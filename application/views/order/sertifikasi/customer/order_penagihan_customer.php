<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 5</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
     
    <p> <? 
       
        $tombol2='<span style="float:right">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/email3.png" border="0" height="40"><br />
                  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>';
         $order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);

        if($order_status){
            $no=0;
            foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
            }
        }   

        if($step_status=='Penagihan'){
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Pembayaran/orderPembayaran/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?>
        
    </P>    
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">List Penaginan</a></li>
    		<!--<li><a href="<?=base_url();?>index.php/order/viewOrderPenagihan/<?=$kd_order_sertifikasi;?>">Cetak</a></li>-->
		</ul>
    <div style="clear:both"></div>
     
<p><?=@$this->errormsg;?></p>

    

    <h3><center>Penagihan No. Registrasi <?=$noreg_order_sertifikasi;?></center></h3> 
    
            <div class="row">
                <div class="form-group">
            <? 
            if($resultOrderInvoice) 
                $this->load->view('order/sertifikasi/customer/view_order_penagihan_customer.php');
            ?>
                </div>
            </div>

<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>