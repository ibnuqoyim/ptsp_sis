<?php
class mAuditor extends CI_Model {
 	var $result;
	function __construct()
    	{
		parent::__construct();
	}

	// Start jenis Sertifikasi	
    public function getAuditor($kd_auditor ='',$nama_auditor='') {
		if($kd_auditor ) $this->db->where('kd_auditor ',$kd_auditor );
		if($nama_auditor) $this->db->like('nama_auditor',$nnama_auditor);
		//$this->db->order_by('tgl_update','desc');
		$this->db->select('kd_auditor,nama_auditor,jabatan_auditor,tgl_create,tgl_update,kd_satker');
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
        $query = $this->db->get('mst_sertifikasi_auditor');
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    function readAuditor($kd_auditor='',$nama_auditor=''){
    	if($kd_auditor!='')$this->db->where('mst_sertifikasi_auditor.kd_auditor',$kd_auditor);
		if($nama_auditor!='') $this->db->like('mst_sertifikasi_auditor.nama_auditor',$nama_auditor);
		$this->db->select('mst_sertifikasi_auditor.*');
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('mst_sertifikasi_auditor.kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$this->db->from('mst_sertifikasi_auditor');
		$this->db->limit(1);
		$result=$this->db->get();
		if($result->num_rows()>0){
			//if($nama_customer) return $query->result();
			//else 
				return $result->row();
		}
		return false;
	}

	

    function getTotalAuditor($kd_auditor='',$nama_auditor=''){
		if($kd_auditor) $this->db->where('kd_auditor',$kd_auditor);
		if($nama_auditor) $this->db->like('nama_auditor',$nama_auditor);
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$this->db->from('mst_sertifikasi_auditor');
		return $this->db->count_all_results();
	}
	
	function getResultAuditor($kd_auditor='',$nama_auditor='',$ord,$srt,$limit,$start){
		if($kd_auditor) $this->db->where('kd_auditor',$kd_auditor);
		if($nama_auditor) $this->db->like('nama_auditor',$nama_auditor);
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$qry=$this->db->get('mst_sertifikasi_auditor');
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}

	function getAuditorSertifikasiList4DropDown(){
		$qry=$this->db->get('mst_sertifikasi_auditor');
		$result=array('');
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				$result[$row->kd_auditor]=$row->nama_auditor;
			}
		}
		return $result;
	}

	function saveAuditor($arr,$kd_auditor ='',$edit=false){
		
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->session->userdata('profil')->kd_satker;
		
		if(isset($arr['nama_auditor'])) 
			$this->db->set('nama_auditor',$arr['nama_auditor']);
		if(isset($arr['singkatan_nama_auditor'])) 
			$this->db->set('singkatan_nama_auditor',$arr['singkatan_nama_auditor']);
		if(isset($arr['jabatan_auditor'])) 
			$this->db->set('jabatan_auditor',$arr['jabatan_auditor']);

		//echo "<script>alert('test input kd_auditor'".$arr['kd_auditor'].")</script>";
		if($edit){	
			if(isset($arr['kd_auditor']))
				$this->db->set('kd_auditor',$arr['kd_auditor']);
			else 	
				$this->db->set('kd_auditor',$kd_auditor);

			if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
			else $this->db->set('tgl_update',date('Y-m-d H:i:s'));

			$this->db->where('kd_auditor',$kd_auditor);
			$this->db->update('mst_sertifikasi_auditor');
			
		} else {
			if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
			else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
			if(isset($arr['kd_auditor'])) 
				$this->db->set('kd_auditor',$arr['kd_auditor']); 
			else $this->db->set('kd_auditor',$this->Make_kd_auditor());
			$this->db->insert('mst_sertifikasi_auditor');
		}
	}

	function deleteAuditor($kd_auditor =''){
		if($kd_auditor){
				$res=$this->readAuditor($kd_auditor);
				$name = $res->nama_auditor;
				if($res){
					$this->db->set('kd_auditor',$res->kd_auditor);
					$this->db->set('tgl_create',$res->tgl_create);
					$this->db->set('tgl_update',$res->tgl_update);
					$this->db->set('kd_satker',$res->kd_satker);
					$this->db->where('kd_auditor',$kd_auditor);
					$this->db->limit(1);
					$this->db->delete('mst_sertifikasi_auditor');
				}
		}
		return 0;
	}

	function Make_kd_auditor(){
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		//$prefix="komoditi-";
		$this->db->order_by('tgl_create','desc');
		$this->db->limit(1);
		$qry=$this->db->get('mst_sertifikasi_auditor');
		if($qry->num_rows()>0){
			$result=$qry->row();
			$arr_urut=explode("-",$result->kd_auditor);
			$urut=$arr_urut[count($arr_urut)-1];
			settype($urut,"integer");
			$urut+=1;
		} else { $urut=1; }
		//$kode=$prefix.$urut;
		#cekdulu
		do{
			
			$prefix=$this->session->userdata('profil')->kd_satker."-auditor-";
			$kode=$prefix.$urut;
			$this->db->where('kd_auditor',$kode);
			$qry=$this->db->get('mst_sertifikasi_auditor');
			$urut++;
		} while($qry->num_rows()>0);
		return $kode;
	}
}