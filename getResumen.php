<?php
header("Content-type:application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$conn = mysqli_connect("localhost", "root", "", "sistema_facturacion");
if (!$conn) {
    http_response_code(500);
    die(json_encode(["error" => "Connection failed"]));
}

$sql = "SELECT
          (SELECT COUNT(*) FROM sucursal) AS sucursales,
          (SELECT COUNT(*) FROM cliente)  AS clientes,
          (SELECT COUNT(*) FROM factura)  AS facturas,
          (SELECT COALESCE(SUM(importe + iva), 0) FROM factura) AS totalFacturado";

$result = $conn->query($sql);
echo json_encode($result->fetch_assoc());

$conn->close();
?>
