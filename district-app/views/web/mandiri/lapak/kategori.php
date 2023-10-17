Hai <br/>

nama: <?=$lapak['nama'] ?><br/>
wa: <?=$lapak['wa'] ?><br/>
deskripsi: <?=$lapak['deskripsi'] ?><br/><br/>

<b><?=$kategori['nama'] ?></b><br/>
Semua: <?=count($barang['all']) ?><br/>
Tertolak: <?=count($barang['tolak']) ?><br/>
Pending: <?=count($barang['pending']) ?><br/>
Terbit: <?=count($barang['terbit']) ?><br/><br/>

<?php

	$page = intval($_GET['page']);

	if ($page < 1) {

		$page = 1;
	}
	
	$limit = 5;
	$offset = ($page - 1) * $limit;

	$jumlahHalaman = ceil(count($barang['all'])/$limit);

?>

<a href="<?php echo site_url('layanan_mandiri/lapak/update'); ?>">Update Lapak</a>

<?php for($i = $offset; $i < $offset + $limit; $i++): ?>

	<?php if ($item = $barang['all'][$i]): ?>

		<p>
			<a href="<?=site_url('layanan_mandiri/lapak/barang/' . $item['id']) ?>">
				<?=$item['nama'] ?>
			</a>
		</p>

	<?php endif ?>

<?php endfor ?>


Total Halaman: <?=$jumlahHalaman ?><br>
Halaman Sekarang: <?=$page ?>

<?php if ($page > 1): ?>

	<a href="<?=site_url('layanan_mandiri/lapak/kategori/' . $kategori['id'] . '/?page=' . + ($page - 1)) ?>"> Mundur </a>

<?php endif ?>

<?php if ($page < $jumlahHalaman): ?>

	<a href="<?=site_url('layanan_mandiri/lapak/kategori/' . $kategori['id'] . '/?page=' . + ($page + 1)) ?>"> Maju </a>

<?php endif ?>
