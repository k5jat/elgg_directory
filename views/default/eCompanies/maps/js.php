<script type="text/javascript">

    function setMarkers(map, locations) {

        for (var i = 0; i < locations.length; i++) {
            var company = locations[i];
            var companyName = company[0];
            var companyLatLng = new google.maps.LatLng(company[1], company[2]);
            var companyIcon = company[3];
            var companyIndex = company[5];
            var companyURL = company[6];
            var companyInfo = company[4];


            var marker = new google.maps.Marker({
                position: companyLatLng,
                map: map,
                icon: companyIcon,
                title: companyName,
                zIndex: companyIndex,
                companyInfo: companyInfo,
                companyURL: companyURL
            });

            var companyInfoWindow = new google.maps.InfoWindow({
                content: 'holding...'
            });

            google.maps.event.addListener(marker, 'mouseover', function() {
                companyInfoWindow.setContent(this.companyInfo);
                companyInfoWindow.open(map, this);
            });

            google.maps.event.addListener(marker, 'click', function() {
                window.open(this.companyURL, 'mywindow');
            });
        }
        return true;
    }

    function setAds(map) {
        var specDiv = document.createElement('div');
        var specOptions = {
            format: google.maps.adsense.AdFormat.HALF_BANNER,
            position: google.maps.ControlPosition.BOTTOM_CENTER,
            publisherId: 'pub-8490157954180368',
            map: map,
            visible: true
        };
        var adUnit = new google.maps.adsense.AdUnit(specDiv, specOptions);
    }

    function initialize(latlng, markers, container, global) {
        var myOptions = {
            zoom: 15,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById(container),
        myOptions);

        setMarkers(map, markers);
        setAds(map);
        if (global == true) {
            setUserPosition(map);
        }
    }

    function codeAddress(address, company_guid) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var latlng = results[0].geometry.location;
                $.ajax ({
                    url: '<?php echo $vars['url'] ?>mod/eCompanies/views/default/ajax/setlatlng.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        latitude: latlng.lat(),
                        longitude: latlng.lng(),
                        company_guid: company_guid
                    },
                    success: function(data) {
                        initialize(latlng);
                    }
                });
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }

    function setUserPosition(map) {
        var initialLocation;
        var browserSupportFlag =  new Boolean();

        if(navigator.geolocation) {
            browserSupportFlag = true;
            navigator.geolocation.getCurrentPosition(function(position) {
                initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                map.setCenter(initialLocation);
            }, function() {
                handleNoGeolocation(browserSupportFlag);
            });
            // Try Google Gears Geolocation
        } else if (google.gears) {
            browserSupportFlag = true;
            var geo = google.gears.factory.create('beta.geolocation');
            geo.getCurrentPosition(function(position) {
                initialLocation = new google.maps.LatLng(position.latitude,position.longitude);
                map.setCenter(initialLocation);
            }, function() {
                handleNoGeoLocation(browserSupportFlag);
            });
            // Browser doesn't support Geolocation
        } else {
            browserSupportFlag = false;
            handleNoGeolocation(browserSupportFlag, map);
        }


    }

    function handleNoGeolocation(errorFlag, map) {
        var siberia = new google.maps.LatLng(60, 105);
        var newyork = new google.maps.LatLng(40.69847032728747, -73.9514422416687);
        var initialLocation;

        if (errorFlag == true) {
            alert("Geolocation service failed.");
            initialLocation = newyork;
        } else {
            alert("Your browser doesn't support geolocation. We've placed you in Siberia.");
            initialLocation = siberia;
        }
        map.setCenter(initialLocation);
    }

</script>
