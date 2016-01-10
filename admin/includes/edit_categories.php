                    <form action="" method="post">
                                   <div class="form-group">
                                      
                                      <?php 

                                       if(isset ($_GET['edit'])){
                                        $cat_id=$_GET['edit'];   
                                           
                                       $query = "SELECT * FROM categories WHERE cat_id=$cat_id";
                                       $edit_category = mysqli_query($connection, $query);
                                                            
                                            while($row=mysqli_fetch_assoc($edit_category)){
                                              $cat_id = $row['cat_id'];
                                              $cat_title = $row['cat_title'];  
                                            }
                                      } 
                                       
                                       if(isset($_POST['edit_category'])){
                                    $cat_title = $_POST['cat_title'];
                                    $query = "UPDATE categories SET cat_title='$cat_title' WHERE cat_id='$cat_id'";
                                    $edit_cat_query=mysqli_query($connection, $query);
                                        if(!$edit_cat_query){
                                            die("QUERY FAILED" . mysqli_error($connection));
                                        }
                                }
                                       
                                       ?>
                                      
                                      <input class="form-control" type="text" name="cat_title" placeholder="Select Category to Edit" value="<?php if(isset($cat_title)){echo $cat_title;} ?>"> 
                                      
                                       
                                       
                                   </div>
                                    <div class="form-group">
                                       <input class="btn btn-primary" type="submit" name="edit_category" value="Update Category"> 
                                   </div>
                               </form>