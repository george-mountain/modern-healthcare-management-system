<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>

<?php include("top_navigation_bar.php");?>
<?php global $conn; ?>
<?php 

if (isset($_GET['view'])) {
    $view_id = $_GET['view'];
    $viewquery = mysqli_query($conn,"SELECT P.*,B.*,U.* FROM `payment` P INNER JOIN `hospital_bills` B ON P.Bill_ID=B.Bill_ID INNER JOIN `patient` U on B.Patient_ID = U.Patient_ID WHERE P.payment_ID = '$view_id'");
    $row = mysqli_fetch_array($viewquery);
    $patient_id = $row['Patient_ID'];
	$fullname = $row['Patient_First_Name'] ." ". $row['Patient_Last_Name'];
	$patient_address = $row['Patient_City'];
	$patient_email = $row['Patient_Email'];
	$patient_phone = $row['Patient_Phone'];
	$patient_dob = $row['Patient_DOB'];
	$patient_gender = $row['Patient_Gender'];
	$patient_nationality = $row['Patient_Citizenship'];
	$rand_val = strval(rand(10001,999999999)); 
    $name_ID = substr('RLGInv', 0,6).'_'.$rand_val.'_';
    $random = uniqid($name_ID);
    $today = date("Y-m-d");
    $diff = date_diff(date_create($patient_dob), date_create($today));

    $Payment_Date = $row['Payment_Date'];
    $Bill_Date = $row['Bill_Date'];
    $Bill_Discount = $row['Bill_Discount'];
	$Payment_ID = $row['payment_ID'];
	$doc_charges = $row['Doctor_charges'];
	$total_doc_charges = $doc_charges - ($doc_charges * $Bill_Discount * 0.01);
	$Medicine_Charge = $row['Medicine_Charge'];
	$total_med_charges = $Medicine_Charge - ($Medicine_Charge * $Bill_Discount * 0.01);
	$Room_Charge = $row['Room_Charge'];
	$total_room_charges = $Room_Charge - ($Room_Charge * $Bill_Discount * 0.01);
	$Lab_Charge = $row['Lab_Charge'];
	$total_lab_charges = $Lab_Charge - ($Lab_Charge * $Bill_Discount * 0.01);
	$Nurse_Charge = $row['Nurse_Charge'];
	$total_nurse_charges = $Nurse_Charge- ($Nurse_Charge * $Bill_Discount * 0.01);
	$Radiology_Charges = $row['Radiology_Charges'];
	$total_rad_charges = $Radiology_Charges - ($Radiology_Charges * $Bill_Discount * 0.01);
	$Payment_Status = $row['Payment_Status'];
	$Payment_Type = $row['Payment_Type'];
	$Misc_Charge = $row['Miscelleneous_Charges'];
	$total_misc_charges = $Misc_Charge  - ($Misc_Charge * $Bill_Discount * 0.01);
	$a = array($total_doc_charges,$total_med_charges,$total_room_charges,$total_lab_charges,$total_nurse_charges,$total_rad_charges,$total_misc_charges);
	$amount = array_sum($a);

}

 ?>
			<!-- Breadcrumb -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Payment Invoice</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
						</li>
						<li class="breadcrumb-item">Payments</li>
						<li class="breadcrumb-item active">Payment Invoice</li>
					</ol>
				</div>
			</div>
			<!-- /Breadcrumb -->
			<!-- Main Content -->
			<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
							<div class="widget-area-2 proclinic-box-shadow pb-3">
								<!-- Invoice Head -->
								<div class="row ">
									<div class="col-sm-6 mb-5">
                                        <img src="images/RLG.png" alt="logo hospital" class="img-thumbnail" style="background-color: gray;">
                                        <br>    
                                        <br>                                     
										<span>Robotic Learning Group - RLG</span>
										<br>
										<span>[Toyonaka, Osaka 560-8531]</span>
										<br>
										<span class="pr-2">Phone: +8193499348</span>
										<span>Email: helpdesk@rlg.com</span>
										<span><hr></span>
									</div>
									<div class="col-sm-6 text-md-right mb-5">
										<h3>INVOICE</h3>
										<br>
										<br>
										<span>Invoice # <?php echo $random ?></span>
										<br>
										<span>Date: <?php echo $Payment_Date ?></span>
										<span><hr></span>
									</div>
								</div>
								<!-- /Invoice Head -->
								<!-- Invoice Content -->
								<div class="row">
									<div class="col-sm-6 mb-5">
										<h6 class="proclinic-text-color">PATIENT DETAILS:</h6>
										<span><strong>Name:</strong> <?php echo $fullname ?></span>
										<br>
										<span><strong>Age:</strong> <?php echo $diff->format('%y') ?></span>
										<br>
										<span><strong>Address: </strong><?php echo $patient_address ?></span>
										<br>
									
										<span><strong>Phone:</strong> <?php echo $patient_phone ?></span>
										<span><hr></span>
									</div>
									<div class="col-sm-6 mb-5">
										<span><strong>Patient ID:</strong> <?php echo $patient_id ?></span>
										<br>
										<span><strong>Bill Date:</strong> <?php echo $Bill_Date ?></span>
										<br>
										<span><strong>Payment Type:</strong> <?php echo $Payment_Type ?></span>
										<br>
										<span><hr></span>
										<br>
										<span><strong>Discount Available:</strong> <?php echo $Bill_Discount ?> <small>(%)</small></span>
									</div>
									<div class="col-sm-12 mb-2">
										<strong class="proclinic-text-color">Services:</strong>
									</div>
									<div class="col-sm-12">
										<table class="table table-bordered table-striped table-invioce">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Service Charges</th>
													<th scope="col"><b>&#165</b> Total Cost</th>
													<th scope="col">Discount <small>(%)</small></th>
													<th scope="col"><b>&#165</b> Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">1</th>
													<td>Doctor Charges</td>
													<td><?php echo $doc_charges ?></td>
													<td><?php echo $Bill_Discount ?></td>
													<td><?php echo $total_doc_charges ?></td>
												</tr>

												<tr>
													<th scope="row">2</th>
													<td>Medicine Charges</td>
													<td><?php echo $Medicine_Charge ?></td>
													<td><?php echo $Bill_Discount ?></td>
													<td><?php echo $total_med_charges ?></td>
												</tr>
												<tr>
													<th scope="row">3</th>
													<td>Room Charges</td>
													<td><?php echo $Room_Charge?></td>
													<td><?php echo $Bill_Discount?></td>
													<td><?php echo $total_room_charges ?></td>
												</tr>
												<tr>
													<th scope="row">4</th>
													<td>Laboratory Charges</td>
													<td><?php echo $Lab_Charge?></td>
													<td><?php echo $Bill_Discount?></td>
													<td><?php echo $total_lab_charges ?></td>
												</tr>
												<tr>
													<th scope="row">5</th>
													<td>Radiology Charges</td>
													<td><?php echo $Radiology_Charges?></td>
													<td><?php echo $Bill_Discount?></td>
													<td><?php echo $total_rad_charges ?></td>
												</tr>
												<tr>
													<th scope="row">6</th>
													<td>Nurse Charges</td>
													<td><?php echo $Nurse_Charge?></td>
													<td><?php echo $Bill_Discount?></td>
													<td><?php echo $total_nurse_charges ?></td>
												</tr>
												<tr>
													<th scope="row">7</th>
													<td>Miscelleneous Charges</td>
													<td><?php echo $Misc_Charge?></td>
													<td><?php echo $Bill_Discount?></td>
													<td><?php echo $total_misc_charges ?></td>
												</tr>
		
											</tbody>
										</table>
									</div>
									<div class="col-sm-4 ml-auto">
										<table class="table table-bordered table-striped">
											<tbody>
												<tr>
													<td><strong> Total</strong></td>
													<td><strong><b>&#165</b> <?php echo $amount; ?></strong></td>
												</tr>
											</tbody>
										</table>
									</div>
		
									<div class="col-sm-12">
										<div class="border p-4">
											<strong>Note:</strong>
											Health is Wealth and your welfare
											is our concern. RLG Health Centre the
											Ultimate health provider worldwide
											<br>
											<br>
											<strong class="f12">Sign: George Ugwu</strong>
										</div>
									</div>
									<div class="col-sm-12">
                                    <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center export-pagination mt-3 mb-0">
                                                <li class="page-item">
                                                    
                                                    <button class="btn btn-flat btn-success" type="button" onclick="window.print()">Print</button>
                                                </li>
                                                
                                            </ul>
										</nav>
									</div>
                                </div>
                                
								<!-- /Invoice Content -->
						</div>
					</div>
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