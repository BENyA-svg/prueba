<?php


$Servidor = "localhost";
$Usuario = "root";
$pass = "";
$bd = "prueba";
$port="3306";
$con = mysqli_connect($Servidor, $Usuario, $pass, $bd, $port);
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}else {
    echo "Conexión exitosa a la base de datos.";
}


?>
<body>
    <form method="POST" action="">
        <input type="number" name="ci" placeholder="Cédula de identidad">
        <input type="text" name="nombre" placeholder="Nombre">
        <input type="text" name="apellido" placeholder="Apellido">
        <input type="submit" value="Enviar">
       
    </form>
<?php 
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ci = $_POST['ci'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $sql = "INSERT INTO clientes(ci, Nombre, Apellido) 
        VALUES (".$ci.", '".$nombre."', '".$apellido."')";
        if ($con->query($sql) === TRUE) {
            echo "<p>Registro guardado correctamente.</p>";
        } else {
          
        }
    }
?>

</body>