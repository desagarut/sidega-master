<div class="col-md-3">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Letter-C</h3>
            <div class="box-tools pull-right">
                <span class="label label-danger"> New</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div class="box-body text-center">
            <a href="<?= site_url('letterc') ?>">
                <?php foreach ($rkpdes_total as $data) : ?>
                    <div class="info-box bg-blue">
                        <span class="info-box-icon"><?= $data['jumlah'] ?></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kepemilikan</span>
                            <span class="info-box-number"><?= $data['jumlah'] ?> <small>Warga</small></span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 0%"></div>
                            </div>
                            <span class="progress-description">
                            <span class="info-box-number"><?= $data['jumlah'] ?> <small>Non Warga</small></span>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </a>
            <a href="<?= site_url('data_persil') ?>">
                <?php foreach ($durkpdes_total as $data) : ?>
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><?= $data['jumlah'] ?></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Persil</span>
                            <span class="info-box-number"><?= $data['jumlah'] ?> <small>Persil</small></span>
                            <!--<div class="progress">
                                <div class="progress-bar" style="width: 0%"></div>
                            </div>
                            <span class="progress-description">
                               <small> Proporsi Usulan = DU-RKP Desa</small>
                            </span> -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </a>
        </div>
    </div>
</div>