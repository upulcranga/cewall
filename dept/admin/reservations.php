<?php

session_start();

if ($_SESSION["valid_type"]!=1)
{
        // User not logged in, redirect to login page
        Header("Location:index.php");
}

  require_once("databaseAccess.php"); 
        $db = new databaseAccess(); // create $obj object
        $dbConnection = $db->initConnection();    // calling getCon() function using $obj object 
?>

<html>

<title>CEWall-Admin</title>
   
    <head>
        <link rel="stylesheet" type="text/css" href="styles/styles.css">        
        <script type="text/javascript" src="plugins/jquery.js"></script>
        <script type='text/javascript' src="plugins/titleAnimation.js"></script>

        <!-- Date picker -->
        <link href="plugins/calendar/calendar.css" type="text/css" rel="stylesheet" />
        <script type='text/javascript' src="plugins/calendar/calendar.js"></script>
        <script type="text/javascript">
        
        var xmlhttp;
        
        function init(){
                calendar.set("date");
                $("#from").timePicker();
                $("#to").timePicker();
        
        
        //ajax starts here!
        if(window.XMLHttpRequest){
            xmlhttp=new XMLHttpRequest();
        }
        else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        }
        
        function getReservationsByDate(){
            setTimeout("delayedGetReservationsByDate()",200);
        }
        
        function delayedGetReservationsByDate(){
            
            xmlhttp.onreadystatechange=function(){
                
                
                if(xmlhttp.readyState==4 && xmlhttp.status==200){
                    xmlResponse=xmlhttp.responseText;
                    document.getElementById('currentReservations').innerHTML=xmlResponse;
                }
            }
            
            date=document.getElementById("date").value;
            room=document.getElementById("room").options[document.getElementById("room").selectedIndex].value;
            xmlhttp.open("GET","ajaxAccess.php?method=date&date="+date+"&lab="+room,true);
            xmlhttp.send();
            
        
        }
        
        function reserve(){
            xmlhttp.onreadystatechange=function(){
                
                
                if(xmlhttp.readyState==4 && xmlhttp.status==200){
                    xmlResponse=xmlhttp.responseText;
                    if(xmlResponse=='0'){
                        alert("Reservation successful.");
                        window.location="reservations.php";
                    }
                    else{
                        alert("Reservation FAILED. Overlap detected.");
                    }             
                                        
                }
            }
            
            date=document.getElementById("date").value;
            room=document.getElementById("room").options[document.getElementById("room").selectedIndex].value;
            from=date+" "+document.getElementById("from").value+":00";
            to=date+" "+document.getElementById("to").value+":00";
            description=document.getElementById("description").value;        
            xmlhttp.open("GET","ajaxAccess.php?method=reserve&start="+from+"&end="+to+"&lab="+room+"&description="+description,true);
            xmlhttp.send();            
        }
        
        
         </script> 
         
         <!-- Time Picker-->
        <script type="text/javascript" src="plugins/timepicker/jquery.timePicker.js"></script>
        <link rel="stylesheet" type="text/css" href="plugins/timepicker/timePicker.css">           
    </head>


<body onload="init()">

            <div class="bodyContainer">
            
                    <div class="overlay"></div>
                    
                    <div class="form">
                        <form action="" method="post">
                            <table align="center" cellpadding="4" cellspacing="1" width="60%">
                            
                            <tr>
                                <td>Reservation Date</td><td>:</td>
                                <td><input type="text" id="date" name="date" style="width:100%" onblur="getReservationsByDate()"/></td>
                            </tr>

                            <tr>
                                <td>Room To Be Reserved</td><td>:</td>
                                <td><select name="room" id="room" style="width:100%" onchange="getReservationsByDate()">
       <?php
                                            
        $queryString="SELECT * from lab"; 
        // %s for characters(strings) and %d for numbers       
        $query = mysql_query($queryString,$dbConnection) or die("MySql Error ".mysql_error()); // Execute query
        
        while($rec=mysql_fetch_array($query)){
            echo "<option value='".$rec['id']."'>".$rec['lab_name']."</option>";
        }
        ?>
                                </select></td>
                            </tr>

                            <tr>
                                <td>From</td><td>:</td>
                                <td><input type="text" id="from" name="from" size="10" onblur=""/></td>
                            </tr>

                            <tr>
                                <td>To</td><td>:</td>
                                <td><input type="text" id="to" name="to" size="10" /></td>
                            </tr>                                                                       

                            <tr>
                                <td>Description</td><td>:</td>
                                <td><input type="text" id="description" name="description" style="width:100%" onblur=""/></td>
                            </tr>

                            <tr>
                                <td><input type="button" value="Reserve" onclick="reserve()"/></td>
                            </tr>
                                         
                            </table>
                        </form>

                    <br/>
                    <table align="center" cellpadding="4" cellspacing="1" width="60%" id="currentReservations">
                    </table>    
                        
                    </div>
                    
 

            </div>
          
<    <!-- Sidebar  -->
    <div id="sidebarContainer" class= "sidebarContainer">
    
            <!-- Component --> 
            <div class='sidebarComponentContainer'>
                <div class='sidebarComponentTitle'>
                    Notices
                </div>
                <div class='sidebarComponentBody' >
                    <a href="upload_file.php">Upload A File To Wall</a>
                    <a href="upload_text.php">Upload Text To Wall</a>
                    <a href="manage_wall.php">Manage Wall</a>
                </div>
            </div> 
            <!-- end of component --> 
            
            <!-- Component --> 
            <div class='sidebarComponentContainer'>
                <div class='sidebarComponentTitle'>
                    Photos
                </div>
                <div class='sidebarComponentBody' >
                    <a href="upload_photos.php">Upload Wall Photos</a>
                    <a href="manage_photos.php">Manage Photos</a>
                </div>
            </div> 
            <!-- end of component --> 

            <!-- Component --> 
            <div class='sidebarComponentContainer'>
                <div class='sidebarComponentTitle'>
                    Reservation
                </div>
                <div class='sidebarComponentBody' >
                    <a href="reservations.php">Make Reservations</a>
                    <a href="manage_reservations.php">Manage Reservations</a>
                </div>
            </div> 
            <!-- end of component -->             
 
            <!-- Component --> 
            <div class='sidebarComponentContainer'>
                <div class='sidebarComponentTitle'>
                    Staff
                </div>
                <div class='sidebarComponentBody' >
                    <a href="staff_presence.php">Presence</a>
                </div>
            </div> 
            <!-- end of component -->  
            
    </div>
    <!-- End of Sidebar -->

          
    <!-- Title of the site -->
    <div id="titleContainer" class= "titleContainer" >


            <div class='titleContent'>

            <table class="titleTable" >
                <!-- Title of the page -->
                <tr id="title"></tr>
                <!-- End of the title -->
            </table>    
            
            </div>
            
            <div class="catogory">
                <table>
                    <!-- Notice category and its icon -->
                    <tr><td><img id='catogoryImage' src='icons/user.png'/></td>
                    <td id='catogoryTitle'>CEWall Backend</td></tr>
                    <!-- End of notice category -->
                </table>
            </div> 

            <div class="logout">
             
             <table align="right">
            <tr>
                <td>Hello <?php echo $_SESSION["valid_user_name"];?></td>
                <td> | </td>
                <td align="right"><a href="logout.php">Log out</a></td>
            </tr></table>
              
              </div>            

            
    </div> 
    <!-- End of the title -->
    
</body>
</html>