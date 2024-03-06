<!-- ======= Desa Garut ======= -->

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
            echo '
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp bg-dark" data-wow-delay="0.1s" style="padding: 10px 10px 10px 10px">
                <h4 class="mb-5 text-light text-center">KABAR DESA GARUT</h4>
                    <div class="course-item ">
                        <div class="position-relative overflow-hidden text-center"><img class="img-fluid" src="' . $RowCariGambar->nodeValue . '">' . '</div></div>';
        };
        foreach ($CariJudul as $RowCariJudul) {
            echo '<div class="col-lg-12 " style="padding: 10px 10px 10px 10px"><h4 class="mb-4 text-light text-center">' . $RowCariJudul->nodeValue . '</h4>';
        };

        foreach ($CariSubjudul as $RowCariSubjudul) {
            echo '<p class="text-center">Penulis : ' . $RowCariSubjudul->nodeValue . '</p>';
        };


        // foreach ($CariDeskripsi as $RowCariDeskripsi) {
        //    echo $RowCariDeskripsi->nodeValue . '<br>';
        // };

        foreach ($CariUrl as $RowCariUrl) {
            echo '<a class="btn btn-sm btn-primary py-3 px-5 mt-2 text-center" href="' . $RowCariUrl->nodeValue
                . '">Baca Selengkapnya </a></div>
</div>
</div>
</div>
</div>
</div>';
        };
    }
}
?>