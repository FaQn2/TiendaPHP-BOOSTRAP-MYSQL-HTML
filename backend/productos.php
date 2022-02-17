<?php
session_start();
if ($_SESSION["id_user"] != session_id() || $_SESSION["admin"] != 1)
{
	header("Location: ../login.php");
}

require ("../lib/cnn.php");

/* $sql = "SELECT * FROM productos ORDER BY nombre";
$rs = mysqli_query($cnn, $sql); */


// Leo las variables pasadas por URL (formulario con propiedad type = GET)
// Nombre a buscar
if (isset($_GET["txtValorBuscado"]))
{
    $valorBuscado = $_GET["txtValorBuscado"];
}
else
{
    $valorBuscado = "";
}
// Rubro
if (isset($_GET["cboRubro"]))
{
    //para que funcione el "todos los rubros"
    if ($_GET["cboRubro"] == '0')
    {
        $rubro = "";
        $id_rubro = "";
    }
    else
    {
        $rubro = " AND id_rubro = " . $_GET["cboRubro"];
        // Esta variable se usa para establecer la propiedade 'selected' del combo de rubros.
        $id_rubro = $_GET["cboRubro"];    
    }
}
else
{
    $rubro = "";
    $id_rubro = "";
}


// Orden de registros
if (isset($_GET["cboOrden"]))
{
    $orden = $_GET["cboOrden"];
}
else
{
    $orden = "nombre";
}

$sql = "SELECT * 
        FROM productos 
        WHERE nombre LIKE '%" . $valorBuscado . "%'" . $rubro . " ORDER BY " . $orden;
$rs = mysqli_query($cnn, $sql);
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

    <p>
            <!-- formulario para buscar registros por nombre, filtro por rubro y orden -->
            <form action="productos.php" method="get">
                <p>
                    <div class="form-group">
                        <label for="cboOrden">Orden:</label>
                        <select class="form-control"  name="cboOrden">
                            <option value="nombre"<?php if ($orden == "nombre") { echo "selected"; } ?>>Orden: alfabético</option>
                            <option value="precio ASC"<?php if ($orden == "precio ASC") { echo "selected"; } ?>>Orden: precio menor a mayor</option>
                            <option value="precio DESC"<?php if ($orden == "precio DESC") { echo "selected"; } ?>>Orden: precio mayor a menor</option>
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
                                $query = mysqli_query($cnn, $sql);
                                $cantidad = mysqli_num_rows($query);
                                if ($cantidad > 0)
                                {
                                    while ($fila = mysqli_fetch_array ($query))
                                    {
                                        // Si la fila que estoy cargando de la tabla rubros coincide con la variable $id_rubro
                                        // que seleccionó el usuario, establezco la propiedad 'selected' en el combo que estoy cargando.
                                        if ($fila["id"] == $id_rubro)
                                        {
                                            echo "<option value='".$fila["id"]."' selected>".$fila["nombre"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$fila["id"]."'>".$fila["nombre"]."</option>";
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

        <p class="text-center">
            <a class="btn btn-primary" href='productos_altas.php' role="button">Nuevo Producto</a>
            <a class="btn btn-secondary" href='backend.php' role="button">Volver a Sistema</a>
        </p>
        <?php
            $cantidad = mysqli_num_rows($rs);
            if ($cantidad > 0)
            {
        ?>
            <table class='table table-hover'>
                <tr>
                    <th><strong>Id</strong></th>
                    <th><strong>Nombre</strong></th>
                    <th><strong>Stock</strong></th>
                    <th><strong>Precio</strong></th>
                    <th><strong>Editar</strong></th>
                    <th><strong>Borrar</strong></th>
                </tr>  
            <?php
                while ($dato = mysqli_fetch_array ($rs))
                {
                    echo "<tr>";
                    echo "<td>".$dato["id"]."</td>";
                    echo "<td>".$dato["nombre"]."</td>";
                    echo "<td>".$dato["stock"]."</td>";
                    echo "<td>".$dato["precio"]."</td>";
                    // Armo los links para editar y borrar registro.
                    echo "<td><a href='productos_editar.php?Id=".$dato["id"]."'><img src='../images/editar_32.png' title='Editar'></a></td>";
                    echo "<td><a href='productos_bajas.php?Id=".$dato["id"]."' onClick='return confirma_borrar()'><img src='../images/borrar_32.png' title='Borrar'></a></td>";
                    echo "</tr>";
                }
            ?>
            </table>
            <?php
            }
            else
            {
                echo "<p>No hay registros.</p>";
            }
            mysqli_free_result($rs);
            mysqli_close($cnn);
        ?>
    </div>
    
    
</body>
</html>




