<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>

	$(function() {

		var keyword = <?= $keyword?> ;

		$("#cari").autocomplete( {

			source: keyword,

			maxShowItems: 10,

		});

	});

</script>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Pengelolaan Kelompok</h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('beranda'); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Pengelolaan Kelompok</li>
    </ol>
  </section>
  <section class="content" id="maincontent">
  <form id="mainform" name="mainform" action="" method="post">
  <div class="row">
  <div class="col-md-3">
    <div id="bantuan" class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Kategori Kelompok</h3>
        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
        <?php if ($this->CI->cek_hak_akses('h')): ?>
          <?php foreach ($list_master AS $data): ?>
          <li <?= jecho($filter, $data['id'], 'class="active"'); ?>> <a href="<?= site_url("kelompok/to_master/$data[id]"); ?>">
            <?= $data['kelompok']; ?>
            </a> </li>
          <?php endforeach; ?>
          <li> <a class="btn btn-box bg-purple btn-sm" href="<?= site_url("kelompok_master/clear"); ?>"><i class="fa fa-plus"></i> Kelola Kategori Kelompok</a> </li>
		<?php endif;?>        
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-9">
  <div class="box box-info">
  <div class="box-header with-border"> 
  	<?php if ($this->CI->cek_hak_akses('h')): ?>
    <a href="<?= site_url('kelompok/form'); ?>" title="Tambah kelompok Baru" class="btn btn-social btn-box bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-plus"></i> Tambah Kelompok Baru</a> 
    <a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform','<?= site_url("kelompok/delete_all"); ?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a> 
    <?php endif;?>
    <a href="<?= site_url("kelompok/dialog/cetak"); ?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data Kelompok"><i class="fa fa-print "></i> Cetak</a> 
    <a href="<?= site_url("kelompok/dialog/unduh"); ?>" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data Kelompok"><i class="fa fa-download"></i> Unduh</a> 
    <a href="<?= site_url("{$this->controller}/clear"); ?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-refresh"></i>Bersihkan</a> 
</div>
  <div class="box-body">
  <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
  <form id="mainform" name="mainform" action="" method="post">
    <div class="row">
      <div class="col-sm-9">
        <select class="form-control input-sm" name="filter" onchange="formAction('mainform', '<?= site_url('kelompok/filter/filter'); ?>')">
          <option value="">Kategori Kelompok</option>
          <?php foreach ($list_master AS $data): ?>
          <option value="<?= $data['id']; ?>" <?php selected($filter, $data['id']); ?> >
          <?= $data['kelompok']; ?>
          </option>
          <?php endforeach;?>
        </select>
      </div>
      <div class="col-sm-3">
        <div class="input-group input-group-sm pull-right">
          <input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=html_escape($cari); ?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action', '<?= site_url("kelompok/filter/cari"); ?>');$('#'+'mainform').submit();}">
          <div class="input-group-btn">
            <button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("kelompok/filter/cari"); ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
        <thead class="bg-gray disabled color-palette">
          <tr>
            <th><input type="checkbox" id="checkall"/></th>
            <th>No</th>
            
            <th>Aksi</th>
            
            <th>Kode Kelompok</th>
            <th width="50%"><?= url_order($o, "{$this->controller}/{$func}/$p", 1, 'Nama Kelompok'); ?></th>
            <th><?= url_order($o, "{$this->controller}/{$func}/$p", 3, 'Ketua Kelompok'); ?></th>
            <th><?= url_order($o, "{$this->controller}/{$func}/$p", 5, 'Kategori Kelompok'); ?></th>
            <th>Jumlah Anggota</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($main): ?>
          <?php foreach ($main as $key => $data): ?>
          <tr>
            <td class="padat"><input type="checkbox" name="id_cb[]" value="<?= $data['id']; ?>" /></td>
            <td class="padat"><?= ($key + $paging->offset + 1); ?></td>
            
            <td class="aksi">
            	<a href="<?= site_url("kelompok/anggota/$data[id]"); ?>" class="btn bg-purple btn-box btn-sm" title="Rincian Kelompok"><i class="fa fa-list-ol"></i></a> 
                <?php if ($this->CI->cek_hak_akses('h')): ?>
                <a href="<?= site_url("kelompok/form/$p/$o/$data[id]"); ?>" class="btn bg-orange btn-box btn-sm" title="Ubah Data Kelompok"><i class='fa fa-edit'></i></a> 
                <a href="#" data-href="<?= site_url("kelompok/delete/$data[id]"); ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus Data" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                <?php endif;?>
            </td>
            <td nowrap><?= $data['kode']; ?></td>
            <td nowrap><?= $data['nama']; ?></td>
            <td nowrap><?= $data['ketua']; ?></td>
            <td><?= $data['master']; ?></td>
            <td class="padat"><?= $data['jml_anggota']; ?></td>
          </tr>
          <?php endforeach; ?>
          <?php else: ?>
          <tr>
            <td class="text-center" colspan="7">Data Tidak Tersedia</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </form>
  <?php $this->load->view('global/paging'); ?>
</div>
</div>
</div>
</div>
</div>
</form>
</section>
</div>
<?php $this->load->view('global/confirm_delete'); ?>
