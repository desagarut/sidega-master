<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Peserta Program/Kegiatan Pembinaan Kemasyarakatan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('pembinaan_masyarakat')?>"> Pembinaan Kemasyarakatan</a></li>
			<li><a href="<?= site_url("pembinaan_masyarakat/detail/$detail[id]")?>"> Rincian Program Bantuan</a></li>
			<li class="active">Data Peserta </li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url('pembinaan_masyarakat')?>" class="btn btn-social btn-box btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Program"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Program</a>
			</div>
			<div class="box-body">
				<?php include('district-app/views/pembinaan_masyarakat/rincian.php'); ?>
				<h5><b>Data Peserta</b></h4>
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover tabel-rincian">
						<tbody>
							<?php if ($individu): ?>
								<?php if ($detail["sasaran"] == 2): ?>
									<tr>
										<td>No. KK</td>
										<td> : </td>
										<td><?= $individu['no_kk']; ?></td>
									</tr>
									<tr>
										<td>Nama KK</td>
										<td> : </td>
										<td><?= $individu['nama_kk']; ?></td>
									</tr>
									<tr>
										<td>Hubungan KK</td>
										<td> : </td>
										<td><?= $individu['hubungan']; ?></td>
									</tr>
								<?php endif; ?>
								<?php if ($detail["sasaran"] == 3): ?>
									<tr>
										<td>No. RTM</td>
										<td> : </td>
										<td><?= $individu['no_kk']; ?></td>
									</tr>
								<?php endif; ?>
								<?php if ($detail["sasaran"] == 4): ?>
									<tr>
										<td>Nama Kelompok</td>
										<td> : </td>
										<td><?= $individu['nama_kelompok']; ?></td>
									</tr>
								<?php endif; ?>
								<tr>
									<td width="20%">NIK <?=$individu['judul']?></td>
									<td width="1">:</td>
									<td><?= $individu['nik']; ?></td>
								</tr>
								<tr>
									<td>Nama <?=$individu['judul']?></td>
									<td> : </td>
									<td><?= $individu['nama']; ?></td>
								</tr>
								<tr>
									<td>Alamat <?=$individu['judul']?></td>
									<td> : </td>
									<td><?= $individu['alamat_wilayah']; ?></td>
								</tr>
								<tr>
									<td>Tempat Tanggal Lahir <?=$individu['judul']?></td>
									<td> : </td>
									<td><?= $individu['tempatlahir']?>, <?= tgl_indo($individu['tanggallahir'])?></td>
								</tr>
								<tr>
									<td>Jenis Kelamin <?=$individu['judul']?></td>
									<td> : </td>
									<td><?= $individu['sex']?></td>
								</tr>
								<tr>
									<td>Umur <?=$individu['judul']?></td>
									<td> : </td>
									<td><?= $individu['umur']?> TAHUN</td>
								</tr>
								<tr>
									<td>Pendidikan <?=$individu['judul']?></td>
									<td> : </td>
									<td><?= $individu['pendidikan']?></td>
								</tr>
								<tr>
									<td>Warganegara / Agama <?=$individu['judul']?></td>
									<td> : </td>
									<td><?= $individu['warganegara']?> / <?= $individu['agama']?></td>
								</tr>
								<tr>
									<td>Program Pembinaan Kemasyarakatan Yang Sudah Diikuti</td>
									<td> : </td>
									<td>
										<?php foreach ($individu['program']['programkerja'] as $item): ?>
											<?php if ($item[status] == '1'): ?>
												<?= anchor("pembinaan_masyarakat/data_peserta/$item[peserta_id]", '<span class="label label-success">' . $item['nama'] . '</span>&nbsp;', 'target="_blank"'); ?>
											<?php endif; ?>
										<?php endforeach; ?>
									</td>
								</tr>
							<?php endif; ?>
							<tr>
								<td colspan='3'><b>IDENTITAS PADA KARTU / SERTIFIKAT</b></td>
							</tr>
							<tr>
								<td>Nomor Kartu Peserta</td>
								<td> : </td>
								<td><?= $peserta["no_id_kartu"]?></td>
							</tr>
							<tr>
								<td>NIK</td>
								<td> : </td>
								<td><?= $peserta["kartu_nik"]?></td>
							</tr>
							<tr>
								<td>Nama</td>
								<td> : </td>
								<td><?= $peserta["kartu_nama"]?></td>
							</tr>
							<tr>
								<td>Tempat Lahir</td>
								<td> : </td>
								<td><?= $peserta["kartu_tempat_lahir"]?></td>
							</tr>
							<tr>
								<td>Tanggal Lahir</td>
								<td> : </td>
								<td><?= tgl_indo($peserta["kartu_tanggal_lahir"])?></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td> : </td>
								<td><?= $individu['sex']?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td> : </td>
								<td><?= $peserta["kartu_alamat"]?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>
