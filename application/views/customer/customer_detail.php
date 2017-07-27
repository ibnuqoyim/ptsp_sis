<?=$this->load->view('view_header');?>
<div style="clear:both"></div>
<p><?=anchor(site_url()."/".$this->uri->segment(1),ucfirst($this->uri->segment(1)))." &raquo; ".ucfirst($this->uri->segment(2));?></p>
<?=form_open(current_url());?>
<div class="steptitle">Step 1</div>
<div class="wizard-steps">
  <div class="completed-step"><a href="index.php/customer/Add" onclick="return false"><span>1</span> Data Customer</a></div>
  <div class="active-step"><a href="<?=current_url();?>"><span>2</span> Detail Komoditi Customer</a></div>  
</div>
<fieldset>
<legend><b><?=$this->judul;?></b></legend>
	<input type="hidden" name="kd_customer" value="<?=$kd_customer;?>" id="editlagi" />
	<input type="hidden" name="save" class="button" value="1" />
<table width="550" class="tablefield">
 <tr>
   <td>
	<table width="550" class="tablefield">
	<tr>
		<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Nama Komoditi</td>
		<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
		<td width="413" valign="top"> 
		<?=form_input(array('name'=>'nama_komoditi','id'=>'nama_komoditi','class'=>'input','value'=>$nama_komoditi,
			'maxlength'=>'200','size'=>'30'));?>
		</td>
	</tr>
	<tr>
		<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Tipe Komoditi</td>
		<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
		<td width="413" valign="top"> 
		<?=form_textarea(array('name'=>'tipe_komoditi','id'=>'tipe_komoditi','class'=>'tinymcemini','value'=>$tipe_komoditi,
		'maxlength'=>'200','size'=>'30'));?>
		</td>
	</tr
	<tr>
		<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Brand Komoditi</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:top"><div align="center">:</div></td>
		<td width="413" valign="top">
		<?=form_textarea(array('name'=>'brand_komoditi','id'=>'brand_komoditi','class'=>'tinymcemini','value'=>$brand_komoditi,
		'maxlength'=>'200','size'=>'30'));?>
		</td>
	</tr>
	<tr>
		<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Kapasitas Produksi</td>
		<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
		<td width="413" valign="top">
		<?=form_textarea(array('name'=>'kapasitas_produksi','id'=>'kapasitas_produksi','class'=>'tinymcemini',
		'value'=>$kapasitas_produksi,'maxlength'=>'200','size'=>'30'));?></td>
	</tr>

	<tr>	<? if($this->uri->segment(2)=="DetailKomoditi" ) { ?>
		<td style="padding:25px 25px 25px 0; text-align:left" colspan="3">
			<button type="submit" name="tambah" class="button" value="1">Simpan Tambah</button>
		</td>
		<?}else{?>
		<td style="padding:25px 25px 25px 0; text-align:left" colspan="3">
			<button type="submit" name="tambah" class="button" value="1">Simpan</button>
		</td>
		<?}?>
	</tr>
	
	</table>
   </td>
  </tr>
  <!--<?php// if($kd_tipe_customer=="cst2"){?> -->
  <tr>	<td bgcolor="#FFFFFF" style="background-color:#FFF"></td>
  </tr>
  <tr>
	
	<td align="center" style="padding-top:15px">
        <? 
		if($result) 
		$this->load->view('customer/view_customer_detail.php');
	?>
         </td>
	
  </tr>
 <!--<?php //}?> -->
  <tr>
	<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
	 <button type="button" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" 
		class="button">Kembali</button>
	</td>
        
  </tr>
</table>
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<?=$this->load->view('view_footer');?>
