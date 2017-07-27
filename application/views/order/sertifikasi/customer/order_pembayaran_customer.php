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
<fieldset></legend>
    <input type="hidden" name="kd_order_sertifikasi" id="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" />
    

    <h3><center>Pembayaran No. Registrasi <?=$noreg_order_sertifikasi;?></center></h3> 
    <p>&nbsp;</p>
        <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Upload Bukti Pembayaran</label>
                    <div class="col-sm-6">   
                           <input type="file" name="bukti_pembayaran">
                    </div>
                </div>
				<div class="form-group">
                    <label  class="col-sm-3 control-label"></label>
                    <div class="col-sm-6"> 
						</br>
                           <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
            

           
			 
</fieldset>
<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>