<?php 
	require_once "functions.php";
	if(!isset($_SESSION['user'])){
    	header("Location: login.php");
		exit;
	}
	session_destroy();?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Silahkan Tunggu...</title>
		<link href="css/styles.css" rel="stylesheet" />
		<link rel="icon" type="image/x-icon" href="assets/img/logo2.ico">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<style>
			/*animasi preloader*/
			.progress .progress-bar {
				animation-name: animateBar;
				animation-iteration-count: 1;
				animation-timing-function: ease-in;
				animation-duration: 1.0s;
			}
			@keyframes animateBar {
			0% {transform: translateX(-100%);}
			100% {transform: translateX(0);}
			}
			.spin {
				width: 120px;
				height: 120px;
			}
			.loading {
				margin: 200px 500px;
			}
			
		</style>
	</head>
	<body class="bg-main">
		<div class="container loading w-25 h-100" id="loader">
			<div class="container text-center align-items-center ">
				<div class="spinner-border text-info spin"></div>
				<h1 class="text-info pt-2 pb-3">Menunggu</h1>
				<!-- <div class="progress">
					<div class="progress-bar progress-bar-striped bg-info" style="width: 100%;"></div>
				</div> -->
			</div>
		</div>
	</body>
	</html>
	<?php header("Refresh:2;url=login.php")?>