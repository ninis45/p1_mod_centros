var centro={
    map:false,
    position:false,
    marker:false,
    dragable:false,
    options:{
        
        
    },
    init:function(lat,lng,zoom)
    {
        var styles = [
          {
            stylers: [
              { hue: "#002b06" },
              { saturation: -70 }
            ]
          },{
            featureType: "road",
            elementType: "geometry",
            stylers: [
              { lightness: -10 },
              { visibility: "simplified" }
            ]
          },{
            featureType: "road",
            elementType: "labels",
            stylers: [
              { visibility: "off" }
            ]
          }
        ];
        centro.position={lat: lat, lng: lng};
        
        centro.options={
            zoom:zoom,
            center: centro.position,
    	    mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        
        centro.map = new google.maps.Map(document.getElementById('map'), centro.options);
        //centro.map.setOptions({styles: styles});
        
        
    },
    set_marker:function(position,map,data,url_icon,url)
    {
        
       
        
        var infowindow = new google.maps.InfoWindow();
        
        centro.marker = new google.maps.Marker({
			position: position,
			map: map,
			//title: data.title,
            draggable:centro.dragable,
            icon: url_icon,
            
            
               
			
        });
        if(data)
        {
            google.maps.event.addListener(centro.marker, 'click', function() {
               //location.href = url;
               
               infowindow.setContent('<div><strong>' + data.nombre + '</strong><br>' +
                  'Clave: ' + data.clave + '<br>' +
                  data.domicilio + '<br/><a href="'+url+'">Más información</a></div>');
                  infowindow.open(centro.map, this);
            });
        }
    },
    set_position:function(evt)
    {
        	$('#lat').val(evt.latLng.lat());
		    $('#lon').val(evt.latLng.lng());
    }
}