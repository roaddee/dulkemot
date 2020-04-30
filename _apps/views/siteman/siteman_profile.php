<?php
/*
 * siteman_dashboard.php
 * 
 * Copyright 2016 Isnu Suntoro <isnusun@gmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

$this->load->view('siteman/siteman_header');
?>
<!-- Left side column. contains the logo and sidebar -->
<?php
$this->load->view('siteman/siteman_sidebar');
?>
 <!-- Content Wrapper. Contains page content -->

<!-- CSS ValidationEngine -->
<link href="<?php echo base_url('assets/plugins/'); ?>validation-engine/validationEngine.jquery.css" rel="stylesheet" type="text/css">

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
			<?php echo $pageTitle;?>
			<small><?php echo $user['nama'];?></small>
			</h1>
			<ol class="breadcrumb">
			<li><a href="<?php echo site_url('siteman')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><i class="fa fa-gear"></i> Pengelolaan Data Pribadi</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-8 col-sm-6 col-xs-12">
					<?php
						if($strMsg){
							echo "
							<div class=\"alert alert-warning\">".$strMsg."</div>
							";
						}
						
					
					?>
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li <?php echo $tab_profil_li; ?>><a href="#profil" data-toggle="tab"><i class="fa fa-newspaper-o"></i> Data Pribadi</a></li>
							<li <?php echo $tab_foto_li; ?>><a href="#foto" data-toggle="tab"><i class="fa fa-user"></i> Foto Profil</a></li>
							<li <?php echo $tab_sandi_li; ?>><a href="#sandi" data-toggle="tab"><i class="fa fa-key"></i> Kata Sandi</a></li>
							
							<li class="pull-left header">Profil <?php echo $user['nama']; ?></li>
						</ul>
						<div class="tab-content">
							<div id="profil" class="tab-pane <?php echo $tab_profil;?>">
								<form action="<?php echo $form_profil; ?>" method="POST" class="formular" role="form">
								
									<div class="form-group has-warning">
										<label for="inputNama" class="control-label">Nama Lengkap</label>
										<input type="text" class="form-control validate[required]" id="nama" placeholder="Tuliskan Nama Karyawan" name="nama" value="<?php echo $pengguna['nama']; ?>">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group  has-warning">
													<label for="inputAlamatEmail" class="control-label">Email</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
														<input type="text" class="form-control" id="email" readonly=\"readonly\" placeholder="Tuliskan alamat email" name="email" value="<?php echo $pengguna['email']; ?>"></div>
													</div>
												</div>
											<div class="col-xs-6">
											<label for="inputAlamat" class="control-label">Website</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-globe fa-fw"></i></span>
												<input type="text" class="form-control validate[optional]" id="exampleInputUrl" placeholder="Tuliskan website" name="url" value="<?php echo $pengguna['url']; ?>"></div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
											<div class="form-group has-warning">
											<label for="inputAlamat" class="control-label">No HP.</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></span>
												<input type="phone" class="form-control validate[required, custom[phone]]" id="exampleInputFax" placeholder="Tuliskan nomor handphone" name="nohp" value="<?php echo $pengguna['nohp']; ?>"></div>
											</div>
											</div>
											<div class="col-xs-6">
											<label for="exampleInputPhone" class="control-label">Telp</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
												<input type="phone" class="form-control validate[optional, custom[phone]]" id="exampleInputPhone" placeholder="Tuliskan nomer telp" name="telp" value="<?php echo $pengguna['telp']; ?>"></div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="inputProfil" class="control-label">Alamat</label>
										<textarea class="form-control validate[optional]" placeholder="Tuliskan alamat" name="alamat" id="alamat"><?php echo $pengguna['alamat']; ?></textarea>
									</div><!--/form-group-->
									<div class="form-group">
										<label for="inputProfil" class="control-label">Foto</label>
										<input type="file" class="form-control" placeholder="Pilih foto dari komkputer" name="foto" id="fotoprofile" />
									</div><!--/form-group-->
									<div class="form-group">
										<label for="inputProfil" class="control-label">Profil</label>
										<textarea class="summernote form-control" placeholder="Tuliskan keterangna profil kantor" name="ndesc" id="ndesc"><?php // echo $pengguna['$ndesc']; ?></textarea>
									</div><!--/form-group-->

									<div class="form-group">
										<div class="">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data Profil</button>
										</div>
									</div>
								</form>
							</div>
							<div id="foto" class="tab-pane <?php echo $tab_foto;?>">
								<!-- formulir ganti foto -->
								<?php
								$file_foto = (strlen($pengguna['foto']) > 0 )? 'assets/uploads/'.str_replace(".","-m.",$pengguna['foto']):'assets/img/nophoto.png';
								if(is_file($file_foto)){
									$foto = "<img src=\"".base_url($file_foto)."\" />";
								}else{
									$foto = "<img src=\"".base_url('assets/img/nophoto.png')."\" />";
								}
								
								?>
								<form action="<?php echo $form_foto; ?>" enctype="multipart/form-data" method="POST" class="form-horizontal formular" role="form">
									<div class="form-group">
										<label class="col-md-4 col-sm-6 col-xs-12 control-label">Foto Terpasang</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<?php echo $foto; ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 col-sm-6 col-xs-12 control-label">Berkas Foto Pengganti</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<input type="file" name="foto" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-4 col-sm-6 col-xs-12 control-label">&nbsp;</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Ganti Foto Profil</button>
										</div>
									</div>
								</form>
								<?php
								if($arsip_foto){
									echo "
									<fieldset class=\"kotak\">
										<legend>Arsip Foto Profil <strong>".$user['nama']."</strong></legend>
										<div>
											<ul class=\"imggrid\">";
										foreach($arsip_foto as $key=>$item){
											echo "<li class=\"active\">
												<img class=\"img-responsive\" src=\"".base_url('assets/uploads/'.str_replace(".","-s.",$item))."\">
												<div class=\"btn-group\">
													<a class=\"btn btn-primary btn-xs\" href=\"\"><i class=\"fa fa-send\"></i></a>
													<a class=\"btn btn-danger btn-xs\" href=\"\"><i class=\"fa fa-trash\"></i></a>
												</div>
												</li>";
										}
										echo "
											</ul>
										</div>
									</fieldset>
									";
								}
								?>
							</div>
							<div id="sandi" class="tab-pane  <?php echo $tab_sandi;?>">
								<!-- formulir ganti kata sandi -->
								<form action="<?php echo $form_sandi; ?>" method="POST" class="form-horizontal formular" role="form">
									<div class="form-group">
										<label class="col-md-4 col-sm-6 col-xs-12 control-label">Sandi saat ini</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<input type="password" name="passwt" id="passwt_old" class="form-control validate[required]">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 col-sm-6 col-xs-12 control-label">Sandi Baru</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<input type="password" name="passwt_new" id="passwt_new" class="form-control validate[required,min[6],max[32]]">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 col-sm-6 col-xs-12 control-label">Ketik Ulang Sandi Baru</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<input type="password" name="passwt_new1" id="passwt_new1" class="form-control validate[required,equals[passwt_new],min[6],max[32]]">
										</div>
									</div>
								
									<div class="form-group">
										<label class="col-md-4 col-sm-6 col-xs-12 control-label">&nbsp;</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Ganti Sandi</button>
										</div>
									</div>
								</form>
							
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="box box-default box-solid">
						<div class="box-header">
							<h3 class="box-title"></h3>
						</div>
						<div class="box-body">

						
						</div>
						<div class="box-footer"></div>
					</div>
				</div>
			</div>
		</section>
	</div>
<!-- footer section -->
<!-- footer section -->
<!-- JS ValidationEngine -->
<script src="<?php echo base_url('assets/plugins/'); ?>validation-engine/jquery.validationEngine.js"></script>
<script src="<?php echo site_url('jsphp/jqueryValidationEngineId'); ?>"></script>
<script>
	$(document).ready(function() {
		/*
		 * jQueryValidation
		 */
              
		var formular = $("form.formular");
		if(formular){
			$("form.formular").validationEngine();
		}
	});
</script>


<!-- Summernote-->
<link href="<?php echo base_url()?>assets/plugins/summernote/summernote.css" / rel="stylesheet">
<script src="<?php echo base_url()?>assets/plugins/summernote/summernote.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/summernote/lang/summernote-id-ID.js"></script>
<script>
	$(document).ready(function() {
		$('.summernote').summernote({
			lang:'id-ID',
			height: 300,
			callbacks: {
				onImageUpload: function (image) {
					sendFile(image[0]);
				}
			}
		});

    function sendFile(image) {
        var data = new FormData();
        data.append("image", image);
        //if you are using CI 3 CSRF 
        // data.append("<?php echo $this->security->get_csrf_token_name() ?>", "<?php echo $this->security->get_csrf_hash() ?>");
        $.ajax({
            data: data,
            type: "POST",
            url: "<?php echo site_url('ajax/summernote_upload/'); ?>",
            cache: false,
            contentType: false,
            processData: false,
            success: function (url) {
                var image = url;
                $('.summernote').summernote("insertImage", image);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
	});		
</script>
<?php

$this->load->view('siteman/siteman_footer');
