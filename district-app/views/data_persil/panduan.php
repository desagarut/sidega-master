<div class="content-wrapper">
	<section class="content-header">
		<h1>Panduan Data Letter-C <?=ucwords($this->setting->sebutan_deskel)?> <?= $kelurahan["nama_deskel"];?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('home')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('data_persil/clear')?>"> Daftar Persil</a></li>
			<li class="active">Panduan Persil</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<div class="col-md-3">
          <?php $this->load->view('data_persil/menu_kiri.php')?>
				</div>
				<div class="col-md-9">
					<div class="box box-info">
						<div class="box-body">
							<h4>Keterangan</h4>
							<p><strong>Modul Data Letter-C</strong> adalah modul untuk pengelolaan data tentang kepemilikan lahan, termasuk riwayat kepemilikan.</p>
							<h4>Panduan</h4>
							<p>Secara garis besar, proses pengisian data Letter-C adalah sebagai berikut:</p>
							<p>
								<ol>
									<li>Buat <strong>Letter-C</strong>
										<p>Buat satu Letter-C untuk setiap penduduk yang akan dicatat kepemilikan lahannya. Setiap Letter-C digunakan untuk mencatat semua kepemilikan lahan penduduk tersebut.</p>
									</li>
									<li>Buat <strong>Persil</strong>
										<p>Persil berisi keterangan lahan yang dimiliki penduduk dan dicatat dalam Letter-C pemilik. Beberapa pemilik bisa mempunyai lahan di persil yang sama. Beberapa persil dapat mempunyai Nomor Persil yang sama. Untuk membedakan, isi juga Nomor Urut Bidang yang unik untuk Persil ybs. Pemilik awal suatu persil dicatat dengan masukkan Letter-C pemilik ybs.</p>
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

