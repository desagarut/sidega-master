<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Main content -->
<section class="content" id="maincontent">
  <div class="row">
    <div class="col-md-12">
      <form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group row">
          <label class="col-sm-3 control-label" style="text-align:left;">Nama Program/Kegiatan</label>
          <div class="col-sm-9">
            <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 control-label" style="text-align:left;" for="urutan_prioritas">Urutan Prioritas</label>
          <div class="col-sm-2">
            <input maxlength="50" class="form-control input-sm required col-md-1" name="urutan_prioritas" id="urutan_prioritas" value="<?= $main->urutan_prioritas ?>" type="text" placeholder="diisi angka" />
            <code>isi dengan angka</code>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 control-label" style="text-align:left;" for="sdgs_ke">Mendukung SDGS Desa Ke-</label>
          <div class="col-sm-2">
            <input maxlength="50" class="form-control input-sm required" name="sdgs_ke" id="sdgs_ke" value="<?= $main->sdgs_ke ?>" type="text" placeholder="contoh: 1, 2, 3" />
          </div>
          <div class="col-sm-6">
            <code>Diisi sesuai dengan nomor 18 Goals SDGS Desa</code>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-12 control-label" style="text-align:left;"><strong>Perkiraan Biaya dan Sumber Pembiayaan</strong></label>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 control-label" style="text-align:left;">Jumlah (Rp)</label>
          <div class="col-sm-9">
            <input class="form-control input-sm required" name="anggaran" id="anggaran" value="<?= $main->anggaran ?>" type="text" placeholder="Anggaran" />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 control-label" style="text-align:left;" for="sumber_dana">Sumber Dana</label>
          <div class="col-sm-9">
            <select class="form-control input-sm select2 required" id="sumber_dana" name="sumber_dana" style="width:100%;">
              <?php foreach ($sumber_dana as $value) : ?>
                <option <?= $value === $main->sumber_dana ? 'selected' : '' ?> value="<?= $value ?>">
                  <?= $value ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 control-label" style="text-align:left;" for="pelaksana_kegiatan">Pelaksana Program/Kegiatan</label>
          <div class="col-sm-9">
          <select class="form-control select2 input-sm required" name="pelaksana_kegiatan">
            <option value="">Pilih Rekanan</option>
              <?php foreach ($pelaksana_kegiatan as $data) : ?>
                <option value="<?= $data['nama_rekanan'] ?>" <?php selected($main->pelaksana_kegiatan, $data['nama_rekanan']); ?>><?= $data['nama_rekanan'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="box-footer">
          <div class="col-xs-12"> <a href="<?= site_url('pembangunan/daftar_usulan_tk_desa') ?>" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>