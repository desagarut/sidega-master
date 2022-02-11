<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
<!--	<link rel="stylesheet" href="<? // = base_url("$this->theme_folder/$this->theme/assets/css/bootstrap.min.css") ?>">-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.1.1/highcharts.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.1.1/highcharts-3d.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
    <!-- OpenStreetMap Css -->
    <link rel="stylesheet" href="<?= base_url()?>assets/css/leaflet.css" />
    <link rel="stylesheet" href="<?= base_url()?>assets/css/leaflet-geoman.css" />
    <link rel="stylesheet" href="<?= base_url()?>assets/css/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="<?= base_url()?>assets/css/MarkerCluster.css" />
    <link rel="stylesheet" href="<?= base_url()?>assets/css/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="<?= base_url()?>assets/css/leaflet-measure-path.css" />
    <link rel="stylesheet" href="<?= base_url()?>assets/css/mapbox-gl.css" />
    <link rel="stylesheet" href="<?= base_url()?>assets/css/L.Control.Shapefile.css" />
    <link rel="stylesheet" href="<?= base_url()?>assets/css/leaflet.groupedlayercontrol.min.css" />
<!--    <link rel="stylesheet" href="<?= base_url()?>assets/css/peta.css"> -->
    
</head>

<body>
	<?php $this->load->view($folder_themes . '/commons/header') ?>

    <section>
	<?php $this->load->view($folder_themes . '/partials/map_p') ?>
    </section>
	<?php $this->load->view($folder_themes . '/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
</body>

<script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/script.min.js?" . THEME_VERSION)?>"></script>
<script>
	$('.fetched-data').on('DOMNodeInserted', 'link[rel=stylesheet]', function () {
		$(this).remove();
	});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- OpenStreetMap Js-->
<script src="<?= base_url()?>assets/js/leaflet.js"></script>
<script src="<?= base_url()?>assets/js/leaflet-geoman.min.js"></script>
<script src="<?= base_url()?>assets/js/leaflet.filelayer.js"></script>
<script src="<?= base_url()?>assets/js/leaflet-providers.js"></script>
<script src="<?= base_url()?>assets/js/leaflet.markercluster.js"></script>
<script src="<?= base_url()?>assets/js/leaflet-measure-path.js"></script>
<script src="<?= base_url()?>assets/js/leaflet-mapbox-gl.js"></script>
<script src="<?= base_url()?>assets/js/leaflet.shpfile.js"></script>
<script src="<?= base_url()?>assets/js/leaflet.groupedlayercontrol.min.js"></script>
<script src="<?= base_url()?>assets/js/leaflet.browser.print.js"></script>
<script src="<?= base_url()?>assets/js/leaflet.browser.print.utils.js"></script>
<script src="<?= base_url()?>assets/js/leaflet.browser.print.sizes.js"></script>
<script src="<?= base_url()?>assets/js/turf.min.js"></script>
<script src="<?= base_url()?>assets/js/togeojson.js"></script>
<script src="<?= base_url()?>assets/js/togpx.js"></script>
<script src="<?= base_url()?>assets/js/L.Control.Locate.min.js"></script>
<script src="<?= base_url()?>assets/js/peta.js"></script>
<script src="<?= base_url()?>assets/js/apbdes_manual.js"></script>
<script src="<?= base_url()?>assets/js/mapbox-gl.js"></script>
<script src="<?= base_url()?>assets/js/shp.js"></script>
<script src="<?= base_url()?>assets/js/dom-to-image.min.js"></script>
</html>