<?php 

require_once '../_config/config.php';

if(isset($_SESSION['admin'])) {
	echo "<script>document.location = '" . base_url('') . "';</script>";
}

// login
if(isset($_POST['login'])) {
	
	$username = strtolower(trim(mysqli_real_escape_string($conn, $_POST['username'])));
	$password = sha1(trim(mysqli_real_escape_string($conn, $_POST['password'])));
	$result_login = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'") or die(mysqli_error($conn));

	$akun = mysqli_fetch_assoc($result_login);

	if(mysqli_num_rows($result_login)) {

		$_SESSION['admin'] = $akun['username'];

		echo "<script>document.location = '" . base_url() . "';</script>";

	} else {

		$error = true;

	}

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Login - Rumah Sakit</title>

	<!-- Bootstrap core CSS -->
	<link href="<?= base_url(); ?>/_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?= base_url('_assets/css/simple-sidebar.css') ?>" rel="stylesheet">

	<!-- fontawesome -->
	<link rel="stylesheet" href="<?= base_url(); ?>/_assets/css/fontawesome.min.css">

</head>

<body>

<div class="wrapper mt-5">
	<div class="container">
		<div class="card p-5 w-70">
			<div class="row justify-content-sm-center">
				<div class="col-md-5">
					<h2 class="text-center">Login</h2>
					<form action="" method="POST" class="mt-2">
						<div class="form-group">
							<input type="text" class="form-control" name="username" placeholder="Masukkan Username" required autocomplete autofocus>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block" name="login">Login</button>
						</div>
					</form>
				</div>
			</div>

			<!-- jika error -->
			<?php if(isset($error)) : ?>
				<div class="row justify-content-sm-center">
					<div class="col-md-5">
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Username / Password Salah!</strong> Pastikan anda memasukkan username / password yang tepat.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
					</div>
				</div>
			<?php endif; ?>
			
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="<?= base_url(); ?>/_assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>