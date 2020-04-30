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
			Olah Data
			<small>| <?php echo APP_TITLE;?></small>
			</h1>
			<ol class="breadcrumb">
			<li><a href="<?php echo site_url('siteman')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Olah Data</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-8 col-sm-6 col-xs-12">
					
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-tag"></i> <?php echo $boxTitle;?></h3>
						</div>
						<div class="box-body">
							<?php
							
							if($rs){
							}
							
							?>
							
						</div>
					</div>
					
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-tags fa-fw"></i> Tags</h3>
						</div>
						<div class="box-body">
							<?php
							if(@$_SESSION['strMsg']){
								echo "
								<div class=\"alert alert-".$_SESSION['strMsg']['stat']."\">
									".$_SESSION['strMsg']['msg']."
								</div>
								";
								$_SESSION['strMsg'] = "";
							}
							
							?>

							<fieldset class="kotak">
								<legend>Daftar Tags</legend>
								<div>
								<?php 
								echo "<ul class=\"nav nav-pills\">";
								foreach($tags as $key=>$tag){
									echo "<li><a href=\"".site_url('olahdata/tags/'.$key.'/'.$tag['parma'])."\"><i class=\"fa fa-tag\"></i> ".$tag['nama']."</a></li>";
								}
								echo "</ul>";
								?>
								</div>
							</fieldset>
							<fieldset class="kotak">
								<legend>Formulir Penulisan Tags Baru</legend>
								<div>
								<form action="<?php echo $form_action_tag;?>" method="POST" class="formular">
									<div class="form-group">
										<label class="form-label">Tag</label>
										<input type="text" name="tag[nama]" class="form-control" id="tag" placeholder="Tuliskan tags disini" />
									</div>
									<div class="form-group">
										<label class="form-label">Keterangan</label>
										<textarea name="tag[ndesc]" class="form-control" id="tagdesc" placeholder="Tuliskan keterangan disini"></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
									</div>
								</form>
								</div>
							</fieldset>
						</div>
					</div>

					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title"><i class="fa fa-info fa-fw"></i> Olah Data</h3>
						</div>
						<div class="box-body">
							<ul>
								<li>Dobelklik pada data untuk mengubah data</li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</section>
	</div>
<!-- footer section -->

<!-- Select2 -->
<link href="<?php echo base_url("assets/plugins/"); ?>select2/select2.css" rel="stylesheet" type="text/css"/>
<!-- Select2 -->
<script src="<?php echo base_url("assets/plugins/"); ?>select2/select2.min.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>select2/select2_locale_id.js"></script>

<script>
	$(document).ready(function() {
		$(".select2-remote" ).select2({
			placeholder: "Cari Data Lembaga dengan menuliskan nama lembaganya",
			minimumInputLength: 3,
			// instead of writing the function to execute the request we use Select2's convenient helper
			ajax: {
				url: "<?php echo site_url("ajax/"); ?>lembaga/",
				dataType: "json",
				quietMillis: 250,
				data: function( term, page ) {
					return {
						// search term
						q: term
					};
				},
				results: function( data, page ) {
						// parse the results into the format expected by Select2.
						// since we are using custom formatting functions we do not need to alter the remote JSON data
						return { results: data.items };
				},
				cache: true
			},
			formatResult: repoFormatResult,
			formatSelection: repoFormatSelection,  // omitted for brevity, see the source of this page
			dropdownCssClass: "bigdrop",
			escapeMarkup: function( m ) {
				return m;
			}
		});
		$("#reset").click(function(){
			$("#p_cari").removeClass("hidden");
			$("#detail_rtm").addClass("hidden");
			
		});
	});

	function repoFormatResult( repo ) {

		var markup = "<div class='select2-result-repository clearfix'>" +
			"<div class='select2-result-repository__meta'>" +
				"<div class='select2-result-repository__title'>" + repo.nama + " - "+ repo.wnama + "</div>"+
			"</div></div>";
		return markup;
	}

	function repoFormatSelection(repo) {
		return repo.nama + " - " + repo.wnama;
	}

</script>
<?php

$this->load->view('siteman/siteman_footer');
