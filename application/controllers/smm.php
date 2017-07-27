<?php
class smm extends CI_Controller {
	var $userresult;
	var $searchbox='';
	var $javascript='';
	var $errormsg='';
	var $title='';
	var $content='';
	var $judul='PTSP';
	var $footer='';
	var $subtitle1='';
	var $subheader1='';
	
   	public function __construct() {
       parent::__construct();
		$this->load->helper('inputer');
		$this->load->model('mSMM');
		$this->load->model('mUser');
  	}

  	public function index($kd_sertifikasi_smm='-',$nama_sertifikasi_smmi='-',$action='view',$ord='tgl_create',$srt='desc',$limit=30,$page=1){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		$this->errormsg="";
		if($kd_sertifikasi_smm != '-') $toview['kd_sertifikasi_smm']=$kd_sertifikasi_smm; 
		else $toview['kd_sertifikasi_smm']='';

	   	$result=$this->mSMM->readSMM($kd_sertifikasi_smm);

	   	if($result){
	   		$toview['nama_sertifikasi_smm']=GetInput($this->input->post('nama_sertifikasi_smm'),$result?ucfirst($result->nama_sertifikasi_smm):'');
		}else{
			$toview['nama_sertifikasi_smm']='';
		}
		
		$toview['ord']=GetInput($this->input->post('ord'),$ord,'mst_sertifikasi_smm.tgl_create');
		$toview['srt']=GetSort($this->input->post('srt'),$srt,'desc');
		$toview['limit']=(int) $limit;
		if($toview['limit']<1){$toview['limit']=30;}
		$page=(int) @ereg_replace("[^0-9]",'',$page);
		
		#get result
		if($toview['kd_sertifikasi_smm'])
			 $toview['tot']=$this->mSMM->getTotalSMM($toview['kd_sertifikasi_smm'],''); 
		else $toview['tot']=$this->mSMM->getTotalSMM('',$toview['nama_sertifikasi_smm']);
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			if($toview['kd_sertifikasi_smm']) {
				$toview['result']=$this->mSMM->getResultSMM($toview['kd_sertifikasi_smm'],'',$toview['ord'],$toview['srt'],$toview['limit'],
								$toview['start']); 
			}else{ 
				$toview['result']=$this->mSMM->getResultSMM('',$toview['nama_sertifikasi_smm'],$toview['ord'],
								$toview['srt'],$toview['limit'],$toview['start']);
			}
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		#set return url
		$toview['pageurl']='smm/index/-/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['nama_sertifikasi_smm'])).'/';
		$toview['pageurl'].='view/';//$toview['action'].'/';
		$toview['ordurl']=$toview['pageurl']; //untuk sort
		$toview['pageurl'].=$toview['ord'].'/';
		$toview['pageurl'].=$toview['srt'].'/';
		$toview['limiturl']=$toview['pageurl']; //untuk limit
		$toview['pageurl'].=$toview['limit'].'/';
		$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);
				
		$this->form_validation->set_rules('nama_sertifikasi_smm', 'Nama Sistem Mutu', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');

		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			$toview['kd_sertifikasi_smm']=trim($this->input->post('kd_sertifikasi_smm'));
			$toview['nama_sertifikasi_smm']=trim($this->input->post('nama_sertifikasi_smm'));

			if($this->errormsg=="") { 
				$toview['tgl_create']=date("Y-m-d h:i:a");
				$toview['tgl_update']=date("Y-m-d h:i:a");
				$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				if($action=="edit") { 
					$komoditi = $this->mSMM->getSMM($kd_sertifikasi_smm);					
					$this->mSMM->saveSMM($toview,$kd_sertifikasi_smm,true);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Update Komoditi");					
				} else {
					$toview['kd_sertifikasi_smm']=$this->mSMM->Make_kd_sertifikasi_smm();
					$this->mSMM->saveSMM($toview,$toview['kd_sertifikasi_smm'],false);
				}
				$this->errormsg='<em style="color:green">'.
				$toview['nama_sertifikasi_smm'].' Berhasil disimpan! <br><a href="index.php/SMM/index/'.
				$toview['kd_sertifikasi_smm'].'/-/-/add">Input Jenis '.ucfirst($toview['nama_sertifikasi_smm']).'</a></em>';
				if($action=="view") redirect(current_url());
			}
		  }
		}

	   	if($action==="add"){
			#judul
			$this->judul='<center>Tambah Sistem Mutu '.$toview['nama_sertifikasi_smm'].'</center>';
			#load view
			$this->content=$this->load->view('smm/smm_sertifikasi_add',$toview);
		}
	   	if($action==="view"){
			#judul
			$this->judul='<center>Daftar Sistem Mutu '.$toview['nama_sertifikasi_smm'].'</center>';
			#load view
			$this->content=$this->load->view('smm/view_smm_sertifikasi',$toview);
		}
		if($action==="edit"){
			#judul
			$this->judul='<center>Ubah Sistem Mutu '.$toview['nama_sertifikasi_smm'].'</center>';
			#load view
			$this->content=$this->load->view('smm/smm_sertifikasi_edit',$toview);
		}
		if($action==="del"){
			$tot=$this->mSMM->deleteSMM($kd_sertifikasi_smm);
			if($tot){
				redirect("smm");
			}
			
		}
   }
  }
?>