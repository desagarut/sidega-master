<div class="col-md-4">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Helpdesk</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div class="box-body text-center">
            <a href="<?= site_url('webmail') ?>" target="_blank"><img src="<?= base_url("assets/files/logo/email.fw.png") ?>" class="img-fluid responsive" width="70px" height="70px" alt=""></a>
            <a href="https://desagarut.id" target="_blank"><img src="<?= base_url("assets/files/logo/helpdesk.fw.png") ?>" class="img-fluid responsive" width="70px" height="70px" alt=""></a>
            <a href="https://chat.whatsapp.com/IR2VtLpT2Fx0ujlNMm3nD9" target="_blank"><img src="<?= base_url("assets/files/logo/whatsapp.fw.png") ?>" class="img-fluid responsive" width="70px" height="70px" alt="Whatsapp Komunitas Desa Garut"></a>
            <?php if ($setting_desa['website_kecamatan']) : ?>
                <a href="<?= $setting_desa['website_kecamatan'] ?>" target="_blank"><img src="<?= base_url("assets/files/logo/pemda_garut.png") ?>" class="img-fluid responsive" width="70px" height="70px" title="Website Kecamatan" alt="Dashboard Kecamatan"></a>
            <?php else : ?>
                <a href="https://desagarut.id" target="_blank"><img src="<?= base_url("assets/files/logo/sidega.png") ?>" class="img-fluid responsive" width="70px" height="70px" title="Desa Garut" alt="Desa Garut"></a>
            <?php endif; ?>
        </div>
        <div class="box-footer text-center">
            <p><i>Gunakan email & password untuk login ke halaman <strong>Email, Helpdesk dan Dashboard Kecamatan</strong><br />
                    <strong>Klik </strong>salah satu icon di atas untuk menuju halaman login</i></p>
            <p class="text-left">
                <i>Email : </i>
                <strong class="pull-right"> <?= $setting_desa['email_desa']; ?></strong><br />
                <i>Password : </i>
                <strong class="pull-right"> @Desagarut.id</strong>

            </p>
        </div>
    </div>
</div>