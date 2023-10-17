<script>
	$(function() {
		var keyword = <?= $keyword?> ;
		$( "#cari" ).autocomplete( {
			source: keyword,
			maxShowItems: 10,
		});
	});
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Wilayah Administratif <?= ucwords($this->setting->sebutan_dusun)?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Daftar <?= ucwords($this->setting->sebutan_dusun)?></li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
                    <?php if ($this->CI->cek_hak_akses('h')): ?>
						<a href="<?= site_url('sid_core/form')?>" class="btn btn-social btn-box btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Data"><i class="fa fa-plus"></i> Tambah Dusun</a>
					<?php endif; ?>
                        <a href="<?= site_url("$this->controller/dialog/cetak")?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Data" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data"><i class="fa fa-print "></i> Cetak</a>
						<a href="<?= site_url("$this->controller/dialog/unduh")?>" title="Unduh Data" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh Data" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data"><i class="fa fa-download"></i> Unduh</a>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<form id="mainform" name="mainform" action="" method="post">
										<div class="row">
											<div class="col-sm-12">
												<div class="box-tools">
                                                
													<div class="input-group input-group-sm pull-right">
														<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=html_escape($cari)?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action','<?= site_url('sid_core/search')?>');$('#'+'mainform').submit();};">
														<div class="input-group-btn">
															<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action','<?= site_url("sid_core/search")?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
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
																<th class="padat">No</th>
																<th wlass="padat">Aksi</th>
																<th width="25%"> <?= ucwords($this->setting->sebutan_dusun)?></th>
																<th width="35%">Kepala <?= ucwords($this->setting->sebutan_dusun)?></th>
																<th class="text-center">RW</th>
																<th class="text-center">RT</th>
																<th class="text-center">KK</th>
																<th class="text-center">L+P</th>
																<th class="text-center">L</th>
																<th class="text-center">P</th>
															</tr>
														</thead>
														<tbody>
															<?php
																$total = array();
																$total['total_rw'] = 0;
																$total['total_rt'] = 0;
																$total['total_kk'] = 0;
																$total['total_warga'] = 0;
																$total['total_warga_l'] = 0;
																$total['total_warga_p'] = 0;
																foreach ($main as $data):
															?>
															<tr>
																<td class="no_urut"><?= $data['no']?></td>
																<td nowrap>
																	<a href="<?= site_url("sid_core/sub_rw/$data[id]")?>" class="btn bg-purple btn-box btn-sm" title="Rincian Sub Wilayah"><i class="fa fa-search"></i> RW</a>
																	<?php if ($this->CI->cek_hak_akses('h')): ?>
                                                                    <a href="<?= site_url("sid_core/form/$data[id]")?>" class="btn bg-orange btn-box btn-sm" title="Ubah"><i class="fa fa-edit"></i></a>
                                                                    <a href="#" data-href="<?= site_url("sid_core/delete/dusun/$data[id]")?>" class="btn bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                                                                    <a href="<?= site_url("sid_core/ajax_kantor_dusun_maps_google/$data[id]")?>" class="btn btn-info btn-box btn-sm" title="Lokasi Kantor"><i class="fa fa-map-marker"></i></a>
                                                                    <a href="<?= site_url("sid_core/ajax_wilayah_dusun_maps_google/$data[id]")?>" class="btn btn-primary btn-box btn-sm" title="Peta Google"><i class="fa fa-google"></i></a>
                                                                    <a href="<?= site_url("sid_core/ajax_wilayah_dusun_openstreet_maps/$data[id]")?>" class="btn btn-info btn-box btn-sm" title="Peta Openstreet"><i class="fa fa-map-o"></i></a>
																	<?php endif; ?>
																</td>
																<td><?= strtoupper($data['dusun'])?></td>
																<td nowrap><strong><?= strtoupper($data['nama_kadus'])?></strong> - <?= $data['nik_kadus']?></td>
																<td class="bilangan"><a href="<?= site_url("sid_core/sub_rw/$data[id]")?>" title="Rincian Sub Wilayah"><?= $data['jumlah_rw']?></a></td>
																<td class="bilangan"><?= $data['jumlah_rt']?></td>
																<td class="bilangan"><a href="<?= site_url("sid_core/warga_kk/$data[id]")?>"><?= $data['jumlah_kk']?></a></td>
																<td class="bilangan"><a href="<?= site_url("sid_core/warga/$data[id]")?>"><?= $data['jumlah_warga']?></a></td>
																<td class="bilangan"><a href="<?= site_url("sid_core/warga_l/$data[id]")?>"><?= $data['jumlah_warga_l']?></a></td>
																<td class="bilangan"><a href="<?= site_url("sid_core/warga_p/$data[id]")?>"><?= $data['jumlah_warga_p']?></a></td>
															</tr>
															<?php
																$total['total_rw'] += $data['jumlah_rw'];
																$total['total_rt'] += $data['jumlah_rt'];
																$total['total_kk'] += $data['jumlah_kk'];
																$total['total_warga'] += $data['jumlah_warga'];
																$total['total_warga_l'] += $data['jumlah_warga_l'];
																$total['total_warga_p'] += $data['jumlah_warga_p'];
																endforeach;
															?>
														</tbody>
														<tfoot>
															<tr>
																<th colspan="4"><label>TOTAL</label></th>
																<th class="bilangan"><?= $total['total_rw']?></th>
																<th class="bilangan"><?= $total['total_rt']?></th>
																<th class="bilangan"><?= $total['total_kk']?></th>
																<th class="bilangan"><?= $total['total_warga']?></th>
																<th class="bilangan"><?= $total['total_warga_l']?></th>
																<th class="bilangan"><?= $total['total_warga_p']?></th>
															</tr>
														</tfoot>
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
	</section>
</div>
<?php $this->load->view('global/confirm_delete');?>
<script src="<?= base_url()?>assets/js/jquery.validate.min.js"></script>
<script src="<?= base_url()?>assets/js/validasi.js"></script>
<script src="<?= base_url()?>assets/js/localization/messages_id.js"></script>


