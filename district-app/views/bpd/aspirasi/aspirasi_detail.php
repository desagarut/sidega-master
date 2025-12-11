<script>
	$(function() {
		var keyword = <?= $keyword != '' ? $keyword : '""' ?>;
		$("#cari").autocomplete({
			source: keyword,
			maxShowItems: 10,
		});
	});
</script>
<?php $detail = $buku_aspirasi[0]; ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>BPD - Daftar Buku Aspirasi - Detail <?= $detail['nama']; ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('bpd_buku_aspirasi') ?>"> Daftar Aspirasi</a></li>
			<li class="active">Buku Aspirasi - Detail <?= $detail['nama']; ?></li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" method="post">
			<div class="box box-info">
				<div class="box-header with-border">
					<?php if ($detail["status"] == 1) : ?>
						<div class="btn-group btn-group-vertical">
							<a class="btn btn-social btn-box btn-success btn-sm" data-toggle="dropdown"><i class='fa fa-plus'></i> Tambah Pemberi Aspirasi</a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="<?= site_url("bpd_buku_aspirasi/aksi/1/" . $detail['id']) ?>" class="btn btn-social btn-box btn-block btn-sm" title="Tambah Satu Aspirasi Baru"><i class="fa fa-plus"></i> Tambah Satu Aspirasi Baru</a>
								</li>
								<li>
									<a href="<?= site_url("bpd_buku_aspirasi/aksi/2/" . $detail['id']) ?>" class="btn btn-social btn-box btn-block btn-sm" title="Tambah Beberapa Apsirasi Baru"><i class="fa fa-plus"></i> Tambah Beberapa Aspirasi Baru</a>
								</li>
							</ul>
						</div>
					<?php endif; ?>
					<a href="#confirm-delete" title="Hapus Data Terpilih" onclick="deleteAllBox('mainform', '<?= site_url("bpd_buku_aspirasi/delete_all/$detail[id]") ?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>
					<a href="<?= site_url("bpd_buku_aspirasi/daftar/$detail[id]/cetak") ?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak" target="_blank"><i class="fa fa-print"></i> Cetak
					</a>
					<a href="<?= site_url("bpd_buku_aspirasi/daftar/$detail[id]/unduh") ?>" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh" target="_blank"><i class="fa fa-download"></i> Unduh
					</a>
					<a href="<?= site_url('bpd_buku_aspirasi') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Program Bantuan"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Buku Aspirasi
					</a>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" id="program_id" name="program_id" value="<?= $detail['id'] ?>">
							<?php include('district-app/views/bpd/aspirasi/aspirasi_rincian.php'); ?>
							<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
								<div class="row">
									<div class="col-sm-9">
										<h5><b>Daftar Pemberi Aspirasi</b></h5>
									</div>
									<div class="col-sm-3">
										<form id="mainform" name="mainform" action="" method="post">
											<div class="input-group input-group-sm pull-right with-border">
												<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?= html_escape($cari) ?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action', '<?= site_url("bpd_buku_aspirasi/search/$detail[id]") ?>');$('#'+'mainform').submit();}">
												<div class="input-group-btn">
													<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("bpd_buku_aspirasi/search/$detail[id]") ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
												</div>
											</div>
										</form>
									</div>
									<div class="col-sm-12">
										<?php $peserta = $buku_aspirasi[1]; ?>
										<div class="table-responsive">
											<table class="table table-bordered table-striped dataTable table-hover tabel-daftar">
												<thead class="bg-gray disabled color-palette">
													<tr>
														<th class="padat"><input type="checkbox" id="checkall" /></th>
														<th class="padat">No</th>
														<th class="padat">Aksi</th>
														<th class="padat">Tanggal</th> <!-- Tanggal Kolom 3 -->
														<th nowrap><?= $detail["judul_peserta"] ?></th><!-- Judul Header Kolom 4-->
														<th nowrap>Aspirasi yang Disampaikan</th><!-- kolom 5 -->
														<th nowrap>Tindak Lanjut</th> <!-- kolom 6 -->
														<th nowrap>Dokumentasi</th> <!--kolom 7 -->
													</tr>
												</thead>
												<tbody>
													<?php if (is_array($peserta)) : ?>
														<?php foreach ($peserta as $key => $item) : ?>
															<tr>
																<td class="padat"><input type="checkbox" name="id_cb[]" value="<?= $item['id'] ?>" /></td>
																<td class="padat"><?= ($key + $paging->offset + 1); ?></td>
																<td class="padat">
																	<a href="<?= site_url("bpd_buku_aspirasi/aspirasi_detail_edit_form/$item[id]") ?>" class="btn bg-orange btn-box btn-sm" title="Ubah" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Data Peserta"><i class="fa fa-edit"></i></a>
																	<a href="#" data-href="<?= site_url("bpd_buku_aspirasi/hapus_peserta/$detail[id]/$item[id]") ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																</td>
																<td class="padat"> <!-- Tanggal Kolom 3 -->
																	<?= $item["tanggal"]; ?>
																</td>
																<?php $id_peserta = ($detail['sasaran'] == 4) ? $item['peserta'] : $item['nik'] ?>
																<td width="20%"> <!-- Kolom 4 -->
																	<?= strtoupper($item["peserta_info"]) ?></br>
																	<?= $item["sex"]; 
																		?></br>
																	<a href="<?= site_url("bpd_buku_aspirasi/peserta/$detail[sasaran]/$id_peserta") ?>" title="Profil Pemberi Aspirasi"><?= $item["peserta_nama"] ?></a>
																</td>
																<td width="20%"> <!-- kOLOM 6 -->
																	<?= $item["aspirasiyangdisampaikan"]; ?>
																</td>
																<td width="20%"> <!-- kolom 7 -->
																	<?= $item["tindaklanjut"] ?>
																</td>
																<td nowrap class="padat">
																	<?php if (!empty($item['dokumen'])) : ?>
																		<label data-rel="popover" data-content="<img width=250 height=100 src=<?= base_url() . LOKASI_DOKUMEN ?><?= urlencode($item['dokumen']) ?>>">
																			<a href="<?= site_url("bpd_buku_aspirasi/data_peserta/$item[id]") ?>" title="Data peserta">
																				<img class="img-responsive" src="<?= base_url() . LOKASI_DOKUMEN ?><?= urlencode($item['dokumen']) ?>" alt="foto <?= strtoupper($data['nama']); ?>" title="foto <?= strtoupper($data['nama']); ?>" style="height:70px" /><br />
																			</a>
																		</label>
																	<?php else : ?>
																		Tidak ada dokumentasi
																	<?php endif; ?>
																</td>
															</tr>
														<?php endforeach; ?>
													<?php else : ?>
														<tr>
															<td class="text-center" colspan="13">Data Tidak Tersedia</td>
														</tr>
													<?php endif; ?>
												</tbody>
											</table>
										</div>
										<?php $this->load->view('global/paging'); ?>
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
<?php $this->load->view('global/confirm_delete'); ?>

<?php if ($this->session->flashdata('notif')) : ?>
	<div class='modal fade' id='notif-box' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
					<h4 class='modal-title' id='myModalLabel'> Informasi</h4>
				</div>
				<div class='modal-body'>
					<?php $data = $this->session->flashdata('notif'); ?>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover tabel-rincian">
							<tbody>
								<tr>
									<td width="30%">Data Peserta Gagal</td>
									<td width="1">:</td>
									<td><?= $data['gagal']; ?></td>
								</tr>
								<tr>
									<td>Data Peserta Sukses</td>
									<td> : </td>
									<td><?= $data['sukses']; ?></td>
								</tr>
								<?php if ($data['pesan']) : ?>
									<tr>
										<td>Informasi Tambahan </td>
										<td> : </td>
										<td><?= $data['pesan']; ?></td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(window).on('load', function() {
			$('#notif-box').modal('show');
		});
	</script>
<?php endif; ?>