<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- ======= More Services Section ======= -->
<section id="more-services" class="more-services">
    <div class="container">
    
        <div class="section-title" data-aos="fade-up">
            <h2>Berita</h2>
            <p>Info Seputar <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
        </div>
                     
        <div class="row">
            <?php if($artikel) : ?>
            <?php foreach($artikel as $article) : ?>
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
                <div class="col-md-6 d-flex align-items-stretch mt-4">
                <?php $data['article'] = $article ?>                
                <?php $url = site_url('artikel/'.buat_slug($article)) ?>
                <?php $abstract = potong_teks(strip_tags($article['isi']), 200) ?>
                <?php $image = ($article['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'kecil_'.$article['gambar'])) ? 
                    AmbilFotoArtikel($article['gambar'],'kecil') :
                    base_url($this->theme_folder.'/'.$this->theme .'/assets/img/placeholder.png');
                ?>
                    
                    <div class="card" alt="<?= $article['judul'] ?>" style='background-image: url("<?= $image ?>");' data-aos="fade-up" data-aos-delay="100">
                        
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?= $url ?>"><?= $article['judul'] ?></a></h5>
                            <p class="card-text"> <?= $abstract ?> </br>
                            <?php if($article['kategori']) : ?>
                                <a href="<?= site_url('first/kategori/'.$article['kat_slug']) ?>" class="content__link"><?= $article['kategori'] ?></a>
                            <?php endif ?>
                            <?= tgl_indo($article['tgl_upload']) ?> - <?= $article['owner'] ?>
                            </p>
                            <div class="read-more">
                                <a href="<?= $url ?>"><?= $article['judul'] ?><i class="icofont-arrow-right"></i> Lanjut Baca</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            <?php endforeach ?>
            <?php endif ?>
        </div>
            
    </div>
</section>