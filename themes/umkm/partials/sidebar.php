<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container">

<?php $this->load->view($folder_themes . '/partials/layanan_online.php') ?>
<?php $this->load->view($folder_themes . '/widgets/agenda.php') ?>
<?php $this->load->view($folder_themes . '/widgets/komentar.php') ?>
<?php $this->load->view($folder_themes . '/widgets/kategori.php') ?>
</div>