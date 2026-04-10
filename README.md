# SmartBar

Plataforma cloud para la gestión de bares.

## Tecnologías utilizadas
- Docker
- Nginx
- Backend (Node.js o Django)
- AWS EC2

## Despliegue
El proyecto se ha desplegado en una instancia EC2 de AWS utilizando contenedores Docker.

## Acceso
Aplicación disponible en:
http://54.235.70.122

## Estructura del proyecto
- backend/ → Lógica de la aplicación
- nginx/ → Configuración del servidor web
- docker-compose.yml → Orquestación de contenedores

## Ejecución

Para levantar el proyecto:

```bash
sudo docker-compose up -d

## Seguridad

- Uso de HTTPS (pendiente o implementado)
- Exclusión de archivos sensibles mediante .gitignore
- No inclusión de claves privadas (.pem)
