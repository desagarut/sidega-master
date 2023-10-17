<?php ?>
<script>
	$( function() {
		$( "#cari_tagih" ).autocomplete({
			source: function( request, response ) {
				$.ajax( {
					type: "POST",
					url: '<?= site_url("data_sppt/autocomplete")?>',
					dataType: "json",
					data: {
						cari: request.term
					},
					success: function( data ) {
						response( JSON.parse( data ));
					}
				} );
			},
			minLength: 1,
		} );
	} );
</script>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Pengelolaan SPPT
      <?= ucwords($this->setting->sebutan_desa)?>
      <?= $desa["nama_desa"];?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Homes</a></li>
      <li class="active">Daftar Tagihan & Pembayaran SPPT PBB</li>
    </ol>
  </section>
  <section class="content" id="maincontent">
  <form id="mainform" name="mainform" action="" method="post">
  <div class="row">
  <div class="col-md-4 col-lg-3">
    <?php $this->load->view('data_sppt/menu.php')?>
  </div>
  <div class="col-md-8 col-lg-9">
  <div class="box box-info">
  <div class="box-header">
    <div class="box-header with-border"> <a href="<?=site_url("data_sppt/tagihan_daftar/")?>" class="btn btn-social bg-blue btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Tambah Tagihan"> <i class="fa fa-arrow-left"></i>Master Data</a> <a href="<?=site_url("data_sppt/tagihan_cetak")?>" class="btn btn-social bg-green btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Data" target="_blank"> <i class="fa fa-print"></i> Cetak </a> 
    <a href="<?=site_url("data_sppt/tagihan_unduh")?>" class="btn btn-social btn-box bg-teal btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data Tagihan" title="Unduh Data Tagihan"> <i class="fa fa-download"></i>Unduh </a> 
    <!-- <a href="<?= site_url('data_sppt/import')?>" class="btn btn-social bg-teal btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data SPPT" title="Unduh Data SPPT"> <i class="fa fa-upload"></i>Unggah </a> --><a href="<?= site_url("data_sppt/clear_tagih")?>" class="btn btn-social bg-yellow btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-refresh"></i>Bersihkan</a> </div>
  </div>
  <div class="box-body">
  <div class="row">
  <div class="col-sm-12">
  <div class="box-body">
  <div class="row">
  <div class="col-sm-12">
  <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
  <form id="mainform" name="mainform" action="" method="post">
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-6">
          <h4 class="text-left"><strong>DAFTAR TAGIHAN & PEMBAYARAN SPPT PBB</strong></h4>
        </div>
        <div class="col-sm-6">
          <div class="box-tools">
            <div class="input-group input-group-sm pull-right">
              <input name="cari_tagih" id="cari_tagih" class="form-control" placeholder="cari tagihan..." type="text" value="<?=html_escape($cari_tagih)?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action', '<?= site_url("data_sppt/search_tagih")?>');$('#'+'mainform').submit();}">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("data_sppt/search_tagih")?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="table-responsive">
          <table class="table table-bordered table-striped dataTable table-hover table-responsive">
            <thead class="bg-purple">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Aksi</th>
                <th class="text-center">Tahun</th>
                <th class="text-center">NOP</th>
                <th class="text-center">Nama Wajib Pajak</th>
                <th class="text-center">Total Tagihan</th>
                <th class="text-center">Tanggal Update</th>
                <th class="text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_tagihan as $item): ?>
              <tr>
                <td align="center"><?= $item['no'] ?></td>
                <td align="center" >
                <div class="btn-group">
				<?php if ($item['status'] == "Lunas"): ?>
                  <button type="button" href="<?= site_url("data_sppt/tagihan_ubah_bayar/".$item["id_tagih"])?>" class="btn btn-success btn-sm" disabled title="Pembayaran Selesai" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Pembayaran Selesai"><i class="fa fa-key"></i> Lunas </a></button>
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                        <!--<li><a href="<?= site_url("data_sppt/tagihan_ubah_bayar/".$item["id_tagih"])?>" class="btn btn-social bg-green btn-box btn-block btn-sm"  title="Terima Pembayaran Pajak" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Terima Pembayaran Pajak"><i class="fa fa-dollar"></i> Bayar</a> </li>-->
                        <li><a href="<?= site_url("data_sppt/tagihan_ubah/".$item["id_tagih"])?>" class="btn btn-social bg-yellow btn-box btn-block btn-sm"  title="Ubah Data" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Tagihan"><i class="fa fa-edit"></i>Ubah</a> </li>
                        <li><a href="#" data-href="<?= site_url("data_sppt/hapus_tagih/".$item["id_tagih"])?>" class="btn btn-social bg-red btn-box btn-block btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i>Hapus</a> </li>
                  </ul>
                  
                  
                  <?php elseif ($item['status'] == "Belum Bayar"):  ?>
				  <button type="button" href="<?= site_url("data_sppt/tagihan_ubah_bayar/".$item["id_tagih"])?>" class="btn btn-danger btn-sm"  title="Terima Pembayaran Pajak" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Terima Pembayaran Pajak"><i class="fa fa-dollar"></i> Bayar</a></button>
                  
                  <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                        <!--<li><a href="<?= site_url("data_sppt/tagihan_ubah_bayar/".$item["id_tagih"])?>" class="btn btn-social bg-green btn-box btn-block btn-sm"  title="Terima Pembayaran Pajak" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Terima Pembayaran Pajak"><i class="fa fa-dollar"></i> Bayar</a> </li>-->
                        <li><a href="<?= site_url("data_sppt/tagihan_ubah/".$item["id_tagih"])?>" class="btn btn-social bg-yellow btn-box btn-block btn-sm"  title="Ubah Data" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Tagihan"><i class="fa fa-edit"></i>Ubah</a> </li>
                        <li><a href="#" data-href="<?= site_url("data_sppt/hapus_tagih/".$item["id_tagih"])?>" class="btn btn-social bg-red btn-box btn-block btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i>Hapus</a> </li>
                  </ul>
				  <?php endif; ?>
                </div>
                </td>
                <td align="center"><?= sprintf("%04s", $item["tahun_tagih"]) ?></td>
                <td align="center"><?= sprintf("%04s", $item["nomor"]) ?></td>
                <td nowrap><?= $item['nama_wp'] ?></td>
                <td nowrap align="right"><?= rupiah($item['total_tagih']) ?></td>
                <td align="center"><?= $item['tgl_bayar'] ?></td>
                <td align="center"><?= $item['status'] ?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
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
</div>
</div>
</div>
</form>
</section>
</div>
<?php $this->load->view('global/confirm_delete');?>
