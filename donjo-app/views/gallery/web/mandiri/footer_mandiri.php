    <footer class="main-footer">
        <div align="center"> 
        <strong><a href="https://desagarut.net" target="_blank"> SIDeGa <?= AmbilVersi(); ?> </a></strong> | &copy; 2019-<?= date("Y");?> | Layanan Masyarakat <?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']);?> Kabupaten Garut
        </div>
    </footer>
        <!-- JS -->
        <?php $this->load->view('web/mandiri/sets/js.php') ?>
</body>
</html>
