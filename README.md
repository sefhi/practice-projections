![Symfony 6](https://img.shields.io/badge/Symfony-6.4-blueviolet)
![PHP Version](https://img.shields.io/badge/php-8.2-blue.svg)
[![CI](https://github.com/sefhi/practice-proyections/actions/workflows/build.yml/badge.svg)](https://github.com/sefhi/practice-proyections/actions/workflows/build.yml)
--------------------------------------

# 🚀 Projections

Este es un repositorio para practicar las proyecciones siguiendo los fundamentos de la plataforma de formación de [CodelyTv](https://pro.codely.com/library/modelado-del-dominio-proyecciones-221901/593578).

## 🛠️ Requisitos

- 🐳 Docker
- __Opcional__: Instalar el comando `make` para mejorar el punto de entrada a nuestra aplicación.
    1. [Instalar en OSX](https://formulae.brew.sh/formula/make)
    2. [Instalar en Window](https://parzibyte.me/blog/2020/12/30/instalar-make-windows/#Descargar_make)

## ⚙️ Configuración del entorno

1. Clona el repositorio o haz un fork
2. Escribe por terminal el comando `make`. Este comando instalara todo lo necesario para arrancar la aplicación.
3. El api está disponible en la url http://localhost:41
   4. Tienes un endpoint para verificar si la aplicación funciona http://localhost:41/api/healthcheck

```Puedes cambiar el puerto de salida 41, en el fichero docker-compose por el que más te guste.```

## 🚀 Comandos Útiles

Este proyecto incluye un Makefile con algunos comandos útiles para el desarrollo. Puedes ejecutarlos con el comando *
*make** seguido del nombre del comando.

### Comandos de Docker Compose

* `make start`: Inicia los contenedores de Docker Compose.
* `make stop`: Detiene los contenedores de Docker Compose.
* `make down`: Detiene y elimina los contenedores de Docker Compose.
* `make recreate`: Reinicia los contenedores de Docker Compose.
* `make rebuild`: Reconstruye los contenedores de Docker Compose.

### Comandos de Composer

* `make deps`: Instala las dependencias del proyecto.
* `make update-deps`: Actualiza las dependencias del proyecto.
* `make clear`: Limpia la caché de Symfony.
* `make bash`: Abre una sesión de terminal en el contenedor de Docker.

### Otros comandos

* `make test`: Ejecuta los tests del proyecto.
* `make lint`: Verifica el cumplimiento de los estándares de codificación.
* `make style`: Corrige los problemas de formato de código.
* `make static-analysis`: Verifica la calidad del código fuente.


📝 Recuerda que puedes consultar los detalles de cada comando en el Makefile del proyecto.

¡Que lo disfrutes! 😎