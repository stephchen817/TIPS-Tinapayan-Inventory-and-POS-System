<?php

    require "dbConnection.php";
    session_start();

    $invID = (int) $_POST['invID'];
    $type = $_POST['add/edit'];

    if ($type == "add"){
        $prod = $_POST['new_prod'];
        $prodqty = (int) $_POST['new_prodqty'];

        $result = $conn->query("SELECT * FROM products WHERE prodDesc='$prod'");

        while ($row = $result->fetch_assoc()){
            $stmt = $conn->prepare("INSERT INTO invoice_details(prodID, invoiceID, inv_qty, prodDesc) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('iiis', $row['prodID'], $invID, $prodqty, $prod);
            $stmt->execute();
        }

        header("location: customerInvoice.php?inv=$invID");
    }

    elseif ($type == "edit"){
        $prod = $_POST['prodDesc'];
        $qty = (int) $_POST['editQty'];

        $result = $conn->query("SELECT * FROM products WHERE prodDesc='$prod'");

        while ($row = $result->fetch_assoc()){
            $stmt = $conn->prepare("UPDATE invoice_details SET inv_qty=? WHERE invoiceID=? AND prodID=?");
            $stmt->bind_param('iii', $qty, $invID, $row['prodID']);
            $stmt->execute();
        }

        header("location: customerInvoice.php?inv=$invID");
    }







    


?>