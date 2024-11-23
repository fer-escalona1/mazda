<?php
include 'connect.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];

    // Manejo de la imagen
    $target_dir = "uploads/"; // Carpeta donde se guardarán las imágenes
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $uploadOk = 1;

    // Validar que el archivo sea una imagen
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Intentar subir la imagen
    if ($uploadOk && move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        // Guardar los datos en la base de datos
        $sql = "INSERT INTO vehiculos (Modelo, Precio, Imagen) VALUES (?, ?, ?)";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sss", $modelo, $precio, $target_file);

        if ($stmt->execute()) {
            echo "Vehículo agregado correctamente.";
        } else {
            echo "Error: " . $connect->error;
        }
    } else {
        echo "Hubo un error al subir la imagen.";
    }
}
?>
