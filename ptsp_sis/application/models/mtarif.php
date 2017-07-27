<?php
class mTarif extends CI_Model {
 	var $result;
	function __construct()
    	{
		parent::__construct();
	}

	// Start jenis Sertifikasi	
    function getJenis($kd_sertifikasi_jenis ='',$result=false) {
	if($this->session->userdata('profil')->groupname != 'super') 
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
	if($kd_sertifikasi_jenis ) $this->db->where('kd_sertifikasi_jenis',$kd_sertifikasi_jenis );
	$this->db->select('kd_sertifikasi_jenis ,nama_sertifikasi_jenis,tgl_create,tgl_update,kd_satker');
		
        $query = $this->db->get('mst_sertifikasi_jenis');
        if( $query->num_rows() > 0 ) {
            if($result) return $query->result(); else return $query->row();
        } else {
            return false;
        }
    }

    function GetTotalJenis($nama_sertifikasi_jenis='',$kd_sertifikasi_jenis =''){
		if($kd_sertifikasi_jenis ) $this->db->where('kd_sertifikasi_jenis',$kd_sertifikasi_jenis );
		if($nama_sertifikasi_jenis) $this->db->like('nama_sertifikasi_jenis',$nama_sertifikasi_jenis); 
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$this->db->from('mst_sertifikasi_jenis');
		return $this->db->count_all_results();
	}
	
	function GetResultJenis($nama_sertifikasi_jenis,$ord,$srt,$limit,$start,$kd_sertifikasi_jenis =''){
		if($kd_sertifikasi_jenis ) $this->db->where('kd_sertifikasi_jenis ',$kd_sertifikasi_jenis );
		if($nama_sertifikasi_jenis) $this->db->like('nama_sertifikasi_jenis',$nama_sertifikasi_jenis); 
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$qry=$this->db->get('mst_sertifikasi_jenis');
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}

	function GetJenisSertifikasiList4DropDown(){
		$qry=$this->db->get('mst_sertifikasi_jenis');
		$result=array('');
		if($qry->num_rows()>0){
			foreach($qry->result() as $row){
				$result[$row->kd_sertifikasi_jenis]=$row->nama_sertifikasi_jenis;
			}
		}
		return $result;
	}

	function SaveJenis($arr,$kd_sertifikasi_jenis ='',$edit=false){
	if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->session->userdata('profil')->kd_satker;
	if(isset($arr['kd_sertifikasi_jenis'])) $this->db->set('kd_sertifikasi_jenis',$arr['kd_sertifikasi_jenis']);
	if(isset($arr['nama_sertifikasi_jenis'])) $this->db->set('nama_sertifikasi_jenis',$arr['nama_sertifikasi_jenis']);
	if($edit){
			if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
			else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
			$this->db->where('kd_sertifikasi_jenis',$kd_sertifikasi_jenis );
			$this->db->update('mst_sertifikasi_jenis');
			if(isset($arr['kd_sertifikasi_jenis']) && $arr['kd_sertifikasi_jenis'] != $kd_sertifikasi_jenis ) { 
				$this->db->set('kd_sertifikasi_jenis',$arr['kd_sertifikasi_jenis']); 
				$this->db->where('kd_sertifikasi_jenis',$kd_sertifikasi_jenis );
				$this->db->update('mst_sertifikasi_tarif'); 
			}
	} else {
			if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
			else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
			if(isset($arr['kd_sertifikasi_jenis'])) $this->db->set('kd_sertifikasi_jenis',$arr['kd_sertifikasi_jenis']); 
			//if(isset($arr['nama_sertifikasi_jenis'])) $this->db->set('nama_sertifikasi_jenis',$arr['nama_sertifikasi_jenis']); 
			else $this->db->set('kd_sertifikasi_jenis ',$this->Make_kd_sertifikasi_jenis ());
			$this->db->insert('mst_sertifikasi_jenis');
		}
	}

	function DeleteJenis($kd_sertifikasi_jenis ='',$temp=true){
		if($kd_sertifikasi_jenis ){
			if($temp) { #Backup
				$res=$this->getJenis($kd_sertifikasi_jenis);
				$name = $res->nama_sertifikasi_jenis;
				if($res){
					$this->db->set('nama_sertifikasi_jenis',$res->nama_sertifikasi_jenis);
					$this->db->set('tgl_create',$res->tgl_create);
					$this->db->set('tgl_update',$res->tgl_update);
					$this->db->set('kd_satker',$res->kd_satker);
					$this->db->where('kd_sertifikasi_jenis',$kd_sertifikasi_jenis );
					$this->db->limit(1);
					$this->db->delete('mst_sertifikasi_jenis');
											
					$res2=$this->getTarif('',$kd_sertifikasi_jenis,true);
					if($res2){
						foreach($res2 as $row){
							$this->db->set('nama_jenistarif',$row->nama_jenistarif);
							$this->db->set('tgl_create',$row->tgl_create);
							$this->db->set('tgl_update',$row->tgl_update); 
							$this->db->set('kd_sertifikasi_jenis',$row->kd_sertifikasi_jenis);
							$this->db->set('kd_satker',$row->kd_satker);			
							$this->db->where('kd_sertifikasi_jenistarif',$row->kd_sertifikasi_jenistarif);
							$this->db->limit(1);
							$this->db->delete('mst_sertifikasi_jenis_tarif');
							
							$del2=true;
							$res3=$this->getItem('',$row->kd_sertifikasi_jenistarif,true);
							if($res3){
								foreach($res3 as $row2){
									$this->db->set('nama_sertifikasi_jenistarifitem',$row2->nama_sertifikasi_jenistarifitem);
									$this->db->set('harga_sertifikasi_jenistarifitem',$row2->harga_sertifikasi_jenistarifitem);
									$this->db->set('satuan_sertifikasi_jenistarifitem',$row2->satuan_sertifikasi_jenistarifitem);
									$this->db->set('keterangan1_jenistarifitem',$row2->keterangan1_jenistarifitem);
									$this->db->set('keterangan2_jenistarifitem',$row2->keterangan2_jenistarifitem);	
									$this->db->set('tgl_create',$row2->tgl_create);
									$this->db->set('tgl_update',$row2->tgl_update);
									$this->db->set('kd_sertifikasi_jenistarif',$row2->kd_sertifikasi_jenistarif);
									$this->db->set('kd_sertifikasi_jenis',$row2->kd_sertifikasi_jenis);
									$this->db->set('kd_satker',$row2->kd_satker);									
									$this->db->where('kd_sertifikasi_jenistarifitem',$row2->kd_sertifikasi_jenistarifitem);
									$this->db->limit(1);
									$this->db->delete('mst_sertifikasi_jenis_tarif_item');
									
									$del3=true;
								}
							}
						}
					}
				}
			}
			return 1;
		}
		return 0;
	}

	function Make_kd_sertifikasi_jenis (){
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		//$prefix="jns-";
		$this->db->order_by('tgl_create','desc');
		$this->db->limit(1);
		$qry=$this->db->get('mst_sertifikasi_jenis');
		if($qry->num_rows()>0){
			$result=$qry->row();
			$arr_urut=explode("-",$result->kd_sertifikasi_jenis );
			$urut=$arr_urut[count($arr_urut)-1];//'05'
			settype($urut,"integer");
			$urut+=1;
		} else { $urut=1; }
		//$kode=$prefix.$urut;
		#cekdulu
		do{
			
			$prefix=$this->session->userdata('profil')->kd_satker."-jns-";
			$kode=$prefix.$urut;
			$this->db->where('kd_sertifikasi_jenis ',$kode);
			$qry=$this->db->get('mst_sertifikasi_jenis');
			$urut++;
		} while($qry->num_rows()>0);
		return $kode;
	}

	//end jenis sertifikasi

    function getTarif($kd_sertifikasi_jenistarif='',$kd_sertifikasi_jenis ='',$result=false) {
    	//$kd_sertifikasi_jenis = 'bpkimi14-jns-1';
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		if($kd_sertifikasi_jenistarif) $this->db->where('kd_sertifikasi_jenistarif',$kd_sertifikasi_jenistarif);
		if($kd_sertifikasi_jenis) $this->db->where('kd_sertifikasi_jenis',$kd_sertifikasi_jenis);
		$this->db->select('kd_sertifikasi_jenistarif,nama_jenistarif ,tgl_create,tgl_update,kd_sertifikasi_jenis,kd_satker');
 		$this->db->order_by('kd_sertifikasi_jenistarif','asc');
	
       	$query = $this->db->get('mst_sertifikasi_jenis_tarif');
        if( $query->num_rows() > 0 ) {
            if($result) return $query->result(); else return $query->row();
        } else {
            return false;
        }
    }


    function GetTotalTarif($nama_jenistarif,$kd_sertifikasi_jenis){
		if($nama_jenistarif){$this->db->like('nama_tarif',$nama_tarif);}
		if($kd_sertifikasi_jenis ){$this->db->like('kd_sertifikasi_jenis ',$kd_sertifikasi_jenis );}
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$this->db->from('mst_sertifikasi_jenis_tarif');
		return $this->db->count_all_results();
	}
	

	function GetResultTarif($nama_jenistarif,$kd_sertifikasi_jenis ,$ord,$srt,$limit,$start){
		if($nama_jenistarif){$this->db->like('nama_jenistarif',$nama_jenistarif);}
		if($kd_sertifikasi_jenis){$this->db->where('kd_sertifikasi_jenis ',$kd_sertifikasi_jenis);}
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$qry=$this->db->get('mst_sertifikasi_jenis_tarif');
		if($qry->num_rows()>0){
			return $qry->result();
		}
		return false;
	}
	
	function SaveTarif($arr,$kd_sertifikasi_jenistarif='',$edit=false){
		if(isset($arr['nama_jenistarif'])) $this->db->set('nama_jenistarif',$arr['nama_jenistarif']);
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->session->userdata('profil')->kd_satker;
		if(isset($arr['kd_sertifikasi_jenis'])) $this->db->set('kd_sertifikasi_jenis',$arr['kd_sertifikasi_jenis']);
		if($edit){
			if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
			else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
			$this->db->where('kd_sertifikasi_jenistarif',$kd_sertifikasi_jenistarif);
			$this->db->update('mst_sertifikasi_jenis_tarif');
		} else {
			if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
			else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
			if(isset($arr['kd_sertifikasi_jenistarif'])) $this->db->set('kd_sertifikasi_jenistarif',$arr['kd_sertifikasi_jenistarif']); 
			else $this->db->set('kd_sertifikasi_jenistarif',$this->Make_kd_sertifikasi_jenistarif());
			$this->db->insert('mst_sertifikasi_jenis_tarif');
		}
	}

	
	

	function Make_kd_sertifikasi_jenistarif(){
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		//$prefix="trf-";
		$this->db->order_by('tgl_create','desc');
		$this->db->limit(1);
		$qry=$this->db->get('mst_sertifikasi_jenis_tarif');
		if($qry->num_rows()>0){
			$result=$qry->row();
			$arr_urut=explode("-",$result->kd_sertifikasi_jenistarif);
			$urut=$arr_urut[count($arr_urut)-1];//'05'
			settype($urut,"integer");
			$urut+=1;
		} else { $urut=1; }
		//$kode=$prefix.$urut;
		#cekdulu
		do{
			$prefix=$this->session->userdata('profil')->kd_satker."-jnt-";
			$kode=$prefix.$urut;
			$this->db->where('kd_sertifikasi_jenistarif',$kode);
			$qry=$this->db->get('mst_sertifikasi_jenis_tarif');
			$urut++;
		} while($qry->num_rows()>0);
		return $kode;
	}
	

    function getDetailTarif($kd_sertifikasi_jenis ) {
	if($this->session->userdata('profil')->groupname != 'super') 
	$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
	$this->db->where('mst_layanan_pengujian.kd_sertifikasi_jenis ',$kd_sertifikasi_jenis );
	$this->db->select('mst_sertifikasi_tarif.*,mst_layanan_pengujian.jenis_tarif');
	$this->db->from('mst_sertifikasi_tarif');
	$this->db->join('mst_layanan_pengujian','mst_sertifikasi_tarif.kd_sertifikasi_jenis =mst_layanan_pengujian.kd_sertifikasi_jenis ');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ) {
            return $query->row();
        } else {
            return false;
        }
    }

    function DeleteTarif($kd_sertifikasi_jenistarif){
		$res=$this->getTarif($kd_sertifikasi_jenistarif);
		if($res){
			$this->db->set('nama_jenistarif ',$res->nama_jenistarif );
			$this->db->set('tgl_create',$res->tgl_create);
			$this->db->set('tgl_update',$res->tgl_update); 
			$this->db->set('kd_sertifikasi_jenis ',$res->kd_sertifikasi_jenis );
			$this->db->set('kd_satker',$res->kd_satker);			
			$this->db->where('kd_sertifikasi_jenistarif',$kd_sertifikasi_jenistarif);
			$this->db->limit(1);
			$this->db->delete('mst_sertifikasi_jenis_tarif');
			
			$res2=$this->getItem('',$kd_sertifikasi_jenistarif,true);
			if($res2){
			//print_r($res2);
				foreach($res2 as $row){
					

					$this->db->set('nama_sertifikasi_jenistarifitem',$row->nama_sertifikasi_jenistarifitem);
					$this->db->set('harga_sertifikasi_jenistarifitem',$row->harga_sertifikasi_jenistarifitem);
					$this->db->set('satuan_sertifikasi_jenistarifitem',$row->satuan_sertifikasi_jenistarifitem);
					$this->db->set('keterangan1_jenistarifitem',$row->keterangan1_jenistarifitem);
					$this->db->set('keterangan2_jenistarifitem',$row->keterangan2_jenistarifitem);	
					$this->db->set('tgl_create',$row->tgl_create);
					$this->db->set('tgl_update',$row->tgl_update);
					$this->db->set('kd_sertifikasi_jenistarif',$row->kd_sertifikasi_jenistarif);
					$this->db->set('kd_sertifikasi_jenis',$row->kd_sertifikasi_jenis);
					$this->db->set('kd_satker',$row->kd_satker);		
					
					$this->db->where('kd_sertifikasi_jenistarifitem',$row->kd_sertifikasi_jenistarifitem);
					$this->db->limit(1);
					$this->db->delete('mst_sertifikasi_jenis_tarif_item');

					
				}
			}
			return 1;
		}
		return 0;
	}

//Star Item
	/*
	function getTarifItem($kd_sertifikasi_jenistarifitem ='',$kd_sertifikasi_jenistarif='',$result=false) {
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		if($kd_sertifikasi_jenistarifitem ) $this->db->where('kd_sertifikasi_jenistarifitem ',$kd_sertifikasi_jenistarifitem );
		if($kd_sertifikasi_jenistarif) $this->db->where('kd_sertifikasi_jenistarif',$kd_sertifikasi_jenistarif);
		$this->db->select('kd_sertifikasi_jenistarifitem ,nama_sertifikasi_jenistarifitem,harga_sertifikasi_jenistarifitem,
						   satuan_sertifikasi_jenistarifitem,keterangan1_jenistarifitem,keterangan2_jenistarifitem 
                           tgl_create,tgl_update,kd_sertifikasi_jenistarif,kd_sertifikasi_jenis,kd_satker');
        	$query = $this->db->get('mst_sertifikasi_jenis_tarif_item');
        	if( $query->num_rows() > 0 ) {
            		if($result) return $query->result(); else return $query->row();
        	} else {
            		return false;
        	}
    }

    */
    
	function getItem($kd_sertifikasi_jenistarifitem='',$kd_sertifikasi_jenistarif='',$result=false) {
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		if($kd_sertifikasi_jenistarifitem) $this->db->where('kd_sertifikasi_jenistarifitem',$kd_sertifikasi_jenistarifitem);
		if($kd_sertifikasi_jenistarif) $this->db->where('kd_sertifikasi_jenistarif',$kd_sertifikasi_jenistarif);
		$this->db->select('kd_sertifikasi_jenistarifitem,nama_sertifikasi_jenistarifitem,harga_sertifikasi_jenistarifitem,
						   satuan_sertifikasi_jenistarifitem,keterangan1_jenistarifitem,keterangan2_jenistarifitem,
                           tgl_create,tgl_update,kd_sertifikasi_jenistarif,kd_sertifikasi_jenis ,kd_satker');
		$this->db->order_by('kd_sertifikasi_jenistarifitem','asc');
        	$query = $this->db->get('mst_sertifikasi_jenis_tarif_item');
        	if( $query->num_rows() > 0 ) {
            		if($result) return $query->result(); else return $query->row();
        	} else {
            		return false;
        	}
    	}

    function GetTotalItem($nama_sertifikasi_jenistarifitem,$harga_sertifikasi_jenistarifitem,$satuan_sertifikasi_jenistarifitem,
    	$keterangan1_jenistarifitem,$keterangan2_jenistarifitem,$kd_sertifikasi_jenistarif){//,$kd_sertifikasi_jenis){
		if($nama_sertifikasi_jenistarifitem){$this->db->like('nama_sertifikasi_jenistarifitem',$nama_sertifikasi_jenistarifitem);}
		if($harga_sertifikasi_jenistarifitem){$this->db->like('harga_sertifikasi_jenistarifitem',$harga_sertifikasi_jenistarifitem);}
		if($satuan_sertifikasi_jenistarifitem){$this->db->like('satuan_sertifikasi_jenistarifitem',$satuan_sertifikasi_jenistarifitem);}
		if($keterangan1_jenistarifitem){$this->db->like('keterangan1_jenistarifitem',$keterangan1_jenistarifitem);}
		if($keterangan2_jenistarifitem){$this->db->like('keterangan2_jenistarifitem',$keterangan2_jenistarifitem);}
		if($kd_sertifikasi_jenistarif){$this->db->like('kd_sertifikasi_jenistarif',$kd_sertifikasi_jenistarif);}
		//if($kd_sertifikasi_jenis){$this->db->like('kd_sertifikasi_jenis',$kd_sertifikasi_jenis);}
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$this->db->from('mst_sertifikasi_jenis_tarif_item');
		return $this->db->count_all_results();
	}
	
	function GetResultItem($nama_sertifikasi_jenistarifitem,$harga_sertifikasi_jenistarifitem,$satuan_sertifikasi_jenistarifitem,
		$keterangan1_jenistarifitem,$keterangan2_jenistarifitem,$kd_sertifikasi_jenistarif,$ord,$srt,$limit,$start){
		if($nama_sertifikasi_jenistarifitem){$this->db->like('nama_sertifikasi_jenistarifitem',$nama_sertifikasi_jenistarifitem);}
		if($harga_sertifikasi_jenistarifitem){$this->db->like('harga_sertifikasi_jenistarifitem',$harga_sertifikasi_jenistarifitem);}
		if($satuan_sertifikasi_jenistarifitem){$this->db->like('satuan_sertifikasi_jenistarifitem',$satuan_sertifikasi_jenistarifitem);}
		if($keterangan1_jenistarifitem){$this->db->like('keterangan1_jenistarifitem',$keterangan1_jenistarifitem);}
		if($keterangan2_jenistarifitem){$this->db->like('keterangan2_jenistarifitem',$keterangan2_jenistarifitem);}
		if($kd_sertifikasi_jenistarif){$this->db->where('kd_sertifikasi_jenistarif',$kd_sertifikasi_jenistarif);}
		//if($kd_sertifikasi_jenis){$this->db->like('kd_sertifikasi_jenis',$kd_sertifikasi_jenis);}
		$this->db->limit($limit,$start);
		$this->db->order_by($ord,$srt);
		if($this->session->userdata('profil')->groupname!='super'){
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		}
		$qry=$this->db->get('mst_sertifikasi_jenis_tarif_item');
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

    /*
    function readTarif($kd_sertifikasi_jenis ){
	if($this->session->userdata('profil')->groupname != 'super') 
	$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
	$this->db->where('customer.kd_sertifikasi_jenis ',$kd_sertifikasi_jenis );
	$this->db->select('customer.*,tipe_customer.tipe_customer as tipe_customer,satker.nama_satker as nama_satker');
	$this->db->from('customer');
	$this->db->join('tipe_customer','customer.kd_tipe_customer=tipe_customer.kd_tipe_customer');
	$this->db->join('satker','customer.kd_satker = satker.kd_satker');
	$this->db->limit(1);
	$result=$this->db->get();
	if($result->num_rows()>0){
			return $result->row();
	}
	return false;
    }
	
    */
	
	
	function SaveItem($arr,$kd_sertifikasi_jenistarifitem='',$edit=false){
		if(isset($arr['nama_sertifikasi_jenistarifitem'])) $this->db->set('nama_sertifikasi_jenistarifitem',$arr['nama_sertifikasi_jenistarifitem']);
		if(isset($arr['harga_sertifikasi_jenistarifitem'])) $this->db->set('harga_sertifikasi_jenistarifitem',$arr['harga_sertifikasi_jenistarifitem']);
		if(isset($arr['satuan_sertifikasi_jenistarifitem'])) $this->db->set('satuan_sertifikasi_jenistarifitem',$arr['satuan_sertifikasi_jenistarifitem']);
		if(isset($arr['keterangan1_jenistarifitem'])) $this->db->set('keterangan1_jenistarifitem',$arr['keterangan1_jenistarifitem']);
		if(isset($arr['keterangan2_jenistarifitem'])) $this->db->set('keterangan2_jenistarifitem',$arr['keterangan2_jenistarifitem']);
		if(isset($arr['kd_sertifikasi_jenistarif'])) $this->db->set('kd_sertifikasi_jenistarif',$arr['kd_sertifikasi_jenistarif']);
		if(isset($arr['kd_sertifikasi_jenis'])) $this->db->set('kd_sertifikasi_jenis',$arr['kd_sertifikasi_jenis']); 
		if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
		else $this->session->userdata('profil')->kd_satker;
		
		
		if($edit){
			if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
			else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
			$this->db->where('kd_sertifikasi_jenistarifitem',$kd_sertifikasi_jenistarifitem);
			$this->db->update('mst_sertifikasi_jenis_tarif_item');
		} else {
			if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
			else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
			if(isset($arr['kd_sertifikasi_jenistarifitem'])) $this->db->set('kd_sertifikasi_jenistarifitem',$arr['kd_sertifikasi_jenistarifitem']); 
			else $this->db->set('kd_sertifikasi_jenistarifitem',$this->Make_kd_item());			
			$this->db->insert('mst_sertifikasi_jenis_tarif_item');
		}
	}
	
		
	function DeleteItem($kd_sertifikasi_jenistarifitem){
		$res=$this->getItem($kd_sertifikasi_jenistarifitem);
		if($res){
			$this->db->set('nama_sertifikasi_jenistarifitem',$res->nama_sertifikasi_jenistarifitem);
			$this->db->set('harga_sertifikasi_jenistarifitem',$res->harga_sertifikasi_jenistarifitem);
			$this->db->set('satuan_sertifikasi_jenistarifitem',$res->satuan_sertifikasi_jenistarifitem);
			$this->db->set('keterangan1_jenistarifitem',$res->keterangan1_jenistarifitem);
			$this->db->set('keterangan2_jenistarifitem',$res->keterangan2_jenistarifitem);	
			$this->db->set('tgl_create',$res->tgl_create);
			$this->db->set('tgl_update',$res->tgl_update);
			$this->db->set('kd_sertifikasi_jenistarif',$res->kd_sertifikasi_jenistarif);
			$this->db->set('kd_sertifikasi_jenis',$res->kd_sertifikasi_jenis);
			$this->db->set('kd_satker',$res->kd_satker);
			
			if($res){
				$this->db->where('kd_sertifikasi_jenistarifitem',$kd_sertifikasi_jenistarifitem);
				$this->db->limit(1);
				$this->db->delete('mst_sertifikasi_jenis_tarif_item');
			}
			return 1;
		}
		return 0;
	}
	
	function Make_kd_item(){
		$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		//$prefix="prm-";
		$this->db->order_by('tgl_create','desc');
		$this->db->limit(1);
		$qry=$this->db->get('mst_sertifikasi_jenis_tarif_item');
		if($qry->num_rows()>0){
			$result=$qry->row();
			$arr_urut=explode("-",$result->kd_sertifikasi_jenistarifitem);
			$urut=$arr_urut[count($arr_urut)-1];//'05'
			settype($urut,"integer");
			$urut+=1;
		} else { $urut=1; }
		//$kode=$prefix.$urut;
		#cekdulu
		do{
			$prefix=$this->session->userdata('profil')->kd_satker."-srt-";
			$kode=$prefix.$urut;
			$this->db->where('kd_sertifikasi_jenistarifitem',$kode);
			$qry=$this->db->get('mst_sertifikasi_jenis_tarif_item');
			$urut++;
		} while($qry->num_rows()>0);
		return $kode;
	}
	
	// Start jenis Sertifikasi	
    public function getKomoditi($kd_sertifikasi_komoditi='') {
	if($kd_sertifikasi_komoditi) $this->db->like('kd_sertifikasi_komoditi',$kd_sertifikasi_komoditi);
	//if($no_sertifikasi_komoditi) $this->db->like('no_sertifikasi_komoditi',$no_sertifikasi_komoditi);
	$this->db->order_by('tgl_update','desc');
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

}
?>