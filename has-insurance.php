<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>
<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;

   $company = ((isset($_POST['company']))?mysqli_real_escape_string($conn, $_POST['company']):'');
   $company = ucwords($company);
   $plan = ((isset($_POST['plan']))?mysqli_real_escape_string($conn, $_POST['plan']):'');
   $plan = ucwords($plan);
   $coverage = ((isset($_POST['coverage']))?mysqli_real_escape_string($conn, $_POST['coverage']):'');
   $insurance = ((isset($_POST['insurance']))?mysqli_real_escape_string($conn, $_POST['insurance']):'');
   $fee = ((isset($_POST['fee']))?mysqli_real_escape_string($conn, $_POST['fee']):'');
   $pay = ((isset($_POST['pay']))?mysqli_real_escape_string($conn, $_POST['pay']):'');
   $rand_val = strval(rand(1001,99999)); 
   $name_ID = substr('NHIS', 0,4).'_'.$rand_val.'_';
   $random = uniqid($name_ID);
   
if (isset($_POST['add_insurance'])) {
		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
		
        if (empty($company)) {
            $errors[] = "Enter the company name!";
        }
        if (empty($plan)) {
            $errors[] = "Enter the insurance Plan!";
        }
         if (empty($coverage)) {
            $errors[] = "Enter the medical coverage!";
        }

        if (empty($fee)) {
            $errors[] = "Enter the insurance fee!";
        }
           if (!empty($errors)) {
              echo display_error($errors);
        } else {
          
        $addsql = "INSERT INTO has_insurance(Insurance_Code,Insurance_Company,Insurance_Plan,Medical_Coverage,Insurance_Fee,Co_Pay_Insurance,Co_Insurance)
        VALUES('$random','$company','$plan','$coverage','$fee','$pay','$insurance')";
        $add_query = mysqli_query($conn,$addsql);
            if ($add_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Record Added successfully
                </div>";
                

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The record could not be added. Try again!
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
                        <li class="breadcrumb-item">Has Insurance</li>
						<li class="breadcrumb-item active">Add Insurance</li>
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
							<h3 class="widget-title">Add Insurance Details</h3>
							<form method="post" enctype="multipart/form-data">
								<?php echo $add_info; ?>
								<?php echo $add_error; ?>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="patient-name">Insurance Company</label>
										<input type="text" name="company" class="form-control" placeholder="Company" id="patient-name" value="<?php echo $company; ?>"  >
									</div>
									<div class="form-group col-md-6">
										<label for="patient-name">Insurance Plan</label>
										<input type="text" name="plan" class="form-control" placeholder="Plan" id="patient-name" value="<?php echo $plan; ?>"  >
									</div>
									
									<div class="form-group col-md-6">
										<label for="age">Insurance Fee</label>
										<input type="number" name="fee" placeholder="Fee" class="form-control" id="age" value="<?php echo $fee; ?>"  >
									</div>

									<div class="form-group col-md-6">
										<label for="patient-name">Medical Cover</label>
										<input type="text" name="coverage" class="form-control" placeholder="Medical Cover" id="patient-name" value="<?php echo $coverage; ?>"  >
									</div>

									<div class="form-group col-md-6">
										<label for="age">Co Pay</label>
										<input type="number" name="pay" placeholder="Co Pay" class="form-control" id="age" value="<?php echo $pay; ?>"  >
									</div>
									
									<div class="form-group col-md-12">
										<label for="exampleFormControlTextarea1">Co Insurance</label>
										<textarea placeholder="Medicine Description" name="insurance" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $insurance; ?></textarea>
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
										<input type="submit" name="add_insurance" class="btn btn-primary btn-lg" value="Add Insurance">
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
