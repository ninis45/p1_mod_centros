<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Group model
 *
 * @author		Phil Sturgeon
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Modules\Groups\Models
 *
 */
class Directores_m extends MY_Model
{
    private $folder;

	public function __construct()
	{
		parent::__construct();
		$this->_table = 'default_directores';
		
	}
    function update_list($id=0)
    {
        $directores = $this->session->userdata('directores');
        
        foreach($directores as $director)
        {
            $data = array(
            
                'id_centro'     => $id,
                'nombre'        => $director['nombre'],
                'cuenta_pasivo' => $director['cuenta_pasivo'],
                'fecha_ini'     => $director['fecha_ini'],
                'fecha_fin'     => $director['fecha_fin'],
                 
            );
            
            $this->insert($data);
        }
    }
}
 ?>