<?php
$genero = $_GET['genero']; // Obtener el género desde la consulta GET

// Realizar la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rockola";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los intérpretes según el género
$sql = "SELECT interprete FROM canciones WHERE genero = '$genero'";
$result = $conn->query($sql);

$interpretes = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $interprete = [
      "nombre" => $row["interprete"]
    ];
    array_push($interpretes, $interprete);
  }
} else {
  $interprete = [
    "nombre" => "No se encontraron intérpretes."
  ];
  array_push($interpretes, $interprete);
}

echo json_encode($interpretes);
$conn->close();
?>
