<?php
session_start();
// Destroying All Sessions
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['logout'])){
        session_destroy();
    }
}
  
?>