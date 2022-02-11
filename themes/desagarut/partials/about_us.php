    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Tentang <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></h2>
        </div>

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            <p>
              <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?> adalah salah satu desa yang terletak di <?= ucwords($this->setting->sebutan_kecamatan." ".$desa['nama_kecamatan'])?> <?= ucwords($this->setting->sebutan_kabupaten." ".$desa['nama_kabupaten'])?> Provinsi <?= ucwords($this->setting->sebutan_propinsi." ".$desa['nama_propinsi'])?>, Dengan Batas Wilayah:.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Di Utara berbatasan dengan <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['batas_utara']) ?></li>
              <li><i class="ri-check-double-line"></i> Di Selatan berbatasan dengan <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['batas_selatan']) ?></li>
              <li><i class="ri-check-double-line"></i> Di Timur berbatasan dengan <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['batas_timur']) ?></li>
              <li><i class="ri-check-double-line"></i> Di Timur berbatasan dengan <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['batas_barat']) ?></li>            
			</ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <p>
              <?= ucwords($this->setting->profil_singkat." ".$desa['profil_singkat'])?>
            </p>
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->
