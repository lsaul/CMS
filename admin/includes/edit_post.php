<?php 
 
        if(isset($_GET['p_id'])){
            $the_post_id = $_GET['p_id'];
            
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_posts_by_id = mysqli_query($connection, $query);
            confirm_query($select_posts_by_id);
                
            while($row = mysqli_fetch_assoc($select_posts_by_id)){
                                        
                $post_id = $row['post_id'];
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
           
                $post_content = $row['post_content'];
                $post_comment_count = $row['post_comment_count'];
                $post_tags = $row['post_tags'];
                $post_status = $row['post_status'];
              }
 }

        if(isset($_POST['update_post'])){
         
            $post_author = $_POST['post_author'];
            $post_title = htmlspecialchars($_POST['post_title'], ENT_QUOTES);
            $post_category_id = $_POST['post_category_id'];
            $post_status = $_POST['post_status']; 
        
            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
        
            $post_content = htmlspecialchars($_POST['post_content'], ENT_QUOTES); 
            $post_tags = $_POST['post_tags'];
        
            move_uploaded_file($post_image_temp, "../images/$post_image");
            if(empty($post_image)){
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                $select_image = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_array($select_image)){
                    $post_image = $row['post_image'];
                }
                
            }
        
            $query = "UPDATE posts SET ";
            $query .= "post_author = '$post_author', ";   
            $query .= "post_title = '$post_title', ";
            $query .= "post_category_id = '$post_category_id', ";
            $query .= "post_status = '$post_status', "; 
            $query .= "post_image = '$post_image', ";
            $query .= "post_content = '$post_content', ";
            $query .= "post_tags = '$post_tags', ";
            $query .= "post_date = now() ";
            $query .= "WHERE post_id = $the_post_id";
            
            $update_post = mysqli_query($connection, $query);
            confirm_query($update_post);
            
            echo "<div class='bg-success'><h3>Post Updated: " . "<a href='../post.php?p_id=$the_post_id'>View Post</a> or <a href='posts.php'>Edit another post</a> </h3></div><hr>";
    }

?>

                                         
                                                                                                                           
<h4>Edit Post</h4>
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group"> 
        <label for="post_title">Post Title</label>
        <input class="form-control" type="text" name="post_title" value="<?php echo $post_title ?>">
    </div>
    
    <div class="form-group"> 
       <label for="post_category_id">Post Category</label>
        <select class="form-control" name="post_category_id" id="">
            <?php 
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            
            confirm_query($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
            
                echo "<option value=\"$cat_id\"";
                if($post_category_id==$cat_id){
                  echo "selected";
                }
                echo ">$cat_title</option>";    
            }
            
                              
                ?>
        </select>
        
        
    </div>
    
    <div class="form-group"> 
        <label for="post_author">Post Author</label>
        <input class="form-control" type="text" name="post_author" placeholder="Post Author" value="<?php echo $post_author; ?>" disabled>
    </div>
    
      
      <div class="form-group">
           <label for="post_status">Post status</label>
           <select class="form-control" name="post_status" id="">
           <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
           
           <?php 
               if ($post_status == 'Published'){
                   echo "<option value='Draft'>Draft</option>";
               }else{
                   echo "<option value='Published'>Published</option>";
               }
               
               
               ?>
           
           
           </select>
      </div>
       
       
       
    
    
    <div class="form-group">
       <img src="../images/<?php echo $post_image; ?>" alt="" width="150"><br>
        <label for="post_image">Post Image</label>
        <input class="form-control" type="file" name="image">
    </div>
    
    <div class="form-group"> 
        <input class="form-control" type="text" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    
    <div class="form-group"> 
        <textarea class="form-control" id="" cols="30" rows="10" type="text" name="post_content"><?php echo $post_content; ?></textarea>
    </div>
    
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
</form>