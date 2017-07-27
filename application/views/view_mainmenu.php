<?php
//--------------------------------------------------------------------------/
//-----------------------------Untuk user super---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'super'){
   $this->load->view('mainmenu/super/view_mainmenu_super.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user administrator---------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'admin'){
   $this->load->view('mainmenu/administrator/view_mainmenu_administrator.php');
}

//--------------------------------------------------------------------------/
//-----------------------------Untuk user pemasaran--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'pemasaran'){
   $this->load->view('mainmenu/pemasaran/view_mainmenu_pemasaran.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user penerima--------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'kerjasama'){
   $this->load->view('mainmenu/kerjasama/view_mainmenu_kerjasama.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user mp--------------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'keuangan'){
   $this->load->view('mainmenu/keuangan/view_mainmenu_keuangan.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user mp--------------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'sertifikasi'){
   $this->load->view('mainmenu/sertifikasi/view_mainmenu_sertifikasi.php');
}
//--------------------------------------------------------------------------/
//-----------------------------Untuk user customer--------------------------------/
//--------------------------------------------------------------------------/
if($this->session->userdata('profil')->groupname == 'customer'){
   $this->load->view('mainmenu/customer/view_mainmenu_customer.php');
}
?>