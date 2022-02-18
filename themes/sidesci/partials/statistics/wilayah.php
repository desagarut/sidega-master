<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="single_page_area">
	<h3 class="post_titile" align="center">Data Demografi Berdasar <?=$heading?></h3>
	<div class="box-body">
		<div class="table-responsive">
		<?php if(count($main) > 0) : ?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr style="background-color:#39F;font-weight:bold; color:#FFF">
						<th class="text-center">No</th>
						<th class="text-center"><?= ucwords($this->setting->sebutan_dusun)?></th>
						<th class="text-center">RW</th>
						<th class="text-center">RT</th>
						<th class="text-center">Nama Kepala/Ketua</th>
						<th class="text-center">KK</th>
						<th class="text-center">L</th>
						<th class="text-center">P</th>
						<th class="text-center">L+P</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($main as $indeks => $data): ?>
						<tr>
							<td align="center"><?= $indeks + 1?></td>
							<td><?= ($main[$indeks - 1]['dusun'] == $data['dusun']) ? '' : strtoupper($data['dusun'])?></td>
							<td><?= ($main[$indeks - 1]['rw'] == $data['rw']) ? '' : $data['rw']?></td>
							<td><?= $data['rt']?></td>
							<td><?= $data['nama_kepala']?></td>
							<td align="right"><?= $data['jumlah_kk']?></td>
							<td align="right"><?= $data['jumlah_warga_l']?></td>
							<td align="right"><?= $data['jumlah_warga_p']?></td>
							<td align="right"><?= $data['jumlah_warga']?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr style="background-color:#39F;font-weight:bold; color:#FFF">
						<td colspan="5" align="left"><label>TOTAL</label></td>
						<td align="right"><?= $total['total_kk']?></td>
						<td align="right"><?= $total['total_warga_l']?></td>
						<td align="right"><?= $total['total_warga_p']?></td>
						<td align="right"><?= $total['total_warga']?></td>
					</tr>
				</tfoot>
			</table>
			<?php else : ?>
				Belum ada data...
		<?php endif ?>
		</div>
	</div>
</div>