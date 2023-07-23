<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Perencanaan</h3>
        <div class="box-tools pull-right">
            <span class="label label-danger"> New</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body text-center">
        <a href="<?= site_url('perencanaan_desa/rkpdes') ?>">
            <?php foreach ($rkpdes_total as $data) : ?>
                <div class="info-box bg-green">
                    <span class="info-box-icon"><?= $data['jumlah'] ?></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total RKP Desa</span>
                        <span class="info-box-number"><?= $data['jumlah'] ?> <small>Kegiatan</small></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <span class="progress-description">
                            <small> Usulan = RKP Desa</small>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </a>
        <a href="<?= site_url('perencanaan_desa/durkpdes') ?>">
            <?php foreach ($durkpdes_total as $data) : ?>
                <div class="info-box bg-orange">
                    <span class="info-box-icon"><?= $data['jumlah'] ?></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total DU-RKP Desa</span>
                        <span class="info-box-number"><?= $data['jumlah'] ?> <small>Kegiatan</small></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <span class="progress-description">
                            <small> Proporsi Usulan = DU-RKP Desa</small>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </a>
    </div>
</div>
