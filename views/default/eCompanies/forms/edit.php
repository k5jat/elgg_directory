<?php
$fields = getCompanyFields();
if (!$vars['entity']) {
    foreach ($fields as $ref => $value) {
        $vars['entity']->$ref = '';
    }
    $current_category = NULL;
} else {
    if (is_plugin_enabled('edifice')) {
        $current_category = get_item_categories($vars['entity']->guid);
    } else {
        $current_category = NULL;
    }
}
?>

<form action="<?php echo $vars['url']; ?>action/company/save" method="post" enctype="multipart/form-data">
    <?php
    echo elgg_view('input/securitytoken');
    echo '<p><label>' . elgg_echo('eCompanies:icon') . '</label>' . elgg_view('input/file', array('internalname' => 'companyicon')) . '</p>';
    foreach ($fields as $ref => $value) {
        echo '<div><label>' . elgg_echo($value['display_name']) . '</label>' . elgg_view('input/' . $value['type'], array('value' => $vars['entity']->$ref,
            'internalname' => $ref, 'options' => $value['options'])) . '</div>';
    }

    if (in_array('company', string_to_tag_array(get_plugin_setting('allowed_object_types', 'edifice')))) {
        echo elgg_view('edifice/forms/assign', array('current_category' => $current_category)) . '<br>';
    }


    echo '<p><label>' . elgg_echo('eCompanies:access') . '</label>' . elgg_view('input/access', array('internalname' => 'access_id', 'value' => $vars['entity']->access_id)) . '</p>';
    echo elgg_view('input/hidden', array('value' => $vars['entity']->guid, 'internalname' => 'object_guid'));
    echo elgg_view('input/hidden', array('value' => $vars['user']->guid, 'internalname' => 'user_guid'));
    echo elgg_view('input/submit', array('value' => 'save', 'internalname' => 'save'));
    ?>
</form>
<?php
if ($vars['entity']->guid) {
?>
<form action="<?php echo $vars['url']; ?>action/company/delete" method="post">
    <?php
    echo elgg_view('input/securitytoken');
    echo elgg_view('input/hidden', array('value' => $vars['entity']->guid, 'internalname' => 'company_guid'));
    echo elgg_view('input/submit', array('value' => 'Delete', 'internalname' => 'delete'));
    ?>
</form>
<?php } ?>