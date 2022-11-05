<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>

<?php include("display_error.php"); ?>

<?php 
  global $conn, $add_info, $add_error;
  if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $editQuery = mysqli_query($conn,"SELECT * FROM doctor WHERE Doctor_ID = '$edit_id'");
    $row = mysqli_fetch_array($editQuery);
    $doctor_id = $row['Doctor_ID'];
	$first_name = $row['First_Name'];
	$last_name = $row['Last_Name'];
	$doctor_address = $row['City'];
	$doctor_email = $row['Email'];
	$doctor_phone = $row['Phone'];
	$doctor_dob = $row['DOB'];
	$doctor_image = $row['Profile_Image'];
	$doctor_status = $row['Status'];
	$doctor_gender = $row['Gender'];
	$doctor_specialization = $row['Department'];
	$doctor_detail = $row['Details'];
  }

if (isset($_POST['update_doctor'])) {
		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
        $first_name = mysqli_real_escape_string($conn,$_POST['first_name']);
        $first_name = ucwords($first_name);

        $last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
        $last_name = ucwords($last_name);
        $doctor_address = mysqli_real_escape_string($conn,$_POST['address']);
        $doctor_phone = mysqli_real_escape_string($conn,$_POST['phone']);
        $doctor_email = mysqli_real_escape_string($conn,$_POST['email']);

        $doctor_dob = mysqli_real_escape_string($conn,$_POST['doctor_DOB']);
        $doctor_gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $doctor_status = mysqli_real_escape_string($conn,$_POST['status']);
        $doctor_specialization = mysqli_real_escape_string($conn,$_POST['specialization']);
        $doctor_detail = mysqli_real_escape_string($conn,$_POST['detail']);
		
		$photo = $_FILES['file'];  
        $name = $photo['name'];

        if (empty($photo['name'])) {
        	$uploadName = $doctor_image;
        } else {


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
        	$allowed_ext = array('png', 'jpg', 'jpeg', 'JFIF','jfif','gif','JPEG','JPEG image');
        	$uploadName = md5(microtime()).'.'.$fileExt;
        	$uploadPath = 'images/'.$uploadName;
        	if ($fileType != 'image') {
        	$errors[] = "Only image is allowed to be uploaded!";
        	}
        	if (!in_array($fileExt, $allowed_ext)) {
        	$errors[] = "Upload a JPG, JFIF, PNG, GIF or JPEG Image!";
        	}
        	if ($size > 512000) {
        	$errors[] = "File is too large. upload an image less than 500MB!";
        	}
        	move_uploaded_file($tempName, $uploadPath);
        }
        

        
    
        if (empty($first_name)) {
            $errors[] = "Enter the doctor's first name!";
        }
         if (empty($last_name)) {
            $errors[] = "Enter the doctor's last name!";
        }
        if (empty($doctor_email)) {
            $errors[] = "Enter the doctor's Email!";
        }
        if (empty($doctor_phone)) {
            $errors[] = "Enter the phone number of the doctor!";
        }
        if (empty($doctor_status)) {
            $errors[] = "Choose a Status of the doctor!";
        }
        
        if (empty($doctor_specialization)) {
            $errors[] = "Enter the doctor's specialization!";
        }

        if (empty($doctor_gender)) {
            $errors[] = "Enter the doctor's gender!";
        }

        if (empty($doctor_detail)) {
            $errors[] = "Enter a description!";
        }

       
        if (!empty($errors)) {
       echo display_error($errors);
        } else {
          
        $update = "UPDATE doctor SET ";
        $update .="First_Name = '{$first_name}', ";
        $update .="Last_Name = '{$last_name}', ";
        $update .="City = '{$doctor_address}', ";
        $update .="Email = '{$doctor_email}', ";
        $update .="Profile_Image = '{$uploadName}', ";
        $update .="Phone = '{$doctor_phone}', ";
        $update .="DOB = '{$doctor_dob}', ";
        $update .="Gender = '{$doctor_gender}', ";
        $update .="Department = '{$doctor_specialization}', ";
        $update .="Details = '{$doctor_detail}', ";
        $update .="Status = '{$doctor_status}' ";
        $update .= "WHERE Doctor_ID = '$edit_id' ";
        $update_query = mysqli_query($conn, $update);
            if ($update_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Doctor Edited Successfully!
                </div>";

            } else {
                echo("Error description: " . mysqli_error($conn));
            }
    }
}
  
    
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Edit Doctor</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Doctors</li>
						<li class="breadcrumb-item active">Edit Doctor</li>
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
										<input type="text" name="first_name" class="form-control" placeholder="First Name" id="Doctor-name" value="<?php echo ((isset($_POST['first_name']))?$_POST['first_name']:$first_name); ?>">
									</div>

									<div class="form-group col-md-6">
										<label for="Doctor-name">Last Name</label>
										<input type="text" name="last_name" class="form-control" placeholder="Last Name" id="Doctor-name" value="<?php echo ((isset($_POST['last_name']))?$_POST['last_name']:$last_name); ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="dob">Date Of Birth</label>
										<input type="date" name="doctor_DOB" placeholder="Date of Birth" class="form-control" id="dob" value="<?php echo ((isset($_POST['doctor_DOB']))?$_POST['doctor_DOB']:$doctor_dob); ?>">
                                    </div>
                                    <div class="form-group col-md-6">
										<label for="specialization">Department</label>
										<input type="text" name="specialization" placeholder="Specialization" class="form-control" id="specialization" value="<?php echo ((isset($_POST['specialization']))?$_POST['specialization']:$doctor_specialization); ?>">
									</div>
									
									
									<div class="form-group col-md-6">
										<label for="phone">Phone</label>
										<input type="text" name="phone" placeholder="Phone" class="form-control" id="phone" value="<?php echo ((isset($_POST['phone']))?$_POST['phone']:$doctor_phone); ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="email">Email</label>
										<input type="email" name="email" placeholder="email" class="form-control" id="Email" value="<?php echo ((isset($_POST['email']))?$_POST['email']:$doctor_email); ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="gender">Gender</label>
										<select class="form-control" id="gender" name="gender">
											<option value="Male" <?php echo ((isset($_POST['gender']) && $_POST['gender']==$patient_gender)?' selected':''); ?>>Male</option>

											<option value="Female" <?php echo ((isset($_POST['gender']) && $_POST['gender']==$patient_gender)?' selected':''); ?>>Female</option>

											<option value="Other" <?php echo ((isset($_POST['gender']) && $_POST['gender']==$patient_gender)?' selected':''); ?>>Other</option>
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="gender">Doctor Status</label>
										<select class="form-control" id="gender" name="status">

											<option value="Available" <?php echo ((isset($_POST['status']) && $_POST['status']==$status)?' selected':''); ?>>Available</option>
											<option value="On Leave" <?php echo ((isset($_POST['status']) && $_POST['status']==$status)?' selected':''); ?>>On Leave</option>
											<option value="Pending" <?php echo ((isset($_POST['status']) && $_POST['status']==$status)?' selected':''); ?>>Pending</option>
											<option value="On Vacation" <?php echo ((isset($_POST['status']) && $_POST['status']==$status)?' selected':''); ?>>On Vacation</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="about-doctor">Doctor Details</label>
										<textarea placeholder="Doctor Details" name="detail" class="form-control" id="about-doctor" rows="3"><?php echo ((isset($_POST['detail']))?$_POST['detail']:$doctor_detail); ?></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
										<label for="address">City</label>
										<textarea placeholder="Address" name="address" class="form-control" id="address" rows="3"><?php echo ((isset($_POST['address']))?$_POST['address']:$doctor_address); ?></textarea>
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
										<input name="update_doctor" type="submit" class="btn btn-primary btn-lg" value="Edit Doctor">
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
