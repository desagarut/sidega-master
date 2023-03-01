<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($folder_themes . '/commons/head') ?>

<body>
  <?php $this->load->view($folder_themes . '/commons/spinner.php') ?>
  <?php $this->load->view($folder_themes . '/commons/nav.php') ?>

  <div class="container-xxl py-5">
    <div class="row">
      <div class="col-md-8 entries">
        <div class="text-start wow fadeInUp" data-wow-delay="0.1s">
          <h1 class="mb-5">video</h1>
        </div>

        <?php $this->load->view($folder_themes . '/partials/sub_gallery_youtube') ?>
      </div>
      <div class="col-md-4">
        <div class="sidebar blog-grid-page">
          <?php $this->load->view($folder_themes . '/partials/sidebar_gallery_youtube.php') ?>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view($folder_themes . '/commons/footer') ?>
</body>

</html>