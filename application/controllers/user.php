<?php 

class User extends CI_Controller {
	var $userresult;
	var $searchbox='';
	var $javascript='';
	var $menu='';
	var $titleimg='';
	var $content='';
	var $judul='Sil';
	var $footer='';
	var $subtitle1='';
	var $subheader1='';
	
    public function __construct() {
        parent::__construct();
		$this->load->helper('inputer');
		$this->load->helper('email');
		$this->load->model('mUser');
		$this->load->model('mTarif');
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
    }
	
	function index($nip='-',$nip_baru='-',$Nama='-',$userid='-',$groupid='-',$kd_satker='-',$ord='users.tgldaftar',
		$srt='desc',$limit=30,$page=1){
		if($this->session->userdata('profil')->groupname=='super' || 
		   $this->session->userdata('profil')->groupname=='admin'){
			$toview['nip']=GetInput($this->input->post('nip'),$nip);
			$toview['nip_baru']=GetInput($this->input->post('nip_baru'),$nip_baru);
			$toview['Nama']=GetInput($this->input->post('Nama'),$Nama);
			$toview['userid']=GetInput($this->input->post('userid'),$userid);
			$toview['kd_satker']=GetInput($this->input->post('kd_satker'),$kd_satker);
			$toview['groupid']=GetInput($this->input->post('groupid'),$groupid);
			$toview['ord']=GetInput($this->input->post('ord'),$ord,'staff.Nama');
			$toview['srt']=GetSort($this->input->post('srt'),$srt,'asc');
			$toview['limit']=(int) $limit;
			if($toview['limit']<1){$toview['limit']=30;}
			$page=(int) @ereg_replace("[^0-9]",'',$page);
			#get result
			$toview['tot']=$this->mUser->GetTotal($toview['nip'],$toview['Nama'],
			$toview['userid'],$toview['groupid'],$toview['kd_satker']);
			if($toview['tot']>0){
				$toview['pages']=ceil($toview['tot']/$toview['limit']);
				if(!is_numeric($page)){$toview['page']=1;}
				elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
				else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['result']=$this->mUser->GetResult($toview['nip'],$toview['Nama'],
					$toview['userid'],$toview['groupid'],$toview['kd_satker'],$toview['ord'],
					$toview['srt'],$toview['limit'],$toview['start']);
			} else {
				$toview['pages']=0;
				$toview['page']=0;
				$toview['start']=0;
				$toview['result']=false;
			}
			#set return url
			$toview['pageurl']='user/index/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['nip'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['nip_baru'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['Nama'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['userid'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['groupid'])).'/';
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
			$this->searchbox=$this->load->view('user/searchbox-user',$toview,true);
			$this->javascript=$this->load->view('user/javascript_user_index',$toview,true);
			$this->content=$this->load->view('user/view_user',$toview);
			//$this->load->view('user/viewadmin');
		} else {
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}
	}

	function add($nip=""){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		if($this->session->userdata('profil')->groupname=='super' || $this->session->userdata('profil')->groupname=='admin'){
			$this->judul='Tambah User';
			$toview['userid']=$nip;
			$toview['nip']=$nip;
			$toview['nip_baru']='';
			$toview['password']='';
			$toview['email']='';
			$toview['keterangan']='';
			$toview['Nama']='';
			$toview['groupid']='';
			
				
			$this->form_validation->set_rules('nip', 'NIP', 'required');
			//$this->form_validation->set_rules('userid', 'Userid', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');
			
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			
			if($this->input->post('save')){
				if($this->form_validation->run())
				{
					$toview['nip']=trim($this->input->post('nip'));
					$toview['nip_baru']=trim($this->input->post('nip_baru'));
					$toview['userid']=trim($this->input->post('nip'));
					if($this->input->post('password')) {
						$toview['password']=trim($this->input->post('password'));
						$toview['cpassword']=trim($this->input->post('cpassword'));
					} else { $toview['password']=trim($result->password); }
					$toview['email']=trim($this->input->post('email'));
					$toview['keterangan']=trim($this->input->post('keterangan'));
					$toview['groupid']=GetNumber($this->input->post('groupid'));
					if(!$this->mUser->GetDetailStaff($toview['nip'])){ 
						#jika userid telah ada
						$this->errormsg='<em style="color:red">NIP tidak terdaftar! Silahkan coba lagi.</em>';
					} elseif($this->mUser->GetDetail($toview['nip'])){ 
						#jika userid telah ada
						$this->errormsg='<em style="color:red">NIP sudah dipakai! Silahkan coba lagi.</em>';
					//} elseif($this->mUser->GetDetail2($toview['userid'])){ 
						#jika userid telah ada
					//	$this->errormsg='<em style="color:red">UserID sudah dipakai! Silahkan coba lagi.</em>';
					} elseif(!$this->mUser->CekEmailForSave($toview['email'],$toview['userid'])){
						#cek email telah terpakai apa belom
						$this->errormsg='<em style="color:red">Alamat email telah dipakai! Silahkan coba lagi.</em>';
					} elseif($this->input->post('password') != '' && $toview['password'] != $toview['cpassword']) { 
						#jika password tidak sama dengan konfirmasi
						$this->errormsg='<em style="color:red">Konfirmasi password tidak sama! Silahkan coba lagi.</em>';
					}
				  if($this->errormsg=="") { 
						$teritorial=$this->mUser->GetDetailStaff($toview['nip']);
				  		if($this->session->userdata('profil')->groupname == 'admin') { //CEK BATAS TERITORIAL
							if($teritorial->kd_satker != $this->session->userdata('profil')->kd_satker) {
								$this->errormsg='<em style="color:red">Maaf! Anda tidak berhak menambah user yang bukan satker anda.</em>';
							}
						}
						if($this->errormsg=="") {
						  $this->mUser->Save($toview,$toview['nip']); 
						  $toview['nip']='';
						  $this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Tambah User Baru");
						  $this->errormsg='<em style="color:green">User Baru Berhasil disimpan! <br>Lihat data <a href="index.php/user/view/'.$teritorial->NIP.'">'.$teritorial->Nama.'</a></em>';
						}
				  }
				}
			}
			#load view
			$this->javascript=$this->load->view('user/javascript_user_edit',$toview,true);
			$this->content=$this->load->view('user/user_add',$toview);
			//$this->load->view('user/viewadmin',$toview);
		} else {
			$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Forbidden!");
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}
	}
	
	function del($nip='',$userid=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		if($this->session->userdata('profil')->groupname=='super' || $this->session->userdata('profil')->groupname=='admin'){
			if($nip) $tot=$this->mUser->DeleteUser($nip);
			/*$arruserid=$this->input->post('userid');
			$tot=0;
			if(!empty($arruserid) && is_array($arruserid)){
				foreach($arruserid as $userid){
					$userid=trim($userid);
					if($userid && $userid!=$this->session->userdata('userid')){$tot+=$this->mUser->DeleteUser($userid);}
				}
			}*/
			$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Hapus User");
			$this->session->set_userdata('alert',$tot.' user telah di hapus');
			$returnurl=$this->session->userdata('returnurl');
			if(!$returnurl){$returnurl='user';}
			elseif(!preg_match("|^user/index/.*$|",$returnurl)){$returnurl='user';}
			redirect($returnurl);
		} else {
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}
	}
	
	function view($nip='',$userid=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		if($nip) $result=$this->mUser->getDetail($nip);
		if($userid) $result=$this->mUser->getDetail2($userid);
		$this->judul='View User';
		if($result===false){
			$toview['userid']='';
			$toview['nip']='';
			$toview['nip_baru']='';
			$toview['password']='';
			$toview['keterangan']='';
			$toview['email']='';
			$toview['Nama']='';
			$toview['Tempat Lahir']='';
			$toview['Tanggal Lahir']='';
			$toview['Jenis_Kelamin']='';
			$toview['groupid']='';
			$toview['groupname']='';
			$toview['pangkat']='';
			$toview['Golongan']='';
			$toview['Jabatan']='';
			$toview['Status']='';
			$toview['kd_satker']='';
			$toview['nama_satker']='';
		} else {
			$toview['userid']=$result->userid;
			$toview['nip']=$result->nip;
			$toview['nip_baru']=$result->nip_baru;
			$toview['password']=$result->password;
			$toview['keterangan']=$result->keterangan;
			$toview['email']=$result->email;
			$toview['tgldaftar']=$result->tgldaftar;
			$toview['added_by']=$result->added_by;
			
			$toview['Nama']=$result->Nama;
			$toview['Tempat_Lahir']=$result->Tempat_Lahir;
			$toview['Tanggal_Lahir']=$result->Tanggal_Lahir;
			$toview['Jenis_Kelamin']=$result->Jenis_Kelamin;
			$toview['groupid']=$result->groupid;
			$toview['groupname']=$result->desc;
			$toview['Pangkat']=$result->Pangkat;
			$toview['Golongan']=$result->Gol_Ruang;
			$toview['Jabatan']=$result->Jabatan;
			$toview['Status']=$result->kd_statuspeg;
			$toview['kd_satker']=$result->kd_satker;
			$toview['nama_satker']=$result->nama_satker;
		}
		$this->content=$this->load->view('user/user_detail',$toview);
	}

	function edit($nip='',$nip_baru=''){
		if($this->session->userdata('profil')->groupname=='super' || $this->session->userdata('profil')->groupname=='admin'){
			$this->errormsg="";
			$nip=($nip=='')?$this->session->userdata('nip'):$nip;
			#return url
			if($this->session->userdata('profil')->groupname=='super' || $this->session->userdata('profil')->groupname=='admin'){
				if(!$this->session->userdata('returnurl')){
				$this->session->set_userdata('returnurl','user');}
				elseif(!preg_match("|^user/index/.*$|",$this->session->userdata('returnurl'))){
				$this->session->set_userdata('returnurl','user');}
			} else {
				$this->session->set_userdata('returnurl',$this->session->userdata('profil')->groupname);
			}
			#default value
			$result=$this->mUser->getDetail($nip);
			if($result===false){
				$this->judul='Tambah User';
				$toview['userid']='';
				$toview['nip']='';
			        $toview['nip_baru']='';
				$toview['password']='';
				$toview['keterangan']='';
				$toview['email']='';
				$toview['Nama']='';
				$toview['Tempat Lahir']='';
				$toview['Tanggal Lahir']='';
				$toview['Jenis_Kelamin']='';
				$toview['groupid']='';
				$toview['pangkat']='';
				$toview['Golongan']='';
				$toview['Jabatan']='';
				$toview['Status']='';
				$toview['kd_satker']='';
				$toview['nama_satker']='';
			} else {
				$this->judul='Ubah User';
				$toview['userid']=$result->userid;
				$toview['nip']=$result->nip;
			        $toview['nip_baru']=$result->nip_baru;
				$toview['password']=$result->password;
				$toview['keterangan']=$result->keterangan;
				$toview['email']=$result->email;
				$toview['Nama']=$result->Nama;
				$toview['Tempat_Lahir']=$result->Tempat_Lahir;
				$toview['Tanggal_Lahir']=$result->Tanggal_Lahir;
				$toview['Jenis_Kelamin']=$result->Jenis_Kelamin;
				$toview['groupid']=$result->groupid;
				$toview['Pangkat']=$result->Pangkat;
				$toview['Golongan']=$result->Gol_Ruang;
				$toview['Jabatan']=$result->Jabatan;
				$toview['Status']=$result->kd_statuspeg;
				$toview['kd_satker']=$result->kd_satker;
				$toview['nama_satker']=$result->nama_satker;
			}
			
			//$this->form_validation->set_rules('userid', 'Userid', 'required');
			//$this->form_validation->set_message('required', '%s Wajib diisi!');
			
			//$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			
			if($this->input->post('save')){
				//if($this->form_validation->run())
				//{
					$toview['nip_baru']=trim($this->input->post('nip_baru'));
					$pass= trim($this->input->post('password'));
					//echo "<script>alert('$pass')</script>";
					if(isset($pass)) {
						$toview['password']=trim($this->input->post('password'));
						$toview['cpassword']=trim($this->input->post('cpassword'));
					} else { $toview['password']=trim($result->password); }

					$toview['email']=trim($this->input->post('email'));
					$toview['keterangan']=trim($this->input->post('keterangan'));
					$toview['groupid']=GetNumber($this->input->post('groupid'));
					if($this->input->post('kd_satker')){ $toview['kd_satker']=$this->input->post('kd_satker'); }
					if($this->session->userdata('profil')->groupname == 'super') 
						$toview['groupid']=GetNumber($this->input->post('groupid'));
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
				//}
				if($this->errormsg=="") { 
					$this->mUser->Save($toview,$nip,true); 
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Update User");
					$this->errormsg='<em style="color:green">Berhasil diupdate!</em>';
				}
			}
			#load view
			if($this->session->userdata('profil')->groupname=='user' || $this->session->userdata('profil')->groupname=='super'){
				$this->searchbox=$this->load->view('user/searchbox-user',array(),true);
			}
			$this->javascript=$this->load->view('user/javascript_user_edit',$toview,true);
			$this->content=$this->load->view('user/user_edit',$toview);
			//$this->load->view('user/viewadmin',$toview);
		} else {
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}
	}

    public function readUser() {
        echo json_encode( $this->mUser->getStaff() );
    }
	
	public function aktivitas($userid='-',$ip='-',$url='-',$action='-',$ord='time',$srt='desc',$limit=30,$page=1){
		if($this->session->userdata('profil')->groupname=='super' || $this->session->userdata('profil')->groupname=='admin'){
			$toview['userid']=GetInput($this->input->post('userid'),$userid);
			$toview['ip']=GetInput($this->input->post('ip'),$ip);
			$toview['url']=GetInput($this->input->post('url'),$url);
			$toview['action']=GetInput($this->input->post('action'),$action);
			$toview['ord']=GetInput($this->input->post('ord'),$ord,'staff.Nama');
			$toview['srt']=GetSort($this->input->post('srt'),$srt,'asc');
			$toview['limit']=(int) $limit;
			if($toview['limit']<1){$toview['limit']=30;}
			$page=(int) @ereg_replace("[^0-9]",'',$page);
			#get result
			$toview['tot']=$this->mUser->getTotUserLog($toview['userid'],$toview['ip'],$toview['url'],$toview['action']);
			if($toview['tot']>0){
				$toview['pages']=ceil($toview['tot']/$toview['limit']);
				if(!is_numeric($page)){$toview['page']=1;}
				elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
				else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['result']=$this->mUser->getUserLog($toview['userid'],$toview['ip'],$toview['url'],$toview['action'],$toview['ord'],$toview['srt'],$toview['limit'],$toview['start']);
			} else {
				$toview['pages']=0;
				$toview['page']=0;
				$toview['start']=0;
				$toview['result']=false;
			}
			#set return url
			$toview['pageurl']='user/aktivitas/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['userid'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['ip'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['url'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['action'])).'/';
			$toview['ordurl']=$toview['pageurl']; //untuk sort
			$toview['pageurl'].=$toview['ord'].'/';
			$toview['pageurl'].=$toview['srt'].'/';
			$toview['limiturl']=$toview['pageurl']; //untuk limit
			$toview['pageurl'].=$toview['limit'].'/';
			$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);
			$this->searchbox=$this->load->view('user/searchbox-log',$toview,true);
			#javascript
			$this->javascript='
			<script type="text/javascript">
			$("#tanggal").datepicker({
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both" 
			});
			</script>';
			$this->load->view('user/view_user_log.php',$toview);
		} else {
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}
	}
	
	public function aktivitas_view($no_urut){
		$toview['result']=$this->mUser->getLog($no_urut);
		$this->load->view('user/view_detail_log',$toview);
		
	}
	
	public function comments()
	{
		echo 'Look at this!';
	}
}
?>
