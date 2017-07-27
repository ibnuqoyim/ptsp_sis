<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 1</div>
    <?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
    <div>
        <ul class="nav nav-tabs" id="myTab">
            <li><a href="<?=base_url();?>index.php/order/edit/<?=$kd_order_sertifikasi;?>">Permohonan</a></li>
            <li class="active"><a href="<?=base_url();?>index.php/order/orderPabrik/<?=$kd_order_sertifikasi;?>">Pabrik</a></li>
            <li><a href="<?=base_url();?>index.php/order/orderKomoditi/<?=$kd_order_sertifikasi;?>">Komoditi</a></li>
            <li><a href="<?=base_url();?>index.php/order/view/<?=$kd_order_sertifikasi;?>">Cetak Permohon</a></li>
        </ul>
    </div>

            <div class="row">
                <div class="form-group">
            <? 
            if($result) 
                $this->load->view('order/sertifikasi/keuangan/view_order_pabrik_keuangan.php');
            ?>
                </div>
            </div>

            

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>