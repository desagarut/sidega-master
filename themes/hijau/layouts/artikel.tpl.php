<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view($folder_themes . '/commons/meta') ?>
<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body>
<?php if($single_artikel['id']) : ?>
<?php $this->load->view($folder_themes .'/commons/header') ?>
<?php // $this->load->view($folder_themes .'/partials/newsticker') ?>
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <h5>Artikel</h5>
      <ol>
        <li><a href="<?= site_url("first"); ?>">Home</a></li>
        <li>artikel</li>
      </ol>
    </div>
  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
  <div class="container">
    <div class="row">
        <?php $this->load->view($folder_themes .'/partials/article.php') ?>
        <?php $this->load->view($folder_themes .'/partials/sidebar.php') ?>
    </div>
  </div>
</section>
<?php $this->load->view($folder_themes .'/commons/footer') ?>
<?php $this->load->view($folder_themes . '/commons/for_js') ?>
<?php else : ?>
<?php $this->load->view($folder_themes . '/commons/404') ?>
<?php endif ?>
</body>
</html>