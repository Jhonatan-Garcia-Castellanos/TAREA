// --- MANEJO DE VENTANAS MODALES ---
const modal = document.getElementById('modal');
const modalTitle = document.getElementById('modal-title');
const modalText = document.getElementById('modal-text');
const closeModal = document.getElementById('close-modal');

// Función para abrir la ventana modal
function openModal(title, text) {
    modalTitle.textContent = title;
    modalText.textContent = text;
    modal.style.display = 'flex';
}

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
