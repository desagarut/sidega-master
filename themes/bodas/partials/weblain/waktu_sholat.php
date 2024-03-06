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
      }

      //Cari Query XPath
      $CariJudul = $xpath->query('/html/body/div[4]/div/div[3]/div[1]/div/div/div[2]/h5/a');
      $CariAuthor = $xpath->query('/html/body/div[4]/div/div[3]/div[1]/div/div/div[4]/small[1]');
      if ($CariJudul->length > 0) {
        foreach ($CariJudul as $judul) {
          echo 'judul' . $judul->nodeValue . '<br>';
        }

        foreach ($CariSubJudul as $RowCariSubJudul) {
          echo 'sub judul' . $RowCariSubJudul->nodeValue . '<br>';
        }

        foreach ($CariGambar as $RowCariGambar) {
          echo 'gambar https://desagarut.id/'.$RowCariGambar->nodeValue. '<br>';
        }

        foreach ($CariDeskripsi as $RowCariDeskripsi){
          echo 'deskripsi '.$RowCariDesakripsi->nodeValue.'<br>';
        }

        foreach($CariUrl as $RowCariUrl){
          echo 'URL '.$RowCariUrl->nodeValue.'<br>';
        }
      };


      ?>

    </div>
  </div>
</div>