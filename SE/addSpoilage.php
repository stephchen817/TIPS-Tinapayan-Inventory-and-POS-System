<?php
	require "dbConnection.php";

	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(empty($_POST['prodname']) || empty($_POST['qty']) || empty($_POST['reason'])){      
            $error = "Please fill up the required information!";
        }else{
			$prodname = $_POST["prodname"];
			$spoilqty = $_POST["qty"];
			$reason = $_POST["reason"];

			$result=$conn->query("SELECT prodID FROM products WHERE prodDesc = '$prodname'");
			while($row = $result->fetch_assoc()): $prodcode=$row["prodID"];

			$stmt = $conn->prepare("INSERT INTO spoilage(prodID, spoilageQty, reason) VALUES(?,?,?)");
			$stmt->bind_param('iis', $prodcode, $spoilqty, $reason);
			$stmt->execute();
			
			$stmt2 = $conn->prepare("UPDATE products SET startQty = (startQty - ?) WHERE prodID= ?");
			$stmt2->bind_param('ii', $spoilqty, $prodcode);
			$stmt2->execute();

			endwhile;
			
			header("location: spoilage.php");
			mysqli_close($conn);
		}
	}
?>