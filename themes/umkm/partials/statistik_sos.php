<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script type="text/javascript">
	var chart;
	$(document).ready(function()
	{
		chart = new Highcharts.Chart(
		{
			chart:
			{
				renderTo: 'container',
				defaultSeriesType: 'column'
			},
			title:
			{
				text: 'Statistik Kelas Sosial'
			},
			xAxis:
			{
				title:
				{
					text: 'Kelas Sosial'
				},
				categories: [
				<?php $i=0;foreach($main as $data){$i++;?>
					<?= "'$data[nama]',";?>
				<?php }?>
				]
			},
			yAxis:
			{
				title:
				{
					text: 'Populasi'
				}
			},
			legend:
			{
				layout: 'vertical',
				backgroundColor: '#FFFFFF',
				align: 'left',
				verticalAlign: 'top',
				x: 100,
				y: 70,
				floating: true,
				shadow: true,
				enabled:false
			},
			tooltip:
			{
				formatter: function()
				{
					return ''+
					this.x +': '+ this.y +'';
				}
			},
			plotOptions:
			{
				series:
				{
					colorByPoint: true
				},
				column:
				{
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [
			{
				name: 'Populasi',
				data: [
				<?php foreach($main as $data){?>
					<?= $data['jumlah'].",";?>
					<?php }?>]
				}]
			});
	});
</script>
