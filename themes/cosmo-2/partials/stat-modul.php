<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
$penduduk = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1')->result_array()[0]['jumlah'];
$keluarga = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_keluarga')->result_array()[0]['jumlah'];
$rtm = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_rtm')->result_array()[0]['jumlah'];
$dusun = $this->db->query('SELECT COUNT(dusun) AS jumlah FROM tweb_wil_clusterdesa')->result_array()[0]['jumlah'];
$surat = $this->db->query('SELECT COUNT(id) AS jumlah FROM log_surat')->result_array()[0]['jumlah'];
?>

<script>
  jQuery(document).ready(function($) {
    var owl = $('.statistik-widget');
      owl.on('initialize.owl.carousel initialized.owl.carousel ' +
      'initialize.owl.carousel initialize.owl.carousel ' +
      'resize.owl.carousel resized.owl.carousel ' +
      'refresh.owl.carousel refreshed.owl.carousel ' +
      'update.owl.carousel updated.owl.carousel ' +
      'drag.owl.carousel dragged.owl.carousel ' +
      'translate.owl.carousel translated.owl.carousel ' +
      'to.owl.carousel changed.owl.carousel',
      function(e) {
        $('.' + e.type)
        .removeClass('secondary')
        .addClass('success');
        window.setTimeout(function() {
          $('.' + e.type)
            .removeClass('success')
            .addClass('secondary');
          }, 3000);
      });
      owl.owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        lazyLoad: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        margin: 20,
        video: true,
        responsive:{
          0:{ 
            items:1
          },
                    480:{
            items:2
          },
                    800:{
            items:3
          },
          980:{
            items:4
          },
                    1336:{
            items:4
          }
        }
      });
    });
</script>
<div class="top-widget">
    <div class="container">
            <div class="statistik-widget owl-carousel">
              <div class="item">
                <div class="stat-box panel-info" style="background-color:#60A7EE">
                    <div class="inner">
                        <div class="stat-value">
                            <?= number_format($penduduk,0,'', '.')?>
                        </div>
                        <p class="stat-title">Penduduk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="stat-box bg-success" style="background-color:#66F">
                    <div class="inner">
                        <div class="stat-value">
                            <?= number_format($keluarga,0,'', '.')?>
                            <?php foreach ($keluarga as $data): ?>
                                <?= number_format($data['jumlah'],0,'', '.')?>
                            <?php endforeach; ?>
                        </div>
                        <p class="stat-title">Keluarga</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                </div>
            </div>

          <div class="item">
                <div class="stat-box bg-read" style="background-color:magenta">
                    <div class="inner">
                        <div class="stat-value">
                            <?= number_format($rtm,0,'', '.')?>
                            <?php foreach ($rtm as $data): ?>
                                <?= number_format($data['jumlah'],0,'', '.')?>
                            <?php endforeach; ?>
                        </div>
                        <p class="stat-title">Rumah Tangga</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-home"></i>
                    </div>
                </div>
            </div>
         

            <div class="item">
                <div class="stat-box bg-teal" style="background-color:cyan">
                    <div class="inner">
                        <div class="stat-value">
                            <?= number_format($dusun,0,'', '.')?>
                            <?php foreach ($dusun as $data): ?>
                                <?= number_format($data['jumlah'],0,'', '.')?>
                            <?php endforeach; ?>
                        </div>
                        <p class="stat-title">Wilayah Dusun</p>
                    </div>
                    <div class="icon">
                        <i class="ti-map-alt"></i>
                    </div>
                </div>
            </div>  
            
            <div class="item">
                <div class="stat-box bg-teal" style="background-color:orange">
                    <div class="inner">
                        <div class="stat-value">
                            <?= number_format($surat,0,'', '.')?>
                            <?php foreach ($surat as $data): ?>
                                <?= number_format($data['jumlah'],0,'', '.')?>
                            <?php endforeach; ?>
                        </div>
                        <p class="stat-title">Surat Terlayani</p>
                    </div>
                    <div class="icon">
                        <i class="ti-map-alt"></i>
                    </div>
                </div>
            </div>     

        </div>
    </div>
</div>