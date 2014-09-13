@extends('layouts.default')

@section('content')

		@if (Session::has('flash_error'))
	        <div id="flash_error"><font color=red>{{ Session::get('flash_error') }}</font></div>
	    @endif
	    @if (Session::has('flash_notice'))
	        <div id="flash_notice"><font color=green>{{ Session::get('flash_notice') }}</font></div>
	    @endif



		<div id="location"></div>
		<script>
			var x = document.getElementById("location");
			var address_dict = {};
			
			function getLocation() {
			    if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPosition);
			    } else {
		        	x.innerHTML = "Geolocation is not supported by this browser.";
		    	}
			}
			function showPosition(position) {
				$.ajax({ 
						url: "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "," + position.coords.longitude 
					}).done(function(data) {
		  				console.log();
		  				$.each(data.results, function(i, address_level) {
		  					$.each(address_level.address_components , function(j, address) {
		  						address_dict[address.types[0]] = address.long_name;
		  					});
		  				});
		  				console.log(address_dict);
						
						x.innerHTML = "Latitude: " + position.coords.latitude + 
						"<br>Longitude: " + position.coords.longitude + "<BR>" + 
						address_dict.locality + ', ' + address_dict.administrative_area_level_1 + ', ' + address_dict.country + '<BR><BR>';
				});
			}
			$(function() {
				getLocation();
				init();
				initQuickLaunch();
				initSidebar();
				initConsole();
			});
		</script>
@stop