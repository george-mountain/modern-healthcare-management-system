
<?php include("header.php"); ?>
		
<!-- Sidebar -->
<?php include("sidebar.php"); ?>
<!-- /Sidebar -->
<?php include("top_navigation_bar.php");?>
	
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Quick Statistics</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
						</li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div>
			</div>
			<!-- /Page Title -->

			<!-- /Breadcrumb -->
			<!-- Main Content -->
			<div class="container-fluid home">


				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-4">
						<div class="widget-area proclinic-box-shadow color-red">
							<div class="widget-left">
								<span class="ti-user"></span>
							</div>
							<div class="widget-right">
								<?php $countQuery = mysqli_query($conn,"SELECT * FROM patient ");
			                    $count_patient = mysqli_num_rows($countQuery); 

			                    ?>
								<h4 class="wiget-title">Patients</h4>
								<span class="numeric color-red"><?php echo $count_patient ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-up"></span> total number of patients</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-md-4">
						<div class="widget-area proclinic-box-shadow color-green">
							<div class="widget-left">
								<span class="ti-bar-chart"></span>
							</div>
							<div class="widget-right">
								<?php $countQuery1 = mysqli_query($conn,"SELECT * FROM appointment ");
			                    $count_appt = mysqli_num_rows($countQuery1); 

			                    ?>
								<h4 class="wiget-title">Appointments</h4>
								<span class="numeric color-green"><?php echo $count_appt ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-up"></span> current appointment</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-md-4">
						<div class="widget-area proclinic-box-shadow color-yellow">
							<div class="widget-left">
								<span class="ti-money"></span>
							</div>
							<div class="widget-right">
								<?php 
								$query4 = "SELECT P.*,B.* FROM `payment` P INNER JOIN `hospital_bills` B ON P.Bill_ID=B.Bill_ID WHERE P.Payment_Status = 'Completed'";

								$view_query4 = mysqli_query($conn,$query4);
								$total_revenue = 0;
								while ($row = mysqli_fetch_array($view_query4)) {
								    $Bill_Discount = $row['Bill_Discount'];
								    $doc_charges = $row['Doctor_charges'];
								    $total_doc_charges = $doc_charges - ($doc_charges * $Bill_Discount * 0.01);
								    $Medicine_Charge = $row['Medicine_Charge'];
								    $total_med_charges = $Medicine_Charge - ($Medicine_Charge * $Bill_Discount * 0.01);
								    $Room_Charge = $row['Room_Charge'];
								    $total_room_charges = $Room_Charge - ($Room_Charge * $Bill_Discount * 0.01);
								    $Lab_Charge = $row['Lab_Charge'];
								    $total_lab_charges = $Lab_Charge - ($Lab_Charge * $Bill_Discount * 0.01);
								    $Nurse_Charge = $row['Nurse_Charge'];
								    $total_nurse_charges = $Nurse_Charge- ($Nurse_Charge * $Bill_Discount * 0.01);
								    $Radiology_Charges = $row['Radiology_Charges'];
								    $total_rad_charges = $Radiology_Charges - ($Radiology_Charges * $Bill_Discount * 0.01);
								    $Payment_Status = $row['Payment_Status'];
								    $Payment_Type = $row['Payment_Type'];
								    $Misc_Charge = $row['Miscelleneous_Charges'];
								    $total_misc_charges = $Misc_Charge  - ($Misc_Charge * $Bill_Discount * 0.01);
								    $a = array($total_doc_charges,$total_med_charges,$total_room_charges,$total_lab_charges,$total_nurse_charges,$total_rad_charges,$total_misc_charges);
								    $amount = array_sum($a);
								    $total_revenue = $total_revenue + $amount;

								};

								 ?>
								<h4 class="wiget-title">Total Revenue</h4>
								<span class="numeric color-yellow">&#165;<?php echo $total_revenue; ?></span>
								<p class="inc-dec mb-0"><span class="ti-angle-up"></span> +total revenue generated</p>
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-6">
						<?php 
						
						$query_doc = "SELECT Status,COUNT(*) as counter FROM `doctor` GROUP BY Status";
						$view_doc = mysqli_query($conn,$query_doc);
						$chart_data_doc = '';
						while($row = mysqli_fetch_array($view_doc))
						{
						 $chart_data_doc .= "{label:'".$row["Status"]."', value:".$row["counter"]."}, ";
						}
						
						?>
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Status of Doctors</h3>
							<div id="lineMorris_doc" class="chart-home"></div>
						</div>
					</div>
					<!-- /Widget Item -->
					<!-- Widget Item -->
					<div class="col-sm-6">
						<?php 
						
						$query4 = "SELECT Status,COUNT(*) as counter FROM `appointment` GROUP BY Status";
						$view_query4 = mysqli_query($conn,$query4);
						$chart_data = '';
						while($row = mysqli_fetch_array($view_query4))
						{
						 $chart_data .= "{label:'".$row["Status"]."', value:".$row["counter"]."}, ";
						}
						
						?>
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Appointments Status</h3>
							<div id="chart" class="chart-home"></div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>

				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-12">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Appointments</h3>
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Patient Name</th>
											<th>Doctor</th>
											<th>Check-Up</th>
											<th>Date</th>
											<th>Time</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$query = "SELECT A.*,P.Patient_First_Name, P.Patient_Last_Name,P.Patient_Phone,P.Patient_Email,D.Email,D.Phone,D.First_Name,D.Last_Name FROM `appointment` A INNER JOIN `patient` P ON A.Patient_ID=P.Patient_ID INNER JOIN `doctor` D on A.Doctor_ID = D.Doctor_ID ORDER BY Appointment_ID LIMIT 10";

										$view_query = mysqli_query($conn,$query);
										while ($row = mysqli_fetch_array($view_query)) {
											$appointment_id = $row['Appointment_ID'];
											$appointment_type = $row['Appointment_Type'];
											$fullname = $row['First_Name'] ." ". $row['Last_Name'];
											$department = $row['Department'];
											$appointment_date = $row['Appointment_Date'];
											$problem = $row['Problem'];
											$time_slot = $row['Appointment_Time'];
											$appointment_status = $row['Status'];
											$patient_id = $row['Patient_ID'];
											$doctor_id = $row['Doctor_ID'];
											$patient_phone = $row['Patient_Phone'];
											$patient_name = $row['Patient_First_Name'] ." ". $row['Patient_Last_Name'];
											$patient_email = $row['Patient_Email'];
											$doctor_email = $row['Email'];
											$doctor_phone = $row['Phone'];
											
										


										 ?>
										<tr>
											<td><?php echo $patient_name; ?></td>
											<td><?php echo $fullname; ?></td>
											<td><?php echo $department; ?></td>
											<td><?php echo $appointment_date; ?></td>
											<td><?php echo $time_slot; ?></td>
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
							</div>
						</div>
					</div>
					<!-- /Widget Item -->
				</div>

				<div class="row">
					<!-- Widget Item -->
					
					<div class="col-md-12">
						<div class="widget-area-2 progress-status proclinic-box-shadow">
							<h3 class="widget-title">Doctors Availability</h3>
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Doctor</th>
											<th>Speciality</th>
											<th>Profile Photo</th>
											<th>Availability</th>
											<th>Email</th>
											<th>Phone</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$view_query = mysqli_query($conn,"SELECT * FROM doctor WHERE Status = 'Available' ORDER BY Doctor_ID DESC");
										while ($row = mysqli_fetch_array($view_query)) {
											$fullname = $row['First_Name'] ." ". $row['Last_Name'];
											$doctor_image = $row['Profile_Image'];
											$doctor_email = $row['Email'];
											$doctor_phone = $row['Phone'];
											$doctor_status = $row['Status'];
											$doctor_specialization = $row['Department'];
											
										


										 ?>
										<tr>
											<td><?php echo $fullname; ?></td>
											<td><?php echo $doctor_specialization ;?></td>
											<td style="margin-left:6%; width:200px;"><img src="images/<?php echo $doctor_image; ?>" style="height:200px;width:100%;"></td>
											<td><?php echo $doctor_email; ?></td>
											<td><?php echo $doctor_phone; ?></td>
											<td>
												<span class="badge badge-success">Available</span>
											</td>
										</tr>
									<?php }; ?>
										
									</tbody>
								</table>
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
	<!-- /Back to Top -->
	
	<!-- Jquery Library-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<!-- Popper Library-->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap Library-->
	<script src="js/bootstrap.min.js"></script>
	<!-- morris charts -->
	<script src="charts/js/raphael-min.js"></script>
	<script src="charts/js/morris.min.js"></script>
	<script src="js/custom-morris.js"></script>

	<!-- Custom Script-->
	<script src="js/custom.js"></script>
</body>
<script>
if($("#chart").length == 1){
   var $donutData = [
   
    <?php echo $chart_data; ?>
  ];
  Morris.Donut({
    element: 'chart',
    data: $donutData,
    barSize: 0.1,
    labelColor: '#3e5569',
    resize: true, //defaulted to true
    colors: ['#FFAA2A', '#ef6e6e', '#22c6ab','#800080']
  });
  }

  if($("#lineMorris_doc").length == 1){
   var $donutData = [
   
    <?php echo $chart_data_doc; ?>
  ];
  Morris.Donut({
    element: 'lineMorris_doc',
    data: $donutData,
    barSize: 0.1,
    labelColor: '#3e5569',
    resize: true, //defaulted to true
    colors: ['#6699cc', '#b36a39', '#FFA500','#3248a8']
  });
  }
</script>

</html>
