var map;

function initialize(){
    var latlng = new google.maps.LatLng(-16.5175116,-50.36822);

    var options = {
        zoom: 14,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("mapa"), options);
}
initialize();
function carregarPontos() {

    var marker = new google.maps.Marker({
    position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
    title: "Meu ponto personalizado! :-D",
    map: map,
    icon: 'marca.png'
    });
    var infowindow = new google.maps.InfoWindow(), marker;

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
    return function() {
        infowindow.setContent("Conteúdo do marcador.");
        nfowindow.open(map, marker);
    }
    })(marker))
}

carregarPontos();
