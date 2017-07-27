<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 8</div>
    
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
            <li class="active"><a href="<?=base_url();?>index.php/order/orderAuditHasilPerTemuan/<?=$kd_order_sertifikasi;?>">Hasil Audit</a></li>         
    		<li><a href="<?=base_url();?>index.php/order/orderAuditHasilPerTemuan/<?=$kd_order_sertifikasi;?>"><font color="red">Hasil Audit Per Temuan</font></a></li>
            <li><a href="<?=base_url();?>index.php/order/orderAuditSHU/<?=$kd_order_sertifikasi;?>">laporan Hasil Uji</a></li>
		</ul>
	</div>
    <p>&nbsp;</P>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Temuan (Akhir Audit)</label>
                    <div class="col-sm-6"> <?=$tgl_temuan_audithasil;?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Hasil Audit Diterima dari Auditor </label>
                    <div class="col-sm-6"><?=$tgl_diterima_audithasil;?>
                    </div>       
                </div>
            </div>
            
            <div class="row">          
            
          
            <div class="col-xs-12"><hr></div>
        	
        	<div class="row">
        		<div class="form-group">
        	<? 
			if($resultOrderAuditHasilPerbaikan)	
				$this->load->view('order/sertifikasi/keuangan/view_order_audit_hasil_perbaikan_keuangan.php');
			?>
				</div>
        	</div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>