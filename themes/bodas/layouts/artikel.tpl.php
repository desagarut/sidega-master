<!DOCTYPE html>
<html lang="en">
<?php $this->load->view($folder_themes . '/commons/head') ?>

<body>
    <?php $this->load->view($folder_themes . '/commons/spinner.php') ?>
    <?php $this->load->view($folder_themes . '/commons/nav.php') ?>
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Artikel</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Artikel</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php $this->load->view($folder_themes . '/partials/artikel') ?>
                </div>
                <div class="col-md-3">
                    <?php $this->load->view($folder_themes . '/partials/artikel-side') ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view($folder_themes . '/commons/footer') ?>
</body>

</html>