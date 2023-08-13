<!-- Content Wrapper. Contains page content -->

<section class="content" id="maincontent">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <form id="validasi" action="<?= $form_action ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
          <div class="row">
            <div class="col-md-12">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" name="id_pembangunan" value="<?= $id_pembangunan ?>">
                    <div class="form-group row">
                      <label class="col-md-4 control-label" for="id_pilihan" style="text-align:left;">Tanggapan anda </label>
                      <div class="col-md-8">
                        <select class="form-control input-sm required" name="id_pilihan">
                          <option value="">- Pilihan Tanggapan - </option>
                          <?php foreach ($pilihan_tanggapan as $data) : ?>
                            <option value="<?= $data['id'] ?>" <?php selected($pilihan_tanggapan['id_pilihan'], $data['id']); ?>><?= strtoupper($data['nama']) ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-4 control-label" style="text-align:left;" for="keterangan">Responden</label>
                      <div class="col-md-8">
                        <input class="form-control input-sm" name="responden" id="responden" value="<?= $main->responden ?>" type="text" placeholder="Tulis nama responden" />
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