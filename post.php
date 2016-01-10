<?php
include('includes/header.php');
include('includes/nav.php');
?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               
               <?php 

                    if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];
                  
                    if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){
                        /*$query = "UPDATE posts SET post_views_count = post_views_count +1 WHERE post_id = $post_id";
                $increment_view_count = mysqli_query($connection, $query);*/
                        
                 $query = "SELECT * FROM posts WHERE post_id = $post_id "; 
            }else{
/*                 $query = "UPDATE posts SET post_views_count = post_views_count +1 WHERE post_id = $post_id AND post_status = 'published'";
                 $increment_view_count = mysqli_query($connection, $query);*/

                  $query = "SELECT * FROM posts WHERE post_id = $post_id AND post_status = 'published'";
                    }
                        
  
                    //Uses the connection already setup in the 'db.php' file. 
                    //connects to the database and processes the above query
                    $select_all_posts_query = mysqli_query($connection, $query);
                        
                    while($row=mysqli_fetch_assoc($select_all_posts_query)){
                            $post_title = $row['post_title']; 
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date']; 
                            $post_image = $row['post_image']; 
                            $post_content = html_entity_decode($row['post_content'], ENT_QUOTES); 
                        
                    //if there are no posts in this category display a message
                if(mysqli_num_rows($select_all_posts_query)<1){
                    echo "<h3>Sorry, there were no posts found in that category. How'd you get here anyway?</h3>";
                }else{
                    
                        ?>
  

                <!-- First Blog Post -->
                <h1><?php echo $post_title; ?></h1>
                
                <p class="lead"> by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a></p>
                 
                <p><?php 
                    if($_SESSION['user_role'] == 'admin'){echo "<a href='admin/posts.php?source=edit_post&p_id=$post_id'>Edit Post</a>&nbsp;|&nbsp;";}
                    ?> 
                    <span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <?php echo $post_content; ?>
              
              
                <hr>
                <!-- Blog Comments -->

               <?php 
                
                if(isset($_POST['create_comment'])){
                    
                    global $post_id;
                    
                    $comment_author = htmlspecialcharS($_POST['comment_author'], ENT_QUOTES);
                    $comment_email = $_POST['comment_email'];
                    $comment_content = htmlspecialchars($_POST['comment_content'], ENT_QUOTES);
                     
                    
                    if(!empty($comment_author && $comment_email && $comment_content)){
                       $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                    
                    $query .= "VALUES ('$post_id', '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
        
                    $add_comment_query = mysqli_query($connection, $query);
                    confirm_query($add_comment_query);
                    
 
                   /* $query = "UPDATE posts SET post_comment_count = post_comment_count+1 ";
                    $query .= "WHERE post_id = $post_id";*/
                    
                    $increment_comment_count = mysqli_query($connection, $query);
                    confirm_query($increment_comment_count);
                        
                    $confirm_comment = true;
                    }else{
                        echo "<script>alert('Comment fields cannot be empty. Please check the form and resubmit.');</script>";
                    }
                      
                } 
                
                ?>
               
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="comment_author" placeholder="Author name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="comment_email" placeholder="Author email">
                        </div>
                           
                               
                        <div class="form-group">
                            <textarea class="form-control" name="comment_content" rows="3" placeholder="Comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                    
                    <?php 
                     if($confirm_comment==true){
                            echo "<div class='bg bg-success comment-submitted'><p>Your comment has been submitted. Once it is approved it will appear in the comment section.</p></div>";  
                        }
                     ?>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                   <?php 
                    global $post_id;
                    
                   $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                   $query .= " AND comment_status = 'approved'";
                   $query .= " ORDER BY comment_id DESC ";
                    
                   $select_comment_query = mysqli_query($connection, $query);
                   confirm_query($select_comment_query); 
                    
                        
                    while($row=mysqli_fetch_assoc($select_comment_query)){
                        $comment_date = $row['comment_date'];
                        $comment_content = htmlspecialchars($row['comment_content'], ENT_QUOTES);
                        $comment_author = $row['comment_author']; 
       
                   ?> 
                    
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                       <p><?php echo $comment_content; ?></p>
                    </div>
                    
                   
                    <div class="clear">&nbsp</div>
                
                      
                    <?php 
                      //Ends Media While loop line 149
                     }
                    ?>
                   </div><!--Ends Media Div-->
                   
                   <?php 
                            }
                        
                        }
                       
                     }else{
                         header("Location: index.php");
                    }
                    ?>
            
           <hr></div>
                
            <!-- Blog Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>
            <div class="clear">&nbsp</div>
        </div>
        <!-- /.row -->

        <hr>

      <?php include('includes/footer.php');