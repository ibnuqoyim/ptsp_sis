<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 4</div>
    <?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>   
    <p>&nbsp;</P> 
    <fieldset>
	<div>
		<ul class="nav nav-tabs" id="myTab">         
    		<li  class="active"><a href="<?=base_url();?>index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>">Data Kontrak</a></li>
		</ul>
	</div>

        	<div class="row">
        		<div class="form-group">
        	<? 
			if($resultOrderKontrak)	
				$this->load->view('order/sertifikasi/pemasaran/view_order_kontrak_pemasaran.php');
			?>
				</div>
        	</div>

   </fieldset>     	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>