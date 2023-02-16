<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="inner-content">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="footer-logo text-center">
                            <a href="<?= site_url('first') ?>">
                                <img src="<?= gambar_desa($desa['logo']) ?>" style="padding-bottom: 5px; width:38px;" alt="Logo">
                            </a></br>
                            <a href="<?= site_url('first') ?>" style="color:white; text-shadow: 2px 1px 2px #000; -webkit-text-stroke: 1px transparent; font-size: 25px; font-weight: normally; text-transform: normally; font-family: candara">
                                <?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="footer-newsletter">
                            <h4 class="title">
                                Subscribe to our Newsletter
                                <span>Get all the latest information, Sales and Offers.</span>
                            </h4>
                            <div class="newsletter-form-head">
                                <form action="#" method="get" target="_blank" class="newsletter-form">
                                    <input name="EMAIL" placeholder="Email address here..." type="email">
                                    <div class="button">
                                        <button class="btn">Subscribe<span class="dir-part"></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->

    <!-- Start Footer Middle -->
    <div class="footer-middle">
        <div class="container">
            <div class="bottom-inner">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-contact">
                            <h3>Alamat Kantor</h3>
                            <p class="phone">Phone: <?= $desa['telepon']; ?></p>
                            <p class="mail">Email:
                                <a href="mailto:<?= $desa['email_desa']; ?>"><?= $desa['email_desa']; ?></a>
                            </p>
                            <p>Alamat:<br />
                                <?= $desa['alamat_kantor']; ?>
                            </p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer our-app">
                            <h3>Our Mobile App</h3>
                            <ul class="app-btn">
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="lni lni-gift"></i>
                                        <span class="small-title">Cek Bantuan Sosial</span>
                                        <span class="big-title">Kemensos.go.id</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="lni lni-play-store"></i>
                                        <span class="small-title">Cek NPWP</span>
                                        <span class="big-title">ereg.pajak.go.id</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-link">
                            <h3>Information</h3>
                            <ul>
                                <li><a href="javascript:void(0)">About Us</a></li>
                                <li><a href="javascript:void(0)">Contact Us</a></li>
                                <li><a href="javascript:void(0)">Downloads</a></li>
                                <li><a href="javascript:void(0)">Sitemap</a></li>
                                <li><a href="javascript:void(0)">FAQs Page</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-link">
                            <h3>Statistik Pengunjung</h3>
                            <?php $this->load->view($folder_themes . '/widgets/statistik_pengunjung.php') ?>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Middle -->

    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="inner-content">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-12">
                        <div class="payment-gateway">
                            <span>Mitra:</span>
                            <a href="https://member.ardetamedia.com/aff.php?aff=7199" ><img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/ardetamedia.png" ) ?>" alt="#" style="height: 50px; width:auto"></a>&nbsp;
                            <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/ceriateam.png" ) ?>"alt="#" style="height: 50px; width:50px">&nbsp;
                            <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/neosidega.png" ) ?>"alt="#" style="height: 50px; width:50px">&nbsp;
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="copyright">
                            <p><strong><a href="https://desagarut.net" target="_blank"><?= $this->setting->website_title ?>
                                        <?= AmbilVersi() ?> | Tema <?= $this->setting->web_theme ?> <?= THEME_VERSION ?></a> </strong>
                        </div>
                        <div class="copyright"><?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>  &copy;
                            <?= date('Y') ?> <br /> Diberdayakan Oleh <?= $this->setting->pemberdaya ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <ul class="socila">
                            <li>
                                <span>Follow Us On:</span>
                            </li>
                            <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Bottom -->
    <div>
        <nav class="footer-links text-lg-right text-center pt-0 pt-lg-0 navbar-light bg-warning navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom">
            <ul class="navbar-nav nav-justified">
                <li class="nav-item"><small> <a href="<?= site_url('first') ?>" class="nav-link" title="Home"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm9-8.586 6 6V15l.001 5H6v-9.585l6-6.001z"></path>
                                <path d="M12 17c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2z"></path>
                            </svg><br />
                            </a></small> </li>
                <li class="nav-item"><small> <a href="<?= site_url('arsip') ?>" class="nav-link" title="Berita"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                <path d="M19.875 3H4.125C2.953 3 2 3.897 2 5v14c0 1.103.953 2 2.125 2h15.75C21.047 21 22 20.103 22 19V5c0-1.103-.953-2-2.125-2zm0 16H4.125c-.057 0-.096-.016-.113-.016-.007 0-.011.002-.012.008L3.988 5.046c.007-.01.052-.046.137-.046h15.75c.079.001.122.028.125.008l.012 13.946c-.007.01-.052.046-.137.046z"></path>
                                <path d="M6 7h6v6H6zm7 8H6v2h12v-2h-4zm1-4h4v2h-4zm0-4h4v2h-4z"></path>
                            </svg><br />
                            </a></small> </li>
                <li class="nav-item"><small> <a href="<?= site_url('first/statistik/15') ?>" class="nav-link" title="Statistik"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                <path d="M6 21H3a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1zm7 0h-3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v17a1 1 0 0 1-1 1zm7 0h-3a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1z"></path>
                            </svg><br />
                            </a></small></li>
                <!--<li class="nav-item"> <small><a href="<?= site_url('peta') ?>" class="nav-link" title="Map"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                <path d="m9 6.882-7-3.5v13.236l7 3.5 6-3 7 3.5V7.382l-7-3.5-6 3zM15 15l-6 3V9l6-3v9z"></path>
                            </svg><br />
                            </a></small> </li>-->
                <li class="nav-item"> <small><a href="<?= site_url('first/toko_show') ?>" class="nav-link" title="Toko Warga"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                <path d="M15.7497 6.75V7.5C15.7497 9.57107 14.0707 11.25 11.9997 11.25C9.9286 11.25 8.24966 9.57107 8.24966 7.5V6.75M5.39221 20.25H18.6071C19.4892 20.25 20.1808 19.4926 20.101 18.6142L18.8737 5.1142C18.8034 4.34158 18.1556 3.75 17.3798 3.75H6.61948C5.84368 3.75 5.19588 4.34158 5.12564 5.1142L3.89837 18.6142C3.81852 19.4926 4.51016 20.25 5.39221 20.25Z" stroke="#3A52EE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg><br />
                            </a></small> </li>
                <li class="nav-item"><small> <a href="<?= site_url('mandiri_web') ?>" class="nav-link" title="Login"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 25 25" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                <path d="m10.998 16 5-4-5-4v3h-9v2h9z"></path>
                                <path d="M12.999 2.999a8.938 8.938 0 0 0-6.364 2.637L8.049 7.05c1.322-1.322 3.08-2.051 4.95-2.051s3.628.729 4.95 2.051S20 10.13 20 12s-.729 3.628-2.051 4.95-3.08 2.051-4.95 2.051-3.628-.729-4.95-2.051l-1.414 1.414c1.699 1.7 3.959 2.637 6.364 2.637s4.665-.937 6.364-2.637C21.063 16.665 22 14.405 22 12s-.937-4.665-2.637-6.364a8.938 8.938 0 0 0-6.364-2.637z"></path>
                            </svg><br />
                            </a> </small></li>
            </ul>
        </nav>
    </div>
</footer>

<!-- End Footer -->
<!-- ========================= scroll-top ========================= -->
<a href="#" class="scroll-top">
    <i class="lni lni-chevron-up"></i>
</a>


<script>
    $('.dropdown-toggle').dropdown()
</script>
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
<script>
        const finaleDate = new Date("February 15, 2023 00:00:00").getTime();

        const timer = () => {
            const now = new Date().getTime();
            let diff = finaleDate - now;
            if (diff < 0) {
                document.querySelector('.alert').style.display = 'block';
                document.querySelector('.container').style.display = 'none';
            }

            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
            let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
            let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
            let seconds = Math.floor(diff % (1000 * 60) / 1000);

            days <= 99 ? days = `0${days}` : days;
            days <= 9 ? days = `00${days}` : days;
            hours <= 9 ? hours = `0${hours}` : hours;
            minutes <= 9 ? minutes = `0${minutes}` : minutes;
            seconds <= 9 ? seconds = `0${seconds}` : seconds;

            document.querySelector('#days').textContent = days;
            document.querySelector('#hours').textContent = hours;
            document.querySelector('#minutes').textContent = minutes;
            document.querySelector('#seconds').textContent = seconds;

        }
        timer();
        setInterval(timer, 1000);
    </script>