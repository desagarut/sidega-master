<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- MOHON TIDAK MEMODIFIKASI TAUTAN PENGEMBANG DI BAWAH INI SEBAGAI BENTUK PENGHARGAAN HAK CIPTA. -->
<?php if($transparansi) $this->load->view($folder_themes .'/partials/apbdesa', $transparansi) ?>
<!-- ======= Footer ======= -->

<footer id="footer">
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
  </div>
  <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0 navbar-dark bg-primary navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom" style="opacity:0.7">
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
      <li class="nav-item"> <small><a href="<?= site_url('first/toko_show') ?>" class="nav-link" title="Map"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
        <path d="M15.7497 6.75V7.5C15.7497 9.57107 14.0707 11.25 11.9997 11.25C9.9286 11.25 8.24966 9.57107 8.24966 7.5V6.75M5.39221 20.25H18.6071C19.4892 20.25 20.1808 19.4926 20.101 18.6142L18.8737 5.1142C18.8034 4.34158 18.1556 3.75 17.3798 3.75H6.61948C5.84368 3.75 5.19588 4.34158 5.12564 5.1142L3.89837 18.6142C3.81852 19.4926 4.51016 20.25 5.39221 20.25Z" stroke="#3A52EE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><br/>
        UMKM</a></small> </li>
      <li class="nav-item"><small> <a href="<?= site_url('mandiri_web') ?>" class="nav-link" title="Login"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
        <path d="m10.998 16 5-4-5-4v3h-9v2h9z"></path>
        <path d="M12.999 2.999a8.938 8.938 0 0 0-6.364 2.637L8.049 7.05c1.322-1.322 3.08-2.051 4.95-2.051s3.628.729 4.95 2.051S20 10.13 20 12s-.729 3.628-2.051 4.95-3.08 2.051-4.95 2.051-3.628-.729-4.95-2.051l-1.414 1.414c1.699 1.7 3.959 2.637 6.364 2.637s4.665-.937 6.364-2.637C21.063 16.665 22 14.405 22 12s-.937-4.665-2.637-6.364a8.938 8.938 0 0 0-6.364-2.637z"></path>
        </svg><br/>
        Login</a> </small></li>
    </ul>
  </nav>
</footer>
