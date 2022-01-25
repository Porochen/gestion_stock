<!doctype html>
	<html lang="en">
	<head>
		<title>Gestion de Stock</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" href="<?= base_url('frontend/css/style.css')?>">

	</head>
	<body style="background-image: url(<?= base_url('upload/eco.jpg')?>);">
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-6 col-lg-4">
						<div class="login-wrap py-5">
							<p class="text-center" style="margin-top:-25px;font-size: 18px;">Bienvenue dans Gestion de stock</p>
							<div class="img d-flex align-items-center justify-content-center" style="background-image: url(<?= base_url('frontend/images/logo.png')?>);"></div>
							<form action="<?= base_url('Login/do_login')?>" method="post" class="login-form" autocomplete="off">
								<?=$sms?>
								<div class="form-group">
									<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user" style="font-size: 25px;"></span></div>
									<input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required>
								</div>
								<div class="form-group">
									<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock" style="font-size: 25px;"></span></div>
									<input type="password" name="password" class="form-control" placeholder="Mot de Passe" required>
								</div>
								<div class="form-group d-md-flex">
									<div class="w-100 text-md-right">
										<a href="#">Mot de passe oublié ?</a>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn form-control btn-primary rounded submit px-3">Se connecter</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script src="<?=base_url('frontend/js/jquery.min.js')?>"></script>
		<script src="<?=base_url('frontend/js/popper.js')?>"></script>
		<script src="<?=base_url('frontend/js/bootstrap.min.js')?>"></script>
		<script src="<?=base_url('frontend/js/main.js')?>"></script>

	</body>
	</html>
