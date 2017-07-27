<!--start main menu -->
<div class="container">
  <!-- Static navbar --> 

  <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
              <!--header saat mobile version-->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              <a class="navbar-brand" href="#">PTSP-SIS 2015</a>
              </div><!--end header saat mobile version-->

            <div class="navbar-collapse collapse">
              <!-- Left nav -->
              <ul class="nav navbar-nav">
                  <li <?=($this->uri->segment(1)===false || $this->uri->segment(1)==="welcome")? 'class="active"' : '';?>>
                     <a href="<?=base_url();?>"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                      <?php if($this->session->userdata('login')==true){?>
                  
                  <li <?=($this->uri->segment(1)==="customer")?'class="active"':'';?>>
                      <a href="<?=base_url();?>index.php/customer">Customer</a></li>

                  <li  <?=($this->uri->segment(1)==="tarif")?'class="active"':'';?>>
                      <a href="<?=base_url();?>index.php/tarif/JenisSertifikasi">Data Master</a></li>   

                  <li  <?=($this->uri->segment(1)==="order")?'class="active"':'';?>>
                      <a href="<?=base_url();?>index.php/order">Order</a>                     
                  </li>
      
                    <?php } ?>
              </ul>

              <!-- Right nav -->
              <ul class="nav navbar-nav navbar-right">
                  <!--<li><a href="#">Sertifikat</a></li>      
                  <li <?=($this->uri->segment(1)==="aktivitas")?'class="active"':'';?>>
                       <a href="<?=base_url();?>index.php/user/aktivitas">Laporan</a></li> -->
                  <li><a href="<?=base_url();?>index.php/welcome/Logout">Logout</a></li>    
              </ul>

            </div><!--/.nav-collapse -->
        </div>
      </div>
  <div>
<!--</div>  /container -->  
<!-- end mainmenu -->