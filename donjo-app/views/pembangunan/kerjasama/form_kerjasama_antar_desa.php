<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <section class="content-header">
    <h1>Form Kerjasama Antar Desa</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= site_url('desa_musdus') ?>">Perencanaan Desa</a></li>
      <li class="breadcrumb-item"><a href="<?= site_url('desa_musdus/usulan_masyarakat') ?>">Kerjasama Antar Desa</a></li>
      <li class="breadcrumb-item"><a href="#!">Form</a></li>
    </ol>
  </section>
  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-3">
        <?php $this->load->view('pembangunan/menu'); ?>
      </div>
      <div class="col-md-9">
        <form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <a href="<?= site_url('pembangunan/kerjasama_antar_desa') ?>" class="btn btn-sm btn-info"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="tahun">Tahun</label>
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
                        <label class="col-sm-3 control-label" style="text-align:left;">Nama Program/Kegiatan</label>
                        <div class="col-sm-9">
                          <input maxlength="50" class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="sdgs_ke">Mendukung SDGS Desa Ke-</label>
                        <div class="col-sm-3">
                          <input maxlength="50" class="form-control input-sm required" name="sdgs_ke" id="sdgs_ke" value="<?= $main->sdgs_ke ?>" type="text" placeholder="SDGS KE" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="lokasi" class="col-sm-3 control-label">Lokasi</label>
                        <div class="col-sm-9">
                          <input maxlength="100" class="form-control input-sm required" name="lokasi" id="lokasi" value="<?= $main->lokasi ?>" type="text" placeholder="Lokasi" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Prakiraan Volume & Satuan</label>
                        <div class="col-sm-4">
                          <input maxlength="50" class="form-control input-sm required" name="volume" id="volume" value="<?= $main->volume ?>" type="text" placeholder="Volume" />
                        </div>
                        <div class="col-sm-4">
                          <input maxlength="50" class="form-control input-sm required" name="satuan" id="satuan" value="<?= $main->satuan ?>" type="text" placeholder="Satuan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;"><strong>Penerima Manfaat</strong></label>
                        <div class="col-sm-9">
                          <div class="form-group row">
                            <div class="col-md-4 mb-4">
                              <label class="col-sm-6 control-label">laki</label>
                              <div class="col-sm-6">
                                <input maxlength="50" class="form-control input-sm required" name="laki" id="laki" value="<?= $main->laki ?>" type="text" placeholder="" />
                              </div>
                            </div>
                            <div class="col-md-4 mb-4">
                              <label class="col-sm-6 control-label">Perempuan</label>
                              <div class="col-sm-6">
                                <input maxlength="50" class="form-control input-sm required" name="perempuan" id="perempuan" value="<?= $main->perempuan ?>" type="text" placeholder="" />
                              </div>
                            </div>
                            <div class="col-md-4 mb-4">
                              <label class="col-sm-6 control-label">RTM</label>
                              <div class="col-sm-6">
                                <input maxlength="50" class="form-control input-sm required" name="rtm" id="rtm" value="<?= $main->rtm ?>" type="text" placeholder="" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-6 control-label" style="text-align:left;"><strong>Perkiraan Biaya yang ditanggung Desa</strong></label>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Jumlah (Rp)</label>
                        <div class="col-sm-6">
                          <input class="form-control input-sm required" name="anggaran" id="anggaran" value="<?= $main->anggaran ?>" type="text" placeholder="Anggaran" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="sumber_dana">Sumber Dana</label>
                        <div class="col-sm-6">
                          <select class="custom-select" id="sumber_dana" name="sumber_dana" style="width:100%;">
                            <?php foreach ($sumber_dana as $value) : ?>
                              <option <?= $value === $main->sumber_dana ? 'selected' : '' ?> value="<?= $value ?>">
                                <?= $value ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-6 control-label" style="text-align:left;"><strong>Perkiraan Biaya yang ditanggung Desa Lain</strong></label>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Jumlah (Rp)</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="anggaran" id="anggaran" value="<?= $main->anggaran ?>" type="text" placeholder="Anggaran" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Nama Desa Lain</label>
                        <div class="col-sm-6">
                          <input class="form-control input-sm required" name="nama_desa_lain" id="nama_desa_lain" value="<?= $main->nama_desa_lain ?>" type="text" placeholder="Nama Desa Lain" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer text-right">
                  <div class="col-xs-12"> <a href="<?= site_url('pembangunan') ?>" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
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