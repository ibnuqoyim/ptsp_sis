<div class="form">
	<?=form_open('tarif/JenisTarif/'.$kd_sertifikasi_jenistarif,array('id'=>'frmsearch'));?>
		<fieldset>
			<legend><b>Pencarian</b></legend>
				<div style="margin-top:5px" >
					<table border="0" align="right" cellpadding="0" cellspacing="0" width="100%" >
						<tr>
							<td align="right"><div class="input-text-1">Nama Jenis Tarif sertifikasi</div></td>
							<td><?=form_input('nama_jenistarif',''/*(isset($nama_jenistarif)? $nama_jenistarif:'')*/,'class="input-text-1"');?></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td align="right">
								<a href="javascript:void();"><button type="submit" class="btn btn-primary">Cari</button></a>&nbsp;
								<a href="javascript:void();"><button type="button" class="btn btn-primary" onclick="goReset()">Reset</button></a>
							</td>
						</tr>
					</table>
				</div>	
		</fieldset>
<?=form_close();?>
</div>