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
		      $this->load->model('mSMM');
		      $this->load->model('mStaff');
		      $this->load->model('mDokumen');
		      $this->load->model('mAuditor');
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
		$toview['email_kontak_perusahaan_pemohon']=$order->email_kontak_perusahaan_pemohon;

		/*$toview['nama_pabrik']  =$order->nama_pabrik;
		$toview['jumlah_karyawan_pabrik']  =$order->jumlah_karyawan_pabrik;
		$toview['alamat_pabrik']=$order->alamat_pabrik;
		$toview['negara_pabrik']=$order->negara_pabrik;
		$toview['kd_sertifikasi_smm']=$order->kd_sertifikasi_smm;	
				$resultsmm = $this->mOrder->getSmm($order->kd_sertifikasi_smm);
				if($resultsmm) $toview['nama_sertifikasi_smm']=$resultsmm->nama_sertifikasi_smm ;*/

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
		$toview['totkomoditi']=$this->mOrder->getTotalOrderKomoditi($toview['kd_order_sertifikasi'],'');
		if($toview['totkomoditi']>0){
			$toview['pages']=ceil($toview['totkomoditi']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultkomoditi']=$this->mOrder->getResultOrderKomoditi($toview['kd_order_sertifikasi'],'','kd_order_komoditi','desc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultkomoditi']=false;
		}

		#get result
		$toview['totpabrik']=$this->mOrder->getTotalOrderPabrik($toview['kd_order_sertifikasi'],'');
		if($toview['totpabrik']>0){
			$toview['pages']=ceil($toview['totpabrik']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultpabrik']=$this->mOrder->getResultOrderPabrik($toview['kd_order_sertifikasi'],'','kd_order_pabrik','desc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultpabrik']=false;
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
	
public function Add($perusahaan_pemohon='',$perusahaan_importir='',$kd_sertifikasi_jenis=''){
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
		$toview['email_kontak_perusahaan_pemohon']='';

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
			 $toview['email_kontak_perusahaan_pemohon']=trim($this->input->post('email_kontak_perusahaan_pemohon'));

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
					redirect('order/OrderPabrik/'.$toview['kd_order_sertifikasi']);
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
				dateFormat: "yy-mm-dd",
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

	public function edit($kd_order_sertifikasi,$perusahaan_pemohon='',$perusahaan_importir='',$kd_sertifikasi_jenis=''){
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
			 $toview['email_kontak_perusahaan_pemohon']=$order->email_kontak_perusahaan_pemohon;

			 
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

		 $toview['kd_jenis_layanan']=$order->kd_jenis_layanan;

		 $toview['kd_sertifikasi_tahapan']=$order->kd_sertifikasi_tahapan;
				$resulttahapan = $this->mOrder->getJenisTahapan($order->kd_sertifikasi_tahapan);
				if($resulttahapan) $toview['nama_sertifikasi_tahapan']=$resulttahapan->nama_sertifikasi_tahapan ;

		$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
				$resultarif = $this->mTarif->getTarif($order->kd_sertifikasi_jenistarif);
				if($resultarif) $toview['nama_jenistarif']=$resultarif->nama_jenistarif ;  

		$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
				$resuljenis = $this->mTarif->getJenis($order->kd_sertifikasi_jenis,false);
				if($resuljenis) $toview['nama_sertifikasi_jenis']=$resuljenis->nama_sertifikasi_jenis;  

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
			 $toview['nohp_kontak_perusahaan_pemohon']=trim($this->input->post('nohp_kontak_perusahaan_pemohon'));
			 $toview['email_kontak_perusahaan_pemohon']=trim($this->input->post('email_kontak_perusahaan_pemohon'));
			 

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
				dateFormat: "yy-mm-dd",
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
	
	 public function orderPabrik($kd_order_sertifikasi='',$kd_order_pabrik=''){
	    $this->errormsg=""; $counter=0;

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_order_pabrik) $toveiw['kd_order_pabrik']='';

	    
		if($kd_order_pabrik){
			 $customerne=$this->mCustomer->readCustomer($kd_order_pabrik);
			 $toview['nama_pabrik']=$customerne->nama;
			 $toview['alamat_pabrik']=$customerne->alamat;
			 $toview['telepon_pabrik']=$customerne->telepon;
			 $toview['fax_pabrik']=$customerne->fax;
			 $data = $this->mCustomer->readNegara($customerne->kd_negara);
			 $toview['negara_pabrik']=$data->negara;
			 $toview['jumlah_karyawan_pabrik']=$customerne->jml_karyawan;
			 $toview['kd_sertifikasi_smm']='';
		} else {	
			 $toview['kd_order_pabrik']='';
			 $toview['nama_pabrik']='';
			 $toview['alamat_pabrik']='';			 
			 $toview['telepon_pabrik']='';
			 $toview['fax_pabrik']='';
			 $toview['negara_pabrik']='';
			 $toview['jumlah_karyawan_pabrik']='';
			 $toview['kd_sertifikasi_smm']='';

		}
		

		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;		
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	#get result
		$toview['tot']=$this->mOrder->getTotalOrderPabrik($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mOrder->getResultOrderPabrik($toview['kd_order_sertifikasi'],'','kd_order_pabrik','desc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		
		$this->form_validation->set_rules('nama_pabrik', 'nama_pabrik', 'required');
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
					$toview['kd_order_pabrik']=$this->mOrder->Make_kd_order_pabrik();
					$toview['nama_pabrik']=$this->input->post('nama_pabrik');
					$toview['alamat_pabrik']=trim($this->input->post('alamat_pabrik'));
				   	$toview['telepon_pabrik']=trim($this->input->post('telepon_pabrik'));
					$toview['fax_pabrik']=trim($this->input->post('fax_pabrik'));
				   	$toview['negara_pabrik']=trim($this->input->post('negara_pabrik'));
				  	$toview['jumlah_karyawan_pabrik']=trim($this->input->post('jumlah_karyawan_pabrik'));
				  	$toview['kd_sertifikasi_smm']=trim($this->input->post('kd_sertifikasi_smm'));
				  	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;				  	
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderPabrik($toview,$toview['kd_order_sertifikasi'],false); 
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
		$this->judul='Order Pabrik';
		
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
			$("#nm_pabrik").autocomplete(data, {
				matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/orderPabrik/'.$kd_order_sertifikasi.'/\'  + item.url;
			});
			
		});  
		
		</script>
		';
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_add_pabrik',$toview);	
	}

	public function delOrderPabrik($kd_order_sertifikasi='',$kd_order_pabrik=''){
		$this->mOrder->deleteOrderPabrik($kd_order_sertifikasi,$kd_order_pabrik);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order pabriki . ".$kd_order_komoditi);
		redirect('order/orderPabrik/'.$kd_order_sertifikasi);
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

				    $dokumenlist=$this->input->post('dokumen');
					
					$toview['jumlah_contoh']=$this->input->post('jumlah_contoh');
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
		$this->mOrder->deleteOrderKomoditi($kd_order_sertifikasi,$kd_order_komoditi);
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
	/*
	public function kirimDataOrderStepBerikutnya($kd_order_sertifikasi,$kd_step_status='',$next_step=''){
		$dat=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi);
		$user=$this->mUser->getDetail($this->session->userdata('userid')); 

		$step_status=$this->mOrder->getSertifikasiStepStatus($kd_step_status);

		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
		$toview['noreg_order_sertifikasi']=$dat->noreg_order_sertifikasi;
		$toview['id_step_status']=$step_status->id_step_status;
		$toview['kd_step_status']=$kd_step_status;
		$toview['nama_step_status']= $step_status->nama_step_status;
		$toview['next_step']= $next_step;
		$toview['nip']=$user->nip_baru;		

		$form='<base href="'.base_url().'"><h2><center>Kirim Data Ke Step selanjutnya</center></h2>';
		if($dat->kd_order_sertifikasi<>'Closed'){
		$form.='<form action="index.php/order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'" method="post">
					<input type="hidden" name="kd_order_sertifikasi" value="'.$toview['kd_order_sertifikasi'].'" >
					<input type="hidden" name="noreg_order_sertifikasi" value="'.$toview['noreg_order_sertifikasi'].'"> 
					<input type="hidden" name="kd_step_status" value="'.$toview['kd_step_status'].'" >
					<input type="hidden" name="nama_step_status" value="'.$toview['nama_step_status'].'"> 
					<input type="hidden" name="next_step" value="'.$toview['next_step'].'">
					<input type="hidden" name="nip_penerima" value="'.$toview['nip'].'" >
					';
		$form.='<center>Pastikan Data yang akan dikirim ke Step &nbsp;'.
				$toview['id_step_status']. '.'.$toview['kd_step_status']. '&nbsp;('.$toview['nama_step_status'].')&nbsp; sudah lengkap</br></br>';
		$form.='<input type="text" name="tgl_create" value="tgl_create" ><input type="submit" name="submit" value="Kirim"></center>';
		$form.='</form>';
			
		}
		echo $form;
		
		if($this->input->post('submit')){
			$tosave['kd_order_sertifikasi']=$kd_order_sertifikasi;
			$tosave['noreg_order_sertifikasi']=trim($this->input->post('noreg_order_sertifikasi'));
			$tosave['kd_step_status']=trim($this->input->post('kd_step_status'));
			$tosave['nama_step_status']=trim($this->input->post('nama_step_status'));
			$tosave['nip']=trim($this->input->post('nip_penerima'));
			$tosave['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$tosave['tgl_create']=date("Y-m-d H:i:s");
			$res=$this->mOrder->saveOrderSertifikasiStatus($tosave,$tosave['kd_order_sertifikasi']);
			
			$tostatus['kd_order_sertifikasi']=$tosave['kd_order_sertifikasi'];
			$tostatus['status_order_sertifikasi']=$tosave['kd_step_status'];
			$res=$this->mOrder->saveOrderSertifikasi($tostatus,$tostatus['kd_order_sertifikasi'],true);
			$tosave['next_step']=trim($this->input->post('next_step'));
			redirect('order/'. $tosave['next_step'].'/'.$kd_order_sertifikasi);
		}
		
		
	}
	*/
	
	public function kirimDataOrderStepBerikutnya($kd_order_sertifikasi,$kd_step_status='',$next_step=''){
		$dat=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi);
		$user=$this->mUser->getDetail($this->session->userdata('userid')); 

		$step_status=$this->mOrder->getSertifikasiStepStatus($kd_step_status);

		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
		$toview['noreg_order_sertifikasi']=$dat->noreg_order_sertifikasi;
		$toview['id_step_status']=$step_status->id_step_status;
		$toview['kd_step_status']=$kd_step_status;
		$toview['nama_step_status']= $step_status->nama_step_status;
		$toview['next_step']= $next_step;
		$toview['nip']=$user->nip_baru;	
		$toview['tgl_create']=date("Y-m-d");//date()
		
		if($this->input->post('submit')){
			$tosave['kd_order_sertifikasi']=$kd_order_sertifikasi;
			$tosave['noreg_order_sertifikasi']=trim($this->input->post('noreg_order_sertifikasi'));
			$tosave['kd_step_status']=trim($this->input->post('kd_step_status'));
			$tosave['nama_step_status']=trim($this->input->post('nama_step_status'));
			$tosave['nip']=trim($this->input->post('nip_penerima'));
			$tosave['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$tosave['tgl_create']=trim($this->input->post('tgl_create'));
			$res=$this->mOrder->saveOrderSertifikasiStatus($tosave,$tosave['kd_order_sertifikasi']);
			
			$tostatus['kd_order_sertifikasi']=$tosave['kd_order_sertifikasi'];
			$tostatus['status_order_sertifikasi']=$tosave['kd_step_status'];
			$res=$this->mOrder->saveOrderSertifikasi($tostatus,$tostatus['kd_order_sertifikasi'],true);
			$tosave['next_step']=trim($this->input->post('next_step'));
			redirect('order/'. $tosave['next_step'].'/'.$kd_order_sertifikasi);
		}

			$this->javascript='
					<script type="text/javascript">
						$("#tgl_create").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						
					</script>';

		#load view
		$this->content=$this->load->view('order/next_step_order',$toview);
		
		
	}


	public function orderDokumen($kd_order_sertifikasi='',$kd_sertifikasi_jenis='',$kd_sertifikasi_jenistarif=''){	

	   		$this->errormsg=""; $this->listDokumen=""; $this->listDokumen1=""; $dokumen='';
           	$counter=0;
	   		//if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	   
	   		//if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
			//else redirect('order');
		
			$order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi,'');

			$toview['kd_sertifikasi_tahapan']=$order->kd_sertifikasi_tahapan;
			$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
			$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
			$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;
			//echo "test". $toview['kd_sertifikasi_jenis']."&nbsp;".$toview['kd_sertifikasi_jenistarif'];

			$order_dokumen = $this->mOrder->getOrderDokumen('',$toview['kd_order_sertifikasi']);
			//echo "test".$order_dokumen->nama_penyerah_dokumen;
			if($order_dokumen){
				$toview['kd_order_sertifikasi_dokumen']=$order_dokumen->kd_order_sertifikasi_dokumen;
				$toview['tgl_dokumen_diterima']=$order_dokumen->tgl_dokumen_diterima;
				$toview['tgl_dokumen_lengkap']=$order_dokumen->tgl_dokumen_lengkap;			
				$toview['status_order_dokumen']=$order_dokumen->status_order_dokumen;
				$toview['nama_penyerah_dokumen']=$order_dokumen->nama_penyerah_dokumen;
		 		$toview['nip_penerima_dokumen']=$order_dokumen->nip_penerima_dokumen;
		 		$toview['nama_penerima_dokumen']=$order_dokumen->nama_penerima_dokumen;
		 		$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
				$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
				$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;

			}else{

				$toview['tgl_dokumen_diterima']='';
				$toview['tgl_dokumen_lengkap']='';			
				$toview['status_order_dokumen']='';
				$toview['nama_penyerah_dokumen']='';
		 		$toview['nip_penerima_dokumen']='';
		 		$toview['nama_penerima_dokumen']='';
		 	}

		 	if($order_dokumen)
		 		$dokumen = $this->mOrder->getOrderDokumenList('',$order_dokumen->kd_order_sertifikasi_dokumen,'');


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
	   		
	   		$kd_sertifikasi_jenistarif= $order->kd_sertifikasi_jenistarif;
	   		$kd_sertifikasi_jenis= $order->kd_sertifikasi_jenis;
	   		

	   		$resultdok= $this->mDokumen->getDokumen('',$kd_sertifikasi_jenistarif ,true);
	   				//echo count($result2);
			if($resultdok){
				if ($kd_sertifikasi_jenis=='bpkimi14-jns-2' && $kd_sertifikasi_jenistarif=='bpkimi14-jnt-4'){ 
			  		$this->listDokumen='<ol><p>&nbsp;</p><b>Importir</b>';
			      	foreach($resultdok as $row){
			      		if($row->jenis_dokumen=='Importir'){
			      			$ceklist="";$cek="";$visible="hidden";$jumuji=1;
			      			    if($dokumen){
									foreach($dokumen as $orderdoklist){
										if($row->kd_sertifikasi_dokumen==$orderdoklist->kd_sertifikasi_dokumen) {
											$ceklist="checked";																				
										}
										$this->listDokumen.='<input type="hidden" name="edit" value="1" id="edit" ">';
									}
			      				}

							$this->listDokumen.='<li>
								<input type="checkbox" name="dokumen['.$counter.']" '.$ceklist.' id="dokumen-'.$counter.'" 
								value="'.$row->kd_sertifikasi_dokumen.'">&nbsp;'.ucfirst($row->nama_sertifikasi_dokumen).';
											
								</li>';
								$counter++;
						}
						
					}

					$this->listDokumen.='</ol>';
					
					$this->listDokumen1='<ol><p>&nbsp;</p><b>Manufaktur</b>';


			      	foreach($resultdok as $row){
			      		if($row->jenis_dokumen=='Manufaktur'){
			      			$ceklist="";$cek="";$visible="hidden";$jumuji=1;
			      			    if($dokumen){
									foreach($dokumen as $orderdoklist){
										if($row->kd_sertifikasi_dokumen==$orderdoklist->kd_sertifikasi_dokumen) {
											$ceklist="checked";																				
										}
										$this->listDokumen1.='<input type="hidden" name="edit" value="1" id="edit" ">';
									}
			      				}

							$this->listDokumen1.='
							<li>
								<input type="checkbox" name="dokumen['.$counter.']" '.$ceklist.' id="dokumen-'.$counter.'" 
								value="'.$row->kd_sertifikasi_dokumen.'">&nbsp;'.ucfirst($row->nama_sertifikasi_dokumen).';
											
								</li>';
								$counter++;
						}
					}
					

					$this->listDokumen1.='</ol>
							<input type="checkbox" name="cekAllDokumen" value="1" id="cekAllDokumen" 
							onchange="CheckItAll()">&nbsp;Check All';


					
				}else {
					$this->listDokumen='<ol>';
			      	foreach($resultdok as $row){

			      			$ceklist="";$cek="";$visible="hidden";$jumuji=1;
			      			    if($dokumen){
									foreach($dokumen as $orderdoklist){
										if($row->kd_sertifikasi_dokumen==$orderdoklist->kd_sertifikasi_dokumen) {
											$ceklist="checked";																				
										}
										$this->listDokumen.='<input type="hidden" name="edit" value="1" id="edit" ">';
									}
			      				}
							$this->listDokumen.='
								<li>
								<input type="checkbox" name="dokumen['.$counter.']" '.$ceklist.' id="dokumen-'.$counter.'" 
								value="'.$row->kd_sertifikasi_dokumen.'">&nbsp;'.ucfirst($row->nama_sertifikasi_dokumen).';
											
								</li>';
								$counter++;
					}
					$this->listDokumen.='</ol>
							<input type="checkbox" name="cekAllDokumen" value="1" id="cekAllDokumen" 
							onchange="CheckItAll()">&nbsp;Check All';

				}
			}
	  		



		 	
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
			
			$this->form_validation->set_rules('tgl_dokumen_diterima', 'Tanggal Dokumen Diterima', 'required');
			$this->form_validation->set_rules('tgl_dokumen_lengkap', 'Tanggal Dokumen Lengkap', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');		
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			//echo "<script>alert('test input edit = '".trim($this->input->post('edit')).")</script>";
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
									$dokumenlist=$this->input->post('dokumen');
									$toview['tgl_dokumen_diterima']=$this->input->post('tgl_dokumen_diterima');
				   					$toview['tgl_dokumen_lengkap']=trim($this->input->post('tgl_dokumen_lengkap'));
				   					$toview['status_order_dokumen']=trim($this->input->post('status_order_dokumen'));
				  					$toview['nip_penerima_dokumen']=trim($this->input->post('nip_penerima_dokumen'));
				  					$toview['nama_penyerah_dokumen']=trim($this->input->post('nama_penyerah_dokumen'));
				   					$toview['nama_penerima_dokumen']=trim($this->input->post('nama_penerima_dokumen'));
				   					$toview['kd_order_sertifikasi']=trim($this->input->post('kd_order_sertifikasi'));
				  					$toview['kd_sertifikasi_jenistarif']=trim($this->input->post('kd_sertifikasi_jenistarif'));
				   					$toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));


									$toview['kd_order_sertifikasi_dokumen']=$this->mOrder->Make_kd_order_sertifikasi_dokumen();									
									//echo "<script>alert('dokumenlist yang dipilih true')</script>";
 									if($dokumenlist){
 										//echo "<script>alert('dokumenlist yang dipilih true')</script>";
										$hasil=$this->mOrder->saveOrderDokumen($toview,'',$dokumenlist,false); 									

									}else{
										//echo "<script>alert('dokumenlist Belum ada yang dipilih')</script>";
									}
									
									if($hasil) { 
										//echo "<script>alert('hasil  true')</script>";
										/*$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
										current_url(),"Detail Order Baru Sementara");
										$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
										//echo "<script>alert('Berhasil disimpan')</script>";*/
										redirect('order/orderDokumen/'.$toview['kd_order_sertifikasi']);
									} else { 
										$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
										//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
										redirect(current_url());
									}
								}else{
									//echo "<script>alert('".$this->errormsg."')</script>";
								}
				
			  			}else if($this->input->post('edit')){
							//echo "<script>alert('test edit')</script>";
							if($this->errormsg=="") { 
				       				//echo "<script>alert('test no error message true')</script>";	
									$dokumenlist=$this->input->post('dokumen');
									$toview['tgl_dokumen_diterima']=$this->input->post('tgl_dokumen_diterima');
				   					$toview['tgl_dokumen_lengkap']=trim($this->input->post('tgl_dokumen_lengkap'));
				   					$toview['status_order_dokumen']=trim($this->input->post('status_order_dokumen'));
				  					$toview['nip_penerima_dokumen']=trim($this->input->post('nip_penerima_dokumen'));
				  					$toview['nama_penyerah_dokumen']=trim($this->input->post('nama_penyerah_dokumen'));
				   					$toview['nama_penerima_dokumen']=trim($this->input->post('nama_penerima_dokumen'));
				   					$toview['kd_order_sertifikasi']=trim($this->input->post('kd_order_sertifikasi'));
				  					$toview['kd_sertifikasi_jenistarif']=trim($this->input->post('kd_sertifikasi_jenistarif'));
				   					$toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));
									//$toview['kd_order_sertifikasi_dokumen']=$this->mOrder->Make_kd_order_sertifikasi_dokumen();
									
									//echo "<script>alert('dokumenlist yang dipilih true')</script>";
 									if($dokumenlist){
 										//echo "<script>alert('dokumenlist yang dipilih true')</script>";										
											//echo "<script>alert('dokumenlist edit')</script>";
											$hasil=$this->mOrder->saveOrderDokumen($toview,'',$dokumenlist,true); 									

									}else{
										//echo "<script>alert('dokumenlist Belum ada yang dipilih')</script>";
									}
									
									if($hasil) { 
										/*$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
										current_url(),"Detail Order Baru Sementara");
										$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
										//echo "<script>alert('Berhasil disimpan')</script>";*/
										redirect('order/orderDokumen/'.$toview['kd_order_sertifikasi']);
									} else { 
										$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
										//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
										redirect(current_url());
									}
								}else{
									//echo "<script>alert('".$this->errormsg."')</script>";
								}
			 			}
		  			}
			}else{

				//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>";
			}
		
			#judul
			$this->judul='List Order Dokumen';
			$this->javascript='
					<script type="text/javascript">
						$("#tgl_dokumen_diterima").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});

						$("#tgl_dokumen_lengkap").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						function CheckItAll(){
							for(i=0;i<'.$counter.';i++){
								document.getElementById(\'dokumen-\' + i).checked=document.getElementById(\'cekAllDokumen\').checked;
							}
						}
					</script>';
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_dokumen',$toview);	
	}

	public function viewOrderDokumen($kd_order_sertifikasi){
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

		


		$order_dokumen = $this->mOrder->getOrderDokumen('',$toview['kd_order_sertifikasi']);			
		$toview['kd_order_sertifikasi_dokumen']=$order_dokumen->kd_order_sertifikasi_dokumen;
		$toview['tgl_dokumen_diterima']=$order_dokumen->tgl_dokumen_diterima;
		$toview['tgl_dokumen_lengkap']=$order_dokumen->tgl_dokumen_lengkap;			
		$toview['status_order_dokumen']=$order_dokumen->status_order_dokumen;
		$toview['nama_penyerah_dokumen']=$order_dokumen->nama_penyerah_dokumen;
		$toview['nip_penerima_dokumen']=$order_dokumen->nip_penerima_dokumen;
		$toview['nama_penerima_dokumen']=$order_dokumen->nama_penerima_dokumen;
		$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
		$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
		$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;

		
		
		#get result order komoditi
		 #get result
		$toview['tot1']=$this->mOrder->getTotalOrderKomoditi($toview['kd_order_sertifikasi'],'');
		if($toview['tot1']>0){
			$toview['pages']=ceil($toview['tot1']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultOrderKomoditi']=$this->mOrder->getResultOrderKomoditi($toview['kd_order_sertifikasi'],'','kd_order_komoditi','desc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultOrderKomoditi']=false;
		}

		#get result
		$toview['totpabrik']=$this->mOrder->getTotalOrderPabrik($toview['kd_order_sertifikasi'],'');
		if($toview['totpabrik']>0){
			$toview['pages']=ceil($toview['totpabrik']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultpabrik']=$this->mOrder->getResultOrderPabrik($toview['kd_order_sertifikasi'],'','kd_order_pabrik','desc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultpabrik']=false;
		}


		#get result Dokumen list
		$toview['tot2']=$this->mOrder->getTotalOrderDokumenList($toview['kd_order_sertifikasi'],'');
		if($toview['tot2']>0){
			$toview['pages']=ceil($toview['tot2']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultOrderDokumenList']=$this->mOrder->getResultOrderDokumenList($toview['kd_order_sertifikasi'],'','kd_order_sertifikasi_dokumen','desc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultOrderDokumenList']=false;
		}


		
		#judul
		$this->judul='View Order';
		#load view
		if($this->session->flashdata('cetak')){
			$this->content=$this->load->view('cetak/print_view_order_dokumen',$toview);
		} else {
			$this->content=$this->load->view('order/sertifikasi/view_order_dokumen',$toview);
		}
	}
	

	public function orderSertifikasiStatus($kd_order_sertifikasi){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi; else redirect('order');
		$order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi);	
		$toview['status_order_sertifikasi'] = $order->status_order_sertifikasi;

		$historis_status_wo=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);		

		$toview['rincian_historis']='';		
		$toview['rincian_historis'] .="<table border=\"1\">";
		$toview['rincian_historis'] .="<tr>
				<td class=\"c-table-x\">No</td>
				<td class=\"c-table-x\">Tanggal</td>
				<td class=\"c-table-x\">Status Order</td>			
				<td class=\"c-table-x\">Deskripsi</td>
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
				<td class=\"c-clas-text-1\">".date("d-m-Y",strtotime($row->tgl_create))."</td>
				<td class=\"c-clas-text-1\">".$row->kd_step_status."</td>
				<td class=\"c-clas-text-1\">".$row->nama_step_status."</td>	
				<td class=\"c-clas-text-1\">".$user->groupdesc." (".$row->nip.")</td>
				</tr>";	
			}
		}
		$toview['rincian_historis'] .="</table>";

		
		
		#judul
		$this->judul='View Rincian Status Order<br>"'.$order->noreg_order_sertifikasi.'"';
		#load view
		$this->content=$this->load->view('order/sertifikasi/view_order_sertifikasi_status',$toview);
	}

public function orderPenawaran($kd_order_sertifikasi='',$kd_penawaran='',$kd_sertifikasi_jenis='',$kd_sertifikasi_jenistarif=''){	

	   		$this->errormsg=""; $this->listTarifItem=""; $penawaran='';
           	$counter=0;
		
			$order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi,'');

			$toview['kd_sertifikasi_tahapan']=$order->kd_sertifikasi_tahapan;
			$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
			$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
			$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;
			//echo "test". $toview['kd_sertifikasi_jenis']."&nbsp;".$toview['kd_sertifikasi_jenistarif'];

			$tahapan = $this->mOrder->getJenisTahapan($toview['kd_sertifikasi_tahapan']);
			$toview['nama_sertifikasi_tahapan']=$tahapan->nama_sertifikasi_tahapan;

			
			//echo "test".$order_dokumen->nama_penyerah_dokumen;
			if($kd_penawaran){
				$order_penawaran = $this->mOrder->getOrderPenawaran($kd_penawaran,'');
				$toview['kd_penawaran']=$order_penawaran->kd_penawaran;
				$toview['no_penawaran']=$order_penawaran->no_penawaran;
				$toview['no_surat_permohonan']=$order_penawaran->no_surat_permohonan;
				$toview['tgl_surat_permohonan']=$order_penawaran->tgl_surat_permohonan;
				$toview['tgl_penawaran']=$order_penawaran->tgl_penawaran;
				$toview['perihal_penawaran']=$order_penawaran->perihal_penawaran;
				$toview['jumlah_lampiran_penawaran']=$order_penawaran->jumlah_lampiran_penawaran;	
				$toview['isi_surat_penawaran']=$order_penawaran->isi_surat_penawaran;		
				$toview['harga_total_penawaran']=$order_penawaran->harga_total_penawaran;
				$toview['nip_pembuat_penawaran']=$order_penawaran->nip_pembuat_penawaran;
				$toview['nama_pembuat_penawaran']=$order_penawaran->nama_pembuat_penawaran;
		 		$toview['nip_penandatangan_penawaran']=$order_penawaran->nip_penandatangan_penawaran;
		 		$toview['nama_penandatangan_penawaran']=$order_penawaran->nama_penandatangan_penawaran;
		 		$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
				$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
				$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;
				$toview['kd_satker']=$order->kd_satker;

			}else{

				$toview['kd_penawaran']='';
				$toview['no_penawaran']='';
				$toview['no_surat_permohonan']='';
				$toview['tgl_surat_permohonan']='';
				$toview['tgl_penawaran']='';
				$toview['perihal_penawaran']='';
				$toview['jumlah_lampiran_penawaran']='';
				$toview['harga_total_penawaran']='';
				$toview['nip_pembuat_penawaran']='';
				$toview['nama_pembuat_penawaran']='';
		 		$toview['nip_penandatangan_penawaran']='';
		 		$toview['nama_penandatangan_penawaran']='';
		 		$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
				$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
				$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;
				$toview['kd_satker']=$order->kd_satker;
		 	}

		 	/*if($kd_penawaran)
		 		$penawaran = $this->mOrder->getOrderPenawaranList('',$kd_penawaran,'');

			*/
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
	   		
	   		$kd_sertifikasi_jenistarif= $order->kd_sertifikasi_jenistarif;

	   		
	   		//$resultdok= $this->mDokumen->getDokumen('',$kd_sertifikasi_jenistarif ,true);
	   		$resultTarifItem=$this->mTarif->getItem('',$toview['kd_sertifikasi_jenistarif'],true);
	   				//echo count($result2);
			if($resultTarifItem){
			  		$this->listTarifItem='<ol>';
			      	foreach($resultTarifItem as $row){
			      			$ceklist="";$cek="";$visible="hidden";$jumitem=1;$jumhari=1;
			      			//echo $row->kd_sertifikasi_jenistarifitem;
			      			    if($penawaran){
									foreach($penawaran as $orderPenawaranlist){
										if($row->kd_sertifikasi_jenistarifitem==$orderPenawaranlist->kd_sertifikasi_jenistarifitem) {
											$ceklist="checked";	
											if($orderPenawaranlist->jumlah_sertifikasi_jenistarifitem >= 1){
												$cek="checked";
												$visible="visible";
												$jumitem=$orderPenawaranlist->jumlah_sertifikasi_jenistarifitem;
												$jumhari=$orderPenawaranlist->jumlahhari_sertifikasi_jenistarifitem;
											}

										}
										$this->listTarifItem.='<input type="hidden" name="edit" value="1" id="edit" ">';
									}
			      				}
							$this->listTarifItem.=
							'<li>
										<input type="checkbox" name="penawaran['.$counter.']" '.$ceklist.' id="penawaran-'.$counter.'" 	
										value="'.$row->kd_sertifikasi_jenistarifitem.'" 						
                                		onchange="
										if(document.getElementById(\'cekJumlahItem-'.$counter.'\').checked)
                                		{
				    						document.getElementById(\'cekJumlahItem-'.$counter.'\').checked=this.checked; 
                                    		document.getElementById(\'jumlah_sertifikasi_jenistarifitem-'.$counter.'\').value=\'1\'; 
				    						document.getElementById(\'jumlah_sertifikasi_jenistarifitem-'.$counter.'\').style.visibility=\'hidden\'
				    						document.getElementById(\'jumlahhari_sertifikasi_jenistarifitem-'.$counter.'\').value=\'1\'; 
				    						document.getElementById(\'jumlahhari_sertifikasi_jenistarifitem-'.$counter.'\').style.visibility=\'hidden\'

                                		}" >&nbsp;'.ucfirst($row->nama_sertifikasi_jenistarifitem).' ( Rp. '
                                    		.number_format($row->harga_sertifikasi_jenistarifitem,2).'/'.$row->satuan_sertifikasi_jenistarifitem.')&nbsp;&nbsp;
										<input name="cekJumlahItem['.$row->kd_sertifikasi_jenistarifitem.']" '.$cek.' id="cekJumlahItem-'.$counter.'"  
                                  		type="checkbox" value="'.$counter.'" 
                                		onchange="javascript:if(this.checked)				
										{ 
				  			 				document.getElementById(\'jumlah_sertifikasi_jenistarifitem-'.$counter.'\').value=\'1\'; 	
                                   			document.getElementById(\'jumlah_sertifikasi_jenistarifitem-'.$counter.'\').style.visibility=\'visible\' 
                                   			document.getElementById(\'jumlahhari_sertifikasi_jenistarifitem-'.$counter.'\').value=\'1\'; 	
                                   			document.getElementById(\'jumlahhari_sertifikasi_jenistarifitem-'.$counter.'\').style.visibility=\'visible\' 
										}else { 
				   							document.getElementById(\'jumlah_sertifikasi_jenistarifitem-'.$counter.'\').value=\'1\'; 
                                  			document.getElementById(\'jumlah_sertifikasi_jenistarifitem-'.$counter.'\').style.visibility=\'hidden\'
                                  			document.getElementById(\'jumlahhari_sertifikasi_jenistarifitem-'.$counter.'\').value=\'1\'; 	
                                   			document.getElementById(\'jumlahhari_sertifikasi_jenistarifitem-'.$counter.'\').style.visibility=\'hidden\' 
										}" />&nbsp;Jumlah &nbsp; 
										<input type="text" name="jumlah_sertifikasi_jenistarifitem['.$row->kd_sertifikasi_jenistarifitem.']" class="input-text" 
											value="'.$jumitem.'" maxlength="4" size="4"  id="jumlah_sertifikasi_jenistarifitem-'.$counter.'"
							 				style="visibility:'.$visible.'">
							 			<input type="text" name="jumlahhari__sertifikasi_jenistarifitem['.$row->kd_sertifikasi_jenistarifitem.']" class="input-text" 
											value="'.$jumhari.'" maxlength="4" size="4" id="jumlahhari_sertifikasi_jenistarifitem-'.$counter.'"
							 				style="visibility:'.$visible.'">
							</li>';
								$counter++;
					}
					$this->listTarifItem.='</ol>
							<input type="checkbox" name="cekAllDokumen" value="1" id="cekAllDokumen" 
							onchange="CheckItAll()">&nbsp;Check All';
			}
	  		



		 	
		 	$toview['limit']=30;
			$toview['page']=1;
		 	$page=1;
			#get result
			$toview['tot']=$this->mOrder->getTotalOrderPenawaran($toview['kd_order_sertifikasi'],'');
			/*echo "<script>alert('{$toview['tot']}')</script>";*/
			if($toview['tot']>0){
				$toview['pages']=ceil($toview['tot']/$toview['limit']);
				if(!is_numeric($page)){$toview['page']=1;}
				elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
				else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['result']=$this->mOrder->getResultOrderPenawaran($toview['kd_order_sertifikasi'],'','kd_penawaran','asc',30,0);
			} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['result']=false;
			}

			$harga_total=0;
			$totbiayaorder=0;
			if($toview['result']){
					//echo "<script>alert('test result')</script>";
					foreach($toview['result'] as $row){
						$harga_total += $row->harga_total_penawaran; //bikin waktu di update ngitung ulang
						$totbiayaorder +=$row->harga_total_penawaran;
					}
			} else { 
						$harga_total=0; 
			}
			$toview['totbiayaorder']= $totbiayaorder;
			$totbiayalain=0;
			
			$toview['harga_total_penawaran']=$toview['totbiayaorder'];
			
			$this->form_validation->set_rules('tgl_penawaran', 'Tanggal Surat Penawaran', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');		
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');

			if($this->input->post('save')){
				//echo "<script>alert('test save true ".trim($this->input->post('save'))."')</script>";
		  			if($this->form_validation->run()){
		  				//echo "<script>alert('test for falidasi true')</script>";
						if($this->input->post('tambah')){
								//echo "<script>alert('test for input post tambah true')</script>";
								if($this->errormsg=="") { 
				       				//echo "<script>alert('test no error message true')</script>";
									$penawaranlist=$this->input->post('penawaran');
									$jumlahtariflist=$this->input->post('jumlah_sertifikasi_jenistarifitem');
									$jumlahharitariflist=$this->input->post('jumlahhari__sertifikasi_jenistarifitem');
									$toview['no_penawaran']=$this->input->post('no_penawaran');
									$toview['no_surat_permohonan']=$this->input->post('no_surat_permohonan');
				   					$toview['tgl_surat_permohonan']=trim($this->input->post('tgl_surat_permohonan'));
				   					$toview['tgl_penawaran']=trim($this->input->post('tgl_penawaran'));
				   					$toview['perihal_penawaran']=trim($this->input->post('perihal_penawaran'));				   					
				   					$toview['jumlah_lampiran_penawaran']=trim($this->input->post('jumlah_lampiran_penawaran'));
				   					$toview['isi_surat_penawaran']=trim($this->input->post('isi_surat_penawaran'));
				  					$toview['harga_total_penawaran']=trim($this->input->post('harga_total_penawaran'));
				  					$toview['nip_pembuat_penawaran']=trim($this->input->post('nip_pembuat_penawaran'));
				   					$toview['nama_pembuat_penawaran']=trim($this->input->post('nama_pembuat_penawaran'));
				   					$toview['nip_penandatangan_penawaran']=trim($this->input->post('nip_penandatangan_penawaran'));
				   					$toview['nama_penandatangan_penawaran']=trim($this->input->post('nama_penandatangan_penawaran'));
				   					$toview['kd_sertifikasi_jenistarif']=trim($this->input->post('kd_sertifikasi_jenistarif'));
				   					$toview['kd_order_sertifikasi']=trim($this->input->post('kd_order_sertifikasi'));
				  					$toview['kd_sertifikasi_jenistarif']=trim($this->input->post('kd_sertifikasi_jenistarif'));
				   					$toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));

									$toview['kd_penawaran']=$this->mOrder->Make_kd_penawaran();									
									//echo "<script>alert('dokumenlist yang dipilih true')</script>";
 									if($penawaranlist){
 										//echo "<script>alert('dokumenlist yang dipilih true')</script>";
										$hasil=$this->mOrder->saveOrderPenawaran($toview,'',$penawaranlist,$jumlahtariflist,$jumlahharitariflist,false);
										$hasil2=$this->mOrder->saveTotalUlang($toview['kd_order_sertifikasi'],'10');								

									}else{
										//echo "<script>alert('dokumenlist Belum ada yang dipilih')</script>";
									}
									
									if($hasil) { 
										//echo "<script>alert('hasil  true')</script>";
										//$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
										//current_url(),"Detail Order Baru Sementara");
										$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
										////echo "<script>alert('Berhasil disimpan')</script>";
										redirect('order/orderPenawaran/'.$toview['kd_order_sertifikasi']);
									} else { 
										$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
										//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
										redirect(current_url());
									}
								}else{
									//echo "<script>alert('".$this->errormsg."')</script>";
								}
				
			  			}else if($this->input->post('edit')){
							//echo "<script>alert('test edit')</script>";
							if($this->errormsg=="") { 
				       				//echo "<script>alert('test no error message true')</script>";	
									$penawaranlist=$this->input->post('penawaran');
									$jumlahtariflist=$this->input->post('jumlah_sertifikasi_jenistarifitem');
									$jumlahharitariflist=$this->input->post('jumlahhari__sertifikasi_jenistarifitem');

									$toview['no_penawaran']=$this->input->post('no_penawaran');
									$toview['no_surat_permohonan']=$this->input->post('no_surat_permohonan');
				   					$toview['tgl_surat_permohonan']=trim($this->input->post('tgl_surat_permohonan'));
				   					$toview['tgl_penawaran']=trim($this->input->post('tgl_penawaran'));
				   					$toview['perihal_penawaran']=trim($this->input->post('perihal_penawaran'));
				   					$toview['jumlah_lampiran_penawaran']=trim($this->input->post('jumlah_lampiran_penawaran'));
				   					$toview['isi_surat_penawaran']=trim($this->input->post('isi_surat_penawaran'));
				  					$toview['harga_total_penawaran']=trim($this->input->post('harga_total_penawaran'));
				  					$toview['nip_pembuat_penawaran']=trim($this->input->post('nip_pembuat_penawaran'));
				   					$toview['nama_pembuat_penawaran']=trim($this->input->post('nama_pembuat_penawaran'));
				   					$toview['nip_penandatangan_penawaran']=trim($this->input->post('nip_penandatangan_penawaran'));
				   					$toview['nama_penandatangan_penawaran']=trim($this->input->post('nama_penandatangan_penawaran'));
				   					$toview['kd_sertifikasi_jenistarif']=trim($this->input->post('kd_sertifikasi_jenistarif'));
				   					$toview['kd_order_sertifikasi']=trim($this->input->post('kd_order_sertifikasi'));
				  					$toview['kd_sertifikasi_jenistarif']=trim($this->input->post('kd_sertifikasi_jenistarif'));
				   					$toview['kd_sertifikasi_jenis']=trim($this->input->post('kd_sertifikasi_jenis'));
									//$toview['kd_penawaran']=$this->mOrder->Make_kd_penawaran();					
									
									//echo "<script>alert('dokumenlist yang dipilih true')</script>";
 									if($penawaranlist){
 											//echo "<script>alert('dokumenlist yang dipilih true')</script>";
											//$hasil=$this->mOrder->saveOrderPenawaran($toview,'',$penawaranlist,true); 
											$hasil=$this->mOrder->saveOrderPenawaran($toview,'',$penawaranlist,$jumlahtariflist,$jumlahharitariflist,true); 
											$hasil2=$this->mOrder->saveTotalUlang($toview['kd_order_sertifikasi'],'10');	
											//$hasil2=$this->mOrder->saveTotalUlang($toview['kd_order'],$ppn); 
											//echo "<script>alert('test, total ulan OK ')</script>";									

									}else{
										//echo "<script>alert('dokumenlist Belum ada yang dipilih')</script>";
									}
									
									if($hasil) { 
										//$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
										//current_url(),"Detail Order Baru Sementara");
										//$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
										//echo "<script>alert('Berhasil disimpan')</script>";
										redirect('order/orderPenawaran/'.$toview['kd_order_sertifikasi']);
									} else { 
										$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
										//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
										redirect(current_url());
									}
								}else{
									//echo "<script>alert('".$this->errormsg."')</script>";
								}
			 			}

		  			} else{
		  				//echo "<script>alert('test Validasi false')</script>";
		  			}


			}else{

				//echo "<script>alert('".trim($this->input->post('save'))."')</script>";
			} 
	
		
			#judul
			$this->judul='List Order Dokumen';
			$this->javascript='
					<script type="text/javascript">
						$("#tgl_penawaran").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_surat_permohonan").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});

						function CheckItAll(){
							for(i=0;i<'.$counter.';i++){
								document.getElementById(\'penawaran-\' + i).checked=document.getElementById(\'cekAllDokumen\').checked;
							}
						}
					</script>';
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_penawaran',$toview);	
	}

public function viewOrderSuratPenawaran($kd_order_sertifikasi='',$kd_penawaran=''){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
	   	else redirect('orderSertifikasi');

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
		$toview['email_kontak_perusahaan_pemohon']=$order->email_kontak_perusahaan_pemohon;

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

		
		$order_penawaran = $this->mOrder->getOrderPenawaran($kd_penawaran,$toview['kd_order_sertifikasi']);
				$toview['kd_penawaran']=$order_penawaran->kd_penawaran;
				$toview['no_penawaran']=$order_penawaran->no_penawaran;
				$toview['no_surat_permohonan']=$order_penawaran->no_surat_permohonan;
				$toview['tgl_surat_permohonan']=$order_penawaran->tgl_surat_permohonan;
				$toview['tgl_penawaran']=$order_penawaran->tgl_penawaran;
				$toview['perihal_penawaran']=$order_penawaran->perihal_penawaran;
				$toview['jumlah_lampiran_penawaran']=$order_penawaran->jumlah_lampiran_penawaran;	
				$toview['isi_surat_penawaran']=$order_penawaran->isi_surat_penawaran;			
				$toview['harga_total_penawaran']=$order_penawaran->harga_total_penawaran;
				$toview['nip_pembuat_penawaran']=$order_penawaran->nip_pembuat_penawaran;
				$toview['nama_pembuat_penawaran']=$order_penawaran->nama_pembuat_penawaran;
		 		$toview['nip_penandatangan_penawaran']=$order_penawaran->nip_penandatangan_penawaran;
		 		$toview['nama_penandatangan_penawaran']=$order_penawaran->nama_penandatangan_penawaran;
		 		$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
				$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
				$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;
				$toview['kd_satker']=$order->kd_satker;

		$toview['limit']=30;
		$toview['page']=1;
		$page=1;
		#get result
		$toview['totpabrik']=$this->mOrder->getTotalOrderPabrik($toview['kd_order_sertifikasi'],'');
		if($toview['totpabrik']>0){
			$toview['pages']=ceil($toview['totpabrik']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultpabrik']=$this->mOrder->getResultOrderPabrik($toview['kd_order_sertifikasi'],'','kd_order_pabrik','desc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultpabrik']=false;
		}
		

		#judul
		$this->judul='Surat Penawaran';
		#load view
		if($this->session->flashdata('cetak')){
			$this->content=$this->load->view('cetak/print_view_order_surat_penawaran',$toview);
		} else {
			$this->content=$this->load->view('order/sertifikasi/view_order_surat_penawaran',$toview);
		}
	}


public function viewOrderLampiranPenawaran($kd_order_sertifikasi,$kd_penawaran){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
	   	else redirect('orderSertifikasi');

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
		$toview['email_kontak_perusahaan_pemohon']=$order->email_kontak_perusahaan_pemohon;

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

		
		$order_penawaran = $this->mOrder->getOrderPenawaran($kd_penawaran,$toview['kd_order_sertifikasi']);
		$toview['kd_penawaran']=$order_penawaran->kd_penawaran;
		$toview['no_penawaran']=$order_penawaran->no_penawaran;
		$toview['no_surat_permohonan']=$order_penawaran->no_surat_permohonan;
		$toview['tgl_penawaran']=$order_penawaran->tgl_penawaran;
		$toview['perihal_penawaran']=$order_penawaran->perihal_penawaran;
		$toview['jumlah_lampiran_penawaran']=$order_penawaran->jumlah_lampiran_penawaran;	
		$toview['isi_surat_penawaran']=$order_penawaran->isi_surat_penawaran;			
		$toview['harga_total_penawaran']=$order_penawaran->harga_total_penawaran;
		$toview['nip_pembuat_penawaran']=$order_penawaran->nip_pembuat_penawaran;
		$toview['nama_pembuat_penawaran']=$order_penawaran->nama_pembuat_penawaran;
		$toview['nip_penandatangan_penawaran']=$order_penawaran->nip_penandatangan_penawaran;
		$toview['nama_penandatangan_penawaran']=$order_penawaran->nama_penandatangan_penawaran;
		$toview['kd_sertifikasi_jenistarif']=$order->kd_sertifikasi_jenistarif;
		$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis;
		$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;
		$toview['kd_satker']=$order->kd_satker;

		$toview['limit']=30;
		$toview['page']=1;
		$page=1;

		//echo $toview['kd_penawaran']."<br>";
		#get result Dokumen list
		$toview['tot2']=$this->mOrder->getTotalOrderPenawaranList('',$toview['kd_penawaran']);
		//echo count($toview['tot2']);
		if($toview['tot2']>0){
			$toview['pages']=ceil($toview['tot2']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultOrderPenawaraList']=$this->mOrder->getResultOrderPenawaranList('',$toview['kd_penawaran'],'kd_sertifikasi_jenistarifitem','asc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultOrderPenawaraList']=false;
		}

		//echo count($toview['resultOrderPenawaranList']);
		#judul
		$this->judul='View Penawaran';
		#load view
		if($this->session->flashdata('cetak')){
			$this->content=$this->load->view('cetak/print_view_order_lampiran',$toview);
		} else {
			$this->content=$this->load->view('order/sertifikasi/view_order_lampiran_surat_penawaran',$toview);
		}
	}


public function delOrderPenawaran($kd_order_sertifikasi='',$kd_penawaran=''){
		//echo "<script>alert('hapus1')</script>";
		$this->mOrder->deletePenawaran($kd_order_sertifikasi,$kd_penawaran);
		$this->mOrder->deletePenawaranList($kd_order_sertifikasi,$kd_penawaran);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Komoditi . ".$kd_invoice);
		redirect('order/orderPenawaran/'.$kd_order_sertifikasi);
	}



public function orderKontrak($kd_order_sertifikasi='',$kd_kontrak=''){
	    $this->errormsg="";          

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_kontrak) $toveiw['kontrak']=$kd_sertifikat;
	    else $toveiw['kontrak']='';

		$toview['no_kontrak']='';
		$toview['tgl_cetak_kontrak']='';	   	
	   	$toview['file_kontrak']='';
	   	$toview['nama_penandatangan_bbk_kontrak']='';
	   	$toview['nip_penandatangan_bbk_kontrak']='';
	   	$toview['jabatan_penandatangan_bbk_kontrak']='';
	   	$toview['tgl_penandatangan_bbk_kontrak']='';
	   	$toview['nama_penandatangan_perusahaan_kontrak']='';
	   	$toview['nip_penandatangan_perusahaan_kontrak']='';
	   	$toview['jabatan_penandatangan_perusahaan_kontrak']='';
	   	$toview['tgl_penandatangan_perusahaan_kontrak']='';
	   	$toview['nip_pembuat_kontrak']='';
	   	$toview['nama_pembuat_kontrak']='';
	   	$toview['tgl_diterima_kontrak']='';
		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	

	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;

		$toview['totOrderKontrak']=$this->mOrder->getTotalOrderKontrak($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderKontrak']>0){
			$toview['pages']=ceil($toview['totOrderKontrak']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderKontrak']=$this->mOrder->getResultOrderKontrak($toview['kd_order_sertifikasi'],'','kd_kontrak','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderKontrak']=false;
		}
		
		$this->form_validation->set_rules('no_kontrak', 'No Kontrakt', 'required');
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
						$toview['kd_kontrak']=$this->mOrder->Make_kd_kontrak();	
				   		$toview['no_kontrak']=trim($this->input->post('no_kontrak'));		
						$toview['tgl_cetak_kontrak']=trim($this->input->post('tgl_cetak_kontrak'));		
	   					$toview['file_kontrak']=trim($this->input->post('file_kontrak'));		
	   					$toview['nama_penandatangan_bbk_kontrak']=trim($this->input->post('nama_penandatangan_bbk_kontrak'));		
	   					$toview['nip_penandatangan_bbk_kontrak']=trim($this->input->post('nip_penandatangan_bbk_kontrak'));		
	   					$toview['jabatan_penandatangan_bbk_kontrak']=trim($this->input->post('jabatan_penandatangan_bbk_kontrak'));		
	   					$toview['tgl_penandatangan_bbk_kontrak']=trim($this->input->post('tgl_penandatangan_bbk_kontrak'));		
	   					$toview['nama_penandatangan_perusahaan_kontrak']=trim($this->input->post('nama_penandatangan_perusahaan_kontrak'));		
	   					$toview['nip_penandatangan_perusahaan_kontrak']=trim($this->input->post('nip_penandatangan_perusahaan_kontrak'));		
	   					$toview['jabatan_penandatangan_perusahaan_kontrak']=trim($this->input->post('jabatan_penandatangan_perusahaan_kontrak'));		
	   					$toview['tgl_penandatangan_perusahaan_kontrak']=trim($this->input->post('tgl_penandatangan_perusahaan_kontrak'));
	   					$toview['nip_pembuat_kontrak']=trim($this->input->post('nip_pembuat_kontrak'));
	   					$toview['nama_pembuat_kontrak']=trim($this->input->post('nama_pembuat_kontrak'));

	   					$toview['tgl_diterima_kontrak']=trim($this->input->post('tgl_diterima_kontrak'));		

				  		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
						$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				if($this->errormsg=="") { 
						
						/*
						$file_dir='./download/kontrak/'.date('Y-m').'/';
						if(!file_exists($file_dir)) {
								mkdir($file_dir);
						}else {
								
								echo "<script>alert('Ok.file direktori sudah ada')</script>";
								$file_dir =$file_dir;

						}
						
						$syxupload['upload_path'] = $file_dir;
						$syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
						$syxupload['max_size']	= '2500';
						//$syxupload['max_width']  = '1024';
						//$syxupload['max_height']  = '768';	
						$this->load->library('upload', $syxupload);
						//$this->upload->initialize($syxupload);

						if (! $this->upload->do_upload())
						{
							$this->errormsg = "Upload Gagal!! ".$file_dir.$this->upload->display_errors();
						}else{
				    		//echo "<script>alert('test no error message true')</script>";\
							$data = array('upload_data' => $this->upload->data());
							$toview['file_kontrak']=$file_dir.$data['upload_data']['file_name'];	*/			    		
									
							$hasil=$this->mOrder->saveOrderKontrak($toview,$toview['kd_order_sertifikasi'],false); 
							//echo "<script>alert('test disimpan')</script>";
							if($hasil) { 
								$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
								current_url(),"Order ESertifikasi ");
								$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
								//echo "<script>alert('Berhasil disimpan')</script>";
								redirect('order/orderSertifikat/'.$toview['kd_order_sertifikasi']);
							} else { 
								$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
								//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
								redirect(current_url());
							}
						//}
					}else{ 
						//echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		
		
		#judul
		$this->judul='Kontrak';
		$this->javascript=';
					<script type="text/javascript">
						$("#tgl_cetak_kontrak").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_penandatangan_bbk_kontrak").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_penandatangan_perusahaan_kontrak").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_diterima_kontrak").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
					</script>';
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_kontrak',$toview);	
}

public function viewOrderKontrak($kd_order_sertifikasi='',$kd_kontrak=''){
	    $this->errormsg="";          

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_kontrak) $toveiw['kontrak']=$kd_kontrak;

		$resultkontrak = $this->mOrder->getOrderKontrak($kd_order_sertifikasi,$kd_kontrak);
	   

		$toview['no_kontrak']=$resultkontrak->no_kontrak;
		$toview['tgl_cetak_kontrak']=$resultkontrak->tgl_cetak_kontrak;	   	
	   	$toview['file_kontrak']=$resultkontrak->file_kontrak;
	   	$toview['nama_penandatangan_bbk_kontrak']=$resultkontrak->nama_penandatangan_bbk_kontrak;
	   	$toview['nip_penandatangan_bbk_kontrak']=$resultkontrak->nip_penandatangan_bbk_kontrak;
	   	$toview['jabatan_penandatangan_bbk_kontrak']=$resultkontrak->jabatan_penandatangan_bbk_kontrak;
	   	$toview['tgl_penandatangan_bbk_kontrak']=$resultkontrak->tgl_penandatangan_bbk_kontrak;
	   	$toview['nama_penandatangan_perusahaan_kontrak']=$resultkontrak->nama_penandatangan_perusahaan_kontrak;	   	
	   	$toview['nip_penandatangan_perusahaan_kontrak']=$resultkontrak->nip_penandatangan_perusahaan_kontrak;
	   	$toview['jabatan_penandatangan_perusahaan_kontrak']=$resultkontrak->jabatan_penandatangan_perusahaan_kontrak;
	   	$toview['tgl_penandatangan_perusahaan_kontrak']=$resultkontrak->tgl_penandatangan_perusahaan_kontrak;
	   	$toview['nip_pembuat_kontrak']=$resultkontrak->nip_pembuat_kontrak;
	   	$toview['nama_pembuat_kontrak']=$resultkontrak->nama_pembuat_kontrak;
	   	$toview['tgl_diterima_kontrak']=$resultkontrak->tgl_diterima_kontrak;
		$toview['kd_order_sertifikasi']=$resultkontrak->kd_order_sertifikasi;	
		
		#judul
		$this->judul='Kontrak';
		
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/view_order_rinci_kontrak',$toview);	
}
public function delKontrak($kd_order_sertifikasi='',$kd_sertifikat=''){
		$this->mOrder->deleteOrderSertifikat($kd_order_sertifikasi,$kd_sertifikat);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Evaluasi. ".$kd_sertifikat);
		redirect('order/orderKontrak/'.$kd_order_sertifikasi);
}

public function orderPenagihan($kd_order_sertifikasi,$kd_invoice='',$action=''){

		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
	   	else redirect('orderSertifikasi');

		$order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi);
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
		$toview['email_kontak_perusahaan_pemohon']=$order->email_kontak_perusahaan_pemohon;

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

		$toview['jumlah_lampiran_invoice']='';
		$toview['perihal_invoice']='';
		$toview['isi_surat_invoice']='';
		$toview['nip_penandatangan_invoice']='';
		$toview['nama_penandatangan_invoice']='';


		$user=$this->mUser->getDetail($this->session->userdata('userid')); 
		$toview['nip_pembuat_invoice']=$user->nip_baru;
		$toview['nama_pembuat_invoice']=$user->Nama;
		$dat_biaya=$this->mOrder->getPembayaranSementara($kd_order_sertifikasi);
		$total_bayar=0;
		if($dat_biaya){
			foreach($dat_biaya as $row1){
				$total_bayar +=$row1->nilai_bayar;
				

			}
		}
		$toview['total_bayar']=$total_bayar;
		$toview['limit']=30;
		$toview['page']=1;
		$page=1;
		
		#get result Dokumen list
		$toview['tot2']=$this->mOrder->getTotalOrderInvoice($toview['kd_order_sertifikasi'],'');
		//echo count($toview['tot2']);
		if($toview['tot2']>0){
			$toview['pages']=ceil($toview['tot2']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultOrderInvoice']=$this->mOrder->getResultOrderInvoice($toview['kd_order_sertifikasi'],'','kd_invoice','asc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultOrderInvoice']=false;
		}


		$this->form_validation->set_rules('invoice_ke', 'Invoice Ke', 'required');
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
					$toview['no_invoice']=$this->input->post('no_invoice');					
					$toview['invoice_ke']=trim($this->input->post('invoice_ke'));
				   	$toview['tgl_invoice']=trim($this->input->post('tgl_invoice'));
				   	$toview['harga_total']=trim($this->input->post('harga_total'));
					$toview['jumlah_bayar']=trim($this->input->post('jumlah_bayar'));
				   	$toview['sisa_bayar']=trim($this->input->post('sisa_bayar'));

				   	$toview['jumlah_lampiran_invoice']=trim($this->input->post('jumlah_lampiran_invoice'));
				   	$toview['perihal_invoice']=trim($this->input->post('perihal_invoice'));
				   	$toview['isi_surat_invoice']=trim($this->input->post('isi_surat_invoice'));
					$toview['nip_penandatangan_invoice']=trim($this->input->post('nip_penandatangan_invoice'));
				   	$toview['nama_penandatangan_invoice']=trim($this->input->post('nama_penandatangan_invoice'));

				  	$toview['nip_pembuat_invoice']=trim($this->input->post('nip_pembuat_invoice'));
				  	$toview['nama_pembuat_invoice']=trim($this->input->post('nama_pembuat_invoice'));
				  	$toview['kd_invoice']=$this->mOrder->Make_kd_invoice();
				  	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderInvoice($toview,$toview['kd_order_sertifikasi']); 
					//echo "<script>alert('test disimpan')</script>";
					if($hasil) { 
						/*$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Order Komoditi ");*/
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/orderPenagihan/'.$toview['kd_order_sertifikasi']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}//else{echo "<script>alert(".$this->errormsg."')</script>";}
				
			  }//else{echo "<script>alert('test for input post tambah false')</script>";}
		  }
		}//else  echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>";

		
		

        #judul
		$this->judul='Daftar Penaginan';
		$this->javascript='
					<script type="text/javascript">
						$("#tgl_invoice").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});

						
					</script>';
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_penagihan',$toview);
		
	}

	public function delOrderPenagihan($kd_order_sertifikasi='',$kd_invoice=''){
		//echo "<script>alert('hapus1')</script>";
		$this->mOrder->deleteInvoice($kd_order_sertifikasi,$kd_invoice);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Komoditi . ".$kd_invoice);
		redirect('order/orderPenagihan/'.$kd_order_sertifikasi);
	}


	public function viewOrderPenagihan($kd_order_sertifikasi,$kd_invoice){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
	   	else redirect('orderSertifikasi');

		$order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi);
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
		$toview['email_kontak_perusahaan_pemohon']=$order->email_kontak_perusahaan_pemohon;

		
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



		$order_penawaran = $this->mOrder->getOrderPenawaran('',$kd_order_sertifikasi);
		$toview['kd_penawaran']=$order_penawaran->kd_penawaran;
		$toview['no_penawaran']=$order_penawaran->no_penawaran;
		$toview['no_surat_permohonan']=$order_penawaran->no_surat_permohonan;
		$toview['tgl_penawaran']=$order_penawaran->tgl_penawaran;
		$toview['perihal_penawaran']=$order_penawaran->perihal_penawaran;
		$toview['jumlah_lampiran_penawaran']=$order_penawaran->jumlah_lampiran_penawaran;	
		$toview['isi_surat_penawaran']=$order_penawaran->isi_surat_penawaran;			
		$toview['harga_total_penawaran']=$order_penawaran->harga_total_penawaran;
		$toview['nip_pembuat_penawaran']=$order_penawaran->nip_pembuat_penawaran;
		$toview['nama_pembuat_penawaran']=$order_penawaran->nama_pembuat_penawaran;
		$toview['nip_penandatangan_penawaran']=$order_penawaran->nip_penandatangan_penawaran;
		$toview['nama_penandatangan_penawaran']=$order_penawaran->nama_penandatangan_penawaran;

		$toview['limit']=30;
		$toview['page']=1;
		$page=1;

		//echo $toview['kd_penawaran']."<br>";
		#get result Dokumen list
		$toview['tot2']=$this->mOrder->getTotalOrderPenawaranList('',$toview['kd_penawaran']);
		//echo count($toview['tot2']);
		if($toview['tot2']>0){
			$toview['pages']=ceil($toview['tot2']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultOrderPenawaraList']=$this->mOrder->getResultOrderPenawaranList('',$toview['kd_penawaran'],'kd_sertifikasi_jenistarifitem','asc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultOrderPenawaraList']=false;
		}


		#get result
		$toview['totpabrik']=$this->mOrder->getTotalOrderPabrik($toview['kd_order_sertifikasi'],'');
		if($toview['totpabrik']>0){
			$toview['pages']=ceil($toview['totpabrik']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultpabrik']=$this->mOrder->getResultOrderPabrik($toview['kd_order_sertifikasi'],'','kd_order_pabrik','desc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultpabrik']=false;
		}



		$inv=$this->mOrder->getOrderInvoice('',$kd_invoice,'');
		$toview['kd_invoice']=$inv->kd_invoice;
		$toview['no_invoice']=$inv->no_invoice;
		$toview['invoice_ke']=$inv->invoice_ke;
		$toview['tgl_invoice']=$inv->tgl_invoice;
		$toview['harga_total']=$inv->harga_total;
		$toview['jumlah_bayar']=$inv->jumlah_bayar;
		$toview['sisa_bayar']=$inv->sisa_bayar; 
		$toview['jumlah_lampiran_invoice']='';
		$toview['perihal_invoice']=$inv->jumlah_lampiran_invoice;
		$toview['isi_surat_invoice']=$inv->isi_surat_invoice;
		$toview['nip_penandatangan_invoice']=$inv->nip_penandatangan_invoice;
		$toview['nama_penandatangan_invoice']=$inv->nama_penandatangan_invoice;
		$toview['nip_pembuat_invoice']=$inv->nip_pembuat_invoice;
		$toview['nama_pembuat_invoice']=$inv->nama_pembuat_invoice;
		$toview['kd_order_sertifikasi']=$inv->kd_order_sertifikasi;

		

		$dat_biaya=$this->mOrder->getPembayaranSementara($kd_order_sertifikasi);
		$total_bayar=0;
		if($dat_biaya){
			foreach($dat_biaya as $row1){
				$total_bayar +=$row1->nilai_bayar;
				

			}
		}
		$toview['total_bayar']=$total_bayar;
		
		
		#judul
		$this->judul='<center><font size=5><b><u>INVOICE</u></b></font>
				<font size=2><br>No : '.$toview['no_invoice'].'</center>';
		
		#load view
		//if($this->session->flashdata('cetak')){
			$this->content=$this->load->view('cetak/print_view_order_surat_penagihan',$toview);
		//} else {
		//	$this->content=$this->load->view('order/sertifikasi/view_order_surat_penagihan',$toview);
		//}
			
		
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

public function orderPembayaran($kd_order_sertifikasi,$kd_pembayaran='',$action='')
{

		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
	   	else redirect('orderSertifikasi');

		$order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi);
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
		$toview['email_kontak_perusahaan_pemohon']=$order->email_kontak_perusahaan_pemohon;
		
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



		$user=$this->mUser->getDetail($this->session->userdata('userid')); 
		$toview['nip_penerima']=$user->nip_baru;
		$toview['nama_penerima']=$user->Nama;

		$dat_biaya=$this->mOrder->getOrderPembayaran($kd_order_sertifikasi);
		$total_bayar=0;
		if($dat_biaya){
			foreach($dat_biaya as $row1){
				$total_bayar +=$row1->nilai_bayar;	
			}
		}
		$toview['total_bayar']=$total_bayar;

		$toview['limit']=30;
		$toview['page']=1;
		$page=1;
		
		#get result Dokumen list
		$toview['tot2']=$this->mOrder->getTotalOrderPembayaran($toview['kd_order_sertifikasi'],'');
		//echo count($toview['tot2']);
		if($toview['tot2']>0){
			$toview['pages']=ceil($toview['tot2']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultOrderPembayaran']=$this->mOrder->getResultOrderPembayaran($toview['kd_order_sertifikasi'],'','kd_pembayaran','asc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultOrderPembayaran']=false;
		}


		$this->form_validation->set_rules('no_pembayaran', 'No Pembayaran', 'required');
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
					$toview['no_pembayaran']=$this->input->post('no_pembayaran');					
					$toview['nilai_bayar']=trim($this->input->post('nilai_bayar'));
				   	$toview['tgl_bayar']=trim($this->input->post('tgl_bayar'));
				   	$toview['nama_pembayar']=trim($this->input->post('nama_pembayar'));
					$toview['tujuan_pembayaran']=trim($this->input->post('tujuan_pembayaran'));
				  	$toview['nip_penerima']=trim($this->input->post('nip_penerima'));
				  	$toview['nama_penerima']=trim($this->input->post('nama_penerima'));
				  	$toview['kd_pembayaran']=$this->mOrder->Make_kd_pembayaran();
				  	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderPembayaran($toview,$toview['kd_order_sertifikasi']); 
					//echo "<script>alert('test disimpan')</script>";
					if($hasil) { 
						/*$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Order Komoditi ");*/
						
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						$dat_biaya=$this->mOrder->getOrderPembayaran($kd_order_sertifikasi);
						$total_bayar=0;
						if($dat_biaya){
							foreach($dat_biaya as $row1){
								$total_bayar +=$row1->nilai_bayar;	
							}
						}
						$toview['jmlbayar_order_sertifikasi']=$total_bayar;
						$hasil1 = $this->mOrder->saveOrderSertifikasi($toview,$kd_order_sertifikasi,true); 

						redirect('order/orderPembayaran/'.$toview['kd_order_sertifikasi']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url()); }
				}//else//{echo "<script>alert(".$this->errormsg."')</script>";}
				
			  }//else//{echo "<script>alert('test for input post tambah false')</script>"; }

			}//else // echo "<script>alert('test vLIDASI  false ')</script>";

		}//echo "<script>alert('test input save false OK'".trim($this->input->post('save')).")</script>";

		
		

        #judul
		$this->judul='Daftar Pembayaran';
		$this->javascript='
					<script type="text/javascript">
						$("#tgl_bayar").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});

						
					</script>';
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_pembayaran',$toview);
}
	public function delOrderPembayaran($kd_order_sertifikasi='',$kd_pembayaran=''){
		echo "<script>alert('hapus1')</script>";
		$this->mOrder->deletePembayaran($kd_order_sertifikasi,$kd_pembayaran);
		$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
		$dat_biaya=$this->mOrder->getOrderPembayaran($kd_order_sertifikasi);
						$total_bayar=0;
						if($dat_biaya){
							foreach($dat_biaya as $row1){
								$total_bayar +=$row1->nilai_bayar;	
							}
						}else{
							$total_bayar=0;

						}
						$toview['jmlbayar_order_sertifikasi']=$total_bayar;
						$hasil1 = $this->mOrder->saveOrderSertifikasi($toview,$kd_order_sertifikasi,true); 

		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Pembayaran . ".$kd_pembayaran);
		redirect('order/orderPembayaran/'.$kd_order_sertifikasi);
	}


	public function viewOrderPembayaran($kd_order_sertifikasi,$kd_invoice){

	     $inv=$this->mOrder->getInvoice($kd_order_sertifikasi,$kd_invoice);		

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

	    $dat=$this->mOrder->getOrder($toview['kd_order_sertifikasi']);
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
		$toview['tot']=$this->mOrder->GetTotalDetail($toview['kd_order_sertifikasi'],'',false);
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mOrder->GetResultDetail($toview['kd_order_sertifikasi'],'',false,'kd_detail_order','desc',30,0);
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
		$toview['resultbiaya_lain']=$this->mOrder->getBiayaLain($toview['kd_order_sertifikasi']);
		if($toview['resultbiaya_lain']){
			foreach($toview['resultbiaya_lain'] as $row){
				$totbiayalain +=$row->sub_total_biaya;
			}
			$toview['totbiayalain'] = $totbiayalain;
		}else{
			$toview['totbiayalain']=0;
		}
		#Rincian Bayar
		$dat_bayar=$this->mOrder->getPembayaranSementara($toview['kd_order_sertifikasi']);
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




	public function orderKwitansi($kd_order_sertifikasi='',$kd_pembayaran=''){
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
		$toview['kd_order_sertifikasi']=$data->kd_order_sertifikasi;
		$toview['kd_satker']=$data->kd_satker;
		$toview['tgl_create']=$data->tgl_create;
	    }
		$dat=$this->mOrder->getOrderSertifikasi($toview['kd_order_sertifikasi']);
		$toview['noreg_order_sertifikasi'] = $dat->noreg_order_sertifikasi;
		$toview['jml_ppn_total'] = (10/100) * $toview['nilai_bayar'];
		$toview['biaya_uji']= $toview['nilai_bayar']*100/110;
		$toview['jml_ppn']= $toview['biaya_uji'] * 10/100;
		#judul
		$this->judul='<center><font size=5><b><u>KWITANSI</u></b></font></center>';
			
		#load view
		
		$this->content=$this->load->view('cetak/print_view_kwitansi',$toview);
			
		
	}

	
public function orderJadwal($kd_order_sertifikasi=''){
		$this->errormsg="";

		if($kd_order_sertifikasi) 
			$toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
		else 
			redirect('order');
		
		$order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi,'');

		
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
		$toview['email_kontak_perusahaan_pemohon']=$order->email_kontak_perusahaan_pemohon;
		
		$toview['kd_sertifikasi_smm']=$order->kd_sertifikasi_smm;
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
		$toview['kd_sertifikasi_jenis']=$order->kd_sertifikasi_jenis; 		
		$toview['kd_jenis_layanan']=$order->kd_jenis_layanan;
		$toview['layanan']=$this->mOrder->getJenisLayanan($order->kd_jenis_layanan);
		$toview['kd_satker']=$order->kd_satker; 
   	
	   	$result=$this->mTarif->getJenis($toview['kd_sertifikasi_jenis']);
		$toview['nama_sertifikasi_jenis']=$result->nama_sertifikasi_jenis;

		$jadwal=$this->mOrder->getOrderAudit($toview['kd_order_sertifikasi']);
		if($jadwal){
			$toview['kd_order_audit']=$jadwal->kd_order_audit;
			$toview['tgl_awal_audit']=$jadwal->tgl_awal_audit;
			$toview['tgl_ahir_audit']=$jadwal->tgl_ahir_audit;
			$toview['tgl_penunjukanauditor_audit']=$jadwal->tgl_penunjukanauditor_audit;
			$toview['nip_penunjukanauditor_audit']=$jadwal->nip_penunjukanauditor_audit;
			$toview['nama_penunjukanauditor_audit']=$jadwal->nama_penunjukanauditor_audit;
			$toview['kd_order_sertifikasi']=$jadwal->kd_order_sertifikasi;
			$toview['kd_satker']=$jadwal->kd_satker;
			$toview['edit']='edit';

		}else{
			$toview['kd_order_audit']='';
			$toview['tgl_awal_audit']='';
			$toview['tgl_ahir_audit']='';
			$toview['tgl_penunjukanauditor_audit']='';
			$toview['nip_penunjukanauditor_audit']='';
			$toview['nama_penunjukanauditor_audit']='';
			$toview['edit']='';
		}

	   		
		$this->form_validation->set_rules('tgl_awal_audit', 'Tanggal Awal Audit', 'required');
		$this->form_validation->set_rules('tgl_ahir_audit', 'Tanggal Akhir Audit', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');
		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		if($this->input->post('save')){
		  if($this->form_validation->run())
		  {
			 $toview['tgl_awal_audit']=$this->input->post('tgl_awal_audit');
			 $toview['tgl_ahir_audit']=$this->input->post('tgl_ahir_audit');
			 $toview['tgl_penunjukanauditor_audit']=$this->input->post('tgl_penunjukanauditor_audit');
			 $toview['nip_penunjukauditor_audit']=$this->input->post('nip_penunjukauditor_audit');
			 $toview['nama_penunjukauditor_audit']=$this->input->post('nama_penunjukauditor_audit');

			if($this->errormsg=="") { 
				$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
				if($this->input->post('edit')){
					$toview['tgl_update']=date("Y-m-d H:i:s");
					$hasil=$this->mOrder->saveOrderAudit($toview,$toview['kd_order_sertifikasi'],true);


				}else{
					$toview['kd_order_audit']=$this->mOrder->Make_kd_order_audit();
					$toview['tgl_create']=date("Y-m-d H:i:s");
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
					$hasil=$this->mOrder->saveOrderAudit($toview,$toview['kd_order_sertifikasi'],false);

				}
												
				 
				if($hasil) { 
					//$this->mUser->WriteLog($this->session->userdata('userid'),
					//$_SERVER['REMOTE_ADDR'],current_url(),"Order Baru");
					$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
					//echo "<script>alert('Berhasil disimpan')</script>";
					redirect('order/orderjadwal/'.$toview['kd_order_sertifikasi']);
				} else { 
					$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
					//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";/
					redirect(current_url());
				}
			}
		  }
		}

								
		
		#judul
		$this->judul='Penjadwalan Audit';
		
		#javascript
		$this->javascript='
					<script type="text/javascript">
						$("#tgl_awal_audit").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_ahir_audit").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_penunjukanauditor_audit").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
					</script>';
		
						
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_add_jadwal',$toview);	
	}

public function orderAuditor($kd_order_sertifikasi='',$kd_auditor=''){
	    $this->errormsg=""; $this->listKomoditi=""; //$this->list_customer="";
           	$counter=0;

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_auditor) $toveiw['kd_auditor']='';

	   	if($kd_auditor){
			 $auditorna=$this->mAuditor->readAuditor($kd_auditor);
			 $toview['kd_auditor']=$auditorna->kd_auditor;
			 $toview['nama_auditor']=$auditorna->nama_auditor;
			 $toview['singkatan_nama_auditor']=$auditorna->singkatan_nama_auditor;
			 $toview['jabatan_auditor']=$auditorna->jabatan_auditor;
			 $toview['posisi_tim_auditor']='';
	   		 $toview['kd_satker']=$auditorna->kd_satker;

		} else {
			 	$toview['kd_auditor']='';
	   			$toview['nama_auditor']='';
				$toview['singkatan_nama_auditor']='';	   	
	   			$toview['jabatan_auditor']='';
	   			$toview['posisi_tim_auditor']='';
	   			
		}
	   		
		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;		
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	#get result
		$toview['tot']=$this->mOrder->getTotalOrderAuditor($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mOrder->getResultOrderAuditor($toview['kd_order_sertifikasi'],'','kd_auditor','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		
		$this->form_validation->set_rules('nama_auditor', 'Nama Auditor', 'required');
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
					$toview['kd_order_auditor']=$this->mOrder->Make_kd_order_auditor();
					$toview['kd_auditor']=trim($this->input->post('kd_auditor'));
					$toview['nama_auditor']=trim($this->input->post('nama_auditor'));
				   	$toview['singkatan_nama_auditor']=trim($this->input->post('singkatan_nama_auditor'));
				  	$toview['jabatan_auditor']=trim($this->input->post('jabatan_auditor'));
				  	$toview['posisi_tim_auditor']=trim($this->input->post('posisi_tim_auditor'));				  	;
				  	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderAuditor($toview,$toview['kd_order_sertifikasi'],false); 
					//echo "<script>alert('test disimpan')</script>";
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Order Komoditi ");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/OrderAuditor/'.$toview['kd_order_sertifikasi']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}else{ //echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		
		#judul
		$this->judul='Order Auditor';
		$this->javascript='
							<script type="text/javascript">
							$(document).ready(function(){
		
			var data = [';
			$result=$this->mAuditor->getAuditor('','');
			if($result){
				foreach($result as $row){
					$nama_auditor=str_replace("'"," ",$row->nama_auditor);
					$this->javascript.="{text:'".$nama_auditor."', url:'$row->kd_auditor'},\n";
				}
			}
			
			$this->javascript.='];
			
			$("#nama_auditor").autocomplete(data, {
			matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/orderAuditor/'.$kd_order_sertifikasi.'/\'  + item.url;
			});
			
		});
						</script>';
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_add_auditor',$toview);	
	}

public function delOrderAuditor($kd_order_sertifikasi='',$kd_auditor=''){
		$this->mOrder->deleteOrderauditor($kd_order_sertifikasi,$kd_auditor);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order auditor . ".$kd_auditor);
		redirect('order/orderAuditor/'.$kd_order_sertifikasi);
	}

public function orderJadwalDetail($kd_order_sertifikasi='',$kd_auditor=''){
	    $this->errormsg=""; $this->listKomoditi=""; //$this->list_customer="";
           	$counter=0;

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_auditor) $toveiw['kd_auditor']='';

	   	
		$toview['tgl_audit_jadwaldetail']='';
		$toview['waktu_audit_jadwaldetail']='';	   	
	   	$toview['deskripsi_audit_jadwaldetail']='';
	   	$toview['singkatan_nama_auditor']='';



		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;		
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	#get result
	   	$toview['totOrderAuditor']=$this->mOrder->getTotalOrderAuditor($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderAuditor']>0){
			$toview['pages']=ceil($toview['totOrderAuditor']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderAuditor']=$this->mOrder->getResultOrderAuditor($toview['kd_order_sertifikasi'],'','kd_auditor','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderAuditor']=false;
		}


		$toview['totOrderJadwalDetail']=$this->mOrder->getTotalOrderJadwalDetail($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderJadwalDetail']>0){
			$toview['pages']=ceil($toview['totOrderJadwalDetail']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderJadwalDetail']=$this->mOrder->getResultOrderJadwalDetail($toview['kd_order_sertifikasi'],'','tgl_audit_jadwaldetail','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderJadwalDetail']=false;
		}
		
		$this->form_validation->set_rules('tgl_audit_jadwaldetail', 'Tanggal Audit', 'required');
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
					$toview['kd_order_audit_jadwaldetail']=$this->mOrder->Make_kd_order_audit_jadwaldetail();
					$toview['tgl_audit_jadwaldetail']=trim($this->input->post('tgl_audit_jadwaldetail'));
					$toview['waktu_audit_jadwaldetail']=trim($this->input->post('waktu_audit_jadwaldetail'));
				   	$toview['deskripsi_audit_jadwaldetail']=trim($this->input->post('deskripsi_audit_jadwaldetail'));
				  	$toview['singkatan_nama_auditor']=trim($this->input->post('singkatan_nama_auditor'));		  	;
				  	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderJadwalDetail($toview,$toview['kd_order_sertifikasi'],false); 
					//echo "<script>alert('test disimpan')</script>";
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Order Komoditi ");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/orderJadwalDetail/'.$toview['kd_order_sertifikasi']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}else{ //echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		//echo base_url()."js/tiny_mce/tiny_mce.js";
		#judul
		$this->judul='Jadwal Detail Audit';
		$this->javascript=';
					<script type="text/javascript">
						$("#tgl_audit_jadwaldetail").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$(document).ready(function(){
       		 					$("textarea.tinymce").tinymce({
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
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_jadwal_detail',$toview);	
	}

	public function delOrderJadwalDetail($kd_order_sertifikasi='',$kd_order_audit_jadwaldetail=''){
		$this->mOrder->deleteOrderJadwalDetail($kd_order_sertifikasi,$kd_order_audit_jadwaldetail);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order auditor . ".$kd_order_audit_jadwaldetail);
		redirect('order/orderJadwalDetail/'.$kd_order_sertifikasi);
	}


	public function viewOrderSuratPenunjukan($kd_order_sertifikasi){
		$this->errormsg="";
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi; 
	   	else redirect('orderSertifikasi');

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
		$toview['email_kontak_perusahaan_pemohon']=$order->email_kontak_perusahaan_pemohon;

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
		$toview['tot']=$this->mOrder->getTotalOrderKomoditi($toview['kd_order_sertifikasi'],'');
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
				$toview['start']=($toview['page']-1)*$toview['limit'];
				$toview['resultOrderKomoditi']=$this->mOrder->getResultOrderKomoditi($toview['kd_order_sertifikasi'],'','kd_order_komoditi','desc',30,0);
		} else {
				$toview['pages']=0;
				$toview['page']=1;
				$toview['start']=0;
				$toview['resultOrderKomoditi']=false;
		}
		
		$toview['tot2']=$this->mOrder->getTotalOrderAuditor($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['tot2']>0){
			$toview['pages']=ceil($toview['tot2']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderAuditor']=$this->mOrder->getResultOrderAuditor($toview['kd_order_sertifikasi'],'','kd_auditor','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderAuditor']=false;
		}
		
		$jadwal=$this->mOrder->getOrderAudit($toview['kd_order_sertifikasi']);
		if($jadwal){
			$toview['kd_order_audit']=$jadwal->kd_order_audit;
			$toview['tgl_awal_audit']=$jadwal->tgl_awal_audit;
			$toview['tgl_ahir_audit']=$jadwal->tgl_ahir_audit;
			$toview['tgl_penunjukanauditor_audit']=$jadwal->tgl_penunjukanauditor_audit;
			$toview['nip_penunjukanauditor_audit']=$jadwal->nip_penunjukanauditor_audit;
			$toview['nama_penunjukanauditor_audit']=$jadwal->nama_penunjukanauditor_audit;
			$toview['kd_order_sertifikasi']=$jadwal->kd_order_sertifikasi;
		}else{
			$toview['kd_order_audit']='';
			$toview['tgl_awal_audit']='';
			$toview['tgl_ahir_audit']='';
			$toview['nip_penunjukanauditor_audit']='';
			$toview['nama_penunjukanauditor_audit']='';
			$toview['tgl_penunjukanauditor_audit']='';
		}

		#judul
		$this->judul='SURAT PENUNJUKAN AUDITOR / PPC';
		#load view
		if($this->session->flashdata('cetak')){
			$this->content=$this->load->view('cetak/print_view_order_surat_penunjukan',$toview);
		} else {
			$this->content=$this->load->view('order/sertifikasi/view_order_surat_penunjukan',$toview);
		}
	}

	public function orderAuditHasil($kd_order_sertifikasi='',$kd_audithasil='',$action=''){
	    $this->errormsg=""; $this->listKomoditi=""; //$this->list_customer="";
           	$counter=0;

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_audithasil) $toveiw['kd_audithasil']='';

	    $hasilaudit = $this->mOrder->getOrderAuditHasil($toview['kd_order_sertifikasi']);
	   	
	   	if($hasilaudit){
	   		$toview['kd_audithasil']=$hasilaudit->kd_audithasil;
	   		$toview['tgl_temuan_audithasil']=$hasilaudit->tgl_temuan_audithasil;
	   		$toview['tgl_diterima_audithasil']=$hasilaudit->tgl_diterima_audithasil;
			$toview['kd_order_audit']=$hasilaudit->kd_order_audit;	   	
	   		$toview['kd_order_sertifikasi']=$hasilaudit->kd_order_sertifikasi;
	   		$toview['tgl_create']=$hasilaudit->tgl_create;
	   		$toview['tgl_update']=$hasilaudit->tgl_update;
			$toview['kd_satker']=$hasilaudit->kd_satker;
	   	}else{
	   		$toview['kd_audithasil']='';
	   		$toview['tgl_temuan_audithasil']='';
	   		$toview['tgl_diterima_audithasil']='';
			$toview['kd_order_audit']='';	   	
	   		$toview['kd_order_sertifikasi']='';
	   		$toview['tgl_create']='';
	   		$toview['tgl_update']='';
			$toview['kd_satker']='';	
	   	}
		


	   	$jadwal=$this->mOrder->getOrderAudit($kd_order_sertifikasi);
	
		$toview['kd_order_audit']=$jadwal->kd_order_audit;
		$toview['tgl_awal_audit']=$jadwal->tgl_awal_audit;
		$toview['tgl_ahir_audit']=$jadwal->tgl_ahir_audit;
		$toview['tgl_penunjukanauditor_audit']=$jadwal->tgl_penunjukanauditor_audit;
		$toview['nip_penunjukanauditor_audit']=$jadwal->nip_penunjukanauditor_audit;
		$toview['nama_penunjukanauditor_audit']=$jadwal->nama_penunjukanauditor_audit;
		$toview['kd_order_sertifikasi']=$jadwal->kd_order_sertifikasi;
		$toview['kd_satker']=$jadwal->kd_satker;
		//$toview['edit']='edit';

		

		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;		
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	#get result
	   	$toview['totOrderAuditor']=$this->mOrder->getTotalOrderAuditor($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderAuditor']>0){
			$toview['pages']=ceil($toview['totOrderAuditor']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderAuditor']=$this->mOrder->getResultOrderAuditor($toview['kd_order_sertifikasi'],'','kd_auditor','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderAuditor']=false;
		}


	   		
	   		$toview['tgl_diterima_dari_perusahaan']='';
	   		$toview['tgl_diberikan_ke_auditor']='';
			$toview['tgl_diterima_dari_auditor']='';
			$toview['tgl_dkembalikan_ke_perusahaan']='';	   		   	
	   		$toview['status_perbaikanhasil']='';
	   		$toview['keterangan']='';
	   		$toview['kd_auditor']='';
	   

		$toview['totOrderAuditHasilPerbaikan']=$this->mOrder->getTotalOrderAuditHasilPerbaikan($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderAuditHasilPerbaikan']>0){
			$toview['pages']=ceil($toview['totOrderAuditHasilPerbaikan']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderAuditHasilPerbaikan']=$this->mOrder->getResultOrderAuditHasilPerbaikan($toview['kd_order_sertifikasi'],'','kd_audithasil','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderAuditHasilPerbaikan']=false;
		}
		if($this->input->post('tambah')){
			$this->form_validation->set_rules('tgl_temuan_audithasil', 'Tanggal Temuan', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');
		}else{
			$this->form_validation->set_rules('tgl_diterima_dari_perusahaan', 'Tanggal hasil Audit diterima dari auditor', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');

		}
		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		//echo "<script>alert('test save ? ')</script>";
		if($this->input->post('save')){
		  //echo "<script>alert('test input save true'".trim($this->input->post('save')).")</script>";
		  
		  if($this->form_validation->run())
		  {
			echo "<script>alert('test for falidasi true')</script>";
			if($this->input->post('tambah')){
				//echo "<script>alert('test for input post tambah true')</script>";
				if($this->errormsg=="") { 
				    //echo "<script>alert('test no error message true')</script>";	
					$toview['kd_audithasil']=$this->mOrder->Make_kd_audithasil();
					$toview['tgl_temuan_audithasil']=trim($this->input->post('tgl_temuan_audithasil'));
					$toview['tgl_diterima_audithasil']=trim($this->input->post('tgl_diterima_audithasil'));
				  	$toview['kd_order_audit']=trim($this->input->post('kd_order_audit')) ;	
				  	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderAuditHasil($toview,$toview['kd_order_sertifikasi'],false); 
					//echo "<script>alert('test disimpan')</script>";
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Audit Hasil ");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/orderAuditHasil/'.$toview['kd_order_sertifikasi']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}else{ //echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }//else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  //}
			  elseif($this->input->post('tambahperbaikan')){
				//echo "<script>alert('test for input post tambahperbaikan true')</script>";
				if($this->errormsg=="") { 
				    //echo "<script>alert('test no error message true')</script>";	
					$toview['kd_perbaiakanhasil']=$this->mOrder->Make_kd_perbaikanhasil();
					$toview['kd_audithasil']=trim($this->input->post('kd_audithasil'));
					$toview['tgl_diterima_dari_perusahaan']=trim($this->input->post('tgl_diterima_dari_perusahaan'));
					$toview['tgl_diberikan_ke_auditor']=trim($this->input->post('tgl_diberikan_ke_auditor'));
					$toview['tgl_diterima_dari_auditor']=trim($this->input->post('tgl_diterima_dari_auditor'));
					$toview['tgl_dkembalikan_ke_perusahaan']=trim($this->input->post('tgl_dkembalikan_ke_perusahaan'));
					$toview['status_perbaikanhasil']=trim($this->input->post('status_perbaikanhasil'));
					$toview['keterangan']=trim($this->input->post('keterangan'));
					$toview['kd_auditor']=trim($this->input->post('kd_auditor'));
				  	$toview['kd_order_audit']=trim($this->input->post('kd_order_audit')) ;	
				  	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderAuditHasilPerbaikan($toview,$toview['kd_order_sertifikasi'],false); 
					//echo "<script>alert('test disimpan')</script>";
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Audit Hasil ");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/orderAuditHasil/'.$toview['kd_order_sertifikasi']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}else{ echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah perbaiakan false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		//echo base_url()."js/tiny_mce/tiny_mce.js";
		#judul
		$this->judul='Hasil Audit';
		$this->javascript=';
					<script type="text/javascript">
						$("#tgl_diterima_audithasil").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_temuan_audithasil").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_diterima_dari_perusahaan").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_diberikan_ke_auditor").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_diterima_dari_auditor").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_dkembalikan_ke_perusahaan").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$(document).ready(function(){
       		 					$("textarea.tinymce").tinymce({
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
		
		#load view

		if($action==="addPerbaikan"){
			#judul
			$this->judul='<center>Tambah Tindakan Perbaikan</center>';
			#load view
			$this->content=$this->load->view('order/sertifikasi/order_audit_hasilperbaikan',$toview);
		}
	   	elseif($action==="delPerbaikan"){
			$tot=$this->mAuditor->deleteAuditor($kd_auditor);
			if($tot){
				redirect('order/orderAuditHasil/'.$toview['kd_order_sertifikasi']);
			}
			
		}else $this->content=$this->load->view('order/sertifikasi/order_audit_hasil',$toview);	
	}
	public function delOrderAuditHasil($kd_order_sertifikasi='',$kd_audithasil=''){
		$this->mOrder->deleteOrderAuditHasil($kd_order_sertifikasi,$kd_audithasil);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Audit Hasil . ".$kd_audithasil);
		redirect('order/orderAuditHasil/'.$kd_order_sertifikasi);
	}

	public function delOrderAuditHasilPerbaikan($kd_order_sertifikasi='',$kd_audithasilperbaikan=''){
		$this->mOrder->deleteOrderAuditHasilPerbaikan($kd_order_sertifikasi,$kd_audithasilperbaikan);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Audit Hasil . ".$kd_audithasilperbaikan);
		redirect('order/orderAuditHasil/'.$kd_order_sertifikasi);
	}


	public function orderAuditHasilPerTemuan($kd_order_sertifikasi='',$kd_audithasil=''){
	    $this->errormsg=""; $this->listKomoditi=""; //$this->list_customer="";
           	$counter=0;

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_audithasil) $toveiw['kd_audithasil']='';

	   	
		$toview['tgl_diterima_audithasil']='';
		$toview['lokasi_audithasil']='';	   	
	   	$toview['referensi_audithasil']='';
	   	$toview['standard_audithasil']='';
	   	$toview['tgl_temuan_audithasil']='';
		$toview['tgl_targert_penyelesaian_audithasil']='';	   	
	   	$toview['temuan_audihasil']='';
	   	$toview['kategori_temuan_audithasil']='';
	   	$toview['status_temuan_audithasil']='';

	   	$toview['tgl_terima_tindakanperbaikan_audithasil']='';
		$toview['tgl_tindakanperbaikan_audithasil']='';	   	
	   	$toview['tindakanperbaikan_audithasil']='';
	   	$toview['tgl_verifikasi_tindakanperbaikan_audithasil']='';
	   	$toview['nip_tindakanperbaikan_audithasil']='';
	   	$toview['nama_tindakanperbaikan_audithasil']='';


	   	$toview['kd_auditor']='';


	   	$jadwal=$this->mOrder->getOrderAudit($toview['kd_order_sertifikasi']);
		if($jadwal){
			$toview['kd_order_audit']=$jadwal->kd_order_audit;
			$toview['tgl_awal_audit']=$jadwal->tgl_awal_audit;
			$toview['tgl_ahir_audit']=$jadwal->tgl_ahir_audit;
			$toview['tgl_penunjukanauditor_audit']=$jadwal->tgl_penunjukanauditor_audit;
			$toview['nip_penunjukanauditor_audit']=$jadwal->nip_penunjukanauditor_audit;
			$toview['nama_penunjukanauditor_audit']=$jadwal->nama_penunjukanauditor_audit;
			$toview['kd_order_sertifikasi']=$jadwal->kd_order_sertifikasi;
			$toview['kd_satker']=$jadwal->kd_satker;
			$toview['edit']='edit';

		}else{
			$toview['kd_order_audit']='';
			$toview['tgl_awal_audit']='';
			$toview['tgl_ahir_audit']='';
			$toview['tgl_penunjukanauditor_audit']='';
			$toview['nip_penunjukanauditor_audit']='';
			$toview['nama_penunjukanauditor_audit']='';
		}
	   	

		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;		
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	#get result
	   	$toview['totOrderAuditor']=$this->mOrder->getTotalOrderAuditor($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderAuditor']>0){
			$toview['pages']=ceil($toview['totOrderAuditor']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderAuditor']=$this->mOrder->getResultOrderAuditor($toview['kd_order_sertifikasi'],'','kd_auditor','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderAuditor']=false;
		}


		$toview['totOrderAuditHasilPerTemuan']=$this->mOrder->getTotalOrderAuditHasilPerTemuan($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderAuditHasilPerTemuan']>0){
			$toview['pages']=ceil($toview['totOrderAuditHasilPerTemuan']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderAuditHasilPerTemuan']=$this->mOrder->getResultOrderAuditHasilPerTemuan($toview['kd_order_sertifikasi'],'','kd_audithasil','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderAuditHasilPerTemuan']=false;
		}
		
		$this->form_validation->set_rules('tgl_diterima_audithasil', 'Tanggal Audit diterima dari auditor', 'required');
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
					$toview['kd_audithasil']=$this->mOrder->Make_kd_audithasil();
					$toview['tgl_diterima_audithasil']=trim($this->input->post('tgl_diterima_audithasil'));
					$toview['lokasi_audithasil']=trim($this->input->post('lokasi_audithasil'));
				   	$toview['referensi_audithasil']=trim($this->input->post('referensi_audithasil'));
				  	$toview['standard_audithasil']=trim($this->input->post('standard_audithasil'));	
				  	$toview['tgl_temuan_audithasil']=trim($this->input->post('tgl_temuan_audithasil'));	
				  	$toview['tgl_targert_penyelesaian_audithasil']=trim($this->input->post('tgl_targert_penyelesaian_audithasil'));
				  	$toview['temuan_audihasil']=trim($this->input->post('temuan_audihasil'));	
				  	$toview['kategori_temuan_audithasil']=trim($this->input->post('kategori_temuan_audithasil'));
				  	$toview['status_temuan_audithasil']=trim($this->input->post('status_temuan_audithasil')) ;

				  	$toview['tgl_terima_tindakanperbaikan_audithasil']=trim($this->input->post('tgl_terima_tindakanperbaikan_audithasil'));
					$toview['tgl_tindakanperbaikan_audithasil']=trim($this->input->post('tgl_tindakanperbaikan_audithasil'));   	
	   				$toview['tindakanperbaikan_audithasil']=trim($this->input->post('tindakanperbaikan_audithasil'));
	   				$toview['tgl_verifikasi_tindakanperbaikan_audithasil']=trim($this->input->post('tgl_verifikasi_tindakanperbaikan_audithasil'));
	   				$toview['nip_tindakanperbaikan_audithasil']=trim($this->input->post('nip_tindakanperbaikan_audithasil'));
	   				$toview['nama_tindakanperbaikan_audithasil']=trim($this->input->post('nama_tindakanperbaikan_audithasil'));

				  	$toview['kd_auditor']=trim($this->input->post('kd_auditor')) ;	
				  	$toview['kd_order_audit']=trim($this->input->post('kd_order_audit')) ;	
				  	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderAuditHasilPerTemuan($toview,$toview['kd_order_sertifikasi'],false); 
					//echo "<script>alert('test disimpan')</script>";
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Order Komoditi ");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/orderAuditHasilPerTemuan/'.$toview['kd_order_sertifikasi']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}else{ //echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		//echo base_url()."js/tiny_mce/tiny_mce.js";
		#judul
		$this->judul='Hasil Audit';
		$this->javascript=';
					<script type="text/javascript">
						$("#tgl_diterima_audithasil").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_temuan_audithasil").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_targert_penyelesaian_audithasil").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_terima_tindakanperbaikan_audithasil").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_tindakanperbaikan_audithasil").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_verifikasi_tindakanperbaikan_audithasil").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$(document).ready(function(){
       		 					$("textarea.tinymce").tinymce({
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
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_audit_hasil_pertemuan',$toview);	
	}

	public function delOrderAuditHasilPerTemuan($kd_order_sertifikasi='',$kd_audithasil=''){
		$this->mOrder->deleteOrderAuditHasil($kd_order_sertifikasi,$kd_audithasil);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Audit Hasil . ".$kd_audithasil);
		redirect('order/orderAuditHasil/'.$kd_order_sertifikasi);
	}

	public function orderAuditSHU($kd_order_sertifikasi='',$kd_order_audit=''){
	    $this->errormsg=""; $this->listKomoditi=""; //$this->list_customer="";
           	$counter=0;

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_order_audit) $toveiw['kd_order_audit']='';

	   	
		$toview['no_bhpc']='';
		$toview['no_shu']='';	   	
	   	$toview['tgl_shu']='';
	   	$toview['tgl_diterima_shu']='';
	   	$toview['file_SHU']='';


	   	$jadwal=$this->mOrder->getOrderAudit($toview['kd_order_sertifikasi']);
		if($jadwal){
			$toview['kd_order_audit']=$jadwal->kd_order_audit;
			$toview['tgl_awal_audit']=$jadwal->tgl_awal_audit;
			$toview['tgl_ahir_audit']=$jadwal->tgl_ahir_audit;
			$toview['tgl_penunjukanauditor_audit']=$jadwal->tgl_penunjukanauditor_audit;
			$toview['nip_penunjukanauditor_audit']=$jadwal->nip_penunjukanauditor_audit;
			$toview['nama_penunjukanauditor_audit']=$jadwal->nama_penunjukanauditor_audit;
			$toview['kd_order_sertifikasi']=$jadwal->kd_order_sertifikasi;
			$toview['kd_satker']=$jadwal->kd_satker;
			$toview['edit']='edit';

		}else{
			$toview['kd_order_audit']='';
			$toview['tgl_awal_audit']='';
			$toview['tgl_ahir_audit']='';
			$toview['tgl_penunjukanauditor_audit']='';
			$toview['nip_penunjukanauditor_audit']='';
			$toview['nama_penunjukanauditor_audit']='';
		}
	   	

		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;		
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	


		$toview['totOrderAuditHasil']=$this->mOrder->getTotalOrderAuditSHU($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderAuditHasil']>0){
			$toview['pages']=ceil($toview['totOrderAuditHasil']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderAuditSHU']=$this->mOrder->getResultOrderAuditSHU($toview['kd_order_sertifikasi'],'','no_shu','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderAuditSHU']=false;
		}
		
		$this->form_validation->set_rules('no_bhpc', 'No BHPC', 'required');
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
				    //echo "<script>alert('test no error message true')</script>";\
				    $toview['kd_order_audit_shu']=$this->mOrder->Make_kd_order_audit_shu();	
					$toview['kd_order_audit']=trim($this->input->post('kd_order_audit'));
					$toview['no_bhpc']=trim($this->input->post('no_bhpc'));
					$toview['no_shu']=trim($this->input->post('no_shu'));
				   	$toview['tgl_shu']=trim($this->input->post('tgl_shu'));
				   	$toview['tgl_diterima_shu']=trim($this->input->post('tgl_diterima_shu'));
				  	$toview['file_SHU']=trim($this->input->post('file_SHU'));
				  	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderAuditSHU($toview,$toview['kd_order_sertifikasi'],false); 
					//echo "<script>alert('test disimpan')</script>";
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Order Komoditi ");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/orderAuditSHU/'.$toview['kd_order_sertifikasi']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}else{ //echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		//echo base_url()."js/tiny_mce/tiny_mce.js";
		#judul
		$this->judul='Hasil Audit';
		$this->javascript=';
					<script type="text/javascript">
						$("#tgl_shu").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						
						$("#tgl_diterima_shu").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
					</script>';
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_audit_SHU',$toview);	
	}

	public function delOrderAuditSHU($kd_order_sertifikasi='',$kd_order_audit_shu=''){
		$this->mOrder->deleteOrderAuditSHU($kd_order_sertifikasi,$kd_order_audit_shu);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order SHU . ".$kd_order_audit_shu);
		redirect('order/orderAuditSHU/'.$kd_order_sertifikasi);
	}

	public function orderEvaluasi($kd_order_sertifikasi='',$kd_order_evaluasi=''){
	    $this->errormsg=""; 
           	$counter=0;

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_order_evaluasi) $toveiw['kd_order_evaluasi']='';

	   	
		$toview['tgl_evaluasi']='';
		$toview['no_evaluasi']='';	   	
	   	$toview['isi_evaluasi']='';
	   	$toview['keputusan_evaluasi']='';
	   	$toview['file_evaluasii']='';

		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;		
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	


		$toview['totOrderEvaluasi']=$this->mOrder->getTotalOrderEvaluasi($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderEvaluasi']>0){
			$toview['pages']=ceil($toview['totOrderEvaluasi']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderEvaluasi']=$this->mOrder->getResultOrderEvaluasi($toview['kd_order_sertifikasi'],'','tgl_evaluasi','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderEvaluasi']=false;
		}
		
		$this->form_validation->set_rules('tgl_evaluasi', 'Tanggal Evaluasi', 'required');
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
						$toview['file_evaluasi']=trim($this->input->post('userfile'));
						$toview['kd_order_evaluasi']=$this->mOrder->Make_kd_order_evaluasi();	
						$toview['tgl_evaluasi']=trim($this->input->post('tgl_evaluasi'));
						$toview['no_evaluasi']=trim($this->input->post('no_evaluasi'));
						$toview['isi_evaluasi']=trim($this->input->post('isi_evaluasi'));
				   		$toview['keputusan_evaluasi']=trim($this->input->post('keputusan_evaluasi'));
				  		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
						$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				if($this->errormsg=="") { 
						

						/*$file_dir='./download/evaluasi/'.date('Y-m').'/';
						if(!file_exists($file_dir)) {
								mkdir($file_dir);
						}else {
								
								echo "<script>alert('Ok.file direktori sudah ada')</script>";
								$file_dir =$file_dir;

						}
						
						
						$syxupload['upload_path'] = $file_dir;
						$syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
						$syxupload['max_size']	= '2500';
						//$syxupload['max_width']  = '1024';
						//$syxupload['max_height']  = '768';
	
						$this->load->library('upload', $syxupload);
						if (! $this->upload->do_upload())
						{
							$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
						}else{*/
				    		//echo "<script>alert('test no error message true')</script>";\
							//$data = array('upload_data' => $this->upload->data());
							//$toview['file_evaluasi']=$file_dir.$data['upload_data']['file_name'];				    		
									
							$hasil=$this->mOrder->saveOrderEvaluasi($toview,$toview['kd_order_sertifikasi'],false); 
							//echo "<script>alert('test disimpan')</script>";
							if($hasil) { 
								$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
								current_url(),"Order Evaluasi ");
								$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
								//echo "<script>alert('Berhasil disimpan')</script>";
								redirect('order/orderEvaluasi/'.$toview['kd_order_sertifikasi']);
							} else { 
								$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
								//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
								redirect(current_url());
							}
						//}
					}else{ //echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		
		
		#judul
		$this->judul='Hasil Audit';
		$this->javascript=';
					<script type="text/javascript">
						$("#tgl_evaluasi").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						
						
					</script>';
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_evaluasi',$toview);	
	}

	public function delOrderEvaluasi($kd_order_sertifikasi='',$kd_order_evaluasi=''){
		$this->mOrder->deleteOrderEvaluasi($kd_order_sertifikasi,$kd_order_evaluasi);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Evaluasi. ".$kd_order_evaluasi);
		redirect('order/orderEvaluasi/'.$kd_order_sertifikasi);
	}

	public function orderTimTeknis($kd_order_sertifikasi='',$kd_auditor=''){
	    $this->errormsg=""; $this->listKomoditi=""; //$this->list_customer="";
           	$counter=0;

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_auditor) $toveiw['kd_auditor']='';

	   	if($kd_auditor){
			 $auditorna=$this->mAuditor->readAuditor($kd_auditor);
			 $toview['kd_auditor']=$auditorna->kd_auditor;
			 $toview['nama_auditor']=$auditorna->nama_auditor;
			 $toview['singkatan_nama_auditor']=$auditorna->singkatan_nama_auditor;
			 $toview['jabatan_auditor']=$auditorna->jabatan_auditor;
			 $toview['posisi_tim_auditor']='';
	   		 $toview['kd_satker']=$auditorna->kd_satker;

		} else {
			 	$toview['kd_auditor']='';
	   			$toview['nama_auditor']='';
				$toview['singkatan_nama_auditor']='';	   	
	   			$toview['jabatan_auditor']='';
	   			$toview['posisi_tim_auditor']='';
	   			
		}
	   		
		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;		
	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;
	   	#get result/
		$toview['tot']=$this->mOrder->getTotalOrderTimTeknis($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mOrder->getResultOrderTimTeknis($toview['kd_order_sertifikasi'],'','kd_order_timteknis','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['result']=false;
		}
		
		$this->form_validation->set_rules('nama_auditor', 'Nama Auditor', 'required');
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
					$toview['kd_order_timteknis']=$this->mOrder->Make_kd_order_timteknis();
					$toview['kd_auditor']=trim($this->input->post('kd_auditor'));
					$toview['nama_auditor']=trim($this->input->post('nama_auditor'));
				   	$toview['singkatan_nama_auditor']=trim($this->input->post('singkatan_nama_auditor'));
				  	$toview['jabatan_auditor']=trim($this->input->post('jabatan_auditor'));
				  	$toview['posisi_tim_auditor']=trim($this->input->post('posisi_tim_auditor'));				  	;
				  	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
					$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
									
					$hasil=$this->mOrder->saveOrderTimTeknis($toview,$toview['kd_order_sertifikasi'],false); 
					//echo "<script>alert('test disimpan')</script>";
					if($hasil) { 
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Order Time teknis / evaluasi ");
						$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
						//echo "<script>alert('Berhasil disimpan')</script>";
						redirect('order/orderTimTeknis/'.$toview['kd_order_sertifikasi']);
					} else { 
						$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
						//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
						redirect(current_url());
					}
				}else{ //echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		
		#judul
		$this->judul='Order Tim Teknis /Evaluasi';
		$this->javascript='
							<script type="text/javascript">
							$(document).ready(function(){
		
			var data = [';
			$result=$this->mAuditor->getAuditor('','');
			if($result){
				foreach($result as $row){
					$nama_auditor=str_replace("'"," ",$row->nama_auditor);
					$this->javascript.="{text:'".$nama_auditor."', url:'$row->kd_auditor'},\n";
				}
			}
			
			$this->javascript.='];
			
			$("#nama_auditor").autocomplete(data, {
			matchContains: true,
			  formatItem: function(item) {
				return item.text;
			  }
			}).result(function(event, item) {
			  location.href = \'index.php/order/orderTimTeknis/'.$kd_order_sertifikasi.'/\'  + item.url;
			});
			
		});
						</script>';
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_add_evaluator',$toview);	
	}

public function delOrderTimTeknis($kd_order_sertifikasi='',$kd_order_timteknis=''){
		$this->mOrder->deleteOrderTimTeknis($kd_order_sertifikasi,$kd_order_timteknis);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order anggota tim teknis . ".$kd_order_timteknis);
		redirect('order/orderTimTeknis/'.$kd_order_sertifikasi);
	}

public function orderSertifikat($kd_order_sertifikasi='',$kd_sertifikat=''){
	    $this->errormsg="";          

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_sertifikat) $toveiw['kd_order_evaluasi']=$kd_sertifikat;
	    else $toveiw['kd_order_evaluasi']='';

		$toview['no_sertifikat']='';
		$toview['file_sertifikat']='';	   	
	   	$toview['tgl_cetak_sertifikat']='';
	   	$toview['tgl_awal_berlaku_sertifikat']='';
	   	$toview['tgl_akhir_berlaku_sertifikat']='';
	   	$toview['nama_penandatangan_sertifikat']='';
	   	$toview['tgl_penandatangan_sertifikat']='';
	   	$toview['tgl_serah_sertifikat']='';
	   	$toview['metode_serah_sertifikat']='';
	   	$toview['nip_penyerah_sertifikat']='';
	   	$toview['nama_penyerah_sertifikat']='';
	   	$toview['nama_penerima_sertifikat']='';
		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	

	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;

		$toview['totOrderSertifikat']=$this->mOrder->getTotalOrderSertifikat($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderSertifikat']>0){
			$toview['pages']=ceil($toview['totOrderSertifikat']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderSertifikat']=$this->mOrder->getResultOrderSertifikat($toview['kd_order_sertifikasi'],'','kd_sertifikat','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderSertifikat']=false;
		}
		
		$this->form_validation->set_rules('no_sertifikat', 'No Sertifikat', 'required');
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
						$toview['kd_sertifikat']=$this->mOrder->Make_kd_sertifikat();	
						$toview['no_sertifikat']=trim($this->input->post('no_sertifikat'));						
						$toview['file_sertifikat']=trim($this->input->post('file_sertifikat'));
						$toview['tgl_cetak_sertifikat']=trim($this->input->post('tgl_cetak_sertifikat'));
						$toview['tgl_awal_berlaku_sertifikat']=trim($this->input->post('tgl_awal_berlaku_sertifikat'));
	   					$toview['tgl_akhir_berlaku_sertifikat']=trim($this->input->post('tgl_akhir_berlaku_sertifikat'));
						$toview['nama_penandatangan_sertifikat']=trim($this->input->post('nama_penandatangan_sertifikat'));
				   		$toview['tgl_penandatangan_sertifikat']=trim($this->input->post('tgl_penandatangan_sertifikat'));

				  		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
						$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				if($this->errormsg=="") { 
						

						/*$file_dir='./download/evaluasi/'.date('Y-m').'/';
						if(!file_exists($file_dir)) {
								mkdir($file_dir);
						}else {
								
								echo "<script>alert('Ok.file direktori sudah ada')</script>";
								$file_dir =$file_dir;

						}
						
						
						$syxupload['upload_path'] = $file_dir;
						$syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
						$syxupload['max_size']	= '2500';
						//$syxupload['max_width']  = '1024';
						//$syxupload['max_height']  = '768';
	
						$this->load->library('upload', $syxupload);
						if (! $this->upload->do_upload())
						{
							$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
						}else{*/
				    		//echo "<script>alert('test no error message true')</script>";\
							//$data = array('upload_data' => $this->upload->data());
							//$toview['file_evaluasi']=$file_dir.$data['upload_data']['file_name'];				    		
									
							$hasil=$this->mOrder->saveOrderSertifikat($toview,$toview['kd_order_sertifikasi'],false); 
							//echo "<script>alert('test disimpan')</script>";
							if($hasil) { 
								$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
								current_url(),"Order ESertifikasi ");
								$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
								//echo "<script>alert('Berhasil disimpan')</script>";
								redirect('order/orderSertifikat/'.$toview['kd_order_sertifikasi']);
							} else { 
								$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
								//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
								redirect(current_url());
							}
						//}
					}else{ 
						//echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		
		
		#judul
		$this->judul='Hasil Audit';
		$this->javascript=';
					<script type="text/javascript">
						$("#tgl_cetak_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_penandatangan_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_serah_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_awal_berlaku_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_akhir_berlaku_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						
					</script>';
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_sertifikat',$toview);	
	}

	public function delOrderSertifikat($kd_order_sertifikasi='',$kd_sertifikat=''){
		$this->mOrder->deleteOrderSertifikat($kd_order_sertifikasi,$kd_sertifikat);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Evaluasi. ".$kd_sertifikat);
		redirect('order/orderSertifikat/'.$kd_order_sertifikasi);
	}

	public function orderSerahTerima($kd_order_sertifikasi='',$kd_sertifikat=''){
	    $this->errormsg="";          

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_sertifikat) $toveiw['kd_sertifikat']=$kd_sertifikat;   

		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	

	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;

		$toview['totOrderSertifikat']=$this->mOrder->getTotalOrderSertifikat($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderSertifikat']>0){
			$toview['pages']=ceil($toview['totOrderSertifikat']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderSertifikat']=$this->mOrder->getResultOrderSertifikat($toview['kd_order_sertifikasi'],'','kd_sertifikat','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderSertifikat']=false;
		}
		
		$this->form_validation->set_rules('no_sertifikat', 'No Sertifikat', 'required');
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
						$toview['kd_sertifikat']=$this->mOrder->Make_kd_sertifikat();	
						$toview['no_sertifikat']=trim($this->input->post('no_sertifikat'));						
						$toview['file_sertifikat']=trim($this->input->post('file_sertifikat'));
						$toview['tgl_cetak_sertifikat']=trim($this->input->post('tgl_cetak_sertifikat'));
						$toview['nama_penandatangan_sertifikat']=trim($this->input->post('nama_penandatangan_sertifikat'));
				   		$toview['tgl_penandatangan_sertifikat']=trim($this->input->post('tgl_penandatangan_sertifikat'));

				  		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
						$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				if($this->errormsg=="") { 
						

						/*$file_dir='./download/evaluasi/'.date('Y-m').'/';
						if(!file_exists($file_dir)) {
								mkdir($file_dir);
						}else {
								
								echo "<script>alert('Ok.file direktori sudah ada')</script>";
								$file_dir =$file_dir;

						}
						
						
						$syxupload['upload_path'] = $file_dir;
						$syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
						$syxupload['max_size']	= '2500';
						//$syxupload['max_width']  = '1024';
						//$syxupload['max_height']  = '768';
	
						$this->load->library('upload', $syxupload);
						if (! $this->upload->do_upload())
						{
							$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
						}else{*/
				    		//echo "<script>alert('test no error message true')</script>";\
							//$data = array('upload_data' => $this->upload->data());
							//$toview['file_evaluasi']=$file_dir.$data['upload_data']['file_name'];				    		
									
							$hasil=$this->mOrder->saveOrderSertifikat($toview,$toview['kd_order_sertifikasi'],true); 
							//echo "<script>alert('test disimpan')</script>";
							if($hasil) { 
								$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
								current_url(),"Order ESertifikasi ");
								$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
								//echo "<script>alert('Berhasil disimpan')</script>";
								redirect('order/orderSertifikat/'.$toview['kd_order_sertifikasi']);
							} else { 
								$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
								//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
								redirect(current_url());
							}
						//}
					}else{ 
						//echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		
		
		#judul
		$this->judul='Serah terima';
		$this->javascript=';
					<script type="text/javascript">
						$("#tgl_cetak_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_penandatangan_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_serah_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						
					</script>';
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_serahterima_sertifikat',$toview);	
	}

	public function delOrderSerahTerima($kd_order_sertifikasi='',$kd_sertifikat=''){
		$this->mOrder->deleteOrderSerahTerima($kd_order_sertifikasi,$kd_sertifikat);
		$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
			current_url(),"Hapus Order Evaluasi. ".$kd_sertifikat);
		redirect('order/orderSertifikat/'.$kd_order_sertifikasi);
	}


	public function orderSerahTerimaProses($kd_order_sertifikasi='',$kd_sertifikat='',$action=''){
	    $this->errormsg="";          

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_sertifikat) $toveiw['kd_sertifikat']=$kd_sertifikat;
	   
	   	$sertifikat=$this->mOrder->getOrderSertifikat($toview['kd_order_sertifikasi'],$toveiw['kd_sertifikat']);
	   	$toview['kd_sertifikat']=$sertifikat->kd_sertifikat;
		$toview['no_sertifikat']=$sertifikat->no_sertifikat;
		$toview['file_sertifikat']=$sertifikat->tgl_cetak_sertifikat;	   	
	   	$toview['tgl_cetak_sertifikat']=$sertifikat->tgl_cetak_sertifikat;
	   	$toview['tgl_awal_berlaku_sertifikat']=$sertifikat->tgl_awal_berlaku_sertifikat;
	   	$toview['tgl_akhir_berlaku_sertifikat']=$sertifikat->tgl_akhir_berlaku_sertifikat;
	   	$toview['nama_penandatangan_sertifikat']=$sertifikat->nama_penandatangan_sertifikat;
	   	$toview['tgl_penandatangan_sertifikat']=$sertifikat->tgl_penandatangan_sertifikat;
	   	$toview['tgl_serah_sertifikat']=$sertifikat->tgl_serah_sertifikat;
	   	$toview['metode_serah_sertifikat']=$sertifikat->metode_serah_sertifikat;
	   	$toview['nip_penyerah_sertifikat']=$sertifikat->nip_penyerah_sertifikat;
	   	$toview['nama_penyerah_sertifikat']=$sertifikat->nama_penyerah_sertifikat;
	   	$toview['nama_penerima_sertifikat']=$sertifikat->nama_penerima_sertifikat;
	   	$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
		$toview['kd_satker']=$sertifikat->kd_satker;
	   
		$this->form_validation->set_rules('tgl_serah_sertifikat', 'Tanggal Serah Terima sertifikat', 'required');
		$this->form_validation->set_rules('nama_penyerah_sertifikat', 'Nama penyerah Sertifikat', 'required');
		$this->form_validation->set_rules('nama_penerima_sertifikat', 'Nama Penerima sertifikat', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		
		//echo "<script>alert('test save ? ')</script>";
		if($this->input->post('save')){
		  //echo "<script>alert('test input save true'".trim($this->input->post('save')).")</script>";
		  if($this->form_validation->run())
		  {
			//echo "<script>alert('test for falidasi true')</script>";
			if($this->input->post('edit')){
				//echo "<script>alert('test for input post tambah true')</script>";
						$toview['kd_sertifikat']=$sertifikat->kd_sertifikat;
						$toview['no_sertifikat']=$sertifikat->no_sertifikat;
						$toview['file_sertifikat']=$sertifikat->tgl_cetak_sertifikat;	   	
	   					$toview['tgl_cetak_sertifikat']=$sertifikat->tgl_cetak_sertifikat;
	   					$toview['tgl_awal_berlaku_sertifikat']=$sertifikat->tgl_awal_berlaku_sertifikat;
	   					$toview['tgl_akhir_berlaku_sertifikat']=$sertifikat->tgl_akhir_berlaku_sertifikat;
	   					$toview['nama_penandatangan_sertifikat']=$sertifikat->nama_penandatangan_sertifikat;
	   					$toview['tgl_penandatangan_sertifikat']=$sertifikat->tgl_penandatangan_sertifikat;
						$toview['tgl_serah_sertifikat']=trim($this->input->post('tgl_serah_sertifikat'));						
						$toview['metode_serah_sertifikat']=trim($this->input->post('metode_serah_sertifikat'));
						$toview['nip_penyerah_sertifikat']=trim($this->input->post('nip_penyerah_sertifikat'));
						$toview['nama_penyerah_sertifikat']=trim($this->input->post('nama_penyerah_sertifikat'));
				   		$toview['nama_penerima_sertifikat']=trim($this->input->post('nama_penerima_sertifikat'));
				   		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
						$toview['kd_satker']=$sertifikat->kd_satker;
						$toview['tgl_create']=$sertifikat->tgl_create;
						//$toview['edit']=trim($this->input->post('edit'));
				  		
						
				if($this->errormsg=="") { 		
							//echo "<script>alert('error 0')</script>";
							$hasil1=$this->mOrder->saveOrderSertifikat($toview,$toview['kd_order_sertifikasi'],true); 
							//echo "<script>alert('test disimpan')</script>";
							if($hasil1) {
								//echo "<script>alert('test Update oK')</script>";
								$this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
								$toview['status_order_sertifikasi']='Closed';
								$hasil2=$this->mOrder->saveOrderSertifikasi("Closed",$kd_order_sertifikasi,true);  
								$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
								current_url(),"Order ESertifikasi ");
								$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
								//echo "<script>alert('Berhasil disimpan')</script>";
								redirect('order/orderSerahTerima/'.$toview['kd_order_sertifikasi']);
							} else { 
								$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
								//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
								redirect(current_url());
							}
						//}
					}else{ 
						//echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		
		

		#judul
		$this->judul='Serah terima';
		$this->javascript=';
					<script type="text/javascript">
						$("#tgl_cetak_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_penandatangan_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_serah_sertifikat").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						
					</script>';
		
		#load view
		if($action==="proses"){
			#judul
			$this->judul='<center>sertfikat Nomor : '.$toview['no_sertifikat'].'</center>';
			#load view
			$this->content=$this->load->view('order/sertifikasi/order_serahterimaproses_sertifikat',$toview);	
		}else if($action==="view"){
			#judul
			$this->judul='<center>Daftar Sertifikat  </center>';
			#load view
			$this->content=$this->load->view('order/sertifikasi/order_serahterima_sertifikat',$toview);	
		}
		
	}

	public function orderClosed($kd_order_sertifikasi=''){
		if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	   
	   
	    $order=$this->mOrder->getOrderSertifikasi($kd_order_sertifikasi,'');		
		$toview['kd_order_sertifikasi']=$order->kd_order_sertifikasi;
		$toview['status_order_sertifikasi']=$order->status_order_sertifikasi;
		#judul
		$this->judul='<font color="red"><H1><center>Order Closed</center></H1>';
		$this->content=$this->load->view('order/sertifikasi/administrator/order_closed_administrator',$toview);	
	}

}
?>
