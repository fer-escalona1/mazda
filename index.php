<?php
// Solicitar el archivo de conexión a la base de datos
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mazda</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg rounded" aria-label="Eleventh navbar example">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample09">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <img src="logo.png" alt="Logo" width="70px">
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#c">Catálogo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Favoritos</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>

    <!-- Carousel COMPLETO -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="carr1.png" class="d-block w-100" alt="Mazda Slide 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Modelo Exclusivo</h5>
                    <p>Descubre lo último en innovación y diseño.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="carr2.png" class="d-block w-100" alt="Mazda Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Conduce el Futuro</h5>
                    <p>Un vehículo diseñado para superar tus expectativas.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="carr3.png" class="d-block w-100" alt="Mazda Slide 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Elegancia y Potencia</h5>
                    <p>El equilibrio perfecto entre estilo y rendimiento.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <h1 id="c" class="title">Catálogo</h1>
    <div class="container" id="catalogContainer">
        <?php
            // Consultar los vehículos desde la base de datos
            $query = "SELECT * FROM vehiculos";
            $result = $connect->query($query);

            if ($result && $result->num_rows > 0) {
                // Generar una tarjeta por cada vehículo
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="card" style="width: 18rem; margin: 10px;">
                        <img src="' . $row['Imagen'] . '" class="card-img-top" alt="' . $row['Modelo'] . '">
                        <div class="card-body">
                            <h5 class="card-title">' . $row['Modelo'] . '</h5>
                            <p class="card-text">Precio: $' . number_format($row['Precio'], 2) . '</p>
                            <button class="btn btn-primary" onclick="showVehicleDetails(' . $row['ID'] . ')">Ver</button>
                            <button class="btn btn-danger">Favoritos</button>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No hay vehículos disponibles en este momento.</p>';
            }
        ?>
    </div>

    <!-- Modal -->
<!-- Contenedor para el catálogo de vehículos -->
<div id="catalogContainer"></div>

<!-- Modal para ver detalles del vehículo -->
<div id="carModal" style="display: none;">
    <div id="vehicleDetails">
        <!-- Aquí se insertarán los detalles del vehículo -->
        <img id="modalImage" alt="Vehicle Image">    </div>
        <button onclick="closeModal()">Cerrar</button>

</div>




</div>


    <!-- INICIO DE SESIÓN-->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Debes iniciar sesión para guardar en favoritos.</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="/mazda/register.php" class="btn btn-secondary">Regístrate</a>
                    <a href="/mazda/login.php" class="btn btn-primary" style="background-color: #910A2D; border-color: #910A2D; color: white;">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
