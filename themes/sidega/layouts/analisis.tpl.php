<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body>

	<?php $this->load->view($folder_themes .'/commons/header') ?>
	<?php // $this->load->view($folder_themes .'/partials/newsticker') ?>
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <h5><?= $heading ?></h5>
      <ol>
        <li><a href="<?= site_url("first"); ?>">Home</a></li>
        <li><?= $heading ?></li>
      </ol>
    </div>
  </div>
</section><!-- End Breadcrumbs -->
    
	<div class="row">
		<section>
			<div class="content_middle"></div>
			<div class="content_bottom">
				<div class="col-lg-9 col-md-9">
					<div class="content_bottom_left">
						<div class="single_page_area">
							<?php if($list_jawab): ?>
								<div class='box'>";
									<?php $this->load->view($folder_themes.'/partials/analisis.php'); ?>
								</div>
							<?php else: ?>
								<div class="">
									<div class="single_page_area">
										<h2 class="post_titile">DAFTAR AGREGASI DATA ANALISIS DESA</h2>
										<div class="single_bottom_rightbar wow fadeInDown animated">
											<h2>Klik untuk melihat lebih detail</h2>
										</div>
									</div>
									<?php foreach($list_indikator AS $data): ?>
										<div class="box-header">
											<a href="<?= site_url('first/data_analisis/'.$data['id'].'/'.$data['subjek_tipe'].'/'.$data['id_periode']);?>">
												<h4><?= $data['indikator']?></h4>
											</a>
										</div>
										<div class="box-body" style="font-size:12px;">
											<table>
												<tr>
													<td width="100">Pendataan </td>
													<td width="20"> :</td>
													<td> <?= $data['master']?></td>
												</tr>
												<tr>
													<td>Subjek </td>
													<td> : </td>
													<td> <?= $data['subjek']?></td>
												</tr>
												<tr>
													<td>Tahun </td>
													<td> :</td>
													<td> <?= $data['tahun']?></td>
												</tr>
											</table>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3">
						<?php $this->load->view("$folder_themes/partials/bottom_content_right.php"); ?>
					</div>
				</div>
			</section>
		</div>
        
	<footer id="footer">
		<?php $this->load->view("$folder_themes/partials/footer_top.php"); ?>
		<?php $this->load->view("$folder_themes/partials/footer_bottom.php"); ?>
	</footer>
	<?php $this->load->view("$folder_themes/commons/meta_footer.php"); ?>
</body>
</html>
