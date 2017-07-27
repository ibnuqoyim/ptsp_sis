<? $this->load->view('view_header');?>
<!--
<ul class="nav nav-tabs" id=”myTab”>
    <li class="active"><a href="#">All Order</a></li>
    <li><a href="<?=base_url();?>index.php/order/lspro">LsPro</a></li>
    <li><a href="<?=base_url();?>index.php/order/smm">SMM</a></li>
</ul>-->
<p><?=$this->searchbox;?></p>
<div style="clear:both"></div>
<p>&nbsp;</P>
<?
if(!empty($result)){?>

	<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
        	<th>No</th>
			<th>No.Registrasi</th>
			<th>Tgl. registrasi</th>
			<th>Tahapan</th>
			<th>Perusahaan Pemohon</th>	
			<th>Jenis Sertifikasi</th>		
			<th>Komoditi</td>
			<th>Status</td>
			<th>Total Biaya</td>
			<th>Total Bayar</td>
			<th>Action</th>
        </tr>
    </thead>

 <tbody>
	<?
	//-----------------------------------------------------------//
	//-------------------isi row table order---------------------//
	//-----------------------------------------------------------//
	$no=0;
	foreach($result as $row){
	   $no++;
	   $resuljenis = $this->mTarif->getJenis($row->kd_sertifikasi_jenis);
	   $resulkomoditi = $this->mOrder->getOrderKomoditi('',$row->kd_order_sertifikasi);
	   ?>
	  
	<tr> 
	
        <td align="center"><?=(($page-1)*$limit)+$no;?></td>
		<td><div><?=$row->noreg_order_sertifikasi;?></div></td>				
		<td><div><?=$row->tglreg_order_sertifikasi;?></div></td>
		<td><div><?
				$resulttahapan = $this->mOrder->getJenisTahapan($row->kd_sertifikasi_tahapan);
				if($resulttahapan) $toview['nama_sertifikasi_tahapan']=$resulttahapan->nama_sertifikasi_tahapan ;
				echo $toview['nama_sertifikasi_tahapan'];
				?></div></td>
		<td><div><?=$row->nama_perusahaan_pemohon;?></div></td>	
		<td><div><?=$resuljenis->nama_sertifikasi_jenis;?></div></td>	
		<td><div><?
				if($resulkomoditi){
					foreach($resulkomoditi as $dat1){
						echo $dat1->no_sertifikasi_komoditi."<br>";
					}
	   			}
			?></div></td>  
		<td><div>
			<? echo anchor_popup('order/orderSertifikasiStatus/'.$row->kd_order_sertifikasi.'?TB_iframe=true&height=500&width=900',
		    		 	 img(array('src'=>'images/preview.gif','border'=>'0','height'=>'16')),
					array('title'=>'View Histori Status Order','alt'=>'View Histori Status Order','class'=>'thickbox',
                            		  'id'=>'historiswo'.$row->kd_order_sertifikasi));  ?>&nbsp;&nbsp;	
			<?= ucwords($row->status_order_sertifikasi);?>&nbsp;&nbsp;	
                        
                </div><span id="orders<?=$no;?>"></span>
         </td>
         <td><div>			
			Rp. <?=number_format($row->hargatotal_order_sertifikasi);?>                
         </td>
         <td><div>			
			Rp. <?=number_format($row->jmlbayar_order_sertifikasi);?>                
         </td>
		<td>
		  <div>
		  <!--<?//=anchor('order/view/'.$row->kd_order_sertifikasi,img(array('src'=>'images/preview.gif','border'=>'0','height'=>'16')),
		   //array('title'=>'View','alt'=>'View'));?> |-->
			
			<?=anchor('order/edit/'.$row->kd_order_sertifikasi,img(array('src'=>'images/edit.gif','border'=>'0','height'=>'16')),
		   	array('title'=>'Edit','alt'=>'Edit'));?> 
		
		                                       
		  </div>
		</td>
	  </tr>

   <?}?>
   </table>
</tbody>


<script language="javascript">
function collapse_pembayaran(bayar_id, status_bayar, kd_order){
  if(document.getElementById(bayar_id).innerHTML==0){
	if(status_bayar=="belum") { 
		pilihanbelum="selected"; pilihanlunas=""; } 
	else { 
		pilihanbelum=""; pilihanlunas="selected"; }
   		document.getElementById(bayar_id).innerHTML='<select name="bayar" style="margin-left:0px;" id="id_' + bayar_id + 
		'" onChange="Execute(\'order/Bayar/' + kd_order + '\',\'id_' + bayar_id + 
		'\')"><option value="belum" ' + pilihanbelum + '>Belum</option><option value="lunas" ' + pilihanlunas + '>Lunas</option></select>';
  }else{
    	document.getElementById(bayar_id).innerHTML="";
  }
}


function Execute(urlne,idne){
	 var url= "index.php/" + urlne + "/" + document.getElementById(idne).value;
	 if(confirm('Yakin ingin mengubah?')){
		//alert(url);
		 window.open(url, "_self");
	 }
 }
</script>


<div style="clear:both"></div>
<table border="0" align="center" cellpadding="0" cellspacing="0" id="menu-display">
	<tr>
		<td>
			<div class="textambahan" align="center" >Display #
			<?=form_dropdown('limit',array(5=>5,10=>10,30=>30,50=>50,100=>100,$tot=>'All'),$limit,'onchange="setLimit(this.value)"  class="input-option"');?>
			&nbsp;&nbsp; Page Result - <?=$page;?> of <?=$pages;?>
			</div>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	

	<!--	<ul class="pagination">
    		<li><a href="#">&laquo;</a></li>
    		<li><a href="#"><?=$page;?></a></li>
    		<li><a href="<"?=anchor($pageurl.'index'.($page+1),"Next");?>">&raquo;</a></li>
		</ul>
		<ul class="pagination">-->
	<?if($pages>1){?>


	<tr>
		<td align="center">
		
		<?if($page>1){?>
			
			<div class="button2-right"><div class="start"><?=anchor($pageurl.'index1','Start');?></span></div></div>
			<div class="button2-right"><div class="prev"><?=anchor($pageurl.'index'.($page-1),'Prev');?></span></div></div>
		<? } else {?>
			<div class="button2-right off"><div class="start"><span>Start</span></div></div>
			<div class="button2-right off"><div class="prev"><span>Prev</span></div></div>
		<?}?>
			<div class="button2-left">
				<div class="page">
					<?
					$limitpages=15;//harus ganjil
					$halflimit=ceil(($limitpages-1)/2);
					$bf=$page-$halflimit;
					$af=$page+$halflimit;     
     
					if($bf<1){
			   			$startpage=1;
			   			$endpage=$af+1-$bf;
					} elseif($af>$pages){
			   			$startpage=$bf-$af+$pages;
			   			$endpage=$pages;
					} else {
			   			$startpage=$bf;
			   			$endpage=$af;
					}
					if($startpage<1){$startpage=1;}
					if($endpage>$pages){$endpage=$pages;}
      				$i=0;
					for($i=$startpage;$i<=$endpage;$i++){
						if($i==$page){
							echo '<span>',$i,'</span> ';
						} else {
							echo anchor($pageurl.'index'.$i,$i).' ';
						}
					}
      
					?>
			</div></div>
			<?if($page<$pages){?>
					<div class="button2-left"><div class="next"><?=anchor($pageurl.'index'.($page+1),"Next");?></div></div>
					<div class="button2-left" style="margin-bottom:10px;"><div class="end"><?=anchor($pageurl.'index'.$pages,"End");?></div></div>
			<?} else {?>
					<div class="button2-left off"><div class="next"><span>Next</span></div></div>
					<div class="button2-left off" style="margin-bottom:10px;"><div class="end"><span>End</span></div></div>
			<?}?>
		</td>
	</tr>
	<?}?>
</table>
<?=form_close();?>
<? }?> 


<?=$this->javascript;?>
</div>
</div>

<? $this->load->view('view_footer');?>