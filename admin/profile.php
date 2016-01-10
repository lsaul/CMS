<?php 
include "includes/admin_header.php"; 

 if(isset($_SESSION['username'])){
     $username = $_SESSION['username'];
     
     $query = "SELECT * FROM users WHERE username = '$username'";
     $select_user_profile_query = mysqli_query($connection, $query);
     
     while($row = mysqli_fetch_array($select_user_profile_query)){
         $user_id = $row['user_id'];
         $username = $row['username'];
         $user_password = $row['user_password'];   
         $user_firstname = $row['user_firstname'];
         $user_lastname = $row['user_lastname'];
         $user_email = $row['user_email'];
         $user_image = $row['user_image']; 
         $user_role = $row['user_role'];
          
     } 
 }  

?>
    
    <?php 

        if(isset($_POST['update_user'])){
          
        
        $user_firstname = htmlspecialchars($_POST['user_firstname'], ENT_QUOTES);
        $user_lastname = htmlspecialchars($_POST['user_lastname'], ENT_QUOTES);
        $user_role = $_POST['user_role']; 
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
         
        //Takes the temporary image holder and moves it to the server
        move_uploaded_file($user_image_temp, "../images/$user_image");
        
         $query = "UPDATE users SET ";
            $query .= "user_firstname = '$user_firstname', ";   
            $query .= "user_lastname = '$user_lastname', ";
            $query .= "user_role = '$user_role', ";
            $query .= "user_email = '$user_email', ";
            $query .= "user_password = '$user_password' "; 
            $query .= "WHERE username = '$username'";
            
            $update_user = mysqli_query($connection, $query);
            confirm_query($update_user);
        
    }
 
?>
     
    <div id="wrapper"> 
           
            <!-- Navigation -->
            <?php include "includes/admin_nav.php"; ?>

                <div id="page-wrapper">

                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Users Admin</h1>
                                 
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
       <label for="username">Username (Cannot be changed)</label>
        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>" disabled>
    </div>
    
    <div class="form-group"> 
       <label for="user_email">Email</label>
        <input class="form-control" type="email" name="user_email" value="<?php echo $user_email; ?>">
    </div>
    
    <div class="form-group"> 
       <label for="user_password">Password</label>
        <input class="form-control" type="password" name="user_password" value="<?php echo $user_password; ?>">
    </div>
 
    <input class="btn btn-primary" type="submit" name="update_user" value="Update Profile">
</form>
                                
                           

                            </div>
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <?php include "includes/admin_footer.php"; ?>