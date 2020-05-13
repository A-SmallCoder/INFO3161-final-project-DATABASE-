<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      Profile
    </title>
    <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="style.css" />

    <link rel="stylesheet" type = "text/css" href = "userExperienceStyles.css"/>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="home.html"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="friend.php">Friends</a>
            </li>
            <li class="nav-item dropdown">
              <div class="dropdown">
                <button class="dropbtn">
                  Settings
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="#">Add Friends</a>
                  <a href="#">Create Group</a>
                </div>
              </div>
            </li>
          </ul>
          
        </div>
      </nav>
    </header>
    
    <div class="mycontainer">

        <div class="myprofile"><h1>My Profile</h1></div>
        
        <div class='profiletop'> 
            <?php
            require_once 'connect.php';
            
            $username = $_SESSION['user'];
            //sql statement to select username
            $sql = "SELECT id FROM user WHERE username = '$username'";
            $result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            $row = mysqli_fetch_assoc($result1);
            $myid = $row['id'];

            // php for profile photo
            $sql6 ="SELECT profile_pic FROM user_profile WHERE profile_id IN(SELECT profile_id FROM created_on WHERE user_id = $myid)";
            $result6 = mysqli_query($conn,$sql6) or die(mysqli_error($conn));
            $row6 = mysqli_fetch_assoc($result6);
            $profile_pic = $row6['profile_pic'];

            //select name of user
            $sql3 = "SELECT Fname, lname FROM user WHERE id = $myid";
            $result3 = mysqli_query($conn,$sql3) or die(mysqli_error($conn));
            $result4 = mysqli_query($conn,$sql3) or die(mysqli_error($conn));
            $row3 = mysqli_fetch_assoc($result3);
            $row4 = mysqli_fetch_assoc($result4);
            $first = $row3['Fname'];
            $last = $row4['lname'];
            $name = $first. " " . $last;

            //select data of birth
            $sql2 = "SELECT DOB FROM user WHERE id = $myid";
            $result2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
            $row = mysqli_fetch_assoc($result2);
            $dob = $row['DOB'];

            //echo "<img src='data:image:base64,' .base64 encode($profile_pic)/>";
            //when image table is working, remove this, set a profile pic and then it should work
            echo "<div class='profilepic'> <img src='background.jpg' /> </div>";
            
            echo "<div>";

            echo "<h1 class='profile-name'><strong>$name</strong></h1>";
            echo "<p>$username</p>";
            echo "<p>Born on $dob</p>";

            echo "</div>";

            //space for bio
        
            //space for groups ( uncomment when group table starts working)
            /*echo "<p>Groups</p>";
            $sql4 = "SELECT group_id FROM member_of WHERE user_id = $myid";
            $result4 = mysqli_query($conn,$sql4) or die(mysqli_error($conn));
            $row4 = mysqli_fetch_assoc($result4);
            $group4 = $row4['group_id'];
            */
        echo "</div>";

        
        echo "<h3>My Posts</h3>";


        

            //select post content for each of this users posts 
            $sql5 = "SELECT post_id,post_text,post_image,post_date FROM posts WHERE post_id IN(SELECT post_id FROM make_post WHERE user_id =$myid)";
            $result5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));

            $count = mysqli_num_rows($result5);
            if($count == 0){
                echo "You have not made any posts. go to the home page to make a post";
            }

            //while there are more posts:
            while($row9 = mysqli_fetch_array($result5)){

                echo "<div class = postdiv>";
                    //get results from the query and put in variables
                    $postid = $row9['post_id'];
                    $posttext = $row9['post_text'];
                    $postimage = $row9['post_image'];
                    $postdate = ['post_date'];

                    echo "<div class = postwords>";
                    echo "<p>$name, $username</p><hr>";
                    echo "</div>";
                    echo "<div class='profilepic'>$postimage</div>";
                    echo "<div class = postwords>$posttext</div>";
                    

                echo "</div>";

            }
          
        ?>
    </div>
                

  </body>
</html>