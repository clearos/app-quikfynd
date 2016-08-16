<?php

/**
 * QuikFynd controller.
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
// B O O T S T R A P
///////////////////////////////////////////////////////////////////////////////

$bootstrap = getenv('CLEAROS_BOOTSTRAP') ? getenv('CLEAROS_BOOTSTRAP') : '/usr/clearos/framework/shared';
require_once $bootstrap . '/bootstrap.php';

///////////////////////////////////////////////////////////////////////////////
// D E P E N D E N C I E S
///////////////////////////////////////////////////////////////////////////////

require clearos_app_base('network') . '/controllers/network_check.php';

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * QuikFynd controller.
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage controllers
 * @author     QuikFynd <support@quikfynd.com>
 * @copyright  2016 QuikFynd
 * @license    Proprietary http://www.quikfynd.com/terms
 * @link       http://www.quikfynd.com/wddownloads/
 */

class Network extends Network_Check
{
    /**
     * Network check constructor.
     */

    function __construct()
    {
        clearos_log('quikfynd-network', 'Constructed');
        parent::__construct('quikfynd');
    }

    /**
     * Network check view.
     *
     * @return view
     */

    function index()
    {
        // Load dependencies
        //------------------
        clearos_log('quikfynd-network', 'index');

        $this->load->library('quikfynd/QuikFynd');
        $port = $this->quikfynd->get_port();
        parent::index('TCP', $port);
        parent::index('TCP', $port+1);
    }
}
