<? $this->load->view('view_header');?>
<?=form_open(current_url());?>
<fieldset>
	<div class="steptitle">Step 6</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
   
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">List Pembayaran</a></li>
		</ul>
    </div> 
    <div class="row">
        <div class="form-group">
                <? 
                if($resultOrderPembayaran) 
                    $this->load->view('order/sertifikasi/sertifikasi/view_order_pembayaran_sertifikasi.php');
                ?>
        </div>
    </div>
		 
</fieldset>
<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>