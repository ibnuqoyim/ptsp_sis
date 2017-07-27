<?php 

class Laporan extends CI_Controller {
	var $datane;
	var $bulan = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nop","Des");
    	public function __construct() {
        	parent::__construct();
		$this->load->model('mCustomer');
		$this->load->model('mOrder');
		$this->load->model('mLaporan');
		$this->load->helper('inputer');
		$this->load->helper('convertnilai');
		$this->load->model('mTarif');
		if(!$this->session->userdata('login')) redirect('welcome/'); //GETOUT!!
   	 }
	
	public function index($lap=''){
		if($lap){
			echo "ijin ngelap";
		} else {
			$this->customer_bulanan();
		}
	}
	
	public function customer_bulanan(){
		 	$toview['judul_laporan']="Customer Monthly Report";
			if($this->input->post('kd_satker')) 
				$toview['kd_satker']=GetInput($this->input->post('kd_satker'));				
			else $toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$toview['tahun']=GetInput($this->input->post('tahun'),date('Y'));
			$toview['judul']="Daftar Laporan Pelanggan Bulanan <br>Tahun ".$toview['tahun'];
			$toview['isiawal']='<table width="600" border="1" style="border:solid">
			  <tr>
				<td>Customer/Bulan</td>
				';
				for($t=0;$t<12;$t++){
					$toview['isiawal'] .= '
					<td>'.$this->bulan[$t].'</td>';
				}
				$toview['isiawal'] .= '</tr>';
			$tipecust=$this->mCustomer->GetTipeCustomer();
			$i=0;
			foreach($tipecust as $row){
				$toview['isiawal'] .= '<tr><td>'.$row->tipe_customer.'</td>';
				$data[$i]=strtolower($row->tipe_customer);
				for($j=0;$j<12;$j++){
				   if($j<9) $bln='0'.($j+1); else $bln=($j+1);
				   $dat=$this->mLaporan->laporan_customer($row->kd_tipe_customer,$bln,$toview['kd_satker'],
							$toview['tahun']);
				   $k=0;
				   if($dat){
				       $l=1;
				       $kod[] ='';
				       foreach($dat as $row1){
						$kod[$l] = $row1->kd_customer;
						if($kod[$l] <> $kod[$l-1]) $k++;
						$l++;
					}
				   }
				   $toview['isiawal'] .= '<td>'.$k.'</td>';
				   $data2[$i][$j]=$k;
					
					//if($j<11) $this->datane .="{bulan:".$bulan[$j].",".$juml."},\n";
				}
				//$this->datane .="{bulan:".$bulan[11].",perorangan:".$juml.",perorangan:".$juml.",}";
				$toview['isiawal'] .= '</tr>';
				$i++;
			}
			//echo($data2[0][0]);
			for($x=0;$x<12;$x++){
				$this->datane .="{bulan:'".$this->bulan[$x]."',";
				for($y=0;$y<$i;$y++){
					 if($y-1) $this->datane .= $data[$y].":".$data2[$y][$x].",";
					//echo  $data[$y].":".$data2[$y][$x]."-";
				}
				$this->datane .= $data[$y-2].":".$data2[$y-2][$x];
				if($x<11) $this->datane .= "},\n";
			}
			 $this->datane .= "}";
			 
			$toview['isiawal'] .= '</table>';
			
			$toview['isiawal'] .= '<p>';
			$toview['isiawal'] .= '
					<script type="text/javascript">
				
				var chart;
				var chartData = ';
				$toview['isiawal'] .= '['.$this->datane.'];';
				$toview['isiawal'] .= '
				
				window.onload = function() 
				{            
					chart = new AmCharts.AmSerialChart();
					chart.pathToImages = "js/amcharts/javascript/images/";
					chart.dataProvider = chartData;
					chart.marginTop = 15;
					chart.marginLeft = 40;
					chart.marginRight = 1;
					chart.categoryField = "bulan";
					chart.angle = 15;
					chart.depth3D = 7;
					chart.startDuration = 1;
					
					var legend = new AmCharts.AmLegend();
					chart.addLegend(legend);
					
					';
					for($z=0;$z<$i;$z++){
						$toview['isiawal'] .= '
						var graph'.$z.' = new AmCharts.AmGraph();
						graph'.$z.'.title = "'.ucfirst($data[$z]).'";
						graph'.$z.'.valueField = "'.$data[$z].'";
						graph'.$z.'.type = "column";
						graph'.$z.'.lineAlpha = 0;
						graph'.$z.'.fillAlphas = 1;
						chart.addGraph(graph'.$z.');';
					}
									
					$toview['isiawal'] .= '
					chart.categoryAxis.gridPosition = "start";
					
					bravo=chart.write;
					chart.write("chartdiv");
					/*bravo.replace("amcharts.com","erik");
					bravo.write("chartdiv");
					document.getElementById("chartdiv").innerHTML=bravo;*/
				}
				
			</script>';
			$toview['isiawal'] .='<div id="chartdiv" style="width:650px; height:400px;"></div>';
			$toview['script']='
			<script>
				$(function() {
					$( "#accordion" ).accordion();
				});
			</script>';
			//$this->load->view('laporan/view_laporan',$toview);
 			$this->load->view('laporan/laporan_view',$toview);
   	}
	public function customer_kumulatif(){
		 	$toview['judul_laporan']="Cumulative Customer Monthly Report";
			if($this->input->post('kd_satker')) 
				$toview['kd_satker']=GetInput($this->input->post('kd_satker'));				
			else $toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$toview['bulan1']=GetInput($this->input->post('bulan1'),(date('m')-3));
			$toview['bulan']=GetInput($this->input->post('bulan'),date('m'));
			if(strlen($toview['bulan1'])<2) $bln1='0'.$toview['bulan1']; else $bln1=$toview['bulan1'];
			settype($toview['bulan1'],"integer");
			if(strlen($toview['bulan'])<2) $bln='0'.$toview['bulan']; else $bln=$toview['bulan'];

			settype($toview['bulan'],"integer");
			$toview['tahun']=GetInput($this->input->post('tahun'),date('Y'));
			$toview['judul']="Daftar Laporan Pelanggan Kumulatif <br>Tahun ".$toview['tahun'];
			$toview['isiawal']='<table width="600" border="1" style="border:solid">
			  <tr>
				<td>Tipe Customer</td>
                                <td>Jumlah Customer Bulan '.$this->bulan[($toview['bulan1']-1)].' s/d Bulan '.
				$this->bulan[($toview['bulan']-1)].' Tahun '.$toview['tahun'].'</td></tr>
				';
				
			$tipecust=$this->mCustomer->GetTipeCustomer();
			$i=0;
			foreach($tipecust as $row){
				$toview['isiawal'] .= '<tr><td>'.$row->tipe_customer.'</td>';
				$dat=$this->mLaporan->laporan_customer_kumulatif($row->kd_tipe_customer,
				$bln1,$bln,$toview['kd_satker'],$toview['tahun']);
				$k=0;
				if($dat){
				       $l=1;
				       $kod[] ='';
				       foreach($dat as $row1){
						$kod[$l] = $row1->kd_customer;
						if($kod[$l] <> $kod[$l-1]) $k++;
						$l++;
					}
				}
				$this->datane .="{customer:'".$row->tipe_customer."',jumlah:".$k."},\n";
				$toview['isiawal'] .= '<td>'.$k.'</td>';
				$i++;
			}
			$toview['isiawal'] .= '</tr>';
			 
			$toview['isiawal'] .= '</table>';
			
			$toview['isiawal'] .= '<p>';
			$toview['isiawal'] .= '
					<script type="text/javascript">
				

				var chart;
				var chartData = ';
				$toview['isiawal'] .= '['.$this->datane.'];';
				$toview['isiawal'] .= '

				
				window.onload = function() 
				{            
					chart = new AmCharts.AmPieChart();
					chart.dataProvider = chartData;
					chart.titleField = "customer";
					chart.valueField = "jumlah";
					chart.depth3D = 5;

					chart.angle = 5;
					chart.innerRadius = "30%";
					chart.startDuration = 2;
					chart.labelRadius = 15;
					legend = new AmCharts.AmLegend();
					legend.align = "center";
					legend.markerType = "circle";
					chart.addLegend(legend);
					

					chart.write("chartdiv");
				}
				
			</script>';
			$toview['isiawal'] .='<div id="chartdiv" style="width:500px; height:300px;"></div>';
			$toview['script']='
			<script>
				$(function() {
					$( "#accordion" ).accordion({ active: 1 });

				});
			</script>';
			$this->load->view('laporan/laporan_view',$toview);
    	}

	public function order_bulanan($starter=0){
		 	$toview['judul_laporan']="Order Monthly Report";
			if($this->input->post('kd_satker')) 
				$toview['kd_satker']=GetInput($this->input->post('kd_satker'));				
			else $toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
			
			$toview['tahun']=GetInput($this->input->post('tahun'),date('Y'));
			$toview['judul']="Daftar Order Bulanan <br>Tahun ".$toview['tahun'];
			$toview['isiawal']='<table width="500" border="1" style="border:solid">
			  <tr>
				<td>Order/Bulan</td>
				';
				for($t=0;$t<12;$t++){
					$toview['isiawal'] .= '
					<td>'.$this->bulan[$t].'</td>';
				}
				$toview['isiawal'] .= '</tr>';
			$tipecust=$this->mCustomer->GetTipeCustomer();
			$i=0;
			foreach($tipecust as $row){
				$toview['isiawal'] .= '<tr><td>'.$row->tipe_customer.'</td>';
				$data[$i]=strtolower($row->tipe_customer);
				for($j=0;$j<12;$j++){
					if($j<9) $bln='0'.($j+1); else $bln=($j+1);
					if($starter) $juml=0; 
					else $dat=$this->mLaporan->laporan_order($row->kd_tipe_customer,$bln,$toview['kd_satker'],
						$toview['tahun']);
				   	$k=0;
				   	if($dat){
						$l=1;
				       		$kod[] ='';
				       		foreach($dat as $row1){
							$kod[$l] = $row1->kd_customer;
							$k++;
						}
				   	}
				   $toview['isiawal'] .= '<td>'.$k.'</td>';
				   $data2[$i][$j]=$k;
					
					//if($j<11) $this->datane .="{bulan:".$bulan[$j].",".$juml."},\n";
				}
				//$this->datane .="{bulan:".$bulan[11].",perorangan:".$juml.",perorangan:".$juml.",}";
				$toview['isiawal'] .= '</tr>';
				$i++;
			}
			//echo($data2[0][0]);
			for($x=0;$x<12;$x++){
				$this->datane .="{bulan:'".$this->bulan[$x]."',";
				for($y=0;$y<$i;$y++){
					 if($y-1) $this->datane .= $data[$y].":".$data2[$y][$x].",";
					//echo  $data[$y].":".$data2[$y][$x]."-";
				}
				$this->datane .= $data[$y-2].":".$data2[$y-2][$x];
				if($x<11) $this->datane .= "},\n";
			}
			 $this->datane .= "}";
			 
			$toview['isiawal'] .= '</table>';
			
			$toview['isiawal'] .= '<p>';
			$toview['isiawal'] .= '
					<script type="text/javascript">
				
				var chart;
				var chartData = ';
				$toview['isiawal'] .= '['.$this->datane.'];';
				$toview['isiawal'] .= '
				
				window.onload = function() 
				{            
					chart = new AmCharts.AmSerialChart();
					chart.pathToImages = "js/amcharts/javascript/images/";
					chart.dataProvider = chartData;
					chart.marginTop = 15;
					chart.marginRight = 10;
					chart.categoryField = "bulan";
					chart.angle = 15;
					chart.depth3D = 7;
					chart.dash_length=1;
					
					var legend = new AmCharts.AmLegend();
					chart.addLegend(legend);
					
					';
					for($z=0;$z<$i;$z++){
						$toview['isiawal'] .= '
						var graph'.$z.' = new AmCharts.AmGraph();
						graph'.$z.'.title = "'.ucfirst($data[$z]).'";
						graph'.$z.'.valueField = "'.$data[$z].'";
						graph'.$z.'.type = "column";
						graph'.$z.'.lineAlpha = 0;
						graph'.$z.'.fillAlphas = 1;
						chart.addGraph(graph'.$z.');';
					}
									
					$toview['isiawal'] .= '
					chart.categoryAxis.gridPosition = "start";
					
					bravo=chart.write;
					chart.write("chartdiv");
					/*bravo.replace("amcharts.com","erik");
					bravo.write("chartdiv");
					document.getElementById("chartdiv").innerHTML=bravo;*/
				}
				
			</script>';
			$toview['isiawal'] .='<div id="chartdiv" style="width:650px; height:400px;"></div>';
			$toview['script']='
			<script>
				$(function() {
					$( "#accordion" ).accordion();
				});
			</script>';
			$this->load->view('laporan/laporan_view',$toview);
    	}
	public function order_kumulatif(){
			$toview['judul']="Daftar Laporan Order Kumulatif";
		 	$toview['judul_laporan']='Order Kumulatif';
		 	$toview['judul_laporan']="Cumulative Order Monthly Report";
			if($this->input->post('kd_satker')) 
				$toview['kd_satker']=GetInput($this->input->post('kd_satker'));				
			else $toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$toview['bulan1']=GetInput($this->input->post('bulan1'),(date('m')-3));
			$toview['bulan']=GetInput($this->input->post('bulan'),date('m'));
			if($toview['bulan1']<10) $bln1='0'.$toview['bulan1']; else $bln1=$toview['bulan1'];
			if($toview['bulan']<10) $bln='0'.$toview['bulan']; else $bln=$toview['bulan'];
			settype($toview['bulan1'],"integer");
			settype($toview['bulan'],"integer");
			$toview['tahun']=GetInput($this->input->post('tahun'),date('Y'));
			$toview['isiawal']='<table width="300" border="1" style="border:solid">
			  <tr>
				<td>Tipe Customer</td><td>Jumlah Order Bulan '.$this->bulan[($toview['bulan1']-1)].' s/d Bulan '.$this->bulan[($toview['bulan']-1)].' Tahun '.$toview['tahun'].'</td></tr>
				';
				
			$tipecust=$this->mCustomer->GetTipeCustomer();
			$i=0;
			foreach($tipecust as $row){
				$toview['isiawal'] .= '<tr><td>'.$row->tipe_customer.'</td>';
				$dat=$this->mLaporan->laporan_order_kumulatif($row->kd_tipe_customer,$bln1,$bln,
					$toview['kd_satker'],$toview['tahun']);
				$k=0;
				if($dat){
						$l=1;
				       		$kod[] ='';
				       		foreach($dat as $row1){
							$kod[$l] = $row1->kd_customer;
							$k++;
						}
				}
				$this->datane .="{order:'".$row->tipe_customer."',jumlah:".$k."},\n";
				$toview['isiawal'] .= '<td>'.$k.'</td>';
				$i++;
			}
			$toview['isiawal'] .= '</tr>';			 
			$toview['isiawal'] .= '</table>';
			$toview['isiawal'] .= '<p>';
			$toview['isiawal'] .= '
					<script type="text/javascript">
				
				var chart;
				var chartData = ';
				$toview['isiawal'] .= '['.$this->datane.'];';
				$toview['isiawal'] .= '
				
				window.onload = function() 
				{            
					chart = new AmCharts.AmPieChart();
					chart.dataProvider = chartData;
					chart.titleField = "pnbp";
					chart.valueField = "jumlah";
					chart.depth3D = 5;
					chart.angle = 5;
					chart.innerRadius = "30%";
					chart.startDuration = 2;
					chart.labelRadius = 10;
					legend = new AmCharts.AmLegend();
					legend.align = "center";
					legend.markerType = "circle";
					chart.addLegend(legend);
					
					chart.write("chartdiv");
				}
				
			</script>';
			$toview['isiawal'] .='<div id="chartdiv" style="width:500px; height:300px;"></div>';
			$toview['script']='
			<script>
				$(function() {
					$( "#accordion" ).accordion({ active: 1 });
				});
			</script>';
			
			$this->load->view('laporan/laporan_view',$toview);
    }

	public function shu_bulanan($starter=0){
		 	$toview['judul_laporan']="SHU Monthly Report";
			if($this->input->post('kd_satker')) 
				$toview['kd_satker']=GetInput($this->input->post('kd_satker'));				
			else $toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$toview['tahun']=GetInput($this->input->post('tahun'),date('Y'));
			$toview['judul']="Daftar SHU Bulanan <br>Tahun ".$toview['tahun'];
			$toview['isiawal']='<table width="500" border="1" style="border:solid">
			  <tr>
				<td>SHU/Bulan</td>
				';
				for($t=0;$t<12;$t++){
					$toview['isiawal'] .= '
					<td>'.$this->bulan[$t].'</td>';
				}
				$toview['isiawal'] .= '</tr>';
			$tipecust=$this->mCustomer->GetTipeCustomer();
			$i=0;
			foreach($tipecust as $row){
				$toview['isiawal'] .= '<tr><td>'.$row->tipe_customer.'</td>';
				$data[$i]=strtolower($row->tipe_customer);
				for($j=0;$j<12;$j++){
				  if($j<9) $bln='0'.($j+1); else $bln=($j+1);
				  if($starter) $juml=0; 
				  else $dat=$this->mLaporan->laporan_shu($row->kd_tipe_customer,$bln,$toview['kd_satker'],$toview['tahun']);
				  $k=0;
				  if($dat){
						$l=1;
				       		$kod[] ='';
				       		foreach($dat as $row1){
							$kod[$l] = $row1->kd_customer;
							$k++;
						}
				  }	
                                  $toview['isiawal'] .= '<td>'.$k.'</td>';
					$data2[$i][$j]=$k;
				}
				$toview['isiawal'] .= '</tr>';
				$i++;
			}
			for($x=0;$x<12;$x++){
				$this->datane .="{bulan:'".$this->bulan[$x]."',";
				for($y=0;$y<$i;$y++){
					 if($y-1) $this->datane .= $data[$y].":".$data2[$y][$x].",";
				}
				$this->datane .= $data[$y-2].":".$data2[$y-2][$x];
				if($x<11) $this->datane .= "},\n";
			}
			 $this->datane .= "}";
			 
			$toview['isiawal'] .= '</table>';
			
			$toview['isiawal'] .= '<p>';
			$toview['isiawal'] .= '
					<script type="text/javascript">
				
				var chart;
				var chartData = ';
				$toview['isiawal'] .= '['.$this->datane.'];';
				$toview['isiawal'] .= '
				
				window.onload = function() 
				{            
					chart = new AmCharts.AmSerialChart();
					chart.pathToImages = "js/amcharts/javascript/images/";
					chart.dataProvider = chartData;
					chart.marginTop = 15;
					chart.marginRight = 10;
					chart.categoryField = "bulan";
					chart.angle = 15;
					chart.depth3D = 7;
					chart.dash_length=1;
					
					var legend = new AmCharts.AmLegend();
					chart.addLegend(legend);
					
					';
					for($z=0;$z<$i;$z++){
						$toview['isiawal'] .= '
						var graph'.$z.' = new AmCharts.AmGraph();
						graph'.$z.'.title = "'.ucfirst($data[$z]).'";
						graph'.$z.'.valueField = "'.$data[$z].'";
						graph'.$z.'.type = "column";
						graph'.$z.'.lineAlpha = 0;
						graph'.$z.'.fillAlphas = 1;
						chart.addGraph(graph'.$z.');';
					}
									
					$toview['isiawal'] .= '
					chart.categoryAxis.gridPosition = "start";
					
					bravo=chart.write;
					chart.write("chartdiv");
					/*bravo.replace("amcharts.com","erik");
					bravo.write("chartdiv");
					document.getElementById("chartdiv").innerHTML=bravo;*/
				}
				
			</script>';
			$toview['isiawal'] .='<div id="chartdiv" style="width:650px; height:400px;"></div>';
			$toview['script']='
			<script>
				$(function() {
					$( "#accordion" ).accordion();
				});
			</script>';
			$this->load->view('laporan/laporan_view',$toview);
    	}
    	public function shu_kumulatif(){
			$toview['judul']="Daftar Laporan SHU Kumulatif";
		 	$toview['judul_laporan']='SHU Kumulatif';
		 	$toview['judul_laporan']="Cumulative SHU Monthly Report";
			if($this->input->post('kd_satker')) 
				$toview['kd_satker']=GetInput($this->input->post('kd_satker'));				
			else $toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$toview['bulan1']=GetInput($this->input->post('bulan1'),(date('m')-3));
			$toview['bulan']=GetInput($this->input->post('bulan'),date('m'));
			if($toview['bulan1']<10) $bln1='0'.$toview['bulan1']; else $bln1=$toview['bulan1'];
			if($toview['bulan']<10) $bln='0'.$toview['bulan']; else $bln=$toview['bulan'];
			settype($toview['bulan1'],"integer");
			settype($toview['bulan'],"integer");
			$toview['tahun']=GetInput($this->input->post('tahun'),date('Y'));
			$toview['isiawal']='<table width="300" border="1" style="border:solid">
			  <tr>
				<td>Tipe Customer</td><td>Jumlah Order Bulan '.$this->bulan[($toview['bulan1']-1)].' s/d Bulan '.$this->bulan[($toview['bulan']-1)].' Tahun '.$toview['tahun'].'</td></tr>
				';
				
			$tipecust=$this->mCustomer->GetTipeCustomer();
			$i=0;
			foreach($tipecust as $row){
				$toview['isiawal'] .= '<tr><td>'.$row->tipe_customer.'</td>';
				$dat=$this->mLaporan->laporan_shu_kumulatif($row->kd_tipe_customer,$bln1,$bln,
					$toview['kd_satker'],$toview['tahun']);
				$k=0;
				  if($dat){
						$l=1;
				       		$kod[] ='';
				       		foreach($dat as $row1){
							$kod[$l] = $row1->kd_customer;
							$k++;
						}
				  }	
				$this->datane .="{order:'".$row->tipe_customer."',jumlah:".$k."},\n";
				$toview['isiawal'] .= '<td>'.$k.'</td>';
				$i++;
			}
			$toview['isiawal'] .= '</tr>';			 
			$toview['isiawal'] .= '</table>';
			$toview['isiawal'] .= '<p>';
			$toview['isiawal'] .= '
					<script type="text/javascript">
				
				var chart;
				var chartData = ';
				$toview['isiawal'] .= '['.$this->datane.'];';
				$toview['isiawal'] .= '
				
				window.onload = function() 
				{            
					chart = new AmCharts.AmPieChart();

					chart.dataProvider = chartData;
					chart.titleField = "pnbp";
					chart.valueField = "jumlah";
					chart.depth3D = 5;

					chart.angle = 5;
					chart.innerRadius = "30%";
					chart.startDuration = 2;
					chart.labelRadius = 10;

					legend = new AmCharts.AmLegend();
					legend.align = "center";
					legend.markerType = "circle";
					chart.addLegend(legend);
					

					chart.write("chartdiv");
				}
				
			</script>';
			$toview['isiawal'] .='<div id="chartdiv" style="width:500px; height:300px;"></div>';
			$toview['script']='
			<script>
				$(function() {

					$( "#accordion" ).accordion({ active: 1 });
				});
			</script>';
			
			$this->load->view('laporan/laporan_view',$toview);
    	}
	public function pnbp_bulanan($starter=0){
		$toview['judul_laporan']="PNBP Monthly Report";
		if($this->input->post('kd_satker')) 
			$toview['kd_satker']=GetInput($this->input->post('kd_satker'));				
		else $toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
		$toview['tahun']=GetInput($this->input->post('tahun'),date('Y'));
		$toview['judul']="Daftar PNBP Bulanan <br>Tahun ".$toview['tahun'];
		$toview['isiawal']='<table width="500" border="1" style="border:solid">
			  	    <tr>
				 	<td><b>PNBP/Bulan</b></td>';
				for($t=0;$t<12;$t++){
					$toview['isiawal'] .= '
					<td><b>'.$this->bulan[$t].'</b></td>';
				}
				$toview['isiawal'] .= '</tr>';
			$tipecust=$this->mCustomer->GetTipeCustomer();
			$i=0;
			foreach($tipecust as $row){
			   $toview['isiawal'] .= '<tr><td>'.$row->tipe_customer.'</td>';
			   $data[$i]=strtolower($row->tipe_customer);
			   for($j=0;$j<12;$j++){
			 	if($j<9) $bln='0'.($j+1); else $bln=($j+1);
				    if($starter) $juml=0; 
				    else $dat=$this->mLaporan->laporan_pnbp($row->kd_tipe_customer,$bln,$toview['kd_satker'],
						$toview['tahun']);
				    $jml_total_tipe_perbulan =0;$juml=0;
				    if($dat){
				       	foreach($dat as $row1){
						$jml_total_tipe_perbulan = $jml_total_tipe_perbulan + $row1->harga_total;
						$ret=$this->mOrder->getPembayaranSementara($row1->kd_order);
						if($ret){
							foreach($ret as $bar){
								$juml += $bar->nilai_bayar;
							}
						}
					}				        	
				    }
					
				    if($jml_total_tipe_perbulan<>0){
					$toview['isiawal'] .= '<td>'.formatRupiah($jml_total_tipe_perbulan).'</br>';
					$toview['isiawal'] .= '<font color=red>Realisasi P. : '.formatRupiah($juml).'</font ></td>';
				    }else
					$toview['isiawal'] .= '<td>'.$jml_total_tipe_perbulan.'</td>';
				    $data2[$i][$j]=$jml_total_tipe_perbulan;
			            $data3[$i][$j]=$juml;
					
				    //if($j<11) $this->datane .="{bulan:".$bulan[$j].",".$juml."},\n";
				}
				//$this->datane .="{bulan:".$bulan[11].",perorangan:".$juml.",perorangan:".$juml.",}";
				$toview['isiawal'] .= '</tr>';				
				$i++;
			}
			$toview['isiawal'] .= '</table>
					       <table width="500" border="0" style="border:solid"><tr>
					       <td><b>PNBP/Bulan</b></td>';

			for($t=0;$t<12;$t++){
					$toview['isiawal'] .= '
					<td><b>'.$this->bulan[$t].'</b></td>';
				}
				$toview['isiawal'] .= '</tr>';
			$toview['isiawal'] .= '<td>Total</td>';
			
			//echo($data2[0][0]);
			$y=0;$x='0';
			for($x=0;$x<12;$x++){
				$this->datane .="{bulan:'".$this->bulan[$x]."',";
				$jml_total_perbulan =0;$jml_total=0;
				for($y=0;$y<$i;$y++){
					 if($y-1) $this->datane .= $data[$y].":".$data2[$y][$x].",";
					 //echo  $data[$y].":".$data2[$y][$x]."-";
					 $jml_total_perbulan = $jml_total_perbulan + $data2[$y][$x];
					 $jml_total = $jml_total + $data3[$y][$x];
									
				}
				$this->datane .= $data[$y-2].":".$data2[$y-2][$x];
				if($x<11) $this->datane .= "},\n";
				
				if($jml_total_perbulan<>0){
				   $toview['isiawal'] .= '<td>'.formatRupiah($jml_total_perbulan).'</br>';
				   $toview['isiawal'] .= '<font color=red>Realisasi P. : '.formatRupiah($jml_total).'</font ></td>';
				}else   $toview['isiawal'] .= '<td>'.$jml_total_perbulan.'</td>';
			}
			$this->datane .= "}";
			$toview['isiawal'] .= '</tr>
					       </table>';
			$toview['isiawal'] .= '<p>';
			$toview['isiawal'] .= '
					<script type="text/javascript">
				
				var chart;
				var chartData = ';
				$toview['isiawal'] .= '['.$this->datane.'];';
				$toview['isiawal'] .= '
				
				window.onload = function() 
				{            
					chart = new AmCharts.AmSerialChart();
					chart.pathToImages = "js/amcharts/javascript/images/";
					chart.dataProvider = chartData;
					chart.marginTop = 15;
					chart.marginRight = 10;
					chart.categoryField = "bulan";
					chart.angle = 15;
					chart.depth3D = 7;
					chart.dash_length=1;
					
					var legend = new AmCharts.AmLegend();
					chart.addLegend(legend);
					
					';
					for($z=0;$z<$i;$z++){
						$toview['isiawal'] .= '
						var graph'.$z.' = new AmCharts.AmGraph();
						graph'.$z.'.title = "'.ucfirst($data[$z]).'";
						graph'.$z.'.valueField = "'.$data[$z].'";
						graph'.$z.'.type = "column";
						graph'.$z.'.lineAlpha = 0;
						graph'.$z.'.fillAlphas = 1;
						chart.addGraph(graph'.$z.');';
					}
									
					$toview['isiawal'] .= '
					chart.categoryAxis.gridPosition = "start";
					
					bravo=chart.write;
					chart.write("chartdiv");
					/*bravo.replace("amcharts.com","erik");
					bravo.write("chartdiv");
					document.getElementById("chartdiv").innerHTML=bravo;*/
				}
				
			</script>';
			$toview['isiawal'] .='<div id="chartdiv" style="width:650px; height:400px;"></div>';
			$toview['script']='
			<script>
				$(function() {
					$( "#accordion" ).accordion();
				});
			</script>';
			$this->load->view('laporan/laporan_view',$toview);
    	}
	public function pnbp_kumulatif($starter=0){
		 	$toview['judul']="Daftar Laporan PNBP Kumulatif";
		 	$toview['judul_laporan']='PNBP Kumulatif';
		 	$toview['judul_laporan']="Cumulative Order Monthly Report";
			if($this->input->post('kd_satker')) 
				$toview['kd_satker']=GetInput($this->input->post('kd_satker'));				
			else $toview['kd_satker']=$this->session->userdata('profil')->kd_satker;
			$toview['bulan1']=GetInput($this->input->post('bulan1'),(date('m')-3));
			$toview['bulan']=GetInput($this->input->post('bulan'),date('m'));
			if($toview['bulan1']<10) $bln1='0'.$toview['bulan1']; else $bln1=$toview['bulan1'];
			if($toview['bulan']<10) $bln='0'.$toview['bulan']; else $bln=$toview['bulan'];
			settype($toview['bulan1'],"integer");
			settype($toview['bulan'],"integer");
			$toview['tahun']=GetInput($this->input->post('tahun'),date('Y'));
			$toview['isiawal']='<table width="300" border="1" style="border:solid">
			  <tr>
				<td>Tipe Customer</td><td>Jumlah Order Bulan '.$this->bulan[($toview['bulan1']-1)].' s/d Bulan '.
				$this->bulan[($toview['bulan']-1)].' Tahun '.$toview['tahun'].
				'</td>
			  </tr>
				';
				
			$tipecust=$this->mCustomer->GetTipeCustomer();
			$i=0;$total=0;$totalr=0;
			foreach($tipecust as $row){
				$toview['isiawal'] .= '<tr><td>'.$row->tipe_customer.'</td>';
				$dat=$this->mLaporan->laporan_pnbp_kumulatif($row->kd_tipe_customer,$bln1,$bln,
					$toview['kd_satker'],$toview['tahun']);
				$jml_total_perbulan =0;$juml=0;
				
				if($dat){
				       	foreach($dat as $row1){
						$jml_total_perbulan = $jml_total_perbulan + $row1->harga_total;
						$ret=$this->mOrder->getPembayaranSementara($row1->kd_order);
						if($ret){
							foreach($ret as $bar){
								$juml += $bar->nilai_bayar;
							}
						}
					}	
				}
				$this->datane .="{order:'".$row->tipe_customer."',jumlah:".$jml_total_perbulan."},\n";
				if($jml_total_perbulan<>0){
					$toview['isiawal'] .= '<td>'.formatRupiah($jml_total_perbulan).'</br>';
					$toview['isiawal'] .= '<font color=red>Realisasi P. : '.formatRupiah($juml).'</font ></td>';
				}else
					$toview['isiawal'] .= '<td>'.$jml_total_perbulan.'</td>';
				$total = $total + $jml_total_perbulan;
				$totalr = $totalr + $juml;
				$i++;
				
			}
			$toview['isiawal'] .= '<tr><td><b>Total</b></td><td><b>'.formatRupiah($total).'</b><br>';			
			$toview['isiawal'] .= '<font color=red>Realisasi P. : '.formatRupiah($totalr).'</font ></td>';
			$toview['isiawal'] .= '</tr>';			 
			$toview['isiawal'] .= '</table>';
			$toview['isiawal'] .= '<p>';
			$toview['isiawal'] .= '
					<script type="text/javascript">
				
				var chart;
				var chartData = ';
				$toview['isiawal'] .= '['.$this->datane.'];';
				$toview['isiawal'] .= '
				
				window.onload = function() 
				{            
					chart = new AmCharts.AmPieChart();
					chart.dataProvider = chartData;
					chart.titleField = "pnbp";
					chart.valueField = "jumlah";
					chart.depth3D = 5;
					chart.angle = 5;
					chart.innerRadius = "30%";
					chart.startDuration = 2;
					chart.labelRadius = 10;
					legend = new AmCharts.AmLegend();
					legend.align = "center";
					legend.markerType = "circle";
					chart.addLegend(legend);
					
					chart.write("chartdiv");
				}
				
			</script>';
			$toview['isiawal'] .='<div id="chartdiv" style="width:500px; height:300px;"></div>';
			$toview['script']='
			<script>
				$(function() {
					$( "#accordion" ).accordion({ active: 1 });
				});
			</script>';
			
			$this->load->view('laporan/laporan_view',$toview);
    }
	
	
	

	

}
?>
