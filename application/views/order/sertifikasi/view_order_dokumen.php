<?php
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'super'){
   $this->load->view('order/sertifikasi/super/view_order_dokumen_super.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'admin'){
   $this->load->view('order/sertifikasi/administrator/view_order_dokumen_administrator.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrasi----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'pemasaran'){
   $this->load->view('order/sertifikasi/pemasaran/view_order_dokumen_pemasaran.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrasi----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'kerjasama'){
   $this->load->view('order/sertifikasi/kerjasama/view_order_dokumen_kerjasama.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user keuangan--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'keuangan'){
   $this->load->view('order/sertifikasi/keuangan/view_order_dokumen_keuangan.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user penerima--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'sertifikasi'){
   $this->load->view('order/sertifikasi/sertifikasi/view_order_dokumen_sertifikasi.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user penerima--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'sertifikat'){
   $this->load->view('order/sertifikasi/sertifikat/view_order_dokumen_sertifikat.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user penerima--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'customer'){
   $this->load->view('order/sertifikasi/customer/view_order_dokumen_customer.php');
}
?>