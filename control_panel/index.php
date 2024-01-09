<?php
error_reporting(0);
ob_start();
session_start();
require_once("includes/conn.php");
//var_dump($_SERVER['REMOTE_ADDR']);
$msg = "";
require_once('../classes/recaptchalib.php');
$publickey = "6LfQjysUAAAAAKaZjpZiL0AmNTGX1ZdNw9pwnepl"; // you got this from the signup page
$privatekey = "6LfQjysUAAAAAH7Rby-OwqWOmtG-Ok86w1xxisLt";
//var_dump(tb_pre); exit;
if($_POST){
	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
	//get verified response data
	$param = "https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$_POST['g-recaptcha-response'];
	$verifyResponse = file_get_contents($param);
	$responseData = json_decode($verifyResponse);
//$responseData=true;
	if($responseData->success){
	$email = mysqli_real_escape_string($url, $_POST['email']);
	$pass = mysqli_real_escape_string($url, $_POST['password']);
	$pass=md5($pass);
	if($email && $pass){
		$query = "SELECT * FROM `".TB_pre."fdl_bookers_gin` WHERE `user_email`='$email' AND `user_pass`='$pass' AND user_role > 1";
		$r = mysqli_query($url, $query) or die(mysqli_error($url));
		if(mysqli_num_rows($r) == 1){
			$_SESSION["logged"] = "true";
			$res=mysqli_fetch_object($r);
			$_SESSION['user_id']=$res->user_id;
			$_SESSION['user_name']=$res->user_name;
			$_SESSION['last_login']=$res->last_login;
			$_SESSION['user_role']=$res->user_role;
		
			if($res->user_id==1 && $res->user_role==10){
				mysqli_query($url, "UPDATE `".TB_pre."fdl_bookers_gin` SET last_login='".date("Y-m-d H:i:s")."' WHERE user_id=".$_SESSION['user_id']);
					//echo $res->user_id.' , '.$res->user_role; exit;
					//var_dump($_SESSION['user_id']); exit;
				header("location:home.php");
			}
			else{
				header("location:authenticate.php");
				//header("location:home.php");
			}
		}
		else{
			$msg = "Invalid Email or Password";
		}
	}
	else{
		$msg = "Please enter email and password";
	}
	}
	else{
		$msg = "Please check Captcha 'I am not Robot'";
	}
	}
	else{
		$msg = "Please check Captcha 'I am not Robot'";
	}
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
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body class="hold-transition skin-green login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>FLC</b> Admin Panel</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in</p>
          <?php if($msg){ ?>
                 	<p class="alert alert-danger"><?php echo $msg; ?></p>
                 <?php } ?>
        <form action="index.php" method="post" onSubmit="return validate();">
          <div class="form-group has-feedback">
            <input type="text" name="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group">
                 <div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>" data-callback="recaptchaCallback"></div>
           </div>
          <div class="row">
            <div class="col-xs-8">
             <?php /*?> <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div><?php */?>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
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
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
	var captcha_check=0;
      function recaptchaCallback() {
    	captcha_check=1;
		};
	
	function validate(){
		if(captcha_check==0){ 
			alert("please check 'you are not robot' captcha");
			return false;
		}
		else return true;
	}
    </script>
  </body>
</html>
<?php ob_end_flush(); ?>