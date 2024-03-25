<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container-xxl py-5">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.2s">
			<h1 class="mb-5">Realisasi Pelaksanaan APB Desa</h1>
		</div>
		<div class="row">
			<?php foreach ($data_widget as $subdata_name => $subdatas) : ?>
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title"><?= ($subdatas['laporan']) ?></h4>
						</div>
						<div class="card-body">
							<?php foreach ($subdatas as $key => $subdata) : ?>
								<?php if ($subdata['judul'] != NULL and $key != 'laporan' and $subdata['realisasi'] != 0 or $subdata['anggaran'] != 0) : ?>
									<label class="text-left"><strong><?= ucwords(strtolower($subdata['judul'])) ?></strong></label>
									<div class="text-right">
										Realisasi : <span class="progress__subtitle">Rp<?= number_format($subdata['realisasi']) ?></span><br />
										Anggaran :
										<span class="progress__subtitle">Rp<?= number_format($subdata['anggaran']) ?></span>
									</div>
									<div class="progress-bar">
										<div class="progress-bar__item" style="width:<?= $subdata['persen'] ?>%">
											<span class="progress-bar-caption"><?= $subdata['persen'] ?>%</span>
										</div>
									</div><br />
								<?php endif ?>
							<?php endforeach ?>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>