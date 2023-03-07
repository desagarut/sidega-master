<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($folder_themes . '/commons/head') ?>

<body>
  <?php $this->load->view($folder_themes . '/commons/spinner.php') ?>
  <?php $this->load->view($folder_themes . '/commons/nav.php') ?>
  <div class="container-xxl py-5">
    <div class="row g-4 justify-content-center">
      <div class="row">
        <?php $this->load->view($folder_themes . '/partials/wisata/index_layanan.php') ?>
      </div>
    </div>
  </div>
  <?php //$this->load->view($folder_themes . '/partials/umkm_list') ?>
  </div>
  <?php $this->load->view($folder_themes . '/commons/footer') ?>
</body>

</html>