// Seleccionar todos los botones de corazón
document.querySelectorAll('.heart-button').forEach(button => {
    button.addEventListener('click', () => {
      // Alternar la clase 'active' al hacer clic
      button.classList.toggle('active');
    });
  });
  

const vehicleData = {
    1: {
        name: "Mazda 2 Sedan",
        image: "mazda2sedan.png",
        features: [
            { name: "Modelo", value: "Mazda 2 Sedan" },
            { name: "Motor", value: "2.0L I4" },
            { name: "Transmisión", value: "Automática" },
            { name: "Color", value: "Rojo" },
            { name: "Año", value: "2024" }
        ]
    },
    2: {
        name: "Mazda CX-3",
        image: "mazdacx3.png",
        features: [
            { name: "Modelo", value: "Mazda CX-3" },
            { name: "Motor", value: "2.5L I4" },
            { name: "Transmisión", value: "Manual" },
            { name: "Color", value: "Blanco" },
            { name: "Año", value: "2023" }
        ]
    },
    3: {
        name: "Mazda CX-50",
        image: "mazdacx50.png",
        features: [
            { name: "Modelo", value: "Mazda CX-50" },
            { name: "Motor", value: "3.0L V6" },
            { name: "Transmisión", value: "Automática" },
            { name: "Color", value: "Negro" },
            { name: "Año", value: "2023" }
        ]
    },
    4: {
        name: "Mazda CX-90",
        image: "mazdacx90.png",
        features: [
            { name: "Modelo", value: "Mazda CX-90" },
            { name: "Motor", value: "2.5L I4" },
            { name: "Transmisión", value: "Automática" },
            { name: "Color", value: "Gris" },
            { name: "Año", value: "2024" }
        ]
    }
};

function showVehicleDetails(vehicleId) {
    const vehicle = vehicleData[vehicleId];
    // Establecer la imagen del vehículo
    document.getElementById('modalImage').src = vehicle.image;

    // Establecer el título del modal
    document.getElementById('carModalLabel').textContent = `Características del vehículo: ${vehicle.name}`;

    // Generar las filas de características
    let detailsHTML = '';
    vehicle.features.forEach(feature => {
        detailsHTML += `
            <div class="row mb-2">
                <div class="col-6"><strong>${feature.name}:</strong></div>
                <div class="col-6">${feature.value}</div>
            </div>
        `;
    });

    // Insertar las características en el modal
    document.getElementById('vehicleDetails').innerHTML = detailsHTML;

    // Mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('carModal'));
    modal.show();
}
