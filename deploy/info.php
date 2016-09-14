<?php

/////////////////////////////////////////////////////////////////////////////
// General information
///////////////////////////////////////////////////////////////////////////// 
$app['basename'] = 'quikfynd';
$app['version'] = '2.0.2';
$app['release'] = '1';
$app['vendor'] = 'QuikFynd';
$app['packager'] = 'QuikFynd';
$app['license'] = 'Proprietary';
$app['license_core'] = 'Proprietary';
$app['description'] = lang('quikfynd_app_description');
$app['tooltip'] = array(
    lang('quikfynd_tooltip_1'),
    lang('quikfynd_tooltip_2')
);

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('quikfynd_app_name');
$app['category'] = lang('base_category_server');
$app['subcategory'] = lang('base_subcategory_file');

/////////////////////////////////////////////////////////////////////////////
// Controllers
/////////////////////////////////////////////////////////////////////////////

$app['controllers']['quikfynd']['title'] = $app['name'];

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['requires'] = array(
    'app-network',
);

$app['core_requires'] = array(
    # app-network-core >= 1:1.4.5', This line crashes webconfig! Commenting for now.
    # 'quikfynd' TODO - when binary packaging is complete, add dependency
);

$app['core_file_manifest'] = array(
    'quikfynd.php' => array('target' => '/var/clearos/base/daemon/quikfynd.php'),
    'quikfynd.conf' => array(
        'target' => '/etc/clearos/quikfynd.conf',
        'mode' => '0644',
        'owner' => 'webconfig',
        'group' => 'webconfig',
        'config' => TRUE,
        'config_params' => 'noreplace'
    )
);

$app['delete_dependency'] = array(
    'app-quikfynd-core',
    'quikfynd'
);
