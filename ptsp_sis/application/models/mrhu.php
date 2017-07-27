<?php
class mRHU extends CI_Model {
    var $result;
    function __construct()
    {
        parent::__construct();
    }
	
    function getRHU($kd_rhu='',$no_pengujian='',$kd_order='') {
	if($this->session->userdata('profil')->groupname != 'super') 
		$this->db->where('order_rhu.kd_satker',$this->session->userdata('profil')->kd_satker);
	if($kd_rhu) $this->db->where('order_rhu.kd_rhu',$kd_rhu);
	if($no_pengujian) $this->db->where('order_rhu.no_pengujian',$no_pengujian);
	if($kd_order) $this->db->where('order_rhu.kd_order',$kd_order);
	//$this->db->join('work_order_pengujian','order_rhu.kd_order=work_order_pengujian.kd_order');
	//$this->db->join('order_detail_pengujian','order_rhu.kd_detail_order=order_detail_pengujian.kd_detail_order');
        $query = $this->db->get('order_rhu');
        if( $query->num_rows() > 0 ) {
            if($kd_rhu) return $query->row();	   
	    else return $query->result();
        } else {
            return false;
        }
    }

	function GetTotal($no_pengujian,$kd_order,$file_rhu){
		if($this->session->userdata('profil')->groupname != 'super') 
		$this->db->where('order_rhu.kd_satker',$this->session->userdata('profil')->kd_satker);
		if($no_pengujian){$this->db->like('order_rhu.no_pengujian',$no_pengujian);}
		if($kd_order){$this->db->like('order_rhu.kd_order',$kd_order);}
		if($file_rhu){$this->db->like('order_rhu.file_rhu',$file_rhu);}
		
		//tambahan
		if($this->session->userdata('profil')->groupname == 'super' || 
			$this->session->userdata('profil')->groupname == 'admin' ||
			$this->session->userdata('profil')->groupname == 'penerima' || 
			$this->session->userdata('profil')->groupname == 'mt' || 
			$this->session->userdata('profil')->groupname == 'mm'|| 
			$this->session->userdata('profil')->groupname == 'mp'|| 
			$this->session->userdata('profil')->groupname == 'keuangan'|| 
			$this->session->userdata('profil')->groupname == 'sertifikat'|| 
			$this->session->userdata('profil')->groupname == 'administrasi'){		
              		$this->db->from('order_rhu');
			//$this->db->join('work_order_pengujian','order_rhu.kd_order=work_order_pengujian.kd_order');
    		}else{
             		$con = $this->session->userdata('profil')->groupname;
			//parsing group id			
			$hasil = preg_split('/[,]/', $con); 
			$i=0;
				$this->db->from('order_rhu');
				//$this->db->join('work_order_pengujian','order_rhu.kd_order=work_order_pengujian.kd_order');
				$this->db->join('order_detail_pengujian','order_rhu.kd_detail_order=order_detail_pengujian.kd_detail_order');
				if(count($hasil)==1){
					if($hasil[0] <> 'analis'){				
						$this->db->where('order_detail_pengujian.jenis_contoh',$hasil[0]);
						//print trim($hasil[$i])."ok</br>";
					}else{	}		

				}else{
					
					$this->db->where('order_detail_pengujian.jenis_contoh',$hasil[0]);
					while( $i < count($hasil) ){ 							
              					$this->db->or_where('order_detail_pengujian.jenis_contoh',$hasil[$i]);
						//print trim($hasil[$i])."</br>";
						$i++;
					}
				}
			
			
			
              		
    		}
		//end tambahan

		//$this->db->from('order_rhu');
		//$this->db->join('work_order_pengujian','order_rhu.kd_order=work_order_pengujian.kd_order');
		return $this->db->count_all_results();
	}
	
	function GetResult($no_pengujian,$kd_order,$file_rhu,$ord,$srt,$limit,$start){
		if($this->session->userdata('profil')->groupname != 'super') 
		$this->db->where('order_rhu.kd_satker',$this->session->userdata('profil')->kd_satker);
		if($no_pengujian){$this->db->like('order_rhu.no_pengujian',$no_pengujian);}
		if($kd_order){$this->db->like('order_rhu.kd_order',$kd_order);}
		if($file_rhu){$this->db->where('order_rhu.file_rhu',$file_rhu);}
		$this->db->limit($limit,$start);
		$this->db->order_by('kd_rhu',$srt);
		//$this->db->select('order_rhu.*,work_order_pengujian.*,order_detail_pengujian.*');
		$this->db->select('order_rhu.*,order_detail_pengujian.*');
		$this->db->select('order_rhu.*');

		//tambahan
		if($this->session->userdata('profil')->groupname == 'super' || 
			$this->session->userdata('profil')->groupname == 'admin' ||
			$this->session->userdata('profil')->groupname == 'penerima' || 
			$this->session->userdata('profil')->groupname == 'mt' || 
			$this->session->userdata('profil')->groupname == 'mm'|| 
			$this->session->userdata('profil')->groupname == 'mp'|| 
			$this->session->userdata('profil')->groupname == 'keuangan'|| 
			$this->session->userdata('profil')->groupname == 'sertifikat'|| 
			$this->session->userdata('profil')->groupname == 'administrasi'){		
              		$this->db->from('order_rhu');
			//$this->db->join('work_order_pengujian','order_rhu.kd_order=work_order_pengujian.kd_order');
			$this->db->join('order_detail_pengujian','order_rhu.kd_detail_order=order_detail_pengujian.kd_detail_order');
    		}else{
             		$con = $this->session->userdata('profil')->groupname;
			//parsing group id			
			$hasil = preg_split('/[,]/', $con); 
			$i=0;
			
				$this->db->from('order_rhu');
				$this->db->join('work_order_pengujian','order_rhu.kd_order=work_order_pengujian.kd_order');
				$this->db->join('order_detail_pengujian','order_rhu.kd_detail_order=order_detail_pengujian.kd_detail_order');
				if(count($hasil)==1){
					if($hasil[0] <> 'analis'){				
						$this->db->where('order_detail_pengujian.jenis_contoh',$hasil[0]);
						//print trim($hasil[$i])."ok</br>";
					}else{	}		

				}else{
					
					$this->db->where('order_detail_pengujian.jenis_contoh',$hasil[0]);
					while( $i < count($hasil) ){ 							
              					$this->db->or_where('order_detail_pengujian.jenis_contoh',$hasil[$i]);
						//print trim($hasil[$i])."</br>";
						$i++;
					}
				}
			
			
			
              		
    		}
		//end tambahan
		//$this->db->from('order_rhu');
		//$this->db->join('work_order_pengujian','order_rhu.kd_order=work_order_pengujian.kd_order');
		//$this->db->join('order_detail_pengujian','order_rhu.kd_detail_order=order_detail_pengujian.kd_detail_order');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}
	#======================================================================#
	
	function GetTotalDetail($no_order,$no_pengujian){
		if($this->session->userdata('profil')->groupname != 'super') 
		$this->db->where('order_detail_pengujian.kd_satker',$this->session->userdata('profil')->kd_satker);
		if($kd_order) $this->db->where('order_detail_pengujian.kd_order',$kd_order);
		if($kd_detail_order) $this->db->where('order_detail_pengujian.kd_detail_order',$kd_detail_order);
		$this->db->from('order_detail_pengujian'); 
		$this->db->join('work_order_pengujian','work_order_pengujian.kd_order=order_detail_pengujian.kd_order');
		#$this->db->join('parameter','order_detail_pengujian.kd_detail_order = parameter.kd_detail_order');
		return $this->db->count_all_results();
	}
	
	function GetResultDetail($kd_order,$no_pengujian,$ord,$srt,$limit,$start){
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
	
	function Save($arr){
		if(isset($arr['kd_rhu'])) $this->db->set('kd_rhu',$arr['kd_rhu']);
			else $this->db->set('kd_rhu',$this->mOrder->Make_kd_rhu());
		if(isset($arr['file_rhu'])) $this->db->set('file_rhu',$arr['file_rhu']);
		if(isset($arr['status_rhu'])) $this->db->set('status_rhu',$arr['status_rhu']);

		if(isset($arr['no_pengujian'])) $this->db->set('no_pengujian',$arr['no_pengujian']);

		if(isset($arr['tgl_pengujian'])) $this->db->set('tgl_pengujian',$arr['tgl_pengujian']);
		if(isset($arr['tgl_selesai_pengujian'])) $this->db->set('tgl_selesai_pengujian',$arr['tgl_selesai_pengujian']);

		if(isset($arr['no_order'])) $this->db->set('no_order',$arr['no_order']);
		if(isset($arr['kd_order'])) $this->db->set('kd_order',$arr['kd_order']);
		if(isset($arr['kd_detail_order'])) $this->db->set('kd_detail_order',$arr['kd_detail_order']);
		if(isset($arr['nip_penyelia'])) $this->db->set('nip_penyelia',$arr['nip_penyelia']);
		if(isset($arr['nm_penyelia'])) $this->db->set('nm_penyelia',$arr['nm_penyelia']);
		if(isset($arr['tgl_dibuat_penyelia'])) $this->db->set('tgl_dibuat_penyelia',$arr['tgl_dibuat_penyelia']);
		if(isset($arr['comment_penyelia'])) $this->db->set('comment_penyelia',$arr['comment_penyelia']);
		
		if(isset($arr['nip_wmanager_teknis'])) $this->db->set('nip_wmanager_teknis',$arr['nip_wmanager_teknis']);
		if(isset($arr['nm_wmanajer_teknis'])) $this->db->set('nm_wmanajer_teknis',$arr['nm_wmanager_teknis']);
		if(isset($arr['tgl_disetujui_wmanager_teknis'])) $this->db->set('tgl_disetujui_wmanager_teknis',
				$arr['tgl_disetujui_wmanager_teknis']);
		if(isset($arr['comment_wmanager_teknis'])) $this->db->set('comment_wmanager_teknis',$arr['comment_wmanager_teknis']); 		
		
		if(isset($arr['nip_manager_teknis'])) $this->db->set('nip_manager_teknis',$arr['nip_manager_teknis']);
		if(isset($arr['nm_manajer_teknis'])) $this->db->set('nm_manajer_teknis',$arr['nm_manager_teknis']);
		if(isset($arr['tgl_disetujui_manager_teknis'])) $this->db->set('tgl_disetujui_manager_teknis',
				$arr['tgl_disetujui_manager_teknis']);
		if(isset($arr['comment_manager_teknis'])) $this->db->set('comment_manager_teknis',$arr['comment_manager_teknis']); 

		if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
			else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

		if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
			else $this->db->set('tgl_update',date("Y-m-d H:i:s"));
			
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->db->set('kd_satker',$this->session->userdata('profil')->kd_satker);

		$this->db->insert('order_rhu');
	  	return true;
	}
	
	function Update($arr,$kd_rhu=''){
	 	if(!empty($arr['kd_rhu'])) $this->db->set('kd_rhu',$arr['kd_rhu']);
		else $this->db->set('kd_rhu',$this->mOrder->Make_kd_rhu());
		
		if(!empty($arr['cek_file'])){
			if(!empty($arr['file_rhu'])) $this->db->set('file_rhu',$arr['file_rhu']);
		}
		if($arr['file_rhu']) {
			if(!empty($arr['file_rhu'])) $this->db->set('file_rhu',$arr['file_rhu']);
		}
		   
		if(!empty($arr['status_rhu'])) $this->db->set('status_rhu',$arr['status_rhu']);
		if(!empty($arr['no_pengujian'])) $this->db->set('no_pengujian',$arr['no_pengujian']);
		if(isset($arr['tgl_pengujian'])) $this->db->set('tgl_pengujian',$arr['tgl_pengujian']);
		if(isset($arr['tgl_selesai_pengujian'])) $this->db->set('tgl_selesai_pengujian',$arr['tgl_selesai_pengujian']);
		if(!empty($arr['no_order'])) $this->db->set('no_order',$arr['no_order']);
		if(!empty($arr['kd_order'])) $this->db->set('kd_order',$arr['kd_order']);
		if(!empty($arr['kd_detail_order'])) $this->db->set('kd_detail_order',$arr['kd_detail_order']);
		if(!empty($arr['nip_penyelia'])) $this->db->set('nip_penyelia',$arr['nip_penyelia']);
		if(!empty($arr['nm_penyelia'])) $this->db->set('nm_penyelia',$arr['nm_penyelia']);
		if(!empty($arr['tgl_dibuat_penyelia'])) $this->db->set('tgl_dibuat_penyelia',$arr['tgl_dibuat_penyelia']);
		if(!empty($arr['comment_penyelia'])) $this->db->set('comment_penyelia',$arr['comment_penyelia']);

		if(!empty($arr['nip_wmanager_teknis'])) $this->db->set('nip_wmanager_teknis',$arr['nip_wmanager_teknis']);
		if(!empty($arr['nm_wmanager_teknis'])) $this->db->set('nm_wmanager_teknis',$arr['nm_wmanager_teknis']);
		if(!empty($arr['tgl_disetujui_wmanager_teknis'])) 
			$this->db->set('tgl_disetujui_wmanager_teknis',$arr['tgl_disetujui_wmanager_teknis']);
		if(!empty($arr['comment_wmanager_teknis'])) 
			$this->db->set('comment_wmanager_teknis',$arr['comment_wmanager_teknis']);

		if(!empty($arr['nip_manager_teknis'])) $this->db->set('nip_manager_teknis',$arr['nip_manager_teknis']);
		if(!empty($arr['nm_manager_teknis'])) $this->db->set('nm_manager_teknis',$arr['nm_manager_teknis']);
		if(!empty($arr['tgl_disetujui_manager_teknis'])) 
			$this->db->set('tgl_disetujui_manager_teknis',$arr['tgl_disetujui_manager_teknis']);
		if(!empty($arr['comment_manager_teknis'])) 
			$this->db->set('comment_manager_teknis',$arr['comment_manager_teknis']); 

		if(!empty($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
		else $this->db->set('tgl_create',date("Y-m-d H:i:s"));
		if(!empty($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
		else $this->db->set('tgl_update',date("Y-m-d H:i:s"));
			
		if(!empty($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->db->set('kd_satker',$this->session->userdata('profil')->kd_satker);
	 	if($kd_rhu){
			$this->db->where('kd_rhu',$kd_rhu);
			$this->db->limit(1);
			$this->db->update('order_rhu');
	  	}
		
	}
	
	function Delete($kd_rhu=''){
		if($kd_rhu) $this->db->where('kd_rhu',$kd_rhu);
		$this->db->limit(1);
		if($kd_rhu) $this->db->delete('order_rhu');
		return $this->db->affected_rows();
		return 0;
	}
}
?>
