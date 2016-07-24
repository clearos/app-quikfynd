<?php

/**
 * QuikFynd daemon controller.
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

require clearos_app_base('base') . '/controllers/daemon.php';

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * QuikFynd daemon controller.
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage controllers
 * @author     QuikFynd <support@quikfynd.com>
 * @copyright  2016 QuikFynd
 * @license    Proprietary http://www.quikfynd.com/terms
 * @link       http://www.quikfynd.com/wddownloads/
 */

class Server extends Daemon
{
    /**
     * Server controller constructor.
     */

    function __construct()
    {
        parent::__construct('quikfynd', 'quikfynd');
    }
}
