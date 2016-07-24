<?php

/**
 * QuikFynd settings controller.
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage controllers
 * @author     QuikFynd <support@quikfynd.com>
 * @copyright  2016 QuikFynd
 * @license    Proprietary http://www.quikfynd.com/terms
 * @link       http://www.quikfynd.com/wddownloads/
 */

///////////////////////////////////////////////////////////////////////////////
//
// Use of this program requires that you adhere to the terms and conditions
// stated here - http://www.quikfynd.com/terms
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// D E P E N D E N C I E S
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * QuikFynd settings controller.
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage controllers
 * @author     QuikFynd <support@quikfynd.com>
 * @copyright  2016 QuikFynd
 * @license    Proprietary http://www.quikfynd.com/terms
 * @link       http://www.quikfynd.com/wddownloads/
 */

class Settings extends ClearOS_Controller
{
    /**
     * Index.
     */

    function index()
    {
        // Load libraries
        //---------------

        $this->load->library('quikfynd/QuikFynd');

        // Load view data
        //---------------

        $data = array(
            'edit' => FALSE,
        );

        $data['sanity_check_fw'] = $this->quikfynd->sanity_check_fw();

        $this->page->view_form('quikfynd/settings', $data, lang('base_settings'));
    }

    /**
     * Edit settings view.
     *
     * @return view
     */

    function edit()
    {
        // Load libraries
        //---------------

        $this->load->library('quikfynd/QuikFynd');

        // Set validation rules
        //---------------------
       
        $this->form_validation->set_policy('mode', 'quikfynd/QuikFynd', 'validate_example');
        $form_ok = $this->form_validation->run();

        // Handle form submit
        //-------------------
        if ($form_ok) {
            try {
                $this->quikfynd->set_example($this->input->post('example'));
                redirect('/quikfynd');
                return;
            } catch (Exception $e) {
                $this->page->set_message(clearos_exception_message($e), 'warning');
            }
        }

        $data = array(
            'edit' => TRUE,
            'example' => $this->quikfynd->get_example()
        );

        $this->page->view_form('quikfynd/settings', $data, lang('base_settings'));
    }
}

// vi: expandtab shiftwidth=4 softtabstop=4 tabstop=4
