<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>

<?php global $conn; ?>
<?php 
if (isset($_GET['delete'])) {
    $pr_id = $_GET['delete'];
    $delete = mysqli_query($conn,"DELETE FROM patient WHERE Patient_ID = '$pr_id'");
    if ($delete) {
        echo "<script>alert('Patient Deleted Successfully')</script>";
        echo "<script>window.location = 'patients.php'</script>";
    }
}

if (isset($_GET['view'])) {
    $view_id = $_GET['view'];
    $viewquery = mysqli_query($conn,"SELECT * FROM patient WHERE Patient_ID = '$view_id'");
    $row = mysqli_fetch_array($viewquery);
    $patient_id = $row['Patient_ID'];
	$fullname = $row['Patient_First_Name'] ." ". $row['Patient_Last_Name'];
	$patient_address = $row['Patient_City'];
	$patient_email = $row['Patient_Email'];
	$patient_phone = $row['Patient_Phone'];
	$patient_dob = $row['Patient_DOB'];
	$patient_gender = $row['Patient_Gender'];
	$patient_nationality = $row['Patient_Citizenship'];

}
 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Patient Details</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Patients</li>
						<li class="breadcrumb-item active">Patient Details</li>
					</ol>
				</div>
			</div>
			<!-- /Page Title -->

			<!-- /Breadcrumb -->
			<!-- Main Content -->
			<div class="container-fluid">

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-6">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Patient Details</h3>
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable">
									<tbody>
										<tr>											
											<td><strong>Name</strong></td>
											<td><?php echo $fullname; ?></td>
										</tr>
										<tr>
											<td><strong>Date Of Birth</strong> </td>
											<td><?php echo $patient_dob ?></td>
										</tr>
										<tr>
											<td><strong>Gender</strong></td>
											<td><?php echo $patient_gender; ?></td>
										</tr>
										<tr>
											<td><strong>Address</strong></td>
											<td><?php echo $patient_address; ?></td>
										</tr>
										<tr>
											<td><strong>Phone </strong></td>
											<td><?php echo $patient_phone ?></td>
										</tr>
										<tr>
											<td><strong>Email</strong></td>
											<td><?php echo $patient_email; ?></td>
                                        </tr>
                                        <tr>
											<td><strong>Nationality</strong></td>
											<td><?php echo $patient_nationality; ?></td>
                                        </tr>										
									</tbody>
								</table>
							</div>
							
								<!--Export links-->
								<nav aria-label="Page navigation example">
									<ul class="pagination justify-content-center export-pagination">
										<li class="page-item">
											<a class="page-link dataExport" href="#" data-type="excel"><span class="ti-download"></span> csv</a>
										</li>
										<li class="page-item">
											<a class="page-link dataExport" href="#" data-type="excel"><span class="ti-printer"></span>  print</a>
										</li>
										<li class="page-item">
											<a class="page-link dataExport" href="#" data-type="pdf"><span class="ti-file"></span> PDF</a>
										</li>
										<li class="page-item">
											<a class="page-link dataExport" href="#" data-type="excel"><span class="ti-align-justify"></span> Excel</a>
										</li>
									</ul>
								</nav>
								<!-- /Export links-->
                            <a href="edit-patient.php?edit=<?php echo $patient_id; ?>"><button type="button" class="btn btn-success mb-3"><span class="ti-pencil-alt"></span> Edit Patient</button></a>
                            <a href="about-patient.php?delete=<?php echo $patient_id; ?>"><button type="button" class="btn btn-danger mb-3"><span class="ti-trash"></span> Delete Patient</button></a>
                            <button type="button" class="btn btn-info mb-3"><span class="ti-arrow-down"></span> Download File</button>
						</div>
					</div>
                    <!-- /Widget Item -->
                    <!-- Widget Item -->

					<div class="col-md-6">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Patient Appointments</h3>
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="appointment_patient" >
									<thead>
										<tr>										
											<th>Doctor Name</th>
											<th>Appointment Type</th>
											<th>Visit Day</th>
											<th>Time</th>
											<th>Doctor Email</th>
											<th>Doctor Phone</th>
											<th>Dept</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$query1 = "SELECT A.*,D.Email,D.Phone,D.First_Name,D.Last_Name FROM `appointment` A INNER JOIN `doctor` D on A.Doctor_ID = D.Doctor_ID WHERE A.Patient_ID = '$view_id'";

										$v_query = mysqli_query($conn,$query1);
										while ($row1 = mysqli_fetch_array($v_query)) {
											$appointment_id = $row1['Appointment_ID'];
											$appointment_type = $row1['Appointment_Type'];
											$fullname = $row1['First_Name'] ." ". $row1['Last_Name'];
											$department = $row1['Department'];
											$appointment_date = $row1['Appointment_Date'];
											$problem = $row1['Problem'];
											$doctor_email = $row1['Email'];
											$doctor_phone = $row1['Phone'];
											$time_slot = $row1['Appointment_Time'];
											$appointment_status = $row1['Status'];
											

										 ?>
										<tr>											
											<td><?php echo $fullname; ?></td>
											<td><?php echo $appointment_type; ?></td>
											<td><?php echo $appointment_date; ?></td>
											<td><?php echo $time_slot; ?></td>
											<td><?php echo $doctor_email; ?></td>
											<td><?php echo $doctor_phone; ?></td>
											<td><?php echo $department; ?></td>
											<?php if ($appointment_status =='Canceled'): ?>
												<td>
												<span class="badge badge-danger"><?php echo $appointment_status ?></span>
												</td>
											<?php else: ?>
												<td>
												<span class="badge badge-success"><?php echo $appointment_status ?></span>
												</td>
											<?php endif ?>
											
										</tr>

										<?php }; ?>
														
									</tbody>
								</table>
								
								<!--Export links-->
								<nav aria-label="Page navigation example">
									<ul class="pagination justify-content-center export-pagination">
										<li class="page-item">
											<a class="page-link " href="#" ><span class="ti-download"></span> csv</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#" ><span class="ti-printer"></span>  print</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#" ><span class="ti-file"></span> PDF</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#" ><span class="ti-align-justify"></span> Excel</a>
										</li>
									</ul>
								</nav>
								<!-- /Export links-->
							</div>
						</div>
					</div>



						<div class="col-md-6">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Patient Admission History</h3>
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="example1">
									<thead>
										<tr>										
											<th>Admission Date</th>
											<th>Room Number</th>
											<th>Block Number</th>
											<th>Block Code</th>
											<th>Discharge Date</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$query2 = "SELECT A.*,R.Room_No,B.Block_Floor,B.Block_Code FROM `patient_admission` A INNER JOIN `room` R on A.Room_ID = R.Room_ID INNER JOIN `building_block` B on R.Block_B_ID = B.B_ID WHERE A.Patient_ID = '$view_id' ORDER BY A.Admission_DATE DESC";

										$view_query2 = mysqli_query($conn,$query2);
										while ($row = mysqli_fetch_array($view_query2)) {
											$admission_id = $row['Admission_ID'];
											$admission_date = $row['Admission_Date'];
											$discharge_date = $row['Discharge_Date'];
											$block_floor = $row['Block_Floor'];
											$room_number = $row['Room_No'];
											$block_code = $row['Block_Code'];
											

										 ?>
										<tr>											
											<td><?php echo $admission_date ?></td>
											<td><?php echo $room_number ?></td>
											<td><?php echo $block_floor ?></td>
											<td><?php echo $block_code ?></td>
											<td><?php echo $discharge_date ?></td>
											
										</tr>

										<?php }; ?>
																	
									</tbody>
									
								</table>
								
								<!--Export links-->
								<nav aria-label="Page navigation example">
									<ul class="pagination justify-content-center export-pagination">
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-download"></span> csv</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-printer"></span>  print</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-file"></span> PDF</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-align-justify"></span> Excel</a>
										</li>
									</ul>
								</nav>
								<!-- /Export links-->
							</div>
						</div>
					</div>

						<div class="col-md-6">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Patient Medical Bills</h3>
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="patient_record">
									<thead>
										<tr>										
											<th>Doctor Charges</th>
											<th>Medicine Charges</th>
											<th>Room Charges</th>
											<th>Lab Charges</th>
											<th>Nurse Charges</th>
											<th>Radiology Charges</th>
											<th>Miscelleneous Charges</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$query3 = "SELECT * FROM `hospital_bills` WHERE Patient_ID = '$view_id' ORDER BY Bill_ID DESC";

										$view_query3 = mysqli_query($conn,$query3);
										while ($row = mysqli_fetch_array($view_query3)) {
											$doc_charges = $row['Doctor_charges'];
											$Medicine_Charge = $row['Medicine_Charge'];
											$Room_Charge = $row['Room_Charge'];
											$Lab_Charge = $row['Lab_Charge'];
											$Nurse_Charge = $row['Nurse_Charge'];
											$Radiology_Charges = $row['Radiology_Charges'];
											$Bill_Status = $row['Bill_Status'];
											$Misc_Charge = $row['Miscelleneous_Charges'];

											

										 ?>
										<tr>											
											<td><?php echo $doc_charges ?></td>
											<td><?php echo $Medicine_Charge ?></td>
											<td><?php echo $Room_Charge ?></td>
											<td><?php echo $Lab_Charge ?></td>
											<td><?php echo $Nurse_Charge ?></td>
											<td><?php echo $Radiology_Charges ?></td>
											<td><?php echo $Misc_Charge ?></td>
											<td><?php echo $Bill_Status ?></td>
											
										</tr>

										<?php }; ?>
																	
									</tbody>
									
								</table>
								
								<!--Export links-->
								<nav aria-label="Page navigation example">
									<ul class="pagination justify-content-center export-pagination">
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-download"></span> csv</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-printer"></span>  print</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-file"></span> PDF</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-align-justify"></span> Excel</a>
										</li>
									</ul>
								</nav>
								<!-- /Export links-->
							</div>
						</div>
					</div>


                    <!-- /Widget Item -->
                     <!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Patient Medical Bills</h3>
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="bills_patient">
									<thead>
										<tr>										
											<th>Date</th>
											<th><b>&#165</b> Doctor Charges</th>
											<th><b>&#165</b> Medicine Charges</th>
											<th><b>&#165</b> Room Charges</th>
											<th><b>&#165</b> Lab Charges</th>
											<th><b>&#165</b> Nurse Charges</th>
											<th><b>&#165</b> Radiology Charges</th>
											<th><b>&#165</b> Miscelleneous Charges</th>
											<th><b>&#x25;</b> Discount</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<?php 
										$query3 = "SELECT * FROM `hospital_bills` WHERE Patient_ID = '$view_id' ORDER BY Bill_ID DESC";

										$view_query3 = mysqli_query($conn,$query3);
										while ($row = mysqli_fetch_array($view_query3)) {
											$Bill_Date = $row['Bill_Date'];
											$doc_charges = $row['Doctor_charges'];
											$Medicine_Charge = $row['Medicine_Charge'];
											$Room_Charge = $row['Room_Charge'];
											$Lab_Charge = $row['Lab_Charge'];
											$Nurse_Charge = $row['Nurse_Charge'];
											$Radiology_Charges = $row['Radiology_Charges'];
											$Bill_Status = $row['Bill_Status'];
											$Bill_Discount = $row['Bill_Discount'];
											$Misc_Charge = $row['Miscelleneous_Charges'];

											

										 ?>											
											<td><?php echo $Bill_Date ?></td>
											<td><?php echo $doc_charges ?></td>
											<td><?php echo $Medicine_Charge ?></td>
											<td><?php echo $Room_Charge ?></td>
											<td><?php echo $Lab_Charge ?></td>
											<td><?php echo $Nurse_Charge ?></td>
											<td><?php echo $Radiology_Charges ?></td>
											<td><?php echo $Misc_Charge ?></td>
											<td><?php echo $Bill_Discount ?></td>

											<?php if ($Bill_Status =='UNPAID'): ?>
												<td>
												<span class="badge badge-danger"><?php echo $Bill_Status ?></span>
												</td>
											<?php else: ?>
												<td>
												<span class="badge badge-success"><?php echo $Bill_Status ?></span>
												</td>
											<?php endif ?>
                                        </tr>

                                        <?php }; ?>
                                       							
									</tbody>
									
								</table>
								
								<!--Export links-->
								<nav aria-label="Page navigation example">
									<ul class="pagination justify-content-center export-pagination">
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-download"></span> csv</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-printer"></span>  print</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-file"></span> PDF</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-align-justify"></span> Excel</a>
										</li>
									</ul>
								</nav>
								<!-- /Export links-->
							</div>
						</div>
					</div>

						<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Patient Payment Transactions</h3>
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>										
											<th>Date</th>
											<th><b>&#165</b> Amount</th>
											<th>Payment Type</th>
											<th>Invoive</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<?php 
										$query4 = "SELECT P.*,B.* FROM `payment` P INNER JOIN `hospital_bills` B ON P.Bill_ID=B.Bill_ID WHERE B.Patient_ID = '$view_id' ORDER BY P.Payment_Date DESC";

										$view_query4 = mysqli_query($conn,$query4);
										while ($row = mysqli_fetch_array($view_query4)) {
											$Payment_Date = $row['Payment_Date'];
											$Payment_ID = $row['payment_ID'];
											$doc_charges = $row['Doctor_charges'];
											$Medicine_Charge = $row['Medicine_Charge'];
											$Room_Charge = $row['Room_Charge'];
											$Lab_Charge = $row['Lab_Charge'];
											$Nurse_Charge = $row['Nurse_Charge'];
											$Radiology_Charges = $row['Radiology_Charges'];
											$Payment_Status = $row['Payment_Status'];
											$Payment_Type = $row['Payment_Type'];
											$Misc_Charge = $row['Miscelleneous_Charges'];
											$a = array($doc_charges,$Medicine_Charge,$Room_Charge,$Lab_Charge,$Nurse_Charge,$Radiology_Charges,$Misc_Charge);
    										$amount = array_sum($a);


											

										 ?>											
											<td><?php echo $Payment_Date ?></td>
											<td><?php echo $amount ?></td>
											<td><?php echo $Payment_Type ?></td>
				
											<td><button type="button" class="btn btn-outline-info mb-0" onclick="location.href='about-payment.php?view=<?php echo $Payment_ID; ?>';"><span class="ti-arrow-down"></span> Invoice</button></td>
											<td><span class="badge badge-warning"><?php echo $Payment_Status ?></span></td>
                                        </tr>

                                        <?php }; ?>
                                       							
									</tbody>
								</table>
								
								<!--Export links-->
								<nav aria-label="Page navigation example">
									<ul class="pagination justify-content-center export-pagination">
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-download"></span> csv</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-printer"></span>  print</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-file"></span> PDF</a>
										</li>
										<li class="page-item">
											<a class="page-link" href="#"><span class="ti-align-justify"></span> Excel</a>
										</li>
									</ul>
								</nav>
								<!-- /Export links-->
							</div>
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