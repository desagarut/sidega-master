   <!-- Profile Instansi -->
   <div class="box box-primary">
     <div class="box-body box-profile">
       <img class="profile-user-img img-responsive img-circle" src="<?= gambar_desa($desa['logo']); ?>" alt="User profile picture">
       <h3 class="profile-username text-center"><?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']); ?></h3>
       <p class="text-muted text-center">
         <?= $desa['alamat_kantor']; ?> <?= ucwords($this->setting->sebutan_kecamatan . " " . $desa['nama_kecamatan']); ?> Provinsi Jawa Barat<br />
         Telepon: <?= $desa['telepon']; ?> - Email: <?= $desa['email_desa']; ?>
       </p>
       <!-- <a href="<?= site_url('identitas_desa/form'); ?>" class="btn btn-default btn-block"><b>Profil</b></a>-->
     </div>
   </div>