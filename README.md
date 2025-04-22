# Terra test

## Requisitos

- Tener [Docker](https://docs.docker.com/get-docker/) y [Docker Compose](https://docs.docker.com/compose/install/) instalados en tu sistema.

## Instrucciones de uso

1. Clona este repositorio o descarga el proyecto en tu máquina local.
2. Abre una terminal y navega a la carpeta raíz del proyecto.
   ```bash
   cd ruta/al/proyecto
3. Ejecutar el siguiente comando:
   ```bash
   docker-compose up --build
4.-Ingresar a la url : http://localhost:8080/
¨Se ejecutarán las migraciones, es decir, se crearán las tablas y registros ficticios, por lo cual no es necesario correr ningún script*.

5.-ingresar a la url: http://localhost:8081/
*aqui se muestra el front del proyecto, este proyecto está construido en MVC, API REST, con la arquitectura escalable.