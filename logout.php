<?php
    session_start();
    include("./dbConnect.php");

    if(isset($_SESSION['user_id'])){
        session_unset();
        // session_destroy();
        // $_SESSION = array();
        $message = "Logged out successfully";
        header('Location: ./index.php?message='.$message);    
    }
?>