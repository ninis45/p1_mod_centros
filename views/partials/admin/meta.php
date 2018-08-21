<script type="text/javascript">
 $(document).ready(function(){
    centro.dragable=<?=$frontend?'false':'true'?>;
    
    centro.init(<?=$plantel->latitud?$plantel->latitud:'19.833932192097134'?>, <?=$plantel->longitud?$plantel->longitud:'-90.5467695763607'?>,<?=$plantel->zoom?$plantel->zoom:'8'?>);
    
    centro.set_marker(centro.position,centro.map);
    
    
    <?php if(!$frontend){?>
        google.maps.event.addListener(centro.marker, 'dragend', function(event) {
		  centro.set_position(event);
		});
        
        google.maps.event.addListener(centro.map, 'zoom_changed', function() {
			$('#zoom').val(centro.map.getZoom());
			
			
		});
    <?php }?>
 });

</script>
