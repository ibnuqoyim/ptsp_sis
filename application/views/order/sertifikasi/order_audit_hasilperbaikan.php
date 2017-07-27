<?php
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'super'){
   $this->load->view('order/sertifikasi/super/order_audit_hasilperbaikan_super.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'admin'){
   $this->load->view('order/sertifikasi/administrator/order_audit_hasilperbaikan_administrator.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrasi----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'pemasaran'){
   $this->load->view('order/sertifikasi/pemasaran/order_audit_hasilperbaikan_pemasaran.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrasi----------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'kerjasama'){
   $this->load->view('order/sertifikasi/kerjasama/order_audit_hasilperbaikan_kerjasama.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user keuangan--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'keuangan'){
   $this->load->view('order/sertifikasi/keuangan/order_audit_hasilperbaikan_keuangan.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user penerima--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'sertifikasi'){
   $this->load->view('order/sertifikasi/sertifikasi/order_audit_hasilperbaikan_sertifikasi.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user penerima--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'sertifikat'){
   $this->load->view('order/sertifikasi/sertifikat/order_audit_hasilperbaikan_sertifikat.php');
}
?>