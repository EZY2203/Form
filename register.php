<?php
$DATABASE_HOST ='localhost';
$DATABASE_USER='root';
$DATABASE_PASS='';
$DATABASE_NAME='user';

$con= mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

if(mysqli_connect_error()){
    exit('Error connecting to the data base'.mysqli_connect_error());
}

if(isset($_POST['name'],$_POST['email'],$_POST['phone'],$_POST['password'],$_POST['confirm_password'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirm_password = password_hash($_POST['confirm_password'], PASSWORD_DEFAULT);

    if($_POST['password'] !== $_POST['confirm_password']){
        exit('Passwords do not match');
    }

    $sql = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    if(mysqli_query($con, $sql)){
        echo "User registered successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

