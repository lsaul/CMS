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

                    /*if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];
                    }else{
                         header("Location: index.php");
                    }*/
                
                    if(isset($_GET['author'])){
                         $author = $_GET['author'];
                    }else{
                         header("Location: index.php");
                    }
                    $query = "SELECT * FROM posts WHERE post_author = '$author' ";
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
                <h2><?php echo $post_title; ?></h2>
                
                <p class="lead"> by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a></p>
                 
                <p><?php 
                    if($_SESSION['user_role'] == 'admin'){echo "<a href='admin/posts.php?source=edit_post&p_id=$post_id'>Edit Post</a>&nbsp;|&nbsp;";}
                    ?> 
                    <span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <?php echo $post_content; ?>
                <?php  }?>
                
                <hr>
 
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('includes/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>

      <?php include('includes/footer.php');