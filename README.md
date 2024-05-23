# Proyecto Tic

# Prueba perfil 1. Convocatoria “Talentos en programación"

## Instalación

Para el servidor Apache, uso Laragon en su versión 6.0, con la siguiente configuración:

-   **Servidor**: Apache httpd-2.4.54 configurado en el puerto 80.
-   **Motor de base de datos**: MySQL 8.0.30 configurado en el puerto 3306.
-   **PHP**: 8.1.10
-   **Git**: 2.41.0.windows.2
-   **Composer**: 2.5.8

Además, utilizo las siguientes herramientas:

-   **Herramienta visualizadora de bases de datos**: DBeaver 24.0.5.
-   Para que el proyecto funcione deb estar en la ruta donde se instalo el laragon, en la carpeta www
    ..\laragon\www\proyecto-tic

## Esquema de base de datos

-   **Nombre**: `prueba-tic`
-   **Charset**: utf8mb4
-   **Collation**: utf8mb4_0900_ai_ci

## Configuración del entorno

Asegúrese de configurar correctamente su entorno antes de ejecutar el proyecto. Puede hacerlo siguiendo estos pasos:

**Configuración del archivo .env:**

Asegúrese de crear un archivo `.env` en la raíz del proyecto y configure las siguientes variables de entorno según sea necesario:

```plaintext
APP_NAME=proyecto_tic
APP_ENV=local
APP_KEY=base64:ZG0IzlcoF0vNkGMog4Zkqx1myN0PAQDqhjqTEtdm65M=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prueba-tic
DB_USERNAME=root
DB_PASSWORD=TU_CONTRASEÑA_DE_MYSQL
```

## Comandos

-   `composer require laravel/ui`
-   `php artisan ui bootstrap --auth`
-   `composer install`
-   `npm install`
-   `composer require yajra/laravel-datatables-oracle`
-   `npm install jquery`
-   `npm install sweetalert2`
-   `npm run dev`


## Ejecutar Migraciones y Seeders

-   `php artisan migrate:refresh --seed`

## Consultas SQL

Para verificar las consultas SQL predefinidas en el proyecto, puede encontrarlas en la raíz del proyecto en el directorio `_consulta_SQL`. Las consultas están disponibles en un archivo llamado `consultas.sql`.

Para ejecutar estas consultas:

**Ubicación del archivo:**

    Vaya al directorio raíz del proyecto y navegue hasta la carpeta `_consulta_SQL`.

### Consulta 1: Seleccionar todos los usuarios en un departamento específico

```sql

SELECT users.*
FROM users
INNER JOIN departaments ON users.departament_id = departaments.id
WHERE departaments.id = 1;

```

### Consulta 2: Seleccionar todos los departamentos con más de 10 usuarios

```sql

SELECT departaments.*, COUNT(users.id) AS total_users
FROM departaments
LEFT JOIN users ON departaments.id = users.departament_id
GROUP BY departaments.id
HAVING total_users > 10;

```

### Consulta 3: Seleccionar todos los departamentos con más de 10 usuarios

```sql

SELECT
    u.id AS user_id,
    u.name AS user_name,
    u.email AS user_email,
    d.name AS department_name
FROM
    users u
INNER JOIN
    departaments d
ON
    u.departament_id = d.id;

```

### Consulta 4: Transacciones SQL

```sql

START TRANSACTION;

INSERT INTO departaments (name, description, created_at, updated_at)
VALUES ('prueba transaccion', 'probando el las transacciones', NOW(), NOW());

SET @departament_id = LAST_INSERT_ID();

INSERT INTO users (name, email, password, departament_id, created_at, updated_at)
VALUES ('transaccion_user', 'henrymauro.j@hotmail.com', '123', @departament_id, NOW(), NOW());

DELIMITER $$
CREATE TRIGGER before_insert_user
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
    IF (SELECT COUNT(*) FROM users WHERE email = NEW.email) > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error al crear el usuario: El correo electrónico ya está en uso';
    END IF;
END$$
DELIMITER ;

COMMIT;
SELECT 'Departamento y usuario creados correctamente' AS mensaje;


```

## Ejecución de pruebas

Para ejecutar las pruebas, utiliza el siguiente comando:

```bash

  npm run test

```

## Autor

-   [HenryMJL](https://github.com/HenryMJL)
