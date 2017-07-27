<?php
class mUser extends CI_Model {
 	var $result;
	function __construct()
    {
        parent::__construct();
	}
	
	function CekLogin($userid,$password){
		$userid=trim($userid);
		$password=trim($password);
		if($userid && $password){
			$this->db->where('userid',$userid);
			$this->db->where('password',$password);
			$this->db->limit(1);
			$result=$this->db->get('users');
			if($result->num_rows()>0){
				return $result->row();
			}
		}
		return false;
	}
	
    public function getUser($nip) {
		$this->db->where('NIP',$nip);
		$this->db->select('Nama,NIP,Pangkat,Gol_Ruang,Jabatan');
        $query = $this->db->get('staff');
        if( $query->num_rows() > 0 ) {
           		return $query->result();
        } else {
           		return false;
       	}
    }
	
	public function readCustomer($userid) {
		#NIP di table users harus sama dengan KD_CUSTOMER di tabel customer
		$this->db->where('users.userid', $userid);
		$this->db->select('users.keterangan,users.email,users.tgldaftar,users.added_by,customer.nama as nama_perusahaan, customer.kd_satker, groups.name as groupname,groups.desc as groupdesc');
		$this->db->from('users');
		$this->db->join('groups','users.groupid=groups.kd_group');
		$this->db->join('customer','users.userid = customer.kd_customer');
		$this->db->limit(1);
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->row();
		}
		return false;
	}
	
    

	function readUser($nip){
		$this->db->where('users.nip',$nip);
		$this->db->select('users.keterangan,users.email,users.tgldaftar,users.added_by,staff.*,
		satker.nama_satker as satker, groups.name as groupname,groups.desc as groupdesc');
		$this->db->from('users');
		$this->db->join('groups','users.groupid=groups.kd_group');
		$this->db->join('staff','users.nip = staff.NIP');
		$this->db->join('satker','staff.kd_satker=satker.kd_satker');
		$this->db->limit(1);
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->row();
		}
		return false;
	}
	function readNipLama($nip_baru){
		$this->db->where('users.nip_baru',$nip_baru);
		$this->db->select('users.nip,users.nip_baru,users.kota,users.keterangan,users.groupid,
			users.email,users.tgldaftar,users.added_by');
		$this->db->from('users');		
		$this->db->limit(1);
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->row();
		}
		return false;
	}
	
	function GetTotal($nip,$name,$userid,$groupid,$kd_satker){
		if($nip){$this->db->like('users.nip',$nip);}
		if($name){$this->db->like('staff.Nama',$name);}
		if($userid){$this->db->like('users.userid',$userid);}
		if($groupid){$this->db->where('users.groupid',$groupid);}
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('staff.kd_satker',$this->session->userdata('profil')->kd_satker);
		} else {
			if($kd_satker){$this->db->where('satker.kd_satker',$kd_satker);}
		}
		$this->db->from('users');
		$this->db->join('groups','users.groupid=groups.kd_group');
		$this->db->join('staff','users.nip=staff.NIP');
		$this->db->join('satker','staff.kd_satker=satker.kd_satker');
		return $this->db->count_all_results();
	}

	function GetResult($nip,$name,$userid,$groupid,$kd_satker,$ord,$srt,$limit,$start){
		if($nip){$this->db->like('users.nip',$nip);}
		if($name){$this->db->like('staff.Nama',$name);}
		if($userid){$this->db->like('users.userid',$userid);}
		if($groupid){$this->db->where('users.groupid',$groupid);}
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('staff.kd_satker',$this->session->userdata('profil')->kd_satker);
		} else {
			if($kd_satker){$this->db->where('satker.kd_satker',$kd_satker);}
		}
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		$this->db->select('users.*,satker.nama_satker,staff.Nama,staff.Pangkat,staff.Gol_Ruang,
			staff.Jabatan,groups.desc as groupname');
		$this->db->from('users');
		$this->db->join('groups','users.groupid=groups.kd_group');
		$this->db->join('staff','users.nip=staff.NIP');
		$this->db->join('satker','staff.kd_satker=satker.kd_satker');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}

	function DeleteUser($nip='',$userid=''){
		if($userid) $this->db->where('userid',$username);
		if($nip) $this->db->where('nip',$nip);
		$this->db->limit(1);
		if($nip || $userid) $this->db->delete('users');
		return $this->db->affected_rows();
		return 0;
	}

	function GetGroupList4DropDown(){
		$qry=$this->db->get('groups');
		$result=array();
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				if($this->session->userdata('profil')->groupname=='admin' && $row->kd_group == 1) {} else {
				$result[$row->kd_group]=$row->desc;
				}
			}
		}
		return $result;
	}
	function GetUserList4DropDown($groupid){		
		$hasil = preg_split('/[,]/', $groupid); 
		//$hasil =explode(",", $groupid);
		$i=0;
		//echo count($hasil)."<br>";
		while( $i < count($hasil) ){
			$this->db->or_where('users.groupid',$hasil[$i]);
			//echo $hasil[$i]."<br>";
			$i++;
		}

		$this->db->select('users.nip as nip, staff`.Nama as nama,staff.kd_satker as kd_satker, 
			groups.desc as groupname ');

		$this->db->from('users');
		$this->db->join('groups','users.groupid=groups.kd_group');
		$this->db->join('staff','users.nip=staff.NIP');
		$this->db->join('satker','staff.kd_satker=satker.kd_satker');
		$qry=$this->db->get();
		$result=array();
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				$result[$row->nip."|".$row->nama]=$row->nama." (".$row->nip.")";				
			}
		}
		return $result;
	}

    public function getDetailStaff($nip) {
		$this->db->where('NIP',$nip);
		$this->db->from('staff');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->row();
		}
		return false;
    }
    
	
	function GetDetail($nip){
		$this->db->where('users.nip',$nip);
		$this->db->from('users');
		$this->db->join('staff','users.nip=staff.NIP');
		$this->db->join('satker','staff.kd_satker=satker.kd_satker');
		$this->db->join('groups','users.groupid=groups.kd_group');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->row();
		}
		return false;
	}
	
	function GetDetail2($userid){
		$this->db->where('users.userid',$userid);
		$this->db->from('users');
		$this->db->join('staff','users.nip=staff.NIP');
		$this->db->join('groups','users.groupid=groups.kd_group');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->row();
		}
		return false;
	}
	function GetDetail3($nip_baru){
		$this->db->where('users.nip_baru',trim($nip_baru));
		$this->db->from('users');
		//$this->db->join('staff','users.nip_baru=staff.nip_baru');
		//$this->db->join('satker','staff.kd_satker=satker.kd_satker');
		//$this->db->join('groups','users.groupid=groups.kd_group');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->row();
		}
		return false;
	}
	
	function CekEmailForSave($email,$userid=''){
		$this->db->where('email',$email);
		if($userid){$this->db->where('userid <>',$userid);}
		return $this->db->count_all_results('users')>0? false:true;
	}
	
	function getLog($no_urut){
		$this->db->where('no_urut',$no_urut);
		$qry=$this->db->get('users_log');
		if($qry->num_rows()>0){
			return $qry->row();
		}
		return false;
	}
	
	function delLog($no_urut){
		$this->db->where('no_urut',$no_urut);
		$this->db->limit(1);
		return $this->db->delete('users_log');
	}
	
	function Save($arr,$nip='',$edit=false){
		if(isset($arr['nip_baru'])) $this->db->set('nip_baru',$arr['nip_baru']);
		if(!empty($arr['password'])) $this->db->set('password',md5($arr['password']));
		if(isset($arr['email'])) $this->db->set('email',$arr['email']);
		if(isset($arr['keterangan'])) $this->db->set('keterangan',$arr['keterangan']);
		if(isset($arr['groupid'])) $this->db->set('groupid',$arr['groupid']);
		if($edit){
			$this->db->where('nip',$nip);
			$this->db->update('users');
			if($arr['kd_satker']){ 
				$this->db->set('kd_satker',$arr['kd_satker']);
				$this->db->where('nip',$nip);
				$this->db->update('staff');
			}
			if($arr['nip_baru']){ 
				$this->db->set('nip_baru',$arr['nip_baru']);
				$this->db->where('nip',$nip);
				$this->db->update('staff');

			}

		} else {
			if(isset($arr['tgldaftar'])) $this->db->set('tgldaftar',$arr['tgldaftar']); 
			else $this->db->set('tgldaftar',date('Y-m-d H:i:s'));
		 	if(isset($arr['userid'])) $this->db->set('userid',$arr['userid']);
			$this->db->set('added_by',$this->session->userdata('userid'));
			$this->db->set('nip_baru',$arr['nip_baru']);
			$this->db->set('nip',$nip);
			$this->db->insert('users');
		}
	}
	
	function getTotUserLog($userid='',$ip='',$url='',$action=''){
		if($userid) $this->db->where('userid',$userid);
		if($ip) $this->db->like('ip',$ip);
		if($url) $this->db->like('url',$url);
		if($action) $this->db->like('action',$action);
		//$qry=$this->db->get('users_log');
		return $this->db->count_all_results('users_log');
	}
	
	function getUserLog($userid='',$ip='',$url='',$action='',$ord,$srt,$limit,$start){
		if($userid) $this->db->where('userid',$userid);
		if($ip) $this->db->like('ip',$ip);
		if($url) $this->db->like('url',$url);
		if($action) $this->db->like('action',$action);
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		$qry=$this->db->get('users_log');
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}
	
	function WriteLog($userid,$ip,$url,$action){
		$this->db->set('userid',$userid);
		$this->db->set('ip',$ip);
		$this->db->set('url',$url);
		$this->db->set('action',$action);
		$this->db->insert('users_log');
	}

	function SaveGroup($arr,$name='',$edit=false){		
		if(isset($arr['name'])) $this->db->set('name',$arr['name']);
		if($edit){			
			if($name){ 
				$this->db->set('name',$arr['name']);
				$this->db->set('desc',$arr['desc']);
				$this->db->where('name',$name);
				$this->db->update('groups');
			}
			

		} else {
			$this->db->set('name',$arr['name']);
			$this->db->set('desc',$arr['desc']);
			$this->db->insert('groups');
		}
	}
	function check_user($userid,$password){
		$userid=trim($userid);
		$password=trim($password);
		if($userid && $password){
			$this->db->where('userid',$userid);
			$this->db->where('password',$password);
			$this->db->limit(1);
			$result=$this->db->get('users');
			if($result->num_rows()>0){
				return $result->result_array();
			}
		}
		return false;
	}				 
}
?>
