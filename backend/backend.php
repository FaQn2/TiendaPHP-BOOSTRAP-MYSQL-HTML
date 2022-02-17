<?php
session_start();

// VB -> AND - OR - <>
// PHP -> && - || - !=
//nos permite saber si el usuario esta logeado, pregunta si el iduser es desigual a sessionid, si es si lo manda al logearse y si es no loguea, 
//
if ($_SESSION["id_user"] != session_id() || $_SESSION["admin"] != 1)
{
	header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("../head.php"); ?>
    <title>System32 - Backend (solo personal autorizado)</title>
</head>
<body>
    <?php require("../header.php"); ?>
    
    <div class="container">
        <p class="text-center">
            <a class="btn btn-danger" href="productos.php" role="button">PRODUCTOS</a> | 
            <a class="btn btn-warning" href='rubros.php' role="button">RUBROS</a>
        </p>
        <!-- <button type="button" class="btn btn-danger">Danger</button> -->
    </div>
    
       
</body>
</html>