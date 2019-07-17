<!DOCTYPE html>
<html>
	<head>
		<title> CST 336 - HW3 </title>
		<link  href="css/styles.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<h1> Weather </h1>
        
        <form id="weatherForm">
        	Zip code:	<input type="text" id="zip"><br />
            			<span id="invalidZip"></span><br />
                
        	<input type="submit" value="Submit" />
        </form>
        
        <div id="weatherInfo">
        	<h3>Temperature</h3>
            City: <span id="city"></span><br />
            Country: <span id="country"></span><br /><br />
            Kelvin: <span id="kelvin"></span><br />
            Celsius: <span id="celsius"></span><br />
            Fahrenheit: <span id="fahrenheit"></span><br />
        </div>
        
        <script>
			var validZip = false;
			
			function submitDetails(){
			// Check city and state
				$.ajax
				({
					method: "GET",
					url: "https://api.openweathermap.org/data/2.5/forecast",
					dataType: "json",
					data: { "zip" : $("#zip").val(), "APPID" : "4e1c93d96d07042b5e2fe4e54e3b5ec8" },

					success: function(data) 
					{
						var kelvin  = data.list[0].main.temp;
						$("#invalidZip").html("");
						
						$("#city").html(data.city.name);
						$("#country").html(data.city.country);
						$("#kelvin").html(kelvin + "&deg");
						$("#celsius").html(kelvinToCelsius(kelvin) + "&deg");
						$("#fahrenheit").html(kelvinToFahrenheit(kelvin) + "&deg");
						
						
						if (kelvin > 310)
							$("#weatherInfo").css("color", "red");
						else if (kelvin > 304)
							$("#weatherInfo").css("color", "orange");
						else if (kelvin > 300)
							$("#weatherInfo").css("color", "yellow");
						else if (kelvin > 294)
							$("#weatherInfo").css("color", "green");
						else if (kelvin > 288)
							$("#weatherInfo").css("color", "blue");
						else
							$("#weatherInfo").css("color", "cyan");
					},
					
					error: function() 
					{
						$("#invalidZip").html("Invalid zip code!");
					}
					
				}); // ajax
			};	
			
			// Check the form for errors upon submission
			$("#weatherForm").on("submit", function() {
				submitDetails();
				
				event.preventDefault();
			});
			
			function kelvinToFahrenheit( kelvin )
			{
				return (1.8) * (kelvin - 273) + 32;
			};
			
			function kelvinToCelsius( kelvin )
			{
				return kelvin - 273;
			};
			
			
			
			
		</script>
        
	</body>
</html>