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
    <li><a href="<?=site_url()."/".$this->uri->segment(1)."/jenisTarif/".$kd_sertifikasi_jenis;?>"><?=$nama_sertifikasi_jenis;?></a></li>
    <li><a href="<?=site_url()."/".$this->uri->segment(1)."/InputItem/".$kd_sertifikasi_jenistarif;?>"><?=$nama_jenistarif;?></a></li>
    <li class="active"><?=$nama_sertifikasi_jenistarifitem;?></li>   
</ul>

<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>

<fieldset><legend><b><?=$this->judul;?></b></legend>
	<input type="hidden" name="kd_sertifikasi_jenistarifitem" value="<?=$kd_sertifikasi_jenistarifitem?>" id="kd_sertifikasi_jenistarifitem" />
	<input type="hidden" name="kd_sertifikasi_jenistarif" value="<?=$kd_sertifikasi_jenistarif?>" id="kd_sertifikasi_jenistarif" />
	<input type="hidden" name="save" value="1" />
	<table width="100%" class="tablefield">
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Nama Item </td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top">
				<?=form_input(array('name'=>'nama_sertifikasi_jenistarifitem', 'value'=>$nama_sertifikasi_jenistarifitem,'class'=>'input-text'));?>
				* <?=form_error('nama_sertifikasi_jenistarifitem')?></td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Biaya</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top">
				<?=form_input(array('name'=>'harga_sertifikasi_jenistarifitem','class'=>'input-text','value'=>$harga_sertifikasi_jenistarifitem,'maxlength'=>'20'));?>
				* <?=form_error('harga_sertifikasi_jenistarifitem')?></td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Satuan </td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top">
				<?=form_input(array('name'=>'satuan_sertifikasi_jenistarifitem','class'=>'input-text','value'=>$satuan_sertifikasi_jenistarifitem,
					'maxlength'=>'200'));?></td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Keterangan1 </td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td  valign="top">
				<?=form_textarea(array('name'=>'keterangan1_jenistarifitem', 'value'=>$keterangan1_jenistarifitem,'class'=>'tinymcenpar',
					'rows'=>'5','cols'=>'30'));?>
				</td>
			</tr>
			<tr>
				<td valign="top" class="input-text-1" style="padding-left:10px;">Keterangan 2</td>
				<td valign="top" class="input-text-1"><div align="center">:</div></td>
				<td valign="top">
				<?=form_textarea(array('name'=>'keterangan2_jenistarifitem', 'value'=>$keterangan2_jenistarifitem,'class'=>'tinymcenpar',
					'rows'=>'5','cols'=>'30'));?>
				</td>
			</tr>
			<?if($this->session->userdata('profil')->groupname == 'super'){?>
			
			<? } ?>
	<tr>
		<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
			<button type="submit" class="button">Simpan</button>&nbsp;
			<button type="button" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" class="button">Kembali</button>
		</td>
	</tr>  
	</table>
</fieldset>
<?=$this->javascript;?>
<?=form_close();?>

<? $this->load->view('view_footer');?>