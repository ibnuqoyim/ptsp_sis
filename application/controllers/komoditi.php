<?php
class komoditi extends CI_Controller {
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
		$this->load->model('mKomoditi');
		$this->load->model('mUser');
  	}

  	public function index($kd_sertifikasi_komoditi='-',$no_sertifikasi_komoditi='-',$nama_sertifikasi_komoditi='-',
  		$action='view',$ord='tgl_create',$srt='desc',$limit=30,$page=1){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		$this->errormsg="";
		if($kd_sertifikasi_komoditi != '-') $toview['kd_sertifikasi_komoditi']=$kd_sertifikasi_komoditi; 
		else $toview['kd_sertifikasi_komoditi']='';

	   	$result=$this->mKomoditi->readKomoditi($kd_sertifikasi_komoditi);

	   	if($result){
	   		$toview['no_sertifikasi_komoditi']=GetInput($this->input->post('no_sertifikasi_komoditi'),$result?ucfirst($result->no_sertifikasi_komoditi):'');
	   		$toview['nama_sertifikasi_komoditi']=GetInput($this->input->post('nama_sertifikasi_komoditi'),$result?ucfirst($result->nama_sertifikasi_komoditi):'');
	   		$toview['tipe_sertifikasi_komoditi']=GetInput($this->input->post('tipe_sertifikasi_komoditi'),$result?ucfirst($result->tipe_sertifikasi_komoditi):'');
	   		/*$toview['no_sertifikasi_komoditi']=$result->no_sertifikasi_komoditi;
			$toview['nama_sertifikasi_komoditi']=$result->nama_sertifikasi_komoditi;
			$toview['tipe_sertifikasi_komoditi']=$result->tipe_sertifikasi_komoditi;*/
		}else{
			$toview['no_sertifikasi_komoditi']='';
			$toview['nama_sertifikasi_komoditi']='';
			$toview['tipe_sertifikasi_komoditi']='';
		}
		
		$toview['ord']=GetInput($this->input->post('ord'),$ord,'mst_sertifikasi_komoditi.tgl_create');
		$toview['srt']=GetSort($this->input->post('srt'),$srt,'desc');
		$toview['limit']=(int) $limit;
		if($toview['limit']<1){$toview['limit']=30;}
		$page=(int) @ereg_replace("[^0-9]",'',$page);
		
		#get result
		if($toview['kd_sertifikasi_komoditi'])
			 $toview['tot']=$this->mKomoditi->getTotalKomoditi('',$toview['kd_sertifikasi_komoditi']); 
		else $toview['tot']=$this->mKomoditi->getTotalKomoditi($toview['no_sertifikasi_komoditi']);
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			if($toview['kd_sertifikasi_komoditi']) {
				$toview['result']=$this->mKomoditi->getResultKomoditi('','',$toview['ord'],$toview['srt'],$toview['limit'],
								$toview['start'],$toview['kd_sertifikasi_komoditi']); 
			}else{ 
				$toview['result']=$this->mKomoditi->getResultKomoditi($toview['no_sertifikasi_komoditi'],'',$toview['ord'],
								$toview['srt'],$toview['limit'],$toview['start']);
			}
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		#set return url
		$toview['pageurl']='komoditi/index/-/-/-/';
		//$toview['pageurl'].=SetAttr(rawurlencode($toview['kd_sertifikasi_komoditi'])).'/-/';
		//$toview['pageurl'].=SetAttr(rawurlencode($toview['no_sertifikasi_komoditi'])).'/';
		//$toview['pageurl'].=SetAttr(rawurlencode($toview['nama_sertifikasi_komoditi'])).'/';
		$toview['pageurl'].='view/';//$toview['action'].'/';
		$toview['ordurl']=$toview['pageurl']; //untuk sort
		$toview['pageurl'].=$toview['ord'].'/';
		$toview['pageurl'].=$toview['srt'].'/';
		$toview['limiturl']=$toview['pageurl']; //untuk limit
		$toview['pageurl'].=$toview['limit'].'/';
		$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);
				
		$this->form_validation->set_rules('no_sertifikasi_komoditi', 'No. SNI Komoditi', 'required');
		$this->form_validation->set_rules('nama_sertifikasi_komoditi', 'Nama Komoditi', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');

		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			$toview['kd_sertifikasi_komoditi']=trim($this->input->post('kd_sertifikasi_komoditi'));
			$toview['no_sertifikasi_komoditi']=trim($this->input->post('no_sertifikasi_komoditi'));
			$toview['nama_sertifikasi_komoditi']=trim($this->input->post('nama_sertifikasi_komoditi'));
			$toview['tipe_sertifikasi_komoditi']=trim($this->input->post('tipe_sertifikasi_komoditi'));

			if($this->errormsg=="") { 
				$toview['tgl_create']=date("Y-m-d h:i:a");
				$toview['tgl_update']=date("Y-m-d h:i:a");
				$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				if($action=="edit") { 
					$komoditi = $this->mKomoditi->getKomoditi($kd_sertifikasi_komoditi);					
					$this->mKomoditi->saveKomoditi($toview,$kd_sertifikasi_komoditi,true);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Update Komoditi");					
				} else {
					$toview['kd_sertifikasi_komoditi']=$this->mKomoditi->Make_kd_sertifikasi_komoditi();
					$this->mKomoditi->saveKomoditi($toview,$toview['kd_sertifikasi_komoditi'],false);
				}
				$this->errormsg='<em style="color:green">'.
				$toview['nama_sertifikasi_komoditi'].' Berhasil disimpan! <br><a href="index.php/Komoditi/inputKomodoti/'.
				$toview['kd_sertifikasi_komoditi'].'/-/-/-/add">Input Jenis '.ucfirst($toview['nama_sertifikasi_komoditi']).'</a></em>';
			 	$toview['no_sertifikasi_komoditi']='';
			 	$toview['nama_sertifikasi_komoditi']='';
			 	$toview['tipe_sertifikasi_komoditi']='';
				if($action=="view") redirect(current_url());
			}
		  }
		}

	   	if($action==="add"){
			#judul
			$this->judul='<center>Tambah Komoditi '.$toview['nama_sertifikasi_komoditi'].'</center>';
			#load view
			$this->content=$this->load->view('komoditi/komoditi_sertifikasi_add',$toview);
		}
	   	if($action==="view"){
			#judul
			$this->judul='<center>Daftar Komoditi '.$toview['nama_sertifikasi_komoditi'].'</center>';
			#load view
			$this->content=$this->load->view('komoditi/view_komoditi_sertifikasi',$toview);
		}
		if($action==="edit"){
			#judul
			$this->judul='<center>Ubah Komoditi '.$toview['nama_sertifikasi_komoditi'].'</center>';
			#load view
			$this->content=$this->load->view('komoditi/komoditi_sertifikasi_edit',$toview);
		}
		if($action==="del"){
			$tot=$this->mKomoditi->deleteKomoditi($kd_sertifikasi_komoditi);
			if($tot){
				redirect("komoditi/index");
			}
			
		}
   }
  }
?>