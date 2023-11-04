<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <?php defined('THEME_VERSION') or define('THEME_VERSION', 'V 5.6') ?>

    <?php $website_title = trim(ucwords($this->setting->website_title)); ?>

    <meta content="utf-8" http-equiv="encoding">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <meta name='google' content='notranslate' />
    <meta name='theme' content='Bodas' />
    <meta name='designer' content='Bambang Andri H' />
    <meta name='theme:designer' content='Bambang Andri H' />
    <meta name="theme:version" content="<?= THEME_VERSION ?>" />
    <meta name="theme-color" content="#06BBCC"/>
    <meta name="keywords" content="<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>, sidega, SIDEGA, SIDeGa, sistem informasi desa garut, web, blog, informasi, website, tema sidega-blue, desa garut, kelurahan garut, kecamatan garut, kabupaten garut, Jawa Barat, indonesia" />
    <meta property="og:site_name" content="<?= $website_title ?>" />
    <meta property="og:type" content="article" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <?php if (isset($single_artikel)) : ?>

        <title><?= $single_artikel["judul"] ?> - <?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?></title>

        <meta name='description' content="<?= str_replace('"', "'", substr(strip_tags($single_artikel['isi']), 0, 400)); ?>" />

        <meta property="og:title" content="<?= $single_artikel["judul"]; ?>" />

        <?php if (trim($single_artikel['gambar']) != '') : ?>

            <meta property="og:image" content="<?= base_url() ?><?= LOKASI_FOTO_ARTIKEL ?>sedang_<?= $single_artikel['gambar']; ?>" />

        <?php endif; ?>

        <meta property='og:description' content="<?= str_replace('"', "'", substr(strip_tags($single_artikel['isi']), 0, 400)); ?>" />

    <?php else : ?>

        <title><?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?> <?= ucfirst($this->setting->sebutan_kecamatan_singkat) . ' ' . ucwords($desa['nama_kecamatan']) ?> <?= ucfirst($this->setting->sebutan_kabupaten_singkat) . ' ' . ucwords($desa['nama_kabupaten']) ?></title>

        <meta name='description' content="<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>" />

        <meta property="og:title" content="<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>" />

        <meta property='og:description' content="<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>" />

    <?php endif; ?>


    <?php if (is_file(LOKASI_LOGO_DESA . "favicon.ico")) : ?>
        <link rel="shortcut icon" href="<?= base_url() . LOKASI_LOGO_DESA ?>favicon.ico" />
    <?php else : ?>
        <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" />
    <?php endif; ?>

    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
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