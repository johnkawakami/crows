<?php
require('config.php');

/* Simple DB creation script.  Tested with MySQL and sqlite backends. */

$dbhandle = new PDO($database_dsn, $database_user, $database_password);

/* Ugh.  It's AUTOINCREMENT with sqlite3 and AUTO_INCREMENT with mysql.  One of these should work... */
$dbhandle->exec("CREATE TABLE IF NOT EXISTS reports (`id` INTEGER PRIMARY KEY AUTO_INCREMENT, `date` DATETIME, `title` VARCHAR(255), name VARCHAR(255), location VARCHAR(255), lat DOUBLE, `long` DOUBLE, report TEXT, link VARCHAR(255), photo VARCHAR(255), embed VARCHAR(255))")
or
$dbhandle->exec("CREATE TABLE IF NOT EXISTS reports (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `date` DATETIME, `title` VARCHAR(255), name VARCHAR(255), location VARCHAR(255), lat DOUBLE, `long` DOUBLE, report TEXT, link VARCHAR(255), photo VARCHAR(255), embed VARCHAR(255))")
or
print_r($dbhandle->errorInfo());
