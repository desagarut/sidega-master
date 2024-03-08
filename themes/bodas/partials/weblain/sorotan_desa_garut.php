<!-- ======= Desa Garut ======= -->
<div class="col-lg-6 col-md-6 wow fadeInUp bg-light" data-wow-delay="0.1s" style="padding: 10px 10px 10px 10px">
    <div class="row">
        <h6 class="py-3 text-dark text-center">Sorotan Desa Garut</h6>
        <div class="col-lg-6 col-md-6">
            <?php
            $html = file_get_contents("https://desagarut.id");
            $xpath_doc = new DOMDocument();
            libxml_use_internal_errors(TRUE); //berfungsi mendisable error
            if (!empty($html)) {
                $xpath_doc->loadHTML($html);
                libxml_clear_errors(); //berfungsi untuk mendisable error / display error
                $xpath = new DOMXPath($xpath_doc);

                //Cari Query XPath
                $CariJudul = $xpath->query('//*[@id="terkini"]/div/div[1]/div/div[2]/h4/a');
                $CariSubjudul = $xpath->query('//*[@id="terkini"]/div/div[1]/div/div[2]/span');
                $CariGambar = $xpath->query('//*[@id="terkini"]/div/div[1]/div/div[1]/img/@src');
                $CariDeskripsi = $xpath->query('//*[@id="terkini"]/div/div[2]/div/div/div/div[2]/h4/a');
                $CariUrl = $xpath->query('//*[@id="terkini"]/div/div[1]/div/div[2]/h4/a/@href');

                if ($CariJudul->length > 0) {
                    foreach ($CariGambar as $RowCariGambar) {
                        echo '<div class="course-item ">
                        <div class="position-relative overflow-hidden text-center shadow"><img class="img-fluid" src="' . $RowCariGambar->nodeValue . '" style="width:100%">' . '</div></div>';
                    };
                    foreach ($CariJudul as $RowCariJudul) {
                        echo '<div class="col-lg-12 " style="padding: 10px 10px 10px 10px"><h6 class="py-3 text-dark text-center">' . $RowCariJudul->nodeValue . '</h6>';
                    };

                    foreach ($CariSubjudul as $RowCariSubjudul) {
                        echo '<p class="text-center"><small>Penulis : ' . $RowCariSubjudul->nodeValue . '<br>';
                    };

                    foreach ($CariUrl as $RowCariUrl) {
                        echo '<a class="btn btn-sm btn-primary py-3 px-5 mt-2 text-center" href="' . $RowCariUrl->nodeValue
                            . '">Baca Selengkapnya </a></small></p></div>';
                    };
                }
            }
            ?>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="course-item ">
                <div class="position-relative overflow-hidden text-center">
                    <a class="btn btn-sm btn-primary py-3 px-5 mt-2 text-center" width="80px" target="_blank" href="https://desagarut.id/">BPJS Ketenagakerjaan </a>
                    <a class="btn btn-sm btn-warning py-3 px-5 mt-2 text-center" width="80px" target="_blank" href="https://desagarut.id/">Pendaftaran NIB </a>
                    <a class="btn btn-sm btn-warning py-3 px-5 mt-2 text-center" target="_blank" href="https://desagarut.id/">Sertifikat Halal </a>
                    <a class="btn btn-sm btn-warning py-3 px-5 mt-2 text-center" target="_blank" href="https://desagarut.id/">Cek Bansos </a>
                    <a class="btn btn-sm btn-warning py-3 px-5 mt-2 text-center" target="_blank" href="https://desagarut.id/">Internet Desa</a>

                </div>
            </div>
        </div>
    </div>
</div>