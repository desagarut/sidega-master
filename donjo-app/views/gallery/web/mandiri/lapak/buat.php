Anda belum memiliki lapak, masukan nama toko anda untuk membuatnya,

<div>

	<?php if ($validation_error): ?>
		<?php echo $validation_error; ?>
	<?php endif ?>
	<div class="box box-primary">
		<div class="box-body">
			<form method="POST" class="form-horizontal">
				<div class="header-profile">
					<lable class="text-right uppercase">
						<strong>Data Lapak</strong>
					</lable>
				</div>
				<div class="section-data-personal">
					<div class="form-group">
						<label for="nama" class="col-sm-3 control-label">Nama Lapak</label>
						<div class="col-md-4">
							<input id="nama" name="nama" class="form-control input-sm required" type="text" placeholder="Nama Lapak" ></input>
						</div>
					</div>					
					<div class="form-group">
						<label for="deskripsi" class="col-sm-3 control-label">Keterangan Lapak</label>
						<div class="col-md-6">
							<textarea id="deskripsi" name="deskripsi" class="form-control input-sm required"placeholder="Keterangan Lapak" style="resize:none;height:200px;"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="wa" class="col-sm-3 control-label">Nomor Telepon</label>
						<div class="col-md-2">
							<input id="wa" name="wa" class="form-control input-sm required" type="text" placeholder="Nomor Telepon" ></input>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat" class="col-sm-3 control-label">Alamat Lapak</label>
						<div class="col-md-6">
							<textarea id="alamat" name="alamat" class="form-control input-sm required"placeholder="Alamat Lapak" style="resize:none;height:200px;"></textarea>
						</div>
					</div>
				</div>
				<button class="btn btn-primary" type="submit">Submit</button>
			</form>
		</div>
	</div>
</div>