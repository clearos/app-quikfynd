<?php

/**
 * QuikFynd status controller
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage controllers
 * @author     QuikFynd <developer@quikfynd.com>
 * @copyright  2016-2015 QuikFynd
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
// B O O T S T R A P
///////////////////////////////////////////////////////////////////////////////

$bootstrap = getenv('CLEAROS_BOOTSTRAP') ? getenv('CLEAROS_BOOTSTRAP') : '/usr/clearos/framework/shared';
require_once $bootstrap . '/bootstrap.php';

///////////////////////////////////////////////////////////////////////////////
// D E P E N D E N C I E S
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * QuikFynd status controller
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage controllers
 * @author     QuikFynd <developer@quikfynd.com>
 * @copyright  2016 QuikFynd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.quikfynd.com/clearos/marketplace/apps/quikfynd
 */

class Summary extends ClearOS_Controller
{
    /**
     * QuikFynd users controller
     *
     * @return view
     */

    function index()
    {
        // Load dependencies
        //------------------

        $this->lang->load('quikfynd');
        $this->load->library('quikfynd/QuikFynd');

        // Load view data
        //---------------
        $data['is_running'] = $this->quikfynd->get_running_state();

        // Load views
        //-----------

        $this->page->view_form('quikfynd/summary', $data, lang('quikfynd_app_name'));
    }
}
