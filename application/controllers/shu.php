<?php
class shu extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->helper('inputer');
		$this->load->helper('date');
		$this->load->model('mOrder');
		$this->load->model('mSHU');
		$this->load->model('mRHU');
 		$this->load->model('mUser');
		$this->load->model('mTarif');
   }
	
	public function index($no_shu='-',$no_pengujian='-',$no_order='-',$tgl_cetak='-',$file_shu='-',
				$ord='shu.kd_shu',$srt='desc',$limit=30,$page=1) {
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!

		$toview['no_shu']=GetInput($this->input->post('no_shu'),$no_shu);
	        $toview['no_pengujian']=GetInput($this->input->post('no_pengujian'),$no_pengujian);		
		
		if(trim($this->input->post('no_order'))){	
			$no_order=$this->input->post('no_order');
			$order = $this->mOrder->getOrder('',false,$no_order);
			if($order){
				foreach($order as $row){
					$toview['kd_order']=  $row->kd_order; 
				}
			}else{
				$toview['kd_order']= '';
			}
		}else{
			
			$toview['kd_order']= '';
		}
		

		$toview['tgl_cetak']=GetInput($this->input->post('tgl_cetak'),$tgl_cetak);
		$toview['file_shu']=GetInput($this->input->post('file_shu'),$file_shu);
		$toview['ord']=GetInput($this->input->post('ord'),$ord,'order_shu.kd_shu');
		$toview['srt']=GetSort($this->input->post('srt'),$srt,'desc');
		$toview['limit']=(int) $limit;
		if($toview['limit']<1){$toview['limit']=30;}
		$page=(int) @ereg_replace("[^0-9]",'',$page);
		#get result
		$toview['tot']=$this->mSHU->GetTotal($toview['no_shu'],$toview['no_pengujian'],$toview['kd_order'],
				$toview['tgl_cetak'],$toview['file_shu']);
		if($toview['tot']>0){
			$toview['pages']=ceil($toview['tot']/$toview['limit']);
			if(!is_numeric($page)){$toview['page']=1;}
			elseif($page>$toview['pages']){$toview['page']=$toview['pages'];}
			else {$toview['page']=$page;}
			$toview['start']=($toview['page']-1)*$toview['limit'];
			$toview['result']=$this->mSHU->GetResult($toview['no_shu'],$toview['no_pengujian'],$toview['kd_order'],
					$toview['tgl_cetak'],
					$toview['file_shu'],$toview['ord'],$toview['srt'],$toview['limit'],$toview['start']);
		} else {
			$toview['pages']=0;
			$toview['page']=0;
			$toview['start']=0;
			$toview['result']=false;
		}
		#set return url
		$toview['pageurl']='shu/index/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['no_shu'])).'/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['no_pengujian'])).'/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['kd_order'])).'/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['tgl_cetak'])).'/';
		$toview['pageurl'].=SetAttr(rawurlencode($toview['file_shu'])).'/';
		$toview['ordurl']=$toview['pageurl']; //untuk sort
		$toview['pageurl'].=$toview['ord'].'/';
		$toview['pageurl'].=$toview['srt'].'/';
		$toview['limiturl']=$toview['pageurl']; //untuk limit
		$toview['pageurl'].=$toview['limit'].'/';
		$this->session->set_userdata('returnurl',$toview['pageurl'].'index'.$toview['page']);
		#judul
		$this->judul='Daftar shu';
		#load view
		$this->searchbox=$this->load->view('shu/searchbox-shu',$toview,true);
		#javascript
		$this->javascript='
		<script type="text/javascript">
		$("#tgl_cetak").datepicker({
			appendText: " (format: yyyy-mm-dd)",
			showOn: "both" 
		});
		$(document).ready(function(){
		
			$("#shu").each(function(){
				var url = $(this).attr("href") + "?TB_iframe=true&height=250&width=500";
		
				$(this).attr("href", url);
			});
		});  
		</script>';
		$this->content=$this->load->view('shu/view_shu',$toview);
		
	}

	function edit($kd_shu=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		//if($this->session->userdata('profil')->groupname=='super' || $this->session->userdata('profil')->groupname=='admin'){
			$this->errormsg="";
			#return url
			#default value
			$this->form_validation->set_rules('no_shu', 'Nomor shu', 'required');
			$this->form_validation->set_message('required', '%s Wajib diisi!');
			
			$this->form_validation->set_error_delimiters('<em style="color:red">','</em>');
			
			if($this->input->post('save')){
			  if($this->form_validation->run())
			  {
				echo "<script>alert('Error1')</script>";
				 $toview['kd_order']=$this->input->post('kd_order');
				 //$toview['kd_detail_order']=trim($this->input->post('kd_detail_order'));
				 $toview['no_shu']=trim($this->input->post('no_shu'));
				 $toview['tgl_cetak']=trim($this->input->post('tgl_cetak'));
				 $toview['file_shu']=trim($this->input->post('userfile'));

				if($this->errormsg=="") {
					
					$file_dir='./download/'.date('Y-m').'/';
					if(!file_exists($file_dir)) {
						mkdir($file_dir);
					}else {
						//echo "<script>alert('Error2')</script>".$file_dir;
						$file_dir =$file_dir;
					}
					$syxupload['upload_path'] = $file_dir;
					$syxupload['allowed_types'] = 'doc|pdf|xls|jpg|docx|xlsx';
					$syxupload['max_size']	= '2500';
					//$syxupload['max_width']  = '1024';
					//$syxupload['max_height']  = '768';
					
					$this->load->library('upload', $syxupload);
					if (! $this->upload->do_upload())
					{
						$this->errormsg = "Upload Gagal!! ".$this->upload->display_errors();
						//echo "<script>alert('File dir: ')</script>";
					}
					else
					{
						$data = array('upload_data' => $this->upload->data());
						$toview['file_shu']=$file_dir.$data['upload_data']['file_name'];
						$result=$this->mshu->Update($toview,$kd_shu);
						$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],
						current_url(),"Upload File shu");
						//redirect('shu/update_sukses');
						redirect('shu');
						/*echo "<script>alert('File Berhasil disimpan')</script>";*/
						$toview['kd_order']='';
					}
				}
			  }
			}
			$result=$this->mshu->getSHU($kd_shu);
			if($result){
				$this->judul='Edit shu';
				$toview['kd_shu']=$result->kd_shu;
				$toview['no_shu']=$result->no_shu;
				$toview['tgl_cetak']=$result->tgl_cetak;
				$toview['file_shu']=$result->file_shu;
				$toview['kd_order']=$result->kd_order;
				$toview['result']=$result;
			}
			
			#javascript
			$this->javascript='
			<script type="text/javascript">
			$("#tgl_cetak").datepicker({
				appendText: " (format: yyyy-mm-dd)",
				showOn: "both" 
			});
			</script>';
			$this->content=$this->load->view('shu/shu_edit',$toview);
		
	}
	public function upload_sukses(){
		echo "<h1>File Berhasil di Upload</h1>";
		echo "<br><br><input type=\"button\" size=\"30\" style=\"width:300px\" onclick=\"parent.tb_remove(); parent.location.reload(1);\" value=\"OK\">";
	}
	
        public function update_sukses(){
		echo "<h1>Update Sukses</h1>";
		echo "<br><br><input type=\"button\" size=\"30\" style=\"width:300px\" onclick=\"parent.tb_remove(); parent.location.reload('shu');\" value=\"OK\">";
	}
	function del($kd_shu=''){
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		if($this->session->userdata('profil')->groupname=='super'){
			if($kd_shu) $tot=$this->mshu->Delete($kd_shu);
			$this->mUser->WriteLog($this->session->userdata('userid'),$_SERVER['REMOTE_ADDR'],current_url(),"File shu Dihapus");
			$this->session->set_userdata('alert',$tot.' user telah di hapus');
			$returnurl=$this->session->userdata('returnurl');
			if(!$returnurl){$returnurl='shu';}
			elseif(!preg_match("|^user/index/.*$|",$returnurl)){$returnurl='shu';}
			redirect($returnurl);
		} else {
			show_error('<h1>Forbiden</h1>You have no right to access this page');
		}
	}
	
	function view($kd_shu=''){

		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		//if($this->session->userdata('profil')->groupname=='super'){
			$this->errormsg="";
			#return url
			#default value
			$result=$this->mSHU->getSHU($kd_shu,'','');
			if($result){
				$this->judul='View shu';
				$toview['kd_shu']=$result->kd_shu;
				$toview['no_shu']=$result->no_shu;
				$toview['tgl_cetak']=$result->tgl_cetak;
				$toview['file_shu']=$result->file_shu;
				$toview['kd_order']=$result->kd_order;
				$toview['result']=$result;
			}
			#javascript
			$this->javascript='
			<script type="text/javascript">
			$("#tgl_cetak").datepicker({
				appendText: " (format: yyyy-mm-dd)",
				showOn: "both" 
			});
			</script>';
			$this->content=$this->load->view('shu/shu_view',$toview);
		//}
	}

	function viewPDF($kd_shu=''){

		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
		//if($this->session->userdata('profil')->groupname=='super'){
			$this->errormsg="";
			#return url
			#default value
			$result=$this->mSHU->getSHU($kd_shu,'','');
			if($result){
				$this->judul='View shu';
				$toview['kd_shu']=$result->kd_shu;
				$toview['no_shu']=$result->no_shu;
				$toview['tgl_cetak']=$result->tgl_cetak;
				$toview['file_shu']=$result->file_shu;
				$toview['kd_order']=$result->kd_order;
				$toview['result']=$result;
			}
			#javascript
			/*$this->javascript='<script type="text/javascript">
				\'use strict\';
				PDFJS.getDocument('.$result->file_shu.').then(function(pdf) {
  				// Using promise to fetch the page
  					pdf.getPage(1).then(function(page) {
    						var scale = 1.5;
    						var viewport = page.getViewport(scale);

    						//
    						// Prepare canvas using PDF page dimensions
    						//
   						var canvas = document.getElementById(\'the-canvas\');
    						var context = canvas.getContext(\'2d\');
    						canvas.height = viewport.height;
    						canvas.width = viewport.width;

    						//
    						// Render PDF page into canvas context
    						//
    						var renderContext = {
     				 			canvasContext: context,
      							viewport: viewport
    						};
    						page.render(renderContext);
  					});
				});
			</script>';
			/*$this->javascript='
			<script type="text/javascript" src="js/pdfjs/contoh/hello.js"></script>';*/
			$this->javascript='
				<script type="text/javascript">
				$(document).ready(function(){
					$("#mypdfdoc").PDFDoc( { source : \'.$result->file_shu.\' } );
				 });
				</script>';
			$this->content=$this->load->view('shu/shu_viewPDF',$toview);
		//}
	}

}

?>
