<!doctype html>
<html>
<head>
 <link rel="stylesheet" href="leaflet/leaflet.css" />
 <link rel="stylesheet" href="style/style.css" />
<!--[if lte IE 8]>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.ie.css" />
<![endif]-->
<script type="text/javascript" src="leaflet/leaflet.js"></script> 
<!-- You must set the height of the div for the map, yes this should be in an external file -->
<body>
<div class="nav">

	<a href="addBanks.php" class="list">Add Banks</a>	
	<a href="index.php" class="list">Home</a>	
</div>
<div id="map" style="height: 550px; margin: 0 0;">
	
</div>

<script type="text/javascript" src="geojson/andhra.js"></script>
<script type="text/javascript">

  // Setup the map to center where you would like it to.  You can always to go maps.google.com and right click anywhere on the map and "Drop LatLng Marker" copy and paste that into the function call below.
  var map = new L.map('map', {zoomControl: false}).setView([16.5, 79], 6.5);
  map.addControl(L.control.zoom({position: 'bottomleft'}));
   // This is where you get your map tiles.  You can get a free API key from cloudmade.com
var cloudmade = L.tileLayer('http://{s}.tile.cloudmade.com/{key}/{styleId}/256/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; 2011 OpenStreetMap contributors, Imagery &copy; 2011 CloudMade',
    key: 'c5007019bb4e4787afb0135c36690912',
    styleId: 22677
  }).addTo(map);



  function style(feature) {
    return {
      fillColor: '#FFF',
      weight: 1,
      opacity: 1,
      color: 'black',
      fillOpacity: 1,
      value: 'Hello'
    };
  }

var legend = L.control({position: 'topleft'});

  legend.onAdd  = function(map) {
  	var div = L.DomUtil.create('div','info legend');
  	div.innerHTML ='Powered by<br/><img src="images/logo.png" alt="Technowell"></img>';
  	return div; 
  }
  legend.addTo(map);

  var legend = L.control({position: 'bottomright'});

 legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend'),
        grades = ['State Bank of India', 'State Bank of Travancore', 'State Bank of Bikaner and Jaipur','State Bank of Hyderabad', 
        'State Bank of Mysore', 'State Bank of Patiala', 'State Bank of Saurashtra','State Bank of Indore', 'Others' ];
        labels = [];

    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < grades.length; i++) {
        div.innerHTML +=
            '<i style="background:' + getColor(grades[i]) + '"></i> &nbsp;'+ grades[i] + '<br>';
    }

    return div;
};
  legend.addTo(map);

  var info = L.control({position: 'topleft'});

  info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
    this.update();
    return this._div;
  };
  

  // method that we will use to update the control based on feature properties passed
  info.update = function (props, name, district, balance) {

  	//console.log(props);
  	if(name == null) {
  		this._div.innerHTML = (props ?
      '<table><tbody><tr><td class="head">' + props.SECTION + '</td></tr>'+
      '<tr><td>Money in Chest : Rs.' + props.money+'</td></tr></tbody></table>'
      : 'Click on a state<br /><br />');
  	}

  	else {
  		console.log("here");
  	this._div.innerHTML = '<table><tbody><tr><td class="head">'+name+'</td></tr>'+
  			'<tr><td>Chest Id: '+props+'</td></tr>'+
  			'<tr><td>Location: '+district+'</td></tr>'+
  			'<tr><td>Money : Rs. '+balance+'</td></tr>'+
  			'</tbody></table>';
  	}
  
  };

  function getBanks()
	{
		//clearLocations();
		var searchUrl = 'getbanks.php';
		
		downloadUrl(searchUrl, function(data) 
		{
			var xml = parseXml(data);
			var bankNodes = xml.documentElement.getElementsByTagName("bank");
			for(var i = 0; i < bankNodes.length; i++)
			{
				chestId = bankNodes[i].getAttribute("chestId");
				name = bankNodes[i].getAttribute("name");
				abbr = bankNodes[i].getAttribute("abbr");
				lat = bankNodes[i].getAttribute("lat");
				lng = bankNodes[i].getAttribute("lng")
				district = bankNodes[i].getAttribute("district");
				balance = bankNodes[i].getAttribute("balance");

				putBank(chestId, name, abbr, lat, lng, district, balance);
			}

		});
	}
  

  function downloadUrl(url, callback)
			{
				var request = window.ActiveXObject ?
				new ActiveXObject('Microsoft.XMLHTTP') :
				new XMLHttpRequest;
				request.onreadystatechange = function() {
					if (request.readyState == 4)
					{
						request.onreadystatechange = doNothing;
						callback(request.responseText, request.status);
					}
				};
				request.open('GET', url, true);
				request.send(null);
			}
			

	function parseXml(str)
			{
				if (window.ActiveXObject)
				{
					var doc = new ActiveXObject('Microsoft.XMLDOM');
					doc.loadXML(str);
					return doc;
				}
				else if (window.DOMParser)
				{
					return (new DOMParser).parseFromString(str, 'text/xml');
				}
			}

	function doNothing(){}		

			

  info.addTo(map);

   

  var geojson;
  var setDistrict = null;

  function highlightFeature(e) {
    var layer = e.target;
    if(setDistrict!=null)
    {  
        setDistrict.setStyle({
        fillColor: '#FFF',
        dashArray: '0',
        fillOpacity: 1
      });
    } 

    layer.setStyle({
      fillColor: '#e5e5e5',
      dashArray: '0',
      fillOpacity: 1
    });
    setDistrict = e.target;
    if (!L.Browser.ie && !L.Browser.opera) {
      //bringToFront(e);
    }
    info.update(layer.feature.properties);
  }

  function getColor(d) {
    return d == 'State Bank of Travancore' ? '#66c2a5' :
           d == 'State Bank of India'  ? '#fc8d62' :
           d == 'State Bank of Bikaner and Jaipur'  ? '#8da0cb' :
           d == 'State Bank of Hyderabad' ? '#d95f02' :
           d == 'State Bank of Mysore'   ? '#1f78b4' :
           d == 'State Bank of Patiala'  ? '#e41a1c' :
           d == 'State Bank of Saurashtra' ? '#FED976' :
           d == 'State Bank of Indore' ? '#4daf4a' :
                             '#000';
}

  function displayDetails(e) {
  	var chestId = e.target.options.label;
  	var name = e.target.options.name;
  	var district = e.target.options.district;
  	var balance = e.target.options.balance;
  	//var circle = e.target._popup._content;
  	info.update(chestId, name, district, balance);
  }

  function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
  }

  function onEachFeature(feature, layer) {
    layer.on({
      click: highlightFeature,
      //mouseout: resetHighlight,
    });
   // layer.bindPopup(feature.properties.name);

  }
  function bringToFront(e) {
    map.fitBounds(e.target.getBounds());
	}
  geojson = L.geoJson(statesData, {
    style: style,
    onEachFeature: onEachFeature
  }).addTo(map);

  function putBank(chestId, name, abbr, lat, lng, district, balance){
  	var circle = L.circle([lat, lng], 500, {
  		label: chestId,
  		name:name,
  		district: district,
  		balance: balance,
    	color: getColor(name),
    	fillColor: getColor(name),
    	fillOpacity: 1
    	
		}).addTo(map);
  circle.on({click: displayDetails});
  circle.bindPopup(name);
}

getBanks();

</script>

<style type="text/css">




.info {
  padding: 6px 8px;
  font: 14px/16px Arial, Helvetica, sans-serif;
  background: white;
  box-shadow: 0 0 15px rgba(0,0,0,0.2);
  border-radius: 5px;
}
.info .head {
  background: #000;
  margin: 0 0 5px;
  padding: 2px;
  color: #fff;
  font-weight: bold;
  font-size: 20px;
}
.info h4 {
  margin: 0 0 5px;
  padding: 2px;
  color: #000;
}
.tag {
  padding: 6px 8px;
  font: 14px/16px Arial, Helvetica, sans-serif;
  background: white;
  box-shadow: 0 0 15px rgba(0,0,0,0.2);
  border-radius: 5px;
}
.tag h4 {
  margin: 0 0 5px;
  padding: 2px;
  color: #000;
}
.legend {
  line-height: 22px;
}
.legend i {
    width: 18px;
    height: 18px;
    float: left;
    opacity: 1;
}
.div-icon {
	width:100px;
	height:100px;
	background: #900;
}

</style>
</body>
</html>