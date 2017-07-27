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
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
    <script type="text/javascript" src="js/calendar/js/jquery-ui-1.8.14.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery-pdfdoc/pdf.js"></script>
    <script type="text/javascript" src="js/jquery-pdfdoc/jquery-pdfdoc.js"></script>
    <link href="js/jquery-pdfdoc/jquery-pdfdoc.css" rel="stylesheet" type="text/css" />

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
<? 
	$dat=$this->mUser->getDetail($this->session->userdata('userid')); 
	$dat1=$this->mUser->getDetail($this->session->userdata('userid')); 
	
?>
<?= form_open_multipart(current_url());?>
<input type="hidden" name="save" value="1" />
<input type="hidden" name="edit" value="1" />
<input type="hidden" name="kd_shu" value="<?=$kd_shu;?>" >

<table width="550" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
      <td>
	 <table width="550" border="0" cellspacing="3" cellpadding="0">
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">No. Pengujian / Analisis</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$no_pengujian;?>
			
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Status SHU</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?php $options= array('Disetujui' => 'Disetujui',
			                      'Diperbaiki' => 'Diperbaiki'); ?>
               		<?=form_dropdown('status_shu',$options, ($status_shu !='')? $status_shu:$status_shu,'class="input-option"')?>
			* <?=form_error('status_shu')?>
		</td> 
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal disetujui Kabid Pengujian</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<input type="hidden" name="nip_manajer_teknis" value="<?=$dat1->nip_baru;?>" >
			<input type="hidden" name="nm_manajer_teknis" value="<?=$dat->Nama;?>" >
			<?=form_input(array('name'=>'tgl_disetujui_manajer_teknis','class'=>'input-option',
			'value'=>$tgl_disetujui_manajer_teknis,'id'=>'tgl_disetujui_manajer_teknis',
			'size'=>'10','maxlength'=>'10'));?>
			<style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
		</td>
           
            </tr>
	    <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Comment Kabid Pengujian</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
		<?=form_textarea(array('name'=>'comment_manajer_teknis','class'=>'tinymcemini',
		'value'=>$comment_manajer_teknis,'cols'=>'50','rows'=>'1'));?>
		</td>
    	   </tr>
	   <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal diperiksa Kasi Pengujian</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" ><?=$tgl_disetujui_wmanajer_teknis;?></td>
           
            </tr>
	    <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Comment Kasi Pengujian</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top"><?=$comment_wmanajer_teknis;?></td>
    	   </tr>			  
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">No. Sertifikat Hasil Uji (SHU)</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$no_shu;?>
			
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tgl. Analisis/Pengujian</br><font color=red>(diambil dari data RHU)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$tgl_pengujian;?>
		
		</td>
            </tr>
	     <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tgl. Selesai Analisis/Pengujian</br><font color=red>(diambil dari data RHU)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$tgl_selesai_pengujian;?>
			
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal Dibuat Koordinator</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$tgl_dibuat_penyelia;?>
			
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal Cetak/Terbit SHU</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$tgl_cetak;?>
		</td>
            </tr> 
	   
	   <!--
	     <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Pengambil Contoh</br><font color=red>(diambil dari data Sampling Report)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$nama_pengambil_sampling;?>
			
		</td>
	    </tr>
	    <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px;">Komoditi</br><font color=red>(diambil dari data Sampling Report)</font></td>
	<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=$nama_komoditi;?>
	</td>
     </tr>
     
     <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Tipe/Kategori komoditi</br><font color=red>(diambil dari data Sampling Report)</font></td>
	<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=$tipe_komoditi;?>
	</td>
     </tr>
     <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Brand/Merk Komoditi</br><font color=red>(diambil dari data Sampling Report)</font></td>
	<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=$brand_komoditi;?>
	</td>
     </tr>
     <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Label/Nomor Kode</br><font color=red>(diambil dari data Sampling Report)</font></td>
	<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=$label_nokode_komoditi;?>
     </tr>
     <tr>
	<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Jumlah</br><font color=red>(diambil dari data Sampling Report)</font></td>
	<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
	<td width="413" valign="top">
		<?=$jumlah_sampling;?>
	</td>
     </tr>
     -->
     <tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Perusahaan</br><font color=red>(diambil dari data order customer tujuan)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$nama_perusahaan;?>
			
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Alamat Perusahaan</br><font color=red>(diambil dari data order customer tujuan)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="1300" valign="top" >
			   <?=$alamat_perusahaan;?>
		</td>
	    </tr>
            <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Alamat Pabrik</br><font color=red>(diambil dari data order customer tujuan)</font></td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=$alamat_pabrik;?>
		</td>
	    </tr> 
	    <tr>
		<td width="150" valign="top"  style="padding-left:10px;">SHU yang telah diupload</td>
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
