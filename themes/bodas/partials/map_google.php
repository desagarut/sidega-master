<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!--<script src="<?= base_url() ?>assets/js/mapsJavaScriptAPI.js"></script>-->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOKTzsvtw8j-TJI8dmJ228bXASq4C-S7U&callback=initMap&v=weekly" defer></script>

<script>
    var LokasiKantorDesa
    var PetaDesa
    var PetaDusun

    function initMap() {
        <?php if (!empty($desa['lat']) && !empty($desa['lng'])) : ?>
            var center = {
                lat: <?= $desa['lat'] ?>,
                lng: <?= $desa['lng'] ?>
            }
        <?php else : ?>
            var center = {
                lat: -7.229426071233562,
                lng: 107.88959092620838
            }
        <?php endif; ?>

        var zoom = 14
        //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
        PetaDesa = new google.maps.Map(document.getElementById("peta_wilayah_desa"), {
            center,
            zoom,
            mapTypeId: google.maps.MapTypeId.HYBRID,
            title: 'Wilayah Desa <?php echo ucwords($this->setting->sebutan_desa) . " " ?><?php echo ucwords($desa['nama_desa']) ?>',
        });

        LokasiKantorDesa = new google.maps.Marker({
            position: center,
            map: PetaDesa,
            title: 'Lokasi Kantor <?php echo ucwords($this->setting->sebutan_desa) . " " ?><?php echo ucwords($desa['nama_desa']) ?>',
            //animation: google.maps.Animation.BOUNCE,
        });


        <?php if (!empty($desa['path'])) : ?>
            let polygon_desa = <?= $desa['path']; ?>;

            polygon_desa[0].map((arr, i) => {
                polygon_desa[i] = {
                    lat: arr[0],
                    lng: arr[1]
                }
            })

            //Style polygon batas wilayah desa
            var batasWilayah = new google.maps.Polygon({
                paths: polygon_desa,
                strokeColor: '#c31b68',
                strokeOpacity: 0.5,
                strokeWeight: 3,
                fillColor: '#fd7e14',
                fillOpacity: 0.35,
                title: 'Wilayah Desa <?php echo ucwords($this->setting->sebutan_desa); ?><?php echo ucwords($desa['nama_desa']) ?>',
            });

            batasWilayah.setMap(PetaDesa)

            var infowindow = new google.maps.InfoWindow({
                content: "<div class='media text-center'><img src='<?= gambar_desa($desa['kantor_desa'], TRUE); ?>' width='140px' height='100px'><br/> <p>Kantor <?php echo ucwords($this->setting->sebutan_desa) . " " ?><?php echo ucwords($desa['nama_desa']) ?></p></div>"
            });
            infowindow.open(PetaDesa, LokasiKantorDesa);

        <?php endif; ?>

    }
</script>

<!-- widget Peta Wilayah Kelurahan -->

<div class="map-section">
    <div class="col-sm-12">
        <div id="peta_wilayah_desa" style="height: 500px"></div>
    </div>
</div>