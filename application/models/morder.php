<?php
class mOrder extends CI_Model {
 	var $result;
  function __construct()
  {
        	parent::__construct();
  }
	
  function getJenisLayanan($kd_jenis_layanan=''){
       if($kd_jenis_layanan) $this->db->where('kd_jenis_layanan',$kd_jenis_layanan);
        $query = $this->db->get('mst_jenis_layanan');
        if( $query->num_rows() > 0 ) {
            if($kd_jenis_layanan) return $query->row(); else return $query->result();
        } else {
            return false;
        }
   }
		
  function getOrderSertifikasi($kd_order_sertifikasi='',$noreg_order_sertifikasi='') { 	     
	     if($this->session->userdata('profil')->groupname != 'super' && $this->session->userdata('profil')->groupname != 'admin') {
		          
				if($this->session->userdata('profil')->groupname == 'customer'){
					$this->db->where('nama_perusahaan_pemohon', $this->session->userdata('profil')->nama_perusahaan);
				  } else {
					//$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
				  }
		 }
	     if($kd_order_sertifikasi){ 
		          $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
  	     }
	     if($noreg_order_sertifikasi){
		          $this->db->where('noreg_order_sertifikasi',$noreg_order_sertifikasi);
  	   }
  	   
		   $query = $this->db->get('order_sertifikasi');		
	     
  	   if( $query->num_rows() > 0 ) {
              if($kd_order_sertifikasi) return $query->row(); 
	             else return $query->result();
  	   }else {
            return false;
        }
  }
  function getTotalOrderSertifikasi($noreg_order_sertifikasi,$nama_perusahaan_pemohon,$nama_pabrik,$tglreg_order_sertifikasi, 
      $kd_sertifikasi_jenis,$status_order_sertifikasi,$statusbayar_order_sertifikasi){
      if($this->session->userdata('profil')->groupname != 'super' && $this->session->userdata('profil')->groupname != 'admin'){
		  if($this->session->userdata('profil')->groupname == 'customer'){
				$this->db->where('nama_perusahaan_pemohon', $this->session->userdata('profil')->nama_perusahaan);
			} else {
				$this->db->where('order_sertifikasi.kd_satker',$this->session->userdata('profil')->kd_satker);
			}
	  }
              
    
      if($noreg_order_sertifikasi){
            $this->db->like('noreg_order_sertifikasi',$noreg_order_sertifikasi);}
      //}else { 
      //      $this->db->like('noreg_order_sertifikasi',date("Y"));}
      if($nama_perusahaan_pemohon){ $this->db->like('nama_perusahaan_pemohon',$nama_perusahaan_pemohon);}
      if($nama_pabrik){ $this->db->like('nama_pabrik',$nama_pabrik);}
      if($tglreg_order_sertifikasi){ $this->db->where('tglreg_order_sertifikasi',$tglreg_order_sertifikasi);}
      if($kd_sertifikasi_jenis){
            $this->db->where('order_sertifikasi_komoditi.nama_sertifikasi_jenis',$kd_sertifikasi_jenis);
            $this->db->join('order_sertifikasi_komoditi','order_sertifikasi.kd_order_sertifikasi=order_sertifikasi_komoditi.kd_order_sertifikasi');}
      if($status_order_sertifikasi){ $this->db->like('status_order_sertifikasi',$status_order_sertifikasi);}
      if($statusbayar_order_sertifikasi){ $this->db->like('statusbayar_order_sertifikasi',$statusbayar_order_sertifikasi);}
    
      $this->db->from('order_sertifikasi');
      $result = $this->db->count_all_results();
	  return $result;
  }
 
  function getResultOrderSertifikasi($noreg_order_sertifikasi,$nama_perusahaan_pemohon,$nama_pabrik,$tglreg_order_sertifikasi, 
      $kd_sertifikasi_jenis,$status_order_sertifikasi,$statusbayar_order_sertifikasi,$ord,$srt,$limit,$start){
      if($this->session->userdata('profil')->groupname != 'super' && $this->session->userdata('profil')->groupname != 'admin'){
            if($this->session->userdata('profil')->groupname == 'customer'){
				$this->db->where('nama_perusahaan_pemohon', $this->session->userdata('profil')->nama_perusahaan);
			} else {
				//$this->db->where('order_sertifikasi.kd_satker',$this->session->userdata('profil')->kd_satker);//
			}
			
	  }
      if($noreg_order_sertifikasi){
            $this->db->like('noreg_order_sertifikasi',$noreg_order_sertifikasi); 
      }//else {
             //order tertampil default hanya pada taun yang sedang berjalan
       //     $this->db->like('noreg_order_sertifikasi',date("Y"));               }
      if($nama_perusahaan_pemohon){$this->db->like('nama_perusahaan_pemohon',$nama_perusahaan_pemohon);}
      if($nama_pabrik){$this->db->like('nama_pabrik',$nama_pabrik);}     
      if($tglreg_order_sertifikasi){$this->db->where('tglreg_order_sertifikasi',$tglreg_order_sertifikasi);}
       if($kd_sertifikasi_jenis){
            $this->db->where('order_sertifikasi_komoditi.kd_sertifikasi_jenis',$kd_sertifikasi_jenis);
            $this->db->join('order_sertifikasi_komoditi','order_sertifikasi.kd_order_sertifikasi=order_sertifikasi_komoditi.kd_order_sertifikasi');}
      if($status_order_sertifikasi){ $this->db->like('status_order_sertifikasi',$status_order_sertifikasi);}
      if($statusbayar_order_sertifikasi){ $this->db->like('statusbayar_order_sertifikasi',$statusbayar_order_sertifikasir);}
    
    
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);   
      
      $this->db->select('order_sertifikasi.*'); 
      $this->db->distinct('order_sertifikasi.noreg_order_sertifikasi');             
      $this->db->from('order_sertifikasi');
    
    
      $qry=$this->db->get();
      if($qry->num_rows()>0){
            return $qry->result();
      }
      return false;
  }

  function getHistoriSertifikasi($kd_order_sertifikasi='') { 	   
	     if($this->session->userdata('profil')->groupname != 'super') 
		        $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
	     if($kd_order_sertifikasi){
		        $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
  	   }
  	
	     $query = $this->db->get('histori_status_order_sertifikasi');
		      
  	   if( $query->num_rows() > 0 ) {
              if($kd_order) return $query->row(); 
	             else return $query->result();
  	   }else {
            return false;
       }
  }

   function getStatusOrderSertifikasi($kd_order_sertifikasi='',$status_order_sertifikasi='') {
        if($kd_order_sertifikasi) $this->db->where('order_sertifikasi.kd_order_sertifikasi',$kd_order_sertifikasi);
        if($status_order_sertifikasi) $this->db->where('order_sertifikasi.$status_order_sertifikasi',$status_order_sertifikasi);
    
        $query = $this->db->get('order_sertifikasi');
        if( $query->num_rows() > 0 ) {

            if($kd_order_sertifikasi) return $query->row(); 
        } else {
            return false;
        }
      }

  function Make_kd_order_sertifikasi(){
    
          $this->db->like('kd_order_sertifikasi',date("Y"));
			if($this->session->userdata('profil')->groupname == 'customer'){
				$this->db->where('nama_perusahaan_pemohon',$this->session->userdata('profil')->nama_perusahaan);
			} else {
				$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
			}	  
          
          $this->db->order_by('tgl_create','desc');
          $this->db->limit(1);
          $qry=$this->db->get('order_sertifikasi');
          if($qry->num_rows()>0){
                $result=$qry->row();
                $arr_urut=explode("-",$result->kd_order_sertifikasi);
                $urut=$arr_urut[count($arr_urut)-1];//'05'
                settype($urut,"integer");
                $urut+=1;
          } else { $urut=1; }
          #cekdulu
          do{
                $prefix=$this->session->userdata('profil')->kd_satker."-ord-s-".date("Y")."-";
                $kode=$prefix.$urut;
                $this->db->where('kd_order_sertifikasi',$kode);
                $qry=$this->db->get('order_sertifikasi');
                $urut++;
          } while($qry->num_rows()>0);
          return $kode;
  }

  function Make_no_order_sertifikasi(){
          //$knm = $this->session->userdata('profil')->kd_satker;
          //$nama = $this->mstaff->getNamaSatker($knm);
    
          $this->db->like('noreg_order_sertifikasi',date("Y"));
		  if($this->session->userdata('profil')->groupname == 'customer'){
			$this->db->where('nama_perusahaan_pemohon', $this->session->userdata('profil')->nama_perusahaan);
		  } else {
			$this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
		  }
          $this->db->order_by('tgl_create','desc');
          $this->db->limit(1);
          $qry=$this->db->get('order_sertifikasi');
          $tahun='';
          if($qry->num_rows()>0){
              $result=$qry->row();
              $arr_urut=explode("/",$result->noreg_order_sertifikasi);
              $urut=$arr_urut[0];
              $tahun=$arr_urut[3];
              settype($urut,"integer");
                $urut+=1;
          } else { 
              $urut=1;
          }
          #cekdulu
          do{
              //$prefix = $nama->singkatan_satker."/S/".date("m")."/".date("Y");      
              $prefix = "/S/".date("m")."/".date("Y");   
              $kode = $urut."/".$prefix;
              $this->db->where('noreg_order_sertifikasi',$kode);
              $qry=$this->db->get('order_sertifikasi');
              $urut++;
          } while($qry->num_rows()>0);
          return $kode;
  }

  function Make_no_order_sertifikasi_smm(){
          $knm = $this->session->userdata('profil')->kd_satker;
          $nama = $this->mstaff->getNamaSatker($knm);
    
          $this->db->like('noreg_order_sertifikasi',date("Y"));
          $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
          $this->db->order_by('tgl_create','desc');
          $this->db->limit(1);
          $qry=$this->db->get('order_sertifikasi');
          $tahun='';
          if($qry->num_rows()>0){
              $result=$qry->row();
              $arr_urut=explode("/",$result->noreg_order_sertifikasi);
              $urut=$arr_urut[0];
              $tahun=$arr_urut[3];
              settype($urut,"integer");
                $urut+=1;
          } else { 
              $urut=1;
          }
          #cekdulu
          do{
              $prefix = $nama->singkatan_satker."/SMM/".date("m")."/".date("Y");      
              $kode = $urut."/".$prefix;
              $this->db->where('noreg_order_sertifikasi',$kode);
              $qry=$this->db->get('order_sertifikasi');
              $urut++;
          } while($qry->num_rows()>0);
          return $kode;
  }

  function Make_no_order_sertifikasi_lspro(){
          $knm = $this->session->userdata('profil')->kd_satker;
          $nama = $this->mstaff->getNamaSatker($knm);
    
          $this->db->like('noreg_order_sertifikasi',date("Y"));
          $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
          $this->db->order_by('tgl_create','desc');
          $this->db->limit(1);
          $qry=$this->db->get('order_sertifikasi');
          $tahun='';
          if($qry->num_rows()>0){
              $result=$qry->row();
              $arr_urut=explode("/",$result->noreg_order_sertifikasi);
              $urut=$arr_urut[0];
              $tahun=$arr_urut[3];
              settype($urut,"integer");
                $urut+=1;
          } else { 
              $urut=1;
          }
          #cekdulu
          do{
              $prefix = $nama->singkatan_satker."/LSPRO/".date("m")."/".date("Y");      
              $kode = $urut."/".$prefix;
              $this->db->where('noreg_order_sertifikasi',$kode);
              $qry=$this->db->get('order_sertifikasi');
              $urut++;
          } while($qry->num_rows()>0);
          return $kode;
  }

  function getSmmList4DropDown(){
    $qry=$this->db->get('mst_sertifikasi_smm');
    $result=array('');
    if($qry->num_rows()>0){
      foreach($qry->result() as $row){
        $result[$row->kd_sertifikasi_smm]=$row->nama_sertifikasi_smm ;
      }
    }
    return $result;
  }

  function getSmm($kd_sertifikasi_smm='',$result=false) {
    if($this->session->userdata('profil')->groupname!='super'){
      $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    }
    if($kd_sertifikasi_smm) $this->db->where('kd_sertifikasi_smm',$kd_sertifikasi_smm);
    $this->db->select('kd_sertifikasi_smm,nama_sertifikasi_smm ,tgl_create,tgl_update,kd_satker');
    $this->db->order_by('kd_sertifikasi_smm','desc');
  
        $query = $this->db->get('mst_sertifikasi_smm');
        if( $query->num_rows() > 0 ) {
            if($result) return $query->result(); else return $query->row();
        } else {
            return false;
        }
    }

   function getJenisTahapan($kd_sertifikasi_tahapan='',$result=false) {
    if($this->session->userdata('profil')->groupname!='super'){
      if($this->session->userdata('profil')->groupname != 'customer'){
		  $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
	  }
    }
    if($kd_sertifikasi_tahapan) $this->db->where('kd_sertifikasi_tahapan',$kd_sertifikasi_tahapan);
    $this->db->select('kd_sertifikasi_tahapan,nama_sertifikasi_tahapan ,tgl_create,tgl_update,kd_satker');
    $this->db->order_by('kd_sertifikasi_tahapan','desc');
  
        $query = $this->db->get('mst_sertifikasi_tahapan');
        if( $query->num_rows() > 0 ) {
            if($result) return $query->result(); else return $query->row();
        } else {
            return false;
        }
    }


  function getTahapanList4DropDown(){
    $qry=$this->db->get('mst_sertifikasi_tahapan');
    $result=array('');
    if($qry->num_rows()>0){
      foreach($qry->result() as $row){
        $result[$row->kd_sertifikasi_tahapan]=$row->nama_sertifikasi_tahapan ;
      }
    }
    return $result;
  }

  function getStatusList4DropDown(){
    $qry=$this->db->get('mst_sertifikasi_step_status');
    $result=array('');
    if($qry->num_rows()>0){
      foreach($qry->result() as $row){
        $result[$row->kd_step_status]=$row->nama_step_status ;
      }
    }
    return $result;
  }



  function saveOrderSertifikasi($arr,$kd_order_sertifikasi='',$edit=false){    
      
      if(isset($arr['nama_perusahaan_pemohon'])) $this->db->set('nama_perusahaan_pemohon',$arr['nama_perusahaan_pemohon']);
      if(isset($arr['alamat_perusahaan_pemohon'])) $this->db->set('alamat_perusahaan_pemohon',$arr['alamat_perusahaan_pemohon']);      
      if(isset($arr['telpon_perusahaan_pemohon'])) $this->db->set('telpon_perusahaan_pemohon',$arr['telpon_perusahaan_pemohon']);
      if(isset($arr['fax_perusahaan_pemohon'])) $this->db->set('fax_perusahaan_pemohon',$arr['fax_perusahaan_pemohon']);

      if(isset($arr['nama_perusahaan_importir'])) $this->db->set('nama_perusahaan_importir',$arr['nama_perusahaan_importir']);
      if(isset($arr['alamat_perusahaan_importir'])) $this->db->set('alamat_perusahaan_importir',$arr['alamat_perusahaan_importir']);      
      if(isset($arr['telpon_perusahaan_importir'])) $this->db->set('telpon_perusahaan_importir',$arr['telpon_perusahaan_importir']);
      if(isset($arr['fax_perusahaan_importir'])) $this->db->set('fax_perusahaan_importir',$arr['fax_perusahaan_importir']);
      if(isset($arr['no_api_perusahaan_importir'])) $this->db->set('no_api_perusahaan_importir',$arr['no_api_perusahaan_importir']);

      if(isset($arr['nm_kontak_perusahaan_pemohon'])) $this->db->set('nm_kontak_perusahaan_pemohon',$arr['nm_kontak_perusahaan_pemohon']);
      if(isset($arr['nohp_kontak_perusahaan_pemohon'])) $this->db->set('nohp_kontak_perusahaan_pemohon',$arr['nohp_kontak_perusahaan_pemohon']);
      if(isset($arr['email_kontak_perusahaan_pemohon'])) $this->db->set('email_kontak_perusahaan_pemohon',$arr['email_kontak_perusahaan_pemohon']);
      
      /*if(isset($arr['nama_pabrik'])) $this->db->set('nama_pabrik',$arr['nama_pabrik']);
      if(isset($arr['jumlah_karyawan_pabrik'])) $this->db->set('jumlah_karyawan_pabrik',$arr['jumlah_karyawan_pabrik']);
      if(isset($arr['alamat_pabrik'])) $this->db->set('alamat_pabrik',$arr['alamat_pabrik']);
      if(isset($arr['negara_pabrik'])) $this->db->set('negara_pabrik',$arr['negara_pabrik']);*/
      
      if(isset($arr['kd_sertifikasi_smm'])) $this->db->set('kd_sertifikasi_smm',$arr['kd_sertifikasi_smm']);
      
      if(isset($arr['noreg_order_sertifikasi'])) $this->db->set('noreg_order_sertifikasi',$arr['noreg_order_sertifikasi']);
      if(isset($arr['tglreg_order_sertifikasi']))$this->db->set('tglreg_order_sertifikasi',$arr['tglreg_order_sertifikasi']);

      if(isset($arr['kd_sertifikasi_jenis']))$this->db->set('kd_sertifikasi_jenis',$arr['kd_sertifikasi_jenis']);

      if(isset($arr['status_order_sertifikasi']))$this->db->set('status_order_sertifikasi',$arr['status_order_sertifikasi']);
      if(isset($arr['statusbayar_order_sertifikasi']))$this->db->set('statusbayar_order_sertifikasi',$arr['statusbayar_order_sertifikasi']);

      if(isset($arr['hargatotal_order_sertifikasi']))$this->db->set('hargatotal_order_sertifikasi',$arr['hargatotal_order_sertifikasi']);
      if(isset($arr['jmlbayar_order_sertifikasi']))$this->db->set('jmlbayar_order_sertifikasi',$arr['jmlbayar_order_sertifikasi']);
      if(isset($arr['ppn_order_sertifikasi']))$this->db->set('ppn_order_sertifikasi',$arr['ppn_order_sertifikasi']);

      if(isset($arr['kd_sertifikasi_tahapan']))$this->db->set('kd_sertifikasi_tahapan',$arr['kd_sertifikasi_tahapan']);
      if(isset($arr['kd_sertifikasi_jenistarif']))$this->db->set('kd_sertifikasi_jenistarif',$arr['kd_sertifikasi_jenistarif']);
      if(isset($arr['kd_sertifikasi_jenis']))$this->db->set('kd_sertifikasi_jenis',$arr['kd_sertifikasi_jenis']);
      if(isset($arr['kd_jenis_layanan']))$this->db->set('kd_jenis_layanan',$arr['kd_jenis_layanan']);

      if(isset($arr['nip_penerima'])) $this->db->set('nip_penerima',$arr['nip_penerima']);
      if(isset($arr['nm_penerima'])) $this->db->set('nm_penerima',$arr['nm_penerima']);
      if(isset($arr['keterangan'])) $this->db->set('keterangan',$arr['keterangan']);
      if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
          //else $this->db->set('kd_satker',$this->session->userdata('profil')->kd_satker);
      
     
      if($edit){
          if(isset($arr['status_order_sertifikasi'])) $this->db->set('status_order_sertifikasi',$arr['status_order_sertifikasi']);
          if(isset($arr['statusbayar_order_sertifikasi'])) $this->db->set('statusbayar_order_sertifikasi',$arr['statusbayar_order_sertifikasi']);
          $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
          $this->db->update('order_sertifikasi');

      } else {
          if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
              else $this->db->set('tgl_create',date('Y-m-d'));
          if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
              else $this->db->set('kd_order_sertifikasi',$this->Make_kd_order_sertifikasi()); 
          if(isset($arr['noreg_order_sertifikasi'])) $this->db->set('noreg_order_sertifikasi',$arr['noreg_order_sertifikasi']); 
              else $this->db->set('noreg_order_sertifikasi',$this->Make_no_order_sertifikasi());     
      
          //insert ke tabel order_sertifikasi
          $this->db->insert('order_sertifikasi');

          //insert ke tabel status_order_sertifikasi
          if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
              else $this->db->set('kd_order_sertifikasi',$this->Make_kd_order_sertifikasi());

          if(isset($arr['noreg_order_sertifikasi'])) $this->db->set('noreg_order_sertifikasi',$arr['noreg_order_sertifikasi']); //tambhan 05/03/2013
              else $this->db->set('noreg_order_sertifikasi',$this->Make_no_order_sertifikasi());

          if(isset($arr['status_order_sertifikasi'])) $this->db->set('kd_step_status','Teregistrasi'); 
              else $this->db->set('kd_step_status','Teregistrasi'); 

          if(isset($arr['status_order_sertifikasi'])) $this->db->set('nama_step_status',$step_status->nama_step_status); 
              else $this->db->set('nama_step_status','Proses Registrasi Permhonan Sertifikasi');
        
          if(isset($arr['nip'])) $this->db->set('nip',$arr['nip']); 
          else{
			  if($this->session->userdata('profil')->groupname == 'customer'){
				  $this->db->set('nip',$this->session->userdata('userid'));
				} else {
					 $dat=$this->mUser->getDetail($this->session->userdata('userid')); 
              $this->db->set('nip',$dat->nip_baru);
				}
             
          }
           if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
              else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
          if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
              else $this->db->set('kd_satker',$this->session->userdata('profil')->kd_satker);
          $this->db->insert('order_sertifikasi_status');

               
      }
    return true;  
  }

  function getHistoriStatusOrder($kd_order_sertifikasi) {
    if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi); 
    $this->db->order_by('tgl_create','asc');         
    $query = $this->db->get('histori_status_order_sertifikasi');
          if( $query->num_rows() > 0 ) {
                return $query->result();
          } else {
              return false;
          }   
  }
  
  function saveHistoriStatusOrder($arr,$kd_order_sertifikasi=''){
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order',$kd_order);
    if(isset($arr['noreg_order_sertifikasi'])) $this->db->set('noreg_order_sertifikasi',$arr['noreg_order_sertifikasi']); 
    if(isset($arr['status_order_sertifikasi'])) $this->db->set('status_order_sertifikasi',$arr['status_order_sertifikasi']); 
      else $this->db->set('status_order_sertifikasi',$status_order);
    if(isset($arr['tgl_create']))$this->db->set('tgl_create',$arr['tgl_create']); 
      else $this->db->set('tgl_create',date("Y-m-d H:i:s"));
    if(isset($arr['nip']))$this->db->set('nip',$arr['nip']); 
      else $this->db->set('nip',$this->session->userdata('userid'));  
    if(isset($arr['keterangan'])) $this->db->set('keterangan',$arr['keterangan']); 
      else $this->db->set('keterangan',$aktivitas);
    if(isset($arr['komentar'])) $this->db->set('komentar',$arr['komentar']); 
      else $this->db->set('komentar',$komentar);
    if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
      else $this->db->set('kd_satker',$this->session->userdata('profil')->kd_satker); 

    $this->db->insert('histori_status_order_sertifikasi');

  }

  function getSertifikasiStepStatus($kd_step_status) {
    if($kd_step_status) $this->db->where('kd_step_status',$kd_step_status); 
    $this->db->order_by('id_step_status','asc');         
    $query = $this->db->get('mst_sertifikasi_step_status');
          if( $query->num_rows() > 0 ) {
                 return $query->row();
          } else {
              return false;
          }   
  }

  function getOrderSertifikasiStatus($kd_order_sertifikasi) {
    if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi); 
    //$this->db->order_by('tgl_create','asc');         
    $query = $this->db->get('order_sertifikasi_status');
          if( $query->num_rows() > 0 ) {
                return $query->result();
          } else {
              return false;
          }   
  }

  function saveOrderSertifikasiStatus($arr,$kd_order_sertifikasi=''){
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$kd_order_sertifikasi);
    if(isset($arr['noreg_order_sertifikasi'])) $this->db->set('noreg_order_sertifikasi',$arr['noreg_order_sertifikasi']); 
    if(isset($arr['kd_step_status'])) $this->db->set('kd_step_status',$arr['kd_step_status']); 
      else $this->db->set('kd_step_status',$kd_step_status);
    if(isset($arr['nama_step_status'])) $this->db->set('nama_step_status',$arr['nama_step_status']); 
      else $this->db->set('nama_step_status',$nama_step_status);
    if(isset($arr['nip']))$this->db->set('nip',$arr['nip']); 
      else $this->db->set('nip',$this->session->userdata('userid'));  
    if(isset($arr['tgl_create']))$this->db->set('tgl_create',$arr['tgl_create']); 
      else $this->db->set('tgl_create',date("Y-m-d H:i:s"));
    if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
      else $this->db->set('kd_satker',$this->session->userdata('profil')->kd_satker); 
    $this->db->insert('order_sertifikasi_status');

  }

  function getOrderPabrik($kd_order_pabrik='',$kd_order_sertifikasi='') {
      if($kd_order_pabrik) $this->db->where('kd_order_pabrik',$kd_order_pabrik);
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
       
      $query = $this->db->get('order_sertifikasi_pabrik'); 
      
      if( $query->num_rows() > 0 ) {
            if($kd_order_pabrik) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
    }


  function getTotalOrderPabrik($kd_order_sertifikasi,$kd_order_pabrik){   
          if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_pabrik.kd_order_sertifikasi',$kd_order_sertifikasi);
          if($kd_order_pabrik) $this->db->where('order_sertifikasi_pabrik.kd_order_pabrik',$kd_order_pabrik);
             $this->db->from('order_sertifikasi_pabrik');                         
          return $this->db->count_all_results();
    }
      
  
  function getResultOrderPabrik($kd_order_sertifikasi,$kd_order_pabrik,$ord,$srt,$limit,$start){
          $this->db->limit($limit,$start);
          $this->db->order_by($ord,$srt);
          if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_pabrik.kd_order_sertifikasi',$kd_order_sertifikasi);
          if($kd_order_pabrik) $this->db->where('order_sertifikasi_pabrik.kd_order_pabrik',$kd_order_pabrik);          
      
          $this->db->select('order_sertifikasi_pabrik.*'); 
          $this->db->from('order_sertifikasi_pabrik');
          //$this->db->join('order_sertifikasi','order_sertifikasi.kd_order_sertifikasi=order_sertifikasi_komoditi.kd_order_sertifikasi');
          $qry=$this->db->get();
       
          if($qry->num_rows()>0){
            return $qry->result(); 
           }
          return false;
  }


  function Make_kd_order_pabrik(){    
    $this->db->like('kd_order_pabrik',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');
    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_pabrik');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_pabrik);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-opbk-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_order_pabrik',$kode);
      $qry=$this->db->get('order_sertifikasi_pabrik');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

  function deleteOrderPabrik($kd_order_sertifikasi,$kd_order_pabrik=''){
      if($kd_order_pabrik){
            if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
            $this->db->delete('order_sertifikasi_pabrik', array('kd_order_pabrik' => $kd_order_pabrik)); 
      }else{
            if($kd_order_sertifikasi) $this->db->delete('order_sertifikasi_pabrik', array('kd_order_sertifikasi)' => $kd_order_sertifikasi)); 
      }
  }

  function saveOrderPabrik($arr,$kd_order_sertifikasi='',$edit=false){
    if(isset($arr['kd_order_pabrik'])) $this->db->set('kd_order_pabrik',$arr['kd_order_pabrik']); 
    if(isset($arr['nama_pabrik'])) $this->db->set('nama_pabrik',$arr['nama_pabrik']);   
    if(isset($arr['alamat_pabrik'])) $this->db->set('alamat_pabrik',$arr['alamat_pabrik']);
    if(isset($arr['telepon_pabrik'])) $this->db->set('telepon_pabrik',$arr['telepon_pabrik']);
    if(isset($arr['fax_pabrik'])) $this->db->set('fax_pabrik',$arr['fax_pabrik']);
    if(isset($arr['negara_pabrik'])) $this->db->set('negara_pabrik',$arr['negara_pabrik']);  
    if(isset($arr['jumlah_karyawan_pabrik'])) $this->db->set('jumlah_karyawan_pabrik',$arr['jumlah_karyawan_pabrik']);
    if(isset($arr['kd_sertifikasi_smm'])) $this->db->set('kd_sertifikasi_smm',$arr['kd_sertifikasi_smm']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
    if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
      else $this->session->userdata('profil')->kd_satker;    
   
    if($edit){ 
      if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
      else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
      $this->db->where('kd_order_pabrik',$arr['kd_order_pabrik']);
      $this->db->update('order_sertifikasi_pabrik');
    } else {

      if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
          else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
      if(isset($arr['kd_order_pabrik'])) $this->db->set('kd_order_pabrik',$arr['kd_order_pabrik']); 
          else $this->db->set('kd_order_pabrik',$this->Make_kd_order_pabrik());
      $this->db->insert('order_sertifikasi_pabrik');
      //return $kd_customer;
    }
  }

  function getOrderKomoditi($kd_order_komoditi='',$kd_order_sertifikasi='') {
      if($kd_order_komoditi) $this->db->where('kd_order_komoditi',$kd_order_komoditi);
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
       
      $query = $this->db->get('order_sertifikasi_komoditi'); 
      
      if( $query->num_rows() > 0 ) {
            if($kd_order_komoditi) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
    }


  function getTotalOrderKomoditi($kd_order_sertifikasi,$kd_order_komoditi){
     
          if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_komoditi.kd_order_sertifikasi',$kd_order_sertifikasi);     
          if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_komoditi.kd_order_sertifikasi',$kd_order_sertifikasi);
          if($kd_order_komoditi) $this->db->where('order_sertifikasi_komoditi.kd_order_komoditi',$kd_order_komoditi);
             $this->db->from('order_sertifikasi_komoditi');                         
          return $this->db->count_all_results();
    }
      
  
  function getResultOrderKomoditi($kd_order_sertifikasi,$kd_order_komoditi,$ord,$srt,$limit,$start){
          $this->db->limit($limit,$start);
          $this->db->order_by($ord,$srt);
          if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_komoditi.kd_order_sertifikasi',$kd_order_sertifikasi);
          if($kd_order_komoditi) $this->db->where('order_sertifikasi_komoditi.kd_order_komoditi',$kd_order_komoditi);          
      
          $this->db->select('order_sertifikasi_komoditi.*'); 
          $this->db->from('order_sertifikasi_komoditi');
          //$this->db->join('order_sertifikasi','order_sertifikasi.kd_order_sertifikasi=order_sertifikasi_komoditi.kd_order_sertifikasi');
          $qry=$this->db->get();
       
          if($qry->num_rows()>0){
            return $qry->result(); 
           }
          return false;
  }


  function Make_kd_order_komoditi(){    
    $this->db->like('kd_order_komoditi',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');
    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_komoditi');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_komoditi);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-okti-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_order_komoditi',$kode);
      $qry=$this->db->get('order_sertifikasi_komoditi');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

  function deleteOrderKomoditi($kd_order_sertifikasi,$kd_order_komoditi=''){
      if($kd_order_komoditi){
            if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
            $this->db->delete('order_sertifikasi_komoditi', array('kd_order_komoditi' => $kd_order_komoditi)); 
      }else{
            if($kd_order_sertifikasi) $this->db->delete('order_sertifikasi_komoditi', array('kd_order_sertifikasi)' => $kd_order_sertifikasi)); 
      }
  }

  function saveOrderKomoditi($arr,$kd_order_sertifikasi='',$edit=false){
    if(isset($arr['kd_order_komoditi'])) $this->db->set('kd_order_komoditi',$arr['kd_order_komoditi']); 
    if(isset($arr['kd_sertifikasi_komoditi'])) $this->db->set('kd_sertifikasi_komoditi',$arr['kd_sertifikasi_komoditi']);   
    if(isset($arr['no_sertifikasi_komoditi'])) $this->db->set('no_sertifikasi_komoditi',$arr['no_sertifikasi_komoditi']);
    if(isset($arr['nama_sertifikasi_komoditi'])) $this->db->set('nama_sertifikasi_komoditi',$arr['nama_sertifikasi_komoditi']);
    if(isset($arr['tipe_sertifikasi_komoditi'])) $this->db->set('tipe_sertifikasi_komoditi',$arr['tipe_sertifikasi_komoditi']);
    if(isset($arr['jenis_produk_komoditi'])) $this->db->set('jenis_produk_komoditi',$arr['jenis_produk_komoditi']);  
    if(isset($arr['merk_dagang_komoditi'])) $this->db->set('merk_dagang_komoditi',$arr['merk_dagang_komoditi']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
    if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
      else $this->session->userdata('profil')->kd_satker;    
   
    if($edit){ 
      if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
      else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
      $this->db->where('kd_order_komoditi',$arr['kd_order_komoditi']);
      $this->db->update('order_sertifikasi_komoditi');
    } else {

      if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
          else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
      if(isset($arr['kd_order_komoditi'])) $this->db->set('kd_order_komoditi',$arr['kd_order_komoditi']); 
          else $this->db->set('kd_order_komoditi',$this->Make_kd_order_komoditi());
      $this->db->insert('order_sertifikasi_komoditi');
      //return $kd_customer;
    }
  }

 function getOrderDokumen($kd_order_sertifikasi_dokumen='',$kd_order_sertifikasi='') {
      if($kd_order_sertifikasi_dokumen) $this->db->where('kd_order_sertifikasi_dokumen',$kd_order_sertifikasi_dokumen);
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
       
      $query = $this->db->get('order_sertifikasi_dokumen'); 
      
      if( $query->num_rows() > 0 ) {
            if($kd_order_sertifikasi_dokumen) return $query->row(); 
            else if($kd_order_sertifikasi) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
    }


  function getTotalOrderDokumen($kd_order_sertifikasi,$kd_order_sertifikasi_dokumen){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_dokumen.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_sertifikasi_dokumen) $this->db->where('order_sertifikasi_dokumen.kd_order_sertifikasi_dokumen',$kd_order_sertifikasi_dokumen);
      $this->db->from('order_sertifikasi_dokumen'); 
     
        return $this->db->count_all_results();
  }
  
  function getResultOrderDokumen($kd_order_sertifikasi,$kd_order_sertifikasi_dokumen,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_dokumen.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_sertifikasi_dokumen) $this->db->where('order_sertifikasi_dokumen.kd_order_sertifikasi_dokumen',$kd_order_sertifikasi_dokumen);
      
      $this->db->select('order_sertifikasi_dokumen.*,order_sertifikasi.*'); 
      $this->db->from('order_sertifikasi_dokumen');
      $this->db->join('order_sertifikasi','order_sertifikasi.kd_order_sertifikasi=order_sertifikasi_dokumen.kd_order_sertifikasi');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }


   function getOrderDokumenList($kd_sertifikasi_dokumen='',$kd_order_sertifikasi_dokumen='',$kd_order_sertifikasi='') {
      if($kd_sertifikasi_dokumen) $this->db->where('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);
      if($kd_order_sertifikasi_dokumen) $this->db->where('kd_order_sertifikasi_dokumen',$kd_order_sertifikasi_dokumen);
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
       
      $query = $this->db->get('order_sertifikasi_dokumen_list'); 
      
      if( $query->num_rows() > 0 ) {
            if($kd_sertifikasi_dokumen && $kd_order_sertifikasi_dokumen) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
    }
    
   function getTotalOrderDokumenList($kd_order_sertifikasi,$kd_order_sertifikasi_dokumen){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_dokumen_list.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_sertifikasi_dokumen) $this->db->where('order_sertifikasi_dokumen.kd_order_sertifikasi_dokumen',$kd_order_sertifikasi_dokumen);
      $this->db->from('order_sertifikasi_dokumen_list'); 
     
        return $this->db->count_all_results();
  }
  
  function getResultOrderDokumenList($kd_order_sertifikasi,$kd_order_sertifikasi_dokumen,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_sertifikasi_dokumen) $this->db->where('order_sertifikasi_dokumen.kd_order_sertifikasi_dokumen',$kd_order_sertifikasi_dokumen);
      
      $this->db->select('order_sertifikasi_dokumen_list.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_dokumen_list');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_order_sertifikasi_dokumen=order_sertifikasi_dokumen_list.kd_order_sertifikasi_dokumen');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

function saveOrderDokumen($kd_order_sertifikasi_dokumen, $kd_sertifikasi_dokumen, $file_name){
	// It's a function to save document uploaded by customers
	// Save its name and path (file_sertifikasi_dokumen)
	// Save uploaded document by editing existing record in table
	// Update status sertifikasi documen and update file sertifikasi dokumen
	
	$this->db->set('status_sertifikasi_dokumen', 'Sudah Upload, Belum Diverifikasi');
	$this->db->set('file_sertifikasi_dokumen ', $file_name);
	$this->db->where('kd_order_sertifikasi_dokumen', $kd_order_sertifikasi_dokumen);
	$this->db->where('kd_sertifikasi_dokumen', $kd_sertifikasi_dokumen);
	$this->db->update('order_sertifikasi_dokumen_list');
	
	return true;
}

function verifikasiDokumen($kd_order_sertifikasi_dokumen, $kd_sertifikasi_dokumen){
	$this->db->set('status_sertifikasi_dokumen', 'Sudah Diverifikasi');
	$this->db->where('kd_order_sertifikasi_dokumen', $kd_order_sertifikasi_dokumen);
	$this->db->where('kd_sertifikasi_dokumen', $kd_sertifikasi_dokumen);
	$this->db->update('order_sertifikasi_dokumen_list');
	
	return true;
}

function getOrderSertifikasiByID($kd_order_sertifikasi){
	$this->db->where('kd_order_sertifikasi', $kd_order_sertifikasi);
	return $this->db->get('order_sertifikasi')->row();
}

function createNewSertifikasiDokumen($order_sertifikasi){
	$kd_order_sertifikasi_dokumen = $this->Make_kd_order_sertifikasi_dokumen();
	
	// create new record
	$this->db->set('kd_order_sertifikasi_dokumen', $kd_order_sertifikasi_dokumen);
	$this->db->set('tgl_dokumen_diterima', date('Y-m-d'));
	$this->db->set('nama_penyerah_dokumen', $order_sertifikasi->nm_kontak_perusahaan_pemohon);
	$this->db->set('kd_order_sertifikasi', $order_sertifikasi->kd_order_sertifikasi);
	$this->db->set('kd_sertifikasi_jenistarif', $order_sertifikasi->	kd_sertifikasi_jenistarif);
	$this->db->set('kd_sertifikasi_jenis	', $order_sertifikasi->kd_sertifikasi_jenis);
	
	$this->db->insert('order_sertifikasi_dokumen');
	
	// get inserted record
	$this->db->where('kd_order_sertifikasi_dokumen', $kd_order_sertifikasi_dokumen);
	return $this->db->get('order_sertifikasi_dokumen')->row();
}
function createEmptyDocuments($kd_order_sertifikasi){
	// this is a function to create blank list of documents that must be uploaded by customer
	
	//get order sertifikasi
	$order_sertifikasi = $this->getOrderSertifikasiByID($kd_order_sertifikasi);
	
	//create new order sertifikasi dokumen
	$order_sertifikasi_dokumen = $this->createNewSertifikasiDokumen($order_sertifikasi);
	
	// get required documents based on jenis tarif of an order sertifikasi
	// every jenis tarif has different documents to be uploaded
	$this->db->where('kd_sertifikasi_jenistarif', $order_sertifikasi->kd_sertifikasi_jenistarif);
	$docList = $this->db->get('mst_sertifikasi_jenis_tarif_dokumen')->result();
    
	foreach($docList as $d){
		$this->db->set('kd_sertifikasi_dokumen',$d->kd_sertifikasi_dokumen);
		$this->db->set('nama_sertifikasi_dokumen',$d->nama_sertifikasi_dokumen);
		$this->db->set('kd_order_sertifikasi_dokumen', $order_sertifikasi_dokumen->kd_order_sertifikasi_dokumen);
		$this->db->set('kd_order_sertifikasi', $kd_order_sertifikasi);
		$this->db->set('kd_sertifikasi_jenistarif', $d->kd_sertifikasi_jenistarif);
		$this->db->set('kd_sertifikasi_jenis', $d->kd_sertifikasi_jenis);        
		$this->db->set('kd_satker', $d->kd_satker);
		$this->db->set('tgl_create', $d->tgl_create);
		$this->db->insert('order_sertifikasi_dokumen_list'); 
	}
	return true;
}
  
function saveOrderDokumen_old($arr,$kd_order_sertifikasi_dokumen='',$dokumenlist='', $edit=false){
    
    if(isset($arr['tgl_dokumen_diterima'])) $this->db->set('tgl_dokumen_diterima',$arr['tgl_dokumen_diterima']);
    if(isset($arr['tgl_dokumen_lengkap'])) $this->db->set('tgl_dokumen_lengkap',$arr['tgl_dokumen_lengkap']);
    if(isset($arr['status_order_dokumen'])) $this->db->set('status_order_dokumen',$arr['status_order_dokumen']);
    if(isset($arr['nama_penyerah_dokumen'])) $this->db->set('nama_penyerah_dokumen',$arr['nama_penyerah_dokumen']);
    if(isset($arr['nip_penerima_dokumen'])) $this->db->set('nip_penerima_dokumen',$arr['nip_penerima_dokumen']);
    if(isset($arr['nama_penerima_dokumen'])) $this->db->set('nama_penerima_dokumen',$arr['nama_penerima_dokumen']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
    if(isset($arr['kd_sertifikasi_jenistarif'])) $this->db->set('kd_sertifikasi_jenistarif',$arr['kd_sertifikasi_jenistarif']);     
    if(isset($arr['kd_sertifikasi_jenis'])) $this->db->set('kd_sertifikasi_jenis',$arr['kd_sertifikasi_jenis']);
	if(isset($arr['file_sertifikasi_dokumen'])) $this->db->set('file_sertifikasi_dokumen',$arr['file_sertifikasi_dokumen']);

    if(isset($arr['kd_satker'])) 
      $this->db->set('kd_satker',$arr['kd_satker']);
    else 
      $this->db->set('kd_satker',$this->session->userdata('profil')->kd_satker); 
    if(isset($arr['tgl_create'])) 
      $this->db->set('tgl_create',$arr['tgl_create']); 
    else 
      $this->db->set('tgl_create',date('Y-m-d H:i:s'));
    
    //echo "<script>alert('tes edit')</script>"; 
    if($edit){
          //echo "<script>alert('tes edit')</script>"; 
          $this->db->set('kd_order_sertifikasi_dokumen',$arr['kd_order_sertifikasi_dokumen']);
          $this->db->where('kd_order_sertifikasi_dokumen',$arr['kd_order_sertifikasi_dokumen']);          
          $this->db->update('order_sertifikasi_dokumen');        
             
          $counter=0;
          #untuk mengecheck yang checklisnya dihilangkan untuk di delete
          $this->db->where('kd_order_sertifikasi_dokumen',$arr['kd_order_sertifikasi_dokumen']);
          $orderlistdok=$this->db->get('order_sertifikasi_dokumen_list');
          $order_listdok=$orderlistdok->result();

          $present_old=array();
          $present=array();
          $cpresent=0;
          $notpresent=array();$cnotpresent=0;

          $cntt=0;$cnttt=0;
          #untuk mengecheck yang checklisnya parameter yang telah ada untuk di update
          foreach($dokumenlist as $kd_sertifikasi_dokumena){
                  //echo $kd_sertifikasi_dokumena->kd_order_sertifikasi_dokumen.'<br>';
                  foreach($order_listdok as $data2){
                    if($kd_sertifikasi_dokumena==$data2->kd_sertifikasi_dokumen){
                        $present[$cpresent]=$data2->kd_sertifikasi_dokumen;
                        //echo $present[$cpresent].'<br>';
                        $cpresent++;
                    }
                  }
                  $cntt++;   
          }
        
          foreach($order_listdok as $data3){
              $present_old[$cpresent]=$data3->kd_sertifikasi_dokumen;
              $cpresent++;          
          }

          $ada      = array_values(array_uintersect($present_old,$present,"strcasecmp"));
          $tidakada = array_values(array_udiff($present_old,$present,"strcasecmp"));
          
          //delete yang tidak ada di checklist yang baru (di unchecklist) 
          for($kk=0;$kk<count($tidakada); $kk++){
              $this->db->where('kd_order_sertifikasi_dokumen',$arr['kd_order_sertifikasi_dokumen']);
              $this->db->where('kd_sertifikasi_dokumen',$tidakada[$kk]);
              $this->db->delete('order_sertifikasi_dokumen_list');
          }
              
          
          foreach($dokumenlist as $kd_sertifikasi_dokumen){
             //echo "<script>alert('test dokument list')</script>";
              $this->db->where('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);
              $res=$this->db->get('mst_sertifikasi_jenis_tarif_dokumen');
              $row=$res->row();
                 
              $this->db->set('kd_sertifikasi_dokumen',$row->kd_sertifikasi_dokumen);
              $this->db->set('nama_sertifikasi_dokumen',$row->nama_sertifikasi_dokumen);
              $this->db->set('kd_sertifikasi_jenistarif',$row->kd_sertifikasi_jenistarif);
              $this->db->set('kd_sertifikasi_jenis',$row->kd_sertifikasi_jenis);
            
              if (in_array($row->kd_sertifikasi_dokumen, $present,true)){ 
                  if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
                 // echo "<script>alert('update dok_list')</script>";
                  $this->db->where('kd_order_sertifikasi_dokumen',$arr['kd_order_sertifikasi_dokumen']);
                  $this->db->where('kd_sertifikasi_dokumen',$row->kd_sertifikasi_dokumen);
                  $this->db->set('tgl_update',date('Y-m-d H:i:s'));
                  $this->db->update('order_sertifikasi_dokumen_list');
              }else{
                  //echo "<script>alert('insert dok list')</script>";
                  if($kd_order_sertifikasi_dokumen) $this->db->set('kd_order_sertifikasi_dokumen',$arr['kd_order_sertifikasi_dokumen']);
                  else $this->db->set('kd_order_sertifikasi_dokumen',$arr['kd_order_sertifikasi_dokumen']);
                  if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
                  $this->db->set('kd_satker',$row->kd_satker);
                  $this->db->set('tgl_create ',date('Y-m-d H:i:s'));
                  $this->db->insert('order_sertifikasi_dokumen_list');
              }                
         
              $counter++;   
          }

    }else{  
        echo "<script>alert('tes bukan edit')</script>";
        if(isset($arr['kd_order_sertifikasi_dokumen'])) $this->db->set('kd_order_sertifikasi_dokumen',$arr['kd_order_sertifikasi_dokumen']);
        else $this->db->set('kd_order_sertifikasi_dokumen',$this->Make_kd_order_sertifikasi_dokumen());

        $this->db->insert('order_sertifikasi_dokumen');        
        if(isset($kd_order_sertifikasi_dokumen)) $this->db->set('kd_order_sertifikasi_dokumen',$kd_order_sertifikasi_dokumen);         

        $this->db->order_by('kd_order_sertifikasi_dokumen','desc'); 
        $res=$this->db->get('order_sertifikasi_dokumen');      
      
        if($dokumenlist){
           //echo "<script>alert('tes dokumen list')</script>";
            $counter=0;
            foreach($dokumenlist as $kd_sertifikasi_dokumen){
                $this->db->where('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);
                $res=$this->db->get('mst_sertifikasi_jenis_tarif_dokumen');
                $row=$res->row();
         
                $this->db->set('kd_sertifikasi_dokumen',$row->kd_sertifikasi_dokumen);
                $this->db->set('nama_sertifikasi_dokumen',$row->nama_sertifikasi_dokumen);
                $this->db->set('kd_order_sertifikasi_dokumen',$arr['kd_order_sertifikasi_dokumen']);
                $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
                $this->db->set('kd_sertifikasi_jenistarif',$row->kd_sertifikasi_jenistarif);
                $this->db->set('kd_sertifikasi_jenis',$row->kd_sertifikasi_jenis);          
                $this->db->set('kd_satker',$row->kd_satker);
                $this->db->set('tgl_create ',$row->tgl_create);
                $this->db->insert('order_sertifikasi_dokumen_list'); 
                //echo "<script>alert('tes dokumen list')</script>";          
                $counter++;
            }                 
        }
    }    
    return true;
}

function simpanDokumen($file_name, $kd_order_sertifikasi, $kd_sertifikasi_dokumen){
	$this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
	$this->db->where('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);
    $query = $this->db->get('order_sertifikasi_dokumen_list');
    if ($query->num_rows() > 0){
        $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
		$this->db->where('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);
		$this->db->set('file_sertifikasi_dokumen ',$file_name);
		$this->db->update('order_sertifikasi_dokumen_list');
    }
    else{
		$this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
		$this->db->limit(1);
		$query = $this->db->get('order_sertifikasi_dokumen');
		if ($query->num_rows() > 0){
			$osd=$query->row();
		} else {
			$this->db->like('kd_order_sertifikasi_dokumen', date("Y"));   
			$this->db->order_by('tgl_create','desc');
			$this->db->limit(1);
			$qry=$this->db->get('order_sertifikasi_dokumen');
			if($qry->num_rows()>0){
			  $result=$qry->row();
			  $arr_urut=explode("-",$result->kd_order_sertifikasi_dokumen);
			  $urut=$arr_urut[count($arr_urut)-1];//'05'
			  settype($urut,"integer");
			  $urut += 1;
			  $kode=substr($result->kd_order_sertifikasi_dokumen,0,-1).$urut;
			} else { 
				$kode = "bpkimi14-odok-".date("Y")."-1";
			}
		}
		
		//
		
        $this->db->where('kd_sertifikasi_dokumen',$kd_sertifikasi_dokumen);
		$res=$this->db->get('mst_sertifikasi_jenis_tarif_dokumen');
		$row=$res->row();
		
		$this->db->set('kd_sertifikasi_dokumen',$row->kd_sertifikasi_dokumen);
		$this->db->set('nama_sertifikasi_dokumen',$row->nama_sertifikasi_dokumen);
		$this->db->set('file_sertifikasi_dokumen ',$file_name);
		$this->db->set('kd_order_sertifikasi_dokumen', $osd->kd_order_sertifikasi_dokumen);
		$this->db->set('kd_order_sertifikasi',$kd_order_sertifikasi);
		$this->db->set('kd_sertifikasi_jenistarif',$row->kd_sertifikasi_jenistarif);
		$this->db->set('kd_sertifikasi_jenis',$row->kd_sertifikasi_jenis);          
		$this->db->set('kd_satker',$row->kd_satker);
		$this->db->set('tgl_create ',$row->tgl_create);
		$this->db->insert('order_sertifikasi_dokumen_list'); 
    }
	return True;
}

function Make_kd_order_sertifikasi_dokumen(){  
    //echo "<script>alert('make kode true')</script>";  
    $this->db->like('kd_order_sertifikasi_dokumen',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');
    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_dokumen');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_sertifikasi_dokumen);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-odok-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_order_sertifikasi_dokumen',$kode);
      $qry=$this->db->get('order_sertifikasi_dokumen');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
}

function getOrderPenawaran($kd_penawaran='',$kd_order_sertifikasi='') {
      if($kd_penawaran) $this->db->where('kd_penawaran',$kd_penawaran);
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
       
      $query = $this->db->get('order_sertifikasi_penawaran'); 
      
      if( $query->num_rows() > 0 ) {
            if($kd_penawaran) return $query->row(); 
            else if($kd_order_sertifikasi) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
    }


  function getTotalOrderPenawaran($kd_order_sertifikasi,$kd_penawaran){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_penawaran.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_penawaran) $this->db->where('order_sertifikasi_penawaran.kd_penawaran',$kd_penawaran);
      $this->db->from('order_sertifikasi_penawaran'); 
     
        return $this->db->count_all_results();
  }
  
  function getResultOrderPenawaran($kd_order_sertifikasi,$kd_penawaran,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_penawaran.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_penawaran) $this->db->where('order_sertifikasi_penawaran.kd_penawaran',$kd_penawaran);
      
      $this->db->select('order_sertifikasi_penawaran.*,order_sertifikasi.*'); 
      $this->db->from('order_sertifikasi_penawaran');
      $this->db->join('order_sertifikasi','order_sertifikasi.kd_order_sertifikasi=order_sertifikasi_penawaran.kd_order_sertifikasi');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

function Make_kd_penawaran(){  
    //echo "<script>alert('make kode true')</script>";  
    $this->db->like('kd_penawaran',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');
    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_penawaran');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_penawaran);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-pnwr-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_penawaran',$kode);
      $qry=$this->db->get('order_sertifikasi_penawaran');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
}

  function getOrderPenawaranList($kd_sertifikasi_jenistarifitem='',$kd_penawaran='',$kd_order_sertifikasi='') {
      if($kd_sertifikasi_jenistarifitem) $this->db->where('kd_sertifikasi_jenistarifitem',$kd_sertifikasi_jenistarifitem);
      if($kd_penawaran) $this->db->where('kd_penawaran',$kd_penawaran);
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
       
      $query = $this->db->get('order_sertifikasi_penawaran_list'); 
      
      if( $query->num_rows() > 0 ) {
            if($kd_sertifikasi_jenistarifitem && $kd_penawaran) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }
    
   function getTotalOrderPenawaranList($kd_order_sertifikasi,$kd_penawaran){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_penawaran_list.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_penawaran) $this->db->where('order_sertifikasi_penawaran_list.kd_penawaran',$kd_penawaran);
      $this->db->from('order_sertifikasi_penawaran_list'); 
     
        return $this->db->count_all_results();
  }
  
  function getResultOrderPenawaranList($kd_order_sertifikasi,$kd_penawaran,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_penawaran) $this->db->where('order_sertifikasi_penawaran_list.kd_penawaran',$kd_penawaran);
      
      $this->db->select('order_sertifikasi_penawaran_list.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_penawaran_list');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

function Make_kd_order_sertifikasi_penawaran(){  
    //echo "<script>alert('make kode true')</script>";  
    $this->db->like('kd_order_sertifikasi_penawaran',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');
    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_penawaran');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_sertifikasi_penawaran);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-pnwr-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_order_sertifikasi_penawaran',$kode);
      $qry=$this->db->get('order_sertifikasi_penawaran');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
}

function saveOrderPenawaran($arr,$kd_order_sertifikasi_penawaran='',$penawaranlist='',$jumlahtariflist='', $jumlahharitariflist='',$edit=false){
    
    if(isset($arr['no_penawaran'])) $this->db->set('no_penawaran',$arr['no_penawaran']);
    if(isset($arr['tgl_penawaran'])) $this->db->set('tgl_penawaran',$arr['tgl_penawaran']);
    if(isset($arr['no_surat_permohonan'])) $this->db->set('no_surat_permohonan',$arr['no_surat_permohonan']);
    if(isset($arr['tgl_surat_permohonan'])) $this->db->set('tgl_surat_permohonan',$arr['tgl_surat_permohonan']);
    if(isset($arr['perihal_penawaran'])) $this->db->set('perihal_penawaran',$arr['perihal_penawaran']);
    if(isset($arr['jumlah_lampiran_penawaran'])) $this->db->set('jumlah_lampiran_penawaran',$arr['jumlah_lampiran_penawaran']);
    if(isset($arr['isi_surat_penawaran'])) $this->db->set('isi_surat_penawaran',$arr['isi_surat_penawaran']);

    if(isset($arr['harga_total_penawaran'])) $this->db->set('harga_total_penawaran',$arr['harga_total_penawaran']);
    if(isset($arr['nip_pembuat_penawaran'])) $this->db->set('nip_pembuat_penawaran',$arr['nip_pembuat_penawaran']);
    if(isset($arr['nama_pembuat_penawaran'])) $this->db->set('nama_pembuat_penawaran',$arr['nama_pembuat_penawaran']);
    if(isset($arr['nip_penandatangan_penawaran'])) $this->db->set('nip_penandatangan_penawaran',$arr['nip_penandatangan_penawaran']);
    if(isset($arr['nama_penandatangan_penawaran'])) $this->db->set('nama_penandatangan_penawaran',$arr['nama_penandatangan_penawaran']);

    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
    if(isset($arr['kd_sertifikasi_jenistarif'])) $this->db->set('kd_sertifikasi_jenistarif',$arr['kd_sertifikasi_jenistarif']);     
    if(isset($arr['kd_sertifikasi_jenis'])) $this->db->set('kd_sertifikasi_jenis',$arr['kd_sertifikasi_jenis']);

    if(isset($arr['kd_satker'])) 
      $this->db->set('kd_satker',$arr['kd_satker']);
    else 
      $this->db->set('kd_satker',$this->session->userdata('profil')->kd_satker); 
    if(isset($arr['tgl_create'])) 
      $this->db->set('tgl_create',$arr['tgl_create']); 
    else 
      $this->db->set('tgl_create',date('Y-m-d H:i:s'));
    
    //echo "<script>alert('tes coba test di morder')</script>"; 
    if($edit){  
          //echo "<script>alert('tes edit di morder')</script>"; 
          //echo "<script>alert('test kd penawaran ".$arr['kd_penawaran']."')</script>";
          $this->db->set('kd_penawaran',$arr['kd_penawaran']);
          $this->db->where('kd_penawaran',$arr['kd_penawaran']);          
          $this->db->update('order_sertifikasi_penawaran');        
             
          $counter=0;
          #untuk mengecheck yang checklisnya dihilangkan untuk di delete
          $this->db->where('kd_penawaran',$arr['kd_penawaran']);
          $orderlistpen=$this->db->get('order_sertifikasi_penawaran_list');
          $order_listpen=$orderlistpen->result();

          $present_old=array();
          $present=array();
          $cpresent=0;
          $notpresent=array();$cnotpresent=0;

          $cntt=0;$cnttt=0;
          #untuk mengecheck yang checklisnya parameter yang telah ada untuk di update
          foreach($penawaranlist as $kd_penawarana){
                   //echo $kd_penawarana->kd_penawaran.'<br>';
                  foreach($order_listpen as $data2){
                    //echo $data2->kd_sertifikasi_jenistarifitem.'<br>';
                    if($kd_penawarana==$data2->kd_sertifikasi_jenistarifitem){
                        $present[$cpresent]=$data2->kd_sertifikasi_jenistarifitem;
                        //echo $present[$cpresent].'<br>';
                        $cpresent++;
                    }
                  }
                  $cntt++;  
  
          }
        
          foreach($order_listpen as $data3){
              $present_old[$cpresent]=$data3->kd_sertifikasi_jenistarifitem;
              $cpresent++;          
          }

          $ada      = array_values(array_uintersect($present_old,$present,"strcasecmp"));
          $tidakada = array_values(array_udiff($present_old,$present,"strcasecmp"));
          //echo count($ada).'<br>';
          //echo count($tidakada).'<br>';
          //delete yang tidak ada di checklist yang baru (di unchecklist) 
          for($kk=0;$kk<count($tidakada); $kk++){
              //echo $tidakada[$kk].'<br>';
              $this->db->where('kd_penawaran',$arr['kd_penawaran']);
              $this->db->where('kd_sertifikasi_jenistarifitem',$tidakada[$kk]);
              $this->db->delete('order_sertifikasi_penawaran_list');
          }
              
          $harga_total=0;
          foreach($penawaranlist as $kd_sertifikasi_jenistarifitem){
                //echo "<script>alert('test dokument list')</script>";
                $this->db->where('kd_sertifikasi_jenistarifitem',$kd_sertifikasi_jenistarifitem);
                $res=$this->db->get('mst_sertifikasi_jenis_tarif_item');
                $row=$res->row();
                //print_r($row->kd_sertifikasi_dokumen);
                //print_r($row->nama_sertifikasi_dokumen);
                if($jumlahtariflist[$kd_sertifikasi_jenistarifitem]>0) 
                      $harga_total+=($row->harga_sertifikasi_jenistarifitem * $jumlahtariflist[$kd_sertifikasi_jenistarifitem] * $jumlahharitariflist[$kd_sertifikasi_jenistarifitem]); 
                else 
                      $harga_total+=($row->harga_sertifikasi_jenistarifitem);

               //echo "<script>alert('harga_total ".$harga_total."')</script>";

                $this->db->set('kd_sertifikasi_jenistarifitem',$row->kd_sertifikasi_jenistarifitem);
                $this->db->set('nama_sertifikasi_jenistarifitem',$row->nama_sertifikasi_jenistarifitem);
                $this->db->set('harga_sertifikasi_jenistarifitem',$row->harga_sertifikasi_jenistarifitem);
                $this->db->set('satuan_sertifikasi_jenistarifitem',$row->satuan_sertifikasi_jenistarifitem);
                $this->db->set('jumlah_sertifikasi_jenistarifitem',$jumlahtariflist[$kd_sertifikasi_jenistarifitem]);
                $this->db->set('jumlahhari_sertifikasi_jenistarifitem',$jumlahharitariflist[$kd_sertifikasi_jenistarifitem]);
                $this->db->set('jumlahharga_sertifikasi_jenistarifitem', $row->harga_sertifikasi_jenistarifitem*
                                                                          $jumlahtariflist[$kd_sertifikasi_jenistarifitem]*
                                                                          $jumlahharitariflist[$kd_sertifikasi_jenistarifitem]);
                $this->db->set('keterangan1_jenistarifitem',$row->keterangan1_jenistarifitem);
                $this->db->set('keterangan2_jenistarifitem',$row->keterangan2_jenistarifitem);
                $this->db->set('kd_penawaran',$arr['kd_penawaran']);
                $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
                $this->db->set('kd_sertifikasi_jenistarif',$row->kd_sertifikasi_jenistarif);
                $this->db->set('kd_sertifikasi_jenis',$row->kd_sertifikasi_jenis);          
                $this->db->set('kd_satker',$row->kd_satker);
            
              if (in_array($row->kd_sertifikasi_jenistarifitem, $present,true)){ 
                  // echo "<script>alert('update dok_list')</script>";
                  if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);                  
                  $this->db->where('kd_penawaran',$arr['kd_penawaran']);
                  $this->db->where('kd_sertifikasi_jenistarifitem',$row->kd_sertifikasi_jenistarifitem);
                  $this->db->set('tgl_update',date('Y-m-d H:i:s'));
                  $this->db->update('order_sertifikasi_penawaran_list');
              }else{
                  //echo "<script>alert('insert dok list')</script>";
                  if($arr['kd_penawaran']) $this->db->set('kd_penawaran',$arr['kd_penawaran']);
                  else $this->db->set('kd_penawaran',$arr['kd_penawaran']);
                  if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
                  $this->db->set('kd_satker',$row->kd_satker);
                  $this->db->set('tgl_create ',date('Y-m-d H:i:s'));
                  $this->db->insert('order_sertifikasi_penawaran_list');
              } 
              $counter++;   
          }
          $this->db->where('kd_penawaran',$arr['kd_penawaran']);
          $this->db->set('harga_total_penawaran',$harga_total);    
          $this->db->update('order_sertifikasi_penawaran');   
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
          $this->db->set('hargatotal_order_sertifikasi',$harga_total);    
          $this->db->update('order_sertifikasi');  

    }else{  
        //echo "<script>alert('tes bukan edit di morder save')</script>";
        if(isset($arr['kd_penawaran'])) $this->db->set('kd_penawaran',$arr['kd_penawaran']);
        else $this->db->set('kd_penawaran',$this->Make_kd_penawaran());


        $this->db->insert('order_sertifikasi_penawaran');        
        if(isset($kd_penawaran)) $this->db->set('kd_penawaran',$kd_penawaran);         

        $this->db->order_by('kd_penawaran','desc'); 
        $res=$this->db->get('order_sertifikasi_penawaran');      
        
        //if($penawaranlist){
            //rint_r($penawaranlist);
            $counter=0;$harga_total=0;
            foreach($penawaranlist as $kd_sertifikasi_jenistarifitem){
                $this->db->where('kd_sertifikasi_jenistarifitem',$kd_sertifikasi_jenistarifitem);
                $res=$this->db->get('mst_sertifikasi_jenis_tarif_item');
                $row=$res->row();
                //print_r($row->kd_sertifikasi_dokumen);
                //print_r($row->nama_sertifikasi_dokumen);
                if($jumlahtariflist[$kd_sertifikasi_jenistarifitem]>0) 
                      $harga_total+=($row->harga_sertifikasi_jenistarifitem * $jumlahtariflist[$kd_sertifikasi_jenistarifitem] * $jumlahharitariflist[$kd_sertifikasi_jenistarifitem]); 
                else 
                      $harga_total+=($row->harga_sertifikasi_jenistarifitem);
         
                $this->db->set('kd_sertifikasi_jenistarifitem',$row->kd_sertifikasi_jenistarifitem);
                $this->db->set('nama_sertifikasi_jenistarifitem',$row->nama_sertifikasi_jenistarifitem);
                $this->db->set('harga_sertifikasi_jenistarifitem',$row->harga_sertifikasi_jenistarifitem);
                $this->db->set('satuan_sertifikasi_jenistarifitem',$row->satuan_sertifikasi_jenistarifitem);
                $this->db->set('jumlah_sertifikasi_jenistarifitem',$jumlahtariflist[$kd_sertifikasi_jenistarifitem]);
                $this->db->set('jumlahhari_sertifikasi_jenistarifitem',$jumlahharitariflist[$kd_sertifikasi_jenistarifitem]);
                $this->db->set('jumlahharga_sertifikasi_jenistarifitem', $row->harga_sertifikasi_jenistarifitem*
                                                                          $jumlahtariflist[$kd_sertifikasi_jenistarifitem]*
                                                                          $jumlahharitariflist[$kd_sertifikasi_jenistarifitem]);
                $this->db->set('keterangan1_jenistarifitem',$row->keterangan1_jenistarifitem);
                $this->db->set('keterangan2_jenistarifitem',$row->keterangan2_jenistarifitem);
                $this->db->set('kd_penawaran',$arr['kd_penawaran']);
                $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
                $this->db->set('kd_sertifikasi_jenistarif',$row->kd_sertifikasi_jenistarif);
                $this->db->set('kd_sertifikasi_jenis',$row->kd_sertifikasi_jenis);          
                $this->db->set('kd_satker',$row->kd_satker);
                $this->db->set('tgl_create ',$row->tgl_create);
                $this->db->insert('order_sertifikasi_penawaran_list'); 
          
                $counter++;
            }    
        //}


        $this->db->where('kd_penawaran',$arr['kd_penawaran']);
        $this->db->set('harga_total_penawaran',$harga_total);    
        $this->db->update('order_sertifikasi_penawaran'); 

        $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
        $this->db->set('hargatotal_order_sertifikasi',$harga_total);    
        $this->db->update('order_sertifikasi');    
    }    
    return true;
}

function saveTotalUlang($kd_order_sertifikasi='',$ppn=''){
    if($kd_order_sertifikasi){
      $hasil['tot']=$this->mOrder->getTotalOrderPenawaran($kd_order_sertifikasi,'');
      if($hasil['tot']>0){
        
        $hasil['result']=$this->mOrder->getResultOrderPenawaran($kd_order_sertifikasi,'','kd_penawaran','desc',30,0);
      } else {
        //echo "<script>alert('Maaf, test')</script>";
        $hasil['result']=false;
      }
      $harga_total=0;
      if($hasil['result']){
        foreach($hasil['result'] as $row){          
          $harga_total += $row->harga_total_penawaran;         }
      } else { 
        $harga_total=0; 
      }
      
    
    $totalnya = $harga_total;
    $jml_ppn = ($totalnya*$ppn)/100;
    $totalnya= $totalnya  + $jml_ppn;
    $this->db->set('hargatotal_order_sertifikasi',$totalnya);
    $this->db->set('ppn_order_sertifikasi',$jml_ppn);
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->update('order_sertifikasi');
    return true;
   }
}


  function saveOrderPenawaranList($arr,$kd_detail_order='',$temp=true){
    if(isset($arr['kd_parameter'])) 
    $this->db->set('kd_parameter',$arr['kd_parameter']); 
    else 
    $this->db->set('kd_parameter',$this->Make_kd_parameter());

    if(isset($arr['nama_parameter'])) $this->db->set('nama_parameter',$arr['nama_parameter']);
    if(isset($arr['metoda_parameter'])) $this->db->set('metoda_parameter',$arr['metoda_parameter']);
    if(isset($arr['syarat_mutu_parameter'])) $this->db->set('syarat_mutu_parameter',$arr['syarat_mutu_parameter']);
    if(isset($arr['harga_satuan'])) $this->db->set('harga_satuan',$arr['harga_satuan']);
    if(isset($arr['satuan'])) $this->db->set('satuan',$arr['satuan']);
    if(isset($arr['jumlah_uji'])) $this->db->set('jumlah_uji',$arr['jumlah_uji']);

    if(isset($arr['kd_detail_order'])) $this->db->set('kd_detail_order',$arr['kd_detail_order']);
    else $this->db->set('kd_detail_order',$kd_detail_order);//tambahan tanggal 20/03/2013

    if(isset($arr['nm_tabel_parameter'])) $this->db->set('nm_tabel_parameter',$arr['nm_tabel_parameter']); 
    if(isset($arr['status_parameter'])) $this->db->set('status_parameter',$arr['status_parameter']); 
    if(isset($arr['tgl_dikerjakan_analis'])) $this->db->set('tgl_dikerjakan_analis',$arr['tgl_dikerjakan_analis']);
    if(isset($arr['nm_analis'])) $this->db->set('satuan',$arr['satuan']);   
    if(isset($arr['nip_analis'])) $this->db->set('nip_analis',$arr['nip_analis']);
    if(isset($arr['tgl_disetujui_penyelia'])) $this->db->set('tgl_disetujui_penyelia',$arr['tgl_disetujui_penyelia']);
    if(isset($arr['nm_penyelia'])) $this->db->set('nm_penyelia',$arr['nm_penyelia']);
    if(isset($arr['nip_penyelia'])) $this->db->set('nip_penyelia',$arr['nip_penyelia']);
    if(isset($arr['komentar_penyelia'])) $this->db->set('komentar_penyelia',$arr['komentar_penyelia']);
    if(isset($arr['file_lkparameter'])) $this->db->set('file_lkparameter',$arr['file_lkparameter']);      
    if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']);
    if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']);

    if($temp==false){
    $this->db->insert('order_parameter_pengujian'); 
    }else{
    $this->db->insert('order_parameter_pengujian_temp');
    }
    return true;
  }

 function getOrderKontrak($kd_order_sertifikasi='',$kd_kontrak='') {
      if($kd_kontrak) $this->db->where('kd_kontrak',$kd_kontrak);
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
       
      $query = $this->db->get('order_sertifikasi_kontrak'); 
      
      if( $query->num_rows() > 0 ) {
            if($kd_kontrak) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
    }


  function getTotalOrderKontrak($kd_order_sertifikasi,$kd_kontrak){ 
          if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_kontrak.kd_order_sertifikasi',$kd_order_sertifikasi);
          if($kd_kontrak) $this->db->where('order_sertifikasi_kontrak.kd_kontrak',$kd_kontrak);
             $this->db->from('order_sertifikasi_kontrak');                         
          return $this->db->count_all_results();
    }
      
  
  function getResultOrderKontrak($kd_order_sertifikasi,$kd_kontrak,$ord,$srt,$limit,$start){
          $this->db->limit($limit,$start);
          $this->db->order_by($ord,$srt);
          if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_kontrak.kd_order_sertifikasi',$kd_order_sertifikasi);
          if($kd_kontrak) $this->db->where('order_sertifikasi_kontrak.kd_order_komoditi',$kd_order_komoditi);          
      
          $this->db->select('order_sertifikasi_kontrak.*'); 
          $this->db->from('order_sertifikasi_kontrak');
          //$this->db->join('order_sertifikasi','order_sertifikasi.kd_order_sertifikasi=order_sertifikasi_komoditi.kd_order_sertifikasi');
          $qry=$this->db->get();
       
          if($qry->num_rows()>0){
            return $qry->result(); 
           }
          return false;
  }


  function Make_kd_Kontrak(){    
    $this->db->like('kd_kontrak',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');
    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_kontrak');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_komoditi);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-oktr-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_kontrak',$kode);
      $qry=$this->db->get('order_sertifikasi_kontrak');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

  function deleteOrderKontrak($kd_order_sertifikasi,$kd_kontrak=''){
      if($kd_kontrak){
            if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
            $this->db->delete('order_sertifikasi_kontrak', array('kd_kontrak' => $kd_kontrak)); 
      }else{
            if($kd_order_sertifikasi) $this->db->delete('order_sertifikasi_kontrak', array('kd_order_sertifikasi)' => $kd_order_sertifikasi)); 
      }
  }

  function saveOrderKontrak($arr,$kd_order_sertifikasi='',$edit=false){
    if(isset($arr['kd_kontrak'])) $this->db->set('kd_kontrak',$arr['kd_kontrak']); 
    if(isset($arr['no_kontrak'])) $this->db->set('no_kontrak',$arr['no_kontrak']);   
    if(isset($arr['tgl_cetak_kontrak'])) $this->db->set('tgl_cetak_kontrak',$arr['tgl_cetak_kontrak']);
    if(isset($arr['file_kontrak'])) $this->db->set('file_kontrak',$arr['file_kontrak']);
    if(isset($arr['nama_penandatangan_bbk_kontrak'])) $this->db->set('nama_penandatangan_bbk_kontrak',$arr['nama_penandatangan_bbk_kontrak']);
    if(isset($arr['nip_penandatangan_bbk_kontrak'])) $this->db->set('nip_penandatangan_bbk_kontrak',$arr['nip_penandatangan_bbk_kontrak']);  
    if(isset($arr['jabatan_penandatangan_bbk_kontrak'])) $this->db->set('jabatan_penandatangan_bbk_kontrak',$arr['jabatan_penandatangan_bbk_kontrak']);
    if(isset($arr['tgl_penandatangan_bbk_kontrak'])) $this->db->set('tgl_penandatangan_bbk_kontrak',$arr['tgl_penandatangan_bbk_kontrak']);
    if(isset($arr['nama_penandatangan_perusahaan_kontrak'])) $this->db->set('nama_penandatangan_perusahaan_kontrak',$arr['nama_penandatangan_perusahaan_kontrak']);
    if(isset($arr['nip_penandatangan_perusahaan_kontrak'])) $this->db->set('nip_penandatangan_perusahaan_kontrak',$arr['nip_penandatangan_perusahaan_kontrak']);  
    if(isset($arr['jabatan_penandatangan_perusahaan_kontrak'])) $this->db->set('jabatan_penandatangan_perusahaan_kontrak',$arr['jabatan_penandatangan_bbk_kontrak']);
    if(isset($arr['tgl_penandatangan_perusahaan_kontrak'])) $this->db->set('tgl_penandatangan_perusahaan_kontrak',$arr['tgl_penandatangan_perusahaan_kontrak']);

     if(isset($arr['nip_pembuat_kontrak'])) $this->db->set('nip_pembuat_kontrak',$arr['nip_pembuat_kontrak']); 
    if(isset($arr['nama_pembuat_kontrak'])) $this->db->set('nama_pembuat_kontrak',$arr['nama_pembuat_kontrak']);   
    if(isset($arr['tgl_diterima_kontrak'])) $this->db->set('tgl_diterima_kontrak',$arr['tgl_diterima_kontrak']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);

    if(isset($arr['kd_satker'])) $this->db->set('kd_satker',$arr['kd_satker']); 
      else $this->session->userdata('profil')->kd_satker;    
   
    if($edit){ 
      if(isset($arr['tgl_update'])) $this->db->set('tgl_update',$arr['tgl_update']); 
      else $this->db->set('tgl_update',date('Y-m-d H:i:s'));
      $this->db->where('kd_kontrak',$arr['kd_kontrak']);
      $this->db->update('order_sertifikasi_kontrak');
    } else {

      if(isset($arr['tgl_create'])) $this->db->set('tgl_create',$arr['tgl_create']); 
          else $this->db->set('tgl_create',date('Y-m-d H:i:s'));
      if(isset($arr['kd_kontrak'])) $this->db->set('kd_kontrak',$arr['kd_kontrak']); 
          else $this->db->set('kd_kontrak',$this->Make_kd_kontrak());
      $this->db->insert('order_sertifikasi_kontrak');
      //return $kd_customer;
    }
  }


 function Make_kd_invoice(){
    $knm = $this->session->userdata('profil')->kd_satker;
    $nama = $this->mstaff->getNamaSatker($knm);
    
    $this->db->like('kd_invoice',date("Y"));
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');
    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_invoice');
    $tahun='';
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_invoice);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
      
    } else { 
      $urut=1;
    }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-inv-s-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_invoice',$kode);
      $qry=$this->db->get('order_sertifikasi_invoice');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

  function Make_no_invoice(){
    $knm = $this->session->userdata('profil')->kd_satker;
    $nama = $this->mstaff->getNamaSatker($knm);
    
    $this->db->like('no_invoice',date("Y"));
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');
    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_invoice');
    $tahun='';
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("/",$result->no_invoice);
      $urut=$arr_urut[0];
      $tahun=$arr_urut[3];
      settype($urut,"integer");
      $urut+=1;
    } else { 
      $urut=1;
    }
    #cekdulu
    do{
      $prefix = $nama->singkatan_satker."/PNBP/INV-S/".date("m")."/".date("Y");     
      $kode = $urut."/".$prefix;
      $this->db->where('no_invoice',$kode);
      $qry=$this->db->get('order_sertifikasi_invoice');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

 function getInvoice($kd_order_sertifikasi='',$kd_invoice='',$no_invoice='',$jumdata=false){

    if($kd_order_sertifikasi)$this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    if($kd_invoice)$this->db->where('kd_invoice',$kd_invoice);
    $this->db->order_by('kd_invoice','desc');
    $qry=$this->db->get('order_sertifikasi_invoice');
    if($qry->num_rows()>0){
      if($jumdata) return $qry->num_rows();
      else return $qry->result();
    }
    return false;
  }

   function getOrderInvoice($kd_order_sertifikasi='',$kd_invoice='',$no_invoice='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_invoice) $this->db->where('kd_invoice',$kd_invoice);
      if($no_invoice) $this->db->where('no_invoice',$no_invoice);
       
      $query = $this->db->get('order_sertifikasi_invoice'); 
      
      if( $query->num_rows() > 0 ) {
            if($no_invoice || $kd_invoice) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }
    
   function getTotalOrderInvoice($kd_order_sertifikasi='',$kd_invoice=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_invoice.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_invoice) $this->db->where('order_sertifikasi_invoice.kd_invoice',$kd_invoice);
      $this->db->from('order_sertifikasi_invoice'); 
     
        return $this->db->count_all_results();
  }
  
  function getResultOrderInvoice($kd_order_sertifikasi,$kd_invoice,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_invoice) $this->db->where('order_sertifikasi_invoice.kd_invoice',$kd_invoice);
      
      $this->db->select('order_sertifikasi_invoice.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_invoice');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function saveOrderInvoice($arr,$kd_order_sertifikasi){
    if($arr['kd_invoice']) $this->db->set('kd_invoice',$arr['kd_invoice']);
    if($arr['no_invoice']) $this->db->set('no_invoice',$arr['no_invoice']);
    if($arr['invoice_ke']) $this->db->set('invoice_ke',$arr['invoice_ke']);
    if($arr['tgl_invoice']) $this->db->set('tgl_invoice',$arr['tgl_invoice']);
    if($arr['harga_total']) $this->db->set('harga_total',$arr['harga_total']);
    if($arr['jumlah_bayar']) $this->db->set('jumlah_bayar',$arr['jumlah_bayar']);
    if($arr['sisa_bayar']) $this->db->set('sisa_bayar',$arr['sisa_bayar']);

    if($arr['jumlah_lampiran_invoice']) $this->db->set('jumlah_lampiran_invoice',$arr['jumlah_lampiran_invoice']);
    if($arr['perihal_invoice']) $this->db->set('perihal_invoice',$arr['perihal_invoice']);
    if($arr['isi_surat_invoice']) $this->db->set('isi_surat_invoice',$arr['isi_surat_invoice']);
    if($arr['nip_penandatangan_invoice']) $this->db->set('nip_penandatangan_invoice',$arr['nip_penandatangan_invoice']);
    if($arr['nama_penandatangan_invoice']) $this->db->set('nama_penandatangan_invoice',$arr['nama_penandatangan_invoice']);

    if($arr['nip_pembuat_invoice']) $this->db->set('nip_pembuat_invoice',$arr['nip_pembuat_invoice']);
    if($arr['nama_pembuat_invoice']) $this->db->set('nama_pembuat_invoice',$arr['nama_pembuat_invoice']);
    if($arr['kd_order_sertifikasi']) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    return $this->db->insert('order_sertifikasi_invoice');
  }

  function deleteInvoice($kd_order_sertifikasi,$kd_invoice){
    //echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_invoice',$kd_invoice);
    return $this->db->delete('order_sertifikasi_invoice');
  }

  function getOrderPembayaran($kd_order_sertifikasi='',$kd_pembayaran='',$no_pembayaran='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_pembayaran) $this->db->where('kd_pembayaran',$kd_pembayaran);
      if($no_pembayaran) $this->db->where('no_pembayaran',$no_pembayaran);
       
      $query = $this->db->get('order_sertifikasi_pembayaran'); 
      
      if( $query->num_rows() > 0 ) {
            if($no_pembayaran && $kd_pembayarane) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }
    
   function getTotalOrderPembayaran($kd_order_sertifikasi='',$kd_pembayaran=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_pembayaran.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_pembayaran) $this->db->where('order_sertifikasi_pembayaran.kd_pembayaran',$kd_pembayaran);
      $this->db->from('order_sertifikasi_pembayaran'); 
     
        return $this->db->count_all_results();
  }
  
  function getResultOrderPembayaran($kd_order_sertifikasi,$kd_pembayaran,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_pembayaran) $this->db->where('order_sertifikasi_invoice.kd_pembayaran',$kd_pembayaran);
      
      $this->db->select('order_sertifikasi_pembayaran.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_pembayaran');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function Make_kd_pembayaran(){
    
    $this->db->like('kd_pembayaran',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');

    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_pembayaran');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_pembayaran);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-pby-s-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_pembayaran',$kode);
      $qry=$this->db->get('order_sertifikasi_pembayaran');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

  function Make_no_pembayaran(){
    $knm = $this->session->userdata('profil')->kd_satker;
    $nama = $this->mstaff->getNamaSatker($knm);
    
    $this->db->like('no_pembayaran',date("Y"));
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');
    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_pembayaran');
    $tahun='';
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("/",$result->no_pembayaran);
      $urut=$arr_urut[0];
      $tahun=$arr_urut[3];
      settype($urut,"integer");
      $urut+=1;
    } else { 
      $urut=1;
    }
    #cekdulu
    do{
      $prefix = $nama->singkatan_satker."/PNBP-S/".date("m")."/".date("Y");     
      $kode = $urut."/".$prefix;
      $this->db->where('no_pembayaran',$kode);
      $qry=$this->db->get('order_sertifikasi_pembayaran');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

 

  
  function saveOrderPembayaran($arr,$kd_order_sertifikasi){
    if($arr['kd_pembayaran']) $this->db->set('kd_pembayaran',$arr['kd_pembayaran']);
    if($arr['no_pembayaran']) $this->db->set('no_pembayaran',$arr['no_pembayaran']);
    if($arr['nilai_bayar']) $this->db->set('nilai_bayar',$arr['nilai_bayar']);
    if($arr['tgl_bayar']) $this->db->set('tgl_bayar',$arr['tgl_bayar']);
    if($arr['nama_pembayar']) $this->db->set('nama_pembayar',$arr['nama_pembayar']);
    if($arr['tujuan_pembayaran']) $this->db->set('tujuan_pembayaran',$arr['tujuan_pembayaran']);
    if($arr['nip_penerima']) $this->db->set('nip_penerima',$arr['nip_penerima']);
    if($arr['nama_penerima']) $this->db->set('nama_penerima',$arr['nama_penerima']);
    if($arr['kd_order_sertifikasi']) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));
    return $this->db->insert('order_sertifikasi_pembayaran');
  }
  
  function getPembayaranSementara($kd_order_sertifikasi,$kd_pembayaran='',$no_pembayaran=''){

    if($kd_order_sertifikasi)$this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    if($kd_pembayaran)$this->db->where('kd_pembayaran',$kd_pembayaran);
    $this->db->order_by('kd_pembayaran','desc');
    $qry=$this->db->get('order_sertifikasi_pembayaran');
    if($qry->num_rows()>0){
      
      return $qry->result();
    }
    return false;
  }
  
  
  
  function deletePembayaran($kd_order_sertifikasi,$kd_pembayaran){
    echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_pembayaran',$kd_pembayaran);
    return $this->db->delete('order_sertifikasi_pembayaran');
  }

  
function getOrderAudit($kd_order_sertifikasi='',$kd_order_audit='') {
      if($kd_order_audit) $this->db->where('kd_order_audit',$kd_order_audit);
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
       
      $query = $this->db->get('order_sertifikasi_audit'); 
      
      if( $query->num_rows() > 0 ) {
            if($kd_order_sertifikasi || $kd_order_audit) return $query->row(); 
            //else return $query->result();
      } else {
            return false;
      }
    }
 
 function saveOrderAudit($arr,$kd_order_sertifikasi,$edit=false){
    if($arr['kd_order_audit']) $this->db->set('kd_order_audit',$arr['kd_order_audit']);
    else $this->db->set('kd_order_audit',$this->mOrder->Make_kd_order_audit());
    if($arr['tgl_awal_audit']) $this->db->set('tgl_awal_audit',$arr['tgl_awal_audit']);
    if($arr['tgl_ahir_audit']) $this->db->set('tgl_ahir_audit',$arr['tgl_ahir_audit']);
    if($arr['tgl_penunjukanauditor_audit']) $this->db->set('tgl_penunjukanauditor_audit',$arr['tgl_penunjukanauditor_audit']);
    if(isset($arr['nip_penunjukanauditor_audit'])) $this->db->set('nip_penunjukanauditor_audit',$arr['nip_penunjukanauditor_audit']);
    if(isset($arr['nama_penunjukanauditor_audit'])) $this->db->set('nama_penunjukanauditor_audit',$arr['nama_penunjukanauditor_audit']);
    if($arr['kd_order_sertifikasi']) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    if($edit){
          if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);  
          $this->db->where('kd_order_audit',$arr['kd_order_audit']); 
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
          $this->db->set('tgl_update',date('Y-m-d H:i:s'));
          $this->db->update('order_sertifikasi_audit');

    }else{
         
          $this->db->insert('order_sertifikasi_audit');

    }
    return true;
  }

  function Make_kd_order_audit(){  
    //echo "<script>alert('make kode true')</script>";  
    $this->db->like('kd_order_audit',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');
    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_audit');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_audit);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-udt-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_order_audit',$kode);
      $qry=$this->db->get('order_sertifikasi_audit');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
}

function getOrderAuditor($kd_order_sertifikasi='',$kd_order_auditor='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_auditor) $this->db->where('kd_order_auditor',$kd_order_auditor);
       
      $query = $this->db->get('order_sertifikasi_auditor'); 
      
      if( $query->num_rows() > 0 ) {
            if($kkd_order_auditor) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }
    
   function getTotalOrderAuditor($kd_order_sertifikasi='',$kd_order_auditor=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_auditor.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_auditor) $this->db->where('order_sertifikasi_auditor.kd_order_auditor',$kd_order_auditor);
      $this->db->from('order_sertifikasi_auditor'); 
     
      return $this->db->count_all_results();
  }
  
  function getResultOrderAuditor($kd_order_sertifikasi,$kd_order_auditor,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_auditor) $this->db->where('order_sertifikasi_auditor.kd_order_auditor',$kd_order_auditor);
      
      $this->db->select('order_sertifikasi_auditor.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_auditor');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function Make_kd_order_auditor(){
    
    $this->db->like('kd_order_auditor',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');

    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_auditor');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_auditor);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-ordauditor-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_order_auditor',$kode);
      $qry=$this->db->get('order_sertifikasi_auditor');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

   function saveOrderAuditor($arr,$kd_order_sertifikasi,$edit=false){
    if($arr['kd_order_auditor']) $this->db->set('kd_order_auditor',$arr['kd_order_auditor']);
    else $this->db->set('kd_order_auditor',$this->mOrder->Make_kd_order_auditor());

    if($arr['kd_auditor']) $this->db->set('kd_auditor',$arr['kd_auditor']);
    if($arr['nama_auditor']) $this->db->set('nama_auditor',$arr['nama_auditor']);
    if($arr['singkatan_nama_auditor']) $this->db->set('singkatan_nama_auditor',$arr['singkatan_nama_auditor']);
    if($arr['jabatan_auditor']) $this->db->set('jabatan_auditor',$arr['jabatan_auditor']);
    if($arr['posisi_tim_auditor']) $this->db->set('posisi_tim_auditor',$arr['posisi_tim_auditor']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);  
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    if($edit){
          $this->db->where('kd_order_audit',$arr['kd_order_audit']); 
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
          $this->db->set('tgl_update',date('Y-m-d H:i:s'));
          $this->db->update('order_sertifikasi_auditor');

    }else{
         
          $this->db->insert('order_sertifikasi_auditor');

    }
    return true;
  }

function deleteOrderAuditor($kd_order_sertifikasi,$kd_order_auditor){
    //echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_order_auditor',$kd_order_auditor);
    return $this->db->delete('order_sertifikasi_auditor');
  }

//mulai Order Jadwal detail
function getOrderJadwaldetail($kd_order_sertifikasi='',$kd_order_audit_jadwaldetail='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_audit_jadwaldetail) $this->db->where('kd_order_audit_jadwaldetail',$kd_order_audit_jadwaldetail);
       
      $query = $this->db->get('order_sertifikasi_audit_jadwaldetail'); 
      
      if( $query->num_rows() > 0 ) {
            if($kkd_order_auditor) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }
    
   function getTotalOrderJadwaldetail($kd_order_sertifikasi='',$kd_order_audit_jadwaldetail=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_audit_jadwaldetail.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_audit_jadwaldetail) $this->db->where('order_sertifikasi_audit_jadwaldetail.kd_order_audit_jadwaldetail',$kd_order_audit_jadwaldetail);
      $this->db->from('order_sertifikasi_audit_jadwaldetail'); 
     
      return $this->db->count_all_results();
  }
  
  function getResultOrderJadwaldetail($kd_order_sertifikasi,$kd_order_audit_jadwaldetail,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_audit_jadwaldetail) $this->db->where('order_sertifikasi_audit_jadwaldetail.kd_order_audit_jadwaldetail',$kd_order_audit_jadwaldetail);
      
      $this->db->select('order_sertifikasi_audit_jadwaldetail.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_audit_jadwaldetail');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function Make_kd_order_audit_jadwaldetail(){
    
    $this->db->like('kd_order_audit_jadwaldetail',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');

    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_audit_jadwaldetail');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_audit_jadwaldetail);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-ordauditor-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_order_audit_jadwaldetail',$kode);
      $qry=$this->db->get('order_sertifikasi_audit_jadwaldetail');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

   function saveOrderJadwaldetail($arr,$kd_order_sertifikasi,$edit=false){
    if($arr['kd_order_audit_jadwaldetail']) $this->db->set('kd_order_audit_jadwaldetail',$arr['kd_order_audit_jadwaldetail']);
    else $this->db->set('kd_order_audit_jadwaldetail',$this->mOrder->Make_kd_order_audit_jadwaldetail());

    if($arr['tgl_audit_jadwaldetail']) $this->db->set('tgl_audit_jadwaldetail',$arr['tgl_audit_jadwaldetail']);
    if($arr['waktu_audit_jadwaldetail']) $this->db->set('waktu_audit_jadwaldetail',$arr['waktu_audit_jadwaldetail']);
    if($arr['deskripsi_audit_jadwaldetail']) $this->db->set('deskripsi_audit_jadwaldetail',$arr['deskripsi_audit_jadwaldetail']);    
    if($arr['singkatan_nama_auditor']) $this->db->set('singkatan_nama_auditor',$arr['singkatan_nama_auditor']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);  
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    if($edit){
          $this->db->where('kd_order_audit_jadwaldetail',$arr['kd_order_audit_jadwaldetail']); 
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
          $this->db->set('tgl_update',date('Y-m-d H:i:s'));
          $this->db->update('order_sertifikasi_audit_jadwaldetail');

    }else{
         
          $this->db->insert('order_sertifikasi_audit_jadwaldetail');

    }
    return true;
  }

function deleteOrderJadwaldetail($kd_order_sertifikasi,$kd_order_audit_jadwaldetail){
    //echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_order_audit_jadwaldetail',$kd_order_audit_jadwaldetail);
    return $this->db->delete('order_sertifikasi_audit_jadwaldetail');
  }


function getOrderAuditHasil($kd_order_sertifikasi='',$kd_audithasil='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_audithasil) $this->db->where('kd_audithasil',$kd_audithasil);
       
      $query = $this->db->get('order_sertifikasi_audit_hasil'); 
      
      if( $query->num_rows() > 0 ) {
            if($kd_audithasil) return $query->row(); 
            else return $query->row(); //$query->result();
      } else {
            return false;
      }
  }
    
  function getTotalOrderAuditHasil($kd_order_sertifikasi='',$kd_audithasil=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_audit_hasil.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_audithasil) $this->db->where('order_sertifikasi_audit_hasil.kd_audithasil',$kd_audithasil);
      $this->db->from('order_sertifikasi_audit_hasil'); 
     
      return $this->db->count_all_results();
  }
  
  function getResultOrderAuditHasil($kd_order_sertifikasi,$kd_audithasil,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_audithasil) $this->db->where('order_sertifikasi_audit_hasil.kd_audithasil',$kd_audithasil);
      
      $this->db->select('order_sertifikasi_audit_hasil.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_audit_hasil');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function Make_kd_audithasil(){
    
    $this->db->like('kd_audithasil',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');

    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_audit_hasil');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_audithasil);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-ordaudithasil-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_audithasil',$kode);
      $qry=$this->db->get('order_sertifikasi_audit_hasil');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

   function saveOrderAuditHasil($arr,$kd_order_sertifikasi,$edit=false){
    if($arr['kd_audithasil']) $this->db->set('kd_audithasil',$arr['kd_audithasil']);
    else $this->db->set('kd_audithasil',$this->mOrder->Make_kd_audithasil());

    if($arr['tgl_diterima_audithasil']) $this->db->set('tgl_diterima_audithasil',$arr['tgl_diterima_audithasil']);
    if($arr['tgl_temuan_audithasil']) $this->db->set('tgl_temuan_audithasil',$arr['tgl_temuan_audithasil']);
    if($arr['kd_auditor']) $this->db->set('kd_auditor',$arr['kd_auditor']);    
    if($arr['kd_order_audit']) $this->db->set('kd_order_audit',$arr['kd_order_audit']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);  
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    if($edit){
          $this->db->where('kd_audithasil',$arr['kd_audithasil']); 
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
          $this->db->set('tgl_update',date('Y-m-d H:i:s'));
          $this->db->update('order_sertifikasi_audit_hasil');

    }else{
         
          $this->db->insert('order_sertifikasi_audit_hasil');

    }
    return true;
  }

function deleteOrderAuditHasil($kd_order_sertifikasi,$kd_audithasil){
    //echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_audithasil',$kd_audithasil);
    return $this->db->delete('order_sertifikasi_audit_hasil');
  }
 //end hasil audit

  function getOrderAuditHasilPerbaikan($kd_order_sertifikasi='',$kd_perbaikanhasil='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_perbaikanhasil) $this->db->where('kd_perbaikanhasil',$kd_perbaikanhasil);
       
      $query = $this->db->get('order_sertifikasi_audit_hasil_perbaikan'); 
      
      if( $query->num_rows() > 0 ) {
            if($kkd_order_auditor) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }
    
  function getTotalOrderAuditHasilPerbaikan($kd_order_sertifikasi='',$kd_perbaikanhasil=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_audit_hasil_perbaikan.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_perbaikanhasil) $this->db->where('order_sertifikasi_audit_hasil_perbaikan.kd_perbaikanhasil',$kd_perbaikanhasil);
      $this->db->from('order_sertifikasi_audit_hasil_perbaikan'); 
     
      return $this->db->count_all_results();
  }
  
  function getResultOrderAuditHasilPerbaikan($kd_order_sertifikasi,$kd_perbaikanhasil,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_perbaikanhasil) $this->db->where('order_sertifikasi_audit_hasil_perbaikan.kd_perbaikanhasil',$kd_perbaikanhasil);
      
      $this->db->select('order_sertifikasi_audit_hasil_perbaikan.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_audit_hasil_perbaikan');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function Make_kd_perbaikanhasil(){
    
    $this->db->like('kd_perbaikanhasil',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');

    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_audit_hasil_perbaikan');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_perbaikanhasil);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-ordperbaikan-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_perbaikanhasil',$kode);
      $qry=$this->db->get('order_sertifikasi_audit_hasil_perbaikan');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

   function saveOrderAuditHasilPerbaikan($arr,$kd_order_sertifikasi,$edit=false){
    if($arr['kd_perbaikanhasil']) $this->db->set('kd_perbaikanhasil',$arr['kd_perbaikanhasil']);
    else $this->db->set('kd_perbaikanhasil',$this->mOrder->Make_kd_perbaikanhasil());

    if($arr['kd_audithasil']) $this->db->set('kd_audithasil',$arr['kd_audithasil']);
    if($arr['tgl_diterima_dari_perusahaan']) $this->db->set('tgl_diterima_dari_perusahaan',$arr['tgl_diterima_dari_perusahaan']);
    if($arr['tgl_diberikan_ke_auditor']) $this->db->set('tgl_diberikan_ke_auditor',$arr['tgl_diberikan_ke_auditor']);    
    if($arr['tgl_diterima_dari_auditor']) $this->db->set('tgl_diterima_dari_auditor',$arr['tgl_diterima_dari_auditor']);
    if($arr['tgl_dkembalikan_ke_perusahaan']) $this->db->set('tgl_dkembalikan_ke_perusahaan',$arr['tgl_dkembalikan_ke_perusahaan']);
    if($arr['status_perbaikanhasil']) $this->db->set('status_perbaikanhasil',$arr['status_perbaikanhasil']);
    if($arr['keterangan']) $this->db->set('keterangan',$arr['keterangan']);    
    if($arr['kd_auditor']) $this->db->set('kd_auditor',$arr['kd_auditor']); 
    if($arr['kd_order_audit']) $this->db->set('kd_order_audit',$arr['kd_order_audit']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);  
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    if($edit){
          $this->db->where('kd_perbaikanhasil',$arr['kd_perbaikanhasil']); 
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
          $this->db->set('tgl_update',date('Y-m-d H:i:s'));
          $this->db->update('order_sertifikasi_audit_hasil_perbaikan');

    }else{
         
          $this->db->insert('order_sertifikasi_audit_hasil_perbaikan');

    }
    return true;
  }

function deleteOrderAuditHasilPerbaikan($kd_order_sertifikasi,$kd_perbaikanhasil){
    //echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_perbaikanhasil',$kd_perbaikanhasil);
    return $this->db->delete('order_sertifikasi_audit_hasil_perbaikan');
  }
 //end hasil audit
  //awal ahasil audit per temua
function getOrderAuditHasilPerTemuan($kd_order_sertifikasi='',$kd_audithasil='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_audithasil) $this->db->where('kd_audithasil',$kd_audithasil);
       
      $query = $this->db->get('order_sertifikasi_audit_hasil_pertemuan'); 
      
      if( $query->num_rows() > 0 ) {
            if($kkd_order_auditor) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }
    
  function getTotalOrderAuditHasilPerTemuan($kd_order_sertifikasi='',$kd_audithasil=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_audit_hasil_pertemuan.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_audithasil) $this->db->where('order_sertifikasi_audit_hasil_pertemuan.kd_audithasil',$kd_audithasil);
      $this->db->from('order_sertifikasi_audit_hasil_pertemuan'); 
     
      return $this->db->count_all_results();
  }
  
  function getResultOrderAuditHasilPerTemuan($kd_order_sertifikasi,$kd_audithasil,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_audithasil) $this->db->where('order_sertifikasi_audit_hasil_pertemuan.kd_audithasil',$kd_audithasil);
      
      $this->db->select('order_sertifikasi_audit_hasil_pertemuan.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_audit_hasil_pertemuan');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function Make_kd_audithasilPerTemuan(){
    
    $this->db->like('kd_audithasil',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');

    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_audit_hasil_pertemuan');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_audithasil);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-ordaudithasilpertemuan-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_audithasil',$kode);
      $qry=$this->db->get('order_sertifikasi_audit_hasil_pertemuan');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

   function saveOrderAuditHasilPerTemuan($arr,$kd_order_sertifikasi,$edit=false){
    if($arr['kd_audithasil']) $this->db->set('kd_audithasil',$arr['kd_audithasil']);
    else $this->db->set('kd_audithasil',$this->mOrder->Make_kd_audithasil());

    if($arr['tgl_diterima_audithasil']) $this->db->set('tgl_diterima_audithasil',$arr['tgl_diterima_audithasil']);
    if($arr['lokasi_audithasil']) $this->db->set('lokasi_audithasil',$arr['lokasi_audithasil']);
    if($arr['referensi_audithasil']) $this->db->set('referensi_audithasil',$arr['referensi_audithasil']);    
    if($arr['standard_audithasil']) $this->db->set('standard_audithasil',$arr['standard_audithasil']);
    if($arr['tgl_temuan_audithasil']) $this->db->set('tgl_temuan_audithasil',$arr['tgl_temuan_audithasil']);
    if($arr['tgl_targert_penyelesaian_audithasil']) $this->db->set('tgl_targert_penyelesaian_audithasil',$arr['tgl_targert_penyelesaian_audithasil']);
    if($arr['temuan_audihasil']) $this->db->set('temuan_audihasil',$arr['temuan_audihasil']);    
    if($arr['kategori_temuan_audithasil']) $this->db->set('kategori_temuan_audithasil',$arr['kategori_temuan_audithasil']);
    if($arr['status_temuan_audithasil']) $this->db->set('status_temuan_audithasil',$arr['status_temuan_audithasil']);
    if($arr['kd_auditor']) $this->db->set('kd_auditor',$arr['kd_auditor']);    
    if($arr['kd_order_audit']) $this->db->set('kd_order_audit',$arr['kd_order_audit']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);  
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    if($edit){
          $this->db->where('kd_audithasil',$arr['kd_audithasil']); 
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
          $this->db->set('tgl_update',date('Y-m-d H:i:s'));
          $this->db->update('order_sertifikasi_audit_hasil_pertemuan');

    }else{
         
          $this->db->insert('order_sertifikasi_audit_hasil_pertemuan');

    }
    return true;
  }

function deleteOrderAuditHasilPerTemuan($kd_order_sertifikasi,$kd_audithasil){
    //echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_audithasil',$kd_audithasil);
    return $this->db->delete('order_sertifikasi_audit_hasil_pertemuan');
  }


  //end hasil audit pertemuan

function getOrderAuditSHU($kd_order_sertifikasi='',$kd_order_audit_shu='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_audit_shu) $this->db->where('kd_order_audit_shu',$kd_order_audit_shu);
       
      $query = $this->db->get('order_sertifikasi_audit_shu'); 
      
      if( $query->num_rows() > 0 ) {
            if($kkd_order_auditor) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }
    
  function getTotalOrderAuditSHU($kd_order_sertifikasi='',$kd_order_audit_shu=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_audit_shu.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_audit_shu) $this->db->where('order_sertifikasi_audit_shu.kd_order_audit_shu',$kd_order_audit_shu);
      $this->db->from('order_sertifikasi_audit_shu'); 
     
      return $this->db->count_all_results();
  }
  
  function getResultOrderAuditSHU($kd_order_sertifikasi,$kd_order_audit_shu,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_audit_shu) $this->db->where('order_sertifikasi_audit_shu.kd_order_audit_shu',$kd_order_audit_shu);
      
      $this->db->select('order_sertifikasi_audit_shu.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_audit_shu');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function Make_kd_order_audit_shu(){
    
    $this->db->like('kd_order_audit_shu',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');

    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_audit_shu');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_audit_shu);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-ordauditshu-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_order_audit_shu',$kode);
      $qry=$this->db->get('order_sertifikasi_audit_shu');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

 function saveOrderAuditSHU($arr,$kd_order_sertifikasi,$edit=false){
    if($arr['kd_order_audit_shu']) $this->db->set('kd_order_audit_shu',$arr['kd_order_audit_shu']);
    else $this->db->set('kd_order_audit_shu',$this->mOrder->Make_kd_order_audit_shu());

    if($arr['no_bhpc']) $this->db->set('no_bhpc',$arr['no_bhpc']);
    if($arr['no_shu']) $this->db->set('no_shu',$arr['no_shu']);
    if($arr['tgl_shu']) $this->db->set('tgl_shu',$arr['tgl_shu']);
    if($arr['tgl_diterima_shu']) $this->db->set('tgl_diterima_shu',$arr['tgl_diterima_shu']);
    if($arr['file_SHU']) $this->db->set('file_SHU',$arr['file_SHU']);

    if($arr['kd_order_audit']) $this->db->set('kd_order_audit',$arr['kd_order_audit']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);  
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    if($edit){
          $this->db->where('kd_order_audit_shu',$arr['kd_order_audit_shu']); 
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
          $this->db->set('tgl_update',date('Y-m-d H:i:s'));
          $this->db->update('order_sertifikasi_audit_shu');

    }else{
         
          $this->db->insert('order_sertifikasi_audit_shu');

    }
    return true;
  }

function deleteOrderAuditSHU($kd_order_sertifikasi,$kd_order_audit_shu){
    //echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_order_audit_shu',$kd_order_audit_shu);
    return $this->db->delete('order_sertifikasi_audit_shu');
  }

  function getOrderEvaluasi($kd_order_sertifikasi='',$kd_order_evaluasi='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_evaluasi) $this->db->where('kd_order_evaluasi',$kd_order_evaluasi);
       
      $query = $this->db->get('order_sertifikasi_evaluasi'); 
      
      if( $query->num_rows() > 0 ) {
            if($kkd_order_auditor) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }
    
  function getTotalOrderEvaluasi($kd_order_sertifikasi='',$kd_order_evaluasi=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_evaluasi.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_evaluasi) $this->db->where('order_sertifikasi_evaluasi.kd_order_evaluasi',$kd_order_evaluasi);
      $this->db->from('order_sertifikasi_evaluasi'); 
     
      return $this->db->count_all_results();
  }
  
  function getResultOrderEvaluasi($kd_order_sertifikasi,$kd_order_evaluasi,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_evaluasi) $this->db->where('order_sertifikasi_evaluasi.kd_order_evaluasi',$kd_order_evaluasi);
      
      $this->db->select('order_sertifikasi_evaluasi.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_evaluasi');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function Make_kd_order_evaluasi(){
    
    $this->db->like('kd_order_evaluasi',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');

    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_evaluasi');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_evaluasi);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-ordevaluasi-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_order_evaluasi',$kode);
      $qry=$this->db->get('order_sertifikasi_evaluasi');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

 function saveOrderEvaluasi($arr,$kd_order_sertifikasi,$edit=false){
    if($arr['kd_order_evaluasi']) $this->db->set('kd_order_evaluasi',$arr['kd_order_evaluasi']);
    else $this->db->set('kd_order_evaluasi',$this->mOrder->Make_kd_order_evaluasi());

    if($arr['tgl_evaluasi']) $this->db->set('tgl_evaluasi',$arr['tgl_evaluasi']);
    if($arr['no_evaluasi']) $this->db->set('no_evaluasi',$arr['no_evaluasi']);
    if($arr['isi_evaluasi']) $this->db->set('isi_evaluasi',$arr['isi_evaluasi']);
    if($arr['keputusan_evaluasi']) $this->db->set('keputusan_evaluasi',$arr['keputusan_evaluasi']);
    if($arr['file_evaluasi']) $this->db->set('file_evaluasi',$arr['file_evaluasi']);

    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);  
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    if($edit){
          $this->db->where('kd_order_evaluasi',$arr['kd_order_evaluasi']); 
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
          $this->db->set('tgl_update',date('Y-m-d H:i:s'));
          $this->db->update('order_sertifikasi_evaluasi');

    }else{
         
          $this->db->insert('order_sertifikasi_evaluasi');

    }
    return true;
  }

function deleteOrderEvaluasi($kd_order_sertifikasi,$kd_order_evaluasi){
    //echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_order_evaluasi',$kd_order_evaluasi);
    return $this->db->delete('order_sertifikasi_sertifikat');
  }

  function getOrderSertifikat($kd_order_sertifikasi='',$kd_sertifikat='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_sertifikat) $this->db->where('kd_sertifikat',$kd_sertifikat);
       
      $query = $this->db->get('order_sertifikasi_sertifikat'); 
      
      if( $query->num_rows() > 0 ) {
            if($kd_sertifikat) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }


  function getOrderTimTeknis($kd_order_sertifikasi='',$kd_order_timteknis='') {
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_timteknis) $this->db->where('kd_order_timteknis',$kd_order_timteknis);
       
      $query = $this->db->get('order_sertifikasi_timteknis'); 
      
      if( $query->num_rows() > 0 ) {
            if($kkd_order_auditor) return $query->row(); 
            else return $query->result();
      } else {
            return false;
      }
  }
    
   function getTotalOrderTimTeknis($kd_order_sertifikasi='',$kd_order_timteknis=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_timteknis.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_timteknis) $this->db->where('order_sertifikasi_timteknis.kd_order_timteknis',$kd_order_timteknis);
      $this->db->from('order_sertifikasi_timteknis'); 
     
      return $this->db->count_all_results();
  }
  
  function getResultOrderTimTeknis($kd_order_sertifikasi,$kd_order_timteknis,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_order_timteknis) $this->db->where('order_sertifikasi_timteknis.kd_order_timteknis',$kd_order_timteknis);
      
      $this->db->select('order_sertifikasi_timteknis.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_timteknis');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function Make_kd_order_timteknis(){
    
    $this->db->like('kd_order_timteknis',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');

    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_timteknis');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_order_timteknis);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-ordtimt-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_order_timteknis',$kode);
      $qry=$this->db->get('order_sertifikasi_timteknis');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

   function saveOrderTimTeknis($arr,$kd_order_sertifikasi,$edit=false){
    if($arr['kd_order_timteknis']) $this->db->set('kd_order_timteknis',$arr['kd_order_timteknis']);
    else $this->db->set('kd_order_timteknis',$this->mOrder->Make_kd_order_timteknis());

    if($arr['kd_auditor']) $this->db->set('kd_auditor',$arr['kd_auditor']);
    if($arr['nama_auditor']) $this->db->set('nama_auditor',$arr['nama_auditor']);
    if($arr['singkatan_nama_auditor']) $this->db->set('singkatan_nama_auditor',$arr['singkatan_nama_auditor']);
    if($arr['jabatan_auditor']) $this->db->set('jabatan_auditor',$arr['jabatan_auditor']);
    if($arr['posisi_tim_auditor']) $this->db->set('posisi_tim_auditor',$arr['posisi_tim_auditor']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);  
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    if($edit){
          $this->db->where('kd_order_audit',$arr['kd_order_audit']); 
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
          $this->db->set('tgl_update',date('Y-m-d H:i:s'));
          $this->db->update('order_sertifikasi_timteknis');

    }else{
         
          $this->db->insert('order_sertifikasi_timteknis');

    }
    return true;
  }

function deleteOrderTimTeknis($kd_order_sertifikasi,$kd_order_timteknis){
    //echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_order_timteknis',$kd_order_timteknis);
    return $this->db->delete('order_sertifikasi_timteknis');
  }
    
  function getTotalOrderSertifikat($kd_order_sertifikasi='',$kd_sertifikat=''){
    
      if($kd_order_sertifikasi) $this->db->where('order_sertifikasi_sertifikat.kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_sertifikat) $this->db->where('order_sertifikasi_sertifikat.kd_sertifikat',$kd_sertifikat);
      $this->db->from('order_sertifikasi_sertifikat'); 
     
      return $this->db->count_all_results();
  }
  
  function getResultOrderSertifikat($kd_order_sertifikasi,$kd_sertifikat,$ord,$srt,$limit,$start){
      $this->db->limit($limit,$start);
      $this->db->order_by($ord,$srt);        
      //echo "<script>alert('test')</script>";
      if($kd_order_sertifikasi) $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
      if($kd_sertifikat) $this->db->where('order_sertifikasi_sertifikat.kd_sertifikat',$kd_sertifikat);
      
      $this->db->select('order_sertifikasi_sertifikat.*');//,order_sertifikasi_dokumen.*'); 
      $this->db->from('order_sertifikasi_sertifikat');
      //$this->db->join('order_sertifikasi_dokumen','order_sertifikasi_dokumen.kd_penawaran=order_sertifikasi_penawaran_list.kd_penawaran');
      $qry=$this->db->get();                  
    
      if($qry->num_rows()>0){
          return $qry->result(); 
      }
      return false;
  }

  function Make_kd_sertifikat(){
    
    $this->db->like('kd_sertifikat',date("Y"));   
    $this->db->where('kd_satker',$this->session->userdata('profil')->kd_satker);
    $this->db->order_by('tgl_create','desc');

    $this->db->limit(1);
    $qry=$this->db->get('order_sertifikasi_sertifikat');
    if($qry->num_rows()>0){
      $result=$qry->row();
      $arr_urut=explode("-",$result->kd_sertifikat);
      $urut=$arr_urut[count($arr_urut)-1];//'05'
      settype($urut,"integer");
      $urut+=1;
    } else { $urut=1; }
    #cekdulu
    do{
      $prefix=$this->session->userdata('profil')->kd_satker."-ordsertifikat-".date("Y")."-";
      $kode=$prefix.$urut;
      $this->db->where('kd_sertifikat',$kode);
      $qry=$this->db->get('order_sertifikasi_sertifikat');
      $urut++;
    } while($qry->num_rows()>0);
    return $kode;
  }

 function saveOrderSertifikat($arr,$kd_order_sertifikasi,$edit=false){
    if($arr['kd_sertifikat']) $this->db->set('kd_sertifikat',$arr['kd_sertifikat']);
    else $this->db->set('kd_sertifikat',$this->mOrder->Make_kd_sertifikat());

    if($arr['no_sertifikat']) $this->db->set('no_sertifikat',$arr['no_sertifikat']);
    if($arr['file_sertifikat']) $this->db->set('file_sertifikat',$arr['file_sertifikat']);
    if($arr['tgl_cetak_sertifikat']) $this->db->set('tgl_cetak_sertifikat',$arr['tgl_cetak_sertifikat']);
    if($arr['tgl_awal_berlaku_sertifikat']) $this->db->set('tgl_awal_berlaku_sertifikat',$arr['tgl_awal_berlaku_sertifikat']);
    if($arr['tgl_akhir_berlaku_sertifikat']) $this->db->set('tgl_akhir_berlaku_sertifikat',$arr['tgl_akhir_berlaku_sertifikat']);
    if($arr['nama_penandatangan_sertifikat']) $this->db->set('nama_penandatangan_sertifikat',$arr['nama_penandatangan_sertifikat']);
    if($arr['tgl_penandatangan_sertifikat']) $this->db->set('tgl_penandatangan_sertifikat',$arr['tgl_penandatangan_sertifikat']);
    if($arr['tgl_serah_sertifikat']) $this->db->set('tgl_serah_sertifikat',$arr['tgl_serah_sertifikat']);
    if($arr['metode_serah_sertifikat']) $this->db->set('metode_serah_sertifikat',$arr['metode_serah_sertifikat']);
    if($arr['nip_penyerah_sertifikat']) $this->db->set('nip_penyerah_sertifikat',$arr['nip_penyerah_sertifikat']);
    if($arr['nama_penyerah_sertifikat']) $this->db->set('nama_penyerah_sertifikat',$arr['nama_penyerah_sertifikat']);
    if($arr['nama_penerima_sertifikat']) $this->db->set('nama_penerima_sertifikat',$arr['nama_penerima_sertifikat']);
    if(isset($arr['kd_order_sertifikasi'])) $this->db->set('kd_order_sertifikasi',$arr['kd_order_sertifikasi']);  
    if($arr['kd_satker']) $this->db->set('kd_satker',$arr['kd_satker']);
    if($arr['tgl_create']) $this->db->set('tgl_create',$arr['tgl_create']);
    else $this->db->set('tgl_create',date("Y-m-d H:i:s"));

    if($edit){
          echo "<script>alert('edit Oke')</script>";
          $this->db->where('kd_sertifikat',$arr['kd_sertifikat']); 
          $this->db->where('kd_order_sertifikasi',$arr['kd_order_sertifikasi']); 
          $this->db->set('tgl_update',date('Y-m-d H:i:s'));
          $this->db->update('order_sertifikasi_sertifikat');
          //$this->db->update('order_sertifikasi_sertifikat');

    }else{
          echo "<script>alert('Add Oke')</script>";
          $this->db->insert('order_sertifikasi_sertifikat');
    }
    return true;
  }

function deleteOrderSertifikat($kd_order_sertifikasi,$kd_sertifikat){
    //echo "<script>alert('hapus2')</script>";
    $this->db->where('kd_order_sertifikasi',$kd_order_sertifikasi);
    $this->db->where('kd_sertifikat',$kd_sertifikat);
    return $this->db->delete('order_sertifikasi_sertifikat');
}

function getUserOrder ($kd_customer){
	$this->db->select('noreg_order_sertifikasi, status_order_sertifikasi');
	$this->db->from("order_sertifikasi");
	$this->db->where("kd_customer", $kd_customer);
	$query = $this->db->get();
	if($query->num_rows() !=0)
	{	
		return $query->result_array();
	}
	else{
		return false;
	}
}
	function getStatusOrder($kd_order){
	$this->db->select('order_sertifikasi.noreg_order_sertifikasi, status_order_sertifikasi, pesan'); 
	$this->db->join('order_sertifikasi_status', 'order_sertifikasi.kd_order_sertifikasi = order_sertifikasi_status.kd_order_sertifikasi'); 
	$this->db->join('mst_sertifikasi_step_status', 'order_sertifikasi_status.kd_step_status = mst_sertifikasi_step_status.kd_step_status');
	$this->db->from("order_sertifikasi");
	$this->db->where("order_sertifikasi.kd_order_sertifikasi", $kd_order);
	$this->db->order_by('order_sertifikasi_status.tgl_create', 'desc');
	$this->db->limit(1);
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
?>
