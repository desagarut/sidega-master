<style>
	.input-sm {
		padding: 4px 4px;
	}
</style>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Pemantauan Bumil</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li>Kesehatan</li>
			<li class="active">Pemantauan Ibu Hamil</li>
		</ol>
	</section>

	<section class="content" id="maincontent">
		<div class="row">
			<div id="kesehatan" class="col-sm-2">
				<?php $this->load->view('kesehatan/bumil/menu') ?>
			</div>
			<div class="col-md-10">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"><strong>Form Pemantauan</strong></h3>
					</div>
					<div class="box-body">
						<form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
							<div class="row">
								<div class="col-sm-4">
									<input type="hidden" id="this_url" value="<?= $this_url ?>">
									<input type="hidden" id="page" name="page" value="<?= $page ?>">

									<div class="form-group">
										<label for="nama" class="col-sm-4 control-label required">NIK/Nama</label>
										<div class="col-sm-8">
											<select class="form-control select2" id="terdata" name="terdata" style="width: 100%;">
												<option value="">-- Silakan Masukan NIK / Nama--</option>
												<?php foreach ($bumil_array as $item) : ?>
													<option value="<?= $item['id'] ?>" data-tgltiba="<?= $item['tanggal_terdaftar'] ?>"> <?= $item['terdata_id'] . " - " . $item['nama'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="tgl_jam" class="col-sm-4 control-label">Tanggal/Jam Input Data</label>
										<div class="col-sm-4">
											<input type="text" class="form-control input-sm" name="tgl_jam" id="tgl_jam" value="<?= $tanggal_pantau; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="tgl_terdaftar" class="col-sm-4 control-label">Tanggal Terdaftar</label>
										<div class="col-sm-4">
											<input type="text" class="form-control input-sm" name="tgl_terdaftar" id="tgl_terdaftar" value="<?= $tgl_terdaftar; ?>" disabled>
										</div>
									</div>
								</div>

								<div class="col-sm-5">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="suhu" class="col-sm-6 control-label required">Suhu Tubuh</label>
												<div class="col-sm-6">
													<input type="text" class="form-control input-sm required" name="suhu" id="suhu" placeholder="36.75">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="bb_pantau" class="col-md-6 control-label required">BB (Kg)</label>
												<div class="col-sm-6">
													<input type="text" class="form-control input-sm required" name="bb_pantau" id="bb_pantau" placeholder="Kg">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="tb_pantau" class="col-md-6 control-label required">TB (Cm)</label>
												<div class="col-sm-6">
													<input type="text" class="form-control input-sm required" name="tb_pantau" id="tb_pantau" placeholder="Cm">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="tekanandarah_pantau" class="col-md-6 control-label required">Tekanan Darah</label>
												<div class="col-sm-6">
													<input type="text" class="form-control input-sm required" name="tekanandarah_pantau" id="tekanandarah_pantau" placeholder="mmHg">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="janin_pantau" class="col-md-6 control-label required">Presentasi Janin</label>
												<div class="col-sm-6">
													<input type="text" class="form-control input-sm required" name="janin_pantau" id="janin_pantau" placeholder="">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="djj_pantau" class="col-md-6 control-label required">Denyut Jantung Janin</label>
												<div class="col-sm-6">
													<input type="text" class="form-control input-sm required" name="djj_pantau" id="djj_pantau" placeholder="">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="tfu_pantau" class="col-md-6 control-label required">Tinggi fundus uteri</label>
												<div class="col-sm-6">
													<input type="text" class="form-control input-sm required" name="tfu_pantau" id="tfu_pantau" placeholder="">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="lila_pantau" class="col-md-6 control-label required">Lila</label>
												<div class="col-sm-6">
													<input type="text" class="form-control input-sm" name="lila_pantau" id="lila_pantau" placeholder="">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="pmt_pantau" class="col-md-6 control-label required">PMT diterima (Kg)</label>
												<div class="col-sm-6">
													<input type="text" class="form-control input-sm" name="pmt_pantau" id="pmt_pantau" placeholder="Kg">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="vita_pantau" class="col-md-6 control-label required">Vitamin</label>
												<div class="col-sm-6">
													<input type="text" class="form-control input-sm" name="vita_pantau" id="vita_pantau" placeholder="">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="ttd_pantau" class="col-md-12 control-label required">Tablet Tambah Darah</label>
										<div class="col-sm-12">
											<input type="text" class="form-control input-sm" name="ttd_pantau" id="ttd_pantau" placeholder="">
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label for="imunisasitetanus_pantau" class="col-md-9 control-label">Imunisasi Tetanus</label>
										<div class="col-sm-3">
											<input type="checkbox" class="form-check-input" name="imunisasitetanus_pantau">
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group">
											<label for="keluhan_lain"></label>
											<textarea name="keluhan_lain" class="form-control input-sm" placeholder="Keluhan Lain" rows="3" style="resize:none;"></textarea>
										</div>
									</div>

								</div>
							</div>
						</form>
					</div>
					<div class="box-footer">
						<div class="box-tools pull-right">
							<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right" onclick="$('#'+'validasi').submit();"><i class="fa fa-check"></i> Simpan</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<!--<a href="<?= site_url("kesehatan_bumil/form_pantau") ?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Form Pantau" title="Form Pantau" class="btn btn-warning btn-box btn-sm"><i class="fa fa-plus"></i>Tambah Data</a>-->
						<a href="<?= site_url("kesehatan_bumil/daftar/cetak/$filter_tgl/$filter_nik") ?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak" target="_blank"><i class="fa fa-print"></i> Cetak</a>
						<a href="<?= site_url("kesehatan_bumil/daftar/unduh/$filter_tgl/$filter_nik") ?>" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh" target="_blank"><i class="fa fa-download"></i> Unduh</a>
						<a href="<?= site_url("kesehatan_bumil/index") ?>" class="btn btn-box btn-info btn-sm" title="Data Bumil"> Kembali ke Data Bumil</a>
					</div>
					<div class="box-body">
						<div class="row">
							<form id="filterform" name="filterform" action="" method="post">

								<div class="col-sm-3">
									<div class="form-group">
										<input type="hidden" id="hidden_unique_date_select" value="<?= $filter_tgl ?>">
										<select class="form-control select2 input-sm" name="unique_date_select" id="unique_date_select" style="width: 100%;">
											<option value="0">-- Pilih Tanggal --</option>
											<?php foreach ($unique_date as $row) : ?>
												<option value="<?= $row[tanggal] ?>"> <?= $row[tanggal] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="col-sm-5">
									<div class="form-group">
										<input type="hidden" id="hidden_unique_nik_select" value="<?= $filter_nik ?>">
										<select class="form-control select2 input-sm" name="unique_nik_select" id="unique_nik_select" style="width: 100%;">
											<option value="0">-- Pilih NIK/Nama --</option>
											<?php foreach ($unique_nik as $row) : ?>
												<option value="<?= $row[id_bumil] ?>"> <?= $row[nik] . " - " . $row[nama] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

							</form>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<form id="mainform" name="mainform" action="" method="post">
										<div class="row">
											<div class="col-sm-12">
												<div class="table-responsive">
													<table class="table table-bordered dataTable table-striped table-hover">
														<thead class="bg-gray disabled color-palette">
															<tr>
																<th>No</th>
																<th>Aksi</th>
																<th>Tgl Terdaftar</th>
																<th>Tgl Pengukuran</th>
																<th>NIK</th>
																<th>Nama</th>
																<th>Usia Saat Pengukuran</th>
																<th>JK</th>
																<th>Suhu</th>
																<th>BB/TB/Lila</th>
																<th>Tekanan Darah</th>
																<th>Presentasi Janin</th>
																<th>Denyut Jantung Janin</th>
																<th>Tinggi Fundus Uteri</th>
																<th>PMT</th>
																<th>Vitamin</th>
																<th>Tablet Tambah Darah</th>
																<th>Imunisasi Tetanus</th>
																<th>Keluhan</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$nomer = $paging->offset;
															foreach ($pantau_bumil_array as $key => $item) :
																$nomer++;
															?>
																<tr>
																	<td align="center" width="2"><?= $nomer; ?></td>
																	<td nowrap>
																		<?php if ($this->CI->cek_hak_akses('h')) : ?>
																			<a href="#" data-href="<?= site_url("$url_delete_front/$item[id]/$url_delete_rare") ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus Data" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a> <?php endif; ?>
																	</td>
																	<td align=center><?= tgl_indo_out($item["tanggal_terdaftar"]) ?></td>
																	<td align=center><?= tgl_indo_out($item["tanggal_jam"]) ?></td>
																	<td><?= $item["nik"] ?></td>
																	<td><?= $item["nama"] ?></td>
																	<td>
																		<?php $lahir    = new DateTime($item['tanggallahir']);
																		$today        = new DateTime($item['tanggal_jam']);
																		$umur = $today->diff($lahir);
																		echo $umur->y;
																		echo " Tahun - ";
																		echo $umur->m;
																		echo " Bulan - ";
																		echo $umur->d;
																		echo " Hari";
																		?>
																	</td>
																	<td><?= ($item["sex"] === '1' ? 'Laki-laki' : 'Perempuan'); ?></td>
																	<td><?= $item["suhu_tubuh"]; ?></td>
																	<td><?= $item["bb_pantau"]; ?>/<?= $item["tb_pantau"]; ?>/<?= $item["lila_pantau"]; ?></td>
																	<td><?= $item["tekanandarah_pantau"]; ?></td>
																	<td><?= $item["janin_pantau"]; ?></td>
																	<td><?= $item["djj_pantau"]; ?></td>
																	<td><?= $item["tfu_pantau"]; ?></td>
																	<td><?= $item["pmt_pantau"]; ?></td>
																	<td><?= $item["vita_pantau"]; ?></td>
																	<td><?= $item["ttd_pantau"]; ?></td>
																	<td><?= ($item["imunisasitetanus_pantau"] === '1' ? 'Ya' : 'Tidak'); ?></td>
																	<td><?= $item["keluhan_lain"]; ?></td>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</form>
									<div class="row">
										<div class="col-sm-6">
											<div class="dataTables_length">
												<form id="paging" action="" method="post" class="form-horizontal">
													<label>
														Tampilkan
														<select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
															<option value="10" <?php selected($per_page, 10); ?>>10</option>
															<option value="100" <?php selected($per_page, 100); ?>>100</option>
															<option value="200" <?php selected($per_page, 200); ?>>200</option>
														</select>
														Dari
														<strong><?= $paging->num_rows ?></strong>
														Total Data
													</label>
												</form>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="dataTables_paginate paging_simple_numbers">
												<ul class="pagination">
													<?php if ($paging->start_link) : ?>
														<li>
															<a href="<?= site_url('kesehatan_bumil/pantau/' . $paging->start_link) ?>" aria-label="First"><span aria-hidden="true">Awal</span></a>
														</li>
													<?php endif; ?>

													<?php if ($paging->prev) : ?>
														<li>
															<a href="<?= site_url('kesehatan_bumil/pantau/' . $paging->prev) ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
														</li>
													<?php endif; ?>

													<?php for ($i = $paging->start_link; $i <= $paging->end_link; $i++) : ?>
														<li <?= jecho($p, $i, "class='active'") ?>>
															<a href="<?= site_url('kesehatan_bumil/pantau/' . $i) ?>"><?= $i ?></a>
														</li>
													<?php endfor; ?>

													<?php if ($paging->next) : ?>
														<li>
															<a href="<?= site_url('kesehatan_bumil/pantau/' . $paging->next) ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
														</li>
													<?php endif; ?>

													<?php if ($paging->end_link) : ?>
														<li>
															<a href="<?= site_url('kesehatan_bumil/pantau/' . $paging->end_link) ?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a>
														</li>
													<?php endif; ?>
												</ul>
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
	</section>
</div>

<?php $this->load->view('global/confirm_delete'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		$("#unique_date_select").val($("#hidden_unique_date_select").val());
		$("#unique_nik_select").val($("#hidden_unique_nik_select").val());

		//https://momentjs.com/docs/#/parsing/string-format/
		$('#tgl_jam').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss',
		});


		function change_arrival_date() {
			var retval = 0;
			if ($("#terdata").val() != "") {
				//	$("#status_covid").val($("#terdata").find(':selected').data('statuscovid'));
				var temp1 = new Date($("#terdata").find(':selected').data('tgltiba'));
				var tgl_terdaftar = new Date(temp1.getFullYear() + "-" + (temp1.getMonth() + 1) + "-" + temp1.getDate());

				var temp2 = new Date($('#tgl_jam').val());
				var tgl_catat = new Date(temp2.getFullYear() + "-" + (temp2.getMonth() + 1) + "-" + temp2.getDate());

				var timediff = tgl_catat - tgl_terdaftar;
				var diffdays = Math.floor(timediff / 86400000);

				$("#tgl_terdaftar").val($("#terdata").find(':selected').data('tgltiba'));

				retval = diffdays;
			} else {
				$("#tgl_terdaftar").val("");
			}

			return retval;
		}

		$("#tgl_terdaftar").val("");
		$("#terdata").change(function() {
			var diff_day = change_arrival_date();

			var tgl_terdaftar = moment().subtract(diff_day, 'days').millisecond(0).second(0).minute(0).hour(0);
			var date_now = moment();

			$('#tgl_jam').data("DateTimePicker").options({
				minDate: tgl_terdaftar,
				//maxDate: date_now
			});
		});

		$('#tgl_jam').on('dp.change', function(e) {
			//var formatedValue = e.date.format(e.date._f);
			change_arrival_date();
		});

		$("#unique_date_select").change(function() {
			url = $("#this_url").val();
			url += "/" + $("#page").val();
			url += "/" + $("#unique_date_select").val();
			url += "/" + $("#unique_nik_select").val();
			$(location).attr('href', url);
		});

		$("#unique_nik_select").change(function() {
			url = $("#this_url").val();
			url += "/" + $("#page").val();
			url += "/" + $("#unique_date_select").val();
			url += "/" + $("#unique_nik_select").val();
			$(location).attr('href', url);
		});

		$("#validasi").validate({
			rules: {
				terdata: "required",
				tgl_jam: "required",
				suhu: {
					required: true,
					number: true,
					min: 10,
					max: 50,
				},
			},
			// Specify validation error messages
			messages: {
				terdata: "Harus memilih NIK/Nama",
				tgl_jam: "Tanggal/Jam harus diisi",
				suhu: {
					required: "Suhu harus tercatat",
					number: "Harus diisi angka",
					min: "Suhu minimal 10 derajat celcius",
					max: "Suhu maksimal 50 derajat celcius",
				},
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	});
</script>