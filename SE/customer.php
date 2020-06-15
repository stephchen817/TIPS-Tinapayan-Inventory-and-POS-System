<?php

if (!isset($_SESSION)) {
    session_start();
}

$connect = new PDO("mysql:host=localhost;dbname=tinapayan", "root", "");


$user = $_SESSION['loginUser'];

$query = "INSERT INTO invoice(customerName, customerAddress, username) VALUES (:custname, :custadd, :user)";

for ($count = 0; $count < count($_POST['hidden_custname']); $count++) {
    $data = array(
        ':custname' => $_POST['hidden_custname'][$count],
        ':custadd' => $_POST['hidden_custadd'][$count],
        ':user' => [$user][$count]
    );
    print_r($data);
    $statement = $connect->prepare($query);
    $statement->execute($data);
}
