<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Centros extends Public_Controller
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('centro_m');
        $this->template->municipios=array(
                'Calakmul'   =>'Calakmul',
                'Calkini'    =>'Calkini',                
                'Campeche'   =>'Campeche',                
                'Champoton'  =>'Champotón',
                'Candelaria' =>'Candelaria',
                'Carmen'     =>'Carmen',
                'Escarcega'  =>'Escárcega',
                'Hecelchakan'=>'Hecelchakán',
                'Hopelchen'  =>'Hopelchén',
                'Palizada'   =>'Palizada',
                'Tenabo'     =>'Tenabo',
                
                
                
                
                
      );
      $this->template->set_breadcrumb($this->module_details['name'],'centros');
    }
    function index()
    {
        $centros=$this->centro_m->get_all();
        
        $this->template->append_css('selectize.css')
                        ->append_js('jquery.tablesorter.min.js')
                        //->append_metadata($this->load->view('partials/meta',false,true))
                        ->set('centros',$centros)
    					->title($this->module_details['name'])
    					->build('index');
    }
    function detalles($id=0)
    {
        if(!$centro=$this->centro_m->get($id))
        {
            redirect('centros');
        }
        
        $this->template->title($this->module_details['name'])
                            ->set_breadcrumb($centro->nombre)   
                          ->append_js('module::map.js')                     
                         ->append_metadata($this->load->view('partials/admin/meta',array('plantel'=>$centro,'frontend'=>true),true))
                        ->set('centro',$centro)
    					
    					->build('details');
    }
    function mapa()
    {
        
        
        
        
        $centros=$this->centro_m->select('*')->get_all();
        
        
        
        $this->template->append_css('selectize.css')
                        ->set_breadcrumb('Cobertura',false,true)   
                        ->set('centros',$centros)
    					->title($this->module_details['name'])
                        ->append_js('module::map.js') 
                                       
                        ->append_metadata($this->load->view('partials/meta_cobertura',array('centros'=>$centros),true))
    					->build('cobertura');
    }
    function cobertura()
    {
         $centros=$this->centro_m->select('*')->get_all();
         $this->template->title($this->module_details['name'])  
                        ->append_js('module::map.js')                       
                        ->set_layout('facebook.html')                    
                        ->append_metadata($this->load->view('partials/meta_cobertura',array('centros'=>$centros),true))
    					->build('facebook/cobertura');
    }
}
?>