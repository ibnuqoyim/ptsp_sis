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
    <li class="active"><?=$nama_sertifikasi_jenis;?> / Edit</li>
</ul>
<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>

<fieldset><legend><b><?=$this->judul;?></b></legend>
	<input type="hidden" name="tambahlagi" value="0" id="tambahlagi" />
	<input type="hidden" name="save" value="1" />
	<table width="100%" class="tablefield">
			<tr>
			<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Nama Jenis Tarif</td>
				<td valign="top" class="input-text-1"><div align="center">:</div>
					<?=form_hidden('kd_sertifikasi_jenis',$kd_sertifikasi_jenis);?>
				</td>
				<td valign="top">
					<?=form_input(array('name'=>'nama_sertifikasi_jenis','class'=>'input-text-1','value'=>$nama_sertifikasi_jenis,
					'maxlength'=>'255'));?>  * <?=form_error('nama_sertifikasi_jenis')?></td>
			</tr>
			<? if($this->session->userdata('profil')->groupname == 'super'){?>
			
			<? } ?>
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