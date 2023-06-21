<?php
    session_start();

    include("./dbConnect.php");

    // dd($_POST);

    $email = mysqli_real_escape_string($mysqli_connection, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli_connection, $_POST['password']);

    if (empty($email) || empty($password)) {
        $message = "Please enter all required fileds";
        header('Location: ./login.php?message='.$message);
    } else {
        $query = "SELECT * FROM users where email='$email'";
        $result = mysqli_query($mysqli_connection, $query);
        if(mysqli_num_rows($result) > 0 ){
             $result_array = mysqli_fetch_assoc($result);
            //  dd($result_array);
             if (password_verify($password, $result_array['password'])) {
                $_SESSION['user_id'] = $result_array['user_id'];
                header('Location: ./dashboard.php');
             } else {
                $message = "Password does not match";
                header('Location: ./login.php?message='.$message);
             }
        } else {
            $message = "Email or Password is incorrect";
            header('Location: ./login.php?message='.$message);
        }
    }

    