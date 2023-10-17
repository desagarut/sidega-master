<div class="box box-info">
	<div class="box-header with-border">
		<table id="judul-laporan" width="100%" style="border: solid 0px black; text-align: center;">
			<tr>
				<td>
					<h4>LAPORAN REALISASI PELAKSANAAN</h4>
					<h4>ANGGARAN PENDAPATAN DAN BELANJA DESA</h4>
					<h4>PEMERINTAH <?= strtoupper(ucwords($this->setting->sebutan_desa))?> <?= strtoupper($desa['nama_desa'])?></h4>
					<h4>SEMESTER <?= $sm ?></h4>
					<h4>TAHUN ANGGARAN <?= $ta ?></h4>
				</td>
			</tr>
		</table>

		<?php switch ($_SESSION['submenu']): ?><?php case "Laporan Keuangan Semester1": ?>
			<?php case "Laporan Keuangan Akhir": ?>
				<?php $this->load->view('keuangan/tabel_laporan_rp_apbd_isi.php'); ?>
				<?php break; ?>
			<?php case "Laporan Keuangan Semester1 Bidang": ?>
			<?php case "Laporan Keuangan Akhir Bidang": ?>
				<?php $this->load->view('keuangan/tabel_laporan_rp_apbd_isi.php', array('jenis' => 'bidang')); ?>
				<?php break; ?>
		<?php endswitch ?>

	</div>
</div>
