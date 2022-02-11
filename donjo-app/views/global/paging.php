<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row paging">
	<div class="col-sm-3 dataTables_length">
		<form class="form-horizontal" id="paging" action="<?= ($func == 'index') ? site_url("$this->controller") : site_url("$this->controller/$func"); ?>" method="POST">
			<label>
				Tampilkan
				<select class="form-control input-sm" name="per_page" onchange="$('#paging').submit()">
					<?php foreach ($set_page as $set): ?>
						<option value="<?= $set; ?>" <?= selected($per_page = $per_page ?: $paging->per_page, $set); ?>><?= $set; ?></option>
					<?php endforeach; ?>
				</select>
				Dari <strong><?= $paging->num_rows; ?></strong> Total Data
			</label>
		</form>
	</div>
	<div class="col-sm-9 dataTables_paginate">
		<ul class="pagination">
			<?php if ($paging->start_link): ?>
				<li <?= jecho($paging->page, 1, "class='disabled'"); ?>><a href="<?= ($func == 'index'OR'paging1') ? site_url("$this->controller") : site_url("$this->controller/$func"); jecho($paging->page.'!', 1, "#"); ?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
			<?php endif; ?>
			<?php if ($paging->prev): ?>
				<li><a href="<?= site_url("$this->controller/$func/$paging->prev"); ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
			<?php endif; ?>
			<?php for ($i=$paging->start_link; $i<=$paging->end_link; $i++): ?>
				<li <?= jecho($paging->page, $i, "class='active'"); ?>><a href="<?= ($i == 1) ? site_url("$this->controller") : site_url("$this->controller/$func/$i"); ?>"><?= $i; ?></a></li>
			<?php endfor; ?>
			<?php if ($paging->next): ?>
				<li><a href="<?= site_url("$this->controller/$func/$paging->next"); ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
			<?php endif; ?>
			<?php if ($paging->end_link): ?>
				<li <?= jecho($paging->page.'!', $paging->end_link, "class='disabled'"); ?>><a href="<?=site_url("$this->controller/$func/$paging->end_link"); jecho($paging->page, $paging->end_link, "#"); ?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
			<?php endif; ?>
		</ul>
	</div>
</div>
