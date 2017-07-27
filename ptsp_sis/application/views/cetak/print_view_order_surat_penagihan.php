<html>
<head>
	<base href="<?=base_url();?>" />
    <link rel="stylesheet" type="text/css" href="css/print2.css" media="screen, projection" />
</head>
<body onLoad="window.print()" style="background-color:#FFF" style="font-family:Verdana, Geneva, sans-serif">

<table  width="100%" >
    <tbody>
        <tr>
            <td width="100">Nomor</td>
            <td>:</td>
            <td><?=$no_invoice;?></td>
            <td align="right">Bandung,&nbsp;&nbsp;<?=tgl_indo(date($tgl_invoice));?></td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td><?=$jumlah_lampiran_invoice;?></td>
            <td></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><?=$perihal_invoice;?></td>
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
         
       
</table>
<table  width="100%" >
    <tbody>
        <tr><td>Kepada</td></tr>
        <tr><td>Pimpinan</td></tr>
        <tr><td><?=$nama_perusahaan_pemohon;?></td></tr>
        <tr><td><?=$alamat_perusahaan_pemohon;?></td></tr>
        <tr><td><?=$telpon_perusahaan_pemohon;?></td></tr>
        <tr><td><?=$fax_perusahaan_pemohon;?></td></tr>
        <tr><td>CP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?=$nm_kontak_perusahaan_pemohon;?></td></tr>
        <tr><td>HP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?=$nohp_kontak_perusahaan_pemohon;?></td></tr>
        <tr><td>E-mail&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?=$email_kontak_perusahaan_pemohon;?></td></tr>
       
    </tbody>
</table>
<table  width="100%" >
    <tbody>
        
        <!--<tr><td><p><?=$isi_surat_invoice?></p></td></tr>  -->   
        <tr><td>

         <? if($no_surat_permohonan!=''){ ?>
        <tr><td><p>Menindaklanjuti Surat Penawaran kami nomor : <?=$no_penawaran;?> tanggal  <?=tgl_indo(date($tgl_penawaran));?> perihal informasi <?=$perihal_penawaran;?> di :<br></p>
        
        <tr><td><p>
            <?php                
                $no=0;
                if($resultpabrik){
                    foreach($resultpabrik as $rowpabrik){
                        $no++;
                        echo $no.". &nbsp;";
                        echo $rowpabrik->nama_pabrik." </br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;".$rowpabrik->alamat_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;teleponi&nbsp;: &nbsp;".$rowpabrik->telepon_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Fax&nbsp;: &nbsp;".$rowpabrik->fax_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Negara&nbsp;: &nbsp;".$rowpabrik->negara_pabrik."</br>";
                       
                    }
                }
            ?> 
        </p></td></tr> 
            <tr><td><p><br>dengan ini kami sampaiakan tagihan biaya untuk kegiatan tersebut adalah sebagai berikut:</p></td></tr> 
            <p>&nbsp;</p>  
        <?php }else { ?>
                    <tr><td><p>Berkenaan dengan akan dilaksanakannya <?=$nama_sertifikasi_tahapan?> perihal informasi <?=$perihal_penawaran;?> di </p></td></tr>
            
            <tr><td><p>
            <?php
                
                $no=0;
                if($resultpabrik){
                    foreach($resultpabrik as $rowpabrik){
                        $no++;
                       $no++;
                        echo $no.". &nbsp;";
                        echo $rowpabrik->nama_pabrik." </br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;".$rowpabrik->alamat_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;teleponi&nbsp;: &nbsp;".$rowpabrik->telepon_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Fax&nbsp;: &nbsp;".$rowpabrik->fax_pabrik."</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Negara&nbsp;: &nbsp;".$rowpabrik->negara_pabrik."</br>";
                       
                    }
                }
            ?>
            </p></td></tr>
            <tr><td><p>&nbsp;</p></td></tr>
            <tr><td><p>dengan ini kami sampaiakan tagihan biaya untuk kegiatan tersebut adalah sebagai berikut:</p></td></tr> 
        <?php } ?>
        
        <tr><td><p>
                    <table  width="60%" >
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            <td></td>
                            <td>Biaya Audit 
                            <?php

                                    $nno=0;$PPC='';
                                    foreach($resultOrderPenawaraList as $row2){  
                                         $nno++; 
                                         if($row2->nama_sertifikasi_jenistarifitem=='PPC') { 
                                            $PPC = $row2->nama_sertifikasi_jenistarifitem; 
                                        }
                                    } 
                                    if($PPC!='') echo "dan Pengambilan Contoh"; 
                            ?></td>
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
                    </table>
                </p>
            </td>
        </tr>
               
        <tr><td><p>Biaya sebesar tersebut mohon ditransfer ke rekening Nomor : <b>0021753620</b> Bank BNI Cabang Ahmad Yani Bandung atas nama <b>Bpn 022 Balai Besar Keramik</b>.
            Bukti Transfer mohon di Fax ke nomor : <b>(022) 7205322</b> dengan mencantumkan nomor surat tagihan / nama perusahaan untuk memudahkan identifikasi</p></td></tr>
         <tr><td><p>Atas perhatian dan kerjasamanya kami sampaikan terima kasih</p></td></tr>   
    </tbody>
</table>

<table  width="100%" >
    <tbody>
        <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
            <td align="center">A.n Kepala Balai Besar Keramik,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
            <td align="center">Kepala Sub Bagian Keuangan</td>
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
            <td align="center"><?=$nama_penandatangan_invoice?></td>
        </tr>
        <tr>
            <td align="center"></td>
            <td></td>
            <td align="center"></td>
            <td>&nbsp;</td>
            <td align="center"><?=$nip_penandatangan_invoice?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        
</table>
</body>
</html>
