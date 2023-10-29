<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$towa = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_toko_warga WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$tawa = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_tawa WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$tukang = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_tukang WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$wisata = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_wisata WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
?>

<div class="content-wrapper">
    <section class='content-header'>
        <h1>Statistik Bidang Kesehatan</h1>
        <ol class='breadcrumb'>
            <li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Bidang Kesehatan</li>
        </ol>
    </section>

    <section class='content' id="maincontent">
        <div class='row'>
            <div id="kesehatan" class="col-sm-2">
                <?php $this->load->view('kesehatan/menu') ?>
            </div>
            <div id="kesehatan" class="col-sm-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h7>Data Balita</h7>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-3 col-xs-3">
                                        <a href="<?= site_url('toko_warga') ?>" class="small-box-footer" title="Data Balita">
                                            <div class="small-box bg-red">
                                                <div class="inner">

                                                    <h4>
                                                        Data Balita : <?= number_format($towa, 0, '', '.') ?>
                                                    </h4>

                                                    <p></p>
                                                </div>
                                                <div class="icon"> <img src="<?= base_url("assets/files/logo/toko.png") ?>" class="img-fluid responsive" width="40px" height="40px" alt=""> </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">
                        <div class="box-header">
                                <h7>Data Stunting</h7>
                            </div>
                            <div class="box-body">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>