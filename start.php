<?php

include_once(dirname(__FILE__) . '/models/model.php');

function ecompanies_init() {

    global $CONFIG;

    register_action('company/save', false, $CONFIG->pluginspath . 'eCompanies/actions/save.php', false);
    register_action('company/delete', false, $CONFIG->pluginspath . 'eCompanies/actions/delete.php', false);

    register_entity_type('object', 'company');
    register_page_handler('companies', 'ecompanies_page_handler');
    register_entity_url_handler('ecompanies_url_handler', 'object', 'company');

    extend_view('profile/icon', 'eCompanies/icon');
    register_plugin_hook('entity:icon:url', 'object', 'company_icon_hook');

    extend_view('css', 'eCompanies/css');
    extend_view('css', 'eTools/css');
    elgg_extend_view('input', 'eCompanies/filter');

    extend_view('metatags', 'eCompanies/maps/metatags');
    elgg_extend_view('page_elements', 'eCompanies/maps/company_map');
    elgg_extend_view('js', 'eCompanies/maps/js');
    extend_view('index/righthandside', 'eCompanies/latest');
    
    add_menu(elgg_echo('eCompanies:menu'), $CONFIG->wwwroot . 'pg/companies/all');
}

function ecompanies_pagesetup() {
    global $CONFIG;

//add submenu options
    if (get_context() == "companies") {
        add_submenu_item(elgg_echo('eCompanies:neighbourhood'), $CONFIG->wwwroot . "pg/companies/neighbourhood");
        if (isloggedin()) add_submenu_item(elgg_echo('eCompanies:network'), $CONFIG->wwwroot . "pg/companies/network/" . $_SESSION['user']->username);
        add_submenu_item(elgg_echo('eCompanies:everyone'), $CONFIG->wwwroot . "pg/companies/all/");

        if (canCreateCompany(get_loggedin_user())) {
            add_submenu_item(elgg_echo('eCompanies:your'), $CONFIG->wwwroot . "pg/companies/owner/" . $_SESSION['user']->username);
            add_submenu_item(elgg_echo('eCompanies:addcompany'), $CONFIG->wwwroot . "pg/companies/new/{$_SESSION['user']->username}/");
        }
    }
}

function ecompanies_page_handler($page) {

    global $CONFIG;

    if (isset($page[0])) {

        switch ($page[0]) {
            case 'neighbourhood' :
                include($CONFIG->pluginspath . 'eCompanies/index/neighbourhood.php');
                break;

            case 'network' :
                set_input('username', $page[1]);
                include($CONFIG->pluginspath . 'eCompanies/index/network.php');
                break;

            case 'owner' :
                set_input('username', $page[1]);
                include($CONFIG->pluginspath . 'eCompanies/index/owner.php');
                break;

            case 'new' :
                set_input('username', $page[1]);
                include($CONFIG->pluginspath . 'eCompanies/index/new.php');
                break;

            case 'edit' :
                set_input('company_guid', $page[1]);
                include($CONFIG->pluginspath . 'eCompanies/index/edit.php');
                break;

            case 'icon':
                if (isset($page[1])) {
                    set_input('company_guid', $page[1]);
                }
                if (isset($page[2])) {
                    set_input('size', $page[2]);
                }
                include($CONFIG->pluginspath . "eCompanies/graphics/eCompanies/icon.php");
                break;

            case 'view' :
                set_input('company_guid', $page[1]);
                include($CONFIG->pluginspath . 'eCompanies/company.php');
                break;

            case 'all' :
            default :
                include($CONFIG->pluginspath . 'eCompanies/index/all.php');
                break;
        }
    } else {
        register_error(elgg_echo('eCompanies:error'));
        forward($_SERVER['HTTP_REFERER']);
    }
}

function company_icon_hook($hook, $entity_type, $returnvalue, $params) {

    global $CONFIG;
    if ((!$returnvalue) && ($hook == 'entity:icon:url') && ($params['entity'] instanceof ElggObject) && ($params['entity']->getSubtype() == 'company')) {

        $entity = $params['entity'];
        $size = $params['size'];
        $filehandler = new ElggFile();
        $filehandler->owner_guid = $entity->owner_guid;
        $filehandler->setFilename("company/" . $entity->guid . $size . ".jpg");

        $url = $CONFIG->url . "pg/companies/icon/{$entity->guid}/{$size}/company.jpg";
        return $url;
    }
}

function ecompanies_url_handler($company) {
    global $CONFIG;
    return $CONFIG->wwwroot . "pg/companies/view/" . $company->guid . '/' . friendly_title($company->title);
}

register_elgg_event_handler('init', 'system', 'ecompanies_init');
register_elgg_event_handler('pagesetup', 'system', 'ecompanies_pagesetup');


function eCompanies_xtabs_init() {

    elgg_extend_view('page_elements', 'page_elements/tabs');

}

register_elgg_event_handler('init', 'system', 'eCompanies_xtabs_init');

?>
