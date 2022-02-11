<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- MOHON TIDAK MEMODIFIKASI TAUTAN PENGEMBANG DI BAWAH INI SEBAGAI BENTUK PENGHARGAAN HAK CIPTA. -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-4 text-lg-left text-center">
          <div class="copyright">
            &copy; <?= date('Y') ?> - <a href="#" target="_blank"><strong>tema Desa Garut <?= THEME_VERSION ?></strong></a>
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/vesperr-free-bootstrap-template/ -->
            Designed by <a href="https://desagarut.net/"> Bambang Andri H</a>
          </div>
          
        </div>
        <div class="col-lg-4 text-lg-left text-center">
            <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                <?php foreach($sosmed as $data) : ?>
                    <?php if(!empty($data['link'])) : ?>
                        <?php $brand = strtolower(str_replace(' ', '-', $data['nama'])) ?>
                        <a class="social-media__item social-media--<?= $brand ?>">
                            <a href="<?= $data['link'] ?>" class="social-media__link"><i class="fa fa-<?= $brand == 'youtube' ? 'youtube-play' : $brand ?>"></i></a>
                        </a>
                    <?php endif ?>
                <?php endforeach ?>
                <a href="https://validator.w3.org/feed/check.cgi?url=https%3A//desagarut.net/feed"><img src="https://validator.w3.org/feed/images/valid-rss-rogers.png" alt="[Valid RSS]" title="Validate my RSS feed" /></a>
            </nav>
			</div>
        <div class="col-lg-4">
          <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
            <a href="<?= site_url();?>" class="scrollto">Home</a>
            <a href="<?= site_url();?>arsip" class="scrollto">Berita</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
          </nav>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


<?php if($transparansi) $this->load->view($folder_themes .'/partials/apbdesa', $transparansi) ?>

