<?php

global $CONFIG;

$title = elgg_echo('eCompanies:everyone');
$header = elgg_view('page_elements/title', array('title' => $title));
$body = elgg_view('eCompanies/filter');
$body .= elgg_view('eCompanies/list');
$body = elgg_view('page_elements/etools_contentwrapper', array('body' => $body));
$body = elgg_view_layout('two_column_left_sidebar', $area1, $header . $body, $area3);

page_draw($title, $body);

?>
