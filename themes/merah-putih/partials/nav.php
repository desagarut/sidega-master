<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Navbar Start -->

<nav class="navbar navbar-expand-lg bg-danger navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s"> <a href="#" class="navbar-brand ms-3 d-lg-none">MENU</a>
  <button type="button" class="navbar-toggler me-3" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"> <span class="navbar-toggler-icon"></span> </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
  <div class="navbar-nav me-auto p-3 p-lg-0"> <a href="<?= site_url('first') ?>" class="nav-item nav-link " aria-label="Toggle navigation">Home</a>
    <?php if(menu_atas) : ?>
    <?php foreach($menu_atas as $menu) : ?>
    <div class="nav-item dropdown">
      <?php if(count($menu['submenu']) > 0) : ?>
      <a href="<?= $menu['link'] ?>" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
      <?= $menu['nama'] ?>
      </a>
      <div class="dropdown-menu border-0 rounded-0 rounded-bottom m-0">
        <?php foreach($menu['submenu'] as $submenu) : ?>
        <a href="<?= $submenu['link'] ?>" class="dropdown-item">
        <?= $submenu['nama'] ?>
        </a>
        <?php endforeach ?>
      </div>
      <?php endif ?>
    </div>
    <?php endforeach ?>
    <?php endif ?>
    <div class="nav-item dropdown"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Login</a>
      <div class="dropdown-menu border-0 rounded-0 rounded-bottom m-0"> <a href="<?= site_url('mandiri_web') ?>" class="dropdown-item">Partisipan</a> <a href="<?= site_url('insidega') ?>" class="dropdown-item">Manajemen</a> </div>
    </div>
  </div>
</nav>
<!-- Navbar End --> 
