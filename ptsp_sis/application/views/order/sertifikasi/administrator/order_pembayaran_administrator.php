<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 6</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
    <p> <? 

        $order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);

        if($order_status){
            $no=0;
            foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
             }
        }
        
        $tombol2='<span style="float:right">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/email3.png" border="0" height="40"><br />
                  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>';
        if($step_status=='Pembayaran') {
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Jadwal/orderJadwal/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
         }?>
        
    </P>    
    <p>&nbsp;</P>

	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">List Pembayaran</a></li>
    		<!--<li><a href="<?=base_url();?>index.php/order/viewOrderPenagihan/<?=$kd_order_sertifikasi;?>">Cetak</a></li>-->
		</ul>    
    <p>&nbsp;</P>
<p><?=@$this->errormsg;?></p>
<fieldset><legend><b></b></legend>
    <input type="hidden" name="kd_order_sertifikasi" id="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" />
    <input type="hidden" name="nip_penerima" value="<?=$nip_penerima;?>" >
    <input type="hidden" name="nama_penerima" value="<?=$nama_penerima;?>" >
    <input type="hidden" name="harga_total" value="<?=$hargatotal_order_sertifikasi;?>" >
    <input type="hidden" name="jumlah_bayar" value="<?=$total_bayar;?>" >
    <input type="hidden" name="sisa_bayar" value="<?=($hargatotal_order_sertifikasi - $total_bayar);?>" >
    <input type="hidden" name="save" id="save" value="1" >
    

    <h3><center>Pembayaran No. Registrasi <?=$noreg_order_sertifikasi;?></center></h3> 
    <p>&nbsp;</p>
        <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No Pembayaran</label>
                    <div class="col-sm-6">   
                            <?=form_error('no_pembayaran')?> 
                            <?=form_input(array('name'=>'no_pembayaran','class'=>'form-control','maxlength'=>'50','size'=>'30'));?> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Sudah terima dari </label> 
                    <div class="col-sm-6">  
                            <?=form_input(array('name'=>'nama_pembayar','class'=>'form-control',
                                'maxlength'=>'250','size'=>'50'));?>   
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Untuk pembayaran </label> 
                    <div class="col-sm-6">  
                            <?=form_textarea(array('name'=>'tujuan_pembayaran','class'=>'form-control'));?>   

                    </div>
                </div>
            </div>         
             <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Nilai Bayar</label> 
                    <div class="col-sm-6">  
                            <?=form_input(array('name'=>'nilai_bayar','class'=>'form-control',
                                'maxlength'=>'250','size'=>'50'));?>   
                    </div>
                </div>
            </div>                     
            
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Tanggal Bayar</label>
                    <div class="col-sm-6">                          
                            <input type="text" name="tgl_bayar" id="tgl_bayar" size="10" value="<?=date("Y-m-d");?>">
                    </div>
                </div>
            </div>
            <div class="col-xs-12"><hr></div>
            <div class="row">
                <div class="form-group"> 
                    <label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <div lass="col-sm-7"> 
                            <button type="submit" name="tambah" value="1" class="btn btn-primary" >Simpan</button>&nbsp;&nbsp; 
                    </div>
                </div>
            </div>

            <div class="col-xs-12"><hr></div>

            <div class="row">
                <div class="form-group">
            <? 
            if($resultOrderPembayaran) 
                $this->load->view('order/sertifikasi/administrator/view_order_pembayaran_administrator.php');
            ?>
                </div>
            </div>
			 
</fieldset>
<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>