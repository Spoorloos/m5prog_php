<?php

function database_connect() {
    $env = parse_ini_file('../.env');
    $connection = new mysqli('mariadb', $env['MYSQL_USER'], $env['MYSQL_PASSWORD'], $env['MYSQL_DATABASE']);
    return $connection;
}