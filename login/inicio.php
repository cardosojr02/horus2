<?php

require "../app/config.php";

session_start();

if(isset($_SESSION['id'])){
  header("Location: $URL");
}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Horus Login</title>
  <link rel="stylesheet" href="./style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="container">
    <div class="left">
      <div class="login">Horus</div>
      <div class="eula">Plataforma líder en venta de cuentas de streaming, donde la seguridad y efectividad son nuestra prioridad.</div>
    </div>
    <div class="right">
      <svg viewBox="0 0 320 300">
        <defs>
          <linearGradient
                          inkscape:collect="always"
                          id="linearGradient"
                          x1="13"
                          y1="193.49992"
                          x2="307"
                          y2="193.49992"
                          gradientUnits="userSpaceOnUse">
            <stop
                  style="stop-color:#ff00ff;"
                  offset="0"
                  id="stop876" />
            <stop
                  style="stop-color:#ff0000;"
                  offset="1"
                  id="stop878" />
          </linearGradient>
        </defs>
        <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
      </svg>
      <div class="form">
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autocomplete="off">
            <label for="pass">Contraseña</label>
            <input type="password" id="pass" name="pass" required autocomplete="off">
            <input type="submit" id="submit" value="Entrar">
        </form>
        <?php
if ($_POST) {
  $email = $_POST['email'];
  $pass = $_POST['pass'];

  // Incluir el archivo de conexión
  

  try {
    // Preparar la consulta SQL para obtener el usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $num = $stmt->rowCount();

    if ($num > 0) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $password_bd = $row['pass'];

      // Comparar la contraseña proporcionada por el usuario con la contraseña de la base de datos
      if ($pass === $password_bd) {
        $_SESSION["id"] = $row['id']; // Almacena el ID del usuario en la sesión
        $_SESSION["nombre"] = $row['nombre'];
        $_SESSION["email"] = $row['email'];
        $_SESSION["tipo_usuario"] = $row['tipo_usuario'];
        
        header("Location: $URL/index.php"); // Redirige a la página del dashboard
      } else {
        // Contraseña incorrecta
        echo "<script>
                Swal.fire({
                  icon: 'error',
                  title: 'Error de autenticación',
                  text: 'Datos incorrectos',
                });
              </script>";
      }
    } else {
      // Usuario no encontrado
      echo "<script>
              Swal.fire({
                icon: 'error',
                title: 'Error de autenticación',
                text: 'Datos incorrectos. u',
              });
            </script>";
    }
  } catch (PDOException $e) {
    echo "Error al obtener el usuario: " . $e->getMessage();
  }
}
?>
    </div>
    
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js'></script><script  src="./script.js"></script>

</body>
</html>
