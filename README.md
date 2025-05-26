# Guía de Instalación

### 1. Instalar Docker
Sigue los pasos de instalación según tu sistema operativo en la [documentación oficial de Docker](https://docs.docker.com/get-docker/):

- [Docker para Windows](https://docs.docker.com/desktop/install/windows-install/)
- [Docker para Mac](https://docs.docker.com/desktop/install/mac-install/)
- [Docker para Linux](https://docs.docker.com/engine/install/)

### 2. Iniciar el Proyecto

Una vez instalado Docker, ejecuta el siguiente comando en la raíz del proyecto:
```bash
sudo docker compose up -d --build --force-recreate
```

### 3. Configuración del Proyecto Laravel

Accede al contenedor de PHP y ejecuta los siguientes comandos:

```bash
# Entrar al contenedor de PHP
docker exec -it app-citasmedicas-php_service-1 bash

# Generar la clave de la aplicación
php artisan key:generate

# Ejecutar las migraciones
php artisan migrate

# Ejecutar los seeders
php artisan db:seed
```

## ¡Listo!
- [ingresar a la aplicación en localhost:9000](http://localhost:9000)
