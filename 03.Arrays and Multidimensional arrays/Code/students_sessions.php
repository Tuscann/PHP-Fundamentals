<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Calculate numbers</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="col-md-4 col-md-offset-4">
			<form method="GET">
				<div class="form-group">
					<label>Delimiter: </label>
					<select class="form-control" name="delimiter">
						<option value=",">,</option>
						<option value="|">|</option>
						<option value="&">&amp;</option>
					</select>
				</div>
				<div class="form-group">
					<label>Names: </label>
					<input type="text" name="names" class="form-control">
				</div>
				<div class="form-group">
					<label>Ages: </label>
					<input type="text" name="ages" class="form-control">
				</div>

				<button type="submit" class="btn btn-primary">Filter</button>
			</form>

			<?php 
				if (isset($_GET['delimiter']) && isset($_GET['names']) && isset($_GET['ages'])) {
					$delimiter = $_GET['delimiter'];
					$names = $_GET['names'];
					$ages = $_GET['ages'];

					$names = explode($delimiter, $names);
					$ages = explode($delimiter, $ages);

					$_SESSION['names'] = $names;
					$_SESSION['ages'] = $ages;
				}

				if(isset($_SESSION['names']) && isset($_SESSION['ages'])) {
					if (count($_SESSION['names']) != count($_SESSION['ages'])) {
						echo "<h4><strong>Грешка:</strong> стойностите в полетата трябва да са равни на брой</h4>";
					}

					else {
			?>	
						<div class="table-responsive" style="margin-top: 20px;">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Age</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										//Pagination
										$items_per_page = 5;
										$page = 1;
										$total_pages = ceil(count($_SESSION['names']) / $items_per_page);	

										if (isset($_GET['page'])) {
											$page = intval($_GET['page']);
										}

										$start = ($page - 1) * $items_per_page;
										$end = $page * $items_per_page;

										if ($end > count($_SESSION['names'])) {
											$end = count($_SESSION['names']);
										}

										for ($i=$start; $i < $end; $i++) {
									?>
											<tr>
												<td><?= htmlspecialchars($_SESSION['names'][$i]) ?></td>
												<td><?= htmlspecialchars($_SESSION['ages'][$i]) ?></td>
											</tr>
									<?php
										}
									?>
								</tbody>
							</table>
						</div>
			<?php
					}
					if (count($_SESSION['names']) > $items_per_page) {
						$total_pages = ceil(count($_SESSION['names']) / $items_per_page);
					?>
						<div class="row text-center">
							<ul class="pagination">
								<li><a href="studentInfo.php?page=<?= $page - 1 ?>">Предишна</a></li>
								<?php 
									for ($i=1; $i <= $total_pages; $i++) { ?>
									<?php	if ($i == $page) { ?>
											<li class="active"><a href="studentInfo.php?page=<?= $i ?>"><?= $i ?></a></li>
								<?php	}

										else { ?>
											<li><a href="studentInfo.php?page=<?= $i ?>"><?= $i ?></a></li>
								<?php	} 
									}
								?>
								<li><a href="studentInfo.php?page=<?= $page + 1 ?>">Следваща</a></li>
							</ul>
						</div>
				<?php
					}
				}
			?>
		</div>
	</div>
</body>
</html>