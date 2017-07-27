<div class="wizard-steps">
        <?

       
$order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);

if($order_status){
        $no=0;
        foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
        }
}
?>
   <?php if($step_status=='Teregistrasi') { ?>
        <div class="active-step"><a href="index.php/order/Edit"><span>1</span> Permohonan</a></div>
        <div><a href="Step 2" onclick="return false"><span>2</span> Dokumen</a></div>
        <div><a href="Step 3" onclick="return false"><span>3</span> Penawaran</a></div>
        <div><a href="Step 4" onclick="return false"><span>4</span> Kontrak</a></div>
        <div><a href="Step 5" onclick="return false"><span>5</span> Penagihan</a></div>
        <div><a href="Step 6" onclick="return false"><span>6</span> Pembayaran</a></div>
        <div><a href="Step 7" onclick="return false"><span>7</span> Jadwal Audit</a></div>
        <div><a href="Step 8" onclick="return false"><span>8</span> Audit</a></div>
        <div><a href="Step 9" onclick="return false"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 10" onclick="return false"><span>10</span> Sertifikat</a></div>
        <div><a href="Step 11" onclick="return false"><span>11</span> Penyerahan Sertifikat</a></div>
        <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='Dokumen') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="active-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div><a href="Step 3" onclick="return false"><span>3</span> Penawaran</a></div>
        <div><a href="Step 4" onclick="return false"><span>4</span> Kontrak</a></div>
        <div><a href="Step 5" onclick="return false"><span>5</span> Penagihan</a></div>
        <div><a href="Step 6" onclick="return false"><span>6</span> Pembayaran</a></div>
        <div><a href="Step 7" onclick="return false"><span>7</span> Jadwal Audit</a></div>
        <div><a href="Step 8" onclick="return false"><span>8</span> Audit</a></div>
        <div><a href="Step 9" onclick="return false"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 10" onclick="return false"><span>10</span> Sertifikat</a></div>
        <div><a href="Step 11" onclick="return false"><span>11</span> Penyerahan Sertifikat</a></div>
        <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='Penawaran') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="active-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div><a href="Step 4" onclick="return false"><span>4</span> Kontrak</a></div>
        <div><a href="Step 5" onclick="return false"><span>5</span> Penagihan</a></div>
        <div><a href="Step 6" onclick="return false"><span>6</span> Pembayaran</a></div>
        <div><a href="Step 7" onclick="return false"><span>7</span> Jadwal Audit</a></div>
        <div><a href="Step 8" onclick="return false"><span>8</span> Audit</a></div>
        <div><a href="Step 9" onclick="return false"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 10" onclick="return false"><span>10</span> Sertifikat</a></div>
        <div><a href="Step 11" onclick="return false"><span>11</span> Penyerahan Sertifikat</a></div>
        <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='Kontrak') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="active-step"><a href="index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>"><span>4</span> Kontrak</a></div>
        <div><a href="Step 5" onclick="return false"><span>5</span> Penagihan</a></div>
        <div><a href="Step 6" onclick="return false"><span>6</span> Pembayaran</a></div>
        <div><a href="Step 7" onclick="return false"><span>7</span> Jadwal Audit</a></div>
        <div><a href="Step 8" onclick="return false"><span>8</span> Audit</a></div>
        <div><a href="Step 9" onclick="return false"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 10" onclick="return false"><span>10</span> Sertifikat</a></div>
        <div><a href="Step 11" onclick="return false"><span>11</span> Penyerahan Sertifikat</a></div>
        <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='Penagihan') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>"><span>4</span> Kontrak</a></div>
        <div class="active-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>5</span> Penagihan</a></div>
        <div><a href="Step 6" onclick="return false"><span>6</span> Pembayaran</a></div>
        <div><a href="Step 7" onclick="return false"><span>7</span> Jadwal Audit</a></div>
        <div><a href="Step 8" onclick="return false"><span>8</span> Audit</a></div>
        <div><a href="Step 9" onclick="return false"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 10" onclick="return false"><span>10</span> Sertifikat</a></div>
        <div><a href="Step 11" onclick="return false"><span>11</span> Penyerahan Sertifikat</a></div>
        <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='Pembayaran') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>"><span>4</span> Kontrak</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>5</span> Penagihan</a></div>
        <div class="active-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>6</span> Pembayaran</a></div>
        <div><a href="Step 7" onclick="return false"><span>7</span> Jadwal Audit</a></div>
        <div><a href="Step 8" onclick="return false"><span>8</span> Audit</a></div>
        <div><a href="Step 9" onclick="return false"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 10" onclick="return false"><span>10</span> Sertifikat</a></div>
        <div><a href="Step 11" onclick="return false"><span>11</span> Penyerahan Sertifikat</a></div>
        <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='Jadwal') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>"><span>4</span> Kontrak</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>5</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>6</span> Pembayaran</a></div>
        <div class="active-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>7</span> Jadwal Audit</a></div>
        <div><a href="Step 8" onclick="return false"><span>8</span> Audit</a></div>
        <div><a href="Step 9" onclick="return false"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 10" onclick="return false"><span>10</span> Sertifikat</a></div>
        <div><a href="Step 11" onclick="return false"><span>11</span> Penyerahan Sertifikat</a></div>
        <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='Audit') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>"><span>4</span> Kontrak</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>5</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>6</span> Pembayaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>7</span> Jadwal Audit</a></div>
        <div class="active-step"><a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>"><span>8</span> Audit</a></div>
        <div><a href="Step 9" onclick="return false"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 10" onclick="return false"><span>10</span> Sertifikat</a></div>
        <div><a href="Step 11" onclick="return false"><span>11</span> Penyerahan Sertifikat</a></div>
        <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='Evaluasi') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>"><span>4</span> Kontrak</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>5</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>6</span> Pembayaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>7</span> Jadwal Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>"><span>8</span> Audit</a></div>
        <div class="active-step"><a href="index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 10" onclick="return false"><span>10</span> Sertifikat</a></div>
        <div><a href="Step 11" onclick="return false"><span>11</span> Penyerahan Sertifikat</a></div>
        <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='Sertifikat') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>"><span>4</span> Kontrak</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>5</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>6</span> Pembayaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>7</span> Jadwal Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>"><span>8</span> Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div class="active-step"><a href="index.php/order/orderSertifikat/<?=$kd_order_sertifikasi;?>"><span>10</span> Sertifikat</a></div>
        <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='SerahTerima') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>"><span>4</span> Kontrak</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>5</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>6</span> Pembayaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>7</span> Jadwal Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>"><span>8</span> Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div class="completed-step"><a href="index.php/order/orderSertifikat/<?=$kd_order_sertifikasi;?>"><span>10</span> Sertifikat</a></div>
        <div class="active-step"><a href="index.php/order/orderSerahTerima/<?=$kd_order_sertifikasi;?>"><span>11</span> Penyerahan Sertifikat</a></div>
         <div><a href="Step 12" onclick="return false"><span>12</span>Closed</a></div>
    <?php }elseif($step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>"><span>4</span> Kontrak</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>5</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>6</span> Pembayaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>7</span> Jadwal Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>"><span>8</span> Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>"><span>9</span> Tim Evaluasi/Teknis</a></div>
        <div class="completed-step"><a href="index.php/order/orderSertifikat/<?=$kd_order_sertifikasi;?>"><span>10</span> Sertifikat</a></div>
        <div class="completed-step"><a href="index.php/order/orderSerahTerima/<?=$kd_order_sertifikasi;?>"><span>11</span> Penyerahan Sertifikat</a></div>
        <div class="completed-step"><a href="index.php/order/orderClosed/<?=$kd_order_sertifikasi;?>"><span>12</span> Closed</a></div>  
     <?php } ?>
    </div>
