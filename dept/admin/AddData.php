<?php

    require_once("databaseAccess.php");
    
    $type=$_POST['uploadType'];
    $notice_by=$_POST['upload_by'];
    $caption=$_POST['caption'];
    $time=$_POST['time_to_display'];
    $display=$_POST['display']=="on"?1:0;
    $show_on=$_POST['show_on_radio'];
	$hide_after=$_POST['hide_after_radio'];
	$show_on_date=$_POST['show_on'];
	$hide_after_date=$_POST['hide_after'];
	
    $date=new DateTime();
    $file_path = "upload/$type/".$date->getTimestamp().($type=='text'?".html":".".end(explode('.', $_FILES["file"]["name"])));     //variable to store file upload status
    $upload_status=-1;
    
    //upload the file to the server and insert entry to the database
    upload($type,$notice_by,$caption,$time,$file_path,$display,$show_on,$hide_after,$show_on_date,$hide_after_date);


function upload($type,$notice_by,$caption,$time,$file_path,$display,$show_on,$hide_after,$show_on_date,$hide_after_date){
                                            
    $db = new databaseAccess(); // create $obj object
    $dbConnection = $db->initConnection();    // calling getCon() function using $obj object     
    mysql_query("BEGIN" ,$dbConnection);
  
    $query1="INSERT INTO notice_entry(type,notice_by,caption,time_to_display,file_path,display";
	
	//If show on date provided, include show_on entry
	if($show_on=="show_later") $query1.=",show_on";
	//If hide after date provided, include show_on entry
	if($hide_after=="hide_after") $query1.=",hide_after";	
	
	 $query1.=") VALUES ((SELECT id FROM notice_type WHERE type='$type'),'$notice_by','$caption', $time, '$file_path' , $display ";

	//If show on date provided, include show_on entry
	if($show_on=="show_later") $query1.=",'".$show_on_date."'";
	//If hide after date provided, include show_on entry
	if($hide_after=="hide_after") $query1.=",'".$hide_after_date."'";;
	 
	 $query1.=")";
    $query1Result=mysql_query($query1) or die ("MySql Error".mysql_error());
  
   
    if($query1Result==1){        
        mysql_query("COMMIT");
        //header("location:".$_POST['requestPage']);
		echo("123568");

    }
    else{
        mysql_query("ROLLBACK");
    }  
}