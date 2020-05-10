<html>
    <head>
        <title>User information</title>
        <link rel = 'stylesheet' type = 'text/css' href = 'adminStyle.css'>
    </head>

    <body>
            <?php
                require_once '../connect.php';
                //gets the id of the user whos button was clicked
                if(isset($_POST['uid'])){
                    $user = $_POST['uid'];

                    //delete button
                    echo "<div class = 'del'><form action = '../delete.php' method = 'post'>";
                    echo "<button>Delete user</button>";
                    echo "</form></div>";
        
                    
            echo "<div class = 'container'>";
            
                //Friends div
                echo "<div class = 'content'><h3>Friends</h3><div>";
                    
                    
                            //select all the user's friend_ids
                            $friends = "SELECT * FROM user WHERE id IN (SELECT friend_id FROM friend WHERE user_id = $user)";
                            $friend_res = mysqli_query($conn,$friends) or die(mysqli_error($conn));

                            //get each field from user for all friends
                            while($row = mysqli_fetch_array($friend_res)){
                                echo "<div class = 'friend'>";
                                echo "$row[id], $row[Fname] $row[lname], $row[email], $row[DOB]";
                                echo "</div>";
                            } 
                        }
                    
                echo "</div></div>";
                
                //Posts div
                echo "<div class = 'content'><h3>Posts</h3><div>";
                    
                    //select post details of each post made by the user
                    $posts = "SELECT post_text,post_image,post_date FROM posts WHERE post_id IN (SELECT post_id FROM make_post WHERE user_id = $user)";
                    $post_res = mysqli_query($conn,$posts) or die(mysqli_error($conn));

                    //get each field from post
                    while($row = mysqli_fetch_array($post_res)){
                        echo "<div class = 'post'>";
                    echo "$row[post_text] " . "$row[post_image]" . "<p><strong>$row[post_date]</strong></p>";
                    echo "</div>";
                    }   
                    
                echo "</div></div>";
                
                //Comments div
                echo "<div class = 'content'><h3>Comments</h3><div>";

                    //select comments and corresponding posts of  made by the user
                    $comments = "SELECT comment.comment_text,posts.post_text,posts.post_image FROM comment INNER JOIN posts ON comment.post_id = posts.post_id WHERE user_id = $user";
                    $comment_res = mysqli_query($conn,$comments) or die(mysqli_error($conn));

                    //get each field from post
                    while($row = mysqli_fetch_array($comment_res)){
                        echo "<div class = 'comment'>";
                        echo "<div><strong>Commented:</strong> $row[comment_text]</div>" . "<div class = cp><strong>On:</strong> $row[post_text]" . "<p>$row[post_image]</p></div>";
                        echo "</div>";
                    } 

                echo "</div></div>";
            

            echo "</div>";
            ?>

    </body>
</html>
