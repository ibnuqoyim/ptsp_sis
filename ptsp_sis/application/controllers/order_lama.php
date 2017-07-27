<?php 
class Order extends CI_Controller {
    public function __construct() {
        	parent::__construct();
		      if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		      $this->load->helper('inputer');
		      $this->load->helper('date');
		      $this->load->helper('tgl_indonesia');
		      $this->load->helper('convertnilai');
		      $this->load->model('mOrder');
		      $this->load->model('mCustomer');
		      $this->load->model('mTarif');
		      $this->load->model('mStaff');
		      $this->load->model('mDokumen');
		      $this->load->model('mSHU');
		      $this->load->model('mUser');
		      $this->load->model('mAutocomplete');
		      $this->load->library('xmlrpc');
        	$this->load->library('xmlrpcs');
    }
    
	public function index($noreg_order_sertifikasi='-',$kd_sertifikasi_jenis='-',$kd_sertifikasi_jenistarif='-',
		    $kd_sertifikasi_tahapan='-',$kd_sertifikasi_komoditi='',
			$nama_perusahaan_pemohon='-',$nama_pabrik='-',$nama_sertifikasi_jenis='',$tglreg_order_sertifikasi='-',
    		$status_order_sertifikasi='-',$statusbayar_order_sertifikasi='-',$hargatotal_order_sertifikasi='-',
    		$jmlbayar_order_sertifikasi='-',$ord='order_sertifikasi.tgl_create',$srt='desc',$limit=30,$page=1)	{
		
		$this->errormsg=""; $this->pending="";$noreg_order_sertifikasi='';$detail='';
		$kd_jenis_tarif='';
    
		$toview['noreg_order_sertifikasi']=$this->input->post('noreg_order_sertifikasi');
		$toview['kd_sertifikasi_jenis']=GetInput($this->input->post('kd_sertifikasi_jenis'),$kd_sertifikasi_jenis);
		$toview['kd_sertifikasi_jenistarif']=GetInput($this->input->post('kd_sertifikasi_jenistarif'),$kd_sertifikasi_jenistarif);
		$toview['kd_sertifikasi_komoditi']=$this->input->post('kd_sertifikasi_komoditi');
		$toview['nama_perusahaan_pemohon']=GetInput($this->input->post('nama_perusahaan_pemohon'),$nama_perusahaan_pemohon);
		$toview['nama_pabrik']=GetInput($this->input->post('nama_pabrik'),$nama_pabrik); 	
		$toview['nama_sertifikasi_jenis']=GetInput($this->input->post('nama_sertifikasi_jenis'),$nama_sertifikasi_jenis); 			
    	$toview['tglreg_order_sertifikasi']=GetInput($this->input->post('tglreg_order_sertifikasi'),$tglreg_order_sertifikasi);
		$toview['status_order_sertifikasi']=GetInput($this->input->post('status_order_sertifikasi'),$status_order_sertifikasi);
		$toview['statusbayar_order_sertifikasi']=GetInput($this->input->post('statusbayar_order_sertifikasi'),$statusbayar_order_sertifikasi);
		$toview['hargatotal_order_sertifikasi']=GetInput($this->input->post('hargatotal_order_sertifikasi'),$hargatotal_order_sertifikasi);
		$toview['jmlbayar_order_sertifikasi']=GetInput($this->input->post('jmlbayar_order_sertifikasi'),$jmlbayar_order_sertifikasi);
		$toview['ord']=GetInput($this->input->post('ord'),$ord,'order_sertifikasi.tgl_create');
		$toview['srt']=GetSort($this->input->post('srt'),$srt,'desc');
		$toview['limit']=(int) $limit;
		
		  	
		if($toview['limit']<0){
			$toview['limit']=30;}
			$page=(int) @ereg_replace("[^0-9]",'',$page);
			#get result
			$toview['tot']=$this->mOrder->getTotalOrderSertifikasi($toview['noreg_order_sertifikasi'],
							$toview['nama_perusahaan_pemohon'],$toview['nama_pabrik'],$toview['tglreg_order_sertifikasi'],
          					$toview['nama_sertifikasi_jenis'],$toview['status_order_sertifikasi'],
          					$toview['statusbayar_order_sertifikasi']);
          
    	if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1; }
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mOrder->getResultOrderSertifikasi($toview['noreg_order_sertifikasi'],
							$toview['nama_perusahaan_pemohon'],$toview['nama_pabrik'],$toview['tglreg_order_sertifikasi'],
          					$toview['nama_sertifikasi_jenis'],$toview['status_order_sertifikasi'],
          					$toview['statusbayar_order_sertifikasi'],
                        	$toview['ord'],$toview['srt'],$toview['limit'],$toview['start']);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		#set return url
		$toview['pageurl']='order/index';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['noreg_order_sertifikasi'])).'/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['nama_perusahaan_pemohon'])).'/'; 
    	$toview['pageurl'].=SetAttr(rawurlencode($toview['nama_pabrik'])).'/';		
		$toview['pageurl'].=SetAttr(rawurlencode($toview['tglreg_order_sertifikasi'])).'/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['nama_sertifikasi_jenis'])).'/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['status_order_sertifikasi'])).'/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['statusbayar_order_sertifikasi'])).'/';
		$toview['ordurl']=$toview['pageurl']; //untuk sort
		$toview['pageurl'].=$toview['ord'].'/';
		$toview['pageurl'].=$toview['srt'].'/';
		$toview['limiturl']=$toview['pageurl']; //untuk limit
		$toview['pageurl'].=$toview['limit'].'/';
		$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);
		//$this->pending=$this->mOrder->getOrderSertifikasi('');
		
		#judul
		$this->judul='Daftar Order';

		
		#load view
		$this->searchbox=$this->load->view('order/searchbox-order',$toview,true);
		
		#javascript
		$this->javascript='
		<script type="text/javascript">
		$("#tgl_order").datepicker({
			appendText: "(format: yyyy-mm-dd)",
			showOn: "both" 
		});
		$(document).ready(function(){
		
			$("#Shu").each(function(){
				var url = $(this).attr("href") + "?TB_iframe=true&height=250&width=500";
				$(this).attr("href", url);
			});
		});  
		</script>';
		if($this->session->flashdata('cetak') || $this->session->flashdata('xls')){
			$this->content=$this->load->view('cetak/print_view_order',$toview);
		} else {
			$this->content=$this->load->view('order/view_order',$toview);			
		}
	}
	
	public function view($kd_order_sertifikasi){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
	   	else redirect('order');

		$order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi,'');
		
		$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;
		$toview['nama_perusahaan_pemohon']=$order->nama_perusahaan_pemohon;
		$toview['alamat_perusahaan_pemohon']=$order->alamat_perusahaan_pemohon;
		$toview['telpon_perusahaan_pemohon']=$order->telpon_perusahaan_pemohon;
		$toview['fax_perusahaan_pemohon']=$order->fax_perusahaan_pemohon;

		$toview['nama_perusahaan_importir']=$order->nama_perusahaan_importir;
		$toview['alamat_perusahaan_importir']=$order->alamat_perusahaan_importir;
		$toview['telpon_perusahaan_importir']=$order->telpon_perusahaan_importir;
		$toview['fax_perusahaan_importir']=$order->fax_perusahaan_importir;
		$toview['no_api_perusahaan_importir']=$order->no_api_perusahaan_importir;

		$toview['nm_kontak_perusahaan_pemohon']=$order->nm_kontak_perusahaan_pemohon;
		$toview['nohp_kontak_perusahaan_pemohon']=$order->nohp_kontak_perusahaan_pemohon;

		$toview['nama_pabrik']  =$order->nama_pabrik;
		$toview['alamat_pabrik']=$order->alamat_pabrik;
		$toview['negara_pabrik']=$order->negara_pabrik;
		$toview['kd_sertifikasi_smm']=$order->kd_sertifikasi_smm;	
				$resultsmm = $this->mOrder->getSmm($order->kd_sertifikasi_smm);
				if($resultsmm) $toview['nama_sertifikasi_smm']=$resultsmm->nama_sertifikasi_smm ;

	  	$toview['noreg_order_sertifikasi']=$order->noreg_order_sertifikasi;
	  	$toview['tglreg_order_sertifikasi']=$order->tglreg_order_sertifikasi;

		$toview['status_order_sertifikasi']=$order->status_order_sertifikasi;
		$toview['statusbayar_order_sertifikasi']=$order->statusbayar_order_sertifikasi;
		$toview['hargatotal_order_sertifikasi']=$order->hargatotal_order_sertifikasi;			 
		$toview['jmlbayar_order_sertifikasi']=$order->jmlbayar_order_sertifikasi;
		$toview['ppn_order_sertifikasi']=$order->ppn_order_sertifikasi;

		$toview['nip_penerima']=$order->nip_penerima;
		$toview['nm_penerima']=$order->nm_penerima;
		$toview['kd_sertifikasi_tahapan']=$order->kd_sertifikasi_tahapan;
				$resulttahapan = $this->mOrder->getJenisTahapan($order->kd_sertifikasi_tahapan);
				if($resulttahapan) $toview['nama_sertifikasi_tahapan']=$resulttahapan->nama_sertifikasi_tahapan ;

		$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
				$resultarif = $this->mTarif->getTarif($order->kd_sertifikasi_jenistarif);
				if($resultarif) $toview['nama_jenistarif']=$resultarif->nama_jenistarif ;  

		$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
				$resuljenis = $this->mTarif->getJenis($order->kd_sertifikasi_jenis,false);
				if($resuljenis) $toview['nama_sertifikasi_jenis']=$resuljenis->nama_sertifikasi_jenis;  

		$toview['kd_jenis_layanan']=$order->kd_jenis_layanan;
		$toview['kd_satker']=$order->kd_satker;
		$toview['layanan']=$this->mOrder->getJenisLayanan($order->kd_jenis_layanan);

		

		$toview['limit']=30;
		$toview['page']=1;
		 $page=1;
		
		#get result

		#get result
		$toview['tot']=$this->mOrder->getTotalOrderKomoditi($toview['kd_order_sertifikasi'],'');
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['result']=$this->mOrder->getResultOrderKomoditi($toview['kd_order_sertifikasi'],'','kd_order_komoditi','desc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['result']=false;
		}

		
		#judul
		$this->judul='View Order';
		#load view
		if($this->session->flashdata('cetak')){
			$this->content=$this->load->view('cetak/print_view_order_rinci',$toview);
		} else {
			$this->content=$this->load->view('order/sertifikasi/view_order_rinci',$toview);
		}
	}
	
public function Add($perusahaan_pemohon='',$perusahaan_importir='',$pabrik='',$kd_sertifikasi_jenis=''){
		$this->errormsg="";
		$this->layanan=$this->mOrder->getJenisLayanan();
		if($perusahaan_pemohon){
			 $customerne=$this->mCustomer->readCustomer($perusahaan_pemohon);
			 $toview['nama_perusahaan_pemohon']=$customerne->nama;
			 $toview['alamat_perusahaan_pemohon']=$customerne->alamat;
			 $toview['telpon_perusahaan_pemohon']=$customerne->telepon;
			 $toview['fax_perusahaan_pemohon']=$customerne->fax;

		} else {
			 $toview['nama_perusahaan_pemohon']='';
			 $toview['alamat_perusahaan_pemohon']='';
			 $toview['telpon_perusahaan_pemohon']='';
			 $toview['fax_perusahaan_pemohon']='';
		}
		if($perusahaan_importir){
			$customer1=$this->mCustomer->readCustomer($perusahaan_importir);
			 $toview['nama_perusahaan_importir']=$customer1->nama;
			 $toview['alamat_perusahaan_importir']=$customer1->alamat;
			 $toview['telpon_perusahaan_importir']=$customerne->telepon;
			 $toview['fax_perusahaan_importir']=$customerne->fax;
		} else {
			 $toview['nama_perusahaan_importir']='';
			 $toview['alamat_perusahaan_importir']='';
			 $toview['telpon_perusahaan_importir']='';
			 $toview['fax_perusahaan_importir']='';
		}
		
		if($pabrik){
			 $customerne2=$this->mCustomer->readCustomer($pabrik);
			 $toview['nama_pabrik']=$customerne2->nama;
			 $toview['alamat_pabrik']=$customerne2->alamat;
			 $toview['negara_pabrik']=$customerne2->kd_negara;
			 
		} else {
			 $toview['nama_pabrik']='';
			 $toview['alamat_pabrik']='';
			 $toview['negara_pabrik']='';
		}
		
		if($kd_sertifikasi_jenis) 
	   	{ 
	   		$toview['kd_sertifikasi_jenis']=$kd_sertifikasi_jenis;
	   		$result=$this->mTarif->getJenis($kd_sertifikasi_jenis);
		 	$toview['nama_sertifikasi_jenis']=$result->nama_sertifikasi_jenis;
	   	} else {
		 	$toview['kd_sertifikasi_jenis']='';
			$toview['nama_sertifikasi_jenis']='';
			
	  	 }

		$toview['kd_order_sertifikasi']=$this->mOrder->Make_no_order_sertifikasi();;
		$toview['noreg_order_sertifikasi']=$this->mOrder->Make_no_order_sertifikasi();
		 
		$no_part=explode("/",$toview['noreg_order_sertifikasi']);
		while($this->mOrder->getOrderSertifikasi('',$toview['noreg_order_sertifikasi'])){
			$no_part[0]++;
			$toview['noreg_order_sertifikasi']=implode("/",$no_part);
		}
			

		$toview['no_api_perusahaan_importir']='';
		$toview['nm_kontak_perusahaan_pemohon']='';
		$toview['nohp_kontak_perusahaan_pemohon']='';

		$toview['tglreg_order_sertifikasi']=date("Y-m-d");
		//$toview['status_order_sertifikasi']='';
		//$toview['statusbayar_order_sertifikasi']='';
		$toview['hargatotal_order_sertifikasi']='';			 
		$toview['jmlbayar_order_sertifikasi']='';
		$toview['ppn_order_sertifikasi']='';
		$toview['kd_sertifikasi_tahapan']='';
		$toview['kd_sertifikasi_jenistarif']='';
		$toview['kd_sertifikasi_smm']='';
		$toview['kd_jenis_layanan']='';
		$toview['tgl_create']=date("Y-m-d");
		 
		$this->form_validation->set_rules('nama_perusahaan_pemohon', 'Nama Perusahaan Pemohon', 'required');
		$this->form_validation->set_rules('nama_pabrik', 'Nama Pabrik', 'required');
		$this->form_validation->set_rules('kd_sertifikasi_jenis', 'Jenis Sertifikasi', 'required');
		$this->form_validation->set_rules('kd_sertifikasi_jenistarif', 'Jenis Tarif', 'required');
		$this->form_validation->set_rules('kd_sertifikasi_tahapan', 'Jenis Tahapan', 'required');
		$this->form_validation->set_rules('nm_kontak_perusahaan_pemohon', 'Nama Kontak Perusahaan', 'required');
		$this->form_validation->set_rules('nohp_kontak_perusahaan_pemohon', 'No. HP Kontak Perusahaan', 'required');
		$this->form_validation->set_rules('noreg_order_sertifikasi', 'Nomor Registrasi', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');
		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			 $toview['kd_order_sertifikasi']=trim($this->input->post('kd_order_sertifikasi'));
			 $toview['kd_jenis_layanan']=trim($this->input->post('kd_jenis_layanan'));
			 $toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));
			 $toview['nama_perusahaan_pemohon']=trim($this->input->post('nama_perusahaan_pemohon'));
			 $toview['alamat_perusahaan_pemohon']=trim($this->input->post('alamat_perusahaan_pemohon'));
			 $toview['telpon_perusahaan_pemohon']=trim($this->input->post('telpon_perusahaan_pemohon'));
			 $toview['fax_perusahaan_pemohon']=trim($this->input->post('fax_perusahaan_pemohon'));

			 $toview['nama_perusahaan_importir']=trim($this->input->post('nama_perusahaan_importir'));
			 $toview['alamat_perusahaan_importir']=trim($this->input->post('alamat_perusahaan_importir'));
			 $toview['telpon_perusahaan_importir']=trim($this->input->post('telpon_perusahaan_importir'));
			 $toview['fax_perusahaan_importir']=trim($this->input->post('fax_perusahaan_importir'));
			 $toview['no_api_perusahaan_importir']=trim($this->input->post('no_api_perusahaan_importir'));

			 $toview['nm_kontak_perusahaan_pemohon']=trim($this->input->post('nm_kontak_perusahaan_pemohon'));
			 $toview['nohp_kontak_perusahaan_pemohon']=trim($this->input->post('nohp_kontak_perusahaan_pemohon'));

			 $toview['nama_pabrik']=trim($this->input->post('nama_pabrik'));
			 $toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
			 $toview['negara_pabrik']=trim($this->input->post('negara_pabrik'));
			 $toview['kd_sertifikasi_smm']=trim($this->input->post('kd_sertifikasi_smm'));

			 $toview['noreg_order_sertifikasi']=trim($this->input->post('noreg_order_sertifikasi'));
			 $toview['tglreg_order_sertifikasi']=$this->input->post('tglreg_order_sertifikasi');
			 //$toview['status_order_sertifikasi']=trim($this->input->post('status_order_sertifikasi'));
			 //$toview['statusbayar_order_sertifikasi']=trim($this->input->post('statusbayar_order_sertifikasi'));
			 $toview['hargatotal_order_sertifikasi']=trim($this->input->post('hargatotal_order_sertifikasi'));			 
			 $toview['jmlbayar_order_sertifikasi']=$this->input->post('jmlbayar_order_sertifikasi');
			 $toview['ppn_order_sertifikasi']=$this->input->post('ppn_order_sertifikasi');

			 $toview['kd_sertifikasi_tahapan']=$this->input->post('kd_sertifikasi_tahapan');
			 $toview['kd_sertifikasi_jenistarif']=$this->input->post('kd_sertifikasi_jenistarif');
			 $toview['kd_sertifikasi_jenis']=$this->input->post('kd_sertifikasi_jenis');
			 $toview['kd_jenis_layanan']=$this->input->post('kd_jenis_layanan');

			 $toview['tgl_create']=$this->input->post('tgl_create');
			 $toview['nip_penerima']=trim($this->input->post('nip_penerima'));
			 $toview['nm_penerima']=trim($this->input->post('nm_penerima'));

			if($this->errormsg=="") { 
				if($toview['tgl_create']=='') $toview['tgl_create']=date("Y-m-d H:i:s");
				$toview['tgl_update']=date("Y-m-d H:i:s");
				$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				$toview['kd_order_sertifikasi']=$this->mOrder->Make_kd_order_sertifikasi();
				
				if($toview['noreg_order_sertifikasi']){
					$toview['noreg_order_sertifikasi']=trim($this->input->post('noreg_order_sertifikasi'));
				}else{   
					$toview['noreg_order_sertifikasi']=$this->mOrder->Make_no_order_sertifikasi();
				}
				#=================================================
				$kode_part=explode("-",$toview['kd_order_sertifikasi']);
				
				while($this->mOrder->getOrderSertifikasi($toview['kd_order_sertifikasi'])){
					$kode_part[(count($kode_part)-1)]++;
					$toview['kd_order']=implode("-",$kode_part);
				}
				
				
				$hasil=$this->mOrder->saveOrderSertifikasi($toview,$toview['kd_order_sertifikasi'],false); 
				if($hasil) { 
					$this->mUser->WriteLog($this->session->userdata('userid'),
					$_SERVER['REMOTE_ADDR'],current_url(),"Order Baru");
					$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
					//echo "<script>alert('Berhasil disimpan')</script>";
					redirect('order/OrderKomoditi/'.$toview['kd_order_sertifikasi']);
				} else { 
					$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
					//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";/
					redirect(current_url());
				}
			}
		  }
		}

								
		
		#judul
		$this->judul='Tambah Order';
		
		#javascript
		$this->javascript='
						<script type="text/javascript">
							$(document).ready(function(){
		
			var data = [';
			$result=$this->mCustomer->getCustomer();
			if($result){
				foreach($result as $row){
					$nama=str_replace("'"," ",$row->nama);
					$this->javascript.="{text:'".$nama."', url:'$row->kd_customer'},\n";
				}
			}
			//$this->javascript=substr($this->javascript,strlen($this->javascript)-2,2);
			$this->javascript.='];
			$("#tglreg_order_sertifikasi").datepicker({
			appendText: "(format: yyyy-mm-dd)",
			showOn: "both" 
			});

			$("#perusahaan_pemohon").autocomplete(data, {
			matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/Add/\' + item.url + \'/'.$perusahaan_importir.'\';
			});
			$("#perusahaan_importir").autocomplete(data, {
			matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/Add/'.$perusahaan_pemohon.'/\' + item.url;
			});
		});
						</script>';
						
						
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_add',$toview);	
	}

	public function edit($kd_order_sertifikasi,$perusahaan_pemohon='',$perusahaan_importir='',$pabrik='',$kd_sertifikasi_jenis=''){
		$this->errormsg="";
		//echo "<script>alert('cek')</script>".$kd_order;
	   	if($kd_order_sertifikasi) 
			$toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
		else 
			redirect('order');
		//$this->layanan=$this->mOrder->getJenisLayanan();
		$order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi,'');

		if($perusahaan_pemohon){
			 $customerne=$this->mCustomer->readCustomer($perusahaan_pemohon);
			 $toview['nama_perusahaan_pemohon']=$customerne->nama;
			 $toview['alamat_perusahaan_pemohon']=$customerne->alamat;
			 $toview['telpon_perusahaan_pemohon']=$customerne->telepon;
			 $toview['fax_perusahaan_pemohon']=$customerne->fax;

		} else {
			 $toview['nama_perusahaan_pemohon']=$order->nama_perusahaan_pemohon;
			 $toview['alamat_perusahaan_pemohon']=$order->alamat_perusahaan_pemohon;
			 $toview['telpon_perusahaan_pemohon']=$order->telpon_perusahaan_pemohon;
			 $toview['fax_perusahaan_pemohon']=$order->fax_perusahaan_pemohon;
		}
		if($perusahaan_importir){
			$customer1=$this->mCustomer->readCustomer($perusahaan_importir);
			 $toview['nama_perusahaan_importir']=$customer1->nama;
			 $toview['alamat_perusahaan_importir']=$customer1->alamat;
			 $toview['telpon_perusahaan_importir']=$customerne->telepon;
			 $toview['fax_perusahaan_importir']=$customerne->fax;
		} else {
			 $toview['nama_perusahaan_importir']=$order->nama_perusahaan_importir;
			 $toview['alamat_perusahaan_importir']=$order->alamat_perusahaan_importir;
			 $toview['telpon_perusahaan_importir']=$order->telpon_perusahaan_importir;
			 $toview['fax_perusahaan_importir']=$order->fax_perusahaan_importir;
		}
			
			 $toview['no_api_perusahaan_importir']=$order->no_api_perusahaan_importir;
			 $toview['nm_kontak_perusahaan_pemohon']=$order->nm_kontak_perusahaan_pemohon;
			 $toview['nohp_kontak_perusahaan_pemohon']=$order->nohp_kontak_perusahaan_pemohon;
			 $toview['nama_pabrik']  =$order->nama_pabrik;
			 $toview['alamat_pabrik']=$order->alamat_pabrik;
			 $toview['negara_pabrik']=$order->negara_pabrik;
			 $toview['kd_sertifikasi_smm']=$order->kd_sertifikasi_smm;
			 
		
		
		if($kd_sertifikasi_jenis) 
	   	{ 
	   		$toview['kd_sertifikasi_jenis']=$kd_sertifikasi_jenis;
	   		$result=$this->mTarif->getJenis($kd_sertifikasi_jenis);
		 	$toview['nama_sertifikasi_jenis']=$result->nama_sertifikasi_jenis;
	   	} else {
		 	$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
			//$toview['nama_sertifikasi_jenis']=$order->nama_sertifikasi_jenis;
			
	  	 }
	  	 //$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;
	  	 $toview['noreg_order_sertifikasi']=$order->noreg_order_sertifikasi;
	  	 $toview['tglreg_order_sertifikasi']=$order->tglreg_order_sertifikasi;
		 $toview['status_order_sertifikasi']=$order->status_order_sertifikasi;
		 $toview['statusbayar_order_sertifikasi']=$order->statusbayar_order_sertifikasi;
		 $toview['hargatotal_order_sertifikasi']=$order->hargatotal_order_sertifikasi;			 
		 $toview['jmlbayar_order_sertifikasi']=$order->jmlbayar_order_sertifikasi;
		 $toview['ppn_order_sertifikasi']=$order->ppn_order_sertifikasi;
		 $toview['nip_penerima']=$order->nip_penerima;
		 $toview['nm_penerima']=$order->nm_penerima;
		 $toview['kd_sertifikasi_tahapan']=$order->kd_sertifikasi_tahapan;
		 $toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif; 		
		 $toview['kd_jenis_layanan']=$order->kd_jenis_layanan;
		 $toview['layanan']=$this->mOrder->getJenisLayanan($order->kd_jenis_layanan);
		
		 $toview['limit']=30;
		 $toview['page']=1;
		 $page=1;

		
		#get result
		$toview['tot']=$this->mOrder->getTotalOrderKomoditi($toview['kd_order_sertifikasi'],'');
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['result']=$this->mOrder->getResultOrderKomoditi($toview['kd_order_sertifikasi'],'','kd_order_komoditi','desc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['result']=false;
		}
		
		
		
		$this->form_validation->set_rules('nama_perusahaan_pemohon', 'Nama Perusahaan Pemohon', 'required');
		$this->form_validation->set_rules('nama_pabrik', 'Nama Pabrik', 'required');
		$this->form_validation->set_rules('kd_sertifikasi_jenis', 'Jenis Sertifikasi', 'required');
		$this->form_validation->set_rules('kd_sertifikasi_jenistarif', 'Jenis Tarif', 'required');
		$this->form_validation->set_rules('kd_sertifikasi_tahapan', 'Jenis Tahapan', 'required');
		$this->form_validation->set_rules('nm_kontak_perusahaan_pemohon', 'Nama Kontak Perusahaan', 'required');
		$this->form_validation->set_rules('nohp_kontak_perusahaan_pemohon', 'No. HP Kontak Perusahaan', 'required');
		$this->form_validation->set_rules('noreg_order_sertifikasi', 'Nomor Registrasi', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');
		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		if($this->input->post('save')){
			
		  if($this->form_validation->run())
		  {
			 $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
			 $toview['kd_jenis_layanan']=trim($this->input->post('kd_jenis_layanan'));
			 $toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));
			 $toview['nama_perusahaan_pemohon']=trim($this->input->post('nama_perusahaan_pemohon'));
			 $toview['alamat_perusahaan_pemohon']=trim($this->input->post('alamat_perusahaan_pemohon'));
			 $toview['telpon_perusahaan_pemohon']=trim($this->input->post('telpon_perusahaan_pemohon'));
			 $toview['fax_perusahaan_pemohon']=trim($this->input->post('fax_perusahaan_pemohon'));

			 $toview['nama_perusahaan_importir']=trim($this->input->post('nama_perusahaan_importir'));
			 $toview['alamat_perusahaan_importir']=trim($this->input->post('alamat_perusahaan_importir'));
			 $toview['telpon_perusahaan_importir']=trim($this->input->post('telpon_perusahaan_importir'));
			 $toview['fax_perusahaan_importir']=trim($this->input->post('fax_perusahaan_importir'));
			 $toview['no_api_perusahaan_importir']=trim($this->input->post('no_api_perusahaan_importir'));
			 $toview['nm_kontak_perusahaan_pemohon']=trim($this->input->post('nm_kontak_perusahaan_pemohon'));

			 $toview['nama_pabrik']=trim($this->input->post('nama_pabrik'));
			 $toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
			 $toview['negara_pabrik']=trim($this->input->post('negara_pabrik'));
			 $toview['standard_sistem_mutu']=trim($this->input->post('standard_sistem_mutu'));

			 $toview['noreg_order_sertifikasi']=trim($this->input->post('noreg_order_sertifikasi'));
			 $toview['tglreg_order_sertifikasi']=trim($this->input->post('tglreg_order_sertifikasi'));
			 $toview['status_order_sertifikasi']=trim($this->input->post('status_order_sertifikasi'));
			 $toview['statusbayar_order_sertifikasi']=trim($this->input->post('statusbayar_order_sertifikasi'));
			 $toview['hargatotal_order_sertifikasi']=trim($this->input->post('hargatotal_order_sertifikasi'));			 
			 $toview['jmlbayar_order_sertifikasi']=$this->input->post('jmlbayar_order_sertifikasi');
			 $toview['jmlbayar_order_sertifikasi']=$this->input->post('jmlbayar_order_sertifikasi');

			 $toview['kd_sertifikasi_tahapan']=$this->input->post('kd_sertifikasi_tahapan');
			 $toview['kd_sertifikasi_jenistarif']=$this->input->post('kd_sertifikasi_jenistarif');
			 $toview['kd_sertifikasi_jenis']=$this->input->post('kd_sertifikasi_jenis');
			 $toview['kd_jenis_layanan']=$this->input->post('kd_jenis_layanan');
			 
			 $toview['tgl_create']=$this->input->post('tgl_create');
			 $toview['nip_penerima']=trim($this->input->post('nip_penerima'));
			 $toview['nm_penerima']=trim($this->input->post('nm_penerima'));
			
			if($this->errormsg=="") { 
			    //$toview['tgl_create']=date("Y-m-d H:i:s");
		            //if($toview['tgl_create']=='') $toview['tgl_create']=date("Y-m-d H:i:s");
			    $toview['tgl_update']=date("Y-m-d H:i:s");
			    $toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
			    $hasil=$this->mOrder->saveOrderSertifikasi($toview,$toview['kd_order_sertifikasi'],true); 
			    if($hasil) { 
			       $this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Update Order");
			       $this->errormsg='<em style="color:green">Berhasil diupdate!</em>';
			      
			    }else { 
				$this->errormsg='<em style="color:red">Maaf, Pengupdetan gagal boss!</em>';
				echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
				redirect(current_url());
			    }
			}
		    }
		  }
		
		
		
		#judul
		$this->judul='Edit Order';
		#javascript
		$this->javascript='
		<script type="text/javascript">
		$("#tglreg_order_sertifikasi").datepicker({
			appendText: "(format: yyyy-mm-dd)",
			showOn: "both" 
			});
		
		$(document).ready(function(){
		
			$("#customer").each(function(){
				var url = $(this).attr("href") + "?TB_iframe=true&height=450&width=600";
		
				$(this).attr("href", url);
			});
			$("#customer2").each(function(){
				var url = $(this).attr("href") + "?TB_iframe=true&height=450&width=600";
		
				$(this).attr("href", url);
			});
			var data = [';
			$result=$this->mCustomer->getCustomer();
			if($result){
				foreach($result as $row){
					$nama=str_replace("'"," ",$row->nama);
					$this->javascript.="{text:'".$nama."', url:'$row->kd_customer'},\n";
				}
			}
			//$this->javascript=substr($this->javascript,strlen($this->javascript)-2,2);
			
			$this->javascript.='];
			$("#perusahaan_pemohon").autocomplete(data, {
				matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/edit/'.$kd_order_sertifikasi.'/\' + item.url + \'/'.$perusahaan_importir.'\';
			});
			$("#perusahaan_importir").autocomplete(data, {
			matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/edit/'.$kd_order_sertifikasi.'/'.$perusahaan_pemohon.'/\' + item.url;
			});
		});  
		
		</script>
		';
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_edit',$toview);
	}
	
	
	
    public function orderKomoditi($kd_order_sertifikasi='',$kd_sertifikasi_komoditi=''){
	    $this->errormsg=""; $this->listKomoditi=""; //$this->list_customer="";
           	$counter=0;

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_sertifikasi_komoditi) $toveiw['kd_sertifikasi_komoditi']='';

	   	if($kd_sertifikasi_komoditi){
			 $komoditina=$this->mTarif->readKomoditi($kd_sertifikasi_komoditi);
			 //$toview['kd_order_komoditi']=$komoditina->kd_order_komoditi;
			 $toview['kd_sertifikasi_komoditi']=$komoditina->kd_sertifikasi_komoditi;
			 $toview['no_sertifikasi_komoditi']=$komoditina->no_sertifikasi_komoditi;
			 $toview['nama_sertifikasi_komoditi']=$komoditina->nama_sertifikasi_komoditi;
			 $toview['tipe_sertifikasi_komoditi']=$komoditina->tipe_sertifikasi_komoditi;
	   		 $toview['kd_satker']=$komoditina->kd_satker;

		} else {
			 	$toview['kd_order_komoditi']='';	   
	   			$toview['kd_sertifikasi_komoditi']='';
	   			$toview['no_sertifikasi_komoditi']='';
				$toview['nama_sertifikasi_komoditi']='';	   	
	   			$toview['tipe_sertifikasi_komoditi']='';
	   			
		}

	   			$toview['jenis_produk_komoditi']='';
	   			$toview['merk_dagang_komoditi']='';
	   			
				

		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;		
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	#get result
		$toview['tot']=$this->mOrder->getTotalOrderKomoditi($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mOrder->getResultOrderKomoditi($toview['kd_order_sertifikasi'],'','kd_sertifikasi_komoditi','desc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		
		$this->form_validation->set_rules('no_sertifikasi_komoditi', 'Nama SNI', 'required');
		$this->form_validation->set_rules('merk_dagang_komoditi', 'Merek dagang', 'required');
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
					$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
					$toview['kd_sertifikasi_komoditi']=trim($this->input->post('kd_sertifikasi_komoditi'));
				   	$toview['no_sertifikasi_komoditi']=trim($this->input->post('no_sertifikasi_komoditi'));
					$toview['nama_sertifikasi_komoditi']=trim($this->input->post('nama_sertifikasi_komoditi'));
				   	$toview['tipe_sertifikasi_komoditi']=trim($this->input->post('tipe_sertifikasi_komoditi'));
				  	$toview['jenis_produk_komoditi']=trim($this->input->post('jenis_produk_komoditi'));
				  	$toview['merk_dagang_komoditi']=trim($this->input->post('merk_dagang_komoditi'));
				  	$toview['kd_order_komoditi']=$this->mOrder->Make_kd_order_komoditi();
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderKomoditi($toview,$toview['kd_order_sertifikasi'],false); 
					echo "<script>alert('test disimpan')</script>";
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Order Komoditi ");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/OrderKomoditi/'.$toview['kd_order_sertifikasi']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}else{
					echo "<script>alert(".$this->errormsg."')</script>";
				}
				
			  }else{//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }
		}//else  echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>";
		
		#judul
		$this->judul='Order Komoditi';
		$this->javascript='
							<script type="text/javascript">
							$(document).ready(function(){
		
			var data = [';
			$result=$this->mTarif->getKomoditi();
			if($result){
				foreach($result as $row){
					$nomor_sni=str_replace("'"," ",$row->no_sertifikasi_komoditi);
					//$nama_sni=str_replace("'"," ",$row->nama_sertifikasi_komoditi);
					//$this->javascript.="{text:'".$nomor_sni." | ".$nama_sni."', url:'$row->kd_sertifikasi_komoditi'},\n";
					//$nama_sni=str_replace("'"," ",$row->nama_sertifikasi_komoditi);
					$this->javascript.="{text:'".$nomor_sni."', url:'$row->kd_sertifikasi_komoditi'},\n";
				}
			}
			//$this->javascript=substr($this->javascript,strlen($this->javascript)-2,2);
			$this->javascript.='];
			
			$("#no_sni").autocomplete(data, {
			matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/orderKomoditi/'.$kd_order_sertifikasi.'/\'  + item.url;
			});
			
		});
						</script>';
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_add_komoditi',$toview);	
	}

	public function delOrderKomoditi($kd_order_sertifikasi='',$kd_order_komoditi=''){
		$this->mOrder->deleteOrderKomoditi($kd_penelitian,$kd_order_komoditi);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Komoditi . ".$kd_order_komoditi);
		redirect('order/orderKomoditi/'.$kd_order_sertifikasi);
	}

	public function cetak($url=''){
		if($url){
			$this->session->set_flashdata('cetak',1);
			redirect(base64_decode($url));
		}
	}

	public function excels($url='',$filename=''){
		if($url){
			$this->session->set_flashdata('xls',1);
			$this->session->set_flashdata('namafile',$filename);
			redirect(base64_decode($url));
		}
	}


	public function orderDokumen($kd_order_sertifikasi='',$kd_sertifikasi_jenis='',$kd_sertifikasi_jenistarif=''){
	

	   		$this->errormsg=""; $this->listDokumen=""; $this->list_order="";
           	$counter=0;
	   		if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
	   
	   		if($kd_order_sertifikasi) 
				$toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
			else 
				redirect('order');
		
			$order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi,'');
			$toview['kd_sertifikasi_tahapan']=$order->kd_sertifikasi_tahapan;
			$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
			$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;


	   		if($kd_sertifikasi_jenis) 
	   		{ 
	   				$toview['kd_sertifikasi_jenis']=$kd_sertifikasi_jenis;
	   				$result=$this->mTarif->getJenis($kd_sertifikasi_jenis);
		 			$toview['nama_sertifikasi_jenis']=$result->nama_sertifikasi_jenis;
	   		} else {
		 			$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
					$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
					$toview['nama_sertifikasi_jenis']='';
	   		}

	   		//$kd_sertifikasi_jenistarif= $order->kd_sertifikasi_jenistarif;
	   		$kd_sertifikasi_jenistarif= $order->kd_sertifikasi_jenistarif;

	   		if($kd_sertifikasi_jenistarif){
	   				$toview['kd_sertifikasi_jenistarif']=$kd_sertifikasi_jenistarif;
	   				$result=$this->mTarif->getTarif($kd_sertifikasi_jenistarif);
	   				//echo $kd_sertifikasi_jenistarif;
	   				$result2= $this->mDokumen->getDokumen('',$kd_sertifikasi_jenistarif ,true);
	   				echo count($result2);
					if($result2){
			  			$this->listDokumen='<ol>';
			      		foreach($result2 as $row){
							$cek=""; $visible="hidden"; $jum_uji=1;
							$this->listDokumen.='
							<li>
								<input type="checkbox" name="parameter['.$counter.']" id="parameter-'.$counter.'" 
								value="'.$row->kd_sertifikasi_dokumen.'" 
								onchange="if(document.getElementById(\'cekJumlahUji-'.$counter.'\').checked){
					  							document.getElementById(\'cekJumlahUji-'.$counter.'\').checked=this.checked;
					 							document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
					  							document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'hidden\'
                                	  		}" >&nbsp;'.ucfirst($row->nama_sertifikasi_dokumen).' &nbsp;&nbsp;
											<input name="cekJumlahUji['.$row->kd_sertifikasi_dokumen.']" '.$cek.' id="cekJumlahUji-'.$counter.'"  
											type="checkbox" value="'.$counter.'" 	
											onchange="javascript:if(this.checked){ 
											document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
											document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'visible\'
											} else { 
												document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
												document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'hidden\'}" />
												&nbsp;Jumlah Uji&nbsp; 
												<input type="text" name="jumlah_uji['.$row->kd_sertifikasi_dokumen.']" class="input" value="1" maxlength="4"
												size="4" id="jumlah_uji-'.$counter.'" style="visibility:'.$visible.'">
								</li>';
								$counter++;
						}
						$this->listDokumen.='</ol>
							<input type="checkbox" name="cekAllJumlahUji" value="1" id="cekAllJumlahUji" 
							onchange="CheckItAll()">&nbsp;Check All';
					}
	  		} else {
		   			$toview['nama_jenistarif']='';
		    		$toveiw['kd_sertifikasi_jenistarif']='';  
	   		}
		 	$toveiw['tgl_dokumen_diterima']='';
			$toveiw['tgl_dokumen_lengkap']='';
			$toview['status_order_dokumen']='';
		 	$toview['nip_penerima_dokumen']='0';
		 	$toview['nama_penerima_dokumen']='';
		 	$toview['limit']=30;
			$toview['page']=1;
		 	$page=1;
			#get result
			$toview['tot']=$this->mOrder->getTotalOrderDokumen($toview['kd_order_sertifikasi'],'');
			/*echo "<script>alert('{$toview['tot']}')</script>";*/
			if($toview['tot']>0){
				$toview['pages']=ceil($toview['tot']/$toview['limit']);
				if(!is_numeric($page)){$toview['page']=1;}
				elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
				else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['result']=$this->mOrder->getResultOrderDokumen($toview['kd_order_sertifikasi'],'','kd_order_sertifikasi_dokumen','desc',30,0);
			} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['result']=false;
			}
		
			$this->form_validation->set_rules('nama_jenistarif', 'Jenis Tarif', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');
		
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			//echo "<script>alert('test save ? ')</script>";
			if($this->input->post('save')){
		  			echo "<script>alert('test input save true'".trim($this->input->post('save')).")</script>";
		  			if($this->form_validation->run())
		  			{
						echo "<script>alert('test for falidasi true')</script>";
						if($this->input->post('tambah')){
								echo "<script>alert('test for input post tambah true')</script>";
								if($this->errormsg=="") { 
				       				 echo "<script>alert('test no error message true')</script>";
					
									$parameterlist=$this->input->post('parameter');
									$jumujilist=$this->input->post('jumlah_uji');
									$toview['jumlah_contoh']=$this->input->post('jumlah_contoh');
									/*echo "<script>alert('".print_r($jumujilist)."')</script>";*/
									$toview['jumlah_sertifikat']=$this->input->post('jumlah_sertifikat');
				   					$toview['kondisi_kemasan']=trim($this->input->post('kondisi_kemasan'));
				   					$toview['kondisi_contoh']=trim($this->input->post('kondisi_contoh'));
				  					$toview['tanda_contoh']=trim($this->input->post('tanda_contoh'));
				   					$toview['no_pengujian']=trim($this->input->post('no_pengujian'));
				        			$toview['kd_jenis_tarif']=trim($this->input->post('kd_jenis_tarif'));
									$toview['kd_detail_order']=$this->mOrder->Make_kd_detail_order();
									
									//$hasil=$this->mOrder->SaveDetail($toview,'',$parameterlist,$jumujilist,false);
 									if($parameterlist){				
										$hasil=$this->mOrder->SaveDetail($toview,'',$parameterlist,$jumujilist,false); 
									}else{
										echo "<script>alert('Parameter Belum ada yang dipilih')</script>";
									}
									if($hasil) { 
										$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
										current_url(),"Detail Order Baru Sementara");
										$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
										/*echo "<script>alert('Berhasil disimpan')</script>";*/
										redirect('order/Detail/'.$toview['kd_order']);
									} else { 
										$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
										/*echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";*/
										redirect(current_url());
									}
								}else{echo "<script>alert(".$this->errormsg."')</script>";}
				
			  			}
		  			}
			}
		
			#judul
			$this->judul='Detail Order';
			$this->javascript='
					<script type="text/javascript">
					function CheckItAll(){
						for(i=0;i<'.$counter.';i++){
							document.getElementById(\'parameter-\' + i).checked=document.getElementById(\'cekAllJumlahUji\').checked;
						}
					}
					$(document).ready(function(){
					';
					$this->javascript.='var data = [';
					$result=$this->mTarif->getJenis('',true);
					if($result){
						foreach($result as $row){
							$this->javascript.="{text:'".$row->nama_sertifikasi_jenis."', url:'".$row->kd_sertifikasi_jenis."'},";
						}
					}
					$this->javascript.='];';
					if($kd_sertifikasi_jenistarif){
						$this->javascript.='
						var data2 = [';
							$result=$this->mTarif->getTarif('',$kd_sertifikasi_jenistarif,true);
						if($result){
							foreach($result as $row){
								$this->javascript.="{text:'".$row->nama_tarif."', url:'".$row->kd_tarif."'},";
							}
						}
						$this->javascript.='];';
						$this->javascript.='
								$("#nama_contoh").autocomplete(data2, {
								matchContains: true,
				  				formatItem: function(item) {
								return item.text;
				 				 }
								}).result(function(event, item) {
				  				location.href = \'index.php/order/orderDokumen/'.$toview['kd_order_sertifikasi'].'/'.$toview['kd_sertifikasi_jenistarif'].'/\' + item.url;
								});';
					}
					$this->javascript.='
							$("#jenis_contoh").autocomplete(data, {
									matchContains: true,
			  						formatItem: function(item) {
											return item.text;
			 						}
							}).result(function(event, item) {
			  						location.href = \'index.php/order/orderDokumen/'.$toview['kd_order_sertifikasi'].'/\' + item.url;
							});
					});  
		
					</script>';
		#load view
		$this->content=$this->load->view('order/sertifikasi/administrator/order_dokumen',$toview);	
	}
	





	/*
	//input RHU di detail order
	public function inputRHUPenyelia($kd_order,$kd_detail_order,$no_order='',$kd_rhu='',$status_rhu='',$no_pengujian='',
	$tgl_pengujian='',$tgl_selesai_pengujian='',$file_rhu='',$nip_penyelia='',$nm_penyelia='',$tgl_dibuat_penyelia='',
	$comment_penyelia='',$nip_manager_teknis='',$nm_manager_teknis='',$tgl_disetujui_manager_teknis='',$comment_manager_teknis=''){
		$this->errormsg="";
		$this->form_validation->set_rules('status_rhu', 'Status RHU', 'required');
		$this->form_validation->set_message('required','%s Wajib diisi!');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		

		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			//echo "<script>alert('Error')</script>";
			 $toview['kd_rhu']=$this->mOrder->Make_kd_rhu();
			 $toview['file_rhu']=trim($this->input->post('userfile'));
			 $toview['status_rhu']=trim($this->input->post('status_rhu'));
			 $toview['no_pengujian']=trim($this->input->post('no_pengujian'));
			 $toview['tgl_pengujian']=trim($this->input->post('tgl_pengujian'));
			 $toview['tgl_selesai_pengujian']=trim($this->input->post('tgl_selesai_pengujian'));

			 $toview['no_order']=trim($this->input->post('no_order'));
			 $toview['kd_order']=trim($this->input->post('kd_order'));
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));

			 $toview['nip_penyelia']=trim($this->input->post('nip_penyelia'));
			 $toview['nm_penyelia']=trim($this->input->post('nm_penyelia'));
		         $toview['tgl_dibuat_penyelia']=trim($this->input->post('tgl_dibuat_penyelia'));
			 $toview['comment_penyelia']=trim($this->input->post('comment_penyelia'));
			 $toview['nip_manager_teknis']=trim($this->input->post('nip_manager_teknis'));
			 $toview['nm_manager_teknis']=trim($this->input->post('nm_manager_teknis'));
			 $toview['tgl_dibuat_manager_teknis']=trim($this->input->post('tgl_dibuat_manager_teknis'));
			 $toview['comment_manager_teknis']=trim($this->input->post('comment_manager_teknis')); 
			 $toview['tgl_create']=date("Y-m-d H:i:s");
			 
			if($this->mRHU->getRHU('',$toview['no_pengujian'])){ 
			  #jika kode order telah ada
			  $this->errormsg='<em style="color:red">Nomor RHU sudah ada! Silahkan coba lagi.</em>';
			}
			if($this->errormsg=="") { 
				$file_dir='./download/rhu/'.date('Y-m').'/';
				
				if(!file_exists($file_dir)) {
						mkdir($file_dir);
				}else {
						echo "<script>alert('Ok.file direktori sudah ada')</script>";
						$file_dir =$file_dir;
				}
				
				//if(!file_exists($file_dir)) mkdir($file_dir);
				$syxupload['upload_path'] = $file_dir;
				$syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
				$syxupload['max_size']	= '2500';
				//$syxupload['max_width']  = '1024';
				//$syxupload['max_height']  = '768';
	
				$this->load->library('upload', $syxupload);
				if (! $this->upload->do_upload())
				{
					$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
					$toview['file_rhu']=$file_dir.$data['upload_data']['file_name'];
					$result=$this->mRHU->save($toview);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Upload File RHU");
					redirect('order/upload_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_order']='';
				}
			}
		  }
		}
		$result = $this->mOrder->getTandaContoh($kd_detail_order);
		
		if($result){
			$no_pengujian=$result->no_pengujian;
			$kd_detail_order=$result->kd_detail_order;
		}
		
		
		if($no_pengujian) $toview['no_pengujian']=$no_pengujian; 
			else $toview['no_pengujian']='';
		if($tgl_pengujian) $toview['tgl_pengujian']=$tgl_pengujian;
			else $toview['tgl_pengujian']='';
	        if($tgl_selesai_pengujian) $toview['tgl_selesai_pengujian']=$tgl_selesai_pengujian;
			else $toview['tgl_selesai_pengujian']='';

		if($status_rhu) $toview['status_rhu']=$status_rhu; 
			else $toview['status_rhu']='';
		if($no_order) $toview['no_order']=$no_order;
			else $toview['no_order']='';
		if($kd_order) $toview['kd_order']=$kd_order;
			else $toview['kd_order']='';
		if($kd_detail_order) $toview['kd_detail_order']=$kd_detail_order;
			else $toview['kd_detail_order']='';
		if($file_rhu) $toview['file_rhu']=$file_rhu; 
			else $toview['file_rhu']='';
		if($nip_penyelia) $toview['nip_penyelia']=$nip_penyelia; 
			else $toview['nip_penyelia']='';
		if($nm_penyelia) $toview['nm_penyelia']=$nm_penyelia; 
			else $toview['nm_penyelia']='';
		if($tgl_dibuat_penyelia) $toview['tgl_dibuat_penyelia']=$tgl_dibuat_penyelia; 
			else $toview['tgl_dibuat_penyelia']='';
		if($comment_penyelia) $toview['comment_penyelia']=$comment_penyelia; 
			else $toview['comment_penyelia']='';
		if($nip_manager_teknis) $toview['nip_manager_teknis']=$nip_manager_teknis ; 
			else $toview['nip_manager_teknis']='';
		if($nm_manager_teknis) $toview['nm_manager_teknis']=$nm_manager_teknis; 
			else $toview['nm_manager_teknis']='';
		if($tgl_disetujui_manager_teknis) $toview['tgl_disetujui_manager_teknis']=$tgl_disetujui_manager_teknis; 
			else $toview['tgl_disetujui_manager_teknis']='';
		if($comment_penyelia) $toview['comment_manager_teknis']=$comment_manager_teknis; 
			else $toview['comment_manager_teknis']='';
		
		
		
		#judul
		$this->judul='<center>Input Rekapitulasi Hasil Uji</br>(RHU)</center>';
		#javascript
		$this->javascript='
		<script type="text/javascript">
		$("#tgl_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
		$("#tgl_selesai_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
		
		$("#tgl_dibuat_penyelia").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 

			showOn: "both"
		});
		$("#tgl_disetujui_manager_teknis").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 

			showOn: "both"
		});
		$(document).ready(function(){
       		 	$("textarea.tinymcecomment").tinymce({
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
		</script>
		
		';
		#load view
		$this->content=$this->load->view('rhu/penyelia/rhu_add_penyelia',$toview);
	}

	//input RHU di detail order
	public function editRHUPenyelia($kd_order,$kd_detail_order,$no_pengujian,$no_order='',$kd_rhu='',$status_rhu='',
		$tgl_pengujian='',$tgl_selesai_pengujian='',$file_rhu='',
		$nip_penyelia='',$nm_penyelia='',$tgl_dibuat_penyelia='',$comment_penyelia='',
                $nip_manager_teknis='',$nm_manager_teknis='',$tgl_disetujui_manager_teknis='',$comment_manager_teknis=''){
		$this->errormsg="";
		$this->form_validation->set_rules('status_rhu', 'Status RHU', 'required');
		$this->form_validation->set_message('required','%s Wajib diisi!');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		

		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			//echo "<script>alert('Error')</script>";
			 $toview['kd_rhu']=trim($this->input->post('kd_rhu'));
			 $toview['file_rhu']=trim($this->input->post('userfile'));
			 $toview['status_rhu']=trim($this->input->post('status_rhu'));
			 $toview['no_pengujian']=trim($this->input->post('no_pengujian'));
			 $toview['tgl_pengujian']=trim($this->input->post('tgl_pengujian'));
			 $toview['tgl_selesai_pengujian']=trim($this->input->post('tgl_selesai_pengujian'));
			 $toview['no_order']=trim($this->input->post('no_order'));
			 $toview['kd_order']=trim($this->input->post('kd_order'));
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
			 $toview['nip_penyelia']=trim($this->input->post('nip_penyelia'));
			 $toview['nm_penyelia']=trim($this->input->post('nm_penyelia'));
		         $toview['tgl_dibuat_penyelia']=trim($this->input->post('tgl_dibuat_penyelia'));
			 $toview['comment_penyelia']=trim($this->input->post('comment_penyelia'));
			 $toview['nip_manager_teknis']=trim($this->input->post('nip_manager_teknis'));
			 $toview['nm_manager_teknis']=trim($this->input->post('nm_manager_teknis'));
			 $toview['tgl_dibuat_manager_teknis']=trim($this->input->post('tgl_dibuat_manager_teknis'));
			 $toview['comment_manager_teknis']=trim($this->input->post('comment_manager_teknis')); 
			 $toview['tgl_update']=date("Y-m-d H:i:s");
			 
			if($this->mRHU->getRHU('',$toview['no_pengujian'])){
				$file_dir='./download/rhu/'.date('Y-m').'/';
				
				if(!file_exists($file_dir)) {
					mkdir($file_dir);
				}else {
					//echo "<script>alert('Ok.file direktori sudah ada')</script>";
					$file_dir =$file_dir;
				}
					
				$syxupload['upload_path'] = $file_dir;
				$syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
				$syxupload['max_size']	= '2500';
				//$syxupload['max_width']  = '1024';
				//$syxupload['max_height']  = '768';
				$toview['cek_file'] = $data['upload_data']['file_name'];
				$this->load->library('upload', $syxupload);
				if (! $this->upload->do_upload())
				{
					if(empty($data['upload_data']['file_name'])){
						$result=$this->mRHU->Update($toview,$toview['kd_rhu']);
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Update tanpa Upload File RHU NO. ".$toview['kd_rhu']);
						redirect('order/update_sukses');
						//echo "<script>alert('File Berhasil disimpan')</script>";
						$toview['kd_order']='';
						
					}else{
						$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
					}
	
				}else{
					echo "<script>alert('test')</script>";
					$data = array('upload_data' => $this->upload->data());
					$toview['file_rhu']=$file_dir.$data['upload_data']['file_name'];
					$result=$this->mRHU->Update($toview,$toview['kd_rhu']);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Update Upload File RHU NO. ".$toview['kd_rhu']);
					redirect('order/update_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_order']='';
				}
			}
			
		  }
		}
				
		$rhu=$this->mRHU->getRHU($kd_rhu,'','');
		if($rhu){
		   foreach($rhu as $rowrhu){
			$toview['kd_rhu']=$rowrhu->kd_rhu; 
			$toview['no_pengujian']=$rowrhu->no_pengujian; 
			$toview['tgl_pengujian']=$rowrhu->tgl_pengujian;
			$toview['tgl_selesai_pengujian']=$rowrhu->tgl_selesai_pengujian;
			$toview['status_rhu']=$rowrhu->status_rhu; 
			$toview['no_order']=$rowrhu->no_order;
			$toview['kd_order']=$rowrhu->kd_order;
			$toview['kd_detail_order']=$rowrhu->kd_detail_order;
			$toview['file_rhu']=$rowrhu->file_rhu; 
			$toview['nip_penyelia']=$rowrhu->nip_penyelia; 
			$toview['nm_penyelia']=$rowrhu->nm_penyelia; 
			$toview['tgl_dibuat_penyelia']=$rowrhu->tgl_dibuat_penyelia; 
			$toview['comment_penyelia']=$rowrhu->comment_penyelia; 
			$toview['nip_manager_teknis']=$rowrhu->nip_manager_teknis ; 
			$toview['nm_manager_teknis']=$rowrhu->nm_manager_teknis; 
			$toview['tgl_disetujui_manager_teknis']=$rowrhu->tgl_disetujui_manager_teknis; 
			$toview['comment_manager_teknis']=$rowrhu->comment_manager_teknis; 
			
		   }
		}
		
		#judul
		$this->judul='<center>Edit Rekapitulasi Hasil Uji</br>(RHU)</center>';
		#javascript
		$this->javascript='
		<script type="text/javascript">
		$("#tgl_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
		});
		$("#tgl_selesai_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
		});
		$("#tgl_dibuat_penyelia").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 

			showOn: "both"
		});
		$("#tgl_disetujui_manager_teknis").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 

			showOn: "both"
		});
		
		</script>';
		
	         
		#load view
		$this->content=$this->load->view('rhu/penyelia/rhu_edit_penyelia',$toview);
	}

	//input RHU di detail order
	public function accRHUMt($kd_order,$kd_detail_order,$no_pengujian,$no_order='',$kd_rhu='',$status_rhu='',$tgl_pengujian='',$tgl_selesai_pengujian='',$file_rhu='',$nip_penyelia='',$nm_penyelia='',$tgl_dibuat_penyelia='',$comment_penyelia='',$nip_manager_teknis='',$nm_manager_teknis='',$tgl_disetujui_manager_teknis='',$comment_manager_teknis=''){
		$this->errormsg="";
		$this->form_validation->set_rules('status_rhu', 'Status RHU', 'required');
		$this->form_validation->set_message('required','%s Wajib diisi!');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');

		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			//echo "<script>alert('Error')</script>";
			 $toview['kd_rhu']=trim($this->input->post('kd_rhu'));
			 $toview['file_rhu']=trim($this->input->post('userfile'));
			 $toview['status_rhu']=trim($this->input->post('status_rhu'));
			 $toview['no_pengujian']=trim($this->input->post('no_pengujian'));
			 $toview['tgl_pengujian']=trim($this->input->post('tgl_pengujian'));
			 $toview['tgl_selesai_pengujian']=trim($this->input->post('tgl_selesai_pengujian'));

			 $toview['no_order']=trim($this->input->post('no_order'));
			 $toview['kd_order']=trim($this->input->post('kd_order'));
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
			 $toview['nip_penyelia']=trim($this->input->post('nip_penyelia'));
			 $toview['nm_penyelia']=trim($this->input->post('nm_penyelia'));
		         $toview['tgl_dibuat_penyelia']=trim($this->input->post('tgl_dibuat_penyelia'));
			 $toview['comment_penyelia']=trim($this->input->post('comment_penyelia'));
			 $toview['nip_wmanager_teknis']=trim($this->input->post('nip_wmanager_teknis'));
			 $toview['nm_wmanager_teknis']=trim($this->input->post('nm_wmanager_teknis'));
			 $toview['tgl_disetujui_wmanager_teknis']=trim($this->input->post('tgl_disetujui_wmanager_teknis'));
			 $toview['comment_wmanager_teknis']=trim($this->input->post('comment_wmanager_teknis')); 
			 $toview['nip_manager_teknis']=trim($this->input->post('nip_manager_teknis'));
			 $toview['nm_manager_teknis']=trim($this->input->post('nm_manager_teknis'));
			 $toview['tgl_disetujui_manager_teknis']=trim($this->input->post('tgl_disetujui_manager_teknis'));
			 $toview['comment_manager_teknis']=trim($this->input->post('comment_manager_teknis')); 
			 $toview['tgl_update']=date("Y-m-d H:i:s");
			 
			//if($this->mRHU->getRHU($toview['kd_rhu'],'')){
				$result=$this->mRHU->Update($toview,$toview['kd_rhu']);
			 	$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
				current_url(),"acc RHU NO. ".$toview['kd_rhu']);
				redirect('order/update_sukses');
				//echo "<script>alert('File Berhasil disimpan')</script>";
				//$toview['kd_rhu']='';
				
			//}
			
		  }
		}
		$rhu=$this->mRHU->getRHU($kd_rhu,'','');
		if($rhu){
		   foreach($rhu as $rowrhu){
			$toview['kd_rhu']=$rowrhu->kd_rhu; 
			$toview['no_pengujian']=$rowrhu->no_pengujian; 
			$toview['tgl_pengujian']=$rowrhu->tgl_pengujian;
			$toview['tgl_selesai_pengujian']=$rowrhu->tgl_selesai_pengujian;
			$toview['status_rhu']=$rowrhu->status_rhu; 
			$toview['no_order']=$rowrhu->no_order;
			$toview['kd_order']=$rowrhu->kd_order;
			$toview['kd_detail_order']=$rowrhu->kd_detail_order;
			$toview['file_rhu']=$rowrhu->file_rhu; 
			$toview['nip_penyelia']=$rowrhu->nip_penyelia; 
			$toview['nm_penyelia']=$rowrhu->nm_penyelia; 
			$toview['tgl_dibuat_penyelia']=$rowrhu->tgl_dibuat_penyelia; 
			$toview['comment_penyelia']=$rowrhu->comment_penyelia;
			$toview['nip_wmanager_teknis']=$rowrhu->nip_wmanager_teknis ; 
			$toview['nm_wmanager_teknis']=$rowrhu->nm_wmanager_teknis; 
			$toview['tgl_disetujui_wmanager_teknis']=$rowrhu->tgl_disetujui_wmanager_teknis; 
			$toview['comment_wmanager_teknis']=$rowrhu->comment_wmanager_teknis;  
			$toview['nip_manager_teknis']=$rowrhu->nip_manager_teknis ; 
			$toview['nm_manager_teknis']=$rowrhu->nm_manager_teknis; 
			$toview['tgl_disetujui_manager_teknis']=$rowrhu->tgl_disetujui_manager_teknis; 
			$toview['comment_manager_teknis']=$rowrhu->comment_manager_teknis; 
			
		   }
		}
		
		
		#judul
		$this->judul='<center>ACC Rekapitulasi Hasil Uji</br>(RHU)</center>';
		#javascript
		$this->javascript='
		<script type="text/javascript">
		
		$("#tgl_disetujui_manager_teknis").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 

			showOn: "both"
		});
		
		</script>';
		
	         
		#load view
		$this->content=$this->load->view('rhu/mt/acc_rhu_mt',$toview);
	}

	public function accRHUWMt($kd_order,$kd_detail_order,$no_pengujian,$no_order='',$kd_rhu='',$status_rhu='',$tgl_pengujian='',$tgl_selesai_pengujian='',$file_rhu='',$nip_penyelia='',$nm_penyelia='',$tgl_dibuat_penyelia='',$comment_penyelia='',$nip_manager_teknis='',$nm_manager_teknis='',$tgl_disetujui_manager_teknis='',$comment_manager_teknis=''){
		$this->errormsg="";
		$this->form_validation->set_rules('status_rhu', 'Status RHU', 'required');
		$this->form_validation->set_message('required','%s Wajib diisi!');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');

		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			//echo "<script>alert('Error')</script>";
			 $toview['kd_rhu']=trim($this->input->post('kd_rhu'));
			 $toview['file_rhu']=trim($this->input->post('userfile'));
			 $toview['status_rhu']=trim($this->input->post('status_rhu'));
			 $toview['no_pengujian']=trim($this->input->post('no_pengujian'));
			 $toview['tgl_pengujian']=trim($this->input->post('tgl_pengujian'));
			 $toview['tgl_selesai_pengujian']=trim($this->input->post('tgl_selesai_pengujian'));

			 $toview['no_order']=trim($this->input->post('no_order'));
			 $toview['kd_order']=trim($this->input->post('kd_order'));
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
			 $toview['nip_penyelia']=trim($this->input->post('nip_penyelia'));
			 $toview['nm_penyelia']=trim($this->input->post('nm_penyelia'));
		         $toview['tgl_dibuat_penyelia']=trim($this->input->post('tgl_dibuat_penyelia'));
			 $toview['comment_penyelia']=trim($this->input->post('comment_penyelia'));
			 $toview['nip_wmanager_teknis']=trim($this->input->post('nip_wmanager_teknis'));
			 $toview['nm_wmanager_teknis']=trim($this->input->post('nm_wmanager_teknis'));
			 $toview['tgl_disetujui_wmanager_teknis']=trim($this->input->post('tgl_disetujui_wmanager_teknis'));
			 $toview['comment_wmanager_teknis']=trim($this->input->post('comment_wmanager_teknis')); 
			 $toview['nip_manager_teknis']=trim($this->input->post('nip_manager_teknis'));
			 $toview['nm_manager_teknis']=trim($this->input->post('nm_manager_teknis'));
			 $toview['tgl_disetujui_manager_teknis']=trim($this->input->post('tgl_disetujui_manager_teknis'));
			 $toview['comment_manager_teknis']=trim($this->input->post('comment_manager_teknis')); 
			 $toview['tgl_update']=date("Y-m-d H:i:s");
			 
			//if($this->mRHU->getRHU($toview['kd_rhu'],'')){
				$result=$this->mRHU->Update($toview,$toview['kd_rhu']);
			 	$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
				current_url(),"acc RHU NO. ".$toview['kd_rhu']);
				redirect('order/update_sukses');
				//echo "<script>alert('File Berhasil disimpan')</script>";
				//$toview['kd_rhu']='';
				
			//}
			
		  }
		}
		$rhu=$this->mRHU->getRHU($kd_rhu,'','');
		if($rhu){
		   foreach($rhu as $rowrhu){
			$toview['kd_rhu']=$rowrhu->kd_rhu; 
			$toview['no_pengujian']=$rowrhu->no_pengujian; 
			$toview['tgl_pengujian']=$rowrhu->tgl_pengujian;
			$toview['tgl_selesai_pengujian']=$rowrhu->tgl_selesai_pengujian;
			$toview['status_rhu']=$rowrhu->status_rhu; 
			$toview['no_order']=$rowrhu->no_order;
			$toview['kd_order']=$rowrhu->kd_order;
			$toview['kd_detail_order']=$rowrhu->kd_detail_order;
			$toview['file_rhu']=$rowrhu->file_rhu; 
			$toview['nip_penyelia']=$rowrhu->nip_penyelia; 
			$toview['nm_penyelia']=$rowrhu->nm_penyelia; 
			$toview['tgl_dibuat_penyelia']=$rowrhu->tgl_dibuat_penyelia; 
			$toview['comment_penyelia']=$rowrhu->comment_penyelia; 
			$toview['nip_wmanager_teknis']=$rowrhu->nip_wmanager_teknis ; 
			$toview['nm_wmanager_teknis']=$rowrhu->nm_wmanager_teknis; 
			$toview['tgl_disetujui_wmanager_teknis']=$rowrhu->tgl_disetujui_wmanager_teknis; 
			$toview['comment_wmanager_teknis']=$rowrhu->comment_wmanager_teknis; 
			$toview['nip_manager_teknis']=$rowrhu->nip_manager_teknis ; 
			$toview['nm_manager_teknis']=$rowrhu->nm_manager_teknis; 
			$toview['tgl_disetujui_manager_teknis']=$rowrhu->tgl_disetujui_manager_teknis; 
			$toview['comment_manager_teknis']=$rowrhu->comment_manager_teknis; 
			
		   }
		}
		
		
		#judul
		$this->judul='<center>ACC Rekapitulasi Hasil Uji</br>(RHU)</center>';
		#javascript
		$this->javascript='

		<script type="text/javascript">
		
		$("#tgl_disetujui_wmanager_teknis").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 

			showOn: "both"
		});
		
		</script>';
		
	         
		#load view
		$this->content=$this->load->view('rhu/wmt/acc_rhu_wmt',$toview);
	}
	//input RHU di detail order
	public function viewRHU($kd_order,$kd_detail_order,$no_pengujian,$no_order='',$kd_rhu='',$status_rhu='',$tgl_pengujian='',$tgl_selesai_pengujian='',$file_rhu='',$nip_penyelia='',$nm_penyelia='',$tgl_dibuat_penyelia='',$comment_penyelia='',$nip_manager_teknis='',$nm_manager_teknis='',$tgl_disetujui_manager_teknis='',$comment_manager_teknis=''){
		
		$rhu=$this->mRHU->getRHU($kd_rhu,'','');
		if($rhu){
		   foreach($rhu as $rowrhu){
			$toview['kd_rhu']=$rowrhu->kd_rhu; 
			$toview['no_pengujian']=$rowrhu->no_pengujian; 
			$toview['tgl_pengujian']=$rowrhu->tgl_pengujian;
			$toview['tgl_selesai_pengujian']=$rowrhu->tgl_selesai_pengujian;
			$toview['status_rhu']=$rowrhu->status_rhu; 
			$toview['no_order']=$rowrhu->no_order;
			$toview['kd_order']=$rowrhu->kd_order;
			$toview['kd_detail_order']=$rowrhu->kd_detail_order;
			$toview['file_rhu']=$rowrhu->file_rhu; 
			$toview['nip_penyelia']=$rowrhu->nip_penyelia; 
			$toview['nm_penyelia']=$rowrhu->nm_penyelia; 
			$toview['tgl_dibuat_penyelia']=$rowrhu->tgl_dibuat_penyelia; 
			$toview['comment_penyelia']=$rowrhu->comment_penyelia; 
			$toview['nip_wmanager_teknis']=$rowrhu->nip_wmanager_teknis ; 
			$toview['nm_wmanager_teknis']=$rowrhu->nm_wmanager_teknis; 
			$toview['tgl_disetujui_wmanager_teknis']=$rowrhu->tgl_disetujui_wmanager_teknis; 
			$toview['comment_wmanager_teknis']=$rowrhu->comment_wmanager_teknis; 
			$toview['nip_manager_teknis']=$rowrhu->nip_manager_teknis ; 
			$toview['nm_manager_teknis']=$rowrhu->nm_manager_teknis; 
			$toview['tgl_disetujui_manager_teknis']=$rowrhu->tgl_disetujui_manager_teknis; 
			$toview['comment_manager_teknis']=$rowrhu->comment_manager_teknis; 
			
		   }
		}
		
		
		#judul
		$this->judul='<center>View Rekapitulasi Hasil Uji</br>(RHU)</center>';
		
	         
		#load view
		$this->content=$this->load->view('rhu/mt/rhu_view',$toview);
	}
/*
	//input shu di detail order
	public function inputSHUSertifikat($kd_order='',$kd_detail_order='',$kd_shu='',$no_pengujian='',$no_order='',$no_shu='',$status_shu='',
		$tgl_cetak='',$file_shu='',$tgl_order='',$tgl_perkiraan_selesai='',$tgl_pengujian='',$tgl_selesai_pengujian='',
		$nama_perusahaan='',$alamat_perusahaan='',$alamat_pabrik='',$nama_pengambil_sampling='',$nama_komoditi='',
		$tipe_komoditi='', $brand_komoditi='',$label_nokode_komoditi='',$jumlah_sampling='',
		$nip_pengetik_sertifikat='',$nm_pengetik_sertifikat='',$tgl_dibuat_pengetik_sertifikat='',
		$comment_pengetik_sertifikat='',$nip_manajer_teknis='',$nm_manager_teknis='',$tgl_disetujui_manajer_teknis='',
		$comment_manager_teknis='',$nip_penyerah_sertifikat='',$nm_penyerah_sertifikat='',$nm_penerima_sertifikat='',
		$tgl_diserahkan_sertifikat=''){
		$this->errormsg="";
		
		$this->form_validation->set_rules('no_shu', 'No SHU', 'required');
		$this->form_validation->set_rules('status_shu', 'Status SHU', 'required');
		$this->form_validation->set_message('required','%s Wajib diisi!');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		
		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			//echo "<script>alert('Error')</script>";
			 if($kd_shu) $toview['kd_shu']=trim($this->input->post('kd_shu'));
				else $toview['kd_shu']=$this->mOrder->Make_kd_shu();

			 $toview['no_shu']=trim($this->input->post('no_shu'));
			 $toview['tgl_cetak']=trim($this->input->post('tgl_cetak'));

			 $toview['file_shu']=trim($this->input->post('userfile'));

			 $toview['status_shu']=trim($this->input->post('status_shu'));
			 $toview['tgl_order']=trim($this->input->post('tgl_order'));
			 $toview['tgl_perkiraan_selesai']=trim($this->input->post('tgl_perkiraan_selesai'));
			 $toview['tgl_pengujian']=trim($this->input->post('tgl_pengujian'));
			 $toview['tgl_selesai_pengujian']=trim($this->input->post('tgl_selesai_pengujian'));

			 $toview['nama_perusahaan']=trim($this->input->post('nama_perusahaan'));
			 $toview['alamat_perusahaan']=trim($this->input->post('alamat_perusahaan'));
			 $toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
			 $toview['nama_pengambil_sampling']=trim($this->input->post('nama_pengambil_sampling'));
			 $toview['nama_komoditi']=trim($this->input->post('nama_komoditi'));
			 $toview['tipe_komoditi']=trim($this->input->post('tipe_komoditi'));
			 $toview['brand_komoditi']=trim($this->input->post('brand_komoditi'));
			 $toview['label_nokode_komoditi']=trim($this->input->post('label_nokode_komoditi'));
			 $toview['jumlah_sampling']=trim($this->input->post('jumlah_sampling'));	 
			 $toview['no_pengujian']=trim($this->input->post('no_pengujian'));
			 $toview['no_order']=trim($this->input->post('no_order'));
			 $toview['kd_order']=trim($this->input->post('kd_order'));
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
			 $toview['nip_pengetik_sertifikat']=trim($this->input->post('nip_pengetik_sertifikat'));
			 $toview['nm_pengetik_sertifikat']=trim($this->input->post('nm_pengetik_sertifikat'));
		         $toview['tgl_dibuat_pengetik_sertifikat']=trim($this->input->post('tgl_dibuat_pengetik_sertifikat'));
			 $toview['comment_pengetik_sertifikat']=trim($this->input->post('comment_pengetik_sertifikat'));
			 $toview['nip_manajer_teknis']=trim($this->input->post('nip_manajer_teknis'));
			 $toview['nm_manager_teknis']=trim($this->input->post('nm_manager_teknis'));
			 $toview['tgl_disetujui_manajer_teknis']=trim($this->input->post('tgl_disetujui_manajer_teknis'));
			 $toview['comment_manajer_teknis']=trim($this->input->post('comment_manajer_teknis')); 
			 $toview['nip_penyerah_sertifikat']=trim($this->input->post('nip_penyerah_sertifikat'));
			 $toview['nm_penyerah_sertifikat']=trim($this->input->post('nm_penyerah_sertifikat'));
			 $toview['nm_penerima_sertifikat']=trim($this->input->post('nm_penerima_sertifikat'));
			 $toview['tgl_diserahkan_sertifikat']=trim($this->input->post('tgl_diserahkan_sertifikat'));

			//if($this->mSHU->getSHU('',$toview['no_shu'])){ 
			  #jika kode order telah ada
			  //$this->errormsg='<em style="color:red">Nomor RHU sudah ada! Silahkan coba lagi.</em>';
			}
			if($this->errormsg=="") { 
			    $file_dir='./download/shu/'.date('Y-m').'/';
				
			    if(!file_exists($file_dir)) {
					mkdir($file_dir);
			    }else {
					echo "<script>alert('Ok.file direktori sudah ada')</script>";
					$file_dir =$file_dir;
			    }
				
			    //if(!file_exists($file_dir)) mkdir($file_dir);
			    $syxupload['upload_path'] = $file_dir;
			    $syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
			    $syxupload['max_size']	= '2500';
			    //$syxupload['max_width']  = '1024';
			    //$syxupload['max_height']  = '768';
				
			    $this->load->library('upload', $syxupload);

			    	
				if (! $this->upload->do_upload())
				{
					$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
					$toview['tgl_create']=date("Y-m-d H:i:s");
					$toview['file_shu']=$file_dir.$data['upload_data']['file_name'];
					$result = $this->mSHU->Save($toview,'','',false);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Upload File SHU");
					redirect('order/upload_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_order']='';
				}

			}
			 
			
			
		  }
		}
		
		$orderDetail = $this->mOrder->getTandaContoh($kd_detail_order);
                $order= $this->mOrder->getOrder($kd_order,false,'') ; 
		$sampling = $this->mOrder->getSamplingReportDetail('',$kd_order);
	        

		if($order){
			$no_order = $order->no_order;
			$nama_perusahaan =$order->nama_customer_tujuan;
			$alamat_perusahaan=$order->alamat_customer_tujuan;
			$tgl_order=$order->tgl_order;
			$tgl_perkiraan_selesai=$order->tgl_perkiraan_selesai;
		}
		if($orderDetail){
			$no_pengujian=$orderDetail->no_pengujian;
			$kd_detail_order=$orderDetail->kd_detail_order;
		}

		if($sampling){
			$nama_pengambil_sampling = $sampling->nama_pengambil_sampling; 
			$nama_komoditi = $sampling->nama_komoditi;
			$tipe_komoditi = $sampling->tipe_komoditi; 
			$brand_komoditi = $sampling->brand_komoditi;
			$label_nokode_komoditi = $sampling->label_nokode_sampling; 
			$jumlah_sampling = $sampling->jumlah_sampling;		
		}
		$customer = $this->mCustomer->GetResult(trim($order->nama_customer_tujuan),'','','','','nama','30','desc','');
	        $rhu=$this->mRHU->getRHU('',$no_pengujian,'');
		if($customer){
		foreach($customer as $row){
			$alamat_pabrik=$row->alamat_pabrik;
		}
		}
		if($rhu){
		   foreach($rhu as $rowrhu){
			$tgl_pengujian = $rowrhu->tgl_pengujian;
			$tgl_selesai_pengujian = $rowrhu->tgl_selesai_pengujian;
		   }
		}
		
		if($kd_shu) $toview['kd_shu']=$kd_shu; 
			else $toview['kd_shu']='';                               
		if($no_shu) $toview['no_shu']=$no_shu;
			else $toview['no_shu']='';                                 
		if($tgl_cetak) $toview['tgl_cetak']=$tgl_cetak;
			else $toview['tgl_cetak']='';
                            
		if($file_shu) $toview['file_shu']=$file_shu;
			else $toview['file_shu']='';
 
	        if($status_shu)  $toview['status_shu'] = $status_shu;
			else $toview['status_shu']='';                           
		if($tgl_order) $toview['tgl_order']=$tgl_order; 
			else $toview['tgl_order']='';
                            
		if($tgl_perkiraan_selesai) $toview['tgl_perkiraan_selesai']=$tgl_perkiraan_selesai;
			else $toview['tgl_perkiraan_selesai']='';  
               
		if($tgl_pengujian) $toview['tgl_pengujian']=$tgl_pengujian;
			else $toview['tgl_pengujian']=''; 
                     
		if($tgl_selesai_pengujian) $toview['tgl_selesai_pengujian']=$tgl_selesai_pengujian;

			else $toview['tgl_selesai_pengujian']='';            
		if($nama_perusahaan) $toview['nama_perusahaan']=$nama_perusahaan;
			else $toview['nama_perusahaan']='';                   
		if($alamat_perusahaan) $toview['alamat_perusahaan']=$alamat_perusahaan;
			else $toview['alamat_perusahaan']='';                 
		if($alamat_pabrik) $toview['alamat_pabrik']=$alamat_pabrik; 
			else $toview['alamat_pabrik']='';          
		if($nama_pengambil_sampling) $toview['nama_pengambil_sampling']=$nama_pengambil_sampling;
			else $toview['nama_pengambil_sampling']='';               
		if($nama_komoditi) $toview['nama_komoditi']=$nama_komoditi;
			else $toview['nama_komoditi']='';                         
		if($tipe_komoditi) $toview['tipe_komoditi']=$tipe_komoditi; 
			else $toview['tipe_komoditi']='';                       
		if($brand_komoditi) $toview['brand_komoditi']=$brand_komoditi;
			else $toview['brand_komoditi']='';                          
		if($label_nokode_komoditi) $toview['label_nokode_komoditi']=$label_nokode_komoditi; 
			else $toview['label_nokode_komoditi']='';               
		if($jumlah_sampling) $toview['jumlah_sampling']=$jumlah_sampling; 
			else $toview['jumlah_sampling']='';                        
		if($no_pengujian) $toview['no_pengujian']=$no_pengujian;
			else $toview['no_pengujian']='';                             
		if($no_order) $toview['no_order']=$no_order;
			else $toview['no_order']='';                                 
		if($kd_order) $toview['kd_order']=$kd_order;
			else $toview['kd_order']=''; 
                              
		if($kd_detail_order) $toview['kd_detail_order']=$kd_detail_order;
			else $toview['kd_detail_order']='';
                         
		if($nip_pengetik_sertifikat) $toview['nip_pengetik_sertifikat']=$nip_pengetik_sertifikat;
			else $toview['nip_pengetik_sertifikat']='';                
		if($nm_pengetik_sertifikat) $toview['nm_pengetik_sertifikat']=$nm_pengetik_sertifikat; 
			else $toview['nm_pengetik_sertifikat']='';                
		if($tgl_dibuat_pengetik_sertifikat) $toview['tgl_dibuat_pengetik_sertifikat']=$tgl_dibuat_pengetik_sertifikat;
			else $toview['tgl_dibuat_pengetik_sertifikat']='';           
		if($comment_pengetik_sertifikat) $toview['comment_pengetik_sertifikat']=$comment_pengetik_sertifikat; 
			else $toview['comment_pengetik_sertifikat']='';                   
		if($nip_manajer_teknis) $toview['nip_manajer_teknis']=$nip_manajer_teknis;
			else $toview['nip_manajer_teknis']='';                 
		if($nm_manager_teknis) $toview['nm_manager_teknis']=$nm_manager_teknis; 
			else $toview['nm_manager_teknis']='';                       
		if($tgl_disetujui_manajer_teknis) $toview['tgl_disetujui_manajer_teknis']=$tgl_disetujui_manajer_teknis;
			else $toview['tgl_disetujui_manajer_teknis']='';             
		if($comment_manager_teknis) $toview['comment_manajer_teknis']=$comment_manager_teknis; 
			else $toview['comment_manager_teknis']='';                  
		if($nip_penyerah_sertifikat) $toview['nip_penyerah_sertifikat']=$nip_penyerah_sertifikat;
			else $toview['nip_penyerah_sertifikat']='';                 
		if($no_pengujian) $toview['nm_penyerah_sertifikat']=$nm_penyerah_sertifikat; 
			else $toview['nm_penyerah_sertifikat ']='';                 
		if($nm_penerima_sertifikat) $toview['nm_penerima_sertifikat']=$nm_penerima_sertifikat;
			else $toview['nm_penerima_sertifikat']='';                  
		if($tgl_diserahkan_sertifikat) $toview['tgl_diserahkan_sertifikat']=$tgl_diserahkan_sertifikat;
			else $toview['tgl_diserahkan_sertifikat']='';
 		//if($tgl_create) $toview['tgl_create']=$tgl_create;
		//	else  $toview['tgl_create']='';
	    //    if($tgl_update) $toview['tgl_update']=$tgl_update;
		//	else $toview['tgl_update']='';//date("Y-m-d H:i:s");
		
		
		
		#judul
		$this->judul='<center>Input sertifikat Hasil Uji (SHU)</br>No. Order : '.$order->no_order.'</center>';
		#javascript
		$this->javascript='
			<script type="text/javascript">
		
			$("#tgl_cetak").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			$("#tgl_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			$("#tgl_selesai_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			
			$("#tgl_disetujui_manager_teknis").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			 
			$("#tgl_dibuat_pengetik_sertifikat").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
		
		</script>';
		
		#load view
		$this->content=$this->load->view('shu/sertifikat/shu_add_sertifikat',$toview);
	}

	public function inputSHU($kd_order='',$kd_detail_order='',$kd_shu='',$no_pengujian='',$no_order='',$no_shu='',$status_shu='',
		$tgl_cetak='',$file_shu='',$tgl_order='',$tgl_perkiraan_selesai='',$tgl_pengujian='',$tgl_selesai_pengujian='',
		$nama_perusahaan='',$alamat_perusahaan='',$alamat_pabrik='',$nama_pengambil_sampling='',$nama_komoditi='',
		$tipe_komoditi='', $brand_komoditi='',$label_nokode_komoditi='',$jumlah_sampling='',
		$nip_penyelia='',$nm_penyelia='',$tgl_dibuat_penyelia='',$comment_penyelia='',
		$nip_wmanajer_teknis='',$nm_wmanager_teknis='',$tgl_disetujui_wmanajer_teknis='',$comment_wmanager_teknis='',
		$nip_manajer_teknis='',$nm_manager_teknis='',$tgl_disetujui_manajer_teknis='',$comment_manager_teknis='',
		$nip_penyerah_sertifikat='',$nm_penyerah_sertifikat='',$nm_penerima_sertifikat='',
		$tgl_diserahkan_sertifikat=''){
		$this->errormsg="";
		
		$this->form_validation->set_rules('no_shu', 'No SHU', 'required');
		$this->form_validation->set_rules('status_shu', 'Status SHU', 'required');
		$this->form_validation->set_message('required','%s Wajib diisi!');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		
		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			//echo "<script>alert('Error')</script>";
			 if($kd_shu) $toview['kd_shu']=trim($this->input->post('kd_shu'));
				else $toview['kd_shu']=$this->mOrder->Make_kd_shu();

			 $toview['no_shu']=trim($this->input->post('no_shu'));
			 $toview['tgl_cetak']=trim($this->input->post('tgl_cetak'));

			 $toview['file_shu']=trim($this->input->post('userfile'));

			 $toview['status_shu']=trim($this->input->post('status_shu'));
			 $toview['tgl_order']=trim($this->input->post('tgl_order'));
			 $toview['tgl_perkiraan_selesai']=trim($this->input->post('tgl_perkiraan_selesai'));
			 $toview['tgl_pengujian']=trim($this->input->post('tgl_pengujian'));
			 $toview['tgl_selesai_pengujian']=trim($this->input->post('tgl_selesai_pengujian'));

			 $toview['nama_perusahaan']=trim($this->input->post('nama_perusahaan'));
			 $toview['alamat_perusahaan']=trim($this->input->post('alamat_perusahaan'));
			 $toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
			 $toview['nama_pengambil_sampling']=trim($this->input->post('nama_pengambil_sampling'));
			 $toview['nama_komoditi']=trim($this->input->post('nama_komoditi'));
			 $toview['tipe_komoditi']=trim($this->input->post('tipe_komoditi'));
			 $toview['brand_komoditi']=trim($this->input->post('brand_komoditi'));
			 $toview['label_nokode_komoditi']=trim($this->input->post('label_nokode_komoditi'));
			 $toview['jumlah_sampling']=trim($this->input->post('jumlah_sampling'));	 
			 $toview['no_pengujian']=trim($this->input->post('no_pengujian'));
			 $toview['no_order']=trim($this->input->post('no_order'));
			 $toview['kd_order']=trim($this->input->post('kd_order'));
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
			 $toview['nip_penyelia']=trim($this->input->post('nip_penyelia'));
			 $toview['nm_penyelia']=trim($this->input->post('nm_penyelia'));
		     $toview['tgl_dibuat_penyelia']=trim($this->input->post('tgl_dibuat_penyelia'));
			 $toview['comment_penyelia']=trim($this->input->post('comment_penyelia'));
			 //$toview['nip_wmanajer_teknis']=trim($this->input->post('nip_wmanajer_teknis'));
			 //$toview['nm_wmanager_teknis']=trim($this->input->post('nm_wmanager_teknis'));
			 //$toview['tgl_disetujui_wmanajer_teknis']=trim($this->input->post('tgl_disetujui_wmanajer_teknis'));
			 //$toview['comment_wmanajer_teknis']=trim($this->input->post('comment_wmanajer_teknis')); 
			 //$toview['nip_manajer_teknis']=trim($this->input->post('nip_manajer_teknis'));
			 //$toview['nm_manager_teknis']=trim($this->input->post('nm_manager_teknis'));
			 //$toview['tgl_disetujui_manajer_teknis']=trim($this->input->post('tgl_disetujui_manajer_teknis'));
			 //$toview['comment_manajer_teknis']=trim($this->input->post('comment_manajer_teknis')); 
			 //$toview['nip_penyerah_sertifikat']=trim($this->input->post('nip_penyerah_sertifikat'));
			 //$toview['nm_penyerah_sertifikat']=trim($this->input->post('nm_penyerah_sertifikat'));
			 //$toview['nm_penerima_sertifikat']=trim($this->input->post('nm_penerima_sertifikat'));
			 //$toview['tgl_diserahkan_sertifikat']=trim($this->input->post('tgl_diserahkan_sertifikat'));

			//if($this->mSHU->getSHU('',$toview['no_shu'])){ 

			  #jika kode order telah ada
			// $this->errormsg='<em style="color:red">Nomor RHU sudah ada! Silahkan coba lagi.</em>';
			//}
			if($this->errormsg=="") { 
			    $file_dir='./download/shu/'.date('Y-m').'/';
				
			    if(!file_exists($file_dir)) {
					mkdir($file_dir);
			    }else {
					echo "<script>alert('Ok.file direktori sudah ada')</script>";
					$file_dir =$file_dir;
			    }
				
			    //if(!file_exists($file_dir)) mkdir($file_dir);
			    $syxupload['upload_path'] = $file_dir;
			    $syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
			    $syxupload['max_size']	= '2500';
			    //$syxupload['max_width']  = '1024';
			    //$syxupload['max_height']  = '768';
				
			    $this->load->library('upload', $syxupload);

			    	
				if (! $this->upload->do_upload())
				{
					$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
					$toview['tgl_create']=date("Y-m-d H:i:s");
					$toview['file_shu']=$file_dir.$data['upload_data']['file_name'];
					$result = $this->mSHU->Save($toview,'','',false);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Upload File SHU");
					redirect('order/upload_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_order']='';
				}

			}
			 
			
			
		  }
		}
		
		$orderDetail = $this->mOrder->getTandaContoh($kd_detail_order);
                $order= $this->mOrder->getOrder($kd_order,false,'') ; 
		$sampling = $this->mOrder->getSamplingReportDetail('',$kd_order);
	        

		if($order){
			$no_order = $order->no_order;
			$nama_perusahaan =$order->nama_customer_tujuan;
			$alamat_perusahaan=$order->alamat_customer_tujuan;
			$tgl_order=$order->tgl_order;
			$tgl_perkiraan_selesai=$order->tgl_perkiraan_selesai;
			$sampling_order=$order->sampling_order;
		}
		if($orderDetail){
			$no_pengujian=$orderDetail->no_pengujian;
			$kd_detail_order=$orderDetail->kd_detail_order;
		}

		if($sampling){
			//$toview['sampling']=$sampling;
			$nama_pengambil_sampling = $sampling->nama_pengambil_sampling; 
			$nama_komoditi = $sampling->nama_komoditi;
			$tipe_komoditi = $sampling->tipe_komoditi; 
			$brand_komoditi = $sampling->brand_komoditi;
			$label_nokode_komoditi = $sampling->label_nokode_sampling; 
			$jumlah_sampling = $sampling->jumlah_sampling;		
		}else{
			//$toview['sampling']=0;
		}
		$customer = $this->mCustomer->GetResult(trim($order->nama_customer_tujuan),'','','','','nama','30','desc','');
	        $rhu=$this->mRHU->getRHU('',$no_pengujian,'');
		if($customer){
		foreach($customer as $row){
			$alamat_pabrik=$row->alamat_pabrik;
		}
		}
		if($rhu){
		   foreach($rhu as $rowrhu){
			$tgl_pengujian = $rowrhu->tgl_pengujian;
			$tgl_selesai_pengujian = $rowrhu->tgl_selesai_pengujian;
		   }
		}
		
		if($kd_shu) $toview['kd_shu']=$kd_shu; 
			else $toview['kd_shu']='';                               
		if($no_shu) $toview['no_shu']=$no_shu;
			else $toview['no_shu']='';                                 
		if($tgl_cetak) $toview['tgl_cetak']=$tgl_cetak;
			else $toview['tgl_cetak']='';
                            
		if($file_shu) $toview['file_shu']=$file_shu;
			else $toview['file_shu']='';
 
	        if($status_shu)  $toview['status_shu'] = $status_shu;
			else $toview['status_shu']='';                           
		if($tgl_order) $toview['tgl_order']=$tgl_order; 
			else $toview['tgl_order']='';
                            
		if($tgl_perkiraan_selesai) $toview['tgl_perkiraan_selesai']=$tgl_perkiraan_selesai;
			else $toview['tgl_perkiraan_selesai']='';  
		if($sampling_order) $toview['sampling_order']=$sampling_order;
			else $toview['sampling_order']=''; 
               
		if($tgl_pengujian) $toview['tgl_pengujian']=$tgl_pengujian;
			else $toview['tgl_pengujian']=''; 
                     
		if($tgl_selesai_pengujian) $toview['tgl_selesai_pengujian']=$tgl_selesai_pengujian;

			else $toview['tgl_selesai_pengujian']='';            
		if($nama_perusahaan) $toview['nama_perusahaan']=$nama_perusahaan;
			else $toview['nama_perusahaan']='';                   
		if($alamat_perusahaan) $toview['alamat_perusahaan']=$alamat_perusahaan;
			else $toview['alamat_perusahaan']='';                 
		if($alamat_pabrik) $toview['alamat_pabrik']=$alamat_pabrik; 
			else $toview['alamat_pabrik']='';          
		if($nama_pengambil_sampling) $toview['nama_pengambil_sampling']=$nama_pengambil_sampling;
			else $toview['nama_pengambil_sampling']='';               
		if($nama_komoditi) $toview['nama_komoditi']=$nama_komoditi;
			else $toview['nama_komoditi']='';                         
		if($tipe_komoditi) $toview['tipe_komoditi']=$tipe_komoditi; 
			else $toview['tipe_komoditi']='';                       
		if($brand_komoditi) $toview['brand_komoditi']=$brand_komoditi;
			else $toview['brand_komoditi']='';                          
		if($label_nokode_komoditi) $toview['label_nokode_komoditi']=$label_nokode_komoditi; 
			else $toview['label_nokode_komoditi']='';               
		if($jumlah_sampling) $toview['jumlah_sampling']=$jumlah_sampling; 
			else $toview['jumlah_sampling']='';                        
		if($no_pengujian) $toview['no_pengujian']=$no_pengujian;
			else $toview['no_pengujian']='';                             
		if($no_order) $toview['no_order']=$no_order;
			else $toview['no_order']='';                                 
		if($kd_order) $toview['kd_order']=$kd_order;
			else $toview['kd_order']=''; 
                              
		if($kd_detail_order) $toview['kd_detail_order']=$kd_detail_order;
			else $toview['kd_detail_order']='';
                         
		if($nip_penyelia) $toview['nip_penyelia']=$nip_penyelia;
			else $toview['nip_penyelia']='';                
		if($nm_penyelia) $toview['nm_penyelia']=$nm_penyelia; 
			else $toview['nm_penyelia']='';                
		if($tgl_dibuat_penyelia) $toview['tgl_dibuat_penyelia']=$tgl_dibuat_penyelia;
			else $toview['tgl_dibuat_penyelia']='';           
		if($comment_penyelia) $toview['comment_penyelia']=$comment_penyelia; 
			else $toview['comment_penyelia']='';
                if($nip_wmanajer_teknis) $toview['nip_wmanajer_teknis']=$nip_wmanajer_teknis;
			else $toview['nip_wmanajer_teknis']='';                 
		if($nm_wmanager_teknis) $toview['nm_wmanager_teknis']=$nm_wmanager_teknis; 
			else $toview['nm_wmanager_teknis']='';                       
		if($tgl_disetujui_wmanajer_teknis) $toview['tgl_disetujui_wmanajer_teknis']=$tgl_disetujui_wmanajer_teknis;
			else $toview['tgl_disetujui_wmanajer_teknis']='';             
		if($comment_wmanager_teknis) $toview['comment_wmanajer_teknis']=$comment_wmanager_teknis; 
			else $toview['comment_wmanager_teknis']='';   
		if($nip_manajer_teknis) $toview['nip_manajer_teknis']=$nip_manajer_teknis;
			else $toview['nip_manajer_teknis']='';                 
		if($nm_manager_teknis) $toview['nm_manager_teknis']=$nm_manager_teknis; 
			else $toview['nm_manager_teknis']='';                       
		if($tgl_disetujui_manajer_teknis) $toview['tgl_disetujui_manajer_teknis']=$tgl_disetujui_manajer_teknis;
			else $toview['tgl_disetujui_manajer_teknis']='';             
		if($comment_manager_teknis) $toview['comment_manajer_teknis']=$comment_manager_teknis; 
			else $toview['comment_manager_teknis']='';                  
		if($nip_penyerah_sertifikat) $toview['nip_penyerah_sertifikat']=$nip_penyerah_sertifikat;
			else $toview['nip_penyerah_sertifikat']='';                 
		if($no_pengujian) $toview['nm_penyerah_sertifikat']=$nm_penyerah_sertifikat; 
			else $toview['nm_penyerah_sertifikat ']='';                 
		if($nm_penerima_sertifikat) $toview['nm_penerima_sertifikat']=$nm_penerima_sertifikat;
			else $toview['nm_penerima_sertifikat']='';                  
		if($tgl_diserahkan_sertifikat) $toview['tgl_diserahkan_sertifikat']=$tgl_diserahkan_sertifikat;
			else $toview['tgl_diserahkan_sertifikat']='';
 		//if($tgl_create) $toview['tgl_create']=$tgl_create;
		//	else  $toview['tgl_create']='';
	    //    if($tgl_update) $toview['tgl_update']=$tgl_update;
		//	else $toview['tgl_update']='';//date("Y-m-d H:i:s");
		
		
		
		#judul
		$this->judul='<center>Input sertifikat Hasil Uji (SHU)</br>No. Order : '.$order->no_order.'</center>';
		#javascript
		$this->javascript='
			<script type="text/javascript">
		
			$("#tgl_cetak").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			$("#tgl_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			$("#tgl_selesai_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			
			$("#tgl_disetujui_manager_teknis").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",

				showOn: "both"
			});

			$("#tgl_disetujui_wmanager_teknis").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			 
			$("#tgl_dibuat_penyelia").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
		
		</script>';
		
		#load view
		$this->content=$this->load->view('shu/penyelia/shu_add_penyelia',$toview);
	}
	//edit shu di detail order
	public function editSHUSertifikat($kd_order='',$kd_detail_order='',$kd_shu='',$no_pengujian='',$no_order='',$no_shu='',$status_shu='',
		$tgl_cetak='',$file_shu='',$tgl_order='',$tgl_perkiraan_selesai='',$tgl_pengujian='',$tgl_selesai_pengujian='',
		$nama_perusahaan='',$alamat_perusahaan='',$alamat_pabrik='',$nama_pengambil_sampling='',$nama_komoditi='',
		$tipe_komoditi='', $brand_komoditi='',$label_nokode_komoditi='',$jumlah_sampling='',
		$nip_pengetik_sertifikat='',$nm_pengetik_sertifikat='',$tgl_dibuat_pengetik_sertifikat='',$comment_pengetik_sertifikat='',
		$nip_manajer_teknis='',$nm_manajer_teknis='',$tgl_disetujui_manajer_teknis='',$comment_manajer_teknis='',
		$nip_penyerah_sertifikat='',$nm_penyerah_sertifikat='',$nm_penerima_sertifikat='',$tgl_diserahkan_sertifikat=''){
		
		$this->errormsg="";
		$this->form_validation->set_rules('no_shu', 'No SHU', 'required');
		$this->form_validation->set_rules('status_shu', 'Status SHU', 'required');
		$this->form_validation->set_message('required','%s Wajib diisi!');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		
		if($this->input->post('save')){
		  echo "<script>alert('save ok')</script>";
		  if($this->form_validation->run())
		  {
		     echo "<script>alert('validasi ok')</script>";
			
	             $toview['kd_shu']=trim($this->input->post('kd_shu'));
			$kod= $toview['kd_shu'];
				
		     echo "<script>alert('$kod')</script>";

		     $toview['no_shu']=trim($this->input->post('no_shu'));
		     $toview['tgl_cetak']=trim($this->input->post('tgl_cetak'));

		    

		     $toview['status_shu']=trim($this->input->post('status_shu'));
		     $toview['tgl_order']=trim($this->input->post('tgl_order'));
		     $toview['tgl_perkiraan_selesai']=trim($this->input->post('tgl_perkiraan_selesai'));

		     $toview['tgl_pengujian']=trim($this->input->post('tgl_pengujian'));

		     $toview['tgl_selesai_pengujian']=trim($this->input->post('tgl_selesai_pengujian'));

		     $toview['nama_perusahaan']=trim($this->input->post('nama_perusahaan'));
		     $toview['alamat_perusahaan']=trim($this->input->post('alamat_perusahaan'));
		     $toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
		     $toview['nama_pengambil_sampling']=trim($this->input->post('nama_pengambil_sampling'));
		     $toview['nama_komoditi']=trim($this->input->post('nama_komoditi'));
		     $toview['tipe_komoditi']=trim($this->input->post('tipe_komoditi'));
		     $toview['brand_komoditi']=trim($this->input->post('brand_komoditi'));
		     $toview['label_nokode_komoditi']=trim($this->input->post('label_nokode_komoditi'));
		     $toview['jumlah_sampling']=trim($this->input->post('jumlah_sampling'));	 
		     $toview['no_pengujian']=trim($this->input->post('no_pengujian'));
		     $toview['no_order']=trim($this->input->post('no_order'));
		     $toview['kd_order']=trim($this->input->post('kd_order'));
		     $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
		     $toview['nip_pengetik_sertifikat']=trim($this->input->post('nip_pengetik_sertifikat'));
		     $toview['nm_pengetik_sertifikat']=trim($this->input->post('nm_pengetik_sertifikat'));
		     $toview['tgl_dibuat_pengetik_sertifikat']=trim($this->input->post('tgl_dibuat_pengetik_sertifikat'));
		     $toview['comment_pengetik_sertifikat']=trim($this->input->post('comment_pengetik_sertifikat'));
		     $toview['nip_manajer_teknis']=trim($this->input->post('nip_manajer_teknis'));
		     $toview['nm_manager_teknis']=trim($this->input->post('nm_manager_teknis'));
		     $toview['tgl_disetujui_manajer_teknis']=trim($this->input->post('tgl_disetujui_manajer_teknis'));
		     $toview['comment_manajer_teknis']=trim($this->input->post('comment_manajer_teknis')); 
		     $toview['nip_penyerah_sertifikat']=trim($this->input->post('nip_penyerah_sertifikat'));
		     $toview['nm_penyerah_sertifikat']=trim($this->input->post('nm_penyerah_sertifikat'));
		     $toview['nm_penerima_sertifikat']=trim($this->input->post('nm_penerima_sertifikat'));
		     $toview['tgl_diserahkan_sertifikat']=trim($this->input->post('tgl_diserahkan_sertifikat'));

	             //if($this->mSHU->getSHU($toview['no_shu'],'','')){ 
			  
			//echo "<script>alert('get shu  ok')</script>";
			if($this->errormsg=="") { 
			    //echo "<script>alert('get nga error ok')</script>";
			    $file_dir='./download/shu/'.date('Y-m').'/';
				
			    if(!file_exists($file_dir)) {
					mkdir($file_dir);
			    }else {
					echo "<script>alert('Ok.file direktori sudah ada')</script>";
					$file_dir =$file_dir;
			    }
				
			    //if(!file_exists($file_dir)) mkdir($file_dir);
			    $syxupload['upload_path'] = $file_dir;
			    $syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
			    $syxupload['max_size']	= '2500';
			    //$syxupload['max_width']  = '1024';
			    //$syxupload['max_height']  = '768';
				
			    $this->load->library('upload', $syxupload);
			    $edit = trim($this->input->post('edit'));
			   
				if (! $this->upload->do_upload())
				{
					//echo "<script>alert('test tanpa upload')</script>";
					if(empty($data['upload_data']['file_name'])){
						$toview['tgl_update']=date("Y-m-d H:i:s");						
						$result =$this->mSHU->Save($toview,'',$toview['kd_shu'],true);
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Update tanpa Upload File SHU NO. ".$toview['kd_shu']);
						//echo "<script>alert(".$toview['kd_shu'].")</script>";
						//echo "<script>alert('update disimpan tanpa upload')</script>";
						redirect('order/update_sukses');
						$toview['kd_order']='';
						
					}else{
						$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
					}
	
				}else{
					//echo "<script>alert('test dengan upload')</script>";
					$data = array('upload_data' => $this->upload->data());
				        $toview['tgl_update']=date("Y-m-d H:i:s");
					//$toview['file_shu']=trim($this->input->post('userfile'));
					$toview['file_shu']=$file_dir.$data['upload_data']['file_name'];
					$result =$this->mSHU->Save($toview,'',$toview['kd_shu'],true);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Update Upload File SHU NO. ".$toview['kd_shu']);
					//echo "<script>alert('update Berhasil disimpan dengana upload')</script>";
					redirect('order/update_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_order']='';
				}
			  
			 }//else { echo "<script>alert('error not ok')</script>";}
		       //}else { echo "<script>alert('get shu not ok')</script>";}
		  }//else { echo "<script>alert('validasi not ok')</script>";}
		}//else { echo "<script>alert('save not ok')</script>";}
		
		$shu=$this->mSHU->getSHU($kd_shu,'','','');
		
		$toview['kd_shu']=$shu->kd_shu; 
		$toview['no_shu']=$shu->no_shu;
		$toview['tgl_cetak']=$shu->tgl_cetak;
		$toview['file_shu']=$shu->file_shu;
		$toview['status_shu'] =$shu->status_shu;
		$toview['tgl_order']=$shu->tgl_order; 
		$toview['tgl_perkiraan_selesai']=$shu->tgl_perkiraan_selesai;
		$toview['tgl_pengujian']=$shu->tgl_pengujian;
		$toview['tgl_selesai_pengujian']=$shu->tgl_selesai_pengujian;
		$toview['nama_perusahaan']=$shu->nama_perusahaan;
		$toview['alamat_perusahaan']=$shu->alamat_perusahaan;
		$toview['alamat_pabrik']=$shu->alamat_pabrik; 
		$toview['nama_pengambil_sampling']=$shu->nama_pengambil_sampling;
		$toview['nama_komoditi']=$shu->nama_komoditi;
		$toview['tipe_komoditi']=$shu->tipe_komoditi; 
		$toview['brand_komoditi']=$shu->brand_komoditi;
		$toview['label_nokode_komoditi']=$shu->label_nokode_komoditi; 
		$toview['jumlah_sampling']=$shu->jumlah_sampling; 
		$toview['no_pengujian']=$shu->no_pengujian;
		$toview['no_order']=$shu->no_order;
		$toview['kd_order']=$shu->kd_order;
		$toview['kd_detail_order']=$shu->kd_detail_order;
		$toview['nip_pengetik_sertifikat']=$shu->nip_pengetik_sertifikat;
		$toview['nm_pengetik_sertifikat']=$shu->nm_pengetik_sertifikat; 
		$toview['tgl_dibuat_pengetik_sertifikat']=$shu->tgl_dibuat_pengetik_sertifikat;
		$toview['comment_pengetik_sertifikat']=$shu->comment_pengetik_sertifikat; 
		$toview['nip_manajer_teknis']=$shu->nip_manajer_teknis;
		$toview['nm_manajer_teknis']=$shu->nm_manajer_teknis; 
		$toview['tgl_disetujui_manajer_teknis']=$shu->tgl_disetujui_manajer_teknis;
		$toview['comment_manajer_teknis']=$shu->comment_manajer_teknis; 
		$toview['nip_penyerah_sertifikat']=$shu->nip_penyerah_sertifikat;
		$toview['nm_penyerah_sertifikat']=$shu->nm_penyerah_sertifikat; 
		$toview['nm_penerima_sertifikat']=$shu->nm_penerima_sertifikat;
		$toview['tgl_diserahkan_sertifikat']=$shu->tgl_diserahkan_sertifikat;			
 		//if($tgl_create) $toview['tgl_create']=$tgl_create;
		//	else  $toview['tgl_create']='';
	     //   if($tgl_update) $toview['tgl_update']=$tgl_update;
		//	else $toview['tgl_update']='';//date("Y-m-d H:i:s");
		
		
		
		#judul
		$this->judul='<center>Input sertifikat Hasil Uji (SHU)</br>No. Order : '.$no_order.'</center>';
		#javascript
		$this->javascript='
			<script type="text/javascript">
		
			$("#tgl_cetak").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			$("#tgl_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			$("#tgl_selesai_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			
			$("#tgl_disetujui_manager_teknis").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			 
			$("#tgl_dibuat_pengetik_sertifikat").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			
			
		
		</script>';
		
		#load view
		$this->content=$this->load->view('shu/sertifikat/shu_edit_sertifikat',$toview);
	}

	//edit shu di detail order
	public function editSHU($kd_order='',$kd_detail_order='',$kd_shu='',$no_pengujian='',$no_order='',$no_shu='',$status_shu='',
		$tgl_cetak='',$file_shu='',$tgl_order='',$tgl_perkiraan_selesai='',$tgl_pengujian='',$tgl_selesai_pengujian='',
		$nama_perusahaan='',$alamat_perusahaan='',$alamat_pabrik='',$nama_pengambil_sampling='',$nama_komoditi='',
		$tipe_komoditi='', $brand_komoditi='',$label_nokode_komoditi='',$jumlah_sampling='',
		$nip_penyelia='',$nm_penyelia='',$tgl_dibuat_penyelia='',$comment_penyelia='',
		$nip_wmanajer_teknis='',$nm_wmanager_teknis='',$tgl_disetujui_wmanajer_teknis='',$comment_wmanager_teknis='',
		$nip_manajer_teknis='',$nm_manager_teknis='',$tgl_disetujui_manajer_teknis='',$comment_manager_teknis='',
		$nip_penyerah_sertifikat='',$nm_penyerah_sertifikat='',$nm_penerima_sertifikat='',$tgl_diserahkan_sertifikat=''){
		
		$this->errormsg="";
		$this->form_validation->set_rules('no_shu', 'No SHU', 'required');
		$this->form_validation->set_rules('status_shu', 'Status SHU', 'required');
		$this->form_validation->set_message('required','%s Wajib diisi!');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		
		if($this->input->post('save')){
		  echo "<script>alert('save ok')</script>";
		  if($this->form_validation->run())
		  {
		     echo "<script>alert('validasi ok')</script>";
			
	             $toview['kd_shu']=trim($this->input->post('kd_shu'));
			$kod= $toview['kd_shu'];
				
		     echo "<script>alert('$kod')</script>";

		     $toview['no_shu']=trim($this->input->post('no_shu'));
		     $toview['tgl_cetak']=trim($this->input->post('tgl_cetak'));

		    

		     $toview['status_shu']=trim($this->input->post('status_shu'));
		     $toview['tgl_order']=trim($this->input->post('tgl_order'));
		     $toview['tgl_perkiraan_selesai']=trim($this->input->post('tgl_perkiraan_selesai'));
		     $toview['tgl_pengujian']=trim($this->input->post('tgl_pengujian'));
		     $toview['tgl_selesai_pengujian']=trim($this->input->post('tgl_selesai_pengujian'));

		     $toview['nama_perusahaan']=trim($this->input->post('nama_perusahaan'));
		     $toview['alamat_perusahaan']=trim($this->input->post('alamat_perusahaan'));
		     $toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
		     $toview['nama_pengambil_sampling']=trim($this->input->post('nama_pengambil_sampling'));
		     $toview['nama_komoditi']=trim($this->input->post('nama_komoditi'));
		     $toview['tipe_komoditi']=trim($this->input->post('tipe_komoditi'));
		     $toview['brand_komoditi']=trim($this->input->post('brand_komoditi'));
		     $toview['label_nokode_komoditi']=trim($this->input->post('label_nokode_komoditi'));
		     $toview['jumlah_sampling']=trim($this->input->post('jumlah_sampling'));	 
		     $toview['no_pengujian']=trim($this->input->post('no_pengujian'));
		     $toview['no_order']=trim($this->input->post('no_order'));
		     $toview['kd_order']=trim($this->input->post('kd_order'));
		     $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
		     $toview['nip_penyelia']=trim($this->input->post('nip_penyelia'));
		     $toview['nm_penyelia']=trim($this->input->post('nm_penyelia'));
		     $toview['tgl_dibuat_penyelia']=trim($this->input->post('tgl_dibuat_penyelia'));
		     $toview['comment_penyelia']=trim($this->input->post('comment_penyelia'));
		     //$toview['nip_wmanajer_teknis']=trim($this->input->post('nip_wmanajer_teknis'));
		     //$toview['nm_wmanager_teknis']=trim($this->input->post('nm_wmanager_teknis'));
		     //$toview['tgl_disetujui_wmanajer_teknis']=trim($this->input->post('tgl_disetujui_wmanajer_teknis'));
		     // $toview['comment_wmanajer_teknis']=trim($this->input->post('comment_wmanajer_teknis')); 
		     //$toview['nip_manajer_teknis']=trim($this->input->post('nip_manajer_teknis'));
		     //$toview['nm_manager_teknis']=trim($this->input->post('nm_manager_teknis'));
		     //$toview['tgl_disetujui_manajer_teknis']=trim($this->input->post('tgl_disetujui_manajer_teknis'));
		     //$toview['comment_manajer_teknis']=trim($this->input->post('comment_manajer_teknis')); 
		     //$toview['nip_penyerah_sertifikat']=trim($this->input->post('nip_penyerah_sertifikat'));
		     //$toview['nm_penyerah_sertifikat']=trim($this->input->post('nm_penyerah_sertifikat'));
		     //$toview['nm_penerima_sertifikat']=trim($this->input->post('nm_penerima_sertifikat'));
		     //$toview['tgl_diserahkan_sertifikat']=trim($this->input->post('tgl_diserahkan_sertifikat'));

	             //if($this->mSHU->getSHU($toview['no_shu'],'','')){ 
			  
			//echo "<script>alert('get shu  ok')</script>";
			if($this->errormsg=="") { 
			    //echo "<script>alert('get nga error ok')</script>";
			    $file_dir='./download/shu/'.date('Y-m').'/';
				
			    if(!file_exists($file_dir)) {
					mkdir($file_dir);
			    }else {
					echo "<script>alert('Ok.file direktori sudah ada')</script>";
					$file_dir =$file_dir;
			    }
				
			    //if(!file_exists($file_dir)) mkdir($file_dir);
			    $syxupload['upload_path'] = $file_dir;
			    $syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
			    $syxupload['max_size']	= '2500';
			    //$syxupload['max_width']  = '1024';
			    //$syxupload['max_height']  = '768';
				
			    $this->load->library('upload', $syxupload);
			    $edit = trim($this->input->post('edit'));
			   
				if (! $this->upload->do_upload())
				{
					//echo "<script>alert('test tanpa upload')</script>";
					if(empty($data['upload_data']['file_name'])){
						$toview['tgl_update']=date("Y-m-d H:i:s");						
						$result =$this->mSHU->Save($toview,'',$toview['kd_shu'],true);
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Update tanpa Upload File SHU NO. ".$toview['kd_shu']);
						//echo "<script>alert('update disimpan tanpa upload')</script>";
						redirect('order/update_sukses');
						$toview['kd_order']='';
						
					}else{
						$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
					}
	
				}else{
					//echo "<script>alert('test dengan upload')</script>";
					$data = array('upload_data' => $this->upload->data());
				        $toview['tgl_update']=date("Y-m-d H:i:s");
					//$toview['file_shu']=trim($this->input->post('userfile'));
					$toview['file_shu']=$file_dir.$data['upload_data']['file_name'];
					$result =$this->mSHU->Save($toview,'',$toview['kd_shu'],true);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Update Upload File SHU NO. ".$toview['kd_shu']);
					//echo "<script>alert('update Berhasil disimpan dengana upload')</script>";
					redirect('order/update_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_order']='';
				}
			  
			 }//else { echo "<script>alert('error not ok')</script>";}
		       //}else { echo "<script>alert('get shu not ok')</script>";}
		  }//else { echo "<script>alert('validasi not ok')</script>";}
		}//else { echo "<script>alert('save not ok')</script>";}
		
                $order= $this->mOrder->getOrder($kd_order,false,'') ; 
		
		if($order){
			$no_order = $order->no_order;
			$nama_perusahaan =$order->nama_customer_tujuan;
			$alamat_perusahaan=$order->alamat_customer_tujuan;
			$tgl_order=$order->tgl_order;
			$tgl_perkiraan_selesai=$order->tgl_perkiraan_selesai;
			$sampling_order=$order->sampling_order;
		}
		

		$shu=$this->mSHU->getSHU($kd_shu,'','','');
		
		$toview['kd_shu']=$shu->kd_shu; 
		$toview['no_shu']=$shu->no_shu;
		$toview['tgl_cetak']=$shu->tgl_cetak;
		$toview['file_shu']=$shu->file_shu;
		$toview['status_shu'] =$shu->status_shu;
		$toview['tgl_order']=$shu->tgl_order; 
		$toview['tgl_perkiraan_selesai']=$shu->tgl_perkiraan_selesai;
		$toview['tgl_pengujian']=$shu->tgl_pengujian;
		$toview['tgl_selesai_pengujian']=$shu->tgl_selesai_pengujian;
		$toview['nama_perusahaan']=$shu->nama_perusahaan;
		$toview['alamat_perusahaan']=$shu->alamat_perusahaan;
		$toview['alamat_pabrik']=$shu->alamat_pabrik; 
		$toview['nama_pengambil_sampling']=$shu->nama_pengambil_sampling;
		$toview['nama_komoditi']=$shu->nama_komoditi;
		$toview['tipe_komoditi']=$shu->tipe_komoditi; 
		$toview['brand_komoditi']=$shu->brand_komoditi;
		$toview['label_nokode_komoditi']=$shu->label_nokode_komoditi; 
		$toview['jumlah_sampling']=$shu->jumlah_sampling; 
		$toview['no_pengujian']=$shu->no_pengujian;
		$toview['no_order']=$shu->no_order;
		$toview['kd_order']=$shu->kd_order;
		$toview['kd_detail_order']=$shu->kd_detail_order;
		$toview['nip_penyelia']=$shu->nip_penyelia;
		$toview['nm_penyelia']=$shu->nm_penyelia; 
		$toview['tgl_dibuat_penyelia']=$shu->tgl_dibuat_penyelia;
		$toview['comment_penyelia']=$shu->comment_penyelia; 
		$toview['nip_wmanajer_teknis']=$shu->nip_wmanajer_teknis;
		$toview['nm_wmanajer_teknis']=$shu->nm_wmanajer_teknis; 
		$toview['tgl_disetujui_wmanajer_teknis']=$shu->tgl_disetujui_wmanajer_teknis;
		$toview['comment_wmanajer_teknis']=$shu->comment_wmanajer_teknis; 
		$toview['nip_manajer_teknis']=$shu->nip_manajer_teknis;
		$toview['nm_manajer_teknis']=$shu->nm_manajer_teknis; 
		$toview['tgl_disetujui_manajer_teknis']=$shu->tgl_disetujui_manajer_teknis;
		$toview['comment_manajer_teknis']=$shu->comment_manajer_teknis; 
		$toview['nip_penyerah_sertifikat']=$shu->nip_penyerah_sertifikat;
		$toview['nm_penyerah_sertifikat']=$shu->nm_penyerah_sertifikat; 
		$toview['nm_penerima_sertifikat']=$shu->nm_penerima_sertifikat;
		$toview['tgl_diserahkan_sertifikat']=$shu->tgl_diserahkan_sertifikat;			
 		//if($tgl_create) $toview['tgl_create']=$tgl_create;
		//	else  $toview['tgl_create']='';
	     //   if($tgl_update) $toview['tgl_update']=$tgl_update;
		//	else $toview['tgl_update']='';//date("Y-m-d H:i:s");
		//if($sampling_order) $toview['sampling_order']=$sampling_order;
		//	else $toview['sampling_order']=''; 
		
		
		#judul
		$this->judul='<center>Input sertifikat Hasil Uji (SHU)</br>No. Order : '.$no_order.'</center>';
		#javascript
		$this->javascript='
			<script type="text/javascript">
		

			$("#tgl_cetak").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});

			$("#tgl_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});

			$("#tgl_selesai_pengujian").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});

			
			$("#tgl_disetujui_manager_teknis").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"

			});
			$("#tgl_disetujui_wmanager_teknis").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			})
			 
			$("#tgl_dibuat_penyelia").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",

				showOn: "both"
			});
			
			
		

		</script>';
		
		#load view
		$this->content=$this->load->view('shu/penyelia/shu_edit_penyelia',$toview);
	}
	//edit shu di detail order
	public function accSHUWMt($kd_order='',$kd_detail_order='',$kd_shu='',$no_pengujian='',$no_order='',$no_shu='',$status_shu='',
		$tgl_cetak='',$file_shu='',$tgl_order='',$tgl_perkiraan_selesai='',$tgl_pengujian='',$tgl_selesai_pengujian='',
		$nama_perusahaan='',$alamat_perusahaan='',$alamat_pabrik='',$nama_pengambil_sampling='',$nama_komoditi='',
		$tipe_komoditi='', $brand_komoditi='',$label_nokode_komoditi='',$jumlah_sampling='',
		$nip_pengetik_sertifikat='',$nm_pengetik_sertifikat='',$tgl_dibuat_pengetik_sertifikat='',
		$comment_pengetik_sertifikat='',$nip_manajer_teknis='',$nm_manajer_teknis='',$tgl_disetujui_manajer_teknis='',
		$comment_manager_teknis='',$nip_penyerah_sertifikat='',$nm_penyerah_sertifikat='',$nm_penerima_sertifikat='',
		$tgl_diserahkan_sertifikat=''){
		$this->errormsg="";
		
		$this->form_validation->set_rules('status_shu', 'Status SHU', 'required');
		$this->form_validation->set_message('required','%s Wajib diisi!');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		
		if($this->input->post('save')){
		  //echo "<script>alert('save ok')</script>";
		  if($this->form_validation->run())
		  {
		     //echo "<script>alert('validasi ok')</script>";
			
	             $toview['kd_shu']=trim($this->input->post('kd_shu'));
			//$kod= $toview['kd_shu'];
				
		     //echo "<script>alert('$kod')</script>";
		     $toview['status_shu']=trim($this->input->post('status_shu'));	    
		     $toview['nip_wmanajer_teknis']=trim($this->input->post('nip_wmanajer_teknis'));
		     $toview['nm_wmanajer_teknis']=trim($this->input->post('nm_wmanajer_teknis'));			
		     $toview['tgl_disetujui_wmanajer_teknis']=trim($this->input->post('tgl_disetujui_wmanajer_teknis'));
		     $toview['comment_wmanajer_teknis']=trim($this->input->post('comment_wmanajer_teknis'));
		     
		     //$toview['nip_penyerah_sertifikat']=trim($this->input->post('nip_penyerah_sertifikat'));
		     //$toview['nm_penyerah_sertifikat']=trim($this->input->post('nm_penyerah_sertifikat'));
		     //$toview['nm_penerima_sertifikat']=trim($this->input->post('nm_penerima_sertifikat'));
		     //$toview['tgl_diserahkan_sertifikat']=trim($this->input->post('tgl_diserahkan_sertifikat'));

	             //if($this->mSHU->getSHU($toview['no_shu'],'','')){ 
			  
			//echo "<script>alert('get shu  ok')</script>";
			if($this->errormsg=="") { 
			    //echo "<script>alert('get nga error ok')</script>";
			    $file_dir='./download/shu/'.date('Y-m').'/';
				
			    if(!file_exists($file_dir)) {
					mkdir($file_dir);
			    }else {
					//echo "<script>alert('Ok.file direktori sudah ada')</script>";
					$file_dir =$file_dir;
			    }
				
			    //if(!file_exists($file_dir)) mkdir($file_dir);
			    $syxupload['upload_path'] = $file_dir;
			    $syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
			    $syxupload['max_size']	= '2500';
			    //$syxupload['max_width']  = '1024';
			    //$syxupload['max_height']  = '768';
				
			    $this->load->library('upload', $syxupload);
			    $edit = trim($this->input->post('edit'));
			   
				if (! $this->upload->do_upload())
				{
					//echo "<script>alert('test tanpa upload')</script>";
					if(empty($data['upload_data']['file_name'])){
						$toview['tgl_update']=date("Y-m-d H:i:s");						
						$result =$this->mSHU->Save($toview,'',$toview['kd_shu'],true);
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Update tanpa Upload File SHU NO. ".$toview['kd_shu']);
						//echo "<script>alert('$toview['kd_shu']')</script>";
						//echo "<script>alert('update disimpan tanpa upload')</script>";
						
					//Start menghitung total jumlah sertifikat dengan status disetujui 
					//dan mengupdate work_order_pengujian dengan status sertifikat Selesai
					//(semua disetujui)
					$jum_shu=$this->mOrder->getSHU($kd_order,'',true);					
					$res=$this->mOrder->getDetail('',false,$kd_order);
	   				$jum_sertifikat=0;
					$kdshu = array();
					$jum_status_disetujui=0;
	   				if($res){
					     foreach($res as $dat){
					         $jum_sertifikat +=$dat->jumlah_sertifikat;
				             }	
					     if($jum_shu==$jum_sertifikat){
				                 $shu=$this->mSHU->getSHU('','','',$kd_order);
				                 //echo "Jumlah SHU : ".count($shu)."</br> ";						    
					         foreach($shu as $dat1){
   						    //echo $dat1->status_shu."</br> ";
					            if($dat1->status_shu == "disetujui"){
							$jum_status_disetujui++;
					            }
					         }     
					         if($jum_status_disetujui==$jum_sertifikat){
						    //echo "jum total disetujui : ".$jum_status_disetujui;
						    $tosave['kd_order']=$kd_order;
						    $tosave['status_order']="Sertifikat Selesai";
			                            $this->mOrder->saveOrder($tosave,$kd_order,true,false);
					         }	     
					     }
					 }
					 // end hitung------------------------------------------
					 // end	hitung ------------------------------------------------
					  redirect('order/update_sukses');
					  //$toview['kd_order']='';
						
					}else{
						$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
					}
	
				}else{
					//echo "<script>alert('test dengan upload')</script>";
					$data = array('upload_data' => $this->upload->data());
				        $toview['tgl_update']=date("Y-m-d H:i:s");
					//$toview['file_shu']=trim($this->input->post('userfile'));
					$toview['file_shu']=$file_dir.$data['upload_data']['file_name'];
					$result =$this->mSHU->Save($toview,'',$toview['kd_shu'],true);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Update Upload File SHU NO. ".$toview['kd_shu']);
					//echo "<script>alert('update Berhasil disimpan dengana upload')</script>";
					//Start menghitung total jumlah sertifikat dengan status disetujui 
					//dan mengupdate work_order_pengujian dengan status sertifikat Selesai
					//(semua disetujui)
					$jum_shu=$this->mOrder->getSHU($kd_order,'',true);					
					$res=$this->mOrder->getDetail('',false,$kd_order);
	   				$jum_sertifikat=0;
					$kdshu = array();
					$jum_status_disetujui=0;
	   				if($res){
					     foreach($res as $dat){
					         $jum_sertifikat +=$dat->jumlah_sertifikat;
				             }	
					     if($jum_shu==$jum_sertifikat){
				                 $shu=$this->mSHU->getSHU('','','',$kd_order);
				                 //echo "Jumlah SHU : ".count($shu)."</br> ";						    
					         foreach($shu as $dat1){
   						    //echo $dat1->status_shu."</br> ";
					            if($dat1->status_shu == "disetujui"){
							$jum_status_disetujui++;
					            }
					         }     
					         if($jum_status_disetujui==$jum_sertifikat){
						    //echo "jum total disetujui : ".$jum_status_disetujui;
						    $tosave['kd_order']=$kd_order;
						    $tosave['status_order']="Sertifikat Selesai";
			                            $this->mOrder->saveOrder($tosave,$kd_order,true,false);
					         }	     
					     }
					 }
					 // end hitung------------------------------------------
					 // end	hitung ------------------------------------------------

					redirect('order/update_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					//$toview['kd_order']='';
				}
			  
			 }//else { echo "<script>alert('error not ok')</script>";}
		       //}else { echo "<script>alert('get shu not ok')</script>";}
		  }//else { echo "<script>alert('validasi not ok')</script>";}
		}//else { echo "<script>alert('save not ok')</script>";}
		
		$shu=$this->mSHU->getSHU($kd_shu,'','','');
		
		$toview['kd_shu']=$shu->kd_shu; 
		$toview['no_shu']=$shu->no_shu;
		$toview['tgl_cetak']=$shu->tgl_cetak;
		$toview['file_shu']=$shu->file_shu;
		$toview['status_shu'] =$shu->status_shu;
		$toview['tgl_order']=$shu->tgl_order; 
		$toview['tgl_perkiraan_selesai']=$shu->tgl_perkiraan_selesai;
		$toview['tgl_pengujian']=$shu->tgl_pengujian;
		$toview['tgl_selesai_pengujian']=$shu->tgl_selesai_pengujian;
		$toview['nama_perusahaan']=$shu->nama_perusahaan;
		$toview['alamat_perusahaan']=$shu->alamat_perusahaan;
		$toview['alamat_pabrik']=$shu->alamat_pabrik; 
		$toview['nama_pengambil_sampling']=$shu->nama_pengambil_sampling;
		$toview['nama_komoditi']=$shu->nama_komoditi;
		$toview['tipe_komoditi']=$shu->tipe_komoditi; 
		$toview['brand_komoditi']=$shu->brand_komoditi;
		$toview['label_nokode_komoditi']=$shu->label_nokode_komoditi; 
		$toview['jumlah_sampling']=$shu->jumlah_sampling; 
		$toview['no_pengujian']=$shu->no_pengujian;
		$toview['no_order']=$shu->no_order;
		$toview['kd_order']=$shu->kd_order;
		$toview['kd_detail_order']=$shu->kd_detail_order;
		$toview['nip_penyelia']=$shu->nip_penyelia;
		$toview['nm_penyelia']=$shu->nm_penyelia; 
		$toview['tgl_dibuat_penyelia']=$shu->tgl_dibuat_penyelia;
		$toview['comment_penyelia']=$shu->comment_penyelia; 
		$toview['nip_wmanajer_teknis']=$shu->nip_wmanajer_teknis;
		$toview['nm_wmanajer_teknis']=$shu->nm_wmanajer_teknis; 
		$toview['tgl_disetujui_wmanajer_teknis']=$shu->tgl_disetujui_wmanajer_teknis;
		$toview['comment_wmanajer_teknis']=$shu->comment_wmanajer_teknis; 
		$toview['nip_manajer_teknis']=$shu->nip_manajer_teknis;
		$toview['nm_manajer_teknis']=$shu->nm_manajer_teknis; 
		$toview['tgl_disetujui_manajer_teknis']=$shu->tgl_disetujui_manajer_teknis;
		$toview['comment_manajer_teknis']=$shu->comment_manajer_teknis; 
		$toview['nip_penyerah_sertifikat']=$shu->nip_penyerah_sertifikat;
		$toview['nm_penyerah_sertifikat']=$shu->nm_penyerah_sertifikat; 
		$toview['nm_penerima_sertifikat']=$shu->nm_penerima_sertifikat;
		$toview['tgl_diserahkan_sertifikat']=$shu->tgl_diserahkan_sertifikat;			
 		//if($tgl_create) $toview['tgl_create']=$tgl_create;
		//	else  $toview['tgl_create']='';
	    //    if($tgl_update) $toview['tgl_update']=$tgl_update;
		//	else $toview['tgl_update']='';//date("Y-m-d H:i:s");
		
		
		
		#judul
		$this->judul='<center>Input sertifikat Hasil Uji (SHU)</br>No. Order : '.$no_order.'</center>';
		#javascript
		$this->javascript='
			<script type="text/javascript">
			
			$("#tgl_disetujui_manajer_teknis").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			
		</script>';
		
		#load view
		$this->content=$this->load->view('shu/wmt/acc_shu_wmt',$toview);
	}
	//edit shu di detail order
	public function accSHUMt($kd_order='',$kd_detail_order='',$kd_shu='',$no_pengujian='',$no_order='',$no_shu='',$status_shu='',
		$tgl_cetak='',$file_shu='',$tgl_order='',$tgl_perkiraan_selesai='',$tgl_pengujian='',$tgl_selesai_pengujian='',
		$nama_perusahaan='',$alamat_perusahaan='',$alamat_pabrik='',$nama_pengambil_sampling='',$nama_komoditi='',
		$tipe_komoditi='', $brand_komoditi='',$label_nokode_komoditi='',$jumlah_sampling='',
		$nip_pengetik_sertifikat='',$nm_pengetik_sertifikat='',$tgl_dibuat_pengetik_sertifikat='',
		$comment_pengetik_sertifikat='',$nip_manajer_teknis='',$nm_manajer_teknis='',$tgl_disetujui_manajer_teknis='',
		$comment_manager_teknis='',$nip_penyerah_sertifikat='',$nm_penyerah_sertifikat='',$nm_penerima_sertifikat='',
		$tgl_diserahkan_sertifikat=''){
		$this->errormsg="";
		
		$this->form_validation->set_rules('status_shu', 'Status SHU', 'required');
		$this->form_validation->set_message('required','%s Wajib diisi!');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		
		if($this->input->post('save')){
		  //echo "<script>alert('save ok')</script>";
		  if($this->form_validation->run())
		  {
		     //echo "<script>alert('validasi ok')</script>";
			
	             $toview['kd_shu']=trim($this->input->post('kd_shu'));
			//$kod= $toview['kd_shu'];
				
		     //echo "<script>alert('$kod')</script>";
		     $toview['status_shu']=trim($this->input->post('status_shu'));	    
		     $toview['nip_manajer_teknis']=trim($this->input->post('nip_manajer_teknis'));
		     $toview['nm_manajer_teknis']=trim($this->input->post('nm_manajer_teknis'));
			
		     $toview['tgl_disetujui_manajer_teknis']=trim($this->input->post('tgl_disetujui_manajer_teknis'));
		     $toview['comment_manajer_teknis']=trim($this->input->post('comment_manajer_teknis'));
			//$kod=  $toview['nm_manajer_teknis'];
		        //echo "<script>alert('$kod')</script>"; 
		     $toview['nip_penyerah_sertifikat']=trim($this->input->post('nip_penyerah_sertifikat'));
		     $toview['nm_penyerah_sertifikat']=trim($this->input->post('nm_penyerah_sertifikat'));
		     $toview['nm_penerima_sertifikat']=trim($this->input->post('nm_penerima_sertifikat'));
		     $toview['tgl_diserahkan_sertifikat']=trim($this->input->post('tgl_diserahkan_sertifikat'));

	             //if($this->mSHU->getSHU($toview['no_shu'],'','')){ 
			  
			//echo "<script>alert('get shu  ok')</script>";
			if($this->errormsg=="") { 
			    //echo "<script>alert('get nga error ok')</script>";
			    $file_dir='./download/shu/'.date('Y-m').'/';
				
			    if(!file_exists($file_dir)) {
					mkdir($file_dir);
			    }else {
					//echo "<script>alert('Ok.file direktori sudah ada')</script>";
					$file_dir =$file_dir;
			    }
				
			    //if(!file_exists($file_dir)) mkdir($file_dir);
			    $syxupload['upload_path'] = $file_dir;
			    $syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
			    $syxupload['max_size']	= '2500';
			    //$syxupload['max_width']  = '1024';
			    //$syxupload['max_height']  = '768';
				
			    $this->load->library('upload', $syxupload);
			    $edit = trim($this->input->post('edit'));
			   
				if (! $this->upload->do_upload())
				{
					//echo "<script>alert('test tanpa upload')</script>";
					if(empty($data['upload_data']['file_name'])){
						$toview['tgl_update']=date("Y-m-d H:i:s");						
						$result =$this->mSHU->Save($toview,'',$toview['kd_shu'],true);
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Update tanpa Upload File SHU NO. ".$toview['kd_shu']);
						//echo "<script>alert('$toview['kd_shu']')</script>";
						//echo "<script>alert('update disimpan tanpa upload')</script>";
						
					//Start menghitung total jumlah sertifikat dengan status disetujui 
					//dan mengupdate work_order_pengujian dengan status sertifikat Selesai
					//(semua disetujui)
					$jum_shu=$this->mOrder->getSHU($kd_order,'',true);					
					$res=$this->mOrder->getDetail('',false,$kd_order);
	   				$jum_sertifikat=0;
					$kdshu = array();
					$jum_status_disetujui=0;
	   				if($res){
					     foreach($res as $dat){
					         $jum_sertifikat +=$dat->jumlah_sertifikat;
				             }	
					     if($jum_shu==$jum_sertifikat){
				                 $shu=$this->mSHU->getSHU('','','',$kd_order);
				                 //echo "Jumlah SHU : ".count($shu)."</br> ";						    
					         foreach($shu as $dat1){
   						    //echo $dat1->status_shu."</br> ";
					            if($dat1->status_shu == "Disetujui"){
							$jum_status_disetujui++;
					            }
					         }     
					         if($jum_status_disetujui==$jum_sertifikat){
						    //echo "jum total disetujui : ".$jum_status_disetujui;
						    $tosave['kd_order']=$kd_order;
						    $tosave['status_order']="Sertifikat Selesai";
			                            $this->mOrder->saveOrder($tosave,$kd_order,true,false);
					         }	     
					     }
					 }
					 // end hitung------------------------------------------
					 // end	hitung ------------------------------------------------
					  redirect('order/update_sukses');
					  //$toview['kd_order']='';
						
					}else{
						$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
					}
	
				}else{
					//echo "<script>alert('test dengan upload')</script>";
					$data = array('upload_data' => $this->upload->data());
				        $toview['tgl_update']=date("Y-m-d H:i:s");
					//$toview['file_shu']=trim($this->input->post('userfile'));
					$toview['file_shu']=$file_dir.$data['upload_data']['file_name'];
					$result =$this->mSHU->Save($toview,'',$toview['kd_shu'],true);
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Update Upload File SHU NO. ".$toview['kd_shu']);
					//echo "<script>alert('update Berhasil disimpan dengana upload')</script>";
					//Start menghitung total jumlah sertifikat dengan status disetujui 
					//dan mengupdate work_order_pengujian dengan status sertifikat Selesai
					//(semua disetujui)
					$jum_shu=$this->mOrder->getSHU($kd_order,'',true);					
					$res=$this->mOrder->getDetail('',false,$kd_order);
	   				$jum_sertifikat=0;
					$kdshu = array();
					$jum_status_disetujui=0;
	   				if($res){
					     foreach($res as $dat){
					         $jum_sertifikat +=$dat->jumlah_sertifikat;
				             }	
					     if($jum_shu==$jum_sertifikat){
				                 $shu=$this->mSHU->getSHU('','','',$kd_order);
				                 //echo "Jumlah SHU : ".count($shu)."</br> ";						    
					         foreach($shu as $dat1){
   						    //echo $dat1->status_shu."</br> ";
					            if($dat1->status_shu == "disetujui"){
							$jum_status_disetujui++;
					            }
					         }     
					         if($jum_status_disetujui==$jum_sertifikat){
						    //echo "jum total disetujui : ".$jum_status_disetujui;
						    $tosave['kd_order']=$kd_order;
						    $tosave['status_order']="Sertifikat Selesai";
			                            $this->mOrder->saveOrder($tosave,$kd_order,true,false);
					         }	     
					     }
					 }
					 // end hitung------------------------------------------
					 // end	hitung ------------------------------------------------

					redirect('order/update_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					//$toview['kd_order']='';
				}
			  
			 }//else { echo "<script>alert('error not ok')</script>";}
		       //}else { echo "<script>alert('get shu not ok')</script>";}
		  }//else { echo "<script>alert('validasi not ok')</script>";}
		}//else { echo "<script>alert('save not ok')</script>";}
		
		$shu=$this->mSHU->getSHU($kd_shu,'','','');
		
		$toview['kd_shu']=$shu->kd_shu; 
		$toview['no_shu']=$shu->no_shu;
		$toview['tgl_cetak']=$shu->tgl_cetak;
		$toview['file_shu']=$shu->file_shu;
		$toview['status_shu'] =$shu->status_shu;
		$toview['tgl_order']=$shu->tgl_order; 
		$toview['tgl_perkiraan_selesai']=$shu->tgl_perkiraan_selesai;
		$toview['tgl_pengujian']=$shu->tgl_pengujian;
		$toview['tgl_selesai_pengujian']=$shu->tgl_selesai_pengujian;
		$toview['nama_perusahaan']=$shu->nama_perusahaan;
		$toview['alamat_perusahaan']=$shu->alamat_perusahaan;
		$toview['alamat_pabrik']=$shu->alamat_pabrik; 
		$toview['nama_pengambil_sampling']=$shu->nama_pengambil_sampling;
		$toview['nama_komoditi']=$shu->nama_komoditi;
		$toview['tipe_komoditi']=$shu->tipe_komoditi; 
		$toview['brand_komoditi']=$shu->brand_komoditi;
		$toview['label_nokode_komoditi']=$shu->label_nokode_komoditi; 
		$toview['jumlah_sampling']=$shu->jumlah_sampling; 
		$toview['no_pengujian']=$shu->no_pengujian;
		$toview['no_order']=$shu->no_order;
		$toview['kd_order']=$shu->kd_order;
		$toview['kd_detail_order']=$shu->kd_detail_order;
		$toview['nip_penyelia']=$shu->nip_penyelia;
		$toview['nm_penyelia']=$shu->nm_penyelia; 
		$toview['tgl_dibuat_penyelia']=$shu->tgl_dibuat_penyelia;
		$toview['comment_penyelia']=$shu->comment_penyelia; 
		$toview['nip_wmanajer_teknis']=$shu->nip_wmanajer_teknis;
		$toview['nm_wmanajer_teknis']=$shu->nm_wmanajer_teknis; 
		$toview['tgl_disetujui_wmanajer_teknis']=$shu->tgl_disetujui_wmanajer_teknis;
		$toview['comment_wmanajer_teknis']=$shu->comment_wmanajer_teknis; 
		$toview['nip_manajer_teknis']=$shu->nip_manajer_teknis;
		$toview['nm_manajer_teknis']=$shu->nm_manajer_teknis; 
		$toview['tgl_disetujui_manajer_teknis']=$shu->tgl_disetujui_manajer_teknis;
		$toview['comment_manajer_teknis']=$shu->comment_manajer_teknis; 
		$toview['nip_penyerah_sertifikat']=$shu->nip_penyerah_sertifikat;
		$toview['nm_penyerah_sertifikat']=$shu->nm_penyerah_sertifikat; 
		$toview['nm_penerima_sertifikat']=$shu->nm_penerima_sertifikat;
		$toview['tgl_diserahkan_sertifikat']=$shu->tgl_diserahkan_sertifikat;			
 		//if($tgl_create) $toview['tgl_create']=$tgl_create;
		//	else  $toview['tgl_create']='';
	    //    if($tgl_update) $toview['tgl_update']=$tgl_update;
		//	else $toview['tgl_update']='';//date("Y-m-d H:i:s");
		
		//echo $toview['file_shu'];
		
		#judul
		$this->judul='<center>Input sertifikat Hasil Uji (SHU)</br>No. Order : '.$no_order.'</center>';
		#javascript
		$this->javascript='
			<script type="text/javascript">

			
			$("#tgl_disetujui_manajer_teknis").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			
		</script>';
		
		#load view
		$this->content=$this->load->view('shu/mt/acc_shu_mt',$toview);
	}
	//edit shu di detail order
	public function viewSHU($kd_order='',$kd_detail_order='',$kd_shu='',$no_pengujian='',$no_order='',$no_shu='',$status_shu='',
		$tgl_cetak='',$file_shu='',$tgl_order='',$tgl_perkiraan_selesai='',$tgl_pengujian='',$tgl_selesai_pengujian='',
		$nama_perusahaan='',$alamat_perusahaan='',$alamat_pabrik='',$nama_pengambil_sampling='',$nama_komoditi='',
		$tipe_komoditi='', $brand_komoditi='',$label_nokode_komoditi='',$jumlah_sampling='',
		$nip_pengetik_sertifikat='',$nm_pengetik_sertifikat='',$tgl_dibuat_pengetik_sertifikat='',
		$comment_pengetik_sertifikat='',$nip_manajer_teknis='',$nm_manajer_teknis='',$tgl_disetujui_manajer_teknis='',
		$comment_manager_teknis='',$nip_penyerah_sertifikat='',$nm_penyerah_sertifikat='',$nm_penerima_sertifikat='',
		$tgl_diserahkan_sertifikat=''){
		
		
		$shu=$this->mSHU->getSHU($kd_shu,'','','');
		
		$toview['kd_shu']=$shu->kd_shu; 
		$toview['no_shu']=$shu->no_shu;
		$toview['tgl_cetak']=$shu->tgl_cetak;
		$toview['file_shu']=$shu->file_shu;
		$toview['status_shu'] =$shu->status_shu;
		$toview['tgl_order']=$shu->tgl_order; 
		$toview['tgl_perkiraan_selesai']=$shu->tgl_perkiraan_selesai;
		$toview['tgl_pengujian']=$shu->tgl_pengujian;
		$toview['tgl_selesai_pengujian']=$shu->tgl_selesai_pengujian;
		$toview['nama_perusahaan']=$shu->nama_perusahaan;
		$toview['alamat_perusahaan']=$shu->alamat_perusahaan;
		$toview['alamat_pabrik']=$shu->alamat_pabrik; 
		$toview['nama_pengambil_sampling']=$shu->nama_pengambil_sampling;
		$toview['nama_komoditi']=$shu->nama_komoditi;
		$toview['tipe_komoditi']=$shu->tipe_komoditi; 
		$toview['brand_komoditi']=$shu->brand_komoditi;
		$toview['label_nokode_komoditi']=$shu->label_nokode_komoditi; 
		$toview['jumlah_sampling']=$shu->jumlah_sampling; 
		$toview['no_pengujian']=$shu->no_pengujian;
		$toview['no_order']=$shu->no_order;
		$toview['kd_order']=$shu->kd_order;
		$toview['kd_detail_order']=$shu->kd_detail_order;
		$toview['nip_penyelia']=$shu->nip_penyelia;
		$toview['nm_penyelia']=$shu->nm_penyelia; 
		$toview['tgl_dibuat_penyelia']=$shu->tgl_dibuat_penyelia;
		$toview['comment_penyelia']=$shu->comment_penyelia; 
		$toview['nip_wmanajer_teknis']=$shu->nip_wmanajer_teknis;
		$toview['nm_wmanajer_teknis']=$shu->nm_wmanajer_teknis; 
		$toview['tgl_disetujui_wmanajer_teknis']=$shu->tgl_disetujui_wmanajer_teknis;
		$toview['comment_wmanajer_teknis']=$shu->comment_wmanajer_teknis; 
		$toview['nip_manajer_teknis']=$shu->nip_manajer_teknis;
		$toview['nm_manajer_teknis']=$shu->nm_manajer_teknis; 
		$toview['tgl_disetujui_manajer_teknis']=$shu->tgl_disetujui_manajer_teknis;
		$toview['comment_manajer_teknis']=$shu->comment_manajer_teknis; 
		$toview['nip_penyerah_sertifikat']=$shu->nip_penyerah_sertifikat;
		$toview['nm_penyerah_sertifikat']=$shu->nm_penyerah_sertifikat; 
		$toview['nm_penerima_sertifikat']=$shu->nm_penerima_sertifikat;
		$toview['tgl_diserahkan_sertifikat']=$shu->tgl_diserahkan_sertifikat;			
 		//if($tgl_create) $toview['tgl_create']=$tgl_create;
			//else  $toview['tgl_create']='';
	       // if($tgl_update) $toview['tgl_update']=$tgl_update;
			//else $toview['tgl_update']='';//date("Y-m-d H:i:s");
		
		
		
		#judul
		//$this->judul='<center>Sertifikat Hasil Uji (SHU)</br>No. Order : '.$no_order.'</center>';
		#javascript
		
		#load view
		$this->content=$this->load->view('shu/mt/shu_view',$toview);
	}

	//edit shu di detail order
	public function serahTerimaSHU($kd_order,$status_order='',$stgl_create='',$nip='',$keterangan='',$komentar=''){
		$this->errormsg="";
		$result=$this->mOrder->getOrder($kd_order);
		$this->form_validation->set_rules('nm_penerima_sertifikat', 
			'<font size="2.5" color="red">Nama Penerima Sertifikat</font>', 'required');
		$this->form_validation->set_rules('tgl_diserahkan_sertifikat', 
			'<font size="2.5" color="red">Tgl. diserahkan sertifikat</font>', 'required');
		$this->form_validation->set_message('required','%s <font size="2.5" color="red">Wajib diisi!</font>');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');

		if($this->input->post('save')){	
		    if($this->form_validation->run())
		    {
			 
		      $shu=$this->mSHU->getSHU('','','',$kd_order);			     				    
	              foreach($shu as $dat){
			// $toview['kd_order']=$dat->kd_order;					
			 $toview['nip_penyerah_sertifikat'] = trim($this->input->post('nip_penyerah_sertifikat'));
			 $toview['nm_penyerah_sertifikat'] = trim($this->input->post('nm_penyerah_sertifikat'));
			 $toview['nm_penerima_sertifikat'] = trim($this->input->post('nm_penerima_sertifikat'));
			 $toview['tgl_diserahkan_sertifikat']=trim($this->input->post('tgl_diserahkan_sertifikat'));
			 $toview['tgl_update']=date("Y-m-d H:i:s");
			 $this->mSHU->Save($toview,'',$dat->kd_shu,true); 
		      }
			 $tosavewo['kd_order']=$kd_order;
			 $tosavewo['status_order']="Closed";
			 $this->mOrder->saveOrder($tosavewo,$kd_order,true,false);
			 redirect('order/update_sukses');
			// echo "<script>alert('Test Berhasil disimpan')</script>";
		    }			
		}
		
		$toview['nip_penyerah_sertifikat']='';
	        $toview['nm_penyerah_sertifikat']='';
		$toview['nm_penerima_sertifikat']='';
		$toview['tgl_diserahkan_sertifikat']='';
                
		
		#judul
		$this->judul='<center>Proses Serah Terima Sertifikat</br>"'.$result->no_order.'"</center>';
		#javascript
		$this->javascript='

			<script type="text/javascript">
			
			$("#tgl_diserahkan_sertifikat").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",

				showOn: "both"
			});
			
		</script>';
		#load view
		$this->content=$this->load->view('order/pengujian/penerima/serah_terima_shu',$toview);
	}
  
  	public function kirimSerahTerimaSHU($kd_order,$status_order='',$jenis_serahterima_sertifikat='',
    $tgl_kirim_sertifkat='',$jasa_pengirim_sertifikat='',$no_pengiriman_sertifikat='',
    $nip_pengirim_sertifikat='',$nm_pengirim_sertifikat='',$nm_penerima_sertifikat='',
    $Tgl_terima_sertifikat=''){
		$this->errormsg="";
		$result=$this->mOrder->getOrder($kd_order);
    $this->kurir=$this->mOrder->getJasaPengiriman();
		$this->form_validation->set_rules('jenis_serah terima_sertifikat', 
			'<font size="2.5" color="red">Jenis Serah Terima Sertifikat</font>', 'required');
		
		$this->form_validation->set_message('required','%s <font size="2.5" color="red">Wajib diisi!</font>');
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
    /*
		//if($this->input->post('save')){	
		//    if($this->form_validation->run())
		//    {
			 
		//      $shu=$this->mSHU->getSHU('','','',$kd_order);			     				    
	    //          foreach($shu as $dat){
			//-- $toview['kd_order']=$dat->kd_order;					
		//	 $toview['nip_penyerah_sertifikat'] = trim($this->input->post('nip_penyerah_sertifikat'));
		//	 $toview['nm_penyerah_sertifikat'] = trim($this->input->post('nm_penyerah_sertifikat'));
		//	 $toview['nm_penerima_sertifikat'] = trim($this->input->post('nm_penerima_sertifikat'));
		//	 $toview['tgl_diserahkan_sertifikat']=trim($this->input->post('tgl_diserahkan_sertifikat'));
		//	 $toview['tgl_update']=date("Y-m-d H:i:s");
		//	 $this->mSHU->Save($toview,'',$dat->kd_shu,true); 
		 //     }
		//	 $tosavewo['kd_order']=$kd_order;
		//	 $tosavewo['status_order']="Closed";
		//	 $this->mOrder->saveOrder($tosavewo,$kd_order,true,false);
		//	 redirect('order/update_sukses');
		//	// echo "<script>alert('Test Berhasil disimpan')</script>";
		//    }			
		} 
		
        $toview['jenis_serahterima_sertifikat']='';
	      $toview['tgl_kirim_sertifikat']='';
		    $toview['jasa_pengirim_sertifikat']='';
		    $toview['no_pengiriman_sertifikat']='';
        $toview['nip_pengirim_sertifikat']='';
        $toview['nm_pengirim_sertifikat']='';
        $toview['nm_penerima_sertifikat']='';
        $toview['tgl_terima_sertifikat']='';
                
		
		#judul
		$this->judul='<center>Proses Kirim/Serah Terima Sertifikat</br>"'.$result->no_order.'"</center>';
		#javascript
		$this->javascript='

			<script type="text/javascript">
			
			$("#tgl_terima_sertifikat").datetimepicker({ 
				appendText: "(format: yyyy-mm-dd jam:menit)",
				showOn: "both"
			});
      $("#tgl_kirim_sertifikat").datetimepicker({ 
				appendText: "(format: yyyy-mm-dd jam:menit)",
				showOn: "both"
			});
			
		</script>';
    
    
		#load view
		$this->content=$this->load->view('order/pengujian/penerima/kirim_serah_terima_shu',$toview);
	}

	public function view_historis_statuswo($kd_order){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order) $toview['kd_order']=$kd_order; else redirect('order');
		$order=$this->mOrder->getOrder($kd_order);		
		$historis_status_wo=$this->mOrder->getHistoriStatusOrder($kd_order);		

		$toview['rincian_historis']='';		
		$toview['rincian_historis'] .="<table border=\"1\">";
		$toview['rincian_historis'] .="<tr>
				<td class=\"c-table-x\">No</td>
				<td class=\"c-table-x\">Status Order</td>			
				<td class=\"c-table-x\">Tanggal</td>
				<td class=\"c-table-x\">Keterangan</td>			
				<td class=\"c-table-x\">Komentar</td>
				<td class=\"c-table-x\">By</td>
				</tr>";		
		
		if($historis_status_wo){
			$no=0;
			foreach($historis_status_wo as $row){
				$no++;	
				$niplama = $this->mUser->readNipLama($row->nip);
				$user = $this->mUser->readUser($niplama->nip);
				$toview['rincian_historis'] .="<tr>
				<td class=\"c-clas-text-1\">".$no."</td>
				<td class=\"c-clas-text-1\">".$row->status_order."</td>			
				<td class=\"c-clas-text-1\">".date("d-m-Y H:i:s",strtotime($row->tgl_create))."</td>
				<td class=\"c-clas-text-1\">".$row->keterangan."</td>			
				<td class=\"c-clas-text-1\">".$row->komentar."</td>
				<td class=\"c-clas-text-1\">".$user->groupdesc." (".$row->nip.")</td>
				</tr>";	
			}
		}
		$toview['rincian_historis'] .="</table>";

		$toview['status_parameter']='';			
		#get result
		$total_detail = $this->mOrder->GetTotalDetail($kd_order,'',false);
		if($total_detail >0){
		   $hasil_total_detail =$this->mOrder->GetResultDetail($kd_order,'',false,'kd_detail_order','desc',30,0);
		
		   $no=0;
		   foreach($hasil_total_detail as $row){	
			$no++;				
			$toview['status_parameter'] .="<fieldset><table border=\"0\">";
			$toview['status_parameter'] .="<tr> 
					       		<td class=\"c-clas-text-1\">
								<b>Jenis / Nama Contoh</b> 
							</td>
							<td class=\"c-clas-text-1\" colspan=\"3\">
							:&nbsp;&nbsp;".$row->jenis_contoh.'/'.$row->nama_contoh."
							</td>
					       </tr>";
			$toview['status_parameter'] .="<tr> 
					       		<td class=\"c-clas-text-1\">
								<b>No. Analisis / Pengujian</b>
							</td>
							<td class=\"c-clas-text-1\" colspan=\"3\">
								:&nbsp;&nbsp;".$row->no_pengujian."
							</td>
					       </tr>";
			$toview['status_parameter'] .="<tr>
				<td class=\"c-table-x\">Nama Parameter</td>
				<td class=\"c-table-x\">Status</td>			
				<td class=\"c-table-x\">Tgl Disetujui Koodinator</td>
				<td class=\"c-table-x\">Tgl Dikerjakan Penguji</td>			
				</tr>";

			$res=$this->mOrder->getParameter($row->kd_detail_order,false);
			if($res){
			    foreach($res as $par){
				if($par->tgl_disetujui_penyelia<> '0000-00-00') 
					$datestj= date("d-m-Y",strtotime($par->tgl_disetujui_penyelia));
				else 
					$datestj= $par->tgl_disetujui_penyelia;

				if($par->tgl_dikerjakan_analis<> '0000-00-00') 
					$datedkj= date("d-m-Y",strtotime($par->tgl_dikerjakan_analis));
				else 
					$datedkj= $par->tgl_dikerjakan_analis;

				$toview['status_parameter'] .="<tr>
				<td class=\"c-clas-text-1\">".$par->nama_parameter."</td>
				<td class=\"c-clas-text-1\">".$par->status_parameter."</td>			
				<td class=\"c-clas-text-1\">".$datestj."</td>
				<td class=\"c-clas-text-1\">".$datedkj."</td>				
				</tr>";	

			    }
			}
			$toview['status_parameter'] .="</table></fieldset>";
		   }	
		}
		
		
		$jum_rhu=$this->mOrder->getRHU($kd_order,'',true);
		$res=$this->mOrder->getDetail('',false,$kd_order);
	   	$jum_sertifikat1=0;
		
		if($jum_rhu){
		   $toview['status_rekap']='';
		   $toview['status_rekap'] .="<fieldset><table border=\"0\">";
	   	   if($res){
		    foreach($res as $dat){
			 $jum_sertifikat1 +=$dat->jumlah_sertifikat;
			
			     $toview['status_rekap'] .="<tr>
				<td class=\"c-clas-text-1\"><b>Jumlah Total Rekapitulasi Hasil Uji (RHU)</b></td>
				<td class=\"c-clas-text-1\" colspan=\"3\">:&nbsp;&nbsp;".$jum_sertifikat1."</td>
				</tr><tr><td class=\"c-clas-text-1\" colspan=\"4\"></td></tr>";	
		    }	
		    if($jum_rhu==$jum_sertifikat1){
	  	    	$rhu=$this->mRHU->getRHU('','',$kd_order);
			     
		        $toview['status_rekap'] .="<tr>				
				<td class=\"c-table-x\">No. Analisis/Pengujian</td>
				<td class=\"c-table-x\">Status</td>			
				<td class=\"c-table-x\">Tgl Disetujui Kabid Pascal</td>
				<td class=\"c-table-x\">Tgl Disetujui Kasi Pengujian</td>
				<td class=\"c-table-x\">Tgl Dibuat Koordinator</td>			
				</tr>";					    
			foreach($rhu as $dat1){
			    if($dat1->tgl_disetujui_manager_teknis<> '0000-00-00') 
				$datesmt = date("d-m-Y",strtotime($dat1->tgl_disetujui_manager_teknis));
			    else 
				$datesmt = $dat1->tgl_disetujui_manager_teknis;
			    if($dat1->tgl_disetujui_wmanager_teknis<> '0000-00-00') 
				$dateswmt = date("d-m-Y",strtotime($dat1->tgl_disetujui_wmanager_teknis));
			    else 
				$dateswmt = $dat1->tgl_disetujui_wmanager_teknis;
			    if($dat1->tgl_dibuat_penyelia <> '0000-00-00') 
				$datespenyelia = date("d-m-Y",strtotime($dat1->tgl_dibuat_penyelia));
			    else 
				$datespenyelia = $dat1->tgl_dibuat_penyelia;
 				
				$toview['status_rekap'] .="<tr>				
				<td class=\"c-clas-text-1\">".$dat1->no_pengujian."</td>
				<td class=\"c-clas-text-1\">".$dat1->status_rhu."</td>			
				<td class=\"c-clas-text-1\">".$datesmt."</td>
				<td class=\"c-clas-text-1\">".$dateswmt."</td>
				<td class=\"c-clas-text-1\">".$datespenyelia."</td>				
				</tr>";	
			}       
		    }
		   }		
		   $toview['status_rekap'] .="</table></fieldset>";
		}
		$jum_shu=$this->mOrder->getSHU($kd_order,'',true);		
	   	$jum_sertifikat2=0;

		if($jum_shu){
		   $toview['status_sertifikat']='';
		   $toview['status_sertifikat'] .="<fieldset><table border=\"0\">";
	   	   if($res){
		    foreach($res as $dat){
			 $jum_sertifikat2 +=$dat->jumlah_sertifikat;
			     $toview['status_sertifikat'] .="<tr>
				<td class=\"c-clas-text-1\"><b>Jumlah Total Sertifikat Hasil Uji (SHU)</b></td>
				<td class=\"c-clas-text-1\" colspan=\"6\">:&nbsp;&nbsp;".$jum_sertifikat2."</td>
				</tr><tr><td class=\"c-clas-text-1\" colspan=\"7\"></td></tr>";	
		    }	
			 if($jum_shu==$jum_sertifikat2){
			     $shu=$this->mSHU->getSHU('','','',$kd_order);
			     
		             $toview['status_sertifikat'] .="<tr>
				
				<td class=\"c-table-x\">No. Sertifikat</td>
				<td class=\"c-table-x\">No. Analisis/Pengujian</td>
				<td class=\"c-table-x\">Status</td>			
				<td class=\"c-table-x\">Tgl Disetujui Kabid Pascal</td>
				<td class=\"c-table-x\">Tgl Disetujui Kasie Pengujian</td>
				<td class=\"c-table-x\">Tgl Dibuat Koordinator</td>
				<td class=\"c-table-x\">Tgl. Sertifikat diserahkan</td>			
				<td class=\"c-table-x\">Nama Penyerah Sertifikat</td>
				<td class=\"c-table-x\">Nama Penerima Sertifikat</td>			
				</tr>";					    
			     foreach($shu as $dat2){
				if($dat2->tgl_disetujui_manajer_teknis<> '0000-00-00') 
					$datesmtshu = date("d-m-Y",strtotime($dat2->tgl_disetujui_manajer_teknis));
			        else 
					$datesmtshu = $dat2->tgl_disetujui_manajer_teknis;
			        if($dat2->tgl_disetujui_wmanajer_teknis<> '0000-00-00') 
					$dateswmtshu = date("d-m-Y",strtotime($dat2->tgl_disetujui_wmanajer_teknis));
			        else 
					$dateswmtshu = $dat2->tgl_disetujui_wmanajer_teknis;

			        if($dat2->tgl_dibuat_penyelia <> '0000-00-00') 
					$datespenyeliashu = date("d-m-Y",strtotime($dat2->tgl_dibuat_penyelia));
			        else 
					$datespenyeliashu = $dat2->tgl_dibuat_penyelia;
				if($dat2->tgl_diserahkan_sertifikat <> '0000-00-00') 
					$datesdiserahkan = date("d-m-Y",strtotime($dat2->tgl_diserahkan_sertifikat));
			        else 
					$datesdiserahkan = $dat2->tgl_diserahkan_sertifikat;
   				 
				$toview['status_sertifikat'] .="<tr>
				<td class=\"c-clas-text-1\">".$dat2->no_shu."</td>
				<td class=\"c-clas-text-1\">".$dat2->no_pengujian."</td>
				<td class=\"c-clas-text-1\">".$dat2->status_shu."</td>			
				<td class=\"c-clas-text-1\">".$datesmtshu ."</td>
				<td class=\"c-clas-text-1\">".$dateswmtshu."</td>
				<td class=\"c-clas-text-1\">".$datespenyeliashu."</td>
				<td class=\"c-clas-text-1\">".$datesdiserahkan."</td>			
				<td class=\"c-clas-text-1\">".$dat2->nm_penyerah_sertifikat."</td>
				<td class=\"c-clas-text-1\">".$dat2->nm_penerima_sertifikat ."</td>					
				</tr>";	
			     }   
			  }
		   }		
		   $toview['status_sertifikat'] .="</table></fieldset>";
 		}
		$toview['status_akhir']='';	
		$toview['status_akhir'] .="<table border=\"1\">";
		$toview['status_akhir'] .="<tr>
					<td colspan=\"3\" align=\"center\">
					<center><font size=\"5\">".$order->status_order."</font></center>
					</td>				
				           </tr>";
		$toview['status_akhir'] .="</table>";
		
		#judul
		$this->judul='View Historis Status Order<br>"'.$order->no_order.'"';
		#load view
		$this->content=$this->load->view('order/pengujian/view_historis_status_wo',$toview);
	}

	public function editKondisiKemasan($kd_detail_order=''){
		$this->errormsg="";
		if($this->input->post('save')){
		 
			 //$toview['kd_order']=$kd_order;
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
			 $toview['kondisi_kemasan']=trim($this->input->post('kondisi_kemasan'));
			 $this->mOrder->saveKondisiKemasan($toview,$kd_detail_order,true,false); 
			 redirect('order/update_sukses');
			// echo "<script>alert('File Berhasil disimpan')</script>";			
		}
		$result = $this->mOrder->getKondisiKemasan($kd_detail_order);
		if($result) {
			$toview['kd_detail_order']=$result->kd_detail_order;
			$toview['kondisi_kemasan']=$result->kondisi_kemasan;
			
			//echo "<script>alert('File Berhasil disimpan1')</script>";
		}else $toview['kondisi_kemasan']='';
                
		
		#judul
		$this->judul='Edit Kondisi Kemasan';
		
		#load view
		$this->content=$this->load->view('order/pengujian/kondisikemasan_edit',$toview);
	}
	//tanda contoh
	public function editTandaContoh($kd_detail_order=''){
		$this->errormsg="";
		if($this->input->post('save')){
		 
			 //$toview['kd_order']=$kd_order;
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
			 $toview['tanda_contoh']=trim($this->input->post('tanda_contoh'));
			 $this->mOrder->saveTandaContoh($toview,$kd_detail_order,true,false); 
			 redirect('order/update_sukses');
			// echo "<script>alert('File Berhasil disimpan')</script>";			
		}
		$result = $this->mOrder->getTandaContoh($kd_detail_order);
		if($result) {
			$toview['kd_detail_order']=$result->kd_detail_order;
			$toview['tanda_contoh']=$result->tanda_contoh;
			//echo "<script>alert('File Berhasil disimpan1')</script>";
		}else $toview['tanda_contoh']='';
                
		
		#judul
		$this->judul='Edit Tanda Contoh';
		
		#load view
		$this->content=$this->load->view('order/pengujian/tandacontoh_edit',$toview);
	}
	//akhir tanda contoh	
	//no pengujian
	public function editNoPengujian($kd_detail_order=''){
		$this->errormsg="";
		if($this->input->post('save')){		 
			 //$toview['kd_order']=$kd_order;
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
			 $toview['no_pengujian']=trim($this->input->post('no_pengujian'));
			 $this->mOrder->saveNoPengujian($toview,$kd_detail_order,true,false); 
			 redirect('order/update_sukses');
			// echo "<script>alert('File Berhasil disimpan')</script>";			
		}
		$result = $this->mOrder->getNoPengujian($kd_detail_order);
		if($result) {
			$toview['kd_detail_order']=$result->kd_detail_order;
			$toview['no_pengujian']=$result->no_pengujian;
			//echo "<script>alert('File Berhasil disimpan1')</script>";
		}else $toview['no_pengujian']='';
                
		
		#judul
		$this->judul='Edit No Pengujian';
		
		#load view
		$this->content=$this->load->view('order/pengujian/nopengujian_edit',$toview);
	}
	//akhir no pengujian
	//Kondisi contoh
	public function editKondisiContoh($kd_detail_order=''){
		$this->errormsg="";
		if($this->input->post('save')){		 
			 //$toview['kd_order']=$kd_order;
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
			 $toview['kondisi_contoh']=trim($this->input->post('kondisi_contoh'));
			 $this->mOrder->saveKondisiContoh($toview,$kd_detail_order,true,false); 
			 redirect('order/update_sukses');
			// echo "<script>alert('File Berhasil disimpan')</script>";			
		}
		$result = $this->mOrder->getKondisiContoh($kd_detail_order);
		if($result) {
			$toview['kd_detail_order']=$result->kd_detail_order;
			$toview['kondisi_contoh']=$result->kondisi_contoh;
			//echo "<script>alert('File Berhasil disimpan1')</script>";
		}else $toview['kondisi_contoh']='';
                
		
		#judul
		$this->judul='Edit Kondisi Contoh';
		
		#load view
		$this->content=$this->load->view('order/pengujian/kondisicontoh_edit',$toview);
	}
	//akhir no pengujian
	
	
	public function StatusOrder($kd_order,$status_order){
		$arr['kd_order']=$kd_order;
		$arr['status_order']=$status_order;
		$this->mOrder->SaveOrder($arr,$kd_order,true,false);
		$this->mOrder->saveHistoriStatusOrder($arr,$kd_order,$status_order,$edit=false,$temp=false);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Status Order = ".$status_order);
		redirect('order');
	}
	
	public function saveStatusOrder($kd_order,$no_order='',$status_order='',$tgl_create='',$nip='',$waktu_perkiraan_antrian='',$keterangan='',$komentar=''){
		$arr['kd_order']=$kd_order;		
		$arr['status_order']=$status_order;
    $arr['waktu_perkiraan_antrian']= $tgl_perkiraan_antrian;
		$hasil=$this->mOrder->SaveOrder($arr,$kd_order,true,false);
     
		$arr['no_order']=$no_order;
		if($tgl_create) 
			$arr['tgl_create'] = $tgl_create;
		else 
			$arr['tgl_create']=date("Y-m-d H:i:s");
   
		$arr['nip']= $nip;    
		$arr['keterangan']=$keterangan;
		$arr['komentar']=$komentar;
		$hasilhis=$this->mOrder->saveHistoriStatusOrder($arr,$kd_order,$edit=false,$temp=false);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
		current_url(),"Status Order = ".$status_order);
		
	}

	//edit status order
	public function editStatusOrder($kd_order,$status_order='',$stgl_create='',$nip='',$keterangan='',$komentar=''){
		$this->errormsg="";
		$result=$this->mOrder->getOrder($kd_order);
		if($this->input->post('save')){	
			 $toview['kd_order']=$kd_order;			
			 $toview['status_order']=trim($this->input->post('status_order'));
			 $toview['tgl_create']=date("Y-m-d H:i:s");
			 $toview['nip']=$nip;
       $toview['tgl_perkiraan_antrian']= trim($this->input->post('tgl_perkiraan_antrian'));
			 $toview['keterangan']=trim($this->input->post('keterangan'));
			 $toview['komentar']=trim($this->input->post('komentar'));
			 $this->saveStatusOrder($kd_order,$toview['status_order'],$toview['tgl_create'],$toview['nip'],
					$toview['tgl_perkiraan_antrian'],$toview['keterangan'],$toview['komentar']); 
			 redirect('order/update_sukses');
			// echo "<script>alert('Test Berhasil disimpan')</script>";			
		}
		//$result = $this->mOrder->getStatusOrder($kd_order);
		if($result) {
			$toview['kd_order']=$result->kd_order;
			$toview['status_order']=$result->status_order;			
			//echo "<script>alert('File Berhasil disimpan1')</script>";
		}else{
			$toview['status_order']='';
			$toview['keterangan']=trim($this->input->post('keterangan'));
                
		}
		#judul
		$this->judul='<center>Prosess Acc Order</br>"'.$result->no_order.'"</center>';
		
		#load view
		$this->content=$this->load->view('order/pengujian/acc_work_order',$toview);
	}
	//akhir status order

	//edit status order
	public function accWorkOrderPenyelia($kd_order,$no_order='',$status_order='',$stgl_create='',$nip='',$keterangan='',$komentar=''){
		$this->errormsg="";
		$result=$this->mOrder->getOrder($kd_order);
		if($this->input->post('save')){	
			 $toview['kd_order']=$kd_order;	
			 $toview['no_order']=trim($this->input->post('no_order'));	
			 $toview['status_order']=trim($this->input->post('status_order'));
			 $toview['tgl_create']=trim($this->input->post('tgl_create'));;//date("Y-m-d H:i:s"); 			 
			 $dat=$this->mUser->getDetail($this->session->userdata('userid')); 
			 $toview['nip']= $dat->nip_baru;

			 $toview['keterangan']=trim($this->input->post('keterangan'));
			 $toview['komentar']=trim($this->input->post('komentar'));
			 $this->saveStatusOrder($kd_order,$toview['no_order'],$toview['status_order'],
				$toview['tgl_create'],$toview['nip'],
					$toview['keterangan'],$toview['komentar']); 

			 redirect('order/update_sukses');
			// echo "<script>alert('Test Berhasil disimpan')</script>";			
		}
		
		if($result) {
			$toview['kd_order']=$result->kd_order;
			$toview['no_order']=$result->no_order;
      
			$toview['status_order']=$result->status_order;			
			//echo "<script>alert('File Berhasil disimpan1')</script>";
		}else{
			$toview['status_order']='';
      $toview['tgl_create']='';
			$toview['keterangan']=trim($this->input->post('keterangan'));
                
		}
		#judul
		$this->judul='<center>Prosess Acc Order</br>"'.$result->no_order.'"</center>';
		#javascript
		$this->javascript='
			<script type="text/javascript">
			 		
      $("#tgl_create").datetimepicker({ 
				appendText: "(format: yyyy-mm-dd jam:menit)",
				showOn: "both"
			});
			
		</script>';
		#load view
		$this->content=$this->load->view('order/pengujian/penyelia/acc_work_order_penyelia',$toview);
	}
	//akhir status order

	//edit status order
	public function accWorkOrderMt($kd_order,$no_order='',$status_order='',$status_order='',$stgl_create='',$nip='',$keterangan='',$komentar=''){
		$this->errormsg="";
		$result=$this->mOrder->getOrder($kd_order);
		if($this->input->post('save')){	
			 $toview['kd_order']=$kd_order;	
			 $toview['no_order']=trim($this->input->post('no_order'));	
			 $toview['status_order']=trim($this->input->post('status_order'));
			 $toview['tgl_create']=trim($this->input->post('tgl_create'));	
			 
			 $dat=$this->mUser->getDetail($this->session->userdata('userid')); 
			 $toview['nip']= $dat->nip_baru;

			 $toview['keterangan']=trim($this->input->post('keterangan'));
			 $toview['komentar']=trim($this->input->post('komentar'));
			 $this->saveStatusOrder($kd_order,$toview['no_order'],$toview['status_order'],
			 $toview['tgl_create'],$toview['nip'],
			 $toview['keterangan'],$toview['komentar']); 

			 redirect('order/update_sukses');
			// echo "<script>alert('Test Berhasil disimpan')</script>";			
		}
		
		if($result) {
			$toview['kd_order']=$result->kd_order;
			$toview['no_order']=$result->no_order;
			$toview['status_order']=$result->status_order;			
			
		}else{
			$toview['status_order']='';
			$toview['keterangan']='';
			$toview['tgl_create']=date("Y-m-d H:i:s");;
                
		}
		#judul
		$this->judul='<center>Prosess Acc Order</br>"'.$result->no_order.'"</center>';
		
    #javascript
		$this->javascript='
			<script type="text/javascript">
			 		
      $("#tgl_create").datetimepicker({ 
				appendText: "(format: yyyy-mm-dd jam:menit)",
				showOn: "both"
			});
			
		</script>';
    
		#load view
		$this->content=$this->load->view('order/pengujian/mt/acc_work_order_mt',$toview);
	}
	//akhir status order  
	//edit status order
	public function accWorkOrderPenerima($kd_order,$no_order='',$status_order='',$status_order='',$stgl_create='',$nip='',$keterangan='',$komentar=''){
		$this->errormsg="";
		$result=$this->mOrder->getOrder($kd_order);
		if($this->input->post('save')){	
			 $toview['kd_order']=$kd_order;	
			 $toview['no_order']=trim($this->input->post('no_order'));	
			 $toview['status_order']=trim($this->input->post('status_order'));
			 $toview['tgl_create']=trim($this->input->post('tgl_create'));
			 
			 $dat=$this->mUser->getDetail($this->session->userdata('userid')); 
			 $toview['nip']= $dat->nip_baru;

			 $toview['keterangan']=trim($this->input->post('keterangan'));
			 $toview['komentar']=trim($this->input->post('komentar'));
			 $this->saveStatusOrder($kd_order,$toview['no_order'],$toview['status_order'],
			 $toview['tgl_create'],$toview['nip'],
			 $toview['keterangan'],$toview['komentar']); 

			 redirect('order/update_sukses');
			// echo "<script>alert('Test Berhasil disimpan')</script>";			
		}
		
		if($result) {
			$toview['kd_order']=$result->kd_order;
			$toview['no_order']=$result->no_order;
			$toview['status_order']=$result->status_order;			
			//echo "<script>alert('File Berhasil disimpan1')</script>";
		}else{
			$toview['status_order']='';
			$toview['keterangan']='';
			$toview['tgl_create']=date("Y-m-d H:i:s");;
                
		}
		#judul
		$this->judul='<center>Prosess Acc Order</br>"'.$result->no_order.'"</center>';
		
		#load view
		$this->content=$this->load->view('order/pengujian/penerima/acc_work_order_penerima',$toview);
	}
	//akhir status order  
	//edit status order
	public function accWorkOrderWmt($kd_order,$no_order='',$status_order='',$tgl_create='',$nip='',$tgl_perkiraan_antrian='',$keterangan='',$komentar=''){
		$this->errormsg="";
		$result=$this->mOrder->getOrder($kd_order);
		if($this->input->post('save')){	
			 $toview['kd_order']=$kd_order;	
			 $toview['no_order']=trim($this->input->post('no_order'));	
			 $toview['status_order']=trim($this->input->post('status_order'));
			 $toview['tgl_create']= trim($this->input->post('tgl_create'));
       //$toview['tgl_perkiraan_antrian']=$this->input->post('tgl_perkiraan_antrian');
			 
			 $dat=$this->mUser->getDetail($this->session->userdata('userid')); 
			 $toview['nip']= $dat->nip_baru;

			 $toview['keterangan']=trim($this->input->post('keterangan'));
			 $toview['komentar']=trim($this->input->post('komentar'));
			 $this->saveStatusOrder($kd_order,$toview['no_order'],$toview['status_order'],
			 $toview['tgl_create'],$toview['nip'],  $toview['tgl_perkiraan_antrian'],
			 $toview['keterangan'],$toview['komentar']); 

			 redirect('order/update_sukses');
			// echo "<script>alert('Test Berhasil disimpan')</script>";			
		}         
		
		if($result) {
			$toview['kd_order']=$result->kd_order;
			$toview['no_order']=$result->no_order;
			$toview['status_order']=$result->status_order;	
			$toview['tgl_create']=date("Y-m-d H:i:s");//$result->tgl_create;
      $toview['tgl_perkiraan_antrian']=	$result->tgl_perkiraan_antrian;	
			//echo "<script>alert('File Berhasil disimpan')</script>";
		}else{
			$toview['status_order']='';
			$toview['keterangan']='';
			$toview['tgl_create']=date("Y-m-d H:i:s");
      $toview['tgl_perkiraan_antrian']=	 '';
                
		}
		#judul
		$this->judul='<center>Prosess Acc Order</br>"'.$result->no_order.'"</center>';

		#javascript
		$this->javascript='
			<script type="text/javascript"> 			
			$("#tgl_create").datetimepicker({ 
				appendText: "(format: yyyy-mm-dd jam:menit)",
				showOn: "both"
			});
			
		</script>';

		
		#load view
		$this->content=$this->load->view('order/pengujian/wmt/acc_work_order_wmt',$toview);
	}
	//akhir status order


	public function upload_sukses(){
		echo "<h1>Save dengan File  di Upload</h1>";
		echo "<br><br><input type=\"button\" size=\"30\" style=\"width:300px\" onclick=\"parent.tb_remove(); parent.location.reload(1);\" value=\"OK\">";
	}
	public function upload_sukses_nonfile(){
		echo "<h1>Save tanpa File  di Upload</h1>";
		echo "<br><br><input type=\"button\" size=\"30\" style=\"width:300px\" onclick=\"parent.tb_remove(); parent.location.reload(1);\" value=\"OK\">";
	}
        public function update_sukses(){
		echo "<h1>Update Sukses</h1>";
		echo "<br><br><input type=\"button\" size=\"30\" style=\"width:300px\" onclick=\"parent.tb_remove(); parent.location.reload(1);\" value=\"OK\">";
	}


	public function acc_sukses(){
		echo "<h1>Acc Sukses</h1>";
		echo "<br><br><input type=\"button\" size=\"30\" style=\"width:300px\" onclick=\"parent.tb_remove(); parent.location.reload(1);\" value=\"OK\">";
	}

	public function Bayar($kd_order,$status){
		$arr['kd_order']=$kd_order;
		$arr['status_bayar']=$status;
		$this->mOrder->SaveOrder($arr,$kd_order,true,false);
		redirect('order');
	}

	
	
	private function do_upload(){
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'zip|pdf|doc|gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			//$this->load->view('lhu/lhu_add', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			#$this->load->view('upload_success', $data);
			//redirect(current_url());
		}
	}
	
	public function Detail($kd_order='',$kd_jenis_tarif='',$kd_tarif=''){
	   $this->errormsg=""; $this->listParameter=""; $this->list_order="";
           $counter=0;
	   if($kd_order) $toview['kd_order']=$kd_order;
	   
	   if($kd_jenis_tarif) 
	   { 
	   		$toview['kd_jenis_tarif']=$kd_jenis_tarif;
	   		$result=$this->mTarif->getJenisTarif($kd_jenis_tarif);
		 	$toview['jenis_contoh']=$result->jenis_tarif;
	   } else {
		 	$toview['jenis_contoh']='';
			$toview['kd_jenis_tarif']='';
	   }
	   if($kd_tarif){
	   		$toview['kd_tarif']=$kd_tarif;
	   		$result=$this->mTarif->getTarif($kd_tarif);
		 	$toview['nama_contoh']=$result->nama_tarif;
		 	$toview['metoda']=$result->metoda_tarif;
	   		$result2=$this->mTarif->getParameter('',$kd_tarif,true);
			if($result2){
			   $this->listParameter='<ol>';
			      foreach($result2 as $row){
				$cek=""; $visible="hidden"; $jum_uji=1;
				$this->listParameter.='
				<li>
				<input type="checkbox" name="parameter['.$counter.']" id="parameter-'.$counter.'" 
				value="'.$row->kd_parameter.'" 
				onchange="if(document.getElementById(\'cekJumlahUji-'.$counter.'\').checked){
					  	document.getElementById(\'cekJumlahUji-'.$counter.'\').checked=this.checked;
					 	document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
					  	document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'hidden\'
                                	  }" >&nbsp;'.ucfirst($row->nama_parameter).' 
				('.$row->metoda_parameter.' Rp. '.number_format($row->harga_satuan,2).')&nbsp;&nbsp;
				<input name="cekJumlahUji['.$row->kd_parameter.']" '.$cek.' id="cekJumlahUji-'.$counter.'"  
				type="checkbox" value="'.$counter.'" 	
				onchange="javascript:if(this.checked){ 
					document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
					document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'visible\'
				} else { 
					document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
					document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'hidden\'}" />
					&nbsp;Jumlah Uji&nbsp; 
					<input type="text" name="jumlah_uji['.$row->kd_parameter.']" class="input" value="1" maxlength="4"
					size="4" id="jumlah_uji-'.$counter.'" style="visibility:'.$visible.'">
				</li>';
					$counter++;
				}
				$this->listParameter.='</ol>
				<input type="checkbox" name="cekAllJumlahUji" value="1" id="cekAllJumlahUji" 
					onchange="CheckItAll()">&nbsp;Check All';
			}
	   } else {
		    $toview['nama_contoh']='';
		    $toview['metoda']='';
		    $toveiw['kd_jenis_tarif']='';  
	   }
		 $toveiw['tanda_contoh']='';
		 $toveiw['no_pengujian']='';
		 $toview['jumlah_contoh']='1';
		 //$toview['jumlah_uji']='0';
		 $toview['jumlah_sertifikat']='1';
		 $toview['limit']=30;
		 $toview['page']=1;
		 $page=1;
			#get result
			$toview['tot']=$this->mOrder->GetTotalDetail($toview['kd_order'],'',true);
			//echo "<script>alert('{$toview['tot']}')</script>";
			if($toview['tot']>0){
				$toview['pages']=ceil($toview['tot']/$toview['limit']);
				if(!is_numeric($page)){$toview['page']=1;}
				elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
				else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['result']=$this->mOrder->GetResultDetail($toview['kd_order'],'',true,'kd_detail_order','desc',30,0);
			} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['result']=false;
			}
		$totbiayaorder=0;
		if($toview['result']){
			foreach($toview['result'] as $row){
				$totbiayaorder +=($row->harga_subtotal);
			}
		}
		$toview['totbiayaorder'] = $totbiayaorder;
		
		if($this->input->post('selesai')){	
			redirect('order/biaya_lain/'.$toview['kd_order']);  
		}
		$this->form_validation->set_rules('jenis_contoh', 'Jenis Contoh', 'required');
		$this->form_validation->set_rules('nama_contoh', 'Nama Contoh', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');
		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		//echo "<script>alert('test save ? ')</script>";
		if($this->input->post('save')){
		  echo "<script>alert('test input save true'".trim($this->input->post('save')).")</script>";
		  if($this->form_validation->run())
		  {
			echo "<script>alert('test for falidasi true')</script>";
			if($this->input->post('tambah')){
				echo "<script>alert('test for input post tambah true')</script>";
				if($this->errormsg=="") { 
				        echo "<script>alert('test no error message true')</script>";
					
					$parameterlist=$this->input->post('parameter');
					//$cekjumuji=$this->input->post('cekJumlahUji');
					$jumujilist=$this->input->post('jumlah_uji');
					//print_r($parameterlist)."<br>".print_r($cekjumuji)."<br>".print_r($jumujilist);
					//exit();
					$toview['jumlah_contoh']=$this->input->post('jumlah_contoh');
					//echo "<script>alert('".print_r($jumujilist)."')</script>";
					$toview['jumlah_sertifikat']=$this->input->post('jumlah_sertifikat');
				   	$toview['kondisi_kemasan']=trim($this->input->post('kondisi_kemasan'));
				   	$toview['kondisi_contoh']=trim($this->input->post('kondisi_contoh'));
				  	$toview['tanda_contoh']=trim($this->input->post('tanda_contoh'));
				   	$toview['no_pengujian']=trim($this->input->post('no_pengujian'));
				        $toview['kd_jenis_tarif']=trim($this->input->post('kd_jenis_tarif'));
					$toview['kd_detail_order']=$this->mOrder->Make_kd_detail_order();
									
					//$hasil=$this->mOrder->SaveDetail($toview,'',$parameterlist,$jumujilist,false);
 					if($parameterlist){				
						$hasil=$this->mOrder->SaveDetail($toview,'',$parameterlist,$jumujilist,false); 
					}else{
						echo "<script>alert('Parameter Belum ada yang dipilih')</script>";
					}
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Detail Order Baru Sementara");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/Detail/'.$toview['kd_order']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}else{echo "<script>alert(".$this->errormsg."')</script>";}
				
			  }
		  }
		}
		
		#judul
		$this->judul='Detail Order';
		$this->javascript='
		<script type="text/javascript">
		function CheckItAll(){
			for(i=0;i<'.$counter.';i++){
				document.getElementById(\'parameter-\' + i).checked=document.getElementById(\'cekAllJumlahUji\').checked;
			}
		}
		$(document).ready(function(){
			';
			$this->javascript.='var data = [';
			$result=$this->mTarif->getJenisTarif('',true);
			if($result){
				foreach($result as $row){
					$this->javascript.="{text:'".$row->jenis_tarif."', url:'".$row->kd_jenis_tarif."'},";
				}
			}
			$this->javascript.='];';
			if($kd_jenis_tarif){
				$this->javascript.='
				var data2 = [';
				$result=$this->mTarif->getTarif('',$kd_jenis_tarif,true);
				if($result){
					foreach($result as $row){
							$this->javascript.="{text:'".$row->nama_tarif."', url:'".$row->kd_tarif."'},";
					}
				}
				$this->javascript.='];';
				$this->javascript.='
				$("#nama_contoh").autocomplete(data2, {
				matchContains: true,
				  formatItem: function(item) {
					return item.text;
				  }
				}).result(function(event, item) {
				  location.href = \'index.php/order/Detail/'.$toview['kd_order'].'/'.$toview['kd_jenis_tarif'].'/\' + item.url;
				});';
			}
			$this->javascript.='
			$("#jenis_contoh").autocomplete(data, {
			matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/Detail/'.$toview['kd_order'].'/\' + item.url;
			});
		});  
		
		</script>
		';
		#load view
		$this->content=$this->load->view('order/pengujian/order_detail',$toview);	
	}
	
	public function DetailE($kd_order='',$kd_jenis_tarif='',$kd_tarif=''){
	   $this->errormsg=""; $this->listParameter=""; $this->list_order="";
           $counter=0;
	   if($kd_order) $toview['kd_order']=$kd_order;
	   
	   if($kd_jenis_tarif) 
	   { 
	   		$toview['kd_jenis_tarif']=$kd_jenis_tarif;
	   		$result=$this->mTarif->getJenisTarif($kd_jenis_tarif);
		 	$toview['jenis_contoh']=$result->jenis_tarif;
	   } else {
		 	$toview['jenis_contoh']='';
			$toview['kd_jenis_tarif']='';
	   }
	   if($kd_tarif){
	   		$toview['kd_tarif']=$kd_tarif;
	   		$result=$this->mTarif->getTarif($kd_tarif);
		 	$toview['nama_contoh']=$result->nama_tarif;
		 	$toview['metoda']=$result->metoda_tarif;
	   		//$result2=$this->mTarif->getParameter('',$kd_tarif,true);
			$result2=$this->mTarif->getParameter('',$kd_tarif,true);
			if($result2){
			   $this->listParameter='<ol>';
			      foreach($result2 as $row){
				$cek=""; $visible="hidden"; $jum_uji=1;
				$this->listParameter.='
				<li>
				<input type="checkbox" name="parameter['.$counter.']" id="parameter-'.$counter.'" 
				value="'.$row->kd_parameter.'" 
				onchange="if(document.getElementById(\'cekJumlahUji-'.$counter.'\').checked){
					  	document.getElementById(\'cekJumlahUji-'.$counter.'\').checked=this.checked;
					 	document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
					  	document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'hidden\'
                                	  }" >&nbsp;'.ucfirst($row->nama_parameter).' 
				('.$row->metoda_parameter.' Rp. '.number_format($row->harga_satuan,2).')&nbsp;&nbsp;
				<input name="cekJumlahUji['.$row->kd_parameter.']" '.$cek.' id="cekJumlahUji-'.$counter.'"  
				type="checkbox" value="'.$counter.'" 	
				onchange="javascript:if(this.checked){ 
					document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
					document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'visible\'
				} else { 
					document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
					document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'hidden\'}" />
					&nbsp;Jumlah Uji&nbsp; 
					<input type="text" name="jumlah_uji['.$row->kd_parameter.']" class="input" value="1" maxlength="4"
					size="4" id="jumlah_uji-'.$counter.'" style="visibility:'.$visible.'">
				</li>';
					$counter++;
				}
				$this->listParameter.='</ol>
				<input type="checkbox" name="cekAllJumlahUji" value="1" id="cekAllJumlahUji" 

					onchange="CheckItAll()">&nbsp;Check All';
			}
	   } else {
		 $toview['nama_contoh']='';
		 $toview['metoda']='';
		 $toveiw['kd_jenis_tarif']='';  
	   }
		 $toveiw['tanda_contoh']='';
		 $toveiw['no_pengujian']='';
		 $toview['jumlah_contoh']='1';
		 //$toview['jumlah_uji']='0';
		 $toview['jumlah_sertifikat']='1';
		 $toview['limit']=30;
		 $toview['page']=1;
		 $page=1;
			#get result
			//$toview['tot']=$this->mOrder->GetTotalDetail($toview['kd_order'],'',true);
			$toview['tot']=$this->mOrder->GetTotalDetail($toview['kd_order'],'',false);//true);
			//echo "<script>alert('{$toview['tot']}')</script>";
			if($toview['tot']>0){
				$toview['pages']=ceil($toview['tot']/$toview['limit']);
				if(!is_numeric($page)){$toview['page']=1;}
				elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
				else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
			//$toview['result']=$this->mOrder->GetResultDetail($toview['kd_order'],'',true,'kd_detail_order','desc',30,0);
				$toview['result']=$this->mOrder->GetResultDetail($toview['kd_order'],
						'',false,'kd_detail_order','desc',30,0);
			} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['result']=false;
			}

		$totbiayaorder=0;
		if($toview['result']){
			foreach($toview['result'] as $row){
				$totbiayaorder +=($row->harga_subtotal);
			}
		}
		$toview['totbiayaorder'] = $totbiayaorder;

		if($this->input->post('selesai')){	
			redirect('order/biaya_lainE/'.$toview['kd_order']);  
		}
		$this->form_validation->set_rules('jenis_contoh', 'Jenis Contoh', 'required');
		$this->form_validation->set_rules('nama_contoh', 'Nama Contoh', 'required');
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
					
					$parameterlist=$this->input->post('parameter');
					//$cekjumuji=$this->input->post('cekJumlahUji');
					$jumujilist=$this->input->post('jumlah_uji');
					//print_r($parameterlist)."<br>".print_r($cekjumuji)."<br>".print_r($jumujilist);
					//exit();
					$toview['jumlah_contoh']=$this->input->post('jumlah_contoh');
					//echo "<script>alert('".print_r($jumujilist)."')</script>";
					$toview['jumlah_sertifikat']=$this->input->post('jumlah_sertifikat');
				   	$toview['kondisi_kemasan']=trim($this->input->post('kondisi_kemasan'));
				   	$toview['kondisi_contoh']=trim($this->input->post('kondisi_contoh'));
				  	$toview['tanda_contoh']=trim($this->input->post('tanda_contoh'));
				   	$toview['no_pengujian']=trim($this->input->post('no_pengujian'));
				        $toview['kd_jenis_tarif']=trim($this->input->post('kd_jenis_tarif'));
					//$toview['kd_detail_order']=$this->mOrder->Make_kd_detail_order();

					$hasil=$this->mOrder->SaveDetail($toview,'',$parameterlist,$jumujilist,true,false); 
					
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Detail Order Baru Sementara");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/DetailE/'.$toview['kd_order']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}else{
					echo "<script>alert(".$this->errormsg."')</script>";
				}
				
			  }
		  }
		}
		
		#judul
		$this->judul='Detail Order';
		$this->javascript='
		<script type="text/javascript">
		function CheckItAll(){
			for(i=0;i<'.$counter.';i++){
				document.getElementById(\'parameter-\' + i).checked=document.getElementById(\'cekAllJumlahUji\').checked;
			}
		}
		$(document).ready(function(){
			';
			$this->javascript.='var data = [';
			$result=$this->mTarif->getJenisTarif('',true);
			foreach($result as $row){
					$this->javascript.="{text:'".$row->jenis_tarif."', url:'".$row->kd_jenis_tarif."'},";
			}
			$this->javascript.='];';
			if($kd_jenis_tarif){
				$this->javascript.='
				var data2 = [';
				$result=$this->mTarif->getTarif('',$kd_jenis_tarif,true);
				if($result){
					foreach($result as $row){
							$this->javascript.="{text:'".$row->nama_tarif."', url:'".$row->kd_tarif."'},";
					}
				}
				$this->javascript.='];';
				$this->javascript.='
				$("#nama_contoh").autocomplete(data2, {
				matchContains: true,
				  formatItem: function(item) {
					return item.text;
				  }
				}).result(function(event, item) {
				  location.href = \'index.php/order/DetailE/'.$toview['kd_order'].'/'.$toview['kd_jenis_tarif'].'/\' + item.url;
				});';
			}
			$this->javascript.='
			$("#jenis_contoh").autocomplete(data, {
			matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/DetailE/'.$toview['kd_order'].'/\' + item.url;
			});
		});  
		
		</script>
		';
		#load view
		$this->content=$this->load->view('order/pengujian/order_detail',$toview);	
	}
	


	public function delBiayaLain($kd_biaya_lain,$kd_order){
		if($kd_biaya_lain){
			$this->mOrder->DeleteBiayaLain($kd_biaya_lain);
			$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Hapus Biaya Lain Temp");
			redirect('order/biaya_lain/'.$kd_order);
		} else {
			echo "Error";
		}
	}
	
	public function delBiayaLainE($kd_biaya_lain,$kd_order){
		if($kd_biaya_lain){
			$this->mOrder->DeleteBiayaLain($kd_biaya_lain);
			$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Hapus Biaya Lain Temp");
			redirect('order/biaya_lainE/'.$kd_order);
		} else {
			echo "Error";
		}
	}
	
	public function delBiayaLainO($kd_biaya_lain,$kd_order){
		if($kd_biaya_lain){
			$this->mOrder->DeleteBiayaLain($kd_biaya_lain);
			$this->mOrder->saveTotalUlang($kd_order,$ppn);
			redirect('order/view/'.$kd_order);
		} else {
			echo "Error";
		}
	}
	
	public function biaya_lain($kd_order=''){
		$this->errormsg="";
		$toview['kd_order']=GetInput($this->input->post('kd_order'),$kd_order);
		$data_order=$this->mOrder->getOrder($kd_order,false);
		if($data_order) $toview['nilai_discount']=$data_order->discount; 
		else $toview['nilai_discount']=0;
		$dat=$this->mOrder->getBiayaLain($toview['kd_order']);
		if($dat){
		     $toview['biaya_biaya'] ="<table border=\"0\" width=\"100%\">";
		      $toview['biaya_biaya'] .="<tr>
							<td><b>Nama Biaya Lain</td>
							<td><b>Biaya</td>
							<td><b>Jumlah</td>
							<td><b>Satuan</td>
							<td><b>Total</td>
							<td><b>Action</td>
						</tr>";
		      foreach($dat as $row){
			$toview['biaya_biaya'] .="<tr>
			<td>
			    <li type=\"square\" style=\"margin-left:10px\">Biaya ".$row->nama_biaya."</td>
			<td>".formatRupiah($row->nilai_biaya)."</td>
			<td>".number_format($row->jumlah_biaya)."</td>
			<td>".$row->satuan_biaya."</td>
			<td>".formatRupiah($row->sub_total_biaya )."</td>
			<td><a href=\"index.php/order/delBiayaLainE/".$row->kd_biaya_lain."/".$toview['kd_order']."\" 
				onclick=\"return confirm('Yakin ingin menghapus biaya ".$row->nama_biaya."?')\">
			<input type=\"button\" name=\"Hapus\" value=\"Hapus\"></a></td>

			</tr>";
		     }
			$toview['biaya_biaya'] .="</table>";
		}
		$toview['kd_order']=@GetInput($this->input->post('kd_order'),@$kd_order);
		$toview['nama_biaya']=@GetInput($this->input->post('nama_biaya'));
		$toview['nilai_biaya']=@GetInput($this->input->post('nilai_biaya'));
		$toview['satuan_biaya']=@GetInput($this->input->post('satuan_biaya'));
		$toview['jumlah_biaya']=@GetInput($this->input->post('jumlah_biaya'));
		$toview['sub_total_biaya']=@GetInput($this->input->post('sub_total_biaya'));
		$toview['nilai_ppn'] = 10;
		
		if($this->input->post('submit')){
			$toview['nama_biaya']=$this->input->post('nama_biaya');
			$toview['nilai_biaya']=$this->input->post('nilai_biaya');			
			$toview['jumlah_biaya']=$this->input->post('jumlah_biaya');
			$toview['satuan_biaya']=$this->input->post('satuan_biaya');
			$toview['sub_total_biaya']=$this->input->post('sub_total_biaya');
			
			if($this->input->post('nilai_discount') && $this->input->post('nilai_discount')>0) 
				$toview['nilai_discount']=$this->input->post('nilai_discount');
			
			if($this->input->post('nilai_discount2') && $this->input->post('nilai_discount2')>0) 
				$toview['nilai_discount']=$this->input->post('nilai_discount2');
			if($this->input->post('nilai_ppn') && $this->input->post('nilai_ppn')>0) 
				$toview['nilai_ppn']=$this->input->post('nilai_ppn');
			
			$hasil=$this->mOrder->saveBiaya($toview['kd_biaya_lain'],$toview['kd_order'],$toview['nama_biaya'],
			      $toview['nilai_biaya'], $toview['jumlah_biaya'], $toview['satuan_biaya'], $toview['sub_total_biaya'],
                              $toview['nilai_discount'],$toview['nilai_ppn']);
			if($hasil) redirect('order/Confirm/'.$toview['kd_order']);  
			else $this->errormsg="<em style=\"color:red\">Maaf terjadi kesalahan teknis. Tidak dapat disimpan!</em>";
		}
		$this->judul="Biaya Lain-lain";
		$this->load->view('view_header');
		$this->load->view('order/biaya_lain',$toview);
		$this->load->view('view_footer');
	}

	public function biaya_lainE($kd_order=''){
		$this->errormsg="";
		$toview['kd_order']=GetInput($this->input->post('kd_order'),$kd_order);
		$data_order=$this->mOrder->getOrder($kd_order,false);
		if($data_order) $toview['nilai_discount']=$data_order->discount; 
		else $toview['nilai_discount']=0;
		$dat=$this->mOrder->getBiayaLain($toview['kd_order']);
		if($dat){
		     $toview['biaya_biaya'] ="<table border=\"0\" width=\"100%\">";
		      $toview['biaya_biaya'] .="<tr>
							<td><b>Nama Biaya Lain</td>
							<td><b>Biaya</td>
							<td><b>Jumlah</td>
							<td><b>Satuan</td>
							<td><b>Total</td>
							<td><b>Action</td>
						</tr>";
		      foreach($dat as $row){
			$toview['biaya_biaya'] .="<tr>
			<td>
			    <li type=\"square\" style=\"margin-left:10px\">Biaya ".$row->nama_biaya."</td>
			<td>".formatRupiah($row->nilai_biaya)."</td>
			<td>".number_format($row->jumlah_biaya)."</td>
			<td>".$row->satuan_biaya."</td>
			<td>".formatRupiah($row->sub_total_biaya )."</td>
			<td><a href=\"index.php/order/delBiayaLainE/".$row->kd_biaya_lain."/".$toview['kd_order']."\" 
				onclick=\"return confirm('Yakin ingin menghapus biaya ".$row->nama_biaya."?')\">
			<input type=\"button\" name=\"Hapus\" value=\"Hapus\"></a></td>
			</tr>";
		     }
			$toview['biaya_biaya'] .="</table>";
		}
		$toview['kd_order']=@GetInput($this->input->post('kd_order'),@$kd_order);
		$toview['nama_biaya']=@GetInput($this->input->post('nama_biaya'));
		$toview['nilai_biaya']=@GetInput($this->input->post('nilai_biaya'));
		$toview['satuan_biaya']=@GetInput($this->input->post('satuan_biaya'));
		$toview['jumlah_biaya']=@GetInput($this->input->post('jumlah_biaya'));
		$toview['sub_total_biaya']=@GetInput($this->input->post('sub_total_biaya'));
		$toview['nilai_ppn'] = 10;

		if($this->input->post('submit')){
			$toview['nama_biaya']=$this->input->post('nama_biaya');
			$toview['nilai_biaya']=$this->input->post('nilai_biaya');			
			$toview['jumlah_biaya']=$this->input->post('jumlah_biaya');
			$toview['satuan_biaya']=$this->input->post('satuan_biaya');
			$toview['sub_total_biaya']=$this->input->post('sub_total_biaya');
			
			if($this->input->post('nilai_discount') && $this->input->post('nilai_discount')>0) 
				$toview['nilai_discount']=$this->input->post('nilai_discount');
			
			if($this->input->post('nilai_discount2') && $this->input->post('nilai_discount2')>0) 
				$toview['nilai_discount']=$this->input->post('nilai_discount2');

			if($this->input->post('nilai_ppn') && $this->input->post('nilai_ppn')>0) 
				$toview['nilai_ppn']=$this->input->post('nilai_ppn');
			
			
			$hasil=$this->mOrder->saveBiaya($toview['kd_biaya_lain'],$toview['kd_order'],$toview['nama_biaya'],
			      $toview['nilai_biaya'], $toview['jumlah_biaya'], $toview['satuan_biaya'], $toview['sub_total_biaya'],
                              $toview['nilai_discount'],$toview['nilai_ppn'],false);

			if($hasil) redirect('order/ConfirmE/'.$toview['kd_order']);  
			else $this->errormsg="<em style=\"color:red\">Maaf terjadi kesalahan teknis. Tidak dapat disimpan!</em>";
		}
		$this->judul="Biaya Lain-lain";
		$this->load->view('view_header');
		$this->load->view('order/biaya_lainE',$toview);
		$this->load->view('view_footer');
	}

	public function editBiayaLain($kd_biaya_lain=''){
		$this->errormsg="";
		
		$dat=$this->mOrder->getBiayaLain('',$kd_biaya_lain);
		if($dat){
			$toview['kd_biaya_lain']=$dat->kd_biaya_lain;
			$toview['nama_biaya']=$dat->nama_biaya;
			$toview['nilai_biaya']=$dat->nilai_biaya;
			$toview['satuan_biaya']=$dat->satuan_biaya;
			$toview['jumlah_biaya']=$dat->jumlah_biaya;
			$toview['sub_total_biaya']=$dat->sub_total_biaya;
			$toview['kd_order']=$dat->kd_order;
			$toview['kd_satker']=$dat->kd_satker;			
		}else{
			$toview['nama_biaya']='';
			$toview['nilai_biaya']='';
			$toview['satuan_biaya']='';
			$toview['jumlah_biaya']='';
			$toview['sub_total_biaya']='';			
		}
		$toview['ppn']=0;

		if($this->input->post('save')){		 
			$toview['kd_order']=$this->input->post('kd_order');
			$toview['kd_biaya_lain']=$this->input->post('kd_biaya_lain');
			$toview['nama_biaya']=$this->input->post('nama_biaya');
			$toview['nilai_biaya']=$this->input->post('nilai_biaya');
			$toview['satuan_biaya']=$this->input->post('satuan_biaya');
			$toview['jumlah_biaya']=$this->input->post('jumlah_biaya');
			$toview['sub_total_biaya']=$this->input->post('sub_total_biaya');
			$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$this->mOrder->updateBiayaLain($toview,$toview['kd_biaya_lain']);
			$ppn=$this->input->post('ppn');
			$this->mOrder->saveTotalUlang($toview['kd_order'],$ppn);
			redirect('order/update_sukses');		
		}
		
		#judul
		//$this->judul='Edit Biaya Lain';
		
		#load view
		$this->content=$this->load->view('order/biaya_lain_edit',$toview);
	}
	
	public function editDetail($kd_order,$kd_detail_order){
		$this->errormsg='';$this->listParameter=""; $this->list_order="";
		$detail=$this->mOrder->getDetail($kd_detail_order,true);
		$parameter=$this->mOrder->getParameter($detail->kd_detail_order,true);
		$toview['kd_order']=$kd_order;
		$toview['kd_detail_order']=$detail->kd_detail_order;
		$toview['jenis_contoh']=$detail->jenis_contoh;
		$toview['nama_contoh']=$detail->nama_contoh;
		$toview['metoda']=$detail->metoda;
		$toview['kondisi_kemasan']=$detail->kondisi_kemasan;
		$toview['kondisi_contoh']=$detail->kondisi_contoh;
		$toview['tanda_contoh']=$detail->tanda_contoh;
		$toview['no_pengujian']=$detail->no_pengujian; 
		$toview['jumlah_contoh']=$detail->jumlah_contoh;
		//$toview['jumlah_uji']=$detail->jumlah_uji;
		$toview['jumlah_sertifikat']=$detail->jumlah_sertifikat;
		$toview['harga_subtotal']=$detail->harga_subtotal;
		$toview['kd_tarif']=$detail->kd_tarif;
		$toview['kd_jenis_tarif']=$detail->kd_jenis_tarif ;
		$toview['kd_satker']=$detail->kd_satker;
		$toview['tgl_create ']=$detail->tgl_create ;
	        //if($kd_tarif){
	   		$toview['kd_tarif']=$detail->kd_tarif;
	   		$result=$this->mTarif->getTarif($detail->kd_tarif);
		 	//$toview['nama_contoh']=$result->nama_tarif;
		 	//$toview['metoda']=$result->metoda_tarif;
	   		$result2=$this->mTarif->getParameter('',$detail->kd_tarif,true);
			if($result2){
				$this->listParameter='<ol>'; $counter=0;
				foreach($result2 as $row){
					$ceklist="";$cek="";$visible="hidden";$jumuji=1;
					foreach($parameter as $par){
						if($row->kd_parameter==$par->kd_parameter) {
							$ceklist="checked"; 
							if($par->jumlah_uji > 1){
								$cek="checked";
								$visible="visible";
								$jumuji=$par->jumlah_uji;
							}
						}
					}
					//$this->listParameter.='<li><input type="checkbox" name="parameter[]" value="'.$row->kd_parameter.'" '.$ceklist.'>&nbsp;'.ucfirst($row->nama_parameter).' ('.$row->metoda_parameter.' Rp. '.number_format($row->harga_satuan,2).')</li>';
					$this->listParameter.='<li><input type="checkbox" name="parameter['.$counter.']" '.$ceklist.' id="parameter-'.$counter.'" value="'.$row->kd_parameter.'" onchange="if(document.getElementById(\'cekJumlahUji-'.$counter.'\').checked){document.getElementById(\'cekJumlahUji-'.$counter.'\').checked=this.checked; document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'hidden\'}" >&nbsp;'.ucfirst($row->nama_parameter).' ('.$row->metoda_parameter.' Rp. '.number_format($row->harga_satuan,2).')&nbsp;&nbsp;<input name="cekJumlahUji['.$row->kd_parameter.']" '.$cek.' id="cekJumlahUji-'.$counter.'"  type="checkbox" value="'.$counter.'" onchange="javascript:if(this.checked){ document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'visible\'} else { document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'hidden\'}" />&nbsp;Jumlah Uji&nbsp; <input type="text" name="jumlah_uji['.$row->kd_parameter.']" class="input" value="'.$jumuji.'" maxlength="4" size="4" id="jumlah_uji-'.$counter.'" style="visibility:'.$visible.'"></li>';
					$counter++;
				}
				$this->listParameter.='</ol><input type="checkbox" name="cekAllJumlahUji" value="1" id="cekAllJumlahUji" onchange="CheckItAll()">&nbsp;Check All';
			}
	   //} 
		
		$toview['limit']=30;
		$toview['page']=1;
		$page=1;
		#get result
		$toview['tot']=$this->mOrder->GetTotalDetail($toview['kd_order'],'',true);
		//echo "<script>alert('{$toview['tot']}')</script>";
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mOrder->GetResultDetail($toview['kd_order'],'',true,'kd_detail_order','desc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		$totbiayaorder=0;
		if($toview['result']){
			foreach($toview['result'] as $row){
				$totbiayaorder +=($row->harga_subtotal);
			}
		}
		$toview['totbiayaorder'] = $totbiayaorder;

		$this->form_validation->set_rules('jenis_contoh', 'Jenis Contoh', 'required');
		$this->form_validation->set_rules('nama_contoh', 'Nama Contoh', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');
		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		if($this->input->post('save')){
		  echo "<script>alert('tes save edit')</script>";
		  if($this->form_validation->run())
		  {
			 echo "<script>alert('tes validation edit edit')</script>";  
			if($this->input->post('tambah')){
				echo "<script>alert('tes tambah edit')</script>";  
				if($this->errormsg=="") { 
					$parameterlist=$this->input->post('parameter');
					$toview['jumlah_contoh']=$this->input->post('jumlah_contoh');
					$jumujilist=$this->input->post('jumlah_uji');
					//$toview['jumlah_uji']=$this->input->post('jumlah_uji');
					$toview['jumlah_sertifikat']=$this->input->post('jumlah_sertifikat');
				   	$toview['kondisi_kemasan']=trim($this->input->post('kondisi_kemasan'));
				   	$toview['kondisi_contoh']=trim($this->input->post('kondisi_contoh'));
				   	$toview['tanda_contoh']=trim($this->input->post('tanda_contoh'));
				   	$toview['no_pengujian']=trim($this->input->post('no_pengujian'));
				        $toview['kd_jenis_tarif']=trim($this->input->post('kd_jenis_tarif'));
					//$toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
					$toview['kd_detail_order']=$kd_detail_order;
					$hasil=$this->mOrder->SaveDetail($toview,$kd_detail_order,$parameterlist,$jumujilist,true); 
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
							current_url(),"Update Detail Order Sementara");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/Detail/'.$toview['kd_order']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}
			  }
			  if($this->input->post('selesai')){
				if($this->errormsg=="") { 
					$toview['tgl_create']=date("Y-m-d H:i:s");
					$toview['tgl_update']=date("Y-m-d H:i:s");
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
					$hasil=$this->mOrder->SaveOrder($toview,$toview['kd_order'],false); 
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Order Disimpan Sementara");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						///cho "<script>alert('Berhasil disimpan')</script>";
						redirect('order/Detail/'.$toview['kd_order']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}
			  }
		  }
		}
		#judul
		$this->judul='Edit Order';
		$this->javascript='
		<script type="text/javascript">
		function CheckItAll(){
			for(i=0;i<'.$counter.';i++){
				document.getElementById(\'parameter-\' + i).checked=document.getElementById(\'cekAllJumlahUji\').checked;
			}
		}
		$(document).ready(function(){
			';
			$this->javascript.='var data = [';
			$result=$this->mTarif->getJenisTarif('',true);
			foreach($result as $row){
					$this->javascript.="{text:'".$row->jenis_tarif."', url:'".$row->kd_jenis_tarif."'},";
			}
			$this->javascript.='];';
			if(@$kd_jenis_tarif){
				$this->javascript.='
				var data2 = [';
				$result=$this->mTarif->getTarif('',$kd_jenis_tarif,true);
				if($result){
					foreach($result as $row){
							$this->javascript.="{text:'".$row->nama_tarif."', url:'".$row->kd_tarif."'},";
					}
				}
				$this->javascript.='];';
				$this->javascript.='
				$("#nama_contoh").autocomplete(data2, {
				matchContains: true,
				  formatItem: function(item) {
					return item.text;
				  }
				}).result(function(event, item) {
				  location.href = \'index.php/order/Detail/'.$toview['kd_order'].'/'.$toview['kd_jenis_tarif'].'/\' + item.url;
				});';
			}
			$this->javascript.='
			$("#jenis_contoh").autocomplete(data, {
			matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/Detail/'.$toview['kd_order'].'/\' + item.url;
			});
		});  
		
		</script>
		';
		#load view
		$this->content=$this->load->view('order/pengujian/order_detail',$toview);	
	}
	
public function editDetailO($kd_order,$kd_detail_order){
		$this->errormsg='';
		$this->listParameter=""; 
		$this->list_order="";
		$detail=$this->mOrder->getDetail($kd_detail_order,false);
		$parameter=$this->mOrder->getParameter($detail->kd_detail_order,false);
		$toview['kd_order']=$kd_order;
		$toview['kd_detail_order']=$detail->kd_detail_order;
		$toview['jenis_contoh']=$detail->jenis_contoh;
		$toview['nama_contoh']=$detail->nama_contoh;
		$toview['metoda']=$detail->metoda;
		$toview['kondisi_kemasan']=$detail->kondisi_kemasan;
		$toview['kondisi_contoh']=$detail->kondisi_contoh;
		$toview['tanda_contoh']=$detail->tanda_contoh;
		$toview['no_pengujian']=$detail->no_pengujian; 
		$toview['jumlah_contoh']=$detail->jumlah_contoh;
		//$toview['jumlah_uji']=$detail->jumlah_uji;
		$toview['jumlah_sertifikat']=$detail->jumlah_sertifikat;
		$toview['harga_subtotal']=$detail->harga_subtotal;
		$toview['kd_tarif']=$detail->kd_tarif;
		$toview['kd_jenis_tarif']=$detail->kd_jenis_tarif;
		$toview['kd_satker']=$detail->kd_satker;
		$toview['tgl_create ']=$detail->tgl_create;

	        //if($kd_tarif){
	   		$toview['kd_tarif']=$detail->kd_tarif;
	   		$result=$this->mTarif->getTarif($detail->kd_tarif);
		 	//$toview['nama_contoh']=$result->nama_tarif;
		 	//$toview['metoda']=$result->metoda_tarif;
	   		$result2=$this->mTarif->getParameter('',$detail->kd_tarif,true);
			if($result2){
				$this->listParameter='<ol>'; $counter=0;
				foreach($result2 as $row){
					$ceklist="";$cek="";$visible="hidden";$jumuji=1;
					foreach($parameter as $par){
						if($row->kd_parameter==$par->kd_parameter) {
							$ceklist="checked"; 
							if($par->jumlah_uji > 1){
								$cek="checked";
								$visible="visible";
								$jumuji=$par->jumlah_uji;
							}
						}
					}
					
					$this->listParameter.=
					'<li>
						<input type="checkbox" name="parameter['.$counter.']" '.$ceklist.' id="parameter-'.$counter.'" 							value="'.$row->kd_parameter.'" 						
                                		onchange="
						if(document.getElementById(\'cekJumlahUji-'.$counter.'\').checked)
                                		{
				    			document.getElementById(\'cekJumlahUji-'.$counter.'\').checked=this.checked; 
                                    			document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
				    			document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'hidden\'
                                		}" >&nbsp;'.ucfirst($row->nama_parameter).' ('.$row->metoda_parameter.' Rp. '
                                    		.number_format($row->harga_satuan,2).')&nbsp;&nbsp;
						<input name="cekJumlahUji['.$row->kd_parameter.']" '.$cek.' id="cekJumlahUji-'.$counter.'"  
                                  		type="checkbox" value="'.$counter.'" 
                                		onchange="javascript:if(this.checked)				
						{ 
				  			 document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 	
                                   			document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'visible\' 
						}else { 
				   			document.getElementById(\'jumlah_uji-'.$counter.'\').value=\'1\'; 
                                  			document.getElementById(\'jumlah_uji-'.$counter.'\').style.visibility=\'hidden\'
						}" />&nbsp;Jumlah Uji&nbsp; 
						<input type="text" name="jumlah_uji['.$row->kd_parameter.']" class="input" 
							value="'.$jumuji.'" maxlength="4" size="4" id="jumlah_uji-'.$counter.'"
							 style="visibility:'.$visible.'">
					</li>';
					$counter++;
				}
				$this->listParameter.='</ol>
						<input type="checkbox" name="cekAllJumlahUji" value="1" id="cekAllJumlahUji"
							 onchange="CheckItAll()">&nbsp;Check All';
			}
	   //} 
		
		 $toview['limit']=30;
		 $toview['page']=1;
		 $page=1;
			#get result
			$toview['tot']=$this->mOrder->GetTotalDetail($toview['kd_order'],'',false);
			//echo "<script>alert('{$toview['tot']}')</script>";
			if($toview['tot']>0){
				$toview['pages']=ceil($toview['tot']/$toview['limit']);
				if(!is_numeric($page)){$toview['page']=1;}
				elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
				else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['result']=$this->mOrder->GetResultDetail($kd_order,'',false,'kd_detail_order','desc',30,0);
			} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['result']=false;
			}

		$harga_total=0;
		//echo "<script>alert('test')</script>";
		$totbiayaorder=0;
		if($toview['result']){
			//echo "<script>alert('test result')</script>";
			foreach($toview['result'] as $row){
				$harga_total += $row->harga_subtotal; //bikin waktu di update ngitung ulang
				$totbiayaorder +=$row->harga_subtotal;
			}
		} else { 
			$harga_total=0; 
		}
		$toview['totbiayaorder']= $totbiayaorder;
		$totbiayalain=0;

		#biaya lain
		$toview['resultbiaya_lain']=$this->mOrder->getBiayaLain($toview['kd_order']);
		if($toview['resultbiaya_lain']){
		   foreach($toview['resultbiaya_lain'] as $row){
			$totbiayalain +=$row->sub_total_biaya;
		    }
		}else{
			$toview['resultbiaya_lain']=0;
		}
		$toview['subtotal']=$totbiayalain + $toview['totbiayaorder'];
		
		$this->form_validation->set_rules('jenis_contoh', 'Jenis Contoh', 'required');
		$this->form_validation->set_rules('nama_contoh', 'Nama Contoh', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');
		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			  if($this->input->post('edit')){
				//echo "<script>alert('test edit')</script>";
				if($this->errormsg=="") { 
					$parameterlist=$this->input->post('parameter');
					$toview['jumlah_contoh']=$this->input->post('jumlah_contoh');
					$jumujilist=$this->input->post('jumlah_uji');
					//$toview['jumlah_uji']=$this->input->post('jumlah_uji');
					$toview['jumlah_sertifikat']=$this->input->post('jumlah_sertifikat');
				   	$toview['kondisi_kemasan']=trim($this->input->post('kondisi_kemasan'));
				   	$toview['kondisi_contoh']=trim($this->input->post('kondisi_contoh'));
				   	$toview['tanda_contoh']=trim($this->input->post('tanda_contoh'));
				   	$toview['no_pengujian']=trim($this->input->post('no_pengujian'));
				        $toview['kd_jenis_tarif']=trim($this->input->post('kd_jenis_tarif'));
					$ppn=trim($this->input->post('ppn'));
					$toview['kd_detail_order']=$kd_detail_order;
					$hasil=$this->mOrder->SaveDetail($toview,$kd_detail_order,$parameterlist,
						$jumujilist,true,false); 
					$hasil2=$this->mOrder->saveTotalUlang($toview['kd_order'],$ppn); 
					//echo "<script>alert('test, total ulan OK ')</script>";
					
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Update Detail Order");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan, OK'+$kd_order)</script>";
						redirect('order/view/'.$toview['kd_order']);
						//redirect('order/DetailE/'.$toview['kd_order']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}
			  }
			
		  }
		}
		#judul
		$this->judul='Edit Detail Order';
		$this->javascript='
		<script type="text/javascript">

		function CheckItAll(){
			for(i=0;i<'.$counter.';i++){
				document.getElementById(\'parameter-\' + i).checked=document.getElementById(\'cekAllJumlahUji\').checked;
			}

		}
		$(document).ready(function(){
			';
			$this->javascript.='var data = [';
			$result=$this->mTarif->getJenisTarif('',true);
			foreach($result as $row){
					$this->javascript.="{text:'".$row->jenis_tarif."', url:'".$row->kd_jenis_tarif."'},";
			}
			$this->javascript.='];';
			if(@$kd_jenis_tarif){
				$this->javascript.='
				var data2 = [';
				$result=$this->mTarif->getTarif('',$kd_jenis_tarif,true);
				if($result){
					foreach($result as $row){
							$this->javascript.="{text:'".$row->nama_tarif."', url:'".$row->kd_tarif."'},";
					}
				}
				$this->javascript.='];';
				$this->javascript.='
				$("#nama_contoh").autocomplete(data2, {

				matchContains: true,
				  formatItem: function(item) {
					return item.text;
				  }

				}).result(function(event, item) {
				  location.href = \'index.php/order/editDetailO/'.$toview['kd_order'].'/'.$toview['kd_jenis_tarif'].'/\' + item.url;
				});';
			}
			$this->javascript.='

			$("#jenis_contoh").autocomplete(data, {
			matchContains: true,
			  formatItem: function(item) {
				return item.text;

			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/editDetailO/'.$toview['kd_order'].'/\' + item.url;
			});

		});  
		
		</script>
		';
		#load view
		$this->content=$this->load->view('order/pengujian/order_detail_edit',$toview);	
				
	}
	public function Confirm($kd_order){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order) $toview['kd_order']=$kd_order; else redirect('order');
		$order=$this->mOrder->getOrder($kd_order,true);
		$toview['no_order']=$order->no_order;
		$toview['tipe_order']=$order->tipe_order;
		$toview['sampling_order']=$order->sampling_order;
		$toview['no_spk']=$order->no_spk;
		$toview['no_surat_pengantar']=$order->no_surat_pengantar;
		$toview['tgl_order']=$order->tgl_order;
		$toview['tgl_surat_pengantar']=$order->tgl_surat_pengantar;
		$toview['tgl_perkiraan_selesai']=$order->tgl_perkiraan_selesai;
		$toview['bahasa_sertifikat']=$order->bahasa_sertifikat ;
		$toview['status_order']=$order->status_order;
		$toview['status_bayar']=$order->status_bayar;
		$toview['harga_total']=$order->harga_total;
		$toview['discount']=$order->discount;
		$toview['ppn']=$order->ppn;
		$toview['keterangan']=$order->keterangan;
		$toview['nama_pemohon']=$order->nama_pemohon;
		$toview['telp_pemohon']=$order->telp_pemohon;
		$toview['nama_customer_asal']=$order->nama_customer_asal;
		$toview['alamat_customer_asal']=$order->alamat_customer_asal;
		$toview['telp_customer_asal']=$order->telp_customer_asal;
		$toview['nama_customer_tujuan']=$order->nama_customer_tujuan;
		$toview['alamat_customer_tujuan']=$order->alamat_customer_tujuan;
		$toview['telp_customer_tujuan']=$order->telp_customer_tujuan;
		$toview['kd_jenis_layanan']=$order->kd_jenis_layanan;
		$toview['nip_penerima']=$order->nip_penerima;
		$toview['nm_penerima']=$order->nm_penerima;
		$toview['layanan']=$this->mOrder->getJenisLayanan($order->kd_jenis_layanan);
		$toview['limit']=30;
		$toview['page']=1;
		 $page=1;
		#get result
		$toview['tot']=$this->mOrder->GetTotalDetail($toview['kd_order'],'',true);
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mOrder->GetResultDetail($toview['kd_order'],'',true,'kd_detail_order','desc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		$totbiayaorder=0;
		if($toview['result']){
			foreach($toview['result'] as $row){
				$totbiayaorder +=($row->harga_subtotal);
			}
		}
		
		#biaya lain
		$totbiayalain=0;
		$toview['resultbiaya_lain']=$this->mOrder->getBiayaLain($toview['kd_order']);
		if($toview['resultbiaya_lain']){
		    foreach($toview['resultbiaya_lain'] as $row){
			$totbiayalain +=$row->sub_total_biaya;
		    }
		}else{
		  $totbiayalain=0;
		}
		$toview['totbiayaorder']= $totbiayaorder;
		$toview['subtotal']=$totbiayalain + $toview['totbiayaorder'];

		if($toview['discount']<=100) $toview['discount']=ceil(($toview['totbiayaorder']*$toview['discount'])/100);
		if($toview['ppn']<=100) $toview['ppn']=ceil((($toview['subtotal']-$toview['discount'])*$toview['ppn'])/100);
		$toview['harga_total']= $toview['subtotal'] - $toview['discount'] + $toview['ppn'];
		
				
		
		if($this->input->post('save')){
			if($this->errormsg=="") { 
				$toview['tgl_create']=date("Y-m-d H:i:s");
				$toview['tgl_update']=date("Y-m-d H:i:s");
				$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				$toview['harga_total']=$this->input->post('harga_total');
				$toview['discount']=$this->input->post('discount');
				$toview['ppn']=$this->input->post('ppn');
				$hasil=$this->mOrder->SaveOrder($toview,$toview['kd_order'],false,false); 
				
				foreach($toview['result'] as $row){
					//========================================================================
					$resDet=$this->mOrder->getDetail($row->kd_detail_order,true);
					$arrDet['kd_detail_order']=$row->kd_detail_order;
					$arrDet['jenis_contoh']=$resDet->jenis_contoh;
					$arrDet['nama_contoh']=$resDet->nama_contoh;
					$arrDet['metoda']=$resDet->metoda;
					$arrDet['kondisi_kemasan']=$resDet->kondisi_kemasan;
					$arrDet['kondisi_contoh']=$resDet->kondisi_contoh;
					$arrDet['tanda_contoh']=$resDet->tanda_contoh; 
					$arrDet['no_pengujian']=$resDet->no_pengujian;
					$arrDet['jumlah_contoh']=$resDet->jumlah_contoh;
					//$arrDet['jumlah_uji']=$resDet->jumlah_uji;
					$arrDet['jumlah_sertifikat']=$resDet->jumlah_sertifikat;
					$arrDet['harga_subtotal']=$resDet->harga_subtotal;
					$arrDet['kd_order']=$resDet->kd_order;
					$arrDet['kd_tarif']=$resDet->kd_tarif;
					$arrDet['kd_jenis_tarif']=$resDet->kd_jenis_tarif;
					$arrDet['kd_satker']=$resDet->kd_satker;
					$arrDet['tgl_create']=$resDet->tgl_create;
					$hasil=$this->mOrder->SaveDetail($arrDet,$row->kd_detail_order,'','',false,false);
					$res=$this->mOrder->getParameter($row->kd_detail_order,true);
					if($res){
						foreach($res as $par){
							$arrPar['kd_parameter']=$par->kd_parameter;
							$arrPar['nama_parameter']=$par->nama_parameter;
							$arrPar['metoda_parameter']=$par->metoda_parameter;
							$arrPar['syarat_mutu_parameter']=$par->syarat_mutu_parameter;
							$arrPar['harga_satuan']=$par->harga_satuan;
							$arrPar['satuan']=$par->satuan;
							$arrPar['jumlah_uji']=$par->jumlah_uji;
							$arrPar['kd_detail_order']=$row->kd_detail_order;
							$arrPar['kd_satker']=$par->kd_satker;
							$arrPar['tgl_create']=$par->tgl_create;
							
							$hasil=$this->mOrder->SaveDetailParameter($arrPar,$row->kd_detail_order,false);
						}
					}
					//========================================================================
				}
				if($hasil) { 
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					current_url(),"Order Baru Dikonfirmasi");
					$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
					//echo "<script>alert('Berhasil disimpan')</script>";
					redirect('order/Sukses/'.$toview['kd_order']);
				} else { 
					$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
					//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
					redirect(current_url());
				}
			}
		}
		#judul
		$this->judul='Konfirmasi Order';
		#load view
		if($this->session->flashdata('cetak')){
			$this->content=$this->load->view('cetak/print_order_konfirmasi',$toview);
		} else {
			$this->content=$this->load->view('order/pengujian/order_konfirmasi',$toview);
		}
	}

	public function ConfirmE($kd_order){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order) $toview['kd_order']=$kd_order; else redirect('order');
		//$order=$this->mOrder->getOrder($kd_order,true);
		$order=$this->mOrder->getOrder($kd_order,false);
		$toview['no_order']=$order->no_order;
		$toview['tipe_order']=$order->tipe_order;
		$toview['sampling_order']=$order->sampling_order;
		$toview['no_spk']=$order->no_spk;
		$toview['no_surat_pengantar']=$order->no_surat_pengantar;
		$toview['tgl_order']=$order->tgl_order;
		$toview['tgl_surat_pengantar']=$order->tgl_surat_pengantar;
		$toview['tgl_perkiraan_selesai']=$order->tgl_perkiraan_selesai;
		$toview['bahasa_sertifikat']=$order->bahasa_sertifikat ;
		$toview['status_order']=$order->status_order;
		$toview['status_bayar']=$order->status_bayar;
		$toview['harga_total']=$order->harga_total;
		$toview['discount']=$order->discount;
		$toview['ppn']=$order->ppn;
		$toview['keterangan']=$order->keterangan;		
		//$toview['nama_penerima_contoh']=$order->nama_penerima_contoh;
		$toview['nama_pemohon']=$order->nama_pemohon;
		$toview['telp_pemohon']=$order->telp_pemohon;
		$toview['nama_customer_asal']=$order->nama_customer_asal;
		$toview['alamat_customer_asal']=$order->alamat_customer_asal;
		$toview['telp_customer_asal']=$order->telp_customer_asal;
		$toview['nama_customer_tujuan']=$order->nama_customer_tujuan;
		$toview['alamat_customer_tujuan']=$order->alamat_customer_tujuan;
		$toview['telp_customer_tujuan']=$order->telp_customer_tujuan;
		$toview['kd_jenis_layanan']=$order->kd_jenis_layanan;
		$toview['nip_penerima']=$order->nip_penerima;
		$toview['nm_penerima']=$order->nm_penerima;
		$toview['layanan']=$this->mOrder->getJenisLayanan($order->kd_jenis_layanan);
		$toview['limit']=30;
		$toview['page']=1;
		 $page=1;
		#get result
		//$toview['tot']=$this->mOrder->GetTotalDetail($toview['kd_order'],'',true);
		$toview['tot']=$this->mOrder->GetTotalDetail($toview['kd_order'],'',false);
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			//$toview['result']=$this->mOrder->GetResultDetail($toview['kd_order'],'',true,'kd_detail_order','desc',30,0);
			$toview['result']=$this->mOrder->GetResultDetail($toview['kd_order'],'',false,'kd_detail_order','desc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		$totbiayaorder=0;
		if($toview['result']){
			foreach($toview['result'] as $row){
				$totbiayaorder +=$row->harga_subtotal;
			}
		}
		$toview['totbiayaorder']= $totbiayaorder;	
		

		#biaya lain
		$totbiayalain=0;
		$toview['resultbiaya_lain']=$this->mOrder->getBiayaLain($toview['kd_order']);
		foreach($toview['resultbiaya_lain'] as $row){
			$totbiayalain +=$row->sub_total_biaya;
		}
		$toview['subtotal']=$totbiayalain + $toview['totbiayaorder'];

		if($toview['discount']<=100) $toview['discount']=ceil(($toview['totbiayaorder']*$toview['discount'])/100);
		if($toview['ppn']<=100) $toview['ppn']=ceil((($toview['subtotal']-$toview['discount'])*$toview['ppn'])/100);
		$toview['harga_total']= $toview['subtotal'] - $toview['discount'] + $toview['ppn'];
		
		
		if($this->input->post('save')){
			if($this->errormsg=="") { 
				$toview['tgl_create']=date("Y-m-d H:i:s");
				$toview['tgl_update']=date("Y-m-d H:i:s");
				$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				$toview['harga_total']=$this->input->post('harga_total');
				$toview['discount']=$this->input->post('discount');
				$toview['ppn']=$this->input->post('ppn');
				//$hasil=$this->mOrder->SaveOrder($toview,$toview['kd_order'],false,false); 
				$hasil=$this->mOrder->SaveOrder($toview,$toview['kd_order'],true,false); 
				
				foreach($toview['result'] as $row){
					//========================================================================
					//$resDet=$this->mOrder->getDetail($row->kd_detail_order,true);
					$resDet=$this->mOrder->getDetail($row->kd_detail_order,false);
					$arrDet['kd_detail_order']=$row->kd_detail_order;
					$arrDet['jenis_contoh']=$resDet->jenis_contoh;
					$arrDet['nama_contoh']=$resDet->nama_contoh;
					$arrDet['metoda']=$resDet->metoda;
					$arrDet['kondisi_kemasan']=$resDet->kondisi_kemasan;
					$arrDet['kondisi_contoh']=$resDet->kondisi_contoh;
					$arrDet['tanda_contoh']=$resDet->tanda_contoh; 
					$arrDet['no_pengujian']=$resDet->no_pengujian;
					$arrDet['jumlah_contoh']=$resDet->jumlah_contoh;
					//$arrDet['jumlah_uji']=$resDet->jumlah_uji;
					$arrDet['jumlah_sertifikat']=$resDet->jumlah_sertifikat;
					$arrDet['harga_subtotal']=$resDet->harga_subtotal;
					$arrDet['kd_order']=$resDet->kd_order;
					$arrDet['kd_tarif']=$resDet->kd_tarif;
					$hasil=$this->mOrder->SaveDetail($arrDet,$row->kd_detail_order,'','',true,false);
					//$res=$this->mOrder->getParameter($row->kd_detail_order,false);
					//if($res){
					//	foreach($res as $par){
					//		$arrPar['kd_parameter']=$par->kd_parameter;
					//		$arrPar['nama_parameter']=$par->nama_parameter;
					//		$arrPar['harga_satuan']=$par->harga_satuan;
					//		$arrPar['satuan']=$par->satuan;
					//		$arrPar['jumlah_uji']=$par->jumlah_uji;
					//		$arrPar['kd_detail_order']=$row->kd_detail_order;
					//	$hasil=$this->mOrder->SaveDetailParameter($arrPar,$row->kd_detail_order,false);
					//	}
					//}
					//========================================================================
				}
				if($hasil) { 
					//$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
					//	current_url(),"Order Baru Dikonfirmasi");
					$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
					//echo "<script>alert('Berhasil disimpan')</script>";
					redirect('order/SuksesE/'.$toview['kd_order']);
				} else { 
					$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
					//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
					redirect(current_url());
				}
			}
		}
		#judul
		$this->judul='Konfirmasi Order';
		#load view
		if($this->session->flashdata('cetak')){
			$this->content=$this->load->view('cetak/print_order_konfirmasi',$toview);
		} else {
			$this->content=$this->load->view('order/pengujian/order_konfirmasi',$toview);
		}
	}
	
	
	public function Sukses($kd_order){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		$this->mOrder->DeleteOrderC($kd_order,true,true);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Order Baru berhasil disimpan");
		#judul
		$this->judul='Order Sukses';
		#load view
		$this->content=$this->load->view('order/order_sukses');
	}
	public function SuksesE($kd_order){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Order Baru berhasil disimpan");
		#judul
		$this->judul='Order Sukses';
		#load view
		$this->content=$this->load->view('order/order_sukses');
	}
	
	public function delOrder($kd_order,$temp=0,$turunan=true){
		$this->mOrder->DeleteOrder($kd_order,$temp,$turunan);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Hapus Order dan turunannya");
		redirect('order/');
	}
	
	public function delDetail($kd_order,$kd_detail_order){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		$result = $this->mOrder->DeleteParameter($kd_detail_order,true);
		$result = $this->mOrder->DeleteDetail($kd_detail_order,true);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"Hapus Detail Order dan turunannya");
		redirect('order/Detail/'.$kd_order);
	}

	public function delDetailE($kd_order,$kd_detail_order){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		$result = $this->mOrder->DeleteParameter($kd_detail_order,false);
		$result = $this->mOrder->DeleteDetail($kd_detail_order,false);
		$result = $this->mOrder->saveTotalUlang($kd_order);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Detail Order dan turunannya");
		redirect('order/view/'.$kd_order);
	}
	
	public function Pembayaran($kd_order,$nilai,$tanggal){
		$toview['kd_order']=GetInput($this->input->post('kd_order'));
		$toview['nilai']=GetInput($this->input->post('nilai_bayar'));
		if($this->input->post('submit')){
			$this->mOrder->savePembayaranSementara($toview['kd_order'],$toview['nilai']);
		}
	}
	
	public function TotalPembayaran($kd_order,$rinci=false){
		$data=$this->mOrder->getPembayaranSementara($kd_order);
		if($rinci){
			$tampung = '<table border="0"><tr><th>Tanggal</th><th>Pembayaran</th></tr>';
			$i=0;
			foreach($data as $row){
				$i++;
				if ($i % 2 != 0) {
					$bgcolor = "#DFDFFF";
				}else{
					$bgcolor = "#EEEEEE";
				}
				$tampung .= '<tr bgcolor="'.$bgcolor.'" onMouseOver="this.style.background=\'#F0FFB8\';"
                                            onMouseOut="this.style.background=\''.$bgcolor.'\'">
 					   <td>'.$row->tgl_bayar.'</td>
					   <td>'.$row->nilai_bayar.'</td></tr>';
			}
			$tampung .= '</table>';
			return $tampung;
		} else {
			$total=0;
			foreach($data as $row){
				$total +=$row->nilai_bayar;
			}
			return "Rp. ".number_format($total);
		}
	}
	public function input_pembayaran($kd_order,$action='',$kd_pembayaran=''){
		$dat=$this->mOrder->getOrder($kd_order);
		$user=$this->mUser->getDetail($this->session->userdata('userid')); 

		$res1=$this->mOrder->getDetail('',false,$kd_order);
	   	$jum_contoh=0;
	  	if($res1){
			foreach($res1 as $dat1){
			$jum_contoh +=$dat1->jumlah_contoh;
			}
		
	  	 }
		$tujuan_pembayaran='';
		$tujuan_pembayaran .= "Biaya uji sebanyak ".$jum_contoh." contoh";

		$form='<base href="'.base_url().'"><h2><center>Pembayaran No. Order '.$dat->no_order.'</center></h2>';
		if($dat->status_order<>'Closed'){
		$form.='<form action="index.php/order/input_pembayaran/'.$kd_order.'" method="post">
			<input type="hidden" name="nip_penerima" value="'.$user->nip_baru.'" >
			<input type="hidden" name="nama_penerima" value="'.$user->Nama.'"> ';
		$form.='<table border="0">';
		$form.='<tr>
				<td>Nomor</td>
				<td><input type="text" name="no_pembayaran" size=30 ></td> <!--value="'.$this->mOrder->Make_no_pembayaran().'"> -->
                       </tr>';
		$form.='<tr>
				<td>Sudah Terima Dari</td>
				<td><input type="text" name="nama_pembayar" value="'.$dat->nama_customer_asal.'" size=50></td>
                       </tr>';
		//$form.='<tr>
		//		<td>Untuk Pembayaran</td>
		//		<td><input type="text" name="tujuan_pembayaran" size=50 
		//		value="'.$tujuan_pembayaran.'" ></td>
                 //      </tr>';
		$form.='<tr>
				<td valign="top">Untuk Pembayaran</td>
				<td valign="top"><textarea  name="tujuan_pembayaran"  rows="5" cols="65" class="tinymce"></textarea></td>
                       </tr>';
		$form.='<tr>
				<td>Nilai Bayar Rp.</td>
				<td><input type="text" name="nilai" align="right" style="text-align:right"></td>
                       </tr>';
		$form.='<tr>
				<td>Tanggal Bayar</td><td><input type="text" name="tanggal" id="tanggal" 
					size="10"></td>
			</tr>';
		
		$form.='<tr><td colspan="2"><input type="submit" name="submit" value="Kirim"></td></tr>';
		$form.='</table><hr width="300" align="left">
			<link type="text/css" href="js/calendar/css/smoothness/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
          		<script type="text/javascript" src="js/calendar/js/jquery-1.5.1.min.js"></script>
           		<script type="text/javascript" src="js/calendar/js/jquery-ui-1.8.14.custom.min.js"></script>
			<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	   		<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
			<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>	 
			<script type="text/javascript">
				$("#tanggal").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",								 
				showOn: "both"
			});
			$(document).ready(function(){
				$("textarea.tinymce").tinymce({
            				// Location of TinyMCE script 
            				script_url : "'.base_url().'js/tiny_mce/tiny_mce.js",
					mode : "textareas",
					theme : "advanced",
					plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,inlinepopups,insertdatetime,preview,searchreplace,print,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

            			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,cleanup,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,advhr,|,print,|,ltr,rtl",
					force_p_newlines : false,
					force_br_newlines : true,
					forced_root_block : "",
        			});
			});</script>';
			
		}
		echo $form;
		
		if($this->input->post('submit')){
			$tosave['kd_pembayaran']=$this->mOrder->Make_kd_pembayaran();
			$tosave['nilai_bayar']=trim($this->input->post('nilai'));
			$tosave['tgl_bayar']=trim($this->input->post('tanggal'));
			$tosave['no_pembayaran']=trim($this->input->post('no_pembayaran'));
			$tosave['nama_pembayar']=trim($this->input->post('nama_pembayar'));
			$tosave['tujuan_pembayaran']=trim($this->input->post('tujuan_pembayaran'));
			$tosave['nip_penerima']=trim($this->input->post('nip_penerima'));
			$tosave['nama_penerima']=trim($this->input->post('nama_penerima'));
			$tosave['kd_order']=$kd_order;
			$tosave['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$tosave['tgl_create']=date("Y-m-d H:i:s");
			$res=$this->mOrder->savePembayaranSementara($tosave,$tosave['kd_order']);
		}
		if($action=='del'){
			if($kd_pembayaran){
				$res2=$this->mOrder->deletePembayaran($kd_pembayaran);
				if($res2) echo '<script>alert(\'Berhasil di hapus!\')</script>';
			}
		}

		
		
		
		$data=$this->mOrder->getPembayaranSementara($kd_order,'','');
		$tampung = '<table border="1" background="#0C065B">
			    <tr>
				<th>Nomor</th>
				<th>Tanggal</th>
				<th>Pembayaran</th>
				<th>Sudah Terima Dari</th>
				<th>Untuk Pembayaran</th>';
		if($dat->status_order<>'Closed'){
		$tampung .=     '<th>Hapus</th>';
		}
		$tampung .=     '<th>Cetak Kuitansi</th>
			    </tr>';
		$i=0;
		if($data){
			$totnilai=0;
			foreach($data as $row){
				$i++;
				if ($i % 2 != 0) {
					$bgcolor = "#DFDFFF";
				}else{
					$bgcolor = "#EEEEEE";
				}
				$totnilai +=$row->nilai_bayar;
				$tampung .= '<tr bgcolor="'.$bgcolor.'" onMouseOver="this.style.background=\'#F0FFB8\';"
						 onMouseOut="this.style.background=\''.$bgcolor.'\'">
						<td>'.$row->no_pembayaran.'</td>
						<td>'.date("d-m-Y",strtotime($row->tgl_bayar)).'</td>
						<td>'.formatRupiah($row->nilai_bayar).'</td>
						<td>'.$row->nama_pembayar.'</td>
						<td>'.$row->tujuan_pembayaran.'</td>';
				if($dat->status_order<>'Closed'){
				$tampung .=    '<td align="center">
						    <a href="'.current_url().'/del/'.$row->kd_pembayaran.'" 
						    onclick="return confirm(\'Yakin ingin dihapus?\')">
						    <img src="images/del.gif" border="0"></a>
						</td>';
				}
				$tampung .=    '<td align="center">
						    <a href="index.php/order/kwitansi/'.$row->kd_pembayaran.'" 
						    target="_blank">
						    <img src="images/print1.jpg" border="0"></a>
						</td>
						
					     </tr>';
			}
		  $tampung .= '</table>';
		  echo $tampung;
		  $sisa=$dat->harga_total-$totnilai;
		  echo '<div style="margin-top:20px;font-size:14;font-weight:bold">';
		  echo "Total Pembayaran ".formatRupiah($totnilai)."<br>";
		  echo "Total Harga ".formatRupiah($dat->harga_total)."<br>";
		  echo "<hr width='300' align='left'>Sisa Pembayaran ".formatRupiah($sisa);
		  echo "</div>";
		} else { 
			  echo '<div style="margin-top:20px;font-size:14;font-weight:bold">Belum ada Pembayaran Saat ini</div>'; 
                }
		echo '<p align="center">
		      <input id="Selesai" value="&nbsp;&nbsp;Tutup&nbsp;&nbsp;" style="width:150px" class="button"
                       onclick="parent.tb_remove(); parent.location.reload(1)" type="button" style="clear:both; 
                       text-align:center; float:left">';


		
	}

	public function kwitansi($kd_pembayaran){
	     $bayar=$this->mOrder->getPembayaranSementara('',$kd_pembayaran,'');		

	     foreach($bayar as $data ){
		
		$toview['kd_pembayaran']=$data->kd_pembayaran;
		$toview['nilai_bayar']=$data->nilai_bayar;
		$toview['tgl_bayar']=$data->tgl_bayar;
		$toview['no_pembayaran']=$data->no_pembayaran;
		$toview['nama_pembayar']=$data->nama_pembayar;
		$toview['tujuan_pembayaran']=$data->tujuan_pembayaran;
		$toview['nip_penerima']=$data->nip_penerima;
		$toview['nama_penerima']=$data->nama_penerima;
		$toview['kd_order']=$data->kd_order;
		$toview['kd_satker']=$data->kd_satker;
		$toview['tgl_create']=$data->tgl_create;
	    }
		$dat=$this->mOrder->getOrder($toview['kd_order']);
		$toview['no_order'] = $dat->no_order;
		$toview['jml_ppn_total'] = (10/100) * $toview['nilai_bayar'];
		$toview['biaya_uji']= $toview['nilai_bayar']*100/110;
		$toview['jml_ppn']= $toview['biaya_uji'] * 10/100;
		#judul
		$this->judul='<center><font size=5><b><u>KWITANSI</u></b></font></center>';
			
		#load view
		
		$this->content=$this->load->view('cetak/print_view_kwitansi',$toview);
			
		
	}
	
	public function input_invoice($kd_order,$kd_invoice='',$action=''){
		$dat=$this->mOrder->getOrder($kd_order);
		$user=$this->mUser->getDetail($this->session->userdata('userid')); 

		$dat_biaya=$this->mOrder->getPembayaranSementara($kd_order);
		$total_bayar=0;
		if($dat_biaya){
			foreach($dat_biaya as $row1){
				$total_bayar +=$row1->nilai_bayar;
				//echo $jumlah_bayar;
			}
		}
		$form='<base href="'.base_url().'"><h2><center>Invoice No. Order '.$dat->no_order.'</center></h2>';
		if($dat->status_order<>'Closed'){
		$form.='<form action="index.php/order/input_invoice/'.$kd_order.'" method="post">			
			<input type="hidden" name="nip_pembuat_invoice" value="'.$user->nip_baru.'" >
			<input type="hidden" name="nama_pembuat_invoice" value="'.$user->Nama.'"> 
			<input type="hidden" name="harga_total" value="'.$dat->harga_total.'">
			<input type="hidden" name="jumlah_bayar" value="'.$total_bayar.'">
			<input type="hidden" name="sisa_bayar" value="'.($dat->harga_total - $total_bayar).'">';
		$form.='<table border="0">';
		$form.='<tr>
				<td>No. Invoice</td>
				<td>
				<input type="hidden" name="kd_invoice" sise=30 value="'.$this->mOrder->Make_kd_invoice().'" >
				<input type="text" name="no_invoice" size=30 value="'.$this->mOrder->Make_no_invoice().'"></td>
                       </tr>';
		$form.='<tr>
				<td>Invoice Ke </td>

				<td><input type="text" name="invoice_ke" size=2></td>
                       </tr>';
		
		$form.='<tr>
				<td>Tanggal Invoice dibuat</td><td><input type="text" name="tgl_invoice" id="tgl_invoice" 
					size="10" value="'.date("Y-m-d").'"></td>
			</tr>';
		
		$form.='<tr><td colspan="2"><input type="submit" name="submit" value="Create Invoice"></td></tr>';
		$form.='</table><hr width="300" align="left">
			<link type="text/css" href="js/calendar/css/smoothness/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
          		<script type="text/javascript" src="js/calendar/js/jquery-1.5.1.min.js"></script>
           		<script type="text/javascript" src="js/calendar/js/jquery-ui-1.8.14.custom.min.js"></script>
			<script type="text/javascript">
				$("#tgl_invoice").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",								 
				showOn: "both"
			});</script>';
		}
		echo $form;
		
		if($this->input->post('submit')){
			$tosave['kd_invoice']=$this->mOrder->Make_kd_invoice();
			$tosave['no_invoice']=trim($this->input->post('no_invoice'));
			$tosave['invoice_ke']=trim($this->input->post('invoice_ke'));
			$tosave['tgl_invoice']=trim($this->input->post('tgl_invoice'));
			$tosave['harga_total']=trim($this->input->post('harga_total'));
			$tosave['jumlah_bayar']=trim($this->input->post('jumlah_bayar'));
			$tosave['sisa_bayar']=trim($this->input->post('sisa_bayar'));
			$tosave['nip_pembuat_invoice']=trim($this->input->post('nip_pembuat_invoice'));
			$tosave['nama_pembuat_invoice']=trim($this->input->post('nama_pembuat_invoice'));
			$tosave['kd_order']=$kd_order;
			$tosave['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$tosave['tgl_create']=date("Y-m-d H:i:s");
			$res=$this->mOrder->saveInvoice($tosave,$tosave['kd_order']);
			//$tosave['kd_invoice']='';

		}
		if($action=='del'){
			if($kd_invoice && $kd_order){
				$res2=$this->mOrder->deleteInvoice($kd_order,$kd_invoice);
				if($res2) 
					echo '<script>alert(\'Berhasil di hapus!\')</script>';
				else 
					echo '<script>alert(\'Gagal di hapus!\')</script>';
			}else echo '<script>alert(\'Gagal awal di hapus!\')</script>';
		}//else echo '<script>alert(\'Gagal awal3 di hapus!\')</script>';

		
		
		
		$data=$this->mOrder->getInvoice($kd_order,'','');
		$tampung = '<table border="1" background="#0C065B">

			    <tr>
				<th>No. Invoice</th>
				<th>Tgl. Invoice</th>
				<th>Invoice Ke </th>
				<th>Jumlah</th>
				<th>Panjar</th>
				<th>Saldo</th>';
		if($dat->status_order<>'Closed'){
		$tampung .=     '<th>Hapus</th>';
		}
		$tampung .=     '<th>Cetak Invoice</th>
			    </tr>';
		$i=0;
		if($data){
			$totnilai=0;
			foreach($data as $row){
				$i++;
				if ($i % 2 != 0) {
					$bgcolor = "#DFDFFF";
				}else{
					$bgcolor = "#EEEEEE";
				}
				
				$tampung .= '<tr bgcolor="'.$bgcolor.'" onMouseOver="this.style.background=\'#F0FFB8\';"
						 onMouseOut="this.style.background=\''.$bgcolor.'\'">
						<td>'.$row->no_invoice.'</td>
						<td>'.date("d-m-Y",strtotime($row->tgl_invoice)).'</td>

						<td>'.$row->invoice_ke.'</td>
						<td>'.formatRupiah($row->harga_total).'</td>
						<td>'.formatRupiah($row->jumlah_bayar).'</td>
						<td>'.formatRupiah($row->sisa_bayar).'</td>';
				if($dat->status_order<>'Closed'){
				$tampung .=    '<td align="center">
						    <a href="'.current_url().'/'.$row->kd_invoice.'/del/" 
						    onclick="return confirm(\'Yakin ingin dihapus?\')">
						    <img src="images/del.gif" border="0"></a>

						</td>';
				}
				$tampung .=    '<td align="center">
						    <a href="index.php/order/invoice/'.$kd_order.'/'.$row->kd_invoice.'" 
						    target="_blank">

						    <img src="images/print1.jpg" border="0"></a>
						</td>
						
					     </tr>';
			}
		  $tampung .= '</table>';
		  echo $tampung;
		  
		} else { 
			  echo '<div style="margin-top:20px;font-size:14;font-weight:bold">Belum ada Invoice yang dibuat</div>'; 
                }
		echo '<p align="center">

		      <input id="Selesai" value="&nbsp;&nbsp;Tutup&nbsp;&nbsp;" style="width:150px" class="button"
                       onclick="parent.tb_remove(); parent.location.reload(1)" type="button" style="clear:both; 
                       text-align:center; float:left">';
	}

	public function invoice($kd_order,$kd_invoice){

	     $inv=$this->mOrder->getInvoice($kd_order,$kd_invoice);		

	     foreach($inv as $data ){		
		$toview['kd_invoice']=$data->kd_invoice;
		$toview['no_invoice']=$data->no_invoice;
		$toview['invoice_ke']=$data->invoice_ke;
		$toview['tgl_invoice']=$data->tgl_invoice;
		$toview['harga_total']=$data->harga_total;
		$toview['jumlah_bayar']=$data->jumlah_bayar;
		$toview['sisa_bayar']=$data->sisa_bayar;
		$toview['nip_pembuat_invoice']=$data->nip_pembuat_invoice;
		$toview['nama_pembuat_invoice']=$data->nama_pembuat_invoice;
		$toview['kd_order']=$data->kd_order;
		//$kd_order=$data->kd_order;
		$toview['kd_satker']=$data->kd_satker;
		$nama_satker = $this->mstaff->getNamaSatker($data->kd_satker);
		$toview['nama_satker']=$nama_satker->nama_satker;		
		$toview['tgl_create']=$data->tgl_create;
		
	     }

	    	$dat=$this->mOrder->getOrder($toview['kd_order']);
		//$toview['kd_order']=$dat->kd_order;
		$toview['nama_customer']=$dat->nama_customer_asal;
		$toview['harga_total']=$dat->harga_total;
		$toview['jumlah_bayar']=$dat->jumlah_bayar;
		$toview['discount']=$dat->discount;
		$toview['ppn']=$dat->ppn;
		$toview['no_order']=$dat->no_order;
		
		//$total_bayar=$dat->jumlah_bayar;
		$harga_total=$dat->harga_total;
		$cust=$this->mCustomer->getDetail('',$dat->nama_customer_asal);		
			$toview['kota']= $cust->nama_kota;
      $toview['alamat']= $cust->alamat;		

		$toview['limit']=30;
		$toview['page']=1;
		 $page=1;
		#get result
		$toview['tot']=$this->mOrder->GetTotalDetail($toview['kd_order'],'',false);
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mOrder->GetResultDetail($toview['kd_order'],'',false,'kd_detail_order','desc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		$totbiayaorder=0;
		if($toview['result']){
			foreach($toview['result'] as $row){
				$totbiayaorder +=$row->harga_subtotal;
			}
		}		
		$toview['totbiayaorder']= $totbiayaorder;

		#biaya lain
		$totbiayalain = 0;
		$toview['resultbiaya_lain']=$this->mOrder->getBiayaLain($toview['kd_order']);
		if($toview['resultbiaya_lain']){
			foreach($toview['resultbiaya_lain'] as $row){
				$totbiayalain +=$row->sub_total_biaya;
			}
			$toview['totbiayalain'] = $totbiayalain;
		}else{
			$toview['totbiayalain']=0;
		}
		#Rincian Bayar
		$dat_bayar=$this->mOrder->getPembayaranSementara($toview['kd_order']);
		$total_bayar=0;
		if($dat_bayar){
			
			foreach($dat_bayar as $row){
				$total_bayar +=$row->nilai_bayar;			
				
			}
			$toview['jumlah_bayar'] = $total_bayar;
			$toview['sisa_bayar'] = $harga_total-$total_bayar;
                         
		}else{
			$toview['jumlah_bayar']=0;
			$toview['sisa_bayar']=$harga_total;
		}

		#judul
		$this->judul='<center><font size=5><b><u>INVOICE</u></b></font>
				<font size=2><br>No : '.$toview['no_invoice'].'</center>';
		#load view
		
		$this->content=$this->load->view('cetak/print_view_invoice',$toview);
			
		
	}

	public function input_status_parameter($kd_detail_order,$kd_parameter,$status_parameter='',$nm_analis='',
		$tgl_dikerjakan_analis='',$nm_penyelia='', $tgl_disetujui_penyelia='',$file_lkparameter=''){
		$this->errormsg="";
		$dat=$this->mOrder->getParameterPerItem($kd_detail_order,$kd_parameter,false);

		if(trim($this->input->post('nm_analis'))) 
			$toview['nm_analis']=trim($this->input->post('nm_analis')); 
		else $toview['nm_analis']='';

		if($this->input->post('submit')){
		  //echo "<script>alert(' input submit oke')</script>";			
		  //if($this->form_validation->run()){
			//echo "<script>alert('validation oke')</script>";
			$toview['kd_detail_order']=$kd_detail_order;
			$toview['kd_parameter']=$kd_parameter;			
			$toview['status_parameter']=trim($this->input->post('status_parameter'));
			if($this->session->userdata('profil')->groupname == 'analis'){
				//$toview['nm_analis']=trim($this->input->post('nm_analis'));
				$toview['tgl_dikerjakan_analis']=trim($this->input->post('tgl_dikerjakan_analis'));
				$toview['file_lkparameter']=trim($this->input->post('userfile'));
				$userfile=trim($this->input->post('userfile'));		
			}else{
				//$toview['nm_penyelia']=trim($this->input->post('nm_penyelia'));
				$toview['tgl_disetujui_penyelia']=trim($this->input->post('tgl_disetujui_penyelia'));
			}
			
					
			
			//if($this->errormsg=="") { 
			if($this->session->userdata('profil')->groupname == 'analis'){
				
				$file_dir='./download/lkparameter/'.date('Y-m').'/';
				if(!file_exists($file_dir)) {
						mkdir($file_dir);
				}else {
						//echo "<script>alert('Ok.file direktori sudah ada')</script>";
						$file_dir =$file_dir;
				}
				$syxupload['upload_path'] = $file_dir;
				$syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
				$syxupload['max_size']	= '3500';
				$syxupload['overwrite'] = 'TRUE'; 
				$syxupload['max_width']  = '1024';
				$syxupload['max_height']  = '768';
	

				$this->load->library('upload',$syxupload);
				if (!$this->upload->do_upload()){
					$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
					echo "<script>alert('$this->errormsg')</script>";
				}else{
					$data = array('upload_data' => $this->upload->data());

					$toview['file_lkparameter']=$file_dir.$data['upload_data']['file_name'];
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"save lembar kerja parameter :".$dat->nama_parameter." status : ".
								$toview['status_parameter']);
					$res=$this->mOrder->saveStatusParameter($toview,
					$kd_detail_order,$kd_parameter,false,false);
					redirect('order/upload_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_detail_order']='';
				}

			//}
			} else{
					
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"save lembar kerja parameter :".$dat->nama_parameter." status : ".
								$toview['status_parameter']);
					$res=$this->mOrder->saveStatusParameter($toview,
					$kd_detail_order,$kd_parameter,false,false);
					redirect('order/upload_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_detail_order']='';

			}	
		  //}else echo "<script>alert('validtion not oke')</script>";
		}
		if($kd_parameter) $toview['kd_parameter']=$kd_parameter;
		if($kd_detail_order) $toview['kd_detail_order']=$kd_detail_order;
		$toview['komentar_penyelia']=$dat->komentar_penyelia;
		
		
		
		#judul
		$this->judul='Parameter<br>'.$dat->nama_parameter;
		$detail=$this->mOrder->getDetail($kd_detail_order,false,'');
		$this->no_pengujian = $detail->no_pengujian;
		#javascript
		$this->javascript='
		<script type="text/javascript">
		$("#tgl_dikerjakan_analis").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 
			showOn: "both"
		});
		$("#tgl_disetujui_penyelia").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 
			showOn: "both"
		});
		</script>
		';
		
		#load view
		$this->content=$this->load->view('order/pengujian/upload_statusparameter',$toview);
	}

	public function uploadParameterAnalis($kd_detail_order,$kd_parameter,$status_parameter='',$nm_analis='',
		$tgl_dikerjakan_analis='',$nm_penyelia='', $tgl_disetujui_penyelia='',$komentar_penyelia='',$file_lkparameter=''){
		$this->errormsg="";
		$dat=$this->mOrder->getParameterPerItem($kd_detail_order,$kd_parameter,false);
		if(trim($this->input->post('nm_analis'))) 
			$toview['nm_analis']=trim($this->input->post('nm_analis')); 
		else $toview['nm_analis']='';

		if($this->input->post('submit')){
		  //echo "<script>alert(' input submit oke')</script>";			
		 
			$toview['kd_detail_order']=$kd_detail_order;
			$toview['kd_parameter']=$kd_parameter;			
			$toview['status_parameter']=trim($this->input->post('status_parameter'));
			$toview['tgl_dikerjakan_analis']=trim($this->input->post('tgl_dikerjakan_analis'));
			$toview['file_lkparameter']=trim($this->input->post('userfile'));
			$userfile=trim($this->input->post('userfile'));	
			
			//if($this->errormsg=="") { 
			if($this->session->userdata('profil')->groupname == 'analis'){
				
				$file_dir='./download/lkparameter/'.date('Y-m').'/';
				if(!file_exists($file_dir)) {
						mkdir($file_dir);
				}else {
						//echo "<script>alert('Ok.file direktori sudah ada')</script>";
						$file_dir =$file_dir;
				}
				$syxupload['upload_path'] = $file_dir;
				$syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
				$syxupload['max_size']	= '3500';
				$syxupload['overwrite'] = 'TRUE'; 
				$syxupload['max_width']  = '1024';
				$syxupload['max_height']  = '768';
	

				$this->load->library('upload',$syxupload);
				if (!$this->upload->do_upload()){
					$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
					echo "<script>alert('$this->errormsg')</script>";
				}else{
					$data = array('upload_data' => $this->upload->data());

					$toview['file_lkparameter']=$file_dir.$data['upload_data']['file_name'];
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"save lembar kerja parameter :".$dat->nama_parameter." status : ".
								$toview['status_parameter']);
					$res=$this->mOrder->saveStatusParameter($toview,
					$kd_detail_order,$kd_parameter,false,false);
					redirect('order/upload_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_detail_order']='';
				}

			//}
			} else{
					
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"save lembar kerja parameter :".$dat->nama_parameter." status : ".
								$toview['status_parameter']);
					$res=$this->mOrder->saveStatusParameter($toview,
					$kd_detail_order,$kd_parameter,false,false);
					redirect('order/upload_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_detail_order']='';

			}	
		  
		}
		if($kd_parameter) $toview['kd_parameter']=$kd_parameter;
		if($kd_detail_order) $toview['kd_detail_order']=$kd_detail_order;
		$toview['komentar_penyelia']=$dat->komentar_penyelia;
		
		
		
		#judul
		$this->judul='Parameter<br>'.$dat->nama_parameter;
		$detail=$this->mOrder->getDetail($kd_detail_order,false,'');
		$this->no_pengujian = $detail->no_pengujian;
		#javascript
		$this->javascript='
		<script type="text/javascript">
		$("#tgl_dikerjakan_analis").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 
			showOn: "both"
		});
		$("#tgl_disetujui_penyelia").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 
			showOn: "both"
		});
		</script>
		';
		
		#load view
		$this->content=$this->load->view('order/pengujian/analis/upload_parameter_analis',$toview);
	}
	/*
	public function uploadParameterPenyelia($kd_detail_order,$kd_parameter,$status_parameter='',$nm_analis='',
		$tgl_dikerjakan_analis='',$nm_penyelia='', $tgl_disetujui_penyelia='',$komentar_penyelia='',$file_lkparameter=''){
		
		$this->errormsg="";		
		$dat=$this->mOrder->getParameterPerItem($kd_detail_order,$kd_parameter,false);

		if(trim($this->input->post('nm_analis'))) 
			$toview['nm_analis']=trim($this->input->post('nm_analis')); 
		else $toview['nm_analis']='';

		if($this->input->post('submit')){
		  //echo "<script>alert(' input submit oke')</script>";			
		   if(trim($this->input->post('tgl_disetujui_penyelia'))!='0000-00-00'){
			$toview['kd_detail_order']=$kd_detail_order;
			$toview['kd_parameter']=$kd_parameter;			
			$toview['status_parameter']=trim($this->input->post('status_parameter'));
			$toview['tgl_disetujui_penyelia']=trim($this->input->post('tgl_disetujui_penyelia'));
			$toview['komentar_penyelia']=trim($this->input->post('komentar_penyelia'));
		
			$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"save lembar kerja parameter :".$dat->nama_parameter." status : ".$toview['status_parameter']);
			$res=$this->mOrder->saveStatusParameter($toview,$kd_detail_order,$kd_parameter,false,false);
			redirect('order/acc_sukses');
			//echo "<script>alert('File Berhasil disimpan')</script>";
			$toview['kd_detail_order']='';
		    }else{
			echo "<script>alert('tanggal Disetujui belum)</script>";
		    }
		}
		if($kd_parameter) $toview['kd_parameter']=$kd_parameter;
		if($kd_detail_order) $toview['kd_detail_order']=$kd_detail_order;
		$toview['komentar_penyelia']=$dat->komentar_penyelia;

		#judul
		$this->judul='Parameter<br>'.$dat->nama_parameter;
		$detail=$this->mOrder->getDetail($kd_detail_order,false,'');
		$this->no_pengujian = $detail->no_pengujian;
		#javascript
		$this->javascript='
		<script type="text/javascript">	

		$("#tgl_dikerjakan_analis").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 
			showOn: "both"
		});
		$("#tgl_disetujui_penyelia").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 
			showOn: "both"
		});
		</script>
		';
		
		#load view
		$this->content=$this->load->view('order/pengujian/penyelia/upload_parameter_penyelia',$toview);
	}
	*//*
	public function uploadParameterPenyelia($kd_detail_order,$kd_parameter,$status_parameter='',$nm_analis='',
		$tgl_dikerjakan_analis='',$nm_penyelia='', $tgl_disetujui_penyelia='',$komentar_penyelia='',$file_lkparameter=''){
		
		$this->errormsg="";		
		$dat=$this->mOrder->getParameterPerItem($kd_detail_order,$kd_parameter,false);

		if(trim($this->input->post('nm_analis'))) 
			$toview['nm_analis']=trim($this->input->post('nm_analis')); 
		else $toview['nm_analis']='';

		if($this->input->post('submit')){
		  //echo "<script>alert(' input submit oke')</script>";	
		  $toview['kd_detail_order']=$kd_detail_order;
		  $toview['kd_parameter']=$kd_parameter;			
		  $toview['status_parameter']=trim($this->input->post('status_parameter'));
		  $toview['tgl_dikerjakan_analis']=trim($this->input->post('tgl_dikerjakan_analis'));
		  $toview['tgl_disetujui_penyelia']=trim($this->input->post('tgl_disetujui_penyelia'));
		  $toview['komentar_penyelia']=trim($this->input->post('komentar_penyelia'));		
		  if(trim($this->input->post('tgl_dikerjakan_analis'))!='0000-00-00' || 
                       trim($this->input->post('tgl_disetujui_penyelia'))!='0000-00-00'){
			//tambahan baru

			//if($this->errormsg=="") { 
			//if($this->session->userdata('profil')->groupname != 'analis'){
				echo "<script>alert('File Berhasil disimpan')</script>";
				$file_dir='./download/lkparameter/'.date('Y-m').'/';
				if(!file_exists($file_dir)) {
						mkdir($file_dir);
				}else {
						//echo "<script>alert('Ok.file direktori sudah ada')</script>";
						$file_dir =$file_dir;
				}
				$syxupload['upload_path'] = $file_dir;
				$syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
				$syxupload['max_size']	= '3500';
				$syxupload['overwrite'] = 'TRUE'; 
				$syxupload['max_width']  = '1024';
				$syxupload['max_height']  = '768';
	

				$this->load->library('upload',$syxupload);
				if (!$this->upload->do_upload()){
					$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
					echo "<script>alert('$this->errormsg')</script>";
					//echo "<script>alert('Save tanpa upload File')</script>";
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"save lembar kerja parameter :".$dat->nama_parameter." status : ".
								$toview['status_parameter']);
					$res=$this->mOrder->saveStatusParameter($toview,
					$kd_detail_order,$kd_parameter,false,false);
					redirect('order/upload_sukses_nonfile');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_detail_order']='';
				}else{
					//echo "<script>alert('Save dengan upload File')</script>";
					$data = array('upload_data' => $this->upload->data());
					$toview['file_lkparameter']=$file_dir.$data['upload_data']['file_name'];
					$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"save lembar kerja parameter :".$dat->nama_parameter." status : ".
								$toview['status_parameter']);
					$res=$this->mOrder->saveStatusParameter($toview,
					$kd_detail_order,$kd_parameter,false,false);
					redirect('order/upload_sukses');
					//echo "<script>alert('File Berhasil disimpan')</script>";
					$toview['kd_detail_order']='';
				}

			//}
			//} else{
					

			//}
		        
			//$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			//current_url(),"save lembar kerja parameter :".$dat->nama_parameter." status : ".$toview['status_parameter']);
			//$res=$this->mOrder->saveStatusParameter($toview,$kd_detail_order,$kd_parameter,false,false);
			//redirect('order/acc_sukses');
			//echo "<script>alert('File Berhasil disimpan')</script>";
			//$toview['kd_detail_order']='';
		    }else{
			echo "<script>alert('tanggal Disetujui belum)</script>";
		    }
		}
		if($kd_parameter) $toview['kd_parameter']=$kd_parameter;
		if($kd_detail_order) $toview['kd_detail_order']=$kd_detail_order;
		$toview['komentar_penyelia']=$dat->komentar_penyelia;

		#judul
		$this->judul='Parameter<br>'.$dat->nama_parameter;

		$detail=$this->mOrder->getDetail($kd_detail_order,false,'');
		$this->no_pengujian = $detail->no_pengujian;
		#javascript
		$this->javascript='

		<script type="text/javascript">	

		$("#tgl_dikerjakan_analis").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 

			showOn: "both"
		});
		$("#tgl_disetujui_penyelia").datepicker({ 
			appendText: "(format: yyyy-mm-dd)",								 

			showOn: "both"
		});
		</script>
		';
		

		#load view
		$this->content=$this->load->view('order/pengujian/penyelia/upload_parameter_penyelia',$toview);

	}

        public function viewParameter($kd_detail_order,$kd_parameter){
		$this->errormsg="";
		$dat=$this->mOrder->getParameterPerItem($kd_detail_order,$kd_parameter,false);
		if(trim($this->input->post('nm_analis'))) 
			$toview['nm_analis']=trim($this->input->post('nm_analis')); 
		else $toview['nm_analis']='';

		
		if($kd_parameter) $toview['kd_parameter']=$kd_parameter;
		if($kd_detail_order) $toview['kd_detail_order']=$kd_detail_order;
		
		$toview['tgl_cetak']=date("Y-m-d");
		#judul
		$this->judul='Parameter<br>'.$dat->nama_parameter;
		$detail=$this->mOrder->getDetail($kd_detail_order,false,'');
		$this->no_pengujian = $detail->no_pengujian;
		#javascript
		
		#load view
		$this->content=$this->load->view('order/pengujian/view_order_parameter',$toview);
	}

	public function input_analis_parameter($kd_detail_order,$kd_parameter,$nip_analis='',
		$nm_analis='',$nip_penyelia='',$nm_penyelia=''){
			$this->errormsg="";
		if($this->input->post('save')){
		 
			 //$toview['kd_order']=$kd_order;
			 $toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
			 $toview['kd_parameter']=trim($this->input->post('kd_parameter'));
			 $hasil = preg_split('/[|]/', trim($this->input->post('nip_analis'))); 			 
			 
			 $toview['nip_analis']=trim($hasil[0]);
			 $dat=$this->mUser->getDetail(trim($hasil[0])); 
			 $toview['nip_baru_analis']=$dat->nip_baru;
			 $toview['nm_analis']=$hasil[1];

			 $toview['nip_penyelia']=trim($this->input->post('nip_penyelia'));
			 $dat1=$this->mUser->getDetail($this->input->post('nip_penyelia')); 			

			 $toview['nip_baru_penyelia']= $dat1->nip_baru;
			 $toview['nm_penyelia']=trim($this->input->post('nm_penyelia'));
			 $this->mOrder->saveAnalisParameter($toview,$kd_parameter,$kd_detail_order,true,false); 
			 redirect('order/update_sukses');
			// echo "<script>alert('File Berhasil disimpan')</script>";			
		}
		$dat=$this->mOrder->getParameterPerItem($kd_detail_order,$kd_parameter,false);
		if($dat) {
			$toview['kd_detail_order']=$dat->kd_detail_order;
			$toview['kd_parameter']=$dat->kd_parameter;
			$toview['nip_analis']=$dat->nip_analis;
			$toview['nip_baru_analis']=$dat->nip_baru_analis;
			$toview['nm_analis']=$dat->nm_analis;
			$toview['nip_penyelia']=$dat->nip_penyelia;
			$toview['nip_baru_penyelia']=$dat->nip_baru_penyelia;
			$toview['nm_penyelia']=$dat->nm_penyelia;				
			//echo "<script>alert('Berhasil tampil')</script>";
		}else {
			$toview['nip_analis']='';
			$toview['nip_baru_analis']='';
			$toview['nm_analis']='';
			$toview['nip_penyelia']='';
			$toview['nip_baru_penyelia']='';
			$toview['nm_penyelia']='';
		}		
				
		
		#judul
		$this->judul='<center>Parameter &nbsp;'.$dat->nama_parameter."</center>";
		#javascript
		
		#load view
		$this->content=$this->load->view('order/pengujian/penyelia/upload_nmanalis',$toview);
	}
	public function cetak($url=''){
		if($url){
			$this->session->set_flashdata('cetak',1);
			redirect(base64_decode($url));
		}
	}

	public function excels($url='',$filename=''){
		if($url){
			$this->session->set_flashdata('xls',1);
			$this->session->set_flashdata('namafile',$filename);
			redirect(base64_decode($url));
		}
	}

	public function comments(){
		echo 'Look at this!';
	}
	
	

	
	function inputSamplingReport($kd_order){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		#return url
		if($this->session->userdata('profil')->groupname=='super'){
			if(!$this->session->userdata('returnurl')){$this->session->set_userdata('returnurl','customer');}
			elseif(!preg_match("|^order/index/.*$|",$this->session->userdata('returnurl'))){
			$this->session->set_userdata('returnurl','customer');}
		} else {
				$this->session->set_userdata('returnurl',$this->session->userdata('profil')->groupname);
		}
		
		#set return url
		$toview['pageurl']='order';
		$this->session->set_userdata('returnurl',$toview['pageurl']);
			
		$this->form_validation->set_rules('nama_pengambil_sampling', 'nama_pengambil_sampling', 'required');
		$this->form_validation->set_rules('no_sampling', 'No Sampling Report', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');
			
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			
		if($this->input->post('save')){
		    echo "<script>alert('Ok.save')</script>";
		     if($this->form_validation->run())
		     {
			$toview['no_sampling']=trim($this->input->post('no_sampling'));
			$toview['nama_pengambil_sampling']=trim($this->input->post('nama_pengambil_sampling'));
			$toview['surat_tugas_sampling']=trim($this->input->post('surat_tugas_sampling'));
			$toview['tgl_sampling']=trim($this->input->post('tgl_sampling'));
			$toview['tgl_selesai_sampling']=trim($this->input->post('tgl_selesai_sampling'));
			$toview['saksi_sampling']=trim($this->input->post('saksi_sampling'));
			$toview['jabatan_saksi_sampling']=trim($this->input->post('jabatan_saksi_sampling'));
			$toview['no_order']=trim($this->input->post('no_order'));
			$toview['kd_order']=trim($this->input->post('kd_order'));
			$toview['kd_satker']=trim($this->input->post('kd_satker'));
			$toview['nama_komoditi']=trim($this->input->post('nama_komoditi'));
			$toview['standar_sampling']=trim($this->input->post('standar_sampling'));
			$toview['tipe_komoditi']=trim($this->input->post('tipe_komoditi'));
			$toview['brand_komoditi']=trim($this->input->post('brand_komoditi'));  
			$toview['nama_perusahaan']=trim($this->input->post('nama_perusahaan')); 
			$toview['alamat_perusahaan']=trim($this->input->post('alamat_perusahaan'));
			$toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
			$toview['label_nokode_sampling']=trim($this->input->post('label_nokode_sampling'));
			$toview['jumlah_sampling']=trim($this->input->post('jumlah_sampling'));
			$toview['kapasitas_produksi']=trim($this->input->post('kapasitas_produksi'));
			$toview['tgl_serial_produk']=trim($this->input->post('tgl_serial_produk'));
			$toview['metode_sampling']=trim($this->input->post('metode_sampling'));
			$toview['tgl_create']=date("Y-m-d H:i:s");;
					
			if($this->errormsg=="") { 
			    $toview['kd_sampling']=$this->mOrder->Make_kd_sampling();
			    $hasil = $this->mOrder->SaveSamplingReport($toview,'','',false);
			    echo "<script>alert(".$toview['kd_sampling'].")</script>";
			    if($hasil){
				$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
				current_url(),"Simpan Sampling report No. ".$toview['kd_sampling']."no Order ".$toview['no_order']);
				$this->errormsg='<em style="color:green"><a href="index.php/order/view/'.$toview['kd_sampling'].'">'.
				$toview['no_order'].'</a> Berhasil disimpan!</em>';
				redirect('order/view/'.$toview['kd_order']);
			    }else{
                                                
				$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
				current_url(),"Simpan Sampling report No. ".$toview['kd_sampling']."no Order ".$toview['no_order']);
				$this->errormsg='<em style="color:green"><a href="index.php/order/view/'.$toview['kd_sampling'].'">'.
				$toview['no_order'].'</a> gagal!</em>';
			    }
			}
		      }
		}


		$order = $this->mOrder->getOrder($kd_order,false);
		$customer = $this->mCustomer->GetResult(trim($order->nama_customer_tujuan),'','','','','nama','30','desc','');
		foreach($customer as $row){
			$toview['alamat_pabrik']=$row->alamat_pabrik;
		}

		#judul 
		$this->judul='Input Report Sampling No. Order: '.$order->no_order;

		$toview['kd_sampling']='';
		$toview['no_sampling']='';
		$toview['nama_pengambil_sampling']='';
		$toview['surat_tugas_sampling']='';
		$toview['tgl_sampling']='';
		$toview['tgl_selesai_sampling']='';
		$toview['saksi_sampling']='';
		$toview['jabatan_saksi_sampling']='';
		$toview['no_order']=$order->no_order;
		$toview['kd_order']=$order->kd_order;
		$toview['kd_satker']=$order->kd_satker;
		$toview['nama_komoditi']='';
		$toview['standar_sampling']='';
		$toview['tipe_komoditi']='';  
		$toview['brand_komoditi']='';    
		$toview['nama_perusahaan']=$order->nama_customer_tujuan;  
		$toview['alamat_perusahaan']=$order->alamat_customer_tujuan ;
		//$toview['alamat_pabrik']=$customer->alamat_pabrik;
		$toview['label_nokode_sampling']='';
		$toview['jumlah_sampling']='';
		$toview['kapasitas_produksi']='';
		$toview['tgl_serial_produk']='';
		$toview['metode_sampling']='';

		#javascript
		$this->javascript='
			<script type="text/javascript">
		
			$("#tgl_sampling").datepicker({
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			$("#tgl_selesai_sampling").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});

			
			</script>';
		
			
		#load view
		
		$this->load->view('order/pengujian/penerima/sampling_report_add',$toview);
		
	}

	function editSamplingReport($kd_order){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		#return url
		if($this->session->userdata('profil')->groupname=='super'){
			if(!$this->session->userdata('returnurl')){$this->session->set_userdata('returnurl','customer');}
			elseif(!preg_match("|^order/index/.*$|",$this->session->userdata('returnurl'))){
			$this->session->set_userdata('returnurl','customer');}
		} else {
				$this->session->set_userdata('returnurl',$this->session->userdata('profil')->groupname);
		}
		
		$order = $this->mOrder->getSamplingReportDetail('',$kd_order);

		#set return url
		$toview['pageurl']='order';
		$this->session->set_userdata('returnurl',$toview['pageurl']);
			
		$this->form_validation->set_rules('nama_pengambil_sampling', 'nama_pengambil_sampling', 'required');
		$this->form_validation->set_rules('no_sampling', 'No Sampling Report', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');
			
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			
		if($this->input->post('save')){
		    echo "<script>alert('Ok.save')</script>";
		     if($this->form_validation->run())
		     {
			$toview['kd_sampling']=$order->kd_sampling;
			$toview['no_sampling']=trim($this->input->post('no_sampling'));
			$toview['nama_pengambil_sampling']=trim($this->input->post('nama_pengambil_sampling'));
			$toview['surat_tugas_sampling']=trim($this->input->post('surat_tugas_sampling'));
			$toview['tgl_sampling']=trim($this->input->post('tgl_sampling'));
			$toview['tgl_selesai_sampling']=trim($this->input->post('tgl_selesai_sampling'));
			$toview['saksi_sampling']=trim($this->input->post('saksi_sampling'));
			$toview['jabatan_saksi_sampling']=trim($this->input->post('jabatan_saksi_sampling'));
			$toview['no_order']=trim($this->input->post('no_order'));
			$toview['kd_order']=trim($this->input->post('kd_order'));
			$toview['kd_satker']=trim($this->input->post('kd_satker'));
			$toview['nama_komoditi']=trim($this->input->post('nama_komoditi'));
			$toview['standar_sampling']=trim($this->input->post('standar_sampling'));
			$toview['tipe_komoditi']=trim($this->input->post('tipe_komoditi'));
			$toview['brand_komoditi']=trim($this->input->post('brand_komoditi'));  
			$toview['nama_perusahaan']=trim($this->input->post('nama_perusahaan')); 
			$toview['alamat_perusahaan']=trim($this->input->post('alamat_perusahaan'));
			$toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
			$toview['label_nokode_sampling']=trim($this->input->post('label_nokode_sampling'));
			$toview['jumlah_sampling']=trim($this->input->post('jumlah_sampling'));
			$toview['kapasitas_produksi']=trim($this->input->post('kapasitas_produksi'));
			$toview['tgl_serial_produk']=trim($this->input->post('tgl_serial_produk'));
			$toview['metode_sampling']=trim($this->input->post('metode_sampling'));
			$toview['tgl_create']=date("Y-m-d H:i:s");;
					
			if($this->errormsg=="") { 
			    
			    $hasil = $this->mOrder->SaveSamplingReport($toview,$toview['kd_sampling'],'',true);
			    echo "<script>alert(".$toview['kd_sampling'].")</script>";
			    if($hasil){
				$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
				current_url(),"Simpan Sampling report No. ".$toview['kd_sampling']."no Order ".$toview['no_order']);
				$this->errormsg='<em style="color:green"><a href="index.php/order/view/'.$toview['kd_sampling'].'">'.
				$toview['no_order'].'</a> Berhasil Update!</em>';
				redirect('order/view/'.$toview['kd_order']);
			    }else{
                                                
				$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
				current_url(),"Update Sampling report No. ".$toview['kd_sampling']."no Order ".$toview['no_order']);
				$this->errormsg='<em style="color:green"><a href="index.php/order/view/'.$toview['kd_sampling'].'">'.
				$toview['no_order'].'</a> gagal!</em>';
			    }
			}
		      }
		}

		
		#judul 
		$this->judul='Edit Report Sampling No. Order : '.$order->no_order;

		$toview['kd_sampling']=$order->kd_sampling;
		$toview['no_sampling']=$order->no_sampling;
		$toview['nama_pengambil_sampling']=$order->nama_pengambil_sampling;
		$toview['surat_tugas_sampling']=$order->surat_tugas_sampling;
		$toview['tgl_sampling']=$order->tgl_sampling;
		$toview['tgl_selesai_sampling']=$order->tgl_selesai_sampling;
		$toview['saksi_sampling']=$order->saksi_sampling;
		$toview['jabatan_saksi_sampling']=$order->jabatan_saksi_sampling;
		$toview['no_order']=$order->no_order;
		$toview['kd_order']=$order->kd_order;
		$toview['kd_satker']=$order->kd_satker;
		$toview['nama_komoditi']=$order->nama_komoditi;
		$toview['standar_sampling']=$order->standar_sampling;
		$toview['tipe_komoditi']=$order->tipe_komoditi;  
		$toview['brand_komoditi']=$order->brand_komoditi;    
		$toview['nama_perusahaan']=$order->nama_perusahaan;  
		$toview['alamat_perusahaan']=$order->alamat_perusahaan ;
		$toview['alamat_pabrik']=$order->alamat_pabrik;
		$toview['label_nokode_sampling']=$order->label_nokode_sampling;
		$toview['jumlah_sampling']=$order->jumlah_sampling;
		$toview['kapasitas_produksi']=$order->kapasitas_produksi;
		$toview['tgl_serial_produk']=$order->tgl_serial_produk;
		$toview['metode_sampling']=$order->metode_sampling;

		#javascript
		$this->javascript='
			<script type="text/javascript">
		
			$("#tgl_sampling").datepicker({
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});
			$("#tgl_selesai_sampling").datepicker({ 
				appendText: "(format: yyyy-mm-dd)",
				showOn: "both"
			});

			
			</script>';
		
			
		#load view
		
		$this->load->view('order/pengujian/penerima/sampling_report_add',$toview);
		
	}

	function viewSamplingReport($kd_order){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		
		$order = $this->mOrder->getSamplingReportDetail('',$kd_order);
		#judul 
		$this->judul='Edit Report Sampling No. Order : '.$order->no_order;

		$toview['kd_sampling']=$order->kd_sampling;
		$toview['no_sampling']=$order->no_sampling;
		$toview['nama_pengambil_sampling']=$order->nama_pengambil_sampling;
		$toview['surat_tugas_sampling']=$order->surat_tugas_sampling;
		$toview['tgl_sampling']=$order->tgl_sampling;
		$toview['tgl_selesai_sampling']=$order->tgl_selesai_sampling;
		$toview['saksi_sampling']=$order->saksi_sampling;
		$toview['jabatan_saksi_sampling']=$order->jabatan_saksi_sampling;
		$toview['no_order']=$order->no_order;
		$toview['kd_order']=$order->kd_order;
		$toview['kd_satker']=$order->kd_satker;
		$toview['nama_komoditi']=$order->nama_komoditi;
		$toview['standar_sampling']=$order->standar_sampling;
		$toview['tipe_komoditi']=$order->tipe_komoditi;  
		$toview['brand_komoditi']=$order->brand_komoditi;    
		$toview['nama_perusahaan']=$order->nama_perusahaan;  
		$toview['alamat_perusahaan']=$order->alamat_perusahaan ;
		$toview['alamat_pabrik']=$order->alamat_pabrik;
		$toview['label_nokode_sampling']=$order->label_nokode_sampling;
		$toview['jumlah_sampling']=$order->jumlah_sampling;
		$toview['kapasitas_produksi']=$order->kapasitas_produksi;
		$toview['tgl_serial_produk']=$order->tgl_serial_produk;
		$toview['metode_sampling']=$order->metode_sampling;
	
			
		#load view
		
		$this->load->view('order/pengujian/penerima/sampling_report_view',$toview);
		
	}
	public function viewSuratTugas($kd_detail_order=''){

	     $res=$this->mOrder->getDetail($kd_detail_order,false,'');

            
	     if($res){
				$hasl = $this->mOrder->getOrder($res->kd_order,false,'');
				$toview['no_order']= $hasl->no_order;
				$toview['kd_order']= $res->kd_order;
			  $toview['kd_detail_order']= $kd_detail_order;
				$toview['no_pengujian']=$res->no_pengujian;
				$toview['jumlah_contoh']=$res->jumlah_contoh;
				$toview['tanda_contoh']=$res->tanda_contoh;
				$toview['metoda']=$res->metoda;
				$toview['nama_contoh']=$res->nama_contoh;
	     }
		

	    	$dat=$this->mOrder->getOrder($toview['kd_order']);
		//$toview['kd_order']=$dat->kd_order;
		$toview['nama_customer']=$dat->nama_customer_asal;
		$toview['harga_total']=$dat->harga_total;
		$toview['jumlah_bayar']=$dat->jumlah_bayar;
		$toview['discount']=$dat->discount;
		$toview['ppn']=$dat->ppn;
		$toview['no_order']=$dat->no_order;
		
		#get result
		
			//=$this->mOrder->GetResultDetail('',$kd_detail_order,false,'kd_detail_order','desc',30,0);
		

		#judul
		$this->judul='<center><font size=5><b><u>Surat Tugas Pengujian</u></b></font>

				<font size=2><br>No : '.$toview['no_pengujian'].'</center>';
		#load view
		
		$this->content=$this->load->view('order/pengujian/wmt/print_view_surat_tugas',$toview);
			
		
	}
	*/

}
?>