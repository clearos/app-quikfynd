<?php

/**
 * QuikFynd summary view.
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage views
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
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('base');
$this->lang->load('quikfynd');

if (!$is_running)
    echo infobox_warning(
        lang('quikfynd_app_name'),
        "<div>" . lang('quikfynd_not_available') . "</div>"
    );
