const express = require("express");
const { Pool } = require("pg");

const app = express();
app.use(express.json());

const pool = new Pool({
    user: "smartbar",
    host: "database",
    database: "smartbar",
    password: "smartbar123",
    port: 5432,
});

app.get("/", (req, res) => {
    res.json({ mensaje: "API funcionando" });
});

app.post("/pedido", async (req, res) => {
    const { id_producto, cantidad } = req.body;

    try {
        // Crear pedido
        const pedido = await pool.query(
            "INSERT INTO pedidos (id_usuario, estado) VALUES (1, 'pendiente') RETURNING id"
        );

        const id_pedido = pedido.rows[0].id;

        // Insertar detalle
        await pool.query(
            "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES ($1, $2, $3)",
            [id_pedido, id_producto, cantidad]
        );

        res.json({ mensaje: "Pedido guardado" });

    } catch (error) {
        console.error(error);
        res.status(500).json({ error: "Error al guardar pedido" });
    }
});

app.listen(3000, () => {
    console.log("Servidor en puerto 3000");
});
