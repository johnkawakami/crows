<?php
require('config.php');
$dbhandle = new PDO($database_dsn, $database_user, $database_password);

$dbhandle->exec("CREATE TABLE IF NOT EXISTS reports (`id` INTEGER PRIMARY KEY AUTO_INCREMENT, `date` TIMESTAMP, `title` VARCHAR(255), name VARCHAR(255), location VARCHAR(255), lat DOUBLE, `long` DOUBLE, report TEXT, link VARCHAR(255), photo VARCHAR(255), embed VARCHAR(255))")
or
print_r($dbhandle->errorInfo());
