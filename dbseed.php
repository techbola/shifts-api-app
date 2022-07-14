<?php

try {
    $connection = new \PDO("mysql:host=localhost;dbname=shift_app", "root", "");
} catch (\PDOException $e) {
    exit($e->getMessage());
}

$statement = "CREATE TABLE IF NOT EXISTS events (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        start DATETIME NOT NULL,
        end DATETIME DEFAULT NULL,
        created_at DATETIME DEFAULT NULL,
        PRIMARY KEY (id),
    ) ENGINE=INNODB";

$statement2 = "INSERT INTO events
        (id, name, start, end, created_at)
    VALUES
        (1, 'Ceremony', '2018-10-22T00:00:00+01:00', '2018-10-24T00:00:00+01:00', '2018-10-24T00:00:00+01:00'),
        (2, 'Induction', '2018-10-22T00:00:00+01:00', '2018-10-24T00:00:00+01:00', '2018-10-24T00:00:00+01:00'),
        (3, 'Sports', '2018-10-22T00:00:00+01:00', '2018-10-24T00:00:00+01:00', '2018-10-24T00:00:00+01:00'),
        (4, 'Coding', '2018-10-22T00:00:00+01:00', '2018-10-24T00:00:00+01:00', '2018-10-24T00:00:00+01:00'),
        (5, 'Interview', '2018-10-22T00:00:00+01:00', '2018-10-24T00:00:00+01:00', '2018-10-24T00:00:00+01:00')";

$statement3 = "CREATE TABLE IF NOT EXISTS departments (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        created_at DATETIME DEFAULT NULL,
        PRIMARY KEY (id),
    ) ENGINE=INNODB";

$statement4 = "INSERT INTO departments
        (id, name, created_at)
    VALUES
        (1, 'Technology', '2018-10-24T00:00:00+01:00'),
        (2, 'Gaming', '2018-10-24T00:00:00+01:00'),
        (3, 'Construction', '2018-10-24T00:00:00+01:00'),
        (4, 'Finances', '2018-10-24T00:00:00+01:00'),
        (5, 'Health', '2018-10-24T00:00:00+01:00')";

$statement5 = "CREATE TABLE IF NOT EXISTS locations (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        created_at DATETIME DEFAULT NULL,
        PRIMARY KEY (id),
    ) ENGINE=INNODB";

$statement6 = "INSERT INTO locations
        (id, name, created_at)
    VALUES
        (1, 'Lagos', '2018-10-24T00:00:00+01:00'),
        (2, 'Ikeja Nigeria', '2018-10-24T00:00:00+01:00'),
        (3, 'Lekki Nigeria', '2018-10-24T00:00:00+01:00'),
        (4, 'Ikoyi Nigeria', '2018-10-24T00:00:00+01:00'),
        (5, 'Surulere Nigeria', '2018-10-24T00:00:00+01:00')";

$statement7 = "CREATE TABLE IF NOT EXISTS users (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        created_at DATETIME DEFAULT NULL,
        PRIMARY KEY (id),
    ) ENGINE=INNODB";

$statement8 = "INSERT INTO users
        (id, name, email, created_at)
    VALUES
        (1, 'Bola', 'Bola@test.com', '2018-10-24T00:00:00+01:00'),
        (2, 'John', 'John@test.com', '2018-10-24T00:00:00+01:00'),
        (3, 'Jude', 'Jude@test.com', '2018-10-24T00:00:00+01:00'),
        (4, 'Tanel', 'Tanel@test.com', '2018-10-24T00:00:00+01:00'),
        (5, 'Ade', 'Ade@test.com', '2018-10-24T00:00:00+01:00')";

$statement9 = "CREATE TABLE IF NOT EXISTS department_shift (
        id INT NOT NULL AUTO_INCREMENT,
        department_id INT DEFAULT NULL,
        shift_id INT DEFAULT NULL,
        created_at DATETIME DEFAULT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (department_id)
            REFERENCES departments(id)
            ON DELETE SET NULL,
        FOREIGN KEY (shift_id)
            REFERENCES shifts(id)
            ON DELETE SET NULL
    ) ENGINE=INNODB";

$statement10 = "INSERT INTO department_shift
        (id, department_id, shift_id, created_at)
    VALUES
        (1, 1, 1, '2018-10-24T00:00:00+01:00'),
        (2, 2, 1, '2018-10-24T00:00:00+01:00'),
        (3, 3, 1, '2018-10-24T00:00:00+01:00'),
        (4, 4, 2, '2018-10-24T00:00:00+01:00'),
        (5, 5, 2, '2018-10-24T00:00:00+01:00')";

$statement11 = "CREATE TABLE IF NOT EXISTS shifts (
        id INT NOT NULL AUTO_INCREMENT,
        type VARCHAR(100) NOT NULL,
        start DATETIME NOT NULL,
        end DATETIME NOT NULL,
        rate FLOAT NOT NULL,
        charge FLOAT NOT NULL,
        area VARCHAR(100) NOT NULL,
        user_id INT DEFAULT NULL,
        location_id INT DEFAULT NULL,
        event_id INT DEFAULT NULL,
        created_at DATETIME DEFAULT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (user_id)
            REFERENCES users(id)
            ON DELETE SET NULL,
        FOREIGN KEY (location_id)
            REFERENCES locations(id)
            ON DELETE SET NULL
        FOREIGN KEY (event_id)
            REFERENCES events(id)
            ON DELETE SET NULL
    ) ENGINE=INNODB";

$statement12 = "INSERT INTO shifts
        (id, type, start, end, rate, charge, area, user_id, location_id, event_id, created_at)
    VALUES
        (1, 'shift', '2018-10-25T17:00:00+01:00', '2018-10-30T00:00:00+01:00', null, null, null, 1, 1, 1, '2018-10-24T00:00:00+01:00'),
        (2, 'shift', '2018-10-25T00:00:00+01:00', '2018-10-29T00:00:00+01:00', null, null, null, 2, 3, 2, '2018-10-24T00:00:00+01:00')";

try {
    $connection->exec($statement);
    $connection->exec($statement2);
    $connection->exec($statement3);
    $connection->exec($statement4);
    $connection->exec($statement5);
    $connection->exec($statement6);
    $connection->exec($statement7);
    $connection->exec($statement8);
    $connection->exec($statement9);
    $connection->exec($statement10);
    $connection->exec($statement11);
    $connection->exec($statement12);
    echo "Success!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}