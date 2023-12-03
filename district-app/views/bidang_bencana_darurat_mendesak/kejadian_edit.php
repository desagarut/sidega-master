<?php $data = $program[0]; ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Ubah Laporan Kejadian</h1>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?=site_url('bidang_bencana_darurat_mendesak')?>"> Daftar Laporan Kejadian</a></li>
			<li class="active">Ubah Laporan Kejadian</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?=site_url('bidang_bencana_darurat_mendesak')?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Laporan Kejadian"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Laporan Kejadian</a>
			</div>
			<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
				<div class="box-body">
					<?php $kelompok_bencana = $data["kelompok_bencana"]; ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">Kelompok Bencana</label>
						<div class="col-sm-3">
							<select class="form-control input-sm required" name="kelompok_bencana" id="kelompok_bencana">
								<option value="">Pilih Kelompok Bencana</option>
								<option value="1" <?php selected($kelompok_bencana, 1); ?>>Bencana Alam</option>
								<option value="2" <?php selected($kelompok_bencana, 2); ?>>Bencana Non Alam</option>
								<option value="3" <?php selected($kelompok_bencana, 3); ?>>Bencana Sosial</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="jenis_bencana">Jenis Bencana</label>
						<div class="col-sm-8">
							<input name="jenis_bencana" class="form-control input-sm nomor_sk required" maxlength="100" placeholder="Detail jenis bencana" type="text" <?= $kejadian_bencana["jenis_bencana"]; ?>></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="ndesc">Keterangan</label>
						<div class="col-sm-8">
							<textarea id="ndesc" name="ndesc" class="form-control input-sm required" placeholder="Isi Keterangan" maxlength="500" rows="8"><?= $data["ndesc"]; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="penyelenggara">Penyelenggara</label>
						<div class="col-sm-8">
							<input name="penyelenggara" class="form-control input-sm" maxlength="100" placeholder="Nama Penyelenggara"  type="text" value="<?= $data["penyelenggara"]; ?>"></input>
						</div>
					</div>
					<?php $data= $program[0]; $val = $data["asaldana"]; ?>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="asaldana">Asal Dana</label>
						<div class="col-sm-3">
							<select class="form-control input-sm required" name="asaldana" id="asaldana">
								<option value="">Sumber Dana</option>
								<?php foreach ($asaldana AS $ad): ?>
									<option value="<?= $ad?>" <?php selected($val, $ad); ?>><?= $ad?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="anggaran">Anggaran</label>
						<div class="col-sm-8">
							<input name="anggaran" class="form-control input-sm required" maxlength="100" placeholder="Pagu Anggaran"  type="text" value="<?= $data["anggaran"]; ?>"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="lokasi">Lokasi</label>
						<div class="col-sm-8">
							<input name="lokasi" class="form-control input-sm required" maxlength="100" placeholder="Lokasi"  type="text" value="<?= $data["lokasi"]; ?>"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="tgl_post">Rentang Waktu Program</label>
						<div class="col-sm-4">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right" id="tgl_1" name="sdate" placeholder="Tgl. Mulai" type="text" value="<?= date("d/m/Y",strtotime($data["sdate"])); ?>">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right" id="tgl_2" name="edate" placeholder="Tgl. Akhir" type="text" value="<?= date("d/m/Y",strtotime($data["edate"])); ?>">
							</div>
						</div>
					</div>
					<?php $data= $program[0]; $status = $data["status"]; ?>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="status">Status</label>
						<div class="col-sm-3">
							<select class="form-control input-sm required" name="status" id="status">
								<option value="1" <?php selected($status, 1); ?>>Aktif</option>
								<option value="0" <?php selected($status, 0); ?>>Tidak Aktif</option>
								<!-- Default Value Aktif -->
							</select>
						</div>
					</div>
				</div>
				<div class='box-footer'>
					<button type='reset' class='btn btn-social btn-box btn-danger btn-sm'><i class='fa fa-times'></i> Batal</button>
					<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right confirm'><i class='fa fa-check'></i> Simpan</button>
				</div>
			</div>
		</div>
	</section>
</div>
