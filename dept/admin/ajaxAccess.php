<?php
require_once("databaseAccess.php");

$db=new databaseAccess();
$dbConnection = $db->initConnection();

$method=$_GET['method'];
$date=$_GET['date'];
$start=$_GET['start'];
$end=$_GET['end'];
$lab=$_GET['lab'];
$description=$_GET['description'];

$staff=$_GET['staff'];
$presence=$_GET['presence'];
$backAt=$_GET['backAt'];

if($method=='date'){
    
    $response="";
    
    $queryString="SELECT  time(start) as start, time(end) as end,description FROM reservation_entry WHERE  date(start)='$date' and date(end)='$date' and lab='$lab' ORDER BY start";
    $query=mysql_query($queryString,$dbConnection);
    
    while($rec=mysql_fetch_array($query)){
        $response.="<tr><td>From ".$rec['start']."</td><td>To ".$rec['end']."</td><td>".$rec['description']."</td></tr>";
    }
echo $response;    
}
else if($method=='reserve'){
 
     $response="";
    
    $queryString="SELECT COUNT(id) AS count FROM reservation_entry WHERE NOT('$start'<start AND '$end'<=start) AND NOT('$start'>=end AND '$end'> end)";
    $query=mysql_query($queryString,$dbConnection); 
    $rec=mysql_fetch_array($query);
    
    if($rec['count']==0){
        $queryString="INSERT INTO reservation_entry(lab,start,end,description) VALUES ($lab,'$start','$end','$description')";
        mysql_query($queryString,$dbConnection);
        echo "0";
    }  
    else{
        echo "-1";
    } 
}
else if($method=='staff'){
    $queryString="UPDATE staff SET status=$presence , status_more='$backAt' where id=$staff";
    $query=mysql_query($queryString,$dbConnection);
}
?>