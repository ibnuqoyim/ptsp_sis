public function orderKontrak($kd_order_sertifikasi='',$kd_kontrak=''){
	    $this->errormsg="";          

	   	if($kd_order_sertifikasi) $toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	
	    if($kd_kontrak) $toveiw['kontrak']=$kd_sertifikat;
	    else $toveiw['kontrak']='';

		$toview['no_kontrak']='';
		$toview['tgl_cetak_kontrak']='';	   	
	   	$toview['file_kontrak']='';
	   	$toview['nama_penandatangan_bbk_kontrak']='';
	   	$toview['nip_penandatangan_bbk_kontrak']='';
	   	$toview['jabatan_penandatangan_bbk_kontrak']='';
	   	$toview['tgl_penandatangan_bbk_kontrak']='';
	   	$toview['nama_penandatangan_perusahaan_kontrak']='';
	   	$toview['nip_penandatangan_perusahaan_kontrak']='';
	   	$toview['jabatan_penandatangan_perusahaan_kontrak']='';
	   	$toview['tgl_penandatangan_perusahaan_kontrak']='';
	   	$toview['nip_pembuat_kontrak']='';
	   	$toview['nama_pembuat_kontrak']='';
	   	$toview['tgl_diterima_kontrak']='';
		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;	

	   	$toview['limit']=30;
	   	$toview['page']=1;
	   	$page=1;

		$toview['totOrderKontrak']=$this->mOrder->getTotalOrderKontrak($toview['kd_order_sertifikasi'],'');
		/*echo "<script>alert('{$toview['tot']}')</script>";*/
		if($toview['totOrderKontrak']>0){
			$toview['pages']=ceil($toview['totOrderKontrak']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['resultOrderKontrak']=$this->mOrder->getResultOrderKontrak($toview['kd_order_sertifikasi'],'','kd_kontrak','asc',30,0);
		} else {
			$toview['pages']=0;
			$toview['page']=1;
			$toview['start']=0;
			$toview['resultOrderKontrak']=false;
		}
		
		$this->form_validation->set_rules('no_kontrak', 'No Kontrakt', 'required');
		$this->form_validation->set_message('required', '%s Wajib diisi!');		
		$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
		
		//echo "<script>alert('test save ? ')</script>";
		if($this->input->post('save')){
		  //echo "<script>alert('test input save true'".trim($this->input->post('save')).")</script>";
		  if($this->form_validation->run())
		  {
			//echo "<script>alert('test for falidasi true')</script>";
			if($this->input->post('tambah')){
				//echo "<script>alert('test for input post tambah true')</script>";
						$toview['kd_kontrak']=$this->mOrder->Make_kd_kontrak();	
				   		$toview['no_kontrak']=trim($this->input->post('no_kontrak'));		
						$toview['tgl_cetak_kontrak']=trim($this->input->post('tgl_cetak_kontrak'));		
	   					$toview['file_kontrak']=trim($this->input->post('file_kontrak'));		
	   					$toview['nama_penandatangan_bbk_kontrak']=trim($this->input->post('nama_penandatangan_bbk_kontrak'));		
	   					$toview['nip_penandatangan_bbk_kontrak']=trim($this->input->post('nip_penandatangan_bbk_kontrak'));		
	   					$toview['jabatan_penandatangan_bbk_kontrak']=trim($this->input->post('jabatan_penandatangan_bbk_kontrak'));		
	   					$toview['tgl_penandatangan_bbk_kontrak']=trim($this->input->post('tgl_penandatangan_bbk_kontrak'));		
	   					$toview['nama_penandatangan_perusahaan_kontrak']=trim($this->input->post('nama_penandatangan_perusahaan_kontrak'));		
	   					$toview['nip_penandatangan_perusahaan_kontrak']=trim($this->input->post('nip_penandatangan_perusahaan_kontrak'));		
	   					$toview['jabatan_penandatangan_perusahaan_kontrak']=trim($this->input->post('jabatan_penandatangan_perusahaan_kontrak'));		
	   					$toview['tgl_penandatangan_perusahaan_kontrak']=trim($this->input->post('tgl_penandatangan_perusahaan_kontrak'));
	   					$toview['nip_pembuat_kontrak']=trim($this->input->post('nip_pembuat_kontrak'));
	   					$toview['nama_pembuat_kontrak']=trim($this->input->post('nama_pembuat_kontrak'));

	   					$toview['tgl_diterima_kontrak']=trim($this->input->post('tgl_diterima_kontrak'));		

				  		$toview['kd_order_sertifikasi']=$kd_order_sertifikasi;
						$toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
				if($this->errormsg=="") { 
							
						$file_dir='./download/kontrak/'.date('Y-m').'/';
						if(!file_exists($file_dir)) {
								mkdir($file_dir);
						}else {
								
								echo "<script>alert('Ok.file direktori sudah ada')</script>";
								$file_dir =$file_dir;

						}
						
						$config['upload_path'] = $file_dir;
						$config['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx|txt';
						$config['max_size']	= '2500000';
						//$syxupload['max_width']  = '1024';
						//$syxupload['max_height']  = '768';	
						$this->load->library('upload', $config);
						//$this->upload->initialize($syxupload);

						if (! $this->upload->do_upload('file_kontrak'))
						{
							$this->errormsg = "Upload Gagal!! ".$file_dir.$this->upload->display_errors();
						}else{
				    		//echo "<script>alert('test no error message true')</script>";\
							$data = array('upload_data' => $this->upload->data());
							$toview['file_kontrak']=$file_dir.$data['upload_data']['file_name'];			    		
									
							$hasil=$this->mOrder->saveOrderKontrak($toview,$toview['kd_order_sertifikasi'],false); 
							//echo "<script>alert('test disimpan')</script>";
							if($hasil) { 
								//$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
								//current_url(),"Order ESertifikasi ");
								$this->errormsg='<em style="color:green">Berhasil disimpan!</em>';
								//echo "<script>alert('Berhasil disimpan')</script>";
								redirect('order/orderSertifikat/'.$toview['kd_order_sertifikasi']);
							} else { 
								$this->errormsg='<em style="color:red">Maaf, Penyimpanan gagal boss!</em>';
								//echo "<script>alert('Maaf, Penyimpanan gagal boss!')</script>";
								redirect(current_url());
							}
						}
					}else{ 
						//echo "<script>alert(".$this->errormsg."')</script>";
				}
			  }else{ 
			  	//echo "<script>alert('test for input post tambah false')</script>";
			  }
		  }else { 
		  	//echo "<script>alert('test validasi  false')</script>";
		  	 }
		}else { 
			//echo "<script>alert('test input save false'".trim($this->input->post('save')).")</script>"; 
		}
		
		
		#judul
		$this->judul='Kontrak';
		$this->javascript=';
					<script type="text/javascript">
						$("#tgl_cetak_kontrak").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_penandatangan_bbk_kontrak").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_penandatangan_perusahaan_kontrak").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
						$("#tgl_diterima_kontrak").datepicker({
							dateFormat: "yy-mm-dd",
							appendText: "(format: yyyy-mm-dd)",
							showOn: "both" 
						});
					</script>';
		
		#load view
		$this->content=$this->load->view('order/sertifikasi/order_kontrak',$toview);	
}