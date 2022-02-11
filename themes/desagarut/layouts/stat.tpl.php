<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>

</head>
<body>

	<?php $this->load->view($folder_themes . '/commons/header') ?>
        <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Statistik </h2>
                <ol>
                    <li><a href="<?= site_url('first') ?>">Home</a></li>
                    <li>Statistik</li>
                </ol>
            </div>
        </div>
    </section><!-- End Breadcrumbs -->

    <main id="main">
	<script>
		const enable3d = <?=$this->setting->statistik_chart_3d ?> ? true : false;
	</script>
        <section>
            <div class="container">
                <div class="row">
                <?php 
                    switch ($tipe) {
                        case '0':
                            $page = '/partials/statistics/default';
                            break;
                        case '3':
                            $page = '/partials/statistics/regions';
                            break;
                        case '4':
                            $page = '/partials/statistics/voters';
                            break;
                        default:
                            $page = '/commons/404';
                            break;
                    }
                ?>
                <?php $this->load->view($folder_themes . $page) ?>
            </div>
            </div>
        </section>
    </main>
    
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
</body>
</html>