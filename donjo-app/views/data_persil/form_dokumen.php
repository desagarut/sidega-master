		<script src="<?= base_url() ?>assets/js/validasi.js"></script>
		<script>
			$(document).ready(function() {
				$('#file_browser').click(function(e) {
					e.preventDefault();
					$('#file').click();
				});

				$('#file').change(function() {
					$('#file_path').val($(this).val());
				});

				$('#file_path').click(function() {
					$('#file_browser').click();
				});
			});
		</script>
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

			</div>
			<div class="box-body">
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
				<div class="form-group">
					<label class="control-label col-sm-3" for="dokumen">Dokumen Lampiran</label>
					<!--<div class="input-group input-group-sm col-sm-8">
						<input type="text" class="form-control" id="file_path4">
						<input type="file" class="hidden" id="file4" name="dokumen">
						<span class="input-group-btn">
							<button type="button" class="btn btn-info btn-box" id="file_browser4"><i class="fa fa-search"></i> Browse</button>
						</span>
					</div>-->
					<div class="input-group input-group-sm col-sm-8">
								<input type="text" class="form-control" id="file_path" name="dokumen">
								<input type="file" class="hidden" id="file" name="dokumen">
								<input type="hidden" name="old_file" value="<?= $letterc['dokumen']?>">
								<span class="input-group-btn">
									<button type="button" class="btn btn-info btn-box"  id="file_browser"><i class="fa fa-search"></i> Browse</button>
								</span>
							</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="link_dokumen">Nama Dokumen</label>
					<div class="input-group input-group-sm col-sm-8">
						<input id="link_dokumen" name="link_dokumen" class="form-control input-sm" type="text" value="<?= $letterc['link_dokumen'] ?>"></input>
						<span class="help-block"><code>(Nantinya akan menjadi link unduh/download)</code></span>
						<!--<iframe src="<?= base_url() ?>desa/upload/dokumen/<?= $letterc['link_dokumen'] ?>" width=100% height=400></iframe>-->
					</div>
				</div>
				<!-- Lampiran Dokumen-->

			</div>
			<div class="box-footer">
				<div class="col-xs-12">
					<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
				</div>
			</div>
		</form>