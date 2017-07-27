<?php
class mStaff extends CI_Model {
 	var $result;
	function __construct()
    {
        parent::__construct();
	}
	
	function CekLogin($nip,$password){
		$nip=trim($nip);
		$password=trim($password);
		if($nip && $password){
					
			$this->db->where('NIP',$nip);
			$this->db->where('password',$password);
			$this->db->limit(1);
			$result=$this->db->get('staff');
			if($result->num_rows()>0){
				return $result->row();
			}
		}
		return false;
	}
	
    public function getStaff() {
		$this->db->select('Nama,NIP,Pangkat,Gol_Ruang,Jabatan');
        $query = $this->db->get('staff');
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
	
	function readStaff($nip){
		$this->db->where('NIP',$nip);
		$this->db->select('staff.*,satker.name as groupname,satker.nama_satker as groupdesc');
		$this->db->from('staff');
		$this->db->join('satker','staff.kd_satker=satker.kd_satker');
		$this->db->limit(1);
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->row();
		}
		return false;
	}
	
	function GetTotal($NIP,$name,$kd_satker){
		if($NIP){$this->db->like('staff.NIP',$NIP);}
		if($name){$this->db->like('staff.Nama',$name);}
		if($kd_satker){$this->db->where('staff.kd_satker',$kd_satker);}
		$this->db->from('staff');
		$this->db->join('satker','staff.kd_satker=satker.kd_satker');
		return $this->db->count_all_results();
	}

	function GetResult($NIP,$name,$kd_satker,$ord,$srt,$limit,$start){
		if($NIP){$this->db->like('staff.NIP',$NIP);}
		if($name){$this->db->like('staff.Nama',$name);}
		if($kd_satker){$this->db->where('staff.kd_satker',$kd_satker);}
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		$this->db->select('staff.NIP,staff.Nama,staff.Pangkat,staff.Gol_Ruang,staff.Jabatan,satker.nama_satker');
		$this->db->from('staff');
		$this->db->join('satker','staff.kd_satker=satker.kd_satker');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}
	
	function GetGroupList4DropDown(){
		$qry=$this->db->get('groups');
		$result=array('');
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				if($this->session->userdata('profil')->groupname=='admin' && $row->kd_group == 1) {} else {
					$result[$row->kd_group]=$row->desc;
				}
			}
		}
		return $result;
	}
	
	function GetSatkerList4DropDown(){
		$qry=$this->db->get('satker');
		$result=array('');
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				$result[$row->kd_satker]=$row->nama_satker;
			}
		}
		return $result;
	}

	function GetDetail($NIP){
		$this->db->where('staff.NIP',$NIP);
		$this->db->join('satker','staff.kd_satker=satker.kd_satker');
		$this->db->from('staff');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->row();
		}
		return false;
	}
	
	function Save($arr,$NIP=''){
		$this->db->set('kd_satker',$arr['kd_satker']);
		if($NIP){
			$this->db->where('NIP',$NIP);
			$this->db->update('staff');
		} else {
			$this->db->insert('staff');
		}
	}
	function getNamaSatker($kd_satker='',$nama_satker='',$singkatan_satker='') {
		if($kd_satker) $this->db->where('satker.kd_satker',$kd_satker);
		if($nama_satker) $this->db->where('satker.nama_satker',$nama_satker);
		if($singkatan_satker) $this->db->where('satker.singkatan_satker',$singkatan_satker);
		$query = $this->db->get('satker');
       		if( $query->num_rows() > 0 ) {
            		if($kd_satker) return $query->row(); //else return $query->result();
        	} else {
            		return false;
       		}
        }

}
?>
