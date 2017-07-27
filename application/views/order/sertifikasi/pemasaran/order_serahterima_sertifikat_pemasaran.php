<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 11</div>
    
    <?
    $this->load->view('order/step_order.php');
    $order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);

    if($order_status){
        $no=0;
        foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
        }
    }
    ?>
    <div style="clear:both"></div>
     <p>&nbsp;</P>
    
    <div style="clear:both"></div>
	<div>
		<ul class="nav nav-tabs" id="myTab">         
    		<li  class="active"><a href="<?=base_url();?>index.php/order/orderSerahTerima/<?=$kd_order_sertifikasi;?>">Serah Terima Sertifikat</a></li>
		</ul>
	</div>
    <p><?=@$this->errormsg;?></p>
    
           
        	<div class="row">
                <div class="form-group">
                    <div class="col-xs-12">
        	<? 
			if($resultOrderSertifikat)	
				$this->load->view('order/sertifikasi/pemasaran/view_order_serahterima_sertifikat_pemasaran.php');
			?>
			  </div>
                </div>
            </div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>