<div class="content-wrapper">
	<section class="content-header">
		<h1>Panduan Data SPPT PBB <?=ucwords($this->setting->sebutan_desa)?> <?= $desa["nama_desa"];?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('data_sppt/clear')?>"> Daftar SPPT PBB</a></li>
			<li class="active">Panduan SPPT PBB</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<div class="col-md-3">
          <?php $this->load->view('data_sppt/menu.php')?>
				</div>
				<div class="col-md-9">
					<div class="box box-info">
						<div class="box-body">
							<h4>Keterangan</h4>
							<p><strong>Modul Data SPPT PBB</strong> adalah modul untuk pengelolaan data tentang kepemilikan lahan, termasuk riwayat kepemilikan.</p>
							<h4>Panduan</h4>
							<p>Secara garis besar, proses pengisian data SPPT PBB adalah sebagai berikut:</p>
							<p>
								<ol>
									<li>Buat <strong>SPPT PBB</strong>
										<p>Buat satu SPPT PBB untuk setiap penduduk yang akan dicatat kepemilikan lahannya. Setiap SPPT PBB digunakan untuk mencatat semua kepemilikan lahan penduduk tersebut.</p>
									</li>
									<li>Buat <strong>Persil</strong>
										<p>Persil berisi keterangan lahan yang dimiliki penduduk dan dicatat dalam SPPT PBB pemilik. Beberapa pemilik bisa mempunyai lahan di persil yang sama. Beberapa persil dapat mempunyai Nomor Persil yang sama. Untuk membedakan, isi juga Nomor Urut Bidang yang unik untuk Persil ybs. Pemilik awal suatu persil dicatat dengan masukkan SPPT PBB pemilik ybs.</p>
									</li>
									<li>Buat <strong>Mutasi Persil</strong>
										<p>Buat mutasi untuk setiap pergantian kepemilikan suatu lahan. Mutasi dapat dilakukan untuk sebagian dari luas suatu persil.</p>
									</li>
								</ol>
							</p>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>

