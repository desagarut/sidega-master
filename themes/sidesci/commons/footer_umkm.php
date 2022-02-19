<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- MOHON TIDAK MEMODIFIKASI TAUTAN PENGEMBANG DI BAWAH INI SEBAGAI BENTUK PENGHARGAAN HAK CIPTA. -->

<?php if($transparansi) $this->load->view($folder_themes .'/partials/apbdesa', $transparansi) ?>

<!-- ======= Footer ======= -->

<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 footer-contact">
          <h3>
            <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
          </h3>
          <p>
            <?= $desa['alamat_kantor']; ?>
            <br>
            Kecamatan
            <?= $desa['nama_kecamatan']; ?>
            <br>
            Kabupaten
            <?= $desa['nama_kabupaten']; ?>
            , Propinsi
            <?= $desa['nama_propinsi']; ?>
            <br>
            Indonesia <br>
            <br>
            <strong>Telepon:</strong>
            <?= $desa['telepon']; ?>
            <br>
            <strong>Email:</strong>
            <?= $desa['email_deskel']; ?>
            <br>
          </p>
        </div>
        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Tautan</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('first') ?>">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('arsip') ?>">Tentang Kami</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('first/status_idm') ?>">Status IDM</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('first/statistik/0') ?>">Statistik</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= site_url('peta') ?>">Peta</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Pemerintah Daerah</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="https://jabarprov.go.id/">Pemprov
              <?= $desa['nama_propinsi']; ?>
              </a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="https://garutkab.go.id">Pemkab Garut</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">DPMD
              <?= $desa['nama_kabupaten']; ?>
              </a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Disdukcapil
              <?= $desa['nama_kabupaten']; ?>
              </a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= $desa['web_kecamatan']; ?>">Kecamatan
              <?= $desa['nama_kecamatan']; ?>
              </a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Kementerian</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="https://kemendesa.go.id/">Kemendesa PDTDT RI</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="https://www.kemendagri.go.id/">Kemendag RI</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="https://www.kemenkeu.go.id/">Kemenkeu RI</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="https://kemensos.go.id/">Kemensos RI</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="https://www.kemkes.go.id/">Kemenkes RI</a></li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-6 footer-newsletter">
          <h4 align="center">Sosial Media</h4>
          <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <?php foreach($sosmed as $data) : ?>
            <?php if(!empty($data['link'])) : ?>
            <?php $brand = strtolower(str_replace(' ', '-', $data['nama'])) ?>
            <a href="<?= $data['link'] ?>" class="social-media__link"><i class="bx bxl-<?= $brand == 'youtube' ? 'youtube-play' : $brand ?>"></i></a>
            <?php endif ?>
            <?php endforeach ?>
          </div>
        </div>
        <br/>
      </div>
    </div>
  </div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div class="container d-md-flex py-4">
    <div class="mr-md-auto text-center text-md-left">
      <div><strong><a href="https://desagarut.net" target="_blank"><?= $this->setting->website_title ?>
        <?= AmbilVersi()?> | Tema <?= $this->setting->web_theme ?> <?= THEME_VERSION ?>
        </span></strong></a> | By <a href="https://desagarut.net/"> Komunitas Desa Garut</a></div>
      <div class="copyright"><?= ucfirst($this->setting->sebutan_kecamatan).' '.ucwords($desa['nama_kecamatan']) ?> &copy;
        <?= date('Y') ?> | Diberdayakan Oleh <?= $this->setting->pemberdaya ?>
      </div>
    </div>
    <br />
    <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0 navbar-dark bg-primary navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom" style="color:#007bff; opacity:0.7">
      <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item"><small> <a href="<?= site_url('first') ?>" class="nav-link" title="Home"> <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
          <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm9-8.586 6 6V15l.001 5H6v-9.585l6-6.001z"></path>
          <path d="M12 17c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2z"></path>
          </svg><br/>
          Home</a></small> </li>
        <li class="nav-item"><small> <a href="<?= site_url('arsip') ?>" class="nav-link" title="Berita"> <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
          <path d="M19.875 3H4.125C2.953 3 2 3.897 2 5v14c0 1.103.953 2 2.125 2h15.75C21.047 21 22 20.103 22 19V5c0-1.103-.953-2-2.125-2zm0 16H4.125c-.057 0-.096-.016-.113-.016-.007 0-.011.002-.012.008L3.988 5.046c.007-.01.052-.046.137-.046h15.75c.079.001.122.028.125.008l.012 13.946c-.007.01-.052.046-.137.046z"></path>
          <path d="M6 7h6v6H6zm7 8H6v2h12v-2h-4zm1-4h4v2h-4zm0-4h4v2h-4z"></path>
          </svg><br/>
          Berita</a></small> </li>
        <li class="nav-item"><small> <a href="<?= site_url('first/statistik/15') ?>" class="nav-link" title="Statistik"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
          <path d="M6 21H3a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1zm7 0h-3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v17a1 1 0 0 1-1 1zm7 0h-3a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1z"></path>
          </svg><br/>
          Statistik</a></small></li>
        <li class="nav-item"> <small><a href="<?= site_url('peta') ?>" class="nav-link" title="Map"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
          <path d="m9 6.882-7-3.5v13.236l7 3.5 6-3 7 3.5V7.382l-7-3.5-6 3zM15 15l-6 3V9l6-3v9z"></path>
          </svg><br/>
          Peta</a></small> </li>
        <li class="nav-item"><small> <a href="<?= site_url('mandiri_web') ?>" class="nav-link" title="Login"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
          <path d="m10.998 16 5-4-5-4v3h-9v2h9z"></path>
          <path d="M12.999 2.999a8.938 8.938 0 0 0-6.364 2.637L8.049 7.05c1.322-1.322 3.08-2.051 4.95-2.051s3.628.729 4.95 2.051S20 10.13 20 12s-.729 3.628-2.051 4.95-3.08 2.051-4.95 2.051-3.628-.729-4.95-2.051l-1.414 1.414c1.699 1.7 3.959 2.637 6.364 2.637s4.665-.937 6.364-2.637C21.063 16.665 22 14.405 22 12s-.937-4.665-2.637-6.364a8.938 8.938 0 0 0-6.364-2.637z"></path>
          </svg><br/>
          Login</a> </small></li>
      </ul>
    </nav>
  </div>
</footer>

<!-- End Footer --> 

<script>

$('.dropdown-toggle').dropdown()

</script> 

