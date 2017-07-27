<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 11</div>
    
    <?
    $this->load->view('order/step_order.php');
    $order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);

    if($order_status){
        $no=0;
        foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
        }
    }
    ?>
    <div style="clear:both"></div>
     <p>&nbsp;</P>
    <p> <? 
        $tombol1='<span style="float:left">
                        <img src="images/printer.gif" border="0" height="40"><br />
                  <span class="textkolom"><b>Cetak</span></b></span>';
        $tombol2='<span style="float:right">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/email3.png" border="0" height="40"><br />
                  <span class="textkolom"><b>closed</b></span></span>';

        if($step_status=='SerahTerima'){
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Closed/orderSerahTerima/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?>
        
    </P>
    <p>&nbsp;</P>
   <div style="clear:both"></div>
     <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">         
    		<li  class="active"><a href="<?=base_url();?>index.php/order/orderSerahTerima/<?=$kd_order_sertifikasi;?>">Serah Terima Sertifikat</a></li>
		</ul>
	</div>
<ul class="breadcrumb">
    <li><a href="<?=site_url()."/order/orderSerahTerima/".$kd_order_sertifikasi;?>">Serah Terima Sertifikat</a></li>
    <li class="active">Proses</li>
</ul>
<p><?=@$this->errormsg;?></p>
   <!-- <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" id="kd_order_sertifikasi" />-->
    <input type="hidden" name="edit" id="edit" value="1" />
	<input type="hidden" name="save" id="save" value="1" />
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">No. Sertifikat </label>
                    <div class="col-sm-6"><?=$no_sertifikat;?> 
                    </div>       
                </div>
            </div>
             <!--<div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Upload Hasil Evaluasi</label>
                    <div class="col-sm-6"> 
                           <input type="file" name="userfile"  id="userfile" class="form-control"/> 
                           
                              
                    </div>
                </div>
            </div>-->
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Cetak Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=$tgl_cetak_sertifikat;?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penandatangan Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=$nama_penandatangan_sertifikat;?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Sertifikat ditandatangani</label>
                    <div class="col-sm-6">  
                             <?=$tgl_penandatangan_sertifikat;?> 
                        
                    </div>       
                </div>
            </div>
               <div class="col-xs-12"><hr></div>
               <div class="col-xs-12"><hr></div>         
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Sertifikat diserahkan</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_serah_sertifikat','value'=>$tgl_serah_sertifikat,
                                'id'=>'tgl_serah_sertifikat',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Metode Serah Terima Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'metode_serah_sertifikat','value'=>$metode_serah_sertifikat,
                                'id'=>'metode_serah_sertifikat','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">NIP Penyerah Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nip_penyerah_sertifikat','value'=>$nip_penyerah_sertifikat,
                                'id'=>'nip_penyerah_sertifikat','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penyerah Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nama_penyerah_sertifikat','value'=>$nama_penyerah_sertifikat,
                                'id'=>'nama_penyerah_sertifikat','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penerima Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nama_penerima_sertifikat','value'=>$nama_penerima_sertifikat,
                                'id'=>'nama_penerima_sertifikat','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            <div class="col-xs-12"><hr></div>
        	<div class="row">
        		<div class="form-group"> 
        			<label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-7"> 
        					<button type="submit" name="tambah" value="1" class="btn btn-primary" >Simpan</button>
                	</div>
        		</div>
        	</div>

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>