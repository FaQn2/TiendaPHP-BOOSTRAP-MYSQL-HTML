<?php
session_start();
$_SESSION["id_user"] = 0;
$_SESSION["id_cliente"] = 0;
$_SESSION["cliente"] = "";
$_SESSION["email"] = "";
//borra o vacia las variables de sesion
session_destroy();
header ("Location: index.php");
?>