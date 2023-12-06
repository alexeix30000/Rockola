<?php
$interprete = $_GET['interprete']; // Obtener el intérprete desde la consulta GET

// Realizar la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rockola";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los títulos según el intérprete
$sql = "SELECT titulo FROM canciones WHERE interprete = '$interprete'";
$result = $conn->query($sql);

$titulos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $titulo = [
          "titulo" => $row["titulo"]
        ];
        array_push($titulos, $titulo);
    }
} else {
    $titulo = [
      "titulo" => "No se encontraron canciones."
    ];
    array_push($titulos, $titulo);
}

$conn->close();

echo json_encode($titulos);
?>

