// Función para validar el correo electrónico
function validateEmail() {
    var email = document.getElementById("email").value;
    // Expresión regular para verificar el formato del
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (emailPattern.test(email)) {
        return true;
    } else {
        alert("Por favor, ingresa un correo electrónico válido.");
        return false;
    }
}