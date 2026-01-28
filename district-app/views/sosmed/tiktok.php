<div class="box-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<label class="col-sm-3 control-label">Usaername Akun Tiktok</label>
				<div class="col-sm-9">
					<input class="form-control input-sm" maxlength="100" type="text" placeholder="Contoh : https://www.tiktok.com/@desagarut/

Isi kolom ini dengan nama akun tiktok: DesaGarut" name="nama" id="nama" value="<?php if ($main): ?><?= $main['link']; ?><?php endif; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-lg-3 control-label" for="status">Status</label>
				<div class="btn-group col-xs-12 col-sm-9" data-toggle="buttons">
					<label id="sx3" class="btn btn-info btn-box btn-sm col-xs-6 col-sm-4 col-lg-2 form-check-label <?php if ($main['enabled'] == '1'): ?>active<?php endif ?>">
						<input id="g1" type="radio" name="enabled" class="form-check-input" type="radio" value="1" <?php if ($main['enabled'] == '1'): ?>checked <?php endif ?> autocomplete="off"> Aktif
					</label>
					<label id="sx4" class="btn btn-info btn-box btn-sm col-xs-6 col-sm-4 col-lg-2 form-check-label <?php if ($main['enabled'] == '2'): ?>active<?php endif ?>">
						<input id="g2" type="radio" name="enabled" class="form-check-input" type="radio" value="2" <?php if ($main['enabled'] == '2'): ?>checked<?php endif ?> autocomplete="off"> Tidak Aktif
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-lg-3 control-label" for="status">Preview</label>
				<div class="btn-group col-xs-12 col-sm-9" data-toggle="buttons">
					<blockquote class="tiktok-embed" cite="https://www.tiktok.com/<?php if ($main): ?><?= $main['link']; ?><?php endif; ?>" data-unique-id="<?php if ($main): ?><?= $main['link']; ?><?php endif; ?>" data-embed-type="creator" style="max-width: 780px; min-width: 288px;">
						<section> <a target="_blank" href="https://www.tiktok.com/<?php if ($main): ?><?= $main['link']; ?><?php endif; ?>?refer=creator_embed"><?php if ($main): ?><?= $main['link']; ?><?php endif; ?></a> </section>
					</blockquote>
					<script async src="https://www.tiktok.com/embed.js"></script>
				</div>
			</div>
		</div>
	</div>
</div>