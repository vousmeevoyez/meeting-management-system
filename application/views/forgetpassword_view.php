<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Aplikasi Pengelola Acara</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url('assets/common/images/favicon.ico');?>" type="image/x-icon">
    <!-- Bootstrap 3.3.2 -->
    <link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?=base_url('assets/bootstrap/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=base_url('assets/dist/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?=base_url('assets/plugins/iCheck/square/blue.css');?>" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="register-page">
    <div class="register-box">
      <div class="login-logo">
        <a href="<?=base_url();?>"><b>Aplikasi Pengelola Acara</b></a>
      </div><!-- /.login-logo -->
      
      <div class="register-box-body">
    <p class="login-box-msg">Please input your email address to change your password</p>

    <?php 
            echo validation_errors('<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">×</button>','</div>');
            echo form_open('forgetpassword/doSendEmail'); 
        ?>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Send</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close();?>
    <br/>
    <a href="<?=base_url('loginadmin');?>" class="text-center">I already remember my password</a>
    <div class="social-auth-links text-center">
          <p>
              &copy; 2017 by <b>Jamkrindo</b>
              <br>
              Versi 1.0.0 
          </p>
        </div><!-- /.social-auth-links -->
  </div>
      
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?=base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?=base_url('assets/plugins/iCheck/icheck.min.js');?>" type="text/javascript"></script>
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