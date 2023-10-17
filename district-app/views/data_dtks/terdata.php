<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Profil Penduduk Terdata</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('data_dtks')?>"><i class="fa fa-home"></i> Data Kemiskinan</a></li>
			<li class="active">Profil Penduduk Terdata</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url()?>data_dtks" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Data Kategori</a>
			</div>
			<div class="box-body">
				<h5>Profil Penduduk Terdata : <b><?= strtoupper($data["nama"]); ?> </b></h5>
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover tabel-rincian">
						<tbody>
							<tr>
								<td width="20%">Nama</td>
								<td width="1%">:</td>
								<td><?= strtoupper($profil["nama"])?></td>
							</tr>
							<tr>
								<td>Keterangan</td>
								<td>:</td>
								<td><?= $profil["ndesc"]?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="box-body">
				<h5><b>Profil Warga Terdata</b></h5>
				<div class="table-responsive">
					<table class="table table-bordered dataTable table-hover tabel-daftar">
						<thead class="bg-gray disabled color-palette">
							<tr>
								<th>No</th>
								<th>Nama Data</th>
								<th width="65%">Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($daftar_data_dtks as $key => $item): ?>
								<tr>
									<td class="padat"><?= ($key + 1); ?></td>
									<td><a href="<?= site_url("data_dtks/rincian/$item[id]"); ?>"><?= $item["nama"] ?></a></td>
									<td><?= $item["keterangan"];?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>

