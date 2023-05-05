<?php 
	include_once('./php_func/db_func.php');
	include_once('./php_func/header.php');

	$all_party_qry = "SELECT * FROM party";
	$all_polling_qry = "SELECT uniqueid,polling_unit_name FROM polling_unit";

	$all_party_res = mysqli_query($db,$all_party_qry);
	$all_polling_res = mysqli_query($db,$all_polling_qry);

;

	$error = [];
	if(isset($_POST['submit'])) {
		$pu_id = $_POST['polling_uniqueid'];
		$party_name = $_POST['party_name'];
		$party_score = $_POST['party_score'];
		$entered_by = $_POST['entered_by'];
		if(empty($pu_id)) {
			$error['id']= 'Please Choose A polling Unit';
		} else if(empty($party_name)){
			$error['party_name']= 'Please Select a party';
		} else if(empty($party_score)){
			$error['party_score']= 'Please provide score';
		} else if(empty($entered_by)) {
			$error['entered_by']= 'Please enter your name';
		} else {
			$date = new DateTime();
			$upload = $date->format('Y-m-d H:i:s');
			$insert_query = "INSERT INTO announced_pu_results(polling_unit_uniqueid,party_abbreviation,party_score,entered_by_user,date_entered,user_ip_address) VALUES('$pu_id','$party_name','$party_score','$entered_by', '$upload','192.168.1.101')";
			if(mysqli_query($db,$insert_query) === true) {
			    
				$msg = 'Upload was successful';
				$_POST = '';
			} else {
				$err = 'Upload was unsuccessful';
				// $err = 'Upload was unsuccessful';
				// header('location: add_result.php?err='.$err);

			}
			
		}
	}
?>
	<main>
		<?php include_once('./php_func/navbar.php') ?>
			<section class="w-75 mx-auto ">
				<div class="w-75">
					<h3 class="mb-4">Upload Result</h3>
					<div class="mx-auto">
						<?php if(isset($msg)) {?>
							<p id="alert" class="alert alert-success text-center"><?=$msg?></p>
						<?php } ?>
						<?php if(isset($err)) {?>
							<p id="alert" class="alert alert-danger text-center"><?=$err?></p>
						<?php } ?>
						<form class="form mx-auto" action="add_result.php" method="POST">
							<div class="form-group mb-3">
								<p>Polling Unit</p>
								<select name="polling_uniqueid" class="form-select">
									<option value="" >
										Choose polling unit
									</option>
									<?php while($row = mysqli_fetch_array($all_polling_res)) {?>
									<option  value="<?= $row['uniqueid'] ?? $_POST['polling_uniqueid'] ?>" >
										<?=$row['polling_unit_name']?>
									</option>
								<?php  } ?>
								</select>
								<?php if(isset($error['id'])){ ?>
									<small class="text-danger"><?=$error['id']?></small>
								<?php }?>
							</div>
							<div class="form-group mb-3">
								<p>Party</p>
								<select name="party_name" class="form-select">
									<option value=''>
										Choose Party
									</option>
									<?php while($row = mysqli_fetch_array($all_party_res)) {?>
									<option value="<?=$row['partyid'] ?? $_POST['party_name']?>" >
										<?=$row['partyname']?>
									</option>
								<?php  } ?>
								</select>
								<?php if(isset($error['party_name'])){ ?>
									<small class="text-danger" ><?=$error['party_name']?></small>
								<?php }?>
							</div>
							<div class="form-group mb-3">
								<p>Enter Party Score</p>
								<input class="form-control" type="number" value="<?=$_POST['party_score'] ?? ''?>" name="party_score" placeholder="Enter Total Party Score">
								<?php if(isset($error['party_score'])){ ?>
									<small class="text-danger" ><?=$error['party_score']?></small>
								<?php }?>
							</div>
							<div class="form-group mb-3">
								<p>Polling Unit Officer Name</p>
								<input class="form-control" type="text" value="<?=$_POST['entered_by'] ?? ''?>" name="entered_by" placeholder="Polling Unit Officer Name">
								<?php if(isset($error['entered_by'])){ ?>
									<small class="text-danger"><?=$error['entered_by']?></small>
								<?php }?>
							</div>
							<div class="text-center">
								<button type="submit" name="submit" class="btn btn-success">
									Submit
								</button>
							</div>
						</form>
					</div>
				</div>
		   </section>
	</main>

<?php 
	include_once('./php_func/footer.php');
?>