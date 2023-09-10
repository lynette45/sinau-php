<?php
// nek wis tau login rasah di tmpilna logine
session_start();
require 'functions.php';

// cek cookie
if (isset($_COOKIE['eo']) && isset($_COOKIE['key'])) {
    $eo = $_COOKIE['eo'];
    $key = $_COOKIE['key'];

    //njiot username kan id
    $result = mysqli_query($kaii, "SELECT username FROM user WHERE 
        id = $eo");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($kaii, "SELECT * FROM user 
                                            WHERE username = '$username'");
    // check username 
    if (mysqli_num_rows($result) === 1) {
        // check password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            // SETT SESSION
            $_SESSION["login"] = true;

            //  CEK REMEMBER ME checklis dan acak key"username"
            if (isset($_POST['checklist'])) {
                // buat cookie
                setcookie('eo', $row['id'], time() + 60);
                setcookie(
                    'key',
                    hash('sha256', $row['username']),
                    time() + 60
                );
            }
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cssku/login.css">
    <script src="https://kit.fontawesome.com/e8ae0af1c8.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/525224f237.js"> -->
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    <!-- <script src="https://use.fontawesome.com/525224f237"></script> -->
    <title>LOGIN</title>
</head>

<body>
    <div class="content">
        <div class="judtext">LOGIN FORM</div>
        <?php if (isset($error)) : ?>
            <p class="correctwrong">Correct Username / Password</p>
        <?php endif; ?>

        <form action="" method="post">
            <div class="field">
                <span class="fas fa-user"></span>
                <input type="text" name="username" id="username" autofocus autocomplete="off" required>
                <label for="username">Enter Your Username</label>
            </div>
            <div class="field">
                <span class="fas fa-lock"></span>
                <input type="password" name="password" id="password" required>
                <label for="password">Enter Your Password</label>
            </div>
            <div class="forgotpass"><a href="#">Forgot Pasword ?</a></div>
            <button type="submit" name="login" class="button">SIGN IN</button>
            <div class="singupnow">not a member ?
                <a class="signupnowa" href="registrasy.php">Signup now</a>
            </div>
        </form>
    </div>
</body>

</html>