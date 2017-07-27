<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 5</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
     
    
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">List Penaginan</a></li>
		</ul>
    <div style="clear:both"></div>
    <div class="row">
                <div class="form-group">
            <? 
            if($resultOrderInvoice) 
                $this->load->view('order/sertifikasi/kerjasama/view_order_penagihan_kerjasama.php');
            ?>
                </div>
    </div>

<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>