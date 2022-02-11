Anda belum memiliki lapak, masukan nama toko anda untuk membuatnya,

<div>

	<?php if ($error): ?>
		<?php echo $error; ?>
	<?php endif ?>

	<form method="POST">
		nama: <input type="text" name="nama" value="<?=$barang['nama'] ?>"><br/>
		keterangan: <input type="text" name="keterangan" value="<?=$barang['keterangan'] ?>"><br/>
		kategori: <select name="kategori">
			<?php foreach ($kategorilist as $key => $value): ?>

				<option value="<?=$key ?>" <?php if($value['id'] == $barang['kategori']['id']) { echo ' selected'; } ?>>
					<?=$value['nama'] ?>
				</option>

			<?php endforeach ?>
		</select><br/>
		Harga : <input type="text" name="harga" id="harga" value="<?=$barang['harga'] ?>"><br />
		Stok : <input type="text" name="stok" id="stok" value="<?=$barang['stok'] ?>"><br />
		<label class="control-label" for="gambar1">Gambar Tambahan</label>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control" id="file_path1">
            <input type="file" class="hidden" id="file1" name="gambar1">
            <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-box" id="file_browser1"><i class="fa fa-search"></i> Browse</button>
             </span>
         </div>
         <div class="input-group input-group-sm">
            <input type="text" class="form-control" id="file_path1">
            <input type="file" class="hidden" id="file2" name="gambar3">
            <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-box" id="file_browser2"><i class="fa fa-search"></i> Browse</button>
             </span>
         </div>
         <div class="input-group input-group-sm">
            <input type="text" class="form-control" id="file_path1">
            <input type="file" class="hidden" id="file3" name="gambar3">
            <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-box" id="file_browser3"><i class="fa fa-search"></i> Browse</button>
             </span>
         </div>
		<button type="submit">Update Barang</button>
	</form>
</div>