<?php
  session_start();

  // Conexión a la base de datos
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "tienda_en_linea";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Insertar el pedido en la base de datos
  $nombre = $_POST["nombre"];
  $correo = $_POST["correo"];
  $direccion = $_POST["direccion"];

  $sql = "INSERT INTO pedidos (nombre, correo, direccion) VALUES ('$nombre', '$correo', '$direccion')";
  $conn->query($sql);

  $pedido_id = $conn->insert_id;

  foreach ($_SESSION["carrito"] as $producto) {
    $producto_id = $producto["id"];
    $cantidad = $producto["cantidad"];

    $sql = "INSERT INTO detalles_pedidos (pedido_id, producto_id, cantidad) VALUES ($pedido_id, $producto_id, $cantidad)";
    $conn->query($sql);
  }

  // Cerrar la conexión a la base de datos
  $conn->close();

  // Mostrar un mensaje de éxito y limpiar el carrito de compras
  unset($_SESSION["carrito"]);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Compra exitosa</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    h1 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    p {
      font-size: 18px;
      margin-bottom: 10px;
    }

    a {
      color: #fff;
      background-color: #0066cc;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Compra exitosa</h1>

    <p>¡Gracias por tu compra!</p>

    <p>Número de pedido: <?php echo $pedido_id; ?></p>

    <a href="index.php">Regresar a la tienda</a>
  </div>
</body>
</html>