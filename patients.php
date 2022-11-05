<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>

<?php global $conn; ?>
<?php 
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $delete = mysqli_query($conn,"DELETE FROM patient WHERE Patient_ID = '$post_id'");
    if ($delete) {
        echo "<script>alert('Patient Deleted Successfully')</script>";
        echo "<script>window.location = 'patients.php'</script>";
    }
}
if (isset($_POST['delete_category'])) {
  if (isset($_POST['post'])) {
    foreach ($_POST['post'] as $key => $value) {
      $delete_query = mysqli_query($conn,"DELETE FROM patient WHERE Patient_ID = '$value'");
    }
   echo "<script>alert('The selected Patient deleted Successfully')</script>";
   echo "<script>window.location='patients.php'</script>";
  }else{
    echo "<script>alert('Please select post to delete first')</script>";
    echo "<script>window.location='patients.php'</script>";
  }
  
}

 ?>

			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Patients</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Patients</li>
						<li class="breadcrumb-item active">All Patients</li>
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
							<h3 class="widget-title">Patients List</h3>							
							<div class="table-responsive mb-3">
								<table id="tableId" class="table table-bordered table-striped" id="all_patient">
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
											<th>DOB</th>
											<th>Phone</th>
											<th>Email</th>
											<th>Gender</th>
											<th>Nationality</th>
											<th>Address</th>
											<th>Action ???</th>
										</tr>
									</thead>
									<tbody>

										<?php 
										$view_query = mysqli_query($conn,"SELECT * FROM patient");
										while ($row = mysqli_fetch_array($view_query)) {
											$patient_id = $row['Patient_ID'];
											$fullname = $row['Patient_First_Name'] ." ". $row['Patient_Last_Name'];
											$patient_address = $row['Patient_City'];
											$patient_email = $row['Patient_Email'];
											$patient_phone = $row['Patient_Phone'];
											$patient_dob = $row['Patient_DOB'];
											$nationality = $row['Patient_Citizenship'];
											$patient_gender = $row['Patient_Gender'];
										


										 ?>
										<tr>
											<td>
                      	<input type="checkbox" name="post[]" value="<?php echo $patient_id; ?>">
                      </td>
											<td><?php echo $patient_id ?></td>
											<td><?php echo $fullname ?></td>
											<td><?php echo $patient_dob ?></td>
											<td><?php echo $patient_phone; ?></td>
											<td><?php echo $patient_email ?></td>
											<td><?php echo $patient_gender ?></td>
											<td><?php echo $nationality ?></td>
											<td><?php echo $patient_address ?></td>
											
										
											
											<td>
	                      <a href="edit-patient.php?edit=<?php echo $patient_id; ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
	                          
	                       <a href="patients.php?delete=<?php echo $patient_id; ?>" class="btn btn-xs btn-danger"><span class="fa fa-remove"></span></a>

	                       <a href="about-patient.php?view=<?php echo $patient_id; ?>" class="btn btn-xs btn-info"><span class="fa fa-eye"></span></a>
	                          
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
