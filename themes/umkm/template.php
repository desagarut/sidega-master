<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view($folder_themes .'/commons/meta') ?>
<?php $this->load->view($folder_themes .'/commons/for_css') ?>
</head>

<body>
<?php $this->load->view($folder_themes .'/commons/header') ?>
<?php if($this->uri->segment(2) == 'kategori' && empty($judul_kategori)) : ?>
<?php $this->load->view($folder_themes .'/commons/404') ?>
<?php else : ?>
<?php $this->load->view($folder_themes .'/layouts/home.tpl.php') ?>
<?php endif;?>
<?php $this->load->view($folder_themes .'/commons/footer') ?>
<?php $this->load->view($folder_themes .'/commons/for_js') ?>
</body>
</html>