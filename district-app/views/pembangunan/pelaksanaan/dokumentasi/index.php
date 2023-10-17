<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <section class="content-header">
    <h1>Detail Progres Pelaksanaan RKP <?= ucwords($this->setting->sebutan_desa); ?></h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
      <li class="breadcrumb-item"><a href="#!">Pembangunan</a></li>
      <li class="breadcrumb-item "><a href="#!">Monitoring</a></li>
      <li class="breadcrumb-item active"><a href="#!">Pelaksanaan RKP</a></li>
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
                  <!-- <a href="<?= site_url("pembangunan/dialog_daftar/{$pembangunan_dok->id}/cetak") ?>" class="btnbg-purple btn-sm " data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Detail Usulan" title="Cetak Detail Usulan <?= $pembangunan_dok->judul ?> "><i class="fa fa-print "></i> Cetak</a>
                  <a href="<?= site_url("pembangunan/dialog_daftar/{$pembangunan_dok->id}/unduh") ?>" class="btnbg-navy btn-sm " data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Detail Usulan" title="Unduh Detail Usulan <?= $pembangunan_dok->judul ?> "><i class="fa fa-download "></i> Unduh</a>-->
                  <a href="<?= site_url('pembangunan/pelaksanaan_rkp') ?>" class="btn btn-info btn-sm " title="Kembali Ke Daftar Usulan"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Pelaksanaan</a>
                </div>
                <div class="box-body">
                  <h5 class="text-bold">Detail Program/Kegiatan</h5>
                  <div class="col-md-7">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <tr>
                          <th width="150px"><?= ucwords($this->setting->sebutan_dusun); ?></th>
                          <td width="20px">:</td>
                          <td><?= strtoupper($pembangunan->dusun) ?></td>
                        </tr>
                        <tr>
                          <th>Tahun Usulan</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->tahun ?></td>
                        </tr>
                        <tr>
                          <th width="150px">Nama Kegiatan</th>
                          <td width="20px">:</td>
                          <td><?= strtoupper($pembangunan->nama_program_kegiatan) ?></td>
                        </tr>
                        <th width="150px">Bidang</th>
                        <td width="20px">:</td>
                        <td><?= $pembangunan->bidang_desa ?></td>
                        </tr>

                        <tr>
                          <th width="150px">Status Usulan</th>
                          <td width="20px">:</td>
                          <td><?php if ($pembangunan->status == "0") { ?>
                              <button class="btn btn-danger btn-sm" title="Tidak Aktif"> Tidak Aktif</button>
                            <?php } else { ?>
                              <button class="btn btn-success btn-sm" title="Aktif"> Aktif</button>
                            <?php } ?>
                            <?php if ($pembangunan->status_usulan == "0") { ?>
                              <button class="btn btn-danger btn-sm" title="Belum Diusulkan"> Belum Diusulkan</button>
                            <?php } else { ?>
                              <button class="btn btn-success btn-sm" title="Sudah Diusulkan"> Sudah Diusulkan</button>
                            <?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Alamat Lokasi</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->lokasi ?></td>
                        </tr>
                        <tr>
                          <th>Sumber Dana</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->sumber_dana ?></td>
                        </tr>
                        <tr>
                          <th>Anggaran</th>
                          <td width="20px">:</td>
                          <td>Rp.
                            <?= number_format($pembangunan->anggaran, 0) ?></td>
                        </tr>
                        <tr>
                          <th>Volume</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->volume ?></td>
                        </tr>
                        <tr>
                          <th>Penerima Manfaat</th>
                          <td width="20px">:</td>
                          <td>Laki-laki:
                            <?= $pembangunan->laki ?>
                            | Perempuan:
                            <?= $pembangunan->perempuan ?>
                            | Rumah Tangga
                            <?= $pembangunan->rtm ?></td>
                        </tr>
                        <tr>
                          <th></th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->manfaat ?></td>
                        </tr>
                        <tr>
                          <th>Mendukung SDGS Ke</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->sdgs_ke ?></td>
                        </tr>
                        <tr>
                          <th>Data Eksisting</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->data_eksisting ?></td>
                        </tr>
                        <tr>
                          <th>Pengusul</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->pengusul ?></td>
                        </tr>
                        <tr>
                          <th>Pelaksana Program/Kegiatan</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->pelaksana_kegiatan ?></td>
                        </tr>
                        <tr>
                          <th>Dibuat Tanggal</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->created_at ?></td>
                        </tr>
                        <tr>
                          <th>Diubah Tanggal</th>
                          <td width="20px">:</td>
                          <td><?= $pembangunan->updated_at ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="row">
                      <img src="<?= base_url() . LOKASI_GALERI . $pembangunan->foto ?>" width="100%" max-height="200px" alt="Foto Dokumentasi"><br/>
                      <?php $this->load->view('pembangunan/pelaksanaan/peta_view'); ?>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                    <h5 class="text-bold">Progres Pelaksanaan Program/Kegiatan</h5>
                    </div>
                  </div>
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
                                  <th class="text-center">Tgl Dibuat</th>
                                  <th class="text-center">Tgl Update</th>
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
          },
          {
            'data': 'updated_at'
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