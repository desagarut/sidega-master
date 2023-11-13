<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$towa = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_toko_warga WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$tawa = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_tawa WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$tukang = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_tukang WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
$wisata = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_wisata WHERE parrent = 0 AND enabled = 1')->result_array()[0]['jumlah'];
?>
<!--
    <div class="box box-success box-solid">
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
    </div>-->
<div class="box box-success box-solid">
    <div class="box-body">
        <div class="row text-center" style="padding-top:20px">
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('toko_warga') ?><?php endif; ?>" title="Toko Warga"><span class="badge bg-aqua"> <?= number_format($towa, 0, '', '.') ?></span><i class="fa fa-cart-plus text-yellow"></i> Toko Warga</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('tawa') ?><?php endif; ?>" title="Transportasi Warga"><span class="badge bg-aqua"><?= number_format($tawa, 0, '', '.') ?></span><i class="fa fa-car text-green"></i> Transportasi</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('tukang') ?><?php endif; ?>" title="Pertukangan"><span class="badge bg-aqua"><?= number_format($tukang, 0, '', '.') ?></span><i class="fa fa-industry text-yellow"></i> Pertukangan</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('wisata') ?><?php endif; ?>" title="Pariwisata"><span class="badge bg-aqua"><?= number_format($wisata, 0, '', '.') ?></span><i class="fa fa-road text-purple"></i> Pariwisata</a>
        </div>
    </div>
</div>