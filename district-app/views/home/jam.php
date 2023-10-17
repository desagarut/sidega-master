<script type="text/javascript">
function currentTime() {
  var date = new Date(); /* creating object of Date class */
  var hour = date.getHours();
  var min = date.getMinutes();
  var sec = date.getSeconds();
  var midday = "AM";
  midday = (hour >= 12) ? "PM" : "AM"; /* assigning AM/PM */
  hour = (hour == 0) ? 12 : ((hour > 12) ? (hour - 12): hour); /* assigning hour in 12-hour format */
  hour = changeTime(hour);
  min = changeTime(min);
  sec = changeTime(sec);
  document.getElementById("digit_clock_time").innerText = hour + " : " + min + " : " + sec + " " + midday; /* adding time to the div */
 
  var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
 
  var curWeekDay = days[date.getDay()]; // get day
  var curDay = date.getDate();  // get date
  var curMonth = months[date.getMonth()]; // get month
  var curYear = date.getFullYear(); // get year
  var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear; // get full date
  document.getElementById("digit_clock_date").innerHTML = date;
 
  var t = setTimeout(currentTime, 1000); /* setting timer */
}
 
function changeTime(k) { /* appending 0 before time elements if less than 10 */
  if (k < 10) {
    return "0" + k;
  }
  else {
    return k;
  }
}
 
currentTime();
 
</script>
<style type="text/css">
/* Google font */

@import url('https://fonts.googleapis.com/css?family=Orbitron');
#digit_clock_time {
	font-family: 'Work Sans', sans-serif;
	color: #66ff99;
	font-size: 20px;
	text-align: center;
	padding-top: 5px;
}
#digit_clock_date {
	font-family: 'Work Sans', sans-serif;
	color: #66ff99;
	font-size: 20px;
	text-align: center;
	padding-top: 20px;
	padding-bottom: 20px;
}
.digital_clock_wrapper {
	background-color: #333;
	padding: 25px;
	max-width: 350px;
	width: 100%;
	text-align: center;
	border-radius: 5px;
	margin: 0 auto;
}
</style>

      <div class="digital_clock_wrapper">
        <div id="digit_clock_time"></div>
        <div id="digit_clock_date"></div>
      </div>

<!-- Menampilkan Hari, Bulan dan Tahun --> 
