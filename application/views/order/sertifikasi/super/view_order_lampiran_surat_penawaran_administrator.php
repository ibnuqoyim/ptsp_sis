<!--<?//$this->load->view('view_header');?> 
<?=form_open(current_url());?>
	<div class="steptitle">Step 3</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
    <p> <? /*
       
        $tombol2='<span style="float:right">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/email3.png" border="0" height="40"><br />
                  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>';  
        $order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);

        if($order_status){
            $no=0;
            foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
            }
        }     
        if($step_status=='Penawaran'){
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Penagihan/orderPenagihan/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?></p>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">    		
    		<li><a href="<?=base_url();?>index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>">Data Penawaran</a></li>
            <li><a href="<?=base_url();?>index.php/order/viewOrderSuratPenawaran/<?=$kd_order_sertifikasi;?>">Cetak Surat Penawaran</a></li>
            <li class="active"><a href="<?=base_url();?>index.php/order/viewOrderLampiranPenawaran/<?=$kd_order_sertifikasi;?>">Cetak Lampiran Penawaran</a></li>
		</ul>
		</ul>
	<div style="clear:both"></div>
     <p>&nbsp;</P>
    <p> <? 
    	$tombol1='<span style="float:left">
    					<img src="images/printer.gif" border="0" height="40"><br />
    			  <span class="textkolom"><b>Cetak</span></b></span>';
    	  	echo anchor('order/cetak/'.base64_encode(current_url()),
    			$tombol1,'target="_blank" border="0" height ="40" style="text-decoration:none"');
    	
    	*/?>
        
    </P>	
    <p>&nbsp;</P>
    <p>&nbsp;</P>
    <p>&nbsp;</P>
-->
<table  width="100%" >
    <tbody>
        <tr>
            <td width="150" align="left">Lampiran Surat Nomor</td>
            <td align="left">:</td>
            <td align="left"><?=$no_penawaran;?></td>
            <td>></td>
        </tr>
        <tr>
            <td align="left">Tanggal</td>
            <td align="left">:</td>
            <td align="left"><?=tgl_indo(date($tgl_penawaran));?></td>
            <td></td>
        </tr>
        
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
        </tr>
         <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
        </tr>
</table>

<?
if(!empty($resultOrderPenawaraList)){?>

    <table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No</th>
            <th>nama Biaya</th>
            <th>Biaya</th>
            <th>Jumlah/Satuan Biaya</th>
            <th>Jumlah</th>
        </tr>
    </thead>

 <tbody>
    
<?
    //-----------------------------------------------------------//
    //-------------------isi row table order---------------------//
    //-----------------------------------------------------------//
    $no=0;$x=0;$y=0;    

    foreach($resultOrderPenawaraList as $row){  
        $judulitemall[$no]=$row->keterangan1_jenistarifitem;
        $no++; 
    }
    
    $judulitem = array_unique($judulitemall);
    
    foreach ($judulitem as $key => $val) {           
            $item_judul[]=$val;
    }
    
    /*for($x=0;$x<count($item_judul); $x++){ ?>

        <tr> 
    
            <td align="center"><?=$x+1;?></td>
            <td><div><?=$item_judul[$x];?></div></td  
        </tr>


    <?}*/
                              
    $nno=0;
    foreach($resultOrderPenawaraList as $row2){  
         $nno++; 
    ?> 
        <tr> 
    
            <td align="center"><?=(($page-1)*$limit)+$nno;?></td>
            <td><div><?=$row2->nama_sertifikasi_jenistarifitem;?></div></td>                
            <td align="right"><div>Rp. <?=formatUangInd($row2->harga_sertifikasi_jenistarifitem);?></div></td>
            <?php
            if($row2->jumlahhari_sertifikasi_jenistarifitem==1){?>
                <td><div><?=$row2->jumlah_sertifikasi_jenistarifitem;?> &nbsp;(<?=$row2->satuan_sertifikasi_jenistarifitem;?>)</div></td> 
            <?php }else {?>            
             <td><div><?=$row2->jumlah_sertifikasi_jenistarifitem;?> / <?=$row2->jumlahhari_sertifikasi_jenistarifitem;?>
             &nbsp;(<?=$row2->satuan_sertifikasi_jenistarifitem;?>)</div></td>
            <?php } ?>
            <td align="right"><div>Rp. <?=formatUangInd($row2->jumlahharga_sertifikasi_jenistarifitem);?></div></td> 
        </tr>
         


<?php

    }?>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>Jumlah</td>
            <td align="right">Rp. <?=formatUangInd($harga_total_penawaran);?></td>
        </tr>
         <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>PPN 10 %</td>
            <td align="right">Rp. <?=formatUangInd($harga_total_penawaran*10/100);?></td>
        </tr>
         <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>Total Biaya</td>
            <td align="right">Rp. <?=formatUangInd($harga_total_penawaran+$harga_total_penawaran*10/100);?></td>
        </tr>
<?php
}    
?>
    </tbody>
</table>

<table  width="100%" >
	<tbody>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
            <td align="center"></td>
        </tr
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td align="center">Bandung,&nbsp;&nbsp;<?=tgl_indo(date($tgl_penawaran));?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td align="center">A.n Kepala Balai Besar Keramik,</td>
		</tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
            <td align="center">Kepala Bidang Pengembangan Jasa Teknis</td>
        </tr>
		<tr>
			<td></td>
			<td>&nbsp;</td>
			<td></td>
			<td>&nbsp;</td>
			<td></div></td>

		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="center"></td>
			<td></td>
			<td align="center"></td>
			<td>&nbsp;</td>
			<td align="center">(Sinta Rismayani)</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		
</table>
<table  width="100%">
    <tbody>
        
        <tr>
            <td>&nbsp;</td>
            
        </tr>
        
         <tr>
            <td>Catatan: </td>
            <td></td>
            
        </tr>
        <tr>
            <td></td>
            <td>
                <ul>
                    <ol>
                        <li> Biaya di atas tidak termasuk biaya pengujian contoh uji dan berlaku untuk 1 lokasi pabrik</li>
                        <li>Biaya pengujian contoh uji berdasarkan ketentuan laboratorium BBK yang ditunjuk oleh LSPro-CENCERA</li>
                        <li>Transportasi, akomodasi tim audit serta biaya pengiriman contoh uji uji disediakan langsung oleh pihak 
                            perusahaan (Hotel untuk auditor minimal bintang tiga atau yang terbaik di wilayahnya</li>
                        <li>Surat tagihan biaya akan dilangkan sebelum pelaksanaan surveilen</li>
                    <ol>

                </ul>

            </td>
            
        </tr>
        <tr>
            <td>&nbsp;</td>
            
        </tr>
</table>
</fieldset>
<!--
<?//=form_close();?>
<?//=$this->load->view('view_footer');?>
-->