<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 6</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>        
    <p>&nbsp;</P>
    <fieldset>

            <div class="row">
                <div class="form-group">
            <? 
            if($resultOrderPembayaran) 
                $this->load->view('order/sertifikasi/pemasaran/view_order_pembayaran_pemasaran.php');
            ?>
                </div>
            </div>
			 
</fieldset>
<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>