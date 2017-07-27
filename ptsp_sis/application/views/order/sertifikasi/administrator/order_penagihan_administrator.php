<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 5</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
     
    <p> <? 
       
        $tombol2='<span style="float:right">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/email3.png" border="0" height="40"><br />
                  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>';
         $order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);

        if($order_status){
            $no=0;
            foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
            }
        }   

        if($step_status=='Penagihan'){
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Pembayaran/orderPembayaran/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?>
        
    </P>    
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">List Penaginan</a></li>
    		<!--<li><a href="<?=base_url();?>index.php/order/viewOrderPenagihan/<?=$kd_order_sertifikasi;?>">Cetak</a></li>-->
		</ul>
    <div style="clear:both"></div>
     
<p><?=@$this->errormsg;?></p>

    <input type="hidden" name="kd_order_sertifikasi" id="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" />
    <input type="hidden" name="nip_pembuat_invoice" value="<?=$nip_pembuat_invoice;?>" >
    <input type="hidden" name="nama_pembuat_invoice" value="<?=$nama_pembuat_invoice;?>" >
    <input type="hidden" name="harga_total" value="<?=$hargatotal_order_sertifikasi;?>" >
    <input type="hidden" name="jumlah_bayar" value="<?=$total_bayar;?>" >
    <input type="hidden" name="sisa_bayar" value="<?=($hargatotal_order_sertifikasi - $total_bayar);?>" >
    <input type="hidden" name="save" id="save" value="1" >

    

    <h3><center>Penagihan No. Registrasi <?=$noreg_order_sertifikasi;?></center></h3> 
    <p>&nbsp;</p>
        <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No Penagihan</label>
                    <div class="col-sm-6">   
                            <?=form_error('no_invoice')?> 
                            <?=form_input(array('name'=>'no_invoice','class'=>'form-control',
                                'value'=>$this->mOrder->Make_no_invoice(),
                                'maxlength'=>'50','size'=>'30'));?> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Penagihan ke</label> 
                    <div class="col-sm-6">  
                            <?=form_input(array('name'=>'invoice_ke','class'=>'form-control',
                                'maxlength'=>'250','size'=>'50'));?>   
                    </div>
                </div>
            </div>            
            
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Tanggal Penagihan dibuat</label>
                    <div class="col-sm-6">                          
                            <input type="text" name="tgl_invoice" id="tgl_invoice" size="10" value="<?=date("Y-m-d");?>">
                    </div>
                </div>
            </div>
           <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Perihal Surat Penagihan</label>
                    <div class="col-sm-6">                      
                             <input type="text" id="perihal_invoice"  name="perihal_invoice" 
                            value="<?=$perihal_invoice;?>" class="form-control" >  
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Jumlah Lampiran Surat Penagihan</label>
                    <div class="col-sm-6">                      
                             <input type="text" id="jumlah_lampiran_invoice"  name="jumlah_lampiran_invoice" 
                            value="<?=$jumlah_lampiran_invoice;?>" class="form-control" >  
                    </div>       
                </div>
            </div>
            <!--<div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Isi Paragraf 1 Surat Penagihan</label>
                    <div class="col-sm-6">                      
                             <textarea  id="isi_surat_invoice"  name="isi_surat_invoice" class="form-control" rows="10" ></textarea>
                    </div>       
                </div>
            </div>-->
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nip penandatngan Surat Penagihan</label>
                    <div class="col-sm-6">                      
                             <input type="text" id="nip_penandatangan_invoice"  name="nip_penandatangan_invoice" 
                            value="<?=$nip_penandatangan_invoice;?>" class="form-control" >  
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama penandatngan Surat Penagihan</label>
                    <div class="col-sm-6">                      
                             <input type="text" id="nama_penandatangan_invoice"  name="nama_penandatangan_invoice" 
                            value="<?=$nama_penandatangan_invoice;?>" class="form-control" >  
                    </div>       
                </div>
            </div>
            <div class="col-xs-12"><hr></div>
            <div class="row">
                <div class="form-group"> 
                    <label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <div lass="col-sm-7"> 
                            <button type="submit" name="tambah" value="1" class="btn btn-primary" >Create</button>&nbsp;&nbsp; 
                    </div>
                </div>
            </div>

            <div class="col-xs-12"><hr></div>

            <div class="row">
                <div class="form-group">
            <? 
            if($resultOrderInvoice) 
                $this->load->view('order/sertifikasi/administrator/view_order_penagihan_administrator.php');
            ?>
                </div>
            </div>

<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>
