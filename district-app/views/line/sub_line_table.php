<div class="content-wrapper">
	<section class="content-header">
		<h1>Pengaturan Kategori Garis</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('line')?>"> Daftar Tipe Garis</a></li>
			<li class="active">Pengaturan Kategori Garis</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<div class="col-md-3">
          <?php $this->load->view('plan/nav.php')?>
				</div>
				<div class="col-md-9">
					<div class="box box-info">
            <div class="box-header with-border">
							<a href="<?= site_url("line/ajax_add_sub_line/$line[id]")?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Tambah Kategori <?= $line['nama'] ?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Tambah Kategori <?= $line['nama'] ?>">
								<i class="fa fa-plus"></i>Tambah Kategori <?= $line['nama'] ?>
            	</a>
							<a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform', '<?=site_url("line/delete_all_sub_line/")?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>
							<a href="<?= site_url("line")?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Tambah Artikel">
								<i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Tipe Garis
           		</a>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
										<form id="mainform" name="mainform" action="" method="post">
											<div class="row">
												<div class="col-sm-12">
													<div class="table-responsive">
														<h5 class="box-title text-center">Daftar Kategori <?= $line['nama']; ?></h5>
														<table class="table table-bordered dataTable table-hover">
															<thead class="bg-gray disabled color-palette">
																<tr>
																	<th><input type="checkbox" id="checkall"/></th>
																	<th>No</th>
																	<th>Aksi</th>
																	<th>Kategori</th>
																	<th>Aktif</th>
																	<th>Warna</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach ($subline as $data): ?>
																	<tr>
																		<td><input type="checkbox" name="id_cb[]" value="<?=$data['id']?>" /></td>
																		<td><?=$data['no']?></td>
																		<td nowrap>
																			<a href="<?= site_url("line/ajax_add_sub_line/$line[id]/$data[id]")?>" class="btn btn-warning btn-box btn-sm"  title="Ubah" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Kategori <?= $line['nama'] ?>"><i class="fa fa-edit"></i></a>
																			<?php if ($data['enabled'] == '2'): ?>
																				<a href="<?= site_url("line/line_lock_sub_line/$line[id]/$data[id]")?>" class="btn bg-navy btn-box btn-sm" title="Aktifkan"><i class="fa fa-lock">&nbsp;</i></a>
																			<?php elseif ($data['enabled'] == '1'): ?>
																				<a href="<?= site_url("line/line_unlock_sub_line/$line[id]/$data[id]")?>" class="btn bg-navy btn-box btn-sm" title="Non Aktifkan"><i class="fa fa-unlock"></i></a>
																			<?php endif; ?>
																			<a href="#" data-href="<?= site_url("line/delete_sub_line/$line[id]/$data[id]")?>" class="btn bg-maroon btn-box btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																	  </td>
																		<td width="70%"><?= $data['nama']?></td>
																		<td><?= $data['aktif']?></td>
																		<td><div style="background-color:<?= $data['color']?>">&nbsp;<div></td>
																	</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</form>
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
