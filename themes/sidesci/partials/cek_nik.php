<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); 

if(isset($_GET['cek_nik']))
{
	header('content-type: application/json');

	$nik = $this->db
		->select('nik')
		->from('tweb_penduduk')
		->where('nik', (int) $_GET['cek_nik'])
		->get()->row_array() ? 'kk' : null;
							
	$kk = $this->db
		->select('no_kk')
		->from('tweb_keluarga')
		->where('no_kk', (int) $_GET['cek_nik'])
		->get()->row_array() ? 'kk': null;

	if($nik || $kk)
	{
		exit(json_encode(['nik' => $nik || $kk, 'type' => $nik ? 'nik' : 'kk']));
	}

	exit(json_encode(['nik' => null]));
}

if(isset($_GET['cek_bantuan']))
{
	header('content-type: application/json');

	$progban = $this->db
		->select('program_peserta.peserta AS kk, program_peserta.kartu_nik AS nik, program.nama AS program')
		->from('program_peserta')
		->join('program', 'program_peserta.program_id = program.id')
		->where('peserta', (int) $_GET['cek_bantuan'])
		->or_where('kartu_nik', (int) $_GET['cek_bantuan'])
		->get()->result_array();

	if($progban)
	{
		exit(json_encode(['bantuan' => $progban]));
	}

	exit(json_encode(['bantuan' => $progban]));
}

?>

    <section id="about-us" class="about-us">
      <div class="container" data-aos="fade-up">
<!-- Button trigger modal cari nik -->
<div class="nik-finder">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="caps-cari-nik">
					CEK NIK/KK <br />
					Apakah NIK/KK anda terdaftar di sistem informasi desa?
				</div>
			</div>
			<div class="col-md-6">
				<div class="field-cari-nik">
					<div class="input-group" style="display:flex;">
						<input id="cariNik" type="text" class="form-control cari-nik" placeholder="CARI NIK/KK" autocomplete="off" style="border-radius:50px;width:100%;box-shadow:0px 2px 15px rgba(0, 0, 0, 0.1)"/>
						<span><button class="btn-cari-nik" type="button" id="cariNikButton">Cari NIK/KK</button></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="visibility: hidden;">
		<button id="modalNikAdaButton" type="button" data-toggle="modal" data-target="#modalNikAda">Launch modal</button>
		<button id="modalNikTidakAdaButton" type="button" data-toggle="modal" data-target="#modalNikTidakAda">Launch modal</button>
	</div>
</div>
</div>
</section>
<!-- Modal Cari Nik -->
<div class="modal fade" id="modalNikTidakAda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="true">x</button>
        <div class="modal-title-non-nik" id="myModalLabel">{{tipe}} {{nik}}  Tidak Terdaftar</div>
      </div>
      <div class="modal-body non-nik">
      	<p>Maaf, NIK/KK yang anda cari belum ada pada sistem data kependudukan <?php echo ucwords($this->setting->sebutan_desa)." "?><?php echo ucwords($desa['nama_desa'])?>.</p>
        <p>Silakan hubungi Operator atau datang ke Kantor <?php echo ucwords($this->setting->sebutan_desa)." "?> atau hubungi nomor telepon <?php echo $desa['telepon']?> untuk melakukan pendataan data penduduk. </p>
        Terimakasih
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalNikAda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="true">x</button>
        <div class="modal-title-nik" id="myModalLabel">{{tipe}} {{nik}}  Telah Terdaftar</div>
      </div>
      <div class="modal-body nik-ada">
        <p>Selamat NIK/KK yang anda cari telah terdaftar pada sistem data kependudukan <?php echo ucwords($this->setting->sebutan_desa)." "?><?php echo ucwords($desa['nama_desa'])?>. </p>
				<div id="bantuan_list"></div>
        Terimakasih
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
	let BASEMODAL1 = document.getElementById('modalNikAda').innerHTML
	let BASEMODAL2 = document.getElementById('modalNikTidakAda').innerHTML

	function cariNikTombol () {

		const NIK = document.getElementById('cariNik').value
		const modalNikAda = document.getElementById('modalNikAda')
		const modalNikTidakAda = document.getElementById('modalNikTidakAda')

		BASEMODAL1 = BASEMODAL1.replace('{{nik}}', NIK)
		BASEMODAL2 = BASEMODAL2.replace('{{nik}}', NIK)

		window.fetch(`?cek_nik=${NIK}`).then(res => res.json()).then(res => {

			modalNikAda.innerHTML = BASEMODAL1.replace('{{tipe}}', res.type)
			modalNikTidakAda.innerHTML = BASEMODAL2.replace('{{tipe}}', res.type)

			window.fetch(`?cek_bantuan=${NIK}`).then(res => res.json()).then(({ bantuan }) => {
				const bantuan_list = document.getElementById('bantuan_list')
				const unorderedList = document.createElement('ul')

				const pesan = document.createElement('p')
				pesan.innerHTML = 'Maaf, Anda tidak terdata sebagai penerima bantuan.'

				if (bantuan.length) {
					pesan.innerHTML = 'Program bantuan dimiliki:'

					for (let i = 0; i < bantuan.length; i++) {
						const childElm = document.createElement('li')
						const { kk, nik, program } = bantuan[i]
						const showKK = kk && 'KK: ' + kk
						const showNIK = nik ? ' - NIK: ' + nik : ''

						childElm.innerHTML = `${program} (${showKK}${showNIK})`
						console.log(nik !== null);
						unorderedList.appendChild(childElm)
					}

				}
				
				bantuan_list.appendChild(pesan)
				bantuan && bantuan_list.appendChild(unorderedList)
			})

			if(res.nik) {
				document.getElementById('modalNikAdaButton').click()
			}

			else {
				document.getElementById('modalNikTidakAdaButton').click()
			}
		})
	}

	document.getElementById('cariNikButton').addEventListener('click', cariNikTombol)
</script>

