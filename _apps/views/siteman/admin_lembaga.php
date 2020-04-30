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
			<?php echo $pageTitle;?>
			<small>Panel Admin</small>	
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
							<h3 class="box-title"><?php echo $boxTitle;?></h3>
						</div>
						<div class="box-body">
					<?php 
					if($id  >0){
								$file_foto = (strlen($pengguna['foto']) > 0 )? 'assets/uploads/'.str_replace(".","-m.",$pengguna['foto']):'assets/img/nophoto.png';
								if(is_file($file_foto)){
									$foto = "<img src=\"".base_url($file_foto)."\" />";
								}else{
									$foto = "<img src=\"".base_url('assets/img/nophoto.png')."\" />";
								}
								echo "
								<table class=\"table table-responsive\">
									<tr><td style=\"width:30%\"></td><td>".$foto."</td></tr>
									<tr><td style=\"width:30%\">Nama</td><td>".$pengguna['nama']."</td></tr>
									<tr><td style=\"width:30%\">Surel/Email</td><td>".$pengguna['email']."</td></tr>
									<tr><td style=\"width:30%\">No Telp</td><td>".$pengguna['telp']."</td></tr>
									<tr><td style=\"width:30%\">No Faximili</td><td>".$pengguna['telp']."</td></tr>
									<tr><td style=\"width:30%\">Website</td><td>".$pengguna['url']."</td></tr>
									<tr><td style=\"width:30%\">Profil</td><td>".$pengguna['ndesc']."</td></tr>
									<tr><td style=\"width:30%\">Data APBD</td><td><a href=\"".site_url('olahdata/apbd/'.$pengguna['id'])."\">Klik disini untuk mengelola data APBD</a></td></tr>
								</table>
								";
					}else{
						echo "
						<table class=\"table table-bordered datatables\">
						<thead><tr><th>#</th>
							<th>Kode</th>
							<th>Nama Lembaga</th>
							<th>Pemerintah Daerah</th>
							<th>Jumlah Pengguna</th>
							<th style=\"min-width:70px;\"></th>
						</tr></thead>
						<tbody>
						";
						$nomer = 1;
						foreach($pengguna as $key=>$item){
							echo "<tr><td class=\"angka\">".$nomer."</td>
							<td><a href=\"".site_url('admin/lembaga/').$item['id']."\">".$item['kode_org']."</a></td>
							<td><a href=\"".site_url('admin/lembaga/').$item['id']."\">".$item['nama']."</a></td>
							<td>".$item['namawilayah']."</td>
							<td class=\"angka\"><a href=\"".site_url('admin/lembaga/'.$item['id'].'/#user')."\">".$item['nuser']."</a></td>
							<td><div class=\"btn-group\">
								<a class=\"btn btn-xs btn-default\" href=\"".site_url('admin/lembaga/'.$item['id'].'/ubah')."\"><i class=\"fa fa-pencil\"></i></a>
								<a class=\"btn btn-xs btn-danger\" href=\"".site_url('admin/lembaga/'.$item['id'].'/hapus')."\"><i class=\"fa fa-trash\"></i></a>
							</div></td>
							</tr>";
							$nomer++;
						}
						echo "
						</tbody>
						</table>
						";
					}
					// echo var_dump($pengguna);
					?>
							
						</div>
						<div class="box-footer">
							<div class="btn-group  pull-right">
							<a class="btn btn-default" href="<?php echo site_url('admin/lembaga/')?>"><i class="fa fa-th-list"></i> Daftar Lembaga</a>
							<a class="btn btn-primary" href="<?php echo site_url('admin/lembaga/0/baru')?>"><i class="fa fa-plus"></i> Tambah Data Lembaga</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-life-buoy"></i> Pengelolaan Data Lembaga</h3>
						</div>
						<div class="box-body">
							
							<table class="table">
								<thead><tr>
									<th>Icon</th>
									<th>Keterangan</th>
								</tr></thead>
								<tbody>
									<tr><td><i class="fa fa-pencil"></i></td>
										<td>Link/tautan untuk mengubah data</td></tr>
									<tr><td><i class="fa fa-trash"></i></td>
										<td>Link/tautan menghapus data pada baris bersangkutan.</td></tr>
									<tr><td><i class="fa fa-user-plus"></i></td>
										<td>Link/tautan menambah data pengguna baru</td></tr>
									<tr><td><i class="fa fa-th-list"></i></td>
										<td>Biasa digunakan pada tombol menuju tautan daftar/indek dari halamannya</td></tr>
								</tbody>
							</table>							
							
						</div>
					</div>

				</div>
			</div>
		</section>
	</div>
<!-- footer section -->

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

	/*
	DataTables
	*/
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
});
</script>

<?php

$this->load->view('siteman/siteman_footer');
