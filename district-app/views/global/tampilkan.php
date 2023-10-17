<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
SIDEGA
 */
?>

<?php if ($link_berkas): ?>
	<div class="modal-body">
		<?php if ($tipe == '.pdf'): ?>
			<iframe src="<?= $link_berkas; ?>" type="application/pdf" style="width: 100%; height: 300px;"></iframe>
		<?php else: ?>
			<img src="<?= $link_berkas; ?>" style="width: 100%; height: auto;">
		<?php endif; ?>
	</div>
	<div class="modal-footer">
		<div class="text-center">
			<a href="<?= $link_unduh; ?>" class="btn btn-flat bg-navy btn-sm"><i class="fa fa-download"></i> Unduh Dokumen</a>
		</div>
	</div>
<?php else: ?>
	<div class="modal-body">
		Berkas tidak ditemukan.
	</div>
<?php endif; ?>
