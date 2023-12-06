<?php
// Conectarnos a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'rockola');

// Verificar la conexión
if (!$conexion) {
  die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Obtener el valor del parámetro GET 'interprete'
$interprete = $_GET['interprete'];

// Buscar la ruta de la canción asociada al interprete
$sql = "SELECT ruta FROM canciones WHERE interprete = '$interprete' LIMIT 1";
$resultado = mysqli_query($conexion, $sql);

// Verificar si se encontró una ruta
if (mysqli_num_rows($resultado) == 1) {

  // Obtener la ruta
  $fila = mysqli_fetch_assoc($resultado);
  $ruta = $fila['ruta'];

  // Verificar si el archivo existe en la ruta
  if (file_exists($ruta)) {

    // Establecer la cabecera de respuesta para 'audio/mpeg'
    header('Content-Type: audio/mpeg');

    // Transmitir el archivo MP3 al cliente
    readfile($ruta);
    
  } else {
    // Mostrar mensaje de error
    http_response_code(404);
    echo "El archivo no fue encontrado.";
  }
  
} else {
  // Mostrar mensaje de error
  http_response_code(404);
  echo "No se encontró una ruta para el intérprete especificado.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>