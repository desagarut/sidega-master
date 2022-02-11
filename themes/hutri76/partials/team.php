<!-- ======= Our Team Section ======= -->

<section id="team" class="team section-bg">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Aparatur <strong>Desa</strong></h2>
      <p><i>dengan ikhlas mengabdi</i></p>
    </div>
    <div class="row">
      <?php foreach($aparatur_desa['daftar_perangkat'] as $data) : ?>
      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" style="width:250px">
          <div class="member-img"> <img src="<?= $data['foto'] ?>" alt="<?= $data['nama'] ?>" width="250px">
            <div class="social"> <a href=""><i class="icofont-twitter"></i></a> <a href=""><i class="icofont-facebook"></i></a> <a href=""><i class="icofont-instagram"></i></a> <a href=""><i class="icofont-linkedin"></i></a> </div>
          </div>
          <div class="member-info">
            <h4>
              <?= $data['nama'] ?>
            </h4>
            <span>
            <?= $data['jabatan'] ?>
            </span> </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- End Our Team Section --> 

<!-- ======= Hero Section ======= --> 
