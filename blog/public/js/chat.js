// Seleccionar elementos
const chatHeader = document.getElementById('chat-header');
const chatBody = document.getElementById('chat-body');
const chatForm = document.getElementById('chat-form');
const chatMessages = document.getElementById('chat-messages');
const chatInput = document.getElementById('chat-input');

// Alternar la visibilidad del chat
chatHeader.addEventListener('click', () => {
    if (chatBody.style.display === 'none' || chatBody.style.display === '') {
        chatBody.style.display = 'block';
    } else {
        chatBody.style.display = 'none';
    }
});

// Manejar envío de mensajes
chatForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const message = chatInput.value.trim();
    if (message === '') return;

    // Agregar mensaje del usuario
    addMessage('user', message);

    // Respuesta automática del "bot"
    setTimeout(() => {
        addMessage('bot', 'Hola, ¿en qué puedo ayudarte?');
    }, 1000);

    // Limpiar el campo de entrada
    chatInput.value = '';
});

// Función para agregar mensajes al chat
function addMessage(type, text) {
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('message', type);
    messageDiv.textContent = text;

    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight; // Desplazar hacia abajo automáticamente
}

// Función para obtener mensajes desde la API
async function fetchMessages() {
    try {
        const response = await fetch("http://localhost:3000/api/messages");
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }
        const messages = await response.json();
        displayMessages(messages);
    } catch (error) {
        console.error("There has been a problem with your fetch operation:", error);
    }
}

// Mostrar mensajes obtenidos desde la API
function displayMessages(messages) {
    messages.forEach((message) => {
        addMessage('api', message); // Usa 'api' como tipo para diferenciar
    });
}

// Llamar a fetchMessages al cargar la página
fetchMessages();