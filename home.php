<?php session_start() ?>
<html>
  <head>
    <title>
      Home
    </title>
    <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type = "text/css" href="userExperienceStyles.css"/>
  </head>

  <body>

    <header>
      <nav class="navbar navbar-expand-lg navbar-light " style=" background-color: black;">
      
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <li class="nav-item dropdown">
              <div class="dropdown">
                <button class="dropbtn">Settings
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="#">Add Friends</a>
                  <a href="#">Create Group</a>
                </div>
              </div> 
            </li>
            
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>        
  
    <?php
      require_once 'connect.php';
      echo "<div class = 'mycontainer'>";

        echo "<div class = newpost>";
          echo "<section><p><strong>New Post</strong></p></section>";
          
          echo "<form action = '#' method = 'post'>";
            echo "<input type = 'textarea' name = 'postarea' class = 'postarea' placeholder = 'Whats on your mind?'/>";
            echo "<div class = 'forminput'><input type='file' id='img' name='img' accept='image/*' name = 'postimg'>";
            echo "<input type='submit' value = 'Post'/></div>";
          echo "</form>";

          $username = $_SESSION['user'];
          //sql statement to select username
          $sql = "SELECT id FROM user WHERE username = '$username'";
          $result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
          $row = mysqli_fetch_assoc($result1);
          $myid = $row['id'];

          if(isset($_POST['postarea'])){
            $thistext = $_POST['postarea'];
            $thisimg = $_POST['postimg'];
          

            //formaction add post
            $sql3 = "INSERT INTO posts (post_text,post_image) Values ($thistext,$thisimg)";
            $send = mysqli_query($conn,$sql3) or die($mysqli_error($conn));

            $sql4 = "SELECT post_id FROM posts where post_text = $thistext && post_date IN(SELECT NOW())";
            $send2 = mysqli_query($conn,$sql4) or die($mysqli_error($conn));
            $sen2 = mysqli_fetch_assoc($send2);
            $postidentify = $sen2['post_id'];

            $sql6 = "INSERT INTO make_post(user_id,post_id) values($myid,$postidentify)";
            $send3 = mysqli_query($conn,$sql6) or die($mysqli_error($conn));
            
            echo "</div>";
          }


         //select friend ids
         $sql = "SELECT friend_id FROM friend WHERE user_id = $myid";
         $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            $ro = mysqli_fetch_assoc($result);
            $friends = $ro['friend_id'];
        
        //for each friend select the posts
        while($ro1 = mysqli_fetch_array($result)){


          $sql2 = "SELECT * FROM user WHERE id = $friends";
          $result2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
          $ro2 = mysqli_fetch_assoc($result2);
          $name = $ro2['Fname'] . " " . $ro2['lname'];
          $fusername = $ro2['username'];
          

          //select post content for each of this users friends posts 
          $sql5 = "SELECT post_id,post_text,post_image,post_date FROM posts WHERE post_id IN(SELECT post_id FROM make_post WHERE user_id =$friends)";
          $result5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));

          //while there are more posts:
          while($row9 = mysqli_fetch_array($result5)){

              echo "<div class = postdiv>";
                  //get results from the query and put in variables
                  $postid = $row9['post_id'];
                  $posttext = $row9['post_text'];
                  $postimage = $row9['post_image'];
                  $postdate = ['post_date'];

                  echo "<div class = postwords>";
                  echo "<p>$name, $fusername</p><hr>";
                  echo "</div>";
                  echo "<div class='profilepic'>$postimage</div>";
                  echo "<div class = postwords>$posttext</div>";
                  

              echo "</div>";

          }
        }





      echo "</div>";
    

    ?>
  
  </body>
</html>