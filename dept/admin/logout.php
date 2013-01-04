<?php
 session_start();    

require_once("databaseAccess.php");
 
          //    $db = new databaseAccess(); // create $obj object
          //   $dbConnection = $db->initConnection();    // calling getCon() function using $obj object 
          //    $queryString="UPDATE users SET is_logged_in=0 WHERE username='".$_SESSION["valid_user_name"]."'"; 
        
        //   mysql_query($queryString,$dbConnection) or die("MySql Error ".mysql_error()); // Execute query
 
        session_destroy();
        header("location:index.php?info=4");
?>