<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;

   $insurance_code = ((isset($_POST['insurance_code']))?mysqli_real_escape_string($conn, $_POST['insurance_code']):'');
   $patient_ID = ((isset($_POST['patient_ID']))?mysqli_real_escape_string($conn, $_POST['patient_ID']):'');
   $insurance_number = ((isset($_POST['insurance_number']))?mysqli_real_escape_string($conn, $_POST['insurance_number']):'');
   $type = ((isset($_POST['type']))?mysqli_real_escape_string($conn, $_POST['type']):'');
   

if (isset($_POST['add_admission'])) {

		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
	    $create_date = $_POST['create_date'];
	    $expiry_date = $_POST['expiry_date'];
    
        if (empty($patient_ID)) {
            $errors[] = "Select a Patient!";
        }
        if (empty($insurance_code)) {
            $errors[] = "Select Insurance plan!";
        }

        if (empty($create_date)) {
            $errors[] = "Select Issued date!";
        }

         if (empty($expiry_date)) {
            $errors[] = "Select expiry date!";
        }
        
           if (!empty($errors)) {
              echo display_error($errors);
        } else {
        
        $addsql = "INSERT INTO health_insurance(Insurance_Number,Creation_Date,Expiry_Date,Patient_ID,Insurance_Code,Insurance_Type)
        VALUES('$insurance_number','$create_date','$expiry_date','$patient_ID','$insurance_code','$type')";
        $add_query = mysqli_query($conn,$addsql);
            if ($add_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Recorded added successfully
                </div>";
                

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Adding record failed. Try again!
                </div>";
            }
    }
  }
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Insurance</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Insurance</li>
						<li class="breadcrumb-item active">Add Insurance</li>
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
							<h3 class="widget-title">Add Health Insurance</h3>
							<form method="post">
								<?php echo $add_info; ?>
								<?php echo $add_error; ?>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="department">Select Patient</label>
										<select class="form-control" id="department" name="patient_ID">
											 <?php
                                              $patQuery = mysqli_query($conn,"SELECT * FROM patient"); 

                                               ?>
                                               <option value="" <?php echo ((isset($_POST['patient_ID']) && $_POST['patient_ID']=='')?' selected':''); ?>></option>
                                              <?php while ($patResult = mysqli_fetch_array($patQuery)) {
                                                $fullname = $patResult['Patient_First_Name'] ." ". $patResult['Patient_Last_Name'];
                                               ?>
                                                <option value="<?php echo $patResult['Patient_ID']; ?>" <?php echo ((isset($_POST['patient_ID']) && $_POST['patient_ID']==$patResult['Patient_ID'])?' selected':''); ?>><?php echo $fullname; ?></option>
                                                <?php }; ?>
											
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="patient-name">Insurance Number</label>
										<input type="text" name="insurance_number" class="form-control" placeholder="Insurance Number" id="patient-name" value="<?php echo $insurance_number; ?>"  >
									</div>
									
									<div class="form-group col-md-6">
										<label for="appointment-date">Issued Date</label>
										<input type="date" name="create_date" placeholder="Issued Date" class="form-control" id="appointment-date">
									</div>

									<div class="form-group col-md-6">
										<label for="department">Insurance Type</label>
										<select class="form-control" id="department" name="type">
											<option value="National Health Insurance (NHI)">National Health Insurance (NHI)</option>
											<option value="Social Insurance (SI)">Social Insurance (SI)</option>
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="appointment-date">Expiry Date</label>
										<input type="date" name="expiry_date" placeholder="Expiry Date" class="form-control" id="appointment-date">
									</div>
									
									<div class="form-group col-md-6">
										<label for="department">Select Insurance Plan</label>
										<select class="form-control" id="department" name="insurance_code">
											 <?php
                                              $hasQuery = mysqli_query($conn,"SELECT * FROM has_insurance"); 

                                               ?>
                                               <option value="" <?php echo ((isset($_POST['insurance_code']) && $_POST['insurance_code']=='')?' selected':''); ?>></option>
                                              <?php while ($hasResult = mysqli_fetch_array($hasQuery)) {
                                               
                                                $code = $hasResult['Insurance_Code'] ." ". $hasResult['Insurance_Company'];
                                               ?>
                                                <option value="<?php echo $hasResult['Insurance_Code']; ?>" <?php echo ((isset($_POST['insurance_code']) && $_POST['insurance_code']==$hasResult['Insurance_Code'])?' selected':''); ?>><?php echo $code; ?></option>
                                                <?php }; ?>
											
										</select>
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
										<input type="submit" name="add_admission" class="btn btn-primary btn-lg" value="Add Record">
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
