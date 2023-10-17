
<div class="content-wrapper">
	<section class="content-header">
		<h1>Pengelolaan Data SPPT <?=ucwords($this->setting->sebutan_desa)?> <?= $desa["nama_desa"];?></h1>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?=site_url('data_sppt/clear')?>"> Daftar SPPT</a></li>
			<li class="active">Input/Edit Data SPPT</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-3">
				<?php $this->load->view('data_sppt/menu.php')?>
			</div>
			<div class="col-md-9">
				<div class="box box-info">
					<div class="box-body">
						<div class="box-header with-border">
							<a href="<?= site_url('data_sppt/clear')?>" class="btn btn-social btn-box btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Objek Pajak"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Objek Pajak</a>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<form action="" id="main" name="main" method="POST" class="form-horizontal">
									<div class="box-body">

										<div class="form-group ">
											<label for="jenis_wp" class="col-sm-3 control-label">Kategori Warga</label>
											<div class="btn-group col-sm-8 kiri" data-toggle="buttons">
												<label class="btn btn-info btn-box btn-sm col-sm-3 form-check-label <?php (empty($sppt) or $sppt["jenis_wp"] == 1) and print('active') ?>">
													<input type="radio" name="jenis_wp" class="form-check-input" value="1" autocomplete="off" <?php selected((empty($sppt) or $sppt["jenis_wp"] == 1), true, true)?> onchange="pilih_wp(this.value);">Terdata di SiDeGa
												</label>
												<label class="btn btn-info btn-box btn-sm col-sm-3 form-check-label <?= ($sppt["jenis_wp"] == 2) and print('active') ?>">
													<input type="radio" name="jenis_wp" class="form-check-input" value="2" autocomplete="off" <?php selected(($sppt["jenis_wp"] == 2), true, true)?> onchange="pilih_wp(this.value);">Tidak Terdata di SiDeGa
												</label>
											</div>
										</div>

										<div id="warga_desa">
											<div class="form-group">
												<label class="col-sm-3 control-label" >Cari Nama/Alamat Tagih</label>
												<div class="col-sm-8">
													<select class="form-control input-sm select2" style="width: 100%;" id="nik" name="nik" onchange="ubah_wajib_pajak($('#jenis_wp').val());">
														<option value="">-- Silakan Masukan NIK / Nama --</option>
														<?php foreach ($penduduk as $item): ?>
															<option value="<?= $item['id']?>" <?php selected($wajib_pajak['nik'], $item['id'])?>>Nama : <?= $item['nama']." Alamat : ".$item['info']?></option>
														<?php endforeach;?>
													</select>
												</div>
											</div>
											<?php if ($wajib_pajak): ?>
												<div class="form-group">
													<label for="nama" class="col-sm-3 control-label">Wajib Pajak</label>
													<div class="col-sm-8">
														<div class="form-group">
															<label class="col-sm-3 control-label">Nama Penduduk</label>
															<div class="col-sm-9">
																<input  class="form-control input-sm" type="text" placeholder="Nama Wajib Pajak" value="<?= $wajib_pajak["nama"] ?>" disabled >
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-3 control-label">NIK Wajib Pajak</label>
															<div class="col-sm-9">
																<input  class="form-control input-sm" type="text" placeholder="NIK Wajib Pajak" value="<?= $wajib_pajak["nik"] ?>" disabled >
															</div>
														</div>
														<div class="form-group">
															<label for="alamat"  class="col-sm-3 control-label">Alamat Wajib Pajak</label>
															<div class="col-sm-9">
																<textarea  class="form-control input-sm" placeholder="Alamat Wajib Pajak" disabled><?= "RT ".$wajib_pajak["rt"]." / RT ".$wajib_pajak["rw"]." - ".strtoupper($wajib_pajak["dusun"]) ?></textarea>
															</div>
														</div>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</form>
								<form name='mainform' action="<?= site_url('data_sppt/simpan_sppt')?>" method="POST"  id="validasi" class="form-horizontal">
									<div class="box-body">
										<input id="jenis_wp" name="jenis_wp" type="hidden" value="1">
										<input type="hidden" name="nik_lama" value="<?= $wajib_pajak["nik_lama"] ?>"/>
										<input type="hidden" name="nik" value="<?= $wajib_pajak["nik"] ?>"/>
										<input type="hidden" name="id_pend" value="<?= $wajib_pajak["id"] ?>"/>
										<?php if ($sppt): ?>
											<input type="hidden" name="id" value="<?= $sppt["id"] ?>"/>
										<?php endif; ?>
										<input type="hidden" name="data_sppt" value="<?= $sppt["data_sppt"] ?>"/>

										<div id="warga_luar_desa">
											<div class="form-group">
												<label for="data_sppt"  class="col-sm-3 control-label">Nama Wajib Pajak <span style="color:red">*</span></label>
												<div class="col-sm-9">
													<input class="form-control input-sm nama required" type="text" placeholder="Nama Wajib Pajak Luar" id="nama_wp_luar" name="nama_wp_luar" value="<?= ($sppt["nama_wp_luar"])?>" <?php $wajib_pajak and print('disabled') ?>>
												</div>
											</div>
											<div class="form-group">
												<label for="data_sppt"  class="col-sm-3 control-label">Alamat Wajib Pajak <span style="color:red">*</span></label>
												<div class="col-sm-9">
													<input class="form-control input-sm required" type="text" placeholder="Alamat Wajib Pajak Luar" id="alamat_wp_luar" name="alamat_wp_luar" value="<?= ($sppt["alamat_wp_luar"])?>" <?php $wajib_pajak and print('disabled') ?>>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="data_sppt"  class="col-sm-3 control-label">Tahun Awal Data Pajak <span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input class="form-control input-sm angka required" type="text" placeholder="Tahun Awal Data Pajak" name="tahun_awal" value="<?= ($sppt["tahun_awal"])?>">
											</div>
										</div>
										<div class="form-group">
											<label for="data_sppt"  class="col-sm-3 control-label">Nomor Objek Pajak <span style="color:red">*</span></label>
											<div class="col-sm-4">
												<input class="form-control input-sm angka_titik required" type="text" placeholder="Nomor Objek Pajak" name="data_sppt" value="<?= ($sppt["nomor"])?>" <?php !($wajib_pajak or $sppt['jenis_wp'] == 2) and print('disabled') ?>>
											</div>
										</div>
										<div class="form-group">
											<label for="sppt"  class="col-sm-3 control-label">Nama Wajib Pajak Tertulis di SPPT <span style="color:red">*</span></label>
											<div class="col-sm-9">
												<input class="form-control input-sm nama required" type="text" placeholder="Nama wajib_pajak sebagaimana tertulis di SPPT PBB" name="nama_wp" value="<?= ($sppt["nama_wp"])?sprintf("%04s", $sppt["nama_wp"]): NULL ?>" <?php !($wajib_pajak or $sppt['jenis_wp'] == 2) and print('disabled') ?>>
											</div>
										</div>
										<div class="form-group">
											<label for="letak_op"  class="col-sm-3 control-label">Letak Objek Pajak <span style="color:red">*</span></label>
											<div class="col-sm-9">
												<input class="form-control input-sm alamat required" type="text" placeholder="Letak Objek Pajak" name="letak_op" value="<?= ($sppt["letak_op"])?>" >
											</div>
										</div>
										<div class="form-group">
											<label for="nama_wp"  class="col-sm-3 control-label">Objek Bumi :</label>
											<div class="col-sm-9">
                                                <div class="col-sm-3">
                                            	<label for="nama_wp"  class="control-label">Luas per Meter </label>
												<input class="form-control input-sm angka " type="text" placeholder="Meter persegi" name="luas_tanah" value="<?= ($sppt["luas_tanah"])?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">Kelas </label>
												<input class="form-control input-sm angka " type="text" placeholder="Angka" name="kelas_tanah" value="<?= ($sppt["kelas_tanah"])?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">NJOP per Meter </label>
												<input class="form-control input-sm" type="text" placeholder="Rupiah" name="pajak_tanah" value="<?= ($sppt["pajak_tanah"])?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">Total </label>
												<input class="form-control input-sm" type="text" placeholder="Rupiah" name="total_pajak_tanah" value="<?= ($sppt["total_pajak_tanah"])?>" >
                                                </div>
                                            </div>
										</div>
										<div class="form-group">
											<label for="nama_wp"  class="col-sm-3 control-label">Objek Bangunan :</label>
											<div class="col-sm-9">
                                                <div class="col-sm-3">
                                            	<label for="nama_wp"  class="control-label">Luas per Meter</label>
												<input class="form-control input-sm angka" type="text" placeholder="Meter persegi" name="luas_bangunan" value="<?= ($sppt["luas_bangunan"])?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">Kelas </label>
												<input class="form-control input-sm angka " type="text" placeholder="Angka" name="kelas_bangunan" value="<?= ($sppt["kelas_bangunan"])?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">PNJOP per Meter </label>
												<input class="form-control input-sm" type="text" placeholder="Rupiah" name="pajak_bangunan" value="<?= ($sppt["pajak_bangunan"])?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">Total </label>
												<input class="form-control input-sm" type="text" placeholder="Rupiah" name="total_pajak_bangunan" value="<?= ($sppt["total_pajak_bangunan"])?>" >
                                                </div>
                                            </div>
										</div>
										<div class="form-group">
											<label for="nama_wp"  class="col-sm-3 control-label">Nilai Jual Objek Pajak (NJOP) :</label>
											<div class="col-sm-9">
                                                <div class="col-sm-3">
                                            	<label for="nama_wp"  class="control-label">Dasar Pengenaan PBB</label>
												<input class="form-control input-sm" type="text" placeholder="Rupiah" name="dp_pbb" value="<?= ($sppt["dp_pbb"])?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">NJOP Tidak Kena Pajak </label>
												<input class="form-control input-sm" type="text" placeholder="Rupiah" name="njop_tkp" value="<?= ($sppt["njop_tkp"])?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">NJOP perhitungan PBB</label>
												<input class="form-control input-sm" type="text" placeholder="Rupiah" name="njop_ppbb" value="<?= ($sppt["njop_ppbb"])?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">PBB Terhutang  <span style="color:red">*</span></label>
												<input class="form-control input-sm required" type="text" placeholder="Rupiah" name="pbb_terhutang" value="<?= ($sppt["pbb_terhutang"])?>" >
                                                </div>
                                            </div>
										</div>
									</div>
									<div class="box-footer">
										<div class="col-xs-12">
											<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right"data-target="#confirm-delete"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
	$(document).ready(function(){
		$('#tipe').change(function(){
			var id=$(this).val();
			$.ajax({
				url : "<?=site_url('data_sppt/kelasid')?>",
				method : "POST",
				data : {id: id},
				async : true,
				dataType : 'json',
				success: function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html += '<option value='+data[i].id+'>'+data[i].kode+' '+data[i].ndesc+'</option>';
					}
					$('#kelas').html(html);
				}
			});
			return false;
		});

		pilih_wp(<?= $sppt['jenis_wp'] ?: 1?>);

	});

	function pilih_lokasi(pilih)
	{
		if (pilih == 1)
		{
			$("#manual").hide();
			$("#pilih").show();
		}
		else
		{
			$("#manual").removeClass('hidden');
			$("#manual").show();
			$("#pilih").hide();
		}
	}

	function pilih_wp(pilih)
	{
		$('#jenis_wp').val(pilih);
		if (pilih == 1)
		{
			if ($('#nik').val() == '')
			{
				$('input[name=data_sppt]').attr('disabled','disabled');
				$('input[name=nama_wp]').attr('disabled','disabled');
			}
			$('#nama_wp_luar').val('');
			$('#nama_wp_luar').removeClass('required');
			$('#alamat_wp_luar').val('');
			$('#alamat_wp_luar').removeClass('required');
			$("#warga_luar_desa").hide();
			$('#nik').addClass('required');
			$("#warga_desa").show();
		}
		else
		{
			$('#nik').removeClass('required');
			$("#warga_desa").hide();
			$("#warga_luar_desa").show();
			$('#nama_wp_luar').addClass('required');
			$('#alamat_wp_luar').addClass('required');
			$('input[name=data_sppt]').removeAttr('disabled');
			$('input[name=nama_wp]').removeAttr('disabled');
			if ($('#nik').val() != '')
			{
				$('#nik').val('');
				$('#nik').change();
			}
		}
	}

	function ubah_wajib_pajak(jenis_wp)
	{
		$('#main').submit();
	}
</script>

