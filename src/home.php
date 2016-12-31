<?php
	session_start();

	if($_POST['logoutBtn']) {
		session_destroy();
	}

	if (isset($_SESSION['id'])) {
		header("Location: index.php");
	}

	include_once("admin/functions.php");
?>

<!DOCTYPE html>
<html>

<head>
	<title>Blog Homepage</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/darkly/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styling.css">
</head>
	
<body onload="register()">
	
	<nav class="navbar navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">BLOG</a> 
			</div>

			<div class="nav navbar-form navbar-right">
				<form action="admin/login.php" method="POST" class="form-group form-inline">
					<input class="login-fields" type="text" name="username" placeholder="Username" required>
					<input class="login-fields" type="password" name="password" value="" placeholder="Password" required>
					<input type="submit" name="loginBtn" value="Log In">
					<?php
						loginError();
					?>
				</form>				
			</div>
		</div>
	</nav>

	<div class="jumbotron" style="margin-top: 10px">
		<div class="container">
			<div class="row" style="text-align: center; padding-bottom: 50px">
				<h2><i>Features</i></h2>
			</div>
			
			<div class="row" style="align-content: center">
				<div class="carousel slide" id="featuresCarousel" data-ride="carousel">
					
					<ol class="carousel-indicators">
						<li data-target="#featuresCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#featuresCarousel" data-slide-to="1"></li>
						<li data-target="#featuresCarousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<div class="carousel-caption">
								Express Yourself!	
							</div>
						</div>
						<div class="item">
							<div class="carousel-caption">
								Read What Others Have Written!	
							</div>
						</div>
						<div class="item">
							<div class="carousel-caption">
								Comment!
							</div>
						</div>
					</div>

					<a class="left carousel-control" href="#featuresCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#featuresCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row col-xs-12 col-sm-4 col-sm-offset-2" style="text-align: center">
			<h2>Register Now</h2>
			<span class="glyphicon glyphicon-hand-right" style="font-size: 100px" aria-hidden="true"></span>
		</div>

		<div class="row col-xs-12 col-sm-4">
			<form id="registerForm" action="admin/registration.php" method="POST" class="form-group">
				<table style="text-align: right">
					<tr>
						<td><label for="registerUsername">Username:</label></td>  
						<td><input id="registerUsername" type="text" name="registerUsername"></td>
					</tr>
					
					<tr>
						<td><label for="registerPassword">Password:</label></td>
						<td><input type="password" name="registerPassword" id="registerPassword"></td>
					</tr>

					<tr>
						<td><label for="registerPasswordConfirm">Confirm Password:</label></td>
						<td><input type="password" name="registerPasswordConfirm" id="registerPasswordConfirm"></td>
					</tr>
						
					<tr>
						<td><label for="registerEmail">Email:</label></td>
						<td><input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="registerEmail" id="registerEmail"></td>
					</tr>

					<tr>
						<td>
							<?php
								regError();
							?>	
						</td>
						<td><input onclick="return register()" type="submit" name="registerBtn" id="registerBtn" value="Register"></td>
					</tr>			
				</table>
			</form>
		</div>		
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#featuresCarousel").carousel({ 
				interval: 1500});
		});
	</script>

</body>
</html>