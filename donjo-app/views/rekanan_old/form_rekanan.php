<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <h1>Form Usulan Masyarakat</h1>
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?= site_url('pembangunan') ?>">Pembangunan</a></li>
      <li class="breadcrumb-item"><a href="#!">Data Rekanan</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-2">
        <?php $this->load->view('pembangunan/menu'); ?>
      </div>
      <div class="col-md-10">
        <div class="box">
          <form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <div class="row">
              <div class="col-md-12">
                <div class="box-header">
                  <a href="<?= site_url('pembangunan') ?>" class="btn btn-sm btn-info"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Kode Rekanan</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;" for="tahun">Jenis Rekanan</label>
                        <div class="col-sm-3">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">NIK Rekanan</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">NPWP Rekanan</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Nama Rekanan</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Nama Instansi</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Jenis Usaha</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Nama Bank</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Nama Cabang</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">No. Rekening</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Nama Rekening</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Telepon</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Email</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 control-label" style="text-align:left;">Alamat</label>
                        <div class="col-sm-9">
                          <input class="form-control input-sm required" name="nama_program_kegiatan" id="nama_program_kegiatan" value="<?= $main->nama_program_kegiatan ?>" type="text" placeholder="Nama Program/Kegiatan" />
                        </div>
                      </div>
                      <?php if ($main->foto) : ?>
                        <div class="form-group row">
                          <label class="control-label col-sm-4" for="nama"></label>
                          <div class="col-sm-6">
                            <input type="hidden" name="old_foto" value="<?= $main->foto ?>">
                            <img class="attachment-img img-responsive img-circle" src="<?= base_url() . LOKASI_GALERI . $main->foto ?>" alt="Gambar Dokumentasi" width="200" height="200">
                          </div>
                        </div>
                      <?php endif; ?>
                      <div class="form-group row">
                        <label class="control-label col-sm-3" for="upload">Unggah Gambar Utama</label>
                        <div class="col-sm-9">
                          <div class="input-group input-group-sm">
                            <input type="text" class="form-control " id="file_path" name="foto">
                            <input id="file" type="file" class="hidden" name="foto">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-info btn-flat" id="file_browser"><i class="fa fa-search"></i> Browse</button>
                            </span>
                          </div>
                          <span class="help-block"><code>(Kosongkan jika tidak ingin mengubah gambar)</code></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer">
                    <div class="col-xs-12"> <a href="<?= site_url('pembangunan') ?>" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
                      <button type="submit" class="btn btn-info pull-right"><i class="fa fa-check"></i> Simpan</button>
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
