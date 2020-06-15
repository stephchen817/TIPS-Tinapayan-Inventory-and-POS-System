<?php include "dbConnection.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $proddesc=$_POST['edit_prodname'];
       // $id=$_POST["spoilID"];
            $result=$conn->query("SELECT prodID FROM products WHERE prodDesc = '$proddesc'");
                while($row = $result->fetch_assoc()): 
                    $prodid=$row["prodID"];
                endwhile;
                    if (empty($_POST['edit_prodname'])) {
                        if (empty($_POST['edit_qty'])) {
                            if (empty($_POST['edit_reason'])) {
                                header("location: spoilage.php");
                            } else {
                                $id=$_POST['spoilID'];
                                $reason = $_POST['edit_reason'];
                                $stmt = $conn->prepare("UPDATE spoilage SET reason = ? WHERE spoilageID = ?");
                                $stmt->bind_param('si', $reason, $id);
                                $stmt->execute();
                                header("location: spoilage.php");
                            }
                        } else {
                            if (empty($_POST['edit_reason'])) {
                                $SpoilageQty = $_POST['edit_qty'];
                                $id=$_POST['spoilID'];
                                $stmt = $conn->prepare("UPDATE spoilage SET spoilageQty = ? WHERE spoilageID = ?");
                                $stmt->bind_param('ii', $SpoilageQty, $id);
                                $stmt->execute();
                                header("location: spoilage.php");
                            } else {
                                $id=$_POST['spoilID'];
                                $SpoilageQty = $_POST['edit_qty'];
                                $reason = $_POST['edit_reason'];
                                $stmt = $conn->prepare("UPDATE spoilage SET spoilageQty = ?, reason = ? WHERE spoilageID = ?");
                                $stmt->bind_param('isi', $SpoilageQty, $reason, $id);
                                $stmt->execute();
                                header("location: spoilage.php");
                            }
                        }
                    } else {
                        if (empty($_POST['edit_qty'])) {
                            if (empty($_POST['edit_reason'])) {
                               $id=$_POST['spoilID'];
                                $ProductID = $_POST['edit_prodname'];
                                $stmt = $conn->prepare("UPDATE spoilage SET prodID = ? WHERE spoilageID = ?");
                                $stmt->bind_param('ii', $ProductID, $id);
                                $stmt->execute();
                                header("location: spoilage.php");
                            } else {
                                $id=$_POST['spoilID'];
                                $ProductID = $_POST['edit_prodname'];
                                $reason = $_POST['edit_reason'];
                                $stmt = $conn->prepare("UPDATE spoilage SET prodID = ?, reason = ? WHERE spoilageID = ?");
                                $stmt->bind_param('isi', $ProductID, $reason, $id);
                                $stmt->execute();
                                header("location: spoilage.php");
                            }
                        } else {
                            if (empty($_POST['edit_reason'])) {
                                $id=$_POST['spoilID'];
                                $ProductID = $_POST['edit_prodname'];
                                $SpoilageQty = $_POST['edit_qty'];
                                $stmt = $conn->prepare("UPDATE spoilage SET prodID = ?, spoilageQty = ? WHERE spoilageID = ?");
                                $stmt->bind_param('iii', $ProductID, $SpoilageQty, $id);
                                $stmt->execute();
                                header("location: spoilage.php");
                            } else {
                                $id=$_POST['spoilID'];
                                $ProductID = $_POST['edit_prodname'];
                                $SpoilageQty = $_POST['edit_qty'];
                                $reason = $_POST['edit_reason'];
                                $stmt = $conn->prepare("UPDATE spoilage SET prodID = ?, spoilageQty = ?, reason = ? WHERE spoilageID = ?");
                                $stmt->bind_param('iisi', $ProductID, $SpoilageQty, $reason, $id);
                                $stmt->execute();
                                header("location: spoilage.php");
                            }
                        }
                    } 
                //endwhile;  
    }
?>