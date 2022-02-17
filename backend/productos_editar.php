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
	$id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $id_rubro = $_POST["id_rubro"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $notas = $_POST["notas"];

	$sql = "UPDATE productos 
            SET nombre = '$nombre', id_rubro = $id_rubro, stock = $stock, precio = $precio, notas = '$notas' 
            WHERE id = $id";

    if (!@mysqli_query ($cnn, $sql)) {
		$msgErr = "Error MySQL: ".mysqli_error($cnn);
	}
    else
    {
        mysqli_close($cnn);
        header("Location: productos.php");
    }
}
elseif (isset($_GET["Id"]))
{
    $id = $_GET["Id"];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $queryProd = mysqli_query($cnn, $sql);
    $cantidad = mysqli_num_rows($queryProd);
    if ($cantidad > 0)
    {
        $filaProd = mysqli_fetch_array ($queryProd);
    }    
}
else
{
    mysqli_close($cnn);
    header("Location: productos.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("../head.php"); ?>
    <title>System32 - productos</title>
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
            <form action="productos_editar.php" method="post">
                <div class="form-group">
                    <label for="id">Id:</label>
                    <input class="form-control" type="text" name="id" value="<?php echo $filaProd["id"]; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="usuario">Nombre:</label>
                    <input class="form-control" type="text" name="nombre" value="<?php echo $filaProd["nombre"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="id_rubro">Rubro:</label>
                    <!-- para llenar una lista desplegable -->
                    <select class="form-control" name="id_rubro">
                    <?php
                        $sql = "SELECT id, nombre FROM rubros ORDER BY nombre";
                        $query = mysqli_query($cnn, $sql);
                        $cantidad = mysqli_num_rows($query);
                        if ($cantidad > 0)
                        {
                            while ($fila = mysqli_fetch_array ($query))
                            {
                                if ($filaProd["id_rubro"] == $fila["id"])
                                {
                                    echo "<option value='".$fila["id"]."' selected>".$fila["nombre"]."</option>";
                                }
                                else
                                {
                                    echo "<option value='".$fila["id"]."'>".$fila["nombre"]."</option>";
                                }
                            }
                        }
                        mysqli_close($cnn);
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input class="form-control" type="number" name="stock" value="<?php echo $filaProd["stock"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input class="form-control" type="number" name="precio" value="<?php echo $filaProd["precio"]; ?>" step="0.01" min="0" max="9999999" required>
                </div>

                <div class="form-group">
                    <label for="notas">Notas:</label>
                    <textarea class="form-control" name="notas"><?php echo $filaProd["notas"]; ?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" name="btnGrabar" value="Grabar" class="btn btn-primary">Grabar</button>
                    <a class="btn btn-secondary" href="productos.php" role="button">Volver a Productos</a>
                </div>
            </form>
        </p>
    </div>
    
      
</body>
</html>