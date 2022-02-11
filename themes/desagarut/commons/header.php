<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

  <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center">
        
            <div class="logo mr-auto">
                <a href="<?= site_url('first') ?>">
                    <h1 class="text-dark"><img src="<?= gambar_desa($desa['logo']) ?>" alt="Logo <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>" class="img-fluid"> <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></h1>
                </a>
            </div>
        
			<?php $this->load->view($folder_themes .'/commons/nav') ?>
        </div>
        
    </header>