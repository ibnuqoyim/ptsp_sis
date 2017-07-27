<?php
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'super'){
   $this->load->view('order/sertifikasi/super/order_evaluasi_super.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'admin'){
   $this->load->view('order/sertifikasi/administrator/order_evaluasi_administrator.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user pemasaran----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'pemasaran'){
   $this->load->view('order/sertifikasi/pemasaran/order_evaluasi_pemasaran.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user pemasaran----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'kerjasama'){
   $this->load->view('order/sertifikasi/kerjasama/order_evaluasi_kerjasama.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user keuangan--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'keuangan'){
   $this->load->view('order/sertifikasi/keuangan/order_evaluasi_keuangan.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user sertifikasi--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'sertifikasi'){
   $this->load->view('order/sertifikasi/sertifikasi/order_evaluasi_sertifikasi.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user sertifikat------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'sertifikat'){
   $this->load->view('order/sertifikasi/sertifikat/order_evaluasi_sertifikat.php');
}