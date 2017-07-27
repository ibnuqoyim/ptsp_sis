<?php
class mCustomer extends CI_Model {
 	var $result;
	function __construct()
    {
        parent::__construct();
	}
		
    public function getCustomer($kd_customer='') {
	if($kd_customer) $this->db->where('kd_customer',$kd_customer);
	$this->db->order_by('tgl_update','desc');
	$this->db->select('kd_customer,nama,alamat,email,telepon,fax,kota,propinsi,tgl_create,tgl_update,kd_satker,kd_tipe_customer');
	if($this->session->userdata('profil')->groupname!='super'){
		if($this->session->userdata('profil')->groupname == 'customer'){
			$this->db->where('kd_customer', $this->session->userdata('userid'));
		  } else {
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		  }
	}
        $query = $this->db->get('customer');
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return false;
        }
    }
	
	function readCustomer($kd_customer='',$nama_customer=''){
		if($nama_customer!='') $this->db->like('customer.nama',$nama_customer);
		if($kd_customer!='')$this->db->where('customer.kd_customer',$kd_customer);
		$this->db->select('customer.*,customer_tipe.tipe_customer as tipe_customer,satker.nama_satker as nama_satker');
		if($this->session->userdata('profil')->groupname!='super'){
			if($this->session->userdata('profil')->groupname == 'customer'){
			$this->db->where('customer.kd_customer', $this->session->userdata('userid'));
		  } else {
			$this->db->where('customer.kd_satker',$this->session->userdata('profil')->kd_satker);
		  }
		}
		$this->db->from('customer');
		$this->db->join('customer_tipe','customer.kd_tipe_customer=customer_tipe.kd_tipe_customer');
		$this->db->join('satker','customer.kd_satker = satker.kd_satker');
		$this->db->limit(1);
		$result=$this->db->get();
		if($result->num_rows()>0){
			//if($nama_customer) return $query->result();
			//else 
				return $result->row();
		}
		return false;
	}
	
	function GetTotal($nama,$kota,$kd_tipe_customer,$kd_satker){
		if($this->session->userdata('profil')->groupname != 'super') 
		{ $this->db->where('customer.kd_satker',$this->session->userdata('profil')->kd_satker); }
		else { if($kd_satker) $this->db->where('satker.kd_satker',$kd_satker); /*echo "<script>alert('".$kd_satker."')</script>";*/ }
		if($nama){$this->db->like('customer.nama',$nama);}
		if($kota){$this->db->like('kota.nama_kota',$kota);}
		if($kd_tipe_customer){$this->db->like('customer_tipe.kd_tipe_customer',$kd_tipe_customer);}
		//if($groupid){$this->db->where('users.groupid',$groupid);}
		$this->db->from('customer');
		$this->db->join('kota','customer.kota=kota.kd_kota'); #<== GARA2 DATABASE BALAI TIDAK MENCANTUMKAN KODE KOTA JADI ERROR 
		$this->db->join('satker','customer.kd_satker = satker.kd_satker');
		$this->db->join('customer_tipe','customer.kd_tipe_customer=customer_tipe.kd_tipe_customer');
		return $this->db->count_all_results();
	}

	function GetResult($nama,$kota,$kd_tipe_customer,$kd_subtipe_customer,$kd_satker,$ord,$srt,$limit,$start){
		if($this->session->userdata('profil')->groupname != 'super') 
		{ $this->db->where('customer.kd_satker',$this->session->userdata('profil')->kd_satker); }
		else { if($kd_satker) $this->db->where('satker.kd_satker',$kd_satker); }
		if($nama){$this->db->like('customer.nama',$nama);}
		if($kota){$this->db->like('kota.nama_kota',$kota);}
		if($kd_tipe_customer){$this->db->like('customer_tipe.kd_tipe_customer',$kd_tipe_customer);}
	  if($kd_subtipe_customer <>'0'){
			$this->db->like('customer_sub_tipe.kd_subtipe_customer',$kd_subtipe_customer);
			$this->db->join('customer_sub_tipe','customer.kd_subtipe_customer=customer_sub_tipe.kd_subtipe_customer',
				'customer1.kd_tipe_customer=customer_tipe.kd_tipe_customer');
			$this->db->select('customer.*,kota.nama_kota,customer_tipe.tipe_customer as tipe_customer,
			customer_sub_tipe.nama_subtipe as nama_subtipe,satker.nama_satker as nama_satker'); 

		} 
		//if($groupid){$this->db->where('users.groupid',$groupid);}
		
		$this->db->from('customer');
		//$this->db->join('propinsi','customer.propinsi = propinsi.kd_propinsi');
    
		$this->db->join('kota','customer.kota=kota.kd_kota'); #<== GARA2 DATABASE BALAI TIDAK MENCANTUMKAN KODE KOTA JADI ERROR 
		$this->db->join('satker','customer.kd_satker = satker.kd_satker');
		$this->db->join('customer_tipe','customer.kd_tipe_customer=customer_tipe.kd_tipe_customer');
		
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}
	
	function GetTotalDetailKomoditi($kd_customer,$kd_komoditi){
        
		if($kd_customer) $this->db->where('customer_komoditi.kd_customer',$kd_customer);
		if($kd_komoditi) $this->db->where('customer_komoditi.kd_komoditi',$kd_komoditi);
		$this->db->from('customer_komoditi'); 
		$this->db->join('customer','customer.kd_customer=customer_komoditi.kd_customer');
		
		return $this->db->count_all_results();
	}
	
	function GetResultDetailKomoditi($kd_customer,$kd_komoditi,$ord,$srt,$limit,$start){
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
        	
		//echo "<script>alert('test')</script>";
		if($kd_komoditi) $this->db->where('customer_komoditi.kd_komoditi',$kd_komoditi);
		if($kd_customer) $this->db->where('customer_komoditi.kd_customer',$kd_customer);
			
		$this->db->select('customer_komoditi.*, customer.*'); 
		$this->db->from('customer_komoditi');
		$this->db->join('customer','customer.kd_customer=customer_komoditi.kd_customer');
		$qry=$this->db->get();
		
		if($qry->num_rows()>0){
			return $qry->result(); 
		}
		return false;
	}
	function GetDetailKomoditi($kd_customer='',$kd_komoditi=''){
		if($kd_komoditi) $this->db->where('customer_komoditi.kd_komoditi',$kd_komoditi);
		if($kd_customer) $this->db->where('customer_komoditi.kd_customer',$kd_customer);
			
		$this->db->select('customer_komoditi.*, customer.*'); 
		$this->db->from('customer_komoditi');
		$this->db->join('customer','customer.kd_customer=customer_komoditi.kd_customer');
		$qry=$this->db->get();
		if($qry->num_rows()>0){
			if($kd_komoditi) return $qry->row(); 
			else return $qry->result();
			//return $qry->result(); 
		}
		return false;
	}

	function DeleteCustomer($kd_customer,$turunan=true){
		if($kd_customer){

		   if($turunan==true){
			$detail_komoditi=$this->GetDetailKomoditi($kd_customer,'');
			if($detail_komoditi){
				foreach($detail_komoditi as $row){
					$this-> DeleteDetailKomoditi($row->kd_komoditi);
									
				}
			}
		   }
		   $this->db->where('kd_customer',$kd_customer);
		   $this->db->limit(1);
		   $this->db->delete('customer');
		   return $this->db->affected_rows();
		}
		return 0;
	}

	function DeleteDetailKomoditi($kd_komoditi){
		if($kd_komoditi){
			$this->db->where('kd_komoditi',$kd_komoditi);
			$this->db->limit(1);
			$this->db->delete('customer_komoditi');
			return $this->db->affected_rows();
		}
		return 0;
	}

	function GetTipeCustomerList4DropDown(){
		$qry=$this->db->get('customer_tipe');
		$result=array('');
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				$result[$row->kd_tipe_customer]=$row->tipe_customer;
			}
		}
		return $result;
	}
	
	function GetSubTipeCustomerList4DropDown(){
		//$this->db->where('kd_tipe_customer ',$kd_tipe_customer);
		$qry=$this->db->get('customer_sub_tipe');
		$result=array('');
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				$result[$row->kd_subtipe_customer]=$row->nama_subtipe ;
			}
		}
		return $result;
	}

	function ListTipeCustomer(){
		$qry=$this->db->get('customer_tipe');
		$result=array('');
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return $result;
	}
	
	function ListSubTipeCustomer(){
		$this->db->where('kd_tipe_customer ',$kd_tipe_customer );
		$qry=$this->db->get('customer_sub_tipe');
		$result=array('');
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return $result;
	}

	function GetNegaraList4DropDown(){
		$qry=$this->db->get('negara');
		$result=array('');
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				$result[$row->kd_negara]=$row->negara;
			}
		}
		return $result;
	}
	
	function GetPropinsiList4DropDown(){
		$qry=$this->db->get('propinsi');
		$result=array('');
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				$result[$row->kd_propinsi]=$row->nama_propinsi;
			}
		}
		return $result;
	}
	
	function GetNegara($kd_negara=''){
		if($kd_negara){
			$this->db->where('kd_negara',$kd_negara);
		}
		$qry=$this->db->get('negara');
		if($qry->num_rows()>0){
			return $qry->result();
		} else { return false; }
	}

	function readNegara($kd_negara){
		$this->db->where('negara.kd_negara',$kd_negara);
		$this->db->select('negara.kd_negara,negara.negara');
		$this->db->from('negara');		
		$this->db->limit(1);
		$result=$this->db->get();
		if($result->num_rows()>0){
			return $result->row();
		}
		return false;
	}
	
	function GetPropinsi($kd_propinsi=''){
		if($kd_propinsi){
			$this->db->where('kd_propinsi',$kd_propinsi);
		}
		$qry=$this->db->get('propinsi');
		if($qry->num_rows()>0){
			return $qry->result();
		} else { return false; }
	}
	
	function GetKabupaten($kd_propinsi=''){
		if($kd_propinsi){
			$this->db->where('kd_propinsi',$kd_propinsi);
		}
		$qry=$this->db->get('kota');
		if($qry->num_rows()>0){
			return $qry->result();
		} else { return false; }
	}

	function GetTipeCustomer($kd_tipe_customer=''){
		if($kd_tipe_customer){
			$this->db->where('kd_tipe_customer',$kd_tipe_customer);
		}
		$qry=$this->db->get('customer_tipe');
		if($qry->num_rows()>0){
			return $qry->result();
		} else { return false; }
	}

	function GetSubTipeCustomer($kd_tipe_customer='',$kd_subtipe_customer=''){
		if($kd_tipe_customer){
			$this->db->where('kd_tipe_customer',$kd_tipe_customer);
		}
		if($kd_subtipe_customer){
			$this->db->where('kd_subtipe_customer',$kd_subtipe_customer);
		}
		$qry=$this->db->get('customer_sub_tipe');
		if($qry->num_rows()>0){
		    if($kd_tipe_customer)
			return $qry->result();
		    else
			return $qry->row();
		} else { return false; }
	}
	
	function JumCustomerBulanan($tipecust,$tanggal){
		
	}
	
	function GetDetail($kd_customer='',$nama_customer=''){
		//$this->db->where('customer.kd_customer',$kd_customer);
		if($nama_customer!='') $this->db->like('customer.nama',$nama_customer);
		if($kd_customer!='')$this->db->where('customer.kd_customer',$kd_customer);
		$this->db->from('customer');
		$this->db->join('customer_tipe','customer.kd_tipe_customer=customer_tipe.kd_tipe_customer');
		$this->db->join('negara','customer.kd_negara=negara.kd_negara');
		$this->db->join('propinsi','customer.propinsi=propinsi.kd_propinsi');
		$this->db->join('kota','customer.kota=kota.kd_kota');
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

	function Save($arr,$kd_customer='',$edit=false){		
		if(isset($arr['nama'])) $this->db->set('nama',$arr['nama']);
		if(isset($arr['alamat'])) $this->db->set('alamat',$arr['alamat']);
		if(isset($arr['alamat_pabrik'])) $this->db->set('alamat_pabrik',$arr['alamat_pabrik']);
		if(isset($arr['email'])) $this->db->set('email',$arr['email']);
		if(isset($arr['website'])) $this->db->set('website',$arr['website']);
		if(!empty($arr['contact_person1'])) $this->db->set('contact_person1',$arr['contact_person1']);
		if(!empty($arr['contact_person2'])) $this->db->set('contact_person2',$arr['contact_person2']);
		if(!empty($arr['contact_person3'])) $this->db->set('contact_person3',$arr['contact_person3']);
		if(!empty($arr['contact_person4'])) $this->db->set('contact_person4',$arr['contact_person4']);
		if(!empty($arr['contact_person5'])) $this->db->set('contact_person5',$arr['contact_person5']);
		if(isset($arr['jml_karyawan'])) $this->db->set('jml_karyawan',$arr['jml_karyawan']);
		if(isset($arr['kapasitas_produksi_total'])) $this->db->set('kapasitas_produksi_total',$arr['kapasitas_produksi_total']);
		if(isset($arr['market_area'])) $this->db->set('market_area',$arr['market_area']);
		if(isset($arr['tahun_pendirian'])) $this->db->set('tahun_pendirian',$arr['tahun_pendirian']);
		if(isset($arr['telepon'])) $this->db->set('telepon',$arr['telepon']);
		if(isset($arr['fax'])) $this->db->set('fax',$arr['fax']);
		if(isset($arr['kd_negara'])) $this->db->set('kd_negara',$arr['kd_negara']);
		if(isset($arr['kota'])) $this->db->set('kota',$arr['kota']);
		if(isset($arr['propinsi'])) $this->db->set('propinsi',$arr['propinsi']);
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
			else $this->session->userdata('profil')->kd_satker;
		if(isset($arr['kd_tipe_customer'])) $this->db->set('kd_tipe_customer',$arr['kd_tipe_customer']);
		if(isset($arr['kd_subtipe_customer'])) $this->db->set('kd_subtipe_customer',$arr['kd_subtipe_customer']);
		if($edit){
			if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
			else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
			$this->db->where('kd_customer',$kd_customer);
			$this->db->update('customer');
		} else {
			if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
				else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
			if(isset($arr['kd_customer'])) $this->db->set('kd_customer',$arr['kd_customer']); 
				else $this->db->set('kd_customer',$this->Make_kd_customer());
			$this->db->insert('customer');
			//return $kd_customer;
		}
	}
	function SaveKomoditi($arr,$kd_customer='',$edit=false){
		if(isset($arr['kd_komoditi'])) $this->db->set('kd_komoditi',$arr['kd_komoditi']);		
		if(isset($arr['nama_komoditi'])) $this->db->set('nama_komoditi',$arr['nama_komoditi']);
		if(isset($arr['tipe_komoditi'])) $this->db->set('tipe_komoditi',$arr['tipe_komoditi']);
		if(isset($arr['brand_komoditi'])) $this->db->set('brand_komoditi',$arr['brand_komoditi']);
		if(isset($arr['kapasitas_produksi'])) $this->db->set('kapasitas_produksi',$arr['kapasitas_produksi']);		
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
			else $this->session->userdata('profil')->kd_satker;
		if(isset($arr['kd_customer'])) $this->db->set('kd_customer',$arr['kd_customer']);
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']);
		if($edit){
			if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
			else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
			$this->db->where('kd_komoditi',$arr['kd_komoditi']);
			$this->db->update('customer_komoditi');
		} else {
			if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
				else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
			if(isset($arr['kd_komoditi'])) $this->db->set('kd_komoditi',$arr['kd_komoditi']); 
				else $this->db->set('kd_komoditi',$this->Make_kd_customer());
			$this->db->insert('customer_komoditi');
			//return $kd_customer;
		}
	}
	
	function Make_kd_customer(){
		$prefix=$this->session->userdata('profil')->kd_satker."-cst-".date("Y")."-";
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		$this->db->order_by('tgl_create','desc');
		$this->db->limit(1);
		$qry=$this->db->get('customer');
		if($qry->num_rows()>0){
			$result=$qry->row();
			$arr_urut=explode("-",$result->kd_customer);
			$urut=$arr_urut[count($arr_urut)-1];//'05'
			settype($urut,"integer");
			$urut+=1;
		} else { $urut=1; }
		#cekdulu
		do{
			$kode=$prefix.$urut;
			$this->db->where('kd_customer',$kode);
			$qry=$this->db->get('customer');
			$urut++;
		} while($qry->num_rows()>0);
		return $kode;
	}
	function Make_kd_komoditi_customer(){
		$prefix=$this->session->userdata('profil')->kd_satker."-kdt-";
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		$this->db->order_by('tgl_create','desc');
		$this->db->limit(1);
		$qry=$this->db->get('customer_komoditi');
		if($qry->num_rows()>0){
			$result=$qry->row();
			$arr_urut=explode("-",$result->kd_komoditi);
			$urut=$arr_urut[count($arr_urut)-1];//'05'
			settype($urut,"integer");
			$urut+=1;
		} else { $urut=1; }
		#cekdulu
		do{
			$kode=$prefix.$urut;
			$this->db->where('kd_komoditi',$kode);
			$qry=$this->db->get('customer_komoditi');
			$urut++;
		} while($qry->num_rows()>0);
		return $kode;
	}
}
?>
