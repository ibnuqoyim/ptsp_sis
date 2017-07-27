<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	var $usermenu;
	
 function __construct()
    {
        parent::__construct();
		$this->load->model('mUser');
		$this->load->model('mOrder');
		//$this->load->model('mSHU');
		$this->load->helper('email');
		$this->load->helper('inputer');
		$this->load->helper('captcha');
		//$this->load->model('mTarif');
	}

	public function index(){
		if($this->session->userdata('login')) redirect('welcome/home');
		/*
		$mysyx=$this->config->item('syx');
		//$rand_mysyx=rand(0,11);
		for($loop=0;$loop<4;$loop++){
			$rand_letter[$loop]=chr(rand(65,91));
		}
		
		$rand_number=rand(100,999);
		//$rand_word=strtoupper($mysyx[$rand_mysyx].$rand_number);
		$rand_word=strtoupper($rand_letter[0].$rand_letter[1].$rand_letter[2].$rand_letter[3].$rand_number);
		$vals = array(
			'word' => $rand_word,
			'img_path' => './images/captcha/',
			'img_url' => './images/captcha/',
			'font_path' => './path/to/fonts/texb.ttf',
			'img_width' => '150',
			'img_height' => 30,
			'expiration' => 7200
		);
		$this->session->set_flashdata('cap',$rand_word);
		$toview['captcha'] = create_captcha($vals);*/

		$toview['userid'] = GetInput($this->input->post('userid'));
		//$toview['validation_code'] = GetInput($this->input->post('validation_code'));
		$this->form_validation->set_rules('userid', 'Userid', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');	
		$this->form_validation->set_message('required', '%s Wajib diisi!');
		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		if($this->input->post('login'))
		{
			if($this->form_validation->run())
			{
				$userid = $this->input->post('userid');
				$password = $this->input->post('password');
				/*
				if($this->input->post('validation_code') != $this->session->flashdata('cap')){
					$this->session->set_userdata('login',false);
					$this->session->set_flashdata('message', '<em style=\"color:red\">Validation Code Salah!</em>');
					redirect();
				}*/
				// continue processing form (validate password)
				$result=$this->mUser->CekLogin($userid,md5($password));
				if(!empty($result)){
					$this->session->set_userdata('userid',$userid);
					$this->session->set_userdata('password',$password);
					$this->session->set_userdata('nip',$result->nip);
					$this->session->set_userdata('login',true);
					
					if($result->groupid == 13)  {
						$this->session->set_userdata('profil',$this->mUser->readCustomer($result->userid));
					} else {
						$this->session->set_userdata('profil',$this->mUser->readUser($result->nip));
					}
					$this->mUser->WriteLog($userid,$_SERVER['REMOTE_ADDR'],current_url(),"Login");
					redirect('welcome/home/');
				}
				else
				{
					$this->mUser->WriteLog('unknown',$_SERVER['REMOTE_ADDR'],current_url(),"Login Gagal");
					$this->session->set_userdata('login',false);
					$this->session->set_flashdata('message', '<em style="color:red">UserID atau Password Salah! Silahkan coba lagi.</em>');
					redirect();
				}
			}
		}
		$this->load->view('view_index',$toview);
	}
	
	function home(){
		if(!$this->session->userdata('login')) redirect('welcome/');
		
		//$shu=$this->mSHU->getSHU('','','',$row->kd_order);
		//$jum_shu=$this->mOrder->getSHU('',$row->kd_detail_order,true); 
		$jml_terdaftar=0;
		$jml_Diperbaiki=0;
		$jml_tlhDiperbaiki=0;
		$jml_diterima=0;
		$jml_dlmproses=0;
		$jml_dlmantrian=0;
   		$jml_DrSert_selesai=0;
    	$jml_DrSert_perbaiki=0;
    	$jml_DrSert_tlhperbaiki=0;
    	$jml_DrSert_tlhdicek=0;
    	$jml_Sert_selesai=0;
    	$jml_Closed=0;
/*
		$order=$this->mOrder->getOrder('',false,'');
		if($order){
			foreach($order as $roworder){
				if($roworder->status_order == 'Terdaftar') {
					$jml_terdaftar = 1+$jml_terdaftar; 
				
				}
				if($roworder->status_order == 'Diperbaiki') {
					$jml_Diperbaiki = 1+$jml_Diperbaiki;
				
				}
				if($roworder->status_order =='Telah Diperbaiki') {
					$jml_tlhDiperbaiki = 1+$jml_tlhDiperbaiki; 
				
				}
				if($roworder->status_order == 'Diterima') {
					$jml_diterima = 1+$jml_diterima; 
				
				}
				if($roworder->status_order == 'Dalam Proses') {
					$jml_dlmproses = 1+$jml_dlmproses; 
				
				}
				if($roworder->status_order == 'Dalam Antrian') {
					$jml_dlmantrian = 1+$jml_dlmantrian; 
				
				}
      		 	if($roworder->status_order == 'Draft Sertifikat Selesai') {
					$jml_DrSert_selesai = 1+$jml_DrSert_selesai; 
				
				}
      			if($roworder->status_order == 'Perbaiki Draft Sertifikat') {
					$jml_DrSert_perbaiki = 1+$jml_DrSert_perbaiki; 
				
				}
      			if($roworder->status_order == 'Draft Sertifikat telah diperbaiki') {
					$jml_DrSert_tlhperbaiki = 1+$jml_DrSert_tlhperbaiki; 
				
				}
      			if($roworder->status_order == 'Draf Sertifikat telah dicek') {
					$jml_DrSert_tlhdicek = 1+$jml_DrSert_tlhdicek; 
				
				}
      			if($roworder->status_order == 'Sertifikat telah selesai') {
					$jml_Sert_selesai = 1+$jml_Sert_selesai; 
				
				}
      			if($roworder->status_order == 'Closed') {
					$jml_Closed = 1+$jml_Closed; 
				
				} 
             
			}
		}
		$toview['jml_terdaftar'] = $jml_terdaftar + $jml_tlhDiperbaiki;
		$toview['jml_Diperbaiki'] = $jml_Diperbaiki;                
		$toview['jml_diterima'] = $jml_diterima;
		$toview['jml_dlmproses'] = $jml_dlmproses+$jml_dlmantrian;  
    	$toview['jml_dlmantrian'] = $jml_dlmantrian;
		$toview['jml_DrSert_selesai'] = $jml_DrSert_selesai + $jml_DrSert_tlhperbaiki;                
		$toview['jml_DrSert_perbaiki'] = $jml_DrSert_perbaiki;
		$toview['jml_DrSert_tlhdicek'] = $jml_DrSert_tlhdicek; 
    	$toview['jml_Sert_selesai'] = $jml_Sert_selesai; 
    	$toview['jml_Closed'] = $jml_Closed; 
    	*/
		$toview['profil'] = $this->session->userdata('profil');
		$toview['groupname'] = $this->session->userdata('profil')->groupname;
		
		$this->load->view('view_home',$toview);
	}
	
	function profil($nip=''){
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Edit Profil");
		$this->errormsg="";
		$nip=($nip=='')?$this->session->userdata('nip'):$nip;
		#return url
		if($this->session->userdata('profil')->groupname=='super'){
			if(!$this->session->userdata('returnurl')){$this->session->set_userdata('returnurl','user');}
			elseif(!preg_match("|^user/index/.*$|",$this->session->userdata('returnurl'))){$this->session->set_userdata('returnurl','user');}
		} else {
			$this->session->set_userdata('returnurl',$this->session->userdata('profil')->groupname);
		}
		#default value
		$result=$this->mUser->getDetail($nip);
		if($result){
			$this->judul='Profil';
			$toview['userid']=$result->userid;
			$toview['nip']=$result->nip;
			$toview['nip_baru']=$result->nip_baru;
			$toview['password']=$result->password;
			$toview['email']=$result->email;
			$toview['keterangan']=$result->keterangan;
			$toview['Nama']=$result->Nama;
			$toview['Tempat_Lahir']=$result->Tempat_Lahir;
			$toview['Tanggal_Lahir']=$result->Tanggal_Lahir;
			$toview['Jenis_Kelamin']=$result->Jenis_Kelamin;
			$toview['groupid']=$result->groupid;
			$toview['Pangkat']=$result->Pangkat;
			$toview['Golongan']=$result->Gol_Ruang;
			$toview['satker']=$this->session->userdata('profil')->satker;
			$toview['Jabatan']=$result->Jabatan;
			$toview['Status']=$result->kd_statuspeg;
			$toview['kd_satker']=$result->kd_satker;
			$toview['nama_satker']=$result->nama_satker;
		}
		 
		//$this->form_validation->set_rules('userid', 'Userid', 'required');
		//$this->form_validation->set_message('required', '%s Wajib diisi!');
		
		//$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		#set return url
		$toview['pageurl']='welcome/home/';
		$this->session->set_userdata('returnurl',$toview['pageurl']);
		
		if($this->input->post('save')){
			//if($this->form_validation->run())
			//{
				$toview['userid']=trim($this->input->post('userid'));
				$pass= trim($this->input->post('password'));
				//echo "<script>alert('$pass')</script>";
				if(isset($pass)) {
					$toview['password']=trim($this->input->post('password'));
					$toview['cpassword']=trim($this->input->post('cpassword'));
				} else { $toview['password']=trim($result->password); }


				$toview['email']=trim($this->input->post('email'));
				$toview['keterangan']=trim($this->input->post('keterangan'));
				if($this->session->userdata('profil')->groupname == 'super') $toview['groupid']=GetNumber($this->input->post('groupid'));
				if($result->userid != $toview['userid']){
					if($this->mUser->GetDetail2($toview['userid'])){ 
						#jika userid telah ada
						$this->errormsg='<em style="color:red">UserID sudah ada! Silahkan coba lagi.</em>';
					} elseif(!$this->mUser->CekEmailForSave($toview['email'],$result->userid)){
						#cek email telah terpakai apa belom
						$this->errormsg='<em style="color:red">Alamat email telah ada! Silahkan coba lagi.</em>';
					} elseif($this->input->post('password') != '' && $toview['password'] != $toview['cpassword']) { 
						#jika password tidak sama dengan konfirmasi
						$this->errormsg='<em style="color:red">Konfirmasi password tidak sama! Silahkan coba lagi.</em>';
					}
				} else {
					if($this->input->post('password') != '' && $toview['password'] != $toview['cpassword']) { 
						#jika password tidak sama dengan konfirmasi
						$this->errormsg='<em style="color:red">Konfirmasi password tidak sama! Silahkan coba lagi.</em>';
					} 
				}
				if($this->errormsg=="") { 
					$this->mUser->Save($toview,$nip,true); 
					if($result->userid != $toview['userid']) $this->session->set_userdata('userid',$toview['userid']);
					if($this->input->post('password') != '') $this->session->set_userdata('password',$toview['password']);
					if($result->groupid != $toview['groupid']) $this->session->set_userdata('groupid',$toview['groupid']);
					$this->session->unset_userdata('profil'); $this->session->set_userdata('profil',$this->mUser->readUser($nip));
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Simpan Profil");
					$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
				} else {
					$toview['userid']=$result->userid;
					$toview['email']=$result->email;
					$toview['keterangan']=$result->keterangan;
					$toview['groupid']=$result->groupid;
				}
				/*echo "<script language='javascript'>alert('".$this->errormsg."')</script>";*/
			//}
		}
		$this->javascript=$this->load->view('user/javascript_user_edit',$toview,true);
		$this->content=$this->load->view('user/user_edit',$toview);
	}
	
	function Logout(){
			$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Logout");
			$this->session->unset_userdata('profil');
			$this->session->unset_userdata('password');
			$this->session->unset_userdata('login');
			$this->session->unset_userdata('userid');
			$this->session->sess_destroy();
			redirect('welcome');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */