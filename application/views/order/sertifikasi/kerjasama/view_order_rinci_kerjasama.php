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
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- &nbsp;Sistem Mutu&nbsp;: &nbsp;".$smm->nama_sertifikasi_smm ."</br>";
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
    
    	
	</table>
    </fieldset>
<?=form_close();?>
<?=$this->load->view('view_footer');?>

