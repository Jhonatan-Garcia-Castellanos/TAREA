// --- MANEJO DE VENTANAS MODALES ---
const modal = document.getElementById('modal');
const modalTitle = document.getElementById('modal-title');
const modalText = document.getElementById('modal-text');
const closeModal = document.getElementById('close-modal');

const btnOrigen = document.getElementById('btn-origen');
const btnMundiales = document.getElementById('btn-mundiales');

// Datos para la ventana modal
const modalData = {
    origen: {
        title: "Orígenes del Fútbol",
        text: "En la China de la dinastía Han (siglos II y III a.C.) se practicaba el 'Cuju', una actividad donde se pateaba una pelota de cuero hacia una red. Siglos más tarde, las reglas unificadas en las escuelas británicas dieron vida al deporte que conocemos hoy."
    },
    mundiales: {
        title: "La Era de los Mundiales",
        text: "Uruguay fue la sede del primer Mundial en 1930 y resultó campeón tras vencer a Argentina 4-2. Desde entonces, Brasil se ha consolidado como el máximo ganador del torneo con 5 copas del mundo."
    }
};

// Función para abrir la ventana modal
function openModal(title, text) {
    modalTitle.textContent = title;
    modalText.textContent = text;
    modal.style.display = 'flex';
}

btnOrigen.addEventListener('click', () => {
    openModal(modalData.origen.title, modalData.origen.text);
});

btnMundiales.addEventListener('click', () => {
    openModal(modalData.mundiales.title, modalData.mundiales.text);
});

// Cerrar modal al hacer clic en la "X" o fuera de la ventana
closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});


// --- VALIDACIONES DE FORMULARIO EN JAVASCRIPT ---
const form = document.getElementById('subscribe-form');
const nombreInput = document.getElementById('nombre');
const emailInput = document.getElementById('email');

const errorNombre = document.getElementById('error-nombre');
const errorEmail = document.getElementById('error-email');

form.addEventListener('submit', (e) => {
    e.preventDefault(); // Previene el envío inmediato del formulario

    let isValid = true;

    // Limpiar mensajes anteriores
    errorNombre.textContent = '';
    errorEmail.textContent = '';

    // VALIDACIÓN 1: Campo de Nombre (Que no esté vacío)
    if (nombreInput.value.trim() === '') {
        errorNombre.textContent = 'Por favor, ingresa tu nombre.';
        isValid = false;
    }

    // VALIDACIÓN 2: Campo de Correo (Que no esté vacío y cumpla el formato)
    const emailValue = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailValue === '') {
        errorEmail.textContent = 'Por favor, ingresa tu correo electrónico.';
        isValid = false;
    } else if (!emailRegex.test(emailValue)) {
        errorEmail.textContent = 'Ingresa un correo electrónico válido (ej. usuario@dominio.com).';
        isValid = false;
    }

    // Si todo es válido
    if (isValid) {
        openModal("¡Suscripción Exitosa!", `Gracias ${nombreInput.value.trim()}, te has suscrito correctamente a nuestro boletín histórico.`);
        form.reset();
    }
});
