<div class="form">
	<?=form_open('customer',array('id'=>'frmsearch'));?>
		<fieldset>
			<legend><b>Pencarian</b></legend>
				<div style="margin-top:5px" >
					<table border="0" align="right" cellpadding="0" cellspacing="0" width="100%" >
	   					<tr>
							<td align="right"><div class="input-text-1">Nama</div></td>
							<td><?=form_input('nama',(isset($nama)? $nama:''),'class="input-text-1"');?></td>
	   					</tr>
	  					<tr>
							<td align="right"><div class="input-text-1">Kota</div></td>
							<td><?=form_input('kota',(isset($kota)? $kota:''),'class="input-text-1"');?></td>
	   					</tr>
	   					<tr>
							<td align="right"><div class="input-text-1">Tipe Customer</div></td>
							<td>
								<?=form_dropdown('kd_tipe_customer',$this->mCustomer->GetTipeCustomerList4DropDown(),
								(isset($kd_tipe_customer)? $kd_tipe_customer:''),'class="input-option"');?>
							</td>
	   					</tr>
	   					<tr>
							<td align="right"><div class="input-text-1">Sub Tipe Customer</div></td>
							<td>
								<?=form_dropdown('kd_subtipe_customer',$this->mCustomer->GetSubTipeCustomerList4DropDown(),
								(isset($kd_subtipe_customer)? $kd_subtipe_customer:''),'class="input-option"');?>
							</td>
	   					</tr>
           				<?php if($this->session->userdata('profil')->groupname == 'super'){ ?>
	   					<tr>
							<td align="right"><div class="input-text-1">Satuan Kerja</div></td>
							<td>
								<?=form_dropdown('kd_satker',$this->mstaff->GetSatkerList4DropDown(),
								(isset($kd_satker)? $kd_satker:''),'class="input-option"');?></td>
	   					</tr>
           				<? } ?>
	   					<tr>
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