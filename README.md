# SmartBar

SmartBar es una plataforma web orientada a la digitalización de pequeños negocios hosteleros, desarrollada como Proyecto Intermodular del ciclo formativo de Administración de Sistemas Informáticos en Red (ASIR).

La aplicación permite gestionar comandas, usuarios, inventario y analíticas básicas mediante una arquitectura modular desplegada en entorno cloud con Docker.

---

# Características principales

- Gestión de usuarios y roles
- Sistema de comandas digitales
- Comunicación entre frontend y backend
- Base de datos PostgreSQL
- Despliegue mediante Docker Compose
- Acceso mediante HTTPS
- Arquitectura modular frontend/backend
- Entorno cloud sobre AWS

---

# Tecnologías utilizadas

## Backend
- Node.js
- Express.js

## Frontend
- HTML5
- PHP
- CSS3

## Base de datos
- PostgreSQL

## Infraestructura
- Docker
- Docker Compose
- Nginx
- AWS EC2
- Let's Encrypt

---

# Estructura del proyecto

```text
smartbar/
│
├── backend/
│   ├── backend_app.js
│   └── backend_package.json
│
├── frontend/
│   ├── frontend_index.html
│   ├── frontend_php_login.php
│   ├── frontend_php_dashboard.php
│   └── ...
│
├── docker-compose.yml
├── nginx_default.conf
├── phpDockerfile
├── postgresql.sql
└── README.md
```

---

# Despliegue del proyecto

## Clonar repositorio

```bash
git clone https://github.com/gonzalorv2004/Smartbar.git
cd Smartbar
```

## Levantar contenedores

```bash
docker-compose up -d
```

## Verificar estado

```bash
docker ps
```

---

# Funcionalidades implementadas

- Login de usuarios
- Gestión de pedidos
- Visualización de pedidos
- Procesamiento de comandas
- Gestión básica de base de datos
- Sistema de roles
- Comunicación API REST

---

# Seguridad

- HTTPS mediante certificados SSL/TLS
- Control de acceso por roles
- Separación de servicios mediante contenedores Docker

---

# Autor

Gonzalo Rubio Vigueras

Proyecto Intermodular ASIR 2025/2026  
I.E.S. Delgado Hernández

---

# Estado del proyecto

Proyecto en desarrollo y validación final.