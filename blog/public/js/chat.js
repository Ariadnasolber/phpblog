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

function displayMessages(messages) {
  const messagesContainer = document.getElementById("messages-container");
  messagesContainer.innerHTML = ""; // Clear existing messages
  messages.forEach((message) => {
    const messageElement = document.createElement("div");
    messageElement.className = "message";
    messageElement.textContent = message; // Assuming each message is a string
    messagesContainer.appendChild(messageElement);
  });
}

fetchMessages();
