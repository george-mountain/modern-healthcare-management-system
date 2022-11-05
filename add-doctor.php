<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;

   $first_name = ((isset($_POST['first_name']))?mysqli_real_escape_string($conn, $_POST['first_name']):'');
   $first_name = ucwords($first_name);
   $last_name = ((isset($_POST['last_name']))?mysqli_real_escape_string($conn, $_POST['last_name']):'');
   $last_name = ucwords($last_name);
   $address = ((isset($_POST['address']))?mysqli_real_escape_string($conn, $_POST['address']):'');
   $phone = ((isset($_POST['phone']))?mysqli_real_escape_string($conn, $_POST['phone']):'');
   $email = ((isset($_POST['email']))?mysqli_real_escape_string($conn, $_POST['email']):'');
   $specialization = ((isset($_POST['specialization']))?mysqli_real_escape_string($conn, $_POST['specialization']):'');
   $detail = ((isset($_POST['detail']))?mysqli_real_escape_string($conn, $_POST['detail']):'');
  
   
   

if (isset($_POST['add_doctor'])) {
		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
		$date = $_POST['doctor_DOB'];
		$gender = $_POST['gender'];
		$doctor_query = mysqli_query($conn,"SELECT * FROM doctor WHERE Email = '$email'");
	    $doc = mysqli_fetch_array($doctor_query);
        $photo = $_FILES['file'];  
        $name = $photo['name'];
        $nameArray = explode('.',$name);
        $fileName = $nameArray[0];
        $fileExt = $nameArray[1];// ext like jpg, gif, png etc if it is image
        $type = $photo['type'];
        $typeArray = explode('/',$type);
        $fileType = $typeArray[0];//image, doc, pdf etc
        $typeFormat = $typeArray[1]; // format like excel, pt for doc etc
        $size = $photo['size']; // size of the file like 8mb etc
        $size = $size;
        $tempName = $photo['tmp_name']; // temporary location for the uploaded image
        $allowed_ext = array('png', 'jpg', 'jpeg', 'JFIF','jfif','gif','JPEG','JPG','JPEG image','JPG image');
        $uploadName = md5(microtime()).'.'.$fileExt;
        $uploadPath = 'images/'.$uploadName;
        if ($fileType != 'image') {
        $errors[] = "Only image is allowed to be uploaded!";
        }
        if (!in_array($fileExt, $allowed_ext)) {
        $errors[] = "Upload a JPG, PNG, GIF or JPEG Image!";
        }
        if ($size > 5120000) {
        $errors[] = "File is too large. upload an image less than 500MB!";
        }
        if ($doc) {
			$errors[] = "The Email address is already taken!";
		}
    
        if (empty($first_name)) {
            $errors[] = "Enter the first name!";
        }
        if (empty($last_name)) {
            $errors[] = "Enter the last name!";
        }
        if (empty($email)) {
            $errors[] = "Enter the doctor email!";
        }
        if (empty($phone)) {
            $errors[] = "Enter the phone number of the doctor!";
        }
       
        if (empty($specialization)) {
            $errors[] = "Enter the doctor's specialization!";
        }
           if (!empty($errors)) {
              echo display_error($errors);
        } else {
          move_uploaded_file($tempName, $uploadPath);
        $addsql = "INSERT INTO doctor(First_Name,Last_Name,Email,City,Phone,DOB,Department,Gender,Details,Profile_Image,Status)
        VALUES('$first_name','$last_name','$email','$address','$phone','$date','$specialization','$gender','$detail','$uploadName','Pending')";
        $add_query = mysqli_query($conn,$addsql);
            if ($add_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Doctor Added successfully
                </div>";
                

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The Doctor could not be added. Try again!
                </div>";
            }
    }
  }
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Add Doctor</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Doctors</li>
						<li class="breadcrumb-item active">Add Doctor</li>
					</ol>
				</div>
			</div>
			<!-- /Page Title -->

			<!-- /Breadcrumb -->
			<!-- Main Content -->
			<div class="container-fluid">

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Add Doctor</h3>
							<form method="post" enctype="multipart/form-data">
								<?php echo $add_info; ?>
								<?php echo $add_error; ?>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="Doctor-name">First Name</label>
										<input type="text" name="first_name" class="form-control" placeholder="First Name" id="Doctor-name" value="<?php echo $first_name; ?>">
									</div>

									<div class="form-group col-md-6">
										<label for="Doctor-name">Last Name</label>
										<input type="text" name="last_name" class="form-control" placeholder="Last Name" id="Doctor-name" value="<?php echo $last_name; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="dob">Date Of Birth</label>
										<input type="date" name="doctor_DOB" placeholder="Date of Birth" class="form-control" id="dob">
                                    </div>
                                    <div class="form-group col-md-6">
										<label for="specialization">Department</label>
										<input type="text" name="specialization" placeholder="Specialization" class="form-control" id="specialization" value="<?php echo $specialization; ?>">
									</div>
									
									
									<div class="form-group col-md-6">
										<label for="phone">Phone</label>
										<input type="text" name="phone" placeholder="Phone" class="form-control" id="phone" value="<?php echo $phone; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="email">Email</label>
										<input type="email" name="email" placeholder="email" class="form-control" id="Email" value="<?php echo $email; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="gender">Gender</label>
										<select class="form-control" id="gender" name="gender">
											<option value="Male">Male</option>
											<option value="Female">Female</option>
											<option value="Other">Other</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="about-doctor">Doctor Details</label>
										<textarea placeholder="Doctor Details" name="detail" class="form-control" id="about-doctor" rows="3"><?php echo $detail; ?></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
										<label for="address">Address</label>
										<textarea placeholder="Address" name="address" class="form-control" id="address" rows="3"><?php echo $address; ?></textarea>
									</div>
									<div class="form-group col-md-12">
										<label for="file">File</label>
										<input type="file" name="file" class="form-control" id="file">
									</div>
																		
									<div class="form-check col-md-12 mb-2">
										<div class="text-left">
											<div class="custom-control custom-checkbox">
												<input name="confirm" class="custom-control-input" type="checkbox" id="ex-check-2">
												<label class="custom-control-label" for="ex-check-2">Please Confirm</label>
											</div>
										</div>
									</div>
									<div class="form-group col-md-6 mb-3">
										<input name="add_doctor" type="submit" class="btn btn-primary btn-lg" value="Add Doctor">
									</div>
								</div>
							</form>
							
						</div>
					</div>
					<!-- /Widget Item -->
				</div>
			</div>
			<!-- /Main Content -->
		</div>
		<!-- /Page Content -->
	</div>
	<!-- Back to Top -->
	<a id="back-to-top" href="#" class="back-to-top">
		<span class="ti-angle-up"></span>
	</a>
	<?php include("footer.php"); ?>
