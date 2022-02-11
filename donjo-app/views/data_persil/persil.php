<?php ?>
<script>
	$( function() {
		$( "#cari" ).autocomplete({
			source: function( request, response ) {
				$.ajax( {
					type: "POST",
					url: '<?= site_url("data_persil/autocomplete")?>',
					dataType: "json",
					data: {
						cari: request.term
					},
					success: function( data ) {
						response( JSON.parse( data ));
					}
				} );
			},
			minLength: 1,
		} );
	} );
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Persil <?= ucwords($this->setting->sebutan_deskel)?> <?= $kelurahan["nama_deskel"];?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('home')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Daftar Persil</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<div class="col-md-4 col-lg-3">
					<?php $this->load->view('data_persil/menu_kiri.php')?>
				</div>
				<div class="col-md-8 col-lg-9">
					<div class="box box-info">
						<div class="box-header">
							<h4 class="text-center"><strong>DAFTAR PERSIL</strong></h4>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="box-header with-border">
										<a href="<?=site_url("data_persil/form/")?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Tambah Persil">
											<i class="fa fa-plus"></i>Tambah Persil
										</a>
										<a href="<?=site_url("data_persil/dialog_cetak/cetak")?>" class="btn btn-social btn-box bg-purple btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data Persil" title="Cetak Data">
											<i class="fa fa-print"></i>Cetak
										</a>
										<a href="<?=site_url("data_persil/dialog_cetak/unduh")?>" class="btn btn-social btn-box bg-navy btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data Persil" title="Unduh Data">
											<i class="fa fa-download"></i>Unduh
										</a>
										<a href="<?= site_url("data_persil/clear")?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-refresh"></i>Bersihkan</a>
									</div>
									<div class="box-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
													<form id="mainform" name="mainform" action="" method="post">
														<div class="row">
															<div class="col-sm-9">
																<select class="form-control input-sm" name="tipe" onchange="formAction('mainform', '<?= site_url("{$this->controller}/filter/tipe"); ?>')">
																	<option value="">Tipe Tanah</option>
																	<option value="BASAH" <?php selected($tipe, "BASAH") ?>>Tanah Basah</option>
																	<option value="KERING" <?php selected($tipe, "KERING") ?>>Tanah Kering</option>
																</select>
																<?php if ($tipe): ?>
																	<select class="form-control input-sm" name="kelas" onchange="formAction('mainform','<?= site_url("{$this->controller}/filter/kelas"); ?>')" >
																		<option value="">Kelas Tanah</option>
																		<?php foreach ($list_kelas AS $data): ?>
																			<option value="<?= $data['id']; ?>" <?= selected($kelas, $data['id']); ?>><?= $data['kode']; ?></option>
																		<?php endforeach;?>
																	</select>
																<?php endif; ?>
																<select class="form-control input-sm" name="lokasi" onchange="formAction('mainform', '<?= site_url("{$this->controller}/filter/lokasi"); ?>')">
																	<option value="">Tipe Lokasi</option>
																	<option value="1" <?php selected($lokasi, "1") ?>>Dalam Desa</option>
																	<option value="2" <?php selected($lokasi, "2") ?>>Luar Desa</option>
																</select>
																<?php if ($lokasi === '1'): ?>
																	<?php $this->load->view('global/filter_wilayah', ['form' => 'mainform']); ?>
																<?php endif; ?>
															</div>
															<div class="col-sm-3">
																<div class="box-tools">
																	<div class="input-group input-group-sm pull-right">
																		<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=html_escape($cari)?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action', '<?= site_url("data_persil/search")?>');$('#'+'mainform').submit();}">
																		<div class="input-group-btn">
																			<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("data_persil/search")?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-sm-12">
																<div class="table-responsive">
																	<table class="table table-bordered table-striped dataTable table-hover">
																		<thead class="bg-gray disabled color-palette">
																			<tr>
																				<th>No</th>
																				<th>Aksi</th>
																				<th>No. Persil : No. Urut Bidang</th>
																				<th>Kelas Tanah</th>
																				<th>Luas (M2)</th>
																				<th>Lokasi</th>
																				<th>Letter-C Awal</th>
																				<th>Jml Mutasi</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php foreach ($persil as $item): ?>
																				<tr>
																					<td><?= $item['no']?></td>
																					<td nowrap>
																						<?php if ($item['jml_bidang'] > 0): ?>
																							<a href="<?= site_url("data_persil/rincian/".$item["id"])?>" class="btn bg-purple btn-box btn-sm" title="Rincian"><i class="fa fa-bars"></i></a>
																						<?php else: ?>
																							<a class="btn bg-purple btn-box btn-sm" disabled title="Rincian"><i class="fa fa-bars"></i></a>
																						<?php endif ?>
																						<a href="<?= site_url("data_persil/form/".$item["id"])?>" class="btn bg-orange btn-box btn-sm"  title="Ubah Data"><i class="fa fa-edit"></i></a>
																						<?php if ($item['jml_bidang'] == 0): ?>
																							<a href="#" data-href="<?= site_url("data_persil/hapus/".$item["id"])?>" class="btn bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																						<?php else: ?>
																							<a class="btn bg-maroon btn-box btn-sm" disabled><i class="fa fa-trash-o"></i></a>
																						<?php endif ?>
																						</td>
																						<td><?= $item['nomor'].' : '.$item['nomor_urut_bidang']?></td>
																						<td><?= $persil_kelas[$item["kelas"]]['kode']?></td>
																						<td><?= $item['luas_persil']?></td>
																						<td><?= $item['alamat'] ?: $item['lokasi']?></td>
																						<td><a href="<?= site_url("letterc/mutasi/$item[letterc_awal]/$item[id]")?>"><?= $item['nomor_letterc_awal']?></a></td>
																						<td><?= $item['jml_bidang']?></td>
																					</tr>
																				<?php endforeach; ?>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</form>
														<?php $this->load->view('global/paging');?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<?php $this->load->view('global/confirm_delete');?>
