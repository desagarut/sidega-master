<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Cetak Master Data Tagihan SPPT PBB</title>
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
					<h3> DATA TAGIHAN SPPT PBB</h3>
                    <label>Tanggal cetak : &nbsp; </label><?= date('Y m d - h:i:sa')?>
				</div>
				<br>
				<table class="border thick">
					<thead>
						<tr class="border thick">
							<th colspan="2" >NOMOR</th>
							<th colspan="2" >PEMILIK</th>
							<th colspan="4" >TAGIHAN PBB</th>
							<th colspan="2" >PEMBAYARAN</th>
							<th colspan="3" >TANGGAL</th>
						</tr>
						<tr>
							<th rowspan="1" >URUT</th>
							<th>SPPT PBB</th>
							<th>NAMA</th>
							<th>lETAK OP</th>
							<th>PBB TERHUTANG</th>
							<th>DENDA</th>
							<th>IURAN</th>
							<th>TOTAL TAGIHAN</th>
							<th>STATUS</th>
							<th>TGL</th>
							<th>UPDATE</th>
							<th>DAFTAR</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data_sppt as $sppt): ?>
						<tr>
							<td align="center"><?= $sppt['no']?></td>
							<td class="textx"><?= sprintf("%04s", $sppt['nomor'])?></td>
							<td><?= strtoupper($sppt["nama_wp"])?></td>
							<td><?= $sppt["letak_op"]?></td>
							<td align="right"> <?= rupiah($sppt['pbb_terhutang'])?></td>
							<td align="right"> <?= rupiah($sppt['denda']) ?></td>
							<td align="right"> <?= rupiah($sppt['iuran']) ?></td>
							<td align="right"> <?= rupiah($sppt['total_tagih']) ?></td>
							<td align="center"> <?= $sppt['status'] ?></td>
							<td align="center">  <?= tgl_indo($sppt['tgl_bayar']) ?></td>
							<td align="center">  <?= tgl_indo($sppt['updated_at']) ?></td>
							<td align="center"><?= tgl_indo($sppt['created_at'])?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
                    <tfoot>
                    	<tr>
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
