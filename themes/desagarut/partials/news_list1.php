<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Berita</h2>
          <p>Info Seputar <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
		<h3 class="content__heading --mb-4 <?php empty($this->input->get('cari')) AND $headline AND $this->uri->segment(2) != 'kategori' AND print('--mt-5') ?>"><i class="fa fa-newspaper-o"></i> <?= $title ?></h3>
        
			<?php if($artikel) : ?>
				<?php foreach($artikel as $article) : ?>
                  <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
						<?php $data['article'] = $article ?>
                        <?php //$this->load->view($folder_themes .'/partials/article_list', $data) ?>
                        
                        <?php $url = site_url('artikel/'.buat_slug($article)) ?>
						<?php $abstract = potong_teks(strip_tags($article['isi']), 200) ?>
                        <?php $image = ($article['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'kecil_'.$article['gambar'])) ? 
                            AmbilFotoArtikel($article['gambar'],'kecil') :
                            base_url($this->theme_folder.'/'.$this->theme .'/assets/images/placeholder.png');
                        ?>

                                
                            <img src="<?= $image ?>" alt="<?= $article['judul'] ?>" class="img-fluid" height="250px" >
                              <div class="portfolio-info">
                                <h4><a href="<?= $url ?>"><?= $article['judul'] ?></a></h4>
                                <p><?= $abstract ?>...</p>
                                <p>
									<?php if($article['kategori']) : ?>
                                    <a href="<?= site_url('first/kategori/'.$article['kat_slug']) ?>" class="content__link"><?= $article['kategori'] ?></a>
                                    <?php endif ?>
                                </br>
                                <?= tgl_indo($article['tgl_upload']) ?> - <?= $article['owner'] ?>
                                </p>
                                <div class="portfolio-links">
                                  <a href="assets/img/portfolio/portfolio-1.jpg" data-gall="portfolioGallery" class="venobox" title="App 1"><i class="bx bx-plus"></i></a>
                                  <a href="<a href="<?= $url ?>"><?= $article['judul'] ?></a>" title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                              </div>
                                            </div>
                  </div>
				<?php endforeach ?>
			<?php endif ?>
          
        </div>
    </div>
    </section>

