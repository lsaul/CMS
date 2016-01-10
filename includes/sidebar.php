        <div class="col-md-4">
            
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" type="submit" class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form><!--end search form-->
                    <!-- /.input-group -->
                </div>
                
                <!--Login Form-->
                <div class="well">
                   
                   <!--Shorthand versions of if/else/endif-->
                   <?php if(isset($_SESSION['user_role'])): ?>
                       <h4>Logged in as <?php echo $_SESSION['username'];?></h4>
                       <a href="includes/logout.php" class="btn btn-primary">Logout</a>
                   <?php else: ?>
                         <h4>User login</h4>

                      <form action="includes/login.php" method="post">
                         <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Enter Username">
                         </div>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                         <span class="input-group-btn">
                             <button class="btn btn-primary" name="login" type="submit">Login</button>
                         </span>
                         
                    </div>
                    </form><!--end search form-->
                   <?php endif; ?>
                   
                   
                   
                     <?php 
                     $login = $_GET['login'];
                     if($login=='false'){
                         echo "<br><p style=\"color: #cc0000;\">Incorrect username or password</p>";
                     }
                    
                    ?>
                    <!-- /.input-group -->
                </div>
                
 
                
                
                <!-- Blog Categories Well -->
                <div class="well">
                   
                   
                   <?php 
 
                        $query = "SELECT * FROM categories";
                        //Uses the connection already setup in the 'db.php' file. 
                        //connects to the database and processes the above query
                        $select_categories_sidebar = mysqli_query($connection, $query);
 
                    ?>
                    
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                 <?php 
                                                 while($row=mysqli_fetch_assoc($select_categories_sidebar)){
             $cat_title = $row['cat_title'];
             $cat_id = $row['cat_id'];
             echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                                            }

                            ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
              
                    </div>
                    <!-- /.row -->
                </div>

               <?php 
                include "widget.php";
                    ?>

            </div>