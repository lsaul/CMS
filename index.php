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
                    //Setting to show limited number of posts per page    
                    $per_page = 5;
                
                    //Gets the page number to show the appropriate posts
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        
                    }else{
                        $page = "";
                    }
                
                    //Calculates which posts should be displayed on the page, based on per page post count $per_page above
                    if($page == "" || $page == 1){
                        $page_1 = 0;
                    }else{
                        $page_1 = ($page*$per_page) - $per_page;
                    }
                    
                    //Prevents unauthorized users from seeing posts in draft status, displays all posts to admin users
                      if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){ 
                  //Gets all posts if user is admin
                  $query = "SELECT * FROM posts";
                    }else{ 
                  //Gets only published posts if user is not admin           
                  $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    }  
                
                
                    
                    $post_count_query = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($post_count_query);
                
                    if($count<1){
                        echo "<h3>Sorry, no posts where found.</h3>";
                    }else{
                    $count = ceil($count/$per_page);
                     
                    $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1,$per_page ";
                    //Uses the connection already setup in the 'db.php' file. 
                    //connects to the database and processes the above query
                    $select_all_posts_query = mysqli_query($connection, $query);
                        
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
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p>
                <?php 
                    if($_SESSION['user_role'] == 'admin'){echo "<a href='admin/posts.php?source=edit_post&p_id=$post_id'>Edit Post</a>&nbsp;|&nbsp;";}
                    ?> 
                    <span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
               <?php echo $post_content; ?>
                <br> 
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr> 
        <?php    
                      }//ends if statement
                    }//ends 'while' loop
                ?>
               
  
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <ul class="pager">
            <?php 
            
             for($i=1; $i<= $count; $i++){
                if($page==$i){$active='active';}else{$active='';}
                echo  "<li";
                if(!empty($active)){
                echo " class='$active'";
                } 
                echo "><a href='index.php?page=$i'>$i</a></li>"; 
             }
                
            ?>
        </ul>

      <?php include('includes/footer.php');