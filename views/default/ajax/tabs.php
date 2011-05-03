<?php

require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . "/engine/start.php");

$tab_id = get_input('tab_id');
$tab_view = get_input('tab_view');

if ($tab_id && $tab_view) {
    echo elgg_view($tab_view, $_SESSION['tabs'][$tab_id]);
}

die();
?>