<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$penduduk = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1')->result_array()[0]['jumlah'];
$keluarga = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_keluarga')->result_array()[0]['jumlah'];
$rtm = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_rtm')->result_array()[0]['jumlah'];
$id = $this->db->query('SELECT COUNT(id) AS jumlah FROM log_surat')->result_array()[0]['jumlah'];
?>

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" style="padding-top:30px">
        <div class="section-title" data-aos="fade-up" data-aos-delay="300">
          <h2>Statistik <?=ucwords($this->setting->sebutan_desa)?></strong></h2>
        </div>
        <div class="row">
          <div class="col-xl-12 d-flex align-items-stretch pt-4 pt-xl-0" data-aos="fade-down" data-aos-delay="300">
            <div class="content d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-3 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-users-social"></i>
                    <span data-toggle="counter-up"><?= number_format($penduduk,0,'', '.')?></span>
                    <p>Jumlah<strong> Seluruh Penduduk</strong> tercatat di <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?> </p>
                  </div>
                </div>

                <div class="col-md-3 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-autism"></i>
                    <span data-toggle="counter-up"><?= number_format($keluarga,0,'', '.')?></span>
                    <p>Jumlah <strong>Kepala Keluarga</strong> total tercatat di <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
                  </div>
                </div>

                <div class="col-md-3 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-group-students"></i>
                    <span data-toggle="counter-up"><?= number_format($rtm,0,'', '.')?></span>
                    <p>Jumlah <strong>Rumah Tangga </strong> bahagia tercatat di <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
                  </div>
                </div>

                <div class="col-md-3 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-paper"></i>
                    <span data-toggle="counter-up"><?= number_format($id,0,'', '.')?></span>
                    <p>Jumlah <strong>Surat </strong> terlayani di <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Counts Section -->
