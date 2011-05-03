<?php

function getCountryList() {

    $countries = array('Afghanistan', 'Albania', 'Algeria', 'American Samoa', 'Angola', 'Anguilla', 'Antartica', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Ashmore and Cartier Island', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'British Virgin Islands', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burma', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde', 'Cayman Islands', 'Central African Republic', 'Chad', 'Chile', 'China', 'Christmas Island', 'Clipperton Island', 'Cocos (Keeling) Islands', 'Colombia', 'Comoros', 'Congo, Democratic Republic of the', 'Congo, Republic of the', 'Cook Islands', 'Costa Rica', 'Cote d\'Ivoire', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Europa Island', 'Falkland Islands (Islas Malvinas)', 'Faroe Islands', 'Fiji', 'Finland', 'France', 'French Guiana', 'French Polynesia', 'French Southern and Antarctic Lands', 'Gabon', 'Gambia, The', 'Gaza Strip', 'Georgia', 'Germany', 'Ghana', 'Gibraltar', 'Glorioso Islands', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guam', 'Guatemala', 'Guernsey', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Heard Island and McDonald Islands', 'Holy See (Vatican City)', 'Honduras', 'Hong Kong', 'Howland Island', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Ireland, Northern', 'Israel', 'Italy', 'Jamaica', 'Jan Mayen', 'Japan', 'Jarvis Island', 'Jersey', 'Johnston Atoll', 'Jordan', 'Juan de Nova Island', 'Kazakhstan', 'Kenya', 'Kiribati', 'Korea, North', 'Korea, South', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macau', 'Macedonia, Former Yugoslav Republic of', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Man, Isle of', 'Marshall Islands', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Micronesia, Federated States of', 'Midway Islands', 'Moldova', 'Monaco', 'Mongolia', 'Montserrat', 'Morocco', 'Mozambique', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'Netherlands Antilles', 'New Caledonia', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Norfolk Island', 'Northern Mariana Islands', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Pitcaim Islands', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Reunion', 'Romainia', 'Russia', 'Rwanda', 'Saint Helena', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Pierre and Miquelon', 'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Scotland', 'Senegal', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Georgia and South Sandwich Islands', 'Spain', 'Spratly Islands', 'Sri Lanka', 'Sudan', 'Suriname', 'Svalbard', 'Swaziland', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Tobago', 'Toga', 'Tokelau', 'Tonga', 'Trinidad', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'Uruguay', 'USA', 'Uzbekistan', 'Vanuatu', 'Venezuela', 'Vietnam', 'Virgin Islands', 'Wales', 'Wallis and Futuna', 'West Bank', 'Western Sahara', 'Yemen', 'Yugoslavia', 'Zambia', 'Zimbabwe');
    $countries = trigger_plugin_hook('eCompanies:countrylist', 'all', array('current' => $countries), $countries);
    return $countries;
}

function getCompanyFields() {

    $company = array(
        'title' => array('display_name' => 'Company Name', 'type' => 'text', 'section' => 'main'),
        'description' => array('display_name' => 'Description', 'type' => 'longtext', 'section' => 'main'),
        'products' => array('display_name' => 'Products/Services', 'type' => 'tags', 'section' => 'extras'),
        'employees' => array('display_name' => 'Number of Employees', 'type' => 'text', 'section' => 'extras'),
        'street1' => array('display_name' => 'Street Address', 'type' => 'text', 'section' => 'address'),
        'street2' => array('display_name' => 'Street Address 2', 'type' => 'text', 'section' => 'address'),
        'city' => array('display_name' => 'City/Town', 'type' => 'text', 'section' => 'address'),
        'province' => array('display_name' => 'Province/State', 'type' => 'text', 'section' => 'address'),
        'zip' => array('display_name' => 'Postal Code', 'type' => 'text', 'section' => 'address'),
        'country' => array('display_name' => 'Country', 'type' => 'pulldown', 'options' => getCountryList(), 'section' => 'address'),
        'phone' => array('display_name' => 'Phone Number', 'type' => 'text', 'section' => 'contacts'),
        'www' => array('display_name' => 'Website', 'type' => 'url', 'section' => 'contacts'),
        'tags' => array('display_name' => 'Tags', 'type' => 'tags', 'section' => 'extras'),
    );

    $company = trigger_plugin_hook('eCompanies:customfields', 'all', array('current' => $company), $company);

    return $company;
}

function getAddressString($entity) {
    if ($entity->street1)
        $address = $entity->street1 . ', ';
    if ($entity->street2)
        $address .= $entity->street2 . ', ';
    if ($entity->city)
        $address .= $entity->city . ', ';
    if ($entity->province)
        $address .= $entity->province . ', ';
    if ($entity->country)
        $address .= $entity->country;
    return $address;
}

function canCreateCompany($user) {
    global $CONFIG;
    $return = true;
    if (is_plugin_enabled('profile_manager')) {
        $options = array(
            "type" => "object",
            "subtype" => CUSTOM_PROFILE_FIELDS_PROFILE_TYPE_SUBTYPE,
            "limit" => 0,
            "owner_guid" => $CONFIG->site_guid,
            "full_view" => false,
            "view_type_toggle" => false,
            "pagination" => false
        );

        $custom_profile_types = elgg_get_entities($options);

        if (!empty($custom_profile_types)) {
            $profile_type = get_entity($user->custom_profile_type)->guid;
            if ($profile_type && get_plugin_setting('profile_type_' . $profile_type, 'eCompanies') == true) {
                $return = true;
            } else {
                $return = false;
            }
        }
    }
    return $return;
}

function getUserCompanies($user_guid) {

    $options = array(
        'types' => 'object',
        'subtypes' => 'company',
        'owner_guids' => $user_guid,
        'limit' => 9999
    );

    $companies = elgg_get_entities($options);

    return $companies;
}

function getNetworkCompanies($user_guid) {

    $user = get_entity($user_guid);
    $friends = $user->getFriends();

    if (!empty($friends)) {
        foreach ($friends as $friend) {
            $guids[] = $friend->guid;
        }
    }

    $options = array(
        'types' => 'object',
        'subtypes' => 'company',
        'owner_guids' => $guids,
        'limit' => 9999
    );

    $companies = elgg_get_entities($options);

    return $companies;
}

function getSiteCompanies() {
    $options = array(
        'types' => 'object',
        'subtypes' => 'company',
        'limit' => 9999
    );

    $companies = elgg_get_entities($options);

    return $companies;
}

function getTooltip($company) {
    $fields = getCompanyFields();
    $tooltip = '<div>' . getAddressString($company) . '</div>';
    foreach ($fields as $ref => $value) {
        if ($company->$ref && $value['section'] == 'contacts') {
            $tooltip .= '<div><span class="company_' . $ref . '">';
            $tooltip .= $value['display_name'] . ': ';
            $tooltip .= elgg_view('output/' . $value['type'], array('value' => $company->$ref));
            $tooltip .= '</span></div>';
        }
    }
    return $tooltip;
}

function getMarker($company) {
    $markers = array();
    if ($company instanceof ElggObject && $company->getSubtype() == 'company') {
        $markers[] = array($company->title, $company->latitude, $company->longitude, $company->getIcon('small'), getTooltip($company), 1, $company->getURL());
    }
    return $markers;
}

function getMarkers($companies) {
    $markers = array();
    $z = 1;
    foreach ($companies as $company) {
        if ($company instanceof ElggObject && $company->getSubtype() == 'company') {
            $markers[] = array($company->title, $company->latitude, $company->longitude, $company->getIcon('small'), getTooltip($company), $z, $company->getURL());
        }
        $z++;
    }
    return $markers;
}

?>
