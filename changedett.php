<?php
session_start();
// wis login rung, ra login tendang koe
if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
}

// HUBUNGKAN dengan file functions.php
require 'functions.php';
// cek apaakah wis di pencet pa durung tombole
if (isset($_POST["submit"])) {

    // var_dump($_POST);
    // var_dump($_FILES); die;
    // cek apakah data brasil di tmbh rung ?
    if (changedett($_POST) > 0) {
        echo "
             <script>
                alert ('DATA ChangeDett SAMPUN DIKIRIM !');
                document.location.href = 'index.php';
              </script>
        ";
    } else {
        echo "
        <script>
           alert ('DATA ChangeDett GAGAL! DiKIRIM !');
           document.location.href = 'index.php';
         </script>
   ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cssku/changedet.css">
    <title>ChangeDETT</title>
</head>

<body>
    <h1>ChangeDETT</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nick_name">Nick Name :</label>
                <input type="text" name="nick_name" id="nick_name" required autocomplete="off" autofocus>
            </li>
            <li>
                <label for="id_server">ID Server :</label>
                <input type="text" name="id_server" id="id_server" required autocomplete="off">
            </li>
            <li>
                <label for="rollers">Rollers :</label>
                <input type="text" name="rollers" id="rollers" required autocomplete="off">
            </li>
            <li>
                <label for="contact">Contact :</label>
                <input type="text" name="contact" id="contact" required autocomplete="off">
            </li>
            <li>
                <label for="profil">Profil :</label>
                <input type="file" name="profil" id="profil">
            </li>
            <li>
                <button type="submit" name="submit">Send Data !</button>
            </li>
        </ul>
    </form>

</body>

</html>