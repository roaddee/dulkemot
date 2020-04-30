<?php 
$this->load->view('pubs/header');
$cur_url = current_url();
?>
			<!-- section start -->
			<!-- ================ -->
			<section class="clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<div class=" section">
<!-- Rangkuman -->								
<?php
								echo "
								<a href=\"".$cur_url."/semua\" class=\"btn btn-primary pull-right\">Tampilkan Detail APBD <i class=\"fa fa-th-list\"></i></a>
								<h2><a class=\"logo-font\" href=\"".site_url('institusi/opd/'.$lembaga['id'].'/'.fixNamaUrl($lembaga['nama']).'/')."\">".$lembaga['nama'] ."</a></h2>
								<h4><a  class=\"sublogo-font\" href=\"".site_url('apbd/pemda/'.$lembaga['kodewilayah'])."\">".$lembaga['namawilayah'] ."</a>
								</h4>
								";
//echo var_dump($summary);

if($summary){
	echo "
	<div class=\"box box-default\">
		<div class=\"box-header with-border\"><h3 class=\"box-title\">".$rekenin_title."</h3></div>
		<div class=\"box-body\">
			<!-- grafik -->
				<div id=\"graph_container\" class=\"chart\"></div>
			<!-- /grafik -->
			
			<!-- tabular -->
			<table class=\"table table-bordered table-responsive datatables\">
			<thead><tr><th style=\"width:30px;\">#</th>
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
				
				echo "<tr><td class=\"angka\">".$nomer."</td>
				<td><a href=\"".site_url('institusi/opd/'.$lembaga['id'].'/'.fixNamaUrl($lembaga['nama']).'/?r='.$rs['akuntansi'])."\">".$rs['akuntansi']."</a></td>
				<td><a href=\"".site_url('institusi/opd/'.$lembaga['id'].'/'.fixNamaUrl($lembaga['nama']).'/?r='.$rs['akuntansi'])."\">".$rs['uraian']."</a></td>";
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

						$angka = ($rupiah > 0) ? ($rupiah / 1000000) : 0;
						echo "<td class=\"angka\"><a href=\"".site_url('institusi/opd/'.$lembaga['id'].'/'.fixNamaUrl($lembaga['nama']).'/?r='.$rs['akuntansi'].'&amp;y='.$tahun)."\">".number_format($angka,2)."</a></td>";
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
			<!-- /pie -->
			
			

		</div>
	</div>
	";	
}


if($programs){
	echo "
	<div class=\"\">
		<div class=\"box box-default\" id=\"box-program\">
			<div class=\"box-header with-border\"><h3 class=\"box-title\">Daftar Program</h3>
				<div class=\"box-tools\">
					<button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-minus\"></i></button>
				</div>
			</div>
			<div class=\"box-body\">
			
				<ul class=\"nav nav-tabs\">";
					$i = 0;
					foreach($tahuns as $tahun){
						$strActive = ($i == 0) ? "class=\"active\"":"";
						echo "<li ".$strActive."><a href=\"#tab".$tahun."\" data-toggle=\"tab\">".$tahun."</a></li>";
						$i++;
					}
					echo "
				</ul>
				<div class=\"tab-content clearfix\">";
					$i = 0;
					foreach($tahuns as $tahun){
						$strActive = ($i == 0) ? "active":"";
						echo "
						<div class=\"tab-pane ".$strActive."\" id=\"tab".$tahun."\">";
						if(is_array($programs)){
							if($programs[$tahun]){
								echo "
									<table class=\"table table-bordered icheck table-responsive datatables\">
									<thead><tr>
										<th>&nbsp;</th>
										<th>Kode Program</th>
										<th>Nama Program</th>
										<th>Nominal</th>
									</tr></thead>
									<tbody>";
								//echo var_dump($programs[$tahun]);
								$prev_pro = "";
								foreach($programs[$tahun] as $k=>$rs){
										$prev_pro = ($prev_pro == $rs["kode_program"]) ? "":$rs["kode_program"];
										echo "
										<tr>
										<td><input type=\"checkbox\" id=\"checkall_".$i."\" class=\"iCheck cb2check\" name=\"program_kode[]\" value=\"".$rs["kode_program"]."\" /></td>
										<td><a href=\"?code=3&amp;kode=".$rs["rekening_kode"]."\">".$prev_pro."</a> </td>
										<td><a href=\"?code=3&amp;kode=".$rs["rekening_kode"]."\">".$rs["uraian"]."</a></td>
										<td class=\"angka\">".number_format($rs['nominal'],2)."</td>
										</tr>";
										$prev_pro = $rs["kode_program"];
								}
									echo "
									</tbody>
								</table>";

							}
						}
						$i++;
						/*	
						$strSQL = "
							SELECT rekening_kode,kode_program,uraian,tahun,nominal 
								FROM tweb_apbd 
							WHERE ((kode_program > 0) AND (lembaga_id='".$id."') AND (tahun='".$tahun."')) 
							GROUP BY kode_program ORDER BY kode_program
							";
						if($db->Query($strSQL)){
							if($db->RowCount() > 0){
								$db->MoveFirst();
								echo "
								<form action=\"?\" method=\"POST\" name=\"form\" class=\"formular\">
									<table class=\"table table-bordered icheck\">
									<thead><tr>
										<th>&nbsp;</th>
										<th>Kode Program</th>
										<th>Nama Program</th>
										<th>Nominal</th>
									</tr></thead>
									<tbody>";
									
									// <input type=\"checkbox\" id=\"checkall\" name=\"cathn\" value=\"".$tahun."\" class=\"iCheck\" />
									$i = 0;
									while (!$db->EndOfSeek()){
										$rs = $db->RowArray();
// 															<td>".$rs['tahun']."</td>
										echo "
										<tr>
										<td><input type=\"checkbox\" id=\"checkall_".$i."\" class=\"iCheck cb2check\" name=\"program_kode[]\" value=\"".$rs["kode_program"]."\" /></td>
										<td><a href=\"?code=3&amp;kode=".$rs["rekening_kode"]."\">".str_pad($rs["kode_program"],3,0,STR_PAD_LEFT)."</a></td>
										<td><a href=\"?code=3&amp;kode=".$rs["rekening_kode"]."\">".$rs["uraian"]."</a></td>
										<td class=\"angka\">".number_format($rs['nominal'],2)."</td>
										</tr>";
										$i++;
									}
									echo "
									</tbody>
								</table>";
							}
						}
						*/
						echo "</div>	"; 
					}
				echo "
				</div>
			</div>
		</div>
		</div>
				";
}
?>
<!-- /Rangkuman -->								

<?php

if($semua){
		echo var_dump($apbd);
		echo "
		<div class=\"box box-default\" id=\"box-program\">
			<div class=\"box-header with-border\"><h3 class=\"box-title\">Detail APBD </h3>
			<div class=\"box-tools\">
				<button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-minus\"></i></button>
			</div>
			</div>
			<div class=\"box-body\">
				<table class=\"table table-bordered table-responsive datatables\">
					<thead>
					<tr class=\"tengah\">
						<th rowspan=\"2\" class=\"visibel\">#</th>
						<th rowspan=\"2\" class=\"visibel\"></th>
						<th rowspan=\"2\" class=\"visibel\">KODE REKENING</th>
						<!--
						<th rowspan=\"2\" class=\"visibel\">KODE AKUNTANSI</th>
						-->
						<th rowspan=\"2\" class=\"visibel\">URAIAN</th>";
						
						$apbd = array();
						$apbd_to_graph = array();
						$XAxis = "";
						$x = 1;
						$xn = count($apbd_tahun);
						$rekening_pendek = 20;
						/*
						foreach($apbd_tahun as $item){
							$strKoma = ($x < $xn) ? ",":"";
							$XAxis .= "'".$item."'".$strKoma;
							$x++;
							
							echo "<th colspan=\"2\">TAHUN ".$item."</th>";
							
							$strSQL = "SELECT rekening_kode,rekening,akuntansi,nominal,nominal_sebelum, nominal_sesudah,nominal_perubahan,nominal_persen,keterangan  
							FROM tweb_apbd WHERE ((lembaga_id=".$id.") AND (tahun='".$item."'))";
							if($db->Query($strSQL)){
								if($db->RowCount() > 0){
									$db->MoveFirst();
									while (!$db->EndOfSeek()){
										$rs = $db->RowArray();
										$rekening_pendek = (strlen($rs["rekening"]) < $rekening_pendek) ? strlen($rs["rekening"]) : $rekening_pendek;
										$apbd[$item][$rs["rekening_kode"]] = array(
												"rekening" => $rs["rekening"],
												"akuntansi" => $rs["akuntansi"],
												"nominal" => $rs["nominal"],
												"sebelum" => $rs["nominal_sebelum"],
												"sesudah" => $rs["nominal_sesudah"],
												"perubahan" => $rs["nominal_perubahan"],
												"persen" => $rs["nominal_persen"],
												"keterangan" => $rs["keterangan"],
											);
									}
								}
							}else{
								echo $db->Error();
							}	
						}
						*/ 
						
						echo "
					</tr>
						<tr>";
						foreach($tahuns as $item){
							echo "<th>NOMINAL</th><th>KETERANGAN</th>";
						}
						echo "</tr>
					</thead>
					<tbody>";
					$nomer = 1;
					$toGraph = array();
					foreach($apbd['rekening'] as $key=>$item){
						echo "
						<tr id=\"baris".$nomer."\">
							<td class=\"angka\">".$nomer."</td>
							<td style=\"min-width:60px;\">
								<div class=\"btn-group\">
									<a href=\"?rek=".$item["rekening_kode"]."\" class=\"btn btn-default btn-xs\"><i class=\"fa fa-bar-chart\"></i></a>
								</div>
							</td>
							<!--
							<td><a href=\"?rek=".$item["rekening_kode"]."\">".$item["rekening_kode"]."</a></td>
							-->
							<td><a href=\"?rek=".$item["rekening_kode"]."\">".$item["rekening_kode"]."</a></td>
							<td><a href=\"?rek=".$item["rekening_kode"]."\">".$item["nama"]."</a></td>";
						$nilai = "";	
						$tg = 1;
						$ntg = count($tahuns);
						foreach($tahuns as $tahun){
							if(array_key_exists($key,$apbd[$tahun])){
								$rupiah = $apbd[$tahun][$key]["nominal"];
								$keterangan = $apbd[$tahun][$key]["keterangan"];
							}else{
								$rupiah = 0;
								$keterangan = "";
							}
							$strKoma = ($tg < $ntg)? ", ":"";

							$keterangan = str_replace(chr(10), "</p><p>", $keterangan);
							$keterangan = str_replace(chr(13), "</p><p>", $keterangan);
							echo "<td class=\"angka\">".number_format($rupiah,2)."</td>
							<td><p>".$keterangan."</p></td>";
							$angka = ($rupiah > 0) ? ($rupiah / 1000000) : 0;
							$nilai .= number_format($angka,2,".","") . $strKoma;
							$tg++;
						}
							echo "
						</tr>
						";
						if(strlen($key) == $rekening_pendek){
							$toGraph[$key] = array("nama"=>$item, "nilai"=>$nilai);
						}
						$nomer++;
					}
					echo "
					</tbody>
				</table>
			</div>
		</div>		
		";	
}

?>
								
							</div>

								
						</div>
						<div class="col-md-4 bg-blue-sky">
							<?php 
								$this->load->view('pubs/sidebar_institusi');
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

// Make monochrome colors and set them as default for all pies
Highcharts.getOptions().plotOptions.pie.colors = (function () {
    var colors = [],
        base = Highcharts.getOptions().colors[0],
        i;

    for (i = 0; i < 10; i += 1) {
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
    }
    return colors;
}());
	
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
						text: 'Anggaran Pendapatan dan Belanja <?php echo $rekening." - ".$lembaga["nama"];?>'
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
