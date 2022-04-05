<script>
(function()
{
  var infoWindow;
  window.onload = function()
  {
		<?php if (!empty($desa['lat']) AND !empty($desa['lng'])): ?>
			var posisi = [<?=$desa['lat'].",".$desa['lng']?>];
			var zoom = <?=$desa['zoom'] ?: 10?>;
		<?php elseif (!empty($desa['path'])): ?>
			var wilayah_desa = <?=$desa['path']?>;
			var posisi = wilayah_desa[0][0];
			var zoom = <?=$desa['zoom'] ?: 10?>;
		<?php else: ?>
			var posisi = [-7.2025712,107.8852316];
			var zoom   = 10;
		<?php endif; ?>

		//Inisialisasi tampilan peta
    var mymap = L.map('map').setView(posisi, zoom);

    <?php if (!empty($desa['path'])): ?>
      mymap.fitBounds(<?=$desa['path']?>);
    <?php endif; ?>

    //Menampilkan overlayLayers Peta Semua Wilayah
    var marker_desa = [];
    var marker_dusun = [];
    var marker_rw = [];
    var marker_rt = [];
    var semua_marker = [];
    var markers = new L.MarkerClusterGroup();
    var markersList = [];


    //OVERLAY WILAYAH DESA
    <?php if ( ! empty($desa['path'])): ?>
      set_marker_desa_content(marker_desa, <?=json_encode($desa)?>, "<?=ucwords($this->setting->sebutan_desa).' '.$desa['nama_desa']?>", "<?= favico_desa()?>", '#isi_popup');
    <?php endif; ?>

    //OVERLAY WILAYAH DUSUN
    <?php if ( ! empty($dusun_gis)): ?>
      set_marker_content(marker_dusun, '<?=addslashes(json_encode($dusun_gis))?>', '<?=ucwords($this->setting->sebutan_dusun)?>', 'dusun', '#isi_popup_dusun_', '<?= favico_desa()?>');
    <?php endif; ?>

    //OVERLAY WILAYAH RW
    <?php if ( ! empty($rw_gis)): ?>
      set_marker_content(marker_rw, '<?=addslashes(json_encode($rw_gis))?>', 'RW', 'rw', '#isi_popup_rw_', '<?= favico_desa()?>');
    <?php endif; ?>

    //OVERLAY WILAYAH RT
    <?php if ( ! empty($rt_gis)): ?>
      set_marker_content(marker_rt, '<?=addslashes(json_encode($rt_gis))?>', 'RT', 'rt', '#isi_popup_rt_', '<?= favico_desa()?>');
    <?php endif; ?>

    //Menampilkan overlayLayers Peta Semua Wilayah
    var overlayLayers = overlayWil(marker_desa, marker_dusun, marker_rw, marker_rt, "<?=ucwords($this->setting->sebutan_desa)?>", "<?=ucwords($this->setting->sebutan_dusun)?>");

    //Menampilkan BaseLayers Peta
    var baseLayers = getBaseLayers(mymap, '<?=$this->setting->google_key?>');

    //Geolocation IP Route/GPS
  	geoLocation(mymap);

    //Menambahkan zoom scale ke peta
    L.control.scale().addTo(mymap);

    //Mencetak peta ke PNG
		cetakPeta(mymap);

    //Menambahkan Legenda Ke Peta
   /* var legenda_desa = L.control({position: 'bottomright'});
    var legenda_dusun = L.control({position: 'bottomright'});
    var legenda_rw = L.control({position: 'bottomright'});
    var legenda_rt = L.control({position: 'bottomright'});

    mymap.on('overlayadd', function (eventLayer) {
      if (eventLayer.name === 'Peta Wilayah Desa') {
        setlegendPetaDesa(legenda_desa, mymap, <?=json_encode($desa)?>, '<?=ucwords($this->setting->sebutan_desa)?>', '<?=$desa['nama_desa']?>');
      }
      if (eventLayer.name === 'Peta Wilayah Dusun') {
        setlegendPeta(legenda_dusun, mymap, '<?=addslashes(json_encode($dusun_gis))?>', '<?=ucwords($this->setting->sebutan_dusun)?>', 'dusun', '', '');
      }
      if (eventLayer.name === 'Peta Wilayah RW') {
        setlegendPeta(legenda_rw, mymap, '<?=addslashes(json_encode($rw_gis))?>', 'RW', 'rw', '<?=ucwords($this->setting->sebutan_dusun)?>');
      }
      if (eventLayer.name === 'Peta Wilayah RT') {
        setlegendPeta(legenda_rt, mymap, '<?=addslashes(json_encode($rt_gis))?>', 'RT', 'rt', 'RW');
      }
    });

    mymap.on('overlayremove', function (eventLayer) {
      if (eventLayer.name === 'Peta Wilayah Desa') {
        mymap.removeControl(legenda_desa);
      }
      if (eventLayer.name === 'Peta Wilayah Dusun') {
        mymap.removeControl(legenda_dusun);
      }
      if (eventLayer.name === 'Peta Wilayah RW') {
        mymap.removeControl(legenda_rw);
      }
      if (eventLayer.name === 'Peta Wilayah RT') {
        mymap.removeControl(legenda_rt);
      }
    });
*/
    // Menampilkan OverLayer Area, Garis, Lokasi
    layerCustom = tampilkan_layer_area_garis_lokasi(mymap, '<?=addslashes(json_encode($area))?>', '<?=addslashes(json_encode($garis))?>', '<?=addslashes(json_encode($lokasi))?>', '<?= base_url().LOKASI_SIMBOL_LOKASI?>', '<?= base_url().LOKASI_FOTO_AREA?>', '<?= base_url().LOKASI_FOTO_GARIS?>', '<?= base_url().LOKASI_FOTO_LOKASI?>');

//Covid
    var mylayer = L.featureGroup();
    var layerControl = {
      "Peta Sebaran Covid19": mylayer, // opsi untuk show/hide Peta Sebaran covid19 dari geojson dibawah
    }

//loading Peta Covid - data geoJSON dari BNPB- https://bnpb-inacovid19.hub.arcgis.com/datasets/data-harian-kasus-per-provinsi-covid-19-indonesia
    $.getJSON("https://opendata.arcgis.com/datasets/0c0f4558f1e548b68a1c82112744bad3_0.geojson",function(data){
    	var datalayer = L.geoJson(data ,{
    		onEachFeature: function (feature, layer) {
    			var custom_icon = L.icon({"iconSize": 32, "iconUrl": "<?= base_url()?>assets/images/covid.png"});
    			layer.setIcon(custom_icon);

    			var popup_0 = L.popup({"maxWidth": "100%"});

    			var html_a = $('<div id="html_a" style="width: 100.0%; height: 100.0%;">'
          + '<h4><b>' + feature.properties.Provinsi + '</b></h4>'
          + '<table><tr>'
          + '<th style="color:red">Positif&nbsp;&nbsp;</th>'
          + '<th style="color:green">Sembuh&nbsp;&nbsp;</th>'
          + '<th style="color:black">Meninggal&nbsp;&nbsp;</th>'
          + '</tr><tr>'
          + '<td><center><b style="color:red">' + feature.properties.Kasus_Posi + '</b></center></td>'
          + '<td><center><b style="color:green">' + feature.properties.Kasus_Semb + '</b></center></td>'
          + '<td><center><b>' + feature.properties.Kasus_Meni + '</b></center></td>'
          + '</tr></table></div>')[0];

    			popup_0.setContent(html_a);

    			layer.bindPopup(popup_0, {'className' : 'covid_pop'});
    			layer.bindTooltip(feature.properties.Provinsi, {sticky: true, direction: 'top'});
    		},
    	});
      mylayer.addLayer(datalayer);
    });
	
    mylayer.on('add', function () {
      setTimeout(function () {
        var bounds = new L.LatLngBounds();
        if (mylayer instanceof L.FeatureGroup) {
          bounds.extend(mylayer.getBounds());
        }
        if (bounds.isValid()) {
          mymap.fitBounds(bounds);
        } else {
          <?php if (!empty($desa['path'])): ?>
            mymap.fitBounds(<?=$desa['path']?>);
          <?php endif; ?>
        }
        $('#covid_status').show();
        $('#covid_status_local').show();
      });
    });

    mylayer.on('remove', function () {
      setTimeout(function () {
        $('#covid_status').hide();
        $('#covid_status_local').hide();
        <?php if (!empty($desa['path'])): ?>
          mymap.fitBounds(<?=$desa['path']?>);
        <?php endif; ?>
      });
    });
	
//End Covid

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
					'<p><a href="<?=site_url("penduduk/detail/1/0/")?>'+penduduk[x].id+'" target="ajax-modalx" rel="content" header="Rincian Data '+penduduk[x].nama+'" >LIHAT DETAIL</a></p></td>'+
					'</tr></table>';
					//Menambahkan point ke marker
					semua_marker.push(turf.point([Number(penduduk[x].lng), Number(penduduk[x].lat)], {content: content, style: point_style}));
			  }
			}
		<?php endif; ?>

		if (semua_marker.length != 0)
		{
		  var geojson = L.geoJSON(turf.featureCollection(semua_marker), {
        pmIgnore: true,
    		showMeasurements: true,
			onEachFeature: function (feature, layer) {
			  layer.bindPopup(feature.properties.content);
			  layer.bindTooltip(feature.properties.content);
			},
			style: function(feature)
			{
			  if (feature.properties.style)
			  {
					return feature.properties.style;
			  }
			},
      pointToLayer: function (feature, latlng)
			{
			  if (feature.properties.style)
			  {
					return L.marker(latlng, {icon: feature.properties.style});
			  }
			  else
				  return L.marker(latlng);
			}
    });

      markersList.push(geojson);
	  markers.addLayer(geojson);
      mymap.addLayer(markers);

      //Mempusatkan tampilan map agar semua marker terlihat
		  mymap.fitBounds(geojson.getBounds());
		}

    //Menampilkan Baselayer dan Overlayer
    var mainlayer = L.control.layers(baseLayers, overlayLayers, {position: 'topleft', collapsed: true}).addTo(mymap);
    var customlayer = L.control.groupedLayers('', layerCustom, {groupCheckboxes: true, position: 'topleft', collapsed: true}).addTo(mymap);
    var covidlayer = L.control.layers('', layerControl, {position: 'topleft', collapsed: false}).addTo(mymap);

		$('#isi_popup').remove();
		$('#isi_popup_dusun').remove();
		$('#isi_popup_rw').remove();
		$('#isi_popup_rt').remove();
		$('#covid_status').hide();
		$('#covid_status_local').hide();
  }; //EOF window.onload

})();
</script>
<style>
	#map
	{
		width:100%; height:400px;
		/*height:80vh*/
	}
</style>
<div class="content-wrapper">
	<form id="mainform_map" name="mainform_map" action="" method="post">
		<div class="row">
			<div class="col-md-12">
				<div id="map">
                    <?php include("donjo-app/views/gis/cetak_peta.php"); ?>
                    <div class="leaflet-top leaflet-left">
                        <div id="covid_status">
                          <?php $this->load->view("gis/covid_peta.php") ?>
                        </div>
                    </div>
					<div class="leaflet-top leaflet-right">
                    	<div id="covid_status_local">
							<?php $this->load->view("gis/covid_peta_local.php") ?>
                        </div>  
						<div class="leaflet-control-layers leaflet-bar leaflet-control">
							<a class="leaflet-control-control icos" href="#" title="Control Panel" role="button" aria-label="Control Panel" onclick="$('#target1').toggle();$('#target1').removeClass('hidden');$('#target2').hide();"><i class="fa fa-gears"></i></a>
							<a class="leaflet-control-control icos" href="#" title="Legenda" role="button" aria-label="Legenda" onclick="$('#target2').toggle();$('#target2').removeClass('hidden');$('#target1').hide();"><i class="fa fa-list"></i></a>
						</div>
                         
						<?php $this->load->view("gis/content_desa.php", array('desa' => $desa, 'list_ref' => $list_ref, 'wilayah' => ucwords($this->setting->sebutan_desa.' '.$desa['nama_desa']))) ?>
						<?php $this->load->view("gis/content_dusun.php", array('dusun_gis' => $dusun_gis, 'list_ref' => $list_ref, 'wilayah' => ucwords($this->setting->sebutan_dusun.' '))) ?>
						<?php $this->load->view("gis/content_rw.php", array('rw_gis' => $rw_gis, 'list_ref' => $list_ref, 'wilayah' => ucwords($this->setting->sebutan_dusun.' '))) ?>
						<?php $this->load->view("gis/content_rt.php", array('rt_gis' => $rt_gis, 'list_ref' => $list_ref, 'wilayah' => ucwords($this->setting->sebutan_dusun.' '))) ?>
						
                        <div id="target1" class="leaflet-control-layers leaflet-control-layers-expanded leaflet-control hidden" aria-haspopup="true" style="max-width: 250px;">
							<div class="leaflet-control-layers-overlays">
								<div class="leaflet-control-layers-group" id="leaflet-control-layers-group-2">
									<span class="leaflet-control-layers-group-name">CARI PENDUDUK</span>
									<div class="leaflet-control-layers-separator"></div>
										<div class="form-group">
											<label>Status Penduduk</label>
											<select class="form-control input-sm " name="filter" onchange="formAction('mainform_map','<?= site_url('gis/filter')?>')">
												<option value="">Pilih Status Penduduk </option>
												<?php foreach ($list_status_penduduk AS $data): ?>
													<option value="<?= $data['id']?>" <?= selected($filter, $data['id']); ?>><?= $data['nama']?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
											<label>Jenis Kelamin</label>
											<select class="form-control input-sm " name="sex" onchange="formAction('mainform_map','<?= site_url('gis/sex')?>')">
												<option value="">Pilih Jenis Kelamin </option>
												<?php foreach ($list_jenis_kelamin AS $data): ?>
													<option value="<?= $data['id']?>" <?= selected($sex, $data['id']); ?>><?= $data['nama']?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
										<label><?=ucwords($this->setting->sebutan_dusun)?></label>
											<select class="form-control input-sm " name="dusun" onchange="formAction('mainform_map','<?= site_url('gis/dusun')?>')">
												<option value="">Pilih Dusun</option>
												<?php foreach ($list_dusun as $data): ?>
													<option value="<?=$data['dusun']?>" <?= selected($dusun, $data['dusun']); ?>><?=$data['dusun']?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<?php if ($dusun): ?>
											<div class="form-group">
												<label>RW</label>
												<select class="form-control input-sm " name="rw" onchange="formAction('mainform_map','<?= site_url('gis/rw')?>')">
													<option value="">Pilih RW</option>
													<?php foreach ($list_rw as $data): ?>
														<option value="<?=$data['rw']?>" <?= selected($rw, $data['rw']); ?>><?=$data['rw']?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<?php if ($rw): ?>
												<div class="form-group">
													<label>RT</label>
													<select class="form-control input-sm " name="rt" onchange="formAction('mainform_map','<?= site_url('gis/rt')?>')">
														<option value="">Pilih RT</option>
														<?php foreach ($list_rt as $data): ?>
															<option value="<?=$data['rt']?>" <?= selected($rt, $data['rt']); ?>><?=$data['rt']?></option>
														<?php endforeach; ?>
													</select>
												</div>
											<?php endif; ?>
										<?php endif; ?>
										<div class="col-sm-12">
											<div class="form-group row">
												<label>Cari</label>
												<div class="box-tools">
													<div class="input-group input-group-sm pull-right">
														<input name="cari" id="cari" class="form-control" placeholder="cari..." type="text" value="<?=html_escape($cari)?>" onkeypress="if (event.keyCode == 13):$('#'+'mainform_map').attr('action', '<?=site_url("gis/search")?>');$('#'+'mainform_map').submit();endif">
														<div class="input-group-btn">
															<button type="submit" class="btn btn-default" onclick="$('#'+'mainform_map').attr('action', '<?=site_url("gis/search")?>');$('#'+'mainform_map').submit();"><i class="fa fa-search"></i></button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<a href="<?=site_url("gis/ajax_adv_search")?>" class="btn btn-block btn-social bg-olive btn-sm" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Pencarian Spesifik" title="Pencarian Spesifik">
												<i class="fa fa-search"></i> Pencarian Spesifik
											</a>
											<a href="<?=site_url("gis/clear")?>" class="btn btn-block btn-social bg-orange btn-sm">
												<i class="fa fa-refresh"></i> Bersihkan
											</a>
										</div>
									</div>
                            </div>
                        </div>
                        <div id="target2" class="leaflet-control-layers leaflet-control-layers-expanded leaflet-control hidden" aria-haspopup="true" style="max-height: 315px;">
                            <div class="leaflet-control-layers-overlays">
                                <div class="leaflet-control-layers-group" id="leaflet-control-layers-group-3">
                                    <span class="leaflet-control-layers-group-name">LEGENDA</span>
                                    <div class="leaflet-control-layers-separator"></div>
                                    <label>
                                        <input class="leaflet-control-layers-selector" type="checkbox" name="layer_penduduk" value="1" onchange="handle_pend(this);" <?php if ($layer_penduduk==1): ?>checked<?php endif; ?>>
                                        <span> Penduduk	</span>
                                    </label>
                                    <label>
                                        <input class="leaflet-control-layers-selector" type="checkbox" name="layer_keluarga" value="1" onchange="handle_kel(this);" <?php if ($layer_keluarga==1): ?>checked<?php endif; ?>>
                                        <span> Keluarga</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
	function handle_pend(cb)
	{
	  formAction('mainform_map', '<?=site_url('gis')?>/layer_penduduk');
	}
	function handle_kel(cb)
	{
	  formAction('mainform_map', '<?=site_url('gis')?>/layer_keluarga');
	}
	function AmbilFoto(foto, ukuran = "kecil_")
	{
	  ukuran_foto = ukuran || null
	  file_foto = '<?= base_url().LOKASI_USER_PICT;?>'+ukuran_foto+foto;
	  return file_foto;
	}
	function AmbilFotoLokasi(foto, ukuran = "kecil_")
	{
	  ukuran_foto = ukuran || null
	  file_foto = '<?= base_url().LOKASI_FOTO_LOKASI;?>'+ukuran_foto+foto;
	  return file_foto;
	}
</script>
<div  class="modal fade" id="modalKecil" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title' id='myModalLabel'></h4>
      </div>
      <div class="fetched-data"></div>
    </div>
  </div>
</div>

<div  class="modal fade" id="modalSedang" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog">
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title' id='myModalLabel'></h4>
      </div>
      <div class="fetched-data"></div>
    </div>
  </div>
</div>

<div  class="modal fade" id="modalBesar" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-lg">
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i></h4>
      </div>
      <div class="fetched-data"></div>
    </div>
  </div>
</div>
