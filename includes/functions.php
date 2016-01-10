<?php 
function confirm_query($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
       }
    
}
?>