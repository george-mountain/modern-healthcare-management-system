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
   $citizenship = ((isset($_POST['citizenship']))?mysqli_real_escape_string($conn, $_POST['citizenship']):'');
   $phone = ((isset($_POST['phone']))?mysqli_real_escape_string($conn, $_POST['phone']):'');
   $email = ((isset($_POST['email']))?mysqli_real_escape_string($conn, $_POST['email']):'');
   $rand_val = strval(rand(1001,99999)); 
   $name_ID = substr($first_name, 0,4).'_'.$rand_val.'_';
   $random = uniqid($name_ID);
   
   

if (isset($_POST['add_patient'])) {
		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
		$date = $_POST['patient_DOB'];
		$gender = $_POST['gender'];
		$patient_query = mysqli_query($conn,"SELECT * FROM patient WHERE Patient_Email = '$email'");
	    $patie = mysqli_fetch_array($patient_query);
       
        if ($patie) {
			$errors[] = "The Email address is already taken!";
		}
    
        if (empty($first_name)) {
            $errors[] = "Enter the patient first name!";
        }
        if (empty($last_name)) {
            $errors[] = "Enter the patient last name!";
        }
         if (empty($citizenship)) {
            $errors[] = "Enter the nationality!";
        }
        if (empty($email)) {
            $errors[] = "Enter the Patient Email!";
        }
        if (empty($phone)) {
            $errors[] = "Enter the phone number of the patient!";
        }
           if (!empty($errors)) {
              echo display_error($errors);
        } else {
          
        $addsql = "INSERT INTO patient(Patient_ID,Patient_First_Name,Patient_Last_Name,Patient_City,Patient_Email,Patient_Phone,Patient_Citizenship,Patient_Gender,Patient_DOB)
        VALUES('$random','$first_name','$last_name','$address','$email','$phone','$citizenship','$gender','$date')";
        $add_query = mysqli_query($conn,$addsql);
            if ($add_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Patient Added successfully
                </div>";
                

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The patient could not be added. Try again!
                </div>";
            }
    }
  }
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Add Patient</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Patients</li>
						<li class="breadcrumb-item active">Add Patient</li>
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
							<h3 class="widget-title">Add Patient</h3>
							<form method="post" enctype="multipart/form-data">
								<?php echo $add_info; ?>
								<?php echo $add_error; ?>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="patient-name">First Name</label>
										<input type="text" name="first_name" class="form-control" placeholder="First Name" id="patient-name" value="<?php echo $first_name; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="patient-name">Last Name</label>
										<input type="text" name="last_name" class="form-control" placeholder="Last Name" id="patient-name" value="<?php echo $last_name; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="dob">Date Of Birth</label>
										<input type="date" name="patient_DOB" placeholder="Date of Birth" class="form-control" id="dob" value="<?php echo $date; ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="age">Citizenship</label>
										<input type="text" name="citizenship" placeholder="Citizenship" class="form-control" id="age" value="<?php echo $citizenship; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="phone">Phone</label>
										<input type="text" name="phone" placeholder="Phone" class="form-control" id="phone" value="<?php echo $phone; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="email">Email</label>
										<input type="email" name="email" placeholder="email" class="form-control" id="Email" value="<?php echo $email; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="gender">Gender</label>
										<select class="form-control" id="gender" name="gender">
											<option value="Male">Male</option>
											<option value="Female">Female</option>
											<option value="Other">Other</option>
										</select>
									</div>
									<div class="form-group col-md-12">
										<label for="exampleFormControlTextarea1">City</label>
										<textarea placeholder="Address" name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $address; ?></textarea>
									</div>
																		
									<div class="form-check col-md-12 mb-2">
										<div class="text-left">
											<div class="custom-control custom-checkbox">
												<input class="custom-control-input" type="checkbox" id="ex-check-2" name="confirm">
												<label class="custom-control-label" for="ex-check-2">Please Confirm</label>
											</div>
										</div>
									</div>
									<div class="form-group col-md-6 mb-3">
										<input type="submit" name="add_patient" class="btn btn-primary btn-lg" value="Add Patient">
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
