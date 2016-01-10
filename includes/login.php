<?php 
include ('db.php');
include ('functions.php');

session_start();

if(isset($_POST['login'])){
     $username = $_POST['username'];
     $password = $_POST['password'];
    
     $username = mysqli_real_escape_string($connection, $username);
     $password = mysqli_real_escape_string($connection, $password);
    
     /*echo $username;
     echo $password;*/
    
     $query = "SELECT * FROM users WHERE username = '$username'";
     $select_user_query = mysqli_query($connection, $query);
    
     confirm_query($select_user_query);
    
     while($row=mysqli_fetch_array($select_user_query)){
         $db_user_id = $row['user_id'];
         $db_user_password = $row['user_password'];
         $db_username = $row['username'];
         $db_user_firstname = $row['user_firstname'];
         $db_user_lastname = $row['user_lastname'];
         $db_user_role = $row['user_role'];  
     }
 
     //$password = crypt($password, $db_user_password);
    
    //Logic for detecting whether the inputted password matches what is set in the database. If it matches, then send them to admin.
   if(password_verify($password, $db_user_password)){
        
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['user_role'] = $db_user_role;
        
        header("Location: ../admin/"); 
    }else{ 
        header("Location: ../index.php?login=false"); 
        
    } 
    
    
}





?>