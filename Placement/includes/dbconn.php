<?php
/**
 * Created by PhpStorm.
 * User: Trilokynath Wagh
 * Date: 18-12-2017
 * Time: 10:33 PM
 */
include_once 'config.php';   // As functions.php is not included
$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
