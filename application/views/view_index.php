<?php $this->load->view('view_header');?> 
<div class="form">
  <?=form_open('welcome/');?>
  <?=form_fieldset('Login Form')?>
	<fieldset >
	<p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>

	<?php if($this->session->flashdata('message')) : ?>
        <p><?=$this->session->flashdata('message')?></p>
    <?php endif; ?>
        
        <!--<h2><span class="fontawesome-lock"></span>Login</h2>    -->    
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-2 control-label" id="userid">User ID </label>             
                    <div class="col-sm-2">
                        <input type="text" id="userid"  name="userid" class="form-control" > <?=form_error('userid')?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group"> 
                    <label  class="col-sm-2 control-label" id="password">Passsword&nbsp;*</label>    
                    <div class="col-sm-2">
                        
                        <input type="password" id="password"  name="password" class="form-control" > <?=form_error('password')?>
                    </div> 
                </div>
	       </div>

            
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-2 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <div class="col-sm-2"> 
                         <div class="buttons"><?=form_submit('login', 'Login', 'class="btn btn-primary"')?></div>
                </div>
            </div>
            
            
	</fieldset>
    <?=form_fieldset_close()?>
<?=form_close();?>
</div>

 