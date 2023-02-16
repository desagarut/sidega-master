<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<header class="header navbar-area">

    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

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
                            <?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>
                        </a>
                        <!--   <ul class="menu-top-link">
                                <li>
                                    <div class="select-position">
                                        <select id="select4">
                                            <option value="0" selected>$ USD</option>
                                            <option value="1">€ EURO</option>
                                            <option value="2">$ CAD</option>
                                            <option value="3">₹ INR</option>
                                            <option value="4">¥ CNY</option>
                                            <option value="5">৳ BDT</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="select-position">
                                        <select id="select5">
                                            <option value="0" selected>English</option>
                                            <option value="1">Español</option>
                                            <option value="2">Filipino</option>
                                            <option value="3">Français</option>
                                            <option value="4">العربية</option>
                                            <option value="5">हिन्दी</option>
                                            <option value="6">বাংলা</option>
                                        </select>
                                    </div>
                                </li>
                            </ul> -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-middle">
                        <ul class="useful-links">
                            <li><a href="<?= site_url('first') ?>">Home</a></li>
                            <li><a href="<?= site_url('arsip') ?>">Blog</a></li>
                            <li><a href="<?= site_url('first/gallery') ?>">Foto</a></li>
                            <li><a href="<?= site_url('first/gallery_youtube') ?>">Video</a></li>
                            <li><a href="<?= site_url('peta') ?>">Peta Desa</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-end">
                        <!--<div class="user">
                                <i class="lni lni-user"></i>
                                Hello
                            </div>-->
                        <ul class="user-login">
                            <li>
                                <a href="<?= site_url('insidega') ?>">Login Desa</a>
                            </li>
                            <li>
                                <a href="<?= site_url('mandiri_web') ?>">Login Warga</a>
                            </li>
                            <li>
                                <a href="https://wa.me/+62<?= $desa['telepon'] ?>?text=Hallo%2C%20Saya%20pengunjung%20website%20Desa%20<?= $desa['nama_desa'] ?>" target="_blank" title="Hubungi via whatsapp">Hubungi</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->

    <!-- Start Header Bottom -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-6 col-12">
                <div class="nav-inner">
                    <?php $this->load->view($folder_themes . '/commons/nav') ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Nav Social -->
                <div class="nav-social">

                    <ul>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-youtube"></i></a>
                        </li>
                        <li>
                            <a href="https://wa.me/+62<?= $desa['telepon'] ?>?text=Hallo%2C%20Saya%20pengunjung%20website%20Desa%20<?= $desa['nama_desa'] ?>" target="_blank" title="Hubungi via whatsapp"><i class="lni lni-whatsapp"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav Social -->
            </div>
        </div>
    </div>
    <!-- End Header Bottom -->
</header>