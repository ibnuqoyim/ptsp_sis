<?php
class dokumen extends CI_Controller {
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
		$this->load->model('mTarif');
		$this->load->model('mDokumen');
		$this->load->model('mUser');
  	}

  	public function ItemDokumen($kd_sertifikasi_jenis='-',$nama_sertifikasi_jenis='-',$action='view',$ord='tgl_create',$srt='asc',$limit=30,$page=1){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		$this->errormsg="";
		if($kd_sertifikasi_jenis != '-') $toview['kd_sertifikasi_jenis']=$kd_sertifikasi_jenis; 
		else $toview['kd_sertifikasi_jenis']='';

	   	$result=$this->mTarif->getJenis($kd_sertifikasi_jenis);

		$toview['nama_sertifikasi_jenis']=GetInput($this->input->post('nama_sertifikasi_jenis'),$result?ucfirst($result->nama_sertifikasi_jenis):'');
		$toview['ord']=GetInput($this->input->post('ord'),$ord,'mst_sertifikasi_jenis.    tgl_create');
		$toview['srt']=GetSort($this->input->post('srt'),$srt,'asc');
		$toview['limit']=(int) $limit;
		if($toview['limit']<1){$toview['limit']=30;}
		$page=(int) @ereg_replace("[^0-9]",'',$page);
		
		#get result
		if($toview['kd_sertifikasi_jenis']) $toview['tot']=$this->mTarif->GetTotalJenis('',$toview['kd_sertifikasi_jenis']); 
		else $toview['tot']=$this->mTarif->GetTotalJenis($toview['nama_sertifikasi_jenis']);
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			if($toview['kd_sertifikasi_jenis']) {
				$toview['result']=$this->mTarif->GetResultJenis('',$toview['ord'],$toview['srt'],$toview['limit'],
				$toview['start'],$toview['kd_sertifikasi_jenis']); 
			}else{ 
				$toview['result']=$this->mTarif->GetResultJenis($toview['nama_sertifikasi_jenis'],$toview['ord'],
				$toview['srt'],$toview['limit'],$toview['start']);
			}
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		#set return url
		$toview['pageurl']='dokumen/ItemDokumen/-/-/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['kd_sertifikasi_jenis'])).'/-/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['nama_sertifikasi_jenis'])).'/';
		$toview['pageurl'].='view/';//$toview['action'].'/';
		$toview['ordurl']=$toview['pageurl']; //untuk sort
		$toview['pageurl'].=$toview['ord'].'/';
		$toview['pageurl'].=$toview['srt'].'/';
		$toview['limiturl']=$toview['pageurl']; //untuk limit
		$toview['pageurl'].=$toview['limit'].'/';
		$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);

		/*		
		$this->form_validation->set_rules('nama_sertifikasi_jenis', 'Nama Jenis Sertifikasi', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		
		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			$toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));
			$toview['nama_sertifikasi_jenis']=trim($this->input->post('nama_sertifikasi_jenis'));
			if($this->errormsg=="") { 
				$toview['tgl_create']=date("Y-m-d h:i:a");
				$toview['tgl_update']=date("Y-m-d h:i:a");
				$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				if($action=="edit") { 
					$jenistrf = $this->mTarif->getJenis($kd_sertifikasi_jenis);					
					$this->mTarif->SaveJenis($toview,$kd_sertifikasi_jenis,true);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Update Jenis Tarif");					
				} else {
					$toview['kd_sertifikasi_jenis']=$this->mTarif->Make_kd_sertifikasi_jenis();
					$this->mTarif->SaveJenis($toview,$toview['kd_sertifikasi_jenis'],false);
				}
				$this->errormsg='<em style="color:green">'.
				      $toview['nama_sertifikasi_jenis'].' Berhasil disimpan! <br><a href="index.php/tarif/InputTarif/'.
				      $toview['kd_sertifikasi_jenis'].'/-/-/-/add">Input Jenis '.ucfirst($toview['nama_sertifikasi_jenis']).'</a></em>';
			 		  $toview['kd_sertifikasi_jenis']='';
			 		  $toview['nama_sertifikasi_jenis']='';
			 		  $toview['nama_sertifikasi_jenis']='';
				if($action=="view") redirect(current_url());
			}
		  }
		}*/
		/*if($action==="add"){
			#judul
			$this->judul='<center>Tambah Dokumen Sertifikasi '.$toview['nama_sertifikasi_komoditi'].'</center>';
			#load view
			$this->content=$this->load->view('dokumen/item_dokumen_sertifikasi_add',$toview);
		}
	   	
		if($action==="edit"){

			$toview['kd_sertifikasi_dokumen']=@$kd_sertifikasi_dokumen;
			//$toview['nama_sertifikasi_dokumen']=''
			#judul
			//$this->judul='<center>Ubah Dokumen Sertifikasi '.$toview['nama_sertifikasi_dokumen'].'</center>';
			#load view
			$this->content=$this->load->view('dokumen/item_dokumen_sertifikasi_edit',$toview);
		}
		if($action==="del"){
			$tot=$this->mKomoditi->deleteKomoditi($kd_sertifikasi_komoditi);
			if($tot){
				redirect("dokumen/JenisSertifikasi");
			}
			
		}*/
	   	if($action==="view"){
			#judul
			$this->judul='<center>Daftar Dokumen Sertifikasi '.$toview['nama_sertifikasi_jenis'].'</center>';
			#load view
			$this->content=$this->load->view('dokumen/view_item_dokumen_sertifikasi',$toview);
		}
		
   }

   function addItemDokumen($kd_sertifikasi_jenis="",$kd_sertifikasi_jenistarif=""){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
			$toview['kd_sertifikasi_jenis']=$kd_sertifikasi_jenis;
			$toview['kd_sertifikasi_jenistarif']=$kd_sertifikasi_jenistarif;
			$toview['kd_sertifikasi_dokumen']='';
			$toview['nama_sertifikasi_dokumen']='';
			$toview['jenis_dokumen']='';
			
				
			$this->form_validation->set_rules('nama_sertifikasi_dokumen', 'Nama Sertifikas Dokumen', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');
			
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			
			if($this->input->post('save')){
		  		if($this->form_validation->run()){
					$toview['kd_sertifikasi_dokumen']=$this->mDokumen->Make_kd_sertifikasi_dokumen();

					$toview['nama_sertifikasi_dokumen']=trim($this->input->post('nama_sertifikasi_dokumen'));
					$toview['jenis_dokumen']=trim($this->input->post('jenis_dokumen'));
					$toview['kd_sertifikasi_jenistarif']=trim($this->input->post('kd_sertifikasi_jenistarif'));
					$toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));
					$toview['kd_satker']=trim($this->input->post('kd_satker'));

					if($this->errormsg=="") { 
						$toview['tgl_update']=date("Y-m-d h:i:a");
						$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;										
						$this->mDokumen->saveDokumen($toview,$kd_sertifikasi_dokumen,false);
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
							current_url(),"Add dokumen");					
						
						redirect('dokumen/itemDokumen');
					}
		 		 }
			}
			#load view
			$this->content=$this->load->view('dokumen/item_dokumen_sertifikasi_add',$toview);
		
	}

	function editItemDokumen($kd_sertifikasi_dokumen=''){
		
			$this->errormsg="";			
			
			#default value
			$result=$this->mDokumen->readDokumen($kd_sertifikasi_dokumen);
			if($result){
				
				$toview['kd_sertifikasi_dokumen']=$result->kd_sertifikasi_dokumen;
				$toview['nama_sertifikasi_dokumen']=$result->nama_sertifikasi_dokumen;
			    $toview['jenis_dokumen']=$result->jenis_dokumen;
			    $toview['kd_sertifikasi_jenistarif']=$result->kd_sertifikasi_jenistarif;
			    $toview['kd_sertifikasi_jenis']=$result->kd_sertifikasi_jenis;
			    $toview['kd_satker']=$result->kd_satker;

			    $this->judul='<center>Edit Item Dokumen '.$toview['nama_sertifikasi_dokumen'].'</center>';
				
			}
			
			$this->form_validation->set_rules('nama_sertifikasi_dokumen', 'Nama Sertifikas Dokumen', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');
			
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			
			if($this->input->post('save')){
		  		if($this->form_validation->run()){
					$toview['kd_sertifikasi_dokumen']=trim($this->input->post('kd_sertifikasi_dokumen'));
					$toview['nama_sertifikasi_dokumen']=trim($this->input->post('nama_sertifikasi_dokumen'));
					$toview['jenis_dokumen']=trim($this->input->post('jenis_dokumen'));
					$toview['kd_sertifikasi_jenistarif']=trim($this->input->post('kd_sertifikasi_jenistarif'));
					$toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));
					$toview['kd_satker']=trim($this->input->post('kd_satker'));


					if($this->errormsg=="") { 
						$toview['tgl_update']=date("Y-m-d h:i:a");
						$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;										
						$this->mDokumen->saveDokumen($toview,$kd_sertifikasi_dokumen,true);
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
							current_url(),"edit dokumen");	
						
						redirect('dokumen/itemDokumen');
					}
		 		 }
			}

			#load view
			$this->content=$this->load->view('dokumen/item_dokumen_sertifikasi_edit',$toview);
		
	}

	function delItemDokumen($kd_sertifikasi_dokumen=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		if($kd_sertifikasi_dokumen) $tot=$this->mDokumen->deleteDokumen($kd_sertifikasi_dokumen);
			if($tot){					
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Hapus Dokumen");
					$this->session->set_userdata('alert',$tot->kd_sertifikasi_dokumen.' dokumen telah di hapus');					
					redirect('dokumen/itemDokumen');
			}
		
  	}
  }
?>