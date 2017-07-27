<?=form_open('user',array('id'=>'frmsearch'));?>
<div style="margin-top:10px">
	<table border="0" align="right" cellpadding="0" cellspacing="0">
		
		<tr>
			<td align="right" style="padding-bottom:5px"><div class="input-text-1">Satker</div></td>
			<td style="padding-bottom:5px">
				<?=form_dropdown('nama_satker',$this->mCustomer->GetTipeCustomerList4DropDown(),
				(isset($nama_satker)? $nama_satker:''),'class="input-option"');?>
			</td>
		</tr>
		
		<tr>
			<td align="right" style="padding-bottom:5px"><div class="input-text-1">Tanggal Terbit/Cetak </div></td>
			<td style="padding-bottom:5px">
			<?=form_dropdown('tgl_terbit',$this->mCustomer->GetTipeCustomerList4DropDown(),(isset($tgl_terbit)? $tgl_terbit:''),'class="input-option"');?></td>
		</tr>
		
		<tr>
			<td align="right" style="padding-bottom:5px"><div class="input-text-1">Perusahaan</div></td>
			<td style="padding-bottom:5px"><?=form_dropdown('nama',$this->mCustomer->GetTipeCustomerList4DropDown(),(isset($nama)? $nama:''),'class="input-option"');?></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td align="right">
				<button type="submit" style="border:none;background-color:transparent;padding:0px;">
				<?=img('./images/cari.jpg');?></button>
				<button type="button" style="border:none;background-color:transparent;padding:0px;" onclick="goReset()">
				<?=img('./images/reset.jpg');?></button>
			</td>
		</tr>
	</table>
</div>	
<?=form_close();?>
