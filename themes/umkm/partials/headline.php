<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $abstract = potong_teks($headline['isi'], 150); ?>
<?php $url = site_url('artikel/'.buat_slug($headline)); ?>
<?php $image = ($headline['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'kecil_'.$headline['gambar'])) ? 
	AmbilFotoArtikel($headline['gambar'],'kecil') :
	base_url($this->theme_folder.'/'.$this->theme .'/assets/images/placeholder.png') ?>

<section class="trending-product section" style="margin-top: 12px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Berita
            <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
          </h2>
        </div>
      </div>
    </div>
    
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12" style="padding-top:32px">
            <div class="single-banner" style="height: 350px; background-image:url('<?= $image ?>')" alt="<?= $headline['judul'] ?>">
                <div class="content">
                    <h2 style="padding-top:100px;color:#FFF">~ <?= $headline['judul'] ?> ~</h2>
                    <p style="color:#FFF"><i><?= $abstract ?></i></p>
                    <a class="button btn btn-warning" href="<?= $url ?>">
                <i class="lni lni-pen"></i> Baca</a> 
                </div>
            </div>
        </div>
    
    
            <?php if($artikel) : ?>
            <?php foreach($artikel as $article) : ?>
            <?php $data['article'] = $article ?>
            <?php $url = site_url('artikel/'.buat_slug($article)) ?>
            <?php $abstract = potong_teks(strip_tags($article['isi']), 200) ?>
            <?php $image = ($article['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'sedang_'.$article['gambar'])) ? 
                        AmbilFotoArtikel($article['gambar'],'sedang') :
                        base_url($this->theme_folder.'/'.$this->theme .'/assets/img/placeholder.png');
                    ?>
      <div class="col-lg-3 col-md-6 col-12"> 
        <!-- Start Single Product -->
        <div class="single-product">
          <div class="product-image"> <img src="<?= $image ?>" alt="#">
          </div>
          <div class="product-info"> 
            <h4 class="title"> <a href="<?= $url ?>" alt="<?= $article['judul'] ?>">
              <?= $article['judul'] ?>
              </a> </h4>
              <time datetime="2020-01-01">
                <?= tgl_indo($article['tgl_upload']) ?>
              </time> | <span><?= $article['owner'] ?></span><br/>
                <a class="button btn btn-warning" href="<?= $url ?>">
                <i class="lni lni-pen"></i> Baca</a> 
          </div>
        </div>
        <!-- End Single Product --> 
      </div>
            <?php endforeach ?>
            <?php endif ?>
            <?php //$this->load->view($folder_themes .'/commons/paging') ?>
    </div>
  </div>
</section>
<!-- End Trending Product Area --> 

<!-- ======= About Us Section ======= -->
<!--
<section id="about-us" class="about-us blog">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Berita </strong></h2>
      <p>Kabar <?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']); ?></p>
    </div>
    <div class="row content">
      <div class="col-lg-6" data-aos="fade-right" align="center" style="padding-bottom:20px">           
        <img src="<?= $image ?>" class="img-fluid" alt="<?= $headline['judul'] ?>">
        <p><br/></p>
        <h3 class="text-justify"><a href="<?= $url ?>">
          <?= $headline['judul'] ?>
          </a></h3>
        <p class="text-justify">
          <?= $abstract ?>
          ... </p>
        <div class="text-right"><a href="<?= $url ?>" class="btn-get-started"><button class="btn btn-success">Lanjut baca</button></a></div>
      </div>
      <div class="col-lg-6 pt-6 pt-lg-0" data-aos="fade-left">
        <div class="sidebar" data-aos="fade-left"> 
          
          <h3 class="sidebar-title">6 Artikel Terbaru</h3>
          <div class="sidebar-item recent-posts">
            <?php if($artikel) : ?>
            <?php foreach($artikel as $article) : ?>
            <?php $data['article'] = $article ?>
            <?php $url = site_url('artikel/'.buat_slug($article)) ?>
            <?php $abstract = potong_teks(strip_tags($article['isi']), 200) ?>
            <?php $image = ($article['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'kecil_'.$article['gambar'])) ? 
                        AmbilFotoArtikel($article['gambar'],'kecil') :
                        base_url($this->theme_folder.'/'.$this->theme .'/assets/img/placeholder.png');
                    ?>
            <div class="post-item clearfix"  style="max-height:400px"> <img src="<?= $image ?>" alt="<?= $article['judul'] ?>">
              <h4><a href="<?= $url ?>">
                <?= $article['judul'] ?>
                </a></h4>
              <time datetime="2020-01-01">
                <?= tgl_indo($article['tgl_upload']) ?>
              </time>
            </div>
            <?php endforeach ?>
            <?php endif ?>
            <?php //$this->load->view($folder_themes .'/commons/paging') ?>
            <div class="text-right"><a href="<?= site_url('arsip') ?>" class="btn-get-started"><button class="btn btn-primary">Artikel Lainnya</button></a></div>
          </div>
          
 <!--         <h3 class="sidebar-title">Kategori</h3>
          <div class="sidebar-item categories">
            <?php foreach($menu_kiri as $data): ?>
            <li><a href="<?= site_url("artikel/kategori/$data[slug]"); ?>">
              <?= $data['kategori']; ?>
              <span></span></a>
              <?php if(count($data['submenu']) > 0): ?>
              <ul class="submenu">
                <?php foreach($data['submenu'] as $submenu): ?>
                <li><a href="<?= site_url("artikel/kategori/$submenu[slug]"); ?>">
                  <?= $submenu['kategori']?>
                  </a></li>
                <?php endforeach; ?>
              </ul>
              <?php endif; ?>
            </li>
            <?php endforeach; ?>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>-->
<!-- End About Us Section --> 

<!-- ======= Services Section ======= -->