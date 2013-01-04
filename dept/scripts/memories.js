/*
* loadPhotos
* prepare photos to display in the notice board
*/
function loadPhotos(){

		//array to hold display times
		times=new Array();
		
		//generates silebar navigation panel
		innerNavigation = "";

		//generate the HTML code to display the notices(Text Notices)
        inner="<div class='overlay'></div>";  
        inner+="<div id='wrapper'>";

        inner+="<ul id='mask' style='width:"+(xmlDomPhotos.length +1)*100+"%'>";
        inner+="<li id='box-1' class='box' style='width:" + (100/(xmlDomPhotos.length+1)) + "%'>";
		
        inner+="<div class='content'><div class='inner' align='center'>";
        inner+="<div class='catogoryPage'>";
        inner+="<div style='position:relative;top:40%;'>Memories</div>";
        inner+="</div></div></div></li>";

		for(i=0;i<xmlDomPhotos.length;i++){
			//the photo
           inner+="<li id='box"+i+"' class='box' style='width:"+ (100/(xmlDomPhotos.length+1))+"%'>";
           inner+="<div class='content'><div class='inner' align='center'>"; 
		   inner+="<img src='"+xmlDomPhotos[i].childNodes[0].childNodes[0].nodeValue+"'  id='notice"+i+"'/>";
		   
		   //caption
		   inner+="<div class='captionContainer' id='caption"+i+"'><div class='captionOverlay'></div>";
		   inner+="<div class='captionNumber'>"+(i+1)+"</div><div class='captionContent'><b><u>"+xmlDomPhotos[i].childNodes[2].childNodes[0].nodeValue+"</b></u></br>- "+xmlDomPhotos[i].childNodes[3].childNodes[0].nodeValue+"</div></div>";
           inner+="</div></div></li>"; 		
		
			//navigation
	       innerNavigation += "<tr><td><div id='navigationNumber"+i+"' class='navigationNumber'>"+(i+1)+"</div></td>";
		   innerNavigation += "<td>"+xmlDomPhotos[i].childNodes[2].childNodes[0].nodeValue+"</td></tr>";

			//time to show
			times[i]=xmlDomPhotos[i].childNodes[1].childNodes[0].nodeValue;
		}

		inner+="</ul><!-- end mask -->";
		inner+="</div><!-- end wrapper -->";
        
		length=xmlDomPhotos.length;
		lengthV=0;
}