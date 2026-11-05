<?php
header("Content-type:application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_facturacion";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$nroFactura = 0;

$getCliente = "SELECT id, nombre, apellido, situacionFiscal, dni FROM cliente";
$result = $conn->query($getCliente);
$cliente = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
echo json_encode($cliente);
$conn->close();

?>