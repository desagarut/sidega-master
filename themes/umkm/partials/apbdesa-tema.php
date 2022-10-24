<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="featured-categories section lazy">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Keuangan Desa</h2>
					<p>Transparansi Keuangan Desa</p>
				</div>
			</div>
		</div>
		<div class="row">
			<?php foreach ($data_widget as $subdata_name => $subdatas) : ?>
				<div class="col-lg-4 col-md-6 col-12">

					<div class="single-category">

						<h3 class="heading"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<span class="title"><?= ($subdatas['laporan']) ?></span></button></h3>
						<?php foreach ($subdatas as $key => $subdata) : ?>
							<?php if ($subdata['judul'] != NULL and $key != 'laporan' and $subdata['realisasi'] != 0 or $subdata['anggaran'] != 0) : ?>
								<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
									<div class="accordion-body" style="background-color:#c8daf7;">
										<div class="list" style="color:black;">
											<div><strong>Uraian : <?= ucwords(strtolower($subdata['judul'])) ?></strong></div>
											<div><i class="lni lni-checkmark-circle"></i> <a href="#">Anggaran : Rp. <?= number_format($subdata['anggaran']) ?></a></div>
											<div><i class="lni lni-checkmark-circle"></i> <a href="#">Realisasi : Rp. <?= number_format($subdata['realisasi']) ?></a></div>
											<div><i class="lni lni-checkmark-circle"></i> <a href="#">Persentase : <strong><?= $subdata['persen'] ?>%</strong></a></div>
										</div>
									</div>
								</div>
							<?php endif ?>
						<?php endforeach ?>
					</div>

				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>