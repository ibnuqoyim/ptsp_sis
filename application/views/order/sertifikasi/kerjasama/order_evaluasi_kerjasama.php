<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 9</div>
    
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
    		<li  class="active"><a href="<?=base_url();?>index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>">Hasil Evaluasi</a></li>
            <li><a href="<?=base_url();?>index.php/order/orderTimTeknis/<?=$kd_order_sertifikasi;?>">Anggota Tim Teknis / Evaluasi</a></li>
		</ul>
	</div>
    <div class="row">
        		<div class="form-group">
        	<? 
			if($resultOrderEvaluasi)	
				$this->load->view('order/sertifikasi/kerjasama/view_order_evaluasi_kerjasama.php');
			?>
				</div>
    </div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>