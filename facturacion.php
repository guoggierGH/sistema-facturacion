<html>
<?php
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


/*$sqlCliente = "SELECT * FROM cliente";
$sqlItem = "SELECT * FROM item";
$sqlSucursal = "SELECT * FROM sucursal";
$result = $conn->query($sqlCliente);
$fechaFactura = new DateTime('2026/01/01');*/

function insertDatos($conn){
  $fechaFactura = new DateTime('2026/01/01');
  $nroFactura = 0;
$estados = ["Pendiente", "Activo", "Atrasado"];
for ($d =1; $d <= 365; $d++){
    for ($i = 0; $i < 10; $i++) {
        $nroFactura++;
        $idCliente = rand(1, 40);
        $importe = rand(1000, 50000);
        $iva = $importe * 0.21;
        $estado = rand(1, 3);
        $sucursal = rand(1, 5);

        echo "Factura numero " . $nroFactura . ": " . "<br>";
        echo "Numero del cliente: " . $idCliente . "<br>";
        $fecha = $fechaFactura->format('Y/m/d');
        echo "Fecha emitida: " . $fecha . "<br>";
        echo "El importe a pagar es (+IVA): " . $iva . "<br>";
        echo "El estado es: " . $estados[$estado - 1] . "<br>";
        echo "La sucursal es: " . $sucursal . "<br>";

        echo "------------------------------------" . "<br>";
        $insert = "INSERT INTO factura (nroFactura, fechaFactura, idCliente, idSucursal, importe, iva, estado) VALUES
        ('$nroFactura', '$fecha', '$idCliente', '$sucursal', '$importe', '$iva', '".$estados[$estado - 1]."')";
        if ($conn->multi_query($insert) === TRUE) {
        echo "New records inserted successfully";
        } else {
        echo "Error: " . $insert . "<br>" . $conn->error;
        }
    }
    $fechaFactura->modify('+1 day');
}



$conn->close();
};

//insertDatos($conn);

$traerCliente = "SELECT nroFactura, fechaFactura, idCliente, idSucursal, importe, iva, estado FROM factura WHERE idCliente = '2' ";
$result = $conn->query($traerCliente);
if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    echo "nroFactura: " . $row["nroFactura"]. " - fechaFactura: " . $row["fechaFactura"]. "idCliente" . $row["idCliente"]. "idSucursal" . $row["idSucursal"]. "importe" . $row["importe"]. "iva" . $row["iva"]. "estado" . $row["estado"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();


?>

</html>