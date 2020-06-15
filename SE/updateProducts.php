<!--script>
    $(document).ready(function(){   
        $('#products').typeahead({
            source: function(query, result){
                $.ajax({
                    url:"autosuggestInventory2.php",
                    method:"POST",
                    data:{query:query},
                    dataType:"json",
                    success:function(data){
                        result($.map(data, function(item){
                        return item;
                        }));
                    }
                })
            }
        });
            
    });
</!--script -->

<?php include "dbConnection.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['prodId'])){
            $id = $_POST['prodId'];
            if(empty($_POST['ProductDesc'])){
                if(empty($_POST['ProdCurrentQty'])){
                    if(empty($_POST['Breakpoint'])){
                        if(empty($_POST['Price'])){
                            header("location: Inventory2.php");
                        }else{
                            $Price = $_POST['Price'];
                            $stmt2 = $conn->prepare("UPDATE price SET prodPrice = ? WHERE prodID = ?");
                            $stmt2->bind_param('ii', $Price, $id);
                            $stmt2->execute();
                            header("location: Inventory2.php");
                        }
                    }else{
                        $Breakpoint = $_POST['Breakpoint'];
                        if(empty($_POST['Price'])){
                            $stmt = $conn->prepare("UPDATE products SET breakpoint = ? WHERE prodID = ?");
                            $stmt->bind_param('ii', $Breakpoint, $id);
                            $stmt->execute();
                            header("location: Inventory2.php");
                        }else{
                            $Price = $_POST['Price'];
                            $stmt = $conn->prepare("UPDATE products SET breakpoint = ? WHERE prodID = ?");
                            $stmt->bind_param('ii', $Breakpoint, $id);
                            $stmt->execute();

                            $stmt2 = $conn->prepare("UPDATE price SET prodPrice = ? WHERE prodID = ?");
                            $stmt2->bind_param('ii', $Price, $id);
                            $stmt2->execute();
                            header("location: Inventory2.php");
                        }
                    }
                }else{
                    $ProdCurrentQty = $_POST['ProdCurrentQty'];
                    if(empty($_POST['Breakpoint'])){
                        if(empty($_POST['Price'])){
                            $stmt = $conn->prepare("UPDATE products SET startQty = ? WHERE prodID = ?");
                            $stmt->bind_param('ii', $ProdCurrentQty, $id);
                            $stmt->execute();
                            header("location: Inventory2.php");
                        }else{
                            $Price = $_POST['Price'];
                            $stmt = $conn->prepare("UPDATE products SET startQty = ? WHERE prodID = ?");
                            $stmt->bind_param('ii', $ProdCurrentQty, $id);
                            $stmt->execute();

                            $stmt2 = $conn->prepare("UPDATE price SET prodPrice = ? WHERE prodID = ?");
                            $stmt2->bind_param('ii', $Price, $id);
                            $stmt2->execute();
                            header("location: Inventory2.php");
                        }
                    }else{
                        $Breakpoint = $_POST['Breakpoint'];
                        if(empty($_POST['Price'])){
                            $stmt = $conn->prepare("UPDATE products SET startQty = ?, breakpoint = ? WHERE prodID = ?");
                            $stmt->bind_param('ii', $ProdCurrentQty, $Breakpoint, $id);
                            $stmt->execute();
                            header("location: Inventory2.php");
                        }else{
                            $Price = $_POST['Price'];
                            $stmt = $conn->prepare("UPDATE products SET startQty = ?, breakpoint = ? WHERE prodID = ?");
                            $stmt->bind_param('ii', $ProdCurrentQty, $Breakpoint, $id);
                            $stmt->execute();

                            $stmt2 = $conn->prepare("UPDATE price SET prodPrice = ? WHERE prodID = ?");
                            $stmt2->bind_param('ii', $Price, $id);
                            $stmt2->execute();
                            header("location: Inventory2.php");
                        }
                    }
                }
            }else{
                $ProductDesc = $_POST['ProductDesc'];
                if(empty($_POST['ProdCurrentQty'])){
                    if(empty($_POST['Breakpoint'])){
                        if(empty($_POST['Price'])){
                            $stmt = $conn->prepare("UPDATE products SET prodDesc = ? WHERE prodID = ?");
                            $stmt->bind_param('si', $ProductDesc, $id);
                            $stmt->execute();
                            header("location: Inventory2.php");
                        }else{
                            $Price = $_POST['Price'];
                            $stmt = $conn->prepare("UPDATE products SET prodDesc = ? WHERE prodID = ?");
                            $stmt->bind_param('si', $ProductDesc, $id);
                            $stmt->execute();

                            $stmt2 = $conn->prepare("UPDATE price SET prodPrice = ? WHERE prodID = ?");
                            $stmt2->bind_param('ii', $Price, $id);
                            $stmt2->execute();
                            header("location: Inventory2.php");
                        }
                    }else{
                        $Breakpoint = $_POST['Breakpoint'];
                        if(empty($_POST['Price'])){
                            $stmt = $conn->prepare("UPDATE products SET prodDesc = ?, breakpoint = ? WHERE prodID = ?");
                            $stmt->bind_param('sii', $ProductDesc, $Breakpoint, $id);
                            $stmt->execute();
                            header("location: Inventory2.php");
                        }else{
                            $Price = $_POST['Price'];
                            $stmt = $conn->prepare("UPDATE products SET prodDesc = ?, breakpoint = ? WHERE prodID = ?");
                            $stmt->bind_param('sii', $ProductDesc, $Breakpoint, $id);
                            $stmt->execute();

                            $stmt2 = $conn->prepare("UPDATE price SET prodPrice = ? WHERE prodID = ?");
                            $stmt2->bind_param('ii', $Price, $id);
                            $stmt2->execute();
                            header("location: Inventory2.php");
                        }
                    }
                }else{
                    $ProdCurrentQty = $_POST['ProdCurrentQty'];
                    if(empty($_POST['Breakpoint'])){
                        if(empty($_POST['Price'])){
                            $stmt = $conn->prepare("UPDATE products SET prodDesc = ?, startQty = ? WHERE prodID = ?");
                            $stmt->bind_param('sii', $ProductDesc, $ProdCurrentQty, $id);
                            $stmt->execute();
                            header("location: Inventory2.php");
                        }else{
                            $Price = $_POST['Price'];
                            $stmt = $conn->prepare("UPDATE products SET prodDesc = ?, startQty = ? WHERE prodID = ?");
                            $stmt->bind_param('sii', $ProductDesc, $ProdCurrentQty, $id);
                            $stmt->execute();

                            $stmt2 = $conn->prepare("UPDATE price SET prodPrice = ? WHERE prodID = ?");
                            $stmt2->bind_param('ii', $Price, $id);
                            $stmt2->execute();
                            header("location: Inventory2.php");
                        }
                    }else{
                        $Breakpoint = $_POST['Breakpoint'];
                        if(empty($_POST['Price'])){
                            $stmt = $conn->prepare("UPDATE products SET prodDesc = ?, startQty = ?, breakpoint = ? WHERE prodID = ?");
                            $stmt->bind_param('siii', $ProductDesc, $ProdCurrentQty, $Breakpoint, $id);
                            $stmt->execute();
                            header("location: Inventory2.php");
                        }else{
                            $Price = $_POST['Price'];
                            $stmt = $conn->prepare("UPDATE products SET prodDesc = ?, startQty = ?, breakpoint = ? WHERE prodID = ?");
                            $stmt->bind_param('siii', $ProductDesc, $ProdCurrentQty, $Breakpoint, $id);
                            $stmt->execute();

                            $stmt2 = $conn->prepare("UPDATE price SET prodPrice = ? WHERE prodID = ?");
                            $stmt2->bind_param('ii', $Price, $id);
                            $stmt2->execute();
                            header("location: Inventory2.php");
                        }
                    }
                }
            }
        }
    }
?>