<?php

/**
 * QuikFynd class.
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage libraries
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
// N A M E S P A C E
///////////////////////////////////////////////////////////////////////////////

namespace clearos\apps\quikfynd;

///////////////////////////////////////////////////////////////////////////////
// B O O T S T R A P
///////////////////////////////////////////////////////////////////////////////

$bootstrap = getenv('CLEAROS_BOOTSTRAP') ? getenv('CLEAROS_BOOTSTRAP') : '/usr/clearos/framework/shared';
require_once $bootstrap . '/bootstrap.php';

///////////////////////////////////////////////////////////////////////////////
// T R A N S L A T I O N S
///////////////////////////////////////////////////////////////////////////////

clearos_load_language('quikfynd');

///////////////////////////////////////////////////////////////////////////////
// D E P E N D E N C I E S
///////////////////////////////////////////////////////////////////////////////

// Classes
//--------

use \clearos\apps\base\Configuration_File as Configuration_File;
use \clearos\apps\base\Daemon as Daemon;
use \clearos\apps\base\File as File;
use \clearos\apps\network\Network_Utils as Network_Utils;

clearos_load_library('base/Configuration_File');
clearos_load_library('base/Daemon');
clearos_load_library('base/File');
clearos_load_library('network/Network_Utils');

// Exceptions
//-----------

use \Exception as Exception;
use \clearos\apps\base\Engine_Exception as Engine_Exception;
use \clearos\apps\base\Validation_Exception as Validation_Exception;

clearos_load_library('base/Engine_Exception');
clearos_load_library('base/Validation_Exception');

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * QuikFynd class.
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage libraries
 * @author     QuikFynd <support@quikfynd.com>
 * @copyright  2016 QuikFynd
 * @license    Proprietary http://www.quikfynd.com/terms
 * @link       http://www.quikfynd.com/wddownloads/
 */

class QuikFynd extends Daemon
{
    ///////////////////////////////////////////////////////////////////////////////
    // C O N S T A N T S
    ///////////////////////////////////////////////////////////////////////////////
    const FILE_CONFIG = "/etc/clearos/quikfynd.conf";

    ///////////////////////////////////////////////////////////////////////////////
    // V A R I A B L E S
    ///////////////////////////////////////////////////////////////////////////////

    protected $config = NULL;
    protected $is_loaded = FALSE;

    ///////////////////////////////////////////////////////////////////////////////
    // M E T H O D S
    ///////////////////////////////////////////////////////////////////////////////

    /**
     * QuikFynd constructor.
     */

    function __construct()
    {
        clearos_profile(__METHOD__, __LINE__);
        clearos_log('quikfynd', 'Constructed');

        parent::__construct('quikfynd');
    }

    /**
     * Returns port.
     *
     * @return integer port number
     * @throws Engine_Exception
     */

    public function get_port()
    {
        clearos_profile(__METHOD__, __LINE__);
        clearos_log('quikfynd', 'get_port');

        if (! $this->is_loaded)
            $this->_load_config();

        if (isset($this->config['BasePort']))
            return $this->config['BasePort'];
        else
            return self::DEFAULT_PORT;
    }

    /**
     * Sets port.
     *
     * @param integer $port port
     *
     * @return void
     * @throws Engine_Exception, Validation_Exception
     */

    public function set_port($port)
    {
        clearos_profile(__METHOD__, __LINE__);
        clearos_log('quikfynd', 'set_port: '.$port);

        Validation_Exception::is_valid($this->validate_port($port));

        $this->_set_parameter('BasePort', $port);
    }

    ///////////////////////////////////////////////////////////////////////////////
    // V A L I D A T I O N   M E T H O D S
    ///////////////////////////////////////////////////////////////////////////////

    /**
     * Validates port.
     *
     * @param integer $port port
     *
     * @return string error message if port is invalid
     */

    public function validate_port($port)
    {
        clearos_profile(__METHOD__, __LINE__);
        clearos_log('quikfynd', 'validate_port: '.$port);

        if (! Network_Utils::is_valid_port($port)) {
            return lang('network_port_invalid');
        }
    }

    ///////////////////////////////////////////////////////////////////////////////
    // P R I V A T E   M E T H O D S
    ///////////////////////////////////////////////////////////////////////////////

    /**
    * loads configuration files.
    *
    * @return void
    * @throws Engine_Exception
    */

    protected function _load_config()
    {
        clearos_profile(__METHOD__, __LINE__);

        $configfile = new Configuration_File(self::FILE_CONFIG);

        $this->config = $configfile->load();

        $this->is_loaded = TRUE;
    }

    /**
     * Generic set routine.
     *
     * @param string $key   key name
     * @param string $value value for the key
     *
     * @return  void
     * @throws Engine_Exception
     */

    private function _set_parameter($key, $value)
    {
        clearos_profile(__METHOD__, __LINE__);

        try {
            $file = new File(self::FILE_CONFIG, TRUE);
            $match = $file->replace_lines("/^$key\s*=\s*/", "$key = $value\n");
            if (!$match)
                $file->add_lines("$key = $value\n");
        } catch (Exception $e) {
            throw new Engine_Exception(clearos_exception_message($e), CLEAROS_ERROR);
        }

        $this->is_loaded = FALSE;
    }

}
