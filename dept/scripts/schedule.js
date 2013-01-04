/*
* loadLabs
* 
*/
function loadLabs(){

		//array to hold display times
		times=new Array(8,8);
		
		//generates silebar navigation panel
		innerNavigation = "";

		//generate the HTML code to display the notices(Text Notices)
        inner="<div class='overlay'></div>";  
        inner+="<div id='wrapper'>";

        inner+="<ul id='mask' style='width:300%'>";
        inner+="<li id='box-1' class='box' style='width:33.3333%'>";
        inner+="<div class='content'><div class='inner' align='center'>";
        inner+="<div class='catogoryPage'>";
        inner+="<div style='position:relative;top:40%;'>Lab Schedule</div>";
        inner+="</div></div></div></li>";

		//HTML code for today's plan
        inner+="<li id='box0' class='box' style='width:33.3333%'>";
        inner+="<div class='content'><div class='inner' align='center'>";
        
        inner+="<table class ='labTable' width='90%' cellpadding='6' cellspacing='4' id='labTable1'>";
        inner+="<tr><td colspan='2'><b>Plan For Today</b></td></tr>";

		//r- odd or even : make the table with two colored rows
         for(i=0;i<xmlDomScheduleToday.length;i++){
              (i%2==0)?r='odd':r='even';
              inner+="<tr><td width='40%' class='"+r+"Row'>" + xmlDomScheduleToday[i].childNodes[0].childNodes[0].nodeValue + "</td><td class='"+r+"Row'>"+xmlDomScheduleToday[i].childNodes[1].childNodes[0].nodeValue+"</td></tr>";
         }       
        inner+="</table>";  

        inner+="</div></div></li>"; 

        inner+="<li id='box1' class='box' style='width:33.3333%'>";
        inner+="<div class='content'><div class='inner' align='center'>"; 
        
        inner+="<table class='labTable' width='90%' cellpadding='6' cellspacing='4' id='labTable2'>";
        inner+="<tr><td colspan='2'><b>Plan For Tomorrow</b></td></tr>";
		
         for(i=0;i<xmlDomScheduleTomorrow.length;i++){
              (i%2==0)?r='odd':r='even';
              inner+="<tr><td width='40%' class='"+r+"Row'>" + xmlDomScheduleTomorrow[i].childNodes[0].childNodes[0].nodeValue + "</td><td class='"+r+"Row'>"+xmlDomScheduleTomorrow[i].childNodes[1].childNodes[0].nodeValue+"</td></tr>";
         }
		 
        inner+="</table>"        
        
        inner+="</div></div></li>";         
        
    inner+="</ul><!-- end mask -->";
    inner+="</div><!-- end wrapper -->";  
 
		//sidebar navigation HTML
       innerNavigation = "<tr><td><div id='navigationNumber0' class='navigationNumber'>1</div></td>";
       innerNavigation += "<td>Plan for today</td></tr>";
       innerNavigation += "<tr><td><div id='navigationNumber1' class='navigationNumber'>2</div></td>";
       innerNavigation += "<td>Plan for tomorrow</td></tr>";
 
	length=2;
	lengthV=0;
}