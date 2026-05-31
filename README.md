# 🍺 SmartBar

SmartBar es una plataforma web desarrollada como Proyecto Intermodular del ciclo formativo ASIR.

La aplicación permite digitalizar la gestión integral de un bar mediante un sistema de roles, pedidos, comunicación interna, contratación de personal y notificaciones automáticas.

---

# 📌 Características principales

- Gestión de usuarios y roles
- Sistema de pedidos para tomar y llevar
- Paneles personalizados según rol
- Comunicación interna entre empleados
- Notificaciones automáticas por Telegram
- Solicitudes de empleo online
- Contratación automática con asignación de turnos
- Despliegue cloud mediante Docker
- Base de datos PostgreSQL
- Interfaz visual mejorada con CSS modular

---

# 🛠️ Tecnologías utilizadas

## Backend
- PHP

## Frontend
- HTML5
- CSS3

## Base de datos
- PostgreSQL

## Infraestructura
- Docker
- Docker Compose
- Nginx
- AWS EC2

## Integraciones
- Telegram Bot API

---

# 👥 Roles del sistema

## 👨‍💼 Gerente
Funciones:
- Visualizar usuarios
- Cambiar roles
- Gestionar turnos
- Ver pedidos
- Revisar solicitudes de empleo
- Contratar candidatos
- Rechazar solicitudes
- Recibir mensajes internos

---

## 👨‍🍳 Cocina
Funciones:
- Consultar pedidos
- Gestionar preparación
- Enviar incidencias al gerente
- Notificaciones por Telegram

---

## 🧹 Conserjería
Funciones:
- Comunicar incidencias de limpieza
- Enviar mensajes al gerente

---

## 🛠️ Administrador
Funciones:
- Supervisión global
- Visualización completa del sistema

---

# 📂 Estructura del proyecto

```text
smartbar/
│
├── backend/
│
├── frontend/
│   ├── css/
│   ├── php/
│   ├── curriculums/
│   └── archivos html/php
│
├── docker-compose.yml
├── nginx.conf
└── README.md