<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <section class="content-header">
    <h1>Form Rencana Pembiayaan Pembangunan Desa</h1>
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url() ?>pembangunan">Perencanaan Desa</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url() ?>pembangunan_pembiayaan">Rencana Pembiayaan Pembangunan Desa</a></li>
    <li class="breadcrumb-item active"><a href="#!">Form</a></li>
  </ol>
  </section>
  <section class="content">
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
                    <a href="<?= site_url('pembangunan_pembiayaan') ?>" class="btn btn-info btn-sm"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                  </div>
                  <div class="box-body">
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="tahun">Tahun Anggaran</label>
                        <div class="col-sm-3">
                          <select class="form-control select2 required" id="tahun" name="tahun" style="width:100%;">
                            <option value="">Pilih Tahun</option>
                            <?php for ($i = date('Y') + 5; $i >= date('Y') - 2; $i--) : ?>
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
                        <label class="col-sm-3 control-label" style="text-align:left;" for="bidang_desa">Pilih Dusun</label>
                        <div class="col-sm-6">
                          <select name="dusun" class="form-control select2 input-sm required">
                            <option value="">Pilih <?= ucwords($this->setting->sebutan_dusun) ?></option>
                            <?php foreach ($dusun as $data) : ?>
                              <option value="<?= $data['dusun'] ?>" <?php selected($data['dusun'], $data['dusun']) ?>><?= $data['dusun'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="bidang_desa">Bidang/Sub Bidang</label>
                        <div class="col-sm-6">
                          <select class="form-control select2 input-sm required" name="bidang_desa">
                            <option value="">- Pilih Sub Bidang Desa -</option>
                            <?php foreach ($bidang_desa as $data) : ?>
                              <option value="<?= $data['nama'] ?>" <?php selected($data['nama'], $data['nama']); ?>><?= $data['nama'] ?></option>
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
                          <label class="col-sm-3 control-label" style="text-align:left;" for="sumber_dana">PADes</label>
                          <div class="col-sm-3">
                            <input class="form-control input-sm" name="pades" id="pades" value="<?= $main->pades ?>" type="text" placeholder="Rp." />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;" for="sdgs_ke">Dana Desa (APBN)</label>
                          <div class="col-sm-3">
                            <input class="form-control input-sm" name="apbn" id="apbn" value="<?= $main->apbn ?>" type="text" placeholder="Rp." />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;" for="urutan_prioritas">Alokasi Dana Desa (bagian dana perimbangan kab./kota)</label>
                          <!--<div class="col-sm-4">-->
                          <div class="col-sm-3">
                            <input class="form-control input-sm" name="add" id="add" value="<?= $main->add ?>" type="text" placeholder="Rp." />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="lokasi" class="col-sm-3 control-label">Dana bagian dari hasil pajak dan retribusi </label>
                          <div class="col-sm-3">
                            <input maxlength="100" class="form-control input-sm" name="bagi_hasil_pajak" id="bagi_hasil_pajak" value="<?= $main->bagi_hasil_pajak ?>" type="text" placeholder="Rp." />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;">APBD Provinsi</label>
                          <div class="col-sm-3">
                            <input maxlength="100" class="form-control input-sm" name="apbd_prov" id="apbd_prov" value="<?= $main->apbd_prov ?>" type="text" placeholder="Rp." />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;">APBD Kabupaten</label>
                          <div class="col-sm-3">
                            <input maxlength="100" class="form-control input-sm" name="apbd_kab" id="apbd_kab" value="<?= $main->apbd_kab ?>" type="text" placeholder="Rp." />
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 control-label" style="text-align:left;">Sumber Keuangan Lainnya yang Sah dan Tidak Mengikat</label>
                          <div class="col-sm-3">
                            <input class="form-control input-sm" name="lainnya" id="lainnya" value="<?= $main->lainnya ?>" type="text" placeholder="Rp." />
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

