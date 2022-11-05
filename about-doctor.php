<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>

<?php global $conn; ?>
<?php 
if (isset($_GET['delete'])) {
    $dr_id = $_GET['delete'];
    $delete = mysqli_query($conn,"DELETE FROM doctor WHERE Doctor_ID = '$dr_id'");
    if ($delete) {
        echo "<script>alert('Doctor Deleted Successfully')</script>";
        echo "<script>window.location = 'doctors.php'</script>";
    }
}

if (isset($_GET['view'])) {
    $view_id = $_GET['view'];
    $viewQuery = mysqli_query($conn,"SELECT * FROM doctor WHERE Doctor_ID = '$view_id'");
    $row = mysqli_fetch_array($viewQuery);
    $doctor_id = $row['Doctor_ID'];
    $first_name = $row['First_Name'];
    $last_name = $row['Last_Name'];
    $fullname = $first_name." ". $last_name;
    $doctor_address = $row['City'];
    $doctor_email = $row['Email'];
    $doctor_phone = $row['Phone'];
    $doctor_dob = $row['DOB'];
    $doctor_image = $row['Profile_Image'];
    $doctor_status = $row['Status'];
    $doctor_gender = $row['Gender'];
    $doctor_detail = $row['Details'];
    $doctor_specialization = $row['Department'];
    $doctor_availability = $row['Phone'];
    $today = date("Y-m-d");
    $diff = date_diff(date_create($doctor_dob), date_create($today));
  }


 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Doctor Details</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Doctors</li>
						<li class="breadcrumb-item active">Doctor Details</li>
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
                            <h3 class="widget-title">Doctor Details</h3>
                            <div class="row no-mp">
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <img class="card-img-top" src="images/<?php echo $doctor_image; ?>" alt="Card image">
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo $fullname ?></h4>
                                            <p class="card-text"><?php echo $doctor_detail ?></p>
                                            <a href="edit-doctor.php?edit=<?php echo $doctor_id; ?>"><button type="button" class="btn btn-success mb-2"><span class="ti-pencil-alt"></span> Edit
                                                Doctor</button></a>
                                            <a href="about-doctor.php?delete=<?php echo $doctor_id; ?>"><button type="button" class="btn btn-danger"><span class="ti-trash"></span> Delete
                                                Doctor</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Specialization</strong></td>
                                                    <td><?php echo $doctor_specialization ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Gender</strong></td>
                                                    <td><?php echo $doctor_gender ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>City</strong></td>
                                                    <td><?php echo $doctor_address ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone</strong> </td>
                                                    <td><?php echo $doctor_phone ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Age</strong> </td>
                                                    <td><?php echo $diff->format('%y') ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email</strong></td>
                                                    <td><?php echo $doctor_email ?></td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Status</strong></td>
                                                    <td><?php echo $doctor_status ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--Export links-->
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center export-pagination">
                                                <li class="page-item">
                                                    <a class="page-link" href="#"><span class="ti-download"></span> csv</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#"><span class="ti-printer"></span> print</a>
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
                
                        </div>
                    </div>
                    <!-- /Widget Item -->
                    <!-- Widget Item -->
                    <?php $countQuery = mysqli_query($conn,"SELECT * FROM appointment WHERE Doctor_ID = '$view_id'");
                    $count_appt = mysqli_num_rows($countQuery); 

                    ?>
                    <?php if (!empty($count_appt)): ?>
                        
                    
                    <div class="col-md-12">
                        <div class="widget-area-2 proclinic-box-shadow">
                            <h3 class="widget-title">Doctor Activity</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Patient Name</th>
                                            <th>Appointment Type</th>
                                            <th>Visit Day</th>
                                            <th>Time</th>
                                            <th>Patient Email</th>
                                            <th>Patient Phone</th>
                                            <th>Patient Gender</th>
                                            <th>Patient Age</th>
                                            <th>Problem</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $query1 = "SELECT A.*,P.* FROM `appointment` A INNER JOIN `patient` P on A.Patient_ID = P.Patient_ID WHERE A.Doctor_ID = '$view_id'";

                                        $v_query = mysqli_query($conn,$query1);
                                        while ($row1 = mysqli_fetch_array($v_query)) {
                                            $appointment_id = $row1['Appointment_ID'];
                                            $appointment_type = $row1['Appointment_Type'];
                                            $fullname = $row1['Patient_First_Name'] ." ". $row1['Patient_Last_Name'];
                                            $department = $row1['Department'];
                                            $appointment_date = $row1['Appointment_Date'];
                                            $problem = $row1['Problem'];
                                            $patient_email = $row1['Patient_Email'];
                                            $patient_dob = $row1['Patient_DOB'];
                                            $patient_gender = $row1['Patient_Gender'];
                                            $patient_phone = $row1['Patient_Phone'];
                                            $time_slot = $row1['Appointment_Time'];
                                            $appointment_status = $row1['Status'];
                                            $now = date("Y-m-d");
                                            $diff_age = date_diff(date_create($patient_dob), date_create($now));
                                            

                                         ?>
                                        <tr>
                                            <td><?php echo $fullname; ?></td>
                                            <td><?php echo $appointment_type; ?></td>
                                            <td><?php echo $appointment_date; ?></td>
                                            <td><?php echo $time_slot; ?></td>
                                            <td><?php echo $patient_email; ?></td>
                                            <td><?php echo $patient_phone; ?></td>
                                            <td><?php echo $patient_gender; ?></td>
                                            <td><?php echo $diff_age->format('%y') ?></td>
                                            <td><?php echo $problem; ?></td>
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
                                            <a class="page-link" href="#"><span class="ti-download"></span> csv</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><span class="ti-printer"></span> print</a>
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
                    <?php endif ?>
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
