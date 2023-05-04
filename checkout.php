<!DOCTYPE html>
<html>
<head>
  <title>Pagar</title>
</head>
<body>
  <h1>Pagar</h1>

  <form action="success.php" method="post">
    <label for="nombre">Nombre completo:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="correo">Correo
    <input type="email" id="correo" name="correo" required>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" required>

    <input type="submit" value="Pagar">
  </form>
</body>
</html>