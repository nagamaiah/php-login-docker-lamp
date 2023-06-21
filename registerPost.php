<?php

    include("./dbConnect.php");
    
    $email = mysqli_real_escape_string($mysqli_connection, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli_connection, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($mysqli_connection, $_POST['confirm-password']);

    if ( empty($email) || empty($password) || empty($confirmPassword)){
        $message = "Please enter all required fileds";
        header('Location: ./register.php?message='.$message);
    } else {
        if ($password !== $confirmPassword) {
            $message = "Confirm password not matched";
            header('Location: ./register.php?message='.$message);
        } else {
            $hashedPassword = password_hash($password,PASSWORD_BCRYPT);
            $query = "INSERT INTO users (email,password) values ('$email', '$hashedPassword')";
            $execute = mysqli_query($mysqli_connection, $query);
            header('Location: ./login.php?message=Registered successfully. Login now.');
        }
    }

    