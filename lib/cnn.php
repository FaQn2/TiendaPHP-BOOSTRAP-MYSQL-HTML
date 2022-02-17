<?php
function Conectar()
{
	$host = "localhost";
	$base = "System32";
	$user = "s32";
	$pass = "123";
	//create and check conection
//  ! este simbolo es la negacion
    if (!($cnn = mysqli_connect($host, $user, $pass)))
    {
		echo "Error al conectar al servidor de bases de datos.";
		exit();
	}

    if (!mysqli_select_db($cnn, $base))
    {
		echo "Error al seleccionar la base de datos.";
		exit();
	}
	
    return $cnn;
}

function desconectar()
{
	mysqli_close();
}
//llama a la funcion conectar
$cnn = Conectar();
mysqli_set_charset($cnn, "utf8");
?>