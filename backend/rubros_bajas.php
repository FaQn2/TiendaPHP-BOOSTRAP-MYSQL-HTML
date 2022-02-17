<?php
session_start();
if ($_SESSION["id_user"] != session_id() || $_SESSION["admin"] != 1)
{
	header("Location: ../login.php");
}

//si existe la variable entonces
if (isset($_GET["Id"]))
{
    //llamo a la conexion
    require ("../lib/cnn.php");
  //recupero la variable para saber que tengo q borrar (señalar con el mouse para comprobar)
    $id = $_GET["Id"];
    $err = false;
        
    $sql = "DELETE FROM rubros WHERE id = ".$id;
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
        echo "<p>Volver a: <a href='rubros.php'>Listado</a></p>";
    }
    else
    {
        header("Location: rubros.php"); // Si todo OK, vuelvo al listado.
    }
}
//si no existe
else
{
    header("Location: rubros.php");
}
?>