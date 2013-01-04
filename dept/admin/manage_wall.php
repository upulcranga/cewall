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
        
		<style type="text/css" media="screen">
			@import "plugins/ui/smoothness/jquery-ui-1.9.1.custom.css";
			 @import "plugins/datatableeditable/demo_table_jui.css";
			/*
						 * Override styles needed due to the mix of three different CSS sources! For proper examples
						 * please see the themes example in the 'Examples' section of this site
						 */
			.dataTables_info {
				padding-top: 0;
			}
			.dataTables_paginate {
				padding-top: 0;
			}
			.css_right {
				float: right;
			}
			#example_wrapper .fg-toolbar {
				font-size: 0.8em
			}
			#theme_links span {
				float: left;
				padding: 2px 10px;
			}
			.time_to_display{
				text-align:center;
			}
		
		</style>
               
		<script src="plugins/jquery.js" type="text/javascript"></script>
		<script src="plugins/datatableeditable/jquery.dataTables.min.js" type="text/javascript"></script>
		<script src="plugins/datatableeditable/jquery.dataTables.editable.js" type="text/javascript"></script>
		<script src="plugins/datatableeditable/jquery.jeditable.js" type="text/javascript" ></script>
		<script src="plugins/ui/js/jquery-ui-1.9.1.custom.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="plugins/timepicker/jquery.timePicker.js"></script>
		<script type='text/javascript' src="plugins/jquery.validate.js"></script>
        <script type='text/javascript' src="plugins/titleAnimation.js"></script>

		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				var id = -1;//simulation of id

				$('#example').dataTable({ bJQueryUI: true,
							bAutoWidth:false,
							sScrollY:"300px",
							sScrollX:"100%",
							sScrollYInner:"100%",
							"sPaginationType": "full_numbers",
							"bProcessing": true,
        					"bServerSide": true,
        					"sAjaxSource": "dataTable.php"
					}).makeEditable({
										sUpdateURL: function(value, settings)
										{
                             				return(value); //Simulation of server-side response using a callback function
										},
                                    	sDeleteHttpMethod: "GET",
										sDeleteURL: "DeleteData.php",
										"aoColumns": [
												{cssclass: "required"},
												{},
												{
													indicator: 'Saving platforms...',
													tooltip: 'Click to edit platforms',
													type: 'textarea',
													submit:'Save changes'
												},
												{	sWidth: '10px',
													indicator: 'Saving Engine Version...',
													tooltip: 'Click to select engine version',
													loadtext: 'loading...',
													type: 'select',
													onblur: 'cancel',
													submit: 'Ok',
													loadurl: 'EngineVersionList.php',
													loadtype: 'GET',
													cssclass: 'time_to_display'
												},
												{
													indicator: 'Saving CSS Grade...',
													tooltip: 'Click to select CSS Grade',
													loadtext: 'loading...',
													type: 'select',
													onblur: 'submit',
													data: "{'':'Please select...', 'A':'A','B':'B','C':'C'}"
												}
											],
										oDeleteRowButtonOptions: {	label: "Remove", 
																	icons: {primary:'ui-icon-trash'}
											},
										sAddDeleteToolbarSelector: ".dataTables_length"								

											});
				
			} );
		</script>

    </head>


<body>

            <div class="bodyContainer">

                    
<div class="full_width">
<div class="tablebox">
          <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
              <tr>
        <th>ID</th>
        <th>Caption</th>
        <th>Posted<br>By</th>
        <th>Display<br>Time</th>
        <th>Show<br>On</th>
        <th>Hide<br>After</th>
        <th>Display</th>
      </tr>
            </thead>
    <tfoot>
              <tr>
        <th>ID</th>
        <th>Caption</th>
        <th>Posted<br>By</th>
        <th>Display<br>Time</th>
        <th>Show<br>On</th>
        <th>Hide<br>After</th>
        <th>Display</th>
       </tr>
            </tfoot>
    <tbody>

            </tbody>
  </table>
  </div>
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