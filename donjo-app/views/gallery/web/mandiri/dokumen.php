<?php $this->load->view('web/mandiri/header_mandiri.php') ?>

<style type="text/css">
table.table th {
	text-align: left;
}
#list_dokumen td.nowrap {
	white-space: nowrap;
}
</style>
<script type='text/javascript'>
	const LOKASI_DOKUMEN = '<?= base_url().LOKASI_DOKUMEN ?>';
</script>

<?php // include('donjo-app/views/web/mandiri/menu.php'); ?>
<?php $this->load->view('web/mandiri/menu.php'); ?>
         
<div class="content-wrapper">
  <section class='content' id="maincontent">
    <div class='row'>
      <div class='col-md-12'>
        <div class="box box-info" style="margin-top: 10px;">
          <div class="box-body">
            <button type="button" title="Tambah Dokumen" data-remote="false" data-toggle="modal" data-target="#modal" data-title="Tambah Dokumen" class="btn btn-social btn-box bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" id="tambah_dokumen"><i class='fa fa-plus'></i>Tambah Dokumen</button>
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="dokumen">
                <thead>
                  <tr>
                    <th class="padat">No</th>
                    <th class="padat nowrap">Aksi</th>
                    <th>Judul Dokumen</th>
                    <th>Jenis Dokumen</th>
                    <th width="20%" nowrap>Tanggal Upload</th>
                  </tr>
                </thead>
                <tbody id="list_dokumen">
                </tbody>
              </table>
            </div>
          </div>
        </div> 
        </div>
    </div>
 </section>
 </div>         
<div class="modal fade in" id="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header btn-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle"></i> &nbsp;Peringatan</h4>
      </div>
      <div class="modal-body">
        <p id="kata_peringatan"></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title' id='myModalLabel'>Ubah dokumen</h4>
      </div>
      <form id="unggah_dokumen" action="" method="POST" enctype="multipart/form-data">
        <div class='modal-body'>
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-danger">
                <div class="box-body">
                  <div class="form-group">
                    <label for="nama_dokumen">Nama / Jenis Dokumen</label>
                    <div class="input-group col-sm-12">
                      <input id="nama_dokumen" name="nama" class="form-control input-sm required <?= jecho($cek_anjungan, TRUE, 'kbvtext'); ?>" type="text" placeholder="Nama Dokumen" value=""/>
                      <input type="text" class="hidden" name="id" id="id_dokumen" value=""/>
                    </div>
                  </div>
                  <div class="form-group">
                    <select class="form-control required input-sm" name="id_syarat" id="id_syarat">
                      <option> -- Pilih Jenis Dokumen -- </option>
                      <?php foreach ($menu_dokumen_mandiri AS $data): ?>
                      <option value="<?= $data['ref_syarat_id']?>" >
                      <?= $data['ref_syarat_nama']?>
                      </option>
                      <?php endforeach;?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="file" >Pilih File:</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control" id="file_path" name="satuan">
                      <input type="file" class="hidden" id="file" name="satuan">
                      <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-box" id="file_browser"><i class="fa fa-search"></i> Browse</button>
                      </span> </div>
                    <span class="help-block"><code>Kosongkan jika tidak ingin mengubah dokumen.</code></span> </div>
                  <?php if (!empty($kk)): ?>
                  <hr>
                  <span class="help-block"><code>Centang jika dokumen yang diupload berlaku juga untuk anggota keluarga di bawah ini.</code></span>
                  <table class="table table-striped table-bordered table-responsive">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($kk as $item): ?>
                      <?php if ($item['nik'] != $penduduk['nik']): ?>
                      <tr>
                        <td><input class='anggota_kk' id="anggota_<?=$item['id']?>" type='checkbox' name='anggota_kk[]' value="<?=$item['id']?>"></td>
                        <td><?=$item['nik']?></td>
                        <td><?=$item['nama']?></td>
                      </tr>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
          <button type="submit" class="btn btn-social btn-box btn-info btn-sm" id="upload_btn"><i class='fa fa-check'></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $this->load->view('web/mandiri/footer_mandiri.php') ?>
