<?$this->load->view('view_header');?> 
<?=form_open(current_url());?>
	<div class="steptitle">Step 2</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">    		
    		<li><a href="<?=base_url();?>index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>">List Dokumen</a></li>
    		<li class="active"><a href="<?=base_url();?>index.php/order/viewOrderDokumen/<?=$kd_order_sertifikasi;?>">Cetak</a></li>
		</ul>
		</ul>
	<div style="clear:both"></div>
     <p>&nbsp;</P>
    <p> <? 
    	$tombol1='<span style="float:left">
    					<img src="images/printer.gif" border="0" height="40"><br />
    			  <span class="textkolom"><b>Cetak</span></b></span>';
    	$tombol2='<span style="float:right">
    					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    					<img src="images/email3.png" border="0" height="40"><br />
    			  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>';

    	echo anchor('order/cetak/'.base64_encode(current_url()),
    			$tombol1,'target="_blank" border="0" height ="40" style="text-decoration:none"');
        $order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);

        if($order_status){
            $no=0;
            foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
            }
        }
        if($step_status=='Dokumen'){
    	echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Penawaran/orderPenawaran/?TB_iframe=true&height=500&width=900',
    			$tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
    	?>

        
    </P>	
    <p>&nbsp;</P>
    <p>&nbsp;</P>
    <p>&nbsp;</P>
    
<table class="table table-condensed table-bordered table-striped">
	<tbody>

		<h2><CENTER>KELENGKAPAN DOKUMEN UNTUK MENDAPATKAN<br><?=$nama_sertifikasi_jenis;?></CENTER></h2>
			<P>&nbsp;</P>
		<tr>
			<td>Nama</td>
			<td><div align="center">:</div></td>
			<td><?=$nama_perusahaan_pemohon;?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><div align="center">:</div></td>
			<td><?=$alamat_perusahaan_pemohon;?></td>
		</tr>
		<tr>
			<td>CP/HP/Email</td>
			<td><div align="center">:</div></td>
			<td><?=$nm_kontak_perusahaan_pemohon;?>&nbsp;/&nbsp;<?=$nohp_kontak_perusahaan_pemohon;?>/</td>
		</tr>
		
		<tr>
			<td>Produsen</td>
			<td><div align="center">:</div></td>
			<td>
                 <?php
                $no=0;
                if($resultpabrik){
                    foreach($resultpabrik as $rowpabrik){
                        $no++;
                        $smm=$this->mSMM->readSMM($rowpabrik->kd_sertifikasi_smm);

                        echo $no.". &nbsp;";
                        echo $rowpabrik->nama_pabrik." </br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Alamat&nbsp;: &nbsp;".$rowpabrik->alamat_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;teleponi&nbsp;: &nbsp;".$rowpabrik->telepon_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Fax&nbsp;: &nbsp;".$rowpabrik->fax_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Negara&nbsp;: &nbsp;".$rowpabrik->negara_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Jumlah Karyawan&nbsp;: &nbsp;".$rowpabrik->jumlah_karyawan_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Sistem Mutu&nbsp;: &nbsp;".$smm->nama_sertifikasi_smm ."</br>";
                    }
                }
            ?>

            </td>
		</tr>

		<tr>
			<td>Komoditi/Produk</td>
			<td><div align="center">:</div></td>
			<td>

			<?php
				$no=0;
				if($resultOrderKomoditi){
					foreach($resultOrderKomoditi as $row){
						$no++;
						echo $no.". &nbsp;";
						echo $row->no_sertifikasi_komoditi." (".$row->nama_sertifikasi_komoditi.")</br>";
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Tipe&nbsp;: &nbsp;".$row->tipe_sertifikasi_komoditi."</br>";
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Jenis Produk/komoditi&nbsp;: &nbsp;".$row->jenis_produk_komoditi."</br>";
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Merek Dagang&nbsp;: &nbsp;".$row->merk_dagang_komoditi."</br>";
						
					}
				}
			?>
			</td>
		</tr>
		           		
		    
    	
	</table>

	<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
        	<th>No</th>
			<th>Jenis Dokumen</th>
			<th>Keterangan</th>
        </tr>
    </thead>

 	<tbody>	
 			<?$resultdok= $this->mDokumen->getDokumen('',$kd_sertifikasi_jenistarif ,true);
			if($resultdok){
                if ($kd_sertifikasi_jenis=='bpkimi14-jns-2' && $kd_sertifikasi_jenistarif=='bpkimi14-jnt-4'){ 

			  		$no=0;
                    echo '<tr><td align="center" Colspan="3"><b>Importir</b></td></tr>';
			      	foreach($resultdok as $row){
                        if($row->jenis_dokumen=='Importir'){
			      			$ceklist="";$cek="";$list;
			      			$no++;?>
			      			<tr class="row0">
								<td align="center"><?=$no;?></td>
								<td><?=$row->nama_sertifikasi_dokumen;?></td>
								<?php
			      			    if($resultOrderDokumenList){
									foreach($resultOrderDokumenList as $orderdoklist){
										if($row->kd_sertifikasi_dokumen ==$orderdoklist->kd_sertifikasi_dokumen) {
											$ceklist="checked";				
										}
									}
			      				}

			      				echo '
								<td align="center">
									<input type="checkbox" name="resultOrderDokumenList['.$no.']" '.$ceklist.' id="resultOrderDokumenList-'.$no.'" 
											value="'.$row->kd_sertifikasi_dokumen.'" disabled>
								</td></tr>';
                        }
					}
                    $no=0;
                    echo '<tr><td align="center" Colspan="3"><b>Manufaktur</b></td></tr>';
                    foreach($resultdok as $row){
                        if($row->jenis_dokumen=='Importir'){
                            $ceklist="";$cek="";$list;
                            $no++;?>
                            <tr class="row0">
                                <td align="center"><?=$no;?></td>
                                <td><?=$row->nama_sertifikasi_dokumen;?></td>
                                <?php
                                if($resultOrderDokumenList){
                                    foreach($resultOrderDokumenList as $orderdoklist){
                                        if($row->kd_sertifikasi_dokumen ==$orderdoklist->kd_sertifikasi_dokumen) {
                                            $ceklist="checked";             
                                        }
                                    }
                                }

                                echo '
                                <td align="center">
                                    <input type="checkbox" name="resultOrderDokumenList['.$no.']" '.$ceklist.' id="resultOrderDokumenList-'.$no.'" 
                                            value="'.$row->kd_sertifikasi_dokumen.'" disabled>
                                </td></tr>';
                        }
                    }   	


                }else{

                    $no=0;
                    foreach($resultdok as $row){
                            $ceklist="";$cek="";$list;
                            $no++;?>
                            <tr class="row0">
                                <td align="center"><?=$no;?></td>
                                <td><?=$row->nama_sertifikasi_dokumen;?></td>
                                <?php
                                if($resultOrderDokumenList){
                                    foreach($resultOrderDokumenList as $orderdoklist){
                                        if($row->kd_sertifikasi_dokumen ==$orderdoklist->kd_sertifikasi_dokumen) {
                                            $ceklist="checked";             
                                        }
                                    }
                                }

                                echo '
                                <td align="center">
                                    <input type="checkbox" name="resultOrderDokumenList['.$no.']" '.$ceklist.' id="resultOrderDokumenList-'.$no.'" 
                                            value="'.$row->kd_sertifikasi_dokumen.'" disabled>
                                </td></tr>';                                
                    }   

                }				
			}?>
 			
			
			
     </tbody>
	</table>
	<table  width="100%" >
	<tbody>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td align="center">Bandung,&nbsp;&nbsp;<?=tgl_indo(date($tgl_dokumen_diterima));?></td>
		</tr>
		<tr>
			<td align="center">Yang Menyerahkan</td>
			<td><div align="center">&nbsp;</div></td>
			<td align="center">Yang menerima</td>
			<td>&nbsp;</td>
			<td align="center"><div align="center">Kepala Seksi Pemasaran</div></td>

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
			<td align="center">(<?=$nama_penyerah_dokumen?>)</td>
			<td></td>
			<td align="center">(<?=$nama_penerima_dokumen?>)</td>
			<td>&nbsp;</td>
			<td align="center">(Eva Novrentiani, ST)</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		
</table>
<!--
<table class="table table-condensed table-bordered table-striped">
 	<tbody>	
    	<tr>
			<td colspan="3" align="center" style="padding-top:15px">
        	<div style="text-align:center">
	     	
	         <a href="index.php/order/cetak/<?=base64_encode(current_url());?>"
                 id="cetak" target="_blank" class="btn btn-primary">
                 &nbsp;Cetak&nbsp; </a>&nbsp;&nbsp;

            <button type="button" onclick="javascript:window.location.href='index.php/order/cetak/<?=base64_encode(current_url());?>'"
                id="cetak" target="_blank" class="btn btn-primary">Cetak</button>&nbsp;&nbsp;   
	     	<button type="button" onclick="javascript:window.location.href='<?=site_url()."/".$this->uri->segment(1);?>'"
                class="btn btn-primary">Kembali</button>&nbsp;&nbsp;
            <button type="button" onclick="javascript:window.location.href='<?=site_url()."/order/orderDokumen/".$kd_order_sertifikasi;?>'"
                class="btn btn-primary">Next</button>
			</td>
	
     	</tr>
     </tbody>
</table>-->
</fieldset>
<?=form_close();?>
<?=$this->load->view('view_footer');?>

