const form = document.getElementById('subscribe-form');
const nombreInput = document.getElementById('nombre');
const emailInput = document.getElementById('email');

const errorNombre = document.getElementById('error-nombre');
const errorEmail = document.getElementById('error-email');
const modal = document.getElementById('modal');
const modalTitle = document.getElementById('modal-title');
const modalText = document.getElementById('modal-text');
const closeModal = document.getElementById('close-modal');

function openModal(title, text) {
    modalTitle.textContent = title;
    modalText.textContent = text;
    modal.style.display = 'flex';
}

function closeModalWindow() {
    modal.style.display = 'none';
}

closeModal.addEventListener('click', closeModalWindow);
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        closeModalWindow();
    }
});

form.addEventListener('submit', (e) => {
    e.preventDefault();

    let isValid = true;

    errorNombre.textContent = '';
    errorEmail.textContent = '';

    // VALIDACIÓN 1
    if (nombreInput.value.trim() === '') {
        errorNombre.textContent = 'Por favor, ingresa tu nombre.';
        isValid = false;
    }

    // VALIDACIÓN 2
    const emailValue = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailValue === '') {
        errorEmail.textContent = 'Por favor, ingresa tu correo electrónico.';
        isValid = false;
    } else if (!emailRegex.test(emailValue)) {
        errorEmail.textContent = 'Ingresa un correo electrónico válido (ej. usuario@dominio.com).';
        isValid = false;
    }

    if (isValid) {
        openModal('¡Suscripción Exitosa!', `Gracias ${nombreInput.value.trim()}, te has suscrito correctamente a nuestro boletín histórico.`);
        form.reset();
    }
});
