<?php
error_reporting(0);
ob_start();
session_start();
require_once("includes/conn.php");
//var_dump($_SERVER['REMOTE_ADDR']);
$msg = "";
//var_dump(tb_pre); exit;
//var_dump($_SESSION['user_name']); exit;
if(isset($_SESSION['user_name'])) {
	if($_SESSION["logged"] == "true"){
		//var_dump($_SESSION['user_name']); exit;
	if(isset($_POST['token'])){
		$query = "SELECT `token_val` FROM `Smart_FLC_tokens` WHERE `token_id`='1' AND `created` > NOW() - INTERVAL 12 HOUR";
		$r = mysqli_fetch_object(mysqli_query($url, $query));
		//var_dump($_POST['token']); exit;
		if($r->token_val!=NULL){
			if($_POST['token']==$r->token_val){
				mysqli_query($url, "UPDATE `".TB_pre."lcfd_users_login` SET last_login='".date("Y-m-d H:i:s")."' WHERE user_id=".$_SESSION['user_id']);
				$_SESSION['token']=$r->token_val;
				header("location:home.php");
			}
			else{
				$msg = "Invalid Token";
			}
		}
		else{
			$msg = "Invalid Token";
		}
	}
	else{
		$msg = "Please enter token";
	}
	}
	else{
	header( "Location:index.php?error=1");
	}
}
else{
	header( "Location:index.php?error=1");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FLC Models | Admin panel </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
     <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-green login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b>FLC</b> Admin Panel</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in</p>
          <?php if($msg){ ?>
                 	<p class="alert alert-danger"><?php echo $msg; ?></p>
                 <?php } ?>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="token" class="form-control" placeholder="Enter the token" />
            <span class="glyphicon glyphicon-star form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-4">
             <?php /*?> <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div><?php */?>
            </div><!-- /.col -->
            <div class="col-xs-8">
              <button type="submit" class="btn btn-success btn-block btn-flat">Sign In With Token</button>
            </div><!-- /.col -->
          </div>
        </form>

        
        <?php /*?><a href="#">I forgot my password</a><br><?php */?>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
  </body>
</html>
<?php ob_end_flush(); ?>