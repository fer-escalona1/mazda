// Función para cargar los vehículos
async function loadVehicles() {
    try {
        const response = await fetch('getVehicles.php');
        if (!response.ok) throw new Error('Error al cargar los datos.');
        const vehicles = await response.json();

        const catalogContainer = document.getElementById('catalogContainer');
        catalogContainer.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevos elementos

        vehicles.forEach(vehicle => {
            const vehicleCard = document.createElement('div');
            vehicleCard.className = 'vehicle-card';
            vehicleCard.innerHTML = `
                <img src="${vehicle.Imagen}" class="vehicle-img" alt="${vehicle.Modelo}">
                <div class="vehicle-details">
                    <h5 class="vehicle-model">${vehicle.Modelo}</h5>
                    <p class="vehicle-price">Precio: $${vehicle.Precio}</p>
                    <button class="vehicle-btn" onclick="showVehicleDetails(${vehicle.ID})">Ver</button>
                    <button class="favorites-btn">Favoritos</button>
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
    fetch('getVehiclesDetails.php?id=' + vehicleId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener los datos del vehículo.');
            }
            return response.json();
        })
        .then(data => {
            if (data) {
                // Actualizar la imagen y detalles en el modal
                const modalImage = document.getElementById('modalImage');
                if (modalImage) {
                    modalImage.src = data.Imagen;
                    modalImage.alt = data.Modelo;
                }

                // Generar el resto de los detalles
                const details = `
                    <div><strong>Modelo:</strong> ${data.Modelo}</div>
                    <div><strong></strong><br><img src="${data.Imagen}" alt="Imagen de ${data.Modelo}" style="width:400PX"; height:auto; margin-bottom: 20px;"></div>
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

                const vehicleDetails = document.getElementById('vehicleDetails');
                if (vehicleDetails) {
                    vehicleDetails.innerHTML = details + `
                    <button class="close-btn" onclick="closeModal()">Cancelar</button>
                    `;
                }

                // Mostrar el modal
                const modal = document.getElementById('carModal');
                if (modal) {
                    modal.style.display = 'block';
                }
            } else {
                alert('No se encontraron datos del vehículo.');
            }
        })
        .catch(error => console.error('Error al obtener los datos del vehículo:', error));
}

function closeModal() {
    const modal = document.getElementById('carModal');
    if (modal) {
        modal.style.display = 'none';
        // Resetear los elementos del modal
        document.getElementById('modalImage').src = '';
        document.getElementById('vehicleDetails').innerHTML = '';
    }
}

// Cargar vehículos al iniciar la página
document.addEventListener('DOMContentLoaded', loadVehicles);
