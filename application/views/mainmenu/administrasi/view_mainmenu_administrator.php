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
              <a class="navbar-brand" href="#">Sistem Informasi Sertifikasi (SIS)</a>
              </div><!--end header saat mobile version-->

            <div class="navbar-collapse collapse">
              <!-- Left nav -->
              <ul class="nav navbar-nav">
                  <li <?=($this->uri->segment(1)===false || $this->uri->segment(1)==="welcome")? 'class="active"' : '';?>>
                     <a href="<?=base_url();?>"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                      <?php if($this->session->userdata('login')==true){?>
                 <!-- <li <?=($this->uri->segment(1)==="staff")?'class="active"':'';?>>
                  <!--    <a href="<?=base_url();?>index.php/staff">Staf</a><!--<span class="caret"></span></a>-->
                      <!--<ul class="dropdown-menu">
                          <li><a href="<?=base_url();?>index.php/staff">Daftar Staff</a></li>
                          <!--<li><a href="#">Update Staff</a></li>
                          <li><a href="#">Delete Staf</a></li>
                      </ul>-->
                  </li>
                  <li <?=($this->uri->segment(1)==="user" && $this->uri->segment(2)!="aktivitas")?'class="active"':'';?>>
                      <a href="<?=base_url();?>index.php/user"><span class="glyphicon glyphicon-user"></span> User</a><!--<span class="caret"></span></a>
                      <!--<ul class="dropdown-menu">
                          <li><a href="<?=base_url();?>index.php/user">Daftar User</a></li>
                          <!--<li><a href="#">Update User</a></li>
                          <li><a href="#">Delete User</a></li>
                      </ul>-->
                  </li>
                  <li <?=($this->uri->segment(1)==="customer")?'class="active"':'';?>>
                      <a href="<?=base_url();?>index.php/customer">Customer</a></li>
                  <li  <?=($this->uri->segment(1)==="tarif")?'class="active"':'';?>>
                      <a href="<?=base_url();?>index.php/tarif/JenisSertifikasi">Tarif</a></li>      
                  <li  <?=($this->uri->segment(1)==="order")?'class="active"':'';?>>
                      <a href="<?=base_url();?>index.php/order">Order<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?=base_url();?>index.php/order">All Order</a></li>
                        <li><a href="#">Order Selesai</a></li>
                        <li><a href="#">Order Status</a></li>
                        </ul>
                  </li>
      
                    <?php } ?>
              </ul>

              <!-- Right nav -->
              <ul class="nav navbar-nav navbar-right">
                       
                  <li <?=($this->uri->segment(1)==="aktivitas")?'class="active"':'';?>>
                       
                  <li><a href="<?=base_url();?>index.php/welcome/Logout">Logout</a></li>    
              </ul>

            </div><!--/.nav-collapse -->
        </div>

	</div> <!-- /container -->   

  
<!-- end mainmenu -->