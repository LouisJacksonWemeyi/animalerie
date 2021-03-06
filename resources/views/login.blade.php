<!DOCTYPE html>
<html lang="en">
<head>
	<title>Connexion</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{ config('app.url') }}resources/assets/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ config('app.url') }}resources/assets/login/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form action="" class="login100-form validate-form" method="POST">
					{{ csrf_field() }}
					<span>
						<img src="{{ config('app.url') }}resources/assets/login/images/logosPSPharma.png" style="display: block; margin-left: auto; margin-right: auto;">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Entrez votre adresse email">
						<input class="input100" type="email" name="email" placeholder="Adresse email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Entrez votre mot de passe">
						<input class="input100" type="password" name="password" placeholder="Mot de passe">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
						<label class="label-checkbox100" for="ckb1">
							Se souvenir de moi
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Se connecter
						</button>
					</div>
					<div class=""><a class="txt1" href="{{ route("forgot") }}">Mot de passe oubli?? ? </a></div>


{{-- 					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Mot de passe oubli?? ?
						</a>
					</div> --}}
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ config('app.url') }}resources/assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ config('app.url') }}resources/assets/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ config('app.url') }}resources/assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="{{ config('app.url') }}resources/assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ config('app.url') }}resources/assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ config('app.url') }}resources/assets/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="{{ config('app.url') }}resources/assets/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="{{ config('app.url') }}resources/assets/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="{{ config('app.url') }}resources/assets/login/js/main.js"></script>

</body>
</html>