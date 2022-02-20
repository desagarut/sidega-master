<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

	<!-- jQuery 3 -->
	<script src="<?= base_url()?>assets/bootstrap/js/jquery.min.js"></script>
	<!-- Jquery UI -->
	<script src="<?= base_url()?>assets/bootstrap/js/jquery-ui.min.js"></script>
	<script src="<?= base_url()?>assets/bootstrap/js/jquery.ui.autocomplete.scroll.min.js"></script>

	<script src="<?= base_url()?>assets/bootstrap/js/moment.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?= base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- Select2 -->
	<script src="<?= base_url()?>assets/bootstrap/js/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="<?= base_url()?>assets/bootstrap/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url()?>assets/bootstrap/js/dataTables.bootstrap.min.js"></script>
	<!-- bootstrap color picker -->
	<script src="<?= base_url()?>assets/bootstrap/js/bootstrap-colorpicker.min.js"></script>
	<!-- bootstrap Date time picker -->
	<script src="<?= base_url()?>assets/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?= base_url()?>assets/bootstrap/js/id.js"></script>
	<!-- bootstrap Date picker -->
	<script src="<?= base_url()?>assets/bootstrap/js/bootstrap-datepicker.min.js"></script>
	<script src="<?= base_url()?>assets/bootstrap/js/bootstrap-datepicker.id.min.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?= base_url()?>assets/bootstrap/js/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="<?= base_url()?>assets/bootstrap/js/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?= base_url()?>assets/bootstrap/js/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url()?>assets/js/adminlte.min.js"></script>
	<script src="<?= base_url()?>assets/js/validasi.js"></script>
	<script src="<?= base_url()?>assets/js/jquery.validate.min.js"></script>
	<script src="<?= base_url()?>assets/js/localization/messages_id.js"></script>
	<script src="<?= base_url()?>assets/front/js/jquery.overlay.min.js"></script>
	<script src="<?= base_url()?>assets/front/js/jquery-confirm.min.js"></script>
	<!-- Numeral js -->
	<script src="<?= base_url()?>assets/js/numeral.min.js"></script>
	<!-- Script-->
	<script src="<?= base_url()?>assets/js/script.js"></script>
	<!-- Khusus modul layanan mandiri -->
	<script src="<?= base_url() ?>assets/front/js/mandiri.js"></script>

	<!-- keyboard widget css & script -->
	<script src="<?= base_url("assets/js/jquery.keyboard.min.js")?>"></script>
	<script src="<?= base_url("assets/js/jquery.mousewheel.min.js")?>"></script>
	<script src="<?= base_url("assets/js/jquery.keyboard.extension-all.min.js")?>"></script>
	<script src="<?= base_url("assets/front/js/mandiri-keyboard.js")?>"></script>
    
	<script>
		$(document).ready(function() {
		// Di form surat ubah isian admin menjadi disabled
		$("#wrapper-mandiri .readonly-permohonan").attr('disabled', true);
		$("#wrapper-mandiri form#validasi").removeAttr('target');
		$("#wrapper-mandiri .tdk-permohonan textarea").removeClass('required');    
		$("#wrapper-mandiri .tdk-permohonan select").removeClass('required');    
		$("#wrapper-mandiri .tdk-permohonan input").removeClass('required');    
		});
    </script>
