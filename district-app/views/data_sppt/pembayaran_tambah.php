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

	<section class="content" id="maincontent">
					<div class="box-body">
							<div class="col-sm-12">
							<!--	<form action="" id="main" name="main" method="POST" class="form-horizontal">
									<div class="box-body">
										<div id="warga_desa">
											<?php// if ($wajib_pajak): ?>
                                            <div class="col-sm-8">
                                                <h5><strong>Data Tagihan</strong></h5>
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
											<?php// endif; ?>
										</div>
									</div>
								</form>-->
                                
								<form name='mainform' action="<?= site_url('data_sppt/simpan_pembayaran')?>" method="POST"  id="validasi" class="form-horizontal">
									<div class="box-body">
                                        <input id="nomor" name="nomor" type="hidden" value="<?= ($data_tagih["nomor"])?>">
										<input id="nama_wp" name="nama_wp" type="hidden" value="<?= ($data_tagih["nama_wp"])?>">
										<input id="letak_op" name="letak_op" type="hidden" value="<?= ($data_tagih["letak_op"])?>">
										<input id="ket" name="ket" type="hidden" value="Lunas">
										<input id="total_tagih" name="total_tagih" type="hidden" value="<?= ($data_tagih["total_tagih"])?>">
										<input id="update_at" name="update_at" type="hidden" value="<?=(int)date('Y-m-d h:i:sa')?>">

										<div id="warga_luar_desa">
                                            <div class="col-sm-12">
                                                <h4><strong>Terima Pembayaran Pajak</strong></h4>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Nama Wajib Pajak</label>
                                                    <div class="col-sm-9">
                                                        <input  class="form-control input-sm" type="text" placeholder="Nama Wajib Pajak" value="<?= ($data_tagih["nama_wp"])?sprintf("%04s", $data_tagih["nama_wp"]): NULL ?>" readonly="readonly" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Nomor Objek Pajak</label>
                                                    <div class="col-sm-9">
                                                        <input  class="form-control input-sm" type="text" placeholder="Nomor Objek Pajak" value=" <?= ($data_tagih["nomor"])?>" readonly="readonly" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat"  class="col-sm-3 control-label">Letak Objek Pajak</label>
                                                    <div class="col-sm-9">
                                                        <textarea  class="form-control input-sm" placeholder="Alamat Wajib Pajak" readonly="readonly"><?= ($data_tagih["letak_op"])?></textarea>
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
                                                                <td align="right"><?= ($data_tagih["luas_tanah"])?> m<sup>2</sup></td>
                                                                <td align="right"><?= ($data_tagih["luas_bangunan"])?> m<sup>2</sup></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">Kelas </td>
                                                                <td align="center"><?= ($data_tagih["kelas_tanah"])?></td>
                                                                <td align="center"><?= ($data_tagih["kelas_bangunan"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">NJOP/m<sup>2</sup></td>
                                                                <td align="right"><?= rupiah($data_tagih["pajak_tanah"])?></td>
                                                                <td align="right"><?= rupiah($data_tagih["pajak_bangunan"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">Total </td> 
                                                                <td align="right"><?= (rupiah($data_tagih["total_pajak_tanah"]))?></td>
                                                                <td align="right"><?= rupiah($data_tagih["total_pajak_bangunan"])?></td>
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
                                                                <td align="right"><?= rupiah($data_tagih["dp_pbb"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>NJOP Tidak Kena Pajak </td>
                                                                <td align="right"><?= rupiah($data_tagih["njop_tkp"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>NJOP perhitungan PBB</td>
                                                                <td align="right"><?= rupiah($data_tagih["njop_ppbb"])?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>PBB Terhutang (awal)</td>
                                                                <td align="right"><strong style="color:#F00"><?= rupiah($data_tagih["pbb_terhutang"])?></strong></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div>
                                            <div class="col-sm-2">
                                                <label for="nama_wp"  class="control-label">Tahun</label>
                                                <input class="form-control input-sm required" maxlength="4" type="text" placeholder="Tahun" name="tahun_tagih" readonly="readonly" value="<?= $data_tagih["tahun_tagih"]?>" >
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="nama_wp"  class="control-label">SPPT Terhutang </label>
                                                <input class="form-control input-sm required" type="text" placeholder="Rupiah" id="pbb_terhutang" name="pbb_terhutang" onKeyup="hitung();" readonly="readonly" value="<?= $data_tagih["pbb_terhutang"]?>" >
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">Denda </label>
                                                <input class="form-control input-sm required" type="text" placeholder="Rupiah" id="denda" name="denda" onKeyup="hitung();" readonly="readonly" value="<?= $data_tagih["denda"]?>" >
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="nama_wp"  class="control-label">Iuran </label>
                                                <input class="form-control input-sm required" type="text" placeholder="Rupiah" id="iuran" name="iuran" onKeyup="hitung();" readonly="readonly" value="<?= $data_tagih["iuran"]?>" >
                                            </div>
                                            <div class="col-sm-4 pull-right">
                                                <label for="nama_wp"  class="control-label">Total Tagihan </label>
                                                <input class="form-control input-sm-4 required" align="right" type="text" placeholder="Rupiah" id="total_tagih" name="total_tagih" readonly="readonly" onKeyup="hitung();" value="<?= $data_tagih["total_tagih"]?>" >
                                            </div>
										</div>
                                    </div>
                                    <div class="box-footer">
										<div class="col-xs-12">
											<button type="reset" class="btn btn-social btn-box btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn btn-social btn-box btn-success btn-sm pull-right"><i class="fa fa-check"></i> Bayar Sekarang</button>
										</div>
									</div>
								</form>
							</div>
					</div>
	</section>
