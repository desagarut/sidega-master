
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Potensi Desa</h3>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-plus"></i> <span>Potensi Umum</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">        
            <li <?php if ($this->tab_ini == 1): ?> class="active" <?php endif; ?>><a href="<?= site_url('potensi_umum')?>"><i class="fa fa-circle-o"></i> Batas Wilayah </a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-plus"></i> <span>Potensi Sumber Daya Alam</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($this->tab_ini == 1): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Jenis lahan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Iklim, Tanah  & Erosi</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Topografi</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-plus"></i> Potensi Pertanian
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                  <a href="#"><i class="fa fa-plus"></i> Tanaman Pangan
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Kepemilikan Lahan</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Hasil & Luas Produksi</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-plus"></i> Tanaman Buah-buahan
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Kepemilikan Lahan</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Hasil & Luas Produksi</a></li>
                  </ul>
                </li>
                <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Apotik Hidup</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-plus"></i> Perkebunan
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Kepemilikan Lahan</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Hasil & Luas Produksi</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-plus"></i> Kehutanan
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Kepemilikan Lahan</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Hasil Hutan</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Kondisi Hutan</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Dampak Pengolahan Hutan</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-plus"></i> Peternakan
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Jenis Populasi Ternak</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Produksi Ternak</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Lahan dan Pakan Ternak</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Pengolahan Hasil Ternak</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-plus"></i> Perikanan
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Alat Produksi Budidaya Ikan Laut</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Alat Produksi Budidaya Ikan Air Tawar</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Jenis dan Produksi Ikan</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Deposit dan Produksi Bahan Galian</a></li>
            
            <!-- Sumber Daya Air -->
            <li class="treeview">
              <a href="#"><i class="fa fa-plus"></i> Sumber Daya Air
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Potensi dan Pemanfaatan</a></li>
                <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Sumber Air Bersih</a></li>
                <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Kualitas Air Minum</a></li>
                <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Air Panas</a></li>
            	</ul>
              </li>
              
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Kualitas Udara</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Kebisingan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Ruang Publik/Taman</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Potensi Wisata</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-plus"></i> <span>Potensi Sumber Daya Manusia</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Jumlah</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Usia</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Pendidikan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Mata Pencaharian Pokok</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Agama</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Kewarganegaraan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Etnis/Suku</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Cacat Mental dan Fisik</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Tenaga Kerja</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Kualitas Angkatan Kerja</a></li>
          </ul>
        </li>
        <!-- End Potensi Sumber Daya Manusia -->
        
        <!-- Start Potensi Kelembagaan -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-plus"></i> <span>Potensi Kelembagaan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Lembaga Pemerintahan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Lembaga Kemasyarakatan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Partisipasi Politik</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Lembaga Ekonomi</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Usaha Jasa, Hiburan DLL</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Lembaga Pendidikan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Lembaga Adat</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Lembaga Keamanan</a></li>
          </ul>
        </li>
        <!-- End Potensi Kelembagaan -->
        
        <!-- Start Potensi Prasarana-sarana -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-plus"></i> <span>Potensi Prasarana-Sarana</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Prasarana Transportasi Darat</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Prasarana dan Sarana Angkutan Lainnya</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Prasarana Komunikasi dan Informasi</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Prasarana dan Kondisi Irigasi</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-plus"></i> Prasarana dan Sarana Pemerintahan
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Desa/Kelurahan</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Badan Perwakilan Desa</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Dusun atau Sebutan Lainnya</a></li>
              </ul>
            </li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Prasarana Lembaga Kemasyarakatan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Prasarana Peribadatan/a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Prasarana Olah Raga/a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Prasarana Kesehatan/a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Sarana Peribadatan/a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Prasarana dan Sarana Pendidikan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i> Prasarana Energi dan Penerangan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i>  Prasarana Wisata dan Hiburan</a></li>
            <li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="#"><i class="fa fa-circle-o"></i>  Prasarana Kebersihan</a></li>
          </ul>
        </li>
        <!--
			<li <?php if ($this->tab_ini == 10): ?>class="active"<?php endif; ?>><a href="<?= site_url('profil_potensi')?>"><i class='fa fa-plus'></i> Potensi Umum</a></li>
			<li <?php if ($this->tab_ini == 12): ?>class="active"<?php endif; ?>><a href="<?= site_url('letterc/clear')?>"><i class='fa fa-list'></i>Potensi Sumber Daya Alam</a></li>
			<li <?php if ($this->tab_ini == 13): ?>class="active"<?php endif; ?>><a href="<?= site_url('data_persil/clear')?>"><i class='fa fa-list'></i>Sumber Daya Manusia</a></li>
			<li <?php if ($this->tab_ini == 14): ?>class="active"<?php endif; ?>><a href="<?= site_url('data_persil/import')?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Impor Data Persil"><i class='fa fa-upload'></i>Potensi Kelembagaan</a></li>
            <li <?php if ($this->tab_ini == 15): ?>class="active"<?php endif; ?>><a href="<?= site_url('letterc/panduan')?>"><i class='fa fa-question-circle'></i>Prasarana-Sarana</a></li>-->
            </li>
            </ul>
            </li>
		</ul>
        
	</div>
</div>
