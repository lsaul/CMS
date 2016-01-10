<?php 
session_start();

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim(htmlspecialchars($string, $ENT_QUOTES)));
}


function confirm_query($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
       }
    
}

function insert_categories(){
    global $connection;
                               //Code for checking submit/post to determine whether to add or edit a category
                               if(isset($_POST['submit'])){
                                  $cat_title = $_POST['cat_title'];
                                  if($cat_title=="" || empty($cat_title)){
                                    echo "<p>Please enter a category name.</p>";
                                  }else{
                                    $query = "INSERT INTO categories(cat_title) ";
                                    $query .= "VALUE('$cat_title')";  
                                    $create_category=mysqli_query($connection, $query);
                                      
                                    if(!$create_category){
                                       
                                        die('QUERY FAILED' . mysqli_error($connection));
                                    }
                                  }
                               
                               }

}

function find_all_categories(){
            global $connection;
            
            //FIND ALL CATEGORIES
                                $query = "SELECT * FROM categories";
                                $select_categories=mysqli_query($connection, $query);

                                    while($row=mysqli_fetch_assoc($select_categories)){
                                          $cat_id=$row['cat_id'];
                                          $cat_title=$row['cat_title'];
                                          echo "<tr>";
                                          echo "<td class=\"cat_id\">$cat_id</td>";
                                          echo "<td class=\"cat_name\">$cat_title</td>";
                                          echo "<td><a href='categories.php?delete=$cat_id'>&nbsp;<i class=\"fa fa-close\"></i></a></td>";
                                        echo "<td><a href='categories.php?edit=$cat_id'>&nbsp;<i class=\"fa fa-pencil-square-o\"></i></a></td>";
                                          echo "</tr>";      
                                    }


}

function delete_category(){
    global $connection;
    //DELETE QUERY
    if(isset($_GET['delete'])){
        $cat_id_delete = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = $cat_id_delete";
        $delete_category = mysqli_query($connection, $query);
        header("location: categories.php");
         }
}

function users_online(){
    
  if(isset($_GET['onlineusers'])){
    global $connection;
    global $count_user;
        
   if(!$connection){
    session_start();
    include("../includes/db.php");
             
    $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;
        
    $query = "SELECT * FROM users_online WHERE session = '$session'";   
    $users_online_query = mysqli_query($connection, $query);
        
    $count = mysqli_num_rows($users_online_query);
    
    if($count==NULL){
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
    }else{
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }
        
    $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'"); 
    echo $count_user = mysqli_num_rows($users_online);
    
    }
  }
}

users_online();

?>