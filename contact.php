<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/nav.php";

?>

<?php 

    if(isset($_POST['submit'])){
 
        
       $to = 'lsaul@uberdesign.org';
       $email = $_POST['email'];
       $subject = wordwrap($_POST['subject'], 70); 
       $body = wordwrap($_POST['message'], 100);
       $header = "From: " . $email;
            
       if(!empty($email && $subject && $body)){
         // send email
        mail($to, $subject, $body, $header);
         $message_submitted = 'true';   
           
       }else{
         $message_submitted = 'false';  
        
       }
         
    }

?>
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                
                    <?php 
                    if($message_submitted=='true'){
                        echo "<div class='bg bg-success message-sent'><p>Your message has been sent.</p></div>";
                    }else if($message_submitted=='false'){
                        echo "<div class='bg bg-danger message-sent'><p>Please fill out all fields before submitting your message.</p></div>";
                    }
                    ?>
                
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>
           
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="contact-message" cols="30" rows="10" placeholder="Enter Your message"></textarea>
                        </div>   
                    
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Message">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
