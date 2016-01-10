<?php 
       //Checks for delete request and sends it
       if(isset($_GET['delete'])){
          $delete_post_id = $_GET['delete']; 
          $query = "DELETE FROM posts WHERE post_id = $delete_post_id";
          $delete_query = mysqli_query($connection, $query);
          } 

        //Checks for reset request and sends it
       if(isset($_GET['reset'])){
          $reset_post_id = $_GET['reset']; 
          $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $reset_post_id) . " ";
          $reset_views_query = mysqli_query($connection, $query);
          } 
 
       //Checks for bulk changes 
       if(isset($_POST['checkBoxArray'])){
            $bulk_options = $_POST['bulk_options'];
           
            foreach($_POST['checkBoxArray'] as $postIdValue){
                 //echo "Post ID value: " . $postIdValue;
                 
                 switch($bulk_options){
                    case 'published':
                    $query = "UPDATE posts SET post_status = 'Published' WHERE post_id = $postIdValue";
                    $bulk_publish_posts = mysqli_query($connection, $query);
                   //confirmQuery breaks loop for some reason, do not make active without correcting
                   // confirmQuery($bulk_publish_posts);
                  
                    break;
                
                    case 'draft':
                    $query = "UPDATE posts SET post_status = 'Draft' WHERE post_id = $postIdValue";
                    $bulk_draft_posts = mysqli_query($connection, $query);
                   // confirmQuery($bulk_draft_posts);
                         
                         //echo 'Post Id value <strong>' . $postValue . '</strong> changed to published<br>';
                    break;
                    
                    case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = $postIdValue";
                    $bulk_delete_posts = mysqli_query($connection, $query);
                   // confirmQuery($bulk_delete_posts);
                         
                         //echo 'Post Id value <strong>' . $postValue . '</strong> changed to published<br>';
                    break;
                    
                    case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = $postIdValue";
                    $select_post_query = mysqli_query($connection, $query);
                    
                    while($row=mysqli_fetch_array($select_post_query)){
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                        
                    }
                         
                    $query = "INSERT INTO posts(post_category_id, post_title, post_date, post_author, post_status, post_image, post_tags, post_content) ";     
                    $query .= "VALUES($post_category_id, '$post_title', now(), '$post_author', '$post_status', '$post_image', '$post_tags', '$post_content')";
                    $copy_query = mysqli_query($connection, $query);
                        
                       if(!$copy_query){
                        die("QUERY FAILED" . mysqli_error($connection));
                    } 
                         
                    break;
                         
                     default:
                     break;
                            
                    } 
                
                   
                }
            }
     

 ?>
                            
                            <form action="" method="post">
                                <table class="table table-bordered table-hover">
                                 
                                <div id="bulkOptionsContainer" class="col-xs-4">
                                <select class="form-control" name="bulk_options" id="">
                                    <option value="">Select Options</option>
                                    <option value="published">Publish</option>
                                    <option value="draft">Draft</option>
                                    <option value="delete">Delete</option>
                                    <option value="clone">Clone</option>
                                </select>     
                                     
                                 </div>
                                 <div class="col-xs-4">
                                     <input class="btn btn-success" type="submit" name="submit" value="Apply"><a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
                                 </div>
                                
                                <thead>
                                 <tr>
                                     <th><input id="selectAllBoxes" type="checkbox"></th>
                                     <th>Id</th>
                                     <th>Author</th>
                                     <th>Title</th>
                                     <th>Category</th>
                                     <th>Status</th>
                                     <th>Image</th>
                                     <th>Tags</th>
                                     <th>Comments</th>
                                     <th>Date</th>
                                     <th>View/Edit</th>
                                     <th>Delete</th>
                                     <th>Views/Reset</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 
<?php 
        $query = "SELECT * FROM posts";
        $post_list_query = mysqli_query($connection, $query);
       
        while($row = mysqli_fetch_assoc($post_list_query)){
         $post_id = $row['post_id'];
         $post_cat_id = $row['post_category_id'];
         $post_title = $row['post_title'];
         $post_author = $row['post_author'];
         $post_date = $row['post_date'];
         $post_image = $row['post_image'];
         $post_content = $row['post_content']; 
         $post_tags = $row['post_tags'];
         $post_status = $row['post_status'];
         $post_views_count = $row['post_views_count'];                                
                                         
         echo "<tr>";
         ?>
          
        <td><input class='checkBoxes' type='checkbox' name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>  
         
           <?php 
            
         echo "<td>{$post_id}</td>";
         echo "<td>{$post_author}</td>";
         echo "<td>{$post_title}</td>";
                                         
                                         
        $query = "SELECT * FROM categories WHERE cat_id=$post_cat_id";
        $edit_category = mysqli_query($connection, $query);
                                                            
                                                         
        while($row=mysqli_fetch_assoc($edit_category)){
         $cat_id = $row['cat_id'];
         $cat_title = $row['cat_title'];  
              } 
                                         
          echo "<td>{$cat_title}</td>";
                                         
           echo "<td>{$post_status}</td>";
           echo "<td><img class='img-responsive' src='../images/$post_image' alt='' width='100'/></td>";
           echo "<td>{$post_tags}</td>";
            
           //queries the comment table and checks to see how many comments match the current post
           $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
           $comment_count_query = mysqli_query($connection, $query);
           $post_comment_count = mysqli_num_rows($comment_count_query);    
            
           //Uses the query to get the id of the post that the comment was made on     
           $row = mysqli_fetch_array($comment_count_query);
           $comment_id = $row['comment_id'];
           $count_comments = mysqli_num_rows($comment_count_query);
            
            
           echo "<td><a href='comments.php?source=post_comments&id=$post_id'>$post_comment_count</a></td>";
           
            
            echo "<td>{$post_date}</td>";
           echo "<td><a href='../post.php?p_id=$post_id'><i class='fa fa-eye'></i></a>&nbsp;|&nbsp;<a href='posts.php?source=edit_post&p_id=$post_id'><i class=\"fa fa-pencil-square-o\"></i></a></td>";
           echo "<td><a onclick=\"return confirm('Are you sure you want to delete &quot;$post_title&quot;?')\" href='posts.php?delete=$post_id'><i class=\"fa fa-times\"></i></a></td>";
            echo "<td>{$post_views_count} | <a onclick=\"return confirm('Are you sure you want to reset views count?')\" href='posts.php?reset=$post_id'><i class='fa fa-circle-o-notch'></i></a></td>";
 echo "</tr>";
                                     
 } ?>

                                 
                             </tbody>
                         </table>
                            </form>
                         