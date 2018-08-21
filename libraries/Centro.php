<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Centro
{
    public function __construct()
	{
	   //ci()->load->model();
       ci()->load->config('centros/usuarios');
    }
    public static function AddUsers($id,$module,$users)
    {
        ci()->db->where(array('module'=>$module,'id_relacion'=>$id))
                ->delete('centros_asignacion');
        if(empty($users))
        {
            return false;
        }
        
        foreach($users as $user)
        {
            $data = array(
            
                'id_relacion' => $id,
                'module'      => $module,
                'user_id'     => $user
                
            );
            
            ci()->db->set($data)
                        ->insert('centros_asignacion');
        }
    }
    public static function GetList($id,$module,$row='user_id')
    {
        $permission = ci()->db->select('*')
                            ->where(array('id_relacion'=>$id,'module'=>$module))
                            ->get('centros_asignacion')->result();
           
        if(!$permission) return false;
                         
        return array_for_select($permission,'id',$row);
    }
    public static function GetPermissions($module)
    {
        $permission = ci()->db->select('*')
                            ->where(array('user_id'=>ci()->current_user->id,'module'=>$module))
                            ->get('centros_asignacion')->result();
            
        if(!$permission) return false;
        
        return array_for_select($permission,'id','id_relacion');
    }
    /*public static function GetPermissions($module='centros')
    {
        
            $permission = ci()->db->select('nombre,centros.id AS id')->join('centros','centros.id=centros_asignacion.id_relacion')
                            ->where(array('user_id'=>ci()->current_user->id,'module'=>$module))
                            ->get('centros_asignacion')->result();
            
            if(!$permission) return false;
            
            
           
            return  array_for_select($permission,'id','nombre');
           
    }*/
}
?>