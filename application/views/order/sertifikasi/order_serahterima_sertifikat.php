<?php
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'super'){
   $this->load->view('order/sertifikasi/super/order_serahterima_sertifikat_super.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'admin'){
   $this->load->view('order/sertifikasi/administrator/order_serahterima_sertifikat_administrator.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user pemasaran----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'pemasaran'){
   $this->load->view('order/sertifikasi/pemasaran/order_serahterima_sertifikat_pemasaran.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user kerjasama----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'kerjasama'){
   $this->load->view('order/sertifikasi/kerjasama/order_serahterima_sertifikat_kerjasama.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user keuangan--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'keuangan'){
   $this->load->view('order/sertifikasi/keuangan/order_serahterima_sertifikat_keuangan.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user sertifikasi--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'sertifikasi'){
   $this->load->view('order/sertifikasi/sertifikasi/order_serahterima_sertifikat_sertifikasi.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user serahterima_sertifikat------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'sertifikat'){
   $this->load->view('order/sertifikasi/sertifikat/order_serahterima_sertifikat_serahterima_sertifikat.php');
}