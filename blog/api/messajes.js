const express = require("express");
const cors = require("cors");
const app = express();
const port = 3000;

app.use(cors()); // Habilitar CORS
app.use(express.json());

let messages = ["Hola", "Adios", "Buenos dias"];

// Obtener todos los mensajes
app.get("/api/messages", (req, res) => {
  res.json(messages);
});

// Crear un nuevo mensaje
app.post("/api/messages", (req, res) => {
  const message = req.body;
  messages.push(message);
  res.status(201).json(message);
});

// Obtener un mensaje por ID
app.get("/api/messages/:id", (req, res) => {
  const id = parseInt(req.params.id, 10);
  const message = messages.find((m) => m.id === id);
  if (message) {
    res.json(message);
  } else {
    res.status(404).send("Message not found");
  }
});

// Actualizar un mensaje por ID
app.put("/api/messages/:id", (req, res) => {
  const id = parseInt(req.params.id, 10);
  const index = messages.findIndex((m) => m.id === id);
  if (index !== -1) {
    messages[index] = req.body;
    res.json(messages[index]);
  } else {
    res.status(404).send("Message not found");
  }
});

// Eliminar un mensaje por ID
app.delete("/api/messages/:id", (req, res) => {
  const id = parseInt(req.params.id, 10);
  const index = messages.findIndex((m) => m.id === id);
  if (index !== -1) {
    messages.splice(index, 1);
    res.status(204).send();
  } else {
    res.status(404).send("Message not found");
  }
});

app.listen(port, () => {
  console.log(`API running at http://localhost:${port}`);
});
