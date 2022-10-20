<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$penduduk = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1')->result_array()[0]['jumlah'];
$keluarga = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_keluarga')->result_array()[0]['jumlah'];
$rtm = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_rtm')->result_array()[0]['jumlah'];
$id = $this->db->query('SELECT COUNT(id) AS jumlah FROM log_surat')->result_array()[0]['jumlah'];
$desa = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_wilayah WHERE rt = "-"')->result_array()[0]['jumlah'];

?>

    <!-- Facts Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-danger px-3">Demografi</h6>
                <h1 class="display-6 mb-4"> <?=ucwords($this->setting->sebutan_kabupaten)?> Garut</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-home fa-4x text-danger mb-4"></i>
                        <h5 class="mb-3">Bangunan Rumah Tangga</h5>
                        <h1 class="display-5 mb-0" data-toggle="counter-up"><?= number_format($rtm,0,'', '.')?></h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-users-cog fa-4x text-danger mb-4"></i>
                        <h5 class="mb-3">Kepala<br/>Keluarga</h5>
                        <h1 class="display-5 mb-0" data-toggle="counter-up"><?= number_format($keluarga,0,'', '.')?></h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-users fa-4x text-danger mb-4"></i>
                        <h5 class="mb-3">Jumlah<br/>Penduduk</h5>
                        <h1 class="display-5 mb-0" data-toggle="counter-up"><?= number_format($penduduk,0,'', '.')?></h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-map-marker fa-4x text-danger mb-4"></i>
                        <h5 class="mb-3">Jumlah<br/>Desa</h5>
                        <h1 class="display-5 mb-0" data-toggle="counter-up"><?= number_format($desa,0,'', '.')?></h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-th-list fa-4x text-danger mb-4"></i>
                        <h5 class="mb-3">Total<br/>RKP Desa</h5>
                        <h1 class="display-5 mb-0" data-toggle="counter-up"><?= number_format($rkpdesa,0,'', '.')?></h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-th-large fa-4x text-danger mb-4"></i>
                        <h5 class="mb-3">Total<br/>DU-RKP Desa</h5>
                        <h1 class="display-5 mb-0" data-toggle="counter-up"><?= number_format($durkpdesa,0,'', '.')?></h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-check-square fa-4x text-danger mb-4"></i>
                        <h5 class="mb-3">Prioritas<br/>Kecamatan</h5>
                        <h1 class="display-5 mb-0" data-toggle="counter-up"><?= number_format($prioritas_kecamatan,0,'', '.')?></h1>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="fact-item bg-light rounded text-center h-100 p-5">
                        <i class="fa fa-university fa-4x text-danger mb-4"></i>
                        <h5 class="mb-3">SKPD<br/>Penanggungjawab</h5>
                        <h1 class="display-5 mb-0" data-toggle="counter-up"><?= number_format($prioritas_kecamatan,0,'', '.')?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


