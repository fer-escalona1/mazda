<?php
include 'connect.php'; // Asegúrate de tener esta conexión configurada correctamente.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $color = $_POST['color'];
    $anio = $_POST['anio'];
    $precio = $_POST['precio'];

    // Validar que no falten datos
    if (empty($id) || empty($modelo) || empty($color) || empty($anio) || empty($precio)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Preparar consulta para actualizar el vehículo
    $query = "UPDATE vehiculos SET Modelo = ?, Color = ?, Año = ?, precio = ? WHERE ID = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ssidi", $modelo, $color, $anio, $precio, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Los cambios se guardaron exitosamente.']);
        error_log("Datos recibidos: " . json_encode($_POST));

    } else {
        error_log("Error al ejecutar la consulta: " . $stmt->error);
        echo json_encode(['success' => false, 'message' => 'Error al guardar los cambios.']);
        error_log("Datos recibidos: " . json_encode($_POST));

    }

    $stmt->close();
    $connect->close();
}
?>

