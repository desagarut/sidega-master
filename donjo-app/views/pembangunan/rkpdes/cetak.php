<style>
	img.gambar-pembangunan {
		width: 400px;
		height: 300px;
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
</style>
<table>
	<tbody>
		<tr>
			<td align="center">
				<img class="logo" src="<?= gambar_desa($config['logo']); ?>" alt="logo-desa">
				<h3 class="judul">DAFTAR PRIORITAS RENCANA KERJA PEMERINTAH DESA<br/>
					<?= strtoupper($this->setting->sebutan_kecamatan . ' ' . $config['nama_kecamatan'] . ' <br>' . $this->setting->sebutan_kabupaten . ' ' . $config['nama_kabupaten'] . ' <br>' ); ?>
				</h3>
			</td>
		</tr>
		<tr>
			<td>
				<hr class="garis">
			</td>
		</tr>
		<table>
            <thead>
                <tr class="border thick">
                    <th>No</th>  
                    <th>Nama Desa</th> 
                    <th>Bidang</th>
                    <th>Nama Program Kegiatan</th>
                    <th>Lokasi</th>
                    <th>Volume</th>
                    <th>Satuan</th>
                    <th>Jumlah (Rp)</th>
                    <th>Sumber Dana</th> 
                </tr>          
            </thead>
			<tbody class="border thick">
            <?php  
				$no = 1;
				 ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $pembangunan->desa; ?></td>
                    <td><?= $pembangunan->bidang_desa; ?></td>
                    <td><?= $pembangunan->nama_program_kegiatan; ?></td>
                    <td><?= $pembangunan->lokasi; ?></td>
                    <td><?= $pembangunan->volume; ?></td>
                    <td><?= $pembangunan->satuan; ?></td>
                    <td><?= rupiah($pembangunan->anggaran); ?></td>
                    <td><?= $pembangunan->sumber_dana; ?></td>
                </tr>
			</tbody>
		</table>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>
