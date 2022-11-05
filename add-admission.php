<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;

   $Room_ID = ((isset($_POST['Room_ID']))?mysqli_real_escape_string($conn, $_POST['Room_ID']):'');
   $patient_ID = ((isset($_POST['patient_ID']))?mysqli_real_escape_string($conn, $_POST['patient_ID']):'');
   

if (isset($_POST['add_admission'])) {

		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
	    $admission_date = $_POST['admission_date'];
	    $discharge_date = $_POST['discharge_date'];
    
        if (empty($patient_ID)) {
            $errors[] = "Select a Patient!";
        }
        if (empty($Room_ID)) {
            $errors[] = "Select a Room!";
        }

        if (empty($admission_date)) {
            $errors[] = "Choose Admission Date!";
        }
        
           if (!empty($errors)) {
              echo display_error($errors);
        } else {
        
        $addsql = "INSERT INTO patient_admission(Admission_Date,Discharge_Date,Patient_ID,Room_ID)
        VALUES('$admission_date','$discharge_date','$patient_ID','$Room_ID')";
        $add_query = mysqli_query($conn,$addsql);
            if ($add_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Patient Admitted successfully
                </div>";
                

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The Admission failed. Try again!
                </div>";
            }
    }
  }
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Admission</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Admission</li>
						<li class="breadcrumb-item active">Admit Patient</li>
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
							<h3 class="widget-title">Admit Patient</h3>
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
										<label for="appointment-date">Admission Date</label>
										<input type="date" name="admission_date" placeholder="Admission Date" class="form-control" id="appointment-date">
									</div>

									<div class="form-group col-md-6">
										<label for="appointment-date">Discharge Date</label>
										<input type="date" name="discharge_date" placeholder="Discharge Date" class="form-control" id="appointment-date">
									</div>
									
									<div class="form-group col-md-6">
										<label for="department">Select Room</label>
										<select class="form-control" id="department" name="Room_ID">
											 <?php
                                              $roomQuery = mysqli_query($conn,"SELECT R.*,B.Block_Floor FROM `Room` R INNER JOIN `building_block` B ON R.Block_B_ID=B.B_ID WHERE Status = 'Available'"); 

                                               ?>
                                               <option value="" <?php echo ((isset($_POST['Room_ID']) && $_POST['Room_ID']=='')?' selected':''); ?>></option>
                                              <?php while ($roomResult = mysqli_fetch_array($roomQuery)) {
                                                $room_no = $roomResult['Room_No'] ." ". $roomResult['Block_Floor'];
                                               ?>
                                                <option value="<?php echo $roomResult['Room_ID']; ?>" <?php echo ((isset($_POST['Room_ID']) && $_POST['Room_ID']==$roomResult['Room_ID'])?' selected':''); ?>><?php echo $room_no; ?></option>
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
										<input type="submit" name="add_admission" class="btn btn-primary btn-lg" value="Admit Patient">
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
