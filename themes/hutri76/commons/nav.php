<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <nav class="nav-menu d-none d-lg-block">
        <ul>
        <?php if(menu_atas) : ?>	
        <li class="active"><a href="<?= site_url('first') ?>">Home</a></li>
        <?php foreach($menu_atas as $menu) : ?>
        <li class="drop-down">
            <a href="<?= $menu['link'] ?>" > <?= $menu['nama'] ?><?php if(count($menu['submenu']) > 0) : ?><?php endif ?></a>
            <?php if(count($menu['submenu']) > 0) : ?>
                <ul>
                <?php foreach($menu['submenu'] as $submenu) : ?>
                    <li><a href="<?= $submenu['link'] ?>"><?= $submenu['nama'] ?></a></li>
                <?php endforeach ?>
                </ul>
            <?php endif ?>
        </li>
        <?php endforeach ?>
        <li><a href="<?= site_url('siteman') ?>">Login</a></li>
        <?php endif ?>
        </ul>
    </nav>

    <div class="header-social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
    </div>

