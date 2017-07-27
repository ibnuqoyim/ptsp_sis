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
            <li><a href="<?=base_url();?>index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>">Hasil Evaluasi</a></li>
            <li   class="active"><a href="<?=base_url();?>index.php/order/orderTimTeknis/<?=$kd_order_sertifikasi;?>">Anggota Tim Teknis / Evaluasi</a></li>
        </ul>
    </div>
<p><?=@$this->errormsg;?></p>
    <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi?>" id="kd_order_sertifikasi" />
	<input type="hidden" name="kd_auditor" value="<?=$kd_auditor;?>" id="kd_auditor" />
    <input type="hidden" name="tambah" id="tambah" value="1" />
	<input type="hidden" name="save" id="save" value="1" />
			<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Nama Anggota Tim Teknis / Evaluasi</label>
        			<div class="col-sm-6"> 
                            <input type="text" id="nama_auditor" autocomplete="off" name="nama_auditor" 
                            value="<?=$nama_auditor;?>" class="form-control" placeholder="atomatis">  
                            <?=form_error('nama_auditor')?>  
					</div>
        		</div>
        	</div>
			<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Nama singkat </label> 
                    <div class="col-sm-6">  
                            <?=form_input(array('name'=>'singkatan_nama_auditor','class'=>'form-control',
                                'value'=>$singkatan_nama_auditor,'maxlength'=>'250','size'=>'50',
                                'readonly'=>'1','style'=>'background-color:#e6edf1'));?>   
                    </div>
        		</div>
        	</div>            
        	
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Jabatan </label>
        			<div class="col-sm-6">        					
							<?=form_input(array('name'=>'jabatan_auditor','class'=>'form-control',
								'value'=>$jabatan_auditor,
								'maxlength'=>'50','size'=>'30','readonly'=>'1','style'=>'background-color:#e6edf1'));?>
					</div>
        		</div>
        	</div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Posisi Tim</label>
                    <div class="col-sm-6">
                        <? 
                            $options= array(
                                ''  => '',
                                'Ketua'    => 'Ketua',
                                'Anggota'    => 'Anggota'
                                );
                                 echo form_dropdown('posisi_tim_auditor', $options, 'id="posisi_tim_auditor"','class="form-control"');
                        ?>                         
                            
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

        	<div class="col-xs-12"><hr></div>



        	<div class="row">
        		<div class="form-group">
        	<? 
			if($result)	
				$this->load->view('order/sertifikasi/administrator/view_order_evaluator_administrator.php');
			?>
				</div>
        	</div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>