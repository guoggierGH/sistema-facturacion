<?php
header("Content-type:application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

// Si el navegador pregunta con OPTIONS, no hacemos nada
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit; }

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

// Datos que manda el frontend (JSON)
$datos = json_decode(file_get_contents("php://input"), true);
$usuarioIngresado = $datos['usuario'] ?? '';
$passwordIngresada = $datos['password'] ?? '';

// real_escape_string evita que metan comillas raras para romper la consulta
$usuarioIngresado = $conn->real_escape_string($usuarioIngresado);
$passwordIngresada = $conn->real_escape_string($passwordIngresada);

$traerUsuario = "SELECT id, usuario, categoria FROM usuario WHERE usuario = '$usuarioIngresado' AND password = '$passwordIngresada'";
$result = $conn->query($traerUsuario);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    http_response_code(401);
    echo json_encode(["error" => "Credenciales invalidas"]);
}

$conn->close();

?>
