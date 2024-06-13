<?php

require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $trainer_id = $_POST['trainer_id'];

    $sql = "DELETE FROM trainers WHERE trainer_id = ?";

    $run = $conn->prepare($sql);
    $run->bind_param("i", $trainer_id);
    $run->execute();

    $_SESSION['success-message'] = 'Trener je uspješno <b>obrisan</b>.';
    header('location: admin_dashboard.php');
    exit();
}