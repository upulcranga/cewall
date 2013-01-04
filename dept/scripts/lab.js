/*
* Functions related to side bar lab component
*/


    var xmlDomLabStatus; //holds current status and the location of the labs as XML
		
	/*
        * updateLabStatus
        * update(fetch) the status of individual lab(AJAX request: currentStatus)
        */
    function updateLabStatus(callback){
            
        ajaxRequest("currentStatus","",function(result){
			xmlDomLabStatus=result.getElementsByTagName("lab");
			setTimeout("updateLabStatus(function(){})",AJAX_SIDEBAR_UPDATE_RATE*60*1000);
			callback();//only for the very first load. from the second update onwards callback will not be called
        });
    }
		
    /*
        * showLabStatus
        * show the status of individual lab at the side bar
        */ 		
	function showLabStatus(labNumber){
                    
        //extract lab name, floor abd the status from the xml DOM object
        labName=xmlDomLabStatus[labNumber].childNodes[0].childNodes[0].nodeValue;
        labFloor=xmlDomLabStatus[labNumber].childNodes[1].childNodes[0].nodeValue;
        labStatus=(xmlDomLabStatus[labNumber].childNodes[2].childNodes[0].nodeValue>0?"<font color='red'><b>Occupied</b></font>":"<font color='green'><b>Vacant</b></font>");
                    
        //fade-out the current values from the component                    
        $('#sidebarLabs').fadeTo(700,0);
        $('#sidebarLabsTitle').fadeTo(700,0,function(){
                                
            //update with new values
                 document.getElementById('sidebarLabsTitle').innerHTML=labName;
                 document.getElementById('sidebarLabs').innerHTML="( " + labFloor + " )<br/>";
                 document.getElementById('sidebarLabs').innerHTML+=labStatus;   
                //show the new values with fade-in effect
                 $('#sidebarLabsTitle').fadeTo(700,1);
                 $('#sidebarLabs').fadeTo(700,1,function(){                                    
                        labNumber= (++labNumber)%(xmlDomLabStatus.length);  //prepare for taking info of the next lab status entry
                        setTimeout('showLabStatus('+labNumber+')',1200);    //delay, and then show the next lab status entry
                 });
         });                          
    }