<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 10</div>
    
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

        if($step_status=='Sertifikat'){
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/SerahTerima/orderSerahTerima/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?>
        
    </P>
    <p>&nbsp;</P> 
	<div>
		<ul class="nav nav-tabs" id="myTab">         
    		<li  class="active"><a href="<?=base_url();?>index.php/order/orderSertikat/<?=$kd_order_sertifikasi;?>">Hasil Sertifikat</a></li>
		</ul>
	</div>
<p><?=@$this->errormsg;?></p>
    <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" id="kd_order_sertifikasi" />
    <input type="hidden" name="tambah" id="tambah" value="1" />
	<input type="hidden" name="save" id="save" value="1" />
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">No. Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'no_sertifikat','value'=>$no_sertifikat,
                                'id'=>'no_sertifikat','class'=>'form-control'));?> 
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
                             <?=form_input(array('name'=>'tgl_cetak_sertifikat','value'=>$tgl_cetak_sertifikat,
                                'id'=>'tgl_cetak_sertifikat',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Awal Sertifikat Berlaku</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_awal_berlaku_sertifikat','value'=>$tgl_awal_berlaku_sertifikat,
                                'id'=>'tgl_awal_berlaku_sertifikat',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Akhir Sertifikat Berlaku </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_akhir_berlaku_sertifikat','value'=>$tgl_akhir_berlaku_sertifikat,
                                'id'=>'tgl_akhir_berlaku_sertifikat',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penandatangan Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nama_penandatangan_sertifikat','value'=>$nama_penandatangan_sertifikat,
                                'id'=>'nama_penandatangan_sertifikat','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Sertifikat ditandatangani</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_penandatangan_sertifikat','value'=>$tgl_penandatangan_sertifikat,
                                'id'=>'tgl_penandatangan_sertifikat',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <!--             
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
                    <label   class="col-sm-3 control-label">Nama Penandatangan Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nama_penandatangan_sertifikat','value'=>$nama_penandatangan_sertifikat,
                                'id'=>'nama_penandatangan_sertifikat','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penandatangan Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nama_penandatangan_sertifikat','value'=>$nama_penandatangan_sertifikat,
                                'id'=>'nama_penandatangan_sertifikat','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penandatangan Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nama_penandatangan_sertifikat','value'=>$nama_penandatangan_sertifikat,
                                'id'=>'nama_penandatangan_sertifikat','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penandatangan Sertifikat </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nama_penandatangan_sertifikat','value'=>$nama_penandatangan_sertifikat,
                                'id'=>'nama_penandatangan_sertifikat','class'=>'form-control'));?> 
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
			if($resultOrderSertifikat)	
				$this->load->view('order/sertifikasi/administrator/view_order_sertifikat_administrator.php');
			?>
				</div>
        	</div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>