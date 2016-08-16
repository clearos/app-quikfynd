<?php

/**
 * QuikFynd settings configuration.
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
$this->lang->load('network');
$this->lang->load('quikfynd');

///////////////////////////////////////////////////////////////////////////////
// Form type handling
///////////////////////////////////////////////////////////////////////////////
if ($form_type === 'edit') {
    $read_only = FALSE;
    $buttons = array(
        form_submit_update('submit'),
        anchor_cancel('/app/quikfynd/settings')
    );
} else {
    $read_only = TRUE;
    $buttons = array(
        anchor_edit('/app/quikfynd/settings/edit')
    );
}


///////////////////////////////////////////////////////////////////////////////
// Form
///////////////////////////////////////////////////////////////////////////////

echo form_open('quikfynd/settings');
echo form_header(lang('base_settings'));

echo field_input('port', $port, lang('quikfynd_port'), $read_only);
echo field_button_set($buttons);

echo form_footer();
echo form_close();

// vi: expandtab shiftwidth=4 softtabstop=4 tabstop=4
