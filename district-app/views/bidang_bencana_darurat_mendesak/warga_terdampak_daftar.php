<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>
	$(function()
	{
		var keyword = <?= $keyword?> ;
		$( "#cari" ).autocomplete(
		{
			source: keyword,
			maxShowItems: 10,
		});
	});
</script>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Warga Terdampak</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('bidang_bencana_darurat_mendesak')?>"> Daftar Laporan Kejadian</a></li>
			<li class="active">Warga Terdampak</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<!--<a href="<?= site_url("bidang_bencana_darurat_mendesak/form_warga_terdampak/$bidang_bencana_darurat_mendesak[id]")?>" title="Tambah Data Warga" class="btn btn-social btn-box bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-plus"></i> Tambah Data Warga</a>
				<a href="<?= site_url("bidang_bencana_darurat_mendesak/dialog_daftar/$bidang_bencana_darurat_mendesak[id]/cetak")?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data <?= $sasaran[$bidang_bencana_darurat_mendesak["sasaran"]]; ?> "><i class="fa fa-print "></i> Cetak</a>
				<a href="<?= site_url("bidang_bencana_darurat_mendesak/dialog_daftar/$bidang_bencana_darurat_mendesak[id]/unduh")?>" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data <?= $sasaran[$bidang_bencana_darurat_mendesak["sasaran"]]; ?> "><i class="fa fa-download "></i> Unduh</a>-->
				<a href="<?= site_url("bidang_bencana_darurat_mendesak")?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali">
					<i class="fa fa-arrow-circle-left "></i>Kembali
				</a>
			</div>
			<?php $this->load->view('bidang_bencana_darurat_mendesak/kejadian_rincian'); ?>
			<div class="box-body">
				<h5><b>Daftar Warga Terdampak Bencana</b></h5>
				<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
					<form id="mainform" name="mainform" action="" method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="input-group input-group-sm pull-right">
									<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=html_escape($cari)?>" value="<?= $cari ?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action', '<?=site_url("bidang_bencana_darurat_mendesak/filter/cari")?>');$('#'+'mainform').submit();}">
									<div class="input-group-btn">
										<button type="submit" class="btn btn-default" value="<?= $cari ?>" onclick="$('#'+'mainform').attr('action', '<?=site_url("bidang_bencana_darurat_mendesak/filter/cari")?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
								<thead class="bg-gray disabled color-palette">
									<tr>
										<th>No</th>
										<th>Aksi</th>
										<th><?= $judul['judul_warga_info']; ?></th>
										<th><?= $judul['judul_warga_plus']; ?> </th>
										<th><?= $judul['judul_warga_nama']; ?></th>
										<th>Tempat Lahir</th>
										<th>Tanggal Lahir</th>
										<th>Jenis-kelamin</th>
										<th>Alamat</th>
										<th>Keterangan</th>
									</tr>
								</thead>
								<tbody>
									<?php if($peserta): ?>
										<?php foreach ($peserta as $key => $item): ?>
											<tr>
												<td class="padat"><?= ($key + $paging->offset + 1); ?></td>
												<td class="aksi">
													<?php if ($this->CI->cek_hak_akses('h')): ?>
														<a href="<?= site_url("bidang_bencana_darurat_mendesak/edit_warga_form/$item[id]"); ?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah peserta" title="Ubah peserta" class="btn btn-warning btn-box btn-sm"><i class="fa fa-edit"></i></a>
														<a href="#" data-href="<?= site_url("bidang_bencana_darurat_mendesak/hapus_peserta/$bidang_bencana_darurat_mendesak[id]/$item[id]"); ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus Data" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
													<?php endif; ?>
												</td>
												<td nowrap><?= $item["peserta_info"]; ?></td>
												<td nowrap><a href="<?= site_url("bidang_bencana_darurat_mendesak/peserta/$bidang_bencana_darurat_mendesak[sasaran]/$item[id_peserta]"); ?>" title="Daftar bidang_bencana_darurat_mendesak untuk peserta"><?= $item["peserta_plus"]; ?></a></td>
												<td nowrap><a href="<?= site_url("bidang_bencana_darurat_mendesak/data_peserta/$item[id]"); ?>" title="Data peserta"><?= $item['peserta_nama'];?></a></td>
												<td><?= $item["tempat_lahir"]; ?></td>
												<td nowrap><?= $item["tanggal_lahir"]; ?></td>
												<td nowrap><?= $item["sex"]; ?></td>
												<td nowrap><?= $item["info"];?></td>
												<td width="25%"><?= $item["keterangan"]; ?></td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td class="text-center" colspan="10">Data Tidak Tersedia</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</form>
					<?php $this->load->view('global/paging');?>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('global/confirm_delete');?>
