<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view($folder_themes . '/partials/meta') ?>
<?php if($single_artikel['id']) : ?>
<?php $this->load->view($folder_themes .'/partials/header') ?>
<?php $this->load->view($folder_themes .'/partials/nav') ?>
        <?php $this->load->view($folder_themes .'/partials/article.php') ?>
<?php $this->load->view($folder_themes .'/partials/footer') ?>
<?php else : ?>
<?php endif ?>
