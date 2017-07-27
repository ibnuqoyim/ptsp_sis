<?php

class Customer extends CI_Controller {
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
		$this->load->helper('date');
 		$this->load->helper('email');
		$this->load->model('mCustomer');
 		$this->load->model('mUser');
		$this->load->model('mTarif');
  }
		
	function index($nama='-',$kota='-',$kd_tipe_customer='-',$kd_subtipe_customer='-',$kd_satker='-',$ord='customer.tgl_create',$srt='desc',$limit=30,$page=1){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		//if($this->session->userdata('profil')->groupname=='super'){
			$toview['nama']=GetInput($this->input->post('nama'),$nama);
			$toview['kota']=GetInput($this->input->post('kota'),$kota);
			$toview['kd_tipe_customer']=GetInput($this->input->post('kd_tipe_customer'),$kd_tipe_customer);
			$toview['kd_subtipe_customer']=GetInput($this->input->post('kd_subtipe_customer'),$kd_subtipe_customer);
			$toview['kd_satker']=GetInput($this->input->post('kd_satker'),$kd_satker);
			$toview['ord']=GetInput($this->input->post('ord'),$ord,'customer.tgl_create');
			$toview['srt']=GetSort($this->input->post('srt'),$srt,'desc');
			$toview['limit']=(int) $limit;
			if($toview['limit']<1){$toview['limit']=30;}
			$page=(int) @ereg_replace("[^0-9]",'',$page);
			#get result
			$toview['tot']=$this->mCustomer->GetTotal($toview['nama'],$toview['kota'],
					$toview['kd_tipe_customer'],$toview['kd_satker']);
			/*echo "<script language=\"javascript\">alert('".$toview['tot']."')</script>";*/
			if($toview['tot']>0){
				$toview['pages']=ceil($toview['tot']/$toview['limit']);
				if(!is_numeric($page)){$toview['page']=1;}
				elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
				else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['result']=$this->mCustomer->GetResult($toview['nama'],$toview['kota'],
					$toview['kd_tipe_customer'],$toview['kd_subtipe_customer'],$toview['kd_satker'],
					$toview['ord'],$toview['srt'],
					$toview['limit'],$toview['start']);
			} else {
				$toview['pages']=0;
				$toview['page']=0;
				$toview['start']=0;
				$toview['result']=false;
			}
			#set return url
			$toview['pageurl']='customer/index/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['nama'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['kota'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['kd_tipe_customer'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['kd_subtipe_customer'])).'/';
			$toview['pageurl'].=SetAttr(rawurlencode($toview['kd_satker'])).'/';
			$toview['ordurl']=$toview['pageurl']; //untuk sort
			$toview['pageurl'].=$toview['ord'].'/';
			$toview['pageurl'].=$toview['srt'].'/';
			$toview['limiturl']=$toview['pageurl']; //untuk limit
			$toview['pageurl'].=$toview['limit'].'/';
			$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);
			#judul
			$this->judul='Daftar Customer';
			#load view
			$this->searchbox=$this->load->view('customer/searchbox-customer',$toview,true);
			$this->javascript='';//$this->load->view('customer/javascript_customer_index',$toview,true);
			if($this->session->flashdata('cetak') || $this->session->flashdata('xls')){
				$this->content=$this->load->view('cetak/print_view_customer',$toview);
			} else {
				$this->content=$this->load->view('customer/view_customer',$toview);
			}
			//$this->load->view('customer/viewadmin');
		/*} else {
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}*/
	}
	
	function view($kd_customer=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
			#default value
			$result=$this->mCustomer->getDetail($kd_customer);
			$this->judul='View Customer';
			if($result===false){
				$toview['kd_customer']='';
				$toview['nama']='';
				$toview['alamat']='';
				$toview['alamat_pabrik']='';
				$toview['email']='';
				$toview['website']='';
				$toview['contact_person1']='';
				$toview['contact_person2']='';
				$toview['contact_person3']='';
				$toview['contact_person4']='';
				$toview['contact_person5']='';
				$toview['jml_karyawan']='';
				$toview['kapasitas_produksi_total']='';
				$toview['market_area']='';
				$toview['tahun_pendirian']='';
				$toview['telepon']='';
				$toview['fax']='';
				$toview['negara']='';
				$toview['kota']='';
				$toview['nama_kota']='';
				$toview['propinsi']='';
				$toview['kd_satker']='';
				$toview['kd_tipe_customer']='';
				$toview['kd_subtipe_customer']='';
			} else {
				$toview['kd_customer']=$result->kd_customer;
				$toview['nama']=$result->nama;
				$toview['alamat']=$result->alamat;
				$toview['alamat_pabrik']=$result->alamat_pabrik;
				$toview['email']=$result->email;
				$toview['website']=$result->website;
				$toview['contact_person1']=$result->contact_person1;
				$toview['contact_person2']=$result->contact_person2;
				$toview['contact_person3']=$result->contact_person3;
				$toview['contact_person4']=$result->contact_person4;
				$toview['contact_person5']=$result->contact_person5;
				$toview['jml_karyawan']=$result->jml_karyawan;
				$toview['kapasitas_produksi_total']=$result->kapasitas_produksi_total;
				$toview['market_area']=$result->market_area;
				$toview['tahun_pendirian']=$result->tahun_pendirian;
				$toview['telepon']=$result->telepon;
				$toview['fax']=$result->fax;
				$toview['negara']=$result->negara;
				$toview['nama_kota']=$result->nama_kota;
				$toview['kota']=$result->kota;
				$toview['propinsi']=$result->nama_propinsi;
				$toview['kd_satker']=$result->kd_satker;
				$toview['kd_tipe_customer']=$result->kd_tipe_customer;
				$toview['kd_subtipe_customer']=$result->kd_subtipe_customer;
				$toview['tgl_create']=$result->tgl_create;
				$toview['tgl_update']=$result->tgl_update;
			}
		$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
		#get result
		$toview['tot']=$this->mCustomer->GetTotalDetailKomoditi($toview['kd_customer'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mCustomer->GetResultDetailKomoditi($toview['kd_customer'],'','kd_komoditi','desc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}			
			$this->content=$this->load->view('customer/view_customer_rinci',$toview);
	}

	function add($without_header=false){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
			#return url
			if($this->session->userdata('profil')->groupname=='super'){
				if(!$this->session->userdata('returnurl')){$this->session->set_userdata('returnurl','customer');}
				elseif(!preg_match("|^customer/index/.*$|",$this->session->userdata('returnurl'))){
				$this->session->set_userdata('returnurl','customer');}
			} else {
				$this->session->set_userdata('returnurl',$this->session->userdata('profil')->groupname);
			}
			$this->judul='Tambah Customer';
			#set return url
			$toview['pageurl']='customer';
			$this->session->set_userdata('returnurl',$toview['pageurl']);
			
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required');
			//$this->form_validation->set_rules('kota', 'Kota', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');
			
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			
			if($this->input->post('save')){
				if($this->form_validation->run())
				{
					$prenama=($this->input->post('prenama')!="def")?", ".$this->input->post('prenama'):"";
					$pascanama=($this->input->post('pascanama')!="def")?", ".$this->input->post('pascanama'):"";
					$toview['nama']=trim($this->input->post('nama')).$prenama.$pascanama;
					$toview['alamat']=trim($this->input->post('alamat'));
	                                $toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
					$toview['email']=trim($this->input->post('email'));
					$toview['website']=trim($this->input->post('website'));
					$toview['contact_person1']=trim($this->input->post('contact_person1'));
					$toview['contact_person2']=trim($this->input->post('contact_person2'));
					$toview['contact_person3']=trim($this->input->post('contact_person3'));
					$toview['contact_person4']=trim($this->input->post('contact_person4'));
					$toview['contact_person5']=trim($this->input->post('contact_person5'));
					$toview['jml_karyawan']=trim($this->input->post('jml_karyawan'));
					$toview['kapasitas_produksi_total']=trim($this->input->post('kapasitas_produksi_total'));
					$toview['market_area']=trim($this->input->post('market_area'));
					$toview['tahun_pendirian']=trim($this->input->post('tahun_pendirian'));
					$toview['telepon']=trim($this->input->post('telepon'));
					$toview['fax']=trim($this->input->post('fax'));
					$toview['kd_negara']=$this->input->post('kd_negara');
					$toview['kota']=trim($this->input->post('kota'));
					$toview['propinsi']=$this->input->post('propinsi');
					$toview['tgl_create']=date("Y-m-d H:i:s");
					$toview['tgl_update']=date("Y-m-d H:i:s");
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
					$toview['kd_tipe_customer']=trim($this->input->post('kd_tipe_customer'));
					if($this->input->post('subtipe')!=="") 
						$toview['kd_subtipe_customer']=trim($this->input->post('subtipe'));
					if($this->errormsg=="") { 
						$kodene=$this->mCustomer->Make_kd_customer();
						$toview['kd_customer']=$kodene;
						$this->mCustomer->Save($toview,'',false);
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
							current_url(),"Simpan Customer Baru");
						$this->errormsg='<em style="color:green"><a href="index.php/customer/view/'.$kodene.'">'.
       						$toview['nama'].'</a> Berhasil disimpan!</em>';
						redirect('customer/DetailKomoditi/'.$toview['kd_customer']);
					}
				}
			}
			$toview['kd_customer']='';
			$toview['nama']='';
			$toview['alamat']='';
			$toview['alamat_pabrik']='';
			$toview['email']='';
			$toview['website']='';
			$toview['contact_person1']='';
			$toview['contact_person2']='';
			$toview['contact_person3']='';
			$toview['contact_person4']='';
			$toview['contact_person5']='';
			$toview['jml_karyawan']='';
			$toview['kapasitas_produksi_total']='';
			$toview['market_area']='';
			$toview['tahun_pendirian']='';
			$toview['telepon']='';
			$toview['fax']='';
			$toview['kd_negara']='102';
			$toview['kota']='';
			$toview['propinsi']='';
			$toview['kd_satker']='';
			$toview['kd_tipe_customer']='';
			$toview['kd_subtipe_customer']='';
			$this->javascript='
			<style>
 				.ui-datepicker-calendar {display: none;}
				.ui-datepicker-month { display:none; }
				.ui-datepicker-prev { display:none;}
				.ui-datepicker-next { display:none; }
				.ui-datepicker thead { display:none; }
				button.ui-datepicker-current {display: none;}​
			</style>
			<script type="text/javascript">
		
			$(function () {  
            			$("#tahun_pendirian").datepicker(  
       				{   
           				changeYear: true, 
					yearRange: "1900:2050", 
           				showButtonPanel: true,  
           				dateFormat: "yy", 
					//appendText: "(format: yyyy)",
					showOn: "both",	 
           				onClose: function (dateText, inst) { 
               					var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();  
               					$(this).datepicker("setDate", new Date(year, 1, 1));  
  
           				}  
       				});  
            			$("tahun_pendirian.ClientID").click(function () {  
                			$(".ui-datepicker-calendar").hide(); 
					
            			});  
        		}); 
			
			</script>';
			#load view
			if($without_header){
				$this->load->view('customer/customer_add',$toview);
			} else {
				$this->load->view('view_header');
				$this->content=$this->load->view('customer/customer_add',$toview);
				$this->load->view('view_footer');
			}
			//$this->load->view('viewadmin',$toview);
	}
	public function DetailKomoditi($kd_customer='',$kd_komoditi=''){
	   	$this->errormsg=""; $this->listKomoditi=""; $this->list_customer="";
           	$counter=0;
	   	if($kd_customer) $toview['kd_customer']=$kd_customer;	   
	   	if($kd_komoditi) $toveiw['kd_komoditi']='';

	   	$toview['nama_komoditi']='';
		$toview['tipe_komoditi']='';
	   	$toview['brand_komoditi']='';
	   	$toview['kapasitas_produksi']='';
		$toview['kd_satker']=''; 
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	#get result
		$toview['tot']=$this->mCustomer->GetTotalDetailKomoditi($toview['kd_customer'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mCustomer->GetResultDetailKomoditi($toview['kd_customer'],'','kd_komoditi','desc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		
		$this->form_validation->set_rules('nama_komoditi', 'Nama Komoditi', 'required');
		$this->form_validation->set_rules('brand_komoditi', 'Brand Komoditi', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');
		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		//echo "<script>alert('test save ? ')</script>";
		if($this->input->post('save')){
		  //echo "<script>alert('test input save true'".trim($this->input->post('save')).")</script>";
		  if($this->form_validation->run())
		  {
			//echo "<script>alert('test for falidasi true')</script>";
			if($this->input->post('tambah')){
				//echo "<script>alert('test for input post tambah true')</script>";
				if($this->errormsg=="") { 
				        //echo "<script>alert('test no error message true')</script>";
					$toview['kd_customer']=$kd_customer;
				   	$toview['nama_komoditi']=trim($this->input->post('nama_komoditi'));
					$toview['tipe_komoditi']=trim($this->input->post('tipe_komoditi'));
				   	$toview['brand_komoditi']=trim($this->input->post('brand_komoditi'));
				  	$toview['kapasitas_produksi']=trim($this->input->post('kapasitas_produksi'));
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
					$toview['kd_komoditi']=$this->mCustomer->Make_kd_komoditi_customer();
									
					$hasil=$this->mCustomer->SaveKomoditi($toview,$toview['kd_customer'],false); 
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Detail Komoditi Customer");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						/*echo "<script>alert('Berhasil disimpan')</script>";*/
						redirect('customer/DetailKomoditi/'.$toview['kd_customer']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						/*echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";*/
						redirect(current_url());
					}
				}else{echo "<script>alert(".$this->errormsg."')</script>";}
				
			  }
		  }
		}//else  echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>";
		
		#judul
		$this->judul='Detail Komoditi Customer';
		
		#load view
		$this->content=$this->load->view('customer/customer_detail',$toview);	
	}
	public function editDetailKomoditi($kd_customer,$kd_komoditi){
	   	$this->errormsg=""; $this->listKomoditi=""; $this->list_customer="";
           	$counter=0;
		$detailKomoditi=$this->mCustomer->GetDetailKomoditi('',$kd_komoditi);

	   	$toview['kd_customer']=$detailKomoditi->kd_customer;	   
	   	if($kd_komoditi) $toveiw['kd_komoditi']=$kd_komoditi;
	   	$toview['nama_komoditi']=$detailKomoditi->nama_komoditi;
		$toview['tipe_komoditi']=$detailKomoditi->tipe_komoditi;
	   	$toview['brand_komoditi']=$detailKomoditi->brand_komoditi;
	   	$toview['kapasitas_produksi']=$detailKomoditi->kapasitas_produksi;
		$toview['kd_satker']=$detailKomoditi->kapasitas_produksi; 
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	#get result
		$toview['tot']=$this->mCustomer->GetTotalDetailKomoditi($toview['kd_customer'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mCustomer->GetResultDetailKomoditi($toview['kd_customer'],'','kd_komoditi','desc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		
		$this->form_validation->set_rules('nama_komoditi', 'Nama Komoditi', 'required');
		$this->form_validation->set_rules('brand_komoditi', 'Brand Komoditi', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');
		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		//echo "<script>alert('test save ? ')</script>";
		if($this->input->post('save')){
		  //echo "<script>alert('test input save true'".trim($this->input->post('save')).")</script>";
		  if($this->form_validation->run())
		  {
			//echo "<script>alert('test for falidasi true')</script>";
			if($this->input->post('tambah')){
				//echo "<script>alert('test for input post tambah true')</script>";
				if($this->errormsg=="") { 
				        //echo "<script>alert('test no error message true')</script>";
					$toview['kd_customer']=$kd_customer;
				   	$toview['nama_komoditi']=trim($this->input->post('nama_komoditi'));
					$toview['tipe_komoditi']=trim($this->input->post('tipe_komoditi'));
				   	$toview['brand_komoditi']=trim($this->input->post('brand_komoditi'));
				  	$toview['kapasitas_produksi']=trim($this->input->post('kapasitas_produksi'));
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;

					$toview['kd_komoditi']=$kd_komoditi;
									
					$hasil=$this->mCustomer->SaveKomoditi($toview,$toview['kd_customer'],true); 
					redirect('customer/DetailKomoditi/'.$toview['kd_customer']);
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Detail Komoditi Customer");
						$this->errormsg='<em style="color:green">Berhasil Edit!</em>';
						//echo "<script>alert('Berhasil diupdate')</script>";
						//redirect('customer/DetailKomoditi/'.$toview['kd_customer']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Edit gagal boss!</em>';
						//echo "<script>alert('Maaf, Update gagal boss!')</script>";
						redirect(current_url());
					}
					//echo "<script>alert('testku')</script>";
	
				}else{
					//echo "<script>alert(".$this->errormsg."')</script>";
				}
				
			  }
		  }
		}//else  echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>";
		
		#judul
		$this->judul='Detail Komoditi Customer';
		
		#load view
		$this->content=$this->load->view('customer/customer_detail',$toview);	
	}
	
	function delDetailKomoditi($kd_customer='',$kd_komoditi=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
			if($kd_customer) $tot=$this->mCustomer->DeleteDetailKomoditi($kd_komoditi);			
			$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Hapus Customer");
			$this->session->set_userdata('alert',$tot.' komoditi telah di hapus');
			$returnurl=$this->session->userdata('returnurl');
			if(!$returnurl){$returnurl='customer/DetailKomoditi/'.$kd_customer;}
			elseif(!preg_match("|^customer/index/.*$|",$returnurl)){$returnurl='customer/DetailKomoditi/'.$kd_customer;}
			redirect($returnurl);
	}

	function del($kd_customer=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
			if($kd_customer) $tot=$this->mCustomer->DeleteCustomer($kd_customer);
			/*$arrkd_customer=$this->input->post('kd_customer');
			$tot=0;
			if(!empty($arrkd_customer) && is_array($arrkd_customer)){
				foreach($arrkd_customer as $kd_customer){
					$kd_customer=trim($kd_customer);
					if($kd_customer && $kd_customer!=$this->session->userdata('kd_customer')){
					$tot+=$this->mCustomer->DeleteCustomer($kd_customer);}
				}
			}*/
			$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Hapus Customer");
			$this->session->set_userdata('alert',$tot.' pelanggan telah di hapus');
			$returnurl=$this->session->userdata('returnurl');
			if(!$returnurl){$returnurl='customer';}
			elseif(!preg_match("|^customer/index/.*$|",$returnurl)){$returnurl='customer';}
			redirect($returnurl);
	}
	
	function edit($kd_customer=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
			$this->errormsg="";
			$kd_customer=($kd_customer=='')?$this->session->userdata('kd_customer'):$kd_customer;
			#return url
			if($this->session->userdata('profil')->groupname=='super'){
				if(!$this->session->userdata('returnurl')){$this->session->set_userdata('returnurl','customer');}
				elseif(!preg_match("|^customer/index/.*$|",$this->session->userdata('returnurl'))){
				$this->session->set_userdata('returnurl','customer');}
			} else {
				$this->session->set_userdata('returnurl',$this->session->userdata('profil')->groupname);
			}
			#default value
			$result=$this->mCustomer->getDetail($kd_customer);
			if($result===false){
				$this->judul='Tambah Customer';
				$toview['kd_customer']='';
				$toview['nama']='';
				$toview['alamat']='';
				$toview['alamat_pabrik']='';
				$toview['email']='';
				$toview['website']='';
				$toview['contact_person1']='';
				$toview['contact_person2']='';
				$toview['contact_person3']='';
				$toview['contact_person4']='';
				$toview['contact_person5']='';
				$toview['jml_karyawan']='';
				$toview['kapasitas_produksi_total']='';
				$toview['market_area']='';
				$toview['tahun_pendirian']='';
				$toview['telepon']='';
				$toview['fax']='';
				$toview['kota']='';
				$toview['kd_negara']='102';
				$toview['propinsi']='';
				$toview['kd_satker']='';
				$toview['kd_tipe_customer']='';
				$toview['kd_subtipe_customer']='';
			} else {
				$this->judul='Ubah Customer';
				$toview['kd_customer']=$result->kd_customer;
				$toview['nama']=$result->nama;
				$toview['alamat']=$result->alamat;
				$toview['alamat_pabrik']=$result->alamat_pabrik;
				$toview['email']=$result->email;
				$toview['email']=$result->email;
				$toview['website']=$result->website;
				$toview['contact_person1']=$result->contact_person1;
				$toview['contact_person2']=$result->contact_person2;
				$toview['contact_person3']=$result->contact_person3;
				$toview['contact_person4']=$result->contact_person4;
				$toview['contact_person5']=$result->contact_person5;
				$toview['jml_karyawan']=$result->jml_karyawan;
				$toview['kapasitas_produksi_total']=$result->kapasitas_produksi_total;
				$toview['market_area']=$result->market_area;
				$toview['tahun_pendirian']=$result->tahun_pendirian;
				$toview['telepon']=$result->telepon;
				$toview['fax']=$result->fax;
				$toview['kd_negara']=$result->kd_negara;
				$toview['kota']=$result->kota;
				$toview['propinsi']=$result->propinsi;
				$toview['kd_satker']=$result->kd_satker;
				$toview['kd_tipe_customer']=$result->kd_tipe_customer;
				$toview['kd_subtipe_customer']=$result->kd_subtipe_customer;
			}
			
			#set return url
			$toview['pageurl']='customer';
			$this->session->set_userdata('returnurl',$toview['pageurl']);
			
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required');
			//$this->form_validation->set_rules('kota', 'Kota', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');
			
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			
			if($this->input->post('save')){
				if($this->form_validation->run())
				{
					$toview['nama']=trim($this->input->post('nama'));
					$toview['alamat']=trim($this->input->post('alamat'));
					$toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
					$toview['email']=trim($this->input->post('email'));
					$toview['website']=trim($this->input->post('website'));
					$toview['contact_person1']=trim($this->input->post('contact_person1'));
					$toview['contact_person2']=trim($this->input->post('contact_person2'));
					$toview['contact_person3']=trim($this->input->post('contact_person3'));
					$toview['contact_person4']=trim($this->input->post('contact_person4'));
					$toview['contact_person5']=trim($this->input->post('contact_person5'));
					$toview['jml_karyawan']=trim($this->input->post('jml_karyawan'));
					$toview['kapasitas_produksi_total']=trim($this->input->post('kapasitas_produksi_total'));
					$toview['market_area']=trim($this->input->post('market_area'));
					$toview['tahun_pendirian']=trim($this->input->post('tahun_pendirian'));
					$toview['telepon']=trim($this->input->post('telepon'));
					$toview['fax']=trim($this->input->post('fax'));
					$toview['kd_negara']=trim($this->input->post('kd_negara'));
					$toview['kota']=trim($this->input->post('kota'));
					$toview['propinsi']=$this->input->post('propinsi');
					$toview['tgl_update']=date("Y-m-d H:i:s");
					//$toview['kd_satker']=trim($this->input->post('kd_satker'));
					$toview['kd_tipe_customer']=trim($this->input->post('kd_tipe_customer'));
					$toview['kd_subtipe_customer']=trim($this->input->post('kd_subtipe_customer'));
					$this->mCustomer->Save($toview,$this->input->post('kd_customer'),true); 
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Update Customer");
					$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
					redirect('customer/DetailKomoditi/'.$toview['kd_customer']);
				}
			}
			#load view
			$this->javascript='
			<style>
 				.ui-datepicker-calendar {display: none;}
				.ui-datepicker-month { display:none; }
				.ui-datepicker-prev { display:none;}
				.ui-datepicker-next { display:none; }
				.ui-datepicker-today { display:none; }
				.ui-datepicker thead { display:none; }
				button.ui-datepicker-current {display: none;}​
			</style>
			<script type="text/javascript">
		
			$(function () {  
            			$("#tahun_pendirian").datepicker(  
       				{   
           				changeYear: true, 
					yearRange: "1900:2050", 
           				showButtonPanel: true,  
           				dateFormat: "yy", 
					//appendText: "(format: yyyy)",
					showOn: "both",	 
           				onClose: function (dateText, inst) { 
               					var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();  
               					$(this).datepicker("setDate", new Date(year, 1, 1));  
  
           				}  
       				});  
            			$("tahun_pendirian.ClientID").click(function () {  
                			$(".ui-datepicker-calendar").hide(); 
					
            			});  
        		}); 
			
			</script>';
			$this->content=$this->load->view('customer/customer_edit',$toview);
			//$this->load->view('viewadmin',$toview);
	}


	public function cetak(){
		$toview['content']=$this->session->userdata('temporary');
		$this->load->view('view_main',$toview);
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
