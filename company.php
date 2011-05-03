<?php

global $CONFIG;

$company_guid = get_input('company_guid');
$company = get_entity($company_guid);

$TabsArray = array(
    'summary' => array('id' => 'company_summary', 'name' => elgg_echo('eCompanies:tabs:summary'), 'view' => 'eCompanies/summary', 'vars' => array('entity' => $company)),
    'reviews' => array('id' => 'company_reviews', 'name' => elgg_echo('eCompanies:tabs:reviews'), 'view' => 'eCompanies/reviews', 'vars' => array('entity' => $company)),
);

$TabsArray = trigger_plugin_hook('eCompanies:companytabs', 'all', array('current' => $TabsArray), $TabsArray);

$body = elgg_view('page_elements/tabs', array('tabs' => $TabsArray));
$body = elgg_view('page_elements/etools_contentwrapper', array('body' => $body));

$area1 = elgg_view_title($company->title);
$area2 = $body;
$area3 = elgg_view('eCompanies/profile', array('entity' => $company));
$area3 = elgg_view('page_elements/etools_contentwrapper', array('body' => $area3));
$area4 = get_submenu() . '<div class="clearfloat"></div>';


$title = elgg_echo('eCompanies:companies');
$body = elgg_view_layout('etools_two_column', $area1, $area2, $area3, $area4);

page_draw($title, $body);
?>
