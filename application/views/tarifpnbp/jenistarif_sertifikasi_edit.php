<? $this->load->view('view_header');?>
<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">Tarif</a></li>
    		<li><a href="<?=base_url();?>index.php/komoditi">Komoditi</a></li>
            <li><a href="<?=base_url();?>index.php/dokumen/ItemDokumen">Dokumen</a></li>
            <li><a href="<?=base_url();?>index.php/smm">SMM</a></li>
            <li><a href="<?=base_url();?>index.php/auditor">Auditor</a></li>
		</ul>
	<div style="clear:both"></div>
<ul class="breadcrumb">
    <li><a href="<?=site_url()."/".$this->uri->segment(1)."/JenisSertifikasi/";?>">Tarif</a></li>
    <li><a href="<?=site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3);?>"><?=$nama_sertifikasi_jenis;?></a></li>
    <li class="active"><?=$nama_jenistarif;?> / Edit</li>   
</ul>
<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>
<fieldset><legend><b><?=$this->judul;?></b></legend>
	<input type="hidden" name="kd_sertifikasi_jenistarif" value="<?=$kd_sertifikasi_jenistarif;?>" id="kd_sertifikasi_jenistarif" />
	<input type="hidden" name="kd_sertifikasi_jenis" value="<?=$kd_sertifikasi_jenis;?>" id="kd_sertifikasi_jenis" />
	<input type="hidden" name="save" value="1" />
	<table width="100%" class="tablefield">
			<tr>
			<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Nama Jenis Tarif Sertifikasi</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top"><?=form_input(array('name'=>'nama_jenistarif','class'=>'input-text',
					'value'=>$nama_jenistarif,'maxlength'=>'200'));?>  * <?=form_error('nama_jenistarif')?></td>
			</tr>			
			<? if($this->session->userdata('profil')->groupname == 'super'){?>
			<?=$nama_jenistarif;?>
			<? } ?>
	<tr>
		<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
			<button type="submit" class="btn btn-info">Simpan</button>&nbsp;
			<button type="button" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" 
				class="btn btn-info">Kembali</button>
		</td>
	</tr>
	</table>
</fieldset>
<?=form_close();?>
<? $this->load->view('view_footer');?>