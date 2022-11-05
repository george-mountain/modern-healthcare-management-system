<?php include "connection.php";?>

<?php 
$salt = '$2y$10$theverylongvaluesiused';
if (isset($_POST['submit'])) {
    $username = htmlentities($_POST['user']);
    $password = htmlentities($_POST['pass_confirmation']);
    $hashed = crypt($password,$salt);
    $sql = "SELECT * FROM login WHERE Email = '$username' OR User_Name = '$username' AND password = '$hashed'";
    $query = mysqli_query($conn,$sql);
    $user = mysqli_fetch_array($query);
    $user_name = $user['User_Name'];
    $user_email = $user['Email'];
    $user_password = $user['password'];
    if ($user) {
        if (!empty($_POST['remember'])) {
            setcookie("member_username",$_POST['username'],time() + (10*365*24*60*60));
            setcookie("member_password",$_POST['password'],time() + (10*365*24*60*60));
        } else {
            if (isset($_COOKIE['member_username'])) {
                setcookie("member_username","");
            }
            if (isset($_COOKIE['member_password'])) {
                setcookie("member_password","");
            }
        }
        $_SESSION['email'] = $user_email;
        header("Location:index.php");
        
    } else {
        echo "<script>alert('Invalid Login Details')</script>";
    }
    

}


 ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>RLG HealthCare System</title>
	<!-- Fav  Icon Link -->
	<link rel="shortcut icon" type="image/png" href="images/fav.png">
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- themify icons CSS -->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Main CSS -->
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/violet.css" id="style_theme">
	<link rel="stylesheet" href="css/responsive.css">

	<script src="js/modernizr.min.js"></script>
</head>

<body class="auth-bg">
	<!-- Pre Loader -->
	<div class="loading">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
	<!--/Pre Loader -->
	<!-- Color Changer -->
	<div class="theme-settings" id="switcher">
		<span class="theme-click">
			<span class="ti-settings"></span>
		</span>
		<span class="theme-color theme-default theme-active" data-color="green"></span>
		<span class="theme-color theme-blue" data-color="blue"></span>
		<span class="theme-color theme-red" data-color="red"></span>
		<span class="theme-color theme-violet" data-color="violet"></span>
		<span class="theme-color theme-yellow" data-color="yellow"></span>
	</div>
	<!-- /Color Changer -->
	<div class="wrapper">
		<!-- Page Content  -->
		<div id="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6 auth-box">
						<div class="proclinic-box-shadow">
							<h3 class="widget-title">Login</h3>
							<form class="widget-form" method="post">
								<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<input name="user" placeholder="Username" class="form-control" required="" data-validation="length alphanumeric" data-validation-length="3-12"
										 data-validation-error-msg="User name has to be an alphanumeric value (3-12 chars)" data-validation-has-keyup-event="true" value="<?php if (isset($_COOKIE['member_username'])) {
								                echo $_COOKIE['member_username'];
								            } ?>">
									</div>
								</div>
								<!-- /.form-group -->
								<!-- form-group -->
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="password" placeholder="Password" name="pass_confirmation" class="form-control" data-validation="strength" data-validation-strength="2"
										 data-validation-has-keyup-event="true" value="<?php if (isset($_COOKIE['member_password'])) {
								                echo $_COOKIE['member_password'];
								            } ?>">
									</div>
								</div>
								<!-- /.form-group -->
								<!-- Check Box -->		
								<div class="form-check row">
									<div class="col-sm-12 text-left">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" id="ex-check-2" name="remember" value="<?php if (isset($_COOKIE['member_username'])) {
										            echo "checked";
										        } ?>">
											<label class="custom-control-label" for="ex-check-2">Remember Me</label>
										</div>
									</div>
								</div>
								<!-- /Check Box -->	
								<!-- Login Button -->			
								<div class="button-btn-block">
									<input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Login">
								</div>
								<!-- /Login Button -->	
								<!-- Links -->	
								<div class="auth-footer-text">
									<small>New User,
										<a href="sign-up.html">Sign Up</a> Here</small>
								</div>
								<!-- /Links -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Content  -->
	</div>
	<!-- Jquery Library-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<!-- Popper Library-->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap Library-->
	<script src="js/bootstrap.min.js"></script>
	<!-- Custom Script-->
	<script src="js/custom.js"></script>
</body>


</html>
