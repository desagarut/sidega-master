<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$penduduk = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1')->result_array()[0]['jumlah'];
$keluarga = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_keluarga')->result_array()[0]['jumlah'];
$rtm = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_rtm')->result_array()[0]['jumlah'];
$id = $this->db->query('SELECT COUNT(id) AS jumlah FROM log_surat')->result_array()[0]['jumlah'];
?>

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="fluid"
     data-ad-layout-key="-64+db+5u-2i-99"
     data-ad-client="ca-pub-1823410826720847"
     data-ad-slot="4363411872"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>


        <div class="row">
		<div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150">
		<?php $this->load->view($folder_themes .'/widgets/peta_wil') ?>
          </div>

          <div class="col-xl-7 d-flex align-items-stretch pt-4 pt-xl-0" data-aos="fade-left" data-aos-delay="300">
            <div class="content d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-simple-smile"></i>
                    <span data-toggle="counter-up"><?= number_format($penduduk,0,'', '.')?></span>
                    <p>Jumlah<strong> Seluruh Penduduk</strong> tercatat di <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?> </p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-users"></i>
                    <span data-toggle="counter-up"><?= number_format($keluarga,0,'', '.')?></span>
                    <p>Jumlah <strong>Kepala Keluarga</strong> total tercatat di <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="icofont-home"></i>
                    <span data-toggle="counter-up"><?= number_format($rtm,0,'', '.')?></span>
                    <p>Jumlah <strong>Rumah Tangga </strong> bahagia tercatat di <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
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
