					<div class="box box-info">
						<div class="box-body no-padding">
							<!-- <h3 class="box-title"> -->
								<ul class="nav nav-pills nav-stacked">
									<li class="<?= jecho($cat, -1, 'active'); ?>">
										<a href='<?= site_url("web/tab/-1")?>'>
											Semua Artikel Dinamis
										</a>
									</li>
								</ul>
							<!-- </h3> -->
						</div>
					</div>
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Kategori Artikel</h3>
							<div class="box-tools">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body no-padding">
							<ul class="nav nav-pills nav-stacked">
								<?php foreach ($list_kategori AS $data): ?>
									<li class="<?= jecho($cat, $data['id'], 'active'); ?>">
										<a href='<?= site_url("web/tab/$data[id]")?>'>
											<?= $data['kategori'];?>
										</a>
									</li>
									<?php foreach($data['submenu'] as $submenu): ?>
										<li class="<?= jecho($cat, $submenu['id'], 'active'); ?>">
											<a href='<?= site_url("web/tab/$submenu[id]")?>'>
												&emsp;<?= $submenu['kategori'];?>
											</a>
										</li>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Artikel Statis</h3>
							<div class="box-tools">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body no-padding">
							<ul class="nav nav-pills nav-stacked">
								<li class="<?= jecho($cat, 999, 'active'); ?>"><a href="<?= site_url('web/tab/999')?>">Halaman Statis</a></li>
								<li class="<?= jecho($cat, 1000, 'active'); ?>"><a href="<?= site_url('web/tab/1000')?>">Agenda</a></li>
								<li class="<?= jecho($cat, 1001, 'active'); ?>"><a href="<?= site_url('web/tab/1001')?>">Keuangan</a></li>
							</ul>
						</div>
					</div>
