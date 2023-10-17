<?php defined('BASEPATH') || exit('No direct script access allowed');

class Pembangunan_dok_model extends CI_Model
{
	const ORDER_ABLE = [
        3 => 'CAST(d.persentase as UNSIGNED INTEGER)',
        4 => 'd.keterangan',
        5 => 'd.created_at',
        6 => 'd.updated_at',
    ];

    protected $table = 'tbl_pembangunan_dok';

    public function get_data($id, string $search = '')
    {
        $this->db->select('d.*')
            ->from("{$this->table} d")
            ->join('tbl_pembangunan p', 'd.id_pembangunan = p.id')
            ->where('d.id_pembangunan', $id);

        if ($search) {
            $this->db
                ->group_start()
                ->like('d.keterangan', $search)
                ->or_like('p.keterangan', $search)
                ->or_like('d.persentase', $search)
                ->or_like('d.created_at', $search)
                ->or_like('d.updated_at', $search)
                ->group_end();
        }

        return $this->db;
    }

    public function insert($id_pembangunan = '')
    {
        $post = $this->input->post();

        $data['id_pembangunan'] = $id_pembangunan;

        $data['gambar']         = $this->upload_gambar_pembangunan('gambar');
        $data['persentase']     = $post['persentase'] ?: $post['id_persentase'];
        $data['keterangan']     = $post['keterangan'];
        $data['created_at']     = date('Y-m-d H:i:s');
        $data['updated_at']     = date('Y-m-d H:i:s');

        if (empty($data['gambar'])) {
            unset($data['gambar']);
        }

        unset($data['file_gambar'], $data['old_gambar']);

        $outp = $this->db->insert('tbl_pembangunan_dok', $data);
        status_sukses($outp);
    }

    public function update($id = 0, $id_pembangunan = 0)
    {
        $post = $this->input->post();

        $data['id_pembangunan'] = $id_pembangunan;
        $data['gambar']         = $this->upload_gambar_pembangunan('gambar');
        $data['persentase']     = $post['persentase'] ?: $post['id_persentase'];
        $data['keterangan']     = $post['keterangan'];
        //$data['created_at']     = date('Y-m-d H:i:s');
        $data['updated_at']     = date('Y-m-d H:i:s');

        if (empty($data['gambar'])) {
            unset($data['gambar']);
        }

        unset($data['file_gambar'], $data['old_gambar']);

        $outp = $this->db->where('id', $id)->update('tbl_pembangunan_dok', $data);
        status_sukses($outp);
    }

    private function upload_gambar_pembangunan($jenis)
    {
        $this->load->library('upload');
        $this->uploadConfig = [
            'upload_path'   => LOKASI_GALERI,
            'allowed_types' => 'gif|jpg|jpeg|png',
            'max_size'      => max_upload() * 1024,
        ];
        // Adakah berkas yang disertakan?
        $adaBerkas = !empty($_FILES[$jenis]['name']);
        if ($adaBerkas !== true) {
            return null;
        }
        // Tes tidak berisi script PHP
        if (isPHP($_FILES['logo']['tmp_name'], $_FILES[$jenis]['name'])) {
            $_SESSION['error_msg'] .= ' -> Jenis file ini tidak diperbolehkan ';
            $_SESSION['success'] = -1;
            redirect('identitas_desa');
        }

        $uploadData = null;
        // Inisialisasi library 'upload'
        $this->upload->initialize($this->uploadConfig);
        // Upload sukses
        if ($this->upload->do_upload($jenis)) {
            $uploadData = $this->upload->data();
            // Buat nama file unik agar url file susah ditebak dari browser
            $namaFileUnik = tambahSuffixUniqueKeNamaFile($uploadData['file_name']);
            // Ganti nama file asli dengan nama unik untuk mencegah akses langsung dari browser
            $fileRenamed = rename(
                $this->uploadConfig['upload_path'] . $uploadData['file_name'],
                $this->uploadConfig['upload_path'] . $namaFileUnik
            );
            // Ganti nama di array upload jika file berhasil di-rename --
            // jika rename gagal, fallback ke nama asli
            $uploadData['file_name'] = $fileRenamed ? $namaFileUnik : $uploadData['file_name'];
        }
        // Upload gagal
        else {
            $_SESSION['success']   = -1;
            $_SESSION['error_msg'] = $this->upload->display_errors(null, null);
        }

        return (!empty($uploadData)) ? $uploadData['file_name'] : null;
    }

    public function delete($id)
    {
        $data = $this->find($id);

        $outp = $this->db->where('id', $id)->delete($this->table);

        status_sukses($outp);
    }

    public function find($id)
    {
        return $this->db->where('id', $id)
            ->get($this->table)
            ->row();
    }

    public function find_dokumentasi($id_pembangunan)
    {
        return $this->db->where('id_pembangunan', $id_pembangunan)
            ->order_by('CAST(persentase as UNSIGNED INTEGER)')
            ->get($this->table)
            ->result();
    }
}
