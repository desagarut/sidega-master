<!-- ======= Desa Garut ======= -->

<div class="container">
    <div class="text-start">
        <h6 class="mb-3">Berita Desa Garut</h6>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            $html = file_get_contents("https://desagarut.id");
            $xpath_doc = new DOMDocument();
            libxml_use_internal_errors(TRUE);
            if (!empty($html)) {
                $xpath_doc->loadHTML($html);
                libxml_clear_errors();
                $xpath = new DOMXPath($xpath_doc);

                //Cari Query XPath
                $CariJudul = $xpath->query('//*[@id="terkini"]/div/div[2]/div/div/div/div[2]/a');
                $CariSubjudul = $xpath->query('//*[@id="terkini"]/div/div[2]/div/div/div/div[2]/h4/a');
                $CariGambar = $xpath->query('//*[@id="terkini"]/div/div[2]/div/div/div/div[1]/a/img/@src');
                $CariDeskripsi = $xpath->query('//*[@id="terkini"]/div/div[2]/div/div/div/div[2]/h4/a');
                $CariUrl = $xpath->query('//*[@id="terkini"]/div/div[2]/div/div/div/div[2]/a/@href');

                if ($CariJudul->length > 0) {
                    foreach ($CariJudul as $RowCariJudul) {
                        $CariJudul_List[] = array('judul' => $RowCariJudul->nodeValue);
                    };

                    foreach ($CariSubjudul as $RowCariSubjudul) {
                        $CariSubJudul_List[] = array('sub_judul' => $RowCariSubjudul->nodeValue);
                    };

                    foreach ($CariGambar as $RowCariGambar) {
                        $CariGambar_List[] = array('gambar' => $RowCariGambar->nodeValue);
                    };

                    foreach ($CariDeskripsi as $RowCariDeskripsi) {
                        $CariDeskripsi_List[] = array('deskripsi' => $RowCariDeskripsi->nodeValue);
                    };

                    foreach ($CariUrl as $RowCariUrl) {
                        $CariUrl_List[] = array('url' => $RowCariUrl->nodeValue);
                    }

                    //tambahkan increment
                    $i = 0;
                    foreach ($CariUrl as $RowCariUrl) {
                        $CariUrl_List[] = array(
                            'judul' => $CariJudul_List[$i]["judul"],
                            'sub_judul' => $CariSubJudul_List[$i]["sub_judul"],
                            'gambar' => 'https://desagarut.id/' . $CariGambar_List[$i]["gambar"],
                            'deskripsi' => $CariDeskripsi_List[$i]["deskripsi"],
                            'url' => 'https://desagarut.id' . $RowCariUrl->nodeValue
                        );
                        $i++;
                    }
                }
            }

            echo json_encode($CariUrl_List)

            ?>

        </div>
    </div>
</div>