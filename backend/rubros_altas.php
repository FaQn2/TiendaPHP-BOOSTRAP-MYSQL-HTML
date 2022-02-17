<?php
session_start();
$msgErr = "";

if ($_SESSION["id_user"] != session_id() || $_SESSION["admin"] != 1)
{
	header("Location: ../login.php");
}

header("Content-Type: text/html;charset=utf-8");

if (isset($_POST["btnGrabar"]) == "Grabar")
{
	require ("../lib/cnn.php");

	$nombre = $_POST["nombre"];
	$sql = "INSERT INTO rubros (nombre)	VALUES ('$nombre')";
	
	if (!@mysqli_query ($cnn, $sql)) {
		$msgErr = "Error MySQL: ".mysqli_error($cnn);
	}
    else
    {
        header("Location: rubros.php");
    }

	mysqli_close($cnn);
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
            <form action="rubros_altas.php" method="post">
               
            <div class="form-group">
                    <label for="stock">Nombre:</label>
                    <input class="form-control" type="text" name="nombre" required>
                </div>
  
                <div class="form-group">
                    <button type="submit" name="btnGrabar" value="Grabar" class="btn btn-primary">Grabar</button>
                    <a class="btn btn-secondary" href='rubros.php' role="button">Volver a Rubros</a>
                </div>
            </form>
        </p>
    </div>                 
            </form>
        </p>
    </div>
    
      
</body>
</html>