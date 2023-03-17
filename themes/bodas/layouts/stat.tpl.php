<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($folder_themes . '/commons/head') ?>

<body>
  <?php //$this->load->view($folder_themes . '/commons/spinner.php')
  ?>
  <?php $this->load->view($folder_themes . '/commons/nav.php') ?>

  <!-- Header Start -->
  <div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-10 text-center">
          <h1 class="display-3 text-white animated slideInDown">Statistik <?= $heading ?></h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
              <li class="breadcrumb-item"><a class="text-white" href="#">Statistik</a></li>
              <li class="breadcrumb-item text-white active" aria-current="page"><?= $heading ?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- Header End -->

  <div class="container-xxl">
    <div class="container">

      <div class="row g-5 justify-content-center">
        <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.3s">

        <?php if ($tipe == 2): ?>
          <?php $this->load->view("$folder_themes/partials/statistik_sos"); ?>
        <?php elseif ($tipe == 3): ?>
          <?php $this->load->view("$folder_themes/partials/statistik/wilayah"); ?>
        <?php elseif ($tipe == 4): ?>
          <?php $this->load->view("$folder_themes/partials/statistik/dpt"); ?>
        <?php else: ?>
          <?php $this->load->view("$folder_themes/partials/statistik/statistik"); ?>
        <?php endif; ?>



          <?php /*
          switch ($tipe) {
            case '0':
              $page = '/partials/statistics/statistik';
              break;
            case '2':
              $page = '/partials/statistics/wilayah';
              break;
            case '3':
              $page = '/partials/statistics/regions';
              break;
            case '4':
              $page = '/partials/statistics/dpt';
            default:
              $page = '/commons/404';
              break;
          }
         */ ?>
          <?php //$this->load->view($folder_themes . $page) ?>
        </div>
        <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
          <div class="row">
            <?php $this->load->view($folder_themes . '/widgets/sidebar_statistik.php') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <?php $this->load->view($folder_themes . '/commons/footer') ?>

</body>

</html>