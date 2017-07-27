<?=$this->load->view('view_header');?>
<div style="clear:both"></div>
<div class="title"><?=$this->judul;?></div>
<p><?=anchor(site_url()."/".$this->uri->segment(1),ucfirst($this->uri->segment(1)))." &raquo; ".$this->uri->segment(2);?></p>
<?=form_open(current_url());?>
<fieldset><legend><b><?=$this->judul;?></b></legend>
	<input type="hidden" name="userid" value="<?=$result->userid;?>" id="editlagi" />
	<input type="hidden" name="save" value="1" />
	<table width="550" class="tablefield">
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Userid</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$result->userid;?> </td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">IP</td>
				<td width="20" valign="top" class="input-text-1" style="vertical-align:top"><div align="center">:</div></td>
				<td valign="top"><?=$result->ip;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">URL</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$result->url;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Action</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$result->action;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;white-space:nowrap">Tanggal</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$result->time;?></td>
			</tr>
		<tr>
		<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
			<button type="button" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" class="button">Kembali</button>
		</td>
	</tr>
	</table>
</fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<?=$this->load->view('view_footer');?>
