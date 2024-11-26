// Función para cargar los vehículos desde la base de datos
async function loadVehicles() {
    try {
        const response = await fetch('getVehicles.php'); // Archivo que devuelve datos en JSON
        if (!response.ok) throw new Error('Error al cargar los datos.');

        const vehicles = await response.json();

        const catalogContainer = document.getElementById('catalogContainer');
        catalogContainer.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevos elementos

        vehicles.forEach(vehicle => {
            const vehicleCard = document.createElement('div');
            vehicleCard.className = 'card';
            vehicleCard.style.width = '18rem';
            vehicleCard.style.margin = '10px';
            vehicleCard.innerHTML = `
                <img src="${vehicle.Imagen}" class="card-img-top" alt="${vehicle.Modelo}">
                <div class="card-body">
                    <h5 class="card-title">${vehicle.Modelo}</h5>
                    <p class="card-text">Precio: $${parseFloat(vehicle.Precio).toFixed(2)}</p>
                    <button class="btn btn-primary" onclick="showVehicleDetails(${vehicle.ID})">Ver</button>
                    <button class="favorites-btn" onclick="showLoginMessage()">Favoritos</button>
                </div>
            `;
            catalogContainer.appendChild(vehicleCard);
        });
    } catch (error) {
        console.error('Error al cargar el catálogo:', error);
    }
}

function showLoginMessage() {
    const catalogContainer = document.getElementById('catalogContainer');

    // Verifica si ya hay un mensaje existente
    let existingMessage = document.getElementById('loginMessage');
    if (!existingMessage) {
        const message = document.createElement('div');
        message.id = 'loginMessage';
        message.style.backgroundColor = '#f8d7da';
        message.style.color = '#721c24';
        message.style.padding = '10px';
        message.style.margin = '10px 0';
        message.style.border = '1px solid #f5c6cb';
        message.style.borderRadius = '5px';
        message.style.position = 'relative';
        message.textContent = 'Debes iniciar sesión para guardar en favoritos.';

        // Agregar un botón de cierre
        const closeButton = document.createElement('button');
        closeButton.textContent = 'X';
        closeButton.style.position = 'absolute';
        closeButton.style.top = '5px';
        closeButton.style.right = '10px';
        closeButton.style.background = 'none';
        closeButton.style.border = 'none';
        closeButton.style.color = '#721c24';
        closeButton.style.cursor = 'pointer';
        closeButton.onclick = () => message.remove();

        message.appendChild(closeButton);
        catalogContainer.insertBefore(message, catalogContainer.firstChild);
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
    // Cargar vehículos al iniciar la página
}

function saveChanges() {
    const form = document.getElementById('editVehicleForm');
    const formData = new FormData(form);

    fetch('updateVehicle.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Vehículo actualizado correctamente');
            location.reload(); // Recargar la página para reflejar los cambios
        } else {
            alert('Error al actualizar el vehículo');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al actualizar el vehículo');
    });
}


function loadVehicleData(vehicleId) {
    // Cargar datos del vehículo en los campos del formulario usando AJAX
    fetch('getVehicleDetails.php?id=' + vehicleId)
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('vehicleId').value = data.ID;
                document.getElementById('modelo').value = data.Modelo;
                document.getElementById('color').value = data.Color;
                document.getElementById('anio').value = data.Año;
                document.getElementById('precio').value = data.precio;
            }
        })
        .catch(error => console.error('Error al cargar los datos:', error));
}


document.addEventListener('DOMContentLoaded', loadVehicles);

// Otras funciones o código de tu script.js
document.addEventListener('DOMContentLoaded', () => {
    loadVehicles();
});