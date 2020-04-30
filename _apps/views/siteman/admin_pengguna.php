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
			<small>Panel Pengguna</small>
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
							<h3 class="box-title"><a href="<?php echo site_url('admin/pengguna');?>"><?php echo $boxTitle;?></a></h3>
						</div>
						<div class="box-body">
							<?php 
							if($msg){
								echo "
								<div class=\"alert alert-success alert-dismissable\">
									<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
									<h4><i class=\"fa fa-check\"></i> ".$msg['msg']."</h4>
								</div>";
							}
							//echo var_dump($user);
							if($id > 0){
								// echo var_dump($pengguna);
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
									<tr><td style=\"width:30%\">No HP</td><td>".$pengguna['nohp']."</td></tr>
									<tr><td style=\"width:30%\">Website</td><td>".$pengguna['url']."</td></tr>
									<tr><td style=\"width:30%\">Lembaga</td><td><a href=\"".site_url('admin/lembaga/').$pengguna['lembaga_id']."\">".$pengguna['lembaga_nama']."</a></td></tr>
									<tr><td style=\"width:30%\">Wilayah Kerja</td><td>".$wilayah_tingkat[$pengguna['wilayah_tingkat']] ." ". $pengguna['wilayah_nama']."</a></td></tr>
									<tr><td style=\"width:30%\">Profil</td><td>".$pengguna['ndesc']."</td></tr>
									<tr><td style=\"width:30%\">Status</td><td>".$user_status[$pengguna['status']]."</td></tr>
									<tr><td style=\"width:30%\">Peranan</td><td>".$user_level[$pengguna['tingkat']]."</td></tr>
									<tr><td style=\"width:30%\">User ID</td><td>".$pengguna['userid']."</td></tr>
								</table>
								";
							}else{
								echo "
								<table class=\"table table-bordered\">
								<thead><tr><th>#</th>
									<th>Nama Pengguna</th>
									<th>Lembaga</th>
									<th></th>
								</tr></thead>
								<tbody>
								";
								$nomer = 1;
								foreach($pengguna as $key=>$item){
									$status = ($item['status'] == 1) ? "<span class=\"btn btn-success btn-xs\"><i class=\"fa fa-gear\"></i></span>":"<span class=\"btn btn-default btn-xs\"><i class=\"fa fa-power\"></i></span>";
									echo "<tr><td class=\"angka\">".$nomer."</td>
									<td><a href=\"".site_url('admin/pengguna/').$item['id']."\">".$item['nama']."</a></td>
									<td><a href=\"".site_url('admin/lembaga/').$item['lembaga_id']."\">".$item['lembaga_nama']."</a></td>
									<td><div class=\"btn-group pull-right\">
										".$status."
										<a class=\"btn btn-xs btn-default\" href=\"".site_url('admin/pengguna/'.$item['id'].'/ubah')."\"><i class=\"fa fa-pencil\"></i></a>
										<a class=\"btn btn-xs btn-danger\" data-record-id=\"".$item['id']."\" data-record-title=\"".$item['nama']."\" data-toggle=\"modal\" data-target=\"#confirm-delete\"><i class=\"fa fa-trash\"></i></a>
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
							<div class="btn-group">
							<?php
							if($id > 0){
								echo "&nbsp;<a class=\"btn btn-default pull-right\" href=\"". site_url('admin/pengguna/'.$id.'/ubah')."\"><i class=\"fa fa-pencil\"></i> Ubah Data Pengguna</a>";
							}
							?>
							<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/pengguna/0/baru'); ?>"><i class="fa fa-user-plus"></i> Tambah Pengguna Baru</a>
							<a class="btn btn-default pull-right" href="<?php echo site_url('admin/pengguna/'); ?>"><i class="fa fa-th-list"></i> Daftar Pengguna</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">

					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Pengelolaan Data Pengguna</h3>
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
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Penghapusan</h4>
                </div>
                <div class="modal-body">
                    <p>Anda hendak menghapus data <b><i class="title"></i></b>, tidak bisa di-kembali-kan.</p>
                    <p>Lanjut?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger btn-ok">Hapus</button>
                </div>
            </div>
        </div>
    </div>

<?php
/*
 * 
 *             // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
            // $.post('/api/record/' + id).then()

 * */
?>

    <script>
        $('#confirm-delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var strUrl = '<?php echo site_url('admin/pengguna/');?>' + id +'/hapus';
            window.location.replace(strUrl);
            /*
            $.ajax({url: strUrl, type: 'DELETE'})
            */
            $modalDiv.addClass('loading');
            setTimeout(function() {
                $modalDiv.modal('hide').removeClass('loading');
            }, 1000)
            
        });
        $('#confirm-delete').on('show.bs.modal', function(e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
        });
    </script>
    

<?php

$this->load->view('siteman/siteman_footer');
