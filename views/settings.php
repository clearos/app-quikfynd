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
$this->lang->load('quikfynd');
$this->lang->load('network');

if ($sanity_check_fw != NULL)
    echo infobox_warning(
        lang('base_warning'),
        "<div>" . $sanity_check_fw . "</div>"
    );
///////////////////////////////////////////////////////////////////////////////
// Form open
///////////////////////////////////////////////////////////////////////////////

echo form_open('quikfynd/settings/edit');
echo form_header(lang('base_settings'));

///////////////////////////////////////////////////////////////////////////////
// Form fields and buttons
///////////////////////////////////////////////////////////////////////////////

if ($edit) {
    $read_only = FALSE;
    $buttons = array(
        form_submit_update('submit'),
        anchor_cancel('/app/quikfynd')
    );
} else {
    $read_only = TRUE;
    $buttons = array(
        anchor_edit('/app/quikfynd/settings/edit'),
    );
}

echo field_input('example', $example, lang('quikfynd_example'), $read_only);
echo field_button_set($buttons);

///////////////////////////////////////////////////////////////////////////////
// Form close
///////////////////////////////////////////////////////////////////////////////

echo form_footer();
echo form_close();

// vi: expandtab shiftwidth=4 softtabstop=4 tabstop=4
