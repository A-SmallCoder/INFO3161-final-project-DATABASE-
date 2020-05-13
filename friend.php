<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
    <title> Friends </title>
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
    <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel ="stylesheet" type="text/css" href="userExperienceStyles.css"/>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: black;">
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active"><a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
            <li class="nav-item dropdown">
                <div class="dropdown">
                    <button class="dropbtn">Settings<i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-content"><a href="friend.php">Add Friends</a><a href="#">Create Group</a></div>
                </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="container" style="padding-top: 12px;">
      <div style="padding: 26px 0px;">
        <h1><strong>Friends</strong></h1>
        <h3 style="color: grey;">Add Friends</h3>
      </div>
      <form action = "#" method = 'post' class="form-inline my-2 my-lg-0">
        <input
          name = 'searchfeild'
          class="form-control mr-sm-2"
          type="search"
          placeholder="Search by username"
        />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
          Search
        </button>
        
        
      
    </form>
    <form action='#' method='POST'>
        <button button class='btn btn-outline-success my-2 my-sm-0' type='submit' value='0' name='zero'>
              add
            </button>
    </form>
    </div>
  </body>
</html>

<?php
  require_once 'connect.php';
  echo "<div class='container'>";
  $username = $_SESSION['user'];
   $selectedvalue;
  global $userfriend;
  global $sql02;
  global $sql03;
  global  $sql28;
  global  $result56;
  global  $result57;
  global $result58;
  
  if(isset($_POST['searchfeild'])){
    $var = $_POST['searchfeild'];
    $userfriend= $var;

  
    $sql0 = "SELECT * FROM user WHERE username = '$var' ";
    $result0 = mysqli_query($conn,$sql0) or die(mysqli_error($conn));
    echo"<div class='container' style='padding-top: 52px;'>";

    while($unknown = mysqli_fetch_array($result0)){
      if ($unknown['username'] == $var){
              
        echo "<div class = 'unknownUsers'>";
        echo "<h5>Search Results</h5>";


        //show row from user table 
        echo "<div class = frame>";
          echo "<div class = ''>";
            echo "$unknown[Fname] " . " " . "$unknown[lname]";
          echo "</div>";

          echo "<div class = ''>";
            echo "$unknown[username]";
          echo "</div>";

          //add button inside friend div



          // select a.id, friendid from (select a.id, b.id as friendid from user A left join user B on a.id = b.id) where a.id=10 and friendid=1 ;
            
            //dropdown list for friend_type
          

            //button to add friend
            echo "<form action='#' method='POST'>";
            echo "<select name = 'typelist'>";
              echo "<option value = 'work'>Work</option>";
              echo "<option value = 'Relative'>Relative</option>";
              echo "<option value = 'Group'>Group</option>";
            echo "</select>";
            echo "<input type='submit' value='Get Group' name='unknown' />";
            echo "</form>";
          
  
         
      }else{
        echo "failed if statement";
      }

      
      
    }
  
  }
  
  
    if (isset($_POST["zero"])){
      if(isset($_POST['unknown']) ){

        global $selectedvalue;
        $selectedvalue = $_POST['typelist'];  // Storing Selected Value In Variable
          // Displaying Selected Value
      }
      echo "button clicked";
      $sql78= "SELECT id from user where username='$username'";
      $result85 = mysqli_query($conn,$sql78) or die(mysqli_error($conn));
      $row90 = mysqli_fetch_assoc($result85);
      $myid4 = $row90['id'];

      $sql89= "SELECT id from user where username= '$userfriend'";
      $result67 = mysqli_query($conn,$sql89) or die(mysqli_error($conn));
      $row67 = mysqli_fetch_assoc($result67);
      $myid67 = $row67['id'];


      $sql28= "INSERT INTO friend values ($myid4, $myid67 )";
      $result58 = mysqli_query($conn,$sql28) or die(mysqli_error($conn));
      
    }
  

   
      
 
    

  
  

    
    

  
  


  echo "<div class = 'phpcontainer container'>";

  echo "<h5>Friends</h5>";

    echo "<div class = frame>";
      
    $username = $_SESSION['user'];
      //sql statement to select username
      $sql = "SELECT id FROM user WHERE username = '$username'";
      $result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
      $row = mysqli_fetch_assoc($result1);
      $myid = $row['id'];
      
      

      //sql statement to select friend_id
      $sql2 = "SELECT friend_id FROM friend WHERE user_id = $myid";
      $result2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
      $row2 = mysqli_fetch_assoc($result2);
      $friendid = $row2['friend_id'];
      
      //friend table needs to be normalized and data fetched from that
      //while($rows = mysqli_fetch_array($row2)){
        //select image from profile

        echo "<div>";
          //sql statemet to select name
          echo "<div class = ''>";
          $sql3 = "SELECT Fname, lname FROM user WHERE id = $friendid";
          $result3 = mysqli_query($conn,$sql3) or die(mysqli_error($conn));
          $result4 = mysqli_query($conn,$sql3) or die(mysqli_error($conn));
          $row3 = mysqli_fetch_assoc($result3);
          $row4 = mysqli_fetch_assoc($result4);
          $first = $row3['Fname'];
          $last = $row4['lname'];
          $name = $first. " " . $last;
          echo $name;
          echo "</div>";

          //sqls statement to select username
          echo "<div class = ''>";
          $sql5 = "SELECT username FROM user WHERE id = $friendid";
          $result5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
          $row5 = mysqli_fetch_assoc($result5);
          $username = $row5['username'];
          echo $username;
          echo "</div>";
        echo "</div>";

        //sql to select friend type
        echo "<div>";
        $sql6 = "SELECT friend_type FROM friend WHERE  friend_id = $friendid";
        $result6 = mysqli_query($conn,$sql6) or die(mysqli_error($conn));
        $row6 = mysqli_fetch_assoc($result6);
        $type = $row6['friend_type'];
        echo $type;
        echo "</div>";
      //}
        
    echo "</div>";  


    echo "</div>";
  echo "</div>";
  echo "</div>";

?>
