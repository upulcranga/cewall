
    var WEATHER_UPDATE_RATE=30; //update rate of the weather component (in minutes)
	
/*
* updateWeather
* will update the weather component for each WEARTHER_UPDATE_RATE minutes
*/
function updateWeather(){

	weather="";
	
	$("#weather").fadeTo(1000,0,function(){  
	
	weather+="<div style='width: 180px; height: 150px; background-image: url( http://vortex.accuweather.com/adcbin/netweather_v2/backgrounds/silver_180x150_bg.jpg ); background-repeat: no-repeat; background-color: #86888B;' >"
        weather+="<div style='height: 138px;' >"
            weather+="<object type='application/x-shockwave-flash' data='http://netweather.accuweather.com/adcbin/netweather_v2/netwx-v28.swf' height='138' width='180' align='top'>"
                weather+="<param name='movie' value='http://netweather.accuweather.com/adcbin/netweather_v2/netwx-v28.swf' />"
                weather+="<param name='allowScriptAccess' value='never' />"
				weather+="<param name='allowNetworking' value='internal' />"
                weather+="<param name='quality' value='high' />"
				weather+="<param name='scale' value='noscale' />"
                weather+="<param name='salign' value='lt' />"
				weather+="<param name='wmode' value='transparent' />"
                weather+="<param name='bgcolor' value='#ffffff' />"
                weather+="<param name='flashvars' value='partner=netweather&myspace=1&logo=1&tStyle=whteYell&zipcode=ASI|LK|CE001|KANDY|&lang=uke&size=28&theme=1&metric=1' />"
            weather+="</object>"
        weather+="</div>"
                        
        weather+="<div style='text-align: center; font-family: arial, helvetica, verdana, sans-serif; font-size: 10px; color: #FFFFFF;' >"
		weather+="</div>"
    weather+="</div>"


		document.getElementById("weather").innerHTML=weather;
		$("#weather").fadeTo(1000,1);
		setTimeout("updateWeather()",1000*60*WEATHER_UPDATE_RATE);
		
	});
}