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
        $sql = $conn->query("SELECT * from user WHERE id IN (SELECT friend_id FROM friend WHERE user_id IN (SELECT id FROM user WHERE username ='".$uname."'))");
    
        #CREATE EMPTY USER VARIABLE WITH ARRAY TYPE
        $users = array();

        while($row= $sql->fetch_assoc()){ #fetch all records from database and store in variable row
            array_push($users,$row);#assign all row values in users array
        }
        $result['users']= $users;
    }

    #insert new record into database
    if($action == 'create'){
        $friendid=$_POST['friendid'];
        
        $userid = $conn->query("SELECT id from user where username='".$uname."'");
        // $result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($userid);
        $myid = $row['id'];

        $sql = $conn->query("INSERT INTO friend (user_id, friend_id) VALUES ($myid, '$friendid')");
       # VALUES (1,'$friendid')");

        if($sql){
            $result['message']="User added successfully";
        }
        else{
            $result['error']= true;
            $result['message']= "Failed to add user!";
        }
    
    }

    $conn->close(); #close the connection to the database

    echo json_encode($result);
?>