<?=$this->load->view('view_header');?>
	<div>
		<ul class="nav nav-tabs" id="tab">
    		<li class="active"><a href="#">Tarif</a></li>
    		<li><a href="<?=base_url();?>index.php/komoditi">Komoditi</a></li>
            <li><a href="<?=base_url();?>index.php/dokumen/ItemDokumen">Dokumen</a></li>
            <li><a href="<?=base_url();?>index.php/smm">SMM</a></li>
            <li><a href="<?=base_url();?>index.php/auditor">Auditor</a></li>
		</ul>
	<div style="clear:both"></div>
<div style="clear:both"></div>
<p><?=anchor(site_url()."/".$this->uri->segment(1),ucfirst($this->uri->segment(1)))." &raquo; Detail Parameter ".$nama_tarif;?></p>
<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>
<fieldset><legend><b><?=$this->judul;?></b></legend>
	<table width="550" class="tablefield">
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;"><span class="input-text-1" style="padding-left:10px;">Kode  Parameter </span></td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$kd_parameter;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;"><span class="input-text-1" style="padding-left:10px;">Nama  Parameter  Uji</span></td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$nama_parameter;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;"><span class="input-text-1" style="padding-left:10px;">Harga Satuan </span></td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$harga_satuan;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;"><span class="input-text-1" style="padding-left:10px;">Metoda  Parameter </span></td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$metoda_parameter;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;"><span class="input-text-1" style="padding-left:10px;">Syarat Mutu  Parameter </span></td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$syarat_mutu_parameter;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;"><span class="input-text-1" style="padding-left:10px;">Durasi SPM </span></td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=$spm_parameter;?></td>
			</tr>
			<? if($this->session->userdata('profil')->groupname == 'super'){?>
			<? } ?>
	<tr>
		<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
			<button type="button" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" class="button">Kembali</button>
		</td>
	</tr>
	</table>
<?=form_close();?>
<?=$this->javascript;?>
<?=$this->load->view('view_footer');?>
