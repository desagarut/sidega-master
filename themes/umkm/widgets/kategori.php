<!-- widget Kategori-->

<div class="widget popular-tag-widget">
	<h5 class="widget-title"> Kategori</h5>
	<div class="tags">
		
			<?php foreach ($menu_kiri as $data) : ?>
				
					<a href="<?= site_url("artikel/kategori/$data[slug]"); ?>">
						<?= $data['kategori']; ?><?php (count($data['submenu']) > 0) and print('<span class="caret"></span>'); ?>
					</a>
					<?php if (count($data['submenu']) > 0) : ?>
						<ul class="nav submenu">
							<?php foreach ($data['submenu'] as $submenu) : ?>
								<li><a href="<?= site_url("artikel/kategori/$submenu[slug]"); ?>"><?= $submenu['kategori'] ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				
			<?php endforeach; ?>
		
	</div>
</div>