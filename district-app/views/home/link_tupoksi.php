<div class="box box-success box-solid">
    <div class="box-body">
        <div class="row text-center" style="padding-top:20px">
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('u')) : ?><?= site_url('penduduk/clear') ?><?php endif; ?>" title="Pemerintahan"><i class="fa fa-users text-blue"></i>Pemerintahan</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('pembengunan') ?><?php endif; ?>" title="Pembangunan"> <i class="fa fa-building text-blue"></i> Pembangunan</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('pemas') ?><?php endif; ?>" title="Pemberdayaan Masyarakat"><span class="badge bg-aqua"></span><i class="fa fa-hand-rock-o text-blue"></i> Pemberdayaan</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('pembinaan_masyarakat') ?><?php endif; ?>" title="Pembinaan Kemasyarakatan"><span class="badge bg-aqua"></span><i class="fa fa-hand-paper-o text-blue"></i> Pembinaan</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('kebencanaan') ?><?php endif; ?>" title="Kebencanaan"><span class="badge bg-aqua"></span><i class="fa fa-object-ungroup text-blue"></i> Kebencanaan</a>
            <a class="btn btn-app" href="<?php if ($this->CI->cek_hak_akses('h')) : ?><?= site_url('kedaruratan') ?><?php endif; ?>" title="Kedaruratan"><span class="badge bg-aqua"></span><i class="fa fa-plug text-blue"></i> Kedaruratan</a>
        </div>
    </div>
</div>