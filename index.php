<?php 
	include_once('./php_func/db_func.php');
	include_once('./php_func/header.php');

	$polling_units = "SELECT DISTINCT polling_unit_uniqueid, polling_unit_name,polling_unit_number FROM announced_pu_results JOIN polling_unit ON announced_pu_results.polling_unit_uniqueid = polling_unit.uniqueid";
	$result = mysqli_query($db,$polling_units);

	if(isset($_POST['submit'])) {
		$pu_uniqueid = $_POST['pu_uniqueid'];
		$pu_results_qry = "SELECT pur.party_abbreviation,pur.party_score, pur.entered_by_user, polling_unit_name,polling_unit_number FROM announced_pu_results pur JOIN polling_unit ON pur.polling_unit_uniqueid = polling_unit.uniqueid WHERE pur.polling_unit_uniqueid = $pu_uniqueid";
		$pu_results = mysqli_query($db,$pu_results_qry);

		$total_qry = "SELECT COUNT(pur.party_score) as total, polling_unit_name,polling_unit_number FROM announced_pu_results pur JOIN polling_unit ON pur.polling_unit_uniqueid = polling_unit.uniqueid WHERE pur.polling_unit_uniqueid = $pu_uniqueid";
		$total_res = mysqli_query($db,$total_qry);

		$total = mysqli_fetch_array($total_res);
	}

?>

<main>
	<?php include_once('./php_func/navbar.php') ?>
		<section class="text-center">
			<div class="text-center">
				<h2 class="mb-4">Polling Unit</h2>
				<form class="w-50 mx-auto" method="POST" action="polling_unit.php">
					<div class="d-flex justify-content-center">
						<div class="form-group">
							<select name='pu_uniqueid' class="form-select">
								<option >Choose Polling Unit</option>
								<?php while($row = mysqli_fetch_array($result)){ 

									?>
									<option value="<?php echo $row['polling_unit_uniqueid'] ?>">
										<?php echo $row['polling_unit_name'] ?>
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
			<div>
				<?php 
				if(isset($total)) {
					if($total['total'] !== 0) { 
					$total_votes = 0; ?>
					<h4 class="mt-3 class-center "><?php echo $total['polling_unit_name'] . ' (' . $total['polling_unit_number'] .')'?></h4>
					<table class="table table-stripe table-bordered w-50 text-center mx-auto mt-3">
						<thead>
							<thead>
								<tr>
									<th>Party</th>
									<th>Score</th>
								</tr>
							</thead>
						</thead>
							<tbody>
								<?php while($row = mysqli_fetch_array($pu_results)) { 
									$total_votes += (int) $row['party_score']
									?>
									<tr>
										<td>
											<?=$row['party_abbreviation'] ?>
										</td>
										<td>
											<?=$row['party_score'] ?>
										</td>
									</tr>
								<?php
							 } ?>
						 
						</tbody>
						<tfooter class="text-center">
							<tr>Total Votes: <?=$total_votes?></tr>
						</tfooter>
						<?php } else { ?>
							<h4> No Record Found </h4>
					    <?php } ?>
					</table> 
				<?php } ?>
				</div>
		</section>
</main>

<?php 
	include_once('./php_func/footer.php');
?>