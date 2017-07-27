<!--start main menu -->
<div id="mainmenu">
     <ul id="yw0">
	<li <?=($this->uri->segment(1)===false || $this->uri->segment(1)==="welcome")? 'class="active"' : '';?>>
		<a href="<?=base_url();?>">Home</a></li>
	<?php 
        if($this->session->userdata('login')==true){?>
	     <li <?=($this->uri->segment(1)==="customer")?'class="active"':'';?>>
                          	<a href="<?=base_url();?>index.php/customer">Customer</a></li>
             <li <?=($this->uri->segment(1)==="tarif")?'class="active"':'';?>>
              		<a href="<?=base_url();?>index.php/tarif/JenisTarif">Tarif PNBP</a></li>
             <li <?=($this->uri->segment(1)==="order")?'class="active"':'';?>>
			<a href="<?=base_url();?>index.php/order">Order</a></li>
            <!-- <li <?=($this->uri->segment(1)==="rhu")?'class="active"':'';?>>
                            <a href="<?=base_url();?>index.php/rhu">RHU</a></li>-->
	     <li <?=($this->uri->segment(1)==="shu")?'class="active"':'';?>>
                            <a href="<?=base_url();?>index.php/shu">SHU</a></li>
             <li <?=($this->uri->segment(1)==="laporan")?'class="active"':'';?>>
                       		<a href="<?=base_url();?>index.php/laporan/">Laporan</a></li>
             <li <?=($this->uri->segment(2)==="aktivitas")?'class="active"':'';?>>
             <li><a href="<?=base_url();?>index.php/welcome/Logout">Logout</a></li>
         <?php }?>
      </ul>	
  </div>
<!-- end mainmenu -->
