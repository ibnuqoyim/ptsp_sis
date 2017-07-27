<?php 

class Staff extends CI_Controller {
	var $userresult;
	var $searchbox='';
	var $javascript='';
	var $menu='';
	var $titleimg='';
	var $content='';
	var $judul='Chalsy';
	var $footer='';
	var $subtitle1='';
	var $subheader1='';
	
    public function __construct() {
        parent::__construct();
		$this->load->helper('inputer');
		$this->load->model('mUser');
		$this->load->model('mTarif');
    }
	
	function Staff(){
		#footer
		if(($this->session->userdata('profil')->groupname=='user' && $this->session->userdata('profil')->ijin_tulis) || 
		$this->session->userdata('profil')->groupname=='super' || $this->session->userdata('profil')->groupname=='admin'){
			$this->footer='<div class="footer-title">|</div>';
			$this->footer.='<div class="footer-title">'.anchor('user/edit','Tambah Data').'</div>';
		}
		#image title
		if($this->session->userdata('profil')->groupname=='user'){
			$this->titleimg=img('images/adm_user.png');}
		elseif($this->session->userdata('profil')->groupname=='super' || 
			$this->session->userdata('profil')->groupname=='admin'){
			$this->titleimg=img('images/super_user.png');
		}
		#menu
		$this->menu='<table border="0" align="right" cellpadding="0" cellspacing="0" id="sub-menu"><tr>';
		if($this->session->userdata('profil')->groupname=='tlh'){
			$this->titleimg=img('images/sub-head_title.jpg');
			$this->menu.='<td>'.anchor('tlh',img(array('src'=>"images/topmenu_login_01.jpg",'id'=>"image1"))).'</td>';
			$this->menu.='<td>'.anchor('tlh/index/phi',img(array('src'=>"images/topmenu_login_02.jpg",'id'=>"image2"))).'</td>';
			$this->menu.='<td>'.anchor('tlh/index/phe',img(array('src'=>"images/topmenu_login_03.jpg",'id'=>"image3"))).'</td>';
			$this->menu.='<td>'.anchor('tlh/index/laporan',img(array('src'=>"images/topmenu_login_04.jpg",'id'=>"image4"))).'</td>';
			$this->menu.='<td>'.anchor('tlh/index/kajian',img(array('src'=>"images/topmenu_login_05.jpg",'id'=>"image5"))).'</td>';
		} elseif($this->session->userdata('profil')->groupname=='ph'){
			$this->titleimg=img('images/sub-head_title_02.jpg');
			$this->menu.='<td>'.anchor('ph',img(array('src'=>"images/topmenu_login_01.jpg",'id'=>"image1"))).'</td>';
			$this->menu.='<td>'.anchor('ph/index/perdata_pidana',img(array('src'=>"images/topmenu_login_08.jpg",'id'=>"image8"))).'</td>';
			$this->menu.='<td>'.anchor('ph/index/somasi',img(array('src'=>"images/topmenu_login_07.jpg",'id'=>"image7"))).'</td>';
			$this->menu.='<td>'.anchor('ph/index/mediasi',img(array('src'=>"images/topmenu_login_06.jpg",'id'=>"image6"))).'</td>';
			$this->menu.='<td>'.anchor('ph/index/perhuk_lap',img(array('src'=>"images/topmenu_login_04.jpg",'id'=>"image4"))).'</td>';
			$this->menu.='<td>'.anchor('ph/index/perhuk_kaj',img(array('src'=>"images/topmenu_login_05.jpg",'id'=>"image5"))).'</td>';
			if($this->session->userdata('profil')->lihat_tlh || $this->session->userdata('profil')->tulis_perda){
				$this->menu.='<td>'.anchor('tlh/',img(array('src'=>"images/topmenu_tlh.jpg",'id'=>"imagetlh"))).'</td>';
			}
		} elseif($this->session->userdata('profil')->groupname=='kepatuhan'){
			$this->titleimg=img('images/sub-head_title_03.jpg');
			$this->menu.='<td>'.anchor('kepatuhan',img(array('src'=>"images/topmenu_login_01.jpg",'id'=>"image1"))).'</td>';
			$this->menu.='<td>'.anchor('kepatuhan/index/selfcompliance',img(array('src'=>"images/topmenu_kepatuhan_01.jpg",'id'=>"kepatuhan_01"))).'</td>';
			$this->menu.='<td>'.anchor('kepatuhan/index/gcg',img(array('src'=>"images/topmenu_kepatuhan_02.jpg",'id'=>"kepatuhan_02"))).'</td>';
			$this->menu.='<td>'.anchor('kepatuhan/index/rups',img(array('src'=>"images/topmenu_kepatuhan_03.jpg",'id'=>"kepatuhan_03"))).'</td>';
			$this->menu.='<td>'.anchor('kepatuhan/index/rakernas',img(array('src'=>"images/topmenu_kepatuhan_04.jpg",'id'=>"kepatuhan_04"))).'</td>';
			$this->menu.='<td>'.anchor('kepatuhan/index/rakerda',img(array('src'=>"images/topmenu_kepatuhan_05.jpg",'id'=>"kepatuhan_05"))).'</td>';
			if($this->session->userdata('profil')->lihat_tlh || $this->session->userdata('profil')->tulis_perda){
				$this->menu.='<td>'.anchor('tlh/',img(array('src'=>"images/topmenu_tlh.jpg",'id'=>"imagetlh"))).'</td>';
			}
		}
		$this->menu.='</tr></table>';
	}
	
	function index($NIP='-',$Nama='-',$kd_satker='-',$ord='staff.Nama',$srt='asc',$limit=30,$page=1){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		if($this->session->userdata('profil')->groupname=='user' || 
			$this->session->userdata('profil')->groupname=='super' || 
			$this->session->userdata('profil')->groupname=='admin'){
			$toview['NIP']=GetInput($this->input->post('NIP'),$NIP);
			$toview['Nama']=GetInput($this->input->post('Nama'),$Nama);
			$toview['kd_satker']=GetInput($this->input->post('kd_satker'),$kd_satker);
			$toview['ord']=GetInput($this->input->post('ord'),$ord,'staff.Nama');
			$toview['srt']=GetSort($this->input->post('srt'),$srt,'asc');
			$toview['limit']=(int) $limit;
			if($toview['limit']<1){$toview['limit']=30;}
			$page=(int) @ereg_replace("[^0-9]",'',$page);
			#get result
			$toview['tot']=$this->mstaff->GetTotal($toview['NIP'],$toview['Nama'],$toview['kd_satker']);
			if($toview['tot']>0){
				$toview['pages']=ceil($toview['tot']/$toview['limit']);
				if(!is_numeric($page)){$toview['page']=1;}
				elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
				else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				
				$toview['result']=$this->mstaff->GetResult($toview['NIP'],$toview['Nama'],$toview['kd_satker'],$toview['ord'],$toview['srt'],$toview['limit'],$toview['start']);
			} else {
				$toview['pages']=0;
				$toview['page']=0;
				$toview['start']=0;
				$toview['result']=false;
			}
			#set return url
			$toview['pageurl']='staff/index/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['NIP'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['Nama'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['kd_satker'])).'/';
			$toview['ordurl']=$toview['pageurl']; //untuk sort
			$toview['pageurl'].=$toview['ord'].'/';
			$toview['pageurl'].=$toview['srt'].'/';
			$toview['limiturl']=$toview['pageurl']; //untuk limit
			$toview['pageurl'].=$toview['limit'].'/';
			$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);
			#judul
			$this->judul='Daftar User';
			#load view
			$this->searchbox=$this->load->view('staff/searchbox-staff',$toview,true);
			$this->javascript=$this->load->view('user/javascript_user_index',$toview,true);
			$this->content=$this->load->view('staff/view_staff',$toview);
			//$this->load->view('staff/viewadmin');
		} else {
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}
	}

	function delete(){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		if(($this->session->userdata('profil')->groupname=='user' && $this->session->userdata('profil')->ijin_hapus) || 
		$this->session->userdata('profil')->groupname=='super' || $this->session->userdata('profil')->groupname=='admin'){
			$arrNIP=$this->input->post('NIP');
			$tot=0;
			if(!empty($arrNIP) && is_array($arrNIP)){
				foreach($arrNIP as $NIP){
					$NIP=trim($NIP);
					if($NIP && $NIP!=$this->session->userdata('NIP')){$tot+=$this->mstaff->DeleteUser($NIP);}
				}
			}
			$this->session->set_userdata('alert',$tot.' user telah di hapus');
			$returnurl=$this->session->userdata('returnurl');
			if(!$returnurl){$returnurl='user';}
			elseif(!preg_match("|^user/index/.*$|",$returnurl)){$returnurl='user';}
			redirect($returnurl);
		} else {
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}
	}
	
	function edit($NIP=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		if($this->session->userdata('profil')->groupname=='super' || 
		($this->session->userdata('profil')->groupname=='user' && $this->session->userdata('profil')->ijin_tulis) || 
		$this->session->userdata('NIP')==$NIP || $this->session->userdata('profil')->groupname=='admin'){
			$this->load->helper('email');
			#return url
			if($this->session->userdata('profil')->groupname=='super' || $this->session->userdata('profil')->groupname=='user'
				|| $this->session->userdata('profil')->groupname=='admin'){
				if(!$this->session->userdata('returnurl')){$this->session->set_userdata('returnurl','user');}
				elseif(!preg_match("|^user/index/.*$|",$this->session->userdata('returnurl'))){$this->session->set_userdata('returnurl','user');}
			} else {
				$this->session->set_userdata('returnurl',$this->session->userdata('profil')->groupname);
			}
			#default value
			$result=$this->mstaff->getDetail($NIP);
			if($result===false){
				$this->judul='Tambah User';
				$toview['NIP']='';
				$toview['password']='';
				$toview['Nama']='';
				$toview['Tempat Lahir']='';
				$toview['Tanggal Lahir']='';
				$toview['Jenis_Kelamin']='';
				$toview['kd_satker']='';
				$toview['pangkat']='';
				$toview['Golongan']='';
				$toview['Jabatan']='';
				$toview['Status']='';
			} else {
				$this->judul='Ubah User';
				$toview['NIP']=$result->NIP;
				$toview['password']=$result->password;
				$toview['Nama']=$result->Nama;
				$toview['Tempat_Lahir']=$result->Tempat_Lahir;
				$toview['Tanggal_Lahir']=$result->Tanggal_Lahir;
				$toview['Jenis_Kelamin']=$result->Jenis_Kelamin;
				$toview['kd_satker']=$result->kd_satker;
				$toview['Pangkat']=$result->Pangkat;
				$toview['Golongan']=$result->Gol_Ruang;
				$toview['Jabatan']=$result->Jabatan;
				$toview['Status']=$result->kd_statuspeg;
			}
			
			if($this->input->post('save')){
				$toview['kd_satker']=GetNumber($this->input->post('kd_satker'));
				$toview['NIP']=trim($this->input->post('NIP'));
				$this->mstaff->Save($toview,$NIP);
			}
			#load view
			if($this->session->userdata('profil')->groupname=='user' || $this->session->userdata('profil')->groupname=='super'){
				$this->searchbox=$this->load->view('user/searchbox-user',array(),true);
			}
			$this->javascript=$this->load->view('user/javascript_user_edit',$toview,true);
			$this->content=$this->load->view('user/user_edit',$toview);
			//$this->load->view('staff/viewadmin',$toview);
		} else {
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}
	}

	public function view($NIP=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		if($this->session->userdata('profil')->groupname=='super' || 
		($this->session->userdata('profil')->groupname=='user' && $this->session->userdata('profil')->ijin_tulis) 
		|| $this->session->userdata('NIP')==$NIP || $this->session->userdata('profil')->groupname=='admin'){
			$this->load->helper('email');
			#return url
			if($this->session->userdata('profil')->groupname=='super' || 
			$this->session->userdata('profil')->groupname=='user' || $this->session->userdata('profil')->groupname=='admin'){
				if(!$this->session->userdata('returnurl')){$this->session->set_userdata('returnurl','user');}
				elseif(!preg_match("|^staff/index/.*$|",$this->session->userdata('returnurl'))){
				$this->session->set_userdata('returnurl','staff');}
			} else {
				$this->session->set_userdata('returnurl',$this->session->userdata('profil')->groupname);
			}
			#default value
			$result=$this->mstaff->getDetail($NIP);
			if($result===false){
				$this->judul='Tambah User';
				$toview['NIP']='';
				$toview['Nama']='';
				$toview['Tempat Lahir']='';
				$toview['Tanggal Lahir']='';
				$toview['Jenis_Kelamin']='';
				$toview['kd_satker']='';
				$toview['nama_satker']='';
				$toview['pangkat']='';
				$toview['Golongan']='';
				$toview['Jabatan']='';
				$toview['Status']='';
			} else {
				$this->judul='Ubah User';
				$toview['NIP']=$result->NIP;
				$toview['Nama']=$result->Nama;
				$toview['Tempat_Lahir']=$result->Tempat_Lahir;
				$toview['Tanggal_Lahir']=$result->Tanggal_Lahir;
				$toview['Jenis_Kelamin']=$result->Jenis_Kelamin;
				$toview['kd_satker']=$result->kd_satker;
				$toview['nama_satker']=$result->nama_satker;
				$toview['Pangkat']=$result->Pangkat;
				$toview['Golongan']=$result->Gol_Ruang;
				$toview['Jabatan']=$result->Jabatan;
				$toview['Status']=$result->kd_statuspeg;
			}
	  #judul
	  $this->judul='Daftar Staff';
	  #load view
	  $this->searchbox=$this->load->view('staff/searchbox-staff',$toview,true);
	  //$this->javascript=$this->load->view('user/javascript_user_index',$toview,true);
	  $this->content=$this->load->view('staff/staff_detail',$toview);
		} else {
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}
	}
	
    public function readUser() {
        echo json_encode( $this->mstaff->getStaff() );
    }

	public function comments()
	{
		echo 'Look at this!';
	}
}
?>
