    <!-- ======= Portfolio Section ======= -->
 <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">

          <div class="col-lg-6 entries">
            <?php if($artikel) : ?>
            <?php foreach($artikel as $article) : ?>
				
				<?php $data['article'] = $article ?>                
                <?php $url = site_url('artikel/'.buat_slug($article)) ?>
                <?php $abstract = potong_teks(strip_tags($article['isi']), 200) ?>
                <?php $image = ($article['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'kecil_'.$article['gambar'])) ? 
                    AmbilFotoArtikel($article['gambar'],'kecil') :
                    base_url($this->theme_folder.'/'.$this->theme .'/assets/img/placeholder.png');
                ?>
                <article class="entry" data-aos="fade-up">
        
                  <div class="entry-img" align="center">
                    <img src="<?= $image ?>" alt="<?= $article['judul'] ?>" class="img-fluid" style="padding-top:20px" >
                  </div>
        
                  <h2 class="entry-title">
                    <a href="<?= $url ?>"><?= $article['judul'] ?></a>
                  </h2>
        
                  <div class="entry-meta">
                    <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i><?= $article['owner'] ?></li>
                      <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> 
                      	<a href="#"><time datetime="2020-01-01"><?= tgl_indo($article['tgl_upload']) ?></time></a></li>
                      <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.html"><?php if($article['kategori']) : ?>
                            <a href="<?= site_url('first/kategori/'.$article['kat_slug']) ?>" class="content__link"><?= $article['kategori'] ?></a>
                        <?php endif ?></a></li>
                    </ul>
                  </div>
        
                  <div class="entry-content">
                    <p><?= $abstract ?></p>
                    <div class="read-more">
                      <a href="<?= $url ?>">Baca</a>
                    </div>
                  </div>
        
                </article><!-- End blog entry -->
                <?php endforeach ?>
                <?php endif ?>

<?php $this->load->view($folder_themes .'/commons/paging') ?>


          <div class="col-lg-6">

            <div class="sidebar" data-aos="fade-left">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="icofont-search"></i></button>
                </form>

              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                  <li><a href="#">General <span>(25)</span></a></li>
                  <li><a href="#">Lifestyle <span>(12)</span></a></li>
                  <li><a href="#">Travel <span>(5)</span></a></li>
                  <li><a href="#">Design <span>(22)</span></a></li>
                  <li><a href="#">Creative <span>(8)</span></a></li>
                  <li><a href="#">Educaion <span>(14)</span></a></li>
                </ul>

              </div><!-- End sidebar categories-->

              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">
                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-1.jpg" alt="">
                  <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-2.jpg" alt="">
                  <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-3.jpg" alt="">
                  <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-4.jpg" alt="">
                  <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-5.jpg" alt="">
                  <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  <li><a href="#">App</a></li>
                  <li><a href="#">IT</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Mac</a></li>
                  <li><a href="#">Design</a></li>
                  <li><a href="#">Office</a></li>
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Studio</a></li>
                  <li><a href="#">Smart</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>

              </div><!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->
