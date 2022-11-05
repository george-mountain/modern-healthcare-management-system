<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>
<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;

   $doctor_charges = ((isset($_POST['doctor_charges']))?mysqli_real_escape_string($conn, $_POST['doctor_charges']):'');
   $medicine_charge = ((isset($_POST['medicine_charge']))?mysqli_real_escape_string($conn, $_POST['medicine_charge']):'');
   $room_charge = ((isset($_POST['room_charge']))?mysqli_real_escape_string($conn, $_POST['room_charge']):'');
   $nurse_charge = ((isset($_POST['nurse_charge']))?mysqli_real_escape_string($conn, $_POST['nurse_charge']):'');
   $radiology_charge = ((isset($_POST['radiology_charge']))?mysqli_real_escape_string($conn, $_POST['radiology_charge']):'');
   $lab_charge = ((isset($_POST['lab_charge']))?mysqli_real_escape_string($conn, $_POST['lab_charge']):'');
   $misc_charge = ((isset($_POST['misc_charge']))?mysqli_real_escape_string($conn, $_POST['misc_charge']):'');
   $bill_discount = ((isset($_POST['bill_discount']))?mysqli_real_escape_string($conn, $_POST['bill_discount']):'');
   $patient_id = ((isset($_POST['patient_id']))?mysqli_real_escape_string($conn, $_POST['patient_id']):'');
   
   
if (isset($_POST['add_bill'])) {
		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
		$insure_query = mysqli_query($conn,"SELECT * FROM health_insurance WHERE Patient_ID = '$patient_id'");
	    $insureCount = mysqli_num_rows($insure_query);

	    if ($insureCount != 0) {
	    	$user = mysqli_fetch_array($insure_query);
	         $insurance_number = $user['Insurance_Number'];
	    }else{
	    	 $insurance_number = 'NIL';
	    }
		
        if (empty($patient_id)) {
            $errors[] = "Select a Patient!";
        }
        
           if (!empty($errors)) {
              echo display_error($errors);
        } else {
          
        $addsql = "INSERT INTO hospital_bills(Doctor_charges,Medicine_Charge,Room_Charge,Lab_Charge,Nurse_Charge,Radiology_Charges,Miscelleneous_Charges,Patient_ID,Insurance_Number,Bill_Date,Bill_Discount)
        VALUES('$doctor_charges','$medicine_charge','$room_charge','$lab_charge','$nurse_charge','$radiology_charge','$misc_charge','$patient_id','$insurance_number',NOW(),$bill_discount)";
        $add_query = mysqli_query($conn,$addsql);
            if ($add_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Bill Issued successfully
                </div>";
                

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The bill could not be issued. Try again!
                </div>";
            }
    }
  }
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Issue Bills</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Bill</li>
						<li class="breadcrumb-item active">Issue Bill</li>
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
							<h3 class="widget-title">Issue Bill</h3>
							<form method="post" enctype="multipart/form-data">
								<?php echo $add_info; ?>
								<?php echo $add_error; ?>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="department">Select Patient</label>
										<select class="form-control" id="department" name="patient_id">
											 <?php
                                              $patQuery = mysqli_query($conn,"SELECT * FROM patient"); 

                                               ?>
                                               <option value="" <?php echo ((isset($_POST['patient_id']) && $_POST['patient_id']=='')?' selected':''); ?>></option>
                                              <?php while ($patResult = mysqli_fetch_array($patQuery)) {
                                                $fullname = $patResult['Patient_First_Name'] ." ". $patResult['Patient_Last_Name'];
                                               ?>
                                                <option value="<?php echo $patResult['Patient_ID']; ?>" <?php echo ((isset($_POST['patient_id']) && $_POST['patient_id']==$patResult['Patient_ID'])?' selected':''); ?>><?php echo $fullname; ?></option>
                                                <?php }; ?>
											
										</select>
									</div>
									
									<div class="form-group col-md-6">
										<label for="patient-name"></label>
										<input type="number" name="doctor_charges" class="form-control" placeholder="Doctor Charges" id="patient-name" value="<?php echo $doctor_charges; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="patient-name">Medicine Charges</label>
										<input type="number" name="medicine_charge" class="form-control" placeholder="Medicine Charges" id="patient-name" value="<?php echo $medicine_charge; ?>"  >
									</div>
									
									<div class="form-group col-md-6">
										<label for="age">Room Charges</label>
										<input type="number" name="room_charge" placeholder="Room Charge" class="form-control" id="age" value="<?php echo $room_charge; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="age">Nurse Charges</label>
										<input type="number" name="nurse_charge" placeholder="Nurse Charge" class="form-control" id="age" value="<?php echo $nurse_charge; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="age">Radiology Charges</label>
										<input type="number" name="radiology_charge" placeholder="Radiology Charge" class="form-control" id="age" value="<?php echo $radiology_charge; ?>"  >
									</div>

									<div class="form-group col-md-6">
										<label for="age">Laboratory Charges</label>
										<input type="number" name="lab_charge" placeholder="Lab Charge" class="form-control" id="age" value="<?php echo $lab_charge; ?>"  >
									</div>

									<div class="form-group col-md-6">
										<label for="age">Miscelleneous Charges</label>
										<input type="number" name="misc_charge" placeholder="Miscelleneous Charge" class="form-control" id="age" value="<?php echo $misc_charge; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="age">Any Discount?</label>
										<input type="number" name="bill_discount" placeholder="Discount" class="form-control" id="age" value="<?php echo $bill_discount; ?>"  >
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
										<input type="submit" name="add_bill" class="btn btn-primary btn-lg" value="Issue Bill">
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
