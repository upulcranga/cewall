/*
* Functions related to side bar staff presence component
*/


    var xmlDomStaffStatus; //holds name,office floor,current status of the lecturer as XML
		
	/*
        * updateStaffStatus
        * update(fetch) the status of individual lecturer(AJAX request: currentPresence)
        */
    function updateStaffStatus(callback){

        ajaxRequest("currentPresence","",function(result){
			xmlDomStaffStatus=result.getElementsByTagName("staff");
			setTimeout("updateStaffStatus(function(){})",AJAX_SIDEBAR_UPDATE_RATE*60*1000 + 5); //5 seconds delay given to finish lab component update
			callback();//only for the very first load. from the second update onwards callback will not be called
        });
    }
		
    /*
        * showStaffStatus
        * show the presence of staff members at the side bar
        */ 		
	function showStaffStatus(staffNumber){
                    
        //extract lecturer name, floor abd the status from the xml DOM object
        staffName=xmlDomStaffStatus[staffNumber].childNodes[0].childNodes[0].nodeValue;
        staffFloor=xmlDomStaffStatus[staffNumber].childNodes[1].childNodes[0].nodeValue;
        staffStatus=xmlDomStaffStatus[staffNumber].childNodes[3].childNodes[0].nodeValue;
        staffStatusId=xmlDomStaffStatus[staffNumber].childNodes[2].childNodes[0].nodeValue;
        
		color="";
			if(staffStatusId==1)
				color="#555";
			else if(staffStatusId==2 | staffStatusId==4)
				color="red"
			else if(staffStatusId==5)
				color="green";
			else if(staffStatusId==3 | staffStatusId==6)
				color="orange";

        //fade-out the current values from the component                    
        $('#sidebarStaff').fadeTo(700,0);
        $('#sidebarStaffTitle').fadeTo(700,0,function(){
                              
            //update with new values
                 document.getElementById('sidebarStaffTitle').innerHTML=staffName;
                 document.getElementById('sidebarStaff').innerHTML="( " + staffFloor + " )<br/>";
                 document.getElementById('sidebarStaff').innerHTML+="<font color='"+color+"'><b>"+staffStatus+"</b></font>";   
                //show the new values with fade-in effect
                 $('#sidebarStaffTitle').fadeTo(700,1);
                 $('#sidebarStaff').fadeTo(700,1,function(){                                    
                        staffNumber= (++staffNumber)%(xmlDomStaffStatus.length);  //prepare for taking info of the next staff status entry
                        setTimeout('showStaffStatus('+staffNumber+')',1200);    //delay, and then show the next staff status entry
                 });
         });                          
    }