<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 9</div>
    
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
                  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>';

        if($step_status=='Evaluasi'){
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Sertifikat/orderSertifikat/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?>
        
    </P>
    <p>&nbsp;</P>
    <p>&nbsp;</P> 
	<div>
		<ul class="nav nav-tabs" id="myTab">         
    		<li  class="active"><a href="<?=base_url();?>index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>">Hasil Evaluasi</a></li>
            <li><a href="<?=base_url();?>index.php/order/orderTimTeknis/<?=$kd_order_sertifikasi;?>">Anggota Tim Teknis / Evaluasi</a></li>
		</ul>
	</div>
<p><?=@$this->errormsg;?></p>
    <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" id="kd_order_sertifikasi" />
    <input type="hidden" name="tambah" id="tambah" value="1" />
	<input type="hidden" name="save" id="save" value="1" />
              <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Evaluasi / Rapat</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_evaluasi','value'=>$tgl_evaluasi,
                                'id'=>'tgl_evaluasi',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
              <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No Evaluasi</label>
                    <div class="col-sm-6"> 
                            <input type="text" id="no_evaluasi" name="no_evaluasi" 
                            value="<?=$no_evaluasi;?>" class="form-control" >  
                              
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Isi Evaluasi</label>
                    <div class="col-sm-6"> 
                             
                            <textarea  name="isi_evaluasi"  rows="5" cols="65" class="tinymce"></textarea>
                              
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Keputusan Akhir Evaluasi</label>
                    <div class="col-sm-6"> 
                            <input type="text" id="keputusan_evaluasi" name="keputusan_evaluasi" 
                            value="<?=$keputusan_evaluasi;?>" class="form-control" >  
                              
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
            
            <div class="col-xs-12"><hr></div>
        	<div class="row">
        		<div class="form-group"> 
        			<label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-7"> 
        					<button type="submit" name="tambah" value="1" class="btn btn-primary" >Simpan</button>
                	</div>
        		</div>
        	</div>

        	<div class="col-xs-12"><hr></div>



        	<div class="row">
        		<div class="form-group">
        	<? 
			if($resultOrderEvaluasi)	
				$this->load->view('order/sertifikasi/administrator/view_order_evaluasi_administrator.php');
			?>
				</div>
        	</div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>