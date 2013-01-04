var months = new Array('January','February','March','April','May',
'June','July','August','September','October','November','December');

var days=new Array("Sunday","Monday","Tuesday", "Wednesday", "Thursday" , "Friday" , "Saturday");

function updateClock ( )
{
  var currentTime = new Date ( );

  var currentHours = currentTime.getHours ( );
  var currentMinutes = currentTime.getMinutes ( );
  var currentSeconds = currentTime.getSeconds ( );

  // Pad the minutes and seconds with leading zeros, if required
  currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  // Choose either "AM" or "PM" as appropriate
  var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  // Convert the hours component to 12-hour format if needed
  currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  // Convert an hours component of "0" to "12"
  currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  // Compose the string for display
  var currentTimeString =  days[currentTime.getDay()] + " , " + months[currentTime.getMonth()] + " " +currentTime.getDate() + " , " + currentTime.getFullYear() + " | " + currentHours + ":" + currentMinutes +  " " + timeOfDay;

  // Update the time display
  document.getElementById("dateTime").firstChild.nodeValue = currentTimeString;
}