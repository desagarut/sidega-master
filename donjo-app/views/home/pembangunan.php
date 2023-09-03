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
            <a class="btn btn-app bg-purple" href="<?php if ($this->CI->cek_hak_akses('u')) : ?><?= site_url('pembangunan') ?><?php endif; ?>" title="Rencana">
                <span class="badge bg-maroon">
                    <?php foreach ($usulan_total as $data) : ?>
                        <?= $data['jumlah'] ?>
                    <?php endforeach; ?>
                </span> Rencana</a>
            <a class="btn btn-app bg-purple" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('pembangunan/penentuan_prioritas_tk_desa') ?><?php endif; ?>" title="Penentuan Prioritas">
                <span class="badge bg-maroon">
                    <?php foreach ($prioritas_total as $data) : ?>
                        <?= $data['jumlah'] ?>
                    <?php endforeach; ?>
                </span>Prioritas</a>
            <a class="btn btn-app bg-purple" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('pembangunan/penetapan_rkp') ?><?php endif; ?>" title="Penetapan">
                <span class="badge bg-maroon">
                    <?php foreach ($rkp_total as $data) : ?>
                        <?= $data['jumlah'] ?>
                    <?php endforeach; ?>
                </span>Prioritas
            </a>
        </div>
        <div class="row text-center">
            <a href="<?= site_url('pembangunan/pelaksanaan_rkp') ?>" class="btn btn-app bg-purple" title="Rencana Kerja Pemerintah <?= ucwords($this->setting->sebutan_desa); ?>" style="color:purpleviolet">
                <span class="badge bg-maroon">
                    <?php foreach ($usulan_total as $data) : ?>
                        <?= $data['jumlah'] ?>
                    <?php endforeach; ?>
                </span> RKP <?= ucwords($this->setting->sebutan_desa); ?>
            </a>
            <a href="<?= site_url('pembangunan/pelaksanaan_durkp') ?>" class="btn btn-app bg-purple" title="Daftar Usulan Rencana Kerja Pemerintah <?= ucwords($this->setting->sebutan_desa); ?>" style="color:purpleviolet">
                <span class="badge bg-maroon">
                    <?php foreach ($durkp_total as $data) : ?>
                        <?= $data['jumlah'] ?>
                    <?php endforeach; ?>
                </span>DU-RKP
            </a>
        </div>
        <div class="row text-center">
            <a href="<?= site_url('pembangunan/pelaksanaan_rkp') ?>" class="btn btn-app bg-green" title="Daftar Daftar Kegiatan Yang dilaksanakan">
                <span class="badge bg-maroon">
                    <?php foreach ($pelaksanaan_total as $data) : ?>
                        <?= $data['jumlah'] ?><br />
                    <?php endforeach; ?>
                </span>Pelaksanaan
            </a>
        </div>
    </div>
</div>