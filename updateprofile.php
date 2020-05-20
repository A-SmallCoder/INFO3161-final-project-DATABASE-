<?php

    session_start();
    $uname = $_SESSION['user'];

    include 'connect.php';

    $result = array('error'=>false);
    $action = '';

    #GET ACTION FROM URL IN HTML FORM
    if (isset($_GET['action'])){
        $action = $_GET['action'];
    }

    #select all records from database
    if($action == 'read'){
        $sql = $conn->query("SELECT * FROM `user_profile` where username = '".$uname."'");
    
        #CREATE EMPTY USER VARIABLE WITH ARRAY TYPE
        $profiles = array();

        while($row= $sql->fetch_assoc()){ #fetch all records from database and store in variable row
            array_push($profiles,$row);#assign all row values in users array
        }
        $result['profile']= $profiles;
    }

    #update profile record in database
    if($action == 'update'){
        $bio=$_POST['bio'];

       // $userid = $conn->query("SELECT id from user where username='".$uname."'");
        // $result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
      //  $row = mysqli_fetch_assoc($userid);
      //  $myid = $row['id'];

        $sql = $conn->query("UPDATE user SET bio='$bio' WHERE profile_id = 1");
       # VALUES (1,'$friendid')");

        if($sql){
            $result['message']="Profile info updated successfully";
        }
        else{
            $result['error']= true;
            $result['message']= "Failed to update profile info!";
        }
    
    }

    $conn->close(); #close the connection to the database

    echo json_encode($result);
?>