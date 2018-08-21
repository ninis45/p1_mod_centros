<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Pages Module
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Pages
 */
class Module_Centros extends Module
{
	public $version = '1.0';

	public function info()
	{
		$info=array(
			'name' => array(
				'en' => 'Schools',
			
				'es' => 'Centros educativos',
				
			),
			'description' => array(
				'en' => 'It allows for low and high schools',
				
				'es' => 'Permite dar de alta y baja a escuelas',
				
			),
			'frontend' => true,
			'backend'  => true,
			'skip_xss' => true,
			'menu'	  => 'admin',

			'roles' => array(
				'edit', 'create','delete','contabilidad'
			),
            
            
            
            'sections' => array(
                'centros'=>array(
                    'name'=>'planteles:list_title',
                    'uri' => 'admin/centros',                    
                    'shortcuts' => array(
			             array(
  						    'name' => 'planteles:create_title',
  						    'uri' => 'admin/centros/create',
  						    'class' => 'btn btn-success'
			             )
                    ),
                )
            )
			
		);
        
        if (function_exists('group_has_role'))
		{
			if(group_has_role('centros', 'admin_centros_fields'))
			{
			    
				$info['sections']['fields'] = array(
							'name' 	=> 'global:custom_fields',
							'uri' 	=> 'admin/centros/fields',
								'shortcuts' => array(
									'create' => array(
										'name' 	=> 'streams:add_field',
										'uri' 	=> 'admin/centros/fields/create',
										'class' => 'add'
										)
									)
				);
			}
		}
        
        return $info;
	}

	public function install()
	{
		
		$this->dbforge->drop_table('centros');

		$tables = array(
			
			
				'nombre'    => array('type' => 'VARCHAR', 'constraint' => 254),
                'domicilio' => array('type' => 'TEXT'),
                'municipio'    => array('type' => 'VARCHAR', 'constraint' => 254),
                'localidad'    => array('type' => 'VARCHAR', 'constraint' => 254),
				'clave'     => array('type' => 'VARCHAR', 'constraint' => 254),	
                'telefono'  => array('type' => 'VARCHAR', 'constraint' => 254),	
                'email'     => array('type' => 'VARCHAR', 'constraint' => 254),	
                'tipo'     => array('type' => 'ENUM', 'constraint' =>array('EMSaD','Plantel')),	
                'fecha_creacion' => array('type' => 'DATE','null' => true),	
                'turno'     => array('type' => 'ENUM', 'constraint' => array('matutino','vespertino','ambos')),
                'descripcion' => array('type' => 'TEXT','null'=>true),
                'cuenta_pasivo' => array('type' => 'VARCHAR','constraint'=>'255','null'=>true),
                'director'     => array('type' => 'VARCHAR', 'constraint' => 254,'null'=>true),	
                		
				
			
			
				
			
		);
        
        
        
		 if (!$this->streams->streams->add_stream('centros', 'centros', 'centros'))
		{
			return false;
		}

        return $this->dbforge->add_column('centros', $tables);

		
	}

	public function uninstall()
	{
		 $this->streams->utilities->remove_namespace('centros');
        return true;
	}

	public function upgrade($old_version)
	{
		return true;
	}
}
?>