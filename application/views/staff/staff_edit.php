<? $this->load->view('view_header');?>
<div style="clear:both"></div>
<?=form_open(current_url());?>
<fieldset><legend><b><?=@$this->judul;?></b></legend>
	<input type="hidden" name="tambahlagi" value="0" id="tambahlagi" />
	<input type="hidden" name="save" value="1" />
	<table width="550" class="tablefield">
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">NIP</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$username;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Nama</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$Nama;?></td>
			</tr>
            <!-- 
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Password</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_password(array('name'=>'password','class'=>'input','maxlength'=>'30'));?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;white-space:nowrap">Konfirmasi Password</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_password(array('name'=>'cpassword','class'=>'input','maxlength'=>'30'));?></td>
			</tr>
            //-->
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Tempat Lahir</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$Tempat_Lahir;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Tanggal Lahir</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=mdate("%d-%m-%Y", strtotime($Tanggal_Lahir));?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Jenis Kelamin</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=($Jenis_Kelamin=="L")?"Laki-laki":"Perempuan";?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Pangkat</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$Pangkat;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Golongan</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$Golongan;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Jabatan</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$Jabatan;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Status</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$Status;?></td>
			</tr>
			<?if($this->session->userdata('profil')->groupname=='super'){?>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Group</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_dropdown('groupid',$this->staff->GetGroupList4DropDown(),$groupid,'class="input-option" id="groupid"');?></td>
			</tr>
			<?}?>
	<tr>
		<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
			<button type="submit" class="button">Simpan</button>&nbsp;
			<button type="button" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" class="button">Kembali</button>
		</td>
	</tr>
	</table>
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<? $this->load->view('view_footer');?>
