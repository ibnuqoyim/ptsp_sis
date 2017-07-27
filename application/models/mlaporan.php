<?php
class mLaporan extends CI_Model {
 	var $result;
	function __construct()
        {
        	parent::__construct();
	}
	
	
	function laporan_customer($kd_tipe_customer,$bln='01',$kd_satker='',$tahun=''){
		if($kd_satker) $this->db->where('customer.kd_satker',$kd_satker);
		$this->db->where('customer.kd_tipe_customer',$kd_tipe_customer);		
		if($tahun=='') $tahun=date("Y");
		$bulan=$tahun.'-'.$bln.'-';
		$this->db->like('work_order_pengujian.tgl_order',$bulan);		
		$this->db->from('customer');
		$this->db->join('work_order_pengujian','work_order_pengujian.nama_customer_asal=customer.nama');
		$qry=$this->db->get();
		return $qry->result();//$qry->num_rows();

	}
	
	function laporan_customer_kumulatif($kd_tipe_customer,$bln1='01',$bln='01',$kd_satker='',$tahun=''){
		if($kd_satker) $this->db->where('work_order_pengujian.kd_satker',$kd_satker);
		$this->db->where('kd_tipe_customer',$kd_tipe_customer);
		if($tahun=='') $tahun=date("Y");
		$bulan1=$tahun.'-'.$bln1.'-1';
		$bulan=$tahun.'-'.$bln.'-31';
		$this->db->where('work_order_pengujian.tgl_order >=',$bulan1);
		$this->db->where('work_order_pengujian.tgl_order <=',$bulan);
		$this->db->join('work_order_pengujian','work_order_pengujian.nama_customer_asal=customer.nama');
		$qry=$this->db->get('customer');
		return $qry->result();
	}

	function laporan_order($kd_tipe_customer,$bln='01',$kd_satker='',$tahun=''){		
		if($kd_satker) $this->db->where('work_order_pengujian.kd_satker',$kd_satker);
		$this->db->where('customer.kd_tipe_customer',$kd_tipe_customer);
		$this->db->from('work_order_pengujian');
		$this->db->join('customer','customer.nama=work_order_pengujian.nama_customer_asal');
		if($tahun=='') $tahun=date("Y");
		$bulan=$tahun.'-'.$bln.'-';
		$this->db->like('work_order_pengujian.tgl_order',$bulan); 
		$qry=$this->db->get();
		return $qry->result();//$qry->num_rows();
	}

	function laporan_order_kumulatif($kd_tipe_customer,$bln1='01',$bln='01',$kd_satker='',$tahun=''){
		if($kd_satker) $this->db->where('work_order_pengujian.kd_satker',$kd_satker);
		$this->db->where('customer.kd_tipe_customer',$kd_tipe_customer);
		//$this->db->where('work_order_pengujian.status_order','selesai semua');
		//$this->db->where('work_order_pengujian.status_bayar','lunas');
		$this->db->from('work_order_pengujian');
		$this->db->join('customer','customer.nama=work_order_pengujian.nama_customer_asal');
		if($tahun=='') $tahun=date("Y");
		$bulan1=$tahun.'-'.$bln1.'-1';
		$bulan=$tahun.'-'.$bln.'-31';
		$this->db->where('work_order_pengujian.tgl_order >=',$bulan1);
		$this->db->where('work_order_pengujian.tgl_order <=',$bulan);
		$qry=$this->db->get();
		return $qry->result();
	}
	
	function laporan_shu($kd_tipe_customer,$bln='01',$kd_satker='',$tahun=''){
		if($kd_satker) $this->db->where('work_order_pengujian.kd_satker',$kd_satker);
		$this->db->where('customer.kd_tipe_customer',$kd_tipe_customer);		
		$this->db->join('work_order_pengujian','work_order_pengujian.kd_order=order_shu.kd_order');
		$this->db->join('customer','customer.nama=work_order_pengujian.nama_customer_asal');
		//$this->db->join('customer','customer.nama=work_order_pengujian.nama_customer_tujuan');
		if($tahun=='') $tahun=date("Y");
		$bulan=$tahun.'-'.$bln.'-';
		$this->db->like('order_shu.tgl_cetak',$bulan);
		$this->db->from('order_shu');
		$qry=$this->db->get();
		return $qry->result();
	}
	
	function laporan_shu_kumulatif($kd_tipe_customer,$bln1='01',$bln='01',$kd_satker='',$tahun=''){
		if($kd_satker) $this->db->where('work_order_pengujian.kd_satker',$kd_satker);
		$this->db->where('customer.kd_tipe_customer',$kd_tipe_customer);		
		$this->db->join('work_order_pengujian','work_order_pengujian.kd_order=order_shu.kd_order');
		$this->db->join('customer','customer.nama=work_order_pengujian.nama_customer_asal');
		//$this->db->join('customer','customer.nama=work_order_pengujian.nama_customer_tujuan');
		if($tahun=='') $tahun=date("Y");
		$bulan1=$tahun.'-'.$bln1.'-1';
		$bulan=$tahun.'-'.$bln.'-31';
		$this->db->where('work_order_pengujian.tgl_order >=',$bulan1);
		$this->db->where('work_order_pengujian.tgl_order <=',$bulan);
		$this->db->from('order_shu');
		$qry=$this->db->get();
		return $qry->result();
	}
	function laporan_pnbp($kd_tipe_customer,$bln='01',$kd_satker='',$tahun=''){
		if($kd_satker) $this->db->where('work_order_pengujian.kd_satker',$kd_satker);
		$this->db->where('customer.kd_tipe_customer',$kd_tipe_customer);
		$this->db->join('customer','customer.nama=work_order_pengujian.nama_customer_asal');
		if($tahun=='') $tahun=date("Y");
		$bulan=$tahun.'-'.$bln.'-';		
		$this->db->like('work_order_pengujian.tgl_order',$bulan); 
		$this->db->from('work_order_pengujian');
		$qry=$this->db->get();
		return $qry->result();
	}
	
	function laporan_pnbp_kumulatif($kd_tipe_customer,$bln1='01',$bln='01',$kd_satker='',$tahun=''){
		if($kd_satker) $this->db->where('work_order_pengujian.kd_satker',$kd_satker);
		$this->db->where('customer.kd_tipe_customer',$kd_tipe_customer);
		$this->db->join('customer','customer.nama=work_order_pengujian.nama_customer_asal');
		if($tahun=='') $tahun=date("Y");
		$bulan=$tahun.'-'.$bln.'-';
		if($tahun=='') $tahun=date("Y");
		$bulan1=$tahun.'-'.$bln1.'-1';
		$bulan=$tahun.'-'.$bln.'-31';
		$this->db->where('work_order_pengujian.tgl_order >=',$bulan1);
		$this->db->where('work_order_pengujian.tgl_order <=',$bulan);
		$this->db->from('work_order_pengujian');
		$qry=$this->db->get();
		return $qry->result();
	}
	
}
?>
