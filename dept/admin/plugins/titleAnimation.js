$(document).ready(function(){
		
		//fade links a bit
        $("a").fadeTo("medium",0.4);
		
		//simple fade animation for links
		  $("a").mouseover(function(){
				$(this).stop().fadeTo("medium",1,function(){});
		});
			
		$("a").mouseout(function(){
				$(this).stop().fadeTo("medium",0.4,function(){});
		});
		
                    //initialize the page title
                    TITLE="Computer Engineering ";
                    for(i=0;i<TITLE.length;i++){
                         document.getElementById("title").innerHTML += "<td class='title'>" + TITLE.substr(i,1) + "</td>";
                    }
                    //start animation of the title and circulate the animation
                    animateTitle();

        setInterval("animateTitle()",5000);
        });
        
        //title animation
        function animateTitle(){
            $(".title").each(function(index){
                $(this).delay(50*index).fadeTo("slow",0.3);
            
            });

            $(".title").each(function(index){
                $(this).delay(25*index).fadeTo("fast",0.8);
            
            });
			

			
}