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
            <li><a href="<?=base_url();?>index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>">Jadwal Audit</a></li>            
            <li><a href="<?=base_url();?>index.php/order/orderAuditor/<?=$kd_order_sertifikasi;?>">Auditor</a></li>
            <li  class="active"><a href="<?=base_url();?>index.php/order/orderJadwalDetail/<?=$kd_order_sertifikasi;?>">Audit Plan</a></li>
            <li><a href="<?=base_url();?>index.php/order/viewOrderSuratPenunjukan/<?=$kd_order_sertifikasi;?>">Cetak Surat Penujukan</a></li>
        </ul>
    </div>





            <div class="row">
                <div class="form-group">
            <? 
            if($resultOrderJadwalDetail)    
                $this->load->view('order/sertifikasi/kerjasama/view_jadwal_detail_kerjasama.php');
            ?>
                </div>
            </div>

            

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>