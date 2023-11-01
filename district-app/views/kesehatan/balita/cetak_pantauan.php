<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>PEMANTAUAN BALITA</title>
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
						<h3><u>PEMANTAUAN BALITA</u></h3>
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
									<th>Tanggal Terdaftar</th>
									<th>Tanggal Pengukuran</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Usia Saat Pengukuran</th>
									<th>Jenis Kelamin</th>
									<th>Suhu</th>
									<th>BB</th>
									<th>TB</th>
									<th>Lila </th>
									<th>PMT </th>
									<th>Vit A </th>
									<th>KPSP </th>
									<th>KIA </th>
									<th>Keluhan</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($query_array as $key => $item) : ?>
									<tr>
										<td><?= $i ?></td>
										<td><?= $item["tanggal_terdaftar"] ?></td>
										<td><?= $item["tanggal_jam"] ?></td>
										<td><?= $item["nik"] ?></td>
										<td class='textx'><?= $item["nama"] ?></td>
										<td>
											<?php $lahir    = new DateTime($item['tanggallahir']);
											$today        = new DateTime($item['tanggal_jam']);
											$umur = $today->diff($lahir);
											echo $umur->y;
											echo " Tahun - ";
											echo $umur->m;
											echo " Bulan - ";
											echo $umur->d;
											echo " Hari";
											?>
										</td>
										<td><?= ($item["sex"] === '1' ? 'Laki-laki' : 'Perempuan'); ?></td>
										<td><?= $item["suhu_tubuh"]; ?></td>
										<td><?= ($item["bb_pantau"]); ?></td>
										<td><?= ($item["tb_pantau"]); ?></td>
										<td><?= ($item["lila_pantau"]); ?></td>
										<td><?= ($item["pmt_pantau"]); ?></td>
										<td><?= ($item["vita_pantau"]); ?></td>
										<td><?= ($item["kpsp_pantau"]); ?></td>
										<td><?= ($item["kia_pantau"]); ?></td>
										<td><?= $item["keluhan_lain"]; ?></td>
										<td><?= $item["status_covid"]; ?></td>
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