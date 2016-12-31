<?php
    session_start();

    // include database handler
    include_once('dbh.php');
    // check if accessed through submit
    if(!$_POST['registerBtn']) {
		header("Location: home.php");
	}
    
    if ($_POST['registerBtn']) {
        $regUsername = ($_POST['registerUsername']);
        $regPassword = ($_POST['registerPassword']);
        $regPasswordConfirm = ($_POST['registerPasswordConfirm']);
        $regEmail = ($_POST['registerEmail']);
        // Check all fields filled AND passwords match AND username unique 
        if (empty($regUsername) || empty($regPassword) || empty($regPasswordConfirm) || empty($regUsername)) {
            header("Location: ../home.php?error=empty#registerForm");
            exit();
        } else if ((strlen($regUsername) < 8) || strlen($regPassword) < 8) {
            header("Location: ../home.php?error=short#registerForm");
            exit();
        } else if ($regPassword != $regPasswordConfirm) {
            header("Location: ../home.php?error=nomatch#registerForm");
            exit();
        } else {
            $sql = "SELECT username FROM users WHERE username='$regUsername'";
            $query = mysqli_query($conn, $sql);
            $usernameCheck = mysqli_num_rows($query);
            if ($usernameCheck > 0) {
                header("Location: ../home.php?error=usertaken#registerForm");
                exit();
            } else {
                ;
            }
        }

        // Basic password encryption
        $regPassword = md5($regPassword);
        // Insert into table 
        $sql = "INSERT INTO users (username, password, email) VALUES ('$regUsername', '$regPassword', '$regEmail')";
        // Query sql database
        $result = mysqli_query($conn, $sql);

        header("Location: ../home.php");
    }
?>