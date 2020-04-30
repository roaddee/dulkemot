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
							<?php 
							if($msg){
								echo "
								<div class=\"alert alert-".$msg['alert']." alert-dismissable\">
									<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
									<h4><i class=\"fa fa-check\"></i> ".$msg['msg']."</h4>
								</div>";
							}
							if($posts){
								if(count($posts) > 0){
									echo "
									<table class=\"table table-responsive table-bordered table-striped\"><thead><tr>
										<th>#</th><th>Judul Halaman
										<br />Tautan</th>
										<th>Penulis</th>
										<th>Status</th><th></th>
									</tr></thead>
									<tbody>";
									$i=1;
									foreach($posts as $key=>$post){
										$post_url = site_url('publik/laman/'.$post['ID']);
										echo "<tr><td class=\"angka\">".$i."</td>
										<td><a href=\"".$post_url."\" target=\"_blank\" style=\"display:block\">".$post["post_title"]."</a>
										".site_url("/publik/laman/".$post["post_name"]."")."
										</td>
										<td>".$post["unama"]."</td>
										<td>".$post["post_status"]."</td>
										<td><div class=\"btn-group\">
											<a class=\"btn btn-default btn-xs\" href=\"".site_url("admin/laman_edit/".$post["ID"]."/")."\"><i class=\"fa fa-edit\"></i></a>
											<a class=\"btn btn-danger btn-xs\" data-toggle=\"modal\" data-target=\"#confirm-delete\" href=\"#\" data-href=\"".site_url("admin/laman/".$post["ID"]."/hapus/")."\"><i class=\"fa fa-trash\"></i></a>
											</div></td>
										</tr>";
										$i++;
									}
									echo "</tbody></table>
									";
								}
							}else{
								echo "<div class=\"alert alert-warning\">Belum ada data laman. Silakan tambahkan dengan <a href=\"".site_url('admin/laman_edit')."\" class=\"btn btn-primary btn-xs\">klik disini</a></div>";
							}
							?>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title"><i class="fa fa-info fa-fw"></i> Konfigurasi Aplikasi</h3>
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
	

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Penghapusan</h4>
                </div>
            
                <div class="modal-body">
                    <p>Yakin akan menghapus laman ini, data yg sudah dihapus tidak bisa dikembalikan.</p>
                    <p>Lanjutkan proses penghapusan?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger btn-ok">Hapus</a>
                </div>
            </div>
        </div>
    </div>
	
<!-- footer section -->
<!-- JS ValidationEngine -->
<script>

	$(document).ready(function() {
		$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
				
//				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
		});
	});
</script>
<?php


$this->load->view('siteman/siteman_footer');
