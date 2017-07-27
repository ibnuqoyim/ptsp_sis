<html>
<head>
	<base href="<?=base_url();?>" />
    <link rel="stylesheet" type="text/css" href="css/print2.css" media="screen, projection" />
</head>
<body onLoad="window.print()" style="background-color:#FFF" style="font-family:Verdana, Geneva, sans-serif">

   
<table class="table table-condensed table-bordered table-striped" width="100%">
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
<table class="table table-condensed"  width="100%" >
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
			<td align="center"><div align="center">Manager Pemasaran</div></td>

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
			<td align="center">(Rahayu Dwi Lestari, S.Sn)</td>
		</tr>

		
</table>

</body>
</html>