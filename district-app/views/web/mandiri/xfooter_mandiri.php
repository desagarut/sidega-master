    <footer class="main-footer">
        <div class="float-right d-none d-sm-block hidden-xs"> 
        &copy; 2019-<?= date("Y");?> - Layanan Masyarakat <strong><a href="https://desagarut.net" target="_blank"> SIDeGa <?= AmbilVersi(); ?> </a></strong> untuk <?= ucwords($this->setting->sebutan_deskel); ?> di Kabupaten Garut. 
        </div>
    </footer>
        <!-- JS -->
        <?php $this->load->view('web/mandiri/sets/js.php') ?>
</body>
</html>
