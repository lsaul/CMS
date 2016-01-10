 //Initializes TinyMCE editor for textareas
tinymce.init({
    selector: 'textarea',
    plugins: "code"
  }); 

//Uncomment if you decide to use the CK editor, you will need to add IDS to each textarea (maybe do this dynamically through jquery)
/*CKEDITOR.replace('post-edit');*/

$(document).ready(function(){
    
 $('#selectAllBoxes').click(function(event){
     if(this.checked){
         $('.checkBoxes').each(function(){
            this.checked = true; 
         });
          
     }else{
         $('.checkBoxes').each(function(){
            this.checked = false; 
         });
     }
     
     
 });
    

//Loading image thing  
/*var div_box = "<div id='load-screen'><div id='loading'></div></div>";
$("body").prepend(div_box);
    
$('#load-screen').delay(100).fadeOut(600, function(){
   $(this).remove(); 
});*/
    
    
function checkUsersOnline(){
    $.get("functions.php?onlineusers=result", function(data){
        $('.usersonline').text(data);   
 
    });
    
} 

//Runs the checkUsersOnline function on load
checkUsersOnline();
    
//Runs the checkUsersOnline function every .5s
setInterval(function(){
    checkUsersOnline();
}, 500);    

     
    
});