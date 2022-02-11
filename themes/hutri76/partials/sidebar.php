<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--<script async src="https://cse.google.com/cse.js?cx=partner-pub-1823410826720847:9092024212"></script>-->


<div class="col-lg-4">
    <div class="sidebar" data-aos="fade-left">

    <h3 class="sidebar-title">Search</h3>
    <div class="sidebar-item search-form" method="get">
        <form action="<?= site_url('first') ?>">
        <input type="text">
        <button type="submit"><i class="icofont-search"></i></button>
        </form>
    </div>

	<?php // $this->load->view($folder_themes .'/partials/layanan_mandiri.php') ?>

	<?php foreach($w_cos as $widget) : ?>
		<?php if ($widget["jenis_widget"] == 1): ?>
			<?php if($widget['isi'] == 'keuangan.php') : ?>
				<?php continue; ?>
			<?php endif ?>
			<div class="sidebar-item">
				<?php include('donjo-app/views/widgets/'.$widget['isi']) ?>
			</div>
			<?php elseif($widget['jenis_widget'] == 2) : ?>
				<div class="sidebar-item">
					<div class="panel panel--sidebar">
						<div class="panel__header">
							<h3 class="sidebar-title"><?= strip_tags($widget['judul']) ?></h3>
						</div>
						<div class="panel__body">
							<?php include($widget['isi']) ?>
						</div>
					</div>
				</div>
			<?php else : ?>
				<div class="sidebar-item">
					<div class="panel panel--sidebar">
						<div class="panel__header">
							<h3 class="sidebar-title"><?= strip_tags($widget['judul']) ?></h3>
						</div>
						<div class="sidebar-item">
							<?= html_entity_decode($widget['isi']) ?>
						</div>
					</div>
				</div>
		<?php endif ?>
	<?php endforeach ?>

<!--      <h3 class="sidebar-title">Tags</h3>
      <div class="sidebar-item tags">
        <ul>
          <li><a href="#">App</a></li>
          <li><a href="#">IT</a></li>
          <li><a href="#">Business</a></li>
          <li><a href="#">Business</a></li>
          <li><a href="#">Mac</a></li>
          <li><a href="#">Design</a></li>
          <li><a href="#">Office</a></li>
          <li><a href="#">Creative</a></li>
          <li><a href="#">Studio</a></li>
          <li><a href="#">Smart</a></li>
          <li><a href="#">Tips</a></li>
          <li><a href="#">Marketing</a></li>
        </ul>

      </div><!-- End sidebar tags-->

    </div><!-- End sidebar -->
</div>
</div>