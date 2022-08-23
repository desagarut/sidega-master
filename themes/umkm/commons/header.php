<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<header class="header navbar-area">
        <!-- Start Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-left">
                            <a href="<?= site_url('first') ?>">
                                <img src="<?= gambar_desa($desa['logo']) ?>" style="padding-bottom: 5px; width:38px;" alt="Logo">
                            </a>&nbsp;
                            <a href="<?= site_url('first') ?>" style="color:white; text-shadow: 2px 1px 2px #000; -webkit-text-stroke: 1px transparent; font-size: 25px; font-weight: normally; text-transform: normally; font-family: candara">
                        <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
                        </a>                        
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-middle">
                            <ul class="useful-links">
                                <li><a href="<?= site_url('first') ?>">Home</a></li>
                                <li><a href="#">Pengembang</a></li>
                                <li><a href="#">Hubungi Kami</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-end">
                            <ul class="user-login">
                                <li>
                                    <a href="<?= site_url('insidega') ?>">Login Desa</a>
                                </li>
                                <li>
                                    <a href="<?= site_url('mandiri_web') ?>">Login Warga</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
                <!-- Start Header Bottom -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="nav-inner">
                        <!-- Start Mega Category Menu -->
                         <?php $this->load->view($folder_themes .'/widgets/menu_kategori') ?>
                        <!-- End Mega Category Menu -->
                         <?php $this->load->view($folder_themes .'/commons/nav') ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Nav Social -->
                    <div class="nav-social">
                        
                        <ul>
			<?php foreach ($sosmed As $data): ?>
			<?php if (!empty($data["link"])): ?>
                            <li>
                                <a href="<?= $data['link']?>" target="_blank" alt="<?= $data['nama'] ?>"><i class="lni lni-<?= $data['nama'] ?>"></i></a>
                            </li>
						<?php endif; ?>
					<?php endforeach; ?>
                        </ul>
                    </div>
                    <!-- End Nav Social -->
                </div>
            </div>
        </div>
    </header>


   <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

