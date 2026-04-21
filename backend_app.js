const express = require("express");
const { Pool } = require("pg");

const app = express();
app.use(express.json());

const pool = new Pool({
  host: "database", // nombre del contenedor en docker-compose
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

// Pedido simple
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
    res.status(500).json({ error: "Error al guardar pedido" });
  }
});

// Pedido múltiple (el bueno 🔥)
app.post("/pedido-completo", async (req, res) => {
  const { productos } = req.body;

  try {
    const pedido = await pool.query(
      "INSERT INTO pedidos (id_usuario, estado) VALUES (1, 'pendiente') RETURNING id"
    );

    const id_pedido = pedido.rows[0].id;

    for (let p of productos) {
      await pool.query(
        "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES ($1, $2, $3)",
        [id_pedido, p.id_producto, p.cantidad]
      );
    }

    res.json({ mensaje: "Pedido completo guardado" });

  } catch (error) {
    console.error(error);
    res.status(500).json({ error: "Error al guardar pedido" });
  }
});

// Ver pedidos
app.get("/pedidos", async (req, res) => {
  try {
    const result = await pool.query(`
      SELECT 
        p.id AS pedido,
        u.nombre AS usuario,
        pr.nombre AS producto,
        dp.cantidad
      FROM pedidos p
      JOIN usuarios u ON p.id_usuario = u.id
      JOIN detalle_pedido dp ON p.id = dp.id_pedido
      JOIN productos pr ON dp.id_producto = pr.id
      ORDER BY p.id;
    `);

    res.json(result.rows);

  } catch (error) {
    console.error(error);
    res.status(500).json({ error: "Error al obtener pedidos" });
  }
});

// Marcar como servido
app.put("/pedido/:id/servido", async (req, res) => {
  const { id } = req.params;

  try {
    await pool.query(
      "UPDATE pedidos SET estado = 'servido' WHERE id = $1",
      [id]
    );

    res.json({ mensaje: "Pedido servido" });

  } catch (error) {
    console.error(error);
    res.status(500).json({ error: "Error al actualizar pedido" });
  }
});

app.listen(3000, () => {
  console.log("Servidor en puerto 3000");
});