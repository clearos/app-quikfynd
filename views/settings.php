<?php

/**
 * QuikFynd settings configuration.
 *
 * @category   apps
 * @package    quikfynd
 * @subpackage views
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
