<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>

<?php global $conn; ?>
<?php 
if (isset($_GET['delete'])) {
    $ap_id = $_GET['delete'];
    $delete = mysqli_query($conn,"DELETE FROM appointment WHERE Appointment_ID = '$ap_id'");
    if ($delete) {
        echo "<script>alert('Appointment Deleted Successfully')</script>";
        echo "<script>window.location = 'appointments.php'</script>";
    }
}
if (isset($_POST['delete_category'])) {
  if (isset($_POST['post'])) {
    foreach ($_POST['post'] as $key => $value) {
      $delete_query = mysqli_query($conn,"DELETE FROM appointment WHERE Appointment_ID = '$value'");
    }
   echo "<script>alert('The selected appointment deleted Successfully')</script>";
   echo "<script>window.location='appointments.php'</script>";
  }else{
    echo "<script>alert('Please select appointment to delete first')</script>";
    echo "<script>window.location='appointments.php'</script>";
  }
  
}
 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Appointments</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
						</li>
						<li class="breadcrumb-item">Appointments</li>
						<li class="breadcrumb-item active">Appointments List</li>
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
							<form method="post">
							<h3 class="widget-title">Appointments List</h3>
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="no-sort">
												<div class="custom-control custom-checkbox">
													<input class="custom-control-input" type="checkbox" id="select-all">
													<label class="custom-control-label" for="select-all"></label>
												</div>
											</th>
											<th>Patient ID</th>
											<th>Patient Name</th>
											<th>Patient Phone</th>
											<th>Patient Email</th>
											<th>Doctor Name</th>
											<th>Doctor Phone</th>
											<th>Doctor Email</th>
											<th>Date</th>
											<th>Time</th>
											<th>Department</th>
											<th>Problem</th>
											<th>Status</th>
											<th>Action???</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$query = "SELECT A.*,P.Patient_First_Name, P.Patient_Last_Name,P.Patient_Phone,P.Patient_Email,D.Email,D.Phone,D.First_Name,D.Last_Name FROM `appointment` A INNER JOIN `patient` P ON A.Patient_ID=P.Patient_ID INNER JOIN `doctor` D on A.Doctor_ID = D.Doctor_ID";

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
											<td>
                      	<input type="checkbox" name="post[]" value="<?php echo $appointment_id; ?>">
                      </td>
											<td><?php echo $patient_id; ?></td>
											<td><?php echo $patient_name; ?></td>
											<td><?php echo $patient_phone; ?></td>
											<td><?php echo $patient_email; ?></td>
											<td><?php echo $fullname ?></td>
											<td><?php echo $doctor_phone ?></td>
											<td><?php echo $doctor_email ?></td>
											<td><?php echo $appointment_date ?></td>
											<td><?php echo $time_slot ?></td>
											<td><?php echo $department ?></td>
											<td><?php echo $problem ?></td>
											<?php if ($appointment_status =='Canceled' OR $appointment_status =='Pending'): ?>
												<td>
												<span class="badge badge-danger"><?php echo $appointment_status ?></span>
												</td>
											<?php else: ?>
												<td>
												<span class="badge badge-success"><?php echo $appointment_status ?></span>
												</td>
											<?php endif ?>
											<td>
	                      <a href="edit-appointment.php?edit=<?php echo $appointment_id; ?>" class="btn btn-sm btn-info"><span class="fa fa-pencil"></span></a>
	                      <a href="appointments.php?delete=<?php echo $appointment_id; ?>" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span></a>

	                    </td>
											
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
								<button type="submit" class="btn btn-danger mt-3 mb-0" name="delete_category"><span class="ti-trash"></span> DELETE</button>
							</div>
						</div>
					</div>
					</form>
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