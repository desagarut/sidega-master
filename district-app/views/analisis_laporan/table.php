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
    <h1>Laporan Hasil Analisis</h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('beranda'); ?>"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="<?= site_url('analisis_master'); ?>"> Master Analisis</a></li>
      <li><a href="<?= site_url('analisis_laporan/leave'); ?>">
        <?= $analisis_master['nama']; ?>
        </a></li>
      <li class="active">Laporan Hasil Klasifikasi</li>
    </ol>
  </section>
  </section>
  <section class="content" id="maincontent">
  <form id="mainform" name="mainform" action="" method="post">
  <div class="row">
  <div class="col-md-4 col-lg-3">
    <?php $this->load->view('analisis_master/left', $data); ?>
  </div>
  <div class="col-md-8 col-lg-9">
  <div class="box box-info">
  <div class="box-header with-border"> <a href="<?= site_url("analisis_laporan/dialog/$o/cetak")?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Laporan Hasil Analisis <?= $judul['asubjek']; ?>" title="Cetak"><i class="fa fa-print"></i>Cetak</a> <a href="<?= site_url("analisis_laporan/dialog/$o/unduh")?>" class="btn btn-social btn-box bg-navy btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Laporan Hasil Analisis <?= $judul['asubjek']; ?>" title="Unduh"><i class="fa fa-download"></i>Unduh</a> <a href="<?= site_url("analisis_laporan/ajax_multi_jawab"); ?>" class="btn btn-social btn-box bg-olive btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Filter Indikator" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Filter Indikator"><i class="fa fa-search"></i>Filter Indikator</a> <a href="<?= site_url("{$this->controller}/clear"); ?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-refresh"></i>Bersihkan</a> <a href="<?= site_url(); ?>analisis_laporan/leave" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar RW"><i class="fa fa-arrow-circle-left "></i>Kembali Ke
    <?= $analisis_master['nama']; ?>
    </a> </div>
  <div class="box-header with-border">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover tabel-rincian">
        <tr>
          <td width="20%">Nama Analisis</td>
          <td width="1%">:</td>
          <td><a href="<?= site_url("analisis_master/menu/$analisis_master[id]"); ?>">
            <?= $analisis_master['nama']; ?>
            </a></td>
        </tr>
        <tr>
          <td>Subjek Analisis</td>
          <td>:</td>
          <td><?= $judul['asubjek']; ?></td>
        </tr>
        <tr>
          <td>Priode</td>
          <td>:</td>
          <td><?= $analisis_periode; ?></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="box-body">
  <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
  <form id="mainform" name="mainform" action="" method="post">
    <div class="row">
      <div class="col-sm-8">
        <select class="form-control input-sm" name="klasifikasi" onchange="formAction('mainform', '<?= site_url('analisis_laporan/filter/klasifikasi'); ?>')">
          <option value=""> --- Klasifikasi --- </option>
          <?php foreach ($list_klasifikasi AS $data): ?>
          <option value="<?= $data['id']; ?>" <?= selected($klasifikasi, $data['id']); ?>>
          <?= $data['nama']; ?>
          </option>
          <?php endforeach;?>
        </select>
        <?php $this->load->view('global/filter_wilayah', ['form' => 'mainform']); ?>
      </div>
      <div class="col-sm-4">
        <div class="input-group input-group-sm pull-right">
          <input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=html_escape($cari)?>" onkeypress="if (event.keyCode == 13):$('#'+'mainform').attr('action', '<?= site_url("analisis_laporan/filter/cari"); ?>');$('#'+'mainform').submit();endif">
          <div class="input-group-btn">
            <button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("analisis_laporan/filter/cari"); ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped dataTable table-hover tabel-daftar">
        <thead class="bg-gray disabled color-palette">
          <tr>
            <th>No</th>
            <th>Aksi</th>
            <th><?= url_order($o, "{$this->controller}/{$func}/$p", 1, $judul['nomor']); ?></th>
            <?php if($analisis_master['subjek_tipe'] != 4): ?>
            <th><?= url_order($o, "{$this->controller}/{$func}/$p", 7, $judul['nomor_kk']); ?></th>
            <?php endif;?>
            <th><?= url_order($o, "{$this->controller}/{$func}/$p", 3, $judul['nama']); ?></th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th><?= url_order($o, "{$this->controller}/{$func}/$p", 5, "Nilai"); ?></th>
            <th>Klasifikasi</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($main): ?>
          <?php foreach ($main as $key => $data): ?>
          <tr>
            <td class="padat"><?= ($key + $paging->offset + 1); ?></td>
            <td class="aksi"><a href="<?= site_url("analisis_laporan/kuisioner/$p/$o/$data[id]"); ?>" class="btn bg-purple btn-box btn-sm" title="Rincian"><i class='fa fa-list'></i></a></td>
            <td><?= $data['uid']; ?></td>
            <?php if($analisis_master['subjek_tipe'] != 4): ?>
            <td><?= $data['kk']; ?></td>
            <?php endif; ?>
            <td nowrap><?= $data['nama']; ?></td>
            <td><?= $data['jk']; ?></td>
            <td><?= strtoupper($data['alamat'] . " " . "RT/RW ". $data['rt']."/".$data['rw'] . " - " . $this->setting->sebutan_dusun . " " . $data['dusun']); ?></td>
            <td><?= $data['nilai']; ?></td>
            <td><?= $data['klasifikasi']; ?></td>
          </tr>
          <?php endforeach; ?>
          <?php else: ?>
          <tr>
            <td class="text-center" colspan="9">Data Tidak Tersedia</td>
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
