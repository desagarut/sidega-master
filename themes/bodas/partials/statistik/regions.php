<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<h5 align="center">Demografi Berdasarkan <?= $heading ?></h5>
	<div class="table" align="center">
		<small><table class=" table-hover">
			<thead>
			<tr>
				<th>No</th>
				<th>Nama Dusun</th>
				<th>Nama Kepala Dusun</th>
				<th>Jml RT</th>
				<th>Jml KK</th>
				<th>Jml Jiwa</th>
				<th>L</th>
				<th>P</th>
			</tr>
			</thead>
			<?php if(count($main) > 0) : ?>
				<tbody>

				<?php foreach($main as $data) : ?>
					<tr>
						<td align="center"><?= $data['no'] ?></td>
						<td><?= strtoupper(unpenetration(ununderscore($data['dusun']))) ?></td>
						<td><?= strtoupper(unpenetration($data['nama_kadus'])) ?></td>
						<td align="center"><?= $data['jumlah_rt'] ?></td>
						<td align="center"><?= $data['jumlah_kk'] ?></td>
						<td align="center"><?= $data['jumlah_warga'] ?></td>
						<td align="center"><?= $data['jumlah_warga_l'] ?></td>
						<td align="center"><?= $data['jumlah_warga_p'] ?></td>
					</tr>
				<?php endforeach ?>
				</tbody>
				<tfoot>
				<tr>
					<th colspan="3">TOTAL</th>
					<th><?= $total['total_rt'] ?></th>
					<th><?= $total['total_kk'] ?></th>
					<th><?= $total['total_warga'] ?></th>
					<th><?= $total['total_warga_l'] ?></th>
					<th><?= $total['total_warga_p'] ?></th>
				</tr>
				</tfoot>
			<?php else : ?>
				<tr><td colspan="6" class='text-center'>Daftar masih kosong</td></tr>
			<?php endif; ?>
		</table></small>
	</div>
