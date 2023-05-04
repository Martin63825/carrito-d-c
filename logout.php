<?php
  session_start();
  // Destruir la sesión
  session_destroy();
  // Redirigir al usuario a la página principal
  header("Location: index.php");
  exit;
?>