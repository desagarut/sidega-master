<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
SIDEGA
 */
?>

<script>
	$( function() {
		$( "#cari" ).autocomplete( {
			source: function( request, response ) {
				$.ajax( {
					type: "POST",
					url: '<?= site_url("ba_penduduk_rekapitulasi/autocomplete"); ?>',
					dataType: "json",
					data: {
						cari: request.term
					},
					success: function( data ) {
						response( JSON.parse( data ));
					}
				} );
			},
			minLength: 2,
		} );
	} );
</script>
<?php if ($tgl_lengkap && $tgl_lengkap_aktif == 1): ?>
<div class="box box-info">
	<div class="box-header with-border">
		<a href="<?= site_url($this->controller."/ajax_cetak/cetak"); ?>" class="btn btn-social btn-flat bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Buku Rekapitulasi Penduduk" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Buku Rekapitulasi Penduduk"><i class="fa fa-print "></i> Cetak</a>
		<a href="<?= site_url($this->controller."/ajax_cetak/unduh"); ?>?>" title="Unduh Buku Rekapitulasi Penduduk" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh Buku Mutasi Penduduk" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Buku Rekapitulasi Penduduk"><i class="fa fa-download"></i> Unduh</a>
		<a href="<?= site_url($this->controller."/clear") ?>" class="btn btn-social btn-flat bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-refresh"></i>Bersihkan</a>
	</div>
	<div class="box-body">
		<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
			<form id="mainform" name="mainform" action="" method="post">
				<div class="row">
					<div class="col-sm-9">
						<select class="form-control input-sm " name="filter_tahun" onchange="formAction('mainform','<?= site_url($this->controller.'/filter/filter_tahun')?>')">
							<?php for ($t=$tahun_lengkap; $t<=date("Y"); $t++): ?>
              	<option value=<?= $t ?> <?php selected($tahun, $t); ?>><?= $t ?></option>
              <?php endfor; ?>
						</select>
						<select class="form-control input-sm" name="filter_bulan" onchange="formAction('mainform','<?= site_url($this->controller.'/filter/filter_bulan')?>')" width="100%">
							<?php foreach (bulan() as $idx => $nama_bulan): ?>
								<option value="<?= $idx?>" <?php selected($bulan, $idx); ?>><?= $nama_bulan?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-3">
						<div class="input-group input-group-sm pull-right">
							<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" title="Pencarian berdasarkan nama penduduk" value="<?=html_escape($cari); ?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action', '<?= site_url("ba_penduduk_rekapitulasi/filter/cari"); ?>');$('#'+'mainform').submit();}">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("ba_penduduk_rekapitulasi/filter/cari"); ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive table-min-height">
					<table class="table table-condensed table-bordered dataTable table-striped table-hover tabel-daftar">
						<thead class="bg-gray color-palette">
							<tr>
								<th rowspan="4">Nomor Urut</th>
								<th rowspan="4">Nama Dusun / Lingkungan</th>
								<th colspan="7">Jumlah Penduduk Awal Bulan</th>
								<th colspan="8">Tambahan Bulan Ini</th>
								<th colspan="8">Pengurangan Bulan Ini</th>
								<th rowspan="2" colspan="7">Jml Penduduk Akhir Bulan</th>
								<th rowspan="4">Ket</th>
							</tr>
							<tr>
								<th colspan="2">WNA</th>
								<th colspan="2">WNI</th>
								<th rowspan="3">Jlh KK</th>
								<th rowspan="3">Jml Anggota Keluarga</th>
								<th rowspan="3">Jml Jiwa (7+8)</th>
								<th colspan="4">Lahir</th>
								<th colspan="4">Datang</th>
								<th colspan="4">Meninggal</th>
								<th colspan="4">Pindah</th>
							</tr>
							<tr>
								<th rowspan="2">L</th>
								<th rowspan="2">P</th>
								<th rowspan="2">L</th>
								<th rowspan="2">P</th>
								<th colspan="2">WNA</th>
								<th colspan="2">WNI</th>
								<th colspan="2">WNA</th>
								<th colspan="2">WNI</th>
								<th colspan="2">WNA</th>
								<th colspan="2">WNI</th>
								<th colspan="2">WNA</th>
								<th colspan="2">WNI</th>
								<th colspan="2">WNA</th>
								<th colspan="2">WNI</th>
								<th rowspan="2">Jml KK</th>
								<th rowspan="2">Jml Anggota Keluarga</th>
								<th rowspan="2">Jml Jiwa (30+31)</th>
							</tr>
							<tr>
								<th>L</th>
								<th>P</th>
								<th>L</th>
								<th>P</th>
								<th>L</th>
								<th>P</th>
								<th>L</th>
								<th>P</th>
								<th>L</th>
								<th>P</th>
								<th>L</th>
								<th>P</th>
								<th>L</th>
								<th>P</th>
								<th>L</th>
								<th>P</th>
								<th>L</th>
								<th>P</th>
								<th>L</th>
								<th>P</th>
							</tr>
							<tr class="border thick">
								<?php for ($i = 1; $i<=33; $i++): ?>
									<th><?= $i ?></th>
								<?php endfor; ?>
							</tr>
						</thead>
						<tbody>
							<?php if ($main): ?>
								<?php foreach ($main as $key => $data): ?>
									<tr>
										<td class="padat"><?= ($key + $paging->offset + 1); ?></td>
										<td><?= strtoupper($data['DUSUN'])?></td>
										<td><?= show_zero_as($data['WNA_L_AWAL'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_P_AWAL'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_L_AWAL'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_P_AWAL'],'-') ?></td>
										<td><?= show_zero_as($data['KK_JLH'],'-') ?></td>
										<td><?= show_zero_as($data['KK_ANG_KEL'],'-') ?></td>
										<td><?= show_zero_as($data['KK_JLH']+$data['KK_ANG_KEL'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_L_TAMBAH_LAHIR'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_P_TAMBAH_LAHIR'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_L_TAMBAH_LAHIR'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_P_TAMBAH_LAHIR'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_L_TAMBAH_MASUK'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_P_TAMBAH_MASUK'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_L_TAMBAH_MASUK'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_P_TAMBAH_MASUK'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_L_KURANG_MATI'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_P_KURANG_MATI'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_L_KURANG_MATI'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_P_KURANG_MATI'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_L_KURANG_KELUAR'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_P_KURANG_KELUAR'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_L_KURANG_KELUAR'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_P_KURANG_KELUAR'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_L_AKHIR'],'-') ?></td>
										<td><?= show_zero_as($data['WNA_P_AKHIR'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_L_AKHIR'],'-') ?></td>
										<td><?= show_zero_as($data['WNI_P_AKHIR'],'-') ?></td>
										<td><?= show_zero_as($data['KK_AKHIR_JML'],'-') ?></td>
										<td><?= show_zero_as($data['KK_AKHIR_ANG_KEL'],'-') ?></td>
										<td><?= show_zero_as($data['KK_AKHIR_JML']+$data['KK_AKHIR_ANG_KEL'],'-') ?></td>
										<td>-</td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td class="text-center" colspan="33">Data Tidak Tersedia</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</form>
			<?php $this->load->view('global/paging'); ?>
		</div>
	</div>
</div>
<?php else: ?>
	<div class="box box-info">
		<div class="box-header with-border">
		</div>
		<div class="box-body">
			<div class="alert alert-warning">
				Buku Rekapitulasi Penduduk masih dalam proses dilengkapi.<br>
				Buka <a href="<?=site_url('setting')?>">Pengaturan > Aplikasi</a> untuk melengkapi tanggal lengkap data.
			</div>
		</div>
	</div>
<?php endif; ?>