<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- widget Menu-->
<div class="widget-polling">
    <div class="form-group">
        <div class="judul-poling"><?php echo $polling['pertanyaan']; ?></div>
    </div>

    <div id="pesan-poll" style="display:none"></div>

    <form id="form-poll" action="<?= site_url('vote') ?>" method="post">
        <div class="form-group">
            <?php foreach ($data_pilihan as $row) { ?>
                <label><input required type="radio" name="id_pil" value="<?= $row['id'] ?>"> <?= $row['nama'] ?></label><br />
            <?php } ?>
        </div>

        <div class="form-group">
            <textarea required class="form-control textarea-polling" name="alasan" placeholder="Tuliskan alasan Anda disini"></textarea>
        </div>

        <div class="form-group">
            <input type="hidden" name="id_poll" value="<?php echo $polling['id']; ?>">
            <script>
                function polling_submit_button() {
                    var url = $('#form-poll').attr('action');
                    $.ajax({
                        type: 'post',
                        url: url,
                        data: $('#form-poll').serialize(),
                        success: function(res) {
                            $("#pesan-poll").html(res.pesan);
                            $("#pesan-poll").show();
                        },
                        error: function() {
                            alert("Failed to getting request");
                        }
                    });
                }
            </script>
            <button type="button" onclick="polling_submit_button()" class="btn btn-primary polling-button">Vote</button>
            <script>
                function polling_lihat_hasil_button() {
                    var url = "<?= site_url('home/get_hasil_vote') ?>";
                    $.ajax({
                        type: 'POST',
                        contentType: "html",
                        url: url,
                        success: function(res) {
                            $("#form-poll").hide();
                            $("#btn-poll-back").fadeIn();

                            $("#hasil-polling").html(res);
                            $("#hasil-polling").fadeIn();
                        },
                        error: function() {
                            alert("Failed to getting request");
                        }
                    });

                }
            </script>
            <!--<button type="button" onclick="polling_lihat_hasil_button()" id="btn-lihat-hasilx" class="btn btn-sm btn-info polling-button">Lihat Hasil</button>-->
        </div>
    </form>

    <div id="hasil-polling" style="display:none"></div>
    <script>
        function polling_lihat_hasil_button_back() {
            $("#form-poll").fadeIn();
            $("#hasil-polling").hide();
            $("#btn-poll-back").hide();
        }
    </script>
    <button style="display:none" type="button" onclick="polling_lihat_hasil_button_back()" id="btn-poll-back" class="btn btn-xs btn-default polling-button"><i class="fa fa-angle-left"></i> Kembali</button>
</div>