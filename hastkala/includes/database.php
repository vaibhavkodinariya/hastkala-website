<?php

$server = "localhost";
$dbName = "hastkala";
$username = "root";
$password = "";
try
{
    $connectionString = "mysql:host=$server;dbname=$dbName";
    $database = new PDO($connectionString, $username, $password);
}
catch(PDOException $e)
{
    echo("Connection Failed...".$e->getMessage());
}
?>