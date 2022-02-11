<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<nav class="nav-menu d-none d-lg-block">
  <ul>
    <li><a href="<?= site_url('first') ?>"> HOME</a></li>
    <?php if(menu_atas) : ?>
    <?php foreach($menu_atas as $menu) : ?>
    <li class="drop-down"> <a href="<?= $menu['link'] ?>" >
      <?= $menu['nama'] ?>
      <?php if(count($menu['submenu']) > 0) : ?>
      <?php endif ?>
      </a>
      <?php if(count($menu['submenu']) > 0) : ?>
      <ul>
        <?php foreach($menu['submenu'] as $submenu) : ?>
        <li><a href="<?= $submenu['link'] ?>">
          <?= $submenu['nama'] ?>
          </a></li>
        <?php endforeach ?>
      </ul>
      <?php endif ?>
    </li>
    <?php endforeach ?>
    <li class="drop-down"><a href="<?= site_url('insidega') ?>">Login</a>
      <ul>
        <li><a href="<?= site_url('mandiri_web') ?>">Layanan Masyarakat</a></li>
        <li><a href="<?= site_url('insidega') ?>">Manajemen Desa</a></li>
      </ul>
    </li>
    <?php endif ?>
  </ul>
</nav>
