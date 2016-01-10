<?php 
            if(isset($_GET['delete'])){
                $delete_comment_id = $_GET['delete']; 
                $query = "DELETE FROM comments WHERE comment_id = $delete_comment_id";
                $delete_query = mysqli_query($connection, $query);
                header("Location: comments.php");
                            } 

            if(isset($_GET['unapprove_comment'])){
                $unapprove_comment_id = $_GET['unapprove_comment']; 
                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '$unapprove_comment_id'";
                $unapprove_comment_query = mysqli_query($connection, $query);
                header("Location: comments.php");
              } 

            if(isset($_GET['approve_comment'])){
                $approve_comment_id = $_GET['approve_comment']; 
                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '$approve_comment_id'";
                $unapprove_comment_query = mysqli_query($connection, $query);
                header("Location: comments.php");
              }

                            ?>
                            <table class="table table-bordered table-hover">
                             <thead>
                                 <tr>
                                     <th>Id</th>
                                     <th>Author/email</th>
                                     <th>Comment</th> 
                                     <th>Status</th>
                                     <th>Commented on</th>
                                     <th>Date</th>
                                     <th>Approve</th>
                                     <th>Delete</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 
<?php 
        $query = "SELECT * FROM comments";
        $comment_list_query = mysqli_query($connection, $query);
       
        while($row = mysqli_fetch_assoc($comment_list_query)){
         $comment_id = $row['comment_id'];
         $comment_post_id = $row['comment_post_id'];
         $comment_author = $row['comment_author'];
         $comment_email = $row['comment_email'];                                
         $comment_content = $row['comment_content'];
         $comment_status = $row['comment_status'];
         $comment_date = $row['comment_date'];
 
         echo "<tr>";
         echo "<td>$comment_id</td>";
         echo "<td>" . $comment_author . "<br>" . $comment_email . "</td>";
         echo "<td>$comment_content</td>";
         echo "<td>$comment_status</td>"; 
        
        $query = "SELECT * FROM posts WHERE post_id=$comment_post_id";
        $select_post_id_query = mysqli_query($connection, $query); 
            
        while($row=mysqli_fetch_assoc($select_post_id_query)){ 
         $post_id = $row['post_id'];    
         $post_title = $row['post_title'];  
              } 
            
         echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
         echo "<td>$comment_date</td>"; 
         echo "<td><a href='comments.php?approve_comment=$comment_id'><i class=\"fa fa-plus-square\" title=\"approve\"></i></a> / <a href='comments.php?unapprove_comment=$comment_id'><i class=\"fa fa-minus-square\"></i></a></td>";
        
            echo "<td><a href='comments.php?delete=$comment_id'><i class=\"fa fa-times\"></i></a></td>";
            
           echo "</tr>";
                                     
 } ?>

 
                             </tbody>
                         </table>
                         