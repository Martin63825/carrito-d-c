<?php
  session_start();
  // Verificar si el usuario ya ha iniciado sesión
  if(isset($_SESSION["username"])){
    header("Location: index.php");
    exit;
  }
  // Verificar si el formulario ha sido enviado
  if(isset($_POST["username"]) && isset($_POST["password"])){
    // Conexión a la base de datos
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "tienda_en_linea";
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    // Consultar la existencia del usuario en la base de datos
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      // Iniciar sesión y redirigir al usuario a la página principal
      $_SESSION["username"] = $username;
      header("Location: index.php");
      exit;
    }else{
      // Mostrar mensaje de error si los datos son incorrectos
      echo "Nombre de usuario o contraseña incorrectos";
    }
    // Cerrar la conexión a la base de datos
    $conn->close();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Iniciar sesión</title>
</head>
<body>
  <h1>Iniciar sesión</h1>
  <form method="post" action="">
    <label>Nombre de usuario:</label>
    <input type="text" name="username" required><br><br>
    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Iniciar sesión">
  </form>
</body>
</html>