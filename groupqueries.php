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
        $sql = $conn->query("SELECT * FROM `group`");
    
        #CREATE EMPTY USER VARIABLE WITH ARRAY TYPE
        $groups = array();

        while($row= $sql->fetch_assoc()){ #fetch all records from database and store in variable row
            array_push($groups,$row);#assign all row values in users array
        }
        $result['group']= $groups;
    }

    #insert new record into database
    if($action == 'create'){
        $groupname=$_POST['groupname'];
       // $userid = $conn->query("SELECT id from user where username='".$uname."'");
        // $result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
      //  $row = mysqli_fetch_assoc($userid);
      //  $myid = $row['id'];

        $sql = $conn->query("INSERT INTO `group` (`group_id`, `group_name`) VALUES (NULL, '$groupname');");
       # VALUES (1,'$friendid')");

        if($sql){
            $result['message']="Group added successfully";
        }
        else{
            $result['error']= true;
            $result['message']= "Failed to add group!";
        }
    
    }

    $conn->close(); #close the connection to the database

    echo json_encode($result);
?>