<?php
    session_start();

    include_once("admin/functions.php");
    include_once("admin/dbh.php");

    if (!isset($_SESSION['id'])) {
		header("Location: home.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    	displayTitle($conn);
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/darkly/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styling.css">
</head>
<body>
    <nav class="navbar navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="home.php">BLOG</a> 
				
			</div>

			<div class="nav navbar-form navbar-right">
                
				<ul class="list-inline">
					<li style="margin-right: 100px; vertical-align: top; padding-top: 15px">
						<span><form action="searchpage.php" method="GET" class="form-inline search-bar">
							<input class="text" type="text" name="search" placeholder="Search for posts (coming soon)">
							<input class="search-btn" type="submit" name="searchBtn">
						</form></span>
					</li>
					<li>
						<?php 
                			echo "<div style='font-size: 20px;'>Hello! " . $_SESSION['username'] . '</div>'; 
                		?> 
						<form action="home.php" method="POST">
                    		<input type="submit" name="logoutBtn" value="LOG OUT"></button>
						</form>	
					</li>
				</ul>								
			</div>
		</div>
	</nav>