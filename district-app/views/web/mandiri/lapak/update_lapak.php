Anda belum memiliki lapak, masukan nama toko anda untuk membuatnya,

<div>

	<?php if ($validation_error): ?>
		<?php echo $validation_error; ?>
	<?php endif ?>

	<form method="POST">
		nama: <input type="text" name="nama" value="<?=$lapak['nama'] ?>"><br/>
		wa: <input type="text" name="wa" value="<?=$lapak['wa'] ?>"><br/>
		deskripsi: <textarea name="deskripsi"><?=$lapak['deskripsi'] ?></textarea><br/>
		<button type="submit">Gelar</button>
	</form>
</div>