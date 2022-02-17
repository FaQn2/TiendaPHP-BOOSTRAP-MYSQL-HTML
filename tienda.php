<?php
session_start();

require("lib/cnn.php");

// Leo las variables pasadas por URL (formulario con propiedad type = GET)
// Nombre a buscar
if (isset($_GET["txtValorBuscado"])) {
    $valorBuscado = $_GET["txtValorBuscado"];
} else {
    $valorBuscado = "";
}

// Rubro
if (isset($_GET["cboRubro"])) {
    if ($_GET["cboRubro"] == '0') {
        $rubro = "";
        $id_rubro = "";
    } else {
        $rubro = " AND id_rubro = " . $_GET["cboRubro"];
        // Esta variable se usa para establecer la propiedade 'selected' del combo de rubros.
        $id_rubro = $_GET["cboRubro"];
    }
} else {
    $rubro = "";
    $id_rubro = "";
}

// Orden de registros
if (isset($_GET["cboOrden"])) {
    $orden = $_GET["cboOrden"];
} else {
    $orden = "nombre";
}

$col = 1;

$sql = "SELECT * 
        FROM productos 
        WHERE nombre LIKE '%" . $valorBuscado . "%'" . $rubro . " ORDER BY " . $orden;
$productos = mysqli_query($cnn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require("head.php"); ?>
    <title>System32 - Tienda</title>
</head>

<body>
    <?php require("header.php"); ?>

    <div class="container">
        <p>
            <!-- formulario para buscar registros por nombre, filtro por rubro y orden -->
        <form action="tienda.php" method="get">
            <p>
            <div class="form-group">
                <label for="cboOrden">Orden:</label>
                <select class="form-control" name="cboOrden">
                    <option value="nombre" <?php if ($orden == "nombre") {
                                                echo "selected";
                                            } ?>>Orden: alfabético</option>
                    <option value="precio ASC" <?php if ($orden == "precio ASC") {
                                                    echo "selected";
                                                } ?>>Orden: precio menor a mayor</option>
                    <option value="precio DESC" <?php if ($orden == "precio DESC") {
                                                    echo "selected";
                                                } ?>>Orden: precio mayor a menor</option>
                </select>
            </div>
            </p>

            <p>
            <div class="form-group">
                <label for="txtValorBuscado">Buscar:</label>
                <input class="form-control" type="text" name="txtValorBuscado" value="<?php echo $valorBuscado; ?>" />
            </div>
            </p>

            <p>
            <div class="form-group">
                <label for="cboRubro">Rubro:</label>
                <select class="form-control" name="cboRubro">
                    <option value='0' selected>- TODOS -</option>
                    <?php
                    $sql = "SELECT id, nombre FROM rubros ORDER BY nombre";
                    $rubros = mysqli_query($cnn, $sql);
                    $cantidad = mysqli_num_rows($rubros);
                    if ($cantidad > 0) {
                        while ($filaRubro = mysqli_fetch_array($rubros)) {
                            // Si la fila que estoy cargando de la tabla rubros coincide con la variable $id_rubro
                            // que seleccionó el usuario, establezco la propiedad 'selected' en el combo que estoy cargando.
                            if ($filaRubro["id"] == $id_rubro) {
                                echo "<option value='" . $filaRubro["id"] . "' selected>" . $filaRubro["nombre"] . "</option>";
                            } else {
                                echo "<option value='" . $filaRubro["id"] . "'>" . $filaRubro["nombre"] . "</option>";
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            </p>

            <p>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="btnBuscar" value="Buscar" />
            </div>
            </p>
        </form>
        </p>

        <?php
        $cantidad = mysqli_num_rows($productos);
        if ($cantidad > 0) {
            while ($filaProd = mysqli_fetch_array($productos)) {
                if ($col == 1)
                {
                    echo "<div class='row'>";
                }
        ?>
                <div class='col-xs-12 col-sm-6 col-md-3' style='padding-top: 15px; padding-bottom: 15px;'>
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $filaProd["nombre"]; ?></h5>
                            <p>
                                <?php
                                if (file_exists("fotos/" . $filaProd["id"] . ".jpg")) {
                                    $rutaImg = "fotos/" . $filaProd["id"] . ".jpg";
                                } else {
                                    $rutaImg = "fotos/no-image.jpg";
                                }
                                echo "<img class='img-fluid img-thumbnail' width='300' height='300' src='$rutaImg' />";
                                ?>
                            </p>

                            <h6 class="card-subtitle mb-2 text-muted">Costo: $ <?php echo $filaProd["precio"]; ?></h6>
                            <p class="card-text"><?php echo $filaProd["notas"]; ?></p>
                            <a href="pago.php" class="btn btn-primary">Comprar</a>
                        </div>
                    </div>
                </div>
        <?php
                if ($col == 4)
                {
                    $col = 1;
                    echo "</div>";
                }
                elseif ($col == 3)
                {
                    $col = 4;
                }
                elseif ($col == 2)
                {
                    $col = 3;
                }
                elseif ($col == 1)
                {
                    $col = 2;
                }
            }
        }
        mysqli_free_result($rubros);
        mysqli_free_result($productos);
        mysqli_close($cnn);
        ?>
    </div>
    
   
</body>


</html>