<!DOCTYPE html>
<html>
<head>
	<title>Offline Mode - <?= ucwords($this->setting->sebutan_deskel).' '.$main['nama_deskel'] ?></title>
</head>
<body>
	<br/><br/><br/>
	<div align="center">
		<?php if ($main['logo']): ?>
			<img class="profile-user-img img-responsive img-circle" src="<?=gambar_desa($main['logo'])?>" alt="Logo">
		<?php else: ?>
			<img class="profile-user-img img-responsive img-circle" src="<?= base_url()?>assets/files/logo/.png" alt="Logo">
		<?php endif ?>
		<p>
			Selamat datang di Halaman Situs Resmi <?= ucwords($this->setting->sebutan_deskel).' '.$main['nama_deskel'] ?><br/>
			Kami mohon maaf untuk sementara halaman tidak dapat di akses, dikarenakan sedang adanya perbaikan oleh tim terkait.
		</p>
		<p>
			Jika ada keperluan yang mendesak silakan langsung datang ke Kantor <?= ucwords($this->setting->sebutan_deskel)?>.<br>
			Alamat : <?= $main['alamat_kantor'] ?><br>
			Email : <?= $main['email_deskel'] ?><br>
			Telepon : <?= $main['Telepon'] ?>
		</p>
		<p>
			<?= ucwords($pamong_kades['jabatan']).' '.$main['nama_deskel'] ?>
			<br>
			<u><b><?= $main['nama_kadeskel'] ?></b></u><br>
			NIP. <?= $main['nip_kadeskel'] ?>
		</p>
	</div>
</body>
</html>