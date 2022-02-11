<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
        <h1 class="logo mr-auto">
            <a href="<?= site_url('first') ?>">
                <img src="<?= gambar_desa($desa['logo']) ?>" alt="Logo <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>" class="img-fluid" ><span> <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></span>
            </a>
        </h1>
            <?php $this->load->view($folder_themes .'/commons/nav') ?>
        </div>
    </header>
    <!-- End Header -->

