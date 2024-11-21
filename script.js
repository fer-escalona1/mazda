// Simulación de estado de sesión (puedes adaptarlo según tu lógica real)
let isLoggedIn = false; // Cambia a true si el usuario ha iniciado sesión
// Seleccionar todos los botones de corazón
document.querySelectorAll('.heart-button').forEach(button => {
    button.addEventListener('click', () => {
        button.classList.toggle('active');
        if (!isLoggedIn) {
            // Mostrar modal de inicio de sesión
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        } else {
            // Alternar estado activo del botón
            button.classList.toggle('active');
        }
    });
});

// Datos de los vehículos
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

// Mostrar detalles del vehículo en el modal
function showVehicleDetails(vehicleId) {
    const vehicle = vehicleData[vehicleId];

    // Imagen del vehículo
    document.getElementById('modalImage').src = vehicle.image;

    // Título del modal
    document.getElementById('carModalLabel').textContent = `Características del vehículo: ${vehicle.name}`;

    // Generar HTML con las características
    let detailsHTML = '';
    vehicle.features.forEach(feature => {
        detailsHTML += `
            <div class="row mb-2">
                <div class="col-6"><strong>${feature.name}:</strong></div>
                <div class="col-6">${feature.value}</div>
            </div>
        `;
    });

    // Insertar características en el modal
    document.getElementById('vehicleDetails').innerHTML = detailsHTML;

    // Mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('carModal'));
    modal.show();
    
}

// Información simulada (reemplazar con datos reales en un sistema dinámico)
const autos = [
    { modelo: "Mazda 2 Sedan", precio: "$300,000 MXN", trabajador: "Juan Pérez" },
    { modelo: "Mazda CX-3", precio: "$350,000 MXN", trabajador: "Ana López" },
    { modelo: "Mazda CX-50", precio: "$500,000 MXN", trabajador: "Carlos Gómez" },
    { modelo: "Mazda CX-90", precio: "$700,000 MXN", trabajador: "Laura Méndez" },
];

// Seleccionar todos los botones "Registrar Venta"
document.querySelectorAll(".registrar-venta-btn").forEach((boton, index) => {
    boton.addEventListener("click", () => {
        const auto = autos[index]; // Selecciona el auto correspondiente al botón
        document.getElementById("nombreTrabajador").textContent = auto.trabajador;
        document.getElementById("modeloAuto").textContent = auto.modelo;
        document.getElementById("precioAuto").textContent = auto.precio;

        // Generar fecha y hora dinámicas
        const fecha = new Date();
        const fechaFormat = fecha.toLocaleDateString("es-MX", {
            year: "numeric",
            month: "long",
            day: "numeric",
        });
        const horaFormat = fecha.toLocaleTimeString("es-MX");
        document.getElementById("fechaHora").textContent = `${fechaFormat}, ${horaFormat}`;
    });
});
