<!-- Pengaturan Grafik (Graph) Data Statistik-->
<script type="text/javascript">
	var chart;
	$(document).ready(function()
	{
		chart = new Highcharts.Chart(
		{
			chart:
			{
				renderTo: 'chart',
				defaultSeriesType: 'column'
			},
			title:
			{
				text: ''
			},
			xAxis:
			{
				title:
				{
					text: '<?= ucwords($main['lblx'])?>'
				},
        categories: [
					<?php foreach ($main['pengunjung']as $data): ?>
					['<?= ($main['lblx']=='Bulan') ? getBulan($data['Tanggal'])." ".date('Y') : tgl_indo2($data['Tanggal']); ?>', ],
				<?php endforeach;?>
					]
			},
			yAxis:
			{
				title:
				{
					text: 'Pengunjung (Orang)'
				}
			},
			legend:
			{
				layout: 'vertical',
        enabled:false
			},
			plotOptions:
			{
				series:
				{
          colorByPoint: true
        },
      column:
			{
				pointPadding: 0,
				borderWidth: 0
			}
		},
		series: [
		{
			shadow:1,
			border:1,
			data: [
				<?php foreach ($main ['pengunjung']as $data): ?>
					['<?= ($main['lblx']=='Tanggal') ? getBulan($data['Tanggal'])." ".date('Y') : tgl_indo2($data['Tanggal']); ?>',<?= $data['Jumlah']?>],
				<?php endforeach;?>]
			}]
		});
	});
</script>

<!-- Highcharts -->
<script src="<?= base_url()?>assets/js/highcharts/exporting.js"></script>
<script src="<?= base_url()?>assets/js/highcharts/highcharts-more.js"></script>

<div class='col-md-3'>
    <div class="box box-success box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Pengunjung Web </h3>
            <div class="box-tools pull-right">
                <a href="<?=site_url("pengunjung")?>"><span class="label label-default"> Detail</span></a>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>				
        <div class='box-body'>
            <div class="box-group" id="accordion">
                <div class="col-md-12">
                    <!-- Ini Grafik -->
                    <br>
                    <div id="chart" style="height:150px"> </div>
                </div>
            </div>
        </div>
    </div>
</div>

