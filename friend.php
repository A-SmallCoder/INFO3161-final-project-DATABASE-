<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
    <title> Friends </title>
    <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel ="stylesheet" type="text/css" href="userExperienceStyles.css"/>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: black;">
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active"><a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
            <li class="nav-item dropdown">
                <div class="dropdown">
                    <button class="dropbtn">Settings<i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-content"><a href="#">Add Friends</a><a href="#">Create Group</a></div>
                </div>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search"/>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
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
          placeholder="Search for friend here"
        />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
          Search
        </button>
        
      </form>
    </div>
  </body>
</html>

<?php
  require_once 'connect.php';

  if(isset($_POST['searchfeild'])){
    $var = $_POST['searchfeild'];


    $sql0 = "SELECT * FROM user WHERE username = '$var' ";
    $result0 = mysqli_query($conn,$sql0) or die(mysqli_error($conn));


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
          echo "<form action = '#' method = 'post'>";
            
            //dropdown list for friend_type
            echo "<select name = 'typelist'>";
              echo "<option value = 'work'>Work</option>";
              echo "<option value = 'relative'>Relative</option>";
              echo "<option value = 'group'>Group</option>";
            echo "</select>";

            //button to add friend
            echo "<button class='btn btn-outline-success my-2 my-sm-0' type='submit' >Add</button>";



            if(isset($_POST['uid7'], $_POST['typelist'])){
              $var7 = $_POST['uid7']; $var8 = $_POST['typelist'];
              
              //sql to add friend by updating friend table
              $sql8 = "INSERT INTO friend VALUES($myid,$var7,$var8)";
              $result8 = mysqli_query($conn,$sql8) or die(mysqli_error($conn));
              $row8 = mysqli_fetch_assoc($result8);
              $id8 = $row8['id'];
              echo $id8;
            }
          echo "</form>";
          
          
        echo "</div>";
      }else{
        echo "failed if statement";
      }
    }
  }


  echo "<div class = 'spacer'> </div>";
  echo "<div class = 'phpcontainer'>";

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
        
    echo "</div>";

  echo "</div>";

?>