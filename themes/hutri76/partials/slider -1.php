<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
  
  <!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
	<!-- Slide 2 -->	
        <?php if($slider_gambar['gambar']) : ?>

        <div class="carousel-inner" role="listbox">
 		<?php foreach($slider_gambar['gambar'] as $data) : ?>
		<?php $img = $slider_gambar['lokasi'] . 'sedang_' . $data['gambar']; ?>
		<?php if(is_file($img)) : ?>
        <div class="carousel-item active" style="background-image: url(<?= base_url($img) ?>);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2><?= $data['judul'] ?></h2>
              <p><?= $data['judul'] ?></p>
              <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
            </div>
          </div>
        </div> 
		<?php endif;?>
        <?php endforeach ?>	
        </div>
		<?php endif ?>
      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
    
    </div>
</section>

  
 