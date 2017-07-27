<?php 
//--------------------------------------------------------------------------/
//-----------------------------Untuk user super-----------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'super'){
   $this->load->view('order/sertifikasi/super/order_add_super.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'admin'){
   $this->load->view('order/sertifikasi/administrator/order_add_administrator.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrasi----------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'pemasaran'){
   $this->load->view('order/sertifikasi/pemasaran/order_add_pemasaran.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user kerjasama----------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'kerjasama'){
   $this->load->view('order/sertifikasi/kerjasama/order_add_kerjasama.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user keuangan--------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'keuangan'){
   $this->load->view('order/sertifikasi/keuangan/order_add_keuangan.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user sertifikat--------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'sertifikasi'){
   $this->load->view('order/sertifikasi/sertifikasi/order_add_sertifikasi.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user Customer------------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'customer'){
   $this->load->view('order/sertifikasi/customer/order_add_customer.php');
}



?>