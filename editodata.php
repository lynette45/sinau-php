<?php
session_start();
// wis login rung, ra login tendang koe
if( !isset($_SESSION["login"]) ){
    header("Location:login.php");
    exit;
}

// HUBUNGKAN dengan file functions.php
require 'functions.php';
// cek apaakah wis di pencet pa durung tombole
// ambil data id di url
$id = $_GET["id"];
// query data member kan id
$mbr = query ("SELECT * FROM member WHERE id = $id") [0];

// cek apkh tmbl submit sdh d tkn apa blum
if ( isset($_POST["submit"]) ){
    // cek apakah data brasil di ubah rung ?
    if( editodata($_POST) > 0 ) 
         {
           echo "
            <script>
                alert ('DATAne berhasil Di Editto !');
                document.location.href = 'index.php';
              </script>
             ";
         }
     else
        {
           echo "
             <script>
                alert ('DATAne gagal Di Editto !');
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
    <title>Edito Data</title>
</head>
<body>
    <h1> Edito Data </h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value=" <?= $mbr ["id"]; ?> ">
        <input type="hidden" name="probien" value="<?= $mbr ["profil"];?>">
        <ul>
            <li>
                <label for="nick_name">Nick Name :</label>
                <input type="text" name="nick_name" id="nick_name" required 
                value="<?= $mbr ["nick_name"];?>">
            </li>
            <li>
                <label for="id_server">ID Server :</label>
                <input type="text" name="id_server" id="id_server" required
                value="<?= $mbr ["id_server"];?>">
            </li>
            <li>
                <label for="rollers">Rollers :</label>
                <input type="text" name="rollers" id="rollers" required
                value="<?= $mbr ["rollers"];?>">
            </li>
            <li>
                <label for="contact">Contact :</label>
                <input type="text" name="contact" id="contact" required
                value="<?= $mbr ["contact"];?>">
            </li>
            <li>
                <label for="profil">Profil :</label><br>
                <img src="proff/<?= $mbr ["profil"]; ?>"width="50"><br>
                <input type="file" name="profil" id="profil">
            </li>
            <li>
                <button type ="submit" name ="submit">Send Update !</button>
            </li>
        </ul>
    </form>
</body>
</html>