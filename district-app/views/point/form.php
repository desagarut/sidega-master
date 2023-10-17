<style>
	.bs-glyphicons
	{
		padding-left: 0;
		padding-bottom: 1px;
		margin-bottom: 20px;
		list-style: none;
		overflow: hidden;
	}

	.bs-glyphicons .glyphicon
	{
		margin-top: 5px;
		margin-bottom: 10px;
		font-size: 24px;
	}

	.bs-glyphicons .glyphicon-class
	{
		display: block;
		text-align: center;
		word-wrap: break-word; /* Help out IE10+ with class names */
	}

	.bs-glyphicons li
	{
		float: left;
		width: 25%;
		height: 115px;
		padding: 10px;
		margin: 0 -1px -1px 0;
		font-size: 12px;
		line-height: 1.4;
		text-align: center;
		border: 1px solid #ddd;
	}
	.bs-glyphicons li:hover, .bs-glyphicons li.active
	{
		background-color: #605ca8;
		color:#fff;
	}

	@media (min-width: 768px)
	{
		.bs-glyphicons li
		{
			width: 12.5%;
		}
	}

	.vertical-scrollbar
	{
		overflow-x: hidden;
		overflow-y: auto;
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Pengaturan Tipe Lokasi</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('point')?>"><i class="fa fa-dashboard"></i> Daftar Tipe Lokasi</a></li>
			<li class="active">Pengaturan Lokasi</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="row">
				<div class="col-md-3">
          <?php $this->load->view('plan/nav.php')?>
				</div>
				<div class="col-md-9">
					<div class="box box-info">
            <div class="box-header with-border">
							<a href="<?= site_url("point")?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Tambah Artikel">
								<i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Tipe Lokasi
            	</a>
						</div>
						<div class="box-body">
							<div class="form-group">
								<label for="nama"  class="col-sm-2 control-label">Nama Jenis Lokasi</label>
								<div class="col-sm-8">
									<input  id="nama" class="form-control input-sm nomor_sk required" maxlength="100" type="text" placeholder="Nama Jenis Lokasi" name="nama" required=""  value="<?= $point['nama']?>">
								</div>
							</div>
							<div class="form-group">
								<label for="nomor"  class="col-sm-2 control-label">Simbol</label>
								<div class="col-sm-4">
									<?php if ($point['simbol']!=""): ?>
										<img src="<?= base_url(LOKASI_SIMBOL_LOKASI)?><?= $point['simbol']?>"/>
									<?php else: ?>
										<img src="<?= base_url(LOKASI_SIMBOL_LOKASI)?>default.png"/>
									<?php endif; ?>
								</div>
							</div>
							<div class="form-group">
								<label for="id_master"  class="col-sm-2 control-label">Ganti Simbol</label>
								<div class="col-sm-10">
									<div  class="vertical-scrollbar" style="max-height:300px;">
									  <ul id="icons" class="bs-glyphicons">
											<?php foreach ($simbol as $data): ?>
												<li <?php if ($point['simbol']==$data['simbol']): ?>class="active" id="simbol_active" <?php endif; ?> onclick="li_active($(this).val());">
													<label>
														<input type="radio" name="simbol" id="simbol" class="hidden" value="<?= $data['simbol']?>" <?php if ($point['simbol']==$data['simbol']): ?>checked<?php endif; ?>>
														<img src="<?= base_url(LOKASI_SIMBOL_LOKASI)?><?= $data['simbol']?>">
														<span class="glyphicon-class"><?= $data['simbol']?></span>
													</label>
												</li>
											<?php endforeach;?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class='box-footer'>
							<div class='col-xs-12'>
								<button type='reset' class='btn btn-social btn-box btn-danger btn-sm' onclick="reset_form($(this).val());"><i class='fa fa-times'></i> Batal</button>
								<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right confirm'><i class='fa fa-check'></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<script>
	function li_active()
	{
    $('li').click( function()
		{
      $('li.active').removeClass('active');
      $(this).addClass('active');
      $(this).children("input[type=radio]").click();
    });
	};
	function reset_form()
	{
		$('li.active').removeClass('active');
		$('#simbol_active').addClass('active');
	};
</script>
