async function loadVehicles() {
    try {
        const response = await fetch('getVehicles.php');
        if (!response.ok) throw new Error('Error al cargar los datos.');
        const vehicles = await response.json();

        // Generar las tarjetas de cada vehículo
        const catalogContainer = document.getElementById('catalogContainer');
        catalogContainer.innerHTML = '';

        vehicles.forEach(vehicle => {
            const vehicleCard = document.createElement('div');
            vehicleCard.className = 'card';
            vehicleCard.style = 'width: 18rem; margin: 10px;';
            vehicleCard.innerHTML = `
                <img src="${vehicle.Imagen}" class="card-img-top" alt="${vehicle.Modelo}">
                <div class="card-body">
                    <h5 class="card-title">${vehicle.Modelo}</h5>
                    <p class="card-text">Precio: $${vehicle.Precio}</p>
                    <button class="btn btn-primary" onclick="showVehicleDetails(${vehicle.ID})">Ver</button>
                    <button class="btn btn-danger">Favoritos</button>
                </div>
            `;
            catalogContainer.appendChild(vehicleCard);
        });
    } catch (error) {
        console.error('Error al cargar el catálogo:', error);
    }
}

// Mostrar detalles del vehículo en el modal
function showVehicleDetails(vehicleId) {
    // Solicitar datos del vehículo
    fetch('getVehiclesDetails.php?id=' + vehicleId)
        .then(response => response.json())
        .then(data => {
            if (data) {
                // Actualizar los detalles del modal
                document.getElementById('modalImage').src = data.Imagen;
                document.getElementById('modalImage').alt = data.Modelo;

                const details = `
                    <div><strong>Modelo:</strong> ${data.Modelo}</div>
                    <div><strong>Color:</strong> ${data.Color}</div>
                    <div><strong>Año:</strong> ${data.Año}</div>
                    <div><strong>Tipo de Motor:</strong> ${data.TipoMotor}</div>
                    <div><strong>Potencia:</strong> ${data.Potencia}</div>
                    <div><strong>Torque:</strong> ${data.Torque}</div>
                    <div><strong>Rendimiento de Combustible:</strong> ${data.RenComb}</div>
                    <div><strong>Peso:</strong> ${data.Peso}</div>
                    <div><strong>Aceite:</strong> ${data.Aceite}</div>
                    <div><strong>Dimensiones:</strong> ${data.Dimensiones}</div>
                    <div><strong>Precio:</strong> $${parseFloat(data.Precio).toFixed(2)}</div>
                `;

                document.getElementById('vehicleDetails').innerHTML = details;

                // Mostrar el modal
                const modal = new bootstrap.Modal(document.getElementById('carModal'));
                modal.show();
            } else {
                alert('No se encontraron datos del vehículo.');
            }
        })
        .catch(error => console.error('Error al obtener los datos del vehículo:', error));
}



// Cargar vehículos al inicio
document.addEventListener('DOMContentLoaded', loadVehicles);
