<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Suplemen <?= ($set_sasaran == 0)? '' : "Sasaran $sasaran[$set_sasaran]"; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda'); ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Data Suplemen</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="box box-info">
				<div class="box-header with-border">
					<a href="<?=site_url('suplemen/form')?>" class="btn btn-social btn-box bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Suplemen Baru"><i class="fa fa-plus"></i> Tambah Suplemen Baru</a>
					<a href="<?=site_url('suplemen/panduan')?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Program Bantuan Baru"><i class="fa fa-question-circle"></i> Panduan</a>
				</div>
				<div class="box-body">
					<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
						<form id="mainform" name="mainform" action="" method="post">
							<select class="form-control input-sm" name="sasaran" onchange="formAction('mainform', '<?= site_url('suplemen'); ?>')">
								<option value="">Pilih Sasaran</option>
								<?php foreach ($list_sasaran AS $key => $value): ?>
									<?php if (in_array($key, ['1', '2'])) : ?>
										<option value="<?= $key; ?>" <?= selected($set_sasaran, $key); ?>><?= $value?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</form>
						<div class="table-responsive">
							<table class="table table-bordered table-striped dataTable table-hover tabel-daftar">
								<thead class="bg-gray disabled color-palette">
									<tr>
										<th>No</th>
										<th>Aksi</th>
										<th>Nama Data</th>
										<th>Jumlah Terdata</th>
										<th>Sasaran</th>
										<th>Keterangan</th>
									</tr>
								</thead>
								<tbody>
									<?php if ($suplemen): ?>
										<?php	foreach ($suplemen as $key => $item):	?>
											<tr>
												<td class="padat"><?= ($key + 1); ?></td>
												<td class="aksi">
													<a href="<?= site_url("suplemen/clear/$item[id]"); ?>" class="btn bg-purple btn-box btn-sm" title="Rincian Data"><i class="fa fa-list-ol"></i></a>
													<a href="<?= site_url("suplemen/form/$item[id]"); ?>" class="btn bg-orange btn-box btn-sm" title="Ubah Data"><i class='fa fa-edit'></i></a>
													<a
														<?php if ($item['jml'] <= 0): ?>
															href="#" data-href="<?= site_url("suplemen/hapus/$item[id]")?>" data-toggle="modal" data-target="#confirm-delete"
														<?php endif; ?>
														class="btn bg-maroon btn-box btn-sm" title="Hapus" <?= jecho($item['jml'] > 0, true, 'disabled'); ?>><i class="fa fa-trash-o"></i>
													</a>
												</td>
												<td width="20%"><a href="<?= site_url("suplemen/rincian/$item[id]"); ?>"><?= $item["nama"] ?></a></td>
												<td class="padat"><?= $item['jml']?></td>
												<td class="nostretch"><?= $sasaran[$item["sasaran"]]?></td>
												<td><?= $item['keterangan']?></td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td class="text-center" colspan="6">Data Tidak Tersedia</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<?php $this->load->view('global/confirm_delete');?>
