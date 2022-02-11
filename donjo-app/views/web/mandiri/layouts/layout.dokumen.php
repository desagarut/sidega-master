<?php $this->load->view('web/mandiri/header_mandiri.php') ?>

<style type="text/css">

div.modal-header.bg-primary {

	padding: 10px;

}

#wrapper-mandiri .tdk-permohonan {

	display: none !important;

}

a.btn {

	color: #fff;

}

.unread > td {

	background-color: #ffeeaa !important;

}

</style>

<?php include('donjo-app/views/web/mandiri/menu.php'); ?>



<?php if (empty($views_partial_layout)): ?>

<?php 

	switch ($m) {

	  case 1:

		$views_partial_layout = 'web/mandiri/mandiri';

		break;

	  case 2:

		$views_partial_layout = 'web/mandiri/layanan_surat';

		break;

	  case 3:

		$views_partial_layout = 'web/mandiri/mailbox';

		break;

	  case 4:

		$views_partial_layout = 'web/mandiri/bantuan';

		break;

	  case 5:

		$views_partial_layout = 'web/mandiri/surat';

		break;

	  case 6:

		$views_partial_layout = 'web/mandiri/profil';

		break;
		
	  case 7:

		$views_partial_layout = 'web/mandiri/mandiri_dokumen';

		break;


	  default:

		$views_partial_layout = 'web/mandiri/mandiri';

	}

  ?>

<?php else: ?>

  <?php $data['mandiri'] = 1; ?>

<?php endif; ?>

              

<?php $this->load->view($views_partial_layout, $data);?>



<?php $this->load->view('web/mandiri/footer_mandiri.php') ?>

