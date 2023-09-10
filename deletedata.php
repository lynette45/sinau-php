<?php
session_start();
// wis login rung, ra login tendang koe
if( !isset($_SESSION["login"]) ){
    header("Location:login.php");
    exit;
}

// hubungkan ke functions.php
require 'functions.php';

$id = $_GET["id"];

if ( deletedata($id) > 0 ) {
    echo "
    <script>
       alert ('DATAne SAMPUN DiHAPUS !');
       document.location.href = 'index.php';
     </script>
";
}else {
    echo "
    <script>
     alert ('DATAne GAGAL! DiHapus !');
     document.location.href = 'index.php';
    </script>
";
}
?>