<?php

    include "dbConnection.php";
    session_start();

    $user = "SALES_ADMIN";
    //$user = $_SESSION['loginUser'];

    $type = $_POST['add/edit'];

    if ($type == "add"){
        if ($_POST['newCustomer'] != null){
            $custName = $_POST['newCustomer'];
            $custAdd = $_POST['newAddress'];
    
            $stmt = $conn->prepare("INSERT INTO invoice(customerName, customerAddress, username) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $custName, $custAdd, $user);
            $stmt->execute();
    
            header("location: invoice1.php");
        }
    }

    elseif ($type == "edit"){
        if ($_POST['invoiceID'] != null){
            $invID = (int) $_POST['invoiceID'];
            if (($_POST['editCustName'] != null) && ($_POST['editCustAdd'] == null)){
                $stmt = $conn->prepare("UPDATE invoice SET customerName=? WHERE invoiceID=?");
                $stmt->bind_param('si', $_POST['editCustName'], $invID);
                $stmt->execute();
                header("location: invoice1.php");
            }
            elseif (($_POST['editCustName'] == null) && ($_POST['editCustAdd'] != null)){
                $stmt = $conn->prepare("UPDATE invoice SET customerAddress=? WHERE invoiceID=?");
                $stmt->bind_param('si', $_POST['editCustAdd'], $invID);
                $stmt->execute();
                header("location: invoice1.php");
            }
            elseif (($_POST['editCustName'] != null) && ($_POST['editCustAdd'] != null)){
                $stmt = $conn->prepare("UPDATE invoice SET customerName=?, customerAddress=? WHERE invoiceID=?");
                $stmt->bind_param('ssi', $_POST['editCustName'], $_POST['editCustAdd'], $invID);
                $stmt->execute();
                header("location: invoice1.php");
            }
        }
    }

    

    
    













/*

if (!isset($_SESSION)) {
    session_start();
}

$connect = new PDO("mysql:host=localhost;dbname=tinapayan new", "root", "");

$user = "SALES_ADMIN";
//$user = $_SESSION['loginUser'];

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


$qry = "SELECT invoiceID, invoiceDate, username FROM invoice";
$statement->execute($qry);
*/
?>