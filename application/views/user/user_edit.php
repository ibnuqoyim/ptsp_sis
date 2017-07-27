<? $this->load->view('view_header');?>
<div style="clear:both"></div>
<p><?=anchor(site_url()."/".$this->uri->segment(1),ucfirst($this->uri->segment(1)))." &raquo; ".ucfirst($this->uri->segment(2));?></p>
<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>
<fieldset>
	<legend><b><?=$this->judul;?></b></legend>
	<input type="hidden" name="tambahlagi" value="0" id="tambahlagi" />
	<input type="hidden" name="save" value="1" />
	<div style="margin-top:5px">
	<table width="100%" class="tablefield">
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">UserID</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top"><?=$userid;?>		
			</td>
    	</tr>
   		<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Nip Baru</td>
			<td valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
			<td align="top">
				<?=form_input(array('name'=>'nip_baru','class'=>'input-text-1','value'=>$nip_baru,'maxlength'=>'50','size'=>'30'));?>
			</td>
    	</tr>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">Password Baru</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top">
				<?=form_password(array('name'=>'password','class'=>'input-text-1','maxlength'=>'100', 'value'=>''));
				?> (Biarkan kosong jika menggunakan password lama)</td>
   		 </tr>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;white-space:nowrap">Konfirmasi Password</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top">
				<?=form_password(array('name'=>'cpassword','class'=>'input-text-1','maxlength'=>'30'));?> 
			</td>
    	</tr>
   		<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Email</td>
			<td valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
			<td valign="top">
				<?=form_input(array('name'=>'email','class'=>'input-text-1','value'=>$email,'maxlength'=>'50','size'=>'30'));?></td>
    	</tr>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Keterangan</td>
			<td valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
			<td valign="top">
				<?=form_textarea(array('name'=>'keterangan','class'=>'textarea','value'=>$keterangan,'rows'=>'5','cols'=>'55'));?>
			</td>
    	</tr>
    		<? if($this->session->userdata('profil')->groupname == 'super' || 
          			$this->session->userdata('profil')->groupname=='admin'){?>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">Group</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top">
                 <?=form_dropdown('groupid',$this->mstaff->GetGroupList4DropDown(),
                                        $groupid,'class="input-option" id="groupid"');?>
        	</td>
    	</tr>
    		<? } ?>
            
    	<tr>
			<td colspan="3"><hr ice:repeating="true" /></td>
    	</tr>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">NIP</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top"><?=$nip;?></td>
    	</tr>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">NIP</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top"><?=$nip_baru;?></td>
    	</tr>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">Nama</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top"><?=$Nama;?></td>
    	</tr>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">Tempat Lahir</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top"><?=$Tempat_Lahir;?></td>
   		</tr>
   		<tr>
			<td Valign="top" class="input-text-1" style="padding-left:10px;">Tanggal Lahir</td>
			<td Valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top"><?=mdate("%d-%m-%Y", strtotime($Tanggal_Lahir));?></td>
    	</tr>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">Jenis Kelamin</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top"><?=($Jenis_Kelamin=="L")?"Laki-laki":"Perempuan";?></td>
    	</tr>
   		<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">Pangkat</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top"><?=$Pangkat;?></td>
    		</tr>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">Golongan</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
			<td valign="top"><?=$Golongan;?></td>
    	</tr>
    	<tr>
			<td valign="top" class="input-text-1" style="padding-left:10px;">Jabatan</td>
			<td valign="top" class="input-text-1"><div align="center">:</div></td>
	<td valign="top"><?=$Jabatan;?></td>
    </tr>
    <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px;">Status</td>
	<td valign="top" class="input-text-1"><div align="center">:</div></td>
	<td valign="top"><?=$Status;?></td>
    </tr>
    <? if($this->session->userdata('profil')->groupname == 'super'){?>
    <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px;">Satker</td>
	<td valign="top" class="input-text-1"><div align="center">:</div></td>
	<td valign="top">
		<?=form_dropdown('kd_satker',$this->mstaff->GetSatkerList4DropDown(),
		$kd_satker,'class="input-option" id="kd_satker"');?>
	</td>
    </tr>
    <? } ?>
    <tr>
	<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
		<button type="submit" class="button">Simpan</button>&nbsp;
<button type="button" 
onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'"class="button">Kembali</button>
	</td>
    </tr>
</table>`</div>
</fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<? $this->load->view('view_footer');?>
