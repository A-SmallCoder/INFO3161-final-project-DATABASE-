<?php

    session_start();
    

    include 'connect.php';

    $result = array('error'=>false);
    $action = '';

    #GET ACTION FROM URL IN HTML FORM
    if (isset($_GET['action'])){
        $action = $_GET['action'];
    }

    #select all records from database
    if($action == 'read'){
        $sql = $conn->query("select * from user where id in (SELECT friend_id FROM friend where user_id in (select id from user where username='8^UIR0(i&c'))");

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
        $sql = $conn->query("INSERT INTO friend (user_id,friend_id) VALUES (4,'$friendid')");

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