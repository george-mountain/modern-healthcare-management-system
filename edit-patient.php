<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>
<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;
  if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $editQuery = mysqli_query($conn,"SELECT * FROM patient WHERE Patient_ID = '$edit_id'");
    $row = mysqli_fetch_array($editQuery);
    $patient_id = $row['Patient_ID'];
	$first_name = $row['Patient_First_Name'];
	$last_name = $row['Patient_Last_Name'];
	$patient_address = $row['Patient_City'];
	$patient_email = $row['Patient_Email'];
	$patient_phone = $row['Patient_Phone'];
	$patient_dob = $row['Patient_DOB'];
	$patient_citizenship = $row['Patient_Citizenship'];
	$patient_gender = $row['Patient_Gender'];
  }

if (isset($_POST['edit_patient'])) {
		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
        $first_name = mysqli_real_escape_string($conn,$_POST['first_name']);
        $first_name = ucwords($first_name);
        $last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
        $last_name = ucwords($last_name);
        $patient_address = mysqli_real_escape_string($conn,$_POST['address']);
        $patient_dob = mysqli_real_escape_string($conn,$_POST['patient_DOB']);
        $patient_phone = mysqli_real_escape_string($conn,$_POST['phone']);
        $patient_email = mysqli_real_escape_string($conn,$_POST['email']);
        $patient_dob = mysqli_real_escape_string($conn,$_POST['patient_DOB']);
        $patient_gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $patient_citizenship = mysqli_real_escape_string($conn,$_POST['citizenship']);
    
        if (empty($first_name)) {
            $errors[] = "Enter the first name!";
        }
        if (empty($last_name)) {
            $errors[] = "Enter the last name!";
        }
        if (empty($patient_email)) {
            $errors[] = "Enter the Patient Email!";
        }
        if (!empty($errors)) {
       echo display_error($errors);
        } else {
          
        $update = "UPDATE patient SET ";
        $update .="Patient_First_Name = '{$first_name}', ";
        $update .="Patient_Last_Name = '{$last_name}', ";
        $update .="Patient_Email = '{$patient_email}', ";
        $update .="Patient_City = '{$patient_address}', ";
        $update .="Patient_Phone = '{$patient_phone}', ";
        $update .="Patient_DOB = '{$patient_dob}', ";
        $update .="Patient_Gender = '{$patient_gender}', ";
        $update .="Patient_Citizenship = '{$patient_citizenship}' ";
        $update .= "WHERE Patient_ID = '$edit_id' ";
        $update_query = mysqli_query($conn, $update);
            if ($update_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Patient Edited Successfully!
                </div>";

            } else {
                // echo("Error description: " . mysqli_error($conn));
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The patient could not be edited. Try again!
                </div>";
            }
    }
}
  
    
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Edit Patient</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Patients</li>
						<li class="breadcrumb-item active">Edit Patient</li>
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
										<input type="text" name="first_name" class="form-control" placeholder="First Name" id="patient-name" value="<?php echo ((isset($_POST['Patient_First_Name']))?$_POST['Patient_First_Name']:$first_name); ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="patient-name">Last Name</label>
										<input type="text" name="last_name" class="form-control" placeholder="Last Name" id="patient-name" value="<?php echo ((isset($_POST['Patient_Last_Name']))?$_POST['Patient_Last_Name']:$last_name); ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="dob">Date Of Birth</label>
										<input type="date" name="patient_DOB" placeholder="Date of Birth" class="form-control" id="dob" value="<?php echo ((isset($_POST['Patient_DOB']))?$_POST['Patient_DOB']:$patient_dob); ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="age">Citizenship</label>
										<input type="text" name="citizenship" placeholder="Citizenship" class="form-control" id="age" value="<?php echo ((isset($_POST['Patient_Citizenship']))?$_POST['Patient_Citizenship']:$patient_citizenship); ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="phone">Phone</label>
										<input type="text" name="phone" placeholder="Phone" class="form-control" id="phone" value="<?php echo ((isset($_POST['Patient_Phone']))?$_POST['Patient_Phone']:$patient_phone); ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="email">Email</label>
										<input type="email" name="email" placeholder="email" class="form-control" id="Email" value="<?php echo ((isset($_POST['Patient_Email']))?$_POST['Patient_Email']:$patient_email); ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="gender">Gender</label>
										<select class="form-control" id="gender" name="gender">

											<option value="Male" <?php echo ((isset($_POST['gender']) && $_POST['gender']==$patient_gender)?' selected':''); ?>>Male</option>
											<option value="Female" <?php echo ((isset($_POST['gender']) && $_POST['gender']==$patient_gender)?' selected':''); ?>>Female</option>
											<option value="Other" <?php echo ((isset($_POST['gender']) && $_POST['gender']==$patient_gender)?' selected':''); ?>>Other</option>
										</select>
									</div>
									<div class="form-group col-md-12">
										<label for="exampleFormControlTextarea1">Address</label>
										<textarea placeholder="Address" name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo ((isset($_POST['address']))?$_POST['address']:$patient_address); ?></textarea>
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
										<input type="submit" name="edit_patient" class="btn btn-primary btn-lg" value="Edit Patient">
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