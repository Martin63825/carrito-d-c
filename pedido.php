<?php
  // Conexión a la base de datos
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "tienda_en_linea";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Obtener los pedidos del usuario
  session_start();
  $username = $_SESSION["username"];

  $sql = "SELECT id, fecha FROM pedidos WHERE usuario = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Mostrar los pedidos
    echo "<table>";
    echo "<tr><th>Número de pedido</th><th>Fecha</th></tr>";

    while ($row = $result->fetch_assoc()) {
      $pedido_id = $row["id"];
      $fecha = $row["fecha"];

      echo "<tr><td><a href='pedido.php?id=$pedido_id'>$pedido_id</a></td><td>$fecha</td></tr>";
    }

    echo "</table>";
  } else {
    echo "Aún no has realizado ningún pedido.";
  }

  // Cerrar la conexión a la base de datos
  $stmt->close();
  $conn->close();
?>