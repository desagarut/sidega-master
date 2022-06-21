<!-- Vendor JS Files -->
<!--<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/jquery/jquery.min.js")?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/jquery.easing/jquery.easing.min.js")?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/php-email-form/validate.js")?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/waypoints/jquery.waypoints.min.js")?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/owl.carousel/owl.carousel.min.js")?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/isotope-layout/isotope.pkgd.min.js")?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/venobox/venobox.min.js")?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/aos/aos.js")?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/swiper/swiper-bundle.min.js")?>"></script>-->

<!-- Vendor JS Files -->
<!--<script src="<?= base_url("$this->theme_folder/$this->theme/assets/vendor/jquery-sticky/jquery.sticky.js")?>"></script>-->

<!-- Template Main JS File -->
<!--<script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/main.js")?>"></script>
<script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/script.js")?>"></script>
<script src="<?= base_url()?>assets/bootstrap/js/jquery.dataTables.min.js"></script> 
<script src="<?= base_url()?>assets/bootstrap/js/dataTables.bootstrap.min.js"></script> 
		<script src="<?= base_url() ?>assets/bootstrap/js/jquery.min.js"></script>-->

<!-- Bootstrap 3.3.7 --> 
<!--<script src="<?= base_url()?>assets/bootstrap/js/bootstrap.min.js"></script> -->

<!-- Select2 --> 
<!--<script src="<?= base_url()?>assets/bootstrap/js/select2.full.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.6.0/leaflet-providers.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl/1.11.1/mapbox-gl.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mapbox-gl-leaflet/0.0.12/leaflet-mapbox-gl.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.cycle2/2.1.6/jquery.cycle2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/9.2.1/highcharts.min.js"></script>
<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>-->


<script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/bootstrap.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/tiny-slider.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/glightbox.min.js")?>"></script>
    <script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/main.js")?>"></script>
    <script type="text/javascript">
        //========= Hero Slider 
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });

        //======== Brand Slider
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });
    </script>