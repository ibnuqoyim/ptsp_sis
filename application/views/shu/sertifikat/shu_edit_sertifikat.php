<html>
<head>
<base href="<?=base_url();?>" />
    <link rel="stylesheet" type="text/css" href="css/<?=($this->uri->segment(1)==="order" && $this->uri->segment(2)!="")?"flick/":"";?>screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/chalsy.js"></script>
    <link rel="stylesheet" type="text/css" href="css/chalsy.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <link type="text/css" href="js/calendar/css/smoothness/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
    <script type="text/javascript" src="js/calendar/js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="js/calendar/js/jquery-ui-1.8.14.custom.min.js"></script>
    <script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>	
	   <script type="text/javascript">
    		 $(document).ready(function(){
       		 	
			$("textarea.tinymcemini").tinymce({
            				// Location of TinyMCE script
            				script_url : "<?=base_url()?>js/tiny_mce/tiny_mce.js",
					mode : "textareas",
					theme : "advanced",
					plugins : "visualchars,table",							
					// Theme options
					theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,sub,sup,|,charmap,|,bullist,numlist",
					theme_advanced_buttons2 : "bold,tablecontrols,|",
					force_p_newlines : false,
					force_br_newlines : true,
					forced_root_block : "",
					height: '25px',
					width: '400px'
        			});
    		}); 
	   </script>

    
</head>
<body>
<div style="clear:both"></div>
<div class="title" style="margin-left:10px"><?=$this->judul;?></div>
<p><?=$this->errormsg;?></p>
<?= form_open_multipart(current_url());?>
<input type="hidden" name="save" value="1" />
<input type="hidden" name="kd_shu" value="<?=$kd_shu;?>" >
<input type="hidden" name="nip_pengetik_sertifikat" value="<?=$nip_pengetik_sertifikat;?>" >
<input type="hidden" name="nm_pengetik_sertifikat" value="<?=$nm_pengetik_sertifikat;?>" >
<input type="hidden" name="no_order" value="<?=$no_order;?>" >
<input type="hidden" name="kd_order" value="<?=$kd_order;?>" >
<input type="hidden" name="kd_detail_order" value="<?=$kd_detail_order;?>" >
<input type="hidden" name="tgl_order" value="<?=$tgl_order;?>" ">
<input type="hidden" name="tgl_perkiraan_selesai" value="<?=$tgl_perkiraan_selesai;?>" >
<!--<input type="hidden" name="tgl_pengujian" value="<?=$tgl_pengujian;?>" ">
<input type="hidden" name="tgl_selesai_pengujian" value="<?=$tgl_selesai_pengujian;?>" > -->

<table width="550" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
      <td>
	 <table width="550" border="0" cellspacing="3" cellpadding="0">
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">No. Pengujian / Analisis</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=form_input(array('name'=>'no_pengujian','class'=>'input-option',
			'value'=>$no_pengujian,'id'=>'no_pengujian','size'=>'20','maxlength'=>'30'));?>
			
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Status SHU</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?php $options= array(''=> '','selesai' => 'Selesai'); ?>
               		<?=form_dropdown('status_shu',$options, ($status_shu !='')? $status_shu:$status_shu,'class="input-option"')?>
			* <?=form_error('status_shu')?>
		</td>
            </tr>			  
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">No. Sertifikat Hasil Uji (SHU)</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=form_input(array('name'=>'no_shu','class'=>'input-option',
			'value'=>$no_shu,'id'=>'no_shu','size'=>'30','maxlength'=>'30'));?> * <?=form_error('no_shu')?>
			
		</td>
	    </tr>
	     <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tgl. Analisis/Pengujian</br><font color=red>(diambil dari data RHU)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=form_input(array('name'=>'tgl_pengujian','class'=>'input-option',
			'value'=>$tgl_pengujian,'id'=>'tgl_pengujian','size'=>'10','maxlength'=>'10'));?>
			<style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
		</td>
            </tr>
	     <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tgl. Selesai Analisis/Pengujian</br><font color=red>(diambil dari data RHU)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=form_input(array('name'=>'tgl_selesai_pengujian','class'=>'input-option',
			'value'=>$tgl_selesai_pengujian,'id'=>'tgl_selesai_pengujian','size'=>'10','maxlength'=>'10'));?>
			<style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal Dibuat Bagian Sertifikat</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=form_input(array('name'=>'tgl_dibuat_pengetik_sertifikat','class'=>'input-option',
			'value'=>$tgl_dibuat_pengetik_sertifikat,'id'=>'tgl_dibuat_pengetik_sertifikat',
			'size'=>'10','maxlength'=>'10'));?>
			<style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal Cetak/Terbit SHU</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=form_input(array('name'=>'tgl_cetak','class'=>'input-option',
			'value'=>$tgl_cetak,'id'=>'tgl_cetak','size'=>'10','maxlength'=>'10'));?>
			<style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
		</td>
            </tr>    
	   
	   
	     <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Pengambil Contoh</br><font color=red>(diambil dari data Sampling Report)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=form_input(array('name'=>'nama_pengambil_sampling','class'=>'input-option',
			'value'=>$nama_pengambil_sampling,'id'=>'nama_pengambil_sampling','size'=>'30','maxlength'=>'30'));?>
			
		</td>
	    </tr>
	    <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px;">Komoditi</br><font color=red>(diambil dari data Sampling Report)</font></td>
	<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=form_input(array('name'=>'nama_komoditi','class'=>'input-option','value'=>$nama_komoditi,
			'maxlength'=>'50','size'=>'30','style'=>'background-color:#bbb'));?>
	</td>
     </tr>
     
     <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Tipe/Kategori komoditi</br><font color=red>(diambil dari data Sampling Report)</font></td>
	<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=form_textarea(array('name'=>'tipe_komoditi', 'class'=>'tinymcemini','value'=>$tipe_komoditi,'cols'=>'50',
					'rows'=>'1'));?>
	</td>
     </tr>
     <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Brand/Merk Komoditi</br><font color=red>(diambil dari data Sampling Report)</font></td>
	<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=form_textarea(array('name'=>'brand_komoditi','class'=>'tinymcemini',
		'value'=>$brand_komoditi,'cols'=>'50','rows'=>'1'));?>
	</td>
     </tr>
     <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Label/Nomor Kode</br><font color=red>(diambil dari data Sampling Report)</font></td>
	<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=form_textarea(array('name'=>'label_nokode_komoditi','class'=>'tinymcemini',
		'value'=>$label_nokode_komoditi ,'cols'=>'50','rows'=>'1'));?>
     </tr>
     <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Jumlah</br><font color=red>(diambil dari data Sampling Report)</font></td>
	<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=form_textarea(array('name'=>'jumlah_sampling','class'=>'tinymcemini','value'=>$jumlah_sampling,
		'cols'=>'50','rows'=>'1'));?>
	</td>
     </tr>
     <tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Perusahaan</br><font color=red>(diambil dari data order customer tujuan)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=form_input(array('name'=>'nama_perusahaan','class'=>'input-option',
			'value'=>$nama_perusahaan,'id'=>'nama_perusahaan','size'=>'30','maxlength'=>'30'));?>
			
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Alamat Perusahaan</br><font color=red>(diambil dari data order customer tujuan)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=form_textarea(array('name'=>'alamat_perusahaan','value'=>$alamat_perusahaan,
				'class'=>'tinymcemini','rows'=>'3','cols'=>'50'));?>
		</td>
	    </tr>
            <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Alamat Pabrik</br><font color=red>(diambil dari data order customer tujuan)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=form_textarea(array('name'=>'alamat_pabrik','value'=>$alamat_pabrik,
				'class'=>'tinymcemini','rows'=>'3','cols'=>'50'));?>
		</td>
	    </tr>
	     <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Upload File SHU (File PDF)</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<input type="file" name="userfile" class="input-option" size="20" />
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">SHU kerja yang telah diupload</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
					<?=($file_shu !="")?basename($file_shu ):"-";?>
				
	    </td>
	    </tr> 	
	</table>
	    
      </td>
   </tr>

   <tr>
	<td align="center" style="padding-top:15px">
			<button type="submit" class="button">Simpan</button>
	</td>
   </tr>
   <?if($file_shu){?>
   <tr>
		<td>
		<div style="width: 800px; height: 600px;" scrolling="no">
        	<iframe src="<?=$file_shu;?>" height="600" width="800" scrolling="no" ><?=basename($file_shu);?></iframe> 
			   
   		</div>
		</td>
   </tr>
   <?}?>
</table>
<?=form_close();?>

<?=$this->javascript;?>

    
</body>
</html>
