<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!--
<section id="team" class="team section-bg">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Aparatur <?= ucfirst($this->setting->sebutan_desa) ?></h2>
      <p><i>kami dengan ikhlas mengabdi</i></p>
    </div>
    <div class="row">
      <?php foreach ($aparatur_desa['daftar_perangkat'] as $data) : ?>
      <div class="col-lg-3 col-md-6 d-flex align-items-stretch pull-center owl-carousel">
        <div class="member" data-aos="fade-up" style="width:250px">
          <div class="member-img"> <img src="<?= $data['foto'] ?>" alt="<?= $data['nama'] ?>" width="250px">
            <div class="social"> <a href=""><i class="icofont-twitter"></i></a> <a href=""><i class="icofont-facebook"></i></a> <a href=""><i class="icofont-instagram"></i></a> <a href=""><i class="icofont-linkedin"></i></a> </div>
          </div>
          <div class="member-info">
            <h4>
              <?= $data['nama'] ?>
            </h4>
            <span>
            <?= $data['jabatan'] ?>
            </span> </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- End Our Team Section -->
<!--
<link type='text/css' href="<?= base_url() ?>assets/front/css/slider.css" rel='Stylesheet' />
<script src="<?= base_url() ?>assets/front/js/jquery.cycle2.caption2.min.js"></script>
<style type="text/css">
#aparatur_desa .cycle-pager span
{
	height: 10px;
	width: 10px;
}
.cycle-slideshow
{
	max-height: none;
	margin-bottom: 0px;
	border: 0px;
}
.cycle-next, .cycle-prev
{
	mix-blend-mode: difference;
}
</style>

<section>
    <div class="container">
    <div class="row" style="padding-top:30px">
        <div class="col-md-4" data-aos="fade-right" data-aos-delay="300">
            <div class="box box-primary box-solid">
            
                <div class="section-title" style="padding-top:20px">
                    <h2> Aparatur <?= ucwords($this->setting->sebutan_desa) ?></h2></br>
                </div>
            
                <div class="box-body">
                    <div id="aparatur_desa" class="cycle-slideshow"
                    data-cycle-pause-on-hover=true
                    data-cycle-fx=scrollHorz
                    data-cycle-timeout=2000
                    data-cycle-caption-plugin=caption2
                    data-cycle-overlay-fx-out="slideUp"
                    data-cycle-overlay-fx-in="slideDown"
                    data-cycle-auto-height=<?= $aparatur_desa['foto_pertama'] ?>
                    >
            
                    <?php if ($this->web_widget_model->get_setting('aparatur_desa', 'overlay') == true) : ?>
                        <div class="cycle-caption"></div>
                        <div class="cycle-overlay"></div>
                    <?php else : ?>
                        <span class="cycle-pager"></span>  
                    <?php endif; ?>
            
                    <?php foreach ($aparatur_desa['daftar_perangkat'] as $data) : ?>
                            <img src="<?= $data['foto'] ?>"
                            data-cycle-title="
                                <span class='cycle-overlay-title'><?= $data['nama'] ?></span>"
                            data-cycle-desc="
                                <?= $data['jabatan'] ?><br />
                                <?= $this->setting->sebutan_nip_desa ?> : <?= $data['pamong_niap'] ?>" align="centre">
                    <?php endforeach; ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
                    -->

<!-- Team Start -->
<div id="team" class="team section-bg">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2 style="padding-top:20px">Aparatur <?= ucfirst($this->setting->sebutan_desa) ?></h2>
    </div>
    <div class="brands-logo-wrapper">
      <div class="brands-logo-carousel d-flex align-items-center justify-content-between">

        <?php foreach ($aparatur_desa['daftar_perangkat'] as $data) : ?>
          <div class="row">
            <div class="col-md-12">
              <div class="brand-logo text-center" style="padding-top:10px; height:270px;">
                <img src="<?= $data['foto'] ?>" alt="<?= $data['nama'] ?>" style="width:auto; max-height:250px">
              </div>
              <div class="text-center p-0">
                <h6 class="mb-0"><?= $data['nama'] ?></h6>
                <small><?= strtoupper($data['jabatan']) ?></small>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Team End -->