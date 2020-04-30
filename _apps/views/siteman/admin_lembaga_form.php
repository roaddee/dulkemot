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
			<small>Panel Lembaga</small>
			</h1>
			<ol class="breadcrumb">
			<li><a href="<?php echo site_url('siteman')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Data Pengguna</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-9 col-sm-6 col-xs-12">
					<?php 
					// echo var_dump($debug);
					?>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><?php echo $boxTitle;?></h3>
						</div>
						<div class="box-body">
							<form action="<?php echo $form_action; ?>" method="POST" class="formular" role="form" enctype="multipart/form-data">
							<div class="form-group has-warning">
								<label for="inputNama" class="control-label">KODE Lembaga</label>
								<input type="text" class="form-control validate[required]" id="kode_org" placeholder="Tuliskan Kode Lembaga" name="kode_org" value="<?php echo $pengguna['kode_org']; ?>">
							</div>
							<div class="form-group has-warning">
								<label for="inputLembaga" class="control-label">Nama Lembaga</label>
								<input type="text" class="form-control validate[required]" id="nama" placeholder="Tuliskan Nama Lembaga" name="nama" value="<?php echo $pengguna['nama']; ?>">
							</div>
							<div class="form-group has-warning">
								<label for="inputWilayah" class="control-label">Pemerintahan Wilayah</label>
								<div class="row">
									<div class="col-md-6 col-sm-12 col-xs-12">
										<label for="inputPropinsi" class="control-label">Wilayah Propinsi</label>
										<select id="pro_id" class="form-control" name="pro_id" placeholder="Propinsi ...">
											<?php 
											foreach($propinsi as $key=>$item){
												$strS = ($key==substr($pengguna['kodewilayah'],0,2)) ? "selected=\"selected\"":"";
												echo "<option value=\"".$key."\" ".$strS.">".$item['nama']."</option>";
											}
											?>
										</select>
										
									</div>
									<div class="col-md-6 col-sm-12 col-xs-12">
										<label for="inputPropinsi" class="control-label">Wilayah Kabupaten/Kota</label>
											<select id="kab_id" class="form-control" name="kab_id" placeholder="Kabupaten/Kota ...">
												<option id="">Kabupaten/kota ...</option>
											</select>
										
									</div>
								</div>
								
							</div>
							
							<div class="form-group">
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="inputAlamatEmail" class="control-label">Email Resmi</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
												<input type="text" class="form-control validate[optional,custom[email]" id="email" placeholder="Tuliskan alamat email" name="email" value="<?php echo $pengguna['email']; ?>"></div>
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
									<label for="exampleInputPhone" class="control-label">Telp</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
										<input type="phone" class="form-control validate[optional, custom[phone]]" id="exampleInputPhone" placeholder="Tuliskan nomer telp" name="telp" value="<?php echo $pengguna['telp']; ?>"></div>
									</div>
									<div class="col-xs-6">
									<label for="inputAlamat" class="control-label">No Faximili</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></span>
										<input type="phone" class="form-control validate[optional, custom[phone]]" id="exampleInputFax" placeholder="Tuliskan nomor handphone" name="fax" value="<?php echo $pengguna['fax']; ?>"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputProfil" class="control-label">Alamat</label>
								<textarea class="form-control validate[optional]" placeholder="Tuliskan alamat" name="alamat" id="alamat"><?php echo $pengguna['alamat']; ?></textarea>
							</div><!--/form-group-->
							<div class="form-group">
								<label for="inputProfil" class="control-label">Logo</label>
								<input type="file" class="form-control" name="foto" id="foto" />
							</div><!--/form-group-->
							<div class="form-group">
								<label for="inputProfil" class="control-label">Profil</label>
								<textarea class="summernote form-control" placeholder="Tuliskan keterangna profil kantor" name="ndesc" id="ndesc"><?php // echo $pengguna['$ndesc']; ?></textarea>
							</div><!--/form-group-->
							<div class="form-group">
								<input type="hidden" name="id" value="<?php echo $id; ?>"/>
								<a class="btn btn-default" href="<?php echo site_url('admin/lembaga/')?>"><i class="fa fa-refresh"></i> Batal</a>
								<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
							</div><!--/form-group-->

								
							</form>
							
							
						</div>
						<div class="box-footer">
							<div class="btn-group  pull-right">
							<a class="btn btn-default" href="<?php echo site_url('admin/lembaga/')?>"><i class="fa fa-th-list"></i> Daftar Lembaga</a>
							<a class="btn btn-primary" href="<?php echo site_url('admin/lembaga/0/baru')?>"><i class="fa fa-plus"></i> Tambah Data Lembaga</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-life-buoy"></i> Penambahan Data Lembaga</h3>
						</div>
						<div class="box-body">
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<!-- footer section -->
<!-- JS ValidationEngine -->
<script src="<?php echo base_url('assets/plugins/'); ?>validation-engine/jquery.validationEngine.js"></script>
<script src="<?php echo site_url('jsphp/jqueryValidationEngineId'); ?>"></script>

<!-- Select INTERDEPENDENT -->
<link href="<?php echo base_url("assets/plugins/"); ?>dependent-dropdown/css/dependent-dropdown.css " rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url("assets/plugins/"); ?>dependent-dropdown/js/dependent-dropdown.min.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>dependent-dropdown/js/locales/id.js"></script>

<!-- Summernote-->
<link href="<?php echo base_url()?>assets/plugins/summernote/summernote.css" / rel="stylesheet">
<script src="<?php echo base_url()?>assets/plugins/summernote/summernote.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/summernote/lang/summernote-id-ID.js"></script>
<script>
	$(document).ready(function() {
		/*
		 * jQueryValidation
		 */
              
		var formular = $("form.formular");
		if(formular){
			$("form.formular").validationEngine();
		}

		/*
		 * Select2
		 */

		/*
		Dependant dropdown
		*/
		var kab_id = $("#kab_id");
		if(kab_id){
			$("#kab_id").depdrop({
				depends: ['pro_id'],
				url: '<?php echo site_url('ajax/siteman_wilayah/'.substr($pengguna['kodewilayah'],0,4));?>',
				initialize: true,
				loadingText: 'Memuat daftar Kabupaten ...'
			});
		}


		/*
		 * Summernote
		 */

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
