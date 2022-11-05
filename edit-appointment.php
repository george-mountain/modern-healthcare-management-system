<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;
  if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $editQuery = mysqli_query($conn,"SELECT * FROM appointment WHERE Appointment_ID = '$edit_id'");
    $row = mysqli_fetch_array($editQuery);
    $appointment_id = $row['Appointment_ID'];
	$appointment_type = $row['Appointment_Type'];
	$date_created = $row['Date_Created'];
	$appointment_date = $row['Appointment_Date'];
	$appointment_time = $row['Appointment_Time'];
	$patient_id = $row['Patient_ID'];
	$doctor_id = $row['Doctor_ID'];
	$department = $row['Department'];
	$problem = $row['Problem'];
	$status = $row['Status'];
  }

if (isset($_POST['edit_appointment'])) {
		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
        $appointment_type = mysqli_real_escape_string($conn,$_POST['type']);
        $appointment_date = mysqli_real_escape_string($conn,$_POST['date']);
        $appointment_time = mysqli_real_escape_string($conn,$_POST['time_slot']);
        $patient_id = mysqli_real_escape_string($conn,$_POST['patient_ID']);
        $doctor_id = mysqli_real_escape_string($conn,$_POST['doctor_id']);
        $department = mysqli_real_escape_string($conn,$_POST['department']);
        $status = mysqli_real_escape_string($conn,$_POST['status']);
        $problem = mysqli_real_escape_string($conn,$_POST['problem']);
    
        if (empty($appointment_type)) {
            $errors[] = "Choose Appointment Type!";
        }
        if (empty($appointment_date)) {
            $errors[] = "Choose the appointement date!";
        }
        if (empty($appointment_time)) {
            $errors[] = "Choose the appointement time!";
        }

         if (empty($department)) {
            $errors[] = "Choose the department for appointment!";
        }

         if (empty($doctor_id)) {
            $errors[] = "Select a Doctor!";
        }
        if (empty($status)) {
            $errors[] = "Select appointement status!";
        }

         if (empty($patient_id)) {
            $errors[] = "Select patient for appointment!";
        }
        if (!empty($errors)) {
       echo display_error($errors);
        } else {
          
        $update = "UPDATE appointment SET ";
        $update .="Appointment_Type = '{$appointment_type}', ";
        $update .="Appointment_Date = '{$appointment_date}', ";
        $update .="Appointment_Time = '{$appointment_time}', ";
        $update .="Patient_ID = '{$patient_id}', ";
        $update .="Doctor_ID = '{$doctor_id}', ";
        $update .="Department = '{$department}', ";
        $update .="Problem = '{$problem}', ";
        $update .="Status = '{$status}' ";
        $update .= "WHERE Appointment_ID = '$edit_id' ";
        $update_query = mysqli_query($conn, $update);
            if ($update_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Appointment Edited Successfully!
                </div>";

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The appointemnt could not be edited. Try again!
                </div>";
            }
    }
}
  
    
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Edit Appointment</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Appointments</li>
						<li class="breadcrumb-item active">Edit Appointment</li>
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
							<h3 class="widget-title">Add Appointment</h3>
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
                                               <!-- <option value="" <?php echo ((isset($_POST['patient_ID']) && $_POST['patient_ID']=='')?' selected':''); ?>></option> -->
                                              <?php while ($patResult = mysqli_fetch_array($patQuery)) {
                                                $fullname = $patResult['Patient_First_Name'] ." ". $patResult['Patient_Last_Name'];
                                               ?>
                                                <option value="<?php echo $patResult['Patient_ID']; ?>" <?php echo ((isset($_POST['patient_ID']) && $_POST['patient_ID']==$patResult['Patient_ID'])?' selected':''); ?>><?php echo $fullname; ?></option>
                                                <?php }; ?>
											
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="department">Department</label>
										<select class="form-control" id="department" name="department">
											<option value="Neuro" <?php echo ((isset($_POST['department']) && $_POST['department']==$department)?' selected':''); ?>>Neuro</option>

											<option value="Orthopaedic" <?php echo ((isset($_POST['department']) && $_POST['department']==$department)?' selected':''); ?>>Orthopaedic</option>

											<option value="Radiology" <?php echo ((isset($_POST['department']) && $_POST['department']==$department)?' selected':''); ?>>Radiology</option>

											<option value="Dental" <?php echo ((isset($_POST['department']) && $_POST['department']==$department)?' selected':''); ?>>Dental</option>

											<option value="General" <?php echo ((isset($_POST['department']) && $_POST['department']==$department)?' selected':''); ?>>General</option>

										</select>
									</div>
									
									<div class="form-group col-md-6">
										<label for="appointment-date">Appointment Date</label>
										<input type="date" name="date" placeholder="Appointment Date" class="form-control" id="appointment-date" value="<?php echo ((isset($_POST['date']))?$_POST['date']:$appointment_date); ?>">
									</div>
									<div class="form-group col-md-6">
										<label for="time-slot">Time Slot</label>
										<select class="form-control" id="time-slot" name="time_slot">
											<option value="10AM-11AM" <?php echo ((isset($_POST['time_slot']) && $_POST['time_slot']==$appointment_time)?' selected':''); ?>>10AM-11AM</option>

											<option value="11AM-12pm" <?php echo ((isset($_POST['time_slot']) && $_POST['time_slot']==$appointment_time)?' selected':''); ?>>11AM-12pm</option>

											<option value="12PM-01PM" <?php echo ((isset($_POST['time_slot']) && $_POST['time_slot']==$appointment_time)?' selected':''); ?>>12PM-01PM</option>

											<option value="2PM-3PM" <?php echo ((isset($_POST['time_slot']) && $_POST['time_slot']==$appointment_time)?' selected':''); ?>>2PM-3PM</option>

											<option value="3PM-4PM" <?php echo ((isset($_POST['time_slot']) && $_POST['time_slot']==$appointment_time)?' selected':''); ?>>3PM-4PM</option>

											<option value="4PM-5PM" <?php echo ((isset($_POST['time_slot']) && $_POST['time_slot']==$appointment_time)?' selected':''); ?>>4PM-5PM</option>

											<option value="6PM-7PM" <?php echo ((isset($_POST['time_slot']) && $_POST['time_slot']==$appointment_time)?' selected':''); ?>>6PM-7PM</option>

											<option value="7PM-8PM" <?php echo ((isset($_POST['time_slot']) && $_POST['time_slot']==$appointment_time)?' selected':''); ?>>7PM-8PM</option>

											<option value="8PM-9PM" <?php echo ((isset($_POST['time_slot']) && $_POST['time_slot']==$appointment_time)?' selected':''); ?>>8PM-9PM</option>
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="department">Select Doctor</label>
										<select class="form-control" id="department" name="doctor_id">
											 <?php
                                              $docQuery = mysqli_query($conn,"SELECT * FROM doctor WHERE Status = 'Available'"); 

                                               ?>
                                               <!-- <option value="" <?php echo ((isset($_POST['doctor_id']) && $_POST['doctor_id']=='')?' selected':''); ?>></option> -->
                                              <?php while ($docResult = mysqli_fetch_array($docQuery)) {
                                                $fullname = $docResult['First_Name'] ." ". $docResult['Last_Name'];
                                               ?>
                                                <option value="<?php echo $docResult['Doctor_ID']; ?>" <?php echo ((isset($_POST['doctor_id']) && $_POST['doctor_id']==$docResult['Doctor_ID'])?' selected':''); ?>><?php echo $fullname; ?></option>
                                                <?php }; ?>
											
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="department">Appointment Type</label>
										<select class="form-control" id="department" name="type">
											<option value="Pre-Bookable Appointments" <?php echo ((isset($_POST['type']) && $_POST['type']==$appointment_type)?' selected':''); ?>>Pre-Bookable Appointments</option>

											<option value="Same Day/Urgent Appointments" <?php echo ((isset($_POST['type']) && $_POST['type']==$appointment_type)?' selected':''); ?>>Same Day/Urgent Appointments</option>

											<option value="Telephone Consultations" <?php echo ((isset($_POST['type']) && $_POST['type']==$appointment_type)?' selected':''); ?>>Telephone Consultations</option>

											<option value="Health Care Assistant Appointments" <?php echo ((isset($_POST['type']) && $_POST['type']==$status)?' selected':''); ?>>Health Care Assistant Appointments</option>

											<option value="Routine checkup" <?php echo ((isset($_POST['type']) && $_POST['type']==$appointment_type)?' selected':''); ?>>Routine checkup</option>

											<option value="Others" <?php echo ((isset($_POST['type']) && $_POST['type']==$appointment_type)?' selected':''); ?>>Others</option>
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="gender">Appointment Status</label>
										<select class="form-control" id="gender" name="status">

											<option value="Registered" <?php echo ((isset($_POST['status']) && $_POST['status']==$status)?' selected':''); ?>>Registered</option>
											<option value="Canceled" <?php echo ((isset($_POST['status']) && $_POST['status']==$status)?' selected':''); ?>>Cancel</option>
											<option value="Completed" <?php echo ((isset($_POST['status']) && $_POST['status']==$status)?' selected':''); ?>>Completed</option>
											<option value="Pending" <?php echo ((isset($_POST['status']) && $_POST['status']==$status)?' selected':''); ?>>Pending</option>
										</select>
									</div>
									<div class="form-group col-md-12">
										<label for="problem">Problem</label>
										<textarea name="problem" placeholder="Problem" class="form-control" id="problem" rows="3"> <?php echo ((isset($_POST['problem']))?$_POST['problem']:$problem); ?></textarea>
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
										<input type="submit" name="edit_appointment" class="btn btn-primary btn-lg" value="Edit Appointment">
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
