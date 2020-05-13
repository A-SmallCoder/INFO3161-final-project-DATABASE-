<html>
    <head>
        <title>Administration</title>
        <link rel = "stylesheet" type = "text/css" href = "adminStyle.css"/>
    </head>

    <body>

        <div class = header>
            <h1> My Book Administration</h1>
        </div>

        <div class = content>
            <h3>My Book users</h3>
            
            <form action = "#" method = 'POST'>
                <input type = "text" placeholder="search name or user ID" name ="searchbox"/>
                <button type = submit>Search</button>
            </form>

            
            <?php
            require_once '../connect.php';
            $users = "SELECT * FROM User";
            $result = mysqli_query($conn,$users) or die(mysqli_error($conn));
                
            //check for text in textbox
            if(isset($_POST['searchbox'])){
                $search = $_POST['searchbox'];
                    
                //check each record for a match in the id,firstname,lastname column
                while($row = mysqli_fetch_array($result)){
                    if ($row['id'] == $search || $row['Fname'] == $search || $row['lname'] == $search || $row['Fname'] ." ". $row['lname'] == $search){
                            
                        echo "<div class = 'user'>";

                        //show row from user table 
                        echo "$row[Fname] " . "$row[lname], " . "$row[email], " . "$row[DOB]";
                        //kind of a cheat //create form, id set as field value. text field is invisible. button sends value to userinfo page
                        echo "<form action = 'userinfo.php' method = 'post'> <input type = 'text' value ='$row[id]' name='uid'/> <button type = 'submit'>View Details</button></form>";
                            
                        echo "</div>";
                    } 
                }
                
            }
            
            ?>
            
        </div>
        
    </body>
</html>

