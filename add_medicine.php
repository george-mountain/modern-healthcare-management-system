<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>
<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;

   $medicine_name = ((isset($_POST['medicine_name']))?mysqli_real_escape_string($conn, $_POST['medicine_name']):'');
   $medicine_name = ucwords($medicine_name);
   $medicine_type = ((isset($_POST['medicine_type']))?mysqli_real_escape_string($conn, $_POST['medicine_type']):'');
   $medicine_type = ucwords($medicine_type);
   $description = ((isset($_POST['description']))?mysqli_real_escape_string($conn, $_POST['description']):'');
   $price = ((isset($_POST['price']))?mysqli_real_escape_string($conn, $_POST['price']):'');
   
if (isset($_POST['add_medicine'])) {
		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
		
        if (empty($medicine_name)) {
            $errors[] = "Enter the medicine name!";
        }
        if (empty($medicine_type)) {
            $errors[] = "Enter the medicine type!";
        }
         if (empty($price)) {
            $errors[] = "Enter the medicine price!";
        }
           if (!empty($errors)) {
              echo display_error($errors);
        } else {
          
        $addsql = "INSERT INTO medicine(Medicine_Name,Medicine_Type,Medicine_Price,Description)
        VALUES('$medicine_name','$medicine_type','$price','$description')";
        $add_query = mysqli_query($conn,$addsql);
            if ($add_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Medicine Added successfully
                </div>";
                

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The Medicine could not be added. Try again!
                </div>";
            }
    }
  }
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Add Medicine</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Medicine</li>
						<li class="breadcrumb-item active">Add Medicine</li>
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
							<h3 class="widget-title">Add Medicine</h3>
							<form method="post" enctype="multipart/form-data">
								<?php echo $add_info; ?>
								<?php echo $add_error; ?>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="patient-name">Medicine Name</label>
										<input type="text" name="medicine_name" class="form-control" placeholder="Medicine Name" id="patient-name" value="<?php echo $medicine_name; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="patient-name">Medicine Type</label>
										<input type="text" name="medicine_type" class="form-control" placeholder="Medicine Type" id="patient-name" value="<?php echo $medicine_type; ?>"  >
									</div>
									
									<div class="form-group col-md-6">
										<label for="age">Medicine Price</label>
										<input type="number" name="price" placeholder="Price" class="form-control" id="age" value="<?php echo $price; ?>"  >
									</div>
									
									<div class="form-group col-md-12">
										<label for="exampleFormControlTextarea1">Description</label>
										<textarea placeholder="Medicine Description" name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $description; ?></textarea>
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
										<input type="submit" name="add_medicine" class="btn btn-primary btn-lg" value="Add Medicine">
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
