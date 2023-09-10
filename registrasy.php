<?php
require 'functions.php';

if (isset($_POST["registmbol"])) {

    if (registraseh($_POST) > 0) {
        echo   "<script>
                    alert ('User Baru Sampun Dados !');
                    </script>
                    ";
    } else {
        echo mysqli_error($kaii);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cssku/register.css">
    <link rel="stylesheet" href="jsku/regispw.js">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    <!-- <script src="https://use.fontawesome.com/525224f237.js"></script> -->
    <!-- <script src="https://cdnjs.com/libraries/font-awesome.js"></script> -->
    <script src="https://kit.fontawesome.com/e8ae0af1c8.js" crossorigin="anonymous"></script>
    <title>REGISTRASY page</title>
    <style>
        label {
            display: block;
        }

        li {
            margin: 7px;
        }

        h1 {
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="judtext">REGISTRASY</div>
        <form action="" method="post">
            <div class="field">
                <span class="fas fa-user"></span>
                <input type="text" name="username" id="username" autofocus autocomplete="off" required>
                <label for="username">Enter Username</label>
            </div>
            <div class="field">
                <span class="fas fa-lock" onclick="togglePass()"></span>
                <input type="password" name="password" id="password" required>
                <label for="password">Enter Password</label>
            </div>
            <div class="field">
                <span class="fas fa-lock"></span>
                <input type="password" name="konfirpass" id="konfirpass" required>
                <label for="konfirpass">Konfirm Password</label>
            </div>
            <button type="submit" name="registmbol" class="button">REGISTRASY</button>
        </form>
    </div>
</body>

</html>