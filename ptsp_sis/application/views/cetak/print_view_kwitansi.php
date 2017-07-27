<html>
<head>
     <base href="<?=base_url();?>" />
     <!--<link rel="stylesheet" type="text/css" href="css/print3.css" media="screen, projection" />-->
    
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="700"height="425" id="table"> 
   <tr>
       <td>
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="425" >
	    <tr>
		
		<td  width="600" height="400">
		   
		     <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr>
				    <td colspan="4" >
		   			 <div >
					<img width="100%"  src="<?=base_url();?>/images/bbk1.png">
		    			</div>
				    </td>
				</tr>
				<tr>
       			   	    <td colspan="4" height="80"><?=$this->judul;?></td>
				    
				</tr>
				<tr>
       			<td width="170" height="40" valign="top"></td>
				    <td width="5" height="40" valign="top"></td>
				    <td colspan="2" height="40" valign="top"></td>
				    
				</tr>
        <tr>
       			<td width="170" height="25" valign="top"><font size="2">&nbsp;&nbsp;<b>No. </b></td>
				    <td width="5" height="25" valign="top"><font size="2"><div >:</div></td>
				    <td colspan="2" height="25" valign="top"><font size="2">&nbsp;<?=$no_pembayaran;?></td>
				    
				</tr>
				<tr>
       			<td width="170" height="25" valign="top"><font size="2">&nbsp;&nbsp;<b>No. Registrasi</b></td>
				    <td width="5" height="25" valign="top"><font size="2"><div >:</div></td>
				    <td colspan="2" height="25" valign="top"><font size="2">&nbsp;<?=$noreg_order_sertifikasi;?></td>
				    
				</tr>
        
				<tr>
       			<td width="170" height="25" valign="top"><font size="2">&nbsp;&nbsp;<b>Sudah Terima dari</b></td>
				    <td width="5" height="25" valign="top"><font size="2"><div >:</div></td>
				    <td colspan="2" height="25" valign="top"><font size="2">&nbsp;<?=$nama_pembayar;?></td>
				    
				</tr>
				<tr>
       			<td width="170" height="25" valign="top"><font size="2">&nbsp;&nbsp;<b>Banyaknya Uang</b></td>
				    <td width="5" height="25" valign="top"><font size="2"><div >:</div></td>
				    <td colspan="2" height="25" valign="top"><font size="2">&nbsp;<?=convertNilaiToKalimat($nilai_bayar);?></td>
				    
				</tr>
			        <!--<tr>
       			   	    <td width="170" height="40"><font size="2"">&nbsp;&nbsp;<b>Untuk Pembayaran</b></td>
				    <td width="5" height="40"><font size="2"><div >:</div></td>
				    <td colspan="2" height="40"><font size="2"><ul><li>&nbsp;<?=$tujuan_pembayaran;?>&nbsp sebesar &nbsp;
				    <?=formatRupiah($biaya_uji);?>&nbsp; </li><li>dan &nbsp; 
				    PPN 10% x <?=formatRupiah($biaya_uji);?> &nbsp;sebesar <?=formatRupiah($jml_ppn);?></li></td>
				    
				</tr>
				 <tr>
       			   	    <td width="170" height="40"><font size="2"">&nbsp;&nbsp;<b>Untuk Pembayaran</b></td>
				    <td width="5" height="40"><font size="2"><div >:</div></td>
				    <td colspan="2" height="40"><font size="2">
					<ul>
					<li><?=$tujuan_pembayaran;?>&nbsp;&nbsp;&nbsp;= &nbsp;<?=formatRupiah($biaya_uji);?>&nbsp; </li>
					<li>PPN 10% x <?=formatRupiah($biaya_uji);?> &nbsp;&nbsp;&nbsp;&nbsp;= &nbsp;
						<?=formatRupiah($jml_ppn);?></li>
					<li>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= &nbsp;
					 <?=formatRupiah($nilai_bayar);?></li></td>
				    
				</tr>-->
				<tr>
       			<td width="170" height="40" valign="top"><font size="2">&nbsp;&nbsp;<b></b></font></td>
				    <td width="5" height="40" valign="top"><font size="2"><div >:</div></td>
				    <td colspan="2" height="40" valign="top"><font size="2"><?=$tujuan_pembayaran;?></td>
				</tr>
				<tr>
       			<td colspan="3"></td>
				    <td align="center" width="200" valign="bottom"><font size="2">Bandung,
					<?=tgl_indo(date($tgl_bayar));?> <br>Kepala Balai Besar Keramik<br>u.b. Bendahara Penerima
				    </td>
				</tr>
				<tr>
       			   	    <td width="600" colspan="3"><font size="2"><b>&nbsp;&nbsp;
					Jumlah  &nbsp;&nbsp;&nbsp;<input type="text" 
					 value="<? echo formatRupiah($nilai_bayar);?>"> 
					
				    </td> 				      							   
				    <td align="center" width="200" valign="bottom" height="90"><b><u><font size="1"><?=$nama_penerima;?></u>
					<br><font size="1">NIP. &nbsp;<?=$nip_penerima;?></td>   
				</tr>
		     </table>
		</td>		
	    </tr>
	</table>
</td></tr>
</table>
<br>
<img width="100%"  src="<?=base_url();?>/images/bbk4.png">
<br>
<table border="0" cellpadding="0" cellspacing="0" width="700"height="425" id="table"> 
   <tr>
       <td>
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="425" >
	    <tr>
		
		<td  width="600" height="400">
		   
		     <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr>
				    <td colspan="4" >
		   			 <div >
					<img width="100%"  src="<?=base_url();?>/images/bbk3.png">
		    			</div>
				    </td>
				</tr>
				<tr>
       			<td colspan="4" height="80"><?=$this->judul;?></td>
				    
				</tr>
				<tr>
       			<td width="170" height="40" valign="top"></td>
				    <td width="5" height="40" valign="top"></td>
				    <td colspan="2" height="40" valign="top"></td>
				    
				</tr>
        <tr>
       			<td width="170" height="25" valign="top"><font size="2">&nbsp;&nbsp;<b>No. </b></td>
				    <td width="5" height="25" valign="top"><font size="2"><div >:</div></td>
				    <td colspan="2" height="25" valign="top"><font size="2">&nbsp;<?=$no_pembayaran;?></td>
				    
				</tr>
				<tr>
       			<td width="170" height="20" valign="top"><font size="2">&nbsp;&nbsp;<b>No Registrasi</b></td>
				    <td width="5" height="25" valign="top"><font size="2"><div >:</div></td>
				    <td colspan="2" height="25" valign="top"><font size="2">&nbsp;<?=$noreg_order_sertifikasi;?></td>
				    
				</tr>
        
				<tr>
       			<td width="170" height="25" valign="top"><font size="2">&nbsp;&nbsp;<b>Sudah Terima dari</b></td>
				    <td width="5" height="25" valign="top"><font size="2"><div >:</div></td>
				    <td colspan="2" height="25" valign="top"><font size="2">&nbsp;<?=$nama_pembayar;?></td>
				    
				</tr>
				<tr>
       			<td width="170" height="25" valign="top"><font size="2">&nbsp;&nbsp;<b>Banyaknya Uang</b></td>
				    <td width="5" height="25" valign="top"><font size="2"><div >:</div></td>
				    <td colspan="2" height="25" valign="top"><font size="2">&nbsp;<?=convertNilaiToKalimat($nilai_bayar);?></td>
				    
				</tr>
			        <!--<tr>

       			   	    <td width="170" height="40"><font size="2"">&nbsp;&nbsp;<b>Untuk Pembayaran</b></td>
				    <td width="5" height="40"><font size="2"><div >:</div></td>
				    <td colspan="2" height="40"><font size="2"><ul><li>&nbsp;<?=$tujuan_pembayaran;?>&nbsp sebesar &nbsp;
				    <?=formatRupiah($biaya_uji);?>&nbsp; </li><li>dan &nbsp; 

				    PPN 10% x <?=formatRupiah($biaya_uji);?> &nbsp;sebesar <?=formatRupiah($jml_ppn);?></li></td>
				    
				</tr>
				 <tr>

       			   	    <td width="170" height="40"><font size="2"">&nbsp;&nbsp;<b>Untuk Pembayaran</b></td>
				    <td width="5" height="40"><font size="2"><div >:</div></td>
				    <td colspan="2" height="40"><font size="2">
					<ul>
					<li><?=$tujuan_pembayaran;?>&nbsp;&nbsp;&nbsp;= &nbsp;<?=formatRupiah($biaya_uji);?>&nbsp; </li>
					<li>PPN 10% x <?=formatRupiah($biaya_uji);?> &nbsp;&nbsp;&nbsp;&nbsp;= &nbsp;
						<?=formatRupiah($jml_ppn);?></li>
					<li>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= &nbsp;
					 <?=formatRupiah($nilai_bayar);?></li></td>
				    
				</tr>-->

				<tr>
       			<td width="170" height="25" valign="top"><font size="2"">&nbsp;&nbsp;<b>Untuk Pembayaran</b></td>
				    <td width="5" height="25" valign="top"><font size="2"><div >:</div></td>
				    <td colspan="2" height="25" valign="top"><font size="2"><?=$tujuan_pembayaran;?></td>
				</tr>
				<tr>
       			<td colspan="3"></td>
				    <td align="center" width="200" valign="bottom"><font size="2">Bandung,
					<?=tgl_indo(date($tgl_bayar));?> <br>Kepala Balai Besar Keramik<br>u.b. Bendahara Penerima
				    </td>
				</tr>
				<tr>
       			   	    <td width="600" colspan="3"><font size="2"><b>&nbsp;&nbsp;
					Jumlah  &nbsp;&nbsp;&nbsp;<input type="text" 
					 value="<? echo formatRupiah($nilai_bayar);?>"> 
					
				    </td> 				      							   
				    <td align="center" width="200" valign="bottom" height="90"><b><u><font size="1"><?=$nama_penerima;?></u>
					<br><font size="1">NIP. &nbsp;<?=$nip_penerima;?></td>   
				</tr>
		     </table>
		</td>		
	    </tr>
	</table>
</td></tr>
</table>
</body>
</html>
