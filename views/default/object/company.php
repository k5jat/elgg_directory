<?php

if (isset($vars['entity']) &&
        $vars['entity'] instanceof ElggObject
        && $vars['entity']->getSubtype() == 'company') {
    if (get_context() == "search") {
        echo elgg_view("company/listing", $vars);
    }
}
?>