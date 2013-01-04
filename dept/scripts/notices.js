/*
* loadNotices
* prepare text notices, text notice navigation and caption for the display
*/	
function loadNotices(){

		//array to hold display times
		times=new Array();
		
		//generates silebar navigation panel
		innerNavigation = "";

		//generate the HTML code to display the notices(Text Notices)
        inner="<div class='overlay'></div>";  
        inner+="<div id='wrapper'>";

        inner+="<ul id='mask' style='width:"+(xmlDomText.length +1)*100+"%'>";
        inner+="<li id='box-1' class='box' style='width:" + (100/(xmlDomText.length+1)) + "%'>";
        inner+="<div class='content'><div class='inner' align='center'>";
        inner+="<div class='catogoryPage'>";
        inner+="<div style='position:relative;top:40%;'>Notices</div>";
        inner+="</div></div></div></li>";
		
		for(i=0;i<xmlDomText.length;i++){
		
			//text notices
			inner+="<li id='box"+i+"' class='box' style='width:"+ (100/(xmlDomText.length+1)) + "%'>";
			inner+="<div class='content'><div class='inner' align='center'>";
			inner+="<div class='textOverlay' ></div>";
			inner+="<div class='textContent' id='notice"+1+"'>";
			inner+="<object style='width:100%;height:100%' type='text/html' data='" + xmlDomText[i].childNodes[0].childNodes[0].nodeValue+"'></object>";
			inner+="</div>";
			
			//caption
			inner+="<div class='captionContainer' id='caption"+i+"'><div class='captionOverlay'></div><div class='captionNumber'>"+(i+1)+"</div>";
			inner+="<div class='captionContent'><b><u>"+xmlDomText[i].childNodes[2].childNodes[0].nodeValue+"</b></u></br>- "+xmlDomText[i].childNodes[3].childNodes[0].nodeValue+"</div></div>";
			inner+="</div></div></li>"; 			
			//time to show
			times[i]=xmlDomText[i].childNodes[1].childNodes[0].nodeValue;
			
			//prepare sidebar navigation data
	       innerNavigation += "<tr><td><div id=\'navigationNumber"+i+"\' class=\'navigationNumber\'>"+(i+1)+"</div></td>"; 
	       innerNavigation += "<td>"+xmlDomText[i].childNodes[2].childNodes[0].nodeValue +"</td></tr>";

		}

    inner+="</ul><!-- end mask -->";
    inner+="</div><!-- end wrapper -->";

	
	//sel the length
	length=xmlDomText.length;
	lengthV=0;
}