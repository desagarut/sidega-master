<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start Navbar -->
<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="toggler-icon"></span>
        <span class="toggler-icon"></span>
        <span class="toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
        <ul id="nav" class="navbar-nav ms-auto">
            <li class="nav-item">
                <a href="<?= site_url('first') ?>" class="active" aria-label="Toggle navigation">Beranda</a>
            </li>
            
			<?php if(menu_atas) : ?>
            <?php foreach($menu_atas as $menu) : ?>
            <li class="nav-item">
                <a class="dd-menu collapsed" href="<?= $menu['link'] ?>" data-bs-toggle="collapse"
                    data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><?= $menu['nama'] ?>
                    <?php if(count($menu['submenu']) > 0) : ?>
                    <?php endif ?>
      			</a>
                
                <?php if(count($menu['submenu']) > 0) : ?>
                <ul class="sub-menu collapse" id="submenu-1-2">
					<?php foreach($menu['submenu'] as $submenu) : ?>
                        <li class="nav-item">
                        <a href="<?= $submenu['link'] ?>"><?= $submenu['nama'] ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
                <?php endif ?>
            </li>            
			<?php endforeach ?>

            <li class="nav-item">
            		<a class="dd-menu collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">Login</a>
                <ul class="sub-menu collapse" id="submenu-1-2">
                    <li class="nav-item">
                    	<a href="<?= site_url('mandiri_web') ?>">Layanan Masyarakat</a>
                    </li>
                    <li class="nav-item">
                    	<a href="<?= site_url('insidega') ?>">Manajemen Desa</a>
                    </li>
              </ul>
            </li>
            <?php endif ?>
        </ul>
    </div> <!-- navbar collapse -->
</nav>
<!-- End Navbar -->

