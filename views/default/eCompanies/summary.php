<?php
$company = $vars['entity'];

$company_logo = elgg_view('profile/icon', array('entity' => $company, 'size' => 'large'));

$fields = getCompanyFields();
$company_address = getAddressString($company);
$map_container = 'company_map';


echo elgg_view('eCompanies/maps/company_map', array(
                    'latitude' => $company->latitude,
                    'longitude' => $company->longitude,
                    'address' => friendly_title($company_address),
                    'container' => $map_container,
                    'company_guid' => $company->guid));
?>

<div class="contentWrapper">
    <div id="<?php echo $map_container ?>"></div>

    <div class="company_description">
        <?php echo $company->description ?>
    </div>
    <?php
    foreach ($fields as $ref => $value) {
        if ($company->$ref && $value['section'] == 'extras') {
            echo '<div class="company_' . $ref . '">';
            echo $value['display_name'] . ': ';
            echo elgg_view('output/' . $value['type'], array('value' => $company->$ref));
            echo '</div>';
        }
    }
    ?>

    <div class="clearfloat"></div>
</div>
