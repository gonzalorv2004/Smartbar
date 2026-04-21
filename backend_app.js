const express = require("express");
const app = express();

app.use(express.json());

const { Pool } = require("pg");

const pool = new Pool({
  host: "smartbar-db",
  user: "smartbar",
  password: "smartbar123",
  database: "smartbar",
  port: 5432,
});

app.get("/", (req, res) => {
  res.json({
    mensaje: "SmartBar funcionando",
    estado: "OK",
    servicio: "backend",
    autor: "Gonzalo Rubio",
  });
});

app.get("/health", (req, res) => {
  res.json({ status: "UP" });
});

app.post("/pedido", async (req, res) => {
  const { id_producto, cantidad } = req.body;

  try {
    const pedido = await pool.query(
      "INSERT INTO pedidos (id_usuario, estado) VALUES (1, 'pendiente') RETURNING id"
    );

    const id_pedido = pedido.rows[0].id;

    await pool.query(
      "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES ($1, $2, $3)",
      [id_pedido, id_producto, cantidad]
    );

    res.json({ mensaje: "Pedido guardado correctamente" });
  } catch (error) {
    console.error(error);
    res.status(500).send("Error al guardar pedido");
  }
});

app.listen(3000, () => {
  console.log("Servidor en puerto 3000");
});
