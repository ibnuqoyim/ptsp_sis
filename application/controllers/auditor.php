<?php
class auditor extends CI_Controller {
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
		$this->load->model('mAuditor');
		$this->load->model('mUser');
  	}

  	public function index($kd_auditor='-',$nama_auditor='-',$action='view',$ord='tgl_create',$srt='desc',$limit=30,$page=1){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		$this->errormsg="";
		if($kd_auditor != '-') $toview['kd_auditor']=$kd_auditor; 
		else $toview['kd_auditor']='';

	   	$result=$this->mAuditor->readAuditor($kd_auditor);

	   	if($result){
	   		$toview['nama_auditor']=$result->nama_auditor;
	   		$toview['singkatan_nama_auditor']=$result->singkatan_nama_auditor;
	   		$toview['jabatan_auditor']=$result->jabatan_auditor;
	   		$toview['kd_auditor']=$result->kd_auditor;
		}else{
			$toview['nama_auditor']='';
			$toview['singkatan_nama_auditor']='';
			$toview['jabatan_auditor']='';
		}
		
		$toview['ord']=GetInput($this->input->post('ord'),$ord,'mst_sertifikasi_auditor.tgl_create');
		$toview['srt']=GetSort($this->input->post('srt'),$srt,'desc');
		$toview['limit']=(int) $limit;
		if($toview['limit']<1){$toview['limit']=30;}
		$page=(int) @ereg_replace("[^0-9]",'',$page);
		
		#get result
		if($toview['kd_auditor'])
			 $toview['tot']=$this->mAuditor->getTotalAuditor($toview['kd_auditor'],''); 
		else 
			$toview['tot']=$this->mAuditor->getTotalAuditor('',$toview['nama_auditor']);

		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			if($toview['kd_auditor']) {
				$toview['result']=$this->mAuditor->getResultAuditor($toview['kd_auditor'],'',$toview['ord'],$toview['srt'],$toview['limit'],
								$toview['start']); 
			}else{ 
				$toview['result']=$this->mAuditor->getResultAuditor('',$toview['nama_auditor'],$toview['ord'],
								$toview['srt'],$toview['limit'],$toview['start']);
			}
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		#set return url
		$toview['pageurl']='auditor/index/-/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['nama_auditor'])).'/';
		//$toview['pageurl'].=SetAttr(rawurlencode($toview['jabatan_auditor'])).'/';
		$toview['pageurl'].='view/';//$toview['action'].'/';
		$toview['ordurl']=$toview['pageurl']; //untuk sort
		$toview['pageurl'].=$toview['ord'].'/';
		$toview['pageurl'].=$toview['srt'].'/';
		$toview['limiturl']=$toview['pageurl']; //untuk limit
		$toview['pageurl'].=$toview['limit'].'/';

		$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);
				
		$this->form_validation->set_rules('nama_auditor', 'Nama Auditor', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');

		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			$toview['kd_auditor']=trim($this->input->post('kd_auditor'));
			//echo "erik".$toview['kd_auditor'];
			$toview['nama_auditor']=trim($this->input->post('nama_auditor'));
			$toview['singkatan_nama_auditor']=trim($this->input->post('singkatan_nama_auditor'));
			$toview['jabatan_auditor']=trim($this->input->post('jabatan_auditor'));

			if($this->errormsg=="") { 
				$toview['tgl_create']=date("Y-m-d h:i:a");
				$toview['tgl_update']=date("Y-m-d h:i:a");
				$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				if($action=="edit") { 
					$this->mAuditor->saveAuditor($toview,$kd_auditor,true);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Update Auditor");					
				} else {
					$toview['kd_auditor']=$this->mAuditor->Make_kd_auditor();
					$this->mAuditor->saveAuditor($toview,$toview['kd_auditor'],false);
				}
				$this->errormsg='<em style="color:green">'.
				$toview['nama_auditor'].' Berhasil disimpan! <br><a href="index.php/Auditor/add/'.
				$toview['kd_auditor'].'/-/-/add">Input Jenis '.ucfirst($toview['nama_auditor']).'</a></em>';
				if($action=="view") redirect(current_url());
			}
		  }
		}

	   	if($action==="add"){
			#judul
			$this->judul='<center>Tambah Auditor'.$toview['nama_auditor'].'</center>';
			#load view
			$this->content=$this->load->view('auditor/auditor_sertifikasi_add',$toview);
		}
	   	if($action==="view"){
			#judul
			$this->judul='<center>Daftar Auditor '.$toview['nama_auditor'].'</center>';
			#load view
			$this->content=$this->load->view('auditor/view_auditor_sertifikasi',$toview);
		}
		if($action==="edit"){
			#judul
			$this->judul='<center>Ubah Auditor '.$toview['nama_auditor'].'</center>';
			#load view
			$this->content=$this->load->view('auditor/auditor_sertifikasi_edit',$toview);
		}
		if($action==="del"){
			$tot=$this->mAuditor->deleteAuditor($kd_auditor);
			if($tot){
				redirect("auditor");
			}
			
		}
   }
  }
?>