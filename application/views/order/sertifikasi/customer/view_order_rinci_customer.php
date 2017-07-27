<?$this->load->view('view_header');?> 
<?=form_open(current_url());?>
	<div class="steptitle">Step 1</div>
    <?php 
        $this->load->view('order/step_order.php');
    ?>
	<div style="clear:both"></div>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li><a href="<?=base_url();?>index.php/order/edit/<?=$kd_order_sertifikasi;?>">Permohonan</a></li>
            <li><a href="<?=base_url();?>index.php/order/orderPabrik/<?=$kd_order_sertifikasi;?>">Pabrik</a></li>
    		<li><a href="<?=base_url();?>index.php/order/orderKomoditi/<?=$kd_order_sertifikasi;?>">Komoditi</a></li>
            <li class="active"><a href="<?=base_url();?>index.php/order/view/<?=$kd_order_sertifikasi;?>">Cetak Permohon</a></li>
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
        if($step_status=='Teregistrasi'){
    	echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Dokumen/orderDokumen/?TB_iframe=true&height=500&width=900',
    			$tombol2,'border="0" height ="40" style="text-decoration:none"');
    	}?>
        
    </P>	
    <p>&nbsp;</P>
    <p>&nbsp;</P>
    <p>&nbsp;</P>
<table class="table table-condensed table-bordered table-striped">
	<tbody>
	<tr>
		<tr>
			<td>No. Register</td>
			<td><div align="center">:</div></td>
			<td><?=$noreg_order_sertifikasi;?></td>
		</tr>
		<tr>
			<td>Tanggal Registrasi</td>
			<td><div align="center">:</div></td>
			<td><?=$tglreg_order_sertifikasi;?></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;<br /></td>
		</tr>
		<tr>
			<td>Jenis Sertifikasi</td>
			<td><div align="center">:</div></td>
			<td><?=$nama_sertifikasi_jenis;?></td>
		</tr>
		<tr>
			<td>Jenis Tarif</td>
			<td><div align="center">:</div></td>
			<td><?=$nama_jenistarif;?> </td>
		</tr>
		<tr>
			<td>Jenis Tahapan</td>
			<td><div align="center">:</div></td>
			<td><?=$nama_sertifikasi_tahapan;?> </td>
		</tr>

		<tr>
			<td>Komoditi/Produk</td>
			<td><div align="center">:</div></td>
			<td>

			<?php
				$no=0;
				if($resultkomoditi){
					foreach($resultkomoditi as $rowkomoditi){
						$no++;
						echo $no.". &nbsp;";
						echo $rowkomoditi->no_sertifikasi_komoditi." (".$rowkomoditi->nama_sertifikasi_komoditi.")</br>";
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Tipe&nbsp;: &nbsp;".$rowkomoditi->tipe_sertifikasi_komoditi."</br>";
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Jenis Produk/komoditi&nbsp;: &nbsp;".$rowkomoditi->jenis_produk_komoditi."</br>";
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Merek Dagang&nbsp;: &nbsp;".$rowkomoditi->merk_dagang_komoditi."</br>";
						
					}
				}
			?>
			</td>
		</tr>
		<tr>
            <td>Pabrik</td>
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
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Sistem Mutu&nbsp;: &nbsp;";
						if ($smm){
							echo $smm->nama_sertifikasi_smm;
						}
						echo "</br>";
                    }
                }
            ?>
            </td>
        </tr>
		<tr>
			<td colspan="3">&nbsp;<br /></td>
		</tr>
		<tr>
			<td>Nama Perusahaan Pemohon</td>
			<td><div align="center">:</div></td>
			<td><?=$nama_perusahaan_pemohon;?></td>
		</tr>
		<tr>
			<td>Alamat Perusahaan Pemohon</td>
			<td><div align="center">:</div></td>
			<td><?=$alamat_perusahaan_pemohon;?></td>
		</tr>
		<tr>
			<td>No. Telpon Perusahaan Pemohon</td>
			<td><div align="center">:</div></td>
			<td ><?=$telpon_perusahaan_pemohon;?></td>
		</tr>
		<tr>
			<td>No. Fax Perusahaan Pemohon </td>
			<td><div align="center">:</div></td>
			<td><?=$fax_perusahaan_pemohon;?> </td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;<br /></td>
		</tr>
		<tr>
			<td>Nama Kontak Perusahaan Pemohon</td>
			<td><div align="center">:</div></td>
			<td ><?=$nm_kontak_perusahaan_pemohon;?></td>
		</tr>
		<tr>
			<td>No. Kontak Perusahaan Pemohon </td>
			<td><div align="center">:</div></td>
			<td><?=$nohp_kontak_perusahaan_pemohon;?> </td>
		</tr>
		<tr>
			<td>Email Kontak Perusahaan Pemohon </td>
			<td><div align="center">:</div></td>
			<td><?=$email_kontak_perusahaan_pemohon;?> </td>
		</tr>
		
		 <tr>	
			<td colspan="3">&nbsp;<br /></td>
		</tr>
		<? if($nama_jenistarif !="Dalam Negeri") { ?> 
		 <tr>	
			<td colspan="3"><h3>Untuk Produk Impor</h3></td>
		</tr>
		<tr>
			<td>Nama Importir</td>
			<td><div align="center">:</div></td>
			<td><?=$nama_perusahaan_importir;?></td>
		</tr>
		<tr>
			<td>Alamat Importir </td>
			<td><div align="center">:</div></td>
			<td><?=$alamat_perusahaan_importir;?></td>
		</tr>
            		
		<tr>
			<td>No. Telpon </td>
			<td><div align="center">:</div></td>
			<td><?=$telpon_perusahaan_importir;?></td>
		</tr>
			<td>No. Fax</td>
			<td><div align="center">:</div></td>
			<td><?=$fax_perusahaan_importir;?></td>
		</tr>
		</tr>
			<td>No. API</td>
			<td><div align="center">:</div></td>
			<td><?=$no_api_perusahaan_importir;?></td>
		</tr>
        <tr>	
			<td colspan="3">&nbsp;<br /></td>
		</tr>
		<?php }?>

		<tr>
			<td>Status  </td>
			<td><div align="center">:</div></td>
			<td><?=$status_order_sertifikasi;?></td>
		</tr>
			<td>Status Bayar</td>
			<td><div align="center">:</div></td>
			<td><?=$statusbayar_order_sertifikasi;?></td>
		</tr>
    
    	<!--<tr>
			<td colspan="3" align="center" style="padding-top:15px">
        	<div style="text-align:center">
	     	
	         <a href="index.php/order/cetak/<?=base64_encode(current_url());?>"
                 id="cetak" target="_blank" class="btn btn-primary">
                 &nbsp;Cetak&nbsp; </a>&nbsp;&nbsp;

            <button type="button" onclick="javascript:window.location.href='index.php/order/cetak/<?=base64_encode(current_url());?>'"
                id="cetak" target="_blank" class="btn btn-primary">Cetak</button>&nbsp;&nbsp; -->  
	     	<!--<button type="button" onclick="javascript:window.location.href='<?=site_url()."/".$this->uri->segment(1);?>'"
                class="btn btn-primary">Kembali</button>&nbsp;&nbsp;
            <button type="button" onclick="javascript:window.location.href='<?=site_url()."/order/orderDokumen/".$kd_order_sertifikasi;?>'"
                class="btn btn-primary">Kirim Ke Step Berikutnya</button>
			</td>
	
     	</tr>
	</table>-->
    </fieldset>
<?=form_close();?>
<?=$this->load->view('view_footer');?>

