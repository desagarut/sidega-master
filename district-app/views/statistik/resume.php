<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Resume Statistik</h1>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('beranda'); ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Resume Statistik <?= $dusun; ?></li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
                <div class='col-md-12'>
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <div class="box-tools pull-right">
                                 <a href="<?=site_url()?>penduduk/clear"><span class="label label-info"> Detail</span></a>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                            <h3 class="box-title">Kependudukan</h3>
                        </div>
                        <div class='box-body'>
                            <div class="col-sm-2 col-xs-6">
                                <div class="small-box bg-purple">
                                    <div class="inner">
                                        <?php foreach ($dusun as $data): ?>
                                            <h3><?=$data['jumlah']?></h3>
                                        <?php endforeach; ?>
                                        <p>Wilayah Dusun</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-location"></i>
                                    </div>
                                    <a href="<?=site_url('sid_core')?>" class="small-box-footer">Detail  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <?php foreach ($penduduk as $data): ?>
                                            <h3><?=$data['jumlah']?></h3>
                                        <?php endforeach; ?>
                                        <p>Penduduk</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person"></i>
                                    </div>
                                    <a href="<?=site_url('penduduk/clear')?>" class="small-box-footer">Detail  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <?php foreach ($keluarga as $data): ?>
                                            <h3><?=$data['jumlah']?></h3>
                                        <?php endforeach; ?>
                                        <p>Keluarga</p>
                                    </div>
    
                                    <div class="icon">
                                        <i class="ion ion-ios-people"></i>
                                    </div>
    
                                    <a href="<?=site_url('keluarga/clear')?>" class="small-box-footer">Detail  <i class="fa fa-arrow-circle-right"></i></a>
    
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <?php foreach ($kelompok as $data): ?>
                                            <h3><?=$data['jumlah']?></h3>
                                        <?php endforeach; ?>
                                        <p>Kelompok</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-android-people"></i>
                                    </div>
                                    <a href="<?=site_url('kelompok/clear')?>" class="small-box-footer">Detail  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6">
                                <div class="small-box bg-orange">
                                    <div class="inner">
                                        <?php foreach ($rtm as $data): ?>
                                            <h3><?=$data['jumlah']?></h3>
                                        <?php endforeach; ?>
                                        <p>Rumah Tangga</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-home"></i>
                                    </div>
                                    <a href="<?=site_url('rtm/clear')?>" class="small-box-footer">Detail  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
					</div>
				</div>

                <div class='col-md-12'>
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <div class="box-tools pull-right">
                                 <a href="<?=site_url()?>program_bantuan"><span class="label label-info"> Detail</span></a>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                            <h3 class="box-title">Program Bantuan</h3>
                        </div>
                        <div class='box-body'>
                            <div class="row">
                                <div class="col-sm-2 col-xs-6">
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h3><?=$bantuan['jumlah']?></h3>
                                            <p><?=$bantuan['nama']?></p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-ios-pie"></i>
                                        </div>
                                        <div class="small-box-footer">
                                            <?php if ($this->CI->cek_hak_akses('u')): ?>
                                                <a href="<?= site_url("{$this->controller}/dialog_pengaturan")?>" class="inner text-white pengaturan" title="Pengaturan Program Bantuan" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Pengaturan Program Bantuan"><i class="fa fa-gear"></i></a>
                                            <?php endif; ?>
                                            <a href="<?=site_url().$bantuan['link_detail']?>" class="inner text-white">Lihat Detail  <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- solid sales graph -->
                                <div class="col-sm-2 col-xs-6">
                                <canvas style="display: inline-block; width: 100px; height: 100px; vertical-align: top;" width="100" height="100"></canvas>
                                    <div class="box box-solid">
                                    <div class="box-header">
                                      <h3 class="box-title text-danger">Sparkline Pie</h3>
                        
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                      </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body text-center">
                                      <div class="sparkline" data-type="pie" data-offset="90" data-width="100px" data-height="100px">
                                        6,4,8
                                      </div>
                                    </div>                                    <!-- /.box-footer -->
                                                          <!-- /.box -->
                            </div>
                            	</div>
                        </div>
                   </div>
                </div>        
			</div>
		</form>
	</section>
</div>
<script type="text/javascript">
	var chart;

	function grafikType() {
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'chart',
				defaultSeriesType: 'column'
			},
			title: 0,
			xAxis: {
				title: {
					text: '<?= $stat?>'
				},
				categories: [
				<?php $i=0; foreach ($main as $data): $i++;?>
				<?php if ($data['jumlah'] != "-"): ?><?= "'$i',";?><?php endif; ?>
			<?php endforeach;?>
			]
		},
		yAxis: {
			title: {
				text: 'Jumlah Populasi'
			}
		},
		legend: {
			layout: 'vertical',
			enabled: false
		},
		plotOptions: {
			series: {
				colorByPoint: true
			},
			column: {
				pointPadding: 0,
				borderWidth: 0
			}
		},
		series: [{
			shadow:1,
			border:1,
			data: [
			<?php foreach ($main as $data): ?>
				<?php if (!in_array($data['nama'], array("TOTAL", "JUMLAH", "PENERIMA"))): ?>
					<?php if ($data['jumlah'] != "-"): ?>
						['<?= strtoupper($data['nama']); ?>',<?= $data['jumlah']; ?>],
					<?php endif; ?>
				<?php endif; ?>
				<?php endforeach;?>]
			}]
		});

		$('#chart').removeAttr('hidden');
	}

	function pieType() {
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'chart',
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			title: 0,
			plotOptions: {
				index: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels:
					{
						enabled: true
					},
					showInLegend: true
				}
			},
			legend: {
				layout: 'vertical',
				backgroundColor: '#FFFFFF',
				align: 'right',
				verticalAlign: 'top',
				x: -30,
				y: 0,
				floating: true,
				shadow: true,
				enabled:true
			},
			series: [{
				type: 'pie',
				name: 'Populasi',
				data: [
				<?php foreach ($main as $data): ?>
					<?php if (!in_array($data['nama'], array("TOTAL", "JUMLAH", "PENERIMA"))): ?>
						<?php if ($data['jumlah'] != "-"): ?>
							["<?= strtoupper($data['nama']); ?>",<?= $data['jumlah']; ?>],
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach;?>
				]
			}]
		});

		$('#chart').removeAttr('hidden');
	}
</script>
<!-- Sparkline -->
<script src="https://omnipotent.net/jquery.sparkline/2.1.2/jquery.sparkline.min.js"></script>
