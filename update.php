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

echo "<br>";
?>
<body>




    <form method="POST" action="">
        <label for="agregar">Agregar usuario:</label>
        <input type="radio" name="accion" id="agregar" value="agregar">
        <br>
        <label for="actualizar">Actualizar usuario:</label>
        <input type="radio" name="accion" id="actualizar" value="actualizar">
        <br>
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
        if (isset($_POST['accion'])&& $_POST['accion'] == 'agregar') {
            $sql = "INSERT INTO clientes(ci, Nombre, Apellido) 
            VALUES (".$ci.", '".$nombre."', '".$apellido."')";
        }elseif (isset($_POST['accion'])&& $_POST['accion'] == 'actualizar') {
        $sql = "UPDATE clientes
        SET Nombre = '".$nombre."', Apellido = '".$apellido."'
        WHERE ci = ".$ci;
        }
        if ($con->query($sql) === TRUE) {
            if ($_POST['accion'] == 'agregar') {
                echo "<p>Registro guardado correctamente.</p>";
           
            }if ($_POST['accion'] == 'actualizar') {
            echo "<p>informacion editada correctamente.</p>";
           
        }
        } else {
            echo "<p>Error en la consulta: " . $con->error . "</p>";
        }
    }
    
$sel = "SELECT * FROM clientes";    
$res = $con->query($sel);
if ($res->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>CI</th><th>Nombre</th><th>Apellido</th></tr>";
    while($fila = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["ci"] . "</td>";
        echo "<td>" . $fila["nombre"] . "</td>";
        echo "<td>" . $fila["apellido"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

?>

</body>