<?php
session_start();
if ($_SESSION["id_user"] != session_id() || $_SESSION["admin"] != 1)
{
	header("Location: ../login.php");
}


if (isset($_GET["Id"]))
{
    require ("../lib/cnn.php");

    $id = $_GET["Id"];
    $err = false;
        
    $sql = "DELETE FROM productos WHERE id = ".$id;
    if (!@mysqli_query ($cnn, $sql)) {
        $err = true;
        $error_baja = "<p>: ".mysqli_error($cnn)."</p>";
    }
    
    mysqli_close($cnn);
    
    // Si hubo algún error lo muestro.
    if ($err == true)
    {
        echo "<h1>Han ocurrido errores!!!</h1>";
        echo $error_baja;
        echo "<p>Volver a: <a href='productos.php'>Listado</a></p>";
    }
    else
    {
        header("Location: productos.php"); // Si todo OK, vuelvo al listado.
    }
}
else
{
    header("Location: productos.php");
}
?>