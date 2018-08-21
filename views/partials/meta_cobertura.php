<script type="text/javascript">
    $(document).ready(function(){
        var url_icon='<?=base_url('files/large/d76d12810244f70')?>';
        var centros=<?=json_encode($centros);?>;
        var BASE_URL='<?=base_url()?>';
        
        centro.init(19.0703016, -90.6017716,8);
        
        $.each(centros,function(index,data){
            
           
            
            centro.set_marker({lng:parseFloat(data.longitud),lat:parseFloat(data.latitud)},centro.map,data,url_icon,'<?=base_url()?>centros/detalles/'+data.id);
        });
        
        
        
        
    });
</script>