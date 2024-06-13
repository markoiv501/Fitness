<?php

require_once 'config.php';

$username = 'admin';
$password = 'admin123';

$cripted_password = password_hash($password, PASSWORD_DEFAULT);
echo $password . "<br>" . $cripted_password;

$sql = "INSERT INTO admins (username, password) VALUES (?,?)";

$run = $conn->prepare($sql);
$run ->bind_param("ss", $username, $cripted_password);
$run ->execute();
$conn->close();


