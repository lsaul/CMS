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
                            Welcome to admin
                            <small><?php echo $post_author; ?></small>
                        </h1>

                                <!--start add category form-->
                                <div class="col-sm-6">
                                    <?php insert_categories(); ?>

                                        <form action="" method="post">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="cat_title" placeholder="Enter Category Name">

                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                            </div>
                                        </form>

                                        <?php 
                                //UPDATE AND INCLUDE 
                               if(isset($_GET['edit'])){
                                $cat_id= $_GET['edit'];
                                include "includes/edit_categories.php";
                               
                               }
                               
                               ?>


                                </div>
                                <!--end add category form-->


                                <div class="col-sm-6">


                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Delete</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            find_all_categories();
                                            delete_category();
                                            ?>

                                        </tbody>
                                    </table>

                                </div>

                                <!-- ADMIN BREAD CRUMB-->
                                <!--
                           <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>-->



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