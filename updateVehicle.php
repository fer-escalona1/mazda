<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $color = $_POST['color'];
    $anio = $_POST['anio'];
    $precio = $_POST['precio'];

    // Consulta para actualizar los datos del vehículo
    $query = "UPDATE vehiculos SET Modelo = ?, Color = ?, Año = ?, precio = ? WHERE ID = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('sssdi', $modelo, $color, $anio, $precio, $id);

    // Ejecutar la consulta y verificar si se actualizó correctamente
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $connect->close();
} else {
    echo json_encode(['success' => false]);
}
?>

