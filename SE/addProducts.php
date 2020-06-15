<?php
    require "dbConnection.php";
    session_start();
    $error = "";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(empty($_POST['Breakpoint'])){
            $Breakpoint = 0;
        }
        
        if(empty($_POST['ProductDesc']) || empty($_POST['ProdCurrentQty']) || empty($_POST['Price'])){      
            $error = "Please fill up the required information!";
        }
        else{
            $ProductDesc = $_POST['ProductDesc'];
            $ProdCurrentQty = $_POST['ProdCurrentQty'];
            $Breakpoint = $_POST['Breakpoint'];
            $Price = $_POST['Price'];
        }
        $stmt = $conn->prepare("INSERT INTO products(prodDesc, startQty, breakpoint) VALUES (?, ?, ?)");
        $stmt->bind_param('sii', $ProductDesc, $ProdCurrentQty, $Breakpoint);
        $stmt->execute();

        $stmt3 = $conn->prepare("INSERT INTO price(prodID, prodPrice) VALUES ((SELECT prodID FROM products WHERE prodDesc = ?), ?)");
        $stmt3->bind_param('si', $ProductDesc, $Price);
        $stmt3->execute();

        header("location: Inventory2.php");

        mysqli_close($conn);
    }
?>