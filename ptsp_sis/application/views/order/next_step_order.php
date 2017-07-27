<?//$this->load->view('view_header');?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <base href="<?=base_url();?>" />    
    <!-- versi baru jquery tidak jalan auto completenya-->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
    <!--<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>-->
    <link href="js/jquery-ui-1.9.2/css/base/jquery-ui-1.9.2.custom.css" rel="stylesheet">    
    <script src="js/jquery-ui-1.9.2/js/jquery-ui-1.9.2.custom.js"></script>
    <!--  Bootstrap Addon -->
    <link rel="stylesheet" href="js/bootstrap-3.3.5/css/bootstrap.css" />
    <!--<link rel="stylesheet" href="js/bootstrap-3.3.5/css/bootstrap-theme.min.css" />  -->
    <script src="js/bootstrap-3.3.5/js/bootstrap.js"></script>  
   
</head>

<body>
<?=form_open(current_url());?>	
<?php
    
	$dat=$this->mUser->getDetail($this->session->userdata('userid'));
	
?>

	<input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" >
    <input type="hidden" name="noreg_order_sertifikasi" value="<?=$noreg_order_sertifikasi;?>"> 
    <input type="hidden" name="kd_step_status" value="<?=$kd_step_status;?>" >
    <input type="hidden" name="nama_step_status" value="<?=$nama_step_status;?>"> 
    <input type="hidden" name="next_step" value="<?=$next_step;?>">
    <input type="hidden" name="nip_penerima" value="<?=$nip;?>" >
        	
             <div class="row">
        		<div class="form-group">
        			<label  class="col-sm-12 control-label"><h2><center>Kirim Data Ke Step selanjutnya</center></h2>
        			</label>        			
                    
        		</div>
        	</div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-12 control-label"><center>Pastikan Data yang akan dikirim ke Step
                <?=$id_step_status;?>.&nbsp;<?=$kd_step_status;?>&nbsp;(<?=$nama_step_status;?>)&nbsp; sudah lengkap</br></br></center>
                    </label>                    
                    
                </div>
            </div>               
        	
            <div class="row">
                <div class="form-group">                    
                    <div class="col-sm-12"> <center> <font color="red">sementara tanggal forward ke next step berikutnya  bisa di isi manual utk pengimputan data lama</font><br>
                             <?=form_input(array('name'=>'tgl_create','value'=>$tgl_create,
                                'id'=>'tgl_create',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <p>&nbsp;</p>
        	<div class="row">
        		<div class="form-group">
        			<div lass="col-sm-12"> <center>
        				<button type="submit" name="submit" value="Kirim" class="btn btn-primary">Simpan</button>
        		</div>
        	</div>
    </div>     
</div>

<?=$this->javascript;?>
</body>
</html>
<?//=form_close();?>