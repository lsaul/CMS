<?php 
        if(isset($_GET['delete'])){
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                $delete_user_id = mysqli_real_escape_string($connection, $_GET['delete']); 
                $query = "DELETE FROM users WHERE user_id = $delete_user_id";
                $delete_query = mysqli_query($connection, $query);
            }
 
           } 

        if(isset($_GET['change_role'])){
              $update_user_id = $_GET['user_id']; 
              $update_user_role = $_GET['change_role']; 
            
              $query = "UPDATE users SET user_role = '$update_user_role' WHERE user_id = '$update_user_id'";
              $change_role_query = mysqli_query($connection, $query);
             } 
         ?>
                            <table class="table table-bordered table-hover">
                             <thead>
                                 <tr>
                                     <th>Id</th>
                                     <th>Username</th>
                                     <th>Name</th>
                                     <th>Email</th>
                                     <th>Role</th> 
                                     <th>User Image</th>
                                     <th>Change Role</th>
                                     <th>Edit Profile</th>
                                     <th>Delete</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 
<?php 
        $query = "SELECT * FROM users";
        $user_list_query = mysqli_query($connection, $query);
       
        while($row = mysqli_fetch_assoc($user_list_query)){
         $user_id = $row['user_id'];
         $username = $row['username'];
         $user_password = $row['user_password'];   
         $user_firstname = $row['user_firstname'];
         $user_lastname = $row['user_lastname'];
         $user_email = $row['user_email'];
         $user_image = $row['user_image']; 
         $user_role = $row['user_role'];
            
                                         
         echo "<tr>";
         echo "<td>$user_id</td>";
         echo "<td>$username</td>";
         echo "<td>$user_firstname  $user_lastname</td>";
         echo "<td>$user_email</td>";                              
         echo "<td>$user_role</td>";
         
        echo "<td><img class='img-responsive' src='../images/$user_image' alt='' width='100'/></td>";
 
        echo "<td><a href='users.php?user_id=$user_id&change_role=admin'>admin/<br><a href='users.php?user_id=$user_id&change_role=subscriber'>subscriber</i></a></a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'><i class=\"fa fa-pencil-square-o\"></i></a></td>";
           echo "<td><a href='users.php?delete=$user_id'><i class=\"fa fa-times\"></i></a></td>";
           echo "</tr>";
                                     
 } ?>

 
                             </tbody>
                         </table>
                         