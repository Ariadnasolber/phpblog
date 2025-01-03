document.addEventListener("DOMContentLoaded", function () {
    fetch("/public/html/chat.html") // Ajusta esta ruta si es necesario
        .then((response) => {
            if (!response.ok) {
                throw new Error(`No se pudo cargar el chat: ${response.statusText}`);
            }
            return response.text();
        })
        .then((data) => {
            document.body.insertAdjacentHTML("beforeend", data);

            // Activar funcionalidad del chat
            const chatHeader = document.getElementById("chat-header");
            const chatBody = document.getElementById("chat-body");
            const chatForm = document.getElementById("chat-form");
            const chatMessages = document.getElementById("chat-messages");
            const chatInput = document.getElementById("chat-input");

            // Alternar visibilidad del chat
            chatHeader.addEventListener("click", () => {
                const isVisible = chatBody.style.display === "block";
                chatBody.style.display = isVisible ? "none" : "block";
            });

            // Manejar envío de mensajes
            chatForm.addEventListener("submit", (e) => {
                e.preventDefault();
                const message = chatInput.value.trim();
                if (message === "") return;

                addMessage("user", message);

                setTimeout(() => {
                    addMessage("bot", "Hola, ¿en qué puedo ayudarte?");
                }, 1000);

                chatInput.value = "";
            });

            // Función para agregar mensajes al chat
            function addMessage(type, text) {
                const messageDiv = document.createElement("div");
                messageDiv.classList.add("message", type);
                messageDiv.textContent = text;

                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll automático
            }
        })
        .catch((error) => console.error("Error al cargar el chat:", error));
});
