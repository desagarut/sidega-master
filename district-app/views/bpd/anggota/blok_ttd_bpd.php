				<table>
					<tr>
						<td colspan="<?= $total_col ?>">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="<?= $spasi_kiri ?>" style="width: 20%">&nbsp;</td>
						<td colspan="<?= $spasi_kiri ?>" style="width: 20%">&nbsp;</td>
						<td colspan="<?= $spasi_tengah ?>" style="width: 30%">&nbsp;</td>
						<td align='center' colspan="2" class="nowrap"><?= ucwords($this->setting->sebutan_desa) ?> <?= $desa['nama_desa'] ?>, <?= tgl_indo(date("Y m d")) ?></td>
						<td style="width: 20%">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="<?= $spasi_kiri ?>">&nbsp;</td>
						<td align='center' class="nowrap">Mengetahui,</td>
						<td colspan="<?= $spasi_tengah ?>">&nbsp;</td>
						<td align='center' colspan="2" class="nowrap">Dibuat Oleh,</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="<?= $total_col ?>">&nbsp;</td>
					<tr>
						<td colspan="<?= $total_col ?>">&nbsp;</td>
					<tr>
						<td colspan="<?= $total_col ?>">&nbsp;</td>
					<tr>
						<td colspan="<?= $total_col ?>">&nbsp;</td>
					<tr>
						<td colspan="<?= $total_col ?>">&nbsp;</td>
					<tr>
						<td colspan="<?= $total_col ?>">&nbsp;</td>
					<tr>
						<td colspan="<?= $spasi_kiri ?>">&nbsp;</td>
						<td align='center' class="underline nowrap"><?= $pamong_ketahui['nama'] ?></td>
						<td colspan="<?= $spasi_tengah ?>">&nbsp;</td>
						<td align='center' colspan="2" class="underline nowrap"><?= $pamong_ttd['nama'] ?></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="<?= $spasi_kiri ?>">&nbsp;</td>
						<td align='center'><?= $pamong_ketahui['jabatan'] ?></td>
						<td colspan="<?= $spasi_tengah ?>">&nbsp;</td>
						<td align='center' colspan="2"><?= $pamong_ttd['jabatan'] ?></td>
						<td>&nbsp;</td>
					</tr>
				</table>