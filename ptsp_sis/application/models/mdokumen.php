<?php
class mDokumen extends CI_Model {
 	var $result;
	function __construct()
    	{
		parent::__construct();
	}

	// Start

	function readDokumen($kd_sertifikasi_dokumen='',$nama_sertifikasi_dokumen='',$result=false) {
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}

		if($kd_sertifikasi_dokumen) $this->db->where('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);
		if($nama_sertifikasi_dokumen) $this->db->where('nama_sertifikasi_dokumen',$nama_sertifikasi_dokumen);
		$this->db->select('mst_sertifikasi_jenis_tarif_dokumen.*');
		
        	$query = $this->db->get('mst_sertifikasi_jenis_tarif_dokumen');
        	if( $query->num_rows() > 0 ) {
            		if($result) return $query->result(); else return $query->row();
        	} else {
            		return false;
        	}
    	}

	function getDokumen($kd_sertifikasi_dokumen='',$kd_sertifikasi_jenistarif='',$result=false) {
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}

		if($kd_sertifikasi_dokumen) $this->db->where('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);
		if($kd_sertifikasi_jenistarif) $this->db->where('kd_sertifikasi_jenistarif',$kd_sertifikasi_jenistarif);
		$this->db->select('mst_sertifikasi_jenis_tarif_dokumen.*');
		
        	$query = $this->db->get('mst_sertifikasi_jenis_tarif_dokumen');
        	if( $query->num_rows() > 0 ) {
            		if($result) return $query->result(); else return $query->row();
        	} else {
            		return false;
        	}
    	}


    function GetTotalItem($kd_sertifikasi_dokumen,$nama_sertifikasi_dokumen,$kd_sertifikasi_jenistarif){
		if($kd_sertifikasi_dokumen){$this->db->like('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);}
		if($nama_sertifikasi_dokumen){$this->db->like('nama_sertifikasi_dokumen',$nama_sertifikasi_dokumen);}
		if($kd_sertifikasi_jenistarif){$this->db->like('kd_sertifikasi_jenistarif',$kd_sertifikasi_jenistarif);}
		//if($kd_sertifikasi_jenis){$this->db->like('kd_sertifikasi_jenis',$kd_sertifikasi_jenis);}
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$this->db->from('mst_sertifikasi_jenis_tarif_dokumen');
		return $this->db->count_all_results();
	}

	function GetResultItem($kd_sertifikasi_dokumen,$nama_sertifikasi_dokumen,$kd_sertifikasi_jenistarif,$ord,$srt,$limit,$start){
		if($kd_sertifikasi_dokumen){$this->db->like('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);}
		if($nama_sertifikasi_dokumen){$this->db->like('nama_sertifikasi_dokumen',$nama_sertifikasi_dokumen);}
		if($kd_sertifikasi_jenistarif){$this->db->like('kd_sertifikasi_jenistarif',$kd_sertifikasi_jenistarif);}
		//if($kd_sertifikasi_jenis){$this->db->like('kd_sertifikasi_jenis',$kd_sertifikasi_jenis);}
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$qry=$this->db->get('mst_sertifikasi_jenis_tarif_dokumen');
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}

    function getDetailItem($kd_sertifikasi_tarif) {
		if($this->session->userdata('profil')->groupname != 'super') 
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		$this->db->where('mst_parameter_pengujian.kd_sertifikasi_tarif',$kd_sertifikasi_tarif);
		$this->db->select('mst_sertifikasi_tarif.*,mst_layanan_pengujian.jenis_tarif');
		$this->db->from('mst_parameter_pengujian');
		$this->db->join('mst_layanan_pengujian','mst_sertifikasi_tarif.kd_sertifikasi_jenis =mst_layanan_pengujian.kd_sertifikasi_jenis ');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            return $query->row();
        } else {
            return false;
        }
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

	function saveDokumen($arr,$kd_sertifikasi_dokumen ='',$edit=false){
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->session->userdata('profil')->kd_satker;
		if(isset($arr['kd_sertifikasi_dokumen']))
			$this->db->set('kd_sertifikasi_dokumen',$arr['kd_sertifikasi_dokumen']);
		if(isset($arr['nama_sertifikasi_dokumen'])) 
			$this->db->set('nama_sertifikasi_dokumen',$arr['nama_sertifikasi_dokumen']);
		if(isset($arr['jenis_dokumen'])) 
			$this->db->set('jenis_dokumen',$arr['jenis_dokumen']);
		if(isset($arr['kd_sertifikasi_jenistarif'])) 
			$this->db->set('kd_sertifikasi_jenistarif',$arr['kd_sertifikasi_jenistarif']);
		if(isset($arr['kd_sertifikasi_jenis'])) 
			$this->db->set('kd_sertifikasi_jenis',$arr['kd_sertifikasi_jenis']);

		if($edit){			
			if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
			else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
			$this->db->where('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);
			$this->db->update('mst_sertifikasi_jenis_tarif_dokumen');
			
		} else {
			if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
			else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
			if(isset($arr['kd_sertifikasi_dokumen'])) 
				$this->db->set('kd_sertifikasi_dokumen',$arr['kd_sertifikasi_dokumen']); 
			else $this->db->set('kd_sertifikasi_dokumen',$this->Make_kd_sertifikasi_dokumen());
			$this->db->insert('mst_sertifikasi_jenis_tarif_dokumen');
		}
	}

	function deleteDokumen($kd_sertifikasi_dokumen =''){
				$res=$this->readDokumen($kd_sertifikasi_dokumen);
				
				if($res){
					$this->db->set('kd_sertifikasi_dokumen',$res->kd_sertifikasi_dokumen);
					$this->db->set('tgl_create',$res->tgl_create);
					$this->db->set('tgl_update',$res->tgl_update);
					$this->db->set('kd_satker',$res->kd_satker);
					$this->db->where('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);
					$this->db->limit(1);
					return $this->db->delete('mst_sertifikasi_jenis_tarif_dokumen');
				} 
		
	}

	function Make_kd_sertifikasi_dokumen(){
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		//$prefix="komoditi-";
		$this->db->order_by('tgl_create','desc');
		$this->db->limit(1);
		$qry=$this->db->get('mst_sertifikasi_jenis_tarif_dokumen');
		if($qry->num_rows()>0){
			$result=$qry->row();
			$arr_urut=explode("-",$result->kd_sertifikasi_dokumen);
			$urut=$arr_urut[count($arr_urut)-1];
			settype($urut,"integer");
			$urut+=1;
		} else { $urut=1; }
		//$kode=$prefix.$urut;
		#cekdulu
		do{
			
			$prefix=$this->session->userdata('profil')->kd_satker."-dok-";
			$kode=$prefix.$urut;
			$this->db->where('kd_sertifikasi_komoditi',$kode);
			$qry=$this->db->get('mst_sertifikasi_komoditi');
			$urut++;
		} while($qry->num_rows()>0);
		return $kode;
	}
}