<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-KE41WGD46L"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-KE41WGD46L');
  </script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1823410826720847" crossorigin="anonymous"></script> <?php $this->load->view($folder_themes . '/commons/meta') ?>
  <?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>

<body>
  <?php $this->load->view($folder_themes . '/commons/header') ?>
  <?php if ($this->uri->segment(2) == 'kategori' && empty($judul_kategori)) : ?>
    <?php $this->load->view($folder_themes . '/commons/404') ?>
  <?php else : ?>
    <?php $this->load->view($folder_themes . '/layouts/home.tpl.php') ?>
  <?php endif; ?>
  <?php $this->load->view($folder_themes . '/commons/footer') ?>
  <?php $this->load->view($folder_themes . '/commons/for_js') ?>
</body>

</html>