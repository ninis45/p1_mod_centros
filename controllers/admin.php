<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Roles controller for the groups module
 *
 * @author		Phil Sturgeon
 * @author		PyroCMS Dev Team
 * @package	 PyroCMS\Core\Modules\Groups\Controllers
 *
 */
class Admin extends Admin_Controller
{

	/**
	 * Constructor method
	 */
	protected $section = 'centros';
	public function __construct()
	{
			parent::__construct();
            $this->lang->load('planteles');
            
            $this->load->model(array('centro_m','directores_m'));
            $this->load->config('usuarios');
            $this->load->library('Centro');
            
            $this->validation_rules = array(
				
					array(
						'field' => 'nombre',
						'label' => 'Nombre',
						'rules' => 'trim|required'
					),
    	           array(
						'field' => 'descripcion',
						'label' => 'Descripción',
						'rules' => 'trim'
					),
    	           array(
						'field' => 'domicilio',
						'label' => 'Domicilio',
						'rules' => 'trim|required'
					),
                    array(
						'field' => 'municipio',
						'label' => 'Municipio',
						'rules' => 'trim|required'
					),
                    array(
						'field' => 'localidad',
						'label' => 'Localidad',
						'rules' => 'trim|required'
					),
                    array(
						'field' => 'latitud',
						'label' => 'Latitud',
						'rules' => 'trim'
					),
                    array(
						'field' => 'longitud',
						'label' => 'Longitud',
						'rules' => 'trim'
					),
                    array(
						'field' => 'zoom',
						'label' => 'Zoom',
						'rules' => 'trim'
					),
    	           array(
						'field' => 'clave',
						'label' => 'Clave',
						'rules' => 'trim'
					),
                    array(
						'field' => 'telefono',
						'label' => 'Teléfono',
						'rules' => 'trim'
					),
                     array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'trim'
					),
                     
                    array(
						'field' => 'turno',
						'label' => 'Turno',
						'rules' => 'trim|required'
					),
                    array(
						'field' => 'tipo',
						'label' => 'Tipo',
						'rules' => 'trim|required'
					),
                     array(
						'field' => 'director',
						'label' => 'Director',
						'rules' => 'trim'
					),
                    array(
						'field' => 'fecha_creacion',
						'label' => 'Fecha creacion',
						'rules' => 'trim'
					),
                    array(
						'field' => 'users',
						'label' => 'Users',
						'rules' => ''
					),
            );
            
            $this->template->municipios=array(
                'Calakmul'   =>'Calakmul',
                'Calkiní'    =>'Calkiní',                
                'Campeche'   =>'Campeche',                
                'Champotón'  =>'Champotón',
                'Candelaria' =>'Candelaria',
                'Carmen'     =>'Carmen',
                'Escárcega'  =>'Escárcega',
                'Hecelchakán'=>'Hecelchakán',
                'Hopelchén'  =>'Hopelchén',
                'Palizada'   =>'Palizada',
                'Tenabo'     =>'Tenabo',
                
                
                
                
                
            );
    }
    function index()
    {
   	    $items = $this->centro_m->get_all();
        
        $this->template->title()
                ->set('items',$items)
                ->build('admin/index');
    }
    function create()
    {
        
        role_or_die($this->section, 'create');
        
        $plantel=new StdClass();
        $config_usuarios = $this->config->item('usuarios');
        // Get the blog stream.
		$this->load->driver('Streams');
		$stream = $this->streams->streams->get_stream('centros', 'centros');
		$stream_fields = $this->streams_m->get_stream_fields($stream->id, $stream->stream_namespace);
        
        $plantel_validation = $this->streams->streams->validation_array($stream->stream_slug, $stream->stream_namespace, 'new');
        
        
        $this->form_validation->set_rules(array_merge($this->validation_rules, $plantel_validation));
        
        
        if ($this->form_validation->run())
		{
            $extra=array(
            
                'nombre'    => $this->input->post('nombre'),
                'domicilio' => $this->input->post('domicilio'),
                'descripcion' => $this->input->post('descripcion'),
                'latitud'   => $this->input->post('latitud'),
                'longitud'  => $this->input->post('longitud'),
                'zoom'      => $this->input->post('zoom')?$this->input->post('zoom'):NULL,
                'municipio' => $this->input->post('municipio'),
                'localidad' => $this->input->post('localidad'),
                
                'turno'     => $this->input->post('turno'),
                'tipo'      => $this->input->post('tipo'),
                'fecha_creacion' => $this->input->post('fecha_creacion')?$this->input->post('fecha_creacion'):NULL,
                'clave'    => $this->input->post('clave'),
                'telefono' => $this->input->post('telefono'),
                'email'    => $this->input->post('email'),
                
                'created'  => date('Y-m-d H:i:s', now())
                
                
            );
            
            if($id = $this->streams->entries->insert_entry($_POST, 'centros', 'centros', array('created'), $extra))
            {
				
				$this->session->set_flashdata('success',sprintf(lang('planteles:add_success'),$this->input->post('nombre')));
				redirect('admin/centros');
				
			}
            else
            {
				$this->session->set_flashdata('error',lang('planteles:save_error'));
				redirect('admin/centros/create');
			}
        }
        else
        {
            foreach ($this->validation_rules as $key => $field)
    		{
    				$plantel->$field['field'] = $this->input->post($field['field']); //set_value($field['field']);
                    
                    
    		}
        }
        //print_r($plantel);
         // Set Values
		$values = $this->fields->set_values($stream_fields, $plantel, 'new');
        
        $usuarios = $this->db->select('*,users.id AS id')
                            ->where_in('groups.name',$config_usuarios)
                            ->join('groups','groups.id=users.group_id')
                            ->join('profiles','profiles.user_id=users.id')
                            ->get('users')
                            ->result();
        
        $this->template->title($this->module_details['name'])
                ->append_metadata('<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?file=api&v=3&&key=AIzaSyAHXd_wbPYIVTEtQRhFNZWp6t45UVhLncs"></script>')
                ->append_metadata($this->load->view('partials/admin/meta',array('plantel'=>$plantel,'frontend'=>false),true))
                ->append_js('module::centro.factory.js')
                ->append_js('module::centro.controller.js')
                ->set('stream_fields', $this->streams->fields->get_stream_fields($stream->stream_slug, $stream->stream_namespace, $values))
                ->set('plantel',$plantel)
                ->set('usuarios',$usuarios)
                ->set('id',false)
                ->build('admin/form');
    }
    function edit($id)
    {
        
        role_or_die($this->section, 'edit');
        
        $plantel=$this->centro_m->get_centro($id);
        
        
        $config_usuarios = $this->config->item('usuarios');
         
         // Get the blog stream.
		$this->load->driver('Streams');
		$stream = $this->streams->streams->get_stream('centros', 'centros');
		$stream_fields = $this->streams_m->get_stream_fields($stream->id, $stream->stream_namespace);
        
        $plantel_validation = $this->streams->streams->validation_array($stream->stream_slug, $stream->stream_namespace, 'new');
        
        
        $this->form_validation->set_rules(array_merge($this->validation_rules, $plantel_validation));
        
        
        if ($this->form_validation->run())
		{
		      $extra=array(
            
                'nombre'    => $this->input->post('nombre'),
                'domicilio' => $this->input->post('domicilio'),
                'descripcion' => $this->input->post('descripcion'),
                'municipio'   => $this->input->post('municipio'),
                
                'localidad' => $this->input->post('localidad'),
                'latitud'   => $this->input->post('latitud'),
                'longitud'  => $this->input->post('longitud'),
                'zoom'      => $this->input->post('zoom')?$this->input->post('zoom'):NULL,
                'turno'     => $this->input->post('turno'),
                'tipo'      => $this->input->post('tipo'),
                'fecha_creacion' => $this->input->post('fecha_creacion')?$this->input->post('fecha_creacion'):NULL,
                'clave'    => $this->input->post('clave'),
                'telefono' => $this->input->post('telefono'),
                'email'            => $this->input->post('email'),
                
                'updated'  => date('Y-m-d H:i:s', now())
                
                
            );
            
            
		    if($this->streams->entries->update_entry($id, $_POST, 'centros', 'centros', array('updated'), $extra))
            {
                
               Centro::AddUsers($id,'centros',$this->input->post('users'));
                
           	    $this->session->set_flashdata('success',sprintf(lang('planteles:edit_success'),$this->input->post('nombre')));
				
            }
            else
            {
                $this->session->set_flashdata('error',lang('planteles:save_error'));
            }
            
            redirect('admin/centros/edit/'.$id);
        }
        elseif($_POST)
        {
            $plantel = (Object)$_POST;
        }
         // Set Values
		$values = $this->fields->set_values($stream_fields, $plantel, 'edit');

		// Run stream field events
		 $this->fields->run_field_events($stream_fields, array(), $values);	
         
         
         //print_r($config_usuarios);
         $usuarios = $this->db->select('*,users.id AS id')
                            ->where_in('groups.name',$config_usuarios)
                            ->join('groups','groups.id=users.group_id')
                            ->join('profiles','profiles.user_id=users.id')
                            ->get('users')
                            ->result();
        
         $this->template->title($this->module_details['name'])
                ->append_metadata('<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?file=api&v=3&&key=AIzaSyAHXd_wbPYIVTEtQRhFNZWp6t45UVhLncs"></script>')
                ->append_js('module::map.js')
                ->append_metadata($this->load->view('partials/admin/meta',array('plantel'=>$plantel,'frontend'=>false),true))
                ->append_js('module::centro.factory.js')
                ->append_js('module::centro.controller.js')
                ->set('stream_fields', $this->streams->fields->get_stream_fields($stream->stream_slug, $stream->stream_namespace, $values, $plantel->id))
                ->set('plantel',$plantel)
                ->set('usuarios',$usuarios)
                ->set('id',$id)
                ->build('admin/form');
    }
    function delete($id=0)
    {
        
        role_or_die($this->section, 'delete');
        
        $this->load->library('files/files');
        $plantel=$this->centro_m->get($id) ;
        
        $directores = $this->db->where('id_centro',$id)->get('directores')->result();
        
        if (!$directores && $plantel && $this->centro_m->delete($id))
		{
		    if(isset($plantel->portada))
            {
                Files::delete_file($plantel->portada);
            }
			

			$this->session->set_flashdata('success', sprintf(lang('planteles:delete_success'),$plantel->nombre));
		}
		else
		{
			$this->session->set_flashdata('error', lang('planteles:delete_error'));
		}

		redirect('admin/centros');
    }
    
   
}
?>