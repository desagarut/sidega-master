    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Pertanahan</h3>
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

                <div class="info-box bg-blue">
                    <?php foreach ($letterc_total as $data) : ?>
                        <span class="info-box-icon"><?= $data['jumlah'] ?></span>
                    <?php endforeach; ?>
                    <div class="info-box-content">
                        <span class="info-box-text">Daftar Letter-C</span>
                        <span class="info-box-number"><?php foreach ($letterc_warga_total as $data) : ?><?= $data['letterc_warga'] ?> <?php endforeach; ?><small> Warga</small> | <?php foreach ($letterc_nonwarga_total as $data) : ?><?= $data['letterc_non'] ?><?php endforeach; ?><small> Non Warga</small></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <span class="progress-description">
                            Detail
                        </span>
                    </div>
                </div>

            </a>
            <a href="<?= site_url('data_persil') ?>">
                <?php foreach ($persil_total as $data) : ?>
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><?= $data['jumlah'] ?></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Daftar Persil</span>
                            <span class="info-box-number"><small>info bidang tanah</small></span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 0%"></div>
                            </div>
                            <span class="progress-description">
                                <small>Detail</small>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </a>
        </div>
    </div>