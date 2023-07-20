<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$towa = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_toko_warga WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$tawa = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_tawa WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$tukang = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_tukang WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$wisata = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_wisata WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
?>

<div class="content-wrapper">
    <section class='content-header'>
        <h1>UMKM</h1>
        <ol class='breadcrumb'>
            <li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">UMKM</li>
        </ol>
    </section>

    <section class='content' id="maincontent">
        <div class='row'>
            <div id="umkm" class="col-sm-3">
                <?php $this->load->view('umkm/menu') ?>
            </div>
            <div id="umkm" class="col-sm-9">
                <?php // $this->load->view($main_content) 
                ?>
                <!--</div> -->
                <div class="box box-primary box-solid">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-3 col-xs-3">
                                <a href="<?= site_url('toko_warga') ?>" class="small-box-footer" title="Lihat Toko Warga">
                                    <div class="small-box bg-red">
                                        <div class="inner">

                                            <h4>
                                                Toko : <?= number_format($towa, 0, '', '.') ?>
                                            </h4>

                                            <p></p>
                                        </div>
                                        <div class="icon"> <img src="<?= base_url("assets/files/logo/toko.png") ?>" class="img-fluid responsive" width="40px" height="40px" alt=""> </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-3 col-xs-3">
                                <a href="<?= site_url('tawa') ?>" class="small-box-footer" title="Lihat Transportasi Warga">
                                    <div class="small-box bg-green">
                                        <div class="inner">

                                            <h4>
                                                Transport : <?= number_format($tawa, 0, '', '.') ?>
                                            </h4>
                                        </div>
                                        <div class="icon"> <img src="<?= base_url("assets/files/logo/transport.png") ?>" class="img-fluid responsive" width="40px" height="40px" alt=""> </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-3 col-xs-3">
                                <a href="<?= site_url('tukang') ?>" class="small-box-footer" title="Lihat Pertukangan Warga">
                                    <div class="small-box bg-yellow">
                                        <div class="inner">

                                            <h4>
                                                Tukang : <strong><?= number_format($tukang, 0, '', '.') ?></strong>
                                            </h4>
                                        </div>
                                        <div class="icon"> <img src="<?= base_url("assets/files/logo/tukang.png") ?>" class="img-fluid responsive" width="40px" height="40px" alt=""> </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-sm-3 col-xs-3">
                                <a href="<?= site_url('wisata') ?>" class="small-box-footer" title="Lihat Wisata Desa">
                                    <div class="small-box bg-blue">
                                        <div class="inner">

                                            <h4>
                                                Wisata : <?= number_format($wisata, 0, '', '.') ?>
                                            </h4>
                                        </div>
                                        <div class="icon"> <img src="<?= base_url("assets/files/logo/wisata.png") ?>" class="img-fluid responsive" width="40px" height="40px" alt=""> </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>