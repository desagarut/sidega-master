<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="box box-danger">
	<div class="box-header with-border">
		<h3 class="box-title">Daftar Calon Pemilih Berdasarkan Wilayah (pada tgl pemilihan <?= $tanggal_pemilihan; ?>)</h3>
	</div>
	<div class="box-body">
		<?php if(count($main) > 0): ?>
			<table id="dpt" class="table table-striped">
				<thead>
					<tr>
						<th class="kiri">No</th>
						<th class="kiri">Nama <?= ucwords($this->setting->sebutan_dusun); ?></th>
						<th class="kiri">RW</th>
						<th class="kanan">Jiwa</th>
						<th class="kanan">Lk</th>
						<th class="kanan">Pr</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($main as $data): ?>
						<tr>
							<td><?= $data['no']; ?></td>
							<td><?= strtoupper($data['dusun']); ?></td>
							<td><?= strtoupper($data['rw']); ?></td>
							<td class="angka"><?= $data['jumlah_warga']; ?></td>
							<td class="angka"><?= $data['jumlah_warga_l']; ?></td>
							<td class="angka"><?= $data['jumlah_warga_p']; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfooter>
					<tr>
						<th colspan="3" class="angka">TOTAL</th>
						<th class="angka"><?= $total['total_warga']; ?></th>
						<th class="angka"><?= $total['total_warga_l']; ?></th>
						<th class="angka"><?= $total['total_warga_p']; ?></th>
					</tr>
				</tfooter>
			</table>
		<?php else: ?>
			<div class="">Data tidak tersedia</div>
		<?php endif; ?>
	</div>
</div>
