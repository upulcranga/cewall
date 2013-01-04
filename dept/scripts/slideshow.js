/*
*
*	Handles the notices slideshow
*
*/
	//the slide number. -1 is for the title of the category, Ex. Notices, News, Lab Schedule and Memories
	//0 to onwards are for notices
	var slide=-1;
	
	var times=""; //holds timings for the notices
	var inner=""; // holds notices to be displayed in HTML mannar
	var innerNavigation=""; //holds sidebar navigation data

	
	var xmlDomText;//holds details of text notices as XML
	var xmlDomVideos;//holds details of text notices as XML
	var xmlDomImages;//holds details of text notices as XML
	var xmlDomPhotos;//holds details of text notices as XML
	
	var xmlDomScheduleToday;//holds today's  lab plan as XML
	var xmlDomScheduleTomorrow;//holds tomorrow's lab plan as XML

	var length;	//holds the total number of notices in the current state(i.e 2 notices ,3 news, 2 labs, 4 memories)
	var lengthV; //only for holding number of videos!!!!
	/*
	* updateNotices
	* fetch the text notices  (AJAX request : notices)
	*/
	function updateNotices(){
	            
	        ajaxRequest("notices","",function(result){
				xmlDomText=result.getElementsByTagName("text");
				xmlDomVideos=result.getElementsByTagName("video");
				xmlDomImages=result.getElementsByTagName("image");
				xmlDomPhotos=result.getElementsByTagName("photo");
				
				ajaxRequest("schedule","",function(result){
					xmlDomScheduleToday=result.getElementsByTagName("today");
					xmlDomScheduleTomorrow=result.getElementsByTagName("tomorrow");
				});
				
				setTimeout("updateNotices()",AJAX_SLIDESHOW_UPDATE_RATE*60*1000);

	        });
	}	

	
	 /*
	   * slideshow
	   * the basic logic of the slideshow. when slide is -1, the category title will be animated, else the notice flow will be continued
	   *
	   */
       function slideshow(){

            slideName="#box"+slide;
            
            if(slide==-1){ //if category page to be shown

		            if(state==NOTICE_STATE){ //State 0 -  Text notices

					//take the text notice data to be shown, time a notice to be shown 
		               loadNotices();

		                document.getElementById("bodyContainer").innerHTML=inner;  
		                $("#navigation").fadeTo(1000,0,function(){
		                    document.getElementById("navigation").innerHTML=innerNavigation;
		                    $(this).fadeTo(1000,1,changeColor());
		                });
		                 
		                $("#catogoryImage").attr("src", 'icons/notices.png');
		                document.getElementById("catogoryTitle").textContent="Notices";
						
		            }    
		            else if(state==NEWS_STATE){

						loadNews();
					
		                document.getElementById("bodyContainer").innerHTML=inner;  
		                $("#navigation").fadeTo(1000,0,function(){
		                    document.getElementById("navigation").innerHTML=innerNavigation; 
		                    $(this).fadeTo(1000,1,changeColor());
		                });
		                $("#catogoryImage").attr("src", 'icons/news.png');
		                document.getElementById("catogoryTitle").textContent="News And Articles";
		            }
		            else if(state==LAB_STATE){
		               // times=timesLabs;
		                loadLabs();
		                document.getElementById("bodyContainer").innerHTML=inner;
		                $("#navigation").fadeTo(1000,0,function(){  
		                    document.getElementById("navigation").innerHTML=innerNavigation; 
		                        document.getElementById("labTable1").style.marginTop=(document.getElementById("wrapper").clientHeight-document.getElementById("labTable1").clientHeight)/2;
		                        document.getElementById("labTable2").style.marginTop=(document.getElementById("wrapper").clientHeight-document.getElementById("labTable2").clientHeight)/2;
		                    $(this).fadeTo(1000,1,changeColor());
		                });
		                $("#catogoryImage").attr("src", 'icons/labs.png');
		                document.getElementById("catogoryTitle").textContent="Lab Schedule"; 
		                
		            }
		            else if(state==MEMORIES_STATE){
		               
						loadPhotos();

		                document.getElementById("bodyContainer").innerHTML=inner;  
		                $("#navigation").fadeTo(1000,0,function(){
		                    document.getElementById("navigation").innerHTML=innerNavigation; 
		                    $(this).fadeTo(1000,1,changeColor());
		                });
		                $("#catogoryImage").attr("src", 'icons/memories.png');
		                document.getElementById("catogoryTitle").textContent="Memories";
		                
		            }
		                     slide=0;
		                     changeColor();   
		                     setTimeout("alignCaptions()",800);

		                     setTimeout("animateCatogory()",1700); 
		    }
            else{

			//navigation - small number box color change
            $('#navigationNumber'+slide).animate({backgroundColor: COLORS[state]}, 800);
                if(slide!=0){
                    $('#navigationNumber'+(slide-1)).animate({backgroundColor: '#bbb'}, 800);   
                }  
            $('#bodyContainer #wrapper').scrollTo(slideName,1200,function(){

                
                
              if(length-lengthV <= slide){
                    movie=document.getElementById("notice"+slide);
                    movieDuration=Math.ceil(movie.GetEndTime()/movie.GetTimeScale());
                    setTimeout("movie.Play()",2000);
                    
                    setTimeout("slideshow()",1000*(movieDuration+3));
                    setTimeout("movie.Rewind()",1000*(movieDuration+3));
                    
                }
                else{
                    setTimeout("slideshow()",1000*times[slide]);
               }
                           
                slide+=1;
                    if(slide> length -1 ){
                    slide=-1;
                        if(state<1)
							state++;
                        else
							state=0;
                    }    

            });

            }//end else
            
        }
		
		/*
		* animateCatogory
		* the category of the notice section is displayed (in large letters)
		*/
        function animateCatogory(){
         $('#bodyContainer #wrapper').scrollTo("#box-1",1200,function(){

                    $('#box-1').fadeTo(3000,0,function(){
           
                        $("#box0").fadeIn(3000,function(){
                              slideshow();
                         });
           
                     });   
       });            
        }
		
		/*
		* alignCaptions
		* the caption at the bottom of each notice is made to cover the width of the notice
		*/
		function alignCaptions(){
       
                   
            for(i=0;i<length;i++){
                              
                    fullWidth=document.getElementById("caption"+i).clientWidth;
                    noticeWidth=document.getElementById("notice"+i).clientWidth;
                    
                    if(fullWidth<noticeWidth){  //avoid the notice exceed the box area, if it is so, resize the notice
                        noticeHeight=document.getElementById("notice"+i).clientHeight;
                        
                        document.getElementById("notice"+i).style.height=noticeHeight*(fullWidth/noticeWidth);
                        document.getElementById("notice"+i).style.width=fullWidth;
                        
                        document.getElementById("notice"+i).style.marginTop=(noticeHeight*(1-(fullWidth/noticeWidth)))/2;
                        document.getElementById("caption"+i).style.marginBottom+=(noticeHeight*(1-(fullWidth/noticeWidth)))/2;
                        
                        fullWidth=document.getElementById("caption"+i).clientWidth;
                        noticeWidth=document.getElementById("notice"+i).clientWidth;
                    }
                    
                    document.getElementById('caption'+i).style.width=noticeWidth;
                    document.getElementById('caption'+i).style.marginLeft=(fullWidth-noticeWidth)/2;

            }
    }