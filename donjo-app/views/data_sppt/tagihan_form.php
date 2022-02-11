<script type="text/javascript">

       var pbb_terhutang = "<?php echo $pbb_terhutang ?>"
       var denda = "<?php echo $denda ?>"
       var iuran = "<?php echo $iuran ?>"

      function hitung()
      {
        var pbb_terhutang = document.getElementById('pbb_terhutang').value;
        var denda = document.getElementById('denda').value;
        var iuran = document.getElementById('iuran').value;

        var result = (parseInt(pbb_terhutang) ) + (parseInt(denda)) + (parseInt(iuran));
        if (!isNaN(result)) {
           document.getElementById('total_tagih').value = result;
        }
      }
</script>	  

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
							<a href="<?= site_url('data_sppt/clear_tagih')?>" class="btn btn-social btn-box btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Objek Pajak"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Objek Pajak</a>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<form action="" id="main" name="main" method="POST" class="form-horizontal">
									<div class="box-body">
										<div id="warga_desa">
											<?php if ($wajib_pajak): ?>
                                            <div class="col-sm-8">
                                                <h4><strong>Data Tagihan</strong></h4>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Nama Wajib Pajak</label>
                                                    <div class="col-sm-9">
                                                        <input  class="form-control input-sm" type="text" placeholder="Nama Wajib Pajak" value="<?= $wajib_pajak["nama"] ?>" readonly="readonly" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Nomor Objek Pajak</label>
                                                    <div class="col-sm-9">
                                                        <input  class="form-control input-sm" type="text" placeholder="NIK Wajib Pajak" value="<?= $wajib_pajak["nik"] ?>" readonly="readonly" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat"  class="col-sm-3 control-label">Letak Objek Pajak</label>
                                                    <div class="col-sm-9">
                                                        <textarea  class="form-control input-sm" placeholder="Alamat Wajib Pajak" readonly="readonly"><?= "RT ".$wajib_pajak["rt"]." / RT ".$wajib_pajak["rw"]." - ".strtoupper($wajib_pajak["dusun"]) ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-responsive">
                                            	<tr>
                                                	<td>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th align="center">Pajak</th>
                                                                <th align="center">Bumi</th>
                                                                <th align="center">Bangunan</th>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">Luas/m<sup>2</sup></td>
                                                                <td align="right"><?= ($sppt["luas_tanah"])?> m<sup>2</sup></td>
                                                                <td align="right"><?= ($sppt["luas_bangunan"])?> m<sup>2</sup></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">Kelas </td>
                                                                <td align="center"><?= ($sppt["kelas_tanah"])?></td>
                                                                <td align="center"><?= ($sppt["kelas_bangunan"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">NJOP/m<sup>2</sup></td>
                                                                <td align="right"><?= rupiah($sppt["pajak_tanah"])?></td>
                                                                <td align="right"><?= rupiah($sppt["pajak_bangunan"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">Total </td> 
                                                                <td align="right"><?= (rupiah($sppt["total_pajak_tanah"]))?></td>
                                                                <td align="right"><?= rupiah($sppt["total_pajak_bangunan"])?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th colspan="2" align="center">Nilai Jual Objek Pajak (NJOP)</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Dasar Pengenaan PBB</td>
                                                                <td align="right"><?= rupiah($sppt["dp_pbb"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>NJOP Tidak Kena Pajak </td>
                                                                <td align="right"><?= rupiah($sppt["njop_tkp"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>NJOP perhitungan PBB</td>
                                                                <td align="right"><?= rupiah($sppt["njop_ppbb"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>PBB Terhutang (awal)</td>
                                                                <td align="right"><strong style="color:#F00"><?= rupiah($sppt["pbb_terhutang"])?></strong></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
											<?php endif; ?>
										</div>
									</div>
								</form>
                                
								<form name='mainform' action="<?= site_url('data_sppt/simpan_tagihan')?>" method="POST"  id="validasi" class="form-horizontal">
									<div class="box-body">
										<input id="nomor" name="nomor" type="hidden" value="<?= ($sppt["nomor"])?>">
										<input id="nama_wp" name="nama_wp" type="hidden" value="<?= ($sppt["nama_wp"])?>">
										<input id="letak_op" name="letak_op" type="hidden" value="<?= ($sppt["letak_op"])?>">
										<input id="ket" name="ket" type="hidden" value="Belum Bayar">
                                        <input id="jenis_wp" name="jenis_wp" type="hidden" value="1">
										<input type="hidden" name="nik_lama" value="<?= $wajib_pajak["nik_lama"] ?>"/>
										<input type="hidden" name="nik" value="<?= $wajib_pajak["nik"] ?>"/>
										<input type="hidden" name="id_pend" value="<?= $wajib_pajak["id"] ?>"/>
										<?php if ($sppt): ?>
											<input type="hidden" name="id" value="<?= $sppt["id"] ?>"/>
										<?php endif; ?>
										<input type="hidden" name="data_sppt" value="<?= $sppt["data_sppt"] ?>"/>
									
										<div id="warga_luar_desa">
                                            <div class="col-sm-8">
                                                <h4><strong>Data Tagihan</strong></h4>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Nama Wajib Pajak</label>
                                                    <div class="col-sm-9">
                                                        <input  class="form-control input-sm" type="text" placeholder="Nama Wajib Pajak" value="<?= ($sppt["nama_wp"])?sprintf("%04s", $sppt["nama_wp"]): NULL ?>" readonly="readonly" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Nomor Objek Pajak</label>
                                                    <div class="col-sm-9">
                                                        <input  class="form-control input-sm" type="text" placeholder="Nomor Objek Pajak" value=" <?= ($sppt["nomor"])?>" readonly="readonly" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat"  class="col-sm-3 control-label">Letak Objek Pajak</label>
                                                    <div class="col-sm-9">
                                                        <textarea  class="form-control input-sm" placeholder="Alamat Wajib Pajak" readonly="readonly"><?= ($sppt["letak_op"])?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-responsive">
                                            	<tr>
                                                	<td>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th align="center">Pajak</th>
                                                                <th align="center">Bumi</th>
                                                                <th align="center">Bangunan</th>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">Luas/m<sup>2</sup></td>
                                                                <td align="right"><?= ($sppt["luas_tanah"])?> m<sup>2</sup></td>
                                                                <td align="right"><?= ($sppt["luas_bangunan"])?> m<sup>2</sup></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">Kelas </td>
                                                                <td align="center"><?= ($sppt["kelas_tanah"])?></td>
                                                                <td align="center"><?= ($sppt["kelas_bangunan"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">NJOP/m<sup>2</sup></td>
                                                                <td align="right"><?= rupiah($sppt["pajak_tanah"])?></td>
                                                                <td align="right"><?= rupiah($sppt["pajak_bangunan"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">Total </td> 
                                                                <td align="right"><?= (rupiah($sppt["total_pajak_tanah"]))?></td>
                                                                <td align="right"><?= rupiah($sppt["total_pajak_bangunan"])?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th colspan="2" align="center">Nilai Jual Objek Pajak (NJOP)</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Dasar Pengenaan PBB</td>
                                                                <td align="right"><?= rupiah($sppt["dp_pbb"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>NJOP Tidak Kena Pajak </td>
                                                                <td align="right"><?= rupiah($sppt["njop_tkp"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>NJOP perhitungan PBB</td>
                                                                <td align="right"><?= rupiah($sppt["njop_ppbb"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>PBB Terhutang (awal)</td>
                                                                <td align="right"><strong style="color:#F00"><?= rupiah($sppt["pbb_terhutang"])?></strong></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div>
                                            <div class="col-sm-1">
                                                <label for="nama_wp"  class="control-label">Tahun</label>
                                                <input class="form-control input-sm required" maxlength="4" type="text" placeholder="Tahun" name="tahun_tagih" value="<?= ($sppt["tahun_tagih"])?>" >
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">SPPT Terhutang </label>
                                                <input class="form-control input-sm required" type="text" placeholder="Rupiah" id="pbb_terhutang" name="pbb_terhutang" onKeyup="hitung();" value="<?= $sppt["pbb_terhutang"]?>" >
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="nama_wp"  class="control-label">Denda </label>
                                                <input class="form-control input-sm required" type="text" placeholder="Rupiah" id="denda" name="denda" onKeyup="hitung();" value="" >
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="nama_wp"  class="control-label">Iuran </label>
                                                <input class="form-control input-sm required" type="text" placeholder="Rupiah" id="iuran" name="iuran" onKeyup="hitung();" value="" >
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="nama_wp"  class="control-label">Total Tagihan </label>
                                                <input class="form-control input-sm-4 required" align="right" type="text" placeholder="Rupiah" id="total_tagih" name="total_tagih" readonly="readonly" onKeyup="hitung();" value="" >
                                            </div>
										</div>
                                    </div>
                                    <div class="box-footer">
										<div class="col-xs-12">
											<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn btn-social btn-box btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
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
<!--
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
-->
