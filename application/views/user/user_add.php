<? $this->load->view('view_header');?>
<div style="clear:both"></div>
<p><?=anchor(site_url()."/".$this->uri->segment(1),ucfirst($this->uri->segment(1)))." &raquo; ".ucfirst($this->uri->segment(2));?></p>
<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>
<fieldset><legend><b><?=$this->judul;?></b></legend>
<input type="hidden" name="tambahlagi" value="0" id="tambahlagi" />
<input type="hidden" name="save" value="1" />
<table width="550" class="tablefield">
    <tr>
	<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">NIP</td>
	<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=form_input(array('name'=>'nip','value'=>$nip,'class'=>'input','maxlength'=>'30'));
		?>  * <?=form_error('nip')?></td>
    </tr>
    <tr>
	<td width="100" valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Nip Baru</td>
	<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=form_input(array('name'=>'nip_baru','class'=>'input','value'=>$nip_baru,'maxlength'=>'200','size'=>'50'));?>
	</td>
    </tr>
    <!-- <tr>
	<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">UserID</td>
	<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=form_input(array('name'=>'userid','class'=>'input','maxlength'=>'30'));
		?>  * <?=form_error('userid')?>
	</td>
    </tr> -->
    <tr>
	<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Password</td>
	<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=form_password(array('name'=>'password','class'=>'input','maxlength'=>'30', 'value'=>''));
		?>  * <?=form_error('password')?>
	</td>
    </tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;white-space:nowrap">Konfirmasi Password</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_password(array('name'=>'cpassword','class'=>'input','maxlength'=>'30'));?>  * <?=form_error('cpassword')?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Email</td>
				<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'email','class'=>'input','maxlength'=>'200','size'=>'40'));?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Keterangan</td>
				<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_textarea(array('name'=>'keterangan','class'=>'textarea','rows'=>'5','cols'=>'40'));?></td>
			</tr>
			<? if($this->session->userdata('profil')->groupname == 'super' || $this->session->userdata('profil')->groupname=='admin'){?>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Group</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_dropdown('groupid',$this->mUser->GetGroupList4DropDown(),$groupid,'class="input-option" id="groupid"'); ?></td>
			</tr>
			<? } ?>
	<tr>
		<td align="center" style="padding-top:15px; text-align:right; " colspan="3">
			<button type="submit" class="button">Simpan</button>&nbsp;
		<button type="button" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" class="button">Kembali</button>
		</td>
	</tr>
	</table>
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<? $this->load->view('view_footer');?>