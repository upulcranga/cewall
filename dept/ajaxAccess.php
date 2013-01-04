<?php
    
    /*
    * ajaxAccess.php
    * Handles all the AJAX requests from the index.php
    * Usually responds with XML
    */


    //obtain the database connection
    require_once("databaseAccess.php");
    $db=new databaseAccess();
    $con=$db->initConnection();

    //decode the requests from the client, methods is the request type
    $method=$_GET['method'];
    $lab=$_GET['lab'];
    $type=$_GET['type'];

    /*
    * currentPresence AJAX response
    * the mini staff presence component at the side bar requests the current status(available/away...)
    * an XML will be sent with lecturer's names, their office floor, and the presence
    */
    if(strcmp($method,"currentPresence")==0){
        
        //mysql query to be executed
        $queryString="SELECT name,floor_name,status,CONCAT(presence_type,status_more) AS presence FROM staff JOIN floor ON floor_id=floor.id JOIN presence ON status=presence.id ORDER BY floor.id";
        $query=mysql_query($queryString,$con);
        
        //sending header information first
        header("Content-Type: text/xml");
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
        echo "<presence>";
        //sending data
        while($rec=mysql_fetch_array($query)){
            echo "<staff>";
            echo "<name>$rec[name]</name>";
            echo "<floor>$rec[floor_name]</floor>";
            echo "<statusId>$rec[status]</statusId>";
            echo "<status>$rec[presence]</status>";
            echo "</staff>";
        }
        
        echo "</presence>";
    }
    
    /*
    * currentStatus AJAX response
    * the mini lab component at the side bar requests the current status(occupied/vacant)
    * an XML will be sent with lab names, their situated floor, and the status
    */
    else if(strcmp($method,"currentStatus")==0){
        
        //mysql query to be executed
        $queryString="SELECT lab_name,floor_name,count(r.description) as count FROM lab JOIN floor ON lab.floor_id=floor.id LEFT JOIN (select * from reservation_entry WHERE date(start)=date(now()) and start<=now() and end >= now()) as r ON r.lab=lab.id  GROUP BY lab_name ORDER BY floor_id";
        $query=mysql_query($queryString,$con);
        
        //sending header information first
        header("Content-Type: text/xml");
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
        echo "<status>";
        //sending data
        while($rec=mysql_fetch_array($query)){
            echo "<lab>";
            echo "<name>$rec[lab_name]</name>";
            echo "<floor>$rec[floor_name]</floor>";
            echo "<use>$rec[count]</use>";
            echo "</lab>";
        }
        
        echo "</status>";
    }    
    /*
    * notice update AJAX response
    * text, video or photo notices will be updated time to time at the client side
    * XML response contains, notice location,time,type,caption and publisher
    */
    else if(strcmp($method,'notices')==0){
       
        $queryString="SELECT file_path,time_to_display,notice_type.type as type,caption,notice_by FROM notice_entry JOIN notice_type on notice_entry.type=notice_type.id WHERE display=1";// AND notice_type.type='$type'";
        $query=mysql_query($queryString,$con);
        
        //sending the header information
        header("Content-Type: text/xml");
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
        echo "<notices>";
        
        //sending data
        while($rec=mysql_fetch_array($query)){
            
            if($rec["type"]=="image") echo "<image>"; 
                else if($rec["type"]=="photo") echo "<photo>";
                    else if($rec["type"]=="text") echo "<text>";
                        else if($rec["type"]=="video") echo "<video>";
 
                echo "<src>$rec[file_path]</src>";
                echo "<time>$rec[time_to_display]</time>";
                echo "<caption>$rec[caption]</caption>";
                echo "<by>$rec[notice_by]</by>";             

            if($rec["type"]=="image") echo "</image>"; 
                else if($rec["type"]=="photo") echo "</photo>";
                    else if($rec["type"]=="text") echo "</text>";
                        else if($rec["type"]=="video") echo "</video>";               
        }
        
        echo "</notices>";        
    }
    /*
    * schedule update AJAX response
    * the responce : lab name and reservations
    * one section of AJAX responce contains today's plan and the other contains tomorrow's plan
    */    
    
    else if(strcmp($method,'schedule')==0){
        
        
        $queryString="SELECT id,lab_name FROM lab order by floor_id";
        $query=mysql_query($queryString,$con);

        //sending the header information
        header("Content-Type: text/xml");
        echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
        echo "<schedule>";
        
       while($rec=mysql_fetch_array($query)){
       
       
       //section for todays lab plan     
            echo "<today>";           
            echo "<lab>$rec[lab_name]</lab>";
            
            $queryString="SELECT time(start) as start,time(end) as end,description FROM reservation_entry WHERE date(start)=date(now()) and lab=$rec[id]";
            $query1=mysql_query($queryString,$con);
            
            echo "<events>";
            
            if((mysql_num_rows($query1))==0){
                echo "No Events";
            }
            else{
                $events="";
               while($rec1=mysql_fetch_array($query1)){
                  $events .= date("H:i",strtotime($rec1['start']))."-".date("H:i",strtotime($rec1['end']))." (".$rec1['description'].") , ";
               }
               echo substr($events,0,strlen($events)-2);
            }   
            echo "</events>";
            echo "</today>";
            
       //section for tomorrows lab plan
           
            echo "<tomorrow>";           
            echo "<lab>$rec[lab_name]</lab>";
            
            $queryString="SELECT time(start) as start,time(end) as end,description FROM reservation_entry WHERE date(start)=date(now()) +1  and lab=$rec[id]";
            $query1=mysql_query($queryString,$con);
            
            echo "<events>";
            
            if((mysql_num_rows($query1))==0){
                echo "No Events";
            }
            else{
                $events="";
               while($rec1=mysql_fetch_array($query1)){
                  $events .= date("H:i",strtotime($rec1['start']))."-".date("H:i",strtotime($rec1['end']))." (".$rec1['description'].") , ";
               }
               echo substr($events,0,strlen($events)-2);
            }
            
            echo "</events>";
            echo "</tomorrow>";  
                      
        }
        
        echo "</schedule>";        

    }

?>