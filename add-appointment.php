<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;

   $patient_ID = ((isset($_POST['patient_ID']))?mysqli_real_escape_string($conn, $_POST['patient_ID']):'');
   $doctor_id = ((isset($_POST['doctor_id']))?mysqli_real_escape_string($conn, $_POST['doctor_id']):'');
   $problem = ((isset($_POST['problem']))?mysqli_real_escape_string($conn, $_POST['problem']):'');
   

   
   
   
   

if (isset($_POST['add_appointment'])) {

		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
		$department = $_POST['department'];
		$type = $_POST['type'];
	    $date = $_POST['date'];
	    $time_slot = $_POST['time_slot'];
    
        if (empty($patient_ID)) {
            $errors[] = "Select a Patient!";
        }
        if (empty($doctor_id)) {
            $errors[] = "Select a Doctor!";
        }

        if (empty($type)) {
            $errors[] = "Choose Appointment type!";
        }
        if (empty($problem)) {
            $errors[] = "Enter the reason for appointment!";
        }
        if (empty($date)) {
            $errors[] = "Choose Appointment Date!";
        }
        if (empty($time_slot)) {
            $errors[] = "Pick a time slot!";
        }
        
           if (!empty($errors)) {
              echo display_error($errors);
        } else {
        
        $addsql = "INSERT INTO appointment(Department,Appointment_Date,Appointment_Time,Problem,Appointment_Type,Patient_ID,Doctor_ID,Status,Date_Created)
        VALUES('$department','$date','$time_slot','$problem','$type','$patient_ID','$doctor_id','Registered',NOW())";
        $add_query = mysqli_query($conn,$addsql);
            if ($add_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Appointment Added successfully
                </div>";
                

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The Appointment could not be added. Try again!
                </div>";
            }
    }
  }
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Add Appointment</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Appointments</li>
						<li class="breadcrumb-item active">Add Appointment</li>
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
									<!-- <div class="form-group col-md-6">
										<label for="patient-name">Patient ID</label>
										<input type="text" name="patient_ID" class="form-control" placeholder="Patient ID" id="patient-id" value="<?php echo $patient_ID; ?>">
									</div> -->
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
										<label for="department">Department</label>
										<select class="form-control" id="department" name="department">
											<option value="Neuro">Neuro</option>
											<option value="Orthopaedic">Orthopaedic</option>
											<option value="Radiology">Radiology</option>
											<option value="Dental">Dental</option>
											<option value="General">General</option>
										</select>
									</div>
									
									<div class="form-group col-md-6">
										<label for="appointment-date">Appointment Date</label>
										<input type="date" name="date" placeholder="Appointment Date" class="form-control" id="appointment-date">
									</div>
									<div class="form-group col-md-6">
										<label for="time-slot">Time Slot</label>
										<select class="form-control" id="time-slot" name="time_slot">
											<option value="10AM-11AM">10AM-11AM</option>
											<option value="11AM-12pm">11AM-12pm</option>
											<option value="12PM-01PM">12PM-01PM</option>
											<option value="2PM-3PM">2PM-3PM</option>
											<option value="3PM-4PM">3PM-4PM</option>
											<option value="4PM-5PM">4PM-5PM</option>
											<option value="6PM-7PM">6PM-7PM</option>
											<option value="7PM-8PM">7PM-8PM</option>
											<option value="8PM-9PM">8PM-9PM</option>
										</select>
									</div>

									<div class="form-group col-md-6">
										<label for="department">Select Doctor</label>
										<select class="form-control" id="department" name="doctor_id">
											 <?php
                                              $docQuery = mysqli_query($conn,"SELECT * FROM doctor WHERE Status = 'Available'"); 

                                               ?>
                                               <option value="" <?php echo ((isset($_POST['doctor_id']) && $_POST['doctor_id']=='')?' selected':''); ?>></option>
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
											<option value="Pre-Bookable Appointments">Pre-Bookable Appointments</option>
											<option value="Same Day/Urgent Appointments">Same Day/Urgent Appointments</option>
											<option value="Telephone Consultations">Telephone Consultations</option>
											<option value="Health Care Assistant Appointments">Health Care Assistant Appointments</option>
											<option value="Routine checkup">Routine checkup</option>
											<option value="Others">Others</option>
										</select>
									</div>
									<div class="form-group col-md-12">
										<label for="problem">Problem</label>
										<textarea name="problem" placeholder="Problem" class="form-control" id="problem" rows="3"> <?php echo $problem; ?></textarea>
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
										<input type="submit" name="add_appointment" class="btn btn-primary btn-lg" value="Add Appointment">
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
