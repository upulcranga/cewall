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
		<link rel="stylesheet" type="text/css" href="plugins/ui/smoothness/jquery-ui-1.9.1.custom.css">     
        <script type="text/javascript" src="plugins/jquery.js"></script>
        <script type="text/javascript" src="plugins/ui/js/jquery-ui-1.9.1.custom.js"></script>
        <script type="text/javascript" src="plugins/timepicker/jquery.timePicker.js"></script>
        <script type='text/javascript' src="plugins/titleAnimation.js"></script>
		<script type='text/javascript' src="plugins/jquery.validate.js"></script>
        
          <script type="text/javascript">
			$(document).ready(function() {
				
				$("#show_on_container").hide();//Hide show_on text box at the initial
				$("#hide_after_container").hide();//Hide hide_after text box at the initial				
				$('input:radio').click(function() { // When click on show on radio
						if ($(this).val()=="show_now")
							$("#show_on_container").hide();
						else if($(this).val()=="show_later")
							$("#show_on_container").show();
						else if($(this).val()=="hide_never")
							$("#hide_after_container").hide();
						else if($(this).val()=="hide_after")
							$("#hide_after_container").show();
    			});
				
				$( "#show_on" ).datepicker({
					dateFormat:"yy-mm-dd",
				});
				$( "#hide_after" ).datepicker({
					dateFormat:"yy-mm-dd",
				});
				
			  $("#upload_file").validate({
				rules: {
					show_on:{
						required: "[value='show_later']:checked",
						dateISO: true
				
					},
					hide_after:{
						required: "[value='hide_after']:checked",
						dateISO: true
				
					},					
				  	upload_by: "required",// simple rule, converted to {required:true}
					time_to_display:{
							required:true,
							number: true,
							max:30
						},
					caption: {
							required: true
						}
				},
				messages: {
				  caption: "Please enter a caption."
				}
			  });
			});
		  </script>
    </head>


<body>

            <div class="bodyContainer">
                    
                    <div class="form">
                         <form id="upload_file" action="upload.php" method="POST" enctype="multipart/form-data">
                         
                         <table align="center" width="60%" cellpadding="4" cellspacing="1" >
                                
                                <input type="hidden" name="requestPage" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                    
                                <tr>
                                <td align="center"><input name="uploadType" value="image" type="radio" checked="true">Image Document Upload</input>
                                &nbsp
                                <input name="uploadType" value="video" type="radio">Video Upload</input></td>
                                </tr>
                                <tr><td><hr/></td></tr>
                                <tr>
                                <td align="center"><input type="file" name="file" id="file" />
                                </td>
                                
                                </tr>
                                
                                <tr><td><hr/></td></tr>
                         </table>
                         
                         <table align="center" width="60%" cellpadding="4" cellspacing="1" class="topalign" >
                         
                            <tr>
                                <td>Upload by</td><td>:</td>
                                <td><input type="text" name="upload_by" id="upload_by" style="width:100%" required /></td>
                            </tr> 

                            <tr>
                                <td >Show</td><td >:</td>
                                <td>
                                <div class="radioSpilters">
                                	<input  type="radio" id="show_on_radio" name="show_on_radio" value="show_now" checked validate="required:true" /><label>Now</label>
                                </div>
                                <div class="radioSpilters">
                                	<input  type="radio" id="show_on_radio"name="show_on_radio"  value="show_later" /><label>Later</label>
                                </div>
								<div id="show_on_container"><input type="text" name="show_on" id="show_on" style="width:100%" /></div></td>
                            </tr> 
                            <tr>
                                <td>Hide</td><td >:</td>
                                <td>
                                	<div class="radioSpilters">
                                    	<input  type="radio" id="hide_after_radio" name="hide_after_radio" value="hide_never" checked validate="required:true" /><label>Never</label>
                                </div>
                                <div class="radioSpilters">
                                	<input  type="radio" id="hide_after_radio" name="hide_after_radio"  value="hide_after"/>
                                	<label>On</label></div>
                                <div id="hide_after_container"><input type="text" name="hide_after" id="hide_after" style="width:100%" /></div>
                                </td>
                            </tr>                             
                            <tr>
                                <td>Time to show(seconds)</td><td>:</td>
                                <td><input type="text" name="time_to_display" id="time_to_display" style="width:100%"/></td>
                            </tr>
                            
                            <tr>
                                <td>Caption</td><td>:</td>
                                <td><input type="text" name="caption" id="caption" style="width:100%"required /></td>
                            </tr>
                            
                            <tr>
                                <td>Show</td><td>:</td>
                                <td><input type="checkbox" name="display" id="display" checked="true"/></td>
                            </tr>
                            
                            <tr>
                                <td colspan="2"><input type="submit" name="upload" id="upload" value="Upload"/></td>
                            </tr>                         
                         </table>
                            
                            
                       
                        </form> 

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
    <!-- End of the title -->
    
</body>
</html>