<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($folder_themes . '/commons/head') ?>

<body>
  <?php //$this->load->view($folder_themes . '/commons/spinner.php') ?>
  <?php $this->load->view($folder_themes . '/commons/nav.php') ?>

  <div class="container-xxl py-5">
    <div class="row">
      <div class="col-lg-8 col-md-8 custom-padding-right">
        <?php
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
        ?>
        <?php $this->load->view($folder_themes . $page) ?>
      </div>
      <div class="col-lg-4 col-md-4 custom-padding-left">
        <div class="row">
          <?php $this->load->view($folder_themes . '/widgets/sidebar_statistik.php') ?>
        </div>
      </div>
    </div>
  </div>
      <?php $this->load->view($folder_themes . '/commons/footer') ?>

</body>

</html>