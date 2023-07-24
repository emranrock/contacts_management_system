
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Team-focus | Admin System Log in</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="<?= base_url('assets/admin/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/admin/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Team-Focus</b><br>Admin System</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign In</p>
     
      <form action="<?php echo base_url('admin/loginMe'); ?>" method="post">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" name="email" required />
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password" required />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">

          </div><!-- /.col -->
          <div class="col-xs-4">
            <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In" />
          </div><!-- /.col -->
        </div>
      </form>

      <a href="<?php echo base_url('admin/forgotPassword'); ?>">Forgot Password</a><br>

    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

  <script src="<?php echo site_url('assets/admin/js/jQuery-2.1.4.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo site_url('assets/admin//bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
</body>

</html>