<?php
$company = $vars['entity'];

$company_logo = elgg_view('profile/icon', array('entity' => $company, 'size' => 'large'));

$fields = getCompanyFields();
$company_address = getAddressString($company);
?>

<div id="company_profile" class="contentWrapper">

    <div class="company_logo"><?php echo $company_logo ?> </div>

    <div><span class="company_address">
            <?php
            echo $company_address;
            ?>
        </span></div>
    <?php
            foreach ($fields as $ref => $value) {
                if ($company->$ref && $value['section'] == 'contacts') {
                    echo '<div><span class="company_' . $ref . '">';
                    echo $value['display_name'] . ': ';
                    echo elgg_view('output/' . $value['type'], array('value' => $company->$ref));
                    echo '</span></div>';
                }
            }
    ?>
            <div class="search_listing_extras">
        <?php echo elgg_view("elggx_fivestar/elggx_fivestar", array('entity' => $vars['entity'])); ?>
        </div>

        <div class="company_imprint">
        <?php
            $owner = get_entity($company->owner_guid);
            $imprint = elgg_echo('eCompanies:addedby') . ' ';
            $imprint .= '<a href="' . $owner->getURL() . '">' . $owner->name . '</a> ';
            if (is_plugin_enabled('edifice')) {
                $imprint .= elgg_echo('eCompanies:incategory') . ' ';
                if (get_context() !== 'category') {
                    $category = get_entity(get_item_categories($vars['entity']->guid));
                    
                    $check = true;
                    $breadcrumbs = '<b>';

                    $parent = $category->guid;
                    while ($check) {
                        $parent = get_entity($parent);
                        if ($parent instanceof ElggObject) {
                            $breadcrumbs = '<a href="' . $vars['url'] . 'pg/category/view/company/' . $parent->guid . '/' . friendly_title($parent->title) .'">' . $parent->title . '</a> >> ' . $breadcrumbs;
                            $parent = get_parent($parent->guid)->guid;
                        } else {
                            $check = false;
                        }
                    }

                    $breadcrumbs .= '</b>';

                    $imprint .= $breadcrumbs;
                }
            }
            echo $imprint;
        ?>
        </div>
        <div class="button">
        <?php
            if ($company->canEdit()) {
                echo '<a href="' . $vars['url'] . 'pg/companies/edit/' . $company->guid . '">' . elgg_echo('eCompanies:editbutton') . '</a>';
            }
        ?>
    </div>
</div>
