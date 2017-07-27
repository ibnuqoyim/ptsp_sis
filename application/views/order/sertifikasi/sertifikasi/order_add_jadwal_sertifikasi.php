<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 7</div>
	
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
       
        $tombol2='<span style="float:right">
                        &nbsp;
                        <img src="images/email3.png" border="0" height="40"><br />
                  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>';

        if($step_status=='Jadwal'){          
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Audit/orderAuditHasil/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?>
        
    </P>    
    <p>&nbsp;</P>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">Jadwal Audit</a></li>            
            <li><a href="<?=base_url();?>index.php/order/orderAuditor/<?=$kd_order_sertifikasi;?>">Auditor</a></li>
            <li><a href="<?=base_url();?>index.php/order/orderJadwalDetail/<?=$kd_order_sertifikasi;?>">Audit Plan</a></li>
            <li><a href="<?=base_url();?>index.php/order/viewOrderSuratPenunjukan/<?=$kd_order_sertifikasi;?>">Cetak Surat Penujukan</a></li>      
		</ul>
	</div>
    <div style="clear:both"></div>
    <p>&nbsp;</P>

<p><?=@$this->errormsg;?></p>
<?php
    
    $dat=$this->mUser->getDetail($this->session->userdata('userid'));
    
?>
    <input type="hidden" name="nip_penunjukanauditor_audit" value="<?=$dat->nip_baru;?>" >
    <input type="hidden" name="nama_penunjukanauditor_audit" value="<?=$dat->Nama;?>" >

    <?
    
    if ($edit) {?>  
            <input type="hidden" name="edit" value="true" id="edit" />
            <input type="hidden" name="save" id="save" value="1" />
    <? }else {?>  
            <input type="hidden" name="save" id="save" value="1" />
    <?}?>

	<input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" id="<?=$kd_order_sertifikasi;?>" />
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Mulai Audit</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_awal_audit','value'=>$tgl_awal_audit,
                                'id'=>'tgl_awal_audit',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Akhir Audit</label>
                    <div class="col-sm-6">   
                             <?=form_input(array('name'=>'tgl_ahir_audit','value'=>$tgl_ahir_audit,
                                'id'=>'tgl_ahir_audit',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Penunjukan Auditor</label>
                    <div class="col-sm-6">   
                             <?=form_input(array('name'=>'tgl_penunjukanauditor_audit','value'=>$tgl_penunjukanauditor_audit,
                                'id'=>'tgl_penunjukanauditor_audit',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="col-xs-12"><hr></div>
        	<div class="row">
        		<div class="form-group">
        			<label   class="col-sm-6 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-12"> 
        				<button type="submit" class="btn btn-primary">Simpan</button>
        		</div>
        	</div>
        	 
            
            
    </div>     
</div>
<?=$this->javascript;?>  
<?=form_close();?>
<? $this->load->view('view_footer');?>