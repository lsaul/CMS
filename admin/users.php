<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <?php 
        if($connection){
            /*echo "<p style='color: white;'>We're connected.</p>";*/
        }else{
            echo "Connection error";
        }

        $query = "SELECT * FROM posts LIMIT 1"; 
        $author_query = mysqli_query($connection, $query);
        while($row=mysqli_fetch_assoc($author_query)){
            
            $post_author = $row['post_author'];
        } 

        ?>

            <!-- Navigation -->
            <?php include "includes/admin_nav.php"; ?>

                <div id="page-wrapper">

                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">
                            Users Admin
                            <small>Logged in as <?php echo $post_author; ?></small>
                        </h1>
                          <?php 


                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                                
                            }else{
                                $source = "";
                            }
                            
                             switch($source){
                             case 'add_user';
                             include('includes/add_user.php'); 
                             break;
                           
                             case 'edit_user';
                             include('includes/edit_user.php'); 
                             break;
                          
                              
                             default:
                             //displays the entire post list if a specific post hasn't                                //been selected
                             include('includes/view_all_users.php');  
                             
                             break;  
                             
                             }

                            ?>

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