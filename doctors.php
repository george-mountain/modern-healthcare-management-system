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
if (isset($_POST['delete_category'])) {
  if (isset($_POST['post'])) {
    foreach ($_POST['post'] as $key => $value) {
      $delete_query = mysqli_query($conn,"DELETE FROM doctor WHERE Doctor_ID = '$value'");
    }
   echo "<script>alert('The selected doctors deleted Successfully')</script>";
   echo "<script>window.location='doctors.php'</script>";
  }else{
    echo "<script>alert('Please select doctors to delete first')</script>";
    echo "<script>window.location='doctors.php'</script>";
  }
  
}

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Doctors</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Doctors</li>
						<li class="breadcrumb-item active">All Doctors</li>
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
							<h3 class="widget-title">Doctors List</h3>
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
											<th>Doctor ID</th>
											<th>Doctor Name</th>
											<th>Phone</th>
											<th>Email</th>
											<th>Department</th>
											<th>Gender</th>
											<th>Age</th>
											<th>Profile Image</th>
											<th>Status</th>
											<th>Actions???</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$view_query = mysqli_query($conn,"SELECT * FROM doctor ORDER BY Doctor_ID DESC");
										while ($row = mysqli_fetch_array($view_query)) {
											$doctor_id = $row['Doctor_ID'];
											$fullname = $row['First_Name'] ." ". $row['Last_Name'];
											$doctor_email = $row['Email'];
											$doctor_phone = $row['Phone'];
											$doctor_dob = $row['DOB'];
											$doctor_gender = $row['Gender'];
											$doctor_image = $row['Profile_Image'];
											$doctor_status = $row['Status'];
											$doctor_specialization = $row['Department'];
											
										


										 ?>
										<tr>
											<td>
                      	<input type="checkbox" name="post[]" value="<?php echo $doctor_id; ?>">
                      </td>

											<td><?php echo $doctor_id; ?></td>
											<td><?php echo $fullname ?></td>
											<td><?php echo $doctor_phone ?></td>
											<td><?php echo $doctor_email ?></td>
											<td><?php echo $doctor_specialization; ?></td>
											<td><?php echo $doctor_gender ?></td>
											<td><?php echo $doctor_dob ?></td>
											
											<td style="margin-left:6%; width:200px;"><img src="images/<?php echo $doctor_image; ?>" style="height:200px;width:100%;"></td>
											
											<?php if ($doctor_status =='Not Available' OR $doctor_status =='On Leave'): ?>
												<td>
												<span class="badge badge-danger"><?php echo $doctor_status ?></span>
												</td>
											<?php else: ?>
												<td>
												<span class="badge badge-success"><?php echo $doctor_status ?></span>
												</td>
											<?php endif ?>
											<td>
                                                <a href="edit-doctor.php?edit=<?php echo $doctor_id; ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
                                                    
                                                 <a href="doctors.php?delete=<?php echo $doctor_id; ?>" class="btn btn-xs btn-danger"><span class="fa fa-remove"></span></a>

                                                 <a href="about-doctor.php?view=<?php echo $doctor_id; ?>" class="btn btn-xs btn-info"><span class="fa fa-eye"></span></a>
                                                    
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
	<!-- /Back to Top -->
	<!-- Jquery Library-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<!-- Popper Library-->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap Library-->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Datatable  -->
	<script src="datatable/jquery.dataTables.min.js"></script>
	<script src="datatable/dataTables.bootstrap4.min.js"></script>
    
	<!-- Custom Script-->
	<script src="js/custom.js"></script>
	<script src="js/custom-datatables.js"></script>
</body>

</html>
