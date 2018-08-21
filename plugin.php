<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Centros extends Plugin
{
    public function display()
    {
        $html='<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?file=api&v=3&&key=AIzaSyAHXd_wbPYIVTEtQRhFNZWp6t45UVhLncs"></script>';
    
        
    
        return $html;
    }
    function get_centro_user()
    {
        if($this->current_user == FALSE) {
            
            return false;
        }
        
        $result = $this->db->select('centros.nombre,centros.tipo')
                ->where('user_id',$this->current_user->id)
                ->join('centros','centros.id=directores.id_centro')
                ->get('directores')->row();
                
                
        return $result->nombre;
    }
    
}
?>