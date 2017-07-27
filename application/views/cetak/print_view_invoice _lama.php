<html>
<head>
     <base href="<?=base_url();?>" />
     <!--<link rel="stylesheet" type="text/css" href="css/print3.css" media="screen, projection" />-->
    
</head>
<body onLoad="window.print()" style="background-color:#FFF" style="font-family:Verdana, Geneva, sans-serif">
   	<div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
       			<td width="125"><font size="2"></td>
			<td width="5"><font size="1"></td>
			<td colspan="2" align=right><font size="2">
			<?//=$usr->kota;?>,&nbsp;<?=tgl_indo(date($tgl_invoice));?></td>
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
       			<td width="125" align=left colspan="4">&nbsp;&nbsp;&nbsp;<?=$nama_customer?></b></td>
		</tr>
		<tr>
       			<td colspan="4" height="80"><?=$this->judul;?></td>
		</tr>
		
	</table>
	</div>
	<div>
            <? $buffer='';
		if($result){			
			$buffer=$this->load->view('cetak/print_view_detail_invoice.php','',true);
			
			$buffer = str_replace('border="0"','border="1"',$buffer);
			$buffer = str_replace('class="c-table-xa"','style="font-weight:bold; background-color:#aaa;"',$buffer);
			$buffer = strip_tags($buffer,"<table><tr><td><p><h1><h2><h3><b><div><li>");
			echo $buffer;
		}
		?>
         </div>
	<div>
	<div>
	<table  width="100%" border="0" >
		
	<tr>
		<td width="100" valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top;">
    		<h3>Biaya Lain-lain</h3>
    		<?=@$biaya_biaya;?>
    		</td>
 	 </tr>
    
  	<tr>
        <td width="100" valign="top" class="input-text-1" style="padding-left:10px; text-align:right; vertical-align:text-top">
        <div>Subtotal : <b><?=formatRupiah($subtotal);?></b></div>
        <div>Discount : <b><?=formatRupiah($discount);?></b></div>
        <div>&nbsp;</div>
        <div style=" font-size:25px;">Harga Total : <b><?=formatRupiah($harga_total);?></b> </div><br>
        </td>
  	</tr>
   
    		<?=@$rincian_biaya;?>
	</div>
	 <div>
		<table  width="100%" border="0" style=" border:none;">
		</br></br></br>
		<tr>
		</tr>	
		<tr>
		</tr>
		<?
			
		?>
		<tr>
			<td align="center"  width="33"></td>
			<td width="33"></td>
			<td align="center"  width="33">Bendahara Penerimaan PNBP</td>
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
			<td align="center"  width="33">(<?=$nama_pembuat_invoice;?>)</br><?=$nip_pembuat_invoice;?></td>
		</tr>
	

		</table>
	</div>


</body>
</html>
