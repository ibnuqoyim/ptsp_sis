<? $this->load->view('view_header');?>
<div style="clear:both"></div>
<ul class="breadcrumb">
    <li><a href="<?=site_url()."/".$this->uri->segment(1)."/user/";?>">User</a></li>
    <li class="active">View</li>
</ul>
<?=form_open(current_url());?>
<fieldset><legend><b><center><?=$this->judul;?></center></b></legend>
	<input type="hidden" name="nip" value="<?=$nip;?>" id="editlagi" />
	<input type="hidden" name="save" value="1" />
	<table class="table table-condensed  table-striped">
	<tbody>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Nip</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$nip;?> </td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Nip Baru</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$nip_baru;?> </td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Nama</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$Nama;?></td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Email</td>
				<td valign="top" class="input-text-1" style="vertical-align:top"><div align="center">:</div></td>
				<td valign="top"><?=$email;?></td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Keterangan</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$keterangan;?></td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;white-space:nowrap">Groupid</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$groupname;?></td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Tanggal Daftar</td>
				<td valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
				<td valign="top"><?=mdate("%d-%m-%Y",strtotime($tgldaftar));?></td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Added by</td>
				<td valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
				<td valign="top"><?=$added_by;?></td>
			</tr>
            <tr><td colspan="3"><hr ice:repeating="true" /></td></tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">NIP</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$nip;?></td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Nip Baru</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$nip_baru;?> </td>
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
				<td valign="top"><?=($Status<3)?"PNS":"Non Aktif";?></td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Kode Satker</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=$nama_satker;?></td>
			</tr>
	<tr>
		<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
			<button type="button" class="btn btn-primary" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" 
				>Kembali</button>
		</td>
	</tr>
	</table>
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<? $this->load->view('view_footer');?>
