<?php
	include("modules/database.php");
	$database = new CDatabase();
	mysqli_set_charset($database,"utf8");
	include("modules/astronauts.php");
	$astronauts = new CAstronauts($database);
?>

<html>
	<head>
		<title>Techfields</title>
		<meta name="author" content="Lukáš Richtarik">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="styles/styles.css">
	</head>
	<body>
		<section>
			<h1>Techfields</h1>
			<h3>Astronauts</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
			<h3>Registration</h3>
				<?php
					if(!empty($_GET['delete']))
					{
						$id=htmlspecialchars($_GET['delete'], ENT_QUOTES);
						if($astronauts->delete($id))
						{
							?>
								<div class="alert alert-success">Astronaut was deleted</div>
							<?php
						}
						else
						{
							?>
								<div class="alert alert-danger">Astronaut was not deleted</div>
							<?php
						}
					}
					if(!empty($_POST['bInsert']))
					{

						$firstName=htmlspecialchars($_POST['firstName'], ENT_QUOTES);
						$lastName=htmlspecialchars($_POST['lastName'], ENT_QUOTES);
						$born=htmlspecialchars($_POST['born'], ENT_QUOTES);
						$superpower=htmlspecialchars($_POST['superpower'], ENT_QUOTES);

						$help = explode('/', $born);
						$born = $help[2] . "-" . $help[0] . "-" . $help[1];

						if(empty($firstName) || empty($lastName) || empty($born) || empty($superpower))
						{
							?>
								<div class="alert alert-danger">Fill required fields, please</div>
							<?php
						}
						else
						{
							if($astronauts->insert($firstName, $lastName, $born, $superpower))
							{
								?>
									<div class="alert alert-success">Astronaut was inserted</div>
								<?php
							}
							else
							{
								?>
									<div class="alert alert-danger">Cannot insert astronaut</div>
								<?php
							}
						}
					}
				?>
				<form action="index.php" method='POST'>
					<input type='hidden' name='bInsert' value='true'>
					<div class='row'>
						<div class='col-lg-6'>
							<div class="form-group">
								<label for="firstName">First name</label>
								<input type="text" placeholder="Fill first name" required class="form-control" name="firstName">
							</div>
							<div class="form-group">
								<label for="lastName">Last name</label>
								<input type="text" placeholder="Fill last name" required class="form-control" name="lastName">
							</div>
						</div>
						<div class='col-lg-6'>
							<div class="form-group">
								<label for="born">Born</label>
								<input type="text" id='datepicker' placeholder="Fill born date" required class="form-control" name="born">
							</div>
							<div class="form-group">
								<label for="superpower">Superpower</label>
								<input type="text" placeholder="Fill your superpower" required class="form-control" name="superpower">
							</div>
							<button type="submit" class="btn formBut">Save</button>
						</div>
					</div>
				</form>
			</div>

			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">First name</th>
						<th scope="col">Last name</th>
						<th scope="col">Born</th>
						<th scope="col">Superpower</th>
						<th scope="col">Action</th>
					</tr>
			 	</thead>
					<tbody>
						<?php
							$allAstronauts = $astronauts->init();
							if(!$allAstronauts)
								echo "<tr><td>No astronauts</td></tr>";
							else
							{
								for($i=0; $i<count($allAstronauts); $i++)
								{
							?>
								<tr>
									<th scope="row"><?php echo $i+1; ?></th>
									<td id='first_<?php echo $allAstronauts[$i]['id']; ?>'><?php echo $allAstronauts[$i]['firstName']; ?></td>
									<td id='last_<?php echo $allAstronauts[$i]['id']; ?>'><?php echo $allAstronauts[$i]['lastName']; ?></td>
									<td id='born_<?php echo $allAstronauts[$i]['id']; ?>'><?php echo $allAstronauts[$i]['born']; ?></td>
									<td id='superpower_<?php echo $allAstronauts[$i]['id']; ?>'><?php echo $allAstronauts[$i]['superpower']; ?></td>
									<td>
										<a href='?delete=<?php echo $allAstronauts[$i]['id']; ?>'><i class="material-icons">delete_forever</i></a>
										<i class="material-icons edit" id='astronaut_<?php echo $allAstronauts[$i]['id']; ?>'>mode_edit</i>
									</td>
								</tr>
							<?php
								}
							}
							?>
					</tbody>
			</table>
		</section>
		<div id='editWindow'>
			<div id='editWindowIn'>
				<input type='hidden' id='editId' value="">
				<div class='row'>
					<div class='col-lg-6'>
						<div class="form-group">
							<label for="editFirstName">First name</label>
							<input type="text" placeholder="Fill first name" required class="form-control" id="editFirstName">
						</div>
						<div class="form-group">
							<label for="editLastName">Last name</label>
							<input type="text" placeholder="Fill last name" required class="form-control" id="editLastName">
						</div>
					</div>
					<div class='col-lg-6'>
						<div class="form-group">
							<label for="editBorn">Born</label>
							<input type="text" placeholder="Fill born date" required class="form-control" id="editBorn">
						</div>
						<div class="form-group">
							<label for="editSuperpower">Superpower</label>
							<input type="text" placeholder="Fill your superpower" required class="form-control" id="editSuperpower">
						</div>
						<button type="submit" id='saveEdit' class="btn formBut">Save</button>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>