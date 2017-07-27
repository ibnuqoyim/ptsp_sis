<html>
<head>
	<base href="<?=base_url();?>" />
    <link rel="stylesheet" type="text/css" href="css/print2.css" media="screen, projection" />
</head>
<body onLoad="window.print()" style="background-color:#FFF" style="font-family:Verdana, Geneva, sans-serif">
<h3 style="font-weight:bold"><?=$this->judul;?></h3>
		<table width="600" border="0" style=" border:none;">
			<tr>
				<td width="30%" valign="top" style="padding-left:10px; border:none; vertical-align:top;">Jenis Layanan</td>
				<td valign="top" style="border:none;"><?=$layanan->nama_layanan;?></td>
			</tr>
	
			<tr>
				<td valign="top" style="padding-left:10px; border:none;">Nama Perusahaan&nbsp;</td>
				<td valign="top" style="border:none;"><?=$nama_customer_asal;?></td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none;">Alamat Perusahaan</td>
				<td valign="top" style="border:none;"><?=$alamat_customer_asal;?></td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none;">Telpon Perusahaan</td>
				<td valign="top" style="border:none;"><?=$telp_customer_asal;?></td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">Nama Perusahaan Tujuan </td>
				<td valign="top" style="border:none;"><?=$nama_customer_tujuan;?> </td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">Alamat Perusahaan Tujuan </td>
				<td valign="top" style="border:none;"><?=$alamat_customer_tujuan;?></td>
			</tr>
						<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">Telpon Perusahaan Tujuan </td>
				<td valign="top" style="border:none;"><?=$telp_customer_tujuan;?></td>
			</tr>
             
			<tr>
				<td valign="top" style="padding-left:10px; border:none;">Nama Pemohon</td>
				<td valign="top"><?=$nama_pemohon;?></td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none;white-space:nowrap">No Telpon Pemohon </td>
				<td valign="top"><?=$telp_pemohon;?></td>
			</tr> 
            		<tr><td colspan="3" style="border:none;">&nbsp;<br /><br /></td></tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">No Order</td>
				<td valign="top" style="border:none;"><?=$no_order;?></td>
			</tr>
			<tr>
	     			<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Tipe Order</td>
	     			<td width="413" valign="top">
				<?php
			      		if($tipe_order== 'reguler')
						echo "Reguler";
			     		elseif($tipe_order== 'kontrak')
						echo "Kontrak";
					elseif($tipe_order== 'lspro')
						echo "Terkait Dengan LsPro";
				?>
			
	     			</td>
	   		</tr>
	   		<tr>
	     			<td valign="top" class="input-text-1" 
				style="padding-left:10px; vertical-align:text-top">Ada Proses Pengambilan Sampling ?
	        		</td>
	     			<td width="413" valign="top">
		   		<?php 
		   			if($sampling_order== 'tidak')
						echo "Tidak ";
		  			if($sampling_order== 'ya'){
						echo "Ya ";
		   				$order = $this->mOrder->getSamplingReportDetail('',$kd_order);
		   
		     			 	if($order){
						echo anchor('order/viewSamplingReport/'.$kd_order,
						img(array('src'=>'images/preview.gif','border'=>'0','height'=>'20')).
						"View Sampling Report",
						array('title'=>'View Sampling Report','alt'=>'Sampling Report'));
		     
		   
		      				}else{
			   				echo "&nbsp; <font color=red >(Sampling Report belum diinput ...!)</font>";
		      				}
                   			 }
		   		?>
				</td>
	   		</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">No SPK</td>
				<td valign="top" style="border:none;"><?=$no_spk;?></td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">No Surat Pengantar </td>
				<td valign="top" style="border:none;"><?=$no_surat_pengantar;?></td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">Tanggal Order </td>
				<td valign="top" style="border:none;"><?=tgl_indo(date($tgl_order));?></td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">Tanggal Surat Pengantar 
				</td>
				<td valign="top" style="border:none;"><?=tgl_indo(date($tgl_surat_pengantar));?></td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none;">Tanggal Perkiraan Selesai </td>
				<td valign="top" style="border:none;"><?=tgl_indo(date($tgl_perkiraan_selesai));?></td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">Bahasa Sertifikasi </td>
				<td valign="top" style="border:none;"><?php
				$options= array(
                  			'id'  => 'Indonesia',
                 			'en'    => 'English',
					'iden'  => 'Indonesia dan English',
               				 );
                		echo $options[$bahasa_sertifikat];
				?></td>
			</tr>
				<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">Status Bayar </td>
				<td valign="top" style="border:none;"><?php
				$options= array(
                  			'belum'  => 'Belum',
		  			'sebagian' => 'sebagain',
                  			'lunas'    => 'Lunas'
                			);
               			 echo $options[$status_bayar];
				?></td>
			</tr>
			<tr>
				<td valign="top" style="padding-left:10px; border:none; vertical-align:text-top">Keterangan</td>
				<td valign="top" style="border:none;"><?=$keterangan;?></td>
			</tr>
		</table>
        <div>
            <? $buffer='';
		if($result){
			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user super-----------------------------/
			//--------------------------------------------------------------------------/
			if($this->session->userdata('profil')->groupname == 'super'){
   				$buffer=$this->load->view('order/pengujian/super/view_order_detail_super.php','',true);
			}
				
			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user administrator---------------------/
			//--------------------------------------------------------------------------/
			if($this->session->userdata('profil')->groupname == 'admin'){
   				$buffer=$this->load->view('order/pengujian/administrator/view_order_detail_administrator.php','',true);
			}

			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user administrasi----------------------/
			//--------------------------------------------------------------------------/
			if($this->session->userdata('profil')->groupname == 'administrasi'){
   				$buffer=$this->load->view('order/pengujian/administrasi/view_order_detail_administrasi.php','',true);
			}

			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user keuangan--------------------------/
			//--------------------------------------------------------------------------/
			if($this->session->userdata('profil')->groupname == 'keuangan'){
   				$buffer=$this->load->view('order/pengujian/keuangan/view_order_detail_keuangan.php','',true);
			}

			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user penerima--------------------------/
			//--------------------------------------------------------------------------/
			if($this->session->userdata('profil')->groupname == 'penerima'){
   				$buffer=$this->load->view('order/pengujian/penerima/view_order_detail_penerima.php','',true);
			}


			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user mt--------------------------------/
			//--------------------------------------------------------------------------/
			elseif($this->session->userdata('profil')->groupname == 'mt'){
   				$buffer=$this->load->view('order/pengujian/mt/view_order_detail_mt.php','',true);
			}

			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user mt--------------------------------/
			//--------------------------------------------------------------------------/
			elseif($this->session->userdata('profil')->groupname == 'wmt'){
   				$buffer=$this->load->view('order/pengujian/wmt/view_order_detail_wmt.php','',true);
			}

			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user mm--------------------------------/
			//--------------------------------------------------------------------------/
			elseif($this->session->userdata('profil')->groupname == 'mm'){
   				$buffer=$this->load->view('order/pengujian/mm/view_order_detail_mm.php','',true);
			}

			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user mp--------------------------------/
			//--------------------------------------------------------------------------/
			elseif($this->session->userdata('profil')->groupname == 'mp'){
   				$buffer=$this->load->view('order/pengujian/mp/view_order_detail_mp.php','',true);
			}

			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user sertifikat------------------------/
			//--------------------------------------------------------------------------/
			elseif($this->session->userdata('profil')->groupname == 'sertifikat'){
   				$buffer=$this->load->view('order/pengujian/sertifikat/view_order_detail_sertifikat.php','',true);
			}

			
			//--------------------------------------------------------------------------/
			//-----------------------------Untuk userpenyelia---------------------------/
			//--------------------------------------------------------------------------/
			elseif($this->session->userdata('profil')->groupname == 'Ubin' ||
   				$this->session->userdata('profil')->groupname == 'Kaca' ||
   				$this->session->userdata('profil')->groupname == 'Genteng' ||
   				$this->session->userdata('profil')->groupname == 'Refraktori' ||
   				$this->session->userdata('profil')->groupname == 'Saniter' ||
   				$this->session->userdata('profil')->groupname == 'Tableware' ||
   				$this->session->userdata('profil')->groupname == 'Bahan Baku' ||
   				$this->session->userdata('profil')->groupname == 'Kimia' ||
   				$this->session->userdata('profil')->groupname == 'Mineral / Mikrostuktur' ||
   				$this->session->userdata('profil')->groupname == 'Pembakaran' ||
   				$this->session->userdata('profil')->groupname == 'Sanitare,Tableware' ||
   				$this->session->userdata('profil')->groupname == 'Refraktori,Genteng,Bata' || 
   				$this->session->userdata('profil')->groupname == 'Kimia,Mineral / Mikrostuktur' ||
   				$this->session->userdata('profil')->groupname == 'Bahan Baku,Pembakaran'){
   				$buffer=$this->load->view('order/pengujian/penyelia/view_order_detail_penyelia.php','',true);
			}
			
			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user analis----------------------------/
			//--------------------------------------------------------------------------/
			elseif($this->session->userdata('profil')->groupname == 'analis'){
   				$buffer=$this->load->view('order/pengujian/analis/view_order_detail_analis.php','',true);
			}

			//--------------------------------------------------------------------------/
			//-----------------------------Untuk user penyelia--------------------------/
			//--------------------------------------------------------------------------/
			/*
			$i=0;

			for($j=0;$j<$i;$j++){
				if($this->session->userdata('profil')->groupname == $pen[$j]){
   				$buffer=$this->load->view('order/pengujian/penyelia/view_order_detail_penyelia.php','',true);
				}
			}
			*/
			$buffer = str_replace('border="0"','border="1"',$buffer);
			$buffer = str_replace('class="c-table-xa"','style="font-weight:bold; background-color:#aaa;"',$buffer);
			$buffer = strip_tags($buffer,"<table><tr><td><p><h1><h2><h3><b><div><li>");
			echo $buffer;
		}
		?>
         </div>
         <div align="right">
           
	 <? $buffer='';
			if($resultbiaya_lain) 
			$buffer=$this->load->view('order/view_biaya_lain.php','',true);
			$buffer = str_replace('border="0"','border="1"',$buffer);
			$buffer = str_replace('class="c-table-xa"','style="font-weight:bold; background-color:#aaa;"',$buffer);
			$buffer = strip_tags($buffer,"<table><tr><td><p><h1><h2><h3><b><div><li>");
			echo $buffer;
	 ?>

            
                <div valign="top" style="padding-left:10px; padding-top:10px; border:none; text-align:right; vertical-align:text-top; font-size:14px;">
                <div>Subtotal : <b><?=formatRupiah($subtotal);?></b></div>
                <div>Discount : <b><?=formatRupiah($discount);?></b></div>
		<div>Ppn      : <b><?=formatRupiah($ppn);?></b></div>
                <div>&nbsp;</div>
                <div style=" font-size:18px;">Harga Total : <b><?=formatRupiah($harga_total);?></b></div>
		<?=@$rincian_biaya;?>
                </div>
        </div>

	<div>
		<table  width="100%" border="0" style=" border:none;">
		</br></br></br>
		<tr>
		</tr>	
		<tr>
		</tr>
		<?php
			$usr=$this->mUser->readNipLama($nip_penerima);
		?>
		<tr>
			<td align="center"  width="33"></td>
			<td width="33"></td>
			<td align="center"  width="33"><?=$usr->kota;?>,&nbsp;<?=tgl_indo(date($tgl_order));?></td>
		</tr>
		<tr>
			<td align="center"  width="33">Nama Pemohon</td>
			<td width="33"></td>
			<td align="center"  width="33">Nama Penerima</td>
		</tr>
		<tr height="45">
			<td width="33"></td>
			<td width="33"></td>
			<td width="33"></td>
		</tr>
		
		<tr>
			
			<td align="center" width="33">(<?=$nama_pemohon;?>)</td>
			<td width="33"></td>
			<td align="center"  width="33">(<?=$nm_penerima;?>)</br><?=$nip_penerima;?></td>
		</tr>
	

		</table>
	</div>

</body>
</html>
