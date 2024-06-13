<?php

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    // $photo_path = $_POST['photo_path_trainer'];



    $sql = "INSERT INTO trainers (first_name, last_name, email, phone_number) VALUES (?,?,?,?)";
    
    $run=$conn->prepare($sql);
    $run->bind_param('ssss', $first_name, $last_name, $email, $phone_number);
    $run->execute();

    $trainer_id = $conn->insert_id;

    $_SESSION['trainer_id'] = $trainer_id;


    $_SESSION['success-message'] = 'Trener je uspješno <b>dodat</b>.';
    header('location: admin_dashboard.php');
    exit();

}