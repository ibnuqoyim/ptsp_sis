<?php
class mSHU extends CI_Model {
    var $result;
    function __construct()
    {
        parent::__construct();
    }
	
    function getSHU($kd_shu='',$no_shu='',$no_pengujian='',$kd_order='') {
	if($this->session->userdata('profil')->groupname != 'super') 
	$this->db->where('order_shu.kd_satker',$this->session->userdata('profil')->kd_satker);
	if($kd_shu) $this->db->where('order_shu.kd_shu',$kd_shu);
	if($no_shu) $this->db->where('order_shu.no_shu',$no_shu);
	if($no_pengujian) $this->db->where('order_shu.no_pengujian',$no_pengujian);
	if($kd_order) $this->db->where('order_shu.kd_order',$kd_order);
	//echo "<script>alert(".$no_shu.")</script>";
	//$this->db->join('work_order_pengujian','order_shu.kd_order=work_order_pengujian.kd_order');
	//$this->db->join('order_detail_pengujian','order_shu.kd_detail_order=order_detail_pengujian.kd_detail_order');
        $query = $this->db->get('order_shu');
        if( $query->num_rows() > 0 ) {
            if($kd_shu) return $query->row();
	    else if($no_shu) return $query->row();
	    else if($no_pengujian) return $query->row();	  
	    else return $query->result();	 
        } else {
            return false;
        }
    }

	function GetTotal($no_shu,$no_pengujian,$kd_order,$tgl_cetak,$file_shu){
		if($this->session->userdata('profil')->groupname != 'super') 
		$this->db->where('order_shu.kd_satker',$this->session->userdata('profil')->kd_satker);
		if($no_shu){$this->db->like('order_shu.no_shu',$no_shu);}
		if($no_pengujian){$this->db->like('order_shu.no_pengujian',$no_pengujian);}
		if($kd_order){$this->db->like('order_shu.kd_order',$kd_order);}
		if($tgl_cetak){$this->db->like('order_shu.tgl_cetak',$tgl_cetak);}
		if($file_shu){$this->db->like('order_shu.file_shu',$file_shu);}
		$this->db->from('order_shu');
		//$this->db->join('work_order_pengujian','order_shu.kd_order=work_order_pengujian.kd_order');
		return $this->db->count_all_results();
	}
	
	function GetResult($no_shu,$no_pengujian,$kd_order,$tgl_cetak,$file_shu,$ord,$srt,$limit,$start){
		if($this->session->userdata('profil')->groupname != 'super') 
		$this->db->where('order_shu.kd_satker',$this->session->userdata('profil')->kd_satker);
		if($no_shu){$this->db->like('order_shu.no_shu',$no_shu);}
		if($no_pengujian){$this->db->like('order_shu.no_pengujian',$no_pengujian);}
		if($kd_order){$this->db->like('order_shu.kd_order',$kd_order);}
		if($tgl_cetak){$this->db->like('order_shu.tgl_cetak',$tgl_cetak);}
		if($file_shu){$this->db->where('order_shu.file_shu',$file_shu);}
		$this->db->limit($limit,$start);
		$this->db->order_by('kd_shu',$srt);
		//$this->db->select('order_shu.*,work_order_pengujian.*,order_detail_pengujian.jenis_contoh');
		$this->db->select('order_shu.*,order_detail_pengujian.jenis_contoh');
		$this->db->from('order_shu');
		//$this->db->join('work_order_pengujian','order_shu.kd_order=work_order_pengujian.kd_order');
		$this->db->join('order_detail_pengujian','order_shu.kd_detail_order=order_detail_pengujian.kd_detail_order');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}
	#======================================================================#
	
	function GetTotalDetail($kd_order,$kd_detail_order){
		if($this->session->userdata('profil')->groupname != 'super') 
		$this->db->where('order_detail_pengujian.kd_satker',$this->session->userdata('profil')->kd_satker);
		if($kd_order) $this->db->where('order_detail_pengujian.kd_order',$kd_order);
		if($kd_detail_order) $this->db->where('order_detail_pengujian.kd_detail_order',$kd_detail_order);
		$this->db->from('order_detail_pengujian'); 
		$this->db->join('work_order_pengujian','work_order_pengujian.kd_order=order_detail_pengujian.kd_order');
		#$this->db->join('parameter','order_detail_pengujian.kd_detail_order = parameter.kd_detail_order');
		return $this->db->count_all_results();
	}
	
	function GetResultDetail($kd_order,$kd_detail_order,$ord,$srt,$limit,$start){
		if($this->session->userdata('profil')->groupname != 'super') 
		$this->db->where('order_detail_pengujian.kd_satker',$this->session->userdata('profil')->kd_satker);
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		if($kd_detail_order) $this->db->where('order_detail_pengujian.kd_detail_order',$kd_detail_order);
		if($kd_order) $this->db->where('order_detail_pengujian.kd_order',$kd_order);
		$this->db->select('order_detail_pengujian.*,work_order_pengujian.*');
		$this->db->from('order_detail_pengujian');
		#$this->db->join('parameter','order_detail_pengujian.kd_detail_order = parameter.kd_detail_order');
		$this->db->join('work_order_pengujian','work_order_pengujian.kd_order=order_detail_pengujian.kd_order');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}
	
	function SaveLama($arr,$kd_order='',$kd_shu='',$edit=false){
		
		//echo "<script>alert('$kd_shu')</script>";

		if($kd_shu && $edit==true){
			if(isset($arr['kd_shu'])) $this->db->set('kd_shu',$kd_shu);
		}else{
			if(isset($arr['kd_shu'])) $this->db->set('kd_shu',$arr['kd_shu']);
			else $this->db->set('kd_shu',$this->mOrder->Make_kd_shu());
		}

		if(isset($arr['no_shu'])) $this->db->set('no_shu',$arr['no_shu']);
		if(isset($arr['tgl_cetak'])) $this->db->set('tgl_cetak',$arr['tgl_cetak']);

		if(!empty($arr['file_shu'])){
			if(isset($arr['file_shu'])) $this->db->set('file_shu',$arr['file_shu']);
		}

		if(isset($arr['status_shu'])) $this->db->set('status_shu',$arr['status_shu']);
		if(isset($arr['tgl_order'])) $this->db->set('tgl_order',$arr['tgl_order']);
		if(isset($arr['tgl_perkiraan_selesai'])) $this->db->set('tgl_perkiraan_selesai',$arr['tgl_perkiraan_selesai']);
		if(isset($arr['tgl_pengujian'])) $this->db->set('tgl_pengujian',$arr['tgl_pengujian']);			                
		if(isset($arr['tgl_selesai_pengujian'])) $this->db->set('tgl_selesai_pengujian',$arr['tgl_selesai_pengujian']);

		if(isset($arr['nama_perusahaan'])) $this->db->set('nama_perusahaan',$arr['nama_perusahaan']);
		if(isset($arr['alamat_perusahaan'])) $this->db->set('alamat_perusahaan',$arr['alamat_perusahaan']);
		if(isset($arr['alamat_pabrik'])) $this->db->set('alamat_pabrik',$arr['alamat_pabrik']);
		if(isset($arr['nip_pengambil_sampling'])) $this->db->set('nip_pengambil_sampling',$arr['nip_pengambil_sampling']);
		if(isset($arr['nama_pengambil_sampling'])) $this->db->set('nama_pengambil_sampling',$arr['nama_pengambil_sampling']);
		if(isset($arr['nama_komoditi'])) $this->db->set('nama_komoditi',$arr['nama_komoditi']);
		if(isset($arr['tipe_komoditi'])) $this->db->set('tipe_komoditi',$arr['tipe_komoditi']);
		if(isset($arr['brand_komoditi'])) $this->db->set('brand_komoditi',$arr['brand_komoditi']);
		if(isset($arr['label_nokode_komoditi'])) $this->db->set('label_nokode_komoditi',$arr['label_nokode_komoditi']);
		if(isset($arr['jumlah_sampling'])) $this->db->set('jumlah_sampling',$arr['jumlah_sampling']);
		if(isset($arr['no_pengujian'])) $this->db->set('no_pengujian',$arr['no_pengujian']);
		if(isset($arr['no_order'])) $this->db->set('no_order',$arr['no_order']);
		if(isset($arr['kd_order'])) $this->db->set('kd_order',$arr['kd_order']);
		if(isset($arr['kd_detail_order'])) $this->db->set('kd_detail_order',$arr['kd_detail_order']);

		if(isset($arr['nip_pengetik_sertifikat'])) $this->db->set('nip_pengetik_sertifikat',$arr['nip_pengetik_sertifikat']);
		if(isset($arr['nm_pengetik_sertifikat'])) $this->db->set('nm_pengetik_sertifikat',$arr['nm_pengetik_sertifikat']);
		if(isset($arr['tgl_dibuat_pengetik_sertifikat'])) 
			$this->db->set('tgl_dibuat_pengetik_sertifikat',$arr['tgl_dibuat_pengetik_sertifikat']);
		if(isset($arr['comment_pengetik_sertifikat '])) 
			$this->db->set('comment_pengetik_sertifikat ',$arr['comment_pengetik_sertifikat ']);

		if(isset($arr['nip_manajer_teknis'])) $this->db->set('nip_manajer_teknis',$arr['nip_manajer_teknis']);
		if(isset($arr['nm_manajer_teknis'])) $this->db->set('nm_manajer_teknis',$arr['nm_manajer_teknis']);

		if(isset($arr['tgl_disetujui_manajer_teknis'])) 
			$this->db->set('tgl_disetujui_manajer_teknis',$arr['tgl_disetujui_manajer_teknis']);
		if(isset($arr['comment_manajer_teknis'])) $this->db->set('comment_manajer_teknis',$arr['comment_manajer_teknis']); 

		if(isset($arr['nip_penyerah_sertifikat'])) $this->db->set('nip_penyerah_sertifikat',$arr['nip_penyerah_sertifikat']);

		if(isset($arr['nm_penyerah_sertifikat'])) $this->db->set('nm_penyerah_sertifikat',$arr['nm_penyerah_sertifikat']);

		if(isset($arr['nm_penerima_sertifikat'])) $this->db->set('nm_penerima_sertifikat',$arr['nm_penerima_sertifikat']);
		if(isset($arr['tgl_diserahkan_sertifikat'])) 
			$this->db->set('tgl_diserahkan_sertifikat',$arr['tgl_diserahkan_sertifikat']);

		if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
		else $this->db->set('tgl_create',date("Y-m-d H:i:s"));
		if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
		else $this->db->set('tgl_update',date("Y-m-d H:i:s"));				
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->db->set('kd_satker',$this->session->userdata('profil')->kd_satker);
		

		if($edit){
			
			echo "<script>alert('test test save edit')</script>";
			if($kd_shu)
				$this->db->where('kd_shu',$kd_shu);
			if($kd_order)
				$this->db->where('kd_order',$kd_order);
			//$this->db->limit(1);
			$this->db->update('order_shu');
	 		

		}else{
			echo "<script>alert('test test save non edit')</script>";
			$this->db->insert('order_shu');
		}		
	
		
	  	return true;
	}

	function Save($arr,$kd_order='',$kd_shu='',$edit=false){
		
		//echo "<script>alert('$kd_shu')</script>";

		if($kd_shu && $edit==true){
			if(isset($arr['kd_shu'])) $this->db->set('kd_shu',$kd_shu);
		}else{
			if(isset($arr['kd_shu'])) $this->db->set('kd_shu',$arr['kd_shu']);
			else $this->db->set('kd_shu',$this->mOrder->Make_kd_shu());
		}

		if(isset($arr['no_shu'])) $this->db->set('no_shu',$arr['no_shu']);
		if(isset($arr['tgl_cetak'])) $this->db->set('tgl_cetak',$arr['tgl_cetak']);

		if(!empty($arr['file_shu'])){
			if(isset($arr['file_shu'])) $this->db->set('file_shu',$arr['file_shu']);
		}

		if(isset($arr['status_shu'])) $this->db->set('status_shu',$arr['status_shu']);
		if(isset($arr['tgl_order'])) $this->db->set('tgl_order',$arr['tgl_order']);
		if(isset($arr['tgl_perkiraan_selesai'])) $this->db->set('tgl_perkiraan_selesai',$arr['tgl_perkiraan_selesai']);
		if(isset($arr['tgl_pengujian'])) $this->db->set('tgl_pengujian',$arr['tgl_pengujian']);			                
		if(isset($arr['tgl_selesai_pengujian'])) $this->db->set('tgl_selesai_pengujian',$arr['tgl_selesai_pengujian']);

		if(isset($arr['nama_perusahaan'])) $this->db->set('nama_perusahaan',$arr['nama_perusahaan']);
		if(isset($arr['alamat_perusahaan'])) $this->db->set('alamat_perusahaan',$arr['alamat_perusahaan']);
		if(isset($arr['alamat_pabrik'])) $this->db->set('alamat_pabrik',$arr['alamat_pabrik']);
		if(isset($arr['nip_pengambil_sampling'])) $this->db->set('nip_pengambil_sampling',$arr['nip_pengambil_sampling']);
		if(isset($arr['nama_pengambil_sampling'])) $this->db->set('nama_pengambil_sampling',$arr['nama_pengambil_sampling']);
		if(isset($arr['nama_komoditi'])) $this->db->set('nama_komoditi',$arr['nama_komoditi']);
		if(isset($arr['tipe_komoditi'])) $this->db->set('tipe_komoditi',$arr['tipe_komoditi']);
		if(isset($arr['brand_komoditi'])) $this->db->set('brand_komoditi',$arr['brand_komoditi']);
		if(isset($arr['label_nokode_komoditi'])) $this->db->set('label_nokode_komoditi',$arr['label_nokode_komoditi']);
		if(isset($arr['jumlah_sampling'])) $this->db->set('jumlah_sampling',$arr['jumlah_sampling']);
		if(isset($arr['no_pengujian'])) $this->db->set('no_pengujian',$arr['no_pengujian']);
		if(isset($arr['no_order'])) $this->db->set('no_order',$arr['no_order']);
		if(isset($arr['kd_order'])) $this->db->set('kd_order',$arr['kd_order']);
		if(isset($arr['kd_detail_order'])) $this->db->set('kd_detail_order',$arr['kd_detail_order']);

		if(isset($arr['nip_penyelia'])) $this->db->set('nip_penyelia',$arr['nip_penyelia']);
		if(isset($arr['nm_penyelia'])) $this->db->set('nm_penyelia',$arr['nm_penyelia']);
		if(isset($arr['tgl_dibuat_penyelia'])) 
			$this->db->set('tgl_dibuat_penyelia',$arr['tgl_dibuat_penyelia']);
		if(isset($arr['comment_penyelia'])) 
			$this->db->set('comment_penyelia',$arr['comment_penyelia']);

		if(isset($arr['nip_wmanajer_teknis'])) $this->db->set('nip_wmanajer_teknis',$arr['nip_wmanajer_teknis']);
		if(isset($arr['nm_wmanajer_teknis'])) $this->db->set('nm_wmanajer_teknis',$arr['nm_wmanajer_teknis']);
		if(isset($arr['tgl_disetujui_wmanajer_teknis'])) 
			$this->db->set('tgl_disetujui_wmanajer_teknis',$arr['tgl_disetujui_wmanajer_teknis']);
		if(isset($arr['comment_wmanajer_teknis'])) $this->db->set('comment_wmanajer_teknis',$arr['comment_wmanajer_teknis']); 

		if(isset($arr['nip_manajer_teknis'])) $this->db->set('nip_manajer_teknis',$arr['nip_manajer_teknis']);
		if(isset($arr['nm_manajer_teknis'])) $this->db->set('nm_manajer_teknis',$arr['nm_manajer_teknis']);
		if(isset($arr['tgl_disetujui_manajer_teknis'])) 
			$this->db->set('tgl_disetujui_manajer_teknis',$arr['tgl_disetujui_manajer_teknis']);
		if(isset($arr['comment_manajer_teknis'])) $this->db->set('comment_manajer_teknis',$arr['comment_manajer_teknis']); 

		if(isset($arr['nip_penyerah_sertifikat'])) $this->db->set('nip_penyerah_sertifikat',$arr['nip_penyerah_sertifikat']);
		if(isset($arr['nm_penyerah_sertifikat'])) $this->db->set('nm_penyerah_sertifikat',$arr['nm_penyerah_sertifikat']);
		if(isset($arr['nm_penerima_sertifikat'])) $this->db->set('nm_penerima_sertifikat',$arr['nm_penerima_sertifikat']);
		if(isset($arr['tgl_diserahkan_sertifikat'])) 
			$this->db->set('tgl_diserahkan_sertifikat',$arr['tgl_diserahkan_sertifikat']);

		if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
		else $this->db->set('tgl_create',date("Y-m-d H:i:s"));
		if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
		else $this->db->set('tgl_update',date("Y-m-d H:i:s"));				
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->db->set('kd_satker',$this->session->userdata('profil')->kd_satker);
		

		if($edit){
			
			echo "<script>alert('test test save edit')</script>";
			if($kd_shu)
				$this->db->where('kd_shu',$kd_shu);
			if($kd_order)
				$this->db->where('kd_order',$kd_order);
			//$this->db->limit(1);
			$this->db->update('order_shu');
	 		

		}else{
			echo "<script>alert('test test save non edit')</script>";
			$this->db->insert('order_shu');
		}		
	
		
	  	return true;
	}
	
	function Update($arr,$kd_shu=''){
	  if(isset($arr['no_shu'])) $this->db->set('no_shu',$arr['no_shu']);
	  if(isset($arr['tgl_cetak'])) $this->db->set('tgl_cetak',$arr['tgl_cetak']); else $this->db->set('tgl_cetak',date('Y-m-d H:i:s'));
	  if(isset($arr['file_shu'])) $this->db->set('file_shu',$arr['file_shu']);
	  if($kd_shu){
		$this->db->where('kd_shu',$kd_shu);
		$this->db->limit(1);
		$this->db->update('order_shu');
	  }
	}
	
	function Delete($kd_shu=''){
		if($kd_shu) $this->db->where('kd_shu',$kd_shu);
		$this->db->limit(1);
		if($kd_shu) $this->db->delete('order_shu');
		return $this->db->affected_rows();
		return 0;
	}
}
?>
