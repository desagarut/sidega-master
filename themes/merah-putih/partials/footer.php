<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Address</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?= $kabupaten['alamat_kantor']; ?></p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?= $kabupaten['telepon']; ?></p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i><?= $kabupaten['email']; ?></p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="https://help.desagarut.id">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Gallery</h5>
                    <div class="row g-2">
                        <div class="col-4">
                            <img class="img-fluid rounded" src="<?= base_url("$this->theme_folder/$this->theme/img/project-1.jpg")?>" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded" src="<?= base_url("$this->theme_folder/$this->theme/img/project-2.jpg")?>" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded" src="<?= base_url("$this->theme_folder/$this->theme/img/project-3.jpg")?>" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded" src="<?= base_url("$this->theme_folder/$this->theme/img/project-4.jpg")?>" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded" src="<?= base_url("$this->theme_folder/$this->theme/img/project-5.jpg")?>" alt="Image">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid rounded" src="<?= base_url("$this->theme_folder/$this->theme/img/project-6.jpg")?>" alt="Image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>More information.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent border-secondary w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#"><?= $this->setting->website_title ?></a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-danger btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/lib/wow/wow.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/lib/easing/easing.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/lib/waypoints/waypoints.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/lib/counterup/counterup.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/lib/owlcarousel/owl.carousel.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/lib/lightbox/js/lightbox.min.js")?>"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url("$this->theme_folder/$this->theme/js/main.js")?>"></script>
