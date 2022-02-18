<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>

<body>
	<?php $this->load->view($folder_themes . '/commons/header') ?>
		<?php $this->load->view($folder_themes . '/partials/map_google') ?>
	<?php $this->load->view($folder_themes . '/commons/footer_min') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
</body>

</html>