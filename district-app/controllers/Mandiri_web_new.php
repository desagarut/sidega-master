<?php defined('BASEPATH') || exit('No direct script access allowed');

use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

class Surat extends Mandiri_Controller
{
    public function __construct()
    {
        parent::__construct();
       // $this->load->model(['keluar_model', 'permohonan_surat_model', 'surat_model', 'surat_master_model', 'lapor_model', 'penduduk_model']);
	   $this->load->model(['web_dokumen_model', 'surat_model', 'penduduk_model', 'keluar_model', 'permohonan_surat_model', 'mailbox_model', 'penduduk_model', 'lapor_model', 'keluarga_model', 'mandiri_model', 'anjungan_model', 'wilayah_model', 'referensi_model', 'web_rumah_model']);
	}

    // Kat 1 = Permohonan
    // Kat 2 = Arsip
    public function index($kat = 1)
    {
        $arsip      = $this->keluar_model->list_data_perorangan($this->is_login->id_pend);
        $permohonan = $this->permohonan_surat_model->list_permohonan_perorangan($this->is_login->id_pend, 1);

        $data = [
            'kat'     => $kat,
            'judul'   => ($kat == 1) ? 'Permohonan Surat' : 'Arsip Surat',
            'main'    => ($kat == 1) ? $permohonan : $arsip,
            'printer' => $this->print_connector(),
        ];

        $this->render('surat', $data);
    }

    public function buat($id = '')
    {
        $id_pend = $this->is_login->id_pend;

        // Cek hanya status = 0 (belum lengkap) yg boleh di ubah
        if ($id) {
            $permohonan = $this->permohonan_surat_model->get_permohonan(['id' => $id, 'id_pemohon' => $id_pend, 'status' => 0]);

            if (! $permohonan) {
                redirect('layanan-mandiri/surat/buat');
            }

            $form_action = site_url("layanan-mandiri/surat/form/{$permohonan['id']}");
        } else {
            $form_action = site_url('layanan-mandiri/surat/form');
        }

        $data = [
            'menu_surat_mandiri'   => $this->surat_model->list_surat_mandiri(),
            'menu_dokumen_mandiri' => $this->lapor_model->get_surat_ref_all(),
            'list_dokumen'         => $this->penduduk_model->list_dokumen($id_pend),
            'kk'                   => ($this->is_login->kk_level === '1') ? $this->keluarga_model->list_anggota($this->is_login->id_kk) : '', // Ambil data anggota KK, jika Kepala Keluarga
            'permohonan'           => $permohonan,
            'form_action'          => $form_action,
        ];

        $this->render('buat_surat', $data);
    }

    public function cek_syarat()
    {
        $id_permohonan = $this->input->post('id_permohonan');
        $permohonan    = $this->db
            ->where('id', $id_permohonan)
            ->get('permohonan_surat')
            ->row_array();

        $syarat_permohonan = json_decode($permohonan['syarat'], true);
        $dokumen           = $this->penduduk_model->list_dokumen($this->is_login->id_pend);
        $id                = $this->input->post('id_surat');
        $syarat_surat      = $this->surat_master_model->get_syarat_surat($id);
        $data              = [];
        $no                = $_POST['start'];

        if ($syarat_surat) {
            foreach ($syarat_surat as $no => $baris) {
                $no++;
                $row   = [];
                $row[] = $no;
                $row[] = $baris['ref_syarat_nama'];
                // Gunakan view sebagai string untuk mempermudah pembuatan pilihan
                $pilihan_dokumen = $this->load->view(MANDIRI . '/pilihan_syarat', ['dokumen' => $dokumen, 'syarat_permohonan' => $syarat_permohonan, 'syarat_id' => $baris['ref_syarat_id'], 'cek_anjungan' => $this->cek_anjungan], true);
                $row[]           = $pilihan_dokumen;
                $data[]          = $row;
            }
        }

        $output = [
            'recordsTotal'    => 10,
            'recordsFiltered' => 10,
            'data'            => $data,
        ];

        $this->json_output($output);
    }

    public function ajax_table_surat_permohonan()
    {
        $data               = $this->penduduk_model->list_dokumen($this->is_login->id_pend);
        $jenis_syarat_surat = $this->referensi_model->list_by_id('ref_syarat_surat', 'ref_syarat_id');

        for ($i = 0; $i < count($data); $i++) {
            $berkas             = $data[$i]['satuan'];
            $list_dokumen[$i][] = $data[$i]['no'];
            $list_dokumen[$i][] = $data[$i]['id'];
            $list_dokumen[$i][] = '<a href="' . site_url('layanan-mandiri/unduh-berkas/' . $data[$i]['id']) . '">' . $data[$i]['nama'] . '</a>';
            $list_dokumen[$i][] = $jenis_syarat_surat[$data[$i]['id_syarat']]['ref_syarat_nama'];
            $list_dokumen[$i][] = tgl_indo2($data[$i]['tgl_upload']);
            $list_dokumen[$i][] = $data[$i]['nama'];
            $list_dokumen[$i][] = $data[$i]['dok_warga'];
        }

        $list['data'] = count($list_dokumen) > 0 ? $list_dokumen : [];

        $this->json_output($list);
    }

    public function ajax_upload_dokumen_pendukung()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama Dokumen', 'required');

        if ($this->form_validation->run() !== true) {
            $data['success'] = -1;
            $data['message'] = validation_errors();

            $this->json_output($data);

            return;
        }

        $this->session->unset_userdata(['success', 'error_msg']);
        $success_msg = 'Berhasil menyimpan data';

        if ($this->is_login->id_pend) {
            $_POST['id_pend'] = $this->is_login->id_pend;
            $id_dokumen       = $this->input->post('id');
            unset($_POST['id']);

            if ($id_dokumen) {
                $hasil = $this->web_dokumen_model->update($id_dokumen, $this->is_login->id_pend, $mandiri = true);
                if (! $hasil) {
                    $data['success'] = -1;
                    $data['message'] = 'Gagal update';
                }
            } else {
                $_POST['dok_warga'] = 1; // Boleh diubah di layanan mandiri
                $this->web_dokumen_model->insert($mandiri = true);
            }
            $data['success'] = $this->session->success;
            $data['message'] = $data['success'] == -1 ? $this->session->error_msg : $success_msg;
        } else {
            $data['success'] = -1;
            $data['message'] = 'Anda tidak mempunyai hak akses itu';
        }

        $this->json_output($data);
    }

    public function ajax_get_dokumen_pendukung()
    {
        $id_dokumen = $this->input->post('id_dokumen');
        $data       = $this->web_dokumen_model->get_dokumen($id_dokumen, $this->is_login->id_pend);

        $data['anggota'] = $this->web_dokumen_model->get_dokumen_di_anggota_lain($id_dokumen);

        if (empty($data)) {
            $data['success'] = -1;
            $data['message'] = 'Tidak ditemukan';
        } elseif ($this->is_login->id_pend != $data['id_pend']) {
            $data = ['message' => 'Anda tidak mempunyai hak akses itu'];
        }

        $this->json_output($data);
    }

    public function ajax_hapus_dokumen_pendukung()
    {
        $id_dokumen = $this->input->post('id_dokumen');
        $data       = $this->web_dokumen_model->get_dokumen($id_dokumen);
        if (empty($data)) {
            $data['success'] = -1;
            $data['message'] = 'Tidak ditemukan';
        } elseif ($this->is_login->id_pend != $data['id_pend']) {
            $data = [
                'success' => -1,
                'message' => 'Anda tidak mempunyai hak akses itu',
            ];
        } else {
            $this->web_dokumen_model->delete($id_dokumen);
            $data['success'] = $this->session->userdata('success') ?: '1';
        }

        $this->json_output($data);
    }

    // Proses permohonan surat
    public function form($id = '')
    {
        $id_pend = $this->is_login->id_pend;

        // Simpan data dari buat surat
        $post                           = $this->input->post();
        $post                           = ($post) ?: $this->session->data_permohonan;
        $this->session->data_permohonan = $post;

        // Cek hanya status = 0 (belum lengkap) yg boleh di ubah
        if ($id) {
            $permohonan = $this->permohonan_surat_model->get_permohonan(['id' => $id, 'id_pemohon' => $id_pend, 'status' => 0]);

            if (! $permohonan || ! $post) {
                redirect('layanan-mandiri/surat/buat');
            }

            $data['permohonan'] = $permohonan;
            $data['isian_form'] = json_encode($this->permohonan_surat_model->ambil_isi_form($permohonan['isian_form']));
            $data['id_surat']   = $permohonan['id_surat'];
        } else {
            if (! $post) {
                redirect('layanan-mandiri/surat/buat');
            }
            $data['permohonan'] = null;
            $data['isian_form'] = null;
            $data['id_surat']   = $post['id_surat'];
        }

        $surat = $this->surat_model->cek_surat_mandiri($data['id_surat']);
        $url   = $surat['url_surat'];

        $data['url']          = $url;
        $data['list_dokumen'] = $this->penduduk_model->list_dokumen($id_pend);
        $data['individu']     = $this->surat_model->get_penduduk($id_pend);
        $data['anggota']      = $this->keluarga_model->list_anggota($data['individu']['id_kk']);
        $data['penduduk']     = $this->penduduk_model->get_penduduk($id_pend);
        $this->get_data_untuk_form($url, $data);
        $data['desa']         = $this->header;
        $data['surat_url']    = rtrim($_SERVER['REQUEST_URI'], '/clear');
        $data['form_action']  = site_url("surat/cetak/{$url}");
        $data['masa_berlaku'] = $this->surat_model->masa_berlaku_surat($url);
        $data['cek_anjungan'] = $this->cek_anjungan;
        $data['mandiri']      = 1; // Untuk tombol cetak/kirim surat

        $this->render('permohonan_surat', $data);
    }

    public function kirim($id = '')
    {
        $this->load->library('Telegram/telegram');

        $data_permohonan = $this->session->data_permohonan;
        $post            = $this->input->post();
        $data            = [
            'id_pemohon'  => $post['nik'],
            'id_surat'    => $post['id_surat'],
            'isian_form'  => json_encode($post),
            'status'      => 1, // Selalu 1 bagi penggun layanan mandiri
            'keterangan'  => $data_permohonan['keterangan'],
            'no_hp_aktif' => $data_permohonan['no_hp_aktif'],
            'syarat'      => json_encode($data_permohonan['syarat']),
        ];

        if ($id) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->permohonan_surat_model->update($id, $data);
        } else {
            $this->permohonan_surat_model->insert($data);

            if (! empty($this->setting->telegram_token) && cek_koneksi_internet()) {
                try {
                    $this->telegram->sendMessage([
                        'text'       => sprintf('Segera cek Halaman Admin, penduduk atas nama %s telah mengajukan %s melalui Layanan Mandiri pada tanggal %s', $this->is_login->nama, str_replace('_', ' ', mb_convert_case($post['url_surat'], MB_CASE_TITLE)), tgl_indo2(date('Y-m-d H:i:s'))),
                        'parse_mode' => 'Markdown',
                        'chat_id'    => $this->setting->telegram_user_id,
                    ]);
                } catch (Exception $e) {
                    log_message('error', $e->getMessage());
                }
            }
        }

        $this->session->unset_userdata('data_permohonan');

        redirect('layanan-mandiri/permohonan-surat');
    }

    private function get_data_untuk_form($url, &$data)
    {
        $this->load->model('pamong_model');
        $this->load->model('surat_model');
        $data['surat_terakhir']     = $this->surat_model->get_last_nosurat_log($url);
        $data['surat']              = $this->surat_model->get_surat($url);
        $data['input']              = $this->input->post();
        $data['input']['nomor']     = $data['surat_terakhir']['no_surat_berikutnya'];
        $data['format_nomor_surat'] = $this->penomoran_surat_model->format_penomoran_surat($data);
        $data['lokasi']             = $this->header['desa'];
        $data['pamong']             = $this->surat_model->list_pamong();
        $pamong_ttd                 = $this->pamong_model->get_ttd();
        $pamong_ub                  = $this->pamong_model->get_ub();
        $data_form                  = $this->surat_model->get_data_form($url);
        if (is_file($data_form)) {
            include $data_form;
        }
    }

    public function proses($id = '')
    {
        $this->permohonan_surat_model->proses($id, 5, $this->is_login->id_pend);

        redirect('layanan-mandiri/permohonan-surat');
    }

    public function cetak_no_antrian(string $no_antrian)
    {
        try {
            $connector = new NetworkPrintConnector($this->cek_anjungan['printer_ip'], $this->cek_anjungan['printer_port'], 5);
            $printer   = new Printer($connector);

            $printer->initialize();
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(2, 2);
            $printer->setEmphasis(true);
            $printer->text('ANJUNGAN MANDIRI');
            $printer->setEmphasis(false);
            $printer->feed(1);

            $printer->setTextSize(1, 1);
            $printer->text("SELAMAT DATANG \n");
            $printer->text('NOMOR ANTRIAN ANDA');
            $printer->feed();

            $printer->setTextSize(4, 4);
            $printer->text(get_antrian($no_antrian));
            $printer->feed();

            $printer->setTextSize(1, 1);
            $printer->text("TERIMA KASIH \n");
            $printer->text('ANDA TELAH MENUNGGU');
            $printer->feed();

            $printer->cut();
        } catch (Exception $e) {
            log_message('error', $e->getMessage());

            redirect($_SERVER['HTTP_REFERER']);
        } finally {
            $printer->close();
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    protected function print_connector()
    {
        if (null === ($anjungan = $this->cek_anjungan)) {
            return;
        }

        try {
            $connector = new NetworkPrintConnector($anjungan['printer_ip'], $anjungan['printer_port'], 5);
        } catch (Exception $e) {
            log_message('error', $e->getMessage());

            return false;
        }

        return $connector;
    }
}
