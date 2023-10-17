<?php ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Pengelolaan SPPT
      <?= ucwords($this->setting->sebutan_desa)?>
      <?= $desa["nama_desa"];?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Laporan</li>
    </ol>
  </section>
  <section class="content" id="maincontent">
  <div class="row">
    <div class="col-md-3">
      <?php $this->load->view('data_sppt/menu.php')?>
    </div>
    <div class="col-md-9">
      <div class="row">
        <div class="col-md-12">
			<?php 
            if(isset($data)){
                $d = $data->row();
            ?>
          <div class="box">
            <div class="box-header box-info with-border">
              <h3 class="box-title">Laporan Pengelolaan SPPT PBB</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                    <div id="canvas-holder">
                    <canvas id="chart-area" width="50" height="50"/>
                    </div>                <!-- /.col -->
                </div>
                
                <div class="col-md-9">
                  <p class="text-center"> <strong>Realisasi SPPT PBB</strong> </p>
                  <div class="progress-group"> <span class="progress-text">Jumlah Objek Pajak Terdaftar di Sistem</span> <span class="progress-number"><b><?=$d->jumlah_nop?> NOP </b> = <?=$rupiah($d->pbb_terhutang)?></span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: <?=$d->jumlah_nop?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                 
                  <div class="progress-group"> <span class="progress-text">Total SPPT PBB Lunas </span> <span class="progress-number"><b><?=$rupiah($d->pajak_lunas)?></b>/<?=$rupiah($d->pbb_terhutang)?></span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: <?=$d->lunas/$d->jumlah_nop*100?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                 
                  <div class="progress-group"> <span class="progress-text">Total SPPT PBB Belum Lunas </span> <span class="progress-number"><b><?=$rupiah($d->pajak_terhutang)?></b>/<?=$rupiah($d->pbb_terhutang)?></span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?=$d->terhutang/$d->jumlah_nop*100?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  
                  <div class="progress-group"> <span class="progress-text">Persentase Pencapaian Target</span> <span class="progress-number"><b><?=$d->presentase?> %</span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: <?=$d->presentase?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group --> 
                </div>
                <!-- /.col --> 
              </div>
              <!-- /.row --> 
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right"> <span class="description-percentage text-green"><i class="fa fa-users"></i>
                    <?=$d->jumlah_nop?>
                    WP</span>
                    <h5 class="description-header">
                      <?=$rupiah($d->pbb_terhutang)?>
                    </h5>
                    <span class="description-text">TOTAL OBJEK PAJAK</span> </div>
                  <!-- /.description-block --> 
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6" id="myTable">
                  <div class="description-block border-right"> <span class="description-percentage text-yellow"><i class="fa fa-users"></i>
                    <?=$d->lunas?>
                    WP</span>
                    <h5 class="description-header">
                      <?=$rupiah($d->pajak_lunas)?>
                    </h5>
                    <span class="description-text">TOTAL LUNAS</span> </div>
                  <!-- /.description-block --> 
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right"> <span class="description-percentage text-green"><i class="fa fa-users"></i>
                    <?=$d->terhutang?>
                    WP</span>
                    <h5 class="description-header">
                      <?=$rupiah($d->pajak_terhutang)?>
                    </h5>
                    <span class="description-text">TOTAL BELUM BAYAR</span> </div>
                  <!-- /.description-block --> 
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block"> <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    <?=$d->presentase?> %
                    </span>
                    <h5 class="description-header">
                      <?=$rupiah($d->pajak_lunas)?>
                    </h5>
                    <span class="description-text">PENCAPAIAN TARGET</span> </div>
                  <!-- /.description-block --> 
                </div>
              </div>
              <div class="col-sm-3 col-xs-6">
                  <div class="description-block"> <span class="description-percentage text-red"><i class="fa fa-caret-down"></i>
                    <?=$d->presentase?> %
                    </span>
                    <h5 class="description-header">
                      <?=$rupiah($d->jml_blm_bayar)?>
                    </h5>
                    <span class="description-text">PENCAPAIAN TARGET</span> </div>
                  <!-- /.description-block --> 
                </div>
              <!-- /.row --> 
            </div>
            <!-- /.box-footer --> 
          </div>
          <!-- /.box -->
			<?php
                }
            ?>
        </div>
        <!-- /.col --> 
      </div>
    </div>
  </div>
</div>
</div>
</section>
</div>

<script src="<?= base_url()?>assets/js/Chart.js"></script>

<script>

		var doughnutData = [
				{
					value: "<?= $d->pajak_terhutang?>",
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Belum Bayar"
				},
				{
					value: "<?= $d->pajak_lunas?>",
					color: "aqua",
					highlight: "#5AD3D1",
					label: "Lunas"
				},
				{
					value: 100,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "Yellow"
				},
				{
					value: 40,
					color: "#949FB1",
					highlight: "#A8B3C5",
					label: "Grey"
				},
				{
					value: 120,
					color: "#4D5360",
					highlight: "#616774",
					label: "Dark Grey"
				}

			];

			window.onload = function(){
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
			};
</script>