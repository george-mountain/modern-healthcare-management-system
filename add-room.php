<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>
<?php include("top_navigation_bar.php");?>
<?php include("display_error.php"); ?>
<?php 
  global $conn, $add_info, $add_error;

   $room_no = ((isset($_POST['room_no']))?mysqli_real_escape_string($conn, $_POST['room_no']):'');
   $room_status = ((isset($_POST['room_status']))?mysqli_real_escape_string($conn, $_POST['room_status']):'');
   $block_id = ((isset($_POST['block_id']))?mysqli_real_escape_string($conn, $_POST['block_id']):'');
  
   
if (isset($_POST['add_room'])) {
		if (empty($_POST['confirm'])) {
			$errors[] = "Please Confirm the Entry";
		}
		
        if (empty($room_no)) {
            $errors[] = "Enter the room number!";
        }
        if (empty($room_status)) {
            $errors[] = "Enter the room status!";
        }
         if (empty($block_id)) {
            $errors[] = "Select the block number";
        }
           if (!empty($errors)) {
              echo display_error($errors);
        } else {
          
        $addsql = "INSERT INTO room(Room_No,Status,Block_B_ID)
        VALUES('$room_no','$room_status','$block_id')";
        $add_query = mysqli_query($conn,$addsql);
            if ($add_query) {
                $add_info = "<div class='alert alert-info'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Room Added successfully
                </div>";
                

            } else {
                $add_error = "<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                The room could not be added. Try again!
                </div>";
            }
    }
  }
    

 ?>
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Add Room</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">						
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
                        </li>
                        <li class="breadcrumb-item">Room</li>
						<li class="breadcrumb-item active">Add Room</li>
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
							<h3 class="widget-title">Add Room</h3>
							<form method="post" enctype="multipart/form-data">
								<?php echo $add_info; ?>
								<?php echo $add_error; ?>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="patient-name">Room Number</label>
										<input type="text" name="room_no" class="form-control" placeholder="Room Number" id="patient-name" value="<?php echo $room_no; ?>"  >
									</div>

									<div class="form-group col-md-6">
										<label for="department">Room Status</label>
										<select class="form-control" id="department" name="room_status">
											<option value="Available">Available</option>
											<option value="Occupied">Occupied</option>
										</select>
									</div>
									
									<div class="form-group col-md-6">
										<label for="department">Select Block Number</label>
										<select class="form-control" id="department" name="block_id">
											 <?php
                                              $blockQuery = mysqli_query($conn,"SELECT * FROM building_block"); 

                                               ?>
                                               <option value="" <?php echo ((isset($_POST['block_id']) && $_POST['block_id']=='')?' selected':''); ?>></option>
                                              <?php while ($blockResult = mysqli_fetch_array($blockQuery)) {
                                                $block_code = $blockResult['Block_Code'];
                                               ?>
                                                <option value="<?php echo $blockResult['B_ID']; ?>" <?php echo ((isset($_POST['block_id']) && $_POST['block_id']==$blockResult['B_ID'])?' selected':''); ?>><?php echo $block_code; ?></option>
                                                <?php }; ?>
											
										</select>
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
										<input type="submit" name="add_room" class="btn btn-primary btn-lg" value="Add Room">
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
	<?php include("footer.php"); ?>