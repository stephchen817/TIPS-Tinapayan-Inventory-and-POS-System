<?php
    include "dbConnection.php";
    $request = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "
    SELECT * FROM products WHERE prodDesc LIKE '%".$request."%'
    ";

    $result = mysqli_query($conn, $query);

    $data = array();

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row["prodDesc"];
        }
        
        echo json_encode($data);
    }

?>
