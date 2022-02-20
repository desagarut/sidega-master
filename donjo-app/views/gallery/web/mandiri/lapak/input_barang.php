Anda belum memiliki lapak, masukan nama toko anda untuk membuatnya,

<div>

	<?php if ($error): ?>
		<?php echo $error; ?>
	<?php endif ?>

	<form method="POST" class="form-horizontal">
		<div class="section-data-personal">
			<div class="form-group">
				<label for="nama" class="col-sm-3 control-label">Nama Barang</label>
				<div class="col-md-4">
					<input id="nama" name="nama" class="form-control input-sm required" type="text" placeholder="Nama Barang" ></input>
				</div>
			</div>
			<div class="form-group">
				<label for="kategori" class="col-sm-3 control-label">Kategori Barang</label>
				<div class="col-md-4">
					<select class="form-control input-sm" name="kategori">
						<?php foreach ($kategorilist as $key => $value): ?>
							<option value="<?=$key ?>">
								<?=$value['nama'] ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="kondisi" class="col-sm-3 control-label">Kondisi Barang</label>
				<div class="col-md-4">
					<select class="form-control input-sm" name="kondisi">
						<?php foreach ($kondisilist as $key => $value): ?>
							<option value="<?=$key ?>">
								<?=$value['nama'] ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="harga" class="col-sm-3 control-label">Harga Barang</label>
				<div class="col-md-2">
					<input id="nama" name="harga" class="form-control input-sm required" type="text" placeholder="Harga Barang" ></input>
				</div>
			</div>
			<div class="form-group">
				<label for="stok" class="col-sm-3 control-label">Stok Barang</label>
				<div class="col-md-1">
					<input id="stok" name="harga" class="form-control input-sm required" type="text" placeholder="Stok Barang" ></input>
				</div>
			</div>
			<div class="form-group">
				<label for="keterangan" class="col-sm-3 control-label">Keterangan Barang</label>
				<div class="col-md-6">
					<textarea id="keterangan" name="keterangan" class="form-control input-sm required"placeholder="Keterangan Barang" style="resize:none;height:200px;"></textarea>
				</div>
			</div>
		</div>
		<button type="submit">Jual Barang</button>
	</form>
</div>