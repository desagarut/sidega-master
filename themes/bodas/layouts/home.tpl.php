<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view($folder_themes . '/partials/carousel') ?>
<?php $this->load->view($folder_themes . '/partials/profil') ?>
<?php $this->load->view($folder_themes . '/partials/team') ?>
<?php $this->load->view($folder_themes . '/partials/berita') ?>
<?php if ($pembangunan) $this->load->view($folder_themes . '/partials/pembangunan/front') ?>
<?php $this->load->view($folder_themes . '/partials/umkm') ?>
<?php $this->load->view($folder_themes . '/partials/service') ?>
<?php if ($w_gal)  $this->load->view($folder_themes . '/partials/gallery_front') ?>
<?php if ($gallery) $this->load->view($folder_themes . '/partials/gallery_youtube_front') ?>
<?php if ($cctv) $this->load->view($folder_themes . '/partials/cctv_front') ?>
