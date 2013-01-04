<?php


 //this php class for making the database connection 
  class databaseAccess{
      
     
      function initConnection(){
          
         $connection=mysql_connect("localhost","cewallreader","asdf123") or die ("Server Error " . mysql_error());
         $database=mysql_select_db("cewall",$connection) or die ("Database Error " . mysql_error()); 
         
         return $connection; 
      }
  }
  
?>
