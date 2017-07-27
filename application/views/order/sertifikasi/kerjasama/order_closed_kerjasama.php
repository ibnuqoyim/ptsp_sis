<?php $this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 12</div>
    <? $this->load->view('order/step_order.php');?>
    
    <div><p>&nbsp;
    
    </div>
	<div><p><h1><center><?=$this->judul;?></p></center></h1></p></div>

<?=form_close();?>
<?=$this->load->view('view_footer');?>