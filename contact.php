<!DOCTYPE html>
<html lang="en">
  <head>
 <title>FLC Production & Model Management PORTFOLIO - Dubai Models , Model Agency Dubai  , FLC Models & Talents</title>
	<?php include_once('md_includes/head.php'); ?>
     
 

</head>

  <body>
    
    <?php include_once('md_includes/header.php'); ?>
        
       
   <section class="aboutWraper">
       	  <div id="map"></div>
          
          
          <div class="container mt-5">
          	<div class="row">
            	
               <div class="col-8 mt-2"> 
               		<form id="contactForm">
                    	<input type="text" placeholder="Name" />
                        <input type="email" placeholder="Email" />
                        <input type="tel" placeholder="Contact Number" />
                        <textarea placeholder="message"></textarea>
                        <input type="submit" value="Send" />
                    </form>
               </div>
                <div class="col-4 mt-2 ourServices">
                		<div class="callUS">
                	<div class="col-12">
                    	<i class="fa fa-phone" aria-hidden="true"></i>
                        <span>Call US</span>
                       <span class="res">+971 4 4548684</span>
                    </div>
                    <div class="col-12"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span>Email Us</span>
                    <span class="res">talk2us@flcmodels.com</span> 
                    </div>
                    <div class="col-12">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>Visit Us</span>
                    <span class="res">1501 Concord Tower,<br>

Media City, Dubai. <br>

PO Box 283795, 
</span>
                    </div>
                </div>
                </div>
            </div>
          </div>
   </section>

  
  <?php include_once('md_includes/footer.php'); ?>
   <script type="text/javascript">
    function initMap() {
        // Styles a map in night mode.
		var concordTower = {lat: 25.097919, lng: 55.156560}
        var map = new google.maps.Map(document.getElementById('map'), {
          center: concordTower, 
          zoom: 14,
          styles: [
  {
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#f5f5f5"
      }
    ]
  },
  {
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [
      {
        "color": "#f5f5f5"
      }
    ]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#bdbdbd"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#eeeeee"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#e5e5e5"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#ffffff"
      }
    ]
  },
  {
    "featureType": "road.arterial",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#757575"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#dadada"
      }
    ]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#616161"
      }
    ]
  },
  {
    "featureType": "road.local",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  },
  {
    "featureType": "transit.line",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#e5e5e5"
      }
    ]
  },
  {
    "featureType": "transit.station",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#eeeeee"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {
        "color": "#c9c9c9"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#9e9e9e"
      }
    ]
  }
]
        });
		 var marker = new google.maps.Marker({
          position: concordTower,
		  icon: "assets/images/marker.png",
          map: map
        });
		
		
		
      }
   
	
</script>
 <script src="https://maps.googleapis.com/maps/api/js?key=your_api_key&callback=initMap"
    async defer></script>
  </body>
</html>
