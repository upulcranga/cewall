<?php
    require_once("databaseAccess.php");

  //DeleteData.php
  if(isset($_REQUEST['id'])){
	  delete($_REQUEST['id']);
  }
  else{
	  echo("No Argument");
  };

  /* Delete a record by id */ 
function delete($id){
                                       
    $db = new databaseAccess(); // create $obj object
    $dbConnection = $db->initConnection();    // calling getCon() function using $obj object     
    mysql_query("BEGIN" ,$dbConnection);
  
    $query1="DELETE FROM `notice_entry` WHERE `id`=$id";
    $query1Result=mysql_query($query1) or die ("MySql Error".mysql_error());
   
    if($query1Result==1){        
        mysql_query("COMMIT");
		echo("ok");
        //header("location:".$_POST['requestPage']);

    }
    else{
        mysql_query("ROLLBACK");
    }  
}


?>