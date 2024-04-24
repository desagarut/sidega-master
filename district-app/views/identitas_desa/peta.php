<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!--<script src="<?= base_url() ?>assets/js/mapsJavaScriptAPI.js"></script>-->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOKTzsvtw8j-TJI8dmJ228bXASq4C-S7U&callback=initMap&v=weekly" defer></script>

<script>
    var PetaDesa
    var kantorDesa
    var batasWilayah

    function initMap() {
        <?php if (!empty($wil_ini['lat']) && !empty($wil_ini['lng'])) : ?>
            var center = {
                lat: <?= $wil_ini['lat'] ?>,
                lng: <?= $wil_ini['lng'] ?>
            }
        <?php else : ?>
            var center = {
                lat: -7.202686,
                lng: 107.8866398,
            }
        <?php endif; ?>

        var zoom = 14
        //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
        PetaDesa = new google.maps.Map(document.getElementById("peta_wilayah_desa"), {
            center,
            zoom: <?= $wil_ini['zoom'] ?>,
            mapTypeId: google.maps.MapTypeId.<?= $wil_ini['map_tipe'] ?>
        });

        kantorDesa = new google.maps.Marker({
            position: center,
            map: PetaDesa,
           // title: 'Kantor <?php echo ucwords($this->setting->sebutan_desa) . " " ?><?php echo ucwords($desa['nama_desa']) ?>'.true,
           // icon: '<?= gambar_desa($main['logo']); ?>',
           content: "Tampilan Info Window",

        });

        <?php if (!empty($wil_ini['path'])) : ?>
            let polygon_desa = <?= $wil_ini['path']; ?>;

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
                fillOpacity: 0.25
            });

            batasWilayah.setMap(PetaDesa)

            var infowindow = new google.maps.InfoWindow({
                content: "<div class='media text-center'><img src='<?= gambar_desa($main['kantor_desa'], TRUE); ?>' width='140px' height='100px'><br/> <p>Kantor <?php echo ucwords($this->setting->sebutan_desa) . " " ?><?php echo ucwords($desa['nama_desa']) ?></p></div>"
            });
            infowindow.open(PetaDesa, kantorDesa);


        <?php endif; ?>
    }
</script>

<div class='row'>
    <div class="pad">
        <div id="peta_wilayah_desa" style="height: 300px"></div>
    </div>
</div>