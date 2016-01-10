<?php 
 //Uncomment the line below if you have timezone issues
 //date_default_timezone_set('America/New_York');
 //Creates an array with the database values
$db['db_host'] = "localhost";
$db['db_user'] = "uberdesi_cms2";
$db['db_pass'] = "S;w!BgBH5[+{";
$db['db_name'] = "uberdesi_cms";

foreach($db as $key => $value){
    define (strtoupper($key), $value);
}

//The line below this connection value is essentially the same. 
//We are using a foreach loop to change th values above into a constant
//so the key for '$db['db_host'] = 'localhost';' becomes 'DB_HOST', which 
//holds the value you type above, in this case 'localhost'
$connection = mysqli_connect("localhost", "uberdesi_cms2", "S;w!BgBH5[+{", "uberdesi_cms");
//$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($connection){
    }else{
    echo "Error connecting to database";
}







?>