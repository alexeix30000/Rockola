<?php
$titulo = $_GET['titulo']; // Obtener el título desde la consulta GET
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "rockola");
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Obtención del título y del intérprete de cada canción
$sql = "SELECT interprete, titulo FROM canciones WHERE titulo LIKE '%$titulo%'";
$result = $conn->query($sql);

// Si se encontraron canciones, se devuelven los datos en formato JSON
if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = array("interprete" => $row["interprete"], "titulo" => $row["titulo"]);
    }
    // Devolver los datos en formato JSON
    echo json_encode($data);
}

// Cierre de la conexión
$conn->close();
?>