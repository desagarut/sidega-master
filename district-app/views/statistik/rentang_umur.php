<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Pengaturan Rentang Umur</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url("statistik/clear/13")?>"> Statistik Kependudukan</a></li>
			<li class="active">Pengaturan Rentang Umur</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<div class="col-md-4">
					<?php $this->load->view('statistik/side_menu.php')?>
				</div>
				<div class="col-md-8">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url("statistik/form_rentang/0")?>" class="btn btn-social btn-box bg-olive btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Rentang Umur" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Tambah Rentang Umur">
								<i class="fa fa-plus"></i>Tambah Rentang
							</a>
							<a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform', '<?=site_url("statistik/delete_all_rentang")?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>
							<a href="<?= site_url("statistik/clear/13")?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">
								<i class="fa fa-arrow-circle-left "></i>Kembali ke Data Statistik
							</a>
						</div>
						<div class="box-body">
							<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
								<form id="mainform" name="mainform" action="" method="post">
									<div class="row">
										<div class="col-sm-12">
											<div class="table-responsive">
												<table class="table table-bordered dataTable table-hover">
													<thead class="bg-gray disabled color-palette">
														<tr>
															<th><input type="checkbox" id="checkall"/></th>
															<th>No</th>
															<th>Aksi</th>
															<th width="85%">Rentang</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($main as $no => $data): ?>
														<tr>
															<td><input type="checkbox" name="id_cb[]" value="<?=$data['id']?>" /></td>
															<td class="text-center"><?= $no+1; ?></td>
															<td nowrap>
																<a href="<?=site_url("statistik/form_rentang/$data[id]")?>" class="btn bg-orange btn-box btn-sm"  title="Ubah Rentang Umur" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Rentang Umur"><i class="fa fa-edit"></i></a>
																<a href="#" data-href="<?=site_url("statistik/rentang_delete/$data[id]")?>" class="btn bg-maroon btn-box btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
															</td>
															<td><?= $data['dari']?> - <?= $data['sampai']?> Tahun</td>
														</tr>
														<?php $no++; endforeach; ?>
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
		</form>
	</section>
</div>
<?php $this->load->view('global/confirm_delete');?>
