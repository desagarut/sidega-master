<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<p><strong>HASIL POLLING</strong></p>
<script src="/assets/js/highcharts/chart.min.js"></script>
<canvas id="pollingHasil"></canvas>
<?php foreach( $data_pilihan as $key => $row )

    {
        $data['labels'][] =  $row['nama'];

        $data['datasets'][] = $this->poll->count_vote( $row['id'] );
    }

?>

<script >
    //doughnut
var ctxD = document.getElementById("pollingHasil").getContext('2d');
var myLineChart = new Chart(ctxD, {
type: 'doughnut',
data: {
labels: <?php echo json_encode($data['labels']); ?>,
datasets: [{
data: <?php echo json_encode($data['datasets']); ?>,
backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
}]
},
options: {
responsive: true
}
});
</script>
<div class="text-center bold">Total Vote: <?=$total_vote?></div><hr/>