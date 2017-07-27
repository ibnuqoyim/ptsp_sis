<?php
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'super'){
   $this->load->view('order/sertifikasi/super/order_add_auditor_super.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'admin'){
   $this->load->view('order/sertifikasi/administrator/order_add_auditor_administrator.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrasi----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'pemasaran'){
   $this->load->view('order/sertifikasi/pemasaran/order_add_auditor_pemasaran.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user kerjasama----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'kerjasama'){
   $this->load->view('order/sertifikasi/kerjasama/order_add_auditor_kerjasama.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user keuangan--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'keuangan'){
   $this->load->view('order/sertifikasi/keuangan/order_add_auditor_keuangan.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user penerima--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'sertifikasi'){
   $this->load->view('order/sertifikasi/sertifikasi/order_add_auditor_sertifikasi.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user penerima--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'sertifikat'){
   $this->load->view('order/sertifikasi/sertifikat/order_add_auditor_sertifikat.php');
}
?>