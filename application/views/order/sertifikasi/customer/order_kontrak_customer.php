<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 4</div>
    <?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
    <p> <? 
        $tombol1='<span style="float:left">
                        <img src="images/printer.gif" border="0" height="40"><br />
                  <span class="textkolom"><b>Cetak</span></b></span>';
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
        if($step_status=='Kontrak'){
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Penagihan/orderPenagihan/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        $dat=$this->mUser->getDetail($this->session->userdata('userid'));
        ?>
        
    </P>
    <p>&nbsp;</P> 
	<div>
		<ul class="nav nav-tabs" id="myTab">         
    		<li  class="active"><a href="<?=base_url();?>index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>">Data Kontrak</a></li>
		</ul>
	</div>
<p><?=@$this->errormsg;?></p>
        	<div class="row">
        		<div class="form-group">
        	<? 
			if($resultOrderKontrak)	
				$this->load->view('order/sertifikasi/customer/view_order_kontrak_customer.php');
			?>
				</div>
        	</div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>