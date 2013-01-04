<html>

<title>CEWall-Admin</title>
   
    <head>
        <link rel="stylesheet" type="text/css" href="styles/styles.css">
        <script type="text/javascript" src="plugins/jquery.js"></script>
        <script type='text/javascript' src="plugins/titleAnimation.js"></script>

    </head>


<body>

    <div id="welcomeContainer" class= "welcomeContainer" >
  
    <div class="loginForm">
      <table  border = "0" align = "center" cellpadding = "15" cellspacing = "1" >
            <tr>
                <form  method = "post" action = "login.php">
                    <td>
                        <table border = "0" cellpadding = "4" cellspacing = "1" >
                            <tr>
                                <td colspan = "3"><strong>Member Login </strong></td>
                            </tr>

                            <tr>
                                <td >Username</td>
                                <td >:</td>
                                <td ><input name = "username" type = "text" id = "username"</td>
                            </tr>

                            <tr>
                                <td>Password</td>
                                <td>:</td>
                                <td><input name = "password" type = "password" id = "password"></td>
                                <td><input type = "submit" name = "Submit" value = "Login"></td>
                            </tr>

                        </table>
                    </td>
                </form>
            </tr>
        </table>
        </div>
</div>

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
            
    </div> 
    <!-- End of the title -->


    
</body>
</html>