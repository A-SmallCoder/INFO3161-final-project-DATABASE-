<?php
ob_start();
require_once 'connect.php';

//get info from registration form
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$date_of_birth = $_REQUEST['dob'];
$email = $_REQUEST['email'];
$username = $_REQUEST['username'];
$passsword = $_REQUEST['password'];

$sql = "INSERT INTO User (Fname,lname,DOB,email,username,password) VALUES(
    '$firstname','$lastname','$date_of_birth','$email','$username','$passsword')";

$result = mysqli_query($conn,$sql) or die(mysql_error($conn));

if($result){
    print("stored");
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/home.html');
    exit();
}else{
    print("failed");
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/register.php');
    exit();
}

ob_end_flush();
?>
