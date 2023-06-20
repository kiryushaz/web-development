<?php
function db_connect($host, $user, $pass, $database) {
    return new mysqli($host, $user, $pass, $database);
}
$mysqli = db_connect("localhost", "root", "", "test");

if ($mysqli->connect_error) {
    die('Error ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error);
}
