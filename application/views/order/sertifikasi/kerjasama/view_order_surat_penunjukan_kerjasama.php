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
   
	<div>
        <ul class="nav nav-tabs" id="myTab">
            <li><a href="<?=base_url();?>index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>">Jadwal Audit</a></li>            
            <li><a href="<?=base_url();?>index.php/order/orderAuditor/<?=$kd_order_sertifikasi;?>">Auditor</a></li>
            <li><a href="<?=base_url();?>index.php/order/orderJadwalDetail/<?=$kd_order_sertifikasi;?>">Audit Plan</a></li>
            <li class="active"><a href="<?=base_url();?>index.php/order/viewOrderSuratPenunjukan/<?=$kd_order_sertifikasi;?>">Cetak Surat Penujukan</a></li>
        </ul>
    </div>
	<div style="clear:both"></div>
    <p>&nbsp;</P>

<table  width="100%" border="1">
    <tbody>
        <tr>
            <td width="100" colspan="3"  rowspan="2" align="center"><h3>PENUNJUKAN AUDITOR / PPC</h3></td>
            <td align="left" width="180">Tanggal :<br><?=tgl_indo(date($tgl_penunjukanauditor_audit));?></td>
                      
        </tr>
        <tr>
             <td align="left">Hal 1 dari 1</td>
        </tr>
        <tr>
             <td colspan="4">
                <table  width="100%" >
                     <tr>
                        <td colspan="3">&nbsp;</td>
                        
                    </tr>
                    <tr>
                        <td colspan="3"><b>PERUSAHAAN YANG AKAN DISERTIFIKASI </b></td>
                        
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Nama </td>
                        <td>:</td>
                        <td><?=$nama_perusahaan_pemohon;?></td>
                    </tr>
                    <tr>
                        <td>Alamat </td>
                        <td>:</td>
                        <td><?=$alamat_perusahaan_pemohon;?></td>
                    </tr>
                    <tr>
                        <td>No. Telepon </td>
                        <td>:</td>
                        <td><?=$telpon_perusahaan_pemohon;?></td>
                    </tr>
                    <tr>
                        <td>No. Fax </td>
                        <td>:</td>
                        <td><?=$fax_perusahaan_pemohon;?></td>
                    </tr>
                    <tr>
                        <td>Yang dihubungi </td>
                        <td>:</td>
                        <td><?=$nm_kontak_perusahaan_pemohon;?></td>
                    </tr>
                     <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                     <tr>
                        <td colspan="3"><b>STANDAR PEMERIKSAAN </b></td>
                    </tr>
                     <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <?php if($nama_sertifikasi_smm){ ?>
                    <tr>
                        <td>Standar sistem Mutu </td>
                        <td>:</td>
                        <td><?=$nama_sertifikasi_smm;?></td>
                    </tr>
                    <?php } ?>
                    <?php if($nama_sertifikasi_jenis=='SERTIFIKASI PRODUK'){ 
                            $standarp='';
                            if($resultOrderKomoditi){
                                foreach($resultOrderKomoditi as $row){
                                    $standarp = $row->no_sertifikasi_komoditi;
                                    $standarp = $standarp."<br>";

                                }
                            }

                    ?>
                    <tr>
                        <td>Standar Produk </td>
                        <td>:</td>
                        <td><?=$standarp;?></td>
                    </tr>
                    <?php } ?>
                     
                     <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                     <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                     <tr>
                        <td valign="top" colspan="2"><b>TAHAPAN SERTIFIKASI </b></td>
                        <td valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                        <td valign="top">&nbsp;</td>
                        <td valign="top">&nbsp;</td>
                        <td colspan valign="top">1. Tinjauan Dokumen<br>2. Assesmen <br> 3. Surveilance<br> 4. Assemen Ulang<br> 5. Pengambilan Contoh<br></td>
                    </tr>
                    
                     <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                     <tr>
                        <td colspan="3"><b>PERSONAL YANG DITUNJUK </b></td>
                    </tr>
                     <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr >
                        <td colspan="3" ><div>
                                <table width="100%" border="1">
                                    <thead>
                                        <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Tugas dalam sertifikasi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($resultOrderAuditor){
                                                $no1=0;
                                                foreach($resultOrderAuditor as $row2){
                                                    $no1++;
                                        ?>
                                                <tr>
                                                     <td><?=$no1;?></td>
                                                     <td><?=$row2->nama_auditor;?></td>
                                                     <td><?=$row2->jabatan_auditor;?></td>

                                            
                                                </tr>
                                        <?php } 
                                            }?>
                                    </tbody>
                                </table>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td align="center">Manajer Operasional</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                     <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align="center"><?=$nama_penunjukanauditor_audit;?></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                </table>



             </td>
        </tr>
        
</table>
<p>&nbsp;</P>
</fieldset>
<?=form_close();?>
<?=$this->load->view('view_footer');?>