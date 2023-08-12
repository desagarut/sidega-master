<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <section class="content-header">
    <h1>Detail Pelaksanaan Kegiatan</h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Beranda</a></li>
      <li><a href="<?= site_url('pembangunan') ?>desa_detail_kegiatan"> Pembangunan</a></li>
      <li class="active">Detail_kegiatan</li>
    </ol>
  </section>

  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-2">
        <?php $this->load->view('pembangunan/menu'); ?>
      </div>
      <div class="col-md-10">
        <div class="box">
          <div class="box-header">
            <a href="<?= site_url('pembangunan') ?>" class="btn btn-sm btn-info">Kembali</a>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="box">
                    <div class="box-body">
                      <div class="box-header">Gambar Lokasi Usulan Masyarakat</div>
                      <?php $this->load->view('pembangunan/pelaksanaan/peta_view'); ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="box">
                    <div class="box-header">Gambar Lokasi Usulan Masyarakat</div>
                    <div class="box-body">
                      <div class="col-xs-12 col-sm-12">
                        <div class="widget-main text-center"> <img src="<?= base_url() . LOKASI_GALERI . $detail_kegiatan->foto ?>" width="auto" height="180px"> </div>
                        <br />
                        <button class="btn btn-info btn-sm btn-minier" data-toggle="modal" data-target="#sampul<?= $detail_kegiatan->id ?>"> <i class="ace-icon fa fa-eye"></i> Lihat </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="box">
                    <div class="box-header"> Informasi Usulan Program/Kegiatan </div>
                    <div class="box-body">
                      <table class="table table-hover">
                        <tr>
                          <th width="150px">Dusun</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->dusun ?></td>
                        </tr>
                        <tr>
                          <th>Tahun Usulan</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->tahun ?></td>
                        </tr>
                        <tr>
                          <th width="150px">Nama Kegiatan</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->nama_program_kegiatan ?></td>
                        </tr>
                        <tr>
                          <th width="150px">Status Usulan</th>
                          <td width="20px">:</td>
                          <td><?php if ($detail_kegiatan->status == "0") { ?>
                              <button class="btn btn-danger disabled" title="Tidak Aktif"> Tidak Aktif</button>
                            <?php } else { ?>
                              <button class="btn btn-success disabled" title="Aktif"> Aktif</button>
                            <?php } ?>
                            <?php if ($detail_kegiatan->status_usulan == "0") { ?>
                              <button class="btn btn-danger disabled" title="Belum Diusulkan"> Belum Diusulkan</button>
                            <?php } else { ?>
                              <button class="btn btn-success disabled" title="Sudah Diusulkan"> Sudah Diusulkan</button>
                            <?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Alamat Lokasi</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->lokasi ?></td>
                        </tr>
                        <tr>
                          <th>Sumber Dana</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->sumber_dana ?></td>
                        </tr>
                        <tr>
                          <th>Anggaran</th>
                          <td width="20px">:</td>
                          <td>Rp.
                            <?= number_format($detail_kegiatan->anggaran, 0) ?></td>
                        </tr>
                        <tr>
                          <th>Volume</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->volume ?></td>
                        </tr>
                        <tr>
                          <th>Penerima Manfaat</th>
                          <td width="20px">:</td>
                          <td>Laki-laki:
                            <?= $detail_kegiatan->laki ?>
                            | Perempuan:
                            <?= $detail_kegiatan->perempuan ?>
                            | Rumah Tangga
                            <?= $detail_kegiatan->rtm ?></td>
                        </tr>
                        <tr>
                          <th>SDGS KE</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->sdgs_ke ?></td>
                        </tr>
                        <tr>
                          <th>Data Eksisting</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->data_eksisting ?></td>
                        </tr>
                        <tr>
                          <th>Pengusul</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->pengusul ?></td>
                        </tr>
                        <tr>
                          <th>Dibuat Tanggal</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->created_at ?></td>
                        </tr>
                        <tr>
                          <th>Diubah Tanggal</th>
                          <td width="20px">:</td>
                          <td><?= $detail_kegiatan->updated_at ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php foreach ($dokumentasi as $key => $value) : ?>
  <div class="col-xs-4 col-sm-4 pricing-box">
    <div class="box">
      <div class="box-header">
        <h6 class="box-title bigger lighter">Gambar Progres Pembangunan <?= $value->persentase ?></h6>
      </div>
      <div class="box-body">
        <div class=" text-center">
          <img src="<?= base_url() . LOKASI_GALERI . $value->gambar ?>" width="280px" height="180px">
        </div>
        <div>
          <button class="btn btn-info btn-minier" data-toggle="modal" data-target="#<?= $value->id ?>">
            <i class="ace-icon fa fa-eye"></i> View
          </button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>



<div class="modal fade" id="sampul<?= $detail_kegiatan->id ?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Foto Lokasi Usulan Kegiatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="text-center"> <img src="<?= base_url() . LOKASI_GALERI . $detail_kegiatan->foto ?>" width="700px" height="400px"> </div>
      </div>
    </div>
  </div>
</div>
