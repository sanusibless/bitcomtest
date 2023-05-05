<?php

	include_once('./php_func/db_func.php');
	include_once('./php_func/header.php');

	$lga_qry = "SELECT lga_id, lga_name FROM lga";
	$result = mysqli_query($db,$lga_qry);

	if(isset($_POST['submit'])) {
		$lga_id = (int)$_POST['lga_uniqueid'] ? $_POST['lga_uniqueid'] : 7;
		 $lga_qry = "SELECT * FROM polling_unit pu join announced_pu_results pur on pu.uniqueid = pur.polling_unit_uniqueid where pu.lga_id = '$lga_id'";
		$lga_results = mysqli_query($db,$lga_qry);
		$total_qry = "SELECT COUNT(pu.lga_id), lga.lga_name FROM polling_unit pu join announced_pu_results pur on pu.uniqueid = pur.polling_unit_uniqueid JOIN lga ON pu.lga_id = lga.lga_id where pu.lga_id = '$lga_id'";
		$total_res = mysqli_query($db,$total_qry);
		if($total_res){
			$total = mysqli_fetch_array($total_res);
		}
	}
?>
		<main>
			<?php include_once('./php_func/navbar.php') ?>
				<section class="w-75 text-center mx-auto">
					<div class="mb-3">
						<h3>LGA Result in Delta State</h3>
						<form class="mx-auto" method="POST" action="lga_result.php">
							<div>
								<p>Select LGA</p>
							</div>
									<div class="d-flex justify-content-center">
										<div class="form-group">
										<select name='lga_uniqueid' class="form-select">
											<option >Choose Polling Unit</option>
											<?php while($row = mysqli_fetch_array($result)){ 

												?>
												<option value="<?php echo $row['lga_id']?>">
													<?php echo $row['lga_name'] ?>
												</option>
											<?php } ?>
										</select>
									</div>
									<div class="pl-2">
										<button type="submit" class="btn btn-dark ml-2" name="submit">
											Fetch
										</button>
									</div>			
							</div>
						</form>
					</div>
						<?php if(isset($total)) { 
							$total_votes = 0; 
							while($row = mysqli_fetch_array($lga_results)) 
							{  $total_votes += intval($row['party_score']);
								} ?>
							<div class="text-center">
								Total Votes <?=$total['lga_name']?> LGA: <?=$total_votes?>
							</div>
								<?php } else { ?>
							<div>
								<p>No result</p>
							</div>
								<?php } ?>
				</section>
		</main>
<?php 
	include_once('./php_func/footer.php');
?>
