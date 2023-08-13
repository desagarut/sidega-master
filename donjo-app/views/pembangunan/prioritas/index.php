<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>Daftar Vote</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= site_url() ?>pembangunan">Pembangunan</a></li>
      <li class="breadcrumb-item "><a href="<?= site_url() ?>pembangunan/usulan_dusun">Polling</a></li>
      <li class="breadcrumb-item active"><a href="#!">Daftar Vote</a></li>
    </ol>
  </section>
  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-3">
        <?php $this->load->view('pembangunan/menu'); ?>
      </div>
      <div class="col-md-9">
        <form id="mainformexcel" name="mainformexcel" method="post" class="form-horizontal">
          <div class="box">
            <div class="row">
              <div class="col-md-12">
                <div class="box-header"> <a href="<?= site_url("pembangunan_polling/form/"); ?>" class="btn btn-success btn-sm btn-sm " title="Tambah Data Baru"> Tambah Tanggapan </a> <a href="<?= site_url("desa_musdus/dialog_daftar/{$polling->id}/cetak") ?>" class="btnbg-purple btn-sm " data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data Pembangunan" title="Cetak Data Pembangunan <?= $polling->judul ?> "><i class="fa fa-print "></i> Cetak</a> <a href="<?= site_url("desa_musdus/dialog_daftar/{$polling->id}/unduh") ?>" class="btnbg-navy btn-sm " data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data Pembangunan" title="Unduh Data Pembangunan <?= $polling->judul ?> "><i class="fa fa-download "></i> Unduh</a> <a href="<?= site_url('pembangunan/usulan_dusun') ?>" class="btn btn-info btn-sm " title="Kembali Ke Daftar Usulan Dusun"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Daftar Usulan Dusun</a> </div>
                <div class="box-body">
                  <h5 class="text-bold">INFORMASI PENENTUAN PRIORITAS</h5>
                  <div class="table-responsive">
                    <table class="table table-hover tabel-rincian">
                      <tbody>
                        <tr>
                          <th width="150px">Nama Desa</th>
                          <td width="20px">:</td>
                          <td><?= $polling->desa ?></td>
                        </tr>
                        <tr>
                          <th width="40%">Nama Usulan Program Kegiatan</th>
                          <td width="1">:</td>
                          <td><?= $polling->nama_program_kegiatan ?></td>
                        </tr>
                        <tr>
                          <td>Sumber Dana</td>
                          <td> : </td>
                          <td><?= $polling->sumber_dana ?></td>
                        </tr>
                        <tr>
                          <td>Lokasi Pembangunan</td>
                          <td> : </td>
                          <td><?= $polling->alamat ?></td>
                        </tr>
                        <tr>
                          <td>Keterangan</td>
                          <td> : </td>
                          <td><?= $polling->keterangan ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="box">
                <div class="box-header">
                  <div class="box-title">Tanggapan Masyarakat</div>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive">
                        <table id="table-polling" class="table table-bordered dataTable table-hover">
                          <thead class="bg-gray">
                            <tr>
                              <th width="20px" class="text-center">No</th>
                              <th width="80px" class="text-center">Aksi</th>
                              <th class="text-center">Responden</th>
                              <th class="text-center">Persentase</th>
                              <th class="text-center">Tanggapan</th>
                              <th class="text-center">Pernyataan Tambahan</th>
                              <th class="text-center">Tgl Rekam</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
  </section>
  <?php $this->load->view('global/confirm_delete'); ?>
  <script>
    $(function() {
      let tabelDokumentasi = $('#table-polling').DataTable({
        'processing': true,
        'serverSide': true,
        'autoWidth': false,
        'pageLength': 10,
        'order': [
          [3, 'asc']
        ],
        'columnDefs': [{
          'orderable': false,
          'targets': [0, 1, 2]
        }],

        'ajax': {
          'url': "<?= site_url("pembangunan_polling/daftar_polling/{$polling->id}") ?>",
          'method': 'POST'
        },
        'columns': [{
            'data': null
          },
          {
            'data': function(data) {
              return `<a href="<?= site_url("pembangunan_polling/form/"); ?>${data.id}" title="Edit Data"  class="btn bg-orange btn-box btn-sm"><i class="fa fa-edit"></i> </a>
								<a href="#" data-href="<?= site_url("pembangunan_polling/delete/{$polling->id}/"); ?>${data.id}" class="btn bg-maroon btn-box btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
							   `
            },
            'class': 'text-center'
          },
          {
            'data': 'id_responden'
          },
          {
            'data': 'persentase'
          },
          {
            'data': 'id_pilihan'
          },
          {
            'data': 'keterangan'
          },
          {
            'data': 'created_at'
          }
        ],
        'language': {
          'url': "<?= base_url('/assets/bootstrap/js/dataTables.indonesian.lang') ?>"
        }
      });

      tabelDokumentasi.on('draw.dt', function() {
        let PageInfo = $('#table-polling').DataTable().page.info();
        tabelDokumentasi.column(0, {
          page: 'current'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });
    });
  </script>