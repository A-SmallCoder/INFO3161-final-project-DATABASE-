<html>
  <head>
    <title>
      My Book - Login
    </title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body class="login">
    <div class="loginbox">
      <img src="avatar.png" class="avatar" />
      <h1>Login Here</h1>
      <form action = "#" method = "POST">
        <p>Username</p>
        <input type="text" name="username" placeholder="Enter your username" />
        <p>Password</p>
        <input type="password" name="password" placeholder="Enter your password" />
        <input type="submit" name="" value="Login" />
        <a href="signin.html">Don't have account? Sign Up</a>
      </form>
    </div>
  </body>
</html>


<?php
ob_start();
require_once 'connect.php';
$table = 'user';

if(isset($_POST['username'])){
    $uname = $_POST['username'];
    $pword = $_POST['password'];

    //makes sure form data is safe
    //$uname = real_escape_string(stripslashes($uname));
    //$pword = real_escape_string(stripslashes($pword));

    $users = "SELECT * FROM $table WHERE username = '$uname' and password = '$pword' limit 1";
    $result = mysqli_query($conn,$users);

    $count = mysqli_num_rows($result);
    if ($count ==  1){
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/home.html');
        exit(); 
    }else{
        echo "wrong username or password";
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login.php');
        exit();
    }

}
ob_end_flush();
?>