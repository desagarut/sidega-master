    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="http://portal.sthgarut.ac.id:8060">Siakad</a>
                    <a class="btn btn-link" href="https://sister.lldikti4.id">Sister</a>
                    <a class="btn btn-link" href="http://portal.sthgarut.ac.id:8100">Neo Feeder</a>
                    <a class="btn btn-link" href="https://pddikti.kemdikbud.go.id">PDDIKTI</a>
                    <a class="btn btn-link" href="https://pin.kemdikbud.go.id">P I N</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?= $desa['alamat_kantor']; ?></p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?= $desa['telepon']; ?></p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i><?= $desa['email']; ?></p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-1.jpg")?>" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-2.jpg")?>" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-3.jpg")?>" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-2.jpg")?>" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-3.jpg")?>" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-1.jpg")?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dapatkan update terbaru dari kami</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#"><?= $this->setting->website_title ?></a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="<?= site_url('') ?>">Home</a>
                            <a href="http://portal.sthgarut.ac.id">Siakad</a>
                            <a href="<?= site_url('peta') ?>">Maps</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/wow/wow.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/easing/easing.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/waypoints/waypoints.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/owlcarousel/owl.carousel.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/counterup/counterup.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/easing/easing.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/lightbox/js/lightbox.min.js")?>"></script>
    <!-- Template Javascript -->
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/main.js")?>"></script>
