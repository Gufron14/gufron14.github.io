<?php
session_start();
include './config/conn.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>EVoting - Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="shortcut icon" href="../img/kpumlogo.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body {font-family: sanssystem-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;}
		

		input[type=text], input[type=password] {
			width: 100%;	
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			/* border: 1px solid #ccc; */
			border-radius: 12px;
			box-sizing: border-box;
		}

		#button {
			background-color: #5C125E;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 12px;
			cursor: pointer;
			width: 100%;

		}

		#button:hover {
			opacity: 0.8;
		}

		span.psw {
			float: right;
			padding-top: 16px;
		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
			span.psw {
				display: block;
				float: none;
			}
		}
	</style>
</head>
<body>

	<h3 class="text-center my-3">Pemilihan Calon Ketua & Wakil Ketua Presiden Mahasiswa</h3>
	<h4 class="text-center my-3">International Women University<br>
	Periode 2023 - 2024</h4>
	<hr>
	<h4 class="text-center my-3"><b>Login Pemilih</b></h4>
	<p class="text-center my-3">Silakan Login dengan <b>Username</b> dan <b>Password</b> yang telah diberikan melalui email!  </p>
	<div class="container">
	<?php
		if(isset($_POST['login']))
		{
			$voter_id = $_POST['voter_id'];
			$password = $_POST['password'];

			$sql = "SELECT * FROM voters WHERE voters_id='$voter_id' AND password='$password'";
			$q = mysqli_query($conn, $sql);
			if(mysqli_num_rows($q) > 0)
			{
				$get_voters_details = mysqli_fetch_array($q);
				$get_voters_name = $get_voters_details['name'];
				$_SESSION['voter_id'] = $voter_id;
				$_SESSION['voter_name'] = $get_voters_name;
				header('Location:./user/voting.php');
			}
			else
			{
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Login Failed</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			}
			
		}
	?>

		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<form action="" method="post">
					<label for="voter_id"><b>Username</b></label>
					<input type="text" placeholder="Enter Username" name="voter_id" id="voter_id" autofocus required>

					<label for="password"><b>Password</b></label>
					<input type="password" placeholder="Enter Password" name="password" id="password" required>

					<button type="submit" id="button" name="login"><b>Login</b></button>
				</form>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
