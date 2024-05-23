-- ### Consulta 1: Seleccionar todos los usuarios en un departamento específico
SELECT users.*
FROM users
INNER JOIN departaments ON users.departament_id = departaments.id
WHERE departaments.id = 1;

-- ### Consulta 2: Seleccionar todos los departamentos con más de 10 usuarios
SELECT departaments.*, COUNT(users.id) AS total_users
FROM departaments
LEFT JOIN users ON departaments.id = users.departament_id
GROUP BY departaments.id
HAVING total_users > 10;

-- ### Consulta 3: Seleccionar todos los departamentos con más de 10 usuarios
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

-- ### Consulta 4: Transacciones SQL
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

