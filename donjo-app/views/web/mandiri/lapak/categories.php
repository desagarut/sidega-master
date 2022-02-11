Hai <br/>

nama: <?=$lapak['nama'] ?><br/>
wa: <?=$lapak['wa'] ?><br/>
deskripsi: <?=$lapak['deskripsi'] ?><br/><br/>

<a href="<?php echo site_url('layanan_mandiri/lapak/update'); ?>">Update Lapak</a>

<a href="<?php echo site_url('layanan_mandiri/lapak/input'); ?>">Upload Barang</a>

<br/><br/>

<?php foreach ($kategorilist as $value): ?>

	<a href="<?=site_url('layanan_mandiri/lapak/kategori/' . $value['id']) ?>"> <?=$value['nama'] ?> </a><br />

<?php endforeach ?>
