<?php 
//--------------------------------------------------------------------------/
//-----------------------------Untuk user super-----------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'super'){
   $this->load->view('order/sertifikasi/super/view_order_super.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'admin'){
   $this->load->view('order/sertifikasi/administrator/view_order_administrator.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrasi----------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'pemasaran'){
   $this->load->view('order/sertifikasi/pemasaran/view_order_pemasaran.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrasi----------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'kerjasama'){
   $this->load->view('order/sertifikasi/kerjasama/view_order_kerjasama.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user keuangan--------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'keuangan'){
   $this->load->view('order/sertifikasi/keuangan/view_order_keuangan.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user penerima--------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'sertifikasi'){
   $this->load->view('order/sertifikasi/sertifikasi/view_order_sertifikasi.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user penerima--------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'sertifikat'){
   $this->load->view('order/sertifikasi/sertifikat/view_order_sertifikat.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user customer--------------------------/
//--------------------------------------------------------------------------/
elseif($this->session->userdata('profil')->groupname == 'customer'){
   $this->load->view('order/sertifikasi/customer/view_order_customer.php');
}
?>


