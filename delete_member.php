<?php

require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $member_id = $_POST['member_id'];

    $sql = "DELETE FROM members WHERE member_id = ?";

    $run=$conn->prepare($sql);
    $run->bind_param('i', $member_id);
    $run->execute();
    $conn->close();

    $_SESSION['success-message'] = "Član teretane je uspješno  <b>obrisan</b>.";
    header('location: admin_dashboard.php');
    exit();

}