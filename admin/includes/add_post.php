<?php 
    if(isset($_SESSION['username'])){
        $author = $_SESSION['username'];
    }else{
        header('Location: ../index.php');
    }
 
    if(isset($_POST['create_post'])){
        
        $post_title = escape($_POST['title']);
        $post_category_id = $_POST['post_category'];
        $post_author = $author;
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_tags = htmlspecialchars($_POST['post_tags'], ENT_QUOTES);
        $post_content = htmlspecialchars($_POST['post_content'], ENT_QUOTES);
        $post_date = date('d-m-y');
        /*$post_comment_count = 4;*/
        
        //Takes the temporary image holder and moves it to the server
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        
        $query .= "VALUES('$post_category_id', '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status') ";
        
        $add_post_query = mysqli_query($connection, $query);
        
        confirm_query($add_post_query);
        
        
        //Gets the last ID posted to the database
        $the_post_id = mysqli_insert_id($connection);
         
        //New functionality to retrieve the recently posted article and display a link to view it
        /*$query = "SELECT * FROM posts WHERE post_title = '$post_title'";
        $retrieve_recent_post = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($retrieve_recent_post)){
                                        
                $post_id = $row['post_id'];
               
              }*/
        
        
        
    }
    
?>
   
<h4>Add Post</h4>

<?php 

    if(isset($the_post_id)){
        echo "<div class='bg-success'><h3>Post Added: " . "<a href='../post.php?p_id=$the_post_id'>View Post</a></h3></div><hr>";
    }


?>

 
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group"> 
        <input class="form-control" type="text" name="title" placeholder="Post Title">
    </div>
    
    <div class="form-group"> 
       <label for="post_category">Post Category</label>
        <select class="form-control" name="post_category" id="">
            <?php 
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            
            confirm_query($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
            
                echo "<option value=\"$cat_title\">$cat_title</option>";    
            }
            
                              
                ?>
        </select>
        
        
    </div>
    
   <!-- <div class="form-group"> 
        <input class="form-control" type="text" name="post_category_id" placeholder="Post category ID">
    </div>-->
    
    <div class="form-group"> 
       <label for="author">Post Author</label>
        <input class="form-control" type="text" name="author" value="<?php echo $author; ?>" disabled>
    </div>
    
    <div class="form-group"> 
        <label for="post_status">Post Status</label>
        <select class="form-control" name="post_status" id="">
            <option value="Draft">Draft</option>
            <option value="Published">Published</option>
        </select>
    </div>
    
    <div class="form-group"> 
        <label for="post_image">Post Image</label>
        <input class="form-control" type="file" name="image">
    </div>
    
    <div class="form-group"> 
        <input class="form-control" type="text" name="post_tags" placeholder="Post Tags">
    </div>
    
    <div class="form-group"> 
        <textarea class="form-control" id="post-edit" cols="30" rows="10" type="text" name="post_content" placeholder="Post Content"></textarea>
    </div>
    
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</form>