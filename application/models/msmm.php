<?php
class mSMM extends CI_Model {
 	var $result;
	function __construct()
    	{
		parent::__construct();
	}

	// Start jenis Sertifikasi	
    public function getSMM($kd_sertifikasi_smm='') {
		if($kd_sertifikasi_smm) $this->db->where('kd_sertifikasi_smm',$kd_sertifikasi_smm);
		//if($no_sertifikasi_komoditi) $this->db->like('no_sertifikasi_komoditi',$no_sertifikasi_komoditi);
		//$this->db->order_by('tgl_update','desc');
		$this->db->select('kd_sertifikasi_smm ,nama_sertifikasi_smm,tgl_create,tgl_update,kd_satker');
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
        $query = $this->db->get('mst_sertifikasi_smm');
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    function readSMM($kd_sertifikasi_smm='',$nama_sertifikasi_smm=''){
		if($nama_sertifikasi_smm!='') $this->db->like('mst_sertifikasi_smm.nama_sertifikasi_smm',$nama_sertifikasi_smm);
		if($kd_sertifikasi_smm!='')$this->db->where('mst_sertifikasi_smm.kd_sertifikasi_smm',$kd_sertifikasi_smm);
		$this->db->select('mst_sertifikasi_smm.*');
		if($this->session->userdata('profil')->groupname!='super'){
			if($this->session->userdata('profil')->groupname != 'customer'){
				$this->db->where('mst_sertifikasi_smm.kd_satker',$this->session->userdata('profil')->kd_satker);
			}
		}
		$this->db->from('mst_sertifikasi_smm');
		$this->db->limit(1);
		$result=$this->db->get();
		if($result->num_rows()>0){
			//if($nama_customer) return $query->result();
			//else 
				return $result->row();
		}
		return false;
	}

	

    function getTotalSMM($kd_sertifikasi_smm='',$nama_sertifikasi_smm=''){
		if($kd_sertifikasi_smm) $this->db->where('kd_sertifikasi_smm',$kd_sertifikasi_smm);
		if($nama_sertifikasi_smm) $this->db->like('nama_sertifikasi_smm',$nama_sertifikasi_smm);
		if($this->session->userdata('profil')->groupname!='super'){
			if($this->session->userdata('profil')->groupname != 'customer'){
				$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
			}
		}
		$this->db->from('mst_sertifikasi_smm');
		return $this->db->count_all_results();
	}
	
	function getResultSMM($kd_sertifikasi_smm='',$nama_sertifikasi_smm='',$ord,$srt,$limit,$start){
		if($kd_sertifikasi_smm) $this->db->where('kd_sertifikasi_smm',$kd_sertifikasi_smm);
		if($nama_sertifikasi_smm) $this->db->like('nama_sertifikasi_smm',$nama_sertifikasi_smm);
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		if($this->session->userdata('profil')->groupname!='super'){
			if($this->session->userdata('profil')->groupname != 'customer'){
				$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
			}
		}
		$qry=$this->db->get('mst_sertifikasi_smm');
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}

	function getSMMSertifikasiList4DropDown(){
		$qry=$this->db->get('mst_sertifikasi_smm');
		$result=array('');
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				$result[$row->kd_sertifikasi_smm]=$row->nama_sertifikasi_smm;
			}
		}
		return $result;
	}

	function saveSMM($arr,$kd_sertifikasi_smm ='',$edit=false){
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->session->userdata('profil')->kd_satker;
		if(isset($arr['kd_sertifikasi_smm']))
			$this->db->set('kd_sertifikasi_smm',$arr['kd_sertifikasi_smm']);
		if(isset($arr['nama_sertifikasi_smm'])) 
			$this->db->set('nama_sertifikasi_smm',$arr['nama_sertifikasi_smm']);
		
		if($edit){			
			if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
			else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
			$this->db->where('kd_sertifikasi_smm',$kd_sertifikasi_smm);
			$this->db->update('mst_sertifikasi_smm');
			
		} else {
			if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
			else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
			if(isset($arr['kd_sertifikasi_smm'])) 
				$this->db->set('kd_sertifikasi_smm',$arr['kd_sertifikasi_smm']); 
			//if(isset($arr['no_sertifikasi_komoditi'])) 
			//$this->db->set('no_sertifikasi_komoditi',$arr['no_sertifikasi_komoditi']); 
			else $this->db->set('kd_sertifikasi_smm',$this->Make_kd_sertifikasi_smm());
			$this->db->insert('mst_sertifikasi_smm');
		}
	}

	function deleteSMM($kd_sertifikasi_smm =''){
		if($kd_sertifikasi_smm){
				$res=$this->readSMM($kd_sertifikasi_smm);
				$name = $res->nama_sertifikasi_smm;
				if($res){
					$this->db->set('kd_sertifikasi_smm',$res->kd_sertifikasi_smm);
					$this->db->set('tgl_create',$res->tgl_create);
					$this->db->set('tgl_update',$res->tgl_update);
					$this->db->set('kd_satker',$res->kd_satker);
					$this->db->where('kd_sertifikasi_smm',$kd_sertifikasi_smm);
					$this->db->limit(1);
					$this->db->delete('mst_sertifikasi_smm');
				}
		}
		return 0;
	}

	function Make_kd_sertifikasi_smm(){
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		//$prefix="komoditi-";
		$this->db->order_by('tgl_create','desc');
		$this->db->limit(1);
		$qry=$this->db->get('mst_sertifikasi_smm');
		if($qry->num_rows()>0){
			$result=$qry->row();
			$arr_urut=explode("-",$result->kd_sertifikasi_smm);
			$urut=$arr_urut[count($arr_urut)-1];
			settype($urut,"integer");
			$urut+=1;
		} else { $urut=1; }
		//$kode=$prefix.$urut;
		#cekdulu
		do{
			
			$prefix=$this->session->userdata('profil')->kd_satker."-smm-";
			$kode=$prefix.$urut;
			$this->db->where('kd_sertifikasi_smm',$kode);
			$qry=$this->db->get('mst_sertifikasi_smm');
			$urut++;
		} while($qry->num_rows()>0);
		return $kode;
	}
	
	function getMaster(){
		$this->db->select("kd_sertifikasi_smm, nama_sertifikasi_smm");
		$this->db->from("mst_sertifikasi_smm");
		$query = $this->db->get();
	if($query->num_rows() !=0)
	{	
		return $query->result_array();
	}
	else{
		return false;
	}
	}
}