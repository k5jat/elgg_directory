<?php

global $CONFIG;

$username = get_input('username');
$user = get_user_by_username($username);

$title = elgg_echo('eCompanies:newlisting');
$header = elgg_view('page_elements/title', array('title' => $title));

if (canCreateCompany(get_loggedin_user())) {
    $body = elgg_view('eCompanies/forms/edit', array('user' => get_loggedin_user()));
} else {
    $body = elgg_echo('eCompanies:noprivileges');
}

$body = elgg_view('page_elements/etools_contentwrapper', array('body' => $body));
$body = elgg_view_layout('two_column_left_sidebar', $area1, $header . $body, $area3);

page_draw($title, $body);
?>

