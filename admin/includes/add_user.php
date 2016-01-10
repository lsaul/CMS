<?php 
    
    if(isset($_POST['create_user'])){
        //Gets the username email and password before anything else
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        
        if(!empty($username && user_email && $user_password)){
            
        $user_firstname = htmlspecialchars($_POST['user_firstname'], ENT_QUOTES);
        $user_lastname = htmlspecialchars($_POST['user_lastname'], ENT_QUOTES);
        $user_role = $_POST['user_role'];
       
        
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
        
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        
         
        //Takes the temporary image holder and moves it to the server
        move_uploaded_file($user_image_temp, "../images/$user_image");
        
        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";
        
        $query .= "VALUES('$user_firstname', '$user_lastname', '$user_role', '$username', '$user_email', '$user_password') ";
        
        $add_user_query = mysqli_query($connection, $query);
        
        confirm_query($add_user_query);
        
        echo "<h3>User created:" . " " . "<a href='users.php'>View Users</a></h3><hr>";
  
        }else{
             echo "<div class='bg bg-danger insert-failed'><h4>Warning, failed to add user. Make sure all fields are filled out.</h4></div><hr>";
        }
    }
    
?>
   
<h4>Add User</h4>
 
<form action="" method="post" enctype="multipart/form-data">
 
    
    <div class="form-group"> 
        <input class="form-control" type="text" name="user_firstname" placeholder="First Name" value="">
    </div>
    
    <div class="form-group"> 
        <input class="form-control" type="text" name="user_lastname" placeholder="Last Name">
    </div>
    
   
    
  <!--  <div class="form-group"> 
        <label for="user_image">Username</label>
        <input class="form-control" type="file" name="user_image">
    </div>-->
    
    
    
        
    <div class="form-group"> 
        <select class="form-control" name="user_role" id="">
             <option value="subscriber">Select User Role</option>
             <option value="admin">Admin</option>
             <option value="subscriber">Subscriber</option>
        </select>
        
        
    </div>
    
    <div class="form-group"> 
        <input class="form-control" type="text" name="username" placeholder="Username">
    </div>
    
    <div class="form-group"> 
        <input class="form-control" type="email" name="user_email" placeholder="Email">
    </div>
    
    <div class="form-group"> 
        <input class="form-control" type="password" name="user_password" placeholder="Password">
    </div>
 
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
</form>