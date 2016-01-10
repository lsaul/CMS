 <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">LL CMS Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <?php 
 
                        $query = "SELECT * FROM categories";
                        //Uses the connection already setup in the 'db.php' file. 
                        //connects to the database and processes the above query
                        $select_all_cat_query = mysqli_query($connection, $query);
                        
                        while($row=mysqli_fetch_assoc($select_all_cat_query)){
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            
                            //Variables for giving the active class to the link for the current page 
                            $category_class = ''; 
                            $registration_class = '';
                            $contact_class = '';
                            
                            
                            //Gets the url of the current page                    
                            $pageName = basename($_SERVER['PHP_SELF']);
                            //Sets variables to compare to the pagename for the contact and registration pages
                            $registration = 'registration.php';
                            $contact = 'contact.php';
                            
                            if(isset($_GET['category']) && $_GET['category'] == $cat_id){  
                                $category_class = 'active'; 
                                
                            }else if($pageName == $registration){
                                 $registration_class = 'active';
                            }else if($pageName == $contact){
                                 $contact_class = 'active';
                            }
                            
                            echo "<li class='$category_class'><a href=\"category.php?category=$cat_id\">$cat_title</a></li>";
                        }
                    
                    ?>
                   
				     <li <?php if($registration_class == 'active') echo "class='active'"; ?>>
                        <a href="registration.php">Register</a>
                    </li>
					 <li <?php if($contact_class == 'active') echo "class='active'"; ?>>
                        <a href="contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="admin">Admin</a>
                    </li>
                    
                   <!-- <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li-->>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>