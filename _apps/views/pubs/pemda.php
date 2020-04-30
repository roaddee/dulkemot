<?php 
$this->load->view('pubs/header');
$cur_url = current_url();
?>
			<!-- section start -->
			<!-- ================ -->
			<section class="clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-9">
							<div class=" section"></div>
							<h3><a class="logo-font" href="<?php echo $cur_url; ?>"><?php echo $wilayah;?></a>
							<span class="text-default"></span></h3>
							<div class="separator-2"></div>
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Ringkasan APBD <?php echo $wilayah;?></h3>
								</div>
								<div class="box-body">
									<?php 
			echo "
			<!-- grafik -->
				<div id=\"graph_container\" class=\"chart\" style=\"margin-bottom:2em;\"></div>
			<!-- /grafik -->
			
			<!-- tabular -->
			<table class=\"table table-bordered table-responsive datatables\">
			<thead><tr>
				<th>Kode Rekening</th>
				<th>Uraian</th>";

				$XAxis = "";
				$x=1;
				$xn=count($tahuns);
				
				foreach($tahuns as $tahun){
					$strKoma = ($x < $xn) ? ",":"";
					$XAxis .= "'".$tahun."' ".$strKoma;
					$x++;
					echo "<th>".$tahun."</th>";
				}
				echo "
			</tr></thead>
			<tbody>";
			$toGraph = array();
			$toPie = array();
			$nomer = 1;
			foreach($summary['data'] as $key=>$rs){
				
				echo "<tr>
				<td><a href=\"".site_url('apbd/pemda/'.$lembagaID.'/?r='.$rs['akuntansi'])."\">".$rs['akuntansi']."</a></td>
				<td><a href=\"".site_url('apbd/pemda/'.$lembagaID.'/?r='.$rs['akuntansi'])."\">".$rs['uraian']."</a></td>";
				$tg = 1;
				$nilai = "";
				foreach($tahuns as $tahun){
					$strKoma = ($tg < $xn)? ", ":"";

					if(array_key_exists($tahun, $summary['akun'])){
						if(array_key_exists($rs['akuntansi'],$summary['akun'][$tahun])){
							$rupiah = $summary['akun'][$tahun][$rs['akuntansi']];
						}else{
							$rupiah = 0;
						}
						
//						$rupiah = $summary['akun'][$tahun][$rs['akuntansi']];
						echo "<td class=\"angka\"><a href=\"".site_url('apbd/pemda/'.$lembagaID.'/?r='.$rs['akuntansi'].'&amp;y='.$tahun)."\">".number_format($rupiah,2)."</a></td>";
						$angka = ($rupiah > 0) ? ($rupiah / 1000000) : 0;
						$nilai .= number_format($angka,2,".","") . $strKoma;
						$tg++;

					}else{
						$rupiah = 0;
						echo "<td class=\"angka\">".number_format($rupiah,2)."</td>";
						$angka = ($rupiah > 0) ? ($rupiah / 1000000) : 0;
						$nilai .= number_format($angka,2,".","") . $strKoma;
						$tg++;
						
					}
					$toPie[$tahun][$rs['akuntansi']] = array('akun'=>$rs['akuntansi'],'uraian'=>$rs['uraian'],'nominal'=>$angka);
				}
				echo "
				</tr>";
				$toGraph[$rs["akuntansi"]] = array("nama"=>$rs["uraian"], "nilai"=>$nilai);
				$nomer++;
			}
			echo "
			</tbody>
			</table>

			<!-- tabular -->
			<!-- pie -->";
			if($pie){
				foreach($tahuns as $thn){
					echo "
					<div class=\"box box-primary\">
						<div class=\"box-header with-border\">
							<h3 class=\"box-title\">Grafik Distribusi Komponen Mata Anggaran Tahun <strong>".$thn."</strong></h3>
						</div>
						<div class=\"box-body\">
							<div class=\"chart\" id=\"pie_container_".$thn."\"></div>
						</div>
					</div>
					";
				}
			}
			echo "
			<!-- /pie -->";

									?>
								</div>
							</div>
							<div class="separator-2"></div>
<?php
if($tags_area){
	
	if(count($tags_area['apbd']) > 0){
		if(count($tags_area['tags']) > 1){
			echo "<div class=\"row\">";
			foreach($tags_area['tags'] as $key=>$item){
				echo "
				<div class=\"col-md-6\">
					<div class=\"box box-primary\">
						<div class=\"box-header with-border\">
							<h3 class=\"box-title\"><i class=\"fa fa-tag\"></i> Identifikasi Anggaran dalam Isu <strong>".$tags_area['tags'][$key]."</strong></h3>
						</div>
						<div class=\"box-body\">
							<table class=\"table table-responsive table-stripped\">
							<thead><tr><th>#</th>
								<th>Mata Anggaran/Lembaga</th><th>Nominal<br />(juta rupiah)</th>
							</tr></thead>
							<tbody>";
							$nomer = 1;
							foreach($tags_area['apbd'] as $rs){
								if($rs['tag_id'] == $key){
									echo "<tr><td class=\"angka\">".$nomer."</td>
										<td><a href=\"\">".$rs['uraian']." </a> ".$rs['tahun']."
										<br />&#8213; <a href=\"".site_url('institusi/opd/'.$rs['lembaga_id'].'/'.fixNamaUrl($rs['lnama']))."\">".$rs['lnama']."</a></td>
										<td class=\"angka\">".number_format($rs['nominal']/1000000)."</td>
									</tr>";
									$nomer++;
								}
							}
							echo "</tbody>
							</table>
							
						";
						
							//echo var_dump($tags_area['apbd']);
						echo "</div>
					</div>
				</div>
				";
					
			}
			echo "</div>";
		}else{
			echo "
			<div class=\"box box-primary\">
				<div class=\"box-header with-border\">
					<h3 class=\"box-title\"><i class=\"fa fa-tag\"></i> Identifikasi Anggaran dalam Isu <strong>".$tags_area['tags']."</strong></h3>
				</div>
				<div class=\"box-body\">
					<div class=\"chart\" id=\"pie_container_".$thn."\"></div>
				</div>
			</div>
			";

		}
		
	}
}


if(!$pie){
?>							
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Daftar Lembaga di <?php echo $wilayah;?></h3>
								</div>
								<div class="box-body text-center">
									<?php
									if(count($org) > 0){
										echo "
										<div class=\"row\">";
										foreach($org as $rs){
											echo "
											<div class=\"col-md-6 col-sm-12 col-xs-12\">
												<div class=\"box box-widget widget-user-2\">
													<!-- Add the bg color to the header using any of the bg-* classes -->
													<div class=\"widget-user-header bg-gray\">
														<a href=\"".site_url('institusi/opd/'.$rs['id'].'/'.fixNamaUrl($rs['nama']))."\">
														<div class=\"widget-user-image\">
															<img class=\"img-circle\" src=\"".$rs['logo']."\" alt=\"".$rs['nama']."\">
														</div>
														</a>
														<!-- /.widget-user-image -->
														<h3 class=\"widget-user-username\"><a href=\"".site_url('institusi/opd/'.$rs['id'].'/'.fixNamaUrl($rs['nama']))."\">".$rs['nama']."</a></h3>
														<h5 class=\"widget-user-desc\"><a href=\"".site_url('apbd/pemda/'.$rs['kodewilayah'].'/'.fixNamaUrl($rs['namawilayah']))."\">".$rs['namawilayah']."</a></h5>
													</div>
													<div class=\"box-footer no-padding\">
														<ul class=\"nav nav-pills\">";
															foreach($rs['apbd'] as $thn){
																echo "<li><a href=\"".site_url('institusi/opd/'.$rs["id"].'/'.fixNamaUrl($rs["nama"]).'/?thn='.$thn)."\">APBD ".$thn."</a></li>";
															}
															echo "
														</ul>
													</div>
												</div>
											
											</div>
											";
										}
										echo "
										</div>";
									}
									?>
								</div>
							</div>
							<div class="separator-2"></div>
<?php
}
?>
							<div class="box box-primary box-solid">
								<div class="box-header with-border">
									<h3 class="box-title text-white">Komentar melalui Facebook</h3>
								</div>
								<div class="box-body text-center">
									<div class="fb-comments" data-href="<?php echo $cur_url;?>" data-numposts="5"></div>
								</div>
							</div>
							<div class="separator-2"></div>
								
							<div class="box box-primary box-solid">
								<div class="box-header with-border">
									<h3 class="box-title text-white">Pemerintahan Daerah</h3>
								</div>
								<div class="box-body text-center">
									<div class="row">
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/34'); ?>"><img src="<?php echo base_url('assets/img/34.jpg'); ?>" class="img-rounded" />Prop. D I Yogyakarta</a>
										</div>
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/3401'); ?>"><img src="<?php echo base_url('assets/img/3401.jpg'); ?>" class="img-rounded" />Kab. Kulonprogo</a>
										</div>
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/3402'); ?>"><img src="<?php echo base_url('assets/img/3402.jpg'); ?>" class="img-rounded" />Kab. Bantul</a>
										</div>
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/3403'); ?>"><img src="<?php echo base_url('assets/img/3403.jpg'); ?>" class="img-rounded" />Kab. Gunungkidul</a>
										</div>
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/3404'); ?>"><img src="<?php echo base_url('assets/img/3404.jpg'); ?>" class="img-rounded" />Kab. Sleman</a>
										</div>
										<div class="col-md-2 col-sm-4 col-xs-6">
											<a href="<?php echo site_url('apbd/pemda/3471'); ?>"><img src="<?php echo base_url('assets/img/3471.jpg'); ?>" class="img-rounded" />Kota Yogyakarta	</a>
										</div>
									</div>
								</div>
							</div>
								
						</div>
						<div class="col-md-3 bg-blue-sky">
							<div class=" bg-blue-sky widget">
								
								<aside id="wg_embed" class="widget ">
									<div class="title-section clearfix">
										<h4 class="lead-title"><i class="fa fa-share-alt"></i> Bagikan Ke Jejaring Sosial</h4>
										<div class="white-line uk-clearfix"></div>
									</div>
									<div>
										<ul class="nav nav-pills">
											<!--linked in	-->
											<li><script type="IN/Share"></script></li>
											<!--Twitter 	-->
											<li><a class="twitter-share-button" href="<?php echo current_url(); ?>">Tweet</a></li>
											<li style="top: -2px;" id="fbshare"><div class="fb-share-button" 
												data-href="<?php echo current_url(); ?>" 
												data-layout="button" data-size="small">
											</div></li>
										</ul>
									</div>
								</aside>
								
								
								<aside id="wg_embed" class="widget ">
									<div class="title-section clearfix">
										<h4 class="lead-title"><i class="fa fa-paste"></i> Tempelkan di Web lain</h4>
										<div class="white-line uk-clearfix"></div>
									</div>
									<div>
										<p style="color:#444">Gunakan skrip berikut ini untuk memasang tautan dari situs web anda ke halaman ini:</p>
										<div  style="height:100px;width:100%;overflow:auto;background:#f5f5f5;color:" onclick="selectText('selectable')" id="selectable">
										<code>
											&lt;div style="border:solid 1px #ccc;border-radius:.5em;-webkit-box-shadow: 5px 6px 8px 0px #d8d8d8;box-shadow: 5px 6px 8px 0px #d8d8d8;background:#fff;color:#888;padding:1em;"&gt;&lt;a href="http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" target="_blank"&gt;&lt;img src="<?php echo base_url('/assets/img/oda-l.png');?>" alt="Open Data APBD" style="width:100%;margin:0;padding:0;margin-bottom:1em;"/&gt;&lt;span style="margin:0;padding:0;font-size:1.6em;font-weight:600;color:#888;line-height:1em;"&gt;Open Data APB <?php echo $pageTitle; ?>&lt;/span&gt;&lt;/a&gt;&lt;/div&gt;
										</code>
										</div>
										<br />pratayang:

											<div style="border:solid 1px #ccc;border-radius:.5em;-webkit-box-shadow: 5px 6px 8px 0px #d8d8d8;box-shadow: 5px 6px 8px 0px #d8d8d8;background:#fff;color:#888;padding:1em;"><a href="http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" target="_blank">
											<img src="<?php echo base_url('/assets/img/oda-l.png');?>" alt="Open Data APBD" style="width:100%;margin:0;padding:0;margin-bottom:1em;"/>
											<span style="margin:0;padding:0;font-weight:600;color:#888;line-height:1em;"><?php echo APP_TITLE;?></span></a></div>

											<script type="text/javascript">
													function selectText(containerid) {
															if (document.selection) {
																	var range = document.body.createTextRange();
																	range.moveToElementText(document.getElementById(containerid));
																	range.select();
															} else if (window.getSelection) {
																	var range = document.createRange();
																	range.selectNode(document.getElementById(containerid));
																	window.getSelection().addRange(range);
															}
													}
											</script>															
										
									</div>
								</aside>	
								
								<?php
								/*
								 * Identifikasi Program berbasis Isu
								 * 
								 * */
								echo "
								<aside id=\"post_tags\" class=\"widget\">
									<div class=\"title-section clearfix\">
										<h4 class=\"lead-title\"><i class=\"fa fa-tags\"></i> Identifikasi Isu</h4>
										<div class=\"white-line uk-clearfix\"></div>
									</div>
									<div>
										<ul class=\"nav nav-pills\">";
										foreach($tags as $key=>$rs){
											echo "
											<li><a href=\"".site_url('apbd/tags/'.$rs['id'].'/'.$rs['parma'])."\"><i class=\"fa fa-tag\"></i> ".$rs['nama']."</a></li>
											";
										}
										echo "
										</ul>
									</div>
								</aside>
								";								
								
								
								?>

								
								<!-- ARTIKEL/ANALISIS NANGKIS-->
								<?php
								if($posts){
									echo "
									<aside id=\"post_by_wilayah_".$kodewilayah."\" class=\"widget\">
										<div class=\"title-section clearfix\">
											<h4 class=\"lead-title\"><i class=\"fa fa-newspaper-o\"></i> Artikel Terkait</h4>
											<div class=\"white-line uk-clearfix\"></div>
										</div>
										<div>
											<ul class=\"list\">";
											foreach($posts as $key=>$rs){
												echo "
												<li><a href=\"\">".$rs['tahun']." : ".$rs['nama']."</a>
												<br />oleh <a href=\"\">".$rs['lembaga']."</a></li>
												";
											}
											echo "
											</ul>
										</div>
									</aside>
									";
								}
								?>
							</div>
							
<?php
if($pie){
?>							
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Daftar Lembaga di <?php echo $wilayah;?></h3>
								</div>
								<div class="box-body">
									<?php
									if(count($org) > 0){
										echo "
										<ul class=\"nav text-left\">";
										foreach($org as $rs){
											echo "
											<li><a href=\"".site_url('institusi/opd/'.$rs['id'].'/'.fixNamaUrl($rs['nama']))."\">".$rs['nama']."</a></li>";
										}
										echo "
										</div>";
									}
									?>
								</div>
							</div>
<?php
}
?>							
						</div>
					</div>
				</div>
			</section>
			<!-- section end -->
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

<!--Highchart.js-->
<script type="text/javascript" src="<?php echo base_url("assets/plugins/"); ?>highcharts/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/plugins/"); ?>highcharts/highcharts-3d.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/plugins/"); ?>highcharts/modules/exporting.js"></script>

<!--Highchart.js Thems-->
<script type="text/javascript" src="<?php echo base_url("assets/plugins/"); ?>highcharts/themes/sand-signika.js"></script>

<script>
	
$(document).ready(function() {
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
	});
	
	
	<?php
	
	if($summary){
		?>
			$('#graph_container').highcharts({
				chart: {
						type: 'column',
						options3d: {
								enabled: true,
								alpha: 15,
								beta: 15,
								viewDistance: 25,
								depth: 40
						}
				},
				title: {
						text: 'Anggaran Pendapatan dan Belanja <?php echo  $rekening." - ".$wilayah;?>'
				},
				yAxis: {
					min: 0, 
					title: {text: 'Nominal (dlm Juta Rupiah)'},
				},
				xAxis: {
						categories: [<?php echo $XAxis; ?>]
				},
				tooltip:{
					crosshairs: [false, true],
				},
				plotOptions: {
						column: {
								depth: 40
						}
				},
				series: [
				<?php
				$tg = 1;
				$ntg = count($toGraph);
				foreach($toGraph as $key=>$item){
					$strComma = ($tg < $ntg)? ", ":"";
					echo "{
						name: '".$item["nama"]."',
						data: [".$item["nilai"]."],
					}".$strComma;
					$tg++;
				}
				?>]
			});		
		<?php

		if($pie){
			foreach($tahuns as $thn){
				?>
				Highcharts.chart('pie_container_<?php echo $thn;?>', {
						chart: {
								type: 'pie',
								options3d: {
										enabled: true,
										alpha: 45,
										beta: 0
								}
						},
						title: {
								text: 'Komponen Penyusun <?php echo $rekening ." ". $thn; ?>'
						},
						tooltip: {
								pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						plotOptions: {
								pie: {
										allowPointSelect: true,
										cursor: 'pointer',
										depth: 35,
										dataLabels: {
												enabled: true,
												format: '{point.name}'
										}
								}
						},
						series: [{
								type: 'pie',
								name: 'Browser share',
								data: [
									<?php 
									//echo var_dump($toPie[$thn]);
									$n = count($toPie[$thn]);
									$i=1;
									foreach($toPie[$thn] as $key=>$item){
										$strKoma = ($i < $n) ? ",":"";
										echo "['".$item['uraian']."',".$item['nominal']."]".$strKoma;
										$i++;
									}
									?>
								]
						}]
				});
				<?php
			}
		}
	}
	?>
	
});	
</script>			
<?php 
$this->load->view('pubs/footer');
