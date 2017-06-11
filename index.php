<?php
define('WWW_ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
require_once(WWW_ROOT . DS . 'autoload.php');

use BLL\ImovelBLL;
use Model\ImovelInfo;

$regraImovel = new ImovelBLL();
/**@var ImovelInfo[] $imoveis*/
$imoveis = $regraImovel->listarImoveisMapa();
$imoveisMapa = $regraImovel->listarMapaToJson($imoveis);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pesquisa de Imóveis</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="jquery-3.1.1.min.js" ></script>
</head>

<body>

<div id="controls" class="dropdown">
    <select id="country" class="btn btn-default dropdown-toggle">
        <option value="all" >All</option>
        <option value="boa_vista">Boa Vista</option>//-16.5049611,-50.3704456
        <option value="centro">Centro</option>//-16.522340, -50.368856
        <option value="jd_bv">JD. Boa Vista</option>//-16.5049611, -50.3704456
        <option value="jd_p">Jardim Primavera</option>//-16.5108878,-50.3842248
        <option value="pq_bv">Parque Bela Vista</option>//-16.5163616,-50.3858183
        <option value="pq_a">Parque das Araras</option>//-16.5111124,-50.393985
        <option value="vn">Vila Nova</option>//-16.5035793,-50.3759981
    </select>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="map" class="thumbnail" style="margin-left: 15%; width: 70%; height: 300px"></div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var map, places, infoWindow;
    var autocomplete;
    var countryRestrict = {'country': 'all'};
    var MARKER_PATH = 'https://developers.google.com/maps/documentation/javascript/images/marker_green';
    var hostnameRegexp = new RegExp('^https?://.+?/');

    var countries = {
        'all': {
            center: {lat: -16.5187234, lng: -50.3811535},
            zoom: 13
        },

        'boa_vista': {
            center: {lat: -16.5049611, lng: -50.3704456},
            zoom: 16
        },

        'centro': {
            center: {lat: -16.522340, lng: -50.368856},
            zoom: 16
        },

        'jd_bv': {
            center: {lat: -16.5049611, lng: -50.3704456},
            zoom: 16
        },

        'jd_p': {
            center: {lat: -16.5108878, lng: -50.3842248},
            zoom: 16
        },

        'pq_bv': {
            center: {lat: -16.5163616, lng: -50.3858183},
            zoom: 16
        },

        'pq_a': {
            center: {lat: -16.5111124, lng: -50.393985},
            zoom: 16
        },

        'vn': {
            center: {lat: -16.5035793, lng: -50.3759981},
            zoom: 16
        }
    };

    function initMap() {
        var mapaImoveis = <?php echo json_encode($imoveisMapa);?>;

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: countries['all'].zoom,
            center: countries['all'].center,
            mapTypeControl: false,
            panControl: false,
            zoomControl: false,
            streetViewControl: false
        });

        <?php if (count($imoveisMapa) > 1) { ?>
        var iconCasa = "images/marca.png";
        for (var i = 0; i < mapaImoveis.length; i++) {
            var lat = mapaImoveis[i].latitude;
            var long = mapaImoveis[i].longitude;
            var titulo = mapaImoveis[i].titulo;
            var lat2 = mapaImoveis[0].latitude;
            var long2 = mapaImoveis[0].longitude;
            var msg = mapaImoveis[i].msg;
            var end = mapaImoveis[i].endereco;
            var foto = mapaImoveis[i].foto;

            var latlng2 = new google.maps.LatLng(lat2, long2);
            var latlng = new google.maps.LatLng(lat, long);

            var conteudo = '<div id="iw-container" style="height: ">' +
                '<img class="img thumbnail" src= "'+foto+'" alt="Fabrica de Porcelana da Vista Alegre">' +
                '<div class="iw-title">'+titulo+'</div>' +
                '<div class="iw-content">' +
                '<p>'+msg+'</p>' +
                '<div class="iw-subTitle">'+end+'</div>' +
                '</div>' +
                '<div class="iw-bottom-gradient"></div>' +
                '</div>';


            var marker = new google.maps.Marker({
                map: map,
                content: conteudo,
                position: latlng,
                icon: iconCasa
            });

            var infowindow = new google.maps.InfoWindow(), marker;

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(marker.content);
                    infowindow.open(map, marker);
                };
            })(marker));
        }
        <?php } ?>

        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */ (
                document.getElementById('autocomplete')), {
                types: ['(cities)'],
                componentRestrictions: countryRestrict
            });
        places = new google.maps.places.PlacesService(map);

        autocomplete.addListener('place_changed', onPlaceChanged);

        document.getElementById('country').addEventListener(
            'change', setAutocompleteCountry);
    }

    function onPlaceChanged() {
        var place = autocomplete.getPlace();
        if (place.geometry) {
            map.panTo(place.geometry.location);
            map.setZoom(15);
            search();
        } else {
            document.getElementById('autocomplete').placeholder = 'Enter a city';
        }
    }

    function search() {
        var search = {
            bounds: map.getBounds(),
            types: ['lodging']
        };

        places.nearbySearch(search, function(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                clearResults();
                clearMarkers();

                for (var i = 0; i < results.length; i++) {
                    var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
                    var markerIcon = MARKER_PATH + markerLetter + '.png';

                    markers[i] = new google.maps.Marker({
                        position: results[i].geometry.location,
                        animation: google.maps.Animation.DROP,
                        icon: markerIcon
                    });

                    markers[i].placeResult = results[i];
                    google.maps.event.addListener(markers[i], 'click', showInfoWindow);
                    setTimeout(dropMarker(i), i * 100);
                    addResult(results[i], i);
                }
            }
        });
    }

    function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
            if (markers[i]) {
                markers[i].setMap(null);
            }
        }
        markers = [];
    }

    function setAutocompleteCountry() {
        var country = document.getElementById('country').value;
        if (country == 'all') {
            autocomplete.setComponentRestrictions([]);
            map.setCenter({lat: -16.5187234, lng: -50.3811535});
            map.setZoom(13);
        } else {
            autocomplete.setComponentRestrictions({'country': country});
            map.setCenter(countries[country].center);
            map.setZoom(countries[country].zoom);
        }
        clearResults();
        clearMarkers();
    }

    function dropMarker(i) {
        return function() {
            markers[i].setMap(map);
        };
    }

    function addResult(result, i) {
        var results = document.getElementById('results');
        var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
        var markerIcon = MARKER_PATH + markerLetter + '.png';

        var tr = document.createElement('tr');
        tr.style.backgroundColor = (i % 2 === 0 ? '#F0F0F0' : '#FFFFFF');
        tr.onclick = function() {
            google.maps.event.trigger(markers[i], 'click');
        };

        var iconTd = document.createElement('td');
        var nameTd = document.createElement('td');
        var icon = document.createElement('img');
        icon.src = markerIcon;
        icon.setAttribute('class', 'placeIcon');
        icon.setAttribute('className', 'placeIcon');
        var name = document.createTextNode(result.name);
        iconTd.appendChild(icon);
        nameTd.appendChild(name);
        tr.appendChild(iconTd);
        tr.appendChild(nameTd);
        results.appendChild(tr);
    }

    function clearResults() {
        var results = document.getElementById('results');
        while (results.childNodes[0]) {
            results.removeChild(results.childNodes[0]);
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap"
        async defer></script>
</body>
</html>