<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view($folder_themes . '/commons/meta') ?>
  <?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>

<body>

  <?php $this->load->view($folder_themes . '/commons/header') ?>
  <section id="portfolio" class="portfolio blog">
    <div class="container">
      <div class="row">
        <div class="col-md-8 entries">
          <?php $this->load->view($folder_themes . '/partials/gallery_youtube') ?>
        </div>
        <div class="col-md-4">
          <div class="sidebar blog-grid-page">
            <?php $this->load->view($folder_themes . '/partials/sidebar_gallery_youtube.php') ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php $this->load->view($folder_themes . '/commons/footer') ?>
  <?php $this->load->view($folder_themes . '/commons/for_js') ?>

</body>

</html>