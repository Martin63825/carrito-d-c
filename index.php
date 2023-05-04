<!DOCTYPE html>
<html>
<head>
  <title>Tienda en línea</title>
</head>
<body>
  <h1>Bienvenido a nuestra tienda en línea</h1>

  <?php
    // Aquí irá el código PHP para mostrar los productos
  ?>

</body>
</html>
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
?>
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

  // Obtener los productos de la base de datos
  $sql = "SELECT * FROM productos";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Mostrar los productos
    while($row = $result->fetch_assoc()) {
      echo "<h2>" . $row["nombre"] . "</h2>";
      echo "<p>" . $row["descripcion"] . "</p>";
      echo "<p>Precio: $" . $row["precio"] . "</p>";
      echo "<img src='" . $row["imagen"] . "' alt='" . $row["nombre"] . "'>";
      echo "<br><br>";
    }
  } else {
    echo "No se encontraron productos";
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
?>
<?php
  // Iniciar sesión
  session_start();

  // Verificar si el usuario ya inició sesión
  if (isset($_SESSION["username"])) {
    echo "<p>Bienvenido, " . $_SESSION["username"] . "!</p>";
    echo "<p><a href='logout.php'>Cerrar sesión</a></p>";
  } else {
    // Mostrar el formulario de inicio de sesión
    echo "<form method='post' action='login.php'>";
    echo "<label for='username'>Nombre de usuario:</label>";
    echo "<input type='text' id='username' name='username'>";
    echo "<label for='password'>Contraseña:</label>";
    echo "<input type='password' id='password' name='password'>";
    echo "<input type='submit' value='Iniciar sesión'>";
    echo "</form>";
  }
?>
<?php
  session_start();

  // Agregar un producto al carrito de compras
  if (isset($_POST["id"]) && isset($_POST["cantidad"])) {
    $producto = array(
      "id" => $_POST["id"],
      "nombre" => $_POST["nombre"],
      "precio" => $_POST["precio"],
      "cantidad" => $_POST["cantidad"]
    );

    // Agregar el producto al carrito de compras
    $_SESSION["carrito"][$_POST["id"]] = $producto;
  }

  // Mostrar el contenido del carrito de compras
  if (isset($_SESSION["carrito"])) {
    echo "<h2>Carrito de compras</h2>";

    foreach ($_SESSION["carrito"] as $producto) {
      echo "<p>" . $producto["nombre"] . " x " . $producto["cantidad"] . " - $" . $producto["precio"] * $producto["cantidad"] . "</p>";
    }

    echo "<a href='checkout.php'>Pagar</a>";
  }
?>
