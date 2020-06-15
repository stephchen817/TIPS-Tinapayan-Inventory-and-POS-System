<?php

$connect = new PDO("mysql:host=localhost;dbname=tinapayan", "root", "");

$prodID = array();
$item_name = array();
$result = array();
$prodDesc = array();

$item_count = count($item_name);
for ($i = 0; $i < $item_count; $i++) {
    $sql = "SELECT * FROM `products` WHERE `prodDesc` =" . $item_name[$i] . ";";
    if ($row = mysqli_fetch_assoc($prodID)) {
        $result = $connect->query("SELECT prodID FROM `products` WHERE `prodDesc` = '$prodDesc'");
    } else {
        echo "error";
    }
}

$qry = "SELECT invoice_details.invoiceID, (invoice_details.inv_qty*price.prodPrice) AS Amount, invoice_details.prodDesc, invoice_details.inv_qty FROM invoice_details INNER JOIN price ON invoice_details.prodID = price.prodID";
$statement = $connect->query($qry);
$statement->execute($qry);

$query = "INSERT INTO invoice_details(prodID, invoiceID, prodDesc, inv_qty) VALUES ((SELECT `prodID` FROM products WHERE `prodDesc` = :item_name), :invoiceID, :item_name, :productqty)";

for ($count = 0; $count < count($_POST['hidden_invoiceID']); $count++) {
    $data = array(
        ':invoiceID' => $_POST['hidden_invoiceID'][$count],
        ':item_name' => $_POST['hidden_item_name'][$count],
        //':item_name' => $prodID = isset($count[1]) ?: null,
        ':productqty' => $_POST['hidden_productqty'][$count]
    );

    $invoiceqty = $data[':productqty'];
    $itemname = $data[':item_name'];

    print_r($data);
    $statement = $connect->prepare($query);
    $statement->execute($data);
    
    $sql = "UPDATE PRODUCTS SET startQty = (startQty-:prodqty) WHERE prodID = (SELECT `prodID` FROM products WHERE `prodDesc` =:prodname)";
    $qry = $connect->prepare($sql);
    $qry->bindParam(':prodqty', $invoiceqty, PDO::PARAM_INT);
    $qry->bindParam(':prodname', $itemname, PDO::PARAM_STR);
    $qry->execute();
}
