<?php

class Tarif extends CI_Controller {
	var $userresult;
	var $searchbox='';
	var $javascript='';
	var $errormsg='';
	var $title='';
	var $content='';
	var $judul='Chalsy';
	var $footer='';
	var $subtitle1='';
	var $subheader1='';
	
   public function __construct() {
       parent::__construct();
		$this->load->helper('inputer');
		$this->load->model('mTarif');
		$this->load->model('mUser');
		//$this->load->model('mTarif');
		//$this->load->helper('tree');
		//$this->load->library('javascript');
		//$this->load->library('jquery', FALSE);
  }
   
  public function JenisSertifikasi($kd_sertifikasi_jenis='-',$nama_sertifikasi_jenis='-',
  	    $action='view',$ord='tgl_create',$srt='asc',$limit=30,$page=1){
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
		$toview['pageurl']='tarif/JenisSertifikasi/-/-/';
		#$toview['pageurl'].=SetAttr(rawurlencode($toview['kd_sertifikasi_jenis'])).'/-/';
		#$toview['pageurl'].=SetAttr(rawurlencode($toview['jenis_tarif'])).'/';
		$toview['pageurl'].='view/';//$toview['action'].'/';
		$toview['ordurl']=$toview['pageurl']; //untuk sort
		$toview['pageurl'].=$toview['ord'].'/';
		$toview['pageurl'].=$toview['srt'].'/';
		$toview['limiturl']=$toview['pageurl']; //untuk limit
		$toview['pageurl'].=$toview['limit'].'/';
		$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);
				
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
		}

	   	if($action==="add"){
			#judul
			$this->judul='<center>Tambah Jenis Sertifikasi '.$toview['nama_sertifikasi_jenis'].'</center>';
			#load view
			$this->content=$this->load->view('tarifpnbp/jenis_sertifikasi_add',$toview);
		}
	   	if($action==="view"){
			#judul
			$this->judul='<center>Daftar Jenis Sertifikasi '.$toview['nama_sertifikasi_jenis'].'</center>';
			#load view
			$this->content=$this->load->view('tarifpnbp/view_jenis_sertifikasi',$toview);
		}
		if($action==="edit"){
			#judul
			$this->judul='<center>Ubah Jenis Sertifikasi '.$toview['nama_sertifikasi_jenis'].'</center>';
			#load view
			$this->content=$this->load->view('tarifpnbp/jenis_sertifikasi_edit',$toview);
		}
		if($action==="del"){
			$tot=$this->mTarif->DeleteJenis($kd_sertifikasi_jenis);
			if($tot){
				redirect("tarif/JenisSertifikasi");
			}
			
		}
   }
   
   
   public function JenisTarif($kd_sertifikasi_jenis,$kd_sertifikasi_jenistarif ="-",$nama_jenistarif="-",$action="view",$ord='tgl_create',$srt='asc',$limit=30,$page=1){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_sertifikasi_jenis) $toview['kd_sertifikasi_jenis']=$kd_sertifikasi_jenis;
	   	$result=$this->mTarif->getJenis($toview['kd_sertifikasi_jenis']);

	   	$toview['nama_sertifikasi_jenis']=$result?ucfirst($result->nama_sertifikasi_jenis):'';
	   	$toview['nama_sertifikasi_jenis']=GetInput($this->input->post('nama_jenistarif'),$toview['nama_sertifikasi_jenis']);
	   	$toview['nama_jenistarif']=GetInput($this->input->post('nama_jenistarif'),$nama_jenistarif);
		$toview['nama_jenistarif']=GetInput($this->input->post('nama_jenistarif'),$nama_jenistarif);
		$toview['kd_sertifikasi_jenis']=GetInput($this->input->post('kd_sertifikasi_jenis'),$kd_sertifikasi_jenis);	
		$toview['kd_sertifikasi_jenistarif']=GetInput($this->input->post('kd_sertifikasi_jenistarif'),$kd_sertifikasi_jenistarif);	
		$toview['ord']=GetInput($this->input->post('ord'),$ord,'tgl_update');
		$toview['srt']=GetSort($this->input->post('srt'),$srt,'asc');
		$toview['limit']=(int) $limit;
		if($toview['limit']<1){$toview['limit']=30;}
		$page=(int) @ereg_replace("[^0-9]",'',$page);
		#get result
		$toview['tot']=$this->mTarif->GetTotalTarif('',$kd_sertifikasi_jenis);
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mTarif->GetResultTarif($toview['nama_jenistarif'],$toview['kd_sertifikasi_jenis'],$toview['ord'],
							  $toview['srt'],$toview['limit'],$toview['start']);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		#set return url
		$toview['pageurl']='tarif/JenisTarif/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['kd_sertifikasi_jenis'])).'/-/-/view/';
		$toview['ordurl']=$toview['pageurl']; //untuk sort
		$toview['pageurl'].=$toview['ord'].'/';
		$toview['pageurl'].=$toview['srt'].'/';
		$toview['limiturl']=$toview['pageurl']; //untuk limit
		$toview['pageurl'].=$toview['limit'].'/';
		$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);
		$result=$this->mTarif->getTarif($toview['kd_sertifikasi_jenistarif']);
		 if($result){
			 $toview['kd_sertifikasi_jenistarif']=$result->kd_sertifikasi_jenistarif;
			 $toview['nama_jenistarif']=$result->nama_jenistarif;
			 $toview['tgl_create']=$result->tgl_create;
			 $toview['tgl_update']=$result->tgl_update;
			 $toview['kd_satker']=$result->kd_satker;
		 } else {
			 $toview['kd_sertifikasi_jenistarif']='';
			 $toview['nama_jenistarif']='';
			 $toview['tgl_create']='';
			 $toview['tgl_update']='';
			 $toview['kd_satker']='';
			 $toview['kd_sertifikasi_jenis']='';
		 }
	   
	   	if($action==="view"){
			#judul
			$this->judul='<center>Daftar jenis Tarif '.$toview['nama_sertifikasi_jenis'];
			$this->searchbox=$this->load->view('tarifpnbp/searchbox-jenistarif_sertifikasi',$toview,true);
			$this->javascript=$this->load->view('tarifpnbp/javascript_jenistarif_sertifikasi_index',$toview,true);
	   		$this->load->view('tarifpnbp/view_jenistarif_sertifikasi',$toview);
	   }
	   if($action==="add" || $action==="edit"){
			if($action==="add"){
				$toview['nama_jenistarif']='';
				$this->judul='<center>Tambah Jenis Tarif '.$toview['nama_sertifikasi_jenis'].'</center>'; 
				#load view
				$this->content=$this->load->view('tarifpnbp/jenistarif_sertifikasi_add',$toview);
			}else{
				$this->judul='<center>Edit Jenis Tarif '.$toview['nama_jenistarif'].'</center>';
				#load view
				$this->content=$this->load->view('tarifpnbp/jenistarif_sertifikasi_edit',$toview);
			} 

			$this->form_validation->set_rules('nama_jenistarif', 'Nama Jenis Tarif Sertifikasi', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');		
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			
			if($action==="add"){
			 	$toview['nama_jenistarif']='';
			 	
			}
			if($this->input->post('save')){


				if($this->form_validation->run())
				{
					
					$toview['nama_jenistarif']=trim($this->input->post('nama_jenistarif'));
					$toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));
					$toview['tgl_update']=date("Y-m-d H:i:s");

					if($action==="add") {
						$toview['tgl_create']=date("Y-m-d H:i:s"); 
						$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
						$toview['kd_sertifikasi_jenistarif']=$this->mTarif->Make_kd_sertifikasi_jenistarif();
						$this->mTarif->SaveTarif($toview,$toview['kd_sertifikasi_jenistarif'],false); 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Jenis Tarif Baru");
						//$this->errormsg='<em style="color:green">'.$toview['nama_jenistarif'].' Berhasil disimpan! <br><a href="index.php/tarif/InputItem/'.$toview['kd_sertifikasi_jenis'].'/-/-/-/add">Input Item '.ucfirst($toview['nama_jenistarif']).'</a></em>';
						//$toview['nama_jenistarif']='';
						//redirect(current_url());
					} else { 
						$this->mTarif->SaveTarif($toview,$toview['kd_sertifikasi_jenistarif'],true); 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Update Jenis Tarif"); 
						///$toview['nama_jenistarif']='';
					}	
					$this->errormsg='<em style="color:green">'.$toview['nama_jenistarif'].' Berhasil disimpan! <br><a href="index.php/tarif/InputItem/'.$toview['kd_sertifikasi_jenis'].'/-/-/-/add">Input Item '.ucfirst($toview['nama_jenistarif']).'</a></em>';
						$toview['nama_jenistarif']='';
						//redirect(current_url());				
				}
			 }
			
	   }
	   if($action==="del"){
			$tot=$this->mTarif->DeleteTarif($kd_sertifikasi_jenistarif);
			if($tot){
				redirect("tarif/JenisTarif/".$kd_sertifikasi_jenis);
			}
	   }
   }
		
   public function InputItem($kd_sertifikasi_jenistarif,$kd_sertifikasi_jenistarifitem="-",$nama_sertifikasi_jenistarifitem="-",
   		$harga_sertifikasi_jenistarifitem="-",$satuan_sertifikasi_jenistarifitem='-',$keterangan1_jenistarifitem ="-",
   		$keterangan2_jenistarifitem ="-",$action="view",$ord='tgl_create',$srt='asc',$limit=30,$page=1){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_sertifikasi_jenistarif) $toview['kd_sertifikasi_jenistarif']=$kd_sertifikasi_jenistarif;
	   	
	    $result=$this->mTarif->getItem($toview['kd_sertifikasi_jenistarif']);
	   	
	  	$toview['nama_sertifikasi_jenistarifitem']=$result?ucfirst($result->nama_sertifikasi_jenistarifitem):'';
		$toview['nama_sertifikasi_jenistarifitem']=GetInput($this->input->post('nama_sertifikasi_jenistarifitem'),$toview['nama_sertifikasi_jenistarifitem']);
		$toview['kd_sertifikasi_jenistarifitem']=GetInput($this->input->post('kd_sertifikasi_jenistarifitem'),$kd_sertifikasi_jenistarifitem);
		$toview['nama_sertifikasi_jenistarifitem']=GetInput($this->input->post('nama_sertifikasi_jenistarifitem'),$nama_sertifikasi_jenistarifitem);
		$toview['harga_sertifikasi_jenistarifitem']=GetInput($this->input->post('harga_sertifikasi_jenistarifitem'),$harga_sertifikasi_jenistarifitem);	
		$toview['satuan_sertifikasi_jenistarifitem']=GetInput($this->input->post('satuan_sertifikasi_jenistarifitem'),$satuan_sertifikasi_jenistarifitem);	
		$toview['keterangan1_jenistarifitem']=GetInput($this->input->post('keterangan1_jenistarifitem'),$keterangan1_jenistarifitem );	
		$toview['keterangan2_jenistarifitem']=GetInput($this->input->post('keterangan2_jenistarifitem'),$keterangan2_jenistarifitem );	
	    
	  	$result1=$this->mTarif->getTarif($kd_sertifikasi_jenistarif,'',false);
	   	$toview['nama_jenistarif']=$result1?ucfirst($result1->nama_jenistarif):'';
	   	$toview['kd_sertifikasi_jenis']=$result1?ucfirst($result1->kd_sertifikasi_jenis):'';
		//$toview['kd_sertifikasi_jenistarif']=$result1?ucfirst($result2->kd_sertifikasi_jenistarif):'';

		
	   	$result2=$this->mTarif->getJenis($toview['kd_sertifikasi_jenis']);
	   	$toview['nama_sertifikasi_jenis']=$result2?ucfirst($result2->nama_sertifikasi_jenis):'';
	   	//$toview['kd_sertifikasi_jenis']=$result1?ucfirst($result2->kd_sertifikasi_jenis):'';



	   
		$toview['ord']=GetInput($this->input->post('ord'),$ord,'create');
		$toview['srt']=GetSort($this->input->post('srt'),$srt,'asc');
		$toview['limit']=(int) $limit;
		if($toview['limit']<1){$toview['limit']=30;}
		$page=(int) @ereg_replace("[^0-9]",'',$page);

		#get result
		$toview['tot']=$this->mTarif->GetTotalItem($toview['nama_sertifikasi_jenistarifitem'],$toview['harga_sertifikasi_jenistarifitem'],
						$toview['satuan_sertifikasi_jenistarifitem'],$toview['keterangan1_jenistarifitem'],$toview['keterangan2_jenistarifitem'],
						$toview['kd_sertifikasi_jenistarif']);
		//echo $toview['tot'];
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mTarif->GetResultItem($toview['nama_sertifikasi_jenistarifitem'],$toview['harga_sertifikasi_jenistarifitem'],
						$toview['satuan_sertifikasi_jenistarifitem'],$toview['keterangan1_jenistarifitem'],$toview['keterangan2_jenistarifitem'],
						$toview['kd_sertifikasi_jenistarif'],$toview['ord'],$toview['srt'],$toview['limit'],$toview['start']);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		#set return url
		$toview['pageurl']='tarif/InputItem/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['kd_sertifikasi_jenistarif'])).'/-/-/-/-/-/-/view/';
		$toview['ordurl']=$toview['pageurl']; //untuk sort
		$toview['pageurl'].=$toview['ord'].'/';
		$toview['pageurl'].=$toview['srt'].'/';
		$toview['limiturl']=$toview['pageurl']; //untuk limit
		$toview['pageurl'].=$toview['limit'].'/';
		$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);

		$result=$this->mTarif->getItem($toview['kd_sertifikasi_jenistarifitem']);
		 if($result){
			 $toview['nama_sertifikasi_jenistarifitem']=$result->nama_sertifikasi_jenistarifitem;
			 $toview['harga_sertifikasi_jenistarifitem']=$result->harga_sertifikasi_jenistarifitem;
			 $toview['satuan_sertifikasi_jenistarifitem']=$result->satuan_sertifikasi_jenistarifitem;
			 $toview['keterangan1_jenistarifitem']=$result->keterangan1_jenistarifitem;
			 $toview['keterangan2_jenistarifitem']=$result->keterangan2_jenistarifitem;
			 $toview['tgl_create']=$result->tgl_create;
			 $toview['tgl_update']=$result->tgl_update;
			 $toview['kd_satker']=$result->kd_satker;
		 }else{
		 	 	$toview['kd_sertifikasi_jenistarifitem']='';
			 	$toview['nama_sertifikasi_jenistarifitem']='';
			 	$toview['harga_sertifikasi_jenistarifitem']='';
			 	$toview['satuan_sertifikasi_jenistarifitem']='';
			 	$toview['keterangan1_jenistarifitem']='';
			 	$toview['keterangan2_jenistarifitem']='';
			 	$toview['tgl_create']='';
			 	$toview['tgl_update']='';
			 	$toview['kd_satker']='';
		 } 
	   
	   	if($action==="view"){
			#judul
			//$toview['kd_sertifikasi_jenis']=$kd_sertifikasi_jenis;
			//$toview['kd_sertifikasi_jenistarif']=$kd_sertifikasi_jenistarif;
			$this->judul='<center>Daftar Jenis Item '.$toview['nama_jenistarif'].'</center>';
			$this->searchbox=$this->load->view('tarifpnbp/searchbox-item_sertifikasi',$toview,true);
			$this->javascript=$this->load->view('tarifpnbp/javascript_item_sertifikasi_index',$toview,true);
	   		$this->load->view('tarifpnbp/view_item_sertifikasi',$toview);
	   	}
	   	if($action==="detail"){
			#judul
			$this->judul='Detail Item '.$toview['nama_jenistarif'];
	   		$this->load->view('tarifpnbp/item_sertifikasi_detail',$toview);
	   	}



	   if($action==="add" || $action==="edit"){
			if($action==="add"){
				$this->judul='Tambah Item '.$toview['nama_jenistarif'];
				$toview['kd_sertifikasi_jenistarifitem']='';
			 	$toview['nama_sertifikasi_jenistarifitem']='';
			 	$toview['harga_sertifikasi_jenistarifitem']='';
			 	$toview['satuan_sertifikasi_jenistarifitem']='';
			 	$toview['keterangan1_jenistarifitem']='';
			 	$toview['keterangan2_jenistarifitem']='';
			 	$toview['kd_sertifikasi_jenistarif']=$kd_sertifikasi_jenistarif;
			 	//$toview['kd_sertifikasi_jenis']=$result1->kd_sertifikasi_jenis;
			 	$toview['tgl_create']='';
			 	$toview['tgl_update']='';
			 	$toview['kd_satker']='';
				#load view
				$this->content=$this->load->view('tarifpnbp/item_sertifikasi_add',$toview);
			}else{
				$this->judul='Ubah Item '.$toview['nama_jenistarif'];
				#load view
				$this->content=$this->load->view('tarifpnbp/item_sertifikasi_edit',$toview);
			}
			$this->form_validation->set_rules('nama_sertifikasi_jenistarifitem', 'nama Item', 'required');
			$this->form_validation->set_rules('harga_sertifikasi_jenistarifitem', 'Harga Satuan', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');			
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
						
			if($this->input->post('save')){
				if($this->form_validation->run())
				{
					$toview['kd_sertifikasi_jenistarifitem']=trim($this->input->post('kd_sertifikasi_jenistarifitem'));
					$toview['nama_sertifikasi_jenistarifitem']=trim($this->input->post('nama_sertifikasi_jenistarifitem'));																
					$toview['harga_sertifikasi_jenistarifitem']=trim($this->input->post('harga_sertifikasi_jenistarifitem'));
					$toview['satuan_sertifikasi_jenistarifitem']=(trim($this->input->post('satuan_sertifikasi_jenistarifitem')))?
											$this->input->post('satuan_sertifikasi_jenistarifitem'):'Not Specified';
					$toview['keterangan1_jenistarifitem']=trim($this->input->post('keterangan1_jenistarifitem'));
					$toview['keterangan2_jenistarifitem']=trim($this->input->post('keterangan2_jenistarifitem'));								
					$toview['kd_sertifikasi_jenistarif']=trim($this->input->post('kd_sertifikasi_jenistarif'));
					$toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));
					$toview['tgl_update']=date("Y-m-d H:i:s");
					$this->errormsg=="";
					if($action==="add") {
						if($this->mTarif->getItem($kd_sertifikasi_jenistarif)){ 
							#jika kode parameter telah ada
							$this->errormsg='<em style="color:red">Kode Parameter sudah ada! Silahkan coba lagi.</em>';
						}
						if($this->errormsg=="") { 
							$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
							$toview['tgl_create']=date("Y-m-d H:i:s"); 
							$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
							$toview['kd_sertifikasi_jenistarifitem']=$this->mTarif->Make_kd_item();
							$this->mTarif->SaveItem($toview,$toview['kd_sertifikasi_jenistarifitem'],false); 
							$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Item Baru");
						}
						
						$toview['kd_sertifikasi_jenistarifitem']='';
						$toview['nama_sertifikasi_jenistarifitem']='';
						$toview['harga_sertifikasi_jenistarifitem']='';
						$toview['satuan_sertifikasi_jenistarifitem']='Not Specified';
						$toview['keterangan1_jenistarifitem']='';
						$toview['keterangan2_jenistarifitem']='';
						//redirect(current_url());
					} else { 
						$this->errormsg='<em style="color:green">Berhasil Update!</em>';
						$this->mTarif->SaveItem($toview,$toview['kd_sertifikasi_jenistarifitem'],true);
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Update Item");
						//redirect(current_url());
					}
					
				}
			 }
			
			
	   }
	   if($action==="del"){
			$tot=$this->mTarif->DeleteItem($kd_sertifikasi_jenistarifitem);
			
			if($tot){
				redirect("tarif/InputItem/".$kd_sertifikasi_jenistarif);
			}
	   }

	   $this->javascript .='<script type="text/javascript">
    		 			$(document).ready(function(){
       		 				$("textarea.tinymcenpar").tinymce({
            						// Location of TinyMCE script
            						script_url : "<?=base_url()?>js/tiny_mce/tiny_mce.js",
							mode : "textareas",
							theme : "advanced",
							plugins : "visualchars",							
							// Theme options
							theme_advanced_buttons1 : "sub,sup,|,charmap",
							force_p_newlines : false,
							force_br_newlines : true,
							forced_root_block : "",
							
				
        					});
    					}); 
	  		 </script>';
   }

	

    public function readUser() {
        echo json_encode( $this->staff->getStaff() );
    }

	public function comments()
	{
		echo 'Look at this!';
	}
	
}
?>
