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
     * Settings controller.
     */

    function index()
    {
        $this->_view_edit('view');
    }

    /**
     * Settings controller.
     *
     * @return view
     */

    function edit()
    {
        $this->_view_edit('edit');
    }

    function _view_edit($form_type = 'view')
    {
        // Load dependencies
        //------------------

        $this->lang->load('base');
        $this->load->library('quikfynd/QuikFynd');

        // Set validation rules
        //---------------------

        $this->form_validation->set_policy('port', 'quikfynd/QuikFynd', 'validate_port', TRUE);
        $form_ok = $this->form_validation->run();

        // Handle form submit
        //-------------------

        //if ($this->input->post('submit') && $form_ok) {
        if ($this->input->post('submit')) {
            try {
                $this->quikfynd->set_port($this->input->post('port'));
                $this->quikfynd->reset(TRUE);
                $this->page->set_status_updated();
                redirect('/quikfynd');
            } catch (Engine_Exception $e) {
                $this->page->view_exception($e);
                return;
            }
        }

        // Load view data
        //---------------

        try {
            $data['form_type'] = $form_type;
            $data['port'] = $this->quikfynd->get_port();
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        $this->page->view_form('quikfynd/settings', $data, lang('base_settings'));
    }
}

// vi: expandtab shiftwidth=4 softtabstop=4 tabstop=4
