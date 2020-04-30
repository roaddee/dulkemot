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
							<h3 class="box-title"><i class="fa fa-filter"></i> <?php echo $boxTitle;?></h3>
						</div>
						<div class="box-body">
							
							<div class="box box-widget widget-user-2">
								<!-- Add the bg color to the header using any of the bg-* classes -->
								<div class="widget-user-header bg-yellow">
									<div class="widget-user-image">
										<img class="img-circle" src="<?php echo $org['logo']; ?>" alt="<?php echo $org['nama']; ?>">
									</div>
									<!-- /.widget-user-image -->
									<input type="hidden" id="org_id" value="<?php echo $org['id']."__".$tahun; ?>">
									<h3 class="widget-user-username"><?php echo $org['nama']; ?></h3>
									<h5 class="widget-user-desc"><?php echo $org['namawilayah']; ?></h5>
								</div>
								<div class="box-footer no-padding">
									<!--
									<ul class="nav nav-stacked">
										<li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
										<li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
										<li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
										<li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
									</ul>
									-->
								</div>
							</div>
							<!-- /.widget-user -->
							
							
						</div>
					</div>
					
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title"><i class="fa fa-institution fa-fw"></i> Pilih Lembaga</h3>
						</div>
						<div class="box-body">
							<form action="<?php echo $form_action; ?>" method="POST" class="formular" role="form">
								<div class="form-group">
									<label class="control-label" for="wilayah">Cari Lembaga</label>
									<input type="text" name="lembaga_id" class="form-control select2-remote" id="lembaga_id"/>
								</div>
								<div class="form-group">
									<label class="control-label" ></label>
									<input type="hidden" name="sebutan" value="kelurahan">
									<button type="submit" class="btn btn-primary"><i class="fa fa-gear"></i> Olah Data</button>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
			
			<div class="">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
						<?php
						if(count($tahuns) > 0){
							
							if(count($tahuns) >= 3){
								for($i=0; $i<2; $i++){
									$strA = ($tahuns[$i] == $tahun)  ? "class=\"active\"":"";
									echo "<li ".$strA."><a href=\"".site_url('olahdata/apbd/'.$org['id'].'/'.$tahuns[$i])."\">".$tahuns[$i]."</a></li>";
								}
								
								echo "
									<li class=\"dropdown\">
										<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
											Tahun sblmnya <span class=\"caret\"></span>
										</a>
										<ul class=\"dropdown-menu\">";
										for ($i=2;$i < count($tahuns); $i++){
											echo "<li><a href=\"".site_url('olahdata/apbd/'.$org['id'].'/'.$tahuns[$i])."\">".$tahuns[$i]."</a></li>";
										}
										
										echo "
										</ul>
									</li>
								";
								
							}else{
								foreach($tahuns as $thn){
									$strA = ($thn == $tahun)  ? "class=\"active\"":"";
									echo "<li ".$strA."><a href=\"".site_url('olahdata/apbd/'.$org['id'].'/'.$thn)."\">".$thn."</a></li>";
								}
							}
						}
						
						?>
						<li class="pull-left header"><a href=""><i class="fa fa-th"></i> <?php echo $org['nama'] ." - ".$org['namawilayah'] ." Tahun <strong class=\"text-blue\">".$tahun;?></strong></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_<?php echo $tahun; ?>">
							<?php
							$r = explode(".",$varRek);

							echo "
							<div>
								<ol class=\"breadcrumb\">
									<li><a href=\"".$url."/?\"><i class=\"fa fa-home\"></i></a></li>";
									if(count($r) > 1){
										$rn = "";
										foreach($r as $ra){
											$rn .= $ra .".";
											if(strlen($ra) >= 3){
												echo "<li><a href=\"".$url."/?r=".$rn."\">".$rn."</a></li>";
											}
										}
									}
									echo "
									
								</ol>
							</div>";
							if($apbd){
								
								if(count($apbd['berkas']) > 0){
									echo "<div class=\"box box-primary\">
										<div class=\"box-header with-border\">
											<h3 class=\"box-title\"><i class=\"fa fa-file-o\"></i> Berkas Terunggah</h3>
										</div>
										<div class=\"box-body\">
										<table class=\"table table-bordered table-responsive\">
										<thead><tr><th>#</th>
											<th>Nama Berkas</th>
											<th>Tgl Unggah</th>
											<th>Diunggah dari</th>
											<th>Diunggah Oleh</th>
											<th>&nbsp;</th>
										</tr></thead>
										<tbody>
										";
										$nomer = 1;
										foreach($apbd['berkas'] as $key=>$berkas){
											echo "<tr><td class=\"angka\">".$nomer."</td>
												<td>".$berkas['nasli']."</td>
												<td>".date("j F Y H:i",strtotime($berkas['nasli']))."</td>
												<td>".$berkas['uploaded_from']."</td>
												<td>".$berkas['unama']."</td>
												<td><div class=\"btn-group\">
													<a class=\"btn btn-default btn-xs\" href=\"".site_url('apbd/unduhfile/'.$key.'')."\"><i class=\"fa fa-download\"></i></a>";
													if($user['tingkat'] <= 3 ){
														echo "<a class=\"btn btn-danger btn-xs\" 
														href=\"".site_url('apbd/filehapus/').$key."\"><i class=\"fa fa-trash\"></i></a>";
													}
													echo "
													</div>
												</td>
											</tr>";
											$nomer++;
										}
										echo "	
										</tbody>
										</table>
										</div>
									</div>";
								}
								
								//substr($varRek,0,strrpos($varRek,".",-2))
								// echo "<h1>".$varRek."x".strrpos($varRek,".",-2)."</h1>";
								/*
								$r = (strlen($varRek) > strrpos($varRek,".",-1)) ? substr($varRek,0,strrpos($varRek,".",-1)):"";
								if($r > 1){
								}
								*/
								
								echo "
								<table class=\"table table-bordered table-responsive datatables\">
								<thead><tr>
									<th style=\"width:30px;\">#</th>
									<th>Kode Rekening</th>
									<th>Uraian</th>
									<th>Nominal</th>
									<th style=\"width:50%;min-width:75px\">Tags</th>
								</tr></thead>
								<tbody>";
								$nomer = 1;
								foreach($apbd['data'] as $key=>$rs){
									echo "<tr>
									<td class=\"angka\">".$nomer."</td>
									<td><a href=\"".$url."/?r=".$rs['akuntansi']."\">".$rs['akuntansi']."</a></td>
									<td>".$rs['uraian']."</td>
									<td class=\"angka\">".number_format($rs['nominal'],2)."</td>
									<td>
										<form action=\"".site_url('olahdata/simpan_apbd_tags/'.$rs['id'].'/'.$org['id'].'/'.$tahun.'/'.$org['kodewilayah'])."\" method=\"POST\">
											<div class=\"input-group\">
												<select name=\"tags[]\" multiple=\"multiple\" class=\"form-control select-tags\">";
													foreach($list_tags as $key=>$tag){
														$strS = (array_key_exists($key,$apbd_tags[$rs['id']]))? "selected=\"selected\"":"";
														echo "<option value=\"".$key."\" ".$strS.">".$tag."</option>";
													}
													echo "
												</select>
												<div class=\"input-group-btn\">
													
													<button type=\"submit\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
												</div><!-- /btn-group -->
											</div><!-- /input-group -->
										</form>
									</td>
									</tr>";
									$nomer++;
									/*
									 * 
									 * 
									<th>Kode Program</th>
									<th>Kode Kegiatan</th>
									
									<td>".$rs['kode_program']."</td>
									<td>".$rs['kode_kegiatan']."</td>

									<th>Kode Kegiatan</th>
									<th style=\"min-width:75px\"></th>
									<td><div class=\"btn-group\" rel=\"".$rs['kode_program']."\">".$btn_pro_nangkis."</div></td>
									<td><div class=\"btn-group\" rel=\"".$rs['kode_kegiatan']."\">".$btn_kg_nangkis."</div></td>
									*/

									/*
									$strID = $org['id']."__".$rs['id']."__".$rs['kode_program']."__".$rs['kode_kegiatan'];
									
									$btn_pro_nangkis = "<button id=\"pro__add__".$strID."\" class=\"btn btn-default btn-xs btn_pro\"><i class=\"fa fa-check\"></i></button>";
									if($rs['nangkis_pro'] == 1){
										$btn_pro_nangkis = "
											<button id=\"pro__stat_".$strID."\" class=\"btn btn-primary btn-xs btn_pro\"><i class=\"fa fa-check\"></i></button>
											<button id=\"pro__rem__".$strID."\" class=\"btn btn-default btn-xs btn_pro\"><i class=\"fa fa-minus\"></i></button>
											";
									}
									$btn_kg_nangkis = "<button id=\"kg__add__".$strID."\" class=\"btn btn-default btn-xs btn_pro\"><i class=\"fa fa-check\"></i></button>";
									if($rs['nangkis_giat'] == 1){
										$btn_kg_nangkis = "
											<button id=\"kg__stat_".$strID."\" class=\"btn btn-success btn-xs btn_pro\"><i class=\"fa fa-check\"></i></button>
											<button id=\"kg__rem__".$strID."\" class=\"btn btn-default btn-xs btn_pro\"><i class=\"fa fa-minus\"></i></button>
											";
									}
									*/


								}
								echo "
								</tbody>
								</table>";
							}else{
								echo "
								<div class=\"callout callout-danger\">
									<h4>Data TIDAK BISA DITAMPILKAN</h4>
									<p>Maaf, data yang anda inginkan tidak bisa ditampilkan disini, karena ketidaktersediaan data tersebut.</p>
								</div>
								";
							}

							?>
						</div>
					</div><!--/.tabs-content-->
				</div><!--/.nav-tabs-custom-->
				
			</div>
			
		</section>
	</div>
<!-- footer section -->
<!-- Select2 -->
<link href="<?php echo base_url("assets/plugins/"); ?>select2/select2.css" rel="stylesheet" type="text/css"/>
<!-- Select2 -->
<script src="<?php echo base_url("assets/plugins/"); ?>select2/select2.min.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>select2/select2_locale_id.js"></script>
<!-- DataTables CSS -->
<link href="<?php echo base_url("assets/plugins/"); ?>datatables/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url("assets/plugins/"); ?>datatables/buttons/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
<!-- Datatables-->
<script src="<?php echo base_url("assets/plugins/"); ?>datatables/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>datatables/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>datatables/buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>jszip/jszip.min.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>datatables/buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>datatables/buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url("assets/plugins/"); ?>datatables/buttons/js/buttons.colVis.min.js"></script>
<script>
	
$(document).ready(function() {
		$('button.btn_pro').click(function(e){
			var r = $(this).closest('div').attr('class');
			var x = $(this).closest('div[class='+ r +']');
			var d=$(this).attr('id');
			e.preventDefault();
			$.ajax({
					type: "POST",
					url: "<?php echo site_url('olahdata/check_nangkis')?>",
					data: { 
							id: d, // < note use of 'this' here
							access_token: $("#org_id").val() 
					},
					success: function(result) {
						x.html(result);
					},
					error: function(result) {
							alert('error');
					}
			});

			
		});
		
    $('table.datatables').DataTable( {
				"language": {
                "url": "<?php echo base_url("assets/plugins/"); ?>datatables/datatables_ID.js"
            },
        dom: 'Bfrtip',
        buttons: [
					'excelHtml5',
					'csvHtml5',
					{extend: 'pdfHtml5',
						orientation: 'landscape',
						pageSize: 'A4'
					},
					'print',
					{
						extend: 'colvis',
						columns: ':gt(2)'
					}
        ]
    } );

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

		$(".select-tags").select2();
		
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

/*
 * 
 * 
		var $tag = $('input.tags');
		if($tag){
			$tag.select2({tags:<?php echo json_encode($tags);?>});
		}
*/
