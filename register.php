<?php
error_reporting(0);
include 'connect.php';
session_start(); // Iniciamos la sesión

// Comprobamos si se presionó el botón "registrar"
if (isset($_POST['registrar'])) {
    // Capturamos los valores enviados desde el formulario
    $rnombre = $connect->real_escape_string($_POST['nombre']);
    $ruser = $connect->real_escape_string($_POST['correo']);
    $rpassword = $connect->real_escape_string($_POST['pass']);

    // Verificamos si el correo ya está registrado
    $consulta = "SELECT * FROM Usuarios WHERE Correo = '$ruser'";
    $resultado = $connect->query($consulta);
    
    if ($resultado->num_rows > 0) {
        // El correo ya está registrado
        $mensaje = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Oh no.</strong> Este correo ya está registrado.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    } else {
        // Insertamos los nuevos datos en la base de datos
        $insertar = "INSERT INTO Usuarios (Nombre, Correo, Contraseña) VALUES ('$rnombre', '$ruser', '$rpassword')";
        
        if ($connect->query($insertar) === TRUE) {
            // Redirigimos a la página de login tras el registro
            $mensaje = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Felicidades.</strong> Te has registrado correctamente.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
        } else {
            // Error al insertar los datos
            $mensaje = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Oh no.</strong> Hubo un error al registrar tus datos.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <img src="mazda-logo.png" alt="Logo Mazda" width="150">
        </div>
        <h2 class="text-center mb-4">Crea tu cuenta</h2>

        <!-- Mostrar mensajes -->
        <?php if (isset($mensaje)) echo $mensaje; ?>

        <!-- Formulario de Registro -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <!-- Campo de Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="nombre" 
                    name="nombre" 
                    placeholder="Escribe tu nombre completo" 
                    required
                >
            </div>

            <!-- Campo de Correo -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="correo" 
                    name="correo" 
                    placeholder="Escribe tu correo electrónico" 
                    required
                >
            </div>

            <!-- Campo de Contraseña -->
            <div class="mb-3">
                <label for="pass" class="form-label">Contraseña</label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="pass" 
                    name="pass" 
                    placeholder="Escribe tu contraseña" 
                    required
                >
            </div>

            <!-- Botón de Envío -->
            <button 
                type="submit" 
                name="registrar"
                class="btn w-100" 
                style="background-color: #910A2D; border-color: #910A2D; color: white;"
            >
                Registrarse
            </button>
        </form>

        <!-- Enlaces Adicionales -->
        <p class="text-center mt-3">
            ¿Ya tienes cuenta? <a href="/mazda/login.php">Inicia sesión aquí</a>
        </p>
        <p class="text-center mt-3">
            <a href="/mazda/index.php" class="btn btn-secondary w-100">Regresar al Catálogo</a>
        </p>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
