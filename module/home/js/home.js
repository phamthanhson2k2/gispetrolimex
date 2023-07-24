
var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}',
    { foo: 'bar', attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' });

var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("Toạ độ " + e.latlng.toString())
        .openOn(map);
}

//map.on('click', onMapClick);
//Petrolimex
var ch1 = L.marker([10.04745, 105.77828]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 1", { permanent: true, direction: 'right' });
var ch2 = L.marker([10.02327, 105.76969]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 2", { permanent: true, direction: 'right' });
var ch3 = L.marker([10.059438, 105.766228]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 3", { permanent: true, direction: 'right' });
var ch5 = L.marker([10.0449, 105.78065]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 5", { permanent: true, direction: 'right' });
var ch9 = L.marker([10.04433, 105.73514]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 9", { permanent: true, direction: 'right' });
var ch10 = L.marker([10.01548, 105.75994]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 10", { permanent: true, direction: 'right' });
var ch13 = L.marker([10.01012, 105.75144]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 13", { permanent: true, direction: 'right' });
var ch16 = L.marker([10.03747, 105.75924]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 16", { permanent: true, direction: 'right' });
var ch17 = L.marker([10.01883, 105.76235]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 17", { permanent: true, direction: 'right' });
var cty = L.marker([10.01785, 105.78662]).bindTooltip("Công Ty Dịch Vụ Xăng Dầu Petrolimex Cần Thơ", { permanent: true, direction: 'right' });

var petrolStations = L.layerGroup([ch2, ch1, ch3, ch5, ch9, ch10, ch13, ch16, ch17, cty]);

//PVoil
var pvoilIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});


var pvoil2 = L.marker([10.031833926097445, 105.77319616931264], { icon: pvoilIcon }).bindTooltip("Pvoil CHXD SỐ 2 CẦN THƠ", { permanent: true, direction: 'right' });
var pvoil4 = L.marker([10.109838728448281, 105.61816991534369], { icon: pvoilIcon }).bindTooltip("PVOIL CHXD No. 04", { permanent: true, direction: 'right' });
var pvoil5 = L.marker([10.242132704602076, 105.54974283068738], { icon: pvoilIcon }).bindTooltip("PVOIL CHXD No. 05", { permanent: true, direction: 'right' });
var pvoil6 = L.marker([10.033176700229813, 105.46708383068737], { icon: pvoilIcon }).bindTooltip("PVOIL PETROMEKONG CHXD SỐ 6", { permanent: true, direction: 'right' });
var pvoil80 = L.marker([10.080070312274701, 105.74429508465633], { icon: pvoilIcon }).bindTooltip("PVOIL PETROMEKONG CHXD SỐ 80", { permanent: true, direction: 'right' });
var pvoil81 = L.marker([10.020481672185621, 105.7817321169473], { icon: pvoilIcon }).bindTooltip("PVOIL PETROMEKONG CHXD SỐ 81", { permanent: true, direction: 'right' });

var pvoilStations = L.layerGroup([pvoil2, pvoil4, pvoil5, pvoil6, pvoil80, pvoil81]);

var baseMaps = {
    "Bản đồ nền": osm
};

var overlayMaps = {
    "Petrolimex": petrolStations,
    "PvOil": pvoilStations
};
/*
var container = L.DomUtil.get('map');
if (container != null) {
    container._leaflet_id = null;
}
*/
if (map !== undefined && map !== null) { map.off(); map.remove(); }

//map.off();
//map.remove();
var map = L.map('map', { center: [10.0338, 105.7867], zoom: 11.5, layers: [osm, petrolStations, pvoilStations] });

var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);
// Creating scale control
var scale = L.control.scale().addTo(map);
/*
L.Routing.osrmv1({
    serviceUrl: "//127.0.0.1:5000/route/v1/driving/105.778280,10.047450;105.735140,10.044330?steps=true"
});
*/
/*
L.Routing.control({
    waypoints: [
        L.latLng(10.04745, 105.77828),
        L.latLng(10.04433, 105.73514)
    ],
    serviceUrl: 'http://router.project-osrm.org/route/v1'
    //serviceUrl: 'http://localhost:5000/route/v1'
    //router: L.Routing.osrmv1({
    //    serviceUrl: 'http://127.0.0.1:5000/route/v1'
    //})
}).addTo(map);
*/
/*
drawnItems = L.featureGroup().addTo(map);
var drawControl = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems,
    },
});

var getName = function(layer) {
    var name = prompt('please, enter the geometry name', 'geometry name');
    return name;
};

map.addControl(drawControl);
map.on(L.Draw.Event.CREATED, function(e) {
    var layer = e.layer; 
    var name = getName(layer);
    if (name == 'geometry name') {
        layer.bindPopup('-- no name provided --');
    } else if (name == '') {
        layer.bindPopup('-- no name provided --');
    } else {
        layer.bindTooltip(name, {permanent:true, direction:'top'})
    };
    drawnItems.addLayer(layer);
});
*/