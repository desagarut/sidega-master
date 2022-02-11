<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if($slider_gambar['gambar']) : ?>
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
			
            <div class="col-lg-12"> 
			     
                <div class="col-lg-6">
					<?php foreach($slider_gambar['gambar'] as $data) : ?> 
                    <h1 data-aos="fade-up"><?php if($data['judul']) : ?><?= $data['judul'] ?><?php endif ?></h1>
                    <h2 data-aos="fade-up" data-aos-delay="400"><?= $data['judul'] ?></h2>
                    
                    <div data-aos="fade-up" data-aos-delay="800">
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    </div> 
					<?php endforeach ?>
				</div>	
                <div class="col-lg-6">
                    <?php $img = $slider_gambar['lokasi'] . 'sedang_' . $data['gambar']; ?>
                    <?php if(is_file($img)) : ?>
                            <img src="<?= base_url($img) ?>" alt="<?= $data['judul'] ?>" class="img-fluid animated">
                    <?php endif ?>
                
                </div>
			
            </div>
            
        </div> 
    </div>

</section><!-- End Hero -->
<?php endif ?>

