<?php

session_start();

if ($_SESSION["valid_type"]!=1)
{
        // User not logged in, redirect to login page
        Header("Location:index.php");
}
?>

<html>

<title>CEWall-Admin</title>
   
    <head>
        <link rel="stylesheet" type="text/css" href="styles/styles.css">        
        <script type="text/javascript" src="plugins/jquery.js"></script>
        <script type='text/javascript' src="plugins/titleAnimation.js"></script>

        <script type="text/javascript">
        
            function switchTextBox(){
                if(document.getElementById("status").options[2].selected ){
                    document.getElementById("backAt").disabled=false;
                }
                else{
                    document.getElementById("backAt").disabled=true;
                    document.getElementById("backAt").value="";
                }
                
            }
        
            function update(){
                
                var xmlhttp;
                
                //ajax starts here!
                if(window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
                }
                else{
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }                

            xmlhttp.onreadystatechange=function(){

                if(xmlhttp.readyState==4 && xmlhttp.status==200){
                    window.location.reload();
                }
            }
            
            presence=document.getElementById("status").options[document.getElementById("status").selectedIndex].value;
            staff="";
            backAt=document.getElementById('backAt').value;
                
            for(i=0;i<document.getElementsByName("staff").length;i++){

                if(document.getElementsByName("staff")[i].checked){
                    staff=document.getElementsByName("staff")[i].value;
                    break;
                }
           }     

                xmlhttp.open("GET","ajaxAccess.php?method=staff&staff="+staff+"&presence="+presence+"&backAt="+backAt,true);
                xmlhttp.send();
                    
           
            } 
        </script>
        
    </head>


<body>

            <div class="bodyContainer">
            
            <?php
            require_once("databaseAccess.php");
            $db=new databaseAccess();
            $dbConnection = $db->initConnection();
            
            $queryString="SELECT staff.id,name,presence_type,status_more FROM staff JOIN presence ON staff.status=presence.id";
            $queryString1="SELECT id,presence_type FROM presence";
            
            $query=mysql_query($queryString,$dbConnection);
            $query1=mysql_query($queryString1,$dbConnection);
            
            $optionList="";
            while($rec1=mysql_fetch_array($query1)) $optionList.="<option value='$rec1[id]'>$rec1[presence_type]</option>";

            ?>
            
                    <div class="form">
                        <form><table align="center" width="60%" cellpadding="4" cellspacing="1">
                            <thead><td></td><td>Name</td><td>Current Status</td></thead>
                            <tr><td colspan="3"><hr/></td></tr>
                                <?php
                                    $i=0;
                                    while($rec=mysql_fetch_array($query)){
                                        $i++;
                                        echo "<tr>";
                                        if($i==1)
                                            echo "<td><input type='radio' name='staff' checked value='$rec[id]' /></td>";
                                        else
                                            echo "<td><input type='radio' name='staff' value='$rec[id]' /></td>";
                                        echo "<td>$rec[name]</td><td>$rec[presence_type]$rec[status_more]</td></tr>";
                                    }
                                ?>                            
                            
                        </table></form>
                        
                        <hr/>
                         <table align="center" width="60%" cellpadding="4" cellspacing="1">
                            <tr><td colspan="3"><b>Change the status</b></td></tr>
                            <tr>
                                <td><?php echo "<select id='status' onchange='switchTextBox()'>$optionList</select>"; ?></td>
                                <td><input type="text" maxlength="5" size="5" id="backAt" disabled="true"/></td>
                                <td><button onclick="update()">Update</button></td>
                            </tr>
                         </table>
                        
                    </div>
            </div>

          
    <!-- Sidebar  -->
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
    <!-- End of the title --> </div>
</div>
    
</body>
</html>