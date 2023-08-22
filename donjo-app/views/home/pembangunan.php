<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Pembangunan</h3>
        <div class="box-tools pull-right">
            <span class="label label-danger"> New</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row text-center">
            <a class="btn btn-app bg-green" href="<?php if ($this->CI->cek_hak_akses('u')) : ?><?= site_url('pembangunan') ?><?php endif; ?>" title="Rencana">
                <span class="badge bg-maroon"><?php foreach ($usulan_total as $data) : ?>
                        <?= $data['jumlah'] ?>
                    <?php endforeach; ?>
                </span> Rencana</a>
            <a class="btn btn-app bg-green" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('perencanaan_desa_polling/daftar_polling') ?><?php endif; ?>" title="Buat Surat"><!--<span class="badge bg-maroon">12</span>--> Polling</a>
            <a class="btn btn-app bg-green" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('penetapan_rkp') ?><?php endif; ?>" title="Surat Masuk"><!--<span class="badge bg-maroon">12</span>--> Penetapan </a>
        </div>
        <div class="row text-center">
            <a href="<?= site_url('pembangunan/rkp') ?>" class="btn btn-app bg-yellow" title="Rencana Kerja Pemerintah <?= ucwords($this->setting->sebutan_desa); ?>" style="color:blueviolet">
                <?php foreach ($usulan_total as $data) : ?>
                    <?= $data['jumlah'] ?>
                <?php endforeach; ?>
            </a>
            <a href="<?= site_url('pembangunan/durkp') ?>" class="btn btn-app bg-yellow" title="Daftar Usulan Rencana Kerja Pemerintah <?= ucwords($this->setting->sebutan_desa); ?>" style="color:blueviolet">
                <?php foreach ($durkp_total as $data) : ?>
                    <?= $data['jumlah'] ?><br />DU-RKP
                <?php endforeach; ?>
            </a>
        </div>
        <div class="row text-center">
            <a href="<?= site_url('pembangunan/pelaksanaan') ?>" class="btn btn-app bg-red" title="Daftar Daftar Kegiatan Yang dilaksanakan">
                <?php foreach ($pelaksanaan_total as $data) : ?>
                    <?= $data['jumlah'] ?><br />
                    Pelaksanaan
                <?php endforeach; ?>
            </a>
        </div>
    </div>
</div>