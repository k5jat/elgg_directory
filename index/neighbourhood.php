<?php

global $CONFIG;

$user = $_SESSION['user'];

$title = elgg_echo('eCompanies:neighbourhood');
$header = elgg_view('page_elements/title', array('title' => $title));

$TabsArray = array();

$TabsArray['all'] = array(
    'id' => 'all_companies',
    'name' => elgg_echo('eCompanies:tabs:all'),
    'view' => 'eCompanies/maps/global_map',
    'vars' => array('companies' => elgg_get_entities(array('types' => 'object', 'subtypes' => 'company')))
);

if (is_plugin_enabled('edifice')) {
    $categories = elgg_get_entities_from_metadata(array(
                'metadata_name' => 'level',
                'metadata_value' => 1,
                'type' => 'object',
                'subtype' => 'category',
                'limit' => 9999,
                'order_by_metadata' => array('name' => 'sort', 'direction' => ASC, 'as' => text)));
    foreach ($categories as $category) {
        $companies = get_filed_items_by_type($category->guid, 'object', 'company');
        $TabsArray[$category->guid] = array(
            'id' => $category->guid,
            'name' => $category->title,
            'view' => 'eCompanies/maps/global_map',
            'vars' => array('companies' => $companies)
        );
    }
}

$area1 = elgg_view('page_elements/tabs', array('tabs' => $TabsArray));
$area1 = elgg_view('page_elements/etools_contentwrapper', array('body' => $area1));
$area2 = '';
$area3 = '';
$area4 = get_submenu() . '<div class="clearfloat"></div>';

$body = elgg_view_layout('etools_two_column', $header . $area1, $area2, $area3, $area4);

page_draw($title, $body);
?>
