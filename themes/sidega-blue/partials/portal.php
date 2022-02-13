    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container" style="padding-top:30px">

        <div class="section-title" data-aos="fade-left">
          <h2>Portal <?= ucfirst($this->setting->sebutan_desa)?></h2>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-3 col-md-4">
            <div class="icon-box">
              <i class="ri-newspaper-fill" style="color: #b2904f;"></i>
              <h3><a href="<?= site_url('first/arsip') ?>">Berita <?=ucwords($this->setting->sebutan_desa)?></a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-bar-chart-2-fill" style="color: #5578ff;"></i>
              <h3><a href="<?= site_url('first/statistik/15') ?>">Statistik <?=ucwords($this->setting->sebutan_desa)?></a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
              <h3><a href="#">Agenda <?=ucwords($this->setting->sebutan_desa)?></a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="ri-fingerprint-line" style="color: #29cc61;"></i>
              <h3><a href="<?= site_url('mandiri_web') ?>">Layanan Masyarakat</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-road-map-fill" style="color: #47aeff;"></i>
              <h3><a href="<?= site_url('peta') ?>">Peta <?=ucwords($this->setting->sebutan_desa)?></a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-signal-tower-line" style="color: #ffa76e;"></i>
              <h3><a href="">WiFi Gratis</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
              <h3><a href="">Surat Online</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-download-cloud-line" style="color: #4233ff;"></i>
              <h3><a href="">Unduhan</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-store-2-line" style="color: #ffbb2c;"></i>
              <h3><a href="<?= site_url('first/toko_show') ?>">UMKM <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-youtube-fill" style="color: #b20969;"></i>
              <h3><a href="">Sosial Media</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-link" style="color: #ff5828;"></i>
              <h3><a href="">Tautan Penting</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-funds-fill" style="color: #e361ff;"></i>
              <h3><a href="<?= site_url('first/status_idm') ?>">Perkembangan Desa</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->
