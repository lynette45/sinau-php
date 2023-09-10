<?php
session_start(); #syarat
$_SESSION = []; # ben tmbah yakin banget timpa array kosong
session_unset(); #ben tmbah yakin
session_destroy(); #ngajurna seseion

setcookie('eo', '', time() - 3600); #untuk id
setcookie('key', '', time() - 3600); #untuk user

header("Location: login.php");
exit;

?>