<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script>
	const dataStats = Object.values(<?= json_encode($stat) ?>);
</script>
<script>
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Browser market shares in January, 2018'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Chrome',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'Internet Explorer',
            y: 11.84
        }, {
            name: 'Firefox',
            y: 10.85
        }, {
            name: 'Edge',
            y: 4.67
        }, {
            name: 'Safari',
            y: 4.18
        }, {
            name: 'Sogou Explorer',
            y: 1.64
        }, {
            name: 'Opera',
            y: 1.6
        }, {
            name: 'QQ',
            y: 1.2
        }, {
            name: 'Other',
            y: 2.61
        }]
    }]
});
</script>       

        <h5 align="center">Demografi Berdasarkan Data <?= $heading ?></h5>
        <div class="--flex --items-center --justify-between --mt-2 --mb-4">
            <h6 align="center">Grafik <?= $heading ?></h6>
            <div align="center">
                <button class="button button--primary button__switch" data-type="column">Bar Graph</button>
                <button class="button button--primary button__switch button__switch--active" data-type="pie">Pie Graph</button>
            </div>
        </div>
        <div id="statistics__graph"></div>
        <br/>
        <h6 align="center"><strong>Tabel Distribusi <?= $heading ?></strong></h6>
        <div class="table" align="center"><small>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Kelompok</th>
                        <th colspan="2" valign="centre">Jumlah</th>
                        <?php if($jenis_laporan == 'penduduk'): ?>
                            <th colspan="2">Laki-laki</th>
                            <th colspan="2">Perempuan</th>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <th>n</th>
                        <th>%</th>
                        <?php if($jenis_laporan == 'penduduk'):?>
                            <th>n</th>
                            <th>%</th>
                            <th>n</th>
                            <th>%</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; $l=0; $p=0; $hide=""; $h=0; $jm1=1; $jm = count($stat);?>
                    <?php foreach ($stat as $data):?>
                        <?php $jm1++; if (1):?>
                        <?php $h++; if ($h > 12 AND $jm > 10): $hide="lebih"; ?>
                        <?php endif;?>
                        <tr class="<?=$hide?>">
                            <td>
                                <?php if ($jm1 > $jm - 2):?>
                                    <?=$data['no']?>
                                <?php else:?>
                                    <?=$h?>
                                <?php endif;?>
                            </td>
                            <td><?=$data['nama']?></td>
                            <td class="<?php ($jm1 <= $jm - 2) and ($data['jumlah'] == 0) and print('nol')?>"><?=$data['jumlah']?>
                            </td>
                            <td><?=$data['persen']?></td>
                            <?php if ($jenis_laporan == 'penduduk'):?>
                                <td><?=$data['laki']?></td>
                                <td><?=$data['persen1']?></td>
                                <td><?=$data['perempuan']?></td>
                                <td><?=$data['persen2']?></td>
                            <?php endif;?>
                        </tr>
                        <?php $i += $data['jumlah'];?>
                        <?php $l += $data['laki']; $p += $data['perempuan'];?>
                        <?php endif;?>
                    <?php endforeach;?>
                </tbody>
            </table></small>
            <div class="read-more">
                <button class="button button--primary" id='showData'>Selengkapnya...</button>
                <button id="tampilkan" onclick="showHideToggle();" class="button button--primary">Tampilkan Nol</button>
            </div>
        </div>
        <?php if (in_array($st, array('bantuan_keluarga', 'bantuan_penduduk'))):?>
            <script>
            const bantuanUrl = '<?= site_url('first/ajax_peserta_program_bantuan')?>';
            </script>
            <br/>
            <h6 align="center"><strong>Daftar <?= $heading ?></strong></h6>
            <input id="stat" type="hidden" value="<?=$st?>">
            <div class="table"><small>
                <table class="table table-striped table-bordered" id="peserta_program">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Program</th>
                            <th>Nama Peserta</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table></small>
            </div>
        <?php endif;?>
<script>
$.fn.dataTable.ext.errMode = 'throw';</script>