document.addEventListener('DOMContentLoaded', function() {

// Definimos el mapa
var mapa = L.map('leafletMap').setView([42.2511933, -8.6894383], 21);

// Definimos el marcador con la "chinqueta"
var marcador = L.marker([42.25090, -8.68965]).addTo(mapa);

// Ponemos un mensaje custom en el PoP
marcador.bindPopup("Panaderías M.L.").openPopup();

//  Creamos el mapa pediendo los datos a la API
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoidnJhdGtlbiIsImEiOiJja2d6aGQ0MDExM3JyMnpyMXR2Zm1pdHlvIn0.n8JYIdVyzVPlmRNfNQf4rw',
    attributionControl: false
}).addTo(mapa);

// Eliminamos el mensaje de la atribución de la librería Leaflet
document.getElementsByClassName( 'leaflet-control-attribution' )[0].style.display = 'none';

});