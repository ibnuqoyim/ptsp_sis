<html> 
<head>
     <base href="<?=base_url();?>" />
     <!--<link rel="stylesheet" type="text/css" href="css/print3.css" media="screen, projection" />-->
    
</head>
<body onLoad="window.print()" style="background-color:#FFF" style="font-family:Verdana, Geneva, sans-serif">
   	<div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
    		<tr>
				    <td colspan="4" >
		   			 <div >
					<img width="100%"  src="<?=base_url();?>/images/bbk1.png">
		    			</div>
				    </td>
				</tr>
		<tr>
       			<td width="125"><font size="2"></td>
			<td width="5"><font size="1"></td>
			<td colspan="2" align=right><font size="2">
			Bandung,&nbsp;<?=tgl_indo(date($tgl_invoice));?></td>
		</tr>
		<tr>
       			<td width="125" align=left colspan="4">Kepada Yth.</td>				    
		</tr>
		
		<tr>
       			<td width="125" align=left colspan="4"><?=$nama_customer?></b></td>
		</tr>
		<tr>
       			<td width="125" align=left colspan="4">di</td>				    
		</tr>
		<tr>
       			<td width="125" align=left colspan="4">&nbsp;&nbsp;&nbsp;<?=$alamat?></b></td>
		</tr>
		<tr>
       			<td colspan="4" height="80"><?=$this->judul;?></td>
		</tr>
		
		<tr>
       			<td colspan="4" height="80">Invoice ke : <?=$invoice_ke?></br>No. Order  : <?=$no_order?></td>
		</tr>
		
		
	</table>
	</div>
	<div>
                     <? $buffer='';   
		if($result){ 	
			$buffer =$this->load->view('cetak/print_view_detail_invoice.php','',true);			
			$buffer = str_replace('border="0"','border="0"',$buffer);
			$buffer = str_replace('class="c-table-xa"','style="font-weight:bold; background-color:#aaa;"',$buffer);
			$buffer = strip_tags($buffer,"<table><img><tr><td></tr></td><p><br><h1><h2><h3><b><div><li><center>");
			echo $buffer;
			//echo $this->load->view('cetak/print_view_detail_invoice.php','',true);
		}
		//$buffer=''; 
		?>
        </div>	
	<div>
	<table  width="100%" border="0" > 
	<tr>
		<td align="center" style="padding-top:15px">
		<div>
           	 <? $buffer='';
			if($resultbiaya_lain){ 
				$buffer = $this->load->view('cetak/print_view_biaya_lain.php','',true);
				$buffer = str_replace('border="0"','border="0"',$buffer);
				$buffer = str_replace('class="c-table-xa"','style="font-weight:bold; background-color:#aaa;"',$buffer);
				$buffer = strip_tags($buffer,"<table><img><tr><td></tr></td><p><br><h1><h2><h3><b><div><li><center>");
				echo $buffer;

			}
	   	 ?>
		</div>
         	</td>
  	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
		
  	<tr>
        
          <td>
              <div>
              <table width="100%">
                 <tr>
                     <td align="right">Jumlah Biaya</td>
                     <td width="3">:</td>
                     <td width="3">Rp.</td>
                     <td width="20" align="right"><?=formatUangInd($harga_total-$ppn);?></td> 
                 </tr>
                 <tr>
                     <td align="right">Ppn 10%</td>
                     <td>:</td>
                     <td width="3">Rp.</td>
                     <td align="right"><?=formatUangInd($ppn);?></td> 
                 </tr>
                 <tr>
                     <td align="right">Discount</td>
                     <td>:</td>
                     <td width="3">Rp.</td>
                     <td align="right"><?=formatUangInd($discount);?></td> 
                 </tr>
                  <tr>
                     <td align="right">Total Biaya</td>
                     <td>:</td>
                     <td width="3">Rp.</td>
                     <td align="right"><?=formatUangInd($harga_total);?></td> 
                 </tr> 
                    <tr>  <td> &nbsp;</td>
                    </tr> 
                 <tr>
                     <td align="right">Jumlah Bayar</td>
                     <td>:</td>
                     <td width="3">Rp.</td>
                     <td align="right"><?=formatUangInd($jumlah_bayar);?></td> 
                 </tr>
                 <tr>
                     <td align="right">Jumlah Tagihan</td>
                     <td>:</td>
                     <td width="3">Rp.</td>
                     <td align="right"><?=formatUangInd($sisa_bayar);?></td> 
                 </tr>   
              </table>
              </div>
          </td?>
          

  	</tr>
	
	<tr>
		<td>
		<div><font>Keterangan :
       <ol>
       <li>Pengujian dalam proses pengerjaan.</li> 
       <li>Pembayaran dapat ditransfer ke Bank BNI 46 Cabang A. Yani Bandung dengan No. Rek. 0021753620 a.n BPn 022 Balai Besar Keramik</li>
	     <li>Pembayaran melalui transfer bank, agar mencantumkan Nama Perusahaan dan No.Order, dengan jumlah bersih sesuai tagihan diluar biaya administrasi bank.</li>
	     <li>Bukti Setoran agar difax ke (022) 7205322 atau e-mail: bendahara_pnbp@keramik.go.id / bbkpnbp@gmail.com</li>
		   </ol>
	</div> 
		</td>
	</tr>
	</div>
	<div>
	        <table  width="100%" border="0" style=" border:none;">
		</br></br>
		<tr>
		</tr>	
		<tr>
			<td align="center"  width="33"></td>
			<td width="33"></td>
			<td align="center"  width="33">Ka. Subag Keuangan</td>
			<!--<td align="center"  width="33">Bendahara Penerimaan PNBP</td>-->
		</tr>
		<tr>
			<td align="center"  width="33"></td>
			<td width="33"></td>
			<td align="center"  width="33"><?=$nama_satker;?></td>
		</tr>
		<tr height="45">
			<td width="33"></td>
			<td width="33"></td>
			<td width="33"></td>
		</tr>
		<tr>
			<td align="center" width="33"></td>
			<td width="33"></td>
			<td align="center"  width="33">Dwi Ariyani<br>(198308132008032001)</td>
			<!--<td align="center"  width="33">(<?=$nama_pembuat_invoice;?>)</br><?=$nip_pembuat_invoice;?></td>-->
		</tr>
	       </table>
	</div>
</body>
</html>
