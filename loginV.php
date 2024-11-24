<?php
error_reporting(0);
include 'connect.php';
session_start(); // Iniciamos la sesión

// Comprobamos si se presionó el botón "entrar"
if (isset($_POST['entrar'])) {
    // Capturamos los valores enviados desde el formulario
    $rclave = $connect->real_escape_string($_POST['clave']);
    $rpassword = $connect->real_escape_string($_POST['pass']);

    // Consulta a la base de datos
    $consulta = "SELECT * FROM vendedores WHERE ClaveT = '$rclave' AND Contraseña = '$rpassword'";
    $claveok = null;
    $passok = null;

    if ($resultado = $connect->query($consulta)) {
        if ($row = $resultado->fetch_assoc()) {
            $claveok = $row["ClaveT"];
            $passok = $row["Contraseña"];
        }
        $resultado->close();
    }

    // Verificamos si la clave y la contraseña son correctas
    if ($claveok && $passok) {
        $_SESSION["login"] = TRUE;
        $_SESSION["Vendedor"] = $claveok; // Guardamos la clave en sesión (o el nombre si lo prefieres)
        header("Location: principal.php");
        exit; // Detenemos la ejecución tras redirigir
    } else {
        $mensaje = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Oh no.</strong> Clave o contraseña incorrectos.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión Vendedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <img src="mazda-logo.png" alt="Logo Mazda" width="150">
        </div>
        <h2 class="text-center mb-4">Inicia Sesión</h2>

        <!-- Mostrar mensajes -->
        <?php if (isset($mensaje)) echo $mensaje; ?>

        <!-- Formulario de Inicio de Sesión -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <!-- Campo de Clave -->
            <div class="mb-3">
                <label for="clave" class="form-label">Clave de Vendedor</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="clave" 
                    name="clave" 
                    placeholder="Escribe tu clave de vendedor" 
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
                name="entrar"
                class="btn w-100" 
                style="background-color: #910A2D; border-color: #910A2D; color: white;"
            >
                Iniciar Sesión
            </button>
        </form>

        <!-- Enlaces Adicionales -->
        <p class="text-center mt-3">
            <a href="/mazda/index.php" class="btn btn-secondary w-100">Regresar al Catálogo</a>
        </p>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
