<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4>Form Penunjang Usulan Masyarakat</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('pembangunan') ?>">Perencanaan Desa</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url('pembangunan') ?>">Usulan Masyarakat</a></li>
            <li class="breadcrumb-item active"><a href="#!">Form Penunjang Usulan</a></li>
          </ol>
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container-fluid --> 
  </div>
  <!-- /.content-header -->
  
  <section class="content" id="maincontent">
    <div class="row">
    <div class="col-md-3">
      <?php $this->load->view('pembangunan/menu'); ?>
    </div>
    <div class="col-md-9">
      <div class="box">
        <form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
          <div class="row">
            <div class="col-md-12">
              <div class="box-header"> <a href="<?= site_url("pembangunan_dok/show/{$id_pembangunan}") ?>" class="btn btn-info btn-sm "><i class="fa fa-arrow-circle-left"></i> Kembali</a> </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" name="id_pembangunan" value="<?= $id_pembangunan ?>">
                    <div class="form-group row">
                      <label for="jenis_persentase" class="col-sm-3 control-label">Persentase Pelaksaan</label>
                      <div class="btn-group col-sm-8 kiri" data-toggle="buttons">
                        <label class="btn btn-info btn-box btn-sm col-sm-3 form-check-label active">
                          <input type="radio" name="jenis_persentase" class="form-check-input" value="1" autocomplete="off" onchange="pilih_persentase(this.value);">
                          Pilih Persentase </label>
                        <label class="btn btn-info btn-box btn-sm col-sm-3 form-check-label">
                          <input type="radio" name="jenis_persentase" class="form-check-input" value="2" autocomplete="off" onchange="pilih_persentase(this.value);">
                          Tulis Manual </label>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 control-label">PIlih Persentase</label>
                      <div id="pilih">
                        <div class="col-sm-7">
                          <select class="form-control input-sm select2b4 required" id="id_persentase" name="id_persentase" style="width:100%">
                            <option value=''>-- Pilih Persentase  --</option>
                            <?php foreach ($persentase as $value) : ?>
                            <option value="<?= $value ?>" <?= selected($main->persentase, $value) ?>>
                            <?= $value ?>
                            </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div id="manual">
                        <div class="col-sm-7">
                          <input maxlength="50" class="form-control input-sm required" name="persentase" id="persentase" type="text" placeholder="Contoh: 50%" value="<?= $main->persentase ?>" />
                        </div>
                      </div>
                    </div>
                    <?php if ($main->gambar) : ?>
                    <div class="form-group row">
                      <label class="control-label col-sm-4" for="nama"> Dokumen Lama</label>
                      <div class="col-sm-6">
                        <input type="hidden" name="old_foto" value="<?= $main->gambar ?>">
                        <img class="attachment-img img-responsive img-circle" src="<?= base_url() . LOKASI_GALERI . $main->gambar ?>" alt="Gambar Dokumentasi" width="200" height="200"> </div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group row">
                      <label class="control-label col-sm-3" for="upload">Unggah Dokumen Baru</label>
                      <div class="col-sm-7">
                        <div class="input-group input-group-sm">
                          <input type="text" class="form-control " id="file_path" name="gambar">
                          <input id="file" type="file" class="hidden" name="gambar">
                          <span class="input-group-btn">
                          <button type="button" class="btn btn-info btn-box" id="file_browser"><i class="fa fa-search"></i> Browse</button>
                          </span> </div>
                        <span class="help-block"><code>(Kosongkan jika tidak ingin mengubah gambar)</code></span> </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 control-label" style="text-align:left;" for="keterangan">Keterangan</label>
                      <div class="col-sm-7">
                        <textarea rows="5" class="form-control input-sm required" name="keterangan" id="keterangan" placeholder="Keterangan"><?= $main->keterangan ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="col-xs-12">
                  <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
                  <button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
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
	function pilih_persentase(pilih) {
		if (pilih == 1) {
			$('#persentase').val('');
			$('#persentase').removeClass('required');
			$("#manual").hide();
			$("#pilih").show();
			$('#id_persentase').addClass('required');
		} else {
			$('#id_persentase').val('');
			$('#id_persentase').trigger('change', true);
			$('#id_persentase').removeClass('required');
			$("#manual").show();
			$('#persentase').addClass('required');
			$("#pilih").hide();
		}
	}

	$(document).ready(function() {
		pilih_persentase(<?= in_array($main->persentase, $persentase) ? 1 : 2 ?>);
	});
</script> 
