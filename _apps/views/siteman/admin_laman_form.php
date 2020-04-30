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

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
			<?php echo APP_TITLE;?>
			<small>Panel Laman Statis</small>
			</h1>
			<ol class="breadcrumb">
			<li><a href="<?php echo site_url('siteman')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Data Pengguna</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-8 col-sm-6 col-xs-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><a href="<?php echo site_url('admin/laman');?>"><?php echo $boxTitle;?></a></h3>
						</div>
						<div class="box-body">
							<form action="<?php echo $form_action; ?>" method="POST" class="formular">
							<div class="form-group">
								<label class="control-label">Alamat URL</label>
								<div class="input-group">
									<span class="input-group-addon"><?php echo site_url('publik/laman/');?></span>
									<input type="text" class="form-control" name="post_name" id="post_name" value="<?php echo $post['post_name']; ?>"/>
								</div>							
							</div>
							<div class="form-group">
								<label class="control-label">Judul Halaman</label>
								<textarea class="resizable_textarea form-control" name="post_title" id="post_title"><?php echo $post['post_title']; ?></textarea>
								
							</div>
							<div class="form-group">
								<label class="control-label">Isi Halaman</label>
								<textarea name="post_content" id="summernote" class="summernote form-control" style="min-height:400px;"><?php echo $post['post_content']; ?></textarea>
							</div>
															
							<div class="form-group">
								<label class="control-label"></label>
								<div>
									<input type="hidden" name="post_type" value="page">
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Batal</button>
									<button type="submit" class="btn btn-default" name="post_status" value="draft"><i class="fa fa-save"></i> Simpan sbg draft</button>
									<button type="submit" class="btn btn-primary" name="post_status" value="publish"><i class="fa fa-send"></i> Simpan dan Publikasikan</button>
								</div>
							</div>
							</form>
							<?php 
							if($msg){
								echo "
								<div class=\"alert alert-success alert-dismissable\">
									<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
									<h4><i class=\"fa fa-check\"></i> ".$msg['msg']."</h4>
								</div>";
							}
							?>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title"><i class="fa fa-info fa-fw"></i> Pengelolaan Laman Statis Web</h3>
						</div>
						<div class="box-body">
							<ul>
								<li></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<!-- footer section -->
<!-- JS ValidationEngine -->
<script src="<?php echo base_url('assets/plugins/'); ?>jeditable/jquery.jeditable.mini.js"></script>
<script>
	$(document).ready(function() {
		/*
		 * Inline Editable
		 */
	});
</script>
<!-- Summernote-->
<link href="<?php echo base_url('assets/plugins/'); ?>summernote/summernote.css" / rel="stylesheet">
<script src="<?php echo base_url('assets/plugins/'); ?>summernote/summernote.min.js"></script>
<script src="<?php echo base_url('assets/plugins/'); ?>summernote/lang/summernote-id-ID.js"></script>
<script>
	$(document).ready(function() {
		$('#summernote').summernote({
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
        // data.append("ci_csrf_token", "");
        $.ajax({
            data: data,
            type: "POST",
            url: "<?php echo site_url('ajax/summernote_upload/'); ?>",
            cache: false,
            contentType: false,
            processData: false,
            success: function (url) {
                var image = url;
                $('#summernote').summernote("insertImage", image);
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
