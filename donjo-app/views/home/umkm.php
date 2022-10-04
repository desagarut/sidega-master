<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$towa = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_toko_warga WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$tawa = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_tawa WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$tukang = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_tukang WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$wisata = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_wisata WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
?>

<div class='col-md-4'>
    <div class="box box-warning box-solid">
        <div class="box-header bg-aqua with-border">
            <h3 class="box-title">Potensi UMKM</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-6 col-sm-3 col-xs-6">
                    <a href="<?= site_url('toko_warga') ?>" class="small-box-footer" title="Lihat Toko Warga">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                
                                    <h3>
                                    <?= number_format($towa, 0, '', '.') ?>
                                    </h3>
                                
                                <p>Toko Warga</p>
                            </div>
                            <div class="icon"> <img src="<?= base_url("assets/files/logo/toko.png") ?>" class="img-fluid responsive" width="70px" height="70px" alt=""> </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-3 col-xs-6">
                    <a href="<?= site_url('tawa') ?>" class="small-box-footer" title="Lihat Transportasi Warga">
                        <div class="small-box bg-success">
                            <div class="inner">
                                
                                    <h3>
                                    <?= number_format($tawa, 0, '', '.') ?>
                                    </h3>
                                
                                <p>Transportasi</p>
                            </div>
                            <div class="icon"> <img src="<?= base_url("assets/files/logo/transport.png") ?>" class="img-fluid responsive" width="70px" height="70px" alt=""> </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-3 col-xs-6">
                    <a href="<?= site_url('tukang') ?>" class="small-box-footer" title="Lihat Pertukangan Warga">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                
                                    <h3>
                                    <?= number_format($tukang, 0, '', '.') ?>
                                    </h3>
                                
                                <p>Pertukangan</p>
                            </div>
                            <div class="icon"> <img src="<?= base_url("assets/files/logo/tukang.png") ?>" class="img-fluid responsive" width="70px" height="70px" alt=""> </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-3 col-xs-6">
                    <a href="<?= site_url('wisata') ?>" class="small-box-footer" title="Lihat Wisata Desa">
                        <div class="small-box bg-info">
                            <div class="inner">
                                
                                    <h3>
                                    <?= number_format($wisata, 0, '', '.') ?>
                                    </h3>
                                
                                <p>Wisata Desa</p>
                            </div>
                            <div class="icon"> <img src="<?= base_url("assets/files/logo/wisata.png") ?>" class="img-fluid responsive" width="70px" height="70px" alt=""> </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="box-footer text-center hidden">
                <p>
                    <strong style="color:blueviolet">"Tinggal Di Desa, Rezeki Kota, Bisnis Mendunia"<br /></strong>
                    <a class="pull-right">~Ridwan Kamil~</a>
                </p>
            </div>
        </div>
    </div>
</div>