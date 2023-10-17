<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Disposisi Surat Masuk</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda'); ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('surat_masuk'); ?>"> Daftar Surat Masuk</a></li>
			<li class="active">Disposisi Surat Masuk</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url("surat_masuk")?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Wilayah">
					<i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Surat Masuk
				</a>
			</div>
			<form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal nomor-urut">
				<div class="box-body">
					<input type="hidden" id="nomor_urut_lama" name="nomor_urut_lama" value="<?= $surat_masuk['nomor_urut']?>">
					<input type="hidden" id="url_remote" name="url_remote" value="<?= site_url('surat_masuk/nomor_surat_duplikat')?>">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="nomor_urut">Nomor Urut</label>
						<div class="col-sm-8">
							<input id="nomor_urut" name="nomor_urut" class="form-control input-sm required" type="text" placeholder="Nomor Urut" value="<?= $surat_masuk['nomor_urut']?>"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="tanggal_penerimaan">Tanggal Penerimaan</label>
						<div class="col-sm-3">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="tgl_1" name="tanggal_penerimaan" type="text" value="<?= tgl_indo_out($surat_masuk['tanggal_penerimaan'])?>">
							</div>
						</div>
					</div>
					<?php if ( ! is_null($surat_masuk['berkas_scan']) && $surat_masuk['berkas_scan'] != '.'): ?>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="kode_pos"></label>
							<div class="col-sm-6">
								<div class="mailbox-attachment-info">
									<a href="<?= site_url("/surat_masuk/unduh_berkas_scan/$surat_masuk[id]");?>" title=""><i class="fa fa-paperclip"></i> <?= $surat_masuk['berkas_scan'];?></a>
									<p><label class="control-label"><input type="checkbox" name="gambar_hapus" value="<?= $surat_masuk['berkas_scan']?>" /> Hapus Berkas Lama</label></p>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="kode_pos">Berkas Scan Surat Masuk</label>
						<div class="col-sm-6">
							<div class="input-group input-group-sm col-sm-12">
								<input type="text" class="form-control" id="file_path">
								<input type="file" class="hidden" id="file" name="satuan">
								<span class="input-group-btn">
									<button type="button" class="btn btn-info btn-box" id="file_browser"><i class="fa fa-search"></i> Browse</button>
								</span>
							</div>
							<span class="help-block"><code>(Kosongkan jika tidak ingin mengubah berkas)</code></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="kode_surat">Kode/Klasifikasi Surat</label>
						<div class="col-sm-8">
							<select class="form-control input-sm select2 required" id="kode_surat" name="kode_surat">
								<option value="">-- Pilih Kode/Klasifikasi Surat --</option>
								<?php foreach ($klasifikasi as $item): ?>
									<option value="<?= $item['kode'] ?>" <?= selected($item['kode'], $surat_masuk["kode_surat"])?>><?= $item['kode'].' - '.$item['nama']?></option>
								<?php endforeach;?>
							</select>
							</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="nomor_surat">Nomor Surat</label>
						<div class="col-sm-8">
							<input id="nomor_surat" name="nomor_surat" maxlength="35" class="form-control input-sm required" type="text" placeholder="Nomor Surat" value="<?= $surat_masuk['nomor_surat']?>"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="tanggal_surat">Tanggal Surat</label>
						<div class="col-sm-3">
							<div class="input-group input-group-sm date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input class="form-control input-sm pull-right required" id="tgl_2" name="tanggal_surat" type="text" value="<?= tgl_indo_out($surat_masuk['tanggal_surat'])?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="pengirim">Pengirim</label>
						<div class="col-sm-8">
							<input id="pengirim" name="pengirim" class="form-control input-sm required" type="text" placeholder="Pengirim" value="<?= $surat_masuk['pengirim']?>"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="disposisi_kepada">Isi Singkat/Perihal</label>
						<div class="col-sm-8">
							<textarea id="isi_singkat" name="isi_singkat" class="form-control input-sm required" placeholder="Isi Singkat/Perihal" rows="5"><?= $surat_masuk['isi_singkat']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="disposisi_kepada">Disposisi Kepada</label>
						<div class="col-sm-8 col-lg-8">
							<div id="op_item">
								<?php foreach ($ref_disposisi as $data): ?>
									<div class="col-sm-12 col-lg-6 checkbox">
										<label>
											<input name="disposisi_kepada[]" value="<?= $data?>" type="checkbox"
											<?php foreach ($disposisi_surat_masuk as $value): ?>
												<?= selected($value['disposisi_ke'], $data, 1) ?>
											<?php endforeach; ?>
											>
											<?= strtoupper($data); ?>
										</label>
									</div>
								<?php endforeach;?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="isi_disposisi">Isi Disposisi</label>
						<div class="col-sm-8">
							<textarea id="isi_disposisi" name="isi_disposisi" class="form-control input-sm required" placeholder="Isi Disposisi" rows="5"><?= $surat_masuk['isi_disposisi']?></textarea>
						</div>
					</div>
				</div>
				<div class='box-footer'>
					<button type='reset' class='btn btn-social btn-box btn-danger btn-sm' ><i class='fa fa-times'></i> Batal</button>
					<button type='submit' class='btn btn-social btn-box btn-info btn-sm pull-right'><i class='fa fa-check'></i> Simpan</button>
				</div>
			</form>
		</div>
	</section>
</div>
<script type="text/javascript">
	$(function() {
		var keyword = <?= $pengirim; ?> ;
		$("#pengirim").autocomplete({
			source: keyword,
			maxShowItems: 10,
		});
	});
</script>
