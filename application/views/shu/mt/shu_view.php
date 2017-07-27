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

   

    
</head>
<body>

<div style="clear:both"></div>
<div class="title" style="margin-left:10px"><center>Sertifikat Hasil Uji (SHU)</br>No. Order : <?=$no_order;?></center></div>
<?= form_open_multipart(current_url());?>
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
			<?=$status_shu;?>
		</td> 
            </tr>
	    			  
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">No. Sertifikat Hasil Uji (SHU)</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$no_shu;?>
			
		</td>
	    </tr>
	     <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tgl. Analisis/Pengujian</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($tgl_pengujian));?>
		
		</td>
            </tr>
	     <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tgl. Selesai Analisis/Pengujian</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($tgl_selesai_pengujian));?>
			
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal Dibuat Koordinator</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($tgl_dibuat_penyelia));?>
			
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal Cetak/Terbit SHU</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($tgl_cetak));?>
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal diperiksa Kasi Pengujian</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($tgl_disetujui_wmanajer_teknis));?>
			
		</td>
           
            </tr>		    
	    <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Comment Kasi Pengujian</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
		<?=$comment_wmanajer_teknis;?>
		</td>
           </tr>
	   <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal disetujui Kabid Pengujian</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($tgl_disetujui_manajer_teknis));?>
			
		</td>
           
            </tr> 
	   <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Comment Manager Teknis</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
		<?=$comment_manajer_teknis;?>
		</td>
           </tr>
	<!--
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Pengambil Contoh</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$nama_pengambil_sampling;?>
			
		</td>
	    </tr>
	    <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Komoditi</td>
		<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
		<td width="413" valign="top">
			<?=$nama_komoditi;?>
		</td>
     	    </tr>
     
            <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Tipe/Kategori komoditi</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
			<?=$tipe_komoditi;?>
		</td>
            </tr>
            <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Brand/Merk Komoditi</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
			<?=$brand_komoditi;?>
		</td>
            </tr>
            <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Label/Nomor Kode</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
		<?=$label_nokode_komoditi;?>
            </tr>
            <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Jumlah</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
		<?=$jumlah_sampling;?>
	    	</td>
            </tr>
            <tr>-->
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Perusahaan</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$nama_perusahaan;?>
			
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Alamat Perusahaan</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=$alamat_perusahaan;?>
		</td>
	    </tr>
            <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Alamat Pabrik</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=$alamat_pabrik;?>
		</td>
	    </tr> 
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal Sertifikat diserahkan</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?
			    if($tgl_diserahkan_sertifikat <> '0000-00-00'){ 
			        echo date("d F Y",strtotime($tgl_diserahkan_sertifikat));
			    }
			?>
			
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Penyerah sertifikat</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=$nm_penyerah_sertifikat;?>
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Penerima sertifikat</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=$nm_penerima_sertifikat;?>
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
		<td>
		<div style="width: 800px; height: 600px;" scrolling="no">
        	<iframe src="<?=$file_shu;?>" height="600" width="800" scrolling="no" ><?=basename($file_shu);?></iframe> 
			   
   		</div>
		</td>
   </tr>
   
</table>
<?=form_close();?>

<?//=$this->javascript;?>

    
</body>
</html>
