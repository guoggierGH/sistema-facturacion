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

$getVentas = "SELECT f.nroFactura, f.fechaFactura, f.importe, f.iva, f.estado,
               CONCAT(c.nombre, ' ', c.apellido) AS cliente,
               s.nombre AS sucursal
        FROM factura f
        JOIN cliente c  ON c.id = f.idCliente
        JOIN sucursal s ON s.id = f.idSucursal
        ORDER BY f.fechaFactura DESC
        LIMIT 100";
    
$result = $conn->query($getVentas);
$ventas = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
echo json_encode($ventas);
$conn->close();

?>