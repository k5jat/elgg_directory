<?php ?>

<?php

$container = 'global_map';

$companies = $vars['companies'];
$markers = getMarkers($companies);

echo elgg_view('eCompanies/maps/js', $vars);

?>

<script type="text/javascript">
    $(document).ready(function() {
        var markers = <?php echo json_encode($markers) ?>;
        var container = '<?php echo $container ?>';
        var newyork = new google.maps.LatLng(40.69847032728747, -73.9514422416687);

        initialize(newyork, markers, container, true);

    });
</script>

<div id="global_map" style="width:100%;height:500px;">
</div>