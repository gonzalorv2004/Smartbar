sudo docker exec -it smartbar-db psql -U smartbar
\c smartbar
-- TABLA USUARIOS
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100),
    rol VARCHAR(50)
);

-- TABLA PRODUCTOS
CREATE TABLE productos (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    precio DECIMAL(10,2),
    stock INT
);

-- TABLA PEDIDOS
CREATE TABLE pedidos (
    id SERIAL PRIMARY KEY,
    id_usuario INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(50),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- TABLA DETALLE_PEDIDO
CREATE TABLE detalle_pedido (
    id SERIAL PRIMARY KEY,
    id_pedido INT,
    id_producto INT,
    cantidad INT,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

-- TABLA MENSAJES
CREATE TABLE mensajes (
    id SERIAL PRIMARY KEY,
    emisor VARCHAR(50),
    destinatario VARCHAR(50),
    mensaje TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABLA SOLICITUDES EMPLEO
CREATE TABLE solicitudes_empleo (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    apellidos VARCHAR(150),
    dni VARCHAR(20),
    direccion VARCHAR(200),
    correo VARCHAR(150),
    pdf VARCHAR(255)
);

-- TABLA SOLICITUDES
CREATE TABLE solicitudes (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(150),
    telefono VARCHAR(30),
    dni VARCHAR(20),
    correo VARCHAR(100),
    direccion VARCHAR(200),
    curriculum VARCHAR(255)
);

DELETE FROM detalle_pedido;

ALTER TABLE detalle_pedido
ALTER COLUMN id_pedido SET NOT NULL;

ALTER TABLE detalle_pedido
ALTER COLUMN id_producto SET NOT NULL;

ALTER TABLE pedidos
ADD COLUMN tipo_pedido VARCHAR(30);

INSERT INTO usuarios (
    nombre,
    password,
    rol
)
VALUES (
    'Mari Carmen',
    '1234',
    'conserje'
);

INSERT INTO solicitudes_empleo
(nombre,apellidos,dni,direccion,correo,pdf)
VALUES
('Juan','Pérez García','12345678A','Calle Real 12','juan@gmail.com','/cv_juan.pdf');

ALTER TABLE usuarios
ADD COLUMN turno VARCHAR(20);

🧩 PASO 1: Insertar usuario
INSERT INTO usuarios (nombre, email, password, rol)
VALUES
('Gonzalo', 'gonzalo@smartbar.com', '1234', 'admin'),
('Antonio Carlos', 'ac@smartbar.com', '1234', 'camarero'),
('Alejandro', 'alex@smartbar.com', '1234', 'cocina'),
('Diego', 'diego@smartbar.com', '1234', 'camarero'),
('Pablo', 'pablo@smartbar.com', '1234', 'cocina'),
('Esperanza', 'espe@smartbar.com', '1234', 'camerero'),
('Juan Pedro', 'jp@smartbar.com', '1234', 'cocina');


🧩 PASO 2: Insertar productos
INSERT INTO productos (nombre, precio, stock)
VALUES 
('Cerveza', 2.50, 100),
('Coca Cola', 2.00, 100),
('Fanta de Naranja', 2.00, 100),
('Fanta de Limon', 2.00, 100),
('Aquarius', 2.50, 100),
('Aquarius de Naranja', 2.50, 100),
('Colacacao', 4.00, 100),
('Cafe', 4.50, 100),
('Perritos Calientes', 6.00, 50),
('Montaditos', 6.50, 50),
('Hamburguesa', 8.00, 50),
('Pizza', 8.50, 50);


🧩 PASO 3: Crear pedido
INSERT INTO pedidos (id_usuario, estado)
VALUES (1, 'pendiente');

🧩 PASO 4: Añadir detalle del pedido
INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad)
VALUES 
(1, 1, 2),
(1, 3, 1);

🧪 PASO 5: VER EL RESULTADO (esto es lo guapo)
SELECT * FROM detalle_pedido;

🔥 AHORA VIENE LO IMPORTANTE (lo que debes enseñar)

Ejecuta esto:

SELECT 
    p.id AS pedido,
    u.nombre AS usuario,
    pr.nombre AS producto,
    dp.cantidad,
    pr.precio
FROM pedidos p
JOIN usuarios u ON p.id_usuario = u.id
JOIN detalle_pedido dp ON p.id = dp.id_pedido
JOIN productos pr ON dp.id_producto = pr.id;

NUEVAS TABLAS
ALTER TABLE pedidos
ADD COLUMN nombre_cliente VARCHAR(100);

ALTER TABLE pedidos
ADD COLUMN telefono VARCHAR(30);

ALTER TABLE pedidos
ADD COLUMN direccion VARCHAR(200);

