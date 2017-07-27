<div class="form">
	<?=form_open('staff',array('id'=>'frmsearch'));?>
		<fieldset>
			<legend><b>Pencarian</b></legend>
				<div style="margin-top:5px" >
					<table border="0" align="right" cellpadding="0" cellspacing="0" width="100%" >
						<tr>
							<td align="right"><div class="input-text-1">NIP</div></td>
							<td align="center"><div class="input-text-1">:</div></td>
							<td><?=form_input('NIP',(isset($NIP)? $NIP:''),'class="input-text-1"');?></td>
						</tr>
						<tr>
							<td align="right"><div class="input-text-1">Nama</div></td>
							<td align="center"><div class="input-text-1">:</div></td>
							<td><?=form_input('Nama',(isset($Nama)? $Nama:''),'class="input-text-1"');?></td>
						</tr>
						<tr>
							<td align="right"><div class="input-text-1">Satuan Kerja</div></td>
							<td align="center"><div class="input-text-1">:</div></td>
							<td><?=form_dropdown('kd_satker',$this->mstaff->GetSatkerList4DropDown(),(isset($kd_satker)? $kd_satker:''),'class="input-option"');?></td>
							</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td align="right">
								<a href="javascript:void();"><button type="submit" class="button">Cari</button></a>&nbsp;
								<a href="javascript:void();"><button type="button" class="button" onclick="goReset()">Reset</button></a>
							</td>
						</tr>
					</table>
				</div>	
		</fieldset>
	<?=form_close();?>
</div>