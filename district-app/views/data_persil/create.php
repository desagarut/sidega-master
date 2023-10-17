<div class="content-wrapper">
	<section class="content-header">
		<h1>Pengelolaan Data Letter-C <?= ucwords($this->setting->sebutan_deskel) ?> <?= $kelurahan["nama_deskel"]; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('data_persil/clear') ?>"> Daftar Letter-C</a></li>
			<li class="active">Pengelolaan Data Letter-C</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-3">
				<?php $this->load->view('data_persil/menu_kiri.php') ?>
			</div>
			<div class="col-md-9">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url('letterc/clear') ?>" class="btn btn-social btn-box btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Letter-C"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Letter-C</a>
					</div>
					<form action="" id="main" name="main" method="POST" class="form-horizontal">
						<div class="box-body">

							<div class="form-group ">
								<label for="jenis_pemilik" class="col-sm-3 control-label">Jenis Pemilik</label>
								<div class="btn-group col-sm-8 kiri" data-toggle="buttons">
									<label class="btn btn-info btn-box btn-sm col-sm-3 form-check-label <?php (empty($letterc) or $letterc["jenis_pemilik"] == 1) and print('active') ?>">
										<input type="radio" name="jenis_pemilik" class="form-check-input" value="1" autocomplete="off" <?php selected((empty($letterc) or $letterc["jenis_pemilik"] == 1), true, true) ?> onchange="pilih_pemilik(this.value);">Warga Desa
									</label>
									<label class="btn btn-info btn-box btn-sm col-sm-3 form-check-label <?= ($letterc["jenis_pemilik"] == 2) and print('active') ?>">
										<input type="radio" name="jenis_pemilik" class="form-check-input" value="2" autocomplete="off" <?php selected(($letterc["jenis_pemilik"] == 2), true, true) ?> onchange="pilih_pemilik(this.value);">Warga Luar Desa
									</label>
								</div>
							</div>

							<div id="warga_desa">
								<div class="form-group">
									<label class="col-sm-3 control-label">Cari Nama Pemilik</label>
									<div class="col-sm-8">
										<select class="form-control input-sm select2" style="width: 100%;" id="nik" name="nik" onchange="ubah_pemilik($('#jenis_pemilik').val());">
											<option value="">-- Silakan Masukan NIK / Nama --</option>
											<?php foreach ($penduduk as $item) : ?>
												<option value="<?= $item['id'] ?>" <?php selected($pemilik['nik'], $item['id']) ?>>Nama : <?= $item['nama'] . " Alamat : " . $item['info'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<?php if ($pemilik) : ?>
									<div class="form-group">
										<label for="nama" class="col-sm-3 control-label">Pemilik</label>
										<div class="col-sm-8">
											<div class="form-group">
												<label class="col-sm-3 control-label">Nama Penduduk</label>
												<div class="col-sm-9">
													<input class="form-control input-sm" type="text" placeholder="Nama Pemilik" value="<?= $pemilik["nama"] ?>" disabled>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">NIK Pemilik</label>
												<div class="col-sm-9">
													<input class="form-control input-sm" type="text" placeholder="NIK Pemilik" value="<?= $pemilik["nik"] ?>" disabled>
												</div>
											</div>
											<div class="form-group">
												<label for="alamat" class="col-sm-3 control-label">Alamat Pemilik</label>
												<div class="col-sm-9">
													<textarea class="form-control input-sm" placeholder="Alamat Pemilik" disabled><?= "RT " . $pemilik["rt"] . " / RT " . $pemilik["rw"] . " - " . strtoupper($pemilik["dusun"]) ?></textarea>
												</div>
											</div>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</form>

					<form name='mainform' action="<?= site_url('letterc/simpan_letterc') ?>" method="POST" id="validasi" class="form-horizontal">
						<div class="box-body">
							<input id="jenis_pemilik" name="jenis_pemilik" type="hidden" value="1">
							<input type="hidden" name="nik_lama" value="<?= $pemilik["nik_lama"] ?>" />
							<input type="hidden" name="nik" value="<?= $pemilik["nik"] ?>" />
							<input type="hidden" name="id_pend" value="<?= $pemilik["id"] ?>" />
							<?php if ($letterc) : ?>
								<input type="hidden" name="id" value="<?= $letterc["id"] ?>" />
							<?php endif; ?>
							<input type="hidden" name="letterc" value="<?= $letterc["letterc"] ?>" />

							<div id="warga_luar_desa">
								<div class="form-group">
									<label for="letterc" class="col-sm-3 control-label">Nama Pemilik</label>
									<div class="col-sm-8">
										<input class="form-control input-sm required" type="text" placeholder="Nama Pemilik Luar" id="nama_pemilik_luar" name="nama_pemilik_luar" value="<?= ($letterc["nama_pemilik_luar"]) ?>" <?php $pemilik and print('disabled') ?>>
									</div>
								</div>
								<div class="form-group">
									<label for="letterc" class="col-sm-3 control-label">Alamat Pemilik</label>
									<div class="col-sm-8">
										<input class="form-control input-sm required" type="text" placeholder="Alamat Pemilik Luar" id="alamat_pemilik_luar" name="alamat_pemilik_luar" value="<?= ($letterc["alamat_pemilik_luar"]) ?>" <?php $pemilik and print('disabled') ?>>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="letterc" class="col-sm-3 control-label">Nomor Letter-C</label>
								<div class="col-sm-8">
									<input class="form-control input-sm angka required" type="text" placeholder="Nomor Surat Letter-C" name="letterc" value="<?= ($letterc["nomor"]) ?>" <?php !($pemilik or $letterc['jenis_pemilik'] == 2) and print('disabled') ?>>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_kepemilikan" class="col-sm-3 control-label">Nama Pemilik Tertulis di Letter-C</label>
								<div class="col-sm-8">
									<input class="form-control input-sm required" type="text" placeholder="Nama pemilik sebagaimana tertulis di Surat Letter-C" name="nama_kepemilikan" value="<?= ($letterc["nama_kepemilikan"]) ? sprintf("%04s", $letterc["nama_kepemilikan"]) : NULL ?>" <?php !($pemilik or $letterc['jenis_pemilik'] == 2) and print('disabled') ?>>
								</div>
							</div>
						</div>
						<div class="box-header">
							<!-- Lampiran Dokumen-->

							<?php if ($letterc['dokumen']) : ?>
								<div class="form-group">
									<label for="letterc" class="col-sm-3 control-label">Nama Dokumen: </label>
									<div class="col-sm-8">
										<?= $letterc['link_dokumen'] ?> <a href="<?= base_url() . LOKASI_DOKUMEN . $letterc['dokumen'] ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
											<div class="btn btn-sm btn-box btn-success pull-right"> Unduh Dokumen</div>
										</a>
									</div>
								</div>
							<?php endif; ?>
							<!--
							<?php //if ($letterc['dokumen']) : ?>
							<div class="form-group">
								<label class="control-label col-sm-3" for="link_dokumen">Nama File</label>
								<div class="input-group input-group-sm col-sm-8">
									<input id="dokumen" name="dokumen" class="form-control input-sm" type="text" value="<?= $letterc['dokumen'] ?>"></input>
								</div>
							</div>
							<?php //endif; ?>
							
							<div class="form-group">
								<label class="control-label col-sm-3" for="dokumen">Dokumen Lampiran</label>
								<div class="input-group input-group-sm col-sm-8">
									<input type="text" class="form-control" id="file_path4">
									<input type="file" class="hidden" id="file4" name="dokumen">
									<span class="input-group-btn">
										<button type="button" class="btn btn-info btn-box" id="file_browser4"><i class="fa fa-search"></i> Browse</button>
									</span>
								</div>
							</div>
							-->
							<!--<div class="form-group">
								<label class="control-label col-sm-3" for="link_dokumen">Nama Dokumen</label>
								<div class="input-group input-group-sm col-sm-8">
									<input id="link_dokumen" name="link_dokumen" class="form-control input-sm" type="text" value="<?= $letterc['link_dokumen'] ?>"></input>
									<span class="help-block"><code>(Nantinya akan menjadi link unduh/download)</code></span>
									<iframe src="<?= base_url() ?>desa/upload/dokumen/<?= $letterc['link_dokumen'] ?>" width=100% height=400></iframe>
								</div>
							</div>-->
							<!-- Lampiran Dokumen-->

						</div>
						<div class="box-footer">
							<div class="col-xs-12">
								<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
								<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
	$(document).ready(function() {
		$('#tipe').change(function() {
			var id = $(this).val();
			$.ajax({
				url: "<?= site_url('data_persil/kelasid') ?>",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				dataType: 'json',
				success: function(data) {
					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {
						html += '<option value=' + data[i].id + '>' + data[i].kode + ' ' + data[i].ndesc + '</option>';
					}
					$('#kelas').html(html);
				}
			});
			return false;
		});

		pilih_pemilik(<?= $letterc['jenis_pemilik'] ?: 1 ?>);

	});

	function pilih_lokasi(pilih) {
		if (pilih == 1) {
			$("#manual").hide();
			$("#pilih").show();
		} else {
			$("#manual").removeClass('hidden');
			$("#manual").show();
			$("#pilih").hide();
		}
	}

	function pilih_pemilik(pilih) {
		$('#jenis_pemilik').val(pilih);
		if (pilih == 1) {
			if ($('#nik').val() == '') {
				$('input[name=letterc]').attr('disabled', 'disabled');
				$('input[name=nama_kepemilikan]').attr('disabled', 'disabled');
			}
			$('#nama_pemilik_luar').val('');
			$('#nama_pemilik_luar').removeClass('required');
			$('#alamat_pemilik_luar').val('');
			$('#alamat_pemilik_luar').removeClass('required');
			$("#warga_luar_desa").hide();
			$('#nik').addClass('required');
			$("#warga_desa").show();
		} else {
			$('#nik').removeClass('required');
			$("#warga_desa").hide();
			$("#warga_luar_desa").show();
			$('#nama_pemilik_luar').addClass('required');
			$('#alamat_pemilik_luar').addClass('required');
			$('input[name=letterc]').removeAttr('disabled');
			$('input[name=nama_kepemilikan]').removeAttr('disabled');
			if ($('#nik').val() != '') {
				$('#nik').val('');
				$('#nik').change();
			}
		}
	}

	function ubah_pemilik(jenis_pemilik) {
		$('#main').submit();
	}
</script>