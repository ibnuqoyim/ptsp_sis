<!--<?//$this->load->view('view_header');?> 
<?=form_open(current_url());?>
	<div class="steptitle">Step 3</div>
	<?php 
        //$this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
    <p> <?/* 
       
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
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Kontrak/orderKontrak/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?></p>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">    		
    		<li><a href="<?=base_url();?>index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>">Data Penawaran</a></li>
            <li class="active"><a href="<?=base_url();?>index.php/order/viewOrderSuratPenawaran/<?=$kd_order_sertifikasi;?>">Cetak Surat Penawaran</a></li>
            <li><a href="<?=base_url();?>index.php/order/viewOrderLampiranPenawaran/<?=$kd_order_sertifikasi;?>">Cetak Lampiran Penawaran</a></li>
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
            <td width="100">Nomor</td>
            <td>:</td>
            <td><?=$no_penawaran;?></td>
            <td align="right">Bandung,&nbsp;&nbsp;<?=tgl_indo(date($tgl_penawaran));?></td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td><?=$jumlah_lampiran_penawaran;?></td>
            <td></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><?=$perihal_penawaran;?></td>
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
        <tr><td>&nbsp;&nbsp;</td></tr>
        <tr><td>&nbsp;&nbsp;</td></tr>
    </tbody>
</table>
<table  width="100%" >
    <tbody>

        <? if($no_surat_permohonan!=''){ ?>
        <tr><td><p>Menindaklanjuti Surat Permohonan saudara nomor : <?=$no_surat_permohonan;?> tanggal  <?=tgl_indo(date($tgl_surat_permohonan));?> perihal informasi <?=$perihal_penawaran;?> di :<br></p>
        <tr><td><p>&nbsp;</p></td></tr>
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
            <tr><td><p>&nbsp;</p></td></tr>
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
         <tr><td><p>&nbsp;</p></td></tr>
         <tr><td><p>
        <?php
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Biaya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;Rp.".formatUangInd($harga_total_penawaran)."</br>";
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;PPN 10%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;Rp.".formatUangInd($harga_total_penawaran*10/100)."</br>";
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;Rp.".formatUangInd($harga_total_penawaran+$harga_total_penawaran*10/100)."</br>";

        ?>
        </p></td></tr>
        <tr><td><p>&nbsp;</p></td></tr>
        <tr><td><p>Tidak dibenarkan untuk memberikan hadiah ataupun gratifikasi dalam bentuk apapun kepada auditor/PPC terkait kegiatan sertifikasi</p></td></tr>
        <tr><td><p>&nbsp;</p></td></tr>
         <tr><td><p>Apabila ada perubahan tipe kategori produk, merk, legalitas/susunan organisasi produsen, 
            jumlah karyawan produsen mohon diinformasikan kepada Seksi Pemasaran dengan nomor Tlp. 022-7206296 ext. 130.
            Atas perhatian dan kerjasamanya kami sampaikan terima kasih</p></td></tr>   
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
			<td align="center">(<?=$nama_penandatangan_penawaran;?>)</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td align="center">NIP <?=$nip_penandatangan_penawaran;?></td>
		</tr>
		
</table>
</fieldset>
<!--
<?//=form_close();?>
<?//=$this->load->view('view_footer');?>
-->