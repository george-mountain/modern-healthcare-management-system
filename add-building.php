<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>
<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;

   $block_floor = ((isset($_POST['block_floor']))?mysqli_real_escape_string($conn, $_POST['block_floor']):'');
   $block_floor = ucwords($block_floor);
   $block_code = ((isset($_POST['block_code']))?mysqli_real_escape_string($conn, $_POST['block_code']):'');
   
   
if (isset($_POST['add_building'])) {
		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
		
        if (empty($block_floor)) {
            $errors[] = "Enter the Building Block!";
        }
        if (empty($block_code)) {
            $errors[] = "Enter the Building Code!";
        }
        
           if (!empty($errors)) {
              echo display_error($errors);
        } else {
          
        $addsql = "INSERT INTO building_block(Block_Floor,Block_Code)
        VALUES('$block_floor','$block_code')";
        $add_query = mysqli_query($conn,$addsql);
            if ($add_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Building Added successfully
                </div>";
                

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The Building could not be added. Try again!
                </div>";
            }
    }
  }
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Add Building</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Building</li>
						<li class="breadcrumb-item active">Add Building</li>
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
							<h3 class="widget-title">Add Building</h3>
							<form method="post" enctype="multipart/form-data">
								<?php echo $add_info; ?>
								<?php echo $add_error; ?>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="patient-name">Building Name</label>
										<input type="text" name="block_floor" class="form-control" placeholder="Block Floor" id="patient-name" value="<?php echo $block_floor; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="patient-name">Block Number</label>
										<input type="text" name="block_code" class="form-control" placeholder="Block Code" id="patient-name" value="<?php echo $block_code; ?>"  >
									</div>
																	
									<div class="form-check col-md-12 mb-2">
										<div class="text-left">
											<div class="custom-control custom-checkbox">
												<input class="custom-control-input" type="checkbox" id="ex-check-2" name="confirm">
												<label class="custom-control-label" for="ex-check-2">Please Confirm</label>
											</div>
										</div>
									</div>
									<div class="form-group col-md-6 mb-3">
										<input type="submit" name="add_building" class="btn btn-primary btn-lg" value="Add Building">
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

</body>


</html>
