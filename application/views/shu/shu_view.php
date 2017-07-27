<?=$this->load->view('view_header');?>
<div style="clear:both"></div>
<p><?=anchor(site_url()."/".$this->uri->segment(1),ucfirst($this->uri->segment(1)))." &raquo; View LHU";?></p>
<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>
<fieldset><legend><b><?=$this->judul;?></b></legend>
	<table width="550" border="0" cellspacing="3" cellpadding="0"  class="tablefield">
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">No. Pengujian / Analisis</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$result->no_pengujian;?>
			
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Status SHU</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$result->status_shu;?>
		</td> 
            </tr>
	    			  
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">No. Sertifikat Hasil Uji (SHU)</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$result->no_shu;?>
			
		</td>
	    </tr>
	     <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tgl. Analisis/Pengujian</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($result->tgl_pengujian));?>
		
		</td>
            </tr>
	     <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tgl. Selesai Analisis/Pengujian</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($result->tgl_selesai_pengujian));?>
			
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal Dibuat Bagian Sertifikat</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($result->tgl_dibuat_pengetik_sertifikat));?>
			
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal Cetak/Terbit SHU</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($result->tgl_cetak));?>
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal disetujui</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=date("d F Y",strtotime($result->tgl_disetujui_manajer_teknis));?>
			
		</td>
           
            </tr>
	    <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Comment Manager Teknis</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
		<?=$result->comment_manajer_teknis;?>
		</td>
           </tr>    
	    
	   
	   
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Pengambil Contoh</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$result->nama_pengambil_sampling;?>
			
		</td>
	    </tr>
	    <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Komoditi</td>
		<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
		<td width="413" valign="top">
			<?=$result->nama_komoditi;?>
		</td>
     	    </tr>
     
            <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Tipe/Kategori komoditi</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
			<?=$result->tipe_komoditi;?>
		</td>
            </tr>
            <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Brand/Merk Komoditi</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
			<?=$result->brand_komoditi;?>
		</td>
            </tr>
            <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Label/Nomor Kode</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
		<?=$result->label_nokode_komoditi;?>
            </tr>
            <tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Jumlah</td>
		<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td width="413" valign="top">
		<?=$result->jumlah_sampling;?>
	    	</td>
            </tr>
            <tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Perusahaan</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?=$result->nama_perusahaan;?>
			
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Alamat Perusahaan</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=$result->alamat_perusahaan;?>
		</td>
	    </tr>
            <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Alamat Pabrik</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=$result->alamat_pabrik;?>
		</td>
	    </tr> 
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Tanggal Sertifikat diserahkan</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			<?
			    if($result->tgl_diserahkan_sertifikat <> '0000-00-00'){ 
			        echo date("d F Y",strtotime($result->tgl_diserahkan_sertifikat));
			    }
			?>
			
		</td>
            </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Penyerah sertifikat</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=$result->nm_penyerah_sertifikat;?>
		</td>
	    </tr>
	    <tr>
		<td width="300" valign="top"  style="padding-left:10px;">Nama Penerima sertifikat</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" >
			   <?=$result->nm_penerima_sertifikat;?>
		</td>
	    </tr>
             <tr>
		<td width="300" valign="top"  style="padding-left:10px;">SHU kerja yang telah diupload</td>
		<td width="20" valign="top" ><div align="center">:</div></td>
		<td width="300" valign="top" ><?=basename($result->file_shu );?>
	    </td>
	    </tr>
	     <tr>
		<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
            		<button type="button" 
			onclick="javascript:window.location.href='<?=site_url()."/".$this->uri->segment(1);?>'" class="button">Kembali
			</button>
         	</td>
            </tr>
	</table>
	 <table width="550" class="tablefield">
	    <tr>
		<td>
		<div style="width: 800px; height: 600px;" scrolling="no">
        	<iframe src="<?=$file_shu;?>" height="600" width="800" scrolling="no" ><?=basename($file_shu);?></iframe> 
			   
   		</div>
		</td>
	   </tr>
	</table>
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<?=$this->load->view('view_footer');?>
