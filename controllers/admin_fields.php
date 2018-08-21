<?php defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Admin Blog Fields
 *
 * Manage custom blogs fields for
 * your blog.
 *
 * @author 		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Users\Controllers
 */
class Admin_fields extends Admin_Controller {

	protected $section = 'fields';

	// --------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
        
		// If they cannot administer profile fields,
		// then they can't access anythere here.
		

		
		$this->lang->load(array('planteles'));
	}

	// --------------------------------------------------------------------------
	
	/**
	 * List out profile fields
	 *
	 * @access 	public
	 * @return 	void
	 */
	public function index()
	{
		$extra['title'] = 'Campos del Evento';
        $extra['buttons'] = array(
            array(
                    'label'     => lang('global:edit'),
                    'url'       => 'admin/centros/fields/edit/-assign_id-'
            ),
            array(
                    'label'     => lang('global:delete'),
                    'url'       => 'admin/centros/fields/delete/-assign_id-',
                    'confirm'   => true,
            )
        );
        
        $this->streams->cp->assignments_table('centros', 'centros', null, null, true, $extra);
	}

	// --------------------------------------------------------------------------

	/**
	 * Create
	 *
	 * Create a new custom blog field
	 *
	 * @access 	public
	 * @return 	void
	 */
	public function create()
	{
		$extra['title'] 		= lang('streams:add_field');
		$extra['show_cancel'] 	= true;
		$extra['cancel_uri'] 	= 'admin/centros/fields';

		$this->streams->cp->field_form('centros', 'centros', 'new', 'admin/centros/fields', null, array(), true, $extra);
	}

	// --------------------------------------------------------------------------

	/**
	 * Delete
	 *
	 * Delete a custom blog profile field.
	 *
	 * @access 	public
	 * @return 	void
	 */
	public function delete()
	{
		if ( ! $assign_id = $this->uri->segment(5))
		{
			show_error(lang('streams:cannot_find_assign'));
		}
	
		// Tear down the assignment
		if ( ! $this->streams->cp->teardown_assignment_field($assign_id))
		{
		    $this->session->set_flashdata('notice', lang('streams:field_delete_error'));
		}
		else
		{
		    $this->session->set_flashdata('success', lang('streams:field_delete_success'));			
		}
	
		redirect('admin/centros/fields');
	}

	// --------------------------------------------------------------------------

	/**
	 * Edit a profile field
	 *
	 * @access 	public
	 * @return 	void
	 */
	public function edit()
	{
		if ( ! $assign_id = $this->uri->segment(5))
		{
			show_error(lang('streams:cannot_find_assign'));
		}

		$extra = array(
			'title'			=> lang('streams:edit_field'),
			'show_cancel'	=> true,
			'cancel_uri'	=> 'admin/centros/fields'
		);

		$this->streams->cp->field_form('centros', 'centros', 'edit', 'admin/centros/fields', $assign_id, array(), true, $extra);
	}
}
?>