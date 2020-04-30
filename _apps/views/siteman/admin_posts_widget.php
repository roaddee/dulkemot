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

if($user['tingkat'] <=1) {
?>
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-folder-open-o fa-fw"></i> Kategori Publikasi</h3>
						</div>
						<div class="box-body">
							<ul class="nav nav-stack">
								<?php 
								
								if($categories){
									if(count($categories) > 0){
										foreach($categories as $key=>$item){
											echo "<li><a href=\"".site_url('posts/index/'.$item['parma'])."\">".$item['nama']."</a></li>";
										}
									}
								}else{
									echo "<div class=\"alert alert-warning\">Belum ada Kategori Publikasi. Silakan tambahkan melalui formulir ini</div>";
								}
								?>
							</ul>
							<div>
								<form action="<?php echo $form_category; ?>" method="POST" class="formular" role="form">
									<div class="form-group">
										<label class="label-control">Nama Kategori</label>
										<input type="text" name="nama" id="cat_nama" value="" class="form-control validate[required]"/>
									</div>
									<div class="form-group">
										<label class="label-control">Parmalink Kategori</label>
										<input type="text" name="parma" id="cat_parma" value="" class="form-control validate[optional,custom[onlyLetterNumber]]"/>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
<?php 

}
