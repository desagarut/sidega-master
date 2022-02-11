<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<nav class="nav-menu d-none d-lg-block">
	<ul>
		<?php if(menu_atas) : ?>	
			<?php foreach($menu_atas as $menu) : ?>
				<li class="drop-down">
					<a href="<?= $menu['link'] ?>" > <?= $menu['nama'] ?><?php if(count($menu['submenu']) > 0) : ?><?php endif ?></a>
						<?php if(count($menu['submenu']) > 0) : ?>
							<ul class="drop-down">
								<?php foreach($menu['submenu'] as $submenu) : ?>
									<li class="nav-dropdown__item"><a href="<?= $submenu['link'] ?>" class="nav-dropdown__link"><?= $submenu['nama'] ?></a></li>
								<?php endforeach ?>
							</ul>
						<?php endif ?>
                </li>
			<?php endforeach ?>
                <li class="get-started"><a href="<?= site_url('siteman') ?>">Login</a></li>
		<?php endif ?>
	</ul>
</nav>

