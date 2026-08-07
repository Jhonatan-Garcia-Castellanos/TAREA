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
        alert(`¡Suscripción Exitosa!\nGracias ${nombreInput.value.trim()}, te has suscrito correctamente a nuestro boletín histórico.`);
        form.reset();
    }
});
