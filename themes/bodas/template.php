<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($folder_themes . '/commons/head') ?>

<body>
<?php $this->load->view($folder_themes . '/commons/spinner.php') ?>
<?php $this->load->view($folder_themes . '/commons/nav.php') ?>

    <?php $this->load->view($folder_themes . '/layouts/home.tpl.php') ?>
</body>
<?php $this->load->view($folder_themes . '/commons/footer') ?>

</body>

</html>