<?php $this->load->view('view_header');?>
<!--<h1>Selamat Datang di <i>Sistem Informasi Sertifikasi (SIS)</i></h1>
<p>Selamat! Anda telah sukses masuk ke aplikasi Sistem Informasi Sertifikasi (SIS).</p> -->

<div class="container">
	<div class="row">
 		<div class="col-md-12 col-sm-12">  
  			<h1>Sistem Informasi Sertifikasi 2016</h1>
 		</div>
	</div>
	<div class="row">
 		<div class="col-md-8 col-sm-8"> <!-- 8 kolom pada resolusi medium dan small -->
  			<ul type="square">
				<!--<img src="images/SOP_lspro.jpg" class="img-responsive" alt="Cinque Terre" width="100%" height="100%">-->
				<img src="images/logoOKES.png" class="img-responsive" alt="Cinque Terre" width="100%" height="100%">
			</ul>
 		</div>
 		<!--<div class="col-md-4 col-sm-4"> <!-- 8 kolom pada resolusi medium dan small -->
  			<!--<ul type="square">
				<img src="images/sop_sertifikasi_BBK_QACS.jpg" class="img-responsive" alt="Cinque Terre" width="100%" height="100%">
			</ul>
 		</div>-->
  		<div class="col-md-4 col-sm-4"> <!-- 8 kolom pada resolusi medium dan small -->
  			<ul type="square">
  				<p>Berikut biodata anda di aplikasi ini :</p>
				<!--<li>NIP: <tt><?=$profil->NIP;?></tt></li>
				<li>Nip Baru: <tt><?=$profil->nip_baru;?></tt></li>
				<li>UserID: <tt><?=$this->session->userdata('userid');?></tt></li>
				<li>Nama: <tt><?=$profil->Nama;?></tt></li>
				<li>TTL: <tt><?=$profil->Tempat_Lahir;?>, <?=mdate("%d-%m-%Y", strtotime($profil->Tanggal_Lahir));?></tt></li>
				<li>Email: <tt><?=$profil->email;?></tt></li>
				<li>Pangkat: <tt><?=$profil->Pangkat;?></tt></li>
				<li>Golongan: <tt><?=$profil->Gol_Ruang;?></tt></li>
				<li>Jabatan: <tt><?=$profil->Jabatan;?></tt></li>-->
				<li>Group: <tt><?=$profil->groupdesc;?></tt></li>
				<!--<li>Satker: <tt><?=$profil->satker;?></tt></li>-->
				<li>Keterangan: <tt><?=$profil->keterangan;?></tt></li>
				<p>Untuk mengubah profil anda klik disini <?=anchor('welcome/profil','Edit Profil');?>.</p>
			</ul>
				
 		</div>
	</div><!--
    <div class="row">
 		<div class="col-md-12 col-sm-12">  
    		<p>Untuk informasi lebih lanjut dan perkembangan aplikasi ini, silahkan baca <a href="http://www.bbk.go.id/doc/">dokumentasi</a>.</p>
			<p>Jika ada pertanyaan, silahkan bergabung bersama kami di <a href="http://forum.bbk.go.id/">forum SIS</a>.</p>	
 		</div>
 	</div>-->

<? $this->load->view('view_footer');?>