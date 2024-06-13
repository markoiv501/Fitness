<?php

require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $member_id = $_POST['member'];
    $trainer_id = $_POST['trainer'];
    
    $sql = "UPDATE members SET trainer_id = ? WHERE member_id = ?";
    
    $run = $conn->prepare($sql);
    $run->bind_param("ii", $trainer_id, $member_id);
    $run->execute();
    
    $_SESSION['success-message'] = 'Trener je uspješno <b>dodijeljen</b> članu.';
    header('location: admin_dashboard.php');
    exit();

}