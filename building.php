<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>

<?php global $conn; ?>
<?php 
if (isset($_GET['delete'])) {
    $b_id = $_GET['delete'];
    $delete = mysqli_query($conn,"DELETE FROM building_block WHERE B_ID = '$b_id'");
    if ($delete) {
        echo "<script>alert('Building Deleted Successfully')</script>";
        echo "<script>window.location = 'building.php'</script>";
    }
}
if (isset($_POST['delete_category'])) {
  if (isset($_POST['post'])) {
    foreach ($_POST['post'] as $key => $value) {
      $delete_query = mysqli_query($conn,"DELETE FROM building_block WHERE B_ID = '$value'");
    }
   echo "<script>alert('The selected post deleted Successfully')</script>";
   echo "<script>window.location='building.php'</script>";
  }else{
    echo "<script>alert('Please select post to delete first')</script>";
    echo "<script>window.location='buiiding.php'</script>";
  }
  
}

 ?>

			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Building</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Building</li>
						<li class="breadcrumb-item active">All Buildings</li>
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
							<h3 class="widget-title">Building List</h3>							
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
											<th>Building ID</th>
											<th>Building Block</th>
											<th>Building Code</th>
											<th>Action ???</th>
										</tr>
									</thead>
									<tbody>

										<?php 
										$view_query = mysqli_query($conn,"SELECT * FROM building_block");
										while ($row = mysqli_fetch_array($view_query)) {
											$b_id = $row['B_ID'];
											$block_floor = $row['Block_Floor'];
											$block_code = $row['Block_Code'];
											
										 ?>
										<tr>
											<td>
                      	<input type="checkbox" name="post[]" value="<?php echo $patient_id; ?>">
                      </td>
											<td><?php echo $b_id ?></td>
											<td><?php echo $block_floor ?></td>
											<td><?php echo $block_code ?></td>
											
											<td>
	                      <a href="edit-building.php?edit=<?php echo $b_id; ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
	                          
	                       <a href="buiding.php?delete=<?php echo $b_id; ?>" class="btn btn-xs btn-danger"><span class="fa fa-remove"></span></a>
	                          
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
