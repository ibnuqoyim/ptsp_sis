
<? $this->load->view('view_header');?>
<div style="clear:both"></div>
<ul class="breadcrumb">
    <li><a href="<?=site_url()."/".$this->uri->segment(1)."/staff/";?>">Staff</a></li>
    <li class="active">View</li>
</ul>

<fieldset><legend><b><center>View Staff</center></b></legend>
	<fieldset>
	<input type="hidden" name="nip" value="<?=$NIP;?>" id="editlagi" />
	<input type="hidden" name="save" value="1" />

	<table class="table table-condensed  table-striped">
	<tbody>
			<tr>			
				<td class="input-text-1" style="padding-left:10px;">NIP</td>
				<td class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$NIP;?></td>
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
				<td valign="top" class="input-text-1" style="padding-left:10px;">Tanggal Lahir</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
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
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Kode Satker</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$nama_satker;?></td>
			</tr>
	<tr>
		<td style="text-align:right" colspan="3">
			<button type="button" class="btn btn-primary" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" class="button">Kembali</button>
		</td>
	</tr>
	</tbody>
	</table>
</fieldset>
<?=$this->javascript;?>
<? $this->load->view('view_footer');?>
