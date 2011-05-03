<?php ?>

<?php
$latitude = $vars['latitude'];
$longitude = $vars['longitude'];
$address = $vars['address'];
$container = $vars['container'];
$company_guid = $vars['company_guid'];
$company = get_entity($company_guid);

$markers = getMarker($company);

echo elgg_view('eCompanies/maps/js', $vars);

?>

<script type="text/javascript">
    $(document).ready(function() {
        var markers = <?php echo json_encode($markers) ?>;
        var address = '<?php echo $address ?>';
        var company_guid = '<?php echo $company->guid ?>';
        var latitude = '<?php echo $latitude ?>';
        var longitude = '<?php echo $longitude ?>';
        var container = '<?php echo $container ?>';
      
        if (latitude == '' || longitude == '') {
            codeAddress(address, company_guid);
        } else {
            var latlng = new google.maps.LatLng (latitude, longitude);
            initialize(latlng, markers, container, false);
        }
    });
</script>

