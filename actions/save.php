<?php

global $CONFIG;
gatekeeper();

$user_guid = get_input('user_guid');
$user = get_entity($user_guid);

$object_guid = (int) get_input('object_guid');
if ($object_guid == '') {
    $object_guid = NULL;
} else {
    $object = get_entity($object_guid);
    $address_string = getAddressString($object_guid);
}

$access_id = (int) get_input('access_id');

$company = new ElggObject($object_guid);
$company->subtype = 'company';
$company->owner_guid = $user_guid;
$company->access_id = get_input('access_id');

$fields = getCompanyFields();

foreach ($fields as $ref => $value) {
    if (get_input($ref)) {
        $company->$ref = get_input($ref);
    } else {
        $company->$ref = '';
    }
}

if ($object_guid == NULL) {
    $action = 'create';
} else {
    $action = 'update';
}
if ($object_guid == NULL or $company->canEdit()) {
    $result = $company->save();
} else {
    $result = false;
}

$topbar = get_resized_image_from_uploaded_file('companyicon', 16, 16, true, true);
$tiny = get_resized_image_from_uploaded_file('companyicon', 25, 25, true, true);
$small = get_resized_image_from_uploaded_file('companyicon', 40, 40, true, true);
$medium = get_resized_image_from_uploaded_file('companyicon', 100, 100, true, true);
$large = get_resized_image_from_uploaded_file('companyicon', 200, 200);
$master = get_resized_image_from_uploaded_file('companyicon', 550, 550);

if ($small !== false
        && $medium !== false
        && $large !== false
        && $tiny !== false) {


    $filehandler = new ElggFile();
    $filehandler->owner_guid = $company->owner_guid;
    $filehandler->setFilename("company/" . $company->guid . "large.jpg");
    $filehandler->open("write");
    $filehandler->write($large);
    $filehandler->close();
    $filehandler->setFilename("company/" . $company->guid . "medium.jpg");
    $filehandler->open("write");
    $filehandler->write($medium);
    $filehandler->close();
    $filehandler->setFilename("company/" . $company->guid . "small.jpg");
    $filehandler->open("write");
    $filehandler->write($small);
    $filehandler->close();
    $filehandler->setFilename("company/" . $company->guid . "tiny.jpg");
    $filehandler->open("write");
    $filehandler->write($tiny);
    $filehandler->close();
    $filehandler->setFilename("company/" . $company->guid . "topbar.jpg");
    $filehandler->open("write");
    $filehandler->write($topbar);
    $filehandler->close();
    $filehandler->setFilename("company/" . $company->guid . "master.jpg");
    $filehandler->open("write");
    $filehandler->write($master);
    $filehandler->close();
}

if ($result) {
    system_message(elgg_echo('eCompanies:savesuccess'));
    add_to_river('river/object/company/' . $action, $action, $user->guid, $company->guid);
    if ($address_string !== getAddressString($company)) {
        remove_metadata($company->guid, 'latitude');
        remove_metadata($company->guid, 'longitude');
    }
    forward('pg/companies/view/' . $company->guid);
} else {
    register_error(elgg_echo('eCompanies:noprivileges'));
    forward($_SERVER['HTTP_REFERER']);
}
?>