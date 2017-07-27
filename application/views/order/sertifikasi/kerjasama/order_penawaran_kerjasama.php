<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 3</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
    
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">Data Penawaran</a></li>
    		<!--<li><a href="<?=base_url();?>index.php/order/viewOrderSuratPenawaran/<?=$kd_order_sertifikasi;?>">Cetak Surat Penawaran</a></li>
            <li><a href="<?=base_url();?>index.php/order/viewOrderLampiranPenawaran/<?=$kd_order_sertifikasi;?>">Cetak Lampiran Penawaran</a></li>-->
		</ul>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
<p><?//=@$this->errormsg;?></p>
<fieldset>
   

            <div class="row">
                <div class="form-group">
            <? 
            if($result) 
                $this->load->view('order/sertifikasi/kerjasama/view_order_penawaran_kerjasama.php');
            ?>
                </div>
            </div>   
</fieldset>
<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>