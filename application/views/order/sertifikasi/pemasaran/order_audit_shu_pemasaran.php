<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 7</div>
    
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
  
	<div>
		<ul class="nav nav-tabs" id="myTab">
            <li><a href="<?=base_url();?>index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>">Hasil Audit</a></li>         
    		<li><a href="<?=base_url();?>index.php/order/orderAuditHasilPerTemuan/<?=$kd_order_sertifikasi;?>">Hasil Audit Per Temuan</a></li>
            <li class="active"><a href="<?=base_url();?>index.php/order/orderAuditSHU/<?=$kd_order_sertifikasi;?>">laporan Hasil Uji</a></li>
		</ul>
	</div>
<p><?=@$this->errormsg;?></p>
    

        	<div class="row">
                <div class="form-group">
                    <div class="col-xs-12"> 
        	<? 
			if($resultOrderAuditSHU)	
				$this->load->view('order/sertifikasi/pemasaran/view_order_audit_shu_pemasaran.php');
			?>
			         </div>
                </div>
            </div>

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>