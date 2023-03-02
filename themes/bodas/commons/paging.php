<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
$pages = array();
for ($i = $paging->start_link; $i <= $paging->end_link; $i++) {
	array_push($pages, $i);
}
?>

<div class="row py-3">
	<div class="wow fadeInUp" data-wow-delay="0.1s">
		<nav class="navbar navbar-expand-lg sticky-top p-0">
			<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="navbar-nav ms-auto p-4 p-lg-0">
				<?php if ((int) $paging->end_link > 1) : ?>
					<div class="navbar-nav">
						<?php if ($paging->start_link) : ?>
							<a href="<?= site_url('first/' . $paging_page . '/' . $paging->start_link) ?>" class="disabled" style="padding:10px 10px 10px 10px"><i class="fa fa-arrow-left"></i></a>
						<?php endif ?>
						<?php if ($paging->prev) : ?>
							<a href="<?= site_url('first/' . $paging_page . '/' . $paging->prev . $paging->suffix) ?>" class="disabled" style="padding:10px 10px 10px 10px"></a>
						<?php endif ?>
						<?php foreach ($pages as $page) : ?>
							<a href="<?= site_url('first/' . $paging_page . '/' . $page . $paging->suffix) ?>" class="active" style="padding:10px 10px 10px 10px"><?= $page ?></a>
						<?php endforeach ?>
						<?php if ($paging->next) : ?>
							<a href="<?= site_url('first/' . $paging_page . '/' . $paging->next . $paging->suffix) ?>" class="disabled" style="padding:10px 10px 10px 10px"></a>
						<?php endif ?>
						<?php if ($paging->end_link) : ?>
							<a href="<?= site_url('first/' . $paging_page . '/' . $paging->end_link) ?>" class="disabled" style="padding:10px 10px 10px 10px"><i class="fa fa-arrow-right"></i></a>
						<?php endif ?>
					</div>
			</div>
				<?php endif ?>
			</div>
		</nav>
	</div>
</div>