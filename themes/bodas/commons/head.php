<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<head>
    <meta charset="utf-8">
    <!--<title>eLEARNING - eLearning HTML Template</title>-->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <?php defined('THEME_VERSION') or define('THEME_VERSION', 'V4.8') ?>

    <?php $kampus_title = trim(ucwords($this->setting->website_title)); ?>

    <meta content="utf-8" http-equiv="encoding">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <meta name='google' content='notranslate' />
    <meta name='theme' content='Bodas' />
    <meta name='designer' content='Bambang Andri H' />
    <meta name='theme:designer' content='Bambang Andri H' />
    <meta name="theme:version" content="<?= THEME_VERSION ?>" />
    <meta name="theme-color" content="#00C" />
    <meta name="keywords" content="sidega, SIDEGA, SIDeGa, sistem informasi desa garut, web, blog, informasi, website, tema sidega-blue, desa garut, kelurahan garut, kecamatan garut, kabupaten garut, Jawa Barat, indonesia" />
    <meta property="og:site_name" content="<?= $website_title ?>" />
    <meta property="og:type" content="article" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <title>
        <?php if ($single_artikel["judul"] == "") : ?>
            <?= $this->setting->website_title . ' ' .  $desa_title; ?>
        <?php else : ?>
            <?= $single_artikel["judul"] . ' - ' . ucwords($this->setting->sebutan_desa) . ' ' . $desa['nama_desa']; ?>
        <?php endif; ?>
    </title>
    
    <?php $favicon = LOKASI_LOGO_DESA . 'favicon.ico'; ?>
    <link rel="shortcut icon" href="<?= base_url(is_file($favicon) ? $favicon : 'favicon.ico') ?>" />

    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url("$this->theme_folder/$this->theme/assets/lib/animate/animate.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("$this->theme_folder/$this->theme/assets/lib/lightbox/css/lightbox.min.css") ?>" rel="stylesheet">

    <link href="<?= base_url("$this->theme_folder/$this->theme/assets/lib/owlcarousel/assets/owl.carousel.min.css") ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url("$this->theme_folder/$this->theme/assets/css/bootstrap.min.css") ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url("$this->theme_folder/$this->theme/assets/css/style.css") ?>" rel="stylesheet">
</head>