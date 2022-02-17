
<?php
session_start();
$msgErr = "";

if ($_SESSION["id_user"] != session_id() || $_SESSION["admin"] != 1)
{
	header("Location: ../login.php");
}

header("Content-Type: text/html;charset=utf-8");

require ("../lib/cnn.php");

if (isset($_POST["btnGrabar"]) == "Grabar")
{
	$nombre = $_POST["nombre"];
    $id_rubro = $_POST["id_rubro"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $notas = $_POST["notas"];

	$sql = "INSERT INTO productos (nombre, id_rubro, stock, precio, notas) 
            VALUES ('$nombre', $id_rubro, $stock, $precio, '$notas')";
	
    if (!@mysqli_query ($cnn, $sql)) {
		$msgErr = "Error MySQL: ".mysqli_error($cnn);
	}
    else
    {
        $id_ultimo = mysqli_insert_id($cnn);

        //BASADO EN JPEG, PARA USAR EN PNG, GIF ETC CAMBIAR EL NOMBRE DE LAS FUNCIONES
        if (isset($_FILES['imagen']) && $_FILES['imagen']['tmp_name'] != '')
        {
            echo "entro a imagen";
            $rutaImg = "../fotos/".$id_ultimo.".jpg";
            
            //Imagen original
            $rtOriginal = $_FILES['imagen']['tmp_name'];
            
            //Crear variable
            $original = imagecreatefromjpeg($rtOriginal);
            
            //Ancho y alto máximo
            $max_ancho = 800; $max_alto = 800;
            
            //Medir la imagen
            list($ancho, $alto) = getimagesize($rtOriginal);
            
            //Ratio
            $x_ratio = $max_ancho / $ancho;
            $y_ratio = $max_alto / $alto;
            
            //Proporciones
            if (($ancho <= $max_ancho) && ($alto <= $max_alto))
            {
                $ancho_final = $ancho;
                $alto_final = $alto;
            }
            elseif (($x_ratio * $alto) < $max_alto)
            {
                $alto_final = ceil($x_ratio * $alto);
                $ancho_final = $max_ancho;
            }
            else
            {
                $ancho_final = ceil($y_ratio * $ancho);
                $alto_final = $max_alto;
            }
            
            //Crear un lienzo
            $lienzo = imagecreatetruecolor($ancho_final, $alto_final); 
            
            //Copiar original en lienzo
            if (!imagecopyresampled($lienzo, $original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto))
            {
                $err = 1;
                $msgError .= "Error al copiar la imagen original en lienzo.";
            }
                
            //Destruir la original
            if (!imagedestroy($original))
            {
                $err = 1;
                $msgError .= "Error al destruir la imagen original.";
            }
            
            //Crear la imagen y guardar en directorio
            if (!imagejpeg($lienzo, $rutaImg))
            {
                $err = 1;
                $msgError .= "Error al crear la nueva imagen y guardar en el directorio.";
            }
        }
        mysqli_close($cnn);
        header("Location: productos.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("../head.php"); ?>
    <title>System32 - Rubros</title>
</head>
<body>
    <?php require("../header.php"); ?>

    <div class="container">
        <?php
        if ($msgErr != "")
        {
            echo "<h3>".$msgErr."</h3>";
        }
        ?>
        <p>
            <form action="productos_altas.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="usuario">Nombre:</label>
                    <input class="form-control" type="text" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="id_rubro">Rubro:</label>
                    <select class="form-control" name="id_rubro">
                    <?php
                        $sql = "SELECT id, nombre FROM rubros ORDER BY nombre";
                        $query = mysqli_query($cnn, $sql);
                        $cantidad = mysqli_num_rows($query);
                        if ($cantidad > 0)
                        {
                            while ($fila = mysqli_fetch_array ($query))
                            {
                                echo "<option value='".$fila["id"]."'>".$fila["nombre"]."</option>";
                            }
                        }
                        mysqli_close($cnn);
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input class="form-control" type="number" name="stock" required>
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input class="form-control" type="number" name="precio" step="0.01" min="0" max="9999999" required>
                </div>

                <div class="form-group">
                    <label for="notas">Notas:</label>
                    <textarea class="form-control" name="notas"></textarea>
                </div>

                
                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <input class="form-control" type="file" name="imagen" />
                </div>

                <div class="form-group">
                    <button type="submit" name="btnGrabar" value="Grabar" class="btn btn-primary">Grabar</button>
                    <a class="btn btn-secondary" href='productos.php' role="button">Volver a Productos</a>
                </div>
            </form>
        </p>
    </div>
      
</body>
</html>

