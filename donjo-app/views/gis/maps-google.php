<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v5.7/mapsJavaScriptAPI.js" async defer></script>

<script>
var PetaDesa
var kantorDesa
var batasWilayah

function initMap() {
    <?php if (!empty($desa['lat']) && !empty($desa['lng'])): ?>
        var center = {
            lat: <?=$desa['lat']?>,
            lng: <?=$desa['lng']?>
        }
    <?php else: ?>
        var center = {
            lat: -7.202686,
            lng: 107.8866398,
        }
    <?php endif; ?>

    var zoom = 14
    //Jika posisi kantor desa belum ada, maka posisi peta akan menampilkan seluruh Indonesia
    PetaDesa = new google.maps.Map(document.getElementById("peta_wilayah_desa"), { center, zoom:<?=$desa['zoom']?>, mapTypeId:google.maps.MapTypeId.<?=$desa['map_tipe']?> });

    kantorDesa = new google.maps.Marker({
        position: center,
        map: PetaDesa,
        title: 'Kantor <?php echo ucwords($this->setting->sebutan_desa)." "?><?php echo ucwords($desa['nama_desa'])?>'.true,
		icon: '<?= gambar_desa($desa['logo']); ?>',
    });
		
    <?php if (!empty($desa['path'])): ?>
	let polygon_desa = <?= $desa['path']; ?>;
	
	polygon_desa[0].map((arr, i) => {
		polygon_desa[i] = { lat: arr[0], lng: arr[1] }
	})
	
	//Style polygon batas wilayah desa
	var batasWilayah = new google.maps.Polygon({
		paths: polygon_desa,
		strokeColor: '#c31b68',
		strokeOpacity: 0.5,
		strokeWeight: 3,
		fillColor: '#fd7e14',
		fillOpacity: 0.25,
		labels:false,
	});

	batasWilayah.setMap(PetaDesa)
    <?php endif; ?>
	
		//PENDUDUK
		<?php if ($layer_penduduk==1 OR $layer_keluarga==1 AND !empty($penduduk)): ?>
			//Data penduduk
			var penduduk = JSON.parse('<?=addslashes(json_encode($penduduk))?>');
			var jml = penduduk.length;
			var foto;
			var content;
			var point_style = L.icon({
			  iconUrl: '<?= base_url(LOKASI_SIMBOL_LOKASI)?>penduduk.png',
			  iconSize: [25, 36],
			  iconAnchor: [13, 36],
			  popupAnchor: [0, -28],
			});
			for (var x = 0; x < jml; x++)
			{
			  if (penduduk[x].lat || penduduk[x].lng)
			  {
					//Jika penduduk ada foto, maka pakai foto tersebut
					//Jika tidak, pakai foto default
					if (penduduk[x].foto)
					{
					  foto = '<td><tr><img src="'+AmbilFoto(penduduk[x].foto)+'" class="foto_pend"/></td>';
					}
					else
						foto = '<td><img src="<?= base_url()?>assets/files/user_pict/kuser.png" class="foto_pend"/></td>';

					//Konten yang akan ditampilkan saat marker diklik
					content =
					'<table border=0><tr>' + foto +
					'<td style="padding-left:2px"><font size="2.5" style="bold">Nama : '+penduduk[x].nama+'</font> - '+penduduk[x].sex+
					'<p>'+penduduk[x].umur+' Tahun '+penduduk[x].agama+'</p>'+
					'<p>'+penduduk[x].alamat+'</p>'+
					'<p><a href="<?=site_url("penduduk/detail/1/0/")?>'+penduduk[x].id+'" target="ajax-modalx" rel="content" header="Rincian Data '+penduduk[x].nama+'" >Data Rincian</a></p></td>'+
					'</tr></table>';
					//Menambahkan point ke marker
					semua_marker.push(turf.point([Number(penduduk[x].lng), Number(penduduk[x].lat)], {content: content, style: point_style}));
			  }
			}
		<?php endif; ?>
}

</script>
<div class="content-wrapper">
      <div class="map">
        <div id="peta_wilayah_desa" style="height: 630px"></div>
      </div>
</div>
