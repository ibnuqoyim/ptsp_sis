<?=$this->load->view("view_header");?>
<style type="text/css">
#container { line-height: 20px; margin: 20px 0; padding: 10px; }
#loading { color: white; background-color: red; padding: 5px 10px; font: 12px Arial; }
</style>
<script src="js/amcharts/javascript/amcharts.js" type="text/javascript"></script>
<script src="js/amcharts/javascript/raphael.js" type="text/javascript"></script>
<?=$script;?>

<center><h2 align="center"><?=$judul;?></h2></center>
        <h2><?=$judul_laporan;?></h2>
    <table border="0" width="100%"><tr><td width="190" valign="top" style="vertical-align:top">
    <div id="accordion">
    <h3><a href="#">Laporan Bulanan</a></h3>
    <div><ul>
    	<li><a href="index.php/laporan/customer_bulanan">Laporan Customer</a></li>
    	<li><a href="index.php/laporan/order_bulanan">Laporan Order</a></li>
	<li><a href="index.php/laporan/contoh_bulanan">Laporan Jumlah Contoh</a></li>
    	<li><a href="index.php/laporan/shu_bulanan">Laporan SHU</a></li>
	<li><a href="index.php/laporan/pnbp_bulanan">Laporan PNBP</a></li>
    </ul></div>
    <h3><a href="#">Laporan Kumulatif</a></h3>
    <div><ul>
    	<li><a href="index.php/laporan/customer_kumulatif">Laporan Customer</a></li>
        <li><a href="index.php/laporan/order_kumulatif">Laporan Order</a></li>
	 <li><a href="index.php/laporan/contoh_kumulatif">Laporan Jumlah Contoh</a></li>
        <li><a href="index.php/laporan/shu_kumulatif">Laporan SHU</a></li>
	<li><a href="index.php/laporan/pnbp_kumulatif">Laporan PNBP</a></li>
   	</ul></div>
	</div>
    </td><td>
    		<div style="margin-bottom:20px">
            <?=form_open(($this->uri->segment(3)==='1')? 
			base_url()."index.php/".$this->uri->segment(1)."/".$this->uri->segment(2):current_url());?>
			Satker <?=form_dropdown('kd_satker',$this->mstaff->GetSatkerList4DropDown(),(isset($kd_satker)?
                        $kd_satker:''),'class="input-option"');?>
            <?php 
	    if($this->uri->segment(2)==="customer_kumulatif"  || $this->uri->segment(2)==="order_kumulatif" 
			|| $this->uri->segment(2)==="lhu_kumulatif" || $this->uri->segment(2)==="pnbp_kumulatif"
			|| $this->uri->segment(2)==="contoh_kumulatif") { ?>
            		Periode Bulan <select name="bulan1" class="input-option">
		<?php 
		for($x=0;$x<12;$x++){ 
			echo '<option value="'.($x+1).'" '.(($bulan1==($x+1))?'selected':'').'>'.$this->bulan[$x].'</option>'; 
                } 
                ?></select> s/d Bulan <select name="bulan" class="input-option">
                        <?php 
                        for($x=0;$x<12;$x++){ 
				echo '<option value="'.($x+1).'" '.(($bulan==($x+1))?'selected':'').'>'.$this->bulan[$x].'</option>'; 
                        } ?></select>
            <?} 
	    if($this->uri->segment(2)==="contoh_bulanan" || $this->uri->segment(2)==="contoh_kumulatif"){

	    }?>
            Tahun <select name="tahun" class="input-option">
			<?php 
			for($x=2010;$x<=date("Y");$x++){ 
				echo '<option value="'.$x.'" '.(($tahun==$x)?'selected':'').'>'.$x.'</option>'; 
			} ?></select>
            <input type="submit" name="submit" class="button" value="Lihat" size="30" width="30" style="width:50px" />
            <?=form_close();?>
          	</div>
    		<?=$isiawal;?>
    </td></tr>
    </table>
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-templ.js"></script>

<?=$this->load->view("view_footer");?>
