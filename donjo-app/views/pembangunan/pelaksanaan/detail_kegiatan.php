<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <section class="content-header">
    <h1>Detail Pelaksanaan Program/Kegiatan</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
      <li class="breadcrumb-item"><a href="#!">Pembangunan</a></li>
      <li class="breadcrumb-item "><a href="#!">Pelaksanaan</a></li>
      <li class="breadcrumb-item active"><a href="#!">Detail</a></li>
    </ol>
  </section>
  <!-- /.content-header -->

  <!-- /.content-header -->
  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-3">
        <?php $this->load->view('pembangunan/menu'); ?>
      </div>
      <div class="col-md-9">
        <div class="box">
          <form id="mainformexcel" name="mainformexcel" method="post" class="form-horizontal">
            <div class="row">
              <div class="col-md-12">
                <div class="box-header">
                  <a href="<?= site_url("pembangunan_dok/form/") ?>" class="btn btn-success btn-sm btn-sm " title="Tambah Data Baru"> <i class="fa fa-plus"></i>Tambah Data </a>
                  <a href="<?= site_url("pembangunan/dialog_daftar/{$musdus_dok->id}/cetak") ?>" class="btnbg-purple btn-sm " data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Detail Usulan" title="Cetak Detail Usulan <?= $musdus_dok->judul ?> "><i class="fa fa-print "></i> Cetak</a>
                  <a href="<?= site_url("pembangunan/dialog_daftar/{$musdus_dok->id}/unduh") ?>" class="btnbg-navy btn-sm " data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Detail Usulan" title="Unduh Detail Usulan <?= $musdus_dok->judul ?> "><i class="fa fa-download "></i> Unduh</a>
                  <a href="<?= site_url('pembangunan') ?>" class="btn btn-info btn-sm " title="Kembali Ke Daftar Usulan"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Daftar Usulan Masyarakat</a>
                </div>
                <div class="box-body">
                  <h5 class="text-bold">Detail Pelaksanaan Program/Kegiatan</h5>
                  <div class="col-md-8">
                  <div class="table-responsive">
                    <table class="table table-hover tabel-rincian">
                      <tbody>
                        <tr>
                          <th width="150px">Nama Dusun</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->dusun ?></td>
                        </tr>
                        <tr>
                          <th width="40%">Nama Usulan Program Kegiatan</th>
                          <td width="1">:</td>
                          <td><?= $pembangunan->nama_program_kegiatan ?></td>
                        </tr>
                        <tr>
                          <td>Sumber Dana</td>
                          <td> : </td>
                          <td><?= $pembangunan->sumber_dana ?></td>
                        </tr>
                        <tr>
                          <td>Lokasi Pembangunan</td>
                          <td> : </td>
                          <td><?= $pembangunan->lokasi ?></td>
                        </tr>
                        <tr>
                          <td>Keterangan</td>
                          <td> : </td>
                          <td><?= $pembangunan->keterangan ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  </div>
                  <div class="col-md-4">
                  <img src="<?= base_url() . LOKASI_GALERI . $pembangunan->foto ?>" width="200" height="180px" alt="Foto Dokumentasi">
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="table-responsive">
                            <table id="tabel-dokumentasi" class="table table-bordered dataTable table-hover">
                              <thead class="bg-gray">
                                <tr>
                                  <th width="20px" class="text-center">No</th>
                                  <th width="80px" class="text-center">Aksi</th>
                                  <th class="text-center">Gambar</th>
                                  <th class="text-center">Persentase</th>
                                  <th class="text-center">Keterangan</th>
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
            </div>
          </form>
        </div>
    </div>
  </section>
  <?php $this->load->view('global/confirm_delete'); ?>
  <script>
    $(function() {
      let tabelDokumentasi = $('#tabel-dokumentasi').DataTable({
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
          'url': "<?= site_url("pembangunan_dok/show/{$pembangunan->id}") ?>",
          'method': 'POST'
        },
        'columns': [{
            'data': null
          },
          {
            'data': function(data) {
              return `<a href="<?= site_url("pembangunan_dok/form/"); ?>${data.id}" title="Edit Data"  class="btn bg-orange btn-box btn-sm"><i class="fa fa-edit"></i> </a>
								<a href="#" data-href="<?= site_url("pembangunan_dok/delete/{$pembangunan->id}/"); ?>${data.id}" class="btn bg-maroon btn-box btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
							   `
            },
            'class': 'text-center'
          },
          {
            'data': function(data) {
              return `<div class="user-panel">
									<div class="image2 text-center">
										<img src="<?= base_url(LOKASI_GALERI) ?>${data.gambar}" class="img-user wid-80 align-top m-r-15" alt="Foto Dokumentasi">
									</div>
								</div>`
            }
          },
          {
            'data': 'persentase'
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
        let PageInfo = $('#tabel-dokumentasi').DataTable().page.info();
        tabelDokumentasi.column(0, {
          page: 'current'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });
    });
  </script>