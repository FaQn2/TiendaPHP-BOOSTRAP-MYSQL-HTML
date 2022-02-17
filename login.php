
<?php
session_start();
$msgErr = "";

if (isset($_POST["Login"]) == "Conectar")
{
    require ("lib/cnn.php");

    $email = $_POST["email"];
    $pass = $_POST["pass"];

    //preguntamos si el usuario y la clave estan bien
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND clave = '$pass'";
    $rs = mysqli_query($cnn, $sql);

    $cantidad = mysqli_num_rows($rs);
    if ($cantidad <= 0)
    {
        $msgErr = "Acceso incorrecto. Verifique sus credenciales y reintente";
    }
    else
    {
        //aca se crean las variables de sesion
        while ($dato = mysqli_fetch_array ($rs))
        {
            $_SESSION["id_user"] = session_id();
            $_SESSION["id_cliente"] = $dato["id"];
            $_SESSION["cliente"] = $dato["nombre"];
            $_SESSION["email"] = $dato["email"];
            $_SESSION["admin"] = $dato["admin"];
        }
    }
    mysqli_free_result($rs);
    mysqli_close($cnn);

    if ($msgErr == "") { header("Location: tienda.php"); }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("head.php"); ?>
    <title>System32 - Login</title>
    
</head>
<body>
    <?php require("header.php"); ?>
   

    <div class="container">
    <?php
    if ($msgErr != "")
    {
        echo "<div class='alert alert-danger' role='alert'>".$msgErr."</div>";
    }
    ?>
    <p>
        <form class="box" action="login.php" method="post">
            <p>
                <label for="email">E-mail:</label>
                <input type="email" name="email">
            </p>
            <p>
                <label for="pass">Contrase&ntilde;a:</label>
                <input type="password" name="pass" />
            </p>
            <p>
                <input type="submit" name="Login" value="Conectar" />
            </p>
        </form>
    </p>
    </div>
    <?php require("footer.php"); ?>
</body>
</html>