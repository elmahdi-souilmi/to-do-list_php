<?php
$host = 'localhost';
$user = 'souilmi';
$password = 'ELMAHDI';
$dbname = 'todo_list';
// set DSN
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
// create a PDO instance
$conn = new PDO($dsn, $user, $password);

