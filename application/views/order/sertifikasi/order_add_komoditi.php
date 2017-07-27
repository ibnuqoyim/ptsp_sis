<?php 
//--------------------------------------------------------------------------/
//-----------------------------Untuk user super-----------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'super'){
   $this->load->view('order/sertifikasi/super/order_add_komoditi_super.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'admin'){
   $this->load->view('order/sertifikasi/administrator/order_add_komoditi_administrator.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user pemasaran----------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'pemasaran'){
   $this->load->view('order/sertifikasi/pemasaran/order_add_komoditi_pemasaran.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user kerjasama----------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'kerjasama'){
   $this->load->view('order/sertifikasi/kerjasama/order_add_komoditi_kerjasama.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user keuangan--------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'keuangan'){
   $this->load->view('order/sertifikasi/keuangan/order_add_komoditi_keuangan.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user sertifikat--------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'sertifikasi'){
   $this->load->view('order/sertifikasi/sertifikasi/order_add_komoditi_sertifikasi.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user umum------------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'sertifikat'){
   $this->load->view('order/sertifikasi/sertifikat/order_add_komoditi_sertifikat.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user customer------------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'customer'){
   $this->load->view('order/sertifikasi/customer/order_add_komoditi_customer.php');
}
?>