<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/nav.php";

?>

<?php 
   

    if(isset($_POST['submit'])){
                
       $username = $_POST['username'];
       $user_email = $_POST['email'];
       $user_password= $_POST['password'];
       $user_role = $_POST['user_role'];
        
       $username = mysqli_real_escape_string($connection, $username);
       $user_email = mysqli_real_escape_string($connection, $user_email);
       $user_password = mysqli_real_escape_string($connection, $user_password);
      
       $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
        
         
       $query = "INSERT INTO users(username,user_email,user_password, user_role)";
       $query .= "VALUES ('$username', '$user_email','$user_password', '$user_role')";
        
       if(!empty($username && $user_email && $user_password)){
         $add_user_query = mysqli_query($connection, $query); 
         confirm_query($add_user_query);
         $user_registered = 'true';   
           
       }else{
         $user_registered = 'false';  
           /*echo "<script>alert('Please fill out all fields and resubmit the form.');</script>";  */
       }
         
    }

?>
   
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                
                    <?php 
                    if($user_registered=='true'){
                        echo "<div class='bg bg-success user-registered'><p>Thank you for registering.</p></div>";
                    }else if($user_registered=='false'){
                        echo "<div class='bg bg-danger user-registered'><p>Please fill out all of the fields.</p></div>";
                    }
                    ?>
                
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        
                        <div class="form-group">
                            <label for="user_role" class="sr-only">Requested User Role</label>
                            <select class="form-control" name="user_role" id="">
                                <option value="subsciber">Select a user role</option>
                                <option value="admin">Admin</option>
                                <option value="subscriber">Subsciber</option>
                            </select>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
