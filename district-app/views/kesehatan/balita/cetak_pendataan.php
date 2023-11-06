<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Data Balita</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="<?= base_url() ?>assets/css/report.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="body">
		<table>
			<tbody>
				<tr>
					<td align="center">
						<?php if ($aksi != 'unduh') : ?>
							<img src="<?= gambar_desa($config['logo']); ?>" alt="" style="width:100px; height:auto">
						<?php endif; ?>
						<h1>PEMERINTAH <?= strtoupper($this->setting->sebutan_kabupaten) ?> <?= strtoupper($config['nama_kabupaten']) ?> </h1>
						<h1 style="text-transform: uppercase;"></h1>
						<h1><?= strtoupper($this->setting->sebutan_kecamatan) ?> <?= strtoupper($config['nama_kecamatan']) ?> </h1>
						<h1><?= strtoupper($this->setting->sebutan_desa) . " " . strtoupper($config['nama_desa']) ?></h1>
					</td>
				</tr>
				<tr>
					<td style="padding: 5px 20px;">
						<hr style="border-bottom: 2px solid #000000; height:0px;">
					</td>
				</tr>
				<tr>
					<td align="center">
						<h3><u>DAFTAR BALITA</u></h3>
					</td>
				</tr>
				<tr>
					<td style="padding: 5px 20px;">
						<strong>Sasaran: </strong>Penduduk Balita<br>
					</td>
				</tr>
				<tr>
					<td style="padding: 5px 20px;">
						<table class="border thick">
							<thead>
								<tr class="border thick">
									<th>No</th>
									<th>Foto</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Tempat Lahir</th>
									<th>Tanggal Lahir</th>
									<th>Jenis Kelamin</th>
									<th>Ayah - Ibu</th>
									<th>Alamat</th>
									<th>Tanggal Terdaftar</th>
									<th>Puskesmas</th>
									<th>Posyandu</th>
									<th>BB / TB Lahir</th>
									<th>No HP</th>
									<th>Email</th>
									<th>Riwayat Penyakit</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($balita_list as $key => $item) : ?>
									<tr>
										<td><?= $i ?></td>
										<td><img class="img img-circle" style="with:100px; height:100px" src="<?= AmbilFoto($item['foto'], '', $item['id_sex']) ?>" alt="foto <?= strtoupper($item['nama']); ?>" title="foto <?= strtoupper($item['nama']); ?>" /></td>
										<td nowrap><?= $item["terdata_nama"] ?></td>
										<td nowrap><?= $item["terdata_info"] ?></td>
										<td><?= $item["tempat_lahir"] ?></td>
										<td nowrap><?= $item["tanggal_lahir"] ?></td>
										<td><?= $item["sex"] ?></td>
										<td align=center nowrap><?= $item["nama_ayah"] ?><br/> - <br/><?= $item["nama_ibu"] ?></td>
										<td><?= $item["info"] ?></td>
										<td><?= tgl_indo_out($item["tanggal_terdaftar"]) ?></td>
										<td><?= $item["nama_puskesmas"] ?></td>
										<td><?= $item["nama_posyandu"] ?></td>
										<td><?= $item["bb_lahir"] ?>/<?= $item["tb_lahir"] ?></td>
										<td><?= $item["hp_ortu"] ?></td>
										<td><?= $item["email_ortu"] ?></td>
										<td><?= $item["riwayat_penyakit"] ?></td>
										<td><?= $item["keterangan"] ?></td>
									</tr>
								<?php $i++;
								endforeach;	?>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>

</html>