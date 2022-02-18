
<!-- ======= Our Team Section ======= 

<section id="team" class="team section-bg">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Aparatur <?= ucfirst($this->setting->sebutan_desa)?></h2>
      <p><i>kami dengan ikhlas mengabdi</i></p>
    </div>
    <div class="row">
      <?php foreach($aparatur_desa['daftar_perangkat'] as $data) : ?>
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

<link type='text/css' href="<?= base_url()?>assets/front/css/slider.css" rel='Stylesheet' />
<script src="<?= base_url()?>assets/front/js/jquery.cycle2.caption2.min.js"></script>
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
<!-- widget Aparatur Desa -->
<section>
    <div class="container">
    <div class="row" style="padding-top:30px">
        <div class="col-md-4" data-aos="fade-right" data-aos-delay="300">
            <div class="box box-primary box-solid">
            
                <div class="section-title" style="padding-top:20px">
                    <h2> Aparatur <?= ucwords($this->setting->sebutan_desa)?></h2></br>
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
            
                    <?php if ($this->web_widget_model->get_setting('aparatur_desa', 'overlay') == true): ?>
                        <div class="cycle-caption"></div>
                        <div class="cycle-overlay"></div>
                    <?php else: ?>
                        <span class="cycle-pager"></span>  <!-- Untuk membuat tanda bulat atau link pada slider -->
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
        <div class="col-md-8" data-aos="fade-right" data-aos-delay="300">
			<?php $this->load->view($folder_themes .'/partials/visimisi') ?>
        </div>
    </div>
    </div>
</section>