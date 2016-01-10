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

                    if(isset($_GET['category'])){
                        $post_category_id = $_GET['category'];
                    }else{
                        header("Location: index.php");
                    }
                        
                    if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){ 
                        
                $query = "SELECT * FROM posts WHERE post_category_id=$post_category_id "; 
            }else{ 
                  $query = "SELECT * FROM posts WHERE post_category_id=2 AND post_status = 'published'";
                    }  
                        
                   // $query = "SELECT * FROM posts WHERE post_category_id=$post_category_id";
                    //Uses the connection already setup in the 'db.php' file. 
                    //connects to the database and processes the above query
                    $select_all_posts_query = mysqli_query($connection, $query);
                //if there are no posts in this category display a message
                if(mysqli_num_rows($select_all_posts_query)<1){
                    echo "<h3>Sorry, there were no posts found in that category. How'd you get here anyway?</h3>";
                }else{
                        
                    while($row=mysqli_fetch_assoc($select_all_posts_query)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title']; 
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date']; 
                            $post_image = $row['post_image']; 
                            $post_content = substr($row['post_content'],0,155); 
                            $post_content = html_entity_decode($post_content, ENT_QUOTES); 
                        ?>
                           
                        <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
               <?php echo $post_content; ?>
                
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                           
 
        <?php       }//end if statement
                }//end while statement
                ?>
               
 
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>

      <?php include('includes/footer.php');