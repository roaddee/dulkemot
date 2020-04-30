<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $pageTitle; ?> | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/fonts/css/font-awesome.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css'); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
				<h4>Pengaturan Ulang Sandi</h4>
        <a href="<?php echo base_url(); ?>"><h2><?php echo APP_TITLE;?></h2></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        
				<?php
				 // Cetak session <p class="login-box-msg">Silakan masukkan akun anda untuk memulai sesi ini</p>
				if($this->session->flashdata('sukses')) {
					echo '<div class="alert alert-warning">'.$this->session->flashdata('sukses').'</div>';
				}
				?>
        
        <form action="<?php echo $form_action; ?>" method="post">
					<?php
          if(!$captcha_false){
						echo '<div class="alert alert-warning">Gunakan formulir berikut untuk mendapatkan/mengatur ulang kata sandi baru anda	</div>';
					}
					
					?>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Alamat surel" name="username" id="username" value="<?php echo @$_POST['username']; ?>">
            <span class="fa fa-envelope form-control-feedback"></span>
          </div>
          <?php 
          if(!$captcha_false){
						echo "
						<div class=\"form-group has-feedback\">
							<input type=\"password\" class=\"form-control\" placeholder=\"Kode Acak\" name=\"captcha\" id=\"captcha\" >
							<span class=\"fa fa-lock form-control-feedback\"></span>
						</div>
						";
					}else{
						echo "
						<div class=\"form-group has-feedback has-error\">
							<input type=\"password\" class=\"form-control\" placeholder=\"Kode Acak\" name=\"captcha\" id=\"captcha\" >
							<span class=\"fa fa-lock form-control-feedback\"></span>
							<p class=\"help-block\">".$captcha_false[1]."</p>
						</div>
						";
					}
          ?>
          <div class="row">
            <div class="col-xs-8">
							<?php echo $capt_img;?>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="kirimsandi" value="1">Kirim <i class="fa fa-key"></i></button>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
