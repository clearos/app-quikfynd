<?php

/**
 * QuikFynd settings controller.
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage controllers
 * @author     QuikFynd <developer@quikfynd.com>
 * @copyright  2016 QuikFynd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.quikfynd.com/clearos/marketplace/apps/quikfynd
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
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
 * @author     QuikFynd <developer@quikfynd.com>
 * @copyright  2016 QuikFynd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.quikfynd.com/clearos/marketplace/apps/quikfynd
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
