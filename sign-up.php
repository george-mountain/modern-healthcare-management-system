<?php include('connection.php');?>
<?php include("display_error.php"); ?>
<?php
	
	$salt = '$2y$10$theverylongvaluesiused';
	global $conn, $add_info, $add_error; 

	   $user_name = ((isset($_POST['user']))?mysqli_real_escape_string($conn, $_POST['user']):'');
	   $email = ((isset($_POST['email']))?mysqli_real_escape_string($conn, $_POST['email']):'');
	   $user_password = ((isset($_POST['password']))?mysqli_real_escape_string($conn, $_POST['password']):'');
	   $confirm_password = ((isset($_POST['pass_confirmation']))?mysqli_real_escape_string($conn, $_POST['pass_confirmation']):'');
	   
	if (isset($_POST['signup'])) {
	    $email_query = mysqli_query($conn,"SELECT * FROM login WHERE Email = '$email' OR User_Name = '$user_name'");
	    $emailCount = mysqli_num_rows($email_query);
	    $required = array('username','password','confirm_password','email');
	    // foreach ($required as $field) {
	    //     if (empty($_POST['$field'])) {
	    //         $errors[] = "Fill all the Fields and try again!";
	    //         break;
	    //     }
	    // }
	    if (empty($user_name)) {
	        $errors[] = "Enter a user name!";
	    }
	   
	    if (empty($email)) {
	        $errors[] = "Enter a valid email address!";
	    }
	    if (empty($user_password)) {
	        $errors[] = "Enter your password!";
	    }
	    if (empty($confirm_password)) {
	        $errors[] = "Confirm the password you entered!";
	    }
	    
	    
	    if (strlen($user_password) < 5) {
	        $errors[] = "Your Password should be of length greater than 5";
	    }
	    if ($user_password != $confirm_password) {
	        $errors[] = "Your Password does not match!";
	    }
	    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
	        $errors[] = "Please use a valid email address!";
	    }
	    if ($emailCount != 0) {
	         $errors[] = "The email or username is already taken by another user. Try again!";
	    }
	    if (!empty($errors)) {
	      echo display_error($errors);
	    }else {
	        $hashed = crypt($user_password,$salt);
	        $addsql = "INSERT INTO login(Email,password,User_Name)
	        VALUES('$email','$hashed','$user_name')";
	        $add_query = mysqli_query($conn,$addsql);
	            if ($add_query) {
	                $add_info = "<div class='alert alert-info'>
	                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	                Registration was successful!
	                </div>";

	            } else {
	                $add_error = "<div class='alert alert-danger'>
	                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	                The Registration Failed. Try again!
	                </div>";
	            }
	    }
	    
	}

 ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ProClinic-Bootstrap4 Hospital Admin</title>
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
		<!-- Page Content -->
		<div id="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6 auth-box">
						<div class="proclinic-box-shadow">
							<!-- Page Title -->
							<h3 class="widget-title">Sign Up</h3>
							<!-- /Page Title -->

							<!-- Form -->
							<form class="widget-form" method="post">
								<?php echo $add_info; ?>
               					<?php echo $add_error; ?>
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="email" placeholder="Email" name="email" class="form-control" required="" data-validation="email" <?php echo $email; ?> data-validation-has-keyup-event="true">
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-12">
										<input name="user" placeholder="Username" class="form-control" required="" data-validation="length alphanumeric" <?php echo $user_name; ?> data-validation-length="3-12"
										 data-validation-error-msg="User name has to be an alphanumeric value (3-12 chars)" data-validation-has-keyup-event="true">
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="password" placeholder="Password" name="password" class="form-control" data-validation="strength" <?php echo $password; ?> data-validation-strength="2"
										 data-validation-has-keyup-event="true">
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="password" placeholder="Confirm Password" name="pass_confirmation" class="form-control" data-validation="strength"
										 data-validation-strength="2" <?php echo $confirm_password; ?> data-validation-has-keyup-event="true">
									</div>
								</div>
								<div class="form-check row">
									<div class="col-sm-12 text-left">
										<div class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" id="ex-check-2">
											<label class="custom-control-label" for="ex-check-2">I agree to Terms & Conditions</label>
										</div>
									</div>
								</div>
								<!-- Button -->
								<div class="button-btn-block">
									<input type="submit" id="signup" class="btn btn-primary btn-lg btn-block" name="signup" value="Sign Up">
								</div>
								<!-- /Button -->
								<!-- Linsk -->
								<div class="auth-footer-text">
									<small>Alredy Sign Up,
										<a href="login.html">Login</a> Here</small>
								</div>
								<!-- /Links -->
							</form>
							<!-- /Form -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Content -->
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
