<div class="form">
	<?//=form_open(current_url(),array('id'=>'frmsearch'));?>
		<fieldset >			
			<legend>Pencarian</legend>
			<div class="row">
				<div class="col">
				<div class="form-group">
					<div class="col-sm-6 control-label">
						<label  for="noreg_order_sertifikasi" >No. Registrasi </label>
						<div class="col-sm-12">						
							<?=form_input('noreg_order_sertifikasi','','class="form-control" id="noreg_order_sertifikasi"');?>
						</div>	
					</div>
				</div>
				</div>
			
				<div class="col">
				<div class="form-group">
					<div class="col-sm-6 control-label">
						<label  for="nama_sertifikasi_jenistarifitem" class="control-label col-xs-20">Nama Jenis Sertifikasi </label>
						<div class="col-sm-12">						
							<?=form_input('nama_sertifikasi_jenistarifitem','','class="form-control" id="nama_sertifikasi_jenistarifitem"');?>
						</div>	
					</div>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
				<div class="form-group">
					<div class="col-sm-6 control-label">
						<label  for="nm_perusahaan_pemohon" class="control-label col-xs-20">Nama Perusahaan Pemohon </label>
						<div class="col-sm-12">						
							<?=form_input('nm_perusahaan_pemohon','','class="form-control" id="nm_perusahaan_pemohon"');?>
						</div>	
					</div>
				</div>
				</div>
				<div class="col">
				<div class="form-group">
					<div class="col-sm-6 control-label">
						<label  for="nm_pabrik" class="control-label col-xs-20">Nama Pabrik </label>
						<div class="col-sm-12">						
							<?=form_input('nm_pabrik','','class="form-control" id="nm_pabrik"');?>
						</div>	
					</div>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<div class="col-sm-6 control-label">
						<label  for="status_order_sertifikasi" class="control-label col-xs-20">Status </label>
						<div class="col-sm-12">						
							<?//=form_input('status_order_sertifikasi','','class="form-control" id="status_order_sertifikasi"');?>
							<?php

									$dropdwon = $this->mOrder->getStatusList4DropDown();							
									$options= array(
				             				'' => '',
			               					'Teregistrasi' => 'Teregistrasi',
                  							'Sertifikasi Telah Selesai'    => 'Sertifikasi Telah Selesai', 
                 		  					'Closed'    => 'Closed',
				              				'Batal' => 'Batal'
                							);
               			 			echo form_dropdown('statusbayar_order_sertifikasi', $dropdwon, '', 'class="input-option"');
							?>
						</div>	
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6 control-label">
						<label  for="statusbayar_order_sertifikasi" class="control-label col-xs-20">Status Bayar </label>
						<div class="col-sm-12">						
							<?//=form_input('statusbayar_order_sertifikasi','','class="form-control" id="statusbayar_order_sertifikasi"');?>
							<?php
									$options= array(
				  								'' => '',
                  								'belum'  => 'Belum',
												'sebagian'  => 'Sebagian',
                  								'lunas'    => 'Lunas'
                								);
               			 						echo form_dropdown('statusbayar_order_sertifikasi', $options, '', 'class="input-option"');
							?>
						</div>	
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<div class="col-sm-offset-5 col-sm-12">
							<a href="javascript:void();"><button type="submit" class="btn btn-primary">Cari</button></a>&nbsp;
							<a href="javascript:void();"><button type="button" class="btn btn-primary" onclick="goReset()">Reset</button></a>	
					</div>				
				</div>	
		</fieldset>
	<?=form_close();?>
</div>