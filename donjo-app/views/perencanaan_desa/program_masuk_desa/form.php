<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Form Program Kegiatan Masuk Ke Desa</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url() ?>perencanaan_desa">Perencanaan Desa</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url() ?>perencanaan_desa_program_masuk_desa">Program Masuk Desa</a></li>
            <li class="breadcrumb-item active"><a href="#!">Form</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <?php $this->load->view('perencanaan_desa/menu'); ?>
        </div>
        <div class="col-md-9">
          <form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <div class="row">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-header"> <a href="<?= site_url('perencanaan_desa_program_masuk_desa') ?>" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> Kembali</a> </div>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;" for="tahun">Tahun Anggaran</label>
                          <div class="col-sm-3">
                            <select class="custom-select" id="tahun" name="tahun" style="width:100%;">
                              <option value="">Pilih Tahun</option>
                              <?php for ($i = date('Y') + 5; $i >= date('Y') - 3; $i--) : ?>
                                <option value="<?= $i ?>">
                                  <?= $i ?>
                                </option>
                              <?php endfor; ?>
                            </select>
                            <script>
                              $('#tahun').val("<?= $main->tahun ?>");
                            </script>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;" for="desa">Nama Desa</label>
                          <div class="col-sm-6">
                            <select class="custom-select required" id="desa" name="desa" style="width:100%">
                              <option value=''>-- Pilih Desa --</option>
                              <?php foreach ($list_lokasi as $key => $item) : ?>
                                <option value="<?= $item["desa"] ?>" <?php selected($item["desa"], $main->desa) ?>>
                                  <?= strtoupper($item["desa"]) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;" for="bidang_desa">Bidang</label>
                          <div class="col-sm-6">
                            <select class="custom-select" id="bidang_desa" name="bidang_desa" style="width:100%;">
                              <option value=''>-- Pilih Bidang --</option>
                              <?php foreach ($bidang_desa as $value) : ?>
                                <option <?= $value === $main->bidang_desa ? 'selected' : '' ?> value="<?= $value ?>">
                                  <?= $value ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;">Nama Program/Kegiatan</label>
                          <div class="col-sm-9">
                            <input maxlength="50" class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;" for="sumber_dana">Sumber Dana</label>
                          <div class="col-sm-9">
                            <select class="custom-select" id="sumber_dana" name="sumber_dana" style="width:100%;">
                              <option value=''>-- Pilih Sumber Dana --</option>
                              <?php foreach ($sumber_dana as $value) : ?>
                                <option <?= $value === $main->sumber_dana ? 'selected' : '' ?> value="<?= $value ?>">
                                  <?= $value ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;" for="sdgs_ke">Mendukung SDGS Desa Ke-</label>
                          <div class="col-sm-3">
                            <input maxlength="50" class="form-control input-sm required" name="sdgs_ke" id="sdgs_ke" value="<?= $main->sdgs_ke ?>" type="text" placeholder="Contoh: 1, 2, 3 dst." />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;" for="urutan_prioritas">Tahun Pelaksanaan</label>
                          <!--<div class="col-sm-4">-->
                          <div class="col-sm-3">
                            <input maxlength="50" class="form-control input-sm required" name="tahun_pelaksanaan" id="tahun_pelaksanaan" value="<?= $main->tahun_pelaksanaan ?>" type="text" placeholder="Contoh: 1, 2, 3 dst." />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="lokasi" class="col-sm-3 control-label">Lokasi</label>
                          <div class="col-sm-9">
                            <input maxlength="100" class="form-control input-sm required" name="lokasi" id="lokasi" value="<?= $main->lokasi ?>" type="text" placeholder="Lokasi" />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;">Volume</label>
                          <div class="col-sm-4">
                            <input maxlength="50" class="form-control input-sm required" name="volume" id="volume" value="<?= $main->volume ?>" type="text" placeholder="Volume" />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;">Satuan</label>
                          <div class="col-sm-4">
                            <input maxlength="50" class="form-control input-sm required" name="satuan" id="satuan" value="<?= $main->satuan ?>" type="text" placeholder="Satuan" />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;">Jumlah (Rp)</label>
                          <div class="col-sm-3">
                            <input class="form-control input-sm required" name="anggaran" id="anggaran" value="<?= $main->anggaran ?>" type="text" placeholder="Rp." />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer text-right">
                    <div class="col-xs-12">
                      <a href="<?= site_url('rpjm_desa') ?>" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
                      <button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  function pilih_lokasi(pilih) {
    if (pilih == 1) {
      $('#lokasi').val(null);
      $('#lokasi').removeClass('required');
      $("#manual").hide();
      $("#pilih").show();
      $('#id_lokasi').addClass('required');
    } else {
      $('#id_lokasi').val(null);
      $('#id_lokasi').trigger('change', true);
      $('#id_lokasi').removeClass('required');
      $("#manual").show();
      $('#lokasi').addClass('required');
      $("#pilih").hide();
    }
  }

  $(document).ready(function() {
    pilih_lokasi(<?= is_null($main->lokasi) ? 1 : 2 ?>);
  });
</script>