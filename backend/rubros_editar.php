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
	$sql = "UPDATE rubros SET nombre = '$nombre' WHERE id = $id";
	
	if (!@mysqli_query ($cnn, $sql)) {
		$msgErr = "Error MySQL: ".mysqli_error($cnn);
	}
    else
    {
        mysqli_close($cnn);
        header("Location: rubros.php");
    }
}
elseif (isset($_GET["Id"]))
{
    $id = $_GET["Id"];
    $sql = "SELECT * FROM rubros WHERE id = $id";
    $rs = mysqli_query($cnn, $sql);
    $cantidad = mysqli_num_rows($rs);
    if ($cantidad > 0)
    {
        $dato = mysqli_fetch_array ($rs);
    }    
}
else
{
    mysqli_close($cnn);
    header("Location: rubros.php");
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
            <form action="rubros_editar.php" method="post">
                <p>
                    <label for="id">Id:</label>
                    <input type="text" name="id" value="<?php echo $dato["id"]; ?>" readonly>
                </p>
                <p>
                    <label for="usuario">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $dato["nombre"]; ?>" required>
                </p>
                <p>
                    <input type="submit" name="btnGrabar" class="btn btn-primary" value="Grabar" />
                </p>
                <p>
                <a class="btn btn-secondary" href="rubros.php" role="button">Volver a rubros</a>
                </p>
            </form>
        </p>
    </div>
    
     
</body>

</html>