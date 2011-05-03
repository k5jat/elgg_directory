<?php
$entity = $vars['entity'];

$title = $entity->title;
$description = elgg_get_excerpt($vars['entity']->description, 100);

$icon = elgg_view("profile/icon", array('entity' => $entity, 'size' => 'small'));
$address = getAddressString($entity);
?>

<div id="<?php echo $entity->guid ?>" class="search_listing">
    <div class="filter_area">
        <div class="listing_title">
            <p class="company_title"><a href="<?php echo $entity->getURL() ?>"><?php echo $title; ?></a></p>
        </div>

        <div class="search_listing_icon company_logo"><?php echo $icon; ?></div>
        <div class="search_listing_info">
            <p class="item_description company_description"><?php echo $description; ?></p>
            <p class="item_address company_address"><?php echo $address ?></p>
        </div>
    </div>
    <div class="search_listing_extras">
        <div class="company_category">
            <?php
            if (is_plugin_enabled('edifice')) {
                if (get_context() !== 'category') {
                    $category = get_entity(get_item_categories($vars['entity']->guid));
                    $check = true;
                    while ($check) {
                        if ((int)$category->level !== 1) {
                            $category = get_parent($category->guid);
                        } else {
                            $check = false;
                        }
                    }
                    $url = $category->getURL();
                    echo '<a href="' . $url . '">' . $category->title . '</a>';
                }
            }
            ?>
        </div>
        <div class="right">
            <?php echo elgg_view("elggx_fivestar/elggx_fivestar", array('entity' => $vars['entity'])); ?>
        </div>
        <div class="clearfloat"></div>
    </div>
</div>