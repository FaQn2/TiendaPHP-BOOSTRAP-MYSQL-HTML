<?php
session_start();
if ($_SESSION["id_user"] != session_id() || $_SESSION["admin"] != 1)
{
	header("Location: ../login.php");
}


require ("../lib/cnn.php");
$sql = "SELECT * FROM rubros ORDER BY nombre";
//consulta a la conexion a la base de datos, rs = recorced
$rs = mysqli_query($cnn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <?php require("../head.php"); ?>
    <title>System32 - Rubros</title>
</head>

<body>
   
     <?php require("../header.php"); ?> <!-- llamo al header.php (encabezado)-->

   <div class="container">
   <p class="text-center">
            <a class="btn btn-primary" href='rubros_altas.php' role="button">Nuevo Rubro</a>
            <a class="btn btn-secondary" href='backend.php' role="button">Volver a Sistema</a>
        </p>
    
    <p>
    <?php
      //devuelve la cantidad de registros
      //variables en PHP con $
        $cantidad = mysqli_num_rows($rs);
        if ($cantidad > 0)
        {
    ?>
      <!-- filas = tr, celda de encabezado = th, celda de datos = n -->
        <table class='table table-hover'>
            <tr>
                <th><strong>Id</strong></th>
                <th><strong>Nombre</strong></th>
                <th><strong>Editar</strong></th>
                <th><strong>Borrar</strong></th>
            </tr>  
        <?php
            while ($dato = mysqli_fetch_array ($rs))
            {
                echo "<tr>";
                echo "<td>".$dato["id"]."</td>";
                echo "<td>".$dato["nombre"]."</td>";
                // Armo los links para editar y borrar registro.
                //para concatenar cadenas usamos el . punto
                //las primeras variales del URL se pasan con el ?, todas las otras con el &
                echo "<td><a href='rubros_editar.php?Id=".$dato["id"]."'><img src='../images/editar_32.png' title='Editar'></a></td>";
                echo "<td><a href='rubros_bajas.php?Id=".$dato["id"]."'><img src='../images/borrar_32.png' title='Borrar'></a></td>";
                echo "</tr>";
            }
        ?>
        </table>
        </p>
        <?php
        }
        else
        {
            echo "<p>No hay registros.</p>";
        }
        //vacia la memoria del servidor con la consulta que yo hice
        mysqli_free_result($rs);
        //cierra la conexion
        mysqli_close($cnn);
        ?>
    </p>
    </div>
    <!-- llamo al footer.php(piede de pagina) -->
      
</body>
</html>