<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>

<?php global $conn; ?>
<?php 
if (isset($_GET['delete'])) {
    $med_id = $_GET['delete'];
    $delete = mysqli_query($conn,"DELETE FROM medicine WHERE Medicine_ID = '$med_id'");
    if ($delete) {
        echo "<script>alert('Patient Deleted Successfully')</script>";
        echo "<script>window.location = 'patients.php'</script>";
    }
}
if (isset($_POST['delete_category'])) {
  if (isset($_POST['post'])) {
    foreach ($_POST['post'] as $key => $value) {
      $delete_query = mysqli_query($conn,"DELETE FROM medicine WHERE Medicine_ID = '$value'");
    }
   echo "<script>alert('The selected post deleted Successfully')</script>";
   echo "<script>window.location='medicine.php'</script>";
  }else{
    echo "<script>alert('Please select post to delete first')</script>";
    echo "<script>window.location='medicine.php'</script>";
  }
  
}

 ?>

			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Medicine</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Medicine</li>
						<li class="breadcrumb-item active">All Medicines</li>
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
							<h3 class="widget-title">Medicine List</h3>							
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
											<th>Medicine ID</th>
											<th>Medicine Name</th>
											<th>Medicine Type</th>
											<th><b>&#165</b> Medicine Price</th>
											<th>Description</th>
											<th>Action ???</th>
										</tr>
									</thead>
									<tbody>

										<?php 
										$view_query = mysqli_query($conn,"SELECT * FROM medicine");
										while ($row = mysqli_fetch_array($view_query)) {
											$med_id = $row['Medicine_ID'];
											$medicine_name = $row['Medicine_Name'];
											$medicine_type = $row['Medicine_Type'];
											$medicine_price = $row['Medicine_Price'];
											$med_description = $row['Description'];
											
										
										 ?>
										<tr>
											<td>
                      	<input type="checkbox" name="post[]" value="<?php echo $patient_id; ?>">
                      </td>
											<td><?php echo $med_id ?></td>
											<td><?php echo $medicine_name ?></td>
											<td><?php echo $medicine_type ?></td>
											<td><?php echo $medicine_price ?></td>
											<td><?php echo $med_description; ?></td>
											
											<td>
	                      <a href="edit-medicine.php?edit=<?php echo $med_id; ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
	                          
	                       <a href="medicine.php?delete=<?php echo $med_id; ?>" class="btn btn-xs btn-danger"><span class="fa fa-remove"></span></a>
	                          
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
