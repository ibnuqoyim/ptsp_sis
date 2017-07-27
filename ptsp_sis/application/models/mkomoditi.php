<?php
class mKomoditi extends CI_Model {
 	var $result;
	function __construct()
    	{
		parent::__construct();
	}

	// Start jenis Sertifikasi	
    public function getKomoditi($kd_sertifikasi_komoditi='') {
		if($kd_sertifikasi_komoditi) $this->db->where('kd_sertifikasi_komoditi',$kd_sertifikasi_komoditi);
		//if($no_sertifikasi_komoditi) $this->db->like('no_sertifikasi_komoditi',$no_sertifikasi_komoditi);
		//$this->db->order_by('tgl_update','desc');
		$this->db->select('kd_sertifikasi_komoditi ,no_sertifikasi_komoditi,nama_sertifikasi_komoditi,
						tipe_sertifikasi_komoditi,tgl_create,tgl_update,kd_satker');
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
        $query = $this->db->get('mst_sertifikasi_komoditi');
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }

    function readKomoditi($kd_sertifikasi_komoditi='',$no_sertifikasi_komoditi=''){
		if($no_sertifikasi_komoditi!='') $this->db->like('mst_sertifikasi_komoditi.no_sertifikasi_komoditi',$no_sertifikasi_komoditi);
		if($kd_sertifikasi_komoditi!='')$this->db->where('mst_sertifikasi_komoditi.kd_sertifikasi_komoditi',$kd_sertifikasi_komoditi);
		$this->db->select('mst_sertifikasi_komoditi.*');
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('mst_sertifikasi_komoditi.kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$this->db->from('mst_sertifikasi_komoditi');
		$this->db->limit(1);
		$result=$this->db->get();
		if($result->num_rows()>0){
			//if($nama_customer) return $query->result();
			//else 
				return $result->row();
		}
		return false;
	}

	

    function getTotalKomoditi($no_sertifikasi_komoditi='',$nama_sertifikasi_komoditi='',$kd_sertifikasi_jenis =''){
		if($kd_sertifikasi_jenis ) $this->db->where('kd_sertifikasi_jenis ',$kd_sertifikasi_jenis );
		if($no_sertifikasi_komoditi) $this->db->like('no_sertifikasi_komoditi',$no_sertifikasi_komoditi); 
		if($nama_sertifikasi_komoditi) $this->db->like('nama_sertifikasi_komoditi',$nama_sertifikasi_komoditi); 
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$this->db->from('mst_sertifikasi_komoditi');
		return $this->db->count_all_results();
	}
	
	function getResultKomoditi($no_sertifikasi_komoditi,$nama_sertifikasi_komoditi='',
					$ord,$srt,$limit,$start,$kd_sertifikasi_jenis =''){
		if($kd_sertifikasi_jenis ) $this->db->where('kd_sertifikasi_jenis ',$kd_sertifikasi_jenis );
		if($no_sertifikasi_komoditi) $this->db->like('no_sertifikasi_komoditi',$no_sertifikasi_komoditi); 
		if($nama_sertifikasi_komoditi) $this->db->like('nama_sertifikasi_komoditi',$nama_sertifikasi_komoditi); 
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$qry=$this->db->get('mst_sertifikasi_komoditi');
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}

	function getKomoditiSertifikasiList4DropDown(){
		$qry=$this->db->get('mst_sertifikasi_komoditi');
		$result=array('');
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				$result[$row->kd_sertifikasi_komoditi]=$row->no_sertifikasi_komoditi;
			}
		}
		return $result;
	}

	function saveKomoditi($arr,$kd_sertifikasi_komoditi ='',$edit=false){
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->session->userdata('profil')->kd_satker;
		if(isset($arr['kd_sertifikasi_komoditi']))
			$this->db->set('kd_sertifikasi_komoditi',$arr['kd_sertifikasi_komoditi']);
		if(isset($arr['no_sertifikasi_komoditi'])) 
			$this->db->set('no_sertifikasi_komoditi',$arr['no_sertifikasi_komoditi']);
		if(isset($arr['nama_sertifikasi_komoditi'])) 
			$this->db->set('nama_sertifikasi_komoditi',$arr['nama_sertifikasi_komoditi']);
		if(isset($arr['tipe_sertifikasi_komoditi'])) 
			$this->db->set('tipe_sertifikasi_komoditi',$arr['tipe_sertifikasi_komoditi']);
		if($edit){			
			if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
			else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
			$this->db->where('kd_sertifikasi_komoditi',$kd_sertifikasi_komoditi);
			$this->db->update('mst_sertifikasi_komoditi');
			
		} else {
			if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
			else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
			if(isset($arr['kd_sertifikasi_komoditi'])) 
				$this->db->set('kd_sertifikasi_komoditi',$arr['kd_sertifikasi_komoditi']); 
			//if(isset($arr['no_sertifikasi_komoditi'])) 
			//$this->db->set('no_sertifikasi_komoditi',$arr['no_sertifikasi_komoditi']); 
			else $this->db->set('kd_sertifikasi_komoditi',$this->Make_kd_sertifikasi_komoditi());
			$this->db->insert('mst_sertifikasi_komoditi');
		}
	}

	function deleteKomoditi($kd_sertifikasi_komoditi =''){
		if($kd_sertifikasi_komoditi){
				$res=$this->readKomoditi($kd_sertifikasi_komoditi);
				$name = $res->no_sertifikasi_komoditi;
				if($res){
					$this->db->set('no_sertifikasi_komoditi',$res->no_sertifikasi_komoditi);
					$this->db->set('tgl_create',$res->tgl_create);
					$this->db->set('tgl_update',$res->tgl_update);
					$this->db->set('kd_satker',$res->kd_satker);
					$this->db->where('kd_sertifikasi_komoditi',$kd_sertifikasi_komoditi);
					$this->db->limit(1);
					$this->db->delete('mst_sertifikasi_komoditi');
				}
		}
		return 0;
	}

	function Make_kd_sertifikasi_komoditi(){
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		//$prefix="komoditi-";
		$this->db->order_by('tgl_create','desc');
		$this->db->limit(1);
		$qry=$this->db->get('mst_sertifikasi_komoditi');
		if($qry->num_rows()>0){
			$result=$qry->row();
			$arr_urut=explode("-",$result->kd_sertifikasi_komoditi);
			$urut=$arr_urut[count($arr_urut)-1];
			settype($urut,"integer");
			$urut+=1;
		} else { $urut=1; }
		//$kode=$prefix.$urut;
		#cekdulu
		do{
			
			$prefix=$this->session->userdata('profil')->kd_satker."-komoditi-";
			$kode=$prefix.$urut;
			$this->db->where('kd_sertifikasi_komoditi',$kode);
			$qry=$this->db->get('mst_sertifikasi_komoditi');
			$urut++;
		} while($qry->num_rows()>0);
		return $kode;
	}
}