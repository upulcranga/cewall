<!---------------------------------------------------------------

CEWall 1.0
==========
Idea and Supervision : Dr. Roshan Ragel

Look and Feel Ideas : Isuru Nawinne, Mahanama Wickramasinghe, Vajira Thambawita

Coding : Kalindu Herath

Final Edit : 2012.07.02

Previous Versions:
1.0 without AJAX
0.9(did not launched - appearence did not meet standards)

----------------------------------------------------------------->
<html>

<!-- Title of the page -->
<title>CEWall - Tell it in a new way</title>

<head>
        <!--imports for sliding and jQuery -->
        <script type="text/javascript" src="plugins/jquery.js"></script>
        <script type="text/javascript" src="plugins/jquery.color.js"></script>
        <script type="text/javascript" src="plugins/jquery.scrollTo-min.js"></script>

        <!--imports for clock -->
        <script type="text/javascript" src="plugins/clock/clock.js"></script>
        <link rel="stylesheet" type="text/css" href="plugins/clock/styles.css">
        
        <!--imports style sheet --> 
        <link rel="stylesheet" type="text/css" href="styles/styles.css">
        
        <!--imports javascript actions of the notice board -->
        <script type="text/javascript" src="scripts/lab.js"></script>
        <script type="text/javascript" src="scripts/staff.js"></script>
        <script type="text/javascript" src="scripts/weather.js"></script>
        
        
        <script type="text/javascript" src="scripts/slideshow.js"></script>
        <script type="text/javascript" src="scripts/notices.js"></script>
        <script type="text/javascript" src="scripts/news.js"></script>
        <script type="text/javascript" src="scripts/memories.js"></script>
        <script type="text/javascript" src="scripts/schedule.js"></script>
    
    <!-- Main control logic of the notice board -->
    <script type="text/javascript">
        
        var TITLE;  //holds the title of the page
        var TITLE_ANIMATE_RATE=5000; //title animation interval in milliseconds
        
        var WELCOME_DELAY=7000;
        
        var COLORS=new  Array("#4444AA" , "#229B22" ,"#b5335F","#028482","#7B3c84" ); //holds the color for each state
        
        var state=0;   //holds the state of the wall. Ex: 0-notices 1-news...
        var NOTICE_STATE=0,NEWS_STATE=1,LAB_STATE=2,MEMORIES_STATE=3;
        
        var AJAX_SIDEBAR_UPDATE_RATE=2,AJAX_SLIDESHOW_UPDATE_RATE=4; //cache update rates in minutes e.x. for every 2 minutes the state of the labs is checked
        
        /*
        * init
        * initialization of the notice wall, preparing the wall for all notices
        */
        function init(){
            
                    //initialize the page title
                    TITLE="Computer Engineering ";
                    for(i=0;i<TITLE.length;i++){
                         document.getElementById("title").innerHTML += "<td class='title'>" + TITLE.substr(i,1) + "</td>";
                    }
                    //start animation of the title and circulate the animation
                    animateTitle();

                    //for the first time take current status of all the labs,and repeat in intervals                    
                    updateLabStatus(function(){
                        //after receiving all the status data, begin the display process
                        showLabStatus(0);
                        
                            updateStaffStatus(function(){
                                showStaffStatus(0);
                            });
                        
                        //activate weather component
                        updateWeather();
                        //also send a request to update the notices cache for the first time
                        updateNotices();
                    });                 
                    //show welcome screen
                    welcome(function(){
                        //start the slide show, see slideshow.js
                        slideshow();
                        
                    });            
        }
        
        /*
        * animateTitle
        * do a continuous animation for the site title
        */
        function animateTitle(){
            $(".title").each(function(index){
                $(this).delay(50*index).fadeTo("medium",0.3);
            
            });

            $(".title").each(function(index){
                $(this).delay(25*index).fadeTo("medium",1);
            
            });
            
            setTimeout("animateTitle()",TITLE_ANIMATE_RATE);
        }
        
        /*
        * welcome
        * Showing a welcome message and hides it, prepare the main wall interface
        */
        function welcome(callback){
                 
                //add content for the welcome message            
                $("#welcomeContainer").fadeTo(1,0,function(){
                innerWelcome="<div class='overlay'></div>";
                innerWelcome+="<div id='wrapper'>";
                innerWelcome+="<div class='content'><div class='inner' align='center'>";
                innerWelcome+="<div class='catogoryPage'><div style='position:relative;top:40%;'>Welcome to CE</div>";
                innerWelcome+="</div></div></div></div>";
                
                    document.getElementById("welcomeContainer").innerHTML=innerWelcome;
                });
                
                   //fade in the welcome message       
                   $("#welcomeContainer").fadeTo(2000,1,function(){

                                //wait and fade out the welcome message 
                                $("#welcomeContainer").delay(WELCOME_DELAY).fadeTo(2000,0,function(){
                                        //fade in the sidebar
                                       $("#sidebarContainer").fadeTo(1500,1,function(){changeColor();callback();});

                                       //center the clock
                                        sidebarWidth=document.getElementById("sidebarComponentContainer").clientWidth;
                                        clockWidth=document.getElementById("clockContainer").clientWidth;
                                        document.getElementById("clockContainer").style.marginLeft=(sidebarWidth-clockWidth)/2;
 
                                });         
                            });       
        }
        
        /*
        * changeColor
        * a common method for changing theme color. changes title bar color, heading color, catogory title color etc
        * ex: notices:blue, news:green
        */
        function changeColor(){
            $('.titleContainer').animate({backgroundColor: COLORS[state]}, 1000);
            $('.sidebarComponentTitle').animate({backgroundColor: COLORS[state]},1000);
            $('.captionNumber').animate({backgroundColor: COLORS[state]},1000);
            $('.catogoryPage').animate({color: COLORS[state]},1000);
            $('.labTable').animate({color: COLORS[state]},1000);
        } 
                
        /*
        * ajaxRequest
        * a common method for handling all the ajax requests
        */
        function ajaxRequest(request,arguments,callback){

              //holding DOM object            
              var xmlhttp;
                 
                if (window.XMLHttpRequest)// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                 else// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
     
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){
                        
                        xmlDoc=xmlhttp.responseXML;
                        callback(xmlDoc);//ensure the data has reached
                    }
              }
    
            xmlhttp.open("GET","ajaxAccess.php?method="+request+"&"+arguments,true);
            xmlhttp.send();
                
        }
        
        
    </script>
    <!-- End of main control logic of the notice board -->
</head>


<!-- Graphics page -->

<body onLoad="init()">

    <div class="welcomeContainer" id="welcomeContainer">
    </div>

    <!-- Notice board main body -->
    <div id="bodyContainer" class= "bodyContainer" >

    </div> 
    <!-- End of main notice board body -->

    
    
    <!-- Sidebar  -->
    <div id="sidebarContainer" class= "sidebarContainer" style="display:none">

        <div class='overlay'></div>

            <!-- Clock -->
            <div class='sidebarComponentContainer' id='sidebarComponentContainer'>
                <div class='sidebarComponentTitle'>
                    <?php echo date('D , M d , Y');?>
                </div>

                <div class='sidebarComponentBody'>
                    <div id="clockContainer" style="width:160px;height:160px;">
                    <ul id="clock">    
                         <li id="sec"></li>
                         <li id="hour"></li>
                         <li id="min"></li>
                    </ul>
                    </div>
                 </div>
            </div>
            <!-- End of clock -->
        
        
            <!-- Weather component --> 
            <div class='sidebarComponentContainer'>
                <div class='sidebarComponentTitle'>
                    Weather in Kandy
                </div>

                <div class='sidebarComponentBody' id="weather" align="center">
                
                     <!-- the content will be added by updateWeather(). see weather.js -->
                    
                </div>
            </div> 
            <!-- end of Weather -->
 
 
            <!-- Lab reservations mini component -->
            <div class='sidebarComponentContainer'>
                <div class='sidebarComponentTitle' >
                    <div id='sidebarLabsTitle'></div>
                </div>
                
                <div class='sidebarComponentBody' id='sidebarLabs'>
                
                </div>
                
            </div>
            <!-- End of lab reservation mini component -->
            
            <!-- Staff member status mini component -->
            <div class='sidebarComponentContainer'>
                <div class='sidebarComponentTitle'>
                    <div id='sidebarStaffTitle'></div>
                </div>
                
                <div class='sidebarComponentBody' id='sidebarStaff'></div>
                
            </div>    
            <!-- End of staff member status mini component -->
                    
            <!-- Navigation panal for notices -->        
            <div class='sidebarComponentContainer'>
                <div class='sidebarComponentTitle'>
                Navigation
                </div>

                <div class='sidebarComponentBody'>
                     <table align="center" id='navigation'>

                    </table>    
                </div>
            </div>
            <!-- end of navigation panal component -->                     

        
       
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
                    <tr><td><img id='catogoryImage' src='icons/notices.png'/></td>
                    <td id='catogoryTitle'>Welcome to CE</td></tr>
                    <!-- End of notice category -->
                </table>
            </div> 
            
    </div> 
    <!-- End of the title -->

</body>
<!-- End of graphics -->


</html>