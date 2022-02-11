<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style type="text/css">
table.table th {
	text-align: left;
}
#list_dokumen td.nowrap {
	white-space: nowrap;
}

</style>
<script type='text/javascript'>
	const LOKASI_DOKUMEN = '<?= base_url().LOKASI_DOKUMEN ?>';
</script>

<div class="content-wrapper">
  <section class="content" id="maincontent">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-4"> 
          
          <!-- Profile Image -->
          
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div align="center">
                <p class="text-muted text-center"> <small> Hai <?= strtoupper($penduduk['nama'])?>, selamat datang di layanan <?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']); ?>, anda login sebagai </small> </p>
                <?php if ($penduduk['foto']): ?>
                <img class="img-responsive img-circle" src="<?= AmbilFoto($penduduk['foto'])?>" alt="Foto Penduduk">
                <?php else: ?>
                <img class="img-responsive img-circle" src="<?= base_url()?>assets/files/user_pict/kuser.png" alt="Foto Penduduk">
                <?php endif; ?>
                <h3 class="profile-username text-center">
                  <h5 style="color:#06F">
                    <?= strtoupper($penduduk['nama'])?>
                  </h5>
                </h3>
                <p class="text-muted text-center"> <small> dengan user
                  <?= $penduduk['nik']?>
                  </small> </p>
              </div>
              <small><a href="<?= site_url();?>mandiri_web/mandiri/1/6" class="btn bg-purple btn-block btn-sm"><b>Profil</b></a></small> </div>
            
            <!-- /.box-body --> 
            
          </div>
          <div class="box box-primary box-solid">
            <div class="box-body"> 
            <a class="btn btn-app" style="color:#06F" href="<?=site_url('arsip')?>" title="Tulis Berita"><i class="fa fa-bullhorn text-yellow"></i> Berita</a> 
              <a class="btn btn-app" style="color:#06F" href="<?= site_url('mandiri_web/mandiri/1/3');?>" title="Pesan"><span class="badge bg-aqua"></span><i class="fa fa-envelope text-green"></i> Pesan </a> 
              <a class="btn btn-app" style="color:#06F" href="<?= site_url('mandiri_web/mandiri/1/2');?>"> <i class="fa fa-paper-plane-o text-aqua"></i> Buat Surat</a> 
              <a class="btn btn-app" style="color:#06F" href="<?=site_url('mandiri_web/mandiri/1/4')?>"><i class="fa fa-handshake-o text-blue"></i> <span class="badge bg-blue">
              <?=$komentar?>
              </span>Bantuan </a> 
              <a class="btn btn-app" style="color:#06F" href="<?=site_url('mandiri_web/ganti_pin')?>" title="Ubah PIN "> <i class="fa fa-key"></i> Ubah PIN </a> 
              <a class="btn btn-app" style="color:#06F" href="<?=site_url('mandiri_web/mandiri_dokumen')?>" title="Ubah PIN "> <i class="fa fa-file"></i> Dokumen </a> 
              </div>
          </div>
        </div>
        <div class="col-md-8">
          <!--<div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box bg-green"> <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content"> <span class="info-box-text">Status PBB</span> <span class="info-box-number">Lunas</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description"> Rp. 125.000,00 </span> </div>
                
                
              </div>
              
              
            </div>
          </div>
          
          <!-- /.row -->
          
          <?php $this->load->view('web/mandiri/penduduk_map.php');?>
          
          <!--<div class="nav-tabs-custom">

                <ul class="nav nav-tabs">

                  <li ><a href="#biodata" data-toggle="tab">Biodata</a></li>

                  <li><a href="#keluarga" data-toggle="tab">Keluarga</a></li>

                  <li><a href="#kelompok" data-toggle="tab">Kelompok</a></li>

                  <li><a href="#dok" data-toggle="tab">Dokumen</a></li>

                  <li><a href="#bantuan" data-toggle="tab">Bantuan</a></li>

                  <li><a href="#rumah" data-toggle="tab">Foto Rumah</a></li>

                  <li class="active"><a href="#resume" data-toggle="tab">Resume</a></li>

                </ul>

                <div class="tab-content"> 

                  <!-- /Profile Biodata-->
          
          <?php //$this->load->view('web/mandiri/profil_biodata.php');?>
          
          <!-- /Profile Keluarga-->
          
          <?php //$this->load->view('web/mandiri/profil_keluarga.php');?>
          
          <!-- /Profile Pokmas-->
          
          <?php //$this->load->view('web/mandiri/profil_pokmas.php');?>
          
          <!-- /Profile Dokumen-->
          
          <?php //$this->load->view('web/mandiri/profil_dokumen.php');?>
          
          <!-- /Profile Program Bantuan-->
          
          <?php //$this->load->view('web/mandiri/profil_program_bantuan.php');?>
          
          <!-- /Profile Rumah Tinggal-->
          
          <?php //$this->load->view('web/mandiri/profil_rumah.php');?>
          
          <!-- /Profile mandiri-->
          
          <?php //$this->load->view('web/mandiri/profil_resume.php');?>
          
          <!--  </div>

              </div>--> 
          
          <!-- /.box --> 
          
          <!-- About Me Box -->
          
          <div class="box box-primary">
            <div class="box-header with-border"> <small>
              <h4 class="box-title">Ringkasan</h4>
              </small> </div>
            
            <!-- /.box-header -->
            
            <div class="box-body"><small> <strong><i class="fa fa-book margin-r-5"></i> Pendidikan Terakhir</strong></small>
              <p class="text-muted"> <small>
                <?= strtoupper($penduduk['pendidikan_kk'])?>
                </small> </p>
              <hr>
              <small><strong><i class="fa fa-map-marker margin-r-5"></i> Alamat Sekarang</strong></small>
              <p class="text-muted"><small>
                <?= strtoupper($penduduk['alamat'])?>
                ,
                <?= strtoupper($penduduk['dusun'])?>
                ,
                <?= strtoupper($penduduk['rt'])?>
                /
                <?= $penduduk['rw']?>
                , </small></p>
              <hr>
              <small><strong><i class="fa fa-pencil margin-r-5"></i> Kontak</strong>
              <p> <span class="label label-info"><i class="fa fa-phone"></i>
                <?= $penduduk['telepon']?>
                </span> <span class="label label-warning"><i class="fa fa-envelope"></i>
                <?= $penduduk['email']?>
                </span> </p>
              </small>
              <hr>
              <small><strong><i class="fa fa-file-text-o margin-r-5"></i> Catatan:</strong> <br>
              Biodata Penduduk (NIK :
              <?= $penduduk['nik']?>
              )
              <?php if (!empty($penduduk['nama_pendaftar'])): ?>
              <p class="kecil"> Terdaftar pada: <i class="fa fa-clock-o"></i>
                <?= tgl_indo2($penduduk['created_at']);?>
                Oleh: <i class="fa fa-user"></i>
                <?= $penduduk['nama_pendaftar']?>
              </p>
              <?php else: ?>
              <p class="kecil"> Terdaftar sebelum: <i class="fa fa-clock-o"></i>
                <?= tgl_indo2($penduduk['created_at']);?>
              </p>
              <?php endif; ?>
              <?php if (!empty($penduduk['nama_pengubah'])): ?>
              <p class="kecil"> Terakhir diubah: <i class="fa fa-clock-o"></i>
                <?= tgl_indo2($penduduk['updated_at']);?>
                <i class="fa fa-user"></i>
                <?= $penduduk['nama_pengubah']?>
              </p>
              <?php endif; ?>
              </small> </div>
            
            <!-- /.box-body --> 
            
          </div>
          
          <!-- /.box --> 
          
        </div>
        
        <!-- /.col --> 
        
      </div>
    </div>
  </section>
</div>

