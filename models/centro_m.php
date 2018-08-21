<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Group model
 *
 * @author		Phil Sturgeon
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Modules\Groups\Models
 *
 */
class Centro_m extends MY_Model
{
    private $folder;

	public function __construct()
	{
		parent::__construct();
		$this->_table = 'default_centros';
		
	}
    function get_centro($id)
    {
        if($result = $this->get($id))
        {
            $users = $this->db->select('id,user_id')->where(array('module'=>'centros','id_relacion'=>$id))->get('centros_asignacion')->result();
            
            //print_r($users);
            $result->users = $users? array_for_select($users,'id','user_id'):array();
            
            
            return $result;
        }
        return false;
    }
    function get_plantel($id)
    {
        if($result = $this->get($id))
        {
            //$result->fecha_creacion = format_date_calendar($result->fecha_creacion);
            
            return $result;
        }
        return false;
    }
    function create($input)
    {
        
        /*return $this->insert(array(
        
                'nombre'    => $input['nombre'],
                'domicilio' => $input['domicilio'],
                'turno'     => $input['turno'],
                'fecha_creacion' => $input['fecha_creacion']?$input['fecha_creacion']:NULL,
                'clave'    => $input['clave'],
                'telefono' => $input['telefono'],
                'email'    => $input['email'],
                'created'  => date('Y-m-d H:i:s', now())
        ));*/
        
    }
}