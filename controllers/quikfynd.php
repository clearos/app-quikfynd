<?php

/**
 * QuikFynd controller.
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
 * QuikFynd controller.
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage controllers
 * @author     QuikFynd <developer@quikfynd.com>
 * @copyright  2016 QuikFynd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.quikfynd.com/clearos/marketplace/apps/quikfynd
 */

class QuikFynd extends ClearOS_Controller
{

    /**
     * QuikFynd default controller
     *
     * @return view
     */

    function index()
    {
        // Load dependencies
        //------------------

        $this->load->library('quikfynd/QuikFynd');
        $this->lang->load('quikfynd');

        // Load views
        //-----------

        $views = array('quikfynd/server', 'quikfynd/summary', 'quikfynd/settings');

        $this->page->view_forms($views, lang('quikfynd_app_name'));
    }
}
