<?php
error_reporting(0);
include 'connect.php';
$ruser = $_POST['Nombre'];
$pass = $_POST['Contrasena'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Crea tu cuenta</h2>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label" name="Nombre">Nombre Completo</label>
                <input type="text" class="form-control" id="name" placeholder="Escribe tu nombre completo" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label" name="Correo">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="Escribe tu correo electrónico" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" name="Contrasena">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="Crea una contraseña" required>
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="confirm-password" placeholder="Confirma tu contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" style="background-color: #910A2D; border-color: #910A2D; color: white;">Registrarme</button>
        </form>
        <p class="text-center mt-3">¿Ya tienes cuenta? <a href="/login.html">Inicia sesión aquí</a></p>
        <p class="text-center mt-3"><a href="/index.html" class="btn btn-secondary w-100">Regresar al Catálogo</a></p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
      