	/*
	* loadNews
	* prepare image and video notics with the captions and time data to display
	*/
	function loadNews(){ 
	
		//array to hold display times
		times=new Array();
		
		//generates silebar navigation panel
		innerNavigation = "";

		//generate the HTML code to display the notices(Image and video news)
        inner="<div class='overlay'></div>";  
        inner+="<div id='wrapper'>";

        inner+="<ul id='mask' style='width:"+(xmlDomImages.length + xmlDomVideos.length +1)*100+"%'>";
        inner+="<li id='box-1' class='box' style='width:" + (100/(xmlDomImages.length + xmlDomVideos.length+1)) + "%'>";
        inner+="<div class='content'><div class='inner' align='center'>";
        inner+="<div class='catogoryPage'>";
        inner+="<div style='position:relative;top:40%;'>News And Articles</div>";
        inner+="</div></div></div></li>";

		for(i=0;i<xmlDomImages.length;i++){
		
			//add the image news to display - HTML format
           inner+="<li id='box"+i+"' class='box' style='width:"+(100/(xmlDomImages.length + xmlDomVideos.length+1))+"%'>";
           inner+="<div class='content'><div class='inner' align='center'>";
           inner+="<img src='"+xmlDomImages[i].childNodes[0].childNodes[0].nodeValue+"'  id='notice"+i+"'/>";

			//arranging captions
            inner+="<div class='captionContainer' id='caption"+i+"'><div class='captionOverlay'></div>";
			inner+="<div class='captionNumber'>"+(i+1)+"</div><div class='captionContent'><b><u>"+xmlDomImages[i].childNodes[2].childNodes[0].nodeValue+"</b></u></br>- "+xmlDomImages[i].childNodes[3].childNodes[0].nodeValue+"</div></div>";
            inner+="</div></div></li>";

			//navigation at the sidebar
			innerNavigation += "<tr><td><div id='navigationNumber"+i+"' class='navigationNumber'>"+(i+1)+"</div></td>";
			innerNavigation += "<td>"+xmlDomImages[i].childNodes[2].childNodes[0].nodeValue+"</td></tr>";
			
			//time
			times[i]=xmlDomImages[i].childNodes[1].childNodes[0].nodeValue;
			
		}
		
		for(i=xmlDomImages.length;i<(xmlDomImages.length+xmlDomVideos.length);i++){
	  	
			//arrange video notices
			inner+="<li id='box"+i+"' class='box' style='width:"+ (100/(xmlDomImages.length + xmlDomVideos.length+1))+"%'>";
           
			inner+="<div class='content'><div class='inner' align='center'>"; 
			inner+="<embed ";
            inner+="id='notice"+i+"'";
			inner+="src='"+xmlDomVideos[i-xmlDomImages.length].childNodes[0].childNodes[0].nodeValue+"'";
            inner+="height='100%' width='100%'";
            inner+="type='video/quicktime'";
            inner+="pluginspage='http://www.apple.com/quicktime/download/'";
            inner+="autoplay='false'";
            inner+="controller='false'";
            inner+="bgcolor='#000'";
            inner+="scale='aspect'";
            inner+="enablejavascript='true'";
            inner+="wmode='transparent'";
            inner+="/>";				
			//arranging captions
            inner+="<div class='captionContainer' id='caption"+i+"'><div class='captionOverlay'></div>";
			inner+="<div class='captionNumber'>"+(i+1)+"</div><div class='captionContent'><b><u>"+xmlDomVideos[i-xmlDomImages.length].childNodes[2].childNodes[0].nodeValue+"</b></u></br>- "+xmlDomVideos[i-xmlDomImages.length].childNodes[3].childNodes[0].nodeValue+"</div></div>";
            inner+="</div></div></li>";
			
			//navigation at the sidebar
			innerNavigation += "<tr><td><div id='navigationNumber"+i+"' class='navigationNumber'>"+(i+1)+"</div></td>";
			innerNavigation += "<td>"+xmlDomVideos[i-xmlDomImages.length].childNodes[2].childNodes[0].nodeValue+"</td></tr>";		
			
			//time
			times[i]=xmlDomVideos[i-xmlDomImages.length].childNodes[1].childNodes[0].nodeValue;

		}

    inner+="</ul>";
    inner+="</div>";

	//set length
	length=xmlDomImages.length + xmlDomVideos.length;
	lengthV=xmlDomVideos.length;
	}