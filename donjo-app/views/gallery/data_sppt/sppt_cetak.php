<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Cetak Master Data SPPT PBB</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php if (is_file(LOKASI_LOGO_DESA . "favicon.ico")): ?>
			<link rel="shortcut icon" href="<?= base_url()?><?= LOKASI_LOGO_DESA?>favicon.ico" />
		<?php else: ?>
			<link rel="shortcut icon" href="<?= base_url()?>favicon.ico" />
		<?php endif; ?>
		<link href="<?= base_url()?>assets/css/report.css" rel="stylesheet" type="text/css">
		<style>
			.textx
			{
				mso-number-format:"\@";
			}
			td,th
			{
				font-size:6.5pt;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="body">
				<div class="header" align="center">
					<label align="left"><?= get_identitas()?></label>
					<h3> DATA SPPT PBB</h3>
                    <label>Tanggal cetak : &nbsp; </label><?= date('Y m d - h:i:sa')?>
				</div>
				<br>
				<table class="border thick">
					<thead>
						<tr class="border thick">
							<th colspan="2" >NOMOR</th>
							<th colspan="3" >PEMILIK</th>
							<th colspan="6" >OBJEK PAJAK</th>
							<th rowspan="3" >NJOP</th>
							<th rowspan="3" >PPB TERHUTANG</th>
							<th rowspan="3" >TANGGAL TERDAFTAR</th>
						</tr>
						<tr>
							<th rowspan="2">URUT</th>
							<th rowspan="2">SPPT PBB</th>
							<th rowspan="2">NAMA</th>
							<th rowspan="2">NIK</th>
							<th rowspan="2">ALAMAT</th>
							<th colspan="3">BUMI</th>
							<th colspan="3">BANGUNAN</th>
                            
						</tr>
						<tr>
							<th>m<sup>2</sup></th>
							<th>Pajak (Rp.)</th>
							<th>Total Pajak (Rp.)</th>
							<th>m<sup>2</sup></th>
							<th>Pajak (Rp.)</th>
							<th>Total Pajak (Rp.)</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data_sppt as $sppt): ?>
						<tr>
							<td align="center"><?= $sppt['no']?></td>
							<td class="textx"><?= sprintf("%04s", $sppt['nomor'])?></td>
							<td><?= strtoupper($sppt["namatertagih"])?></td>
							<td class="textx"><?= $sppt['nik']?></td>
							<td><?= $sppt["alamat"]?></td>
							<td align="center"> <?= $sppt['luas_tanah'], " m<sup>2</sup>" ?></td>
							<td align="right"> <?= rupiah($sppt['pajak_tanah']) ?></td>
							<td align="right"> <?= rupiah($sppt['total_pajak_tanah']) ?></td>
							<td align="center"> <?= $sppt['luas_banguan'], " m<sup>2</sup>" ?></td>
							<td align="right">  <?= rupiah($sppt['pajak_bangunan']) ?></td>
							<td align="right">  <?= rupiah($sppt['total_pajak_bangunan']) ?></td>
							<td align="right">  <?= rupiah($sppt['njop_ppbb']) ?></td>
							<td align="right">  <?= rupiah($sppt['pbb_terhutang']) ?></td>
							<td align="center"><?= tgl_indo($sppt['tanggal_daftar'])?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
                    <tfoot>
                    	<tr>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                            <td align="center"><b>Jumlah</b></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                        </tr>
                    </tfoot>
                    
				</table>
			</div>
			
		</div>
	</body>
</html>
