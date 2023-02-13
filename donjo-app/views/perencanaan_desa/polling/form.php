<!-- Content Wrapper. Contains page content -->

<section class="content" id="maincontent">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form id="validasi" action="<?= $form_action?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
          <div class="row">
            <div class="col-md-12">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" name="id_perencanaan_desa" value="<?= $id_perencanaan_desa ?>">
                    <!-- <div class="form-group row">
                    <label class="col-sm-3 control-label" style="text-align:left;" for="desa">Mendukung SDGS Desa Ke-</label>
                    <div class="col-sm-3">
                      <?= $data->desa ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 control-label" style="text-align:left;">Nama Program Kegiatan</label>
                    <div class="col-sm-4">
                      <?= $data->nama_program_kegiatan ?>
                    </div>
                  </div> -->
                    <div class="form-group row">
                      <label class="col-sm-5 control-label" for="id_pilihan" style="text-align:left;">Tanggapan anda </label>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <select class="form-control select2 input-sm required" name="id_pilihan" >
                            <option value="">Pilih Tanggapan Anda</option>
                            <option value="1" <?php //selected($main['id_pilihan'], '1'); ?>>Kurang Penting</option>
                            <option value="2" <?php //selected($main['id_pilihan'], '2'); ?> >Penting</option>
                            <option value="3" <?php //selected($main['id_pilihan'], '3'); ?> >Sangat Penting</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-5 control-label" style="text-align:left;" for="keterangan">Tanggapan Tambahan</label>
                      <div class="col-sm-7">
                        <input class="form-control input-sm" name="keterangan" id="keterangan" value="<?= $main->keterangan ?>" type="text" placeholder="Opsional" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer text-right">
                <div class="row">
                  <div class="col-md-12">
                    <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
