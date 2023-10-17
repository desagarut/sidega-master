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
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive">
                        <tr>
                            <th>NOP</td>
                            <td>: <?= ($ubah_tagih["nomor"])?></td>
                        </tr>
                        <tr>
                            <th>Nama WP</td>
                            <td>: <?= ($ubah_tagih["nama_wp"])?></td>
                        </tr>
                        <tr>
                            <th>Letak OP</td>
                            <td>: <?= ($ubah_tagih["letak_op"])?></td>
                        </tr>
                    </table>
                    <div class="row">
                        <form name='mainform' action="<?= site_url('data_sppt/update_tagihan_save')?>" method="POST"  class="form-horizontal">
                            <div class="box-body">
                                <input id="id_tagih" name="id_tagih" type="hidden" value="<?= ($ubah_tagih["id_tagih"])?>">
                               <!--<input id="tahun_tagih" name="tahun_tagih" type="hidden" value="<?= ($ubah_tagih["tahun_tagih"])?>">
                                <input id="pbb_terhutang" name="pbb_terhutang" type="hidden" value="<?= ($ubah_tagih["pbb_terhutang"])?>">
                                <input id="denda" name="denda" type="hidden" value="<?= ($ubah_tagih["denda"])?>">
                                <input id="iuran" name="iuran" type="hidden" value="<?= ($ubah_tagih["iuran"])?>">
                                <input id="total_tagih" name="total_tagih" type="hidden" value="<?//= ($ubah_tagih["total_tagih"])?>">-->
                                <input id="status" name="status" type="hidden" value="Lunas">
                                <div>
                                    <div class="col-sm-2">
                                        <label for="nama_wp"  class="control-label">Tahun</label>
                                        <input class="form-control input-sm required" maxlength="4" type="text" placeholder="Tahun" name="tahun_tagih" value="<?= ($ubah_tagih["tahun_tagih"])?>" >
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="nama_wp"  class="control-label">SPPT Terhutang </label>
                                        <input class="form-control input-sm required" type="text" placeholder="Rupiah" id="pbb_terhutang" name="pbb_terhutang" onKeyup="hitung();" value="<?= $ubah_tagih["pbb_terhutang"]?>" >
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="nama_wp"  class="control-label">Denda </label>
                                        <input class="form-control input-sm required" type="text" placeholder="Rupiah" id="denda" name="denda" onKeyup="hitung();" value="<?= $ubah_tagih["denda"]?>" >
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="nama_wp"  class="control-label">Iuran </label>
                                        <input class="form-control input-sm required" type="text" placeholder="Rupiah" id="iuran" name="iuran" onKeyup="hitung();" value="<?= $ubah_tagih["iuran"]?>" >
                                    </div>
                                    <div class="col-sm-4  pull-right">
                                        <label for="nama_wp"  class="control-label">Total Tagihan </label>
                                        <input class="form-control input-sm-4 required" type="text" placeholder="Rupiah" id="total_tagih" readonly="readonly" name="total_tagih" onKeyup="hitung();" value="<?= $ubah_tagih["total_tagih"]?>" >
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
	</section>
