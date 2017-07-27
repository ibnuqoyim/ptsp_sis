<?php
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'super'){
   $this->load->view('order/sertifikasi/super/view_order_rinci_super.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'admin'){
   $this->load->view('order/sertifikasi/administrator/view_order_rinci_administrator.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user pemasaran----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'pemasaran'){
   $this->load->view('order/sertifikasi/pemasaran/view_order_rinci_pemasaran.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user pemasaran----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'kerjasama'){
   $this->load->view('order/sertifikasi/kerjasama/view_order_rinci_kerjasama.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user keuangan--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'keuangan'){
   $this->load->view('order/sertifikasi/keuangan/view_order_rinci_keuangan.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user sertifikasi--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'sertifikasi'){
   $this->load->view('order/sertifikasi/sertifikasi/view_order_rinci_sertifikasi.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user sertifikasi--------------------------/
//--------------------------------------------------------------------------/

elseif($this->session->userdata('profil')->groupname == 'sertifikat'){
   $this->load->view('order/sertifikasi/sertifikat/view_order_rinci_sertifikat.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user Customer--------------------------/
//--------------------------------------------------------------------------/

elseif($this->session->userdata('profil')->groupname == 'customer'){
   $this->load->view('order/sertifikasi/customer/view_order_rinci_customer.php');
}
?>