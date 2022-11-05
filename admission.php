<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>

<?php global $conn; ?>
<?php 
if (isset($_GET['delete'])) {
    $ad_id = $_GET['delete'];
    $delete = mysqli_query($conn,"DELETE FROM patient_admission WHERE Admission_ID = '$ad_id'");
    if ($delete) {
        echo "<script>alert('Admission Deleted Successfully')</script>";
        echo "<script>window.location = 'admission.php'</script>";
    }
}
if (isset($_POST['delete_category'])) {
  if (isset($_POST['post'])) {
    foreach ($_POST['post'] as $key => $value) {
      $delete_query = mysqli_query($conn,"DELETE FROM admission WHERE Admission_ID = '$value'");
    }
   echo "<script>alert('The selected admissions deleted Successfully')</script>";
   echo "<script>window.location='admission.php'</script>";
  }else{
    echo "<script>alert('Please select admissions to delete first')</script>";
    echo "<script>window.location='admission.php'</script>";
  }
  
}

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Admissions</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Admissions</li>
						<li class="breadcrumb-item active">Admission List</li>
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
							<h3 class="widget-title">Admission List</h3>
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
											<th>Admission ID</th>
											<th>Admission Date</th>
											<th>Discharge Date</th>
											<th>Patient Name</th>
											<th>Room Number</th>
											<th>Block Number</th>
											<th>Block Code</th>
											<th>Action ???</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$query = "SELECT A.*,P.Patient_First_Name, P.Patient_Last_Name,R.Room_No,B.Block_Floor,B.Block_Code FROM `patient_admission` A INNER JOIN `patient` P ON A.Patient_ID=P.Patient_ID INNER JOIN `room` R on A.Room_ID = R.Room_ID INNER JOIN `building_block` B on R.Block_B_ID = B.B_ID";

										$view_query = mysqli_query($conn,$query);
										while ($row = mysqli_fetch_array($view_query)) {
											$admission_id = $row['Admission_ID'];
											$admission_date = $row['Admission_Date'];
											$fullname = $row['Patient_First_Name'] ." ". $row['Patient_Last_Name'];
											$discharge_date = $row['Discharge_Date'];
											$block_floor = $row['Block_Floor'];
											$room_number = $row['Room_No'];
											$block_code = $row['Block_Code'];
											

										 ?>
										<tr>
											<td>
												<div class="custom-control custom-checkbox">
													<input class="custom-control-input" type="checkbox" id="1">
													<label class="custom-control-label" for="1"></label>
												</div>
											</td>
											<td><?php echo $admission_id ?></td>
											<td><?php echo $admission_date; ?></td>
											<td><?php echo $discharge_date; ?></td>
											<td><?php echo $fullname; ?></td>
											<td><?php echo $room_number; ?></td>
											<td><?php echo $block_floor; ?></td>
											<td><?php echo $block_code ?></td>
											<td>
	                      <a href="edit-admission.php?edit=<?php echo $admission_id; ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
	                          
	                       <a href="admission.php?delete=<?php echo $admission_id; ?>" class="btn btn-xs btn-danger"><span class="fa fa-remove"></span></a>
	                          
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
								<button type="button" class="btn btn-danger mt-3 mb-0"><span class="ti-trash"></span> DELETE</button>
								<button type="button" class="btn btn-primary mt-3 mb-0"><span class="ti-pencil-alt"></span> EDIT</button>
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
    
    <!-- Datatable  -->
	<script src="datatable/jquery.dataTables.min.js"></script>
	<script src="datatable/dataTables.bootstrap4.min.js"></script>
    
	<!-- Custom Script-->
	<script src="js/custom.js"></script>
	<script src="js/custom-datatables.js"></script>
</body>


</html>
