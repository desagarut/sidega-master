<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="container">
<div class="row">
	<?php foreach($data_widget as $subdata_name => $subdatas) : ?>
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?= ($subdatas['laporan'])?></h4>
				</div>
				<div class="card-body">
					<?php foreach($subdatas as $key => $subdata) : ?>
						<?php if($subdata['judul'] != NULL and $key != 'laporan' and $subdata['realisasi'] != 0 or $subdata['anggaran'] != 0): ?>
								<label class="text-left"><?= ucwords(strtolower($subdata['judul'])) ?></label>
								<div class="text-right">
									<span class="progress__subtitle">Rp<?= number_format($subdata['realisasi']) ?></span>
									<span class="progress__subtitle">Rp<?= number_format($subdata['anggaran']) ?></span>
								</div>
								<div class="progress-bar">
									<div class="progress-bar__item" style="width:<?= $subdata['persen'] ?>%">
										<span class="progress-bar-caption"><?= $subdata['persen'] ?>%</span>
									</div>
								</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
</section>