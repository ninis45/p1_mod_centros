<style type="text/css">

.list-group > li {
  position: relative;
  display: block;
  padding: 10px 15px;
  margin-bottom: -1px;
  background-color: #fff;
  border: 1px solid #ddd;
}
.list-group > li:first-child {
  border-top-left-radius: 4px;
  border-top-right-radius: 4px;
}
.list-group >li:last-child {
  margin-bottom: 0;
  border-bottom-right-radius: 4px;
  border-bottom-left-radius: 4px;
}
.list-group > li a{
  display:block;
}
.list-group > li:hover,

.list-group > li:focus{
  color: #555;
  text-decoration: none;
  background-color: #f5f5f5;
}
</style>
<?php //if($this->method=='detalles'){?>
 <script type="text/javascript">
   var map;
   var position = new google.maps.LatLng(<?=$plantel->latitud?$plantel->latitud:'19.833932192097134'?>, <?=$plantel->longitud?$plantel->longitud:'-90.5467695763607'?>);
   var marker;
   var options = {
    	zoom:<?=$plantel->zoom?$plantel->zoom:'8'?>,
    	center: position,
    	mapTypeId: google.maps.MapTypeId.ROADMAP
  };
   
   $(document).ready(function(){
        initMap(position);
        
        <?php if(!$frontend){?>
        google.maps.event.addListener(marker, 'dragend', function(event) {
		  set_position(event);
		});
        
        google.maps.event.addListener(map, 'zoom_changed', function() {
			$('#zoom').val(map.getZoom());
			
			
		});
        <?php }?>
        $('#btn-load-map').click(function(e){
            
            e.preventDefault();
            
            var lat=$('#lat').val(),
                lon=$('#lon').val();
                
            if(!$.isNumeric(lat) || !$.isNumeric(lon))
            {
                alert('Las coordenadas deben ser números')
                return false;
            }
            
            
            
            options.center={
                    lat:parseFloat(lat),
                    lng:parseFloat(lon)
            };
            
            google.maps.event.trigger(map, 'resize');
            map.setCenter(options.center);
            marker.setPosition(options.center);
            
            
        });
       
   });
function initMap(position) {
  
  map = new google.maps.Map(document.getElementById('map'), options);
  marker = new google.maps.Marker({
			position: position,
			map: map,
			title: '<?=$frontend?$plantel->nombre:'Para una mejor ubicación del Centro Educativo, arrastra este marcador'?>',
			draggable: <?=$frontend?'false':'true'?>
    });
 
}
function set_marker(map,position,title)
{
     marker = new google.maps.Marker({
			position: position,
			map: map,
			title: '<?=$frontend?$plantel->nombre:'Para una mejor ubicación del Centro Educativo, arrastra este marcador'?>',
			draggable: <?=$frontend?'false':'true'?>
    });
}
function set_position(evt){
	
		$('#lat').val(evt.latLng.lat());
		$('#lon').val(evt.latLng.lng());
		
}


</script>
<?php // }?>
  
    