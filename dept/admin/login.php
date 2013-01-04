<?php

  require_once("databaseAccess.php");
      
      
  $username=$_POST["username"];
  $password=$_POST["password"];
  
  
   /*** if(($username=="")||($password==""))
    {
        header("location:index.php?info=1");
    }
    else
    {***/

        
        $db = new databaseAccess(); // create $obj object
        $dbConnection = $db->initConnection();    // calling getCon() function using $obj object 
        
        $queryString=sprintf("SELECT * FROM user WHERE username='%s' and password=md5('%s')",mysql_real_escape_string($username),$password); 
        // %s for characters(strings) and %d for numbers
        
        $query = mysql_query($queryString,$dbConnection) or die("MySql Error".mysql_error()); // Execute query
        $noOfRaws = mysql_num_rows($query); // to check is there any out put when execute the $query 
        
        //echo $nor;
        
        if($noOfRaws==1)
        {
            
            $rec =  mysql_fetch_assoc($query);
         /***   $dbPass = $rec["password"];***/
            
           /*** if($rec["user_type"]!=4){  
                if($dbPass == md5($password) && $rec["is_active"]>0 && $rec["email_notified"]==1 && $rec["is_logged_in"]==0)
                {
                    
                    //check for access terminated staff or manager login
                    if($rec["user_type"]==1 || $rec["user_type"]==2){
                            $queryStringForTermination="SELECT working_status FROM ".($rec["user_type"]==2?"staff":"managers")." where username='".$rec["username"]."'";
                            $queryForTermination=mysql_query($queryStringForTermination) or die("MySql Error ".mysql_error());
                            
                            $recForTermination=mysql_fetch_array($queryForTermination);
                            
                                if($recForTermination["working_status"]==0){
                                    header("location:index.php?info=9");
                                    die();
                                }                        
                    }
                    
                    $queryString="UPDATE users SET is_active=3,is_logged_in=1,last_activity=now() WHERE username='".mysql_real_escape_string($username)."'";
                    mysql_query($queryString) or die ("MySql Error ".mysql_error());
                        ***/ 
                          session_start();  
                           
                                    $_SESSION["valid_type"] = $rec["type"];
                                    $_SESSION["valid_user_name"] = $rec["username"];
                          /**         $_SESSION["lastAction"] = time();
                                    
                   $queryStringForParameters="SELECT * FROM parameters";
                   $queryForParameters=mysql_query($queryStringForParameters) or die("MySql Error ".mysql_error());
                   $recForParameters=mysql_fetch_assoc($queryForParameters);
                                    
                                    $_SESSION["timeOut"]=$recForParameters['time_out'];
                                    $_SESSION["netWeight"]=$recForParameters['minimum_net_weight'];
                                    $_SESSION["advanced"]=$recForParameters['minimum_advanced_amount'];
                                    $_SESSION["payment"]=$recForParameters['minimum_payment'];
                  ***/                  
                          if($rec["type"]==1){
                          
                         //**   $queryString="SELECT name FROM managers WHERE username='".$rec["username"]."'";
                         //**   $query=mysql_query($queryString) or die("MySql Error".mysql_error());
                            
                         //**   $rec=mysql_fetch_array($query);
                         //**   $_SESSION["valid_user"] = $rec["name"];   
                                                       
                            header("location:upload_file.php");
                        }
                  /***       else if($rec["user_type"]==2){
                                                      
                            $queryString="SELECT name FROM staff WHERE username='".$rec["username"]."'";
                            $query=mysql_query($queryString) or die("MySql Error".mysql_error());
                            
                            $rec=mysql_fetch_array($query);
                            $_SESSION["valid_user"] = $rec["name"];  
                                                                                    
                            header("location:staff/home.php?info=1");
                        }
                        else if($rec["user_type"]==3){
                            
                            $queryString="SELECT name FROM customers WHERE nic='".$rec["username"]."'";
                            $query=mysql_query($queryString) or die("MySql Error".mysql_error());
                            
                            $rec=mysql_fetch_array($query);
                            $_SESSION["valid_user"] = $rec["name"];                              
                            
                            header("location: customer/home.php?info=1");
                        }
                }
                else if($rec["is_logged_in"]==1){
                    header("location:index.php?info=10");
                }
                else if($rec["email_notified"]==0)
                {
                    header("location:index.php?info=6");
                }
                else if($dbPass != md5($password) && $rec["is_active"]>0)
                {
                    
                    $queryString="UPDATE users SET is_active=(is_active-1) WHERE username='".mysql_real_escape_string($username)."'";
                    mysql_query($queryString) or die ("MySql Error ".mysql_error());
                    
                    if($rec["is_active"]>1)
                    header("location:index.php?info=2");
                    else
                    header("location:index.php?info=5");
                }
                else if($rec["is_active"]==0)
                {
                    header("location:index.php?info=5");
                }
                else
                {
                    header("location:index.php?info=2");
                }
            }
           else if($rec["user_type"]==4 && $dbPass == md5($password)){//Admin
                                    session_start();  
                                    $_SESSION["valid_type"] = $rec["user_type"];
                                    $_SESSION["valid_user_name"] = $rec["username"];
                                    $_SESSION["lastAction"] = time();              
                                    $_SESSION["timeOut"]=100;
                                    $_SESSION["valid_user"] = "Admin";                              
          
            header("location:admin/home.php?info=1");
            }
            else{
             header("location:index.php?info=2");               
            }  ***/
        }
        else
        {
           header("location:index.php?info=1"); // this happens when there is no user name
        }
    /***}***/

    
?>
