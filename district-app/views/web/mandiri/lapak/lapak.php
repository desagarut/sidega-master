<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="lapak profil">
	<div class="row">
		<div class="col-md-3 col-xs-12">
			<div class="left-box">
				<div class="section-logo-lapak">
						<?php if ($penduduk['foto']): ?>
							<img class="foto-penduduk center" src="<?= AmbilFoto($penduduk['foto'])?>" alt="Foto">
						<?php else: ?>
							<img class="foto-penduduk center" src="<?php echo base_url().$this->theme_folder.'/'.$this->theme; ?>/assets/images/icons/no-foto.png" alt="Foto">
						<?php endif; ?>
				</div>
				<div class="nama-lapak"><?=$lapak['nama'] ?></div>				
				<div class="fungsi-tombol">
					<div class="row">
						<div class="col-xs-6">
							<a href="<?php echo site_url('layanan_mandiri/lapak/buat'); ?>">
								<div class="lihat-lapak">
									<div class="icon-tombol"><i class="fa fa-pencil-square-o"></i></div>
									<div class="nama-tombol">Buat Lapak</div>
								</div>
							</a>
						</div>
						<div class="col-xs-6">
							<a href="<?php echo site_url('layanan_mandiri/lapak/update'); ?>">
								<div class="tambah-barang">
									<div class="icon-tombol"><i class="fa fa-refresh"></i></div>
									<div class="nama-tombol">Update Lapak</div>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="menu-lapak">
					<a href="<?php echo site_url('layanan_mandiri/lapak/input'); ?>">
						<div class="menu">
							<span class="icon-menu"><i class="ti-layers"></i></span>
							Tambah Barang
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-9 col-xs-12">
			<div class="right-box">
				<div class="data-box">
					<div class="head-right-lapak">Halo Lapak <?=$lapak['nama'] ?> !!!</div>
					<div class="sub-right-lapak">Berikut ini adalah ringkasan informasi yang terjadi di lapak anda.</div>
					<div class="personal-profile">
						<div class="header-profile">Data Lapak</div>
					</div>
					<div class="section-data-personal table-responsive">						
						<table class="table table-striped">
							<tr>
								<td class="label-data-table">Nama Lapak</td>
								<td width="2%">:</td>
								<td class="uppercase" width="70%"><?=$lapak['nama'] ?></td>
							</tr>
							<tr>
								<td class="label-data-table">Nomor Telepon</td>
								<td>:</td>
								<td class="uppercase"><?=$lapak['wa'] ?></td>
							</tr>
							<tr>
								<td class="label-data-table">Deskripsi Lapak</td>
								<td>:</td>
								<td class="uppercase"><?=$lapak['deskripsi'] ?></td>
							</tr>
							<tr>
								<td class="label-data-table">Alamat Usaha</td>
								<td>:</td>
								<td class="uppercase"><?=$lapak['alamat'] ?></td>
							</tr>
						</table>
					</div>
						
					<div class="personal-profile">
						<div class="header-profile">Data Barang Jualan</div>
					</div>				
					<div class="section-data-personal">
						<div class="row">
							<div class="col-md-3 col-xs-6">
								<div class="small-box bg-green">
									<div class="inner">
										<div class="jumlah-widget"><?=count($lapak['barang']['terbit']) ?></div>
										<p class="title-widget">Ditampilkan</p>
									</div>
									<div class="icon">
										<i class="fa fa-eye"></i>
									</div>
								</div>
							</div>
							
							<div class="col-md-3 col-xs-6">
								<div class="small-box bg-orange">
									<div class="inner">
										<div class="jumlah-widget"><?=count($lapak['barang']['pending']) ?></div>
										<p class="title-widget">Tertunda</p>
									</div>
									<div class="icon">
										<i class="fa fa-eye-slash"></i>
									</div>
								</div>
							</div>
							
							<div class="col-md-3 col-xs-6">
								<div class="small-box bg-red">
									<div class="inner">
										<div class="jumlah-widget"><?=count($lapak['barang']['tolak']) ?></div>
										<p class="title-widget">Ditolak</p>
									</div>
									<div class="icon">
										<i class="fa fa-ban"></i>
									</div>
								</div>
							</div>
							
							<div class="col-md-3 col-xs-6">
								<div class="small-box bg-aqua">
									<div class="inner">
										<div class="jumlah-widget"><?=count($lapak['barang']['all']) ?></div>
										<p class="title-widget">Semua Barang</p>
									</div>
									<div class="icon">
										<i class="fa fa-cubes"></i>
									</div>
								</div>
							</div>
						</div>

						<?php

							$page = intval($_GET['page']);

							if ($page < 1) {

								$page = 1;
							}
							
							$limit = 5;
							$offset = ($page - 1) * $limit;

							$jumlahHalaman = ceil(count($lapak['barang']['all'])/$limit);

						?>
							<table class="table table-bordered table-barang table-hover">
								<thead class="bg-gray disabled color-palette">
									<tr>
										<th class="text-center" width="2%"><input type="checkbox" id="checkall"></th>	
										<th width="11%">Foto</th>
										<th width="30%">Nama & Harga Barang</th>											
										<th width="15%">Kategori</th>
										<th class="text-center" width="10%">Stok</th>
										<th width="20%">Aksi</th>
										<th class="text-center" width="7%">Status</th>
									</tr>
								</thead>
							</table>
							<?php for($i = $offset; $i < $offset + $limit; $i++): ?>
							<?php if ($item = $lapak['barang']['all'][$i]): ?>
							<div class=" table-responsive">
								<table class="table table-bordered table-barang table-hover">
									<tbody>
										<?php $urut = 0; ?>
										<tr>
											<td class="text-center" width="2%">
												<input type="checkbox" name="id_cb[]" value="529">
											</td>	
											<td nowrap class="text-center" width="11%">
												<img src="<?php echo base_url(); ?>assets/files/user_pict/kuser.png" class="foto-barang" alt="Foto Kepala Keluarga">
											</td>
											<td width="30%">
												<a href="<?=site_url('layanan_mandiri/lapak/barang/' . $item['id']) ?>">
													<?=$item['nama'] ?>
												</a><br />
												<?php echo uang_indo ($item['harga']); ?>
											</td>
											
											<td width="15%">
												<?php echo $item['kategori']['nama']; ?>
											</td>

											<td class="text-center" width="10%">
												<?php echo($item['stok']); ?>
											</td>

											<td nowrap width="20%">
												<a href="<?php echo base_url('/layanan_mandiri/lapak/update_barang/'.$item['id']); ?>" class="btn btn-sm bg-blue" style="padding:5px; border-radius:3px;">
														<i class="fa fa-pencil-square-o"></i>
												</a>
											<?php if ($item['status'] != 2): ?>
												<a href="<?php echo base_url('/layanan_mandiri/lapak/tampilkan/'.$item['id']); ?>" class="btn btn-sm bg-green" style="padding:5px; border-radius:3px;">
														<i class="fa fa-eye"></i>
												</a>
											<?php endif ?>
																		
											<?php if ($item['status'] == 1 || $item['status'] == 2): ?>
												<a href="<?php echo base_url('/layanan_mandiri/lapak/sembunyikan/'.$item['id']); ?>" class="btn btn-sm bg-orange" style="padding:5px; border-radius:3px;">
														<i class="fa fa-eye-slash"></i>
												</a>
											<?php endif ?>
																		 
												<a href="<?php echo base_url('/layanan_mandiri/lapak/hapus/'.$item['id']); ?>" class="btn btn-sm bg-red" style="padding:5px; border-radius:3px;">
														<i class="fa fa-trash"></i>
												</a>
											</td>
											<td class="text-center" width="7%">
											<?php if ($item['status'] == 1): ?>
												<span class="fa fa-times" style="color:orange;font-size:13px"></span>
											<?php elseif ($item['status'] == 2): ?>
												<span class="fa fa-check" style="color:green;font-size:13px"></span>
											<?php else: ?>
												<span class="fa fa-ban" style="color:red;font-size:13px"></span>
											<?php endif ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<?php endif ?>
						<?php endfor ?>

						Total Halaman: <?=$jumlahHalaman ?><br>
						Halaman Sekarang: <?=$page ?>

						<?php if ($page > 1): ?>

							<a href="<?=site_url('layanan_mandiri/lapak?page=' . + ($page - 1)) ?>"> Mundur </a>

						<?php endif ?>

						<?php if ($page < $jumlahHalaman): ?>

							<a href="<?=site_url('layanan_mandiri/lapak?page=' . + ($page + 1)) ?>"> Maju </a>

						<?php endif ?>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>