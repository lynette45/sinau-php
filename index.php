<?php
session_start();
// wis login rung cok, ra login tendang koe
if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
}
// hubungkan ke file functions.php
require 'functions.php';
// pagination degan LIMIT
// konfirgugrasi
$jmlahperpage = 3;
$jmlahwong = count(query("SELECT * FROM member"));
$jmlahpage = ceil($jmlahwong / $jmlahperpage);
$pagetif = (isset($_GET["page"])) ? $_GET["page"] : 1; #operator ternary true ke aktif jika false ke 1
$awaldet = ($jmlahperpage * $pagetif) - $jmlahperpage;
$member = query(" SELECT * FROM member LIMIT $awaldet,$jmlahperpage");
// nek tombol golet di klik timpa bae data kabeh ng nduwur
if (isset($_POST["golet"])) {
    $member = golet($_POST["singditulis"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cssku/indextzy.css">
    <title>Page Hero</title>
</head>

<body>
    <div class="pecel">
        <h1>Squad | AKSARA RESPECT</h1>
    </div>
    <div class="buntel">
        <a href="changedett.php">ChangeDETT</a>
        <a href="logout.php">Log Out</a>
    </div>
    <div class="bundhel">
        <form action="" method="post">
            <input type="text" name="singditulis" size="35" autofocus placeholder="Ketik sing pengen di goleti" autocomplete="off">
            <button type="submit" name="golet"> Golet </button>
        </form>
        <!-- NAVIGASI LIMIT-->
        <!-- preview < dari bisa ditulis jdi &lt; gnti wae lah ddi &laquo;  -->
        <!-- nek ng pagetif 1 ra sah metu koe cok tempiling ngawe -->
        <?php if ($pagetif > 1) : ?>
            <a href="?page=<?= $pagetif - 1 ?>">&laquo;</a>
        <?php endif; ?>

        <?php for ($pagenav = 1; $pagenav <= $jmlahpage; $pagenav++) : ?>
            <!-- BEN Keton page pira  -->
            <?php if ($pagenav == $pagetif) : ?>
                <a href="?page=<?= $pagenav; ?>" style="font-weight:bold; color:black;"><?= $pagenav; ?></a>
            <?php else : ?>
                <a href="?page=<?= $pagenav; ?>"><?= $pagenav; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <!-- nextview > dari bisa ditulis jdi &gt; ganti bae lah ddi &raquo;  -->
        <!-- nek ng pagetif 1 ra sah metu koe cok tempiling ngawe -->
        <?php if ($pagetif < $jmlahpage) : ?>
            <a href="?page=<?= $pagetif + 1 ?>">&raquo;</a>
        <?php endif; ?>
    </div>
    <div class="buncis">
        <table border="4" cellpadding="0" cellspacing="0" class="kangkung">
            <tr>
                <th>No.</th>
                <th>Action</th>
                <th>Profil</th>
                <th>Id_Server</th>
                <th>Nick_Name</th>
                <th>Contact</th>
                <th>Rollers</th>
            </tr>

            <?php $no_urut = 1; ?>
            <?php foreach ($member as $mbr) : ?>

                <tr>
                    <td><?= $no_urut ?> </td>
                    <td> <a href="editodata.php?id=<?= $mbr["id"]; ?>">Editto</a> |
                        <a href="deletedata.php?id=<?= $mbr["id"]; ?>
                      " onclick="return confirm ('YAKIN NGAB ?, AREP SOLO !')">Delete</a>
                    </td>
                    <td> <img class="ngtabel" src="proff/<?= $mbr["profil"]; ?>"> </td>
                    <td> <?= $mbr["id_server"]; ?> </td>
                    <td> <?= $mbr["nick_name"]; ?> </td>
                    <td> <?= $mbr["contact"]; ?> </td>
                    <td> <?= $mbr["rollers"]; ?> </td>
                </tr>
                <?php $no_urut++; ?>
            <?php endforeach; ?>

        </table>
    </div>
</body>

</html>