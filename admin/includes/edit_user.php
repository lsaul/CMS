<?php 
 if(isset($_GET['edit_user'])){
     $edit_user_id = $_GET['edit_user'];
     
     $query = "SELECT * FROM users WHERE user_id=$edit_user_id";
     $get_user_info_query = mysqli_query($connection, $query);
     confirm_query($get_user_info_query);
     
     while($row=mysqli_fetch_assoc($get_user_info_query)){
         $user_firstname = $row['user_firstname'];
         $user_lastname = $row['user_lastname'];
         $user_role = $row['user_role'];
         $username = $row['username'];
         $user_email = $row['user_email'];
         $user_password = $row['user_password'];
        
     }
      
 }else{
     header("Location: index.php");
 }    

    if(isset($_POST['update_user'])){
        
        
        $user_firstname = htmlspecialchars($_POST['user_firstname'], ENT_QUOTES);
        $user_lastname = htmlspecialchars($_POST['user_lastname'], ENT_QUOTES);
        $user_role = $_POST['user_role'];
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
         
        //Takes the temporary image holder and moves it to the server
        move_uploaded_file($user_image_temp, "../images/$user_image");
        
         /* echo "<script>alert('User Password is: $user_password');</script>";
        
         */
        
        //Checks the password posted to the form against the password in the database, then assigns the database password to a variable $db_user_password 
        if(!empty($user_password)){
            $query_password = "SELECT user_password FROM users WHERE user_id = $edit_user_id";
            $get_user_query = mysqli_query($connection, $query_password);
            //confirmQuery($get_user_query);
            
            $row = mysqli_fetch_array($get_user_query);
            $db_user_password = $row['user_password'];
        }
        
        //We are checking to see if the user is updating their password, if so, then we are encrypting it
        if($db_user_password != $user_password){
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
        }
 
         $query = "UPDATE users SET ";
            $query .= "user_firstname = '$user_firstname', ";   
            $query .= "user_lastname = '$user_lastname', ";
            $query .= "user_role = '$user_role', ";
            $query .= "username = '$username', ";
            $query .= "user_email = '$user_email', ";
            $query .= "user_password = '$user_password' "; 
            $query .= "WHERE user_id = $edit_user_id";
            
            $update_user = mysqli_query($connection, $query);
            confirm_query($update_user);
              
            $updated_user = true;   
 
    }
    
?>
   
<h4>Edit User</h4>
   
<?php 
    if($updated_user){
        echo "<div class='bg-success'><h3>User Updated! <a href='users.php'>View All Users</a></h3></div><hr>";
    }
    
?>   
<form action="" method="post" enctype="multipart/form-data">
 
    
    <div class="form-group"> 
       <label for="user_firstname">First Name</label>
        <input class="form-control" type="text" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>
    
    <div class="form-group"> 
       <label for="user_lastname">Last Name</label>
        <input class="form-control" type="text" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>
    
   
    
  <!--  <div class="form-group"> 
        <label for="user_image">Username</label>
        <input class="form-control" type="file" name="user_image">
    </div>-->
     
    <div class="form-group"> 
        <label for="user_role">Change User Role</label>
        <select class="form-control" name="user_role" id="">
            <option value="<?php echo $user_role; ?>" selected>
                <?php
                    if($user_role==admin){echo "Admin";}
                    else if($user_role==subscriber){echo "Subscriber";}
                ?>
            </option>
            <?php 
                
                if($user_role==admin){
                    echo "<option value=\"subscriber\">Subscriber</option>";
                }else if($user_role==subscriber){
                    echo "<option value=\"admin\">Admin</option>";
                }
            
            ?>
 
        </select>
        
        
    </div>
    
    <div class="form-group"> 
       <label for="username">Username</label>
        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
    </div>
    
    <div class="form-group"> 
       <label for="user_email">Email</label>
        <input class="form-control" type="email" name="user_email" value="<?php echo $user_email; ?>">
    </div>
    
    <div class="form-group"> 
       <label for="user_password">Password</label>
        <input class="form-control" type="password" name="user_password" value="<?php echo $user_password; ?>">
    </div>
 
    <input class="btn btn-primary" type="submit" name="update_user" value="Update" User">
</form>